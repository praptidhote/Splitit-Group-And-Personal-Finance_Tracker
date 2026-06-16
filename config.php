<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "://infinityfree.com"; 
$username = "if0_42198247";  
$password = "Radha@6509"; 
$database = "if0_42198247_finance_tracker"; 

$con = mysqli_connect($servername, $username, $password, $database);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
