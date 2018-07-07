<?php
session_start();
include ('config/config.php');
$userId = $_SESSION["userId"];
if(!$userId){
    header("Location:login.php");
    die;
}

$userId = $_SESSION["userId"];
$taskId = $_GET["task_id"];

$sql = "DELETE FROM `tasks` WHERE `id`='$taskId'";
$result = mysqli_query($conn,$sql);

header('location:tasks.php');