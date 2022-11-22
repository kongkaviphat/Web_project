<?php 
session_start();
require_once('connection.php');
if(isset($_POST['editprofile']))
    $email = $_SESSION['user_login'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if(empty($username)){
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้";
        header('location:editprofile_form.php');
    }else if(empty($firstname)){
        $_SESSION['error'] = "กรุณากรอกชื่อ";
        header('location:editprofile_form.php');
    }else if(empty($lastname)){
        $_SESSION['error'] = "กรุณากรอกนามสกุล";
        header('location:editprofile_form.php');
    }else if(empty($age)){
        $_SESSION['error'] = "กรุณากรอกอายุ";
        header('location:editprofile_form.php');
    }else if(empty($gender)){
        $_SESSION['error'] = "กรุณาเลือกเพศ";
        header('location:editprofile_form.php');
    }else if(empty($phone)){
        $_SESSION['error'] = "กรุณากรอกเบอร์โทรศัพท์";
        header('location:editprofile_form.php');
    }else if(empty($address)){
        $_SESSION['error'] = "กรุณากรอกที่อยู่";
        header('location:editprofile_form.php');
    }else{
        try{
            $check_data = $conn->prepare("SELECT * FROM detail_user WHERE email = :email");
            $check_data->bindParam(":email",$email);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);
            if($check_data->rowCount() > 0){
                $update_data = $conn->prepare("UPDATE detail_user SET username = :username,firstname = :firstname, lastname = :lastname, age = :age,
                gender = :gender,phone = :phone, address = :address WHERE email = :email");

                $update_data->bindParam(":email",$email);
                $update_data->bindParam(":username",$username);
                $update_data->bindParam(":firstname",$firstname);
                $update_data->bindParam(":lastname",$lastname);
                $update_data->bindParam(":age",$age);
                $update_data->bindParam(":gender",$gender);
                $update_data->bindParam(":phone",$phone);
                $update_data->bindParam(":address",$address);
                
                if($update_data->execute()){
                    $_SESSION['success'] = "แก้ไขข้อมูลส่วนตัวสำเร็จ";
                    header('location:editprofile_form.php');
                }else{
                    $_SESSION['error'] = "แก้ไขข้อมูลส่วนตัวไม่สำเร็จ";
                    header('location:editprofile_form.php');
                }
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    //update to showrealtime editprofile_form.php
    $_SESSION['username'] = $row['username'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['age'] = $age;
    $_SESSION['gender'] = $gender;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;

    }

?>
