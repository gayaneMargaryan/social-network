<?php
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","Test");

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die(mysqli_connect_error());