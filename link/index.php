
<?php

require_once('../classes.php');
$db = new DowncodeDB();
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
// Figure out something clever to display if no album specified; show all. maybe in columns?
$albums = Array();
$album = NULL;
if (empty($slug)) {
	$albums = $db->allAlbums();
} else {
	$album = $albums[] = $db->albumForSlug($slug);
}
if ($album) {
$longTitle = $album['title'];
if (!empty($album['featuring'])) { $longTitle .= '[feat. ' . $album[featuring] . ']';
$longTitle .= ' - by ' . $album['artist'];
}
?><!DOCTYPE html>
<html class="no-js" lang="en-us">
  <head>
    <meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]-->
    <title>&lt;?php echo htmlentities($album[&quot;title&quot;], ENT_QUOTES)); ?&gt; | Lorenzo Wood Music</title>
    <meta name="description" content="BLAH BLAH BLAH BLAH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="stylesheet" href="/css/main.04132019.css">
    <!-- FB OG tags--><meta property='og:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta property='og:url' content='<?php echo htmlentities(curPageURL()); ?>'>
<meta property='og:type' content='article'>
<meta property='og:image' content='http://cdnlinks.linkfire.com/facebook_5a4cf73c50a2f_Final-BMxCB-SingleArt_5a4cf73c77286.jpg'> <!-- 600 x 315 -->
<meta property='og:image' content='http://cdnlinks.linkfire.com/5a4cf73c50a2f_Final-BMxCB-SingleArt_5a4cf73c77286.jpg'> <!-- big square -->
    <!-- additional media-->
    <!-- Twitter summary card meta tags--><meta name='twitter:url' value='<?php echo htmlentities(curPageURL()); ?>'>
<meta name='twitter:title' content='<?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:description' content='Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>'>
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:image' content='http://cdnlinks.linkfire.com/twitter_5a4cf73c50a2f_Final-BMxCB-SingleArt_5a4cf73c77286.jpg'> <!-- 440 x 220 -->
<?php } ?>
    <link rel="stylesheet" href="link.css">
  </head>
  <body class="&lt;?php echo htmlentities($album[&quot;title&quot;], ENT_QUOTES)); ?&gt;"><!--[if lt IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
      <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p><![endif]-->
    <header id="main-header">
      <h1 class="ir">Lorenzo Wood Music</h1>
      <div class="logo">
        <div style="width:100%; height:4em; background-color:black"></div>
        <input id="navigation" type="checkbox">
        <label class="hamburger" for="navigation">
          <div class="spinner diagonal part-1"></div>
          <div class="spinner horizontal"></div>
          <div class="spinner diagonal part-2"></div>
        </label>
        <nav class="page-menu">
          <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/photos/">Photos</a></li>
                    <li><a href="/videos/">Videos</a></li>
                    <li><a href="/booking/">Booking</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <main>
      <div>
        <?php
        foreach ($albums as $album) {
        ?>
        <div id="prefpage">
          <div id="bg">
            <!-- Really we should have 640 square for good retina image.--><img src="../album_art/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>", alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>">
          </div>
          <div class="imagecontainer" id="img" style="position:relative;"><img src="../album_art/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>", alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>"></div>
          <div class="service-container sticky" id="header" style="z-index:9000; ;">
            <div class="header">
              <h1 class="artist"><?php echo htmlspecialchars($album['artist']); ?> <br> <?php echo htmlspecialchars($album['title']); ?><?php $featuring = $album['featuring']; if (!empty($featuring)) { echo '(Featuring ' . htmlspecialchars($featuring) . ')'; } ?></h1>
              <p class="where">Download and stream now</p>
            </div>
            <div class="arrow"></div>
          </div>
          <div class="service-container" id="service">
            <!-- Artist information-->
            <!-- End of artist information-->
            <div class="service"><a class="img-btn redirect" href="http://smarturl.it/Finesse12Inch" data-player="brunomars" data-servicetype="goto" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_brunomars.svg" alt="brunomars"></span><span class="play">Limited 12” Vinyl</span></a></div>
            <div class="service"><a class="img-btn redirect" href="https://itunes.apple.com/us/album/finesse-remix-feat-cardi-b-single/1328526390?uo=4&amp;&amp;app=itunes&amp;at=1010lKkX&amp;ct=LFV_e00e0cfbd461e64db33ee18b3d048681" data-player="itunes" data-servicetype="download" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_itunes.svg" alt="itunes"></span><span class="play">Download</span></a></div>
            <div class="service"><a class="img-btn redirect" href="https://open.spotify.com/user/brunomars/playlist/1B9BPUMWDtl4ASyG4f693s" data-uri="spotify:user:brunomars:playlist:1B9BPUMWDtl4ASyG4f693s" data-player="spotify" data-servicetype="play" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_spotify.svg" alt="spotify"></span><span class="play">Play</span></a></div>
            <div class="service"><a class="img-btn redirect" href="https://itunes.apple.com/us/album/finesse-remix-feat-cardi-b-single/1328526390?uo=4&amp;&amp;app=music&amp;at=1010lKkX&amp;ct=LFV_e00e0cfbd461e64db33ee18b3d048681" data-player="applemusic" data-servicetype="play" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_applemusic.svg" alt="applemusic"></span><span class="play">Play</span></a></div>
            <div class="service"><a class="img-btn redirect" href="http://amazon.com/Finesse-Remix-feat-Cardi-B/dp/B078KPMXXP?tag=warnermusicuk-21&amp;ie=UTF8&amp;linkCode=as2&amp;ascsubtag=e00e0cfbd461e64db33ee18b3d048681" data-player="amazonmp3" data-servicetype="download" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_amazonmp3.svg" alt="amazonmp3"></span><span class="play">Play</span></a></div>
            <div class="service"><a class="img-btn redirect" href="https://youtu.be/LsoLEjrDogU" data-player="youtube" data-servicetype="play" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_youtube.svg" alt="youtube"></span><span class="play">Play</span></a></div>
            <div class="service"><a class="img-btn redirect" href="https://play.google.com/store/music/album?id=Bee43mdsj4g2kwvoakhwe2bmgfq&amp;tid=song-Tdqdsrwdmzgpo3azztlj3comnle&amp;PAffiliateID=10lHrU&amp;PCamRefID=LFV_e00e0cfbd461e64db33ee18b3d048681" data-player="google-play" data-servicetype="download" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_google-play.svg" alt="google-play"></span><span class="play">Download</span></a></div>
            <div class="service"><a class="img-btn redirect" href="http://www.deezer.com/album/53983322?app_id=140685" data-player="deezer" data-servicetype="play" data-apptype="manual"><span><img width="125px" height="40px" style="display:inline-block;" src="music-service_deezer.svg" alt="deezer"></span><span class="play">Play</span></a></div>
            <!-- Last option should be 'i dont know'-->
          </div>
        </div><?php
        }
        ?>
      </div>
    </main>
    <?php
    $db->close();
    ?>
  </body>
</html>