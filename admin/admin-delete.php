<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['admin_id'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/admin.php";

        $id=$_GET['admin_id'];
        if(removeAdmin($id, $conn)){
            $sm = "Successfully Deleted!";
            header("Location: admin.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: admin.php?error=$sm");
            exit;
        }

}else {
    header("Location: admin.php");
    exit;
}

}else {
    header("Location: admin.php");
    exit;
}