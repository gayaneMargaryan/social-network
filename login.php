<?php
session_start();
include ("config/config.php");

$email =  mysqli_real_escape_string($conn,strip_tags($_POST["email"]));
$password =  mysqli_real_escape_string($conn,strip_tags($_POST["password"]));

$sql = "SELECT * FROM `user` WHERE email='$email'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$userData = mysqli_fetch_assoc($result);

if( $result->num_rows){
    if(password_verify($password, $userData["password"])){
        $_SESSION["userId"] = $userData['id'];
        unset($_SESSION["login_error"]);
        header("Location: profile.php");
    }else{
        $_SESSION["login_error"]= "Wrong Email or password";
        header("Location: index.php");
    }
}else{
    $_SESSION["login_error"]= "Wrong Email or password";
    header("Location: index.php");
}
?>