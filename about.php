<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - Bandullurgy</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #e8e4dc;
            color: #333;
        }
                
        /* Header styling */

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
        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            background-color: #283454;
            color: white;
            text-align: center;
        }

        .hero h2 {
            font-size: 2.5em;
            margin: 0;
        }

        .content {
            padding: 40px;
        }

        .content h3 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #283454;
        }

        .content p {
            line-height: 1.6;
            text-align: justify;
        }

        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
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
            <a href="about.php">About</a>
            <a href="services.php">Services</a>
            <a href="contact.php">Contact</a>
            <a href="blog.php">Blog</a>
            <a href="faq.php">FAQ</a>
            <a href="profile.php">Profile</a>
            <?php if (isset($_SESSION['name'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <!-- Hero Section -->
    <section class="hero">
        <h2>ABOUT BANDULLURGY</h2>
    </section>

    <!-- Content Section -->
    <section class="content">
        <h3>Our Mission</h3>
        <p>
            Bandullurgy didedikasikan untuk menjelajahi solusi energi berkelanjutan yang inovatif. Platform kami menampilkan teknologi terkini seperti Pendulum Power Generator, yang dirancang untuk meningkatkan efisiensi energi dan mendorong keberlanjutan. Kami bertujuan menginspirasi individu dan komunitas untuk mengadopsi praktik ramah lingkungan demi masa depan yang lebih hijau.
        </p>
        <h3>Our Vision</h3>
        <p>
            Kami membayangkan dunia di mana energi terbarukan dapat diakses oleh semua orang. Bandullurgy berkomitmen menjadikan energi berkelanjutan bukan hanya sebagai pilihan, tetapi sebagai norma, yang mendorong kemajuan global menuju kemandirian energi dan harmoni lingkungan.
        </p>
        <h3>Our Technology</h3>
        <p>
            Di inti dari Bandullurgy adalah Pendulum Power Generator, alat revolusioner yang mengubah energi kinetik menjadi listrik. Teknologi ini adalah bukti komitmen kami terhadap inovasi dan masa depan yang berkelanjutan.
        </p>
        <img src="img/about.jpg" alt="Inovasi Bandullurgy">
    </section>
</body>
</html>
