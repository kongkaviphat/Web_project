<?php

$db = mysqli_connect("localhost","root","","reviewfood");

if(isset($_POST['email_check'])){
    $email = $_POST['email'];
    $sql = "SELECT * FROM detail_user WHERE email = '$email'";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "taken";
    }else{
        echo "not_taken";
    }
    exit();
}
if(isset($_POST['save'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO detail_user (firstname,lastname,email,password) VALUES ('$firstname','$lastname','$email','$password')";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "exist";
        exit();
    }else{
        
        $query = "INSERT INTO detail_user (firstname,lastname,email,password) VALUES ('$firstname','$lastname','$email','".md5($password)."')";
        $result = mysqli_query($db,$query);
        echo "success";
        exit();
        
    }
}
?>


    

