<?php
require '../../../user_side/util.php';
require '../../../user_side/database.php';
init_php_session();
if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['pass']) &&
    isset($_POST['email'])) {

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
        }else if(Database::unameIsUnique($uname)) {
            $em  = "Username is taken! try another";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else if (empty($pass)) {
            $em  = "Password is required";
            header("Location: ../admin-add.php?error=$em&$data");
            exit;
        }else {
            //hashing the password
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $cle = rand(1000000, 9000000);
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $PDO->prepare("INSERT INTO users (email, password, fname, lname, username,is_admin, is_confirm, cle) VALUES (:email, :password, :fname, :lname, :username,true, true, :cle)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':username', $uname);
            $stmt->bindParam(':cle', $cle);
            $stmt->execute();
        }

        $sm = "New Admin registred successfully";
        header("Location: ../admin-add.php?success=$sm");
        exit;

    }else {
        $em = "An error occurred";
        header("Location: ../admin-add.php?error=$em");
        exit;
    }