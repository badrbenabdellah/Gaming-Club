<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['user_id'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/user.php";

        $id=$_GET['user_id'];
        if(removeUser($id, $conn)){
            $sm = "Successfully Deleted!";
            header("Location: user.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: user.php?error=$sm");
            exit;
        }

}else {
    header("Location: user.php");
    exit;
}

}else {
    header("Location: user.php");
    exit;
}