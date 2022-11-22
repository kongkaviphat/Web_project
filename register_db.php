<?php 
session_start();
require_once('connection.php');

if(isset($_POST['register'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(empty($firstname)){
        $_SESSION['error'] = "กรุณากรอกชื่อ";
        header('location:register_form.php');
    }else if(empty($lastname)){
        $_SESSION['error'] = "กรุณากรอกนามสกุล";
        header('location:register_form.php');
    }else if(empty($email)){
        $_SESSION['error'] = "กรุณากรอกอีเมล";
        header('location:register_form.php');
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = "รูปเเบบอีเมลไม่ถูกต้่อง";
        header('location:register_form.php');
    }else if(empty($password)){
        $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
        header('location:register_form.php');
    }else if(empty($confirm_password)){
        $_SESSION['error'] = "กรุณากรอกยืนยันรหัสผ่าน";
        header('location:register_form.php');
    }else if($password != $confirm_password){
        $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        header('location:register_form.php');
    }else{
        try{
          $check_emil = $conn->prepare("SELECT email FROM detail_user WHERE email = :email");
            $check_emil->bindParam(":email",$email);
            $check_emil->execute();
            $row = $check_emil->fetch(PDO::FETCH_ASSOC);

            if($row['email'] == $email){
                $_SESSION['warning'] = "อีเมลนี้มีผู้ใช้งานแล้ว";
                header('location:register_form.php');
            }else if(!isset($_SESSION['error'])){
                $passwordHash = password_hash($password,PASSWORD_DEFAULT);
                $insert = $conn->prepare("INSERT INTO detail_user(firstname,lastname,email,password)
                                            VALUES(:firstname,:lastname,:email,:password)");
                $insert->bindParam(":firstname",$firstname);
                $insert->bindParam(":lastname",$lastname);
                $insert->bindParam(":email",$email);
                $insert->bindParam(":password",$passwordHash);
                $insert->execute();//เพิ่มข้อมูลลงในฐานข้อมูล

                //เมื่อเพิ่มข้อมูลลงในฐานข้อมูลแล้ว ให้เก็บข้อมูลลงในตัวแปร session
                $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!! <a href='login_form.php' class='alert_link'>เข้าสู่ระบบ</a>";
                header('location:login_form.php');
            }
        }catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
            header('location:register_form.php');
            
        }
}
}

?>