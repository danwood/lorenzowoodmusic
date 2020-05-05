<?php

require_once('../classes/downcode.php');
$db = new DowncodeDB();
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
  header('HTTP/1.0 404 Not Found');
  readfile('../404.html');
  exit();
}

$now = new DateTime();
$releaseDate = $now;   // default to now, so it should show up as released
$releases = $db->releasesExtendedForSlug($slug);
if (!$releases) {
  header('HTTP/1.0 404 Not Found');
  readfile('../404.html');
  exit();
}
$release = $releases[0];

$has_radio_edit = false;
$has_explicit = false;
foreach($releases as $release) {
	if ($release['variation_id'] == 2) { $has_radio_edit = true; }
	if ($release['variation_id'] == 1) { $has_explicit = true; }
}
$is_explicit = $release['variation_id'] == 1;	// is *this* page marked explicit?

$longTitle = $release['title'];

if (!empty($release['featuring'])) { $longTitle .= ' [feat. ' . $release['featuring'] . ']'; }
$longTitle .= ' - by ' . $release['artist_name'];
$releaseDateString = NULL;
if (!empty($release['release_date'])) {
   $releaseDate = new DateTime($release['release_date'], new DateTimeZone('America/New_York'));
   $now = new DateTime();
   if ($now < $releaseDate) $releaseDateString = $releaseDate->format('l, F jS');
}
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><title><?php echo htmlentities($longTitle); ?></title><meta name='description' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"><link rel="stylesheet" href="/css/main.050120.css"><link rel="prefetch" href="//img.youtube.com"><meta property='og:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:url' content='<?php echo htmlentities(curPageURL()); ?>'>
<meta property='og:type' content='article'>
<meta property='og:image' content='<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($release['imageName'], ENT_QUOTES); ?>'> 
<meta name='twitter:url' value='<?php echo htmlentities(curPageURL()); ?>'>
<meta name='twitter:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:image' content='<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($release['imageName'], ENT_QUOTES); ?>'><link rel="stylesheet" href="/css/linkstyles.042223.css"></head><body><!--[if lt IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><div class="mini-icons"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic" style="fill:#e95950"><svg aria-label="Instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Instagram</desc><!-- #e95950 --><path d="M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.7 4.92 4.92.06 1.27.07 1.65.07 4.85 0 3.2-.01 3.58-.07 4.85-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07a83 83 0 0 1-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92A82.98 82.98 0 0 1 2.16 12a84 84 0 0 1 .07-4.85c.15-3.23 1.67-4.77 4.92-4.92A84.4 84.4 0 0 1 12 2.16zM12 0C8.74 0 8.33.01 7.05.07 2.7.27.27 2.7.07 7.05A84.29 84.29 0 0 0 0 12c0 3.26.01 3.67.07 4.95.2 4.36 2.62 6.78 6.98 6.98 1.28.06 1.7.07 4.95.07 3.26 0 3.67-.01 4.95-.07 4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.7.07-4.95 0-3.26-.01-3.67-.07-4.95C23.73 2.7 21.3.27 16.95.07A84.33 84.33 0 0 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.85a1.44 1.44 0 1 0 0 2.89 1.44 1.44 0 0 0 0-2.89z"/></svg></a><a data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic" style="fill:#3b5998"><svg aria-label="Facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Facebook</desc><!-- #3b5998 --><path d="M22.68 0H1.32C.6 0 0 .6 0 1.32v21.36C0 23.4.6 24 1.32 24h11.5v-9.3H9.69v-3.62h3.13V8.41c0-3.1 1.9-4.79 4.66-4.79 1.32 0 2.46.1 2.8.15V7h-1.92c-1.5 0-1.8.71-1.8 1.76v2.32h3.59l-.47 3.62h-3.12V24h6.12c.73 0 1.32-.6 1.32-1.32V1.32C24 .6 23.4 0 22.68 0z"/></svg></a></div><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div></header><main><div class="background-blur"><img src="<?php $blur = $release['image_blurred'] ? '../blurred_100/' . $release['image_blurred'] : '../album_art_640/' . htmlentities($release['image']); echo htmlentities($blur, ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"></div><div class="center-column"><?php if ($release['blurb']) { ?>
<div class="centered additional"><a href="<?php echo htmlentities($release['blurb_url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($release['blurb']); ?></a></div>
<?php } ?><div class="imagecontainer"><img src="../album_art_640/<?php echo htmlentities($release['image'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"></div><div class="title-container"><?php if ($release['youtube_video_v']) { ?>
<div class="youtube-border"><div class="youtube" data-linking="yep" data-code='<?php echo htmlentities($release['youtube_video_v'], ENT_QUOTES); ?>' data-title=''></div></div>
<?php } ?><h1><?php echo htmlspecialchars($release['artist_name']); ?> <br> <?php echo htmlspecialchars($release['title']); ?></h1><?php $featuring = $release['featuring']; if (!empty($featuring)) { echo ' (Featuring ' . htmlspecialchars($featuring) . ')'; } ?></div><div class="title-container"><p><?php
if ($now < $releaseDate) {
	echo 'Releasing ' . htmlspecialchars($releaseDateString);
} else {
	echo 'Download and stream now';
} ?></p><div class="requires-js"><?php
if ($has_radio_edit && $has_explicit) { ?>
<div class="switch">
	<input type="radio" class="switch-input" name="view2" value="dirty" id="dirty" <?php if ($is_explicit) { echo 'checked'; } ?>>
	<label for="dirty" class="switch-label switch-label-off"
	<?php
	if (!$is_explicit) {
		echo 'onclick="window.location=\'' . baseURL() . '/link/' 
			. htmlentities($release['slug'], ENT_QUOTES) 
			. '\'"'; 
	} ?>
	>Explicit</label>
	<input type="radio" class="switch-input" name="view2" value="clean" id="clean"  <?php if (!$is_explicit) { echo 'checked'; } ?>>
	<label for="clean" class="switch-label switch-label-on"
	<?php
	if ($is_explicit) {
		echo 'onclick="window.location=\'' . baseURL() . '/link/' 
			. htmlentities($release['slug'] . '-radio-edit', ENT_QUOTES) 
			. '\'"'; 
	} ?>
	>Radio Edit</label>
	<span class="switch-selection"></span>
</div>
<?php } ?>
</div><div class="js-hidden"><?php
if ($has_radio_edit && $has_explicit) { ?>
	<?php
	if (!$is_explicit) {
		echo "<a href='" . baseURL() . "/link/"
			. htmlentities($release['slug'], ENT_QUOTES) 
			. "'>"; 
	}
	else {
		echo '<b>';
	}
	echo 'Explicit';
	if (!$is_explicit) {
		echo "</a>";
	}
	else {
		echo '</b>';
	}


	echo ' &middot; ';

	if ($is_explicit) {
		echo "<a href='" . baseURL() . "/link/"
			. htmlentities($release['slug'] . '-radio-edit', ENT_QUOTES) 
			. "'>"; 
	}
	else {
		echo '<b>';
	}
	echo 'Radio Edit';
	if ($is_explicit) {
		echo "</a>";
	}
	else {
		echo '</b>';
	}
} ?>


	</div></div><div class="service-container"><?php if ($release['apple_music_album']) { ?>
<div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($release['apple_music_album'], ENT_QUOTES); ?>?app=itunes&amp;at=1000lKSp"><img src="../svg/iTunes_Store_Buy_Lockup_RGB_blk.svg" alt="iTunes"><span class="play"><?php echo ($now < $releaseDate) ? 'Pre-order' : 'Download'; ?></span></a></div>
<?php } if ($release['apple_music_album'] && ($now >= $releaseDate)) { ?>
<div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($release['apple_music_album'], ENT_QUOTES); ?>?mt=1&app=music&amp;at=1000lKSp"><img src="../svg/Apple_Music_lockup_RGB_blk.svg" alt="Apple Music"><span class="play">Play</span></a></div>
<?php } if ($release['spotify_track']) { ?>
<div class="service"><a href="https://play.spotify.com/track/<?php echo htmlentities($release['spotify_track'], ENT_QUOTES); ?>"><img src="../svg/spotify-text.svg" alt="Spotify"><span class="play">Play</span></a></div>
<?php } if ($release['spotify_album'] && !$release['spotify_track']) { ?>
<div class="service"><a href="https://play.spotify.com/album/<?php echo htmlentities($release['spotify_album'], ENT_QUOTES); ?>"><img src="../svg/spotify-text.svg" alt="Spotify"><span class="play">Play</span></a></div>
<?php } if ( (!$release['spotify_album']) && (!$release['spotify_track']) &&$release['spotify_presave_url']) { ?>
<div class="service"><a rel="nofollow" href="<?php echo htmlentities($release['spotify_presave_url'], ENT_QUOTES); ?>"><img src="../svg/spotify-text.svg" alt="Presave on Spotify"><span class="play">Pre-save</span></a>
<div style="padding-left:5em; font-size:80%; color:gray"><?php if ($now >= $releaseDate) { ?>
<div><b>Direct spotify link coming soon!</b></div>
<?php } ?>
This step takes you to our DistroKid.com page to continue. You will be asked to log into your Spotify account.</div><?php } if ($release['google_play_album']) { ?>
<div class="service"><a href="https://play.google.com/store/music/album/<?php echo htmlentities($release['google_play_album'], ENT_QUOTES); ?>"><img src="../svg/google-play.svg" alt="Google Play"><span class="play"><?php echo ($now < $releaseDate) ? 'Pre-order' : 'Download'; ?></span></a></div>
<?php } if ($now >= $releaseDate) { ?>
<?php      if ($release['amazon_dp']) { ?>
<div class="service"><a href="https://www.amazon.com/dp/<?php echo htmlentities($release['amazon_dp'], ENT_QUOTES); ?>"><img src="../svg/amazon-music.svg" alt="Amazon Music"><span class="play">Play</span></a></div>
<?php } if ($release['youtube_music_v']) { ?>
<div class="service"><a href="https://music.youtube.com/watch?v=<?php echo htmlentities($release['youtube_music_v'], ENT_QUOTES); ?>"><img src="../svg/youtube-music.svg" alt="Youtube Music"><span class="play">Play</span></a></div>
<?php } if ($release['youtube_music_MPRE'] && !$release['youtube_music_v']) { ?>
<div class="service"><a href="https://music.youtube.com/browse/<?php echo htmlentities($release['youtube_music_MPRE'], ENT_QUOTES); ?>"><img src="../svg/youtube-music.svg" alt="Youtube Music"><span class="play">Play</span></a></div>
<?php } if ($release['bandcamp_path']) { ?>
<div class="service"><a href="https://lorenzowoodmusic.bandcamp.com/<?php echo htmlentities($release['bandcamp_path'], ENT_QUOTES); ?>"><img src="../svg/bandcamp.svg" alt="Bandcamp"><span class="play">Download</span></a>
<?php if ($release['bandcamp_blurb_url']) { ?>
<div style="padding-left:5em; margin-top:-20px; font-size:80%;"><a style="text-decoration:underline !important" href="<?php echo htmlentities($release['bandcamp_blurb_url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($release['bandcamp_blurb']); ?></a></div>
<?php } ?>
</div>
<?php } if ($release['soundcloud_path']) { ?>
<div class="service"><a href="https://soundcloud.com/<?php echo htmlentities($release['soundcloud_path'], ENT_QUOTES); ?>"><img src="../svg/soundcloud.svg" alt="Soundcloud"><span class="play">Play</span></a></div>
<?php } if ($release['deezer_track']) { ?>
<div class="service"><a href="https://www.deezer.com/us/track/<?php echo htmlentities($release['deezer_track'], ENT_QUOTES); ?>"><img src="../svg/deezer.svg" alt="Deezer"><span class="play">Play</span></a></div>
<?php } if ($release['deezer_album'] && !$release['deezer_track']) { ?>
<div class="service"><a href="https://www.deezer.com/us/album/<?php echo htmlentities($release['deezer_album'], ENT_QUOTES); ?>"><img src="../svg/deezer.svg" alt="Deezer"><span class="play">Play</span></a></div>
<?php } if ($release['iheartradio_songs']) { ?>
<div class="service"><a href="https://www.iheart.com/artist/lorenzo-wood-32159981/songs/<?php echo htmlentities($release['iheartradio_songs'], ENT_QUOTES); ?>"><img src="../svg/iheartradio-logo.svg" alt="IHeartRadio"><span class="play">Play</span></a></div>
<?php } if ($release['tidal_track']) { ?>
<div class="service"><a href="https://listen.tidal.com/track/<?php echo htmlentities($release['tidal_track'], ENT_QUOTES); ?>"><img src="../svg/tidal.svg" alt="Tidal"><span class="play">Play</span></a></div>
<?php } if ($release['tidal_album'] && !$release['tidal_track']) { ?>
<div class="service"><a href="https://listen.tidal.com/album/<?php echo htmlentities($release['tidal_album'], ENT_QUOTES); ?>"><img src="../svg/tidal.svg" alt="Tidal"><span class="play">Play</span></a></div>
<?php } if ($release['cd_url']) { ?>
<div class="service"><a href="<?php echo htmlentities($release['cd_url'], ENT_QUOTES); ?>"><img src="/img/cd100.png" alt="Buy CD"><span class="play">Buy</span></a></div>
<?php } ?>
<?php } ?></div></div></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span><a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span><a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning">JavaScript is disabled in your browser; please enable it to see missing content.
</p></footer><script>for(var iOS=/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream,youtube=document.querySelectorAll(".youtube"),i=0;i<youtube.length;i++){var code=youtube[i].dataset.code,title=youtube[i].dataset.title,caption=youtube[i].dataset.caption,linking=youtube[i].dataset.linking;if(iOS&&(linking=!0),0){var iframe=document.createElement("iframe");iframe.setAttribute("allowfullscreen",""),iframe.setAttribute("src","https://www.youtube.com/embed/"+code),youtube[i].appendChild(iframe)}else{var source="https://img.youtube.com/vi/"+code+"/sddefault.jpg",image=new Image;image.src=source,image.id="video-"+code,image.alt="YouTube thumbnail",image.addEventListener("load",void youtube[i].appendChild(image)),youtube[i].addEventListener("click",function(){var e=this.dataset.code;if(linking)window.location.href="https://www.youtube.com/watch?v="+e;else{var t=document.createElement("iframe");t.setAttribute("frameborder","0"),t.setAttribute("allowfullscreen",""),t.setAttribute("src","https://www.youtube.com/embed/"+e+"?rel=0&showinfo=0&autoplay=1"),this.innerHTML="",this.appendChild(t)}});var play=document.createElement("div");if(play.setAttribute("class","play-button"),youtube[i].appendChild(play),void 0!==title){var t=document.createElement("div");t.setAttribute("class","title"),t.innerText=title,youtube[i].appendChild(t)}}if(caption){var captionDiv=document.createElement("p");captionDiv.innerText=caption,youtube[i].insertAdjacentElement("afterend",captionDiv)}}</script><?php
$db->close();
?><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script></body></html>