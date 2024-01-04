<?php

session_start();

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: ../index.php?error=Veuillez saisir un nom d'utilisateur");
        exit();
    }else if(empty($pass)){
        header("Location: ../index.php?error=Veuillez saisir un mot de passe");
        exit();
    }else{

        $pdo = new PDO("mysql:server=localhost;dbname=metroguesser", "root", "paulojulia");
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name=:uname AND password=:pass;");

        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['user_name'] = $result['user_name'];
            $_SESSION['id'] = $result['id'];
            header("Location: ../home.php");
        }else{
            header("Location: ../index.php?error=Nom d'utilisateur ou mot de passe incorrect");
        }
        exit();
    }

}else{
    header("Location: ../index.php");
    exit();
}