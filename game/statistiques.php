<?php

session_start();

include "../authentification/db_conn.php";

if (isset($_SESSION['user_name'])) {

    $userId = $_SESSION['user_name'];

    $sql = "SELECT score FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)  {
        $row = $result->fetch_assoc();
        $score = $row["score"];
        echo "<h2>Score de ".$_SESSION['user_name']." : $score</h2>";
    } else {
        echo "<p>Aucun score trouvé pour ".$_SESSION['user_name']."</p>";
    }

} else {
    header("Location: ../home.php");
    exit();
}
