<?php

require_once('../protected/bandsintown_api.php');

// https://app.swaggerhub.com/apis/Bandsintown/PublicAPI/3.0.0#/artist%20events/artistEvents

$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));

curl_setopt($ch, CURLOPT_URL,'https://rest.bandsintown.com/artists/Lorenzo%20Wood%20Music?app_id=' . API_KEY);

$json=curl_exec($ch);
curl_close($ch);
$artist = json_decode($json, true);


$ch = curl_init();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));

curl_setopt($ch, CURLOPT_URL,'https://rest.bandsintown.com/artists/Lorenzo%20Wood%20Music/events?app_id=' . API_KEY);

$json=curl_exec($ch);
curl_close($ch);
$events = json_decode($json, true);


?>


Upcoming Dates

<?php

$artistURL = $artist['url'];

foreach ($events as $event) {
	$url = $event['url'];
	$datetime = $event['datetime'];
	$venue = $event['venue']['name'];
	$cityState = $event['venue']['city'] . ', ' . $event['venue']['region'];


	echo "$url\n";
	echo "$datetime\n";
	echo "$venue\n";
	echo "$cityState\n";

}


?>

