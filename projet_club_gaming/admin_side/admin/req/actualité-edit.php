<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        
        if (isset($_POST['id']) &&
            isset($_POST['title']) &&
            isset($_POST['content'])) {
            
            include '../../Connexion_BDD.php';
            include "../data/competition.php";

            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];

            $data = 'id=' . $id;

            if (empty($title)) {
                $em  = "Title is required";
                header("Location: ../actualité-edit.php?error=$em&$data");
                exit;
            } elseif (empty($content)) {
                $em  = "Content is required";
                header("Location: ../actualité-edit.php?error=$em&$data");
                exit;
            } else {
                // Update the actualité without image
                $sql = "UPDATE actualités SET
                        title = ?, content = ?
                        WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$title, $content, $id]);
                $sm = "successfully updated!";
                header("Location: ../actualité-edit.php?success=$sm&$data");
                exit;
            }
        } else {
            $em = "An error occurred";
            header("Location: ../actualité-edit.php?error=$em");
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
