<?php
require '../header.php';

if (isset($_GET['msg'])) {
    echo $_GET['msg'];
}
?>

<div class="form">
    <form action="../backend/teamsController.php" method="post">
        <input type="hidden" name="type" value="create">
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name">
        </div>

        <div class="form-group">
            <input type="submit" value="Maak nieuw team">
        </div>
    </form>
</div>
<a href="index.php">Terug naar dashboard</a>
<?php
require '../footer.php';
?>