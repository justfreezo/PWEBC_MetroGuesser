<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Map</title>
        <!-- Include Leaflet and other necessary scripts/styles -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="js/mapScript.js"></script> <!-- Create a new JavaScript file for your map logic -->
    </head>
    <body>
    <!-- Your Leaflet map container -->
    <div id="map" style="height: 500px;"></div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </html>
    <?php

} else {
    header("Location: index.php");
    exit();
}


?>
s