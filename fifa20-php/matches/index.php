<?php
require '../header.php';

if (!isset($_SESSION['user_id'])) {
	$msg = urlencode("Je moet eerst inloggen om te dashboard kunnen zien!");
	header("Location: login.php?msg=$msg");
}

?>

<h1>Wedstrijdschema</h1>
<a href="../dashboard.php">Dashboard</a>
<?php if ($_SESSION["user_admin"] == 1) {  ?>
	<form action="../backend/matchesController.php" method="POST">
		<input type="hidden" name="formType" value="generate">		
		<input type="submit" value="Genereren" name="genereren">
		<select name="fields" id="fields">
			<option value="1">1 veld</option>
			<option value="2">2 velden</option>
			<option value="3">3 velden</option>
			<option value="4">4 velden</option>
			<option value="5">5 velden</option>
			<option value="6">6 velden</option>
		</select>
	</form>
<?php } ?>
<table>
	<tr>
		<th>Team 1</th>
		<th>Team 2</th>
		<th>Veld</th>
		<th>Scheidsrechter</th>
		<th>Uitslag</th>
		<th></th>
	</tr>

	<?php
	$sql = "SELECT m.id, t1.name AS team1_id, t2.name AS team2_id, team1_score, team2_score, field, t3.name AS referee_id
FROM matches AS m
LEFT JOIN teams t1 on m.team1_id = t1.id
LEFT JOIN teams t2 on m.team2_id = t2.id
LEFT JOIN players t3 on m.referee_id = t3.id";

	$prepare = $conn->prepare($sql);
	$prepare->execute(array());
	$rows = $prepare->fetchAll();

	foreach ($rows as $row) {
		echo "<tr><td>{$row["team1_id"]}</td><td>{$row["team2_id"]}</td><td>{$row["field"]}</td><td>{$row["referee_id"]}</td><td> {$row["team1_score"]} - {$row["team2_score"]}</td><td><a href='result.php?id={$row['id']}'>invullen</a></td></tr>";
	}
	echo "</table>";


	require '../footer.php';
	?>