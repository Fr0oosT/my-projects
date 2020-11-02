<?php require('header.php');?>

<h1>Registreren</h1>

<form action="backend/authController.php" method="POST">
<input type="hidden" name="formType" value="register">

<div>
    <label for="">Volledige naam:</label>
    <input type="text" name="name">
</div>

<div>
    <label for="">Email:</label>
    <input type="email" name="email">
</div>

<div>
    <label for="">Wachtwoord:</label>
    <input type="password" name="password">
</div>

<input type="submit" value="Registeren">

</form>

<?php
if(isset($_GET['msg'])){
  echo $_GET['msg'];
}
?>

<?php require('footer.php');?>