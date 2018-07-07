<?php
session_start();
include ("config/config.php");

$userId = $_SESSION["userId"];
if(!$userId){
    header("Location:login.php");
    die;
}

include("layout/header.php");

?>



<div style="height: 100vh" id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjbheylMugZah3_izW6yjA999MwjZ94ZI&callback=initMap"
            async defer></script>




<?php
include("layout/footer.php");
?>