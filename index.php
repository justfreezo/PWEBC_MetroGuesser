<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        function afficherInscription() {
            document.getElementById("inscriptionForm").style.display = "block";
            document.getElementById("connexionForm").style.display = "none";
        }

        function cacherInscription() {
            document.getElementById("inscriptionForm").style.display = "none";
            document.getElementById("connexionForm").style.display = "block";
        }
    </script>
</head>
<body>
    <form id="connexionForm" action="authentification/login.php" method="post">
        <h2>Connexion</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Nom d'utilisateur
            <input type="text" name="uname" placeholder="Nom d'utilisateur">
        </label><br>
        <label>Mot de passe
            <input type="password" name="password" placeholder="Mot de passe">
        </label><br>
        <button type="submit">Valider</button>
        <button type="button" onclick="afficherInscription()">Inscription</button>
    </form>

    <form id="inscriptionForm" action="authentification/inscription.php" method="post" style="display: none;">
        <h2>Inscription</h2>
        <label>Nom d'utilisateur
            <input type="text" name="newUname" placeholder="Nom d'utilisateur">
        </label><br>
        <label>Mot de passe
            <input type="password" name="newPassword" placeholder="Mot de passe">
        </label><br>
        <button type="submit">S'inscrire</button>
        <button type="button" onclick="cacherInscription()">Annuler</button>
    </form>
</body>
</html>