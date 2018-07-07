<?php
session_start();
include ('config/config.php');

$userId = $_SESSION["userId"];

if(!$userId){
    header("Location:login.php");
    die;
}
if(isset($_POST["title"]) && !empty($_POST["title"])){
    $title = mysqli_real_escape_string($conn, strip_tags($_POST["title"]));
    unset($_SESSION['error']['title']);
}else{
    $_SESSION['error']['title'] = "Title is mandatory";
    header('Location:task.php');
}

$description = mysqli_real_escape_string($conn, strip_tags($_POST["description"]));

$sql = "INSERT INTO `tasks` (`user_id`,`title`, `description`) VALUES
            ('$userId','$title','$description  ')";
$task = mysqli_query($conn, $sql);
header("location: tasks.php")

?>
