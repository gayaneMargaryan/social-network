<?php
session_start();
include("config/config.php");

$userId = $_SESSION["userId"];

if(!$userId){
    header("Location:index.php");
}



$target_dir = "uploads/";
$file_name = $_GET["img_name"];
$fileName = uniqid().basename($_GET["img_name"]);
$file = "gallery/".$file_name;
$new_file = $target_dir.$fileName;
$uploadOk = 1;


if ($uploadOk) {
    $sql = "SELECT avatar FROM `user` WHERE id = '$userId'";
    $select = mysqli_query($conn,$sql);
    $selectData = mysqli_fetch_assoc($select);

    if(!empty($selectData['avatar'])){
        unlink($target_dir.$selectData['avatar']);
    }

    if (copy($file,$new_file)) {

        $sql = "UPDATE `user` SET avatar='$fileName' WHERE id='$userId'";
        $upload = mysqli_query($conn,$sql);
        if($upload){
            header("Location:profile.php");
        }
    } else {
        unlink($target_file);
        header("Location:profile.php");
    }
// if everything is ok, try to upload file
} else {
    header("Location:profile.php");
}