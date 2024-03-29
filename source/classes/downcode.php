<?php
error_reporting(E_ALL);
date_default_timezone_set('America/Los_Angeles');

// Temporarily don't use $_SERVER['DOCUMENT_ROOT'] - based database.
define('PRIVATE_DIR', dirname(__FILE__)  . '/../../protected');
define('PRIVATE_RESOLVED', is_link(PRIVATE_DIR) ? readlink(PRIVATE_DIR) : PRIVATE_DIR);
include_once(PRIVATE_RESOLVED . '/downcode_db/secrets.php');	// $password

define('DOWNCODE_DBDIR',	PRIVATE_RESOLVED . '/downcode_db');

define('CLOUDPREFIX', 'https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/f_auto,q_auto/lwm/');

/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}


function baseURL() {
	$pageURL = 'http';
	if(isset($_SERVER["HTTPS"]))
	if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
	} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
	}
	return $pageURL;
}
function curPageURL() {
	return baseURL() . $_SERVER["REQUEST_URI"];
}


class DowncodeDB extends SQLite3
{
	function __construct()
	{
		$dbPath = DOWNCODE_DBDIR . '/downcode.sqlite3';
		//if (!is_writable($dbPath)) {
		//	error_log("Not writeable database: " . $dbPath);
		//	echo '<h1><a href="applescript://com.apple.scripteditor?action=new&script=do%20shell%20script%20%22chmod%20666%20~%2FDropbox%2Florenzowoodmusic_private%2Fdowncode_db%2F//downcode.sqlite3%22">chmod 666 downcode.sqlite3</a></h1>';
		//	throw new \RuntimeException("Database cannot be updated");
		//}
		$this->open($dbPath, SQLITE3_OPEN_READONLY);		// don't need it to be SQLITE3_OPEN_READWRITE unless we start updating from the website
	}



	function allReleases()	// reverse order by timestamp, so most recent added at top
	{
		$statement = $this->prepare('SELECT *, a.name as artist_name FROM Release R, Artist A WHERE R.RELEASE_TYPE_ID != 0 AND R.artist_id = A.ID ORDER BY release_date DESC');
		$ret = $statement->execute();
		$result = Array();
		while ($release = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result[] = $release;
		}
		return $result;
	}

	// Returns an array of releases: the desired (explicit/non-explicit) followed by the other one
	// so client knows if there is also an alternate version.

	function releasesExtendedForSlug($slug)
	{
		$slug = strtolower(trim($slug));
		// If it ends with -radio-edit we are getting a different 'album'
		$needle = "-radio-edit";
		$length = strlen($needle);
		$radio_edit = false;

		if (substr($slug, -$length) === $needle) {
			$radio_edit = true;
			$slug = substr($slug, 0,-$length);		// remove the -radio-edit
		}

		$result = NULL;
		$statement = $this->prepare('SELECT *, a.name as artist_name FROM Release R, External E, Artist A LEFT OUTER JOIN Marketing M ON R.ID = M.release_id WHERE R.RELEASE_TYPE_ID != 0 AND R.ID = E.release_id AND R.artist_id = A.ID AND R.slug = :slug ORDER BY E.variation_id ' . ($radio_edit ? 'desc' : 'asc'));
		$statement->bindValue(':slug', $slug);
		$ret = $statement->execute();
		$result = Array();
		while ($album = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result[] = $album;
		}
		return count($result) ? $result : NULL;		// return array of releases, with preferred one first
	}

	// JUST the release wthout the External stuff. No variations, so just one item.

	function releaseForSlug($slug)
	{
		$slug = strtolower(trim($slug));

		$result = NULL;
		$statement = $this->prepare('SELECT *, a.name as artist_name FROM Release R, Artist A WHERE R.RELEASE_TYPE_ID != 0 AND R.artist_id = A.ID AND R.slug = :slug');
		$statement->bindValue(':slug', $slug);
		$ret = $statement->execute();
		while ($release = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result = $release;
		}
		return $result;
	}

	/*
		Figure out which album to feature at the top of the home page / 2AM page.
		Pass in $artist, defaults to 1 = Lorenzo Wood

		This returns the most recent (by release date)
		release that at least has an iTunes/Apple Music entry, and a Spotify Presave or Stream link.
		This means we only show this featured item when there is an action available for the visitor to take!
		Otherwise we keep showing the latest release that fits that criteria.

		To prevent conflicts with a just-released song, we don't find the upcoming release until 7 days before release.
		At that point, we stop featuring the released one, and switch to the upcoming one.

		Ideally we would be able to have a longer tease period (several weeks) before release, if there is no recent release,
		but then again we should be promoting what we have already released usually. Still, we can show the upcoming release further down - see marketingRelease().
	*/
	function featuredRelease($artist_id = 1)
	{
		$result = NULL;
		$statement = $this->prepare("SELECT *, T.name as release_type_name FROM Release R, External E, ReleaseType T WHERE R.RELEASE_TYPE_ID != 0 AND R.ID = E.release_id AND R.release_type_id = T.ID AND R.artist_id = :artist_id AND (E.spotify_presave_url != '' OR E.spotify_album != '' OR E.spotify_track != '') AND apple_music_album != '' AND release_date < date('now', 'start of day','+7 days') ORDER BY R.release_date DESC, E.variation_id DESC LIMIT 1");
		$statement->bindValue(':artist_id', $artist_id);
		$ret = $statement->execute();
		while ($album = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result = $album;
		}
		return $result;
	}

