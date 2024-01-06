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
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Menu</span>
            </div>
            <div class="input_box">
                <div class="header">
                    <a class="input-submit" href="authentification/logout.php">Déconnexion</a>
                    <a class="input-submit" href="game/statistiques.php">Statistiques</a>
                </div>
            </div>

            <div class="title">
                <h1>Bienvenue, <?php echo $_SESSION['user_name']; ?> ! </h1>
            </div>

            <div class="input-box">
                <button class="input-submit" onclick="startGame()">Jouer !</button>
            </div>
        </div>
    </div>
</body>
</html>


    <?php
}else{
    header("Location: index.php");
    exit();
}
?>
