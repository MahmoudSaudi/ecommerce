<?php
session_start();
include_once "../validation/RegisterRequest.php";
include_once "../models/User.php";
include_once "../mail/sendMail.php";

if(isset($_POST['check-email'])){
    //validation, required, regex, exists in db
     // validation email -->required, regex
     $emailValidation = new RegisterRequest;
     $emailValidation->setEmail($_POST['email']);
     $emailValidationResult = $emailValidation->emailValidation(); 
 
      if($emailValidationResult){
          $_SESSION['validation']['email-validation']= $emailValidationResult;
          header('location:../../check-email.php');
      }else{
          // validation email -->exists in db
          $emailDataBaseCheck = $emailValidation->emailDataBaseCheck();
          if(empty($emailDataBaseCheck)){ //[]
              $_SESSION['validation']= ['email-not-exists'=>'Email Not exists'];
              header('location:../../check-email.php');
          }
      }
      if(empty($_SESSION['validation'])){
        // update code in db by user email
        // send email
        // header -> check code // header set password
        $userObj = new User;
        $userObj->setEmail($_POST['email']);
        $code = rand(10000,99999);
        $userObj->setCode($code );
       $userObjResult= $userObj->updateCodeByEmail();
       if($userObjResult){
            //send email
            $email = new sendMail;
            $body = "DEAR <br> your verification code : ".$code;
            $subject = 'verfication code';
            $result= $email->sendEmail($_POST['email'], $subject , $body); //true, false
            if($result){
                $_SESSION['email']=$_POST['email'];
                header('location:../../check-code.php?page=check-email');
            }else{
                $_SESSION['validation']['failed-email']='please try again';
                header('location:../../check-email.php');
            }
       }else{
            $_SESSION['validation']['something-wrong'] = 'something wrong';
            header('location:../../check-email.php');
       }

      }

}else{
    header('location:../../errors/403.php');
}