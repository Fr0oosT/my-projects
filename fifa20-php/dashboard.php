<?php
require 'header.php';

if (!isset($_SESSION['user_id'])) {
	$msg = urlencode("Je moet eerst inloggen om te dashboard kunnen zien!");
	header("Location: login.php?msg=$msg");
}


if (isset($_GET['msg'])) {
	echo $_GET['msg'];
}

?>

<h1>DASHBOARD</h1>
<p>Hallo! <?= $_SESSION['user_name'] ?></p>
<style>
	.ranking {border: black solid 1px; display: inline-block; margin: 20px; padding: 0px 50px 0px 5px;} 
</style>
<div class='ranking'>
	<h3>Ranking</h3>
	<?php

	$sql = "SELECT * FROM teams ORDER BY points DESC LIMIT 5";
	$prepare = $conn->prepare($sql);
	$prepare->execute(array());
	$rows = $prepare->fetchAll();
	echo "<ol>";
	foreach ($rows as $row) {
		echo "<li>{$row["name"]} - {$row['points']} punten</li>";
	}
	echo "</ol>"
	?>
</div>
<ul>
	<li><strong>Teams:</strong></li>
	<li><a href="teams/index.php">Teams bekijken (eis 203)</a></li>
	<li><a href="teams/create.php">Nieuw team maken (eis 201)</a></li>
	<li><a href="matches/index.php">Wedstrijdschema</a></li>
	<li><strong>Hier volgen de andere links vanaf het dashboard:</strong></li>
	<li><a href="api/matches.php?key=INSERT_KEY_HERE">matches API</a></li>
	<li><a href="api/result.php?key=INSERT_KEY_HERE">result API</a></li>
	<li><a href="logout.php">Uitloggen</a></li>
</ul>

<?php
require 'footer.php';
?>