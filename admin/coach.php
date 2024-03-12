<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])){

    if($_SESSION['role'] == 'Admin') {
        include "../Connexion_BDD.php";
        include "data/coach.php";
        include "data/subject.php";
        include "data/grade.php";
        $coachs = getAllCoachs($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Coach</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="../images/_LOGO HD.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include "inc/navbar.php"; 
        if($coachs != 0){
    ?>
    <div class="container mt-5">
        <a href="coach-add.php" class="btn btn-dark">Add New Coach</a>

        <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" role="alert">
                <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                <?=$_GET['success']?>
            </div>
        <?php } ?>
        <div class="table-responsive">
        <table class="table table-bordered mt-3 n-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($coachs as $coach){ ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?=$coach['coach_id']?></td>
                    <td><?=$coach['fname']?></td>
                    <td><?=$coach['lname']?></td>
                    <td><?=$coach['username']?></td>
                    <td>
                        <?php
                        $s = '';
                        $subjects = str_split(trim($coach['subjects']));
                        foreach($subjects as $subject){
                            $s_temp = getSubjectsById($subject, $conn);
                            if($s_temp !=0)
                            $s .=$s_temp['subject_code'].', ';
                        }
                        echo $s;
                        ?>
                    </td>
                    <td>
                        <?php
                        $g = '';
                        $grades = str_split(trim($coach['grades']));
                        foreach($grades as $grade){
                            $g_temp = getGradeById($grade, $conn);
                            if($g_temp !=0)
                            $g .=$g_temp['grade_code'].'-'.$g_temp['grade'].',';
                        }
                        echo $g;
                        ?>
                    </td>
                    <td>
                        <a href="coach-edit.php?coach_id=<?=$coach['coach_id']?>"
                           class="btn btn-warning">Edit</a>
                        <a href="coach-delete.php?coach_id=<?=$coach['coach_id']?>"
                           class="btn btn-danger">Delete</a>
                    </td>
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
            $("#navLinks li:nth-child(2) a").addClass('active');
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