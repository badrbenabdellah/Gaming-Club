<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['competition_id']) &&
    isset($_POST['title']) &&
    isset($_POST['description']) &&
    isset($_POST['start_date']) &&
    isset($_POST['end_date']) &&
    isset($_POST['prizes']) &&
    isset($_POST['conditions'])) {
    
    include '../../Connexion_BDD.php';
    include "../data/competition.php";

    $competition_id = $_POST['competition_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $prizes = $_POST['prizes'];
    $conditions = $_POST['conditions'];

    $data = 'competition_id='.$competition_id;

    if (empty($title)) {
		$em  = "Title is required";
		header("Location: ../competition-edit.php?error=$em&$data");
		exit;
    }else if (empty($description)) {
      $em  = "Description is required";
      header("Location: ../competition-edit.php?error=$em&$data");
      exit;
    }else if (empty($start_date)) {
      $em  = "Start Date is required";
      header("Location: ../competition-edit.php?error=$em&$data");
      exit;
    }else if (empty($end_date)) {
      $em  = "End Date is required";
      header("Location: ../competition-edit.php?error=$em&$data");
      exit;
    }else if (empty($prizes)) {
      $em  = "Prizes is required";
      header("Location: ../competition-edit.php?error=$em&$data");
      exit;
    }else {
          $sql = "UPDATE competition SET
                  title = ?, description = ?, start_date = ?, end_date = ?, prizes=?, conditions=?
                  WHERE competition_id=?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$title,$description, $start_date, $end_date, $prizes, $conditions, $competition_id]);
          $sm = "successfully updated!";
          header("Location: ../competition-edit.php?success=$sm&$data");
          exit;
    }
    
  }else {
  	$em = "An error occurred";
    header("Location: ../competition-edit.php?error=$em");
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
