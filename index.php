<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
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
    <div class="wrapper">
        <form id="connexionForm" action="authentification/login.php" method="post">
            <div class="login_box">
                <div class="login-header">
                    <span>Login</span>
                </div>
                <div class="input_box">
                    <input type="text" id="user" class="input-field" name="uname" placeholder="Nom d'utilisateur">
                    <label for="user" class="label"> Nom d'utilisateur </label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" id="pass" class="input-field" name="password" placeholder="Mot de passe">
                    <label for="pass" class="label"> Mot de passe </label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="submit" class="input-submit" value="Valider">
                </div>
                <div class="input-box">
                    <button type="button" class="input-submit" onclick="afficherInscription()">Inscription</button>
                </div>
            </div>
        </form>

        <form id="inscriptionForm" action="authentification/inscription.php" method="post" style="display: none;">
            <div class="login_box">
                <div class="login-header">
                    <span>Sign in</span>
                </div>
                <div class="input_box">
                    <input type="text" id="user" class="input-field" name="newUname" placeholder="Nom d'utilisateur">
                    <label for="user" class="label"> Nom d'utilisateur</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" id="pass" class="input-field" name="newPassword" placeholder="Mot de passe">
                    <label for="pass" class="label"> Mot de passe </label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="submit" class="input-submit" value="S'inscrire">
                </div>
                <div class="input-box">
                    <button type="button" class="input-submit"  onclick="cacherInscription()">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>