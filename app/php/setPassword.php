<?php
session_start();

include_once "../validation/RegisterRequest.php";
include_once "../models/User.php";

if(empty($_SESSION['email'])){
    header('location:../../errors/404.php');
}
if(isset($_POST['set-password'])){
    // password, confirm password
    // validation 
   $validation = new RegisterRequest;

    $validation->setPassword($_POST['password']);
    $validation->setConfirmPassword($_POST['confirm-password']);
    $passwordValidation = $validation->passwordValidation();
    if($passwordValidation){
        $_SESSION['validation']['password-validation']= $passwordValidation;
        header('location:../../set-password.php');
    }else{
        //update password by email in db
        $user = new User;
        $user->setEmail($_SESSION['email']);
        $user->setPassword($_POST['password']);
        $userUpdated = $user->updateUserPasswordByEmail();
        if($userUpdated){
            // index
            // select user query --> fetch object  = session['user'] 
            // unset $_SESSION['email']

            // login
            unset($_SESSION['email']);
            header('location:../../login.php');
        }else{
            $_SESSION['validation']['something-wrong']= "something wrong";
            header('location:../../set-password.php');
        }
    }
}else{
    header('location:../../errors/403.php');
}

// $_SESSION-->email