<?php 
require __DIR__ . './header.php'; 

// hier de cars ophalen
$cars = select("SELECT * FROM cars");

?>



<main>
    <section class="cars">
        <h2>Available cars</h2>
        <ul>
            <?php
                foreach($cars as $car) {
                    echo "<li> <a href='./cars/detail.php?id={$car['id']}'> {$car['brand']} </a></li>";
                }
            ?>
        </ul>
        
        <a href="cars/create.php">Auto Toevoegen</a>
        
    </section>
</main>
<?php require __DIR__ . './footer.php'; ?>



