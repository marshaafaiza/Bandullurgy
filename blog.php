<?php
session_start(); // Panggil session_start() sekali saja
include 'config.php'; // Pastikan file konfigurasi database sudah benar

// Fetch Blog Posts from Database
$sql = "SELECT title, content FROM posts ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Bandullurgy</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
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
            padding: 10px;
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

        .blog-post {
            margin-bottom: 40px;
        }

        .blog-post h3 {
            color: #283454;
        }

        .blog-post p {
            line-height: 1.6;
        }

        /* Styling the new content form */
        .post-new-content {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post-new-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .post-new-content label {
            font-weight: bold;
            margin-top: 10px;
        }

        .post-new-content input,
        .post-new-content textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .post-new-content button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #283454;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .post-new-content button:hover {
            background-color: #34495E;
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

    <!-- Blog Content Section -->
    <section class="content">
        <h2>Latest Blog Posts</h2>
        
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="blog-post">
                    <h3><?= htmlspecialchars($row['title']); ?></h3>
                    <p><?= htmlspecialchars($row['content']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No blog posts available at the moment. Please check back later.</p>
        <?php endif; ?>
    </section>

    <!-- Post New Content Form at the bottom of the page -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

    <div class="post-new-content">
        <h2>Post New Content</h2>
        <form action="process_post.php" method="POST">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter title" required>

            <label for="content">Content</label>
            <textarea id="content" name="content" placeholder="Enter content" required></textarea>

            <button type="submit">Post Content</button>
        </form>
    </div>
    <?php else: ?>
        <p></p>
    <?php endif; ?>

</body>
</html>
