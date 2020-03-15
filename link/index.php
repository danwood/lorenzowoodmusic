<?php

require_once('../classes.php');
$db = new DowncodeDB();
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
	$albums = $db->allAlbums();
	foreach ($albums as $album) {
		echo '<a href="' . htmlentities($album['slug'], ENT_QUOTES) . '">';
		echo htmlspecialchars($album['title']);
		echo '</a><br />' . PHP_EOL;
	}
	die();
}

$album = $db->albumForSlug($slug);
if ($album) {
	$longTitle = $album['title'];
	if (!empty($album['featuring'])) { $longTitle .= ' [feat. ' . $album['featuring'] . ']'; }
	$longTitle .= ' - by ' . $album['artist'];
	$releaseDateString = NULL;
	$now = new DateTime();
	$release = $now;	// default to now, so it should show up as released
	if (!empty($album['release_date'])) {
		$release = new DateTime($album['release_date']);
		$now = new DateTime();
		if ($now < $release) $releaseDateString = $release->format('l, F jS');
	}
}
else {
	header('HTTP/1.0 404 Not Found');
	readfile('../404.html');
	exit();
}
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><title><?php echo htmlentities($longTitle); ?></title><meta name='description' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap" rel="stylesheet"><link rel="apple-touch-icon" href="icon.png"><link rel="stylesheet" href="/css/main.030920.css"><meta property='og:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:url' content='<?php echo htmlentities(curPageURL()); ?>'>
<meta property='og:type' content='article'>
<meta property='og:image' content='<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($album['imageName'], ENT_QUOTES); ?>'> 
<meta name='twitter:url' value='<?php echo htmlentities(curPageURL()); ?>'>
<meta name='twitter:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:image' content='<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($album['imageName'], ENT_QUOTES); ?>'><link rel="stylesheet" href="/css/linkstyles.122219.css"></head><body><!--[if lt IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><h1 class="ir">Lorenzo Wood Music</h1><div class="logo"><a href="/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="85 90 441 49"><defs/><path d="M90.4 132.4V92.9c0-.7-.7-1.3-1.4-1.4h-3.3V137H97c1.5 0 2.2-.7 2.5-1.2l1.5-3.4H90.4zM125.6 91a5.8 5.8 0 00-5.9 5.8v35a6 6 0 005.9 5.7h3.5a5.9 5.9 0 005.7-5.8V96.8a6 6 0 00-5.7-5.8h-3.5zm1.3 42.4a2.6 2.6 0 01-2.5-2.6V97.7c0-1.4 1.1-2.5 2.5-2.6h.7c1.3 0 2.4 1.2 2.4 2.6v33.1c0 1.4-1 2.6-2.4 2.6h-.7zm46.4 3.6v-17.4s.1-3.4-1.7-4.3c1.9-.5 1.7-4 1.7-4v-14c0-3.3-2.6-5.8-5.8-5.8H159V137h4.7v-19.6h2.5c1.2 0 2.4.8 2.4 3V137h4.7zm-9.6-24V96h2.5c1.2 0 2.4.6 2.4 2.3v12.2c0 2.1-1.2 2.6-2.4 2.6h-2.5zm41 19.4v-15.8c0-.6.5-1.1 1-1.1h2c1.5 0 2.2-.7 2.5-1.3l1.5-3.4h-7V97.3c0-.7.4-1.1 1-1.1h3.8c1.5 0 2.3-.7 2.5-1.3l1.6-3.4h-12.2c-.8 0-1.4.6-1.4 1.3V137h10.4c1.5 0 2.2-.7 2.5-1.2l1.5-3.4h-9.7zm47-40.9H247v26.2L242.2 94c-.2-1.3-.7-2.5-3.3-2.5h-2.1V137h4.7v-25.4l5 22.5c.2.9.5 2.9 3 2.9h2.2V91.5zM279.5 115.3L272 137h17c1.4 0 2-.7 2.4-1.3l1.5-3.3h-12.7c-.6 0-1-.5-.8-1.2l5.3-15.9h-5.3zM293 91.5h-17.8l1.6 3.4c.3.6 1 1.3 2.5 1.3h5.2c.8 0 1 .5 1 1l-4.7 13.7h5.5l6.6-19.4zM320.6 91a5.8 5.8 0 00-5.9 5.8v35a6 6 0 005.9 5.7h3.5a5.9 5.9 0 005.7-5.8V96.8a6 6 0 00-5.7-5.8h-3.5zm1.3 42.4a2.6 2.6 0 01-2.5-2.6V97.7c0-1.4 1.1-2.5 2.5-2.6h.7c1.3 0 2.4 1.2 2.4 2.6v33.1c0 1.4-1 2.6-2.4 2.6h-.7zM414 91.5h-3.7c-1 0-1.3.6-1.4 1l-3 24.9-3-19.4h-.6c-3 0-3.8 1-4 3.6l-2.3 15.8-3.2-25c0-.2-.3-.9-1.4-.9h-3.6l5.7 45.5h4.3l3.1-23 3.2 23h4.3l5.6-45.5zm24.9-.5a5.8 5.8 0 00-5.9 5.8v35a6 6 0 005.9 5.7h3.5a5.9 5.9 0 005.7-5.8V96.8a6 6 0 00-5.7-5.8H439zm1.3 42.4a2.6 2.6 0 01-2.5-2.6V97.7c0-1.4 1.1-2.5 2.5-2.6h.7c1.3 0 2.4 1.2 2.4 2.6v33.1c0 1.4-1 2.6-2.4 2.6h-.7zM477.9 91a5.8 5.8 0 00-5.9 5.8v35a6 6 0 005.9 5.7h3.5a5.9 5.9 0 005.7-5.8V96.8a6 6 0 00-5.7-5.8H478zm1.3 42.4a2.6 2.6 0 01-2.5-2.6V97.7c0-1.4 1.1-2.5 2.5-2.6h.7c1.3 0 2.4 1.2 2.4 2.6v33.1c0 1.4-1 2.6-2.4 2.6h-.7zm31.9-41.9V137h9c3.3 0 5.8-2.5 5.9-5.7v-34a5.8 5.8 0 00-5.8-5.8h-9zm10.2 38.5c0 1.7-1.1 2.4-2.4 2.4h-3V96.2h3c1.3 0 2.4.6 2.4 2.3V130z"/></svg></a><div class="mini-icons"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic"><svg aria-label="Instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Instagram</desc><path fill="#e95950" d="M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.7 4.92 4.92.06 1.27.07 1.65.07 4.85 0 3.2-.01 3.58-.07 4.85-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07a83 83 0 0 1-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92A82.98 82.98 0 0 1 2.16 12a84 84 0 0 1 .07-4.85c.15-3.23 1.67-4.77 4.92-4.92A84.4 84.4 0 0 1 12 2.16zM12 0C8.74 0 8.33.01 7.05.07 2.7.27.27 2.7.07 7.05A84.29 84.29 0 0 0 0 12c0 3.26.01 3.67.07 4.95.2 4.36 2.62 6.78 6.98 6.98 1.28.06 1.7.07 4.95.07 3.26 0 3.67-.01 4.95-.07 4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.7.07-4.95 0-3.26-.01-3.67-.07-4.95C23.73 2.7 21.3.27 16.95.07A84.33 84.33 0 0 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.85a1.44 1.44 0 1 0 0 2.89 1.44 1.44 0 0 0 0-2.89z"/></svg></a><a data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic"><svg aria-label="Facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Facebook</desc><path fill="#3b5998" d="M22.68 0H1.32C.6 0 0 .6 0 1.32v21.36C0 23.4.6 24 1.32 24h11.5v-9.3H9.69v-3.62h3.13V8.41c0-3.1 1.9-4.79 4.66-4.79 1.32 0 2.46.1 2.8.15V7h-1.92c-1.5 0-1.8.71-1.8 1.76v2.32h3.59l-.47 3.62h-3.12V24h6.12c.73 0 1.32-.6 1.32-1.32V1.32C24 .6 23.4 0 22.68 0z"/></svg></a></div><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">Home</a></li><li><a href="/photos/">Photos</a></li><li><a href="/videos/">Videos</a></li><li><a href="/2am-in-the-basement.html">2AM</a></li><li><a href="/booking/">Booking</a></li></ul></nav></div></header><main><div class="background-blur"><img src="../album_art_640/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>"></div><div class="center-column"><?php if ($album['additional_info']) { ?>
<div class="centered additional"><a href="<?php echo htmlentities($album['additional_info_url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($album['additional_info']); ?></a></div>
<?php } ?><div class="imagecontainer"><img src="../album_art_640/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>">
<?php if ($album['youtube_video_id']) { ?>
<div class="youtube-button"><a href="https://www.youtube.com/watch?v=<?php echo htmlentities($album['youtube_video_id'], ENT_QUOTES); ?>"><img src="../svg/youtube-play.svg" alt="Youtube"></a></div>
<?php } ?></div><div class="title-container"><h1><?php echo htmlspecialchars($album['artist']); ?> <br> <?php echo htmlspecialchars($album['title']); ?><?php $featuring = $album['featuring']; if (!empty($featuring)) { echo ' (Featuring ' . htmlspecialchars($featuring) . ')'; } ?></h1><p><?php if ($releaseDateString) {	echo 'Releasing ' . htmlspecialchars($releaseDateString);
} else {
	echo 'Download and stream now';
}?></p></div><div class="service-container"><?php if ($album['itunes_id']) { ?>
<div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>?app=itunes&amp;at=1000lKSp"><img src="../svg/iTunes_Store_Buy_Lockup_RGB_blk.svg" alt="iTunes"><span class="play"><?php echo $releaseDateString ? 'Pre-order' : 'Download'; ?></span></a></div>
<?php } if ($album['itunes_id'] && empty($releaseDateString)) { ?>
<div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>?mt=1&app=music&amp;at=1000lKSp"><img src="../svg/Apple_Music_lockup_RGB_blk.svg" alt="Apple Music"><span class="play">Play</span></a></div>
<?php } if ($album['spotify_id']) { ?>
<div class="service"><a href="https://play.spotify.com/album/<?php echo htmlentities($album['spotify_id'], ENT_QUOTES); ?>"><img src="../svg/spotify-text.svg" alt="Spotify"><span class="play">Play</span></a></div>
<?php } if ( ($now < $release) && $album['spotify_presave_url']) { ?>
<div class="service"><a rel="nofollow" href="<?php echo htmlentities($album['spotify_presave_url'], ENT_QUOTES); ?>"><img src="../svg/spotify-text.svg" alt="Presave on Spotify"><span class="play">Pre-save</span></a>
<div style="padding-left:5em; font-size:80%; color:gray;">This step takes you to our DistroKid.com page to continue. You will be asked to log into your Spotify account.</div>
</div>
<?php } if ($album['amazon_music_id']) { ?>
<div class="service"><a href="https://www.amazon.com/dp/<?php echo htmlentities($album['amazon_music_id'], ENT_QUOTES); ?>"><img src="../svg/amazon-music.svg" alt="Amazon Music"><span class="play">Play</span></a></div>
<?php } if ($album['google_play_id']) { ?>
<div class="service"><a href="https://play.google.com/store/music/album/<?php echo htmlentities($album['google_play_id'], ENT_QUOTES); ?>"><img src="../svg/google-play.svg" alt="Google Play"><span class="play"><?php echo $releaseDateString ? 'Pre-order' : 'Download'; ?></span></a></div>
<?php } if ($album['youtube_music_id']) { ?>
<div class="service"><a href="https://music.youtube.com/browse/<?php echo htmlentities($album['youtube_music_id'], ENT_QUOTES); ?>"><img src="../svg/youtube-music.svg" alt="Youtube Music"><span class="play">Play</span></a></div>
<?php } if ($album['soundcloud_id']) { ?>
<div class="service"><a href="https://soundcloud.com/<?php echo htmlentities($album['soundcloud_id'], ENT_QUOTES); ?>"><img src="../svg/soundcloud.svg" alt="Soundcloud"><span class="play">Play</span></a></div>
<?php } if ($album['deezer_id']) { ?>
<div class="service"><a href="https://www.deezer.com/us/album/<?php echo htmlentities($album['deezer_id'], ENT_QUOTES); ?>"><img src="../svg/deezer.svg" alt="Deezer"><span class="play">Play</span></a></div>
<?php } if ($album['bandcamp_id']) { ?>
<div class="service"><a href="https://lorenzowoodmusic.bandcamp.com/<?php echo htmlentities($album['bandcamp_id'], ENT_QUOTES); ?>"><img src="../svg/bandcamp.svg" alt="Bandcamp"><span class="play">Download</span></a></div>
<?php } if ($album['cd_id']) { ?>
<div class="service"><a href="<?php echo htmlentities($album['cd_id'], ENT_QUOTES); ?>"><img src="/img/cd100.png" alt="Buy CD"><span class="play">Buy</span></a></div>
<?php } ?></div></div></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b></p><p class="js-warning">JavaScript is disabled in your browser; please enable it to see missing content.
</p></footer><?php
$db->close();
?></body></html>