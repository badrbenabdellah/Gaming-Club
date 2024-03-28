<?php
    //require 'util.php';
    function displayHeader($pageNumber)
    {
        $link1 = '';
        $link2 = '';
        $link3 = '';
        $link4 = '';
        $link5 = '';
        $link6 = '';
        switch ($pageNumber){
            case 1:{
                $link2 = 'pages/news.php';
                $link3 = 'pages/login.php';
                $link4 = 'pages/join.php';
                $link5 = 'pages/tournament.php';
            }
            break;
            case 2:{
                $link1 = '../';
                $link2 = 'news.php';
                $link3 = 'login.php';
                $link4 = 'join.php';
                $link5 = 'tournament.php';
                $link6 = '../';
            }
            break;
            default: echo 'Incorrect';
                break;
        }
        ?>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- style CSS -->
        <link rel="stylesheet" href="<?=$link1?>css/style.css">
        <!--::header part start::-->
        <header class="main_menu single_page_menu">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="<?=$link1?>index.php"> <img src="<?=$link1?>img/logo.png" alt="logo"> </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu_icon"><i class="fas fa-bars"></i></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=$link1?>index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=$link2?>">News</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?=$link5?>">Tournaments</a>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                            if(!is_logged())
                                                echo '<a class="nav-link" href="'.$link3.'" id="navbarDropdown1"
                                           role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            Log In
                                        </a>';
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            if (is_logged()) {
                                ?>
                                <div class="dropdown">
                                    <button class="btn " type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                        <img class="inline-block size-8 " style="border-radius: 50%" width="50px" height="50px" src="<?php echo $link6.$_SESSION['profile_photo']; ?>" alt="Image Description">
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?=$link1?>index.php?action=logout">Log out</a></li>
                                    </ul>
                                </div>
                                <?php
                            } else {
                                echo '<a href="'.$link4.'" class="btn_1 d-none d-sm-block">Join Now</a>';
                            }
                            ?>

                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header part end-->
     <?php
    }
?>