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
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="js/mapScript.js"></script>
    </head>
    <body>
        <div class="title">
            <h1>Station à trouver :</h1>
            <h1 id="station_name"> ...</h1>
        </div>

        <div id="scoreDisplay">Total Score: <span id="totalScore">0</span></div>

        <div id="progressBarContainer">
            <div id="progressBar"></div>
        </div>

        <div id="map"></div>

        <div class="actions">
            <div class="next">
                <button class="input-submit" id="boutonSuivant"> Suivant </button>
            </div>

            <div class="cancel">
                <button class="input-submit" onclick="confirmLeave()"> Arrêter de jouer </button>
            </div>
        </div>

    </body>
    </html>
    <?php

} else {
    header("Location: index.php");
    exit();
}


?>