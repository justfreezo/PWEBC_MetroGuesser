<?php

if (isset($_POST['newUname']) && isset($_POST['newPassword'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $newUname = validate($_POST['newUname']);
    $newPass = validate($_POST['newPassword']);

    if (empty($newUname)) {
        header("Location: ../index.php?error=Veuillez saisir un nom d'utilisateur");
        exit();
    } else if(empty($newPass)){
        header("Location: ../index.php?error=Veuillez saisir un mot de passe");
        exit();
    }

    $pdo = new PDO("mysql:host=localhost;dbname=metroguesser", "root", "paulojulia");

    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name = :newUname");
    $stmt->bindParam(':newUname', $newUname);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result) {
        header("Location: ../index.php?error=Nom d'utilisateur déjà pris");
        exit();
    }
    else{
        $stmt = $pdo->prepare("INSERT INTO users (user_name, password) VALUES (:newUname, :newPass)");

        $stmt->bindParam(':newUname', $newUname);
        $stmt->bindParam(':newPass', $newPass);

        if ($stmt->execute()) {
            $userId = $pdo->lastInsertId();
            $stmtStats = $pdo->prepare("INSERT INTO stats (id) VALUES (:userId)");
            $stmtStats->bindParam(':userId', $userId);
            $stmtStats->execute();

            header("Location: ../home.php");
        } else {
            echo "Erreur : " . $stmt->errorInfo()[2];
        }
        exit;
    }

}else {
    header("Location: ../index.php");
    exit();
}