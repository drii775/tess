<?php
session_start();
include "db.php"; // Pastikan db.php benar

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Login failed! Username or password incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="index.php" method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');">
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                document.querySelector('input[name="username"]').value = "";
                document.querySelector('input[name="password"]').value = "";
            }, 100);
        });
    </script>
</body> 
</html>
