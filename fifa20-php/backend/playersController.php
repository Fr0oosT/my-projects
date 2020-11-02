<?php
require 'connection.php';

// als de gebruiker rechtstreeks probeert te navigeren naar deze controller wordt hij terugverwezen naar het dashboard, omdat hij vanuit een post-verzoek (form in dit geval) moet komen.
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	$msg = "Je kunt deze pagina alleen bereiken via een veilige form-invoer.";
	header("location: ../dashboard.php?msg=$msg");
	exit;
}

if ($_POST['formType'] == "add"){

	$playerid = $_POST['player'];
	$teamid = $_POST['team_id'];
	echo $playerid;
	echo "<br>";
	echo $teamid;

	$sql = "UPDATE players SET
	team_id = :teamid
	WHERE id = :playerid";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':teamid' => $teamid,
		':playerid' => $playerid
	]);

	$msg = urlencode("Gebruiker is succesvol toegevoegd aan een team!");
	header("location: ../dashboard.php?msg=$msg");

	exit;
}

?>