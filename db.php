<?php
$conn = new mysqli("localhost", "root", "", "blossom");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>