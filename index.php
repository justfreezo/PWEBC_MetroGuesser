<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
     <form action="login.php" method="post">
     	<h2>Connexion</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Nom d'utilisateur</label>
     	<input type="text" name="uname" placeholder="nom d'utilisateur"><br>

     	<label>Mot de passe</label>
     	<input type="password" name="password" placeholder="mot de passe"><br>

     	<button type="submit">Valider</button>
     </form>
</body>
</html>