<?php
$hostname = 'localhost'; // or your hostname
$username = 'root'; // your database username
$password = 'mummy007'; // your database password
$database = 'go_2'; // your database name

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>