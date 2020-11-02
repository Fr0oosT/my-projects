<?php
require '../backend/connection.php';

if (isset($_GET['key'])) {
    if ($_GET['key'] === "INSERT_KEY_HERE") {
        $sql = "SELECT m.id, t1.id AS 'team1_id', t1.name AS 'team1_name', t2.id AS 'team2_id', t2.name AS 'team2_name' FROM matches AS m 
                LEFT JOIN teams t1 ON m.team1_id = t1.id
                LEFT JOIN teams t2 ON m.team2_id = t2.id";
        $query = $conn->prepare($sql);
        $query->execute();
        $matches = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($matches);
    }
}
