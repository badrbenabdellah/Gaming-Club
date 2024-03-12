<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['coach_id'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/coach.php";

        $id=$_GET['coach_id'];
        if(removeCoach($id, $conn)){
            $sm = "Successfully Deleted!";
            header("Location: coach.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: coach.php?error=$sm");
            exit;
        }

}else {
    header("Location: coach.php");
    exit;
}

}else {
    header("Location: coach.php");
    exit;
}