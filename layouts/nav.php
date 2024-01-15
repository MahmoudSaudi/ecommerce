<?php
include_once "app/models/Category.php";
// echo __DIR__."\../app\models\Subcategory.php";die;

include_once __DIR__ . "\../app\models\Subcategory.php";

$cat = new Category;
$cat->setStatus(1);
$catResult = $cat->read(); // rows >=0 --> fetch all array of array
// print_r($catResult);
$subCat = new Subcategory;
$subCat->setStatus(1);

?>

<!-- header start -->
<header class="header-area gray-bg clearfix">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="logo">
                        <a href="index.php">
                            <img alt="" src="assets/img/logo/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-6">
                    <div class="header-bottom-right">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="top-hover"><a href="index.php">home</a>
                                        <ul class="submenu">
                                            <li><a href="index.php">home version 1</a></li>
                                            <li><a href="index-2.php">home version 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about-us.php">about</a></li>
                                    <li class="mega-menu-position top-hover"><a href="shop.php">shop</a>
                                        <ul class="mega-menu">
                                            <!-- count of categories -->
                                            <li>
                                                <ul>
                                                    <?php
                                                    if ($catResult) {
                                                        $categories = $catResult->fetch_all(MYSQLI_ASSOC);
                                                        // print_r($categories);die;
                                                        foreach ($categories as $category) { ?>
                                                            <li class="mega-menu-title">
                                                                <?= $category['name_en'] ?>
                                                            </li>

                                                            <?php
                                                            $subCat->setCategoryId($category['id']);
                                                            $subCatResult = $subCat->read();
                                                            if ($subCatResult) {
                                                                $subcategories = $subCatResult->fetch_all(MYSQLI_ASSOC);

                                                                foreach ($subcategories as $subcategory) { ?>
                                                                    <li><a href="shop.php?subId=<?=$subcategory['id']?>">
                                                                            <?= $subcategory['name_en'] ?>
                                                                        </a></li>

                                                                <?php }
                                                            } else { ?>
                                                                <li><a href="">No Subcat</a></li>

                                                            <?php }
                                                            ?>
                                                        <?php }

                                                    } else { ?>
                                                        <li class="mega-menu-title">No Cat</li>
                                                    <?php }

                                                    ?>
                                            </li>
                                        </ul>
                                        </ul>
                                    </li>
                                    <li class="mega-menu-position top-hover"><a href="shop.php">Categories</a>
                                        <ul class="mega-menu">
                                            <!-- count of categories -->
                                            <li>
                                                <ul>
                                                    <?php
                                                    if ($catResult) {
                                                        $categories = $catResult->fetch_all(MYSQLI_ASSOC);
                                                        // print_r($categories);die;
                                                        foreach ($categories as $category) { ?>
                                                            <li class="mega-menu-title">
                                                                <?= $category['name_en'] ?>
                                                            </li>

                                                            <?php
                                                            $subCat->setCategoryId($category['id']);
                                                            $subCatResult = $subCat->read();
                                                            if ($subCatResult) {
                                                                $subcategories = $subCatResult->fetch_all(MYSQLI_ASSOC);

                                                                foreach ($subcategories as $subcategory) { ?>
                                                                    <li><a href="shop.php">
                                                                            <?= $subcategory['name_en'] ?>
                                                                        </a></li>

                                                                <?php }
                                                            } else { ?>
                                                                <li><a href="">No Subcat</a></li>

                                                            <?php }
                                                            ?>
                                                        <?php }

                                                    } else { ?>
                                                        <li class="mega-menu-title">No Cat</li>
                                                    <?php }

                                                    ?>
                                            </li>
                                        </ul>
                                        </ul>
                                    </li>

                                <li><a href="contact.php">contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-currency">
                            <li class="nav-item dropdown">
                                <?php
                                if (isset($_SESSION['user'])) { ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= $_SESSION['user']->name ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="app/php/logout.php"> logout</a>
                                        <a class="dropdown-item" href="my-account.php"> profile </a>
                                    </div>
                                    <?php
                                } else { ?>

                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Welcome
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="login.php">login</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="register.php">register</a>
                                    </div>
                                <?php }
                                ?>
                            </li>
                        </div>
                        <div class="header-cart">
                            <a href="#">
                                <div class="cart-icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                            </a>
                            <div class="shopping-cart-content">
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote </a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="#">Phantom Remote</a></h4>
                                            <h6>Qty: 02</h6>
                                            <span>$260.00</span>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="ion ion-close"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-total">
                                    <h4>Shipping : <span>$20.00</span></h4>
                                    <h4>Total : <span class="shop-total">$260.00</span></h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a href="cart-page.php">view cart</a>
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="#">HOME</a>
                                <ul>
                                    <li><a href="index.php">home version 1</a></li>
                                    <li><a href="index-2.php">home version 2</a></li>
                                </ul>
                            </li>

                            <li><a href="shop.php"> Shop </a>
                                <ul>
                                    <li><a href="#">Categories 01</a>
                                        <ul>
                                            <li><a href="shop.php">Aconite</a></li>
                                            <li><a href="shop.php">Ageratum</a></li>
                                            <li><a href="shop.php">Allium</a></li>
                                            <li><a href="shop.php">Anemone</a></li>
                                            <li><a href="shop.php">Angelica</a></li>
                                            <li><a href="shop.php">Angelonia</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Categories 02</a>
                                        <ul>
                                            <li><a href="shop.php">Balsam</a></li>
                                            <li><a href="shop.php">Baneberry</a></li>
                                            <li><a href="shop.php">Bee Balm</a></li>
                                            <li><a href="shop.php">Begonia</a></li>
                                            <li><a href="shop.php">Bellflower</a></li>
                                            <li><a href="shop.php">Bergenia</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Categories 03</a>
                                        <ul>
                                            <li><a href="shop.php">Caladium</a></li>
                                            <li><a href="shop.php">Calendula</a></li>
                                            <li><a href="shop.php">Carnation</a></li>
                                            <li><a href="shop.php">Catmint</a></li>
                                            <li><a href="shop.php">Celosia</a></li>
                                            <li><a href="shop.php">Chives</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Categories 04</a>
                                        <ul>
                                            <li><a href="shop.php">Daffodil</a></li>
                                            <li><a href="shop.php">Dahlia</a></li>
                                            <li><a href="shop.php">Daisy</a></li>
                                            <li><a href="shop.php">Diascia</a></li>
                                            <li><a href="shop.php">Dusty Miller</a></li>
                                            <li><a href="shop.php">Dame’s Rocket</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li><a href="contact.php"> Contact us </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->