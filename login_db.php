<?php 
session_start();
require_once('connection.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        $_SESSION['error'] = "กรุณากรอกอีเมล";
        header('location:login_form.php');
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = "รูปเเบบอีเมลไม่ถูกต้่อง";
        header('location:login_form.php');
    }else if(empty($password)){
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        header('location:login_form.php');
    }
    
    else{
        try{

            $check_data = $conn->prepare("SELECT * FROM detail_user WHERE email = :email");
            $check_data->bindParam(":email",$email);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

        if($check_data->rowCount() > 0){
            if ($email == $row['email']) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_login'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['age'] = $row['age'];
                    $_SESSION['gender'] = $row['gender'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['address'] = $row['address'];

                    if(!empty($_POST["remember"])) {
                        setcookie ("email",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));
                        setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
                    } else {
                        if(isset($_COOKIE["email"])) {
                            setcookie ("email","");
                        }
                        if(isset($_COOKIE["password"])) {
                            setcookie ("password","");
                            
                        }
                    }
                    header("location:index.php");
                }
             else {
                $_SESSION['error'] = 'รหัสผ่านผิด';
                header('location:login_form.php');
            }
        }
        } else {
            $_SESSION['error'] = 'อีเมลผิด';
            header('location:login_form.php');
        }
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
            header('location:register_form.php');
            
        }
}
}
?>