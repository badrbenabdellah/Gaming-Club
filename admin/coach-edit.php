<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['coach_id'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../Connexion_BDD.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/coach.php";
       $subjects = getAllSubjects($conn);
       $grades = getAllGrades($conn);
       
       $coach_id = $_GET['coach_id'];
       $coach = getCoachById($coach_id, $conn);

       if ($coach == 0) {
         header("Location: coach.php");
         exit;
       }
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Coach</title>
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
        <a href="coach.php"
           class="btn btn-dark">Go Back</a>

        <div class="row"> <!-- Nouvelle ligne pour placer les deux formulaires côte à côte -->
        <div class="col">   

            <form method="post"
                  class="shadow p-3 mt-5 form-w" 
                  action="req/coach-edit.php">
            <h3>Edit Coach</h3><hr>
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
              <label class="form-label">First name</label>
              <input type="text" 
                    class="form-control"
                    value="<?=$coach['fname']?>" 
                    name="fname">
            </div>
            <div class="mb-3">
              <label class="form-label">Last name</label>
              <input type="text" 
                    class="form-control"
                    value="<?=$coach['lname']?>"
                    name="lname">
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" 
                    class="form-control"
                    value="<?=$coach['username']?>"
                    name="username">
            </div>
            <input type="text"
                    value="<?=$coach['coach_id']?>"
                    name="coach_id"
                    hidden>

            <div class="mb-3">
              <div class="row row-cols-5">
                <?php 
                $subject_ids = str_split(trim($coach['subjects']));
                foreach ($subjects as $subject){ 
                  $checked =0;
                  foreach ($subject_ids as $subject_id ) {
                    if ($subject_id == $subject['subject_id']) {
                      $checked =1;
                    }
                  }
                ?>
                <div class="col">
                  <input type="checkbox"
                        name="subjects[]"
                        <?php if($checked) echo "checked"; ?>
                        value="<?=$subject['subject_id']?>">
                        <?=$subject['subject']?>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Grade</label>
              <div class="row row-cols-5">
                <?php 
                  $grade_ids = str_split(trim($coach['grades']));
                  foreach ($grades as $grade){ 
                    $checked =0;
                    foreach ($grade_ids as $grade_id ) {
                      if ($grade_id == $grade['grade_id']) {
                        $checked =1;
                    }
                  }
                ?>
                <div class="col">
                  <input type="checkbox"
                        name="grades[]"
                        <?php if($checked) echo "checked"; ?>
                        value="<?=$grade['grade_id']?>">
                        <?=$grade['grade_code']?>-<?=$grade['grade']?>
                </div>
                <?php } ?>
              </div>
            </div>

          <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col"> 
     <form method="post"
              class="shadow p-3 my-5 form-w" 
              action="req/coach-change.php"
              id="change_password">
        <h3>Change Password</h3><hr>
          <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
             <?=$_GET['perror']?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
             <?=$_GET['psuccess']?>
            </div>
          <?php } ?>

       <div class="mb-3">
            <div class="mb-3">
            <label class="form-label">Admin password</label>
                <input type="password" 
                       class="form-control"
                       name="admin_pass"> 
          </div>

            <label class="form-label">New password </label>
            <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="new_pass"
                       id="passInput">
                <button class="btn btn-secondary"
                        id="gBtn">
                        Random</button>
            </div>
            
          </div>
          <input type="text"
                value="<?=$coach['coach_id']?>"
                name="coach_id"
                hidden>

          <div class="mb-3">
            <label class="form-label">Confirm new password  </label>
                <input type="text" 
                       class="form-control"
                       name="c_new_pass"
                       id="passInput2"> 
          </div>
          <button type="submit" 
              class="btn btn-primary">
              Change</button>
        </form>
     </div>
      </div>
          </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * 
         charactersLength));

           }
           var passInput = document.getElementById('passInput');
           var passInput2 = document.getElementById('passInput2');
           passInput.value = result;
           passInput2.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(4);
        });
    </script>
</body>
</html>
<?php 

  }else {
    header("Location: coach.php");
    exit;
  } 
}else {
	header("Location: coach.php");
	exit;
} 

?>