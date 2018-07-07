<?php
session_start();
include("config/config.php");

$userId = $_SESSION["userId"];

if(!$userId){
    header("Location:index.php");
}
//var_dump($_FILES["img"]);die;

if(isset($_POST["load"])){

    foreach ($_FILES["img"]["name"] as $key => $value){
    $target_dir = "gallery/";
    $fileName = uniqid().basename($_FILES["img"]["name"][$key]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["img"]["name"]["size"] > 5000000000) {
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
        if (move_uploaded_file($_FILES["img"]["tmp_name"][$key], $target_file)) {

            $sql = "INSERT INTO `gallery` (`image`,`user_id`) VALUES
            ('$fileName','$userId')";
            $upload = mysqli_query($conn,$sql);
            if($upload){
                header("Location:gallery.php");
            }
        } else {
//            unlink($target_file);
            header("Location:gallery.php");
        }
// if everything is ok, try to upload file
    } else {
        header("Location:gallery.php");
    }

}
}