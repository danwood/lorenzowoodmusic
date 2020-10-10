<?php
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

require_once('classes/downcode.php');
$db = new DowncodeDB();
$release = $db->featuredRelease();

$now = new DateTime(isset($_GET['ymd']) ? $_GET['ymd'] : 'now');
$releaseDate = $now;	// default to now, so it should show up as released
if ($release) {
	$releaseDateString = NULL;
	if (!empty($release['release_date'])) {
		$releaseDate = new DateTime($release['release_date'], new DateTimeZone('America/New_York'));
		if ($now < $releaseDate) $releaseDateString = $releaseDate->format('l, F jS');
	}
	$oneMonthAgo = new \DateTime('1 month ago');
}

$marketingReleases = $db->marketingReleases();
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><link rel="prefetch" href="//res.cloudinary.com"><link rel="prefetch" href="//fonts.googleapis.com"><title>Lorenzo Wood Music — Official Site</title><meta name="description" content="Lorenzo Wood is an award-winning pop musician, songwriter, producer, and vocalist from the San Francisco area."><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><meta property="og:type" content="website"> <meta property="og:image" content="<?php echo baseURL(); ?>/img/lorenzo-wood-image-card.jpg"> <meta property="og:image:width" content="1200"> <meta property="og:image:height" content="627"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap&amp;subset=latin" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-16x16.png"><link rel="stylesheet" href="/css/main.090120.css"><link rel="prefetch" href="//code.jquery.com"><link href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/raw/upload/lwm/css/aos.css" rel="stylesheet"><noscript><style>[data-aos]{opacity:1!important;transform:translate(0) scale(1)!important;}</style></noscript><style>@charset "UTF-8";
/*
================================================================================

HERO kinds of classes.  For actual Home page, and the 2AM home page.

================================================================================
*/
.icons-header svg {
  fill: var(--color6); }

/*
----------------------------------------
Homepage streaming links above the fold
----------------------------------------
*/
.action-banner {
  text-align: center; }
  .action-banner a {
    padding: 0 8px;
    display: inline-block;
    text-decoration: none; }
    .action-banner a b {
      text-decoration: underline; }
  .action-banner img {
    display: inline-block;
    width: 32px;
    height: 32px;
    padding: 0; }

@media only screen and (max-width: 270px) {
  .action-banner {
    display: none !important; } }

@media only screen and (max-width: 370px) {
  .needsMedium-small {
    display: none !important; } }

@media only screen and (max-width: 470px) {
  .needsMedium {
    display: none !important; } }

/*
----------------------------------------
Down arrow only below full page hero
----------------------------------------
*/
.scrolldown {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center; }
  .scrolldown svg {
    width: 24px;
    height: 24px; }

.bounce {
  animation: bounce 2s infinite; }

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0); }
  40% {
    transform: translateY(-30px); }
  60% {
    transform: translateY(-15px); } }

/*
----------------------------------------
Hero
----------------------------------------
*/
.hero {
  position: relative;
  width: 100%;
  height: auto; }

.hero-image {
  width: 100%; }

img.covering {
  object-fit: cover;
  object-position: 50% 75%;
  top: 0;
  z-index: -1; }
  @media only screen and (max-width: 767px) {
    img.covering {
      border-top: 3em solid var(--cBanner); } }
.js img.covering {
  position: fixed; }

.action-banner a {
  color: var(--cInkH); }

@media only screen and (min-width: 768px) {
  .action-banner {
    position: absolute;
    top: 0;
    left: 0;
    right: 0; } }

/*
================================================================================

Home-Page ONLY classes.

================================================================================
*/
/*
---------------------------------------------
Social Icons on home page only at page bottom
---------------------------------------------
*/
.icons.absolute {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  /* should match with height of nav */ }

/*
----------------------------------------
Colors
----------------------------------------
*/
section.mailchimp-section {
  background-color: var(--color3); }

section.bio {
  background-color: var(--color6); }

