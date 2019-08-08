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
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><title><?php echo htmlentities($longTitle); ?></title><meta name='description' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link rel="apple-touch-icon" href="icon.png"><link rel="stylesheet" href="/css/main.07052019.css"><meta property='og:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:url' content='<?php echo htmlentities(curPageURL()); ?>'>
<meta property='og:type' content='article'>
<meta property='og:image' content='<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($album['imageName'], ENT_QUOTES); ?>'> 
<meta name='twitter:url' value='<?php echo htmlentities(curPageURL()); ?>'>
<meta name='twitter:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:image' content='<?php echo baseURL() . '/album_art_large/' . htmlentities($album['imageName'], ENT_QUOTES); ?>'><link rel="stylesheet" href="/css/linkstyles.080719.css"></head><body><!--[if lt IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><h1 class="ir">Lorenzo Wood Music</h1><div class="logo"><a href="/"><svg viewBox="0 0 846 73" aria-label="Lorenzo Wood Music" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M.1 71V3.6h12.3v57.1h27.7V71H.1zm69.8-49.8c14.5 0 24.2 10.2 24.2 25 0 17.9-12.6 25.9-25 25.9-13.8 0-24.4-9.5-24.4-25.1 0-16 10.5-25.8 25.2-25.8zm-.3 9c-8.7 0-12.2 8.4-12.2 16.5 0 9.4 4.6 16.5 12.1 16.5 7 0 11.9-6.9 11.9-16.7 0-7.6-3.4-16.3-11.8-16.3zM104.2 71V38c0-6.6-.1-11.3-.4-15.7h10.7l.4 9.3h.4c2.4-6.9 8.1-10.4 13.3-10.4 1.2 0 1.9.1 2.9.3v11.6c-1-.2-2.1-.4-3.6-.4-5.9 0-9.9 3.8-11 9.3-.2 1.1-.4 2.4-.4 3.8V71h-12.3zm76-20.9h-32.6c.3 8.8 7.2 12.6 15 12.6 5.7 0 9.8-.8 13.5-2.2l1.8 8.5c-4.2 1.7-10 3-17 3-15.8 0-25.1-9.7-25.1-24.6 0-13.5 8.2-26.2 23.8-26.2 15.8 0 21 13 21 23.7 0 2.3-.2 4.1-.4 5.2zm-32.6-8.6H169c.1-4.5-1.9-11.9-10.1-11.9-7.6 0-10.8 6.9-11.3 11.9zM190.5 71V36.8c0-5.6-.1-10.3-.4-14.5h10.8l.6 7.3h.3c2.1-3.8 7.4-8.4 15.5-8.4 8.5 0 17.3 5.5 17.3 20.9V71h-12.3V43.5c0-7-2.6-12.3-9.3-12.3-4.9 0-8.3 3.5-9.6 7.2-.4 1.1-.5 2.6-.5 4V71h-12.4zm52.6 0v-7.1l18.3-23.4c2.5-3 4.6-5.4 7.2-8.2v-.2h-23.7v-9.8h38.7v7.5l-17.9 22.9c-2.4 2.9-4.7 5.7-7.2 8.3v.2h25.7V71h-41.1zm71-49.8c14.5 0 24.2 10.2 24.2 25 0 17.9-12.6 25.9-25 25.9-13.8 0-24.4-9.5-24.4-25.1 0-16 10.5-25.8 25.2-25.8zm-.3 9c-8.7 0-12.2 8.4-12.2 16.5 0 9.4 4.6 16.5 12.1 16.5 7 0 11.9-6.9 11.9-16.7 0-7.6-3.4-16.3-11.8-16.3zM373.1 71h-13.3L343.3 3.6h13.1l6.4 30.6c1.7 8.2 3.3 16.8 4.4 23.5h.2c1.1-7.1 3-15.1 4.9-23.6l7.3-30.5h12.9l6.7 31c1.7 8 3.1 15.5 4.1 22.8h.2c1.2-7.4 2.8-15.1 4.6-23.3l7-30.5h12.5L409.5 71h-13.2l-7-31.7c-1.7-7.7-2.9-14.1-3.7-21.4h-.2c-1.2 7.2-2.5 13.7-4.5 21.4L373.1 71zm80.5-49.8c14.5 0 24.2 10.2 24.2 25 0 17.9-12.6 25.9-25 25.9-13.8 0-24.4-9.5-24.4-25.1 0-16 10.5-25.8 25.2-25.8zm-.3 9c-8.7 0-12.2 8.4-12.2 16.5 0 9.4 4.6 16.5 12.1 16.5 7 0 11.9-6.9 11.9-16.7 0-7.6-3.4-16.3-11.8-16.3zm56.7-9c14.5 0 24.2 10.2 24.2 25 0 17.9-12.6 25.9-25 25.9-13.8 0-24.4-9.5-24.4-25.1 0-16 10.5-25.8 25.2-25.8zm-.3 9c-8.7 0-12.2 8.4-12.2 16.5 0 9.4 4.6 16.5 12.1 16.5 7 0 11.9-6.9 11.9-16.7 0-7.6-3.4-16.3-11.8-16.3zM576.9 0h12.3v57.3c0 5 .2 10.4.4 13.7h-11l-.5-7.7h-.2c-2.9 5.4-8.8 8.8-15.9 8.8-11.6 0-20.8-9.9-20.8-24.9-.1-16.3 10.1-26 21.8-26 6.7 0 11.5 2.8 13.7 6.4h.2V0zm0 49.9v-7.3c0-1-.1-2.2-.3-3.2-1.1-4.8-5-8.7-10.6-8.7-7.9 0-12.3 7-12.3 16.1 0 8.9 4.4 15.4 12.2 15.4 5 0 9.4-3.4 10.6-8.7.3-1.1.4-2.3.4-3.6z" fill="#FFF"/><path d="M661.3 71L660 43.5c-.4-8.7-.9-19.2-.8-28.3h-.3c-2.2 8.2-5 17.3-8 25.8l-9.8 29.2h-9.5l-9-28.8c-2.6-8.6-5-17.8-6.8-26.2h-.2c-.3 8.8-.7 19.5-1.2 28.7L612.9 71h-11.5l4.5-67.4h16.2l8.8 27.1c2.4 7.9 4.5 15.9 6.2 23.4h.3c1.8-7.3 4.1-15.6 6.7-23.5l9.3-27h16l3.9 67.4h-12zm67.6-48.7v34.1c0 5.8.2 10.6.4 14.6h-10.8l-.6-7.4h-.2c-2.1 3.5-6.9 8.5-15.6 8.5-8.9 0-17-5.3-17-21.2V22.3h12.3v26.5c0 8.1 2.6 13.3 9.1 13.3 4.9 0 8.1-3.5 9.4-6.6.4-1.1.7-2.4.7-3.8V22.3h12.3zm10.3 46.3l2.4-8.9c2.8 1.7 8.1 3.5 12.5 3.5 5.4 0 7.8-2.2 7.8-5.4 0-3.3-2-5-8-7.1-9.5-3.3-13.5-8.5-13.4-14.2 0-8.6 7.1-15.3 18.4-15.3 5.4 0 10.1 1.4 12.9 2.9l-2.4 8.7c-2.1-1.2-6-2.8-10.3-2.8-4.4 0-6.8 2.1-6.8 5.1 0 3.1 2.3 4.6 8.5 6.8 8.8 3.2 12.9 7.7 13 14.9 0 8.8-6.9 15.2-19.8 15.2-5.9 0-11.2-1.4-14.8-3.4zm57.1 2.4h-12.4V22.3h12.4V71zm-6.2-69c4.2 0 6.8 2.9 6.9 6.7 0 3.7-2.7 6.6-7 6.6-4.1 0-6.8-2.9-6.8-6.6 0-3.8 2.8-6.7 6.9-6.7zm53.5 58.4l1.7 9.1c-2.6 1.2-7.7 2.5-13.8 2.5-15.2 0-25.1-9.7-25.1-24.8 0-14.6 10-26 27.1-26 4.5 0 9.1 1 11.9 2.3l-2.2 9.2c-2-.9-4.9-1.9-9.3-1.9-9.4 0-15 6.9-14.9 15.8 0 10 6.5 15.7 14.9 15.7 4.3 0 7.3-.9 9.7-1.9z" fill="#62B1DE"/></g></svg></a><div class="mini-icons"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic"><svg aria-label="Instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Instagram</desc><path fill="#e95950" d="M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.7 4.92 4.92.06 1.27.07 1.65.07 4.85 0 3.2-.01 3.58-.07 4.85-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07a83 83 0 0 1-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92A82.98 82.98 0 0 1 2.16 12a84 84 0 0 1 .07-4.85c.15-3.23 1.67-4.77 4.92-4.92A84.4 84.4 0 0 1 12 2.16zM12 0C8.74 0 8.33.01 7.05.07 2.7.27.27 2.7.07 7.05A84.29 84.29 0 0 0 0 12c0 3.26.01 3.67.07 4.95.2 4.36 2.62 6.78 6.98 6.98 1.28.06 1.7.07 4.95.07 3.26 0 3.67-.01 4.95-.07 4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.7.07-4.95 0-3.26-.01-3.67-.07-4.95C23.73 2.7 21.3.27 16.95.07A84.33 84.33 0 0 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.85a1.44 1.44 0 1 0 0 2.89 1.44 1.44 0 0 0 0-2.89z"/></svg></a><a data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic"><svg aria-label="Facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Facebook</desc><path fill="#3b5998" d="M22.68 0H1.32C.6 0 0 .6 0 1.32v21.36C0 23.4.6 24 1.32 24h11.5v-9.3H9.69v-3.62h3.13V8.41c0-3.1 1.9-4.79 4.66-4.79 1.32 0 2.46.1 2.8.15V7h-1.92c-1.5 0-1.8.71-1.8 1.76v2.32h3.59l-.47 3.62h-3.12V24h6.12c.73 0 1.32-.6 1.32-1.32V1.32C24 .6 23.4 0 22.68 0z"/></svg></a><a data-title="Twitter" href="https://twitter.com/lorenzowmusic"><svg aria-label="Twitter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Twitter</desc><path fill="#55acee" d="M24 4.56c-.88.39-1.83.65-2.83.77a4.93 4.93 0 0 0 2.17-2.72c-.95.56-2 .97-3.13 1.2a4.92 4.92 0 0 0-8.4 4.48A13.9 13.9 0 0 1 1.68 3.15 4.93 4.93 0 0 0 3.2 9.72a4.9 4.9 0 0 1-2.23-.61A4.93 4.93 0 0 0 4.91 14a5 5 0 0 1-2.22.08 4.93 4.93 0 0 0 4.6 3.42A9.9 9.9 0 0 1 0 19.54a13.94 13.94 0 0 0 7.55 2.21c9.14 0 14.3-7.72 14-14.64.95-.7 1.79-1.57 2.45-2.55z"/></svg></a></div><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">Home</a></li><li><a href="/photos/">Photos</a></li><li><a href="/videos/">Videos</a></li><li><a href="/booking/">Booking</a></li></ul></nav></div></header><main><div class="background-blur"><img src="../album_art_640/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>"></div><div class="center-column"><?php if ($album['additional_info']) { ?>
<div class="centered additional"><a href="<?php echo htmlentities($album['additional_info_url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($album['additional_info']); ?></a></div>
<?php } ?><div class="imagecontainer"><img src="../album_art_640/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>">
<?php if ($album['youtube_video_id']) { ?>
<div class="youtube-button"><a href="https://www.youtube.com/watch?v=<?php echo htmlentities($album['youtube_video_id'], ENT_QUOTES); ?>"><img src="../svg/youtube-play.svg" alt="Youtube"></div>
<?php } ?></div><div class="title-container"><h1><?php echo htmlspecialchars($album['artist']); ?> <br> <?php echo htmlspecialchars($album['title']); ?><?php $featuring = $album['featuring']; if (!empty($featuring)) { echo ' (Featuring ' . htmlspecialchars($featuring) . ')'; } ?></h1><p><?php if ($releaseDateString) {	echo 'Releasing ' . htmlspecialchars($releaseDateString);
} else {
	echo 'Download and stream now';
}?></p></div><div class="service-container"><?php if ($album['itunes_id']) { ?>
<div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>?app=itunes&amp;at=1000lKSp"><img src="../svg/iTunes_Store_Buy_Lockup_RGB_blk.svg" alt="iTunes"><span class="play"><?php echo $releaseDateString ? 'Pre-order' : 'Download'; ?></span></a></div>
<?php } if ($album['itunes_id'] && empty($releaseDateString)) { ?>
<div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>?mt=1&app=music&amp;at=1000lKSp"><img src="../svg/Apple_Music_lockup_RGB_blk.svg" alt="Apple Music"><span class="play">Play</span></a></div>
<?php } if ($album['spotify_id']) { ?>
<div class="service"><a href="https://play.spotify.com/album/<?php echo htmlentities($album['spotify_id'], ENT_QUOTES); ?>"><img src="../svg/spotify-text.svg" alt="Spotify"><span class="play">Play</span></a></div>
<?php } if ($album['amazon_music_id']) { ?>
<div class="service"><a href="https://www.amazon.com/dp/<?php echo htmlentities($album['amazon_music_id'], ENT_QUOTES); ?>"><img src="../svg/amazon-music.svg" alt="Amazon Music"><span class="play">Play</span></a></div>
<?php } if ($album['google_play_id']) { ?>
<div class="service"><a href="https://play.google.com/store/music/album/<?php echo htmlentities($album['google_play_id'], ENT_QUOTES); ?>"><img src="../svg/google-play.svg" alt="Google Play"><span class="play">Download</span></a></div>
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
<?php } ?></div></div></main><footer><p><b>Copyright © 2017-2019 Lorenzo Wood</b></p><p class="js-warning">JavaScript is disabled in your browser; please enable it to see missing content.
</p></footer><?php
$db->close();
?></body></html>