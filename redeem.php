<?php

error_log("TEMPORARILY ALLOWING THIS PAGE TO BE ACCESSED BY GET");
//if ($_SERVER['REQUEST_METHOD'] != 'POST') die;	// really this shouldn't come from a GET

$inputs = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST : $_GET;

require_once('classes.php');
$iOSDevice = false;	// or set to a non-false text value
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match("/(\\(iPod|\\(iPhone|\\(iPad)/", $userAgent, $matches)) {
	$iOSDevice = substr($matches[1], 1);
}
$code = isset($inputs['code']) ? htmlspecialchars($inputs['code']) : '';
$email = isset($inputs['email']) ? htmlspecialchars($inputs['email']) : '';

$db = new DowncodeDB();

$album = $db->findAndRedeemAlbumFromCode($code, $iOSDevice);
$tracks = $db->tracksOfAlbumID($album['ID']);

?><!DOCTYPE html><html lang="en-us"><head><link rel="stylesheet" href="redeem.css" /></head><body><?php if (!$album) { ?><p>Sorry, but the code you used is not valid, or has already been redeemed.
Please double-check the code and try again. If you are sure this is an
error, please contact webmaster@lorenzowoodmusic.com with the code that you used.</p><?php die; } ?><div id="redeem_console"><h1><?php echo htmlspecialchars($album['title']); ?></h1><p><?php echo htmlspecialchars($album['description']); ?></p><div id="cover-art-container"><div id="cover-art"><img amplitude-song-info="cover_art_url" amplitude-main-song-info="true"></div></div><form id="downloader"><input type="hidden" id="a_input" name="a" value="<?php echo $album['ID']; ?>"><input type="hidden" id="c_input" name="c" value="<?php echo $code; ?>"><div id="time-container"><span class="current-time"><span class="amplitude-current-minutes" amplitude-main-current-minutes="true"></span>:<span class="amplitude-current-seconds" amplitude-main-current-seconds="true"></span></span><input class="amplitude-song-slider" type="range" amplitude-main-song-slider="true" step=".1"><span class="duration"><span class="amplitude-duration-minutes" amplitude-main-duration-minutes="true"></span>:<span class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span></span></div><div id="central-controls"><div id="central-controls-grouped"><div class="amplitude-prev" id="previous"></div><div class="amplitude-play-pause" id="play-pause" amplitude-main-play-pause="true"></div><div class="amplitude-next" id="next"></div></div></div><div id="meta-container"><span class="song-name" amplitude-song-info="name" amplitude-main-song-info="true"></span><div class="song-artist-album"><span amplitude-song-info="artist" amplitude-main-song-info="true"></span><span amplitude-song-info="album" amplitude-main-song-info="true"></span></div></div><?php
if (!$iOSDevice) {
?>
<?php
}
?><div id="list-container"><span id="format-container"><?php
if (!$iOSDevice) {
	echo 'Format: ';
	echo '<select id="f_input" name="f">' . PHP_EOL;
	$formats = $db->formats();
	foreach ($formats as $format) {
		echo '<option value="' . $format['ID'] . '"';
		echo ' data-extension="' . $format['extension'] . '"';
		// not really used, but maybe a script could populate something?
		if (isset($album['formatID']) && $album['formatID'] == $format['ID']) {
			echo ' data-previous-format="' . $album['formatID'] . '" selected';
		}
		else if (!isset($album['formatID'])
			&& isset($format['platform_preg'])
			&& preg_match($format['platform_preg'], $userAgent, $matches)) {
			echo ' data-platform="' . $matches[0] . '" selected';
		}
		echo '>' . htmlspecialchars($format['description']) . '</option>' . PHP_EOL;
	}
	echo '</select>' . PHP_EOL;
}
?></span><?php
	if (!$iOSDevice) {
?><span class="song-download"><button class="download" type="button" name="t" value="0">Download all</button></span><?php
}
$trackIndex = 0;
foreach ($tracks as $track) {
?><div class="song amplitude-song-container amplitude-play-pause" amplitude-song-index="<?php echo $trackIndex++; ?>"><div class="song-now-playing-icon-container"><div class="play-button-container"></div><div class="now-playing"></div></div><div class="song-meta-data"><span class="track-number"><?php echo htmlspecialchars($track['trackNumber']); ?>.</span><span class="song-title"><?php echo htmlspecialchars($track['title']); ?></span></div><span class="song-duration"><?php echo htmlspecialchars($track['duration']); ?></span><?php
	if (!$iOSDevice) {
?><div class="song-download"><button class="download" type="button" name="t" value="<?php echo $track['ID']; ?>">Download</button></div><?php
	}
?></div><?php
}
?></div></form></div><script src="https://code.jquery.com/jquery-3.3.1.min.js"></script><script src="https://cdn.jsdelivr.net/npm/amplitudejs@3.2.3/dist/amplitude.js"></script><?php error_log("Should include minimized amplitudejs"); ?><script>$('button.download').click(function (evt) {
	evt.preventDefault();

	var button = $(evt.target);
	// Build a form
	// Based on this: https://gist.github.com/DavidMah/3533415
	var form = $('<form>').attr('action', 'download.php').attr('method', 'post');
	form.append($("<input>").attr('type', 'hidden').attr('name', 't').attr('value', button.attr('value')));
	form.append($("<input>").attr('type', 'hidden').attr('name', 'a').attr('value', $('#a_input').val()));
	form.append($("<input>").attr('type', 'hidden').attr('name', 'c').attr('value', $('#c_input').val()));
	form.append($("<input>").attr('type', 'hidden').attr('name', 'f').attr('value', $('#f_input').val()));
	form.appendTo('body').submit().remove();

	// Disable the downloading button
	button.prop("disabled",true);
	// Dim the download console for just a second so we know that something is happening when we click download. Good or dumb idea?
	$("#redeem_console").parent().animate({
		opacity: 0.5,
		}, 100, function() {
		setTimeout(function(){
			$('#redeem_console').parent().css({"opacity":"1.0"});
			button.prop("disabled",false); // and restore the button
		}, 900);
	});
});

