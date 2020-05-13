<?php $slug = 'falling';?><?php

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
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><title><?php echo htmlspecialchars($release['title']); ?> - Press page | Lorenzo Wood Music</title><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"><link rel="stylesheet" href="/css/main.051220.css"><style>.releaseDate { text-align:right; opacity:0.5; }
.cover { float:left; width:192px; margin:0 1em 1em 0; }
.column { float:left; margin-left:1em; font-size:90% }
.socials svg { width:2em; height: 2em; padding:10px 10px 10px 0; }
.soundCloudLink { text-indent: -3.5em; margin-left: 3.5em; line-height:1; font-size:80%;  }
.soundCloudLink img { width:3em; padding-right:0.5em; }
.soundCloudLink b { white-space: nowrap }
td { padding:0 1em;}
pre.lyrics { font: 16px/1.6 'Montserrat', sans-serif; }</style></head><body><!--[if lt IE 9]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><div class="spinner diagonal part-1"></div><div class="spinner horizontal"></div><div class="spinner diagonal part-2"></div></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div></header><main><section><article class="textual"><h1><?php echo htmlspecialchars($release['title']); ?></h1><h2>Artist: <?php echo htmlspecialchars($release['artist_name']); ?></h2><p class="releaseDate">Song Release Date: <?php echo htmlspecialchars($releaseDateString); ?></p><h3 class="centered">FOR RELEASE ON OR AFTER MAY 8, 2020 (0:00 Eastern Time)</h3><p><b>Teen Musicians Create Cover of the Harry Styles Song "Falling" to Raise Funds for COVID-19 Relief</b></p><p>ALAMEDA, CALIFORNIA, May 8, 2020 — Musician Lorenzo Wood, under the band name 2AM in the Basement, today released a cover of the hit song "Falling," in collaboration with a virtual orchestra of 11 other teen musicians from around the United States, to raise money for COVID-19 relief. Proceeds from downloads and streams of the song, and views of the video, will go to a mix of charities that Wood has selected. The song can be downloaded, streamed, or viewed from URL LorenzoWoodMusic.com/falling .
</p><p>"Falling" was originally recorded by English singer and songwriter Harry Styles, and released earlier this year.
</p><p>Wood, 17, initially recorded the song in his home studio with vocals and basic instrumentation of keyboards, guitars, and electric bass. But then, after being in touch online throughout the Coronavirus crisis with a number of fellow young musicians all over the country — also graduating high school seniors, who have been accepted into Belmont University, Berklee College of Music, LA College of Music, and USC Thornton School of Music — he had the idea of accumulating additional parts for the song. He wrote arrangements for new instrumentation and emailed sheet music and reference recordings to both his new acquaintances and some old friends.</p><p>"I was a little worried about how some of the contributions would sound," said Wood.  "Many of these musicians are stuck at home with their instrument but without any recording equipment.  So a lot of them used their phones! Fortunately I was able to process and clean up the sounds just fine. The microphones built into iPhones are actually pretty good."
</p><p>Additional instruments added to the mix include backing vocals, strings, brass, woodwinds, and drums/percussion.
</p><p>Lorenzo is releasing the song "Falling" under his pseudonym, 2AM in the Basement, that he uses for cover songs. (He releases his songs under his own name.) Wood's cover of the song adds additional energy to the calmer original version. Singer/Producer Delanie Leclerc of Southeast Florida is a featured vocalist, singing a minimal, stripped chorus before a reprise featuring all of the contributing musicians at once.
</p><p>The song also comes with a music video. Everybody contributed video recordings of their part at their homes.
</p><p>Wood and his collaborators have decided to use this release, and its unique circumstances, as a way to raise funds for several COVID-19 relief charities. Lorenzo will be contributing the net proceeds from downloads and streams of the song collected for the first 2 months after its release to a mix of nonprofits: American Guild of Musical Artists (AGMA) Relief Fund, Feeding America, and Freelancers Relief Fund.
</p><p>Wood credits his parents with the idea of using the song to raise money. "We are all feeling a bit overwhelmed with staying at home and social distancing," said Lorenzo. "But they helped me understand that what I'm going through is nothing to complain about. The unemployment levels are horrible, and like me, musicians all over the world are having their gigs cancelled. And many people who are able to work are putting their lives on the line every day."
</p><p>Musicians are especially impacted by the societal changes due to the Coronavirus, as many rely on crowds at live performances, cancelled for the forseeable future. The AGMA relief fund, one of the targetted charities, was chosen out of solidarity with fellow musicians.
</p><p>Readers are encouraged to watch the video, and share it with friends, and stream/purchase the song.
</p><p><b>Ends</b></p><p>For further information, please contact <a href="mailto:info@lorenzowoodmusic.com">info@lorenzowoodmusic.com</a> or 
<img class="ghost" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAG4AAAAOBAMAAAA8gTSSAAAAGFBMVEX///8GBgZfX1+/v7/f399/f3+fn58/Pz/0OKciAAAA30lEQVR4XtWRwUrDUBRED+/lNetrW9xG6AdchabbbKrbCsF1ggu3poZ+v2UutOQHBGcRDmeYXEL485h9c2ygeppRqmlGhmInmXczh9EFUUED+dJA6hJK7YcwnDuUntJRXVygSrt4HK8OCJApqpQEdesBhJ5sELasXCL5S5Q1t+zhQ/VelVLNwk/ykMweyLaOMj1vkYGeqtGuv+94Xd5780MXu10ZiDQUs43gvmuX36cXaCcPkE8gK5Bc7fIsrP2L5b18u1c67QJix/jo2Wyt36bk6QcZxi2RBGAbgap/k18A4SCIF3ziIAAAAABJRU5ErkJggg==" alt="" />
</p><hr><h2>Web Page</h2><p>Please use this URL to link to "<?php echo htmlspecialchars($release['title']); ?>":
<a href='https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?>'> https://www.lorenzowoodmusic.com/link/<?php echo htmlspecialchars($release['slug']); ?></a></p><h3>Recipient Charities</h3><ul><li><a href="https://www.musicalartists.org/membership/agma-relief-fund/">AGMA Relief Fund</a></li><li><a href="https://www.feedingamerica.org">Feeding America</a></li><li><a href="https://www.freelancersunion.org/resources/freelancers-relief-fund/">Freelancers Relief Fund</a></li></ul><h3>Collaborators</h3><p>Most of the collaborators can be contacted via Instagram. Listed alphabetically by last name here:</p><table class="flipping"><tr><td>Terry Cowley</td><td>Costa Mesa, CA</td><td>Tuba, Upright Bass</td><td><a href="https://www.instagram.com/mea_hookani_pila">@mea_hookani_pila</a></td></tr><tr><td>Ana-Laura Galindo</td><td>Hackettstown, NJ</td><td>Clarinet</td><td><a href="https://www.instagram.com/analaura_galindo">@analaura_galindo</a></td></tr><tr><td>Elina Graham</td><td>CA</td><td>Clarinet</td><td></td></tr><tr><td>Delanie Leclerc</td><td>Delray Beach, FL</td><td>Vocals</td><td><a href="https://www.instagram.com/delanieleclerc">@delanieleclerc</a></td></tr><tr><td>Ada Papila</td><td>Palo Alto, CA</td><td>Vocals</td><td><a href="https://www.instagram.com/adapapilamusic">@adapapilamusic</a></td></tr><tr><td>Anna Renton</td><td>Albany, CA</td><td>Violin and Viola</td><td><a href="https://www.instagram.com/anna.renton">@anna.renton</a></td></tr><tr><td>J Tolub</td><td>Pasadena, CA</td><td>Trumpet</td><td><a href="https://www.instagram.com/jthecomposer">@jthecomposer</a></td></tr><tr><td>Zander Scott</td><td>Cary, IL</td><td>Drums</td><td><a href="https://www.instagram.com/zander_scott_">@zander_scott_</a></td></tr><tr><td>Bailey Wise</td><td>Springfield, MO</td><td>Cello</td><td><a href="https://www.instagram.com/baileymwise">@baileymwise</a></td></tr><tr><td>Andrew Wilson</td><td>Sacramento, CA</td><td>808s/Drum Pads</td><td><a href="https://www.instagram.com/parayasound">@parayasound</a></td></tr><tr><td>Lorenzo Wood</td><td>Alameda, CA</td><td>Vocals, Guitars, Keys, Arrangement, Production</td><td><a href="https://www.instagram.com/lorenzowoodmusic">@lorenzowoodmusic</a></td></tr><tr><td>Andy Young</td><td>San Francisco, CA</td><td>Trombone</td><td><a href="https://www.instagram.com/andyyru">@andyyru</a></td></tr></table><p>Delanie Leclerc on Spotify:
<a href="https://open.spotify.com/artist/547XK7rrl55NSCTqDa7TUx">https://open.spotify.com/artist/547XK7rrl55NSCTqDa7TUx</a></p><div class="clearfix"><h2>Album Artwork</h2><a href='<?php echo htmlentities($db->pathForImageSize($release, 3000), ENT_QUOTES); ?>'>
<img class="cover" src="<?php echo htmlentities($db->pathForImageSize($release, 384), ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>" />
</a><div class="column"><p>Link to large image (3000 pixels square):<br><a href='<?php echo htmlentities($db->pathForImageSize($release, 3000), ENT_QUOTES); ?>'>https://lorenzowoodmusic.com<?php echo htmlspecialchars($db->pathForImageSize($release, 3000)); ?></a></p></div></div><?php if ($now < $releaseDate ) { ?><h2>Prerelease - SoundCloud Link</h2><p><i>For review use only - not for distribution</i></p><p class="soundCloudLink"><a href="https://soundcloud.com/lorenzowoodmusic/falling/s-ptYg7eF2lVL"><img src="/svg/soundcloud-icon.svg" alt="">https://soundcloud.com/lorenzowoodmusic/falling/s-ptYg7eF2lVL</a></p><iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/805053907%3Fsecret_token%3Ds-ptYg7eF2lVL&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe><?php } ?><h2>Music Video</h2><div class="clearfix"><a href="https://www.youtube.com/watch?v=ixUV87pKtBg"><img class="cover" src="https://img.youtube.com/vi/ixUV87pKtBg/sddefault.jpg"></a><div class="column"><p>Music video:
<a href="https://www.youtube.com/watch?v=ixUV87pKtBg">https://www.youtube.com/watch?v=ixUV87pKtBg</a></p><?php if ($now < $releaseDate) { ?><p>Preview for Press/Media ONLY, before release
<a href="https://www.youtube.com/watch?v=6tgTYadpb7o">https://www.youtube.com/watch?v=6tgTYadpb7o</a></p><?php } ?><p>Thumbnail image:
<a href="https://www.lorenzowoodmusic.com/press/falling_thumb.jpg">https://www.lorenzowoodmusic.com/press/falling_thumb.jpg</a></p></div></div></article></section><div id="generic"></div><noscript>More information: <a href="./">General press kit for Lorenzo Wood</a></noscript><section><article class="textual"><h2>Additional resources</h2><p><a href="/video/">Videos</a> page and downloadable <a href="/photos/">photos</a>.</p></article></section></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span><a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span><a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning">JavaScript is disabled in your browser; please enable it to see missing content.
</p></footer><script src="/js/svg4everybody.min.js"></script><script>svg4everybody();</script><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script><script>var el = document.getElementById('generic');
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