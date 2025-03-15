<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['username'])) {
        die("You must be logged in to comment.");
    }

    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $user_result = $conn->query("SELECT id FROM users WHERE username='$username'");
    $user = $user_result->fetch_assoc();
    $user_id = $user['id'];

    $sql = "INSERT INTO comments (user_id, comment) VALUES ('$user_id', '$comment')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
