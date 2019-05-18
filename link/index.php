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
<div class="service"><a class="img-btn redirect" href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>?app=itunes&amp;at=1000lKSp"><img class="service" src="../svg/iTunes_Store_Buy_Lockup_RGB_blk.svg" alt="iTunes"><span class="play">Download</span></a></div>
<div class="service"><a class="img-btn redirect" href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($album['itunes_id'], ENT_QUOTES); ?>?mt=1&app=music&amp;at=1000lKSp"><img class="service" src="../svg/Apple_Music_lockup_RGB_blk.svg" alt="Apple Music"><span class="play">Play</span></a></div>
<?php } if ($album['spotify_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://play.spotify.com/album/<?php echo htmlentities($album['spotify_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/spotify-text.svg" alt="Spotify"><span class="play">Play</span></a></div>
<?php } if ($album['amazon_music_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://www.amazon.com/dp/<?php echo htmlentities($album['amazon_music_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/amazon-music.svg" alt="Amazon Music"><span class="play">Play</span></a></div>
<?php } if ($album['google_play_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://play.google.com/store/music/album/<?php echo htmlentities($album['google_play_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/google-play.svg" alt="Google Play"><span class="play">Download</span></a></div>
<?php } if ($album['youtube_music_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://music.youtube.com/browse/<?php echo htmlentities($album['youtube_music_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/youtube-icon.svg" alt="Youtube Music"><span class="play">Play</span></a></div><!-- can also watch at https://music.youtube.com/watch?v= + youtube_video_id -->
<?php } if ($album['youtube_video_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://www.youtube.com/watch?v=<?php echo htmlentities($album['youtube_video_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/youtube-icon.svg" alt="Youtube Music"><span class="play">Play</span></a></div>
<?php } if ($album['soundcloud_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://soundcloud.com/<?php echo htmlentities($album['soundcloud_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/soundcloud-icon.svg" alt="Soundcloud"><span class="play">Play</span></a></div>
<?php } if ($album['deezer_id']) { ?>
<div class="service"><a class="img-btn redirect" href="https://www.deezer.com/us/album/<?php echo htmlentities($album['deezer_id'], ENT_QUOTES); ?>"><img class="service" src="../svg/deezer.svg" alt="Deezer"><span class="play">Play</span></a></div>
<?php } if ($album['cd_id']) { ?>
<div class="service"><a class="img-btn redirect" href="<?php echo htmlentities($album['deezer_id'], ENT_QUOTES); ?>"><img class="service" src="data:image/png;base64,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" alt="Buy CD"><span class="play">Buy</span></a></div>
<?php } ?></div></div></div></main><?php
$db->close();
?></body></html>