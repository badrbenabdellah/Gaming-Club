<?php
require '../database.php';
require '../util.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $erreur = "";
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['fname']) && !empty($_POST['fname'])
        && isset($_POST['lname']) && !empty($_POST['lname'])) {

        $nom_fichier = $_FILES['profile_photo']["name"];
        $taille_fichier = $_FILES['profile_photo']["size"];
        $type_fichier = $_FILES['profile_photo']["type"];
        $temp_fichier = $_FILES['profile_photo']["tmp_name"];

        // Vérifie si le fichier est une image
        $extensions_autorisees = array("jpg", "jpeg", "png");
        $extension_upload = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if(in_array($extension_upload, $extensions_autorisees)) {
            // Déplacer le fichier téléchargé vers un emplacement permanent
            $chemin_destination = "../img/user_profile_image/" . $nom_fichier;
            move_uploaded_file($temp_fichier, $chemin_destination);
            Database::addUsers($_POST['username'], $_POST['email'],$_POST['fname'],$_POST['lname'], $hashed_password, $chemin_destination);
            $user = Database::getUsers($_POST['username']);
            if(smtpmailer($_POST['email'], 'boubacar34sangare@gmail.com', 'FST GAMING CLUB', 'Confirmation of Your Email Address', $user['id'], $user['cle']) == 1){
                $message = 'Account created successfully. Please check your email to verify your account.';
            }else{
                $message = 'Error when sending confirmation email.';
            }

        } else {
            $message = 'Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.';
        }
        if(empty($temp_fichier)){
            Database::addUsers($_POST['username'], $_POST['email'],$_POST['fname'],$_POST['lname'], $hashed_password, $temp_fichier);
            $user = Database::getUsers($_POST['username']);
            if(smtpmailer($_POST['email'], 'boubacar34sangare@gmail.com', 'FST GAMING CLUB', 'Confirmation of Your Email Address', $user['id'], $user['cle']) == 1){
                $message = 'Account created successfully. Please check your email to verify your account.';
            }else{
                $message = 'Error when sending confirmation email.';
            }
        }
    }else{
        $message = 'You must give all the information';
    }
}
?>
<html class="h-full" lang="en">
<head>
    <link rel="stylesheet" href="../output.css">
    <title>Join Us</title>
</head>
<body class="dark:bg-slate-900 bg-my-col flex h-full items-center py-16">
<main class="w-full max-w-md mx-auto p-6 mt-10">
    <!-- Toast -->
    <div class="max-w-xs bg-blue-500 text-sm text-white rounded-xl shadow-lg" role="alert" id="popup" hidden="<?php if (!isset($message)) echo 'hidden' ?>">
        <div class="flex p-4">
            <?php if(isset($message)){
                echo $message;
            }
            ?>
            <div class="ms-auto">
                <button type="button" id="cls" class="inline-flex flex-shrink-0 justify-center items-center size-5 rounded-lg text-white hover:text-white opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
    <!-- End Toast -->
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Welcome</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="login.php">
                        Log in here
                    </a>
                </p>
            </div>

            <div class="mt-5">
                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">Or</div>

                <!-- Form -->
                <form method="post" action="join.php" enctype="multipart/form-data">
                    <div class="grid gap-y-4">
                        <!-- Form Group -->
                        <div>
                            <label for="fname" class="block text-sm mb-2 dark:text-white">Fisrt Name</label>
                            <div class="relative">
                                <input type="text" id="fname" name="fname" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="password-error">
                                <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                    <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->
                        <!-- Form Group -->
                        <div>
                            <label for="lname" class="block text-sm mb-2 dark:text-white">Last Name</label>
                            <div class="relative">
                                <input type="text" id="lname" name="lname" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="password-error">
                                <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                    <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->
                        <!-- Form Group -->
                        <div>
                            <label for="username" class="block text-sm mb-2 dark:text-white">Username</label>
                            <div class="relative">
                                <input type="text" id="username" name="username" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="password-error">
                                <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                    <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->
                        <!-- Form Group -->
                        <div>
                            <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                            <div class="relative">
                                <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="email-error">
                                <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                    <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="hidden text-xs text-red-600 mt-2" id="email-error">Please include a valid email address so we can get back to you</p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="password-error">
                                <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                                    <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->

                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input name="profile_photo" type="file" accept="image/*" class="block w-full text-sm text-gray-500
                          file:me-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:text-sm file:font-semibold
                          file:bg-blue-600 file:text-white
                          hover:file:bg-blue-700
                          file:disabled:opacity-50 file:disabled:pointer-events-none
                          dark:file:bg-blue-500
                          dark:hover:file:bg-blue-400
                        ">
                        </label>

                        <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Join us</button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById('cls').closest('button').addEventListener('click', function() {
        document.getElementById('popup').style.display = 'none';
    });
</script>
<script src="../node_modules/preline/dist/preline.js"></script>
</body>
</html>