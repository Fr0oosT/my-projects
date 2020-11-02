<?php

require '../../header.php';

if(!isset($_GET['id'])){
    $msg = urlencode("Je moet wel een speler selecteren!");
    header("Location: ../index.php?msg=$msg");
}

$user_id = $_GET['id'];

$sql = "SELECT players.id, players.name, players.team_id FROM players WHERE id = $user_id";
$query = $conn->query($sql);
$player = $query->fetch(PDO::FETCH_ASSOC);

$team_id = $player["team_id"];

$sql2 = "SELECT teams.name FROM teams WHERE id = $team_id";
$query2 = $conn->query($sql2);
$team = $query2->fetch(PDO::FETCH_ASSOC);

?>

<h2><?= $player["name"]; ?></h2>
<p>Team: <?= $team['name'];?></p>

<a href="../detail.php?id=<?=$team_id?>"> Terug naar Team</a>

<?php

require '../../footer.php';

?>