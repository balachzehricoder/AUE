<?php
$host = 'localhost';
$username = 'root';
$password = ''; // No password for default XAMPP setup
$database = 'e-comercedb'; // Replace with your actual database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
