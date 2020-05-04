<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

// contains tools used for cleaning up, validation, etc.
// an attempt to organize functions and avoiding "re-declaring" same functions on
// the same flow. It also could help lessen the overhead bandwith brought about by the
// previously mentioned re-declaration. Consequently, it would make php scripts cleaner
// and organized
class housekeeping {


	public static function trimFirst($string)	// gets the first line of a multi-line input and trims it. Really cleans the input!
	{
		$lines = explode("\n",$string);
		$string = $lines[0];
		$string = trim($string);
		return $string;
	}

	public static function testStringAsBoolean($string)
	{
		$result = TRUE;
   		$string = strtolower($string);
		if (empty($string)
			|| $string == 'no'
			|| $string == '0'
	   		|| $string == 'false'
			|| $string == 'f'
			|| $string == 'n'
		    )
		{
			$result = FALSE;
		}
		return $result;
	}

	// GET FUNCTIONS.  Use getraw for a textarea.
	public static function getraw($key, $default='')
	{
   		return isset ( $_GET[$key] ) ? $_GET[$key] : $default;
	}
	public static function get($key, $default='')
	{
   		return isset ( $_GET[$key] ) ? housekeeping::trimFirst($_GET[$key]) : $default;
	}
	public static function isGet($key)
	{
   		return isset ( $_GET[$key] ) ? housekeeping::testStringAsBoolean($_GET[$key]) : FALSE;
   	}

	// POST FUNCTIONS.  Use postraw for a textarea.
	public static function postraw($key, $default='')
	{
   		return isset ( $_POST[$key] ) ? $_POST[$key] : $default;
	}
	public static function post($key, $default='')
	{
   		return isset ( $_POST[$key] ) ? housekeeping::trimFirst($_POST[$key]) : $default;
	}
	public static function isPost($key)
	{
   		return isset ( $_POST[$key] ) ? housekeeping::testStringAsBoolean($_POST[$key]) : FALSE;
   	}

	// REQUEST FUNCTIONS - get or post.  Use requestraw for a textarea.
	public static function requestraw($key, $default='')
	{
   		return isset ( $_REQUEST[$key] ) ? $_REQUEST[$key] : $default;
	}
	public static function request($key, $default='')
	{
   		return isset ( $_REQUEST[$key] ) ? housekeeping::trimFirst($_REQUEST[$key]) : $default;
	}
	public static function isRequest($key)
	{
   		return isset ( $_REQUEST[$key] ) ? housekeeping::testStringAsBoolean($_REQUEST[$key]) : FALSE;
   	}

	// SESSION FUNCTIONS.  Use sessionraw for a textarea.
	public static function sessionraw($key, $default='')
	{
   		return isset ( $_SESSION[$key] ) ? $_SESSION[$key] : $default;
	}
	public static function session($key, $default='')
	{
   		return isset ( $_SESSION[$key] ) ? housekeeping::trimFirst($_SESSION[$key]) : $default;
	}
	public static function isSession($key, $default=FALSE)
	{
   		return isset ( $_SESSION[$key] ) ? housekeeping::testStringAsBoolean($_SESSION[$key]) : $default;
   	}




 
}
?>
