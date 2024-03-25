<?php
    require 'util.php';
    require 'include/header.php';
    require 'include/footer.php';
    init_php_session();
    if (!empty($_GET['action']) && $_GET['action'] == 'logout'){
        clean_php_session();
        header("location: index.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FST GAMING CLUB</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- animate CSS
    <link rel="stylesheet" href="css/animate.css"> -->
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- flaticon CSS
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css"> -->
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS
    <link rel="stylesheet" href="css/slick.css"> -->
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!--<link rel="stylesheet" href="output.css">-->
</head>

<body>
    <div class="body_bg">

        <?php displayHeader(1); ?>

        <!-- banner part start-->
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-md-8">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                                <h1>Welcome to FST GAMING CLUB</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore
                                    magna aliqua. Quis ipsum </p>
                                <?php if (!is_logged()){echo '<a href="pages/join.php" class="btn_1">Join Now</a>';} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner part start-->

        <!--::client logo part end::-->
        <section class="client_logo">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="client_logo_slider owl-carousel d-flex justify-content-between">
                            <div class="single_client_logo">
                                <img src="img/client_logo/fst.png" alt="">
                            </div>
                            <div class="single_client_logo">
                                <img src="img/client_logo/uae.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::client logo part end::-->

        <!-- about_us part start-->
        <section class="about_us section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-5 col-lg-6 col-xl-6">
                        <div class="learning_img">
                            <img src="img/about_img.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6 col-xl-5">
                        <div class="about_us_text">
                            <h2>Find out about us in history</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. </p>
                            <a href="#" class="btn_1">Discover the team</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about_us part end-->

        <!--::about_us part start::-->
        <section class="live_stareams padding_bottom">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-2 offset-lg-2 offset-sm-1">
                        <div class="live_stareams_text">
                            <h2>Watch our last <br> tournaments</h2>
                            <a href="#"><div class="btn_1">Go to the channel</div></a>
                        </div>
                    </div>
                    <div class="col-md-7 offset-sm-1">
                        <div class="live_stareams_slide owl-carousel">
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_1.png" alt="">
                                <div class="extends_video">
                                    <a  class="video-play-button popup-youtube"
                                        href="https://youtu.be/V49iSQ326Hw?si=Z_aObclGqjhm_zGc">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_2.png" alt="">
                                <div class="extends_video">
                                    <a class="video-play-button popup-youtube"
                                        href="https://youtu.be/V49iSQ326Hw?si=Z_aObclGqjhm_zGc">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_1.png" alt="">
                                <div class="extends_video">
                                    <a class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::about_us part end::-->

        <!-- use sasu part end -->
        <section class="Latest_War">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section_tittle text-center">
                            <h2>Upcoming Tournament</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12">
                        <div class="Latest_War_text">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-lg-6">
                                    <div class="single_war_text text-center">
                                        <img src="img/favicon.png" alt="">
                                        <h4>Open War chalange</h4>
                                        <p>27 june , 2020</p>
                                        <a href="#">view fight</a>
                                        <div class="war_text_item d-flex justify-content-around align-items-center">
                                            <img src="img/war_logo_1.png" alt="">
                                            <h2>190<span>vs</span>189</h2>
                                            <img src="img/war_logo_2.png" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn_2">Watch detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- use sasu part end-->

        <?php displayFooter(1); ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery plugins here-->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script><!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- slick js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>