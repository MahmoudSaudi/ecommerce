<?php
include_once "layouts/header.php";
include_once "app/middlewares/guest.php";
include_once "layouts/nav.php";
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Register</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Register</li>
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
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php
                                    if(isset($_SESSION['validation']['failed-email'])){
                                        echo "<div class='alert alert-danger'>".$_SESSION['validation']['failed-email']."</div>";

                                    }
                                    if(isset($_SESSION['validation']['something-wrong'])){
                                        echo "<div class='alert alert-danger'>".$_SESSION['validation']['something-wrong']."</div>";

                                    }
                                    ?>
                                    <form action="app/php/register.php" method="post">
                                        <input type="text" name="name" placeholder="name">
                                        <input type="email" name="email" placeholder="email">
                                        <?php 
                                            if(isset( $_SESSION['validation']['email-validation'])){
                                                foreach($_SESSION['validation']['email-validation']As $key=> $value){
                                                    echo "<div class='alert alert-danger'>$value</div>";
                                                }
                                            }
                                            // if(isset( $_SESSION['validation']['email-exists'])){
                                            //     echo "<div class='alert alert-danger'>".$_SESSION['validation']['email-exists']."</div>";

                                            // }
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
                                        <input type="password" name="confirm-password" placeholder="confirm-password">
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
                                        <input name="phone" placeholder="phone" type="tel">
                                        <div class="button-box">
                                            <button type="submit" name="register"><span>Register</span></button>
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