section.gigs {
  background-color: var(--color3); }
  section.gigs a {
    color: #944747; }
  section.gigs a.bit-track {
    color: white; }

section.latest-releases {
  background-color: var(--color3); }

/*
----------------------------------------
Latest Releases Section
----------------------------------------
*/
.latest-releases h3 {
  font-size: 2rem; }
  .latest-releases h3 a {
    text-decoration: none; }
    .latest-releases h3 a:hover {
      text-decoration: underline; }

.latest-releases h4 {
  font-size: 100%;
  font-weight: normal;
  font-style: italic; }

.latest-releases .release-image img {
  width: 100%;
  height: auto;
  max-height: 320px;
  max-width: 320px;
  display: block;
  transition: transform .5s ease; }
  .latest-releases .release-image img:hover {
    box-shadow: 0px 0px 5px 0px rgba(255, 255, 255, 0.9);
    transform: scale(1.05); }

.latest-releases article {
  display: block;
  padding-top: 4em;
  padding-bottom: 4em; }
  @media only screen and (min-width: 768px) {
    .latest-releases article {
      padding-top: 2.5em;
      padding-bottom: 2.5em;
      display: flex;
      margin: 0 auto;
      max-width: 90rem; } }
@media only screen and (max-width: 767px) {
  .latest-releases .release-image img {
    margin: 0 auto; }
  .latest-releases h3, .latest-releases h4 {
    text-align: center;
    margin-top: 0.5rem;
    margin-bottom: 0; } }

@media only screen and (min-width: 768px) {
  .latest-releases .release-image {
    width: 41%;
    float: left;
    margin: 0 1em 0 0; }
  .latest-releases .reversed .release-image {
    float: right;
    margin: 0 0 0 1em; }
  .latest-releases .no-video .release-image {
    width: 22.7%; }
  .latest-releases .release-blurb {
    width: 55.5%;
    padding: 15px 15px; }
    .latest-releases .release-blurb.no-video {
      width: 100%; }
    .latest-releases .release-blurb h3, .latest-releases .release-blurb h4 {
      margin: 0; }
  .latest-releases .release-video {
    width: 44.5%; } }

.latest-releases .subsection.reversed article {
  flex-direction: row-reverse; }

.latest-releases .dark-text {
  color: rgba(0, 0, 0, 0.9) !important; }

.latest-releases .dark-text a {
  color: rgba(0, 0, 0, 0.6) !important; }

.latest-releases .light-text {
  color: white !important; }

.latest-releases .light-text a {
  color: rgba(255, 255, 255, 0.6) !important; }

.latest-releases .release-image.bordered img {
  border: 1px solid rgba(255, 255, 255, 0.5); }

/*
----------------------------------------
Bands in Town
----------------------------------------
*/
.bit-row {
  padding: 6px 0;
  border-bottom: 1px solid var(--cPaperL); }

.bit-header {
  font-weight: bold; }

.bit-row.bit-upcoming a {
  text-decoration: none;
  color: var(--cInkH); }

.bit-date {
  padding-left: 5px;
  text-transform: uppercase;
  font-weight: bold;
  display: inline-block;
  width: 7em; }

.bit-date, .bit-venue, .bit-citystate {
  padding-top: 10px; }

.bit-button {
  color: var(--cPaperH);
  background-color: var(--cLink);
  padding: 10px;
  display: inline-block;
  text-align: center;
  width: 8em;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 90%;
  float: right; }

.bit-after {
  padding-top: 1em; }

@media only screen and (max-width: 767px) {
  /* Bands in town just show square logo */
  .bit-header-full {
    display: none; }
  .bit-date, .bit-venue, .bit-citystate, .bit-button {
    display: block; }
  .bit-date, .bit-venue, .bit-citystate {
    padding: 0; } }

@media only screen and (min-width: 768px) {
  /* Bands in town just show square logo */
  .bit-header-mobile {
    display: none; }
  /* Make track link be a button */
  .bit-track {
    text-decoration: none;
    color: var(--cPaperH);
    background-color: var(--cLink);
    padding: 10px;
    margin-right: 0.5rem; }
  /* Separator for city-state */
  .bit-citystate:before {
    content: ' — '; } }

/*
----------------------------------------
Mailing
----------------------------------------
*/
.taller {
  margin: 1em auto; }

.mailchimp-section {
  padding-top: 0;
  padding-bottom: 0; }
  .mailchimp-section form, .mailchimp-section input {
    display: inline-block; }
  .mailchimp-section input:not([type]), .mailchimp-section input[type=text], .mailchimp-section input[type=email], .mailchimp-section input[type=submit] {
    padding: 0.5rem;
    margin: 0.5rem 0.5rem;
    font: normal 16px HelveticaNeue-CondensedBold, impact, sans-serif; }

#mce-FNAME {
  width: 6em; }

