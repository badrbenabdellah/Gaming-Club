<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['user_id']) &&
    isset($_POST['email'])) {
    
    include '../../Connexion_BDD.php';
    include "../data/user.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $user_id = $_POST['user_id'];

    $data = 'user_id='.$user_id;

    if (empty($fname)) {
        $em  = "First name is required";
        header("Location: ../user-edit.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em  = "Last name is required";
        header("Location: ../user-edit.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em  = "Username is required";
        header("Location: ../user-edit.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn, $user_id)) {
        $em  = "Username is taken! try another";
        header("Location: ../user-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE students SET
                username = ?, fname=?, lname=?, email=?
                WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname,$fname, $lname, $email, $user_id]);
        $sm = "successfully updated!";
        header("Location: ../user-edit.php?success=$sm&$data");
        exit;
    }
    
  }else {
    $em = "An error occurred";
    header("Location: ../user-edit.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
    header("Location: ../../logout.php");
    exit;
} 
