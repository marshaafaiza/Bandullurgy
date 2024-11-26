<?php
session_start();
include 'config.php';

// Handle Tambah FAQ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_faq'])) {
    if (isset($_SESSION['name'])) {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $user_id = $_SESSION['id']; // Ambil user ID dari session
        
        $sql = "INSERT INTO faqs (user_id, question, answer) VALUES ('$user_id', '$question', '$answer')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('FAQ berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Anda harus login untuk menambah FAQ.');</script>";
    }
}

// Fetch FAQs dari database
$sql = "SELECT faqs.id, faqs.question, faqs.answer, users.name AS author 
        FROM faqs 
        JOIN users ON faqs.user_id = users.id 
        ORDER BY faqs.id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Bandullurgy</title>
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
            margin-bottom: 20px;
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

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h3 {
            margin: 0;
            color: #283454;
        }

        .faq-item p {
            margin: 5px 0 0;
            line-height: 1.6;
        }

        .author {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
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
        <h2>Frequently Asked Questions</h2>

        <!-- Form Tambah FAQ -->
        <?php if (isset($_SESSION['name'])): ?>
            <form method="POST" action="">
                <h3>Tambah FAQ</h3>
                <input type="text" name="question" placeholder="Pertanyaan" required>
                <textarea name="answer" placeholder="Jawaban" rows="3" required></textarea>
                <button type="submit" name="add_faq">Tambah FAQ</button>
            </form>
        <?php else: ?>
            <p>Login untuk menambahkan FAQ.</p>
        <?php endif; ?>

        <!-- Daftar FAQ -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="faq-item">
                    <h3>Q: <?= htmlspecialchars($row['question']); ?></h3>
                    <p>A: <?= htmlspecialchars($row['answer']); ?></p>
                    <p class="author">Ditambahkan oleh: <?= htmlspecialchars($row['author']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Belum ada FAQ. Jadilah yang pertama menambahkan!</p>
        <?php endif; ?>
    </section>
</body>
</html>
