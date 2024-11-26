<?php
session_start();

// Cek apakah user adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect ke login kalau bukan admin
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .container a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #0a84ff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .container a:hover {
            background-color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= $_SESSION['name']; ?> (Admin)</h1>
        <p>Kelola data user atau lakukan tugas admin lainnya di sini.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
