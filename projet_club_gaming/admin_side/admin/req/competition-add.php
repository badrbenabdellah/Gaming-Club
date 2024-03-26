<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {

        if (isset($_POST['title']) &&
            isset($_POST['description']) &&
            isset($_POST['start_date']) &&
            isset($_POST['end_date']) &&
            isset($_POST['prizes']) &&
            isset($_POST['conditions'])) {

            include "../../Connexion_BDD.php";
            include "../data/competition.php";

            $title = $_POST['title'];
            $description = $_POST['description'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $prizes = $_POST['prizes'];
            $conditions = $_POST['conditions'];

            // Vérifier si les champs sont vides
            if (empty($title) || empty($description) || empty($start_date) || empty($end_date) || empty($prizes) || empty($conditions)) {
                $em = "All fields are required";
                header("Location: ../competition-add.php?error=$em");
                exit;
            } else {
                // Insérer les données dans la base de données
                $sql = "INSERT INTO competition (title, description, start_date, end_date, prizes, conditions) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$title, $description, $start_date, $end_date, $prizes, $conditions]);
            }

            $sm = "New competition registered successfully";
            header("Location: ../competition-add.php?success=$sm");
            exit;

        } else {
            $em = "An error occurred";
            header("Location: ../competition-add.php?error=$em");
            exit;
        }

    } else {
        header("Location: ../../logout.php");
        exit;
    } 
} else {
    header("Location: ../../logout.php");
    exit;
} 
?>
