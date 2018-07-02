<?php

// curl -s -o "$DOCUMENT_ROOT/CACHE/bandsintown.html" "https://www.lorenzowoodmusic.com/bandsintown.php"

ob_start();	// We will buffer this output so we can compact it

include_once('bandsintown.php');

$output = ob_get_contents();
ob_end_clean();

// NOT NEEDED, ACTUALLY ... COMPRESSING OUTPUT ... $output = preg_replace('/\s+/', ' ', $output);

$cachePath = 'CACHE/bandsintown.html';

$bytes = file_put_contents($cachePath, $output);

if (FALSE === $bytes) {
	echo "failed to write to $cachePath";
}
else {
	//header('Location: https://www.lorenzowoodmusic.com/');
}
?>