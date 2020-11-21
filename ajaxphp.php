<?php

$location = $_POST['location'];
if (!empty($location)) {
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/forecast/daily?q=".$location."&cnt=7&mode=json",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
	// CURLOPT_MAXREDIRS => 10,
	// CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
			"x-rapidapi-key: fa571595a3mshc43f545094b05acp178971jsnd3123f567397"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
	// echo  $response;
		$div ="";
		$response = json_decode($response,true);

	// echo "<pre>";print_r($response);echo "</pre>";die;

		try {
			if (!empty($response)) {
				foreach ($response['list'] as $key => $value) {
					$div .= "<p class='sat'>".date('l',$value['dt'])." <br><span>day - ".$value['temp']['day']."</span><br><span>eve - ".$value['temp']['eve']."</span><br><span>max - ".$value['temp']['max']."</span><br><span>min - ".$value['temp']['min']."</span><br><span>morn - ".$value['temp']['morn']."</span><br><span>night - ".$value['temp']['night']."</span></p>";
				}
			}
			echo $div;
		} catch (Exception $e) {
			echo $e;
		}
	}
}
?>