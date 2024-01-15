<?php
ob_start();
include_once "layouts/header.php";
include_once "app/middlewares/auth.php";
include_once "layouts/nav.php";
include_once "app/models/User.php";
include_once "app/validation/RegisterRequest.php";

// info contact ( email, password )
$userobj = new User;
$userobj->setEmail($_SESSION['user']->email);

$successProfile = '';
$errors = [];
// print_r($errors);die;
if (isset($_POST['update-profile'])) {
    // validation name, phone
    // image exists (validation )--> in db default.png  ($_FILES)
    // update user
    if ($_FILES['image']['error'] == 0) {
        //validation size, extension
        $maxUploadedSize = 10 ** 6;
        if ($_FILES['image']['size'] > $maxUploadedSize) {
            $errors['image']['image-size'] = "TOO large file , max size is 1 mega";
        }
        $allowedExtensions = ['jpg', 'png'];
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if (!in_array($extension, $allowedExtensions)) {
            $errors['image']['image-ext'] = "extension must be jpg, png only";
        }
        if (empty($errors)) {
            // photoname, path , move temp--> 
            // $photoName = time().$_SESSION['user']->id.'.'.$extension;
            $photoName = time() . '.' . $extension;
            // 12345689.jpg

            // $directory= 'assets/img/users/';
            $fullPath = 'assets/img/users/' . $photoName;
            move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
            $userobj->setPhoto($photoName);
        }

    }
    if (empty($errors)) {

        $userobj->setName($_POST['name'])->setPhone($_POST['phone'])->setEmail($_SESSION['user']->email);
        $result = $userobj->update(); //up date user  in db

        if ($result) {
            //session update 
            $_SESSION['user']->name = $_POST['name'];
            $_SESSION['user']->phone = $_POST['phone'];
            if (isset($photoName)) {
                $_SESSION['user']->photo = $photoName;

            }
            $successProfile = 'Data Updated Successfully';
        } else {
            $error['something-wrong'] = 'something wrong';
        }
    }
}
if (isset($_POST['change-password'])) {
    // validation
    $pattern= '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/';

    $validationPassword = new RegisterRequest;
    $validationPassword->setPassword($_POST['new-password']);
    $validationPassword->setConfirmPassword($_POST['confirm-password']);
    $validationPasswordResult = $validationPassword->passwordValidation();
    if ($validationPasswordResult) {
        $errors['validation']['password-validation'] = $validationPasswordResult;
        // print_r( $errors['validation']['password-validation']);die;
    }else{
        if($_POST['old-password'] == $_POST['new-password']){ //oldpassword != postnewpass
            $errors['validation']['new-password-match'] = "you didnot change password";
        }
    }
    // new, confirm (require ,regex, match) -->register request
    // old password required, regex, match db password, not match new password
    if(empty($_POST['old-password'])){
        $errors['validation']['old-password-required'] = "old password Is Required";
    }else{
        if(!preg_match($pattern, $_POST['new-password'])){
            $errors['validation']['old-password-invalid'] = "old Password must be between 4 and 8 digits long and include at least one numeric digit";
           
        }else{   
            // sha1($_POST['old-password']) //123456 // ljkhjhkjguihuhjnklkj
            // $userobj->getPasswordByUser();
            if($_SESSION['user']->password != sha1($_POST['old-password'])){ //oldpassword, session = db
                $errors['validation']['old-password-not-match'] = "wrong password";
            }
        }
    }
 /// empty $errors
 //send mail with code --> check-code --> update data in db
 if(empty($errors)){
    $userobj->setPassword($_POST['new-password']);
    $result =$userobj->updateUserPasswordByEmail();
    if ($result) {
        $successPassword = 'Data Updated Successfully';
    } else {
        $error['something-wrong'] = 'something wrong';
    }
 }

    
    

}
if (isset($_POST['change-email'])) {
    // validation
    // $_SESSION['user']->email= $_POST['email']
}
$userDataUpadated = $userobj->getUserByEmail();
if ($userDataUpadated) {
    $user = $userDataUpadated->fetch_object();
    // print_r($user);die;
    // send mail with code, 
    // go to check code with query string 

} else {
    $error['something-wrong'] = 'something wrong';
}

?>
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>MY ACCOUNT</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq"
                                        href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse<?php echo (isset($_POST['update-profile']))? 'show':'';?>">
                                <!-- show -->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-12">
                                        </div>
                                    </div>
                                    <?php
                                    if (!empty($successProfile)) {
                                        echo "<div class='alert alert-success'>" . $successProfile . " </div>";
                                    }
                                    if (isset($errors['something-wrong'])) {
                                        echo "<div class='alert alert-danger'>" . $errors['something-wrong'] . " </div>";
                                    }
                                    ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>My Account Information</h4>
                                                <h5>Your Personal Details</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 offset-4 mb-3">
                                                    <img src="assets/img/users/<?= $user->photo ?>"
                                                        class="w-100 rounded-circle" alt="">
                                                    <input type="file" name="image" id="" class="form-control">
                                                    <?php
                                                    if (isset($errors['image'])) {
                                                        foreach ($errors['image'] as $value) {
                                                            echo "<div class='alert alert-danger'> $value </div>";
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Name</label>
                                                        <input type="text" name="name" value="<?= $user->name ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-profile">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq"
                                        href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse <?php echo (isset($_POST['change-password']))? 'show':'';?>">
                                <div class="panel-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-12">
                                            </div>
                                        </div>
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old-password">
                                                        <?php
                                                            if (isset($errors['validation']['old-password-required'])) {
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['old-password-required'] . "</div>";

                                                            }
                                                            if (isset($errors['validation']['old-password-invalid'])) {
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['old-password-invalid']. "</div>";
                                                            }

                                                            if(isset($errors['validation']['old-password-not-match'])){
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['old-password-not-match']. "</div>";
                                                            }
                                                        
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new-password">
                                                        <?php
                                                        if (isset($errors['validation']['password-validation'])) {
                                                            if (isset($errors['validation']['password-validation']['password-required'])) {
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['password-validation']['password-required'] . "</div>";
                                                            }
                                                            if (isset($errors['validation']['password-validation']['password-invalid'])) {
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['password-validation']['password-invalid'] . "</div>";

                                                            }
                                                        }
                                                        if(isset($errors['validation']['new-password-match'])){
                                                            echo "<div class='alert alert-danger'>" . $errors['validation']['new-password-match'] . "</div>";

                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Confirm Password </label>
                                                        <input type="password" name="confirm-password">
                                                        <?php
                                                        if (isset($errors['validation']['password-validation'])) {
                                                            if (isset($errors['validation']['password-validation']['confirm-password-required'])) {
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['password-validation']['confirm-password-required'] . "</div>";
                                                            }
                                                            if (isset($errors['validation']['password-validation']['confirm-password-invalid'])) {
                                                                echo "<div class='alert alert-danger'>" . $errors['validation']['password-validation']['confirm-password-invalid'] . "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="change-password">Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq"
                                        href="#my-account-3">Change your email </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse <?php echo (isset($_POST['change-email']))? 'show':'';?>">
                                <div class="panel-body">
                                    <form method="post">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Email</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="<?= $user->email ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="change-email">Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "layouts/footer.php";
ob_end_flush();
?>