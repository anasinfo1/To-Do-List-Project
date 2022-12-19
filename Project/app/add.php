<?php
@include 'config.php';
session_start();

if(isset($_POST['title'])){
    require '../config.php';

    $title = $_POST['title'];
    $userid = $_SESSION['iduser'];

    if(empty($title)){
        header("Location: ../main.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(title,id_user) VALUE(?, $userid)");
        $res = $stmt->execute([$title]);

        if($res){
            header("Location: ../main.php?mess=success"); 
        }else {
            header("Location: ../main.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../main.php?mess=error");
}