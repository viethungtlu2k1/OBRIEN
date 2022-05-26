<?php
include("./config/constants.php");
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
} else {
    $id_food = $_GET['id'];
    if (isset($_GET['qty'])) {
        $qty = $_GET['qty'];
    } else {
        $qty = 1;
    }
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `cart` WHERE '$id_food' = id_food and id_user='$user_id'";

    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 0) {
        $sql = "INSERT INTO `cart`(`id_user`, `id_food`, `qty`) VALUES ('$user_id','$id_food','$qty')";
    } else {
        $row = mysqli_fetch_assoc($res);
        $sl = $row['qty'] + $qty;
        echo $sql = "UPDATE `cart` SET `qty`='$sl' where '$id_food' = id_food and id_user='$user_id'";
    }
    $res = mysqli_query($conn, $sql);
    header("location: cart.php");
}
