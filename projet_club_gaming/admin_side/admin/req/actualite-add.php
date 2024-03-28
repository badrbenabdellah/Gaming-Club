<?php
        require '../../../user_side/util.php';
        require '../../../user_side/database.php';
        init_php_session();

        if (isset($_FILES['image']) && !empty($_FILES['image'])) {
            $nom_fichier = $_FILES['image']["name"];
            $taille_fichier = $_FILES['image']["size"];
            $type_fichier = $_FILES['image']["type"];
            $temp_fichier = $_FILES['image']["tmp_name"];

            $extensions_autorisees = array("jpg", "jpeg", "png");
            $extension_upload = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
            if (in_array($extension_upload, $extensions_autorisees)) {
                $chemin_destination = "../../../user_side/img/news/".$nom_fichier;
                move_uploaded_file($temp_fichier, $chemin_destination);
            } else {
                $em = "Only JPG, JPEG, and PNG files are allowed for profile photos.";
                header("Location: ../actualite-add.php?error=$em");
                exit;
            }
        }else{
            $em = "Image are required";
            header("Location: ../actualite-add.php?error=$em");
            exit;
        }

        $title = $_POST['title']??'';
        $content = $_POST['content']??'';
        $date = $_POST['date'];

        if (empty($title) || empty($content)) {
            $em = "Title and Content are required";
            header("Location: ../actualite-add.php?error=$em");
            exit;
        }
        Database::AddNews($title,$content,$date,$chemin_destination);
        $sm = "New Actualite added successfully";
        header("Location: ../actualite-add.php?success=$sm");

