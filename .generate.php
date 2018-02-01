#!/usr/local/bin/php
<?php
require_once('classes.php');

$db = new DowncodeDB();

$db->generateCodes($argv[1]);


?>