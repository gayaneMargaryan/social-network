<?php
session_start();
include ('config/config.php');
if(!$userId){
    header("Location:login.php");
    die;
}

$userId = $_SESSION["userId"];
$taskId = $_GET["task_id"];