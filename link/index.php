<?php

require_once('../classes/downcode.php');
$db = new DowncodeDB();
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$genBlurhash = isset($_GET['blurhash']);

if (empty($slug)) {
  header('HTTP/1.0 404 Not Found');
  readfile('../404.html');
  exit();
}

$now = new DateTime(isset($_GET['ymd']) ? $_GET['ymd'] : 'now');
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
foreach($releases as $r) {
	if ($r['variation_id'] == 2) { $has_radio_edit = true; }
	if ($r['variation_id'] == 1) { $has_explicit = true; }
}
$is_explicit = $release['variation_id'] == 1;	// is *this* page marked explicit?
$longTitle = $release['title'];

if (!empty($release['featuring'])) { $longTitle .= ' [feat. ' . $release['featuring'] . ']'; }
$longTitle .= ' - by ' . $release['artist_name'];

$descriptionHTML = $release['description_html'];
$whereEndParagraph = strpos($descriptionHTML, '</p>');
if (FALSE !== $whereEndParagraph) { $descriptionHTML = substr($descriptionHTML, 0, $whereEndParagraph+strlen('</p>')); }
$descriptionText = strip_tags($descriptionHTML);

$releaseDateString = NULL;
if (!empty($release['release_date'])) {
	$releaseDate = new DateTime($release['release_date'], new DateTimeZone('America/New_York'));
	if ($now < $releaseDate) $releaseDateString = $releaseDate->format('l, F jS');
}
?><!DOCTYPE html><html class="no-js" lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--><link rel="prefetch" href="//res.cloudinary.com"><link rel="prefetch" href="//fonts.googleapis.com"><title><?php echo htmlentities($longTitle); ?></title><?php if (strlen($descriptionText) > 0) { echo "<meta name='description' content='" . htmlentities($descriptionText, ENT_QUOTES) . "'>"; } ?><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><meta name="supported-color-schemes" content="light dark"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&amp;display=swap&amp;subset=latin" rel="stylesheet"><link rel="apple-touch-icon" sizes="180x180" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/upload/lwm/favicon-16x16.png"><link rel="stylesheet" href="/css/main.101020.css"><meta property="og:title" content="<?php echo htmlentities($longTitle, ENT_QUOTES); ?>"> <meta property="og:description" content="Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>"> <meta property="og:url" content="<?php echo htmlentities(curPageURL()); ?>"> <meta property="og:type" content="article"> <meta property="og:image" content="<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($release['image'], ENT_QUOTES); ?>"> <meta name="twitter:url" content="<?php echo htmlentities(curPageURL()); ?>"> <meta name="twitter:title" content="<?php echo htmlentities($longTitle, ENT_QUOTES); ?>"> <meta name="twitter:description" content="Preview, download or stream <?php echo htmlentities($longTitle, ENT_QUOTES); ?>"> <meta name="twitter:card" content="summary_large_image"> <meta name="twitter:image" content="<?php echo baseURL() . '/album_art_1200x630/' . htmlentities($release['image'], ENT_QUOTES); ?>"><style>header#main-header,body>footer,.page-menu{z-index:2}body>footer{background:none}body>footer p{color:#d9d9d9;text-shadow:2px 2px 1px rgba(0,0,0,.5)}@media only screen and (max-width: 599px){body>footer p{opacity:.5;font-size:70%;text-shadow:none}}.js-warning{display:none}.centered{text-align:center}.additional{background-color:rgba(255,255,0,.3);margin-top:10px;margin-bottom:10px}.additional a{color:#000}.mini-icons{padding-left:10px;display:inline-block}.mini-icons svg{width:24px;height:24px;padding:6px 6px 1rem 6px}@media only screen and (max-width: 413px){.mini-icons{display:none}}.background-blur,.blurhash{z-index:0;position:fixed;top:-50%;left:-50%;width:200%;height:200%;transform:translate3d(0, 0, 0);-o-transform:translate3d(0, 0, 0);-ms-transform:translate3d(0, 0, 0);-moz-transform:translate3d(0, 0, 0);-webkit-transform:translate3d(0, 0, 0)}.background-blur img,.blurhash img{position:absolute;top:0;left:0;right:0;bottom:0;margin:auto;min-width:55%;min-height:55%}.background-blur img{filter:blur(30px);-webkit-filter:blur(30px);-moz-filter:blur(30px);-o-filter:blur(30px);-ms-filter:blur(30px)}.center-column{position:relative;z-index:1;overflow:visible;max-width:320px;display:block;margin:auto;padding:0;border:0;font-size:16px;vertical-align:baseline}.imagecontainer{position:relative;display:block;overflow:hidden}.imagecontainer img{width:320px;height:320px;display:block;position:relative;background-size:100%;background:rgba(0,0,0,.5)}.title-container{background-color:#181818;padding-bottom:10px;text-align:center;color:#fff}.title-container h1,.title-container h2,.title-container p{margin-bottom:0;margin-top:0;line-height:1.3em}.title-container h1,.title-container h2{padding:16px 20px 0;font-size:18px;font-weight:500}.title-container p{padding:5px 20px 20px;font-size:14px;word-break:normal}.service-container{background-color:#fff}.service-barrier{border-top:1px solid #fff;padding:2px 10px 0;background-color:#888;color:#fff;font-size:70%;letter-spacing:2px;text-transform:uppercase}.service{padding:2px 0;border-bottom:1px solid #f5f5f5;transition:background-color .3s ease;cursor:pointer}.service a{width:100%;display:inline-block;text-decoration:none !important}.service a:hover .play{transition:.3s ease;color:#fff;background-color:#222;border-color:#222}.service .play{text-align:center;display:inline-block;float:right;margin:15px 15px 15px 0;border-radius:5px;border:1px solid #777;padding:8px 10px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:155px;color:#777}.service img,.service svg{max-width:170px;max-height:45px;display:inline-block;margin:14px 0 14px 15px}.service:hover{transition:background-color .3s ease;background-color:#f5f5f5}.blurb{margin-top:2em;background-color:rgba(0,0,0,.5);font-size:75%;padding:1em;color:rgba(255,255,255,.5)}.switch{position:relative;height:26px;width:200px;margin:0 auto;border-radius:3px;box-shadow:inset 0 1px 3px rgba(0,0,0,.3),0 1px rgba(255,255,255,.1)}.switch .switch-label{position:relative;z-index:2;float:left;width:98px;line-height:26px;font-size:11px;color:rgba(255,255,255,.75);text-align:center;text-shadow:0 1px 1px rgba(0,0,0,.45);cursor:pointer}.switch .switch-label:active{font-weight:bold}.switch .switch-label-off{padding-left:2px}.switch .switch-label-on{padding-right:2px}.switch .switch-input{display:none}.switch .switch-input:checked+.switch-label{font-weight:bold;color:rgba(0,0,0,.65);text-shadow:0 1px rgba(255,255,255,.25)}.switch .switch-input:checked+.switch-label-on~.switch-selection{left:100px}.switch .switch-selection{position:absolute;z-index:1;top:2px;left:2px;display:block;width:98px;height:22px;border-radius:3px;background-color:#c4bb61;background-image:linear-gradient(to top, #e0dd94, #c4bb61);box-shadow:inset 0 1px rgba(255,255,255,.5),0 0 2px rgba(0,0,0,.2)} </style></head><body><!--[if lt IE 10]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
<a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]--><header id="main-header"><div class="logo"><a href="/"><h1>Lorenzo Wood</h1></a><div class="mini-icons"><div class="icon"><a data-title="Instagram" href="https://instagram.com/LorenzoWoodMusic"><svg><use xlink:href="/svg/homepage.svg#instagram"></use></svg></a></div><div class="icon"><a data-title="Facebook" href="https://facebook.com/LorenzoWoodMusic"><svg><use xlink:href="/svg/homepage.svg#facebook"></use></svg></a></div></div><input id="navigation" type="checkbox"><label class="hamburger" for="navigation"><span class="spinner diagonal part-1"></span><span class="spinner horizontal"></span><span class="spinner diagonal part-2"></span></label><nav class="page-menu"><ul><li><a href="/">home</a></li><li><a href="/photos/">photos</a></li><li><a href="/videos/">videos</a></li><li><a href="/booking/">booking</a></li><li><a href="/2am-in-the-basement/">2am</a></li></ul></nav></div><?php if ($genBlurhash) { ?> <input type="number" id="x" value="4" min="1" max="9"> × <input type="number" id="y" value="4" min="1" max="9"> <input id="blurhash" style="width:100%" value="Blurhash goes here"> <canvas id="originalCanvas" style="display:none" width="100" height="100"></canvas> <?php } ?></header><main><div class="blurhash"><img id="blurhashImage"> <canvas id="outputCanvas" style="display:none" width="32" height="32"></canvas></div><div class="background-blur" id="background-blur"><noscript><img src="<?php $blur = CLOUDPREFIX . ($release['image_blurred'] ? 'blurred_100/' . $release['image_blurred'] : 'album_art_640/' . htmlentities($release['image'])); echo htmlentities($blur, ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"></noscript></div><div class="center-column"><?php if ($release['blurb']) { ?> <div class="centered additional"><a href="<?php echo htmlentities($release['blurb_url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($release['blurb']); ?></a></div> <?php } ?><div class="title-container"><?php if ($release['youtube_video_v']) { ?> <div class="youtube-border"><div class="youtube-player" data-linking="yep" data-code="<?php echo htmlentities($release['youtube_video_v'], ENT_QUOTES); ?>" data-title=""></div></div> <?php } ?><h1><?php echo htmlspecialchars($release['artist_name']); ?> <br> <?php echo htmlspecialchars($release['title']); ?></h1><?php $featuring = $release['featuring']; if (!empty($featuring)) { echo ' (Featuring ' . htmlspecialchars($featuring) . ')'; } ?></div><div class="imagecontainer"><img width="640" height="640" src="<?php echo CLOUDPREFIX . 'album_art_640/' . htmlentities($release['image'], ENT_QUOTES); ?>" alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>"></div><div class="title-container"><h2><?php
if ($now < $releaseDate) {
	echo 'Releasing ' . htmlspecialchars($releaseDateString);
} else {
	echo 'Download and stream now';
} ?></h2><div class="requires-js"><?php
if ($has_radio_edit && $has_explicit) { ?> <div class="switch"> <input type="radio" class="switch-input" name="view2" value="dirty" id="dirty"  <?php if ($is_explicit) { echo 'checked'; } ?>> <label for="dirty" class="switch-label switch-label-off"  <?php
	if (!$is_explicit) {
		echo 'onclick="window.location=\'' . baseURL() . '/link/' 
			. htmlentities($release['slug'], ENT_QUOTES) 
			. '\'"'; 
	} ?> >Explicit</label> <input type="radio" class="switch-input" name="view2" value="clean" id="clean"  <?php if (!$is_explicit) { echo 'checked'; } ?>> <label for="clean" class="switch-label switch-label-on"  <?php
	if ($is_explicit) {
		echo 'onclick="window.location=\'' . baseURL() . '/link/' 
			. htmlentities($release['slug'] . '-radio-edit', ENT_QUOTES) 
			. '\'"'; 
	} ?> >Radio Edit</label> <span class="switch-selection"></span> </div> <?php } ?> </div><div class="js-hidden"><?php
if ($has_radio_edit && $has_explicit) { ?> <?php
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
} ?> </div></div><div class="service-container"><?php if ($release['apple_music_album']) { ?> <div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($release['apple_music_album'], ENT_QUOTES); ?>?app=itunes&amp;at=1000lKSp"><img src="../svg/page_link/itunes.svg" alt="iTunes"><span class="play"><?php echo ($now < $releaseDate) ? 'Pre-order' : 'Download'; ?></span></a></div> <?php } if ($release['apple_music_album'] && ($now >= $releaseDate)) { ?> <div class="service"><a href="https://geo.itunes.apple.com/us/album/<?php echo htmlentities($release['apple_music_album'], ENT_QUOTES); ?>?mt=1&app=music&amp;at=1000lKSp"><img src="../svg/page_link/apple-music.svg" alt="iTunes"><span class="play">Play</span></a></div> <?php } if ($release['spotify_track']) { ?> <div class="service"><a href="https://play.spotify.com/track/<?php echo htmlentities($release['spotify_track'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#spotify-text"/></svg><span class="play">Play</span></a></div> <?php } if ($release['spotify_album'] && !$release['spotify_track']) { ?> <div class="service"><a href="https://play.spotify.com/album/<?php echo htmlentities($release['spotify_album'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#spotify-text"/></svg><span class="play">Play</span></a></div> <?php } if ( (!$release['spotify_album']) && (!$release['spotify_track']) &&$release['spotify_presave_url']) { ?> <div class="service"><a rel="nofollow" href="<?php echo htmlentities($release['spotify_presave_url'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#spotify-text"/></svg><span class="play">Pre-save</span></a> <div style="padding-left:5em;font-size:80%;color:gray"><?php 	if ($now >= $releaseDate) { ?> <div><b>Direct spotify link coming soon!</b></div> <?php	} ?> This step takes you to our DistroKid.com page to continue. You will be asked to log into your Spotify account.</div> </div><?php } if ($now >= $releaseDate) { ?> <?php 	if ($release['amazon_dp']) { ?> <div class="service"><a href="https://www.amazon.com/dp/<?php echo htmlentities($release['amazon_dp'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#amazon-music"/></svg><span class="play">Play</span></a></div> <?php } if ($release['youtube_music_v']) { ?> <div class="service"><a href="https://music.youtube.com/watch?v=<?php echo htmlentities($release['youtube_music_v'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#youtube-music"/></svg><span class="play">Play</span></a></div> <?php } if ($release['youtube_music_MPRE'] && !$release['youtube_music_v']) { ?> <div class="service"><a href="https://music.youtube.com/browse/<?php echo htmlentities($release['youtube_music_MPRE'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#youtube-music"/></svg><span class="play">Play</span></a></div> <?php } if ($release['bandcamp_path']) { ?> <div class="service"><a href="https://lorenzowoodmusic.bandcamp.com/<?php echo htmlentities($release['bandcamp_path'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#bandcamp"/></svg><span class="play">Download</span></a> <?php 		if ($release['bandcamp_blurb_url']) { ?> <div style="padding-left:5em;margin-top:-20px;font-size:80%"><a style="text-decoration:underline!important" href="<?php echo htmlentities($release['bandcamp_blurb_url'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($release['bandcamp_blurb']); ?></a></div> <?php 		} ?> </div> <?php } if ($release['soundcloud_path']) { ?> <div class="service"><a href="https://soundcloud.com/<?php echo htmlentities($release['soundcloud_path'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#soundcloud"/></svg><span class="play">Play</span></a></div> <?php } if ($release['deezer_track']) { ?> <div class="service"><a href="https://www.deezer.com/us/track/<?php echo htmlentities($release['deezer_track'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#deezer"/></svg><span class="play">Play</span></a></div> <?php } if ($release['deezer_album'] && !$release['deezer_track']) { ?> <div class="service"><a href="https://www.deezer.com/us/album/<?php echo htmlentities($release['deezer_album'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#deezer"/></svg><span class="play">Play</span></a></div> <?php } if ($release['iheartradio_songs']) { ?> <div class="service"><a href="https://www.iheart.com/artist/lorenzo-wood-32159981/songs/<?php echo htmlentities($release['iheartradio_songs'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#iheartradio"/></svg><span class="play">Play</span></a></div> <?php } if ($release['tidal_track']) { ?> <div class="service"><a href="https://listen.tidal.com/track/<?php echo htmlentities($release['tidal_track'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#tidal"/></svg><span class="play">Play</span></a></div> <?php } if ($release['tidal_album'] && !$release['tidal_track']) { ?> <div class="service"><a href="https://listen.tidal.com/album/<?php echo htmlentities($release['tidal_album'], ENT_QUOTES); ?>"><svg><use xlink:href="/svg/page_link.svg#tidal"/></svg><span class="play">Play</span></a></div> <?php } if ($release['cd_url']) { ?> <div class="service"><a href="<?php echo htmlentities($release['cd_url'], ENT_QUOTES); ?>"><img src="/img/cd100.png" alt="Buy CD"><span class="play">Buy</span></a></div> <?php } ?> <?php } // end if now > release date ?></div><?php if (strlen($descriptionText) > 0) { echo '<div class="blurb">' . $descriptionHTML . '</div>'; } ?></div></main><footer><p><b>Copyright © 2017-2020 Lorenzo Wood</b><span class="widespace"></span><span class="widespace"></span> <a class="contact-link" href="/contact/">Contact us</a><span class="widespace"></span> <a class="press-link" href="/press/">Press & Media</a></p><p class="js-warning"><noscript>JavaScript is disabled in your browser; please enable it to see missing content. </noscript></p></footer><script>for(var iOS=/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream,youtube=document.querySelectorAll(".youtube-player"),i=0;i<youtube.length;i++){var code=youtube[i].dataset.code,title=youtube[i].dataset.title,caption=youtube[i].dataset.caption,linking=youtube[i].dataset.linking;if(iOS&&(linking=!0),0){var iframe=document.createElement("iframe");iframe.setAttribute("allowfullscreen",""),iframe.setAttribute("src","https://www.youtube.com/embed/"+code),youtube[i].appendChild(iframe)}else{var prefix="https://img.youtube.com/vi/",source="https://res.cloudinary.com/avfivcfiwkvgmspufqrh/image/youtube/"+code+".jpg",image=new Image;image.src=source,image.id="video-"+code,image.setAttribute("loading","lazy"),image.alt="YouTube thumbnail",image.addEventListener("load",void youtube[i].appendChild(image)),youtube[i].addEventListener("click",(function(){var e=this.dataset.code;if(linking)window.location.href="https://www.youtube.com/watch?v="+e;else{var t=document.createElement("iframe");t.setAttribute("frameborder","0"),t.setAttribute("allowfullscreen",""),t.setAttribute("src","https://www.youtube.com/embed/"+e+"?rel=0&showinfo=0&autoplay=1"),this.innerHTML="",this.appendChild(t)}}));var play=document.createElement("div");if(play.setAttribute("class","play-button"),youtube[i].appendChild(play),void 0!==title){var t=document.createElement("div");t.setAttribute("class","title"),t.innerText=title,youtube[i].appendChild(t)}}if(caption){var captionDiv=document.createElement("p");captionDiv.innerText=caption,youtube[i].insertAdjacentElement("afterend",captionDiv)}}var digitCharacters="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz#$%*+,-.:;=?@[]^_{|}~".split(""),sRGBToLinear=function(n){var t=n/255;return t<=.04045?t/12.92:Math.pow((t+.055)/1.055,2.4)},linearTosRGB=function(n){var t=Math.max(0,Math.min(1,n));return t<=.0031308?Math.round(12.92*t*255+.5):Math.round(255*(1.055*Math.pow(t,1/2.4)-.055)+.5)},sign=function(n){return n<0?-1:1},signPow=function(n,t){return sign(n)*Math.pow(Math.abs(n),t)};var decode83=function(r){for(var t=0,e=0;e<r.length;e++){var o=r[e],n;t=83*t+digitCharacters.indexOf(o)}return t},__extends=this&&this.__extends||function(){var r=function(t,e){return(r=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(r,t){r.__proto__=t}||function(r,t){for(var e in t)t.hasOwnProperty(e)&&(r[e]=t[e])})(t,e)};return function(t,e){function o(){this.constructor=t}r(t,e),t.prototype=null===e?Object.create(e):(o.prototype=e.prototype,new o)}}(),ValidationError=function(r){function t(t){var e=r.call(this,t)||this;return e.name="ValidationError",e.message=t,e}return __extends(t,r),t}(Error),validateBlurhash=function(r){if(!r||r.length<6)throw new ValidationError("The blurhash string must be at least 6 characters");var t=decode83(r[0]),e=Math.floor(t/9)+1,o=t%9+1;if(r.length!==4+2*o*e)throw new ValidationError("blurhash length mismatch: length is "+r.length+" but it should be "+(4+2*o*e))},isBlurhashValid=function(r){try{validateBlurhash(r)}catch(r){return{result:!1,errorReason:r.message}}return{result:!0}},decodeDC=function(r){var t,e=r>>8&255,o=255&r;return[sRGBToLinear(r>>16),sRGBToLinear(e),sRGBToLinear(o)]},decodeAC=function(r,t){var e=Math.floor(r/361),o=Math.floor(r/19)%19,n=r%19,a;return[signPow((e-9)/9,2)*t,signPow((o-9)/9,2)*t,signPow((n-9)/9,2)*t]},decode=function(r,t,e,o){validateBlurhash(r),o|=1;for(var n=decode83(r[0]),a=Math.floor(n/9)+1,i=n%9+1,s,h=(decode83(r[1])+1)/166,c=new Array(i*a),u=0;u<c.length;u++)if(0===u){var l=decode83(r.substring(2,6));c[u]=decodeDC(l)}else{var l=decode83(r.substring(4+2*u,6+2*u));c[u]=decodeAC(l,h*o)}for(var d=4*t,f=new Uint8ClampedArray(d*e),v=0;v<e;v++)for(var g=0;g<t;g++){for(var _=0,p=0,w=0,B=0;B<a;B++)for(var u=0;u<i;u++){var b=Math.cos(Math.PI*g*u/t)*Math.cos(Math.PI*v*B/e),y=c[u+B*i];_+=y[0]*b,p+=y[1]*b,w+=y[2]*b}var M=linearTosRGB(_),m=linearTosRGB(p),P=linearTosRGB(w);f[4*g+0+v*d]=M,f[4*g+1+v*d]=m,f[4*g+2+v*d]=P,f[4*g+3+v*d]=255}return f};var blurhashData = '<?php echo htmlspecialchars($release['blurhash']); ?>';if(blurhashData){var pixels=decode(blurhashData,32,32);if(pixels){var outputCanvas=document.getElementById("outputCanvas"),blurhashImage=document.getElementById("blurhashImage"),ctx=outputCanvas.getContext("2d"),imageData=new ImageData(pixels,32,32);ctx.putImageData(imageData,0,0);var dataUrl=outputCanvas.toDataURL();blurhashImage.src=dataUrl}}var backgroundBlur=document.getElementById("background-blur"),blurImage=new Image;blurImage.onload=function(){setTimeout((function(){var e;document.getElementById("blurhashImage").style.display="none",blurImage.style.display="block"}),0)},blurImage.style.display="none",blurImage.src="<?php $blur = CLOUDPREFIX . ($release['image_blurred'] ? 'blurred_100/' . $release['image_blurred'] : 'album_art_640/' . htmlentities($release['image'])); echo htmlentities($blur, ENT_QUOTES); ?>",blurImage.alt="<?php echo htmlentities($release['title'], ENT_QUOTES); ?>",backgroundBlur.appendChild(blurImage);</script><?php if ($genBlurhash) { ?><script>var encode83=function(a,o){for(var t="",r=1;r<=o;r++){var e=Math.floor(a)/Math.pow(83,o-r)%83;t+=digitCharacters[Math.floor(e)]}return t},bytesPerPixel=4,multiplyBasisFunction=function(a,o,t,r){for(var e=0,n=0,i=0,h=o*bytesPerPixel,l=0;l<o;l++)for(var c=0;c<t;c++){var f=r(l,c);e+=f*sRGBToLinear(a[bytesPerPixel*l+0+c*h]),n+=f*sRGBToLinear(a[bytesPerPixel*l+1+c*h]),i+=f*sRGBToLinear(a[bytesPerPixel*l+2+c*h])}var s=1/(o*t);return[e*s,n*s,i*s]},encodeDC=function(a){var o,t,r;return(linearTosRGB(a[0])<<16)+(linearTosRGB(a[1])<<8)+linearTosRGB(a[2])},encodeAC=function(a,o){var t,r,e;return 19*Math.floor(Math.max(0,Math.min(18,Math.floor(9*signPow(a[0]/o,.5)+9.5))))*19+19*Math.floor(Math.max(0,Math.min(18,Math.floor(9*signPow(a[1]/o,.5)+9.5))))+Math.floor(Math.max(0,Math.min(18,Math.floor(9*signPow(a[2]/o,.5)+9.5))))},encode=function(a,o,t,r,e){if(r<1||r>9||e<1||e>9)throw new ValidationError("BlurHash must have between 1 and 9 components");if(o*t*4!==a.length)throw new ValidationError("Width and height must match the pixels array");for(var n=[],i=function(e){for(var i=function(r){var i=0==r&&0==e?1:2,h=multiplyBasisFunction(a,o,t,(function(a,n){return i*Math.cos(Math.PI*r*a/o)*Math.cos(Math.PI*e*n/t)}));n.push(h)},h=0;h<r;h++)i(h)},h=0;h<e;h++)i(h);var l=n[0],c=n.slice(1),f="",s,M;if(f+=encode83(r-1+9*(e-1),1),c.length>0){var u=Math.max.apply(Math,c.map((function(a){return Math.max.apply(Math,a)}))),d=Math.floor(Math.max(0,Math.min(82,Math.floor(166*u-.5))));M=(d+1)/166,f+=encode83(d,1)}else M=1,f+=encode83(0,1);return f+=encode83(encodeDC(l),4),c.forEach((function(a){f+=encode83(encodeAC(a,M),2)})),f};</script><script>var sourceImageElement = document.getElementById("blurry");
var componentXElement = document.getElementById("x");
var componentYElement = document.getElementById("y");
var blurhashElement = document.getElementById("blurhash");
var originalCanvas = document.getElementById("originalCanvas");
var outputCanvas = document.getElementById("outputCanvas");

function render() {
	var blurhash = blurhashElement.value;
	if (blurhash) {
		var pixels = decode(blurhash, 32, 32);
		if (pixels) {
			var ctx = outputCanvas.getContext("2d");
			var imageData = new ImageData(pixels, 32, 32);
			ctx.putImageData(imageData, 0, 0);


			dataUrl = outputCanvas.toDataURL();
			sourceImageElement.src = dataUrl;
		}
	}
}

// Re-render if we change the blurhash value
blurhashElement.addEventListener("keyup", render);

function clamp(n) {
	return Math.min(9, Math.max(1, n));
}

function doEncode() {
	var componentX = clamp(+componentXElement.value);
	var componentY = clamp(+componentYElement.value);

	var ctx_1 = originalCanvas.getContext("2d");
	var imageData = ctx_1.getImageData(0, 0, originalCanvas.width, originalCanvas.height);
	var blurhash = encode(imageData.data, imageData.width, imageData.height, componentX, componentY);
	blurhashElement.value = blurhash;

	// Immediately render now that we have a blurhash value
	render();
};

componentXElement.addEventListener("change", doEncode);
componentYElement.addEventListener("change", doEncode);

var loaded = false;

// As soon as real background image is loaded, put it into the canvas.
sourceImageElement.onload = function () {
	if (!loaded) {
		var ctx_1 = originalCanvas.getContext("2d");

		ctx_1.drawImage(sourceImageElement, 0, 0, originalCanvas.width, originalCanvas.height);

		doEncode();

		loaded = true;
	}
}; </script><?php } ?><?php
$db->close();
?><script>document.documentElement.className = document.documentElement.className.replace("no-js","js");!function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.svg4everybody=b()}):"object"==typeof exports?module.exports=b():a.svg4everybody=b()}(this,function(){/*! svg4everybody v2.0.0 | github.com/jonathantneal/svg4everybody */
function a(a,b){if(b){var c=!a.getAttribute("viewBox")&&b.getAttribute("viewBox"),d=document.createDocumentFragment(),e=b.cloneNode(!0);for(c&&a.setAttribute("viewBox",c);e.childNodes.length;)d.appendChild(e.firstChild);a.appendChild(d)}}function b(b){b.onreadystatechange=function(){if(4===b.readyState){var c=document.createElement("x");c.innerHTML=b.responseText,b.s.splice(0).map(function(b){a(b[0],c.querySelector("#"+b[1].replace(/(\W)/g,"\\$1")))})}},b.onreadystatechange()}function c(c){function d(){for(var c;c=e[0];){var j=c.parentNode;if(j&&/svg/i.test(j.nodeName)){var k=c.getAttribute("xlink:href");if(f&&(!g||g(k,j,c))){var l=k.split("#"),m=l[0],n=l[1];if(j.removeChild(c),m.length){var o=i[m]=i[m]||new XMLHttpRequest;o.s||(o.s=[],o.open("GET",m),o.send()),o.s.push([j,n]),b(o)}else a(j,document.getElementById(n))}}}h(d,17)}c=c||{};var e=document.getElementsByTagName("use"),f="shim"in c?c.shim:/\bEdge\/12\b|\bTrident\/[567]\b|\bVersion\/7.0 Safari\b/.test(navigator.userAgent)||(navigator.userAgent.match(/AppleWebKit\/(\d+)/)||[])[1]<537,g=c.validate,h=window.requestAnimationFrame||setTimeout,i={};f&&d()}return c});svg4everybody();</script></body></html>