<?php
require '../util.php';
require '../include/header.php';
require '../include/footer.php';
init_php_session();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>gaming</title>
    <link rel="icon" href="../img/favicon.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- animate CSS -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="../css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<?php displayHeader(2); ?>

<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>tournament details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<!--<div class="alert alert-danger" role="alert">

</div> -->
<!--================Blog Area =================-->
<div id="popup" class="alert alert-info" role="alert">
    <?php if(isset($_SESSION['apply_success_message'])){
        echo $_SESSION['apply_success_message'];
    }
        ?>
</div>
<section class="blog_area single-post-area section_padding">
    <div class="container">
        <div class="row">
            <?php
            require '../database.php';
            if (isset($_GET['id'])) {
                $tounament_id = $_GET['id'];
                $tounament_detail = Database::getTournamentById($tounament_id); // Définissez cette méthode dans votre classe Database
                if ($tounament_detail) {
                    ?>
                    <div class="col-lg-8 posts-list m-3">
                        <div class="single-post">
                            <div class="feature-img">
                                <img class="img-fluid" src="<?php echo $tounament_detail['image_path'] ?>" alt="">
                            </div>
                            <div class="blog_details">
                                <h2><?php echo $tounament_detail['title']; ?></h2>
                                <p><?php echo $tounament_detail['detail']; ?></p>
                                <p><?php echo $tounament_detail['conditions']; ?></p>
                            </div>
                        </div>
                            </div>
                        </div><!--w-->
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button" onclick="envoyerIdAvecRedirection(<?php echo $tounament_id; ?>)">Apply now</button>
                        </div>
                    <?php
                } else {
                    echo "competition demandée n'existe pas.";
                }
            } else {
                echo "Identifiant de competition manquant dans l'URL.";
            }
            ?>
        </div>
    </div>
</section>
<!--================Blog Area end =================-->

<script>
    function envoyerIdAvecRedirection(id) {
        // Rediriger avec l'ID inclus dans l'URL
        window.location.href = 'apply-tounament.php?id=' + id;
    }
    document.getElementById("popup").style.display = "block";

    // Cacher le popup après 5 secondes (5000 millisecondes)
    setTimeout(function(){
        document.getElementById("popup").style.display = "none";
    }, 5000); // Durée en millisecondes (ici 5 secondes)
</script>

<?php displayFooter(2); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- jquery plugins here-->
<script src="../js/jquery-1.12.1.min.js"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script><!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<!-- easing js -->
<script src="../js/jquery.magnific-popup.js"></script>
<!-- swiper js -->
<script src="../js/swiper.min.js"></script>
<!-- swiper js -->
<script src="../js/masonry.pkgd.js"></script>
<!-- particles js -->
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.nice-select.min.js"></script>
<!-- slick js -->
<script src="../js/slick.min.js"></script>
<script src="../js/jquery.counterup.min.js"></script>
<script src="../js/waypoints.min.js"></script>
<script src="../js/contact.js"></script>
<script src="../js/jquery.ajaxchimp.min.js"></script>
<script src="../js/jquery.form.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/mail-script.js"></script>
<!-- custom js -->
<script src="../js/custom.js"></script>
</body>

</html>