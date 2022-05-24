<?php
include("./config/constants.php");
ob_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Obrien - Organic Food HTML5 Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/css/vendor/font.awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/css/vendor/ionicons.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <!-- Nice Select -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->

    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css"> -->

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/style.min.css"> -->
</head>

<body>

    <div class="contact-wrapper">
        <header class="main-header-area">
            <!-- Main Header Area Start -->
            <div class="main-header">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-lg-12 col-custom">
                            <div class="row align-items-center">
                                <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                                    <div class="header-logo d-flex align-items-center">
                                        <a href="index.php">
                                            <img class="img-full" src="assets/images/logo/logo.png" alt="Header Logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xl-7 position-static d-none d-lg-block col-custom">
                                    <nav class="main-nav d-flex justify-content-center">
                                        <ul class="nav">
                                            <li>
                                                <a href="index.php">
                                                    <span class="menu-text"> Home</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="shop.php">
                                                    <span class="menu-text">Foods</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="contact-us.php">
                                                    <span class="menu-text">Contact</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-lg-2 col-xl-3 col-sm-6 col-6 col-custom">
                                    <div class="header-right-area main-nav">
                                        <ul class="nav">
                                            <?php
                                            if (isset($_SESSION['user_id'])) {
                                            ?>
                                                <li class="login-register-wrap d-none d-xl-flex">
                                                    <span><a href="logout.php">Logout</a></span>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="login-register-wrap d-none d-xl-flex">
                                                    <span><a href="login.php">Login</a></span>
                                                    <span><a href="register.php">Register</a></span>
                                                </li>
                                            <?php

                                            }
                                            ?>
                                            <?php
                                            $cartCount = 0;
                                            if (isset($_SESSION['user_id'])) {
                                                $user_id = $_SESSION['user_id'];
                                                $sql = "SELECT * FROM `cart` WHERE id_user = $user_id";
                                                $res = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($res) > 0) {
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $qty = $row['qty'];
                                                        $cartCount = $cartCount + $qty;
                                                    }
                                                }
                                            }


                                            ?>
                                            <li class="minicart-wrap">
                                                <a href="cart.php" class="minicart-btn toolbar-btn">
                                                    <i class="ion-bag"></i>
                                                    <span class="cart-item_count"><?= $cartCount ?></span>
                                                </a>
                                            </li>
                                            <li class="mobile-menu-btn d-lg-none">
                                                <a class="off-canvas-btn" href="#">
                                                    <i class="fa fa-bars"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Header Area End -->
        </header>
        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper mt-no-text mb-no-text">
            <div class="container container-default-2 custom-area">
                <div class="row">
                    <form action="#" method="POST">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Image</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $user_id = $_SESSION['user_id'];
                                        $sql = "SELECT * FROM `cart` WHERE id_user = $user_id";
                                        $res = mysqli_query($conn, $sql);
                                        $cartTotal = 0;
                                        if (mysqli_num_rows($res) > 0) {
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                $id_food = $row['id_food'];
                                                $qty = $row['qty'];
                                                $sql2 = "SELECT * FROM `tbl_food` WHERE $id_food = id and active = 'Yes'";
                                                $res2 = mysqli_query($conn, $sql2);
                                                $row2 = mysqli_fetch_assoc($res2);
                                                $total = number_format($qty * $row2['price'], 2);
                                                $cartTotal  = number_format($cartTotal + $total, 2);
                                        ?>
                                                <tr>
                                                    <td class="pro-thumbnail"><a href="product-details.php?id=<?= $id_food ?>"><img class="img-fluid" src="images/food/<?= $row2['image_name'] ?>" style="min-height: 160px;" alt="Product" /></a></td>
                                                    <td class="pro-title"><a href="product-details.php?id=<?= $id_food ?>"><?= $row2['title'] ?></a></td>
                                                    <td class="pro-price"><span>$<?= $row2['price'] ?></span></td>
                                                    <td class="pro-quantity">
                                                        <div class="quantity">
                                                            <div class="cart-plus-minus">
                                                                <input class="cart-plus-minus-box" name="<?= $id_food ?>" value="<?= $qty ?>" type="text">
                                                                <div class="dec qtybutton">-</div>
                                                                <div class="inc qtybutton">+</div>
                                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="pro-subtotal"><span>$<?= $total ?></span></td>
                                                    <td class="pro-remove"><a href="remove-food.php?id=<?= $id_food ?>"><i class="ion-trash-b"></i></a></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                </div>
                                <div class="cart-update mt-sm-16">
                                    <input type="submit" name="submit" value="Update Cart" class="btn obrien-button primary-btn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Cart Totals</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>$<?= $cartTotal ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td>$0</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">$<?= $cartTotal ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="checkout.php" class="btn obrien-button primary-btn d-block">Proceed To Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
        <!-- Support Area Start Here -->
        <div class="support-area">
            <div class="container container-default custom-area">
                <div class="row">
                    <div class="col-lg-12 col-custom">
                        <div class="support-wrapper d-flex">
                            <div class="support-content">
                                <h1 class="title">Need Help ?</h1>
                                <p class="desc-content">Call our support 24/7 at 01234-567-890</p>
                            </div>
                            <div class="support-button d-flex align-items-center">
                                <a class="obrien-button primary-btn" href="contact-us.php">Contact now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Area End Here -->
        <!-- Footer Area Start Here -->
        <footer class="footer-area">
            <div class="footer-widget-area">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-custom">
                            <div class="single-footer-widget m-0">
                                <div class="footer-logo">
                                    <a href="index.php">
                                        <img src="assets/images/logo/footer.png" alt="Logo Image">
                                    </a>
                                </div>
                                <p class="desc-content">Obrien is the best parts shop of your daily nutritions. What kind of nutrition do you need you can get here soluta nobis</p>
                                <div class="social-links">
                                    <ul class="d-flex">
                                        <li>
                                            <a class="border rounded-circle" href="#" title="Facebook">
                                                <i class="fa fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="border rounded-circle" href="#" title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="border rounded-circle" href="#" title="Linkedin">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="border rounded-circle" href="#" title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="border rounded-circle" href="#" title="Vimeo">
                                                <i class="fa fa-vimeo"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-custom">
                            <div class="single-footer-widget">
                                <h2 class="widget-title">Information</h2>
                                <ul class="widget-list">
                                    <li><a href="about-us.php">Our Company</a></li>
                                    <li><a href="contact-us.php">Contact Us</a></li>
                                    <li><a href="about-us.php">Our Services</a></li>
                                    <li><a href="about-us.php">Why We?</a></li>
                                    <li><a href="about-us.php">Careers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-custom">
                            <div class="single-footer-widget">
                                <h2 class="widget-title">Quicklink</h2>
                                <ul class="widget-list">
                                    <li><a href="about-us.php">About</a></li>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="shop.php">Shop</a></li>
                                    <li><a href="cart.php">Cart</a></li>
                                    <li><a href="contact-us.php">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-custom">
                            <div class="single-footer-widget">
                                <h2 class="widget-title">Support</h2>
                                <ul class="widget-list">
                                    <li><a href="contact-us.php">Online Support</a></li>
                                    <li><a href="contact-us.php">Shipping Policy</a></li>
                                    <li><a href="contact-us.php">Return Policy</a></li>
                                    <li><a href="contact-us.php">Privacy Policy</a></li>
                                    <li><a href="contact-us.php">Terms of Service</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-custom">
                            <div class="single-footer-widget">
                                <h2 class="widget-title">See Information</h2>
                                <div class="widget-body">
                                    <address>123, H2, Road #21, Main City, Your address goes here.<br>Phone: 01254 698 785, 36598 254 987<br>Email: https://example.com</address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright-area">
                <div class="container custom-area">
                    <div class="row">
                        <div class="col-12 text-center col-custom">
                            <div class="copyright-content">
                                <p>Copyright © 2020 <a href="https://hasthemes.com/" title="https://hasthemes.com/">HasThemes</a> | Built with&nbsp;<strong>Obrien</strong>&nbsp;by <a href="https://hasthemes.com/" title="https://hasthemes.com/">HasThemes</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <!-- jQuery Migrate JS -->
    <script src="assets/js/vendor/jQuery-migrate-3.3.0.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- Countdown JS -->
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <!-- Ajax JS -->
    <script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <!-- Jquery Nice Select JS -->
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <!-- Jquery Ui JS -->
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <!-- jquery magnific popup js -->
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `cart` WHERE id_user = $user_id";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id_food = $row['id_food'];
            $qty = $_POST[$id_food];
            echo $sql2 = "UPDATE `cart` SET `qty`='$qty' WHERE id_user = $user_id and $id_food = id_food";
            $res2 = mysqli_query($conn, $sql2);
            echo "<br>";
        }
    }
    header("location: cart.php");
}

?>