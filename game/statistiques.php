<?php
session_start();

if (isset($_SESSION['user_name'])) {

    $userId = $_SESSION['user_name'];

    $pdo = new PDO("mysql:server=localhost;dbname=metroguesser", "root", "paulojulia");
    $stmt = $pdo->prepare("SELECT score FROM users WHERE user_name = :user_name;");

    $stmt->bindParam(':user_name', $userId);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row)  {
        $score = $row["score"];
        echo "<h2>Score de ".$_SESSION['user_name']." : $score</h2>";
    } else {
        echo "<p>Aucun score trouvé pour ".$_SESSION['user_name']."</p>";
    }

} else {
    header("Location: ../home.php");
    exit();
}
