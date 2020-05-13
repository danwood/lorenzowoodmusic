<?php
error_reporting(E_ALL);
date_default_timezone_set('America/Los_Angeles');

// Temporarily don't use $_SERVER['DOCUMENT_ROOT'] - based database.
define('PRIVATE_DIR',      dirname(__FILE__)  . '/../../protected');
define('PRIVATE_RESOLVED', is_link(PRIVATE_DIR) ? readlink(PRIVATE_DIR) : PRIVATE_DIR);
include_once(PRIVATE_RESOLVED . '/downcode_db/secrets.php');    // $password

define('DOWNCODE_DBDIR',    PRIVATE_RESOLVED . '/downcode_db');
define('DOWNCODE_FILESDIR', PRIVATE_RESOLVED . '/downcode_files');

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
		if (!is_writable($dbPath)) {
			error_log("Not writeable database: " . $dbPath);
			echo '<h1><a href="applescript://com.apple.scripteditor?action=new&script=do%20shell%20script%20%22chmod%20666%20~%2FDropbox%2Florenzowoodmusic_private%2Fdowncode_db%2Fdowncode.sqlite3%22">chmod 666 downcode.sqlite3</a></h1>';
			throw new \RuntimeException("Database cannot be updated");
		}
		$this->open($dbPath, SQLITE3_OPEN_READWRITE);
	}



	function allReleases()	// reverse order by timestamp, so most recent added at top
	{
		$statement = $this->prepare('SELECT *, a.name as artist_name FROM Release R, Artist A WHERE R.artist_id = A.ID ORDER BY release_date DESC');
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
		$statement = $this->prepare('SELECT *, a.name as artist_name FROM Release R, External E, Artist A LEFT OUTER JOIN Marketing M ON R.ID = M.release_id WHERE R.ID = E.release_id AND R.artist_id = A.ID AND R.slug = :slug ORDER BY E.variation_id ' . ($radio_edit ? 'desc' : 'asc'));
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
		$statement = $this->prepare('SELECT *, a.name as artist_name FROM Release R, Artist A WHERE R.artist_id = A.ID AND R.slug = :slug');
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
		$statement = $this->prepare("SELECT *, T.name as release_type_name FROM Release R, External E, ReleaseType T WHERE R.ID = E.release_id AND R.release_type_id = T.ID AND R.artist_id = :artist_id AND (E.spotify_presave_url != '' OR E.spotify_album != '' OR E.spotify_track != '') AND apple_music_album != '' AND release_date < date('now', 'start of day','+7 days') ORDER BY R.release_date DESC, E.variation_id DESC LIMIT 1");
		$statement->bindValue(':artist_id', $artist_id);
		$ret = $statement->execute();
		while ($album = $ret->fetchArray(SQLITE3_ASSOC) ){
			$result = $album;
		}
		return $result;
	}

	// All released, or upcoming with the ability to pre-save/pre-order, are listed here.

	function marketingReleases()
	{
		$statement = $this->prepare("SELECT *, T.name as release_type_name, a.name as artist_name FROM Release R, External E, ReleaseType T, Marketing M, Artist A WHERE R.ID = E.release_id AND R.ID = M.release_id AND R.release_type_id = T.ID AND A.ID = R.artist_id AND (E.spotify_presave_url != '' OR E.spotify_album != '' OR E.spotify_track != '') AND apple_music_album != '' ORDER BY R.release_date DESC, E.variation_id DESC");
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


	function pathCDNForImageSize($release, $size = 3000) {
		if (!in_array($size, Array(64, 384, 640, '1200x630', 3000, 'blurred'))) return NULL;

		$cloudPrefix = 'https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/';

		$dir = 'album_art_' . $size;
		$file = $release['image'];
		if ($size == 64 && $release['image_64']) {
			$file = $release['image_64'];
		}


		return $cloudPrefix . $dir . '/' . $file;
	}


}
?>