<?php
require __DIR__ . '/../header.php'; 


?>

<main>
<h2>Auto Toevoegen</h2>
    <form action="../../backend/controllers/carsController.php" method="post">
        <input type="hidden" name="formType" value="create">
        <div class="form-group">
            <label for="">Brand</label>
            <input name="brand" type="text">
        </div>
        <div class="form-group">
            <label for="">Model</label>
            <input name="model" type="text">
        </div>
        <div class="form-group">
            <label for="">Color</label>
            <input name="color" type="text">
        </div>
        <div class="form-group">
            <label for="">Category</label>
            <select name="cars" id="cars">
                <option value="1">Cheap Ass</option>
                <option value="2">Middle Class</option>
                <option value="3">Premium</option>
            </select>
            <!-- <input name="categories_id" type="text"> -->
        </div>
        <div class="form-group">
            <label for="">Kenteken</label>
            <input name="license_plate" type="text">
        </div>


        <input type="submit" value="Toevoegen">
        
    </form>   




</main>


<?php  require __DIR__ . '/../footer.php'; ?>
