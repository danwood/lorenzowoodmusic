<?php $slug = 'more-than-friends';?><?php

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
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><link rel="prefetch" href="//res.cloudinary.com"><link rel="prefetch" href="//fonts.googleapis.com"><meta name="robots" content="noindex"><title><?php echo htmlspecialchars($release['title']); ?> - Press page | Lorenzo Wood Music</title><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap&amp;subset=latin" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-16x16.png"><link rel="stylesheet" href="/css/main.063020.css"><style>.releaseDate { text-align:right; opacity:0.5; }
.cover { float:left; width:192px; margin:0 1em 1em 0; }
.column { float:left; margin-left:1em; font-size:90% }
.socials svg { width:2em; height: 2em; padding:10px 10px 10px 0; }
.soundCloudLink { text-indent: -3.5em; margin-left: 3.5em; line-height:1; font-size:80%;  }
.soundCloudLink img { width:3em; padding-right:0.5em; }
.soundCloudLink b { white-space: nowrap }
td { padding:0 1em;}
pre.lyrics { font: 16px/1.6 'Montserrat', sans-serif; }</style></head><body><!--[if lt IE 10]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div></header><main><section><article class="textual"><h1><?php echo htmlspecialchars($release['title']); ?></h1><h2>Artist: <?php echo htmlspecialchars($release['artist_name']); ?></h2><p class="releaseDate">Song Release Date: <?php echo htmlspecialchars($releaseDateString); ?></p><p><b>More Than Friends is an upbeat song about the hopeful transition from being just friends into something more. </b></p><p>"It's a pretty happy song, which is hard for a lot of songwriters to write. I only have a few of them," said Lorenzo Wood, the writer and producer of the song. "Yes, it is written about a particular person, so shout-out to her for the inspiration." </p><blockquote>'More Than Friends' is a soft Electro Pop track with a brief interlude of sultry saxophone to add to the musical layers and production.<footer><a href="https://www.laonlock.com/reviews/5/1/2020/lorenzo-wood-more-than-friends-review">LA On Lock</a></footer></blockquote><blockquote title="En upplyftande poplåt om att satsa helhjärtat på ett förhållande och ta det från vänskap till något mer. Allt skriven och producerat av sångaren och du hittar även en kryddning med saxofon i låten. Så väldigt charmig.">An uplifting pop song about investing wholeheartedly in a relationship and taking it from friendship to something more. Everything written and produced by the singer and you also find spice with saxophone in the song. So very charming.<footer><a href="https://popmuzik.se/104966/lorenzo-wood-more-than-friends/">Popmuzik</a> <span style="opacity:0.3">(translated from Swedish)</span></footer></blockquote><blockquote>I love how this song conveys the underlying anxieties of a crush; the vocals are very smooth, but accompanied by a faster beat, which mimics the way your heart might beat faster around someone despite your normal behavior.<footer><a href="https://www.unheardgems.com/post/more-than-friends-lorenzo-wood-review">Unheard Gems</a></footer></blockquote><p>Featured on <a href="https://alfitude.com/2020/05/01/new-music-lorenzo-wood/">Alfitude New Music</a>. </p><h2>Web Page</h2><p>Please use this URL to link to "<?php echo htmlspecialchars($release['title']); ?>": <a href="https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?>"> https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?></a></p><div class="clearfix"><h2>Album Artwork</h2><a href="<?php echo htmlentities($db->pathCDNForImageSize($release, 3000, false), ENT_QUOTES); ?>"> <img class="cover" src="<?php echo htmlentities($db->pathCDNForImageSize($release, 384), ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"> </a><div class="column"><p>Link to large image (3000 pixels square):<br><a href="<?php echo htmlentities($db->pathCDNForImageSize($release, 3000, false), ENT_QUOTES); ?>">https://www.lorenzowoodmusic.com<?php echo htmlspecialchars($db->pathCDNForImageSize($release, 3000, false)); ?></a></p><p>Designed by <a href="http://designology.co">Kyle Wonzen</a></p></div></div><?php if ($now < $releaseDate ) { ?><h2>Prerelease - SoundCloud Link</h2><p><i>For review use only - not for distribution</i></p><p class="soundCloudLink"><a href="https://soundcloud.com/lorenzowoodmusic/more-than-friends-releasing-on-may-1/s-Jznggs6I7kA"><img src="/svg/soundcloud-icon.svg" alt="">https://soundcloud.com/lorenzowoodmusic/more-than-friends-releasing-on-may-1/s-Jznggs6I7kA</a> <b>(Explicit lyrics)</b></p><p class="soundCloudLink"><a href="https://soundcloud.com/lorenzowoodmusic/more-than-friends-clean-version/s-nX1HoYzNcUN"><img src="/svg/soundcloud-icon.svg" alt="">https://soundcloud.com/lorenzowoodmusic/more-than-friends-clean-version/s-nX1HoYzNcUN</a> <b>(Radio Edit)</b></p><?php } ?><h2>Lyrics</h2><pre class="lyrics">I woke up at 5 a.m.
Just to talk to you
Before your flight to LA
And I’m wondering would you do the same for me too?

And judging from our texts at night
There’s something in between us
And based on how you smile at me 
That’s another reason to believe it 

So I wanna be more than friends
Tryna give it a shot with us two
So if you’re feeling like I’ve been
Then this could be beautiful 

I fuckin’ wanna be more than friends
Know I just wanna be with you
So if you’re thinking like I am
Well that’s what we gotta do
Be more than friends

(Yeah)
(Just come on, girl)

More than friends

This level of sarcasm 
Just has to be you flirting 
The thought that you want this like I do
Has got my heart bursting 

This week has been too much talking
Not enough kissing your lips
Yuh every fucking day
Can’t stop thinking ‘bout you and how

I wanna be more than friends
Tryna give it a shot with us two
So if you’re feeling like I’ve been
Then this could be beautiful 

I fuckin’ wanna be more than friends
I just wanna be with you
So if you’re thinking like I am
Well that’s what we gotta do

(Be more than friends)
I wanna be more than friends
I hope you wanna give it a shot with us two
If you’re feeling like I’ve been
Then this could be beautiful 
(This could be beautiful)
I fuckin’ wanna be more than friends
I just wanna be with you
If you’re thinking like I am
Well that’s what we gotta do
(That’s what we gotta do)

Be more than friends</pre></article></section><div id="generic"></div><noscript>More information: <a href="./">General press kit for Lorenzo Wood</a></noscript><section><article class="textual"><h2>Additional resources</h2><p><a href="/video/">Videos</a> page and downloadable <a href="/photos/">photos</a>.</p></article></section></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span> <a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span> <a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning"><noscript>JavaScript is disabled in your browser; please enable it to see missing content. </noscript></p></footer><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.svg4everybody=b()}):"object"==typeof exports?module.exports=b():a.svg4everybody=b()}(this,function(){/*! svg4everybody v2.0.0 | github.com/jonathantneal/svg4everybody */
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