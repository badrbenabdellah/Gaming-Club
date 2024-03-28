<?php
        require '../../user_side/util.php';
        require '../../user_side/database.php';
        init_php_session();
        $title = '';
        $description = '';
        $start_date = '';
        $end_date = '';
        $prizes = '';
        $conditions = '';

        if (isset($_GET['title'])) $title = $_GET['title'];
        if (isset($_GET['description'])) $description = $_GET['description'];
        if (isset($_GET['start_date'])) $start_date = $_GET['start_date'];
        if (isset($_GET['end_date'])) $end_date = $_GET['end_date'];
        if (isset($_GET['prizes'])) $prizes = $_GET['prizes'];
        if (isset($_GET['conditions'])) $conditions = $_GET['conditions'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Competition</title>
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
        <a href="competition.php" class="btn btn-dark">Go Back</a>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/competition-add.php" enctype="multipart/form-data">
            <h3>Add New Competition</h3><hr>
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
                <input type="text" class="form-control" value="<?=$title?>" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="5"><?=$description?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="start_date" min="<?= date('Y-m-d') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="end_date" min="<?= date('Y-m-d') ?>">
            </div>

            
            <div class="mb-3">
                <label class="form-label">Price (MAD)</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" value="<?= $prizes ?? '100' ?>" name="prizes" step="1" min="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*" >
            </div>

            <div class="mb-3">
                <label class="form-label">Conditions</label>
                <textarea class="form-control" name="conditions" rows="5"><?=$conditions?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
        });
    </script>
</body>
</html>
