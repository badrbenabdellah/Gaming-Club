<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])){

    if($_SESSION['role'] == 'Admin') {
      if(isset($_POST['searchkey'])) {

        $search_key = $_POST['searchkey'];
        include "../Connexion_BDD.php";
        include "data/admin.php";
        $admins = SearchAdmin($search_key,$conn);
        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Search Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="../images/_LOGO HD.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "inc/navbar.php"; 
        if($admins != 0){
    ?>
    <div class="container mt-5">
        <a href="admin-add.php" class="btn btn-dark">Add New Admin</a>
        
        <form action="admin-search.php" 
              method="post"
              class="mt-3 ">
            <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchkey"
                       value="<?=$search_key?>"
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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach($admins as $admin) {
                    $i++; ?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$admin['admin_id']?></td>
                    <td><?=$admin['fname']?></td>
                    <td><?=$admin['lname']?></td>
                    <td><?=$admin['username']?></td>
                    <td><?=$admin['email']?></td>
                    <td>
                        <a href="admin-edit.php?admin_id=<?=$admin['admin_id']?>" class="btn btn-warning">Edit</a>
                        <a href="admin-delete.php?admin_id=<?=$admin['admin_id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <?php }else{ ?>
            <div class="alert alert-info .w-450 m-5" role="alert">
            <a href="admin.php" class="btn btn-dark">Go Back</a>
            </div>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(2) a").addClass('active');
        });
    </script>
</body>
</html>
<?php

}else {
  header("Location: admin.php");
  exit;
}

}else {
    header("Location: ../Login.php");
    exit;
}

}else {
    header("Location: ../Login.php");
    exit;
}
?>