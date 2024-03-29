<?php
session_start();

if (isset($_SESSION['user_name'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Map</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="icon" href="../img/icon.ico" type="image/x-icon">
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script> var playerName = "<?php echo $_SESSION['user_name']; ?>"</script>
        <script src="../js/mapScript.js"></script>
    </head>
    <body>
        <div class="title">
            <h1>Station à trouver :</h1>
            <h1 id="station_name"> ...</h1>
        </div>

        <div class="score-container">
            <div id="display">Score total : <span id="totalScore">0</span></div>
            <div class="progress-container">
                <div id="progressBar"></div>
            </div>
        </div>

        <div class="round-container">
            <div id="display">Manche : <span id="totalRound">1 sur 5</span></div>
        </div>

        <div id="map"></div>

        <div class="actions">
            <div class="action-button">
                <button class="input-submit" id="boutonSuivant"> Suivant </button>
            </div>

            <div class="action-button">
                <button class="input-submit" onclick="confirmLeave()"> Arrêter de jouer </button>
            </div>
        </div>

    </body>
    </html>
    <?php

} else {
    header("Location: ../index.php");
    exit();
}


?>