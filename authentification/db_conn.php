<?php

$sname= "localhost";
$uname= "root";
$password = "paulojulia";

$db_name = "metroguesser";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connexion échouée";
}