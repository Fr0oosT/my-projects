
<?php
require 'header.php';


if(isset($_GET['msg'])){
    echo $_GET['msg'];
}
?>

<h1>FIFA Devteam 18</h1>
<p>Hier moet algemene info over het project komen (eis 802, pas aan werken in sprint RC).</p>
<a href="dashboard.php">Ga naar het dashboard (eis 106) &gt;</a>

<?php
require 'footer.php';
?>
