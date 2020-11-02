<?php
require '../header.php';


if (isset($_GET['msg'])) {
    echo $_GET['msg'];
}



$sql = "SELECT * FROM teams";
$query = $conn->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<h1>Alle teams:</h1>

<?php
echo "<ul>";
foreach ($teams as $team) {
    echo "<li><a href='detail.php?id=${team['id']}'>${team['name']}</a></li>";
}
echo "</ul>";
?>

<p><a href="create.php">Maak een nieuw team</a></p>

<?php
require '../footer.php';
?>
