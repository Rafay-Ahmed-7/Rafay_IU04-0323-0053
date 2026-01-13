<?php
$host = 'localhost';
$user = 'root';  // Change to your MySQL user
$pass = '';      // Change to your MySQL password
$db = 'car_rental';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>