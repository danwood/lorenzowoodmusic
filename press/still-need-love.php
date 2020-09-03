<?php $slug = 'still-need-love';?><?php

require_once('../classes/downcode.php');
$db = new DowncodeDB();


$now = new DateTime(isset($_GET['ymd']) ? $_GET['ymd'] : 'now');
$releaseDate = $now;   // default to now, so it should show up as released
$release = $db->releaseForSlug($slug);

$releaseDate = $now;	// default to now, so it should show up as released
if ($release) {
	$releaseDateString = NULL;
	if (!empty($release['release_date'])) {
		$releaseDate = new DateTime($release['release_date'], new DateTimeZone('America/New_York'));
		if ($now < $releaseDate) {
			$releaseDateString = $releaseDate->format('l, F jS');
		} else {
			$releaseDateString = $releaseDate->format('F jS Y');
		}
	}
	$oneMonthAgo = new \DateTime('1 month ago');
}
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><link rel="prefetch" href="//res.cloudinary.com"><link rel="prefetch" href="//fonts.googleapis.com"><meta name="robots" content="noindex"><title><?php echo htmlspecialchars($release['title']); ?> - Press page | Lorenzo Wood Music</title><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap&amp;subset=latin" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-16x16.png"><link rel="stylesheet" href="/css/main.090120.css"><style>.releaseDate { text-align:right; opacity:0.5; }
.cover { float:left; width:192px; height:auto; margin:0 1em 1em 0; }
.column { float:left; margin-left:1em; font-size:90% }
.socials svg { width:2em; height: 2em; padding:10px 10px 10px 0; }
.soundCloudLink { text-indent: -3.5em; margin-left: 3.5em; line-height:1; font-size:80%;  }
.soundCloudLink img { width:3em; padding-right:0.5em; }
.soundCloudLink b { white-space: nowrap }
td { padding:0 1em;}
pre.lyrics { font: 16px/1.6 'Montserrat', sans-serif; }</style></head><body><!--[if lt IE 10]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><span class="spinner diagonal part-1"></span><span class="spinner horizontal"></span><span class="spinner diagonal part-2"></span></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div></header><main><section><article class="textual"><h1><?php echo htmlspecialchars($release['title']); ?></h1><h2>Artist: <?php echo htmlspecialchars($release['artist_name']); ?></h2><p class="releaseDate">Song Release Date: <?php echo htmlspecialchars($releaseDateString); ?></p><p><b>"Still Need Love" is the first of several singles that Lorenzo Wood is releasing in Spring 2020. Lorenzo calls this song "the start of my new era of music with a fiery beat and smooth saxophone."</b></p><p>Originally meant to be a song about depression and heartbreak, it gains new meaning during the lonely times of COVID-19 social distancing and being stuck at home. </p><p>Featured on WKNY Radio Kingston | 1490 AM, 107.9 FM on "<a href="https://www.itsrhythmandviews.com">Rhythm & Views</a>," May 2nd</p><p>Featured on <a href="https://www.facebook.com/CBN-Network-408993199924636">Caribbean Broadcast Network</a></p><p>Featured on <a href="https://talkaboutpopmusic.com/2020/04/20/playlist-discover-weekly-20th-april/">Talk About Pop Music</a>, playlist: Discover Weekly 20th April.</p><h2>Web Page</h2><p>Please use this URL to link to "<?php echo htmlspecialchars($release['title']); ?>": <a href="https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?>"> https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?></a></p><div class="clearfix"><h2>Album Artwork</h2><a href="<?php echo htmlentities($db->pathCDNForImageSize($release, 3000, false), ENT_QUOTES); ?>"> <img class="cover" width="384" height="384" src="<?php echo htmlentities($db->pathCDNForImageSize($release, 384), ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"> </a><div class="column"><p>Link to large image (3000 pixels square):<br><a href="<?php echo htmlentities($db->pathCDNForImageSize($release, 3000, false), ENT_QUOTES); ?>">https://www.lorenzowoodmusic.com<?php echo htmlspecialchars($db->pathCDNForImageSize($release, 3000, false)); ?></a></p><p>Designed by <a href="http://designology.co">Kyle Wonzen</a></p></div></div><?php if ($now < $releaseDate ) { ?><h2>Prerelease - SoundCloud Link</h2><p><i>For review use only - not for distribution</i></p><p class="soundCloudLink"><a><img src="/svg/soundcloud-icon.svg" alt=""></a></p><?php } ?><h2>Music Video</h2><div class="clearfix"><a href="https://www.youtube.com/watch?v=TkDhR4FMHVg"><img class="cover" src="https://img.youtube.com/vi/TkDhR4FMHVg/sddefault.jpg"></a><div class="column"><p>Music video: <a href="https://www.youtube.com/watch?v=TkDhR4FMHVg">https://www.youtube.com/watch?v=TkDhR4FMHVg</a></p><?php if ($now < $releaseDate) { ?><?php } ?><p>Thumbnail image: <a href="https://img.youtube.com/vi/TkDhR4FMHVg/maxresdefault.jpg">https://img.youtube.com/vi/TkDhR4FMHVg/maxresdefault.jpg</a></p></div></div><h2>Lyrics</h2><pre class="lyrics">Lying in my room again on my iPhone 
All the days wasting away, where’d they all go?
I’ve been watching Netflix again just to escape 
Yeah I can’t bring any meaning to my own name

