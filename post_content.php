<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Konten berhasil diposting!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Post New Content</title>
</head>
<body>
    <h1>Post New Content</h1>
    <form method="POST" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="content">Content:</label>
        <textarea name="content" required></textarea>
        <button type="submit">Post</button>
    </form>
</body>
</html>
