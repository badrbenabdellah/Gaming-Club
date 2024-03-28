<?php
        require '../../../user_side/util.php';
        require '../../../user_side/database.php';
        init_php_session();
        if (isset($_POST['id']) &&
            isset($_POST['title']) &&
            isset($_POST['content'])) {

            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];

            $data = 'id=' . $id;

            if (empty($title)) {
                $em  = "Title is required";
                header("Location: ../actualite-edit.php?error=$em&$data");
                exit;
            } elseif (empty($content)) {
                $em  = "Content is required";
                header("Location: ../actualite-edit.php?error=$em&$data");
                exit;
            } else {
                // Update the actualité without image
                Database::updateNewsById($id,$title,$content);
                $sm = "successfully updated!";
                header("Location: ../actualite-edit.php?success=$sm&$data");
                exit;
            }
        } else {
            $em = "An error occurred";
            header("Location: ../actualite-edit.php?error=$em");
            exit;
        }

