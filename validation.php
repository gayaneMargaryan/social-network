<?php
session_start();
include("config/config.php");

if(isset($_POST["email"])) {
    $email = mysqli_real_escape_string($conn, strip_tags($_POST["email"]));
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM `user` WHERE email='$email'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($result->num_rows) {
            echo json_encode(["error" => true]);
        } else {
            echo json_encode(["error" => false]);
        }

    } else{
        echo json_encode(["error" => true]);
    }
}

?>