<?php

if (isset($_POST['playerScore']) && isset($_POST['uname']) && isset($_POST['timePlayer']))  {

    $playerScore = $_POST['playerScore'];
    $playerName = $_POST['uname'];
    $playerTime = $_POST['timePlayer'];

    $pdo = new PDO("mysql:server=localhost;dbname=metroguesser", "root", "paulojulia");
    $stmt = $pdo->prepare("UPDATE stats SET score = score + :score, time = time + :timePlayer, nbGame = nbGame + 1 
             WHERE id = (SELECT id FROM users WHERE user_name = :username);");

    $stmt->bindParam(':score', $playerScore, PDO::PARAM_INT);
    $stmt->bindParam(':timePlayer', $playerTime, PDO::PARAM_INT);
    $stmt->bindParam(':username', $playerName);

    $result = $stmt->execute();
} else {
    echo "Invalid request!";
}
