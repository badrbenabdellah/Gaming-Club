<?php
    require 'util.php';
    require 'database.php';
    init_php_session();
    if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['cle']) && !empty($_GET['cle'])){
        $user = Database::getUserByIdKey($_GET['id'], $_GET['cle']);
        if($user){
            if($user['is_confirm']){
                $_SESSION['cle'] = $user['cle'];
                header("location: index.php");
            }else{
                Database::updateUserIsComfirm(true, $user['id']);
                $_SESSION['cle'] = $user['cle'];
                echo 'verifier avec succsess';
                //header("location: index.php");
            }
        }else{
            echo 'No user found';
        }
    }else{
        echo 'No user found';
    }
    ?>