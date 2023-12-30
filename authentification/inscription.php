<?php
$servername = "localhost";
$username = "root";
$password = "paulojulia";
$dbname = "metroguesser";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Connexion échouée";
}

if (isset($_POST['newUname']) && isset($_POST['newPassword'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $newUname = validate($_POST['newUname']);
    $newPass = validate($_POST['newPassword']);

    if (empty($newUname)) {
        header("Location: index.php?error=Veuillez saisir un nom d'utilisateur");
        exit();
    } else if(empty($newPass)){
        header("Location: index.php?error=Veuillez saisir un mot de passe");
        exit();
    } else{
        $sql = "INSERT INTO users (user_name, password) VALUES ('$newUname', '$newPass')";

        if ($conn->query($sql) === TRUE) {
            header("Location: home.php");
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }
        exit;
    }

}else {
    header("Location: index.php");
    exit();
}