Amplitude.init({
	"songs": [
	<?php foreach ($tracks as $track) { ?>
		{
			"name": "<?php echo htmlspecialchars($track['title']); ?>",
			"album": "<?php echo htmlspecialchars($album['title']); ?>",
			"artist": "<?php echo htmlspecialchars($album['artist']); ?>",
			"url": "amplitude_tracks/<?php echo htmlspecialchars($track['fileBase']); ?>.mp3",
			"cover_art_url": "album_art/<?php echo htmlspecialchars($album['imageName']); ?>",
		},
	<?php } ?>
	],
});

/*
	Ensure that on mouseover, CSS styles don't get messed up for active songs.
*/
$('.song').on('mouseover', function(){
	$(this).css('background-color', '#00A0FF');
	$(this).find('.song-meta-data *').css('color', '#FFFFFF');

	if( !$(this).hasClass('amplitude-active-song-container') ){
		$(this).find('.play-button-container').css('display', 'block');
	}

	$(this).find('.song-duration').css('color', '#FFFFFF');
});

/*
	Ensure that on mouseout, CSS styles don't get messed up for active songs.
*/
$('.song').on('mouseout', function(){
	$(this).css('background-color', '');
	$(this).find('.song-meta-data *').css('color', '');
	$(this).find('.play-button-container').css('display', 'none');
	$(this).find('.song-duration').css('color', '');
});

/*
	Show and hide the play button container on the song when the song is clicked.
*/
$('.song').on('click', function(){
	$(this).find('.play-button-container').css('display', 'none');
});

if (window.DeviceMotionEvent==undefined) {
	$('.song-download').hide();
}
</script></body></html>
<?php
$db->close();
?>