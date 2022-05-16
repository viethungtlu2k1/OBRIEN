<?php
//Include constants.php for SITEURL
include('./config/constants.php');
//1. Destory the Session
session_destroy();
//$_SESSION['user_id'] = 0; //Unsets $_SESSION['user']

//2. REdirect to Login Page

header("location:login.php");
