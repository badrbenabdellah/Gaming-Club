<?php
require '../../../user_side/util.php';
require '../../../user_side/database.php';
init_php_session();
if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['id']) &&
    isset($_POST['email'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $admin_id = $_POST['id'];

    $data = 'id='.$admin_id;

    if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../admin-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Last name is required";
		header("Location: ../admin-edit.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../admin-edit.php?error=$em&$data");
		exit;
	}else if (Database::unameIsUnique($uname, $admin_id)) {
		$em  = "Username is taken! try another";
		header("Location: ../admin-edit.php?error=$em&$data");
		exit;
	}else {
        global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
        $sql = "UPDATE users SET
                username = ?, fname=?, lname=?, email=?
                WHERE id=?";
        $stmt = $PDO->prepare($sql);
        $stmt->execute([$uname,$fname, $lname, $email, $admin_id]);
        $sm = "successfully updated!";
        header("Location: ../admin-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../admin-edit.php?error=$em");
    exit;
  }