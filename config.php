<?php
$servername = "://infinityfree.com"; 
$username = "if0_42198247";  
$password = "YOUR_VPANEL_PASSWORD"; // Put your actual InfinityFree vPanel password here
$database = "if0_42198247_finance_tracker"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
