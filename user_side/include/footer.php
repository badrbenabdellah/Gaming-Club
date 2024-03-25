<?php

    function displayFooter($pageNumber)
    {
    $link1 = '';
    $col = '';
    switch ($pageNumber){
    case 1:
    break;
    case 2:{
        $link1 = '../';
        $col = 'bg-black';
    }
    break;
    default: echo 'Incorrect';
        break;
}
?>
        <!--::footer_part start::-->
        <footer class="footer_part <?=$col?>">
            <div class="footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="single_footer_part">
                                <a href="<?=$link1?>index.php" class="footer_logo_iner"> <img src="<?=$link1?>img/logo.png" alt="#"> </a>
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
<?php
    }
?>
