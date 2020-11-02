<?php
require "../header.php";

$id = $_GET['id'];
$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $conn->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$team = $prepare->fetch(PDO::FETCH_ASSOC);
?>

<div class="form">
    <form action="../backend/teamsController.php?id=<?= $id ?>" method="post">
        <input type="hidden" name="type" value="edit">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?= $team['name'] ?>">
        </div>

        <div class="form-group">
            <input type="submit" value="Wijzig contact">
        </div>
    </form>
</div>