<?php

require_once('../classes.php');
$db = new DowncodeDB();
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
// Figure out something clever to display if no album specified; show all. maybe in columns?
$album = $db->albumForSlug($slug);
if ($album) {
	$longTitle = $album['title'];
	if (!empty($album['featuring'])) { $longTitle .= ' [feat. ' . $album['featuring'] . ']'; }
	$longTitle .= ' - by ' . $album['artist'];
}
else {
	header('HTTP/1.0 404 Not Found');
	readfile('../404.html');
	exit();
}
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><title><?php echo htmlentities($longTitle); ?></title><meta name='description' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"><link rel="apple-touch-icon" href="icon.png"><link rel="stylesheet" href="/css/main.04132019.css"><!-- FB OG tags--><meta property='og:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:url' content='<?php echo htmlentities(curPageURL()); ?>'>
<meta property='og:type' content='article'>
<meta property='og:image' content='<?php echo baseURL() . '/album_art/' . htmlentities($album['imageName'], ENT_QUOTES); ?>'> <!-- 600 x 315 ideally 1200x630 --><!-- additional media--><!-- Twitter summary card meta tags--><meta name='twitter:url' value='<?php echo htmlentities(curPageURL()); ?>'>
<meta name='twitter:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:image' content='<?php echo baseURL() . '/album_art/' . htmlentities($album['imageName'], ENT_QUOTES); ?>'> <!-- square 144 up to 4000, 5 MB max --><link rel="stylesheet" href="link.css"></head><body><!--[if lt IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><h1 class="ir">Lorenzo Wood Music</h1><div class="logo"><div style="width:100%; height:4em; background-color:black"></div><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">Home</a></li><li><a href="/photos/">Photos</a></li><li><a href="/videos/">Videos</a></li><li><a href="/booking/">Booking</a></li></ul></nav></div></header><main><div><div id="prefpage"><div id="bg"><!-- Really we should have 640 square for good retina image.--><img src="../album_art/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>", alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>"></div><div class="imagecontainer" id="img" style="position:relative;"><img src="../album_art/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>", alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>"></div><div class="service-container sticky" id="header" style="z-index:9000; ;"><div class="header"><h1 class="artist"><?php echo htmlspecialchars($album['artist']); ?> <br> <?php echo htmlspecialchars($album['title']); ?><?php $featuring = $album['featuring']; if (!empty($featuring)) { echo ' (Featuring ' . htmlspecialchars($featuring) . ')'; } ?></h1><p class="where">Download and stream now</p></div><div class="arrow"></div></div><div class="service-container" id="service"><?php if ($album['itunes_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_itunes.svg" alt="itunes"></span><span class="play">Download</span></a></div>
<?php } if ($album['spotify_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['spotify_id'], ENT_QUOTES); ?>"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_spotify.svg" alt="spotify"></span><span class="play">Play</span></a></div>
<?php } if ($album['apple_music_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['apple_music_id'], ENT_QUOTES); ?>"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_applemusic.svg" alt="applemusic"></span><span class="play">Play</span></a></div>
<?php } if ($album['amazon_music_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['amazon_music_id'], ENT_QUOTES); ?>"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_amazonmp3.svg" alt="amazonmp3"></span><span class="play">Play</span></a></div>
<?php } if ($album['google_play_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['google_play_id'], ENT_QUOTES); ?>"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_google-play.svg" alt="google-play"></span><span class="play">Download</span></a></div>
<?php } if ($album['deezer_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['deezer_id'], ENT_QUOTES); ?>"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_deezer.svg" alt="deezer"></span><span class="play">Play</span></a></div>
<?php } ?></div></div></div></main><?php
$db->close();
?></body></html>