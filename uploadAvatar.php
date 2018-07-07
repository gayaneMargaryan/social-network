<?php
session_start();
include("config/config.php");

$userId = $_SESSION["userId"];

if(!$userId){
    header("Location:index.php");
}

if(isset($_POST["upload"])){
    $target_dir = "uploads/";
    $fileName = uniqid().basename($_FILES["avatar"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["avatar"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk) {
        $sql = "SELECT avatar FROM `user` WHERE id = '$userId'";
        $select = mysqli_query($conn,$sql);
        $selectData = mysqli_fetch_assoc($select);
//        var_dump($selectData); die;
        if(!empty($selectData['avatar'])){
            unlink($target_dir.$selectData['avatar']);
        }
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            /*unlink*/
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



}