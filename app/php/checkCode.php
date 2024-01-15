<?php
session_start();
include_once "../models/User.php";

// print_r($_GET);die;
$pages=['register', 'login', 'check-email'];
if($_GET){ //super global
    if(isset($_GET['page'])){ //key
        if(in_array($_GET['page'], $pages)){ //value
            $page = $_GET['page'];
        }else{
            header('location:../errors/404.php');
        }
    }else{
        header('location:../errors/404.php');
    }
}else{
    header('location:../errors/404.php');
}

if (isset($_POST['check-code'])) {
    // print_r($_SESSION['email']);die;
    // validation code

    // session -->email 
    // post -->code 
    // get -->page

    $user = new User;
    $user->setCode($_POST['code']);
    $user->setEmail($_SESSION['email']);
    $result = $user->checkCodeByEmail();

    if ($result) {
        // verifeid
        $userVerified = $user->emailVerification();
        if($userVerified){
            // check page
            switch($page){
                case 'login':
                case 'register':
                    $_SESSION['user']=$result->fetch_object(); //object
                    unset($_SESSION['email']);
                    header('location: ../../index.php');
                break;
                case 'check-email':
                    // session -> email
                    header('location: ../../set-password.php');
                break;
                default:
                    header('location:../errors/404.php'); 
            }
         
        }else{
            $_SESSION['validation']['failed-email-verified'] = 'something wrong';
            header('location: ../../check-code.php');

        }
    } else {
        header('location: ../../check-code.php');
    }
} else {
    header('location:../errors/403.php');
}