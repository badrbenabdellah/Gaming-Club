<?php
        /*require '../../user_side/util.php';
        require '../../user_side/database.php';
        init_php_session();
        $title = '';
        $content = '';
        $date = '';
        $erreur = "";
        if (isset($_GET['title']) && isset($_GET['content']) && isset($_GET['date'])){
            $nom_fichier = $_FILES['image']["name"];
            $taille_fichier = $_FILES['image']["size"];
            $type_fichier = $_FILES['image']["type"];
            $temp_fichier = $_FILES['image']["tmp_name"];

            // Vérifie si le fichier est une image
            $extensions_autorisees = array("jpg", "jpeg", "png");
            $extension_upload = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
            if(in_array($extension_upload, $extensions_autorisees)) {
                // Déplacer le fichier téléchargé vers un emplacement permanent
                $chemin_destination = "../../user_side/img/news/" . $nom_fichier;
                move_uploaded_file($temp_fichier, $chemin_destination);
                $title = $_GET['title'];
                $content = $_GET['content'];
                $date = $_GET['date'];
                Database::AddNews($title,$content,$date,$chemin_destination);
                $message = "Actualité ajouté avec success";

            } else {
                $message = 'Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.';
            }
        }*/
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Actualité</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="../images/_LOGO HD.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
    ?>
    <div class="container mt-5">
        <a href="actualite.php" class="btn btn-dark">Go Back</a>
        <form method="post" class="shadow p-3 mt-5 form-w" action="req/actualite-add.php" enctype="multipart/form-data">
            <h3>Add New Actualité</h3><hr>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['error']?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?=$_GET['success']?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*" >
            </div>

            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="date" min="<?= date('Y-m-d') ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(5) a").addClass('active');
        });
        document.getElementById('close_btn').closest('button').addEventListener('click', function() {
            document.getElementById('popups').style.display = 'none';
        });
    </script>
</body>
</html>