<?php
session_start();

if (isset($_SESSION['scores']) && isset($_SESSION['user_names']) && isset($_SESSION['timesPlayed']) && isset($_SESSION['nbGames'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Leaderboard</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>
    <body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Stats</span>
            </div>

            <h1>Leaderboard</h1>

            <div class="stats">
                <table class="stats-table">
                    <tr>
                        <th>Player Name</th>
                        <th>Score</th>
                        <th>Time Played</th>
                        <th>Games Played</th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($_SESSION['user_names']); $i++) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($_SESSION['user_names'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($_SESSION['scores'][$i]); ?></td>
                            <td><?php echo htmlspecialchars($_SESSION['timesPlayed'][$i]); ?> secondes</td>
                            <td><?php echo htmlspecialchars($_SESSION['nbGames'][$i]); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <div class="input-box">
                <a class="input-submit" href="home.php">Retour</a>
            </div>
        </div>
    </div>

    </body>
    </html>
    <?php

} else {
    header("Location: home.php");
    exit();
}


?>