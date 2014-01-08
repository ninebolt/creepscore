<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Creep Score</title>
		<script>
			function onClick() {
				var summonerInput = document.getElementById("summonerInputField").value;
				if (summonerInput) {
					document.getElementById("submitForm").setAttribute("action", "summonerID.php");
				}
			}
		</script>
	</head>
	<body>
		<p>Insert Summoner Name to have Summoner ID returned!</p>
		<form id="submitForm" method="post">
			<input type="hidden" name="submit"/>
			Summoner Name: <input type="text" name="summonerName" id="summonerInputField" />
			<button id="submit_btn" data-style="expand-right" type="submit" onClick="onClick()">Enter</button>
			<br />
		</form>
	</body>
</html>