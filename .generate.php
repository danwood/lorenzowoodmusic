#!/usr/bin/php
<?php
require_once('classes/downcode.php');

$db = new DowncodeDB();

$db->generateCodes($argv[1]);


?>
