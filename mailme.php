<?php

$recipient = "dan@gigliwood.com";

if ( 0 == strcmp('GET',$_SERVER['REQUEST_METHOD'])  )

{
	http_response_code(405);
	echo "You should be accessing this via POST not GET.";
	exit();
}

require_once('classes/class.housekeeping.php');
require_once('classes/class.Encoding.php');		// Force into UTF-8

$MISSING_SENDER			= "You did not enter your email address, so your message was not sent.";
$MISSING_MESSAGE		= "You did not enter a reasonably long message, so no message was sent.";
$MISSING_DESTINATION	= "Can't send message -- the creator of this web page did not specify a valid email address for receiving messages.";
$MESSAGE_SENT			= "Your message was successfully sent via email.";


function extract_emails_from($string){
	preg_match_all("/[\+\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
	return $matches[0];
}

// from http://www.phpbuilder.com/columns/ian_gilfillan20060412.php3?page=2
function containsNewlines($str_to_test) {
	return (preg_match("/(%0A|%0D|\\n+|\\r+)/i", $str_to_test) != 0);
}

function check_email_address($email)  // convenience to get to email validator
{
	$validator = new EmailAddressValidator;
	return ($validator->check_email_address($email));
}


// USED FORM ELEMENTS A CDEF H   LMN  QRST V XYZ


/*
ob_start();
phpinfo();
$out1 = ob_get_contents();
ob_end_clean();
error_log($out1);
*/

$devMode	= housekeeping::isPost('devm');	// secret developer mode -- if set we can issue warnings and so forth

if ($devMode)
{
	print_r($_POST);
	echo "\n\n\n";
	print_r($_SERVER);
}


$fromEmail	= housekeeping::post('e', '');	// from email

$subject	= housekeeping::post('s', '');	// subject
$message	= housekeeping::postraw('m', '');	// message .... textarea
$name		= housekeeping::post('n', '');	// from name


$iehack	= housekeeping::post('iehack', '');	// Hopefully force form into being UTF-8
// if ($iehack) error_log("mailme.php: iehack = $iehack (unconverted, should be E2 98 95)");

$subject	= Encoding::toUTF8($subject);
$message	= Encoding::toUTF8($message);
$name		= Encoding::toUTF8($name);

$subject 	= html_entity_decode($subject, ENT_QUOTES|ENT_HTML5, 'UTF-8'); 	  // case 224584 ...
$message 	= html_entity_decode($message, ENT_QUOTES|ENT_HTML5, 'UTF-8');
$name    	= html_entity_decode($name, ENT_QUOTES|ENT_HTML5, 'UTF-8');

/* I think a weakness though is that if the posting form is, say, ISO-8859-1 like the russian website in case 224584 is,
then we are getting a mix of 8859 Latin and the UTF-8 which we really need this to be here.  So really we need to somehow
*first* convert the data into UTF-8, but that means we have to even know what the encoding was.  Urgh.
*/


$message = str_replace("\r\n", "\n", $message);		// try to get rid of \r's
$message = str_replace("\r", "\n", $message);


$suspectedSpam = false;			// This might be turned on in a couple of cases; disable form submission from that IP address.


// key of 'v' is old-style blowfish
// key of 'vv' is newer 3DES
// key of 'v1' is newest DES (which we are using now to make one less strong-encryption issue to report)




$fromEmails = extract_emails_from($fromEmail);
																	// Also: 'x' is the name of the 'Send' button
$honeypot1		= housekeeping::post('subject', '');
$honeypot2		= housekeeping::post('message', '');

// EXTRA GOODIES, NOT IN THE SANDVOX UI:

$successReturn = housekeeping::post('r', '');	// where to return.
$successReturnHash = housekeeping::post('h', '');	// #section where to return. 

// NOTE: WE NEED TO EXTRACT \t \n BEFORE CALLING STRIPSLASHES.

$footer		= housekeeping::post('f', '');	// footer text, appended below main text
$footer		= Encoding::toUTF8($footer);
$footer   	= html_entity_decode($footer, ENT_QUOTES|ENT_HTML5, 'UTF-8');
$footer		= str_replace('\t', "\t", $footer);
$footer		= str_replace('\n', "\n", $footer);

$delim		= housekeeping::postraw('l', ': ');	// delimeter (with \t \n OK)
$delim		= str_replace('\t', "\t", $delim);
$delim		= str_replace('\n', "\n", $delim);
$delimUTF8	= Encoding::toUTF8($delim);
$delimUTF8 	= html_entity_decode($delimUTF8, ENT_QUOTES|ENT_HTML5, 'UTF-8');

$prefix		= housekeeping::post('y', '');	// subject prefix
$prefix		= Encoding::toUTF8($prefix);
$prefix   	= html_entity_decode($prefix, ENT_QUOTES|ENT_HTML5, 'UTF-8');

$suffix		= housekeeping::post('z', '');	// subject suffix
$suffix		= Encoding::toUTF8($suffix);
$suffix   	= html_entity_decode($suffix, ENT_QUOTES|ENT_HTML5, 'UTF-8');

$errorReturn = housekeeping::post('q', '');	// URL to return to (after landing page) if there was an error


$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$referer = str_replace("\n", ' ', $referer);
$referer = str_replace("\r", ' ', $referer);
if (0 === strpos($referer, '----'))
{
	$referer = '';		// somehow referer is being sent as -------------------------------------------------  -- case 40266
}

$errorString = '';		// if we put a message here, it will show on the resulut page.

// Look for extra POST parameters and insert them into the message.
$fields = '';

foreach($_POST as $postKey => $postValue)
{
	if (strlen($postKey) > 1 && $postKey != 'subject' && $postKey != 'message' && $postKey != 'v' && $postKey != 'vv' && $postKey != 'v1' && $postKey != 'iehack')	// ignore 1-char keys and honeypots and hack
	{
		$postkeyFriendly = Encoding::toUTF8($postKey);
		$postkeyFriendly = html_entity_decode($postkeyFriendly, ENT_QUOTES|ENT_HTML5, 'UTF-8');
		$postkeyFriendly = str_replace('_', ' ', $postkeyFriendly);		// keys come in with underscores, so convert to spaces
		if ( substr($postkeyFriendly, -strlen($delimUTF8)) == substr($delimUTF8, 0, strlen($delimUTF8)) )
		{
			$postkeyFriendly = substr($postkeyFriendly, 0, -strlen($delimUTF8));
		}

		$postValue = Encoding::toUTF8($postValue);
		$postValue = html_entity_decode($postValue, ENT_QUOTES|ENT_HTML5, 'UTF-8');

		$keyPlusValue = $postkeyFriendly . $delimUTF8 . $postValue . "\n";	// e.g. key tab value
		$fields .= $keyPlusValue;
	}
}

$message = "From: $name <$fromEmail>\n\n\n" . $message;

if (!empty($fields)) {
	$message = $fields . "\n" . $message;
}

if (!empty($footer)) {
	$message .= "\n\n\n\n\n---------------------------------------------------\n$footer";
}

if (		containsNewlines($recipient)
			||	containsNewlines($subject)
			||	containsNewlines($fromEmail)
			||	containsNewlines($name) )
{
	error_log( "mailme.php: NEWLINE INJECTION in one of these:\n\nrecipient='$recipient'\nsubject='$subject'\nfromEmail='$fromEmail'\nname='$name'\n\n" . print_r($_POST, 1) . "\n\n\n" . print_r($_SERVER, 1) . "\n\n\n" . print_r($recipEmails, 1), 1, 'server@karelia.com' );

	$suspectedSpam = true;	// newlines in these values mean likely spam.
}
else if (!empty($honeypot1) || !empty($honeypot2))
{
	// I want to see what got posted and how often....
	// error_log( "mailme.php: HONEYPOT ACTIVATED!\n\n\n" . print_r($_POST, 1) . "\n\n\n" . print_r($_SERVER, 1) . "\n\n\n" . print_r($recipient, 1), 1, 'server@karelia.com' );

	$suspectedSpam = true;
}
else if ( empty($fromEmail) || 0 == count($fromEmails) )
{
	$errorString = $MISSING_SENDER;
}
else if ( empty($subject) && strlen($message) < 25 )
{
	$errorString = $MISSING_MESSAGE;
}
else		// Everything looks OK, proceed
{
	if (!$suspectedSpam)		// Make sure we didn't just prevent it, above
	{
		// Fallback subject
		if (empty($subject))
		{
			$subject = $FALLBACK_SUBJECT;
		}
		if (!empty($prefix))
		{
			$subject = "$prefix $subject";
		}
		if (!empty($suffix))
		{
			$subject = "$subject $suffix";
		}

		if (empty($name))
		{
			$emailOrName = $fromEmails[0];
		}
		else
		{
			$emailOrName = $name;
		}
	}

	// No "From" header — this seems to stop the script from working, at least on NearlyFreeSpeech.
	$headers = 'Reply-To: ' . $fromEmails[0] . "\r\n";

	$sent = mail($recipient, $subject, $message, $headers);

	if(!$sent)
	{
		$errorString = "Mail could not be sent.";
	}
}


$redirectSite = empty($successReturn) ? "/mailsent.php" : $successReturn;

if (!empty($errorString))		// was there an error?
{
	$redirectSite .= "?e=" . urlencode($errorString);

	if (!empty($errorReturn))		// did we specify an error site?  If so, we'll go there instead.
	{
		$successReturn = $errorReturn;	// use errorReturn instead of successReturn
	}
}
else {
	$redirectSite .= "?msg=" . urlencode($MESSAGE_SENT);
}
if (!empty($successReturnHash)) {
	$redirectSite .= '#' . $successReturnHash;
}

header("Location: $redirectSite");

?>
