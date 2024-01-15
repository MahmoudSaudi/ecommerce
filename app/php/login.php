<?php
session_start();
include_once "../validation/RegisterRequest.php";
include_once "../validation/LoginRequest.php";
include_once "../models/User.php";
include_once "../mail/sendMail.php";
// login
// validation password , email 
if(isset($_POST['login'])){
    // validation email -->required, regex
    $emailValidation = new RegisterRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation(); 

     if($emailValidationResult){
         $_SESSION['validation']['email-validation']= $emailValidationResult;
         header('location:../../login.php');
     }else{
         // validation email -->exists in db
         $emailDataBaseCheck = $emailValidation->emailDataBaseCheck();
         if(empty($emailDataBaseCheck)){ //[]
             $_SESSION['validation']= ['email-not-exists'=>'Email Not exists'];
             header('location:../../login.php');
         }
     }

     //password validation
     $passwordValidation = new LoginRequest;
     $passwordValidation->setPassword($_POST['password']);
     $passwordValidationResult = $passwordValidation->passwordValidation();
     if($passwordValidationResult){
        $_SESSION['validation']['password-validation']= $passwordValidationResult;  // show it in html
        header('location:../../login.php');
     }

     if(empty($_SESSION['validation'])){
        // check user on db
        $user= new User;
        $user->setEmail($_POST['email']); 
        $user->setPassword($_POST['password']); 
        $userDb = $user->login();
        if($userDb){
            $userAuth = $userDb->fetch_object();
            if($userAuth->email_verified_at){

                $_SESSION['user'] = $userAuth;
                header('location:../../index.php');
            }else{
                //send mail
                $email = new sendMail;
                $body = "DEAR ".$userAuth->name."<br> your verification code : ".$userAuth->code;
                $result= $email->sendEmail($userAuth->email,'verfication code', $body);
                if($result){
                    $_SESSION['email']=$userAuth->email;
                    header('location:../../check-code.php?page=login');
                }else{
                    $_SESSION['validation']['failed-email']='please try again';
                    header('location:../../login.php');
                }
            }
        }else{
            $_SESSION['validation']['email-password-wrong']= 'something-wrong';
            header('location:../../login.php');
        }
     }
    }else{
    header('location:../../errors/403.php');
}