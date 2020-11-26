<?php

$MISSING_SENDER			= "You did not enter your email address, so your message was not sent.";
$MISSING_MESSAGE		= "You did not enter a message, so no message was sent.";
$UNABLE_TO_SEND			= "Unable to send mail message.";
$MESSAGE_SENT			= "Your message was successfully sent via email.";
$RETURN_TO_FORMAT		= "Return to %@";

require_once('classes/class.housekeeping.php');

// parameters: e = error message, r = return URL; t = website name; d = design name

$status = housekeeping::isGet('e') ? $UNABLE_TO_SEND : $MESSAGE_SENT;

$returnURL = housekeeping::get('r');
if (!preg_match("~^https?://~i", $url))
{
	$returnURL = '';	// bogus, so eliminate.  Avoid XSS tricks!
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>
			<?php echo htmlspecialchars($title); ?>
		</title>
<?php
if (!housekeeping::isGet('e') && ($_SERVER["SCRIPT_URI"] != $returnURL) && !empty($returnURL) ) {
?>
<meta http-equiv="refresh" content="7;url=<?php echo htmlspecialchars($returnURL, ENT_QUOTES); ?>">
<?php
}
?>
		<meta name="robots" content="none" />
	</head>
	<body>
		<h2><span class="in"><?php echo htmlspecialchars($status); ?></span></h2>
<p>
<?php
if (housekeeping::isGet('e'))
{
	$message = housekeeping::getraw('e');
	$htmlMessage = htmlspecialchars($message);
	$htmlMessage = str_replace("\n", "\n<br \>\n", $htmlMessage);
	echo $htmlMessage;
}
else
{
?>
		<?php /* echo $MESSAGE_SENT; */ ?>
<?php
}
?>
</p>

<?php
if (!empty($returnURL)) {
	echo "<p>\n";

	$siteTitleOrWebsite = htmlspecialchars($t);
	$format = htmlspecialchars($RETURN_TO_FORMAT);
	$returnToSite = str_replace('%@', '<b>' . $siteTitleOrWebsite . '</b>', $format);

	echo '<a href="' . htmlspecialchars($returnURL, ENT_QUOTES) . '">' . $returnToSite . '</a>' . "\n";
	echo "</p>\n";
}
else
{
?>
<p>Use your browser's “back” button to return to website.</p>
<?php
}
?>

	</body>
</html>
