<?php
session_start();

$pdo = new PDO("mysql:server=localhost;dbname=metroguesser", "root", "paulojulia");
$stmt = $pdo->prepare("SELECT user_name, score, time, nbGame FROM users;");

$result = $stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($rows) {
    $userNames = [];
    $scores = [];
    $timesPlayed = [];
    $nbGames = [];

    foreach ($rows as $row) {
        $userNames[] = $row['user_name'];
        $scores[] = $row['score'];
        $timesPlayed[] = $row['time'];
        $nbGames[] = $row['nbGame'];
    }

    $_SESSION['user_names'] = $userNames;
    $_SESSION['scores'] = $scores;
    $_SESSION['timesPlayed'] = $timesPlayed;
    $_SESSION['nbGames'] = $nbGames;

    header("Location: leaderboard_display.php");
} else {
    header("Location: home.php");
}
exit();
