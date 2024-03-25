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
                                <h2>Tournaments</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb start-->

        <!--::client logo part end::-->
        <section class="client_logo">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="client_logo_slider owl-carousel d-flex justify-content-between">
                            <div class="single_client_logo">
                                <img src="../img/client_logo/fst.png" alt="">
                            </div>
                            <div class="single_client_logo">
                                <img src="../img/client_logo/uae.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::client logo part end::-->

        <!--================Blog Area =================-->
        <?php
        require '../database.php';
        // Définir le nombre d'actualités par page
        $nombre_tournament_par_page = 3;

        // Récupérer le numéro de page actuelle, par défaut 1 si non spécifié
        $page_actuelle = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculer l'offset pour la requête SQL
        $offset = ($page_actuelle - 1) * $nombre_tournament_par_page;

        // Récupérer les actualités pour la page actuelle
        $tournament = Database::getTournamentPerPage($nombre_tournament_par_page, $offset);

        // Récupérer le nombre total d'actualités
        $total_tournament = Database::countTournament();

        // Calculer le nombre total de pages
        $nombre_total_pages = ceil($total_tournament / $nombre_tournament_par_page);
        ?>

        <section class="blog_area section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">
                            <?php
                            while ($data = $tournament->fetch(PDO::FETCH_ASSOC)) {
                                $date = date('d', strtotime($data['date'])); // Jour
                                $month = date('M', strtotime($data['date'])); // Mois (abréviation)
                                ?>
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="<?php echo $data['image_path'] ?>" alt="">
                                        <a href="#" class="blog_item_date">
                                            <h3><?php echo $date; ?></h3>
                                            <p><?php echo $month; ?></p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="tournament-detail.php?id=<?php echo $data['id']; ?>">
                                            <h2><?php echo $data['title'] ?></h2>
                                        </a>
                                    </div>
                                </article>
                            <?php } ?>

                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <!-- Lien vers la page précédente -->
                                    <li class="page-item <?php echo ($page_actuelle <= 1) ? 'disabled' : ''; ?>">
                                        <a href="?page=<?php echo ($page_actuelle - 1); ?>" class="page-link" aria-label="Previous">
                                            <i class="ti-angle-left"></i>
                                        </a>
                                    </li>

                                    <!-- Liens vers les pages -->
                                    <?php for ($i = 1; $i <= $nombre_total_pages; $i++) { ?>
                                        <li class="page-item <?php echo ($page_actuelle == $i) ? 'active' : ''; ?>">
                                            <a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>

                                    <!-- Lien vers la page suivante -->
                                    <li class="page-item <?php echo ($page_actuelle >= $nombre_total_pages) ? 'disabled' : ''; ?>">
                                        <a href="?page=<?php echo ($page_actuelle + 1); ?>" class="page-link" aria-label="Next">
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Area =================-->

        <?php displayFooter(2); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery plugins here-->
    <script src="../js/jquery-1.12.1.min.js"></script>
    <!-- bootstrap js -->
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