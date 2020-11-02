<?php

//Aparte PHP Pagina met database en INSERT query


$dbHost = 'localhost';
$dbName = 'carrental';
$dbUser = 'root';
$dbPass = '';

$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO cars 
        (categories_id, brand, model, color, license_plate)
    VALUES
        (:categories_id, :brand, :model, :color, :licence_plate)";

    
$prepare = $db->prepare($sql);
$prepare->execute([
    ':categories_id' => '2',
    ':brand'         => 'Volkswagen',
    ':model'         => 'Passat',
    ':color'         => 'Pink',
    ':license_plate' => 'aa-234-bb'
]);
// $cars = $query->fetchAll(PDO::FETCH_ASSOC);

// foreach ($cars as $car ) {
    
//     echo "<li> ${car['brand']} </li>";
    
// }
