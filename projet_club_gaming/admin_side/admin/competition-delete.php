<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['competition_id'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/competition.php";

        $id=$_GET['competition_id'];
        if(removeCompetition($id, $conn)){
            $sm = "Successfully Deleted!";
            header("Location: competition.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: competition.php?error=$sm");
            exit;
        }

}else {
    header("Location: competition.php");
    exit;
}

}else {
    header("Location: competition.php");
    exit;
}