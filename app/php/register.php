<?php 
session_start();

include_once "../validation/RegisterRequest.php";
include_once "../models/User.php";
include_once "../mail/sendMail.php";
// print_r($_SESSION);die;

if(isset($_POST['register'])){
   $validation = new RegisterRequest;
   // validation email
   $validation->setEmail($_POST['email']);
   $emailValidation = $validation->emailValidation(); 
   // validation password
   $validation->setPassword($_POST['password']);
   $validation->setConfirmPassword($_POST['confirm-password']);
   $passwordValidation = $validation->passwordValidation();

    if($emailValidation){
        $_SESSION['validation']['email-validation']= $emailValidation;
        header('location:../../register.php');
    }else{
        $emailDataBaseCheck= $validation->emailDataBaseCheck();
        if($emailDataBaseCheck){
            $_SESSION['validation']['email-exists']= $emailDataBaseCheck;  // show it in html
            header('location:../../register.php');
        }
    }
    if($passwordValidation){
        $_SESSION['validation']['password-validation']= $passwordValidation;
        header('location:../../register.php');
    }
    if(empty($_SESSION['validation'])){

        // check errors 
        // insert user in db 
        $user = new User;
        $user->setName($_POST['name']);
        $user->setPassword($_POST['password']);
        $user->setEmail($_POST['email']);
        $user->setPhone($_POST['phone']);
        $code = rand(10000,99999);
        $user->setCode($code);
        $userDb= $user->create();
        if($userDb){
            // check code
            // mail();
            // php maile
            $email = new sendMail;
            $body = "DEAR ".$_POST['name']."<br> your verification code : ".$code;
            $result= $email->sendEmail($_POST['email'],'verfication code', $body);
            if($result){
                $_SESSION['email']=$_POST['email'];
                // $_SESSION['page']= 'register';
                header("location:../../check-code.php?page=register");
            }else{
                $_SESSION['validation']['failed-email']='please try again';
                header('location:../../register.php');
            }
           
        }else{
            $_SESSION['validation']['something-wrong']='something wrong';
            header('location:../../register.php');
        }
    }

}else{
    header('location:../../errors/403.php');
}
