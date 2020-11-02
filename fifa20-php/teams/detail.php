<?php
require '../header.php';

if(!isset($_GET['id'])){
    $msg = urlencode("Je moet wel een team selecteren!");
    header("Location: index.php?msg=$msg");
}

$id = $_GET['id'];
$sql = "SELECT * FROM `teams` WHERE id = $id";
$query = $conn->query($sql);
$team = $query->fetch(PDO::FETCH_ASSOC);

$team_id = $team['id'];
$sql2 = "SELECT players.id, players.name FROM `players` WHERE team_id = $team_id";
$query2 = $conn->query($sql2);
$players = $query2->fetchAll(PDO::FETCH_ASSOC);

?>
<h2><?php echo $team['name']; ?></h2>
<p>Points: <?= $team['points']; ?></p>
<p>Creator: <?= $team['creator_id'] ?></p>
<p>Players:</p>

<?php
echo "<ul>";
foreach($players as $player){
    echo "<li><a href='players/detail.php?id=$player[id]'>$player[name]</a></li>";
}
echo "</ul>";
?>
<a href="index.php">Terug naar Teams</a>
<?php
if ($team['creator_id'] == $_SESSION['user_id'] || $_SESSION["user_admin"] == true) {
    echo '<a href="players/add.php?id=' . $id . '">Voeg een nieuw speler</a>';
    echo '<a href="edit.php?id=' . $id . '">Wijzigen</a>';
    echo '<form action="../backend/teamsController.php?id=' . $id . '" method="post">';
    echo '<input type="hidden" name="type" value="delete">';
    echo '<input type="submit" value="Verwijder dit contact">';
    echo '</form>';
}

require '../footer.php';
?>