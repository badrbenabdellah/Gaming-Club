<?php
require '../../user_side/util.php';
init_php_session();
/*if (!empty($_GET['action']) && $_GET['action'] == 'logout'){
    clean_php_session();
    header("location: ../../user_side/index.php");
}*/
/*session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])){

    if($_SESSION['role'] == 'Admin') {*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Admin</title>
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
        <div class="container text-center">
            <div class="row row-cols-5">
                <a href="admin.php" class="col btn btn-dark m-2 py-3">
                <i class="fa fa-user-md fs-1" aria-hidden="true"></i><br>
                    Admins
                </a>
                <a href="user.php" class="col btn btn-dark m-2 py-3">
                <i class="fa fa-user fs-1" aria-hidden="true"></i><br>
                    Users
                </a>
                <a href="competition.php" class="col btn btn-dark m-2 py-3">
                <i class="fa fa-pencil-square fs-1" aria-hidden="true"></i><br>
                    Competition
                </a>
                
                <a href="actualité.php" class="col btn btn-dark m-2 py-3">
                <i class="fa fa-bullhorn fs-1" aria-hidden="true"></i><br>
                    Actualité
                </a>
                
                <a href="" class="col btn btn-primary m-2 py-3 col-5">
                <i class="fa fa-cogs fs-1" aria-hidden="true"></i><br>
                    Settings
                </a>
                <a href="../logout.php" class="col btn btn-warning m-2 py-3 col-5">
                <i class="fa fa-sign-out fs-1" aria-hidden="true"></i><br>
                    Logout
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(1) a").addClass('active');
        });
    </script>
</body>
</html>
