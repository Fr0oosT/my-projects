<?php
require '../header.php';

$match_id = $_GET["id"];
?>

<h1>Score invullen</h1>

<form action="../backend/matchesController.php?id=<?= $match_id ?>" method="POST">
    <input type="hidden" name="formType" value="score">

    <div>
        <label for="">Score team 1</label>
        <input type="number" name="team1_score" min="0" max="30">
    </div>


    <div>
        <label for="">Score team 2</label>
        <input type="number" name="team2_score" min="0" max="30">
    </div>
    <div>
        <input type="submit" value="Verzenden">
    </div>
</form>

<?php
require '../footer.php';
?>