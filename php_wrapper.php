<?php

	/**
	* This is a PHP wrapper for the Riot Games API located at developer.riotgames.com
	* Developed by Ash '9 Bolt' Bhatnagar
	* 
	* The wrapper  isn’t endorsed by Riot Games and doesn’t reflect the views or opinions of Riot Games or anyone 
	* officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks 
	* or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.
	*/

	$_KEY = "ddf2a87b-1df4-4fec-bc3b-ecf243b55331"; //CHANGE.
	$_region= "na"; //CHANGE
	$_URL = "http://prod.api.pvp.net/api/lol/"; //Base url.

	$_summonerName;
	$_summonerId; //CHANGE
	$_season = "SEASON3"; //CHANGE
	
	// The function bellow makes the request
	// to Riot servers and then turns it into
	// a decoded object array which it returns.
	function makeRequest($requestString) {
		$curl = curl_init();
		curl_setopt_array($curl, array(CURLOPT_URL => $requestString, CURLOPT_RETURNTRANSFER => true));
		$json = curl_exec($curl);
		curl_close($curl);
		$decodedJSON = json_decode($json);
		if(is_array($decodedJSON)) {
			return $decodedJSON;
		} else {
			$decodedJSON = get_object_vars($decodedJSON);
			return $decodedJSON;
		}
	}

	// Below are the calling functions
	// They construct the strings required to make calls
	// If $_region, $_summonerId, $_season, $_summonerName are null, it will error out.
	function call_champList($freeToPlay = false) {
		global $_URL, $_region, $_KEY;
		return $_URL . $_region . "/v1.1/champion?freeToPlay=" . $freeToPlay . "&api_key=" . $_KEY;
	}

	function call_recentGames() {
		global $_URL, $_region, $_summonerId, $_KEY;
		return $_URL . $_region . "/v1.2/game/by-summoner/" . $_summonerId . "/recent?api_key=" . $_KEY;
	}

	function call_leagueData() {
		global $_URL, $_region, $_summonerId, $_KEY;
		return $_URL . $_region . "/v2.2/league/by-summoner/" . $_summonerId . "?api_key=" . $_KEY;
	}

	function call_playerStats($gameType = 0) {
		global $_URL, $_region, $_summonerId, $_season, $_KEY;
		if ($gameType == 0) {
			return $_URL . $_region . "/v1.2/stats/by-summoner/" . $_summonerId . "/summary?season=" . $_season . "&api_key=" . $_KEY;
		} else {
			return $_URL . $_region . "/v1.2/stats/by-summoner/" . $_summonerId . "/ranked?season=" . $_season . "&api_key=" . $_KEY;
		}
	}

	function call_summonerInfo($info = 0) {
		global $_URL, $_region, $_summonerName, $_summonerId, $_KEY;
		if ($info == 0) {
			return $_URL . $_region . "/v1.2/summoner/" . $_summonerId . "/masteries/?api_key=" . $_KEY;
		} else if ($info == 1) {
			return $_URL . $_region . "/v1.2/summoner/" . $_summonerId . "/runes/?api_key=" . $_KEY;
		} else if ($info == 2) {
			return $_URL . $_region . "/v1.2/summoner/by-name/" . $_summonerName . "?api_key=" . $_KEY;
		} else if ($info == 3) {
			return $_URL . $_region . "/v1.2/summoner/" . $_summonerId . "?api_key=" . $_KEY;
		} else {
			return "Error";
		}
	}

	function call_teamInfo() {
		global $_URL, $_region, $_summonerId, $_KEY;
		return $_URL . $_region . "/v2.2/team/by-summoner/" . $_summonerId . "?api_key=" . $_KEY;
	}

	function fillSummonerId($rawSummonerName) {
		global $_summonerName, $_summonerId;
		$_summonerName = rawurlencode($rawSummonerName);
		echo $_summonerName;
		$string1 = call_summonerInfo(2);
		$object1 = makeRequest($string1);
		$_summonerId = $object1["id"];
	}
	
	fillSummonerId("barneydabarnacle");
	echo $_summonerId . "<br />";
	$string2 = call_recentGames(1);
	echo $string2 . "<br />";
	$object2 = makeRequest($string2);
	var_dump($object2);

?>