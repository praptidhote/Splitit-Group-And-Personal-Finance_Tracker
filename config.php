<?php
$servername = "localhost";  // Change if needed
$username = "root";         // Change if needed
$password = "";             // Change if needed
$database = "detsdb"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
