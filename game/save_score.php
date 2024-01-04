<?php
session_start();
include "../authentification/db_conn.php";

if (isset($_POST['playerScore']) && isset($_POST['uname']))  {

    $playerScore = $_POST['playerScore'];
    $playerName = $_POST['uname'];

    $pdo = new PDO("mysql:server=localhost;dbname=metroguesser", "root", "paulojulia");
    $stmt = $pdo->prepare("UPDATE users SET score = score + :score WHERE user_name = :username;");

    $stmt->bindParam(':score', $playerScore, PDO::PARAM_INT);
    $stmt->bindParam(':username', $playerName);

    $result = $stmt->execute();
} else {
    echo "Invalid request!";
}
