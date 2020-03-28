<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') die;	// really this shouldn't come from a GET

$inputs = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST : $_GET;

require_once('classes/downcode.php');
$iOSDevice = false;	// or set to a non-false text value
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match("/(\\(iPod|\\(iPhone|\\(iPad)/", $userAgent, $matches)) {
	$iOSDevice = substr($matches[1], 1);
	if ($iOSDevice) $iOSDevice = $inputs['album'] == '2938';	// verify! Look for for magic number
}
$code = isset($inputs['code']) ? htmlspecialchars($inputs['code']) : '';
$email = isset($inputs['email']) ? htmlspecialchars($inputs['email']) : '';

$db = new DowncodeDB();

$album = $db->findAndRedeemAlbumFromCode($code, $iOSDevice);
$tracks = $db->tracksOfAlbumID($album['ID']);

?><!DOCTYPE html><html lang="en-us"><head><meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]--></head><body><?php if (!$album) { ?><p class="warning">Sorry, but the code you used is not valid, or has already been redeemed.
Please double-check the code and try again. If you are sure this is an
error, please contact webmaster@lorenzowoodmusic.com with the code that you used.</p><?php die; } ?><div id="redeem_console"><h1><?php echo htmlspecialchars($album['title']); ?></h1><p><?php echo htmlspecialchars($album['description']); ?></p><div id="cover-art-container"><div id="cover-art"><img src="/album_art_384/<?php echo htmlspecialchars($album['imageName']); ?>" alt="<?php echo htmlspecialchars($album['title']); ?>"></div></div><form id="downloader"><input type="hidden" id="a_input" name="a" value="<?php echo $album['ID']; ?>"><input type="hidden" id="c_input" name="c" value="<?php echo $code; ?>"><?php
if ($iOSDevice) {
?><div class="warning">(Downloading not possible from an iOS device. Please download from a computer and sync to your <?php echo htmlspecialchars($iOSDevice); ?>.)</div><?php
}
?><div id="list-container"><div class="song"><?php
if (!$iOSDevice) {
	echo 'File Format: ';
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
?></div><div class="song"><div class="song-meta-data">&nbsp;</div><span class="song-duration">&nbsp;</span><?php
	if (!$iOSDevice) {	// don't output download, but just in case, it will be hidden by JS as well.
?><span class="song-download"><button class="download-button" type="button" name="t" value="0">Download all</button></span></div><div class="song">Individual Tracks:</div><?php
}
$trackIndex = 0;
foreach ($tracks as $track) {
?><div class="song"><div class="song-meta-data"><span class="track-number"><?php echo htmlspecialchars($track['trackNumber']); ?>.</span><span class="song-title"><?php echo htmlspecialchars($track['title']); ?></span></div><span class="song-duration"><?php echo htmlspecialchars($track['duration']); ?></span><?php
	if (!$iOSDevice) {
?><div class="song-download"><button class="download-button" type="button" name="t" value="<?php echo $track['ID']; ?>">Download</button></div><?php
	}
?></div><?php
}
?></div></form></div><script>$('button.download-button').click(function (evt) {
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
</script></body></html>
<?php
$db->close();
?>