<?php


$server = "localhost";
$usern = "root";
$code = "";
$db_name = "registration";


$conne = new mysqli($server, $usern, $code, $db_name);




try {
    $conn = new PDO("mysql:host=$server;dbname=$db_name", 
                    $usern, $code);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}


?>