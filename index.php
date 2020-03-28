
<?php
$code = isset($_GET['code']) ? htmlspecialchars($_GET['code']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

require_once('classes/downcode.php');
$db = new DowncodeDB();
$now = new DateTime();
$release = $now;	// default to now, so it should show up as released
$album = $db->featuredAlbum();
if ($album) {
	$releaseDateString = NULL;
	if (!empty($album['release_date'])) {
		$release = new DateTime($album['release_date'], new DateTimeZone('America/New_York'));
		$now = new DateTime();
		if ($now < $release) $releaseDateString = $release->format('l, F jS');
	}
}
?><!DOCTYPE html>
<html class="no-js" lang="en-us">
  <head>
    <meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]-->
    <title>Lorenzo Wood Music — Official Site</title>
    <meta name="description" content="Lorenzo Wood is a musician, singer-songwriter, and producer from Alameda, California USA. He sings and plays guitar, keys, drums, bass, and has fun on mandolin and banjo.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="supported-color-schemes" content="light dark">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="stylesheet" href="/css/main.032820.css">
    <link rel="prefetch" href="//code.jquery.com">
    <link rel="prefetch" href="//img.youtube.com">
  </head>
  <body class="home"><!--[if lt IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
      <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p><![endif]-->
    <header class="covering" id="main-header">
      <div class="logo"><a class="active" href="/">
          <h1>Lorenzo Wood</h1></a>
        <input id="navigation" type="checkbox">
        <label class="hamburger" for="navigation">
          <div class="spinner diagonal part-1"></div>
          <div class="spinner horizontal"></div>
          <div class="spinner diagonal part-2"></div>
        </label>
        <nav class="page-menu">
          <ul>
                    <li><a class="active" href="/">home</a></li>
                    <li><a href="/photos/">photos</a></li>
                    <li><a href="/videos/">videos</a></li>
                    <li><a href="/booking/">booking</a></li>
                    <li><a href="/2am-in-the-basement.html">2am</a></li>
          </ul>
        </nav>
      </div>
      <div class="hero"><?php if ($album) { ?>
        <div class="action-banner clearfix safe-area-only">
          <p><a target="_blank" href="/link/<?php echo htmlentities($album['slug'], ENT_QUOTES); ?>">
<img style="display:inline-block; width:32px; height:auto; padding:0;" src="album_art_64/<?php echo htmlentities($album['imageName'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($album['title'], ENT_QUOTES); ?>, cover image" />
</a><span>
              New <?php echo htmlspecialchars($album['album_ep_single'] . ' “' . $album['title'] . '”'); ?> —&nbsp;</span><b><a style="text-decoration:underline" href="/link/<?php echo htmlentities($album['slug'], ENT_QUOTES); ?>"><?php echo ($now < $release) ? 'Pre-Save or Pre-Order Now!' : 'Download or stream now!'; ?></a></b>
          </p>
        </div><?php } ?>
        <picture>
          <source class="swapping-image" srcset="img/banner1_giant.jpg 2560w, img/banner1_big.jpg 1920w, img/banner1_medium.jpg 960w, img/banner1_small.jpg 640w"><img class="hero-image covering swapping-image" src="img/banner1_medium.jpg" loading="eager" alt="Lorenzo Wood">
        </picture>
      </div>
      <div class="icons icons-header absolute icons-5 safe-area-only"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic"><svg aria-label="Instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Instagram</desc><!-- #e95950 --><path d="M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.7 4.92 4.92.06 1.27.07 1.65.07 4.85 0 3.2-.01 3.58-.07 4.85-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07a83 83 0 0 1-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92A82.98 82.98 0 0 1 2.16 12a84 84 0 0 1 .07-4.85c.15-3.23 1.67-4.77 4.92-4.92A84.4 84.4 0 0 1 12 2.16zM12 0C8.74 0 8.33.01 7.05.07 2.7.27.27 2.7.07 7.05A84.29 84.29 0 0 0 0 12c0 3.26.01 3.67.07 4.95.2 4.36 2.62 6.78 6.98 6.98 1.28.06 1.7.07 4.95.07 3.26 0 3.67-.01 4.95-.07 4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.7.07-4.95 0-3.26-.01-3.67-.07-4.95C23.73 2.7 21.3.27 16.95.07A84.33 84.33 0 0 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.85a1.44 1.44 0 1 0 0 2.89 1.44 1.44 0 0 0 0-2.89z"/></svg></a><a class="smaller" data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic"><svg aria-label="Facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Facebook</desc><!-- #3b5998 --><path d="M22.68 0H1.32C.6 0 0 .6 0 1.32v21.36C0 23.4.6 24 1.32 24h11.5v-9.3H9.69v-3.62h3.13V8.41c0-3.1 1.9-4.79 4.66-4.79 1.32 0 2.46.1 2.8.15V7h-1.92c-1.5 0-1.8.71-1.8 1.76v2.32h3.59l-.47 3.62h-3.12V24h6.12c.73 0 1.32-.6 1.32-1.32V1.32C24 .6 23.4 0 22.68 0z"/></svg></a><a data-title="YouTube" href="https://www.youtube.com/lorenzowoodmusic"><svg aria-label="YouTube" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on YouTube</desc><!-- #b00 --><path d="M4.65 0H6.1l.99 3.7L8 0h1.45L7.79 5.5v3.76H6.35V5.51L4.65 0zm6.6 2.37c-1.12 0-1.86.74-1.86 1.84v3.35c0 1.2.62 1.83 1.86 1.83 1.02 0 1.82-.69 1.82-1.83V4.2c0-1.07-.8-1.84-1.82-1.84zm.53 5.13c0 .37-.2.65-.53.65-.36 0-.56-.3-.56-.65V4.32c0-.37.17-.65.53-.65.39 0 .56.27.56.65V7.5zm4.73-5.07v5.19c-.16.19-.5.5-.75.5-.27 0-.34-.18-.34-.45V2.43h-1.27v5.71c0 .68.2 1.22.89 1.22.38 0 .92-.2 1.47-.85v.75h1.27V2.43H16.5zm2.2 13.86c-.45 0-.54.31-.54.76v.66h1.07v-.66c0-.44-.1-.76-.53-.76zm-4.7.04a.93.93 0 0 0-.25.2v4.05c.1.1.19.18.28.23.2.1.49.1.62-.07.07-.09.1-.24.1-.45v-3.36a.82.82 0 0 0-.12-.5c-.15-.19-.42-.2-.63-.1zm4.82-5.2a183 183 0 0 0-13.66 0c-2.82.2-3.15 1.9-3.17 6.37.02 4.47.35 6.17 3.17 6.37a183 183 0 0 0 13.66 0c2.82-.2 3.15-1.9 3.17-6.37-.02-4.47-.35-6.17-3.17-6.37zM6.51 21.82H5.15v-7.54H3.74V13h4.18v1.28H6.5v7.54zm4.84 0h-1.2v-.72c-.23.27-.46.47-.7.6-.65.38-1.55.37-1.55-.95v-5.44h1.21v5c0 .25.06.43.32.43.24 0 .57-.3.71-.49v-4.94h1.21v6.5zm4.66-1.35c0 .8-.3 1.43-1.1 1.43-.45 0-.82-.16-1.15-.58v.5h-1.22V13h1.22v2.84c.27-.33.64-.6 1.07-.6.89 0 1.18.74 1.18 1.62v3.61zm4.47-1.75h-2.31v1.23c0 .49.04.9.53.9.5 0 .54-.34.54-.9v-.45h1.24v.48c0 1.26-.53 2.02-1.81 2.02-1.16 0-1.75-.85-1.75-2.02v-2.92c0-1.13.75-1.91 1.84-1.91 1.16 0 1.72.74 1.72 1.91v1.66z"/></svg></a><a class="smaller" data-title="Apple Music" href="https://geo.itunes.apple.com/us/artist/lorenzo-wood/1262743720?at=1000lKSp"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.2 28.2"><defs/><path d="M28.2 7.2c0-.9 0-1.7-.3-2.6A5.8 5.8 0 0025.3 1C24.7.6 24 .3 23.1.2L21.3 0H6.5c-.9 0-1.8.2-2.6.5a5.9 5.9 0 00-3.8 5v1.3L0 7v14.9A6.2 6.2 0 004.4 28H22.8c1-.1 1.9-.4 2.7-1a6 6 0 002.5-4c.2-.8.2-1.6.2-2.4V7.2m-7.6 4.7v6.7c0 .5 0 1-.2 1.4-.4.7-1 1.1-1.7 1.3l-1.2.3a2.2 2.2 0 01-1-4.2 5 5 0 011.1-.4l1.3-.3c.4 0 .6-.3.6-.6v-.2a4542.3 4542.3 0 000-6.6c0-.2-.1-.3-.3-.3a4 4 0 00-.6 0l-2.7.6-2.7.6-1.6.3c-.4 0-.5.2-.5.6v9.3c0 .5 0 1-.3 1.4-.3.8-.9 1.3-1.7 1.5l-1.2.2c-1.2 0-2-.7-2.3-1.8-.2-1 .3-2 1.4-2.5a7 7 0 011.3-.3l1-.2c.4-.1.7-.4.7-.9v-.2a18137.8 18137.8 0 010-10.8c.1-.4.4-.5.7-.6l.9-.2 2.6-.5 2.6-.6 2.4-.5h.8c.3-.1.6.1.6.5v7z"/></svg></a><a data-title="Spotify" href="https://open.spotify.com/artist/1rEOrX1GSkT1SJAsG1fBYA?si=kAr7Wf29R7WkScnbG9d2dg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 168 168"><!-- #1ED760 --><path d="M84 .28a83.74 83.74 0 1 0 0 167.48A83.74 83.74 0 0 0 84 .28zm38.4 120.78a5.22 5.22 0 0 1-7.18 1.73c-19.66-12.01-44.41-14.73-73.56-8.07a5.22 5.22 0 0 1-2.33-10.18c31.9-7.3 59.27-4.15 81.34 9.34a5.22 5.22 0 0 1 1.73 7.18zm10.25-22.8a6.53 6.53 0 0 1-8.98 2.15c-22.51-13.84-56.82-17.85-83.45-9.77a6.54 6.54 0 0 1-3.8-12.49c30.42-9.23 68.23-4.76 94.08 11.13a6.53 6.53 0 0 1 2.15 8.97zm.88-23.75C106.54 58.48 62.01 57 36.24 64.82a7.83 7.83 0 1 1-4.55-14.99c29.58-8.98 78.76-7.24 109.83 11.2a7.82 7.82 0 1 1-7.99 13.48z"/></svg></a></div>
    </header>
    <main>
      <section class="bio">
        <header class="ir" aria-hidden="true">
          <h2>Bio</h2>
        </header>
        <article class="textual">
          <p>Lorenzo Wood is a musician, singer-songwriter, and producer from Alameda, California USA. He sings and plays guitar, keys, drums, bass, and has fun on mandolin and banjo.</p>
          <p>Lorenzo performs solo or with a band in concert and at street fairs and private events. In addition to playing live, Lorenzo runs a recording studio in Alameda producing local artists as well as his own music.</p>
          <p>
            Lorenzo’s single, <a href="href="/link/jacket">Jacket (I’m Sensitive)</a> won Song of the Year in Redwood City and Song of the Month in Palo Alto for West Coast Songwriters.
            
          </p>
          <blockquote>“His voice is like ear candy”
            <footer>Wheeler Cole, West Coast Songwriters</footer>
          </blockquote>
          <p>He also runs live sound, and is knowledgeable and experienced with most audio and musical equipment.</p>
          <p>
            Lorenzo lists Maroon 5, Shawn Mendes, Julia Michaels, John Mayer, The Beatles, U2, Fleetwood Mac, Niall Horan and Train as his musical influences.
            
          </p>
          <aside class="epk download"><a href="EPK.zip">Electronic Press Kit</a></aside>
        </article>
      </section>
      <section class="mailchimp-section">
        <div class="centered">
          <form class="validate taller" action="https://lorenzowoodmusic.us16.list-manage.com/subscribe/post?u=3fb2f947fceaaa94b99d40919&amp;amp;id=1c68d63e9a" method="post" name="mc-embedded-subscribe-form" target="_blank"><input type="email" id="mce-EMAIL" name="EMAIL" placeholder="Email address" title="The domain portion of the email address is invalid (the portion after the @)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required>
            <input id="mce-FNAME" type="text" name="FNAME" placeholder="First Name">
            <input id="mce-LNAME" type="text" name="LNAME" placeholder="Last Name"><span class="ir" aria-hidden="true">
              <input class="ir" type="text" name="b_3fb2f947fceaaa94b99d40919_1c68d63e9a" tabindex="-1"></span>
            <input class="button" type="submit" value="Subscribe to Announcement Email List" name="subscribe">
          </form>
        </div>
      </section>
      <section class="gigs">
        <article class="textual"><?php include 'CACHE/bandsintown.html'; ?>
          <p><i>Please check back closer to the scheduled dates to make sure performances are not cancelled due to coronavirus.</i></p>
        </article>
      </section>
      <section class="latest-releases unpadded">
        <div class="subsection">
          <article>
            <header class="ir" aria-hidden="true">
              <h2>Latest Releases</h2>
            </header>
          </article>
        </div>
        <div class="subsection light-text" style="background-color:#3b8abb">
          <article>
            <div class="release-image bordered"><a href="/link/still-need-love"><img src="/album_art_640/still-need-love.jpg"></a></div>
            <div class="release-blurb">
              <h3><a href="/link/still-need-love">Still Need Love</a></h3>
              <h4>March 2020</h4>
              <p>The first of several singles that I'm releasing in Spring 2020. The start of my new era of music with a fiery beat and smooth saxophone.</p>
              <p>Originally meant to be a song about depression and heartbreak, it gains new meaning during the lonely times of social distancing and being stuck at home.</p>
              <p><a class="bold" href="link/still-need-love">Download/Stream</a></p>
            </div>
            <div class="release-video">
              <div class="youtube" data-code="TkDhR4FMHVg" data-title="Lorenzo Wood - Still Need Love (Official Lyric Video)"></div>
            </div>
          </article>
        </div>
        <div class="subsection light-text reversed" style="background-color:#1D2C1D"> 
          <article>
            <div class="release-image bordered"><a href="link/jacket"><img src="/album_art_640/jacket-ep.jpg"></a></div>
            <div class="release-blurb">
              <h3><a href="link/jacket">Jacket (EP)</a></h3>
              <h4>May 2019 (Single), Oct 2019 (EP)</h4>
              <p>It's about how your friends need to support you, even if they don't understand what you're going through.</p>
              <p>This is an EP with four versions of the same song! The original (in the video here), a remix by <a class="spotify" href="https://open.spotify.com/artist/1BGQD9MGL3oUkS4sN86Wec">Aendru</a>, a rock version, and an acoustic-driven duet with <a href="https://www.kaiasongs.com">Kaia</a>.</p>
              <p><a class="bold" href="link/jacket">Download/Stream</a></p>
            </div>
            <div class="release-video">
              <div class="youtube" data-code="iVHF1RM7a9I" data-title="Lorenzo Wood - Jacket (I'm Sensitive)"></div>
              <div><a href="https://youtu.be/iVHF1RM7a9I">Original video</a></div>
              <div><a href="https://youtu.be/_______">Duet with Kaia</a></div>
              <div><a href="https://youtu.be/Jg1yOnHlcYA">Live Acoustic performance</a></div>
            </div>
          </article>
        </div>
        <div class="subsection light-text" style="background-color:#490B19">
          <article>
            <div class="release-image bordered"><a href="/link/heartless"><img src="/album_art_640/heartless.jpg"></a></div>
            <div class="release-blurb">
              <h3><a href="/link/heartless">Heartless</a></h3>
              <h4>2AM in the Basement • December 2019</h4>
              <p>After listening to Heartless by Diplo and Morgan Wallen a few times, I knew I had to cover it. I used it as an opportunity to learn to produce and edit video, and to try out singing in a different style.</p>
              <p><a class="bold" href="link/heartless">Download/Stream</a></p>
            </div>
            <div class="release-video">
              <div class="youtube" data-code="PfjIqix5ZZw" data-title="Heartless (Diplo &amp; Morgan Wallen) Cover by 2AM In The Basement"></div>
            </div>
          </article>
        </div>
        <div class="subsection dark-text reversed" style="background-color:#d0aa85">
          <article>
            <div class="release-image"><a href="/link/old-town-road"><img src="/album_art_640/old-town-road.jpg"></a></div>
            <div class="release-blurb no-video">
              <h3><a href="/link/old-town-road">Old Town Road</a></h3>
              <h4>2AM in the Basement • May 2019</h4>
              <p>I made this track from start to finish in just over twenty-fours just before the peak of the song's popularity. <a href="http://designology.co">Kyle Wonzen</a> did an awesome job on the graphics, and I've had him contributing artwork ever since.</p>
              <p><a class="bold" href="link/old-town-road">Download/Stream</a></p>
            </div>
          </article>
        </div>
        <div class="subsection dark-text" style="background-color:#bec7cc">
          <article>
            <div class="release-image"><a href="link/now-in-control"><img src="/album_art_640/now-in-control.jpg"></a></div>
            <div class="release-blurb no-video">
              <h3><a href="link/now-in-control">Now In Control (EP)</a></h3>
              <h4>May 2018</h4>
              <p>My debut EP, released when I was just 15 years old. That seems so long ago now! My favorite track is "Don't Look Back"; It's stood the test of time (two years, haha) the most, in my opinion.</p>
              <p><a class="bold" href="link/now-in-control">Download/Stream</a></p>
            </div>
          </article>
        </div>
      </section>
    </main>
    <footer>
      <div class="icons icons-5 icons-footer safe-area-only"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic" style="fill:#e95950"><svg aria-label="Instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Instagram</desc><!-- #e95950 --><path d="M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.7 4.92 4.92.06 1.27.07 1.65.07 4.85 0 3.2-.01 3.58-.07 4.85-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07a83 83 0 0 1-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92A82.98 82.98 0 0 1 2.16 12a84 84 0 0 1 .07-4.85c.15-3.23 1.67-4.77 4.92-4.92A84.4 84.4 0 0 1 12 2.16zM12 0C8.74 0 8.33.01 7.05.07 2.7.27.27 2.7.07 7.05A84.29 84.29 0 0 0 0 12c0 3.26.01 3.67.07 4.95.2 4.36 2.62 6.78 6.98 6.98 1.28.06 1.7.07 4.95.07 3.26 0 3.67-.01 4.95-.07 4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.7.07-4.95 0-3.26-.01-3.67-.07-4.95C23.73 2.7 21.3.27 16.95.07A84.33 84.33 0 0 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.85a1.44 1.44 0 1 0 0 2.89 1.44 1.44 0 0 0 0-2.89z"/></svg></a><a class="smaller" data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic" style="fill:#3b5998"><svg aria-label="Facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on Facebook</desc><!-- #3b5998 --><path d="M22.68 0H1.32C.6 0 0 .6 0 1.32v21.36C0 23.4.6 24 1.32 24h11.5v-9.3H9.69v-3.62h3.13V8.41c0-3.1 1.9-4.79 4.66-4.79 1.32 0 2.46.1 2.8.15V7h-1.92c-1.5 0-1.8.71-1.8 1.76v2.32h3.59l-.47 3.62h-3.12V24h6.12c.73 0 1.32-.6 1.32-1.32V1.32C24 .6 23.4 0 22.68 0z"/></svg></a><a data-title="YouTube" href="https://www.youtube.com/lorenzowoodmusic" style="fill:#b00"><svg aria-label="YouTube" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><desc>Lorenzo Wood Music on YouTube</desc><!-- #b00 --><path d="M4.65 0H6.1l.99 3.7L8 0h1.45L7.79 5.5v3.76H6.35V5.51L4.65 0zm6.6 2.37c-1.12 0-1.86.74-1.86 1.84v3.35c0 1.2.62 1.83 1.86 1.83 1.02 0 1.82-.69 1.82-1.83V4.2c0-1.07-.8-1.84-1.82-1.84zm.53 5.13c0 .37-.2.65-.53.65-.36 0-.56-.3-.56-.65V4.32c0-.37.17-.65.53-.65.39 0 .56.27.56.65V7.5zm4.73-5.07v5.19c-.16.19-.5.5-.75.5-.27 0-.34-.18-.34-.45V2.43h-1.27v5.71c0 .68.2 1.22.89 1.22.38 0 .92-.2 1.47-.85v.75h1.27V2.43H16.5zm2.2 13.86c-.45 0-.54.31-.54.76v.66h1.07v-.66c0-.44-.1-.76-.53-.76zm-4.7.04a.93.93 0 0 0-.25.2v4.05c.1.1.19.18.28.23.2.1.49.1.62-.07.07-.09.1-.24.1-.45v-3.36a.82.82 0 0 0-.12-.5c-.15-.19-.42-.2-.63-.1zm4.82-5.2a183 183 0 0 0-13.66 0c-2.82.2-3.15 1.9-3.17 6.37.02 4.47.35 6.17 3.17 6.37a183 183 0 0 0 13.66 0c2.82-.2 3.15-1.9 3.17-6.37-.02-4.47-.35-6.17-3.17-6.37zM6.51 21.82H5.15v-7.54H3.74V13h4.18v1.28H6.5v7.54zm4.84 0h-1.2v-.72c-.23.27-.46.47-.7.6-.65.38-1.55.37-1.55-.95v-5.44h1.21v5c0 .25.06.43.32.43.24 0 .57-.3.71-.49v-4.94h1.21v6.5zm4.66-1.35c0 .8-.3 1.43-1.1 1.43-.45 0-.82-.16-1.15-.58v.5h-1.22V13h1.22v2.84c.27-.33.64-.6 1.07-.6.89 0 1.18.74 1.18 1.62v3.61zm4.47-1.75h-2.31v1.23c0 .49.04.9.53.9.5 0 .54-.34.54-.9v-.45h1.24v.48c0 1.26-.53 2.02-1.81 2.02-1.16 0-1.75-.85-1.75-2.02v-2.92c0-1.13.75-1.91 1.84-1.91 1.16 0 1.72.74 1.72 1.91v1.66z"/></svg></a><a class="smaller" data-title="Apple Music" href="https://geo.itunes.apple.com/us/artist/lorenzo-wood/1262743720?at=1000lKSp"><svg aria-label="Apple Music" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><rect width="512" height="512" rx="15%" fill="#fff"/><style>stop:last-child{stop-color:#fff;stop-opacity:0}</style><linearGradient id="b" x1=".78" x2=".29" y1=".92" y2=".6"><stop stop-color="#39f" offset="0"/><stop offset="1"/></linearGradient><linearGradient id="a" x1=".75" x2=".93" y1=".16" y2=".59"><stop stop-color="#f66" offset="0"/><stop offset="1"/></linearGradient><path d="M199 359V199q0-9 10-11l138-28q11-2 12 10v122q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69V88s0-20-17-15l-170 35s-13 2-13 18v203q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69" fill="#96f"/><path d="M199 359V199q0-9 10-11l138-28q11-2 12 10v122q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69V88s0-20-17-15l-170 35s-13 2-13 18v203q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69" fill="url(#b)"/><path d="M199 359V199q0-9 10-11l138-28q11-2 12 10v122q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69V88s0-20-17-15l-170 35s-13 2-13 18v203q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69" fill="url(#a)"/></svg></a><a data-title="Spotify" href="https://open.spotify.com/artist/1rEOrX1GSkT1SJAsG1fBYA?si=kAr7Wf29R7WkScnbG9d2dg" style="fill:#1ED760"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 168 168"><!-- #1ED760 --><path d="M84 .28a83.74 83.74 0 1 0 0 167.48A83.74 83.74 0 0 0 84 .28zm38.4 120.78a5.22 5.22 0 0 1-7.18 1.73c-19.66-12.01-44.41-14.73-73.56-8.07a5.22 5.22 0 0 1-2.33-10.18c31.9-7.3 59.27-4.15 81.34 9.34a5.22 5.22 0 0 1 1.73 7.18zm10.25-22.8a6.53 6.53 0 0 1-8.98 2.15c-22.51-13.84-56.82-17.85-83.45-9.77a6.54 6.54 0 0 1-3.8-12.49c30.42-9.23 68.23-4.76 94.08 11.13a6.53 6.53 0 0 1 2.15 8.97zm.88-23.75C106.54 58.48 62.01 57 36.24 64.82a7.83 7.83 0 1 1-4.55-14.99c29.58-8.98 78.76-7.24 109.83 11.2a7.82 7.82 0 1 1-7.99 13.48z"/></svg></a></div>
      <p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span><a class="contact-link" href="/contact/">Contact us</a>
      </p>
      <p class="js-warning">
        JavaScript is disabled in your browser; please enable it to see missing content.
        
      </p>
    </footer>
    <div id="cover" style="display:none"></div>
    <div class="modal" id="redeemer" style="display:none"></div>
    <div class="modal" id="contacter" style="display:none"><header><h2>Contact Lorenzo and the team</h2></header><div class="input-form"><form id="contact-form" action="/mailme.php" method="post"><div><input type="email" name="e" id="e_fm" placeholder="Your Email Address" title="The domain portion of the email address is invalid (the portion after the @)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required></div><div><input type="text" id="e_na" name="n" placeholder="Your Name" value=""/></div><div><textarea type="text" id="e_ms" name="m" rows="10" cols="40" required="required" placeholder="Message"></textarea></div><div><input class="ir" type="text" name="subject" value=""/><input class="ir" type="text" name="message" value=""/><input type="hidden" name="f" value="This message was sent from the LorenzoWoodMusic.com website."/><input type="hidden" name="s" value="Message sent from LorenzoWoodMusic.com"/><input type="hidden" name="r" value="/contact/"/><input type="hidden" name="h" value="contact-form"/><input class="button" type="submit" value="Contact us"/></div><?php if (isset($_GET['msg'])) { echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>'; } ?>
<?php if (isset($_GET['e'])) { echo '<h2 style="color:#C00">' . htmlspecialchars($_GET['e']) . '</h2>'; } ?></form></div>
    </div>
    <div id="close-modal" style="display:none">&#215;</div>
    <div class="scrolldown bounce" id="scroll-arrow" style="display:none; stroke:purple;"><a class="down-arrow" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M1 6l11 10L23 6" stroke-width="4" stroke-linecap="square" fill="none"/></svg></a></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\\/script>')</script>
    <script>
      $("#recent-performances").html('<a id="recent-link" href="#">& Recent</a>'),$("#recent-link").click(function(){return $(".bit-header").text("Recent & Upcoming Performances"),$(".bit-past").show(),!1}),$(".contact-link").click(function(){return $("#cover").show(),$("#contacter").show(),$("#close-modal").show(),!1}),$("#contact-form").submit(function(e){$.ajax({type:"POST",url:"https://www.lorenzowoodmusic.com/mailme.php",data:$("#contact-form").serialize(),success:function(e,t,o){""!==e?($("#e_fm").val(""),$("#e_ms").val(""),$("#e_na").val(""),$("#close-modal").click(),setTimeout(function(){window.alert("Your message was sent. You should hear back from us soon!")},0)):window.alert("Sorry, but the contact form submission did not work as expected.")},error:function(e,t,o){window.alert("ERROR. "+o+" "+t)},complete:function(e,t){}}),e.preventDefault()}),$("#redeem-form").submit(function(e){$("#redeem-input").val().length>0&&$.ajax({type:"POST",url:"/redeem.php",data:$("#redeem-form").serialize(),success:function(e,t,o){""!==e?($("#cover").show(),$("#redeemer").show(),$("#close-modal").show(),$("#redeemer").html(e)):(window.alert("Sorry, but the code you entered has already been redeemed or was entered incorrectly."),$("#redeem-input").focus())},error:function(e,t,o){window.alert(o+" "+t)},complete:function(e,t){}}),e.preventDefault()}),$("#close-modal").click(function(){$("#cover").fadeOut("slow"),$("#close-modal").fadeOut("slow"),$("#redeemer").fadeOut("fast"),$("#contacter").fadeOut("fast")});var $w=$(window).scroll(function(){$("#scroll-arrow").remove(),$w.scrollTop()>$("main").offset().top&&($("body").hasClass("swapped-hero")||($("img.bw-image").css({filter:"grayscale(0%)",opacity:"1.0"}),$("body").hasClass("showing-2")?($("img.swapping-image").attr("src",function(){return $(this).attr("src").replace(/2/g,"1")}),$("source.swapping-image").attr("srcset",function(){return $(this).attr("srcset").replace(/2/g,"1")}),$("body").removeClass("showing-2")):($("img.swapping-image").attr("src",function(){return $(this).attr("src").replace(/1/g,"2")}),$("source.swapping-image").attr("srcset",function(){return $(this).attr("srcset").replace(/1/g,"2")}),$("body").addClass("showing-2")),$("body").addClass("swapped-hero"))),0==$w.scrollTop()&&$("body").removeClass("swapped-hero")});function fullscreen(o){var r=$(window).width(),e=$(window).height(),n=!1;r/e<.575?e=Math.round(r/.575):r/e>1.55?e=Math.round(r/1.55):n=!0,n&&!o?$("#scroll-arrow").css("display","block"):$("#scroll-arrow").remove(),jQuery(".covering").css({width:r,height:e})}$(".down-arrow").click(function(o){return o.preventDefault(),$("html, body").animate({scrollTop:$(".down-arrow").offset().top},1e3),!1}),setTimeout(function(){$("#scroll-arrow").fadeOut("slow",function(){$("#scroll-arrow").remove()})},2e3),fullscreen(null),$(window).resize(function(o){fullscreen(o)});for(var iOS=/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream,youtube=document.querySelectorAll(".youtube"),i=0;i<youtube.length;i++){var code=youtube[i].dataset.code,title=youtube[i].dataset.title,caption=youtube[i].dataset.caption,linking=youtube[i].dataset.linking;if(iOS&&(linking=!0),0){var iframe=document.createElement("iframe");iframe.setAttribute("allowfullscreen",""),iframe.setAttribute("src","https://www.youtube.com/embed/"+code),youtube[i].appendChild(iframe)}else{var source="https://img.youtube.com/vi/"+code+"/sddefault.jpg",image=new Image;image.src=source,image.id="video-"+code,image.alt="YouTube thumbnail",image.addEventListener("load",void youtube[i].appendChild(image)),youtube[i].addEventListener("click",function(){var e=this.dataset.code;if(linking)window.location.href="https://www.youtube.com/watch?v="+e;else{var t=document.createElement("iframe");t.setAttribute("frameborder","0"),t.setAttribute("allowfullscreen",""),t.setAttribute("src","https://www.youtube.com/embed/"+e+"?rel=0&showinfo=0&autoplay=1"),this.innerHTML="",this.appendChild(t)}});var play=document.createElement("div");play.setAttribute("class","play-button"),youtube[i].appendChild(play);var t=document.createElement("div");t.setAttribute("class","title"),t.innerText=title,youtube[i].appendChild(t)}if(caption){var captionDiv=document.createElement("p");captionDiv.innerText=caption,youtube[i].insertAdjacentElement("afterend",captionDiv)}}if (iOS) $('#form-album').val(window.DeviceMotionEvent ? '2938' : '8603');</script><?php if ($code) { ?><script>$('#redeem-form').submit();</script><?php } ?>
<script type="application/ld+json">{"@context":"http://schema.org","@type":"Person","name":"Lorenzo Wood","url":"https://www.lorenzowoodmusic.com/","sameAs":["https://www.facebook.com/lorenzowoodmusic/","https://twitter.com/lorenzowmusic","https://www.instagram.com/LorenzoWoodMusic/","https://www.youtube.com/lorenzowoodmusic","https://listen.tidal.com/artist/9832731",https://soundcloud.com/LorenzoWoodMusic","https://geo.itunes.apple.com/us/artist/lorenzo-wood/1262743720?at=1000lKSp","https://open.spotify.com/artist/1rEOrX1GSkT1SJAsG1fBYA?si=kAr7Wf29R7WkScnbG9d2dg"]}</script>
    <script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>
  </body>
</html>