<?php
include("./config/constants.php");
if (!isset($_SESSION['user_id'])){
    header("location: login.php");
}else{
    echo $id_food = $_GET['id'];
    echo $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM `cart` WHERE $user_id = id_user and $id_food = id_food ";
    $res = mysqli_query($conn, $sql);
    header("location: cart.php");
}

?>