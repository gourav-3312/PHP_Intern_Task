<?php
session_start();

include 'conn.php';

if (isset($_GET['token'])) {
$token = $_GET['token'];
$updatequery = "update registration set status='active' where token='$token' ";

$query = mysqli_query($con,$updatequery);
if ($query) {
    if (isset($_SESSION['msg'])) {
        $_SESSION['msg'] = "Account Updated Successfully";
        header('location:login.php');
    }else {
        $_SESSION['msg'] = "You are logged out";
        header('location:login.php');
    }
}else {
    $_SESSION['msg'] = "Account not activated";
    header('location:register.php');
}
}
