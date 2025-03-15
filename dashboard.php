<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil komentar dari database
$sql = "SELECT users.username, comments.comment, comments.created_at 
        FROM comments 
        JOIN users ON comments.user_id = users.id 
        ORDER BY comments.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <!-- <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2> -->
        <form action="logout.php" method="post">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
        <!-- Form Komentar -->
        <h3>Leave a Comment:</h3>
        <form action="comment.php" method="POST">
            <textarea name="comment" placeholder="Write your comment..." required></textarea>
            <button type="submit">Post Comment</button>
        </form>

        <!-- Daftar Komentar -->
        <h3>Comments:</h3>
        <div class="comments-section">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='comment-box'>";
                    echo "<strong>" . htmlspecialchars($row['username']) . "</strong> - <small>" . $row['created_at'] . "</small>";
                    echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No comments yet.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
