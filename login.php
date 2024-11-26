<?php
include 'config.php'; // Koneksi ke database

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek email di database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email']; // Tambahkan email ke session
            $_SESSION['role'] = $user['role'];

            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                header('Location: home.php'); // Redirect ke homepage
            } else {
                header('Location: home.php'); // Redirect ke homepage
            }
            exit;
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bandullurgy</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Style */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e8e4dc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            flex-direction: column;
        }

        h1 {
            color: #283454;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .box {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            width: 400px;
            color: #283454;
            border: 2px solid #283454; /* Box border */
            border-radius: 10px;
            
        }

        .user-box {
            width: 100%;
            position: relative;
            margin-bottom: 20px;
        }

        .user-box input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background: transparent;
            border: 1px solid #000000;
            border-radius: 22px;
            color: #333;
            outline: none;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .form-label {
            color: white;
            display: block;
            margin-bottom: 4px;
        }

        .button-container {
            display: flex;
            gap: 10px; /* Jarak antar tombol */
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            width: 200px;
            padding: 12px;
            font-size: 20px;
            font-weight: bold;
            color: white;
            background: #283454;
            border: none;
            border-radius: 22px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Link Style */
        a {
            color: #283454;
            text-decoration: none;
            margin-top: 20px;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="box">
            <h1>LOGIN</h1>
            <form method="POST" action="">
                <div class="user-box">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="user-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="button-container">
                    <button type="submit">LOGIN</button>
                </div>
            </form>
            <a href="register.php">Belum punya akun? Daftar di sini</a>
        </div>
    </div>
</body>
</html>
