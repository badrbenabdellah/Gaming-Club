<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/competition.php"; 
        $competitions = getAllCompetitions($conn)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Competition</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="../images/_LOGO HD.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "inc/navbar.php"; 
        if($competitions != 0){
    ?>
    <div class="container mt-5">
        <a href="competition-add.php" class="btn btn-dark">Ajouter une nouvelle compétition</a>
        
        <form action="competition-search.php" 
              class="mt-3"
              method="post">
            <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchkey"
                       placeholder="Search.......">
                <button class="btn btn-primary" id="gBtn">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>

        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 " role="alert">
                <?=$_GET['success']?>
            </div>
        <?php } ?>
        <div class="table-responsive">
        <table class="table table-bordered mt-3 ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date début</th>
                    <th scope="col">Date fin</th>
                    <th scope="col">Prix gagnants (USD)</th>
                    <th scope="col">Conditions participation</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach($competitions as $competition) {
                    $i++; ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$competition['competition_id']?></td>
                    <td><?=$competition['title']?></td>
                    <td><?=$competition['description']?></td>
                    <td><?=$competition['start_date']?></td>
                    <td><?=$competition['end_date']?></td>
                    <td><?=$competition['prizes']?></td>
                    <td><?=$competition['conditions']?></td>
                    <td>
                        <a href="competition-edit.php?competition_id=<?=$competition['competition_id']?>" class="btn btn-warning">Edit</a>
                        <a href="competition-delete.php?competition_id=<?=$competition['competition_id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <?php }else{ ?>
            <div class="alert alert-info .w-450 m-5" role="alert">
                Vide !
            </div>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(4) a").addClass('active');
        });
    </script>
</body>

</html>
<?php
}else {
    header("Location: ../Login.php");
    exit;
}
}else {
    header("Location: ../Login.php");
    exit;
}
?>
