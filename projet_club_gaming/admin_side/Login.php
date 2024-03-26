<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="./images/_LOGO HD.png">
</head>
<body class="body-login">
    <div class="black-fill"> <br> 
        <div class="d-flex justify-content-center align-items-center flex-column flex-column">
         
        <form class="login" method="post" action="./req/Login.php">
            <div class="text-center">
                <img src="./images/_LOGO HD.png" width="100">
            </div>
            <h3>Login</h3>
            <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?=$_GET['error']?>
            </div>
            <?php } ?>
            <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="uname">
            </div>
            <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="pass">
            </div>
            <div class="mb-3">
            <label class="form-label">Login As</label>
            <select class="form-control" name="role">
                <option value="1">Admin</option>
                <option value="3">Student</option>
                <option value="2">Coach</option>
            </select>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="index.php" class="text-decoration-none">Home</a>
        </form>
        <br>
        <div class="text-center text-light">
            <br>
            Copyright &copy; 2024 Gaming Club. All rights reserved
        </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>