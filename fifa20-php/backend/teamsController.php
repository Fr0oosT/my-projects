<?php
require 'connection.php';


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	$msg = "Je kunt deze pagina alleen bereiken via een veilige form-invoer.";
	header("location: ../dashboard.php?msg=$msg");
	exit;
}


if ($_POST['type'] == 'create') {
	$name = $_POST['name'];
	$creatorID = $_SESSION['user_id'];


	if (strlen($name) < 2) {
		$msg = urlencode("Naam van team moet tenminste 2 letters bevatten!");
		header("Location: ../teams/create.php?msg=$msg");
		exit;
	}

	$sql = "SELECT * FROM teams WHERE `name` = :name";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':name' => $name
	]);
	$team = $prepare->rowCount();
	if ($team > 0) {
		$msg = urlencode("Deze team bestaat al!");
		header("Location: ../teams/create.php?msg=$msg");
		die;
	}

	$sql = "INSERT INTO teams (`name`, `creator_id`) VALUES (:name, :creator_id)";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':name' => $name,
		':creator_id' => $creatorID
	]);

	
	$msg = "Team is succesvol toegevoegd.";
	header("location: ../dashboard.php?msg=$msg");
	exit;
}

if ($_POST['type'] == 'delete') {

	$id = $_GET['id'];

	$sql = "DELETE FROM `teams` WHERE id = :id";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':id' => $id
	]);
	$msg = "team succesvol verwijderd.";
	header("location: ../dashboard.php?msg=$msg");
	exit;
}
if ($_POST['type'] == 'edit') {
	$id = $_GET['id'];
	$name = $_POST['name'];
	$points = $_POST['points'];

	$sql = "UPDATE teams SET name = :name, points = :points WHERE id = :id";
	$prepare = $conn->prepare($sql);
	$prepare->execute([
		':name' => $name,
		':points' => $points,
		':id' => $id
	]);


	$msg = "gegevens succesvol gewijzigd.";
	header("location: ../dashboard.php?msg=$msg");
	exit;
}
