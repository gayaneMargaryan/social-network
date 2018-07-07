<?php
session_start();
include("config/config.php");
$userId =  $_SESSION['userId'];
$img_id = $_GET["img_id"];
$img_name = $_GET["img_name"];
$imgUrl = "uploads/".$img_name;
$sql = "DELETE FROM `gallery` WHERE `id`='$img_id' AND user_id = $userId";
$result = mysqli_query($conn,$sql);
unlink($imgUrl);
$sql = "UPDATE `user` SET avatar=NULL WHERE id='$userId'";
$upload = mysqli_query($conn,$sql);
header('location:profile.php')
?>
