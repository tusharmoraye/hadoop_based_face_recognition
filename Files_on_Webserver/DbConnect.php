<?php

$hostname = "localhost";
$username = "root";
$password = "rootroot";
$database = "faceRec";

$conn = new mysqli($hostname, $username, $password, $database);
if (!$conn) {
    die('Connect Error: ' . mysqli_connect_error());
}

