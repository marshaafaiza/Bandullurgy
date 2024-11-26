<?php
include 'config.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Query untuk insert data
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Tampilkan pop-up setelah registrasi berhasil
                const modal = document.createElement('div');
                modal.style.position = 'fixed';
                modal.style.top = '50%';
                modal.style.left = '50%';
                modal.style.transform = 'translate(-50%, -50%)';
                modal.style.backgroundColor = '#1e2a38';
                modal.style.color = '#ffffff';
                modal.style.padding = '20px';
                modal.style.borderRadius = '10px';
                modal.style.boxShadow = '0px 4px 6px rgba(0, 0, 0, 0.2)';
                modal.style.textAlign = 'center';

                // Isi pop-up
                modal.innerHTML = `
                    <h2>Registrasi Berhasil!</h2>
                    <p>Akun kamu berhasil dibuat. Klik tombol di bawah untuk login.</p>
                    <button id='goToLogin' style='padding: 10px 20px; background-color: #0a84ff; border: none; border-radius: 5px; color: #ffffff; font-size: 16px; cursor: pointer;'>Login</button>
                `;

                document.body.appendChild(modal);

                // Tambahkan event listener ke tombol untuk pindah ke halaman login
                document.getElementById('goToLogin').addEventListener('click', function() {
                    window.location.href = 'login.php'; // Redirect ke halaman login
                });
            });
        </script>
        ";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <style>
        /* CSS sama kayak sebelumnya */
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
<body>
    <div class="form-container">
        <div class="box">
            <h1>MAKE ACCOUNT</h1>
            <form method="POST" action="">
                <div class="user-box">
                    <input type="name" name="name" placeholder="Name" required>
                </div>
                <div class="user-box">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="user-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="button-container">
                    <button type="submit">START</button>
                </div>
            </form>
    </div>
    </div>
</body>
</html>