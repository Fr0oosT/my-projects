<?php
require '../backend/connection.php';

if (isset($_GET['key'])) {
    if ($_GET['key'] === "INSERT_KEY_HERE") {
        $sql = "SELECT m.id, t1.id AS 'team1_id', t1.name AS 'team1_name', team1_score, t2.id AS 'team2_id', t2.name AS 'team2_name', team2_score FROM matches AS m 
                LEFT JOIN teams t1 ON m.team1_id = t1.id
                LEFT JOIN teams t2 ON m.team2_id = t2.id";
        $query = $conn->prepare($sql);
        $query->execute();
        $matches = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($matches as $key => $match) {
            $winnerId = "";
            if ($matches[$key]['team1_score'] > $matches[$key]['team2_score']) {
                $winnerId = "{$matches[$key]['team1_id']}";
            } else if ($matches[$key]['team2_score'] > $matches[$key]['team1_score']) {
                $winnerId = "{$matches[$key]['team2_id']}";
            } else {
                $winnerId = "DRAW!";
            }
            $matches[$key]["winner_id"] = $winnerId;
        }
        echo json_encode($matches);
    }
}
