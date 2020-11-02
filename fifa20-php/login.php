<?php require('header.php'); ?>
<h1>Login</h1>
<?php
if (isset($_GET['msg'])) {
  if (strpos($_GET['msg'], 'geregistreed') != false) {
    echo "<div style='color: #cc0000; font-size: 1.1em; text-decoration: underline;'>";
    echo $_GET['msg'];
    echo "</div>";
  } else {
    echo "<div style='color: #00cc00; font-size: 1.1em; text-decoration: underline;'>";
    echo $_GET['msg'];
    echo "</div>";
  }
}
?>
<form action="backend/authController.php" method="POST">
  <input type="hidden" name="formType" value="login">

  <div>
    <label for="">Email:</label>
    <input type="email" name="email">
  </div>

  <div>
    <label for="">Wachtwoord:</label>
    <input type="password" name="password">
  </div>

  <input type="submit" value="Login">

</form>
<p>Als je nog geen account heb maak <a href="register.php">hier</a> een account aan!</p>


<?php require('footer.php'); ?>