<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['id'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/actualité.php";

        $id=$_GET['id'];
        if(removeActualite($id, $conn)){
            $sm = "Successfully Deleted!";
            header("Location: actualité.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: actualité.php?error=$sm");
            exit;
        }

}else {
    header("Location: actualité.php");
    exit;
}

}else {
    header("Location: actualité.php");
    exit;
}