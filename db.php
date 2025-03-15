<?php
$host = "localhost";
$user = "root"; // Ganti dengan user database
$pass = ""; // Ganti dengan password database
$dbname = "tess";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