How could I ever be someone desirable
When I can’t think of me smiling again
And how could I ever be with someone else
When I don’t know who I am

But I still need love 
I need something to get me through 
I need new purpose for myself and everything I do
Yeah still I need love 
I know I need something new
I need new purpose for myself and everything I do
Yeah I still need love

I got songs to sing but no one to sing to
You know I wanna see the whole world from a new point of view 
But I tapped over to your story, see your arm around someone new
And I bet you haven’t even checked mine to see what I been up to

But I still need love 
I need something to get me through 
I need new purpose for myself and everything I do
Yeah still I need love 
I know I need something new
I need new purpose for myself and everything I do
Yeah I still need love</pre></article></section><div id="generic"></div><noscript>More information: <a href="./">General press kit for Lorenzo Wood</a></noscript><section><article class="textual"><h2>Additional resources</h2><p><a href="/video/">Videos</a> page and downloadable <a href="/photos/">photos</a>.</p></article></section></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span> <a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span> <a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning"><noscript>JavaScript is disabled in your browser; please enable it to see missing content. </noscript></p></footer><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.svg4everybody=b()}):"object"==typeof exports?module.exports=b():a.svg4everybody=b()}(this,function(){/*! svg4everybody v2.0.0 | github.com/jonathantneal/svg4everybody */
function a(a,b){if(b){var c=!a.getAttribute("viewBox")&&b.getAttribute("viewBox"),d=document.createDocumentFragment(),e=b.cloneNode(!0);for(c&&a.setAttribute("viewBox",c);e.childNodes.length;)d.appendChild(e.firstChild);a.appendChild(d)}}function b(b){b.onreadystatechange=function(){if(4===b.readyState){var c=document.createElement("x");c.innerHTML=b.responseText,b.s.splice(0).map(function(b){a(b[0],c.querySelector("#"+b[1].replace(/(\W)/g,"\\$1")))})}},b.onreadystatechange()}function c(c){function d(){for(var c;c=e[0];){var j=c.parentNode;if(j&&/svg/i.test(j.nodeName)){var k=c.getAttribute("xlink:href");if(f&&(!g||g(k,j,c))){var l=k.split("#"),m=l[0],n=l[1];if(j.removeChild(c),m.length){var o=i[m]=i[m]||new XMLHttpRequest;o.s||(o.s=[],o.open("GET",m),o.send()),o.s.push([j,n]),b(o)}else a(j,document.getElementById(n))}}}h(d,17)}c=c||{};var e=document.getElementsByTagName("use"),f="shim"in c?c.shim:/\bEdge\/12\b|\bTrident\/[567]\b|\bVersion\/7.0 Safari\b/.test(navigator.userAgent)||(navigator.userAgent.match(/AppleWebKit\/(\d+)/)||[])[1]<537,g=c.validate,h=window.requestAnimationFrame||setTimeout,i={};f&&d()}return c});svg4everybody();</script><script>var el = document.getElementById('generic');
// IE8+
var request = new XMLHttpRequest();
request.open('GET', 'shared.html', true);

request.onreadystatechange = function() {
  if (this.readyState === 4) {
    if (this.status >= 200 && this.status < 400) {
      var resp = this.responseText;
      el.innerHTML = resp;
    } else {
      el.innerHTML = 'More information: <a href="./">General press kit for Lorenzo Wood</a>';
    }
  }
};
request.send();
request = null;</script></body></html>