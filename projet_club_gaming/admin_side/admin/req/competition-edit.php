<?php
require '../../../user_side/util.php';
require '../../../user_side/database.php';
init_php_session();
if (isset($_POST['competition_id']) &&
    isset($_POST['title']) &&
    isset($_POST['description']) &&
    isset($_POST['start_date']) &&
    isset($_POST['end_date']) &&
    isset($_POST['prizes']) &&
    isset($_POST['conditions'])) {

    $competition_id = $_POST['competition_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $prizes = $_POST['prizes'];
    $conditions = $_POST['conditions'];

    $data = 'id='.$competition_id;

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
       Database::updateTournamentById($competition_id,$title,$description,$start_date,$end_date,$prizes,$conditions);
      $sm = "successfully updated!";
      header("Location: ../competition-edit.php?success=$sm&$data");
      exit;
    }
    
  }else {
  	$em = "An error occurred";
    header("Location: ../competition-edit.php?error=$em");
    exit;
  }
