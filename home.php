<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
     <h1>Salut, <?php echo $_SESSION['user_name']; ?></h1>
     <a href="authentification/logout.php">Déconnexion</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>