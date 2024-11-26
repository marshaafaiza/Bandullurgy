<?php
session_start(); // Mulai session

// Cek apakah user sudah login
if (!isset($_SESSION['name'])) {
    header('Location: login.php'); // Redirect ke login kalau belum login
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .dashboard-container {
            background-color: #1e2a38;
            color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .dashboard-container h2 {
            margin-bottom: 20px;
        }
        .dashboard-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0a84ff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .dashboard-container a:hover {
            background-color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Selamat Datang, <?= $_SESSION['name']; ?>!</h2>
        <p>Kamu berhasil login. Nikmati fitur dari mahakarya ini! 🚀</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
