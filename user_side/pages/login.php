<?php
require '../database.php';
require '../util.php';
init_php_session();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) ){
        $req = Database::getUsers($_POST['username']);
        if($req){
            if(password_verify($_POST['password'], $req['password'])){
                if ($req['is_confirm']){
                    $_SESSION['username'] = $req['username'];
                    $_SESSION['profile_photo'] = $req['profile_photo'];
                    $_SESSION['email'] = $req['email'];
                    $_SESSION['id'] = $req['id'];
                    $_SESSION['is_admin'] = $req['is_admin'];
                    $_SESSION['apply_success_message'] = null;
                    header("location: ../index.php");
                }else{
                    $error_message = 'Your account is not verified yet, check your email';
                }
            }else{
                $error_message = 'username or password incorrect';
            }
        }else{
            $error_message = 'username or password incorrect';
        }
    }
}
?>
<html class="h-full" lang="en">
<head>
    <link rel="stylesheet" href="../output.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Log in</title>
</head>
<body class="dark:bg-slate-900 bg-my-col flex h-full items-center py-16">
<main class="w-full max-w-md mx-auto p-6">
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Welcome</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Don't have an account ?
                    <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="join.php">
                        Join us here
                    </a>
                </p>
            </div>
            <div class="mt-5">
                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">Or</div>

                <!-- Form -->
                <form method="post" action="login.php">
                    <div class="grid gap-y-4">
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

                        <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Se connecter</button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</main>
<script src="../node_modules/preline/dist/preline.js"></script>
</body>
</html>
