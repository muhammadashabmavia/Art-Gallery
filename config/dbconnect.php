<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$server = "localhost";
$user = "root";
$password = "";
$db = "swiss_collection";

$conn = mysqli_connect($server,$user,$password,$db);

if(!$conn) {
    die("Connection Failed:".mysqli_connect_error());
}

?>