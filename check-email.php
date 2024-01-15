<?php
include_once "layouts/header.php";
?>

<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Check Email </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="app/php/checkEmail.php" method="post">
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
                                        <button type="submit" name="check-email"><span>check email</span></button>
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
?>