	// All released, or upcoming with the ability to pre-save/pre-order, are listed here.
	// This ONLY matches Lorenzo Wood artist

	// #######  Keep old name around for a short while since PHP gets cached

	function marketingReleases()
	{
		$statement = $this->prepare("SELECT *, T.name as release_type_name, a.name as artist_name FROM Release R, External E, ReleaseType T, Marketing M, Artist A WHERE R.RELEASE_TYPE_ID != 0 AND R.ID = E.release_id AND R.ID = M.release_id AND R.release_type_id = T.ID AND A.ID = R.artist_id AND (E.spotify_presave_url != '' OR E.spotify_album != '' OR E.spotify_track != '') AND apple_music_album != '' AND A.ID = 1 ORDER BY R.release_date DESC, E.variation_id DESC");
		$ret = $statement->execute();

		//  AND release_date < date('now', 'start of day','+7 days')

		$result = Array();
		$lastReleaseID = -1;		// Can't figure out the SQL to only get one row per release so cheat here!
		while ($release = $ret->fetchArray(SQLITE3_ASSOC) ){
			if ($release['release_id'] != $lastReleaseID) {
				$result[] = $release;
			}
			$lastReleaseID = $release['release_id'];
		}
		return count($result) ? $result : NULL;		// return array of releases, with preferred one first
	}

	function projects()
	{
		$statement = $this->prepare("SELECT P.*, PT.class, PT.name AS section_type FROM Project P, ProjectType PT WHERE PT.id = P.type ORDER BY date DESC");
		$ret = $statement->execute();
		$result = Array();
		while ($release = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result[] = $release;
		}
		return $result;
	}

	function projectsAndLorenzoWoodReleases()
	{
		$statement = $this->prepare("SELECT PT.class, PT.name AS section_type, NULL as slug, P.* FROM Project P, ProjectType PT WHERE PT.id = P.type
UNION ALL
SELECT 'release' as class, 'Release' as section_type, R.slug, R.id as id, '0' as type, NULL as client, R.title, E.spotify_track as embed_code, E.spotify_album as embed_code_2,  NULL as embed_title, NULL as embed_title_2, R.image as image_name, NULL as alt, NULL as url, M.description_html as html, R.release_date as date, '0' as month_only, '0' as is_small
FROM Release R, External E, ReleaseType T, Marketing M, Artist A WHERE R.RELEASE_TYPE_ID != 0 AND R.ID = E.release_id AND R.ID = M.release_id AND R.release_type_id = T.ID AND A.ID = R.artist_id AND (E.spotify_presave_url != '' OR E.spotify_album != '' OR E.spotify_track != '') AND apple_music_album != '' AND A.ID = 1
AND E.variation_id < 2
ORDER BY date DESC");
		// Kind of a hack - looking for variation_id < 2 means either null or 0 or explicit, NOT radio edit, instrumental etc.
		$ret = $statement->execute();
		$result = Array();
		while ($release = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result[] = $release;
		}
		return $result;
	}


	// All released, or upcoming with the ability to pre-save/pre-order, are listed here.
	// This ONLY matches Lorenzo Wood artist

	function marketingLorenzoWoodReleases()
	{
		$statement = $this->prepare("SELECT *, T.name as release_type_name, a.name as artist_name FROM Release R, External E, ReleaseType T, Marketing M, Artist A WHERE R.RELEASE_TYPE_ID != 0 AND R.ID = E.release_id AND R.ID = M.release_id AND R.release_type_id = T.ID AND A.ID = R.artist_id AND (E.spotify_presave_url != '' OR E.spotify_album != '' OR E.spotify_track != '') AND apple_music_album != '' AND A.ID = 1 ORDER BY R.release_date DESC, E.variation_id DESC");
		$ret = $statement->execute();

		//  AND release_date < date('now', 'start of day','+7 days')

		$result = Array();
		$lastReleaseID = -1;		// Can't figure out the SQL to only get one row per release so cheat here!
		while ($release = $ret->fetchArray(SQLITE3_ASSOC) ){
			if ($release['release_id'] != $lastReleaseID) {
				$result[] = $release;
			}
			$lastReleaseID = $release['release_id'];
		}
		return count($result) ? $result : NULL;		// return array of releases, with preferred one first
	}


	function pathCDNForImageSize($release, $size = 3000, $useCDN = true) {
		if (!in_array($size, Array(64, 384, 640, '1200x630', 'background_1200x630', 3000, 'blurred'))) return NULL;

		$cloudPrefix = $useCDN ? CLOUDPREFIX : '/';

		$dir = 'album_art_' . $size;
		$file = $release['image'];
		if ($size == 64 && $release['image_64']) {
			$file = $release['image_64'];
		}


		return $cloudPrefix . $dir . '/' . $file;
	}


}
?>