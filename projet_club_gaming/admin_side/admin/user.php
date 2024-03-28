<?php
        require '../../user_side/util.php';
        require '../../user_side/database.php';
        init_php_session();
        $users = Database::getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User </title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="../images/_LOGO HD.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "inc/navbar.php"; 
        if($users != 0){
    ?>
    <div class="container mt-5">
        <a href="user-add.php" class="btn btn-dark">Add New User</a>

        <form action="user-search.php" 
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
            <div class="alert alert-danger mt-3 " role="alert">
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
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <!--<th scope="col">Action</th>-->
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach($users as $user) {
                    $i++; ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$user['id']?></td>
                    <td><?=$user['fname']?></td>
                    <td><?=$user['lname']?></td>
                    <td><?=$user['username']?></td>
                    <td><?=$user['email']?></td>
                    <!--<td>
                        <a href="user-edit.php?user_id=<?=$user['id']?>" class="btn btn-warning">Edit</a>
                        <a href="user-delete.php?user_id=<?=$user['id']?>" class="btn btn-danger">Delete</a>
                    </td>-->
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <?php }else{ ?>
            <div class="alert alert-info .w-450 m-5" role="alert">
                Empty!
            </div>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(3) a").addClass('active');
        });
    </script>
</body>
</html>