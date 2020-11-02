<?php 
require __DIR__ . '/../header.php'; 

if (!isset($_GET['id'])) {
    redirect('../index.php');
}
$id = $_GET['id'];
$car = selectOne("SELECT * FROM cars WHERE id = :id", [
    ':id' => $id
]);

?>
<main> 
    <h2>Auto Wijzigen</h2>
    <form action="../../backend/controllers/carsController.php" method="post">
        <input type="hidden" name="formType" value="edit">
        <input type="hidden" name="id" value="<?= $car['id'] ?>">
        <div class="form-group">
            <label for="">Brand</label>
            <input name="brand" type="text" value="<?= $car['brand'] ?>">
        </div>
        <div class="form-group">
            <label for="">Model</label>
            <input name="model" type="text" value="<?= $car['model'] ?>">
        </div>
        <div class="form-group">
            <label for="">Color</label>
            <input name="color" type="text" value="<?= $car['color'] ?>">
        </div>
        <div class="form-group">
            <label for="">Category</label>
            <input name="categories_id" type="text" value="<?= $car['categories_id'] ?>">
        </div>
        <div class="form-group">
            <label for="">Kenteken</label>
            <input name="license_plate" type="text" value="<?= $car['license_plate'] ?>">
        </div>


        <input type="submit" value="Wijzigen">
        
    </form>
</main>



<?php  require __DIR__ . '/../footer.php'; ?>