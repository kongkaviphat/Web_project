<?php 
    session_start();
    require_once('connection.php');


    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <h2>Login</h2><hr>
        <form action="login_db.php" method="post">
        <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" name="email" placeholder="Email" aria-describedby="email">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" id="password" name="password" placeholder="Password" aria-describedby="password" >
                
            </div>
            <label class="form">
                <input type="checkbox" name="remember" >
                <label for="remember">Remember Me</label>
            </label>
            <div class="mb-3">
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
        </form>
        <hr>       
        <span class="text-muted">Don't have an account? 
        <a href="register_form.php" class="btn btn-dark">Register</a>
        </span>
</div>
</body>
</html>