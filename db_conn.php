<?php

$sname= "localhost";
$unmae= "root";
$password = "paulojulia";

$db_name = "metroguesser";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}