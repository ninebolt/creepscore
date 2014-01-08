<?php
	if ($_POST["summonerName"] != "") {
		$summonerName = ($_POST["summonerName"]);
	} else {  }
	$summonerName = rawurlencode($summonerName);
	$URL = "http://prod.api.pvp.net/api/lol/na/v1.2/summoner/by-name/" . $summonerName . "?api_key=ddf2a87b-1df4-4fec-bc3b-ecf243b55331";
	$curl = curl_init();
	curl_setopt_array($curl, array(CURLOPT_URL => $URL, CURLOPT_RETURNTRANSFER => true));
	$json = curl_exec($curl);
	curl_close($curl);
	$decodedJSON = json_decode($json);
	$decodedJSON = get_object_vars($decodedJSON);
	echo "Your account was the " . $decodedJSON["id"] . "th account created.";
?>