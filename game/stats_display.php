<?php
session_start();

if (isset($_SESSION['score']) && isset($_SESSION['user_name']) && isset($_SESSION['timePlayed']) && isset($_SESSION['nbGame'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Map</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="../js/mapScript.js"></script>
    </head>
    <body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Stats</span>
            </div>

            <h1>Statistiques du joueur <?php echo $_SESSION['user_name'] ?></h1>

            <div class="stats">
                <table class="stats-table">
                    <tr>
                        <td>Score total :</td>
                        <td><?php echo htmlspecialchars($_SESSION['score']) ?></td>
                    </tr>
                    <tr>
                        <td>Nombre de parties jouées :</td>
                        <td><?php echo htmlspecialchars($_SESSION['nbGame']) ?></td>
                    </tr>
                    <tr>
                        <td>Durée de jeu :</td>
                        <td><?php echo htmlspecialchars($_SESSION['timePlayed']) ?> secondes</td>
                    </tr>
                </table>
            </div>

            <div class="input-box">
                <a class="input-submit" href="../home.php">Retour</a>
            </div>
        </div>
    </div>

    </body>
    </html>
    <?php

} else {
    header("Location: ../home.php");
    exit();
}


?>