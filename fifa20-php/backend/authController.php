<?php require('connection.php');

if( $_POST['formType'] == 'register'){
        $name           = $_POST['name'];
        $email          = $_POST['email'];
        $password       = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (strlen($name) < 1){
          $msg = urlencode("Naam van gebruiker kan niet leeg zijn!");
          header("Location: ../register.php?msg=$msg");
          die;
        }

        $sql = "SELECT * FROM players WHERE email = :email";
        $query = $conn->prepare($sql);
        $query->execute([
            ':email' => $email
        ]);
        $player = $query->rowCount();
        if ($player){
            $msg = urlencode('Dit gebruiker bestaat al!');
            header("Location: ../register.php?msg=$msg");
            die;
        }


        $sql = "INSERT INTO players (name,email,password) VALUES (:name,:email,:password)";
        $query = $conn->prepare($sql);
        $query->execute([
            ':name'      => $name,
            ':email'     => $email,
            ':password'  => $hashedPassword
        ]);

        $msg = urlencode("Gebruiker is geregistreerd");
        header("Location: ../login.php?msg=$msg");
        die;


} else if ($_POST['formType'] == 'login') {
    $email          = $_POST['email'];
    $password       = $_POST['password'];

    $sql ="SELECT * FROM players WHERE email = :email";
    $query = $conn->prepare($sql);
    $query->execute([
      ':email' => $email
    ]);
    $playerExists = $query->rowCount();

    if ($playerExists) {
      $player = $query->fetch();
      $verified = password_verify( $password, $player['password'] );
      if (!$verified) {
        $msg = urlencode('Gebruikersnaam / wachtwoord is onjuist!');
        header("Location: ../login.php?msg=$msg");
        die;
      }
    }

    $_SESSION['user_id'] = $player['id'];
    $_SESSION['user_email'] = $player['email'];
    $_SESSION['user_name'] = $player['name'];
    $_SESSION['user_admin'] = $player['admin'];

    $msg = urlencode('Je bent nu ingelogd!');
    header("Location: ../dashboard.php?msg=$msg");

} 
