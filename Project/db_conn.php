<?php 

$sName = "localhost";
$uName = "root";
$upass = "";
$db_name = "registration";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $upass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}


?>