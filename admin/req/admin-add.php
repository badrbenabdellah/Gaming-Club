<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['pass']) &&
    isset($_POST['email'])) {

        include "../../Connexion_BDD.php";
        include "../data/admin.php";


        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        

        $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname;
        if(empty($fname)) {
            $em  = "First Name is required";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else if(empty($lname)) {
            $em  = "Last name is required";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else if(empty($uname)) {
            $em  = "Username is required";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else if(!unameIsUnique($uname, $conn)) {
            $em  = "Username is taken! try another";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else if (empty($pass)) {
            $em  = "Password is required";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else {
            //hashing the password
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO coachs(username, password, fname,lname,email)
                    VALUES(?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname, $pass, $fname, $lname, $email]);
        }

        $sm = "New Admin registred successfully";
        header("Location: ../admin-add.php?success=$sm");
        exit;

    }else {
        $em = "An error occurred";
        header("Location: ../admin-add.php?error=$em");
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