<?php 
        require '../../../user_side/util.php';
        require '../../../user_side/database.php';
        init_php_session();
        if (isset($_POST['title']) &&
            isset($_POST['description']) &&
            isset($_POST['start_date']) &&
            isset($_POST['end_date']) &&
            isset($_POST['prizes']) &&
            isset($_POST['conditions']) && isset($_FILES['image'])) {

            $nom_fichier = $_FILES['image']["name"];
            $taille_fichier = $_FILES['image']["size"];
            $type_fichier = $_FILES['image']["type"];
            $temp_fichier = $_FILES['image']["tmp_name"];

            $extensions_autorisees = array("jpg", "jpeg", "png");
            $extension_upload = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
            if (in_array($extension_upload, $extensions_autorisees)) {
            $chemin_destination = "../../../user_side/img/tournament/".$nom_fichier;
            move_uploaded_file($temp_fichier, $chemin_destination);
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
                Database::addTournament($title,$description,$start_date, $end_date, $prizes, $conditions,$chemin_destination);
                $sm = "New competition registered successfully";
                header("Location: ../competition-add.php?success=$sm");
                exit;
            }

            } else {
            $em = "Only JPG, JPEG, and PNG files are allowed for profile photos.";
            header("Location: ../competition-add.php?error=$em");
            exit;
            }

        } else {
            $em = "An error occurred";
            header("Location: ../competition-add.php?error=$em");
            exit;
        }

