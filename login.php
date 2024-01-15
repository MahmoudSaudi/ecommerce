<?php
include_once "layouts/header.php";
include_once "app/middlewares/guest.php";
include_once "layouts/nav.php";

?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>LOGIN</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Login</li>
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
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                              
                                <form action="app/php/login.php" method="post">
                                        <input type="email" name="email" placeholder="email">
                                        <?php 
                                            if(isset( $_SESSION['validation']['email-validation'])){
                                                foreach($_SESSION['validation']['email-validation']As $key=> $value){
                                                    echo "<div class='alert alert-danger'>$value</div>";
                                                }
                                            }
                                            if(isset( $_SESSION['validation']['email-not-exists'])){
                                                echo "<div class='alert alert-danger'>".$_SESSION['validation']['email-not-exists']."</div>";

                                            }
                                        ?>
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
                                     
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Remember me</label>
                                                <a href="check-email.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit" name="login"><span>Login</span></button>
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
unset($_SESSION['validation']);

include_once "layouts/footer.php";
?>