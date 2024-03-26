<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['competition_id'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../Connexion_BDD.php";
       include "data/competition.php";
       
       $competition_id = $_GET['competition_id'];
       $competition = getCompetitionById($competition_id, $conn);

       if ($competition == 0) {
         header("Location: competition.php");
         exit;
       }
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Competition</title>
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
        <a href="competition.php"
           class="btn btn-dark">Go Back</a>

        <div class="row"> 
        <div class="col">   

          <form method="post"
                  class="shadow p-3 mt-5 form-w" 
                  action="req/competition-edit.php">
            <h3>Edit Competition</h3><hr>
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
                    value="<?=$competition['title']?>" 
                    name="title">
            </div> 
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text"
                       class="form-control" 
                       value="<?=$competition['description']?>"
                       name="description">
            </div>
            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" 
                       class="form-control" 
                       value="<?=$competition['start_date']?>"
                       name="start_date">
            </div>
            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" 
                       class="form-control" 
                       value=<?=$competition['end_date']?>
                       name="end_date">
            </div>
            
            <div class="mb-3">
              <label class="form-label">Prizes (USD)</label>
              <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" 
                         class="form-control"
                         value="<?=$competition['prizes']?>" 
                         name="prizes" step="1" min="0">
              </div>
            </div>


            <input type="text"
                value="<?=$competition['competition_id']?>"
                name="competition_id"
                hidden>
            <div class="mb-3">
                <label class="form-label">Conditions</label>
                <input type="text"
                       class="form-control" 
                       value="<?=$competition['conditions']?>"
                       name="conditions">
            </div>

          <button type="submit" class="btn btn-primary">Update</button>
        </form>
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
    header("Location: competition.php");
    exit;
  } 
}else {
	header("Location: competition.php");
	exit;
} 

?>