#mce-LNAME {
  width: 9em; }

#mce-EMAIL {
  width: 10em; }

@media only screen and (max-width: 767px) {
  .mailchimp-section {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem; }
    .mailchimp-section h3, .mailchimp-section form, .mailchimp-section input {
      display: block; }
    .mailchimp-section h3 {
      padding: 0;
      margin: 0.5rem 0.5rem; }
    .mailchimp-section input:not([type]), .mailchimp-section input[type=text], .mailchimp-section input[type=email], .mailchimp-section input[type=submit] {
      padding: 0.5rem;
      margin: 0.5rem 0.5rem; }
  #mce-FNAME, #mce-LNAME, #mce-EMAIL {
    width: 90%; } }

/*
----------------------------------------
Modal for Contact Form
----------------------------------------
*/
#cover {
  position: fixed;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 20;
  width: 100%;
  height: 100%; }

.modal {
  position: fixed;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -20%);
  min-width: 768px;
  max-width: 100%;
  min-height: 300px;
  max-height: 100%;
  margin: auto auto;
  background-color: var(--cPaperH);
  border: 5px solid black;
  border-radius: 10px;
  padding: 10px;
  z-index: 21; }

#close-modal {
  position: fixed;
  top: 0;
  right: 40px;
  font-size: 600%;
  color: var(--cPaperH);
  z-index: 22;
  text-shadow: 0 0 4px var(--cInkH);
  cursor: pointer; } </style></head><body class="home"><!--[if lt IE 10]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header class="covering" id="main-header"><div class="logo"><a class="active" href="/"><h1>Lorenzo Wood</h1></a><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><span class="spinner diagonal part-1"></span><span class="spinner horizontal"></span><span class="spinner diagonal part-2"></span></label><nav class="page-menu"><ul><li><a class="active" href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div><div class="hero"><?php if ($release) { ?><div class="action-banner clearfix safe-area-only"><p><a target="_blank" href="/link/<?php echo htmlentities($release['slug'], ENT_QUOTES); ?>"> <img loading="lazy" src="<?php echo htmlentities($db->pathCDNForImageSize($release, 64), ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>, cover image" width="64" height="64"> </a><span><?php echo htmlspecialchars( ($now < $releaseDate ? 'Upcoming' : ($releaseDate < $oneMonthAgo ? 'Latest' : 'New')) . ' ' . $release['release_type_name'] . ' “' . $release['title'] . '”'); ?> —&nbsp;</span><b><a href="/link/<?php echo htmlentities($release['slug'], ENT_QUOTES); ?>"><?php echo ($now < $releaseDate) ? 'Pre-Save or Pre-Order Now!' : 'Download or stream now!'; ?></a></b></p></div><?php } ?><img class="hero-image covering swapping-image" srcset="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/img/banner1_giant.jpg 2560w, https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/img/banner1_big.jpg 1920w, https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/img/banner1_medium.jpg 960w, https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/img/banner1_small.jpg 640w" sizes="100vw" width="960" height="674" src="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/img/banner1_medium.jpg" loading="eager" alt="Lorenzo Wood"></div><div class="icons icons-header absolute icons-5 safe-area-only"><div class="icon"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic"><svg><use xlink:href="/svg/homepage.svg#instagram"></use></svg></a></div><div class="icon smaller"><a data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic"><svg><use xlink:href="/svg/homepage.svg#facebook"></use></svg></a></div><div class="icon"><a data-title="YouTube" href="https://www.youtube.com/lorenzowoodmusic"><svg><use xlink:href="/svg/homepage.svg#youtube"></use></svg></a></div><div class="icon smaller"><a data-title="Apple Music" href="https://geo.itunes.apple.com/us/artist/lorenzo-wood/1262743720?at=1000lKSp"><svg><use xlink:href="/svg/homepage.svg#apple-music-monochrome"></use></svg></a></div><div class="icon"><a data-title="Spotify" href="https://open.spotify.com/artist/1rEOrX1GSkT1SJAsG1fBYA"><svg><use xlink:href="/svg/homepage.svg#spotify"></use></svg></a></div></div></header><main><section class="bio"><header class="ir" aria-hidden="true"><h2>Bio</h2></header><article class="textual"><p data-aos="fade">Lorenzo Wood is an award-winning musician, songwriter, producer, and vocalist from the San Francisco area. His heartfelt, honest lyrics present a personal perspective of friendships, relationships, and coming of age in the modern era of social media. His songs, rooted in the pop genre, borrow from a number of different musical styles to create a distinctive mix of real instruments and electronic sounds. </p><p data-aos="fade-left" data-aos-delay="100">In addition to recording and producing songs and videos in his home studio, Lorenzo performs solo or with a band live. With a skillset of music performance technology, he puts together unique, intricate live setups that make his performances stand out. </p><p data-aos="fade-right" data-aos-delay="200">Lorenzo lists Maroon 5, Train, U2, Shawn Mendes, Owl City, and John Mayer as his initial musical influences. But now he feels his style resembles more that of artists like Bazzi, Julia Michaels, Post Malone, and Jonas Brothers. </p><p data-aos="fade-left" data-aos-delay="300">Lorenzo has been performing and recording his songs since a young age. At age 13, he discovered busking, and has been performing primarily at street festivals in the San Francisco Bay Area every summer/fall since then. </p><p data-aos="fade-right" data-aos-delay="400">In 2018, while releasing his first EP at the age of 15, he put together and hired a band to play the newly released songs with him on stage. He performed again 2019 with a new lineup. </p><p data-aos="fade-left" data-aos-delay="500">Lorenzo has also performed as a member of several local bands. Recently he has supported Kat Van Morgan, Saint Benjamin, and others, playing whatever instruments were needed. </p><p data-aos="fade-right" data-aos-delay="600">For many of his own performances and those of others, Lorenzo coordinates and runs live sound, being knowledgeable and experienced with most audio and musical equipment. </p></article></section><section class="mailchimp-section"><div class="centered" data-aos="fade-up" data-aos-delay="300"><form class="validate taller" action="https://lorenzowoodmusic.us16.list-manage.com/subscribe/post?u=3fb2f947fceaaa94b99d40919&amp;amp;id=1c68d63e9a" method="post" name="mc-embedded-subscribe-form" target="_blank"><input type="email" id="mce-EMAIL" name="EMAIL" placeholder="Email address" title="The domain portion of the email address is invalid (the portion after the @)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required><input id="mce-FNAME" name="FNAME" placeholder="First Name"><input id="mce-LNAME" name="LNAME" placeholder="Last Name"><span class="ir" aria-hidden="true"><input class="ir" name="b_3fb2f947fceaaa94b99d40919_1c68d63e9a" tabindex="-1"></span><input class="button" type="submit" value="Subscribe to Announcement Email List" name="subscribe"></form></div></section><section class="gigs"><article class="textual" data-aos="fade-up" data-aos-delay="600"><?php include 'CACHE/bandsintown.html'; ?><p><i>Please check back closer to the scheduled dates to make sure performances are not cancelled due to coronavirus.</i></p></article></section><section class="latest-releases unpadded"><div class="subsection ir" aria-hidden="true"><article><header><h2>Latest Releases</h2></header></article></div><?php $reversed = false; foreach ($marketingReleases as $release) { ?> <div class="subsection <?php echo $release['light_text'] ? 'light-text' : 'dark-text'; if ($reversed) { echo ' reversed'; } $reversed = !$reversed; ?>" style="background-color:<?php echo htmlentities($release['color'], ENT_QUOTES); ?>"><article><div class="release-blurb<?php if (!$release['youtube_video_v']) { echo ' no-video'; } ?>"> <div class="release-image bordered" data-aos="fade-<?php echo $reversed ? 'right' : 'left'; ?>" , data-aos-delay="200"> <a href="/link/<?php echo htmlentities($release['slug'], ENT_QUOTES); ?>"><?php	echo '<img loading="lazy" width="64" height="64" src="';
	echo htmlentities($db->pathCDNForImageSize($release, 64), ENT_QUOTES);
	echo '" alt= "Cover image of ';
	echo htmlentities($release['title'], ENT_QUOTES);
	echo '" srcset="';
	echo htmlentities(
		$db->pathCDNForImageSize($release, 64) . ' 64w, ' .
		$db->pathCDNForImageSize($release, 384) . ' 384w, ' .
		$db->pathCDNForImageSize($release, 640) . ' 640w', ENT_QUOTES);
	echo '" sizes="(max-width: 768px) 100vw, 25vw"/>';
