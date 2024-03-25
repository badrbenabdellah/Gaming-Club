<!-- fichier traitement-login.php -->
<?php
require 'database.php';
require 'util.php';
init_php_session();
if (isset($_POST['valid_connection']))
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $req = Database::getUsers($email);
        if ($req) {
            if (password_verify($password, $req['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['is_admin'] = $req['is_admin'];
                header("location: index.php");
            }
        } else {
            echo "email or password incorrect";
        }
    }


