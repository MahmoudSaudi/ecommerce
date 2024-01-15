<?php
include_once "layouts/header.php";
// include_once "layouts/nav.php";
// print_r($_SESSION['email']);die;
// print_r("app/php/checkCode.php?page=".$_GET['page']);die;
// $_GET=['page'=>'check-email']
// print_r($_GET);die;
// echo "app/php/checkCode.php?page=".$_GET['page'];die;
?>

<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Check-code </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?php
                                        if(isset($_SESSION['validation']['failed-email-verified'])){
                                            echo "<div class='alert alert-danger'>". $_SESSION['validation']['failed-email-verified']."</div>";
                                        }
                                    ?>
                                    <!-- isset $_get -->
                                    <form action=<?php echo "app/php/checkCode.php?page=".$_GET['page']?> method="post">
                                        <input type="code" name="code" placeholder="code">
                                            <button type="submit" name="check-code"><span>check code</span></button>
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
<
<?php
// include_once "layouts/footer.php";
?>