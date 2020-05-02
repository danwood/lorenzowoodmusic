<!DOCTYPE html>
<html class="no-js" lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
</head>
<body>

<?php

require_once('../classes/downcode.php');
$db = new DowncodeDB();
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
   $albums = $db->allAlbums();
   foreach ($albums as $album) {
       echo '<a href="' . htmlentities($album['slug'], ENT_QUOTES) . '">';
       echo htmlspecialchars($album['title']);
       echo '</a><br />' . PHP_EOL;
   }
}
?>

</body>