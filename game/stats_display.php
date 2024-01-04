<?php
session_start();

if (isset($_SESSION['score']) && isset($_SESSION['user_name'])) {
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
        <h1>Statistiques du joueur <?php echo $_SESSION['user_name'] ?></h1>
        <div class="stats">
            <p>Score : <?php echo $_SESSION['score'] ?></p>
        </div>
    </body>
    </html>
    <?php

} else {
    header("Location: ../home.php");
    exit();
}


?>