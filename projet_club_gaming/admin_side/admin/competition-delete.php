<?php
require '../../user_side/util.php';
require '../../user_side/database.php';
init_php_session();
if (isset($_GET['id'])){

        $id=$_GET['id'];
        if(Database::removeTournament($id)){
            $sm = "Successfully Deleted!";
            header("Location: competition.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: competition.php?error=$sm");
            exit;
        }

}else {
    header("Location: competition.php");
    exit;
}