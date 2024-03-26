<?php
        require '../../user_side/util.php';
        require '../../user_side/database.php';
        init_php_session();
        $id=$_GET['id'];
        if(Database::removeAdmin($id)){
            $sm = "Successfully Deleted!";
            header("Location: admin.php?success=$sm");
            exit;
        }else{
            $sm = "Unknow error occurred";
            header("Location: admin.php?error=$sm");
            exit;
        }