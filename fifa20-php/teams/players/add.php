<?php
require '../../header.php';

if(!isset($_GET['id'])){
    $msg = urlencode("Je moet naar deze pagina komen via team scherm!");
    header("Location: ../../dashboard.php?msg=$msg");
    exit;
}

$team_id = $_GET["id"];

$sql = "SELECT * FROM `teams` WHERE id = $team_id";
$query = $conn->query($sql);
$team = $query->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM `players`";
$query2 = $conn->query($sql2);
$players = $query2->fetchAll(PDO::FETCH_ASSOC);

if($team['creator_id'] !== $_SESSION['user_id']){
    if($_SESSION["user_admin"] ==true){
    }
    else{
        $msg = urlencode("Je hebt niet genoeg rechten om te naar deze pagina komen!");
        header("Location: ../../dashboard.php?msg=$msg");
        exit;
    }
}
?>

<div class="form">
    <form action="../../backend/playersController.php" method="post">
        <input type="hidden" name="formType" value="add">
        <input type="hidden" name="team_id" value="<?=$team['id'];?>">
        <div> 
            <p>Team: <?=$team['name'];?></p>
        </div>
        <div>            
            <select name="player">
                <?php foreach($players as $player):?>
                    <option value="<?=$player['id']; ?>">
                        <?=$player['name'];?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <input type="submit" value="Voeg speler aan deze team">
        </div>
    </form>
</div>

<?php

require '../../footer.php';

?>
