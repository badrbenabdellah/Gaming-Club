<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../Connexion_BDD.php";
        include "../data/actualité.php";

        if (!empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $nom_fichier = $_FILES['image']["name"];
            $taille_fichier = $_FILES['image']["size"];
            $type_fichier = $_FILES['image']["type"];
            $temp_fichier = $_FILES['image']["tmp_name"];

            $extensions_autorisees = array("jpg", "jpeg", "png");
            $extension_upload = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
            if (in_array($extension_upload, $extensions_autorisees)) {

                $chemin_destination = "../images/actualites/" . $nom_fichier;
                move_uploaded_file($temp_fichier, $chemin_destination);
            } else {
                $em = "Only JPG, JPEG, and PNG files are allowed for profile photos.";
                header("Location: ../actualité-add.php?error=$em");
                exit;
            }
        }

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $date = date('Y-m-d H:i:s');

        $image = isset($chemin_destination) ? $chemin_destination : '';

        if (empty($title) || empty($content)) {
            $em = "Title and Content are required";
            header("Location: ../actualité-add.php?error=$em");
            exit;
        }

        $sql = "INSERT INTO actualités(title, content, date, image)
                VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $content, $date, $image]);

        $sm = "New Actualité added successfully";
        header("Location: ../actualité-add.php?success=$sm");
        exit;
    } else {
        $em = "An error occurred";
        header("Location: ../actualité-add.php?error=$em");
        exit;
    }
} else {
    header("Location: ../../logout.php");
    exit;
}
?>
