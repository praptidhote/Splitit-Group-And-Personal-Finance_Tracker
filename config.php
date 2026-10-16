<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "detsdb";

// Procedural connection ($con)
$con = mysqli_connect($servername, $username, $password, $database);

// Object-Oriented connection ($conn)
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>
