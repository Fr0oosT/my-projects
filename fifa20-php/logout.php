<?php

session_start();
session_destroy();

$msg = urlencode('Je bent uitgelogd');
header("Location: login.php?msg=$msg");

?>
