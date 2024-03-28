<?php
require '../../user_side/util.php';
require '../../user_side/database.php';
init_php_session();
if (isset($_GET['id'])){

        $id=$_GET['id'];
        if(Database::removeNewsbyId($id)){
            $sm = "Successfully Deleted!";
            header("Location: actualite.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: actualite.php?error=$sm");
            exit;
        }

}else {
    header("Location: actualite.php");
    exit;
}
