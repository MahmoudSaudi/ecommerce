<?php
include_once "layouts/header.php";
// print_r($_SESSION);die;

?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Set New Password</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Set New Password</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> New Password </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="app/php/setPassword.php" method="post">
                                        <input type="password" name="password" placeholder="Password">
                                        <?php 
                                            if(isset( $_SESSION['validation']['password-validation'])){
                                                if(isset($_SESSION['validation']['password-validation']['password-required'])){
                                                    echo "<div class='alert alert-danger'>".$_SESSION['validation']['password-validation']['password-required']."</div>";

                                                }
                                                if(isset($_SESSION['validation']['password-validation']['password-invalid'])){
                                                    echo "<div class='alert alert-danger'>".$_SESSION['validation']['password-validation']['password-invalid']."</div>";

                                                }
                                            }
                                        ?>
                                        <input type="password" name="confirm-password" placeholder="Confrim Password">
                                        <?php 
                                            if(isset( $_SESSION['validation']['password-validation'])){
                                                if(isset($_SESSION['validation']['password-validation']['confirm-password-required'])){
                                                    echo "<div class='alert alert-danger'>".$_SESSION['validation']['password-validation']['confirm-password-required']."</div>";

                                                }
                                                if(isset($_SESSION['validation']['password-validation']['confirm-password-invalid'])){
                                                    echo "<div class='alert alert-danger'>".$_SESSION['validation']['password-validation']['confirm-password-invalid']."</div>";

                                                }
                                            }
                                        ?>
                                        <div class="button-box">
                                            <button type="submit" name="set-password"><span>Change Password</span></button>
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
<?php include_once "layouts/footer.php"; ?>