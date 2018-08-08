<?php

ob_start();	// We will buffer this output so we can compact it

require_once('../protected/bandsintown_api.php');

// https://app.swaggerhub.com/apis/Bandsintown/PublicAPI/3.0.0#/artist%20events/artistEvents

// Get artist info so we have general URL to link to from logo

$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));

curl_setopt($ch, CURLOPT_URL,'https://rest.bandsintown.com/artists/Lorenzo%20Wood%20Music?app_id=' . API_KEY);

$json=curl_exec($ch);
curl_close($ch);
$artist = json_decode($json, true);

$artistURL = $artist['url'];
$artistName = $artist['name'];
$artistNameWithoutMusic = preg_replace('/ Music$/', '', $artistName);

$oneYearAgo = date('Y-m-d', strtotime('-1 year'));
$oneYearAhead = date('Y-m-d', strtotime('+1 year'));
$thisYear = date('Y');

if ($artist['upcoming_event_count']) {
// Get upcoming events

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));

	curl_setopt($ch, CURLOPT_URL,'https://rest.bandsintown.com/artists/Lorenzo%20Wood%20Music/events?app_id=' . API_KEY
		. '&date=' . $oneYearAgo . ',' . $oneYearAhead);

	$json=curl_exec($ch);
	curl_close($ch);
	$events = json_decode($json, true);

?>
<!-- <?php echo htmlspecialchars(date('c')); ?> -->
<div class='bit-header-row'>
	<span class='bit-header'>Upcoming Performances <span id="recent-performances"></span></span>
	<a href='<?php echo htmlspecialchars($artistURL); ?>'><span
		class='bit-header-full'><?php include 'svg/bit-full.svg'; ?></span><span
		class='bit-header-mobile'><?php include 'svg/bit-mobile.svg'; ?></span></a>
</div>
<?php
	foreach ($events as $event) {
		$url = $event['url'];
		$dateTime = strtotime($event['datetime']);
		$year = date('Y', $dateTime);
		$month_day = ($year == $thisYear) ? date('M d', $dateTime) : date('M d, Y', $dateTime);
		$venue = trim($event['venue']['name']);
		$city_state = $event['venue']['city'] . ', ' . $event['venue']['region'];
		$past = ($dateTime < time())
?>
<div class='bit-row <?php echo ($past ? 'bit-past' : 'bit-upcoming'); ?>'
	<?php if ($past) { echo ' style="display:none"'; } ?>>
	<?php if (!$past) { echo '<a href="' . htmlspecialchars($url) . '">'; } ?>
		<span class='bit-date'><?php echo htmlspecialchars($month_day); ?></span>
		<span class='bit-venue'><?php echo htmlspecialchars($venue); ?></span>
		<span class='bit-citystate'><?php echo htmlspecialchars($city_state); ?></span>
	<?php if (!$past && false !== strpos(strtolower($venue), 'private')) {
		echo '<span class="bit-button">More Info</span>';
		echo '</a>';
	} ?>

		<?php if (!$past) { ?><?php } ?>
	</a>
</div>
<?php
	}
?>
<div class='bit-after'>
	<a class='bit-track' href='<?php echo htmlspecialchars($artistURL); ?>'>Track <?php echo htmlspecialchars($artistNameWithoutMusic); ?> on BandsInTown</span></a>
	to be notified of upcoming gigs!
</div>
<?php
}

// Now to compress what was output. Not perfect but improves things a bit.
$output = ob_get_contents();
ob_end_clean();

$output = preg_replace('/\s+/', ' ', $output);
echo $output;
?>
