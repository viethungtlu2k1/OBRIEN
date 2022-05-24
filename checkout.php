<?php
ob_start();
include("./config/constants.php");
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
                                                <a class="active" href="index.php">
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

        <!-- Checkout Area Start Here -->
        <div class="checkout-area">
            <div class="container container-default-2 custom-container">
                <form action="" method="POST">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <form action="#">
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $user_id = $_SESSION['user_id'];
                                            $sql = "SELECT * FROM `tbl_user` WHERE id = $user_id";
                                            $res = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($res)
                                            ?>
                                            <div class="checkout-form-list">
                                                <label>Full Name <span class="required">*</span></label>
                                                <input name="full_name" type="text" value="<?= $row['full_name'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input placeholder="Street address" type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone <span class="required">*</span></label>
                                                <input type="text" value="<?= $row['phone'] ?>" name="phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="cart-product-name">Product</th>
                                                <th class="cart-product-total">Total</th>
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
                                                    <tr class="cart_item">
                                                        <td class="cart-product-name"> <?= $row2['title'] ?><strong class="product-quantity">
                                                                × <?= $qty ?></strong></td>
                                                        <td class="cart-product-total text-center"><span class="amount">$<?= $total ?></span></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Shipping</th>
                                                <td class="text-center"><span class="amount">$0</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td class="text-center"><strong><span class="amount">$<?= $cartTotal ?></span></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="#payment-1">
                                                    <h5 class="panel-title mb-2">
                                                        <a href="#" class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Payment on delivery.
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body mb-2 mt-2">
                                                        <p>When you receive the goods, please pay the delivery person.</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="order-button-payment">
                                            <input value="Place order" type="submit" name="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Area End Here -->
        <!-- Support Area Start Here -->
        <div class=" support-area">
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
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $date = date("Y-m-d H:i:s");
    $user_id = $_SESSION['user_id'];
    $id_order = random_int(0, 1000000);
    if ($_POST['full_name'] == "" || $_POST['address'] == "" || $_POST['phone'] == "") {
        echo "<script> alert('Not enough information has been entered') </script>";
    } else {
        $sql = "INSERT INTO `tbl_order`(`id`,`id_user`, `order_date`, `status`, `customer_name`, `customer_phone`, `customer_address`) 
        VALUES ('$id_order','$user_id','$date',0,'$full_name','$phone','$address')";
        $res = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM `cart` WHERE id_user = $user_id";
        $res = mysqli_query($conn, $sql);
        //$cartTotal = 0;
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id_food = $row['id_food'];
                $qty = $row['qty'];
                $sql2 = "INSERT INTO `order_food`(`id_food`, `id_order`, `qty`) 
                VALUES ('$id_food','$id_order','$qty')";
                $res2 = mysqli_query($conn, $sql2);
                //$cartTotal  = $cartTotal + $total;
            }
            // khi dat hang xong phai xoa trong gio hang
            $sql = "DELETE FROM `cart` WHERE id_user = $user_id";
            $res = mysqli_query($conn, $sql);
            echo "<script> alert('Order Success') </script>";
            header("location:index.php");
        }
    }
}

?>