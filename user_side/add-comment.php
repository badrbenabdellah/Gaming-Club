<?php
require 'util.php';
require 'database.php';
init_php_session();
if(isset($_POST['comment']) && !empty($_POST['comment'])){
    $news_id = $_POST['news_id'];
    if(is_logged()){
        $commentaire = $_POST['comment'];
        $user_id = $_SESSION['id'];
        Database::addComment($news_id, $user_id, $commentaire);
        //echo "commentaire ajouter avec success";
        header("location: pages/news-detail.php?id=".$news_id);
    }else{
        header("location: pages/news-detail.php?id=".$news_id);
    }
}
?>