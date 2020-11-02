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
    <h2>Car Detail Page</h2>
    <section class="detail">
        <h3>Naam: <?= $car['brand'] ?></h3>
        <table>
            <tr>
                <th>Model</th>
                <td><?= $car['model'] ?></td>
            </tr>
            <tr>
                <th>Color</th>
                <td><?= $car['color'] ?></td>
            </tr>
        </table>
    </section>

    <form method="POST" action="../../backend/controllers/carsController.php">
        <input type="hidden" name="id" value="<?= $car['id'] ?>">
        <input type="hidden" name="formType" value="delete">
        <input type="submit" value="X">
    </form>

    <a href="./edit.php?id=<?= $id ?>">Auto Wijzigen</a>
</main>



<?php require __DIR__ . '/../footer.php'; ?>