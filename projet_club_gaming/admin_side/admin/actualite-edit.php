<?php
require '../../user_side/util.php';
require '../../user_side/database.php';
init_php_session();
if (isset($_GET['id'])) {
       
       $id = $_GET['id'];
       $actu = Database::getNewsById($id);

       if ($actu == 0) {
         header("Location: actualite.php");
         exit;
       }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Actualité</title>
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
        <a href="actualite.php"
           class="btn btn-dark">Go Back</a>

        <div class="row"> <!-- Nouvelle ligne pour placer les deux formulaires côte à côte -->
        <div class="col">   

            <form method="post"
                  class="shadow p-3 mt-5 form-w" 
                  action="req/actualite-edit.php">
            <h3>Edit Actualité</h3><hr>
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
                <input type="text" 
                       class="form-control" 
                       value="<?=$actu['title']?>"
                       name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <input type="text"
                       class="form-control"
                       value="<?=$actu['content']?>"
                       name="content">
            </div>
            <input type="text"
                value="<?=$actu['nid']?>"
                name="id"
                hidden>

            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" 
                       class="form-control" 
                       value="<?= date('Y-m-d') ?>" name="date" min="<?= date('Y-m-d') ?>">
            </div>
            

          <button type="submit" class="btn btn-primary">Update</button>
          </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(5) a").addClass('active');
        });
    </script>
</body>
</html>
<?php 

  }else {
    header("Location: actualite.php");
    exit;
  }

?>