<?php
$host = "localhost";       // usually "localhost"
$username = "root";        // your MySQL username
$password = "";            // your MySQL password (empty if using XAMPP)
$database = "final_project"; // your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
