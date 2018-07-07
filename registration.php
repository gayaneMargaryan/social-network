<?php
session_start();
include ("config/config.php");


$gender = $_POST["gender"];

if(isset($_POST["register-submit"])) {
    $confirm_password = $_POST['confirm-password'];
    if (isset($_POST["name"]) && !empty($_POST{"name"})) {
        $name = mysqli_real_escape_string($conn, strip_tags($_POST["name"]));
        unset($_SESSION["error"]["Firstname"]);
    } else {
        $_SESSION["error"]["Firstname"] = 'Firstname is mandatory';
        header('Location:index.php');
    };
    if (isset($_POST["last_name"]) && !empty($_POST{"last_name"})) {
        $last_name = mysqli_real_escape_string($conn, strip_tags($_POST["last_name"]));
        unset($_SESSION["error"]["Lastname"]);
    } else {
        $_SESSION["error"]["Lastname"] = 'Lastname is mandatory';
        header('Location:index.php');
    }
    if (isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($conn, strip_tags($_POST["email"]));
        unset($_SESSION["error"]["Email"]);
    } else {
        $_SESSION["error"]["Email"] = 'Email is mandatory';
        header('Location:index.php');
        die;
    }

    $sql = "SELECT * FROM `user` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
    if ($result ->num_rows){
        header("Location:index.php");
        die;
    }

    if (isset($_POST["password"]) && !empty($_POST{"password"})) {
        $password = mysqli_real_escape_string($conn, strip_tags($_POST["password"]));
        unset($_SESSION["error"]["Password"]);
    } else {
        $_SESSION["error"]["Password"] = 'Password is mandatory';
        header('Location:index.php');
    }
    if ($password == $confirm_password) {
        $password_hash = crypt($password);

        $sql = "INSERT INTO `user` (`name`, `lastname`, `email`, `gender`, `password`) VALUES
        ('$name', '$last_name', '$email','$gender', '$password_hash')";
        $register = mysqli_query($conn, $sql);


        $sql = "SELECT * FROM `user` WHERE email = '$email'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $userData = mysqli_fetch_assoc($result);
        $_SESSION["userId"] = $userData["id"];
        unset($_SESSION["error"]["Password"]);

        header('Location:index.php');
    } else {
        $_SESSION["error"]["Password"] = 'Please confirm your password';
        header('Location:index.php');
    }
}