<?php $slug = 'more-than-friends';?><?php

require_once('../classes/downcode.php');
$db = new DowncodeDB();


$now = new DateTime();
$releaseDate = $now;   // default to now, so it should show up as released
$release = $db->releaseForSlug($slug);

$now = new DateTime();
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
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><title><?php echo htmlspecialchars($release['title']); ?> - Press page | Lorenzo Wood Music</title><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"><link rel="stylesheet" href="/css/main.050120.css"><style>.releaseDate { text-align:right; opacity:0.5; }
.cover { float:left; width:192px; margin:0 1em 1em 0; }
.column { float:left; margin-left:1em; font-size:90% }
.socials svg { width:2em; padding:10px 10px 10px 0; }
.soundCloudLink { text-indent: -3.5em; margin-left: 3.5em; line-height:1; font-size:80%;  }
.soundCloudLink svg { width:3em; padding-right:0.5em; }
.soundCloudLink b { white-space: nowrap }
td { padding:0 1em;}
pre.lyrics { font: 16px/1.6 'Montserrat', sans-serif; }</style></head><body><!--[if lt IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div></header><main><section><article class="textual"><h1><?php echo htmlspecialchars($release['title']); ?></h1><h2>Artist: <?php echo htmlspecialchars($release['artist_name']); ?></h2><p class="releaseDate">Song Release Date: <?php echo htmlspecialchars($releaseDateString); ?></p><p><b>More Than Friends is an upbeat song about the hopeful transition from being just friends into something more. 
</b></p><p>"It's a pretty happy song, which is hard for a lot of songwriters to write. I only have a few of them," said Lorenzo Wood, the writer and producer of the song. "Yes, it is written about a particular person, so shout-out to her for the inspiration."
</p><blockquote>'More Than Friends' is a soft Electro Pop track with a brief interlude of sultry saxophone to add to the musical layers and production.<footer><a href="https://www.laonlock.com/reviews/5/1/2020/lorenzo-wood-more-than-friends-review">LA On Lock</a></footer></blockquote><blockquote title="En upplyftande poplåt om att satsa helhjärtat på ett förhållande och ta det från vänskap till något mer. Allt skriven och producerat av sångaren och du hittar även en kryddning med saxofon i låten. Så väldigt charmig.">An uplifting pop song about investing wholeheartedly in a relationship and taking it from friendship to something more. Everything written and produced by the singer and you also find spice with saxophone in the song. So very charming.<footer><a href="https://popmuzik.se/104966/lorenzo-wood-more-than-friends/">Popmuzik</a>
<span style="opacity:0.3">(translated from Swedish)</span></footer></blockquote><blockquote>I love how this song conveys the underlying anxieties of a crush; the vocals are very smooth, but accompanied by a faster beat, which mimics the way your heart might beat faster around someone despite your normal behavior.<footer><a href="https://www.unheardgems.com/post/more-than-friends-lorenzo-wood-review">Unheard Gems</a></footer></blockquote><p>Featured on <a href="https://alfitude.com/2020/05/01/new-music-lorenzo-wood/">Alfitude New Music</a>.</p><h2>Web Page</h2><p>Please use this URL to link to "<?php echo htmlspecialchars($release['title']); ?>":
<a href='https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?>'> https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?></a></p><div class="clearfix"><h2>Album Artwork</h2><a href='<?php echo htmlentities($db->pathForImageSize($release, 3000), ENT_QUOTES); ?>'>
<img class="cover" src="<?php echo htmlentities($db->pathForImageSize($release, 384), ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>" />
</a><div class="column"><p>Link to large image (3000 pixels square):<br><a href='<?php echo htmlentities($db->pathForImageSize($release, 3000), ENT_QUOTES); ?>'>https://lorenzowoodmusic.com/<?php echo htmlspecialchars($db->pathForImageSize($release, 3000)); ?></a></p><p>Designed by
<a href="http://designology.co">Kyle Wonzen</a></p></div></div><?php if ($now < $releaseDate ) { ?><h2>Prerelease - SoundCloud Link</h2><p><i>For review use only - not for distribution</i></p><p class="soundCloudLink"><a href="https://soundcloud.com/lorenzowoodmusic/more-than-friends-releasing-on-may-1/s-Jznggs6I7kA"><svg aria-label="SoundCloud" xmlns="http://www.w3.org/2000/svg" viewBox="0 6 24 12"><desc>Lorenzo Wood Music on SoundCloud</desc><path fill="#f50" d="M7 17.94H6V9.87c.3-.23.64-.43 1-.56v8.63zm3 0h1V8.7c-.23.27-.44.55-.62.86L10 9.4v8.55zm-2 0h1V9.09c-.5-.08-.62-.05-1 0v8.85zm-4 0h1v-7.02a4.7 4.7 0 0 0-.7 1.53l-.3-.18v5.67zm-3-5.25a3.07 3.07 0 0 0 0 4.53V12.7zm18.88-.67c-.2-2.84-2.4-5.08-5.12-5.08-1.02 0-1.96.33-2.76.88v10.12h9.09c1.6 0 2.91-1.4 2.91-3.1 0-2.24-2.17-3.78-4.12-2.82zM3 11.99c-.3-.02-.53-.03-1 .12v5.7c.45.14.64.13 1 .13v-5.95z"/></svg>https://soundcloud.com/lorenzowoodmusic/more-than-friends-releasing-on-may-1/s-Jznggs6I7kA</a>
<b>(Explicit lyrics)</b></p><p class="soundCloudLink"><a href="https://soundcloud.com/lorenzowoodmusic/more-than-friends-clean-version/s-nX1HoYzNcUN"><svg aria-label="SoundCloud" xmlns="http://www.w3.org/2000/svg" viewBox="0 6 24 12"><desc>Lorenzo Wood Music on SoundCloud</desc><path fill="#f50" d="M7 17.94H6V9.87c.3-.23.64-.43 1-.56v8.63zm3 0h1V8.7c-.23.27-.44.55-.62.86L10 9.4v8.55zm-2 0h1V9.09c-.5-.08-.62-.05-1 0v8.85zm-4 0h1v-7.02a4.7 4.7 0 0 0-.7 1.53l-.3-.18v5.67zm-3-5.25a3.07 3.07 0 0 0 0 4.53V12.7zm18.88-.67c-.2-2.84-2.4-5.08-5.12-5.08-1.02 0-1.96.33-2.76.88v10.12h9.09c1.6 0 2.91-1.4 2.91-3.1 0-2.24-2.17-3.78-4.12-2.82zM3 11.99c-.3-.02-.53-.03-1 .12v5.7c.45.14.64.13 1 .13v-5.95z"/></svg>https://soundcloud.com/lorenzowoodmusic/more-than-friends-clean-version/s-nX1HoYzNcUN</a>
<b>(Radio Edit)</b></p><iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/797933995%3Fsecret_token%3Ds-Jznggs6I7kA&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><?php } ?><h2>Lyrics</h2><pre class="lyrics">I woke up at 5 a.m.
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

Be more than friends</pre></article></section><div id="generic"></div><noscript>More information: <a href="./">General press kit for Lorenzo Wood</a></noscript><section><article class="textual"><h2>Additional resources</h2><p><a href="/video/">Videos</a> page and downloadable <a href="/photos/">photos</a>.</p></article></section></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span><a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span><a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning">JavaScript is disabled in your browser; please enable it to see missing content.
</p></footer><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script><script>var el = document.getElementById('generic');
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