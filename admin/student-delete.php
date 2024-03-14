<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['student_id'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/student.php";

        $id=$_GET['student_id'];
        if(removeStudent($id, $conn)){
            $sm = "Successfully Deleted!";
            header("Location: student.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: student.php?error=$sm");
            exit;
        }

}else {
    header("Location: student.php");
    exit;
}

}else {
    header("Location: student.php");
    exit;
}