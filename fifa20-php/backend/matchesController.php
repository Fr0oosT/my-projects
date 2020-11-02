<?php
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	$msg = "Je kunt deze pagina alleen bereiken via een veilige form-invoer.";
	header("location: ../dashboard.php?msg=$msg");
	exit;
}

if ($_POST['formType'] == "score") {

	$matchid 	= $_GET['id'];
	$team1score = $_POST['team1_score'];
	$team2score = $_POST['team2_score'];

	$sql = "UPDATE matches SET team1_score = :team1_score,team2_score = :team2_score 
	WHERE id = :match_id";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':team1_score' => $team1score,
		':team2_score' => $team2score,
		':match_id' => $matchid
	]);

	//teams points updater
	$sql = "SELECT m.id, t1.id AS team1_id, t2.id AS team2_id
			FROM matches AS m
			LEFT JOIN teams t1 on m.team1_id = t1.id
			LEFT JOIN teams t2 on m.team2_id = t2.id
			WHERE m.id = :match_id";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':match_id' => $matchid
	]);
	$row = $prepare->fetchAll();
	if ($team1score > $team2score) {
		$team = $row[0]["team1_id"];
		$sql = "SELECT points FROM teams WHERE id = :team_id";
		$prepare = $conn->prepare($sql);
		$prepare->execute([
			':team_id' => $team
		]);
		$row = $prepare->fetchAll();
		$points = $row[0]["points"] + 3;

		$sql = "UPDATE teams SET points = :points WHERE id = :team_id";
		$prepare = $conn->prepare($sql);
		$prepare->execute([
			':points' => $points,
			':team_id' => $team
		]);
	} elseif ($team1score < $team2score) {
		$team = $row[0]["team2_id"];
		$sql = "SELECT points FROM teams WHERE id = :team_id";
		$prepare = $conn->prepare($sql);
		$prepare->execute([
			':team_id' => $team
		]);
		$row = $prepare->fetchAll();
		$points = $row[0]["points"] + 3;

		$sql = "UPDATE teams SET points = :points WHERE id = :team_id";
		$prepare = $conn->prepare($sql);
		$prepare->execute([
			':points' => $points,
			':team_id' => $team
		]);
	} elseif ($team1score == $team2score) {
		$team1 = $row[0]["team1_id"];
		$team2 = $row[0]["team2_id"];
		$sql = "SELECT points FROM teams WHERE id IN(:team1_id, :team2_id)";
		$prepare = $conn->prepare($sql);
		$prepare->execute([
			':team1_id' => $team1,
			':team2_id' => $team2
		]);
		$rows = $prepare->fetchAll();
		$points1 = $rows[0]["points"] + 1;
		$points2 = $rows[1]["points"] + 1;

		$sql = "UPDATE teams SET points = :points WHERE id = :team_id";
		$prepare = $conn->prepare($sql);
		$prepare->execute([
			':points' => $points1,
			':team_id' => $team1
		]);
		$prepare->execute([
			':points' => $points2,
			':team_id' => $team2
		]);
	}
}

if ($_POST['formType'] == "generate") {
	$sql = "DELETE FROM matches";
	$prepare = $conn->prepare($sql);
	$prepare->execute();

	$sql = "SELECT * FROM teams";
	$prepare = $conn->prepare($sql);
	$prepare->execute();
	
	$teams = $prepare->fetchAll();
	$fields = $_POST["fields"];
	$field = 1;

	$sql = "SELECT id FROM players WHERE team_id IS NULL";
	$prepare = $conn->prepare($sql);
	$prepare->execute();
	$players = $prepare->fetchAll();

	
	foreach ($teams as $team1) {
		foreach ($teams as $team2) {
			if ($team1['name'] != $team2['name']) {
				$referee = $players[array_rand($players)];
				$sql = "INSERT INTO matches (team1_id, team2_id, team1_score, team2_score, field, referee_id) VALUES({$team1[0]},{$team2[0]},0,0,{$field},{$referee[0]})";
				$query = $conn->prepare($sql);
				$query->execute();
				$field++;
				if ($field > $fields) {
					$field = 1;

				}
			}
		}
		array_shift($teams);
	}
}
header("location: ../matches/index.php");
?>
