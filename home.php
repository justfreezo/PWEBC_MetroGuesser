<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/script.js"></script>
    </head>
    <body>
        <div class="welcome-message">
            <div class="header">
                <a class="input-submit"  href="authentification/logout.php">Déconnexion</a>
                <a class="input-submit"  href="statistiques.php">Statistiques</a>
            </div>

            <div class="title">
                <h1>Bienvenue, <?php echo $_SESSION['user_name']; ?> ! </h1>
            </div>

            <button class="input-submit"  onclick="startGame()">Jouer</button>
        </div>
    </body>
    </html>

    <?php
}else{
    header("Location: index.php");
    exit();
}
?>
