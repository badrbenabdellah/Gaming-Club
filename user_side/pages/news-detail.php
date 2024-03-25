<?php
require '../util.php';
    require '../include/header.php';
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
                     <h2>news details</h2>
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
   <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
             <?php
             require '../database.php';
             // Vérifier si l'identifiant de l'actualité est présent dans l'URL
             if (isset($_GET['id'])) {
                 // Récupérer l'identifiant de l'actualité depuis l'URL
                 $news_id = $_GET['id'];

                 // Récupérer les détails de l'actualité depuis la base de données en fonction de l'identifiant
                 $news_details = Database::getNewsById($news_id); // Définissez cette méthode dans votre classe Database

                 // Vérifier si l'actualité existe
                 if ($news_details) {
                     // Afficher les détails de l'actualité
                     // Assurez-vous de sécuriser et de formater correctement les données avant de les afficher
                     ?>
                     <div class="col-lg-8 posts-list">
                         <div class="single-post">
                             <div class="feature-img">
                                 <img class="img-fluid" src="<?php echo $news_details['image_path'] ?>" alt="">
                             </div>
                             <div class="blog_details">
                                 <h2><?php echo $news_details['title']; ?></h2>
                                 <ul class="blog-info-link mt-3 mb-4">
                                     <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                                 </ul>
                                 <p><?php echo $news_details['content']; ?></p>
                             </div>
                         </div>
                         <div class="navigation-area">
                             <div class="row">
                                 <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                     <?php
                                     // Récupérer l'identifiant de l'actualité précédente
                                     $previous_news_id = Database::getPreviousNewsId($news_id); // Supposons que vous avez une méthode pour récupérer l'identifiant de l'actualité précédente
                                     if ($previous_news_id) {
                                         $previous_news_details = Database::getNewsById($previous_news_id);
                                         ?>
                                         <div class="thumb">
                                             <a href="news-detail.php?id=<?php echo $previous_news_id; ?>">
                                                 <img class="img-fluid" width="100" height="100" src="<?php echo $previous_news_details['image_path']; ?>" alt="">
                                             </a>
                                         </div>
                                         <div class="arrow">
                                             <a href="news-detail.php?id=<?php echo $previous_news_id; ?>">
                                                 <span class="lnr text-white ti-arrow-left"></span>
                                             </a>
                                         </div>
                                         <div class="detials">
                                             <p>Actualité précédente</p>
                                             <a href="news-detail.php?id=<?php echo $previous_news_id; ?>">
                                                 <h4><?php echo $previous_news_details['title']; ?></h4>
                                             </a>
                                         </div>
                                         <?php
                                     }
                                     ?>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                     <?php
                                     // Récupérer l'identifiant de l'actualité suivante
                                     $next_news_id = Database::getNextNewsId($news_id); // Supposons que vous avez une méthode pour récupérer l'identifiant de l'actualité suivante
                                     if ($next_news_id) {
                                         $next_news_details = Database::getNewsById($next_news_id);
                                         ?>
                                         <div class="detials">
                                             <p>Actualité suivante</p>
                                             <a href="news-detail.php?id=<?php echo $next_news_id; ?>">
                                                 <h4><?php echo $next_news_details['title']; ?></h4>
                                             </a>
                                         </div>
                                         <div class="arrow">
                                             <a href="news-detail.php?id=<?php echo $next_news_id; ?>">
                                                 <span class="lnr text-white ti-arrow-right"></span>
                                             </a>
                                         </div>
                                         <div class="thumb">
                                             <a href="news-detail.php?id=<?php echo $next_news_id; ?>">
                                                 <img class="img-fluid" width="100" height="100" src="<?php echo $next_news_details['image_path']; ?>" alt="">
                                             </a>
                                         </div>
                                         <?php
                                     }
                                     ?>
                                 </div>
                             </div>
                         </div><!--w-->
                         <div class="comments-area">
                             <h4>Commentaires</h4>
                             <?php
                             // Récupérer les commentaires associés à l'actualité en cours
                             $comments = Database::getCommentsByNewsId($news_id); // Supposons que vous avez une méthode pour récupérer les commentaires par l'identifiant de l'actualité

                             // Vérifier s'il y a des commentaires à afficher
                             if ($comments->rowCount() > 0) {
                                 // Afficher chaque commentaire
                                 while ($comment = $comments->fetch(PDO::FETCH_ASSOC)) {
                                     $user = Database::getUserById($comment['user_id']);
                                     ?>
                                     <div class="comment-list">
                                         <div class="single-comment justify-content-between d-flex">
                                             <div class="user justify-content-between d-flex">
                                                 <div class="thumb">
                                                     <img src="<?php echo $user['profile_photo']; ?>" alt="">
                                                 </div>
                                                 <div class="desc">
                                                     <p class="comment"><?php echo $comment['comment_text'];?></p>
                                                     <div class="d-flex justify-content-between">
                                                         <div class="d-flex align-items-center">
                                                             <h5><?php echo $user['username']; // ici ligne 228?></h5>
                                                             <p class="date"><?php echo $comment['created_at']; ?></p>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <?php
                                 }
                             } else {
                                 echo "<p>Aucun commentaire trouvé.</p>";
                             }
                             ?>
                         </div>
                         <div class="comment-form">
                             <h4>Leave a Reply</h4>
                             <form class="form-contact comment_form" method="post" action="../add-comment.php" id="commentForm">
                                 <input type="number" hidden="hidden" value="<?= $news_id ?>" name="news_id">
                                 <div class="row">
                                     <div class="col-12">
                                         <div class="form-group">
                                             <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Écrire un commentaire"></textarea>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group mt-3">
                                     <button type="submit" class="button button-contactForm btn_1" >Commenter <i class="flaticon-right-arrow"></i></button>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <?php
                 } else {
                     // Si l'actualité n'existe pas, afficher un message d'erreur ou rediriger l'utilisateur vers une page d'erreur
                     echo "L'actualité demandée n'existe pas.";
                 }
             } else {
                 // Si aucun identifiant d'actualité n'est fourni dans l'URL, afficher un message d'erreur ou rediriger l'utilisateur vers une page d'erreur
                 echo "Identifiant d'actualité manquant dans l'URL.";
             }
             ?>
         </div>
      </div>
   </section>
   <!--================Blog Area end =================-->

   <!--::footer_part start::-->
   <footer class="footer_part bg-black">
       <div class="footer_top">
           <div class="container">
               <div class="row">
                   <div class="col-sm-6 col-lg-3">
                       <div class="single_footer_part">
                           <a href="../index.php" class="footer_logo_iner"> <img src="../img/logo.png" alt="#"> </a>
                           <p>Heaven fruitful doesn't over lesser days appear creeping seasons so behold bearing
                               days
                               open
                           </p>
                       </div>
                   </div>
                   <div class="col-sm-6 col-lg-3">
                       <div class="single_footer_part">
                           <h4>Contact Info</h4>
                           <p>Address : Morocco, Tangier</p>
                           <p>Phone : +212 0674940360</p>
                           <p>Email : info@fstgamingclub.com</p>
                       </div>
                   </div>
                   <div class="col-sm-6 col-lg-3">
                       <div class="single_footer_part">
                           <h4>Newsletter</h4>
                           <p>Heaven fruitful doesn't over lesser in days. Appear creeping seasons deve behold
                               bearing
                               days
                               open
                           </p>
                           <div id="mc_embed_signup">
                               <form target="_blank"
                                     action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                     method="get" class="subscribe_form relative mail_part">
                                   <input type="email" name="email" id="newsletter-form-email"
                                          placeholder="Email Address" class="placeholder hide-on-focus"
                                          onfocus="this.placeholder = ''"
                                          onblur="this.placeholder = ' Email Address '">
                                   <button type="submit" name="submit" id="newsletter-submit"
                                           class="email_icon newsletter-submit button-contactForm"><i
                                               class="far fa-paper-plane"></i></button>
                                   <div class="mt-10 info"></div>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="copygight_text">
           <div class="container">
               <div class="row align-items-center">
                   <div class="col-lg-8">
                       <div class="copyright_text">
                           <P>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | FST GAMING CLUB</P>
                       </div>
                   </div>
                   <div class="col-lg-4">
                       <div class="footer_icon social_icon">
                           <ul class="list-unstyled">
                               <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a>
                               </li>
                               <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                               <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                               <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </footer>
   <!--::footer_part end::-->

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