?></a> </div><div data-aos="fade-up" data-aos-duration="1000"><h3><a href="<?php echo '/link/' . htmlentities($release['slug'], ENT_QUOTES); ?>"> <?php echo htmlspecialchars($release['title']); ?> </a></h3><?php if ($release['artist_id'] != 1) { echo '<h4>' . htmlspecialchars($release['artist_name']) . '</h4>'; } ?> <?php echo $release['description_html']; ?> <?php $releaseDate = new DateTime($release['release_date'], new DateTimeZone('America/New_York'));if ($now < $releaseDate) { ?><h4>Releasing <?php echo htmlspecialchars($releaseDate->format('F j, Y')); ?></h4> <p><a class="bold" href="link/<?php echo htmlentities($release['slug'], ENT_QUOTES); ?>">Pre-Save / Pre-Order</a></p> <?php } else { ?> <h4><?php echo htmlspecialchars($releaseDate->format('F Y')); ?></h4> <p><a class="bold" href="link/<?php echo htmlentities($release['slug'], ENT_QUOTES); ?>">Download/Stream</a></p> <?php } ?></div></div> <?php if ($release['youtube_video_v']) { echo '<div class="release-video" data-aos="fade-' . ($reversed ? 'left' : 'right') . '" data-aos-delay="400" data-aos-duration="1000"><div class="youtube-player" data-code="' . $release['youtube_video_v'] . '"></div></div>'; } ?></article></div> <?php } ?></section></main><footer><div class="icons icons-5 icons-footer safe-area-only"><div class="icon instagram"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic"><svg><use xlink:href="/svg/homepage.svg#instagram"></use></svg></a></div><div class="icon smaller facebook"><a data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic"><svg><use xlink:href="/svg/homepage.svg#facebook"></use></svg></a></div><div class="icon youtube"><a data-title="YouTube" href="https://www.youtube.com/lorenzowoodmusic"><svg><use xlink:href="/svg/homepage.svg#youtube"></use></svg></a></div><div class="icon smaller"><a data-title="Apple Music" href="https://geo.itunes.apple.com/us/artist/lorenzo-wood/1262743720?at=1000lKSp"><svg aria-label="Apple Music" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><rect height="100%" width="100%" rx="15%" fill="#fff"/><style>stop:last-child{stop-color:#fff;stop-opacity:0}</style><linearGradient id="acb" x1=".78" x2=".29" y1=".92" y2=".6"><stop stop-color="#39f" offset="0"/><stop offset="1"/></linearGradient><linearGradient id="aca" x1=".75" x2=".93" y1=".16" y2=".59"><stop stop-color="#f66" offset="0"/><stop offset="1"/></linearGradient><path d="M199 359V199q0-9 10-11l138-28q11-2 12 10v122q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69V88s0-20-17-15l-170 35s-13 2-13 18v203q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69" fill="#96f"/><path d="M199 359V199q0-9 10-11l138-28q11-2 12 10v122q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69V88s0-20-17-15l-170 35s-13 2-13 18v203q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69" fill="url(#acb)"/><path d="M199 359V199q0-9 10-11l138-28q11-2 12 10v122q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69V88s0-20-17-15l-170 35s-13 2-13 18v203q0 15-45 20c-57 9-48 105 30 79 30-11 35-40 35-69" fill="url(#aca)"/></svg></a></div><div class="icon spotify"><a data-title="Spotify" href="https://open.spotify.com/artist/1rEOrX1GSkT1SJAsG1fBYA"><svg><use xlink:href="/svg/homepage.svg#spotify"></use></svg></a></div></div><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span> <a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span> <a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning"><noscript>JavaScript is disabled in your browser; please enable it to see missing content. </noscript></p></footer><div id="cover" style="display:none"></div><div class="modal" id="contacter" style="display:none"><header><h2>Contact Lorenzo and the team</h2></header><div class="input-form"><form id="contact-form" action="/mailme.php" method="post"><div><input type="email" name="e" id="e_fm" placeholder="Your Email Address" title="The domain portion of the email address is invalid (the portion after the @)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required></div><div><input id="e_na" name="n" placeholder="Your Name" value=""></div><div><textarea id="e_ms" name="m" rows="10" cols="40" required="required" placeholder="Message"></textarea></div><div><input class="ir" name="subject" value=""><input class="ir" name="message" value=""><input type="hidden" name="f" value="This message was sent from the LorenzoWoodMusic.com website."><input type="hidden" name="s" value="Message sent from LorenzoWoodMusic.com"><input type="hidden" name="r" value="/contact/"><input type="hidden" name="h" value="contact-form"><input class="button" type="submit" value="Contact us"></div><?php if (isset($_GET['msg'])) { echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>'; } ?> <?php if (isset($_GET['e'])) { echo '<h2 style="color:#C00">' . htmlspecialchars($_GET['e']) . '</h2>'; } ?></form></div></div><div id="close-modal" style="display:none">&#215;</div><div class="scrolldown bounce" id="scroll-arrow" style="display:none; stroke:purple;"><a class="down-arrow" href="#"><svg><use xlink:href="/svg/homepage.svg#downarrow"></use></svg></a></div><script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script><script src="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/raw/upload/lwm/js/aos.js"></script><script>window.jQuery || document.write('<script src="js/vendor/jquery-3.5.1.min.js"><\\/script>')
AOS.init({disable: 'mobile', once: true});</script><script>$("#recent-performances").html('<a id="recent-link" href="#">& Recent</a>'),$("#recent-link").click((function(){return $(".bit-header").text("Recent & Upcoming Performances"),$(".bit-past").show(),!1})),$(".contact-link").click((function(){return $("#cover").show(),$("#contacter").show(),$("#close-modal").show(),!1})),$("#contact-form").submit((function(e){$.ajax({type:"POST",url:"https://www.lorenzowoodmusic.com/mailme.php",data:$("#contact-form").serialize(),success:function(e,t,o){""!==e?($("#e_fm").val(""),$("#e_ms").val(""),$("#e_na").val(""),$("#close-modal").click(),setTimeout((function(){window.alert("Your message was sent. You should hear back from us soon!")}),0)):window.alert("Sorry, but the contact form submission did not work as expected.")},error:function(e,t,o){window.alert("ERROR. "+o+" "+t)},complete:function(e,t){}}),e.preventDefault()})),$("#close-modal").click((function(){$("#cover").fadeOut("slow"),$("#close-modal").fadeOut("slow"),$("#contacter").fadeOut("fast")}));var $w=$(window).scroll((function(){$("#scroll-arrow").remove(),$w.scrollTop()>$("main").offset().top&&($("body").hasClass("swapped-hero")||($("body").hasClass("showing-2")?($("img.swapping-image").attr("src",(function(){return $(this).attr("src").replace(/2_/g,"1_")})),$("img.swapping-image").attr("srcset",(function(){return $(this).attr("srcset").replace(/2_/g,"1_")})),$("body").removeClass("showing-2")):($("img.swapping-image").attr("src",(function(){return $(this).attr("src").replace(/1_/g,"2_")})),$("img.swapping-image").attr("srcset",(function(){return $(this).attr("srcset").replace(/1_/g,"2_")})),$("body").addClass("showing-2")),$("body").addClass("swapped-hero"))),0==$w.scrollTop()&&$("body").removeClass("swapped-hero")}));function fullscreen(o){var r=$(window).width(),e=$(window).height(),n=!1;r/e<.575?e=Math.round(r/.575):r/e>1.55?e=Math.round(r/1.55):n=!0,n&&!o?$("#scroll-arrow").css("display","block"):$("#scroll-arrow").remove(),jQuery(".covering").css({width:r,height:e})}$(".down-arrow").click((function(o){return o.preventDefault(),$("html, body").animate({scrollTop:$(".down-arrow").offset().top},1e3),!1})),setTimeout((function(){$("#scroll-arrow").fadeOut("slow",(function(){$("#scroll-arrow").remove()}))}),2e3),fullscreen(null),$(window).resize((function(o){fullscreen(o)}));for(var iOS=/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream,youtube=document.querySelectorAll(".youtube-player"),i=0;i<youtube.length;i++){var code=youtube[i].dataset.code,title=youtube[i].dataset.title,caption=youtube[i].dataset.caption,linking=youtube[i].dataset.linking;if(iOS&&(linking=!0),0){var iframe=document.createElement("iframe");iframe.setAttribute("allowfullscreen",""),iframe.setAttribute("src","https://www.youtube.com/embed/"+code),youtube[i].appendChild(iframe)}else{var prefix="https://img.youtube.com/vi/",source="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/youtube/"+code+".jpg",image=new Image;image.src=source,image.id="video-"+code,image.setAttribute("loading","lazy"),image.alt="YouTube thumbnail",image.addEventListener("load",void youtube[i].appendChild(image)),youtube[i].addEventListener("click",(function(){var e=this.dataset.code;if(linking)window.location.href="https://www.youtube.com/watch?v="+e;else{var t=document.createElement("iframe");t.setAttribute("frameborder","0"),t.setAttribute("allowfullscreen",""),t.setAttribute("src","https://www.youtube.com/embed/"+e+"?rel=0&showinfo=0&autoplay=1"),this.innerHTML="",this.appendChild(t)}}));var play=document.createElement("div");if(play.setAttribute("class","play-button"),youtube[i].appendChild(play),void 0!==title){var t=document.createElement("div");t.setAttribute("class","title"),t.innerText=title,youtube[i].appendChild(t)}}if(caption){var captionDiv=document.createElement("p");captionDiv.innerText=caption,youtube[i].insertAdjacentElement("afterend",captionDiv)}}</script><script type="application/ld+json">{"@context":"http://schema.org","@type":"Person","name":"Lorenzo Wood","url":"https://www.lorenzowoodmusic.com/","sameAs":["https://www.facebook.com/lorenzowoodmusic/","https://twitter.com/lorenzowmusic","https://www.instagram.com/LorenzoWoodMusic/","https://www.youtube.com/lorenzowoodmusic","https://listen.tidal.com/artist/9832731","https://soundcloud.com/LorenzoWoodMusic","https://geo.itunes.apple.com/us/artist/lorenzo-wood/1262743720?at=1000lKSp","https://open.spotify.com/artist/1rEOrX1GSkT1SJAsG1fBYA"]}</script><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.svg4everybody=b()}):"object"==typeof exports?module.exports=b():a.svg4everybody=b()}(this,function(){/*! svg4everybody v2.0.0 | github.com/jonathantneal/svg4everybody */
function a(a,b){if(b){var c=!a.getAttribute("viewBox")&&b.getAttribute("viewBox"),d=document.createDocumentFragment(),e=b.cloneNode(!0);for(c&&a.setAttribute("viewBox",c);e.childNodes.length;)d.appendChild(e.firstChild);a.appendChild(d)}}function b(b){b.onreadystatechange=function(){if(4===b.readyState){var c=document.createElement("x");c.innerHTML=b.responseText,b.s.splice(0).map(function(b){a(b[0],c.querySelector("#"+b[1].replace(/(\W)/g,"\\$1")))})}},b.onreadystatechange()}function c(c){function d(){for(var c;c=e[0];){var j=c.parentNode;if(j&&/svg/i.test(j.nodeName)){var k=c.getAttribute("xlink:href");if(f&&(!g||g(k,j,c))){var l=k.split("#"),m=l[0],n=l[1];if(j.removeChild(c),m.length){var o=i[m]=i[m]||new XMLHttpRequest;o.s||(o.s=[],o.open("GET",m),o.send()),o.s.push([j,n]),b(o)}else a(j,document.getElementById(n))}}}h(d,17)}c=c||{};var e=document.getElementsByTagName("use"),f="shim"in c?c.shim:/\bEdge\/12\b|\bTrident\/[567]\b|\bVersion\/7.0 Safari\b/.test(navigator.userAgent)||(navigator.userAgent.match(/AppleWebKit\/(\d+)/)||[])[1]<537,g=c.validate,h=window.requestAnimationFrame||setTimeout,i={};f&&d()}return c});svg4everybody();</script></body></html>