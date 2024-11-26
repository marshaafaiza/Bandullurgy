<?php
session_start();
include 'config.php';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Query untuk menyimpan data ke tabel contacts
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesan Anda berhasil dikirim!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Bandullurgy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e8e4dc;
            color: #333;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #283454;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping if space is tight */
            justify-content: flex-start; /* Align links to the left */
            font-size: 1em;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px ;
            margin-right: 20px;
        }

        .logo-text {
            color: white;
            font-size: 1.5em;
            text-decoration: none;
            font-weight: bold;
        }

        .content {
            padding: 100px 20px;
        }

        form {
            margin-top: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #283454;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <a href="home.php" class="logo-text">BANDULLURGY</a>
        </div>
        <nav>
            <a href="services.php">Services</a>
            <a href="contact.php">Contact</a>
            <a href="blog.php">Blog</a>
            <a href="faq.php">FAQ</a>
            <?php if (isset($_SESSION['name'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <!-- Content Section -->
    <section class="content">
        <h2>Contact Us</h2>
        <p>Hubungi kami melalui formulir di bawah ini:</p>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Nama Anda" required>
            <input type="email" name="email" placeholder="Email Anda" required>
            <textarea name="message" placeholder="Pesan Anda" rows="5" required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </section>
</body>
</html>
