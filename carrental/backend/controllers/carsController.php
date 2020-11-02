<?php 
require __DIR__ . '/../init.php'; 

if ($_POST['formType'] == 'delete') {
    $id = $_POST['id'];
    query("DELETE FROM cars WHERE id = :id", [
        ':id' => $id
    ]);
    redirect('../../public/index.php');
} else if ($_POST['formType'] == 'edit') {
    $id             = $_POST['id'];
    $brand          = $_POST['brand'];
    $model          = $_POST['model'];
    $color          = $_POST['color'];
    $license_plate  = $_POST['license_plate'];
    $categories_id  = $_POST['categories_id'];

    query("UPDATE cars SET 
                brand = :brand, 
                model = :model, 
                color = :color, 
                license_plate = :license_plate,
                categories_id = :categories_id
            WHERE id = :id", [
                ':brand' => $brand,
                ':model' => $model,
                ':color' => $color,
                ':license_plate' => $license_plate,
                ':categories_id' => $categories_id,
                ':id' => $id
            ]);

    redirect("../../public/cars/detail.php?id=$id");

} else if ($_POST['formType'] == 'create'){
    $brand          = $_POST['brand'];
    $model          = $_POST['model'];
    $color          = $_POST['color'];
    $license_plate  = $_POST['license_plate'];
    $categories_id  = $_POST['categories_id'];

    query("INSERT INTO cars (brand, model, color, categories_id, license_plate)
                VALUES (:brand, :model, :color, :categories_id, :license_plate)",[
                    ':brand' => $brand,
                    ':model' => $model,
                    ':color' => $color,
                    ':license_plate' => $license_plate,
                    ':categories_id' => $categories_id,
                ]);

    redirect('../../public/index.php');
}

