<?php $slug = 'drown';?><?php

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
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><link rel="prefetch" href="//res.cloudinary.com"><link rel="prefetch" href="//fonts.googleapis.com"><meta name="robots" content="noindex"><title><?php echo htmlspecialchars($release['title']); ?> - Press page | Lorenzo Wood Music</title><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap&amp;subset=latin" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-16x16.png"><link rel="stylesheet" href="/css/main.082520.css"><style>.releaseDate { text-align:right; opacity:0.5; }
.cover { float:left; width:192px; height:auto; margin:0 1em 1em 0; }
.column { float:left; margin-left:1em; font-size:90% }
.socials svg { width:2em; height: 2em; padding:10px 10px 10px 0; }
.soundCloudLink { text-indent: -3.5em; margin-left: 3.5em; line-height:1; font-size:80%;  }
.soundCloudLink img { width:3em; padding-right:0.5em; }
.soundCloudLink b { white-space: nowrap }
td { padding:0 1em;}
pre.lyrics { font: 16px/1.6 'Montserrat', sans-serif; }</style></head><body><!--[if lt IE 10]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><span class="spinner diagonal part-1"></span><span class="spinner horizontal"></span><span class="spinner diagonal part-2"></span></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div></header><main><section><article class="textual"><h1><?php echo htmlspecialchars($release['title']); ?></h1><h2>Artist: <?php echo htmlspecialchars($release['artist_name']); ?></h2><p class="releaseDate">Song Release Date: <?php echo htmlspecialchars($releaseDateString); ?></p><p><b>This is a breakup song. But unlike most breakup songs,</b> this takes place before the breakup and is from the perspective of the person finding that they need to initiate it. It’s about the turmoil in deciding to put an end to a relationship that isn’t quite cutting it.</p><p>Starting with an acoustic foundation, then morphing into a percussion-heavy atmosphere — Layers of acoustic drums and percussion layered with a mainstream trap beat — conveying the stress, frustration and pain in the lyrical content. </p><blockquote><p>This song gave me the most relieving cry session. Somehow he managed to convey all the conflicting thoughts and feelings I had during my first relationship and I finally feel so understood. </p><p>The song begins with a sweet guitar solo - the calm before the storm. Throughout the song, the artist's voice is effortlessly beautiful. Emotional lyrics follow the internal conflict between the protagonist and their thoughts. Should they end the relationship now that the spark is gone and hurt the other person? Or must they endure unhappiness for the sake of the other person? He doesn’t give us an answer, but he does depict the situation with powerful metaphors of cages, flight, and succumbing to the pool of your darkest thoughts. </p><footer><a href="https://www.unheardgems.com/post/drown-lorenzo-wood-review-premiere">Unheard Gems</a> : “Drown” - Lorenzo Wood | Review &amp; Premiere</footer></blockquote><blockquote><p>We all know that great music is written based on personal experiences and real emotions, especially the breakup song theme. Lorenzo Wood’s Drown uses a fresh perspective from the person who has to do the breaking up and the horrific anxiety that ending a relationship causes, especially when no one has warranted the change of heart. Sometimes it just happens. I think the lyrics to this song reflect these complex emotions.</p><footer><a href="https://neonmusic.co.uk/a-fresh-perspective-from-lorenzo-wood-with-drown">Neon Music</a> : A Fresh Perspective From Lorenzo Wood With Drown</footer></blockquote><p>Music and Lyrics, Vocals, Production, Guitar, Mandolin, Piano/Keys, Drums/Percussion: Lorenzo Wood</p><p>Mixed by Chris Krotky</p><p>Mastered by Lorenzo Wood</p><h2>Web Page</h2><p>Please use this URL to link to "<?php echo htmlspecialchars($release['title']); ?>": <a href="https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?>"> https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?></a></p><div class="clearfix"><h2>Album Artwork</h2><a href="<?php echo htmlentities($db->pathCDNForImageSize($release, 3000, false), ENT_QUOTES); ?>"> <img class="cover" width="384" height="384" src="<?php echo htmlentities($db->pathCDNForImageSize($release, 384), ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"> </a><div class="column"><p>Link to large image (3000 pixels square):<br><a href="<?php echo htmlentities($db->pathCDNForImageSize($release, 3000, false), ENT_QUOTES); ?>">https://www.lorenzowoodmusic.com<?php echo htmlspecialchars($db->pathCDNForImageSize($release, 3000, false)); ?></a></p><p>Designed by <a href="http://designology.co">Kyle Wonzen</a></p></div></div><?php if ($now < $releaseDate ) { ?><h2>Prerelease - SoundCloud Link</h2><p><i>For review use only - not for distribution</i></p><p class="soundCloudLink"><a href="https://soundcloud.com/lorenzowoodmusic/drown/s-NNq3bzGrIit"><img src="/svg/soundcloud-icon.svg" alt="">https://soundcloud.com/lorenzowoodmusic/drown/s-NNq3bzGrIit</a></p><iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/814166620%3Fsecret_token%3Ds-NNq3bzGrIit&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><?php } ?><h2>Lyrics</h2><pre class="lyrics">I feel boxed in
Like a bird in a cage who’s just stuck
Aside from my heart
Well the cage has everything I want 

But I wish I could fly
Just spread my wings and fly
But I can’t 
Yea I can’t with you in my life

‘Cause no road I take will leave us both okay 
No path I choose will make things right 
No choice I make will end with us feeling good
So all I can do is drown in my thoughts tonight

You‘ve been good, yeah you treated me well no matter what 
Everything feels right, just except for my heart   

It’s not like it was before 
Things feel different,  now I don’t belong here
All the memories of us that were good are now gone 

‘Cause no road I take will leave us both okay 
No path I choose will make things right 
No choice I make will end with us feeling good
All I can do is drown in my thoughts tonight

Today’s gonna be the day
Don’t know what I’m gonna say
There’s no way to do this where it won’t hurt
So just tell me I’m gonna be alright and it won’t get worse 

‘Cause no road I take will leave us both okay 
No path I choose will make things right 
No choice I make will end with us feeling good
All I can do is drown in my thoughts tonight
</pre></article></section><div id="generic"></div><noscript>More information: <a href="./">General press kit for Lorenzo Wood</a></noscript><section><article class="textual"><h2>Additional resources</h2><p><a href="/video/">Videos</a> page and downloadable <a href="/photos/">photos</a>.</p></article></section></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span> <a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span> <a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning"><noscript>JavaScript is disabled in your browser; please enable it to see missing content. </noscript></p></footer><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.svg4everybody=b()}):"object"==typeof exports?module.exports=b():a.svg4everybody=b()}(this,function(){/*! svg4everybody v2.0.0 | github.com/jonathantneal/svg4everybody */
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