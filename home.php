<?php
session_start();

// Proteksi akses ke homepage
if (!isset($_SESSION['name'])) {
    header('Location: login.php'); // Redirect ke login kalau belum login
    exit;
}

include 'config.php';

// Handle Post Content Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Content posted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandullurgy</title>
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
        /* Content section */
        .container {
            display: flex;
            padding: 10px;
            margin-top: 10px; /* Increase the top margin to avoid overlap with header */
            justify-content: space-between;
        }

     
        
        /* Hero Section with video background */
        .c-home-hero {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            margin-bottom: 40px; /* Menambahkan jarak bawah antara video dan konten utama */
        }

        .c-home-hero__video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Intro Section with text centered over video */
        .c-intro-home {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: left;
            z-index: 1;
        }

        .c-intro-home__title {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .u-blue-gradient {
            text-align: left;
            -webkit-background-clip: text;
            color: #e8e4dc;
            font-family: "Helvetica Neue";
            
        }

        /* Content and buttons */
        .container {
            display: flex; 
            padding: 40px;
            justify-content: space-between; 
        }

        .text-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            max-width: 50%;
    
        }

        .main-title {
            font-size: 2.5em;
            margin: 10px 0;
        }

        .description {
            text-align: left;
            line-height: 1.6;
        }

        .button {
            background-color: #283454;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 22px;
            cursor: pointer;
            font-size: 12px;
            margin: 60px 0;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #1f6394;
        }

        .image-container {
            margin: 0px 0;
            max-width: 45%;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tengah {
            display: flex;
            justify-content: center; /* Horizontally center the content */
            align-items: center; /* Vertically center the content */
            height: 200px; /* You can adjust this height to fit your content */
            margin-top: 10px; /* Optional: adds space above */
            padding: 0 20px; /* Adds padding to the left and right */
            
           
        }

        .tengah-text {
            text-align: center; /* Centers the text inside */
            padding: 0 55px; /* Adds padding on the left and right of the text */
            font-size: 1.2em;
            color: #333;
            max-width: 50%; /* Optional: limits the width of the text block */
           
            
        }

        /* Proses Section */
        .proses {
            display: center;
            justify-content: space-between;
        }

        .proses-text {
            position: relative;
            color: black;
            text-align: center;
            margin-top: 50px; 
            font-size: 1.5em; 
            z-index: 1;
        }

        .prosesimage-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
            margin-left: 70px;
        }

        .prosesimage-container img {
            max-width: 40%;
            height: auto;
            border-radius: 10px;
        }

        .prosesitem {
            display: flex;
            align-items: center; 
            gap: 40px;
        }

        .prosesdescription {
            font-size: 0.7em;
            color: black;
            text-align: left;
            max-width: 45%;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            /* Media query to ensure mobile responsiveness */
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav {
                justify-content: center;
                width: 100%;
                flex-wrap: wrap;
            }

            .logo-text {
                font-size: 1.2em;
            }

            .container {
                flex-direction: column;
                padding: 20px;
            }

            .text-container, .image-container {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .prosesimage-container {
                margin-left: 0;
            }

            .prosesdescription {
                font-size: 1em;
            }
        }
        .container2 {
            margin-top: 120px;
            margin-bottom: 20px;
            padding: 2px;
            display: flex; 
            justify-content: space-between; 
        }
        .advantages {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 50px;
            padding: 50px;
            background-color: #e8e4dc;
        }

        .advantage-item {
            display: flex;
            flex-direction: column; /* Stack icon and text vertically */
            align-items: flex-start; /* Align icon and text to the left */
            background-color: #283454;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 30px;
            padding: 20px;
            flex-basis: 22%;
            transition: transform 0.3s ease;
            color: #e8e4dc;
            margin-top: 20px;
        }

        .advantage-item:hover {
            transform: translateY(-10px);
        }

        .icon {
            display: flex;
            align-items: center; /* Center the icon vertically */
            justify-content: center;
            margin-bottom: 20px; /* Adjust space between icon and text */
        }

        .icon img {
            width: 60px; /* Adjust icon size */
            height: auto;
            background-color: white;
            border-radius: 10px;
            margin-right: 10px; /* Space between icon and text */
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align text content to the left */
        }

        .content h3 {
            font-size: 1.2em;
            margin: 0 0 10px 0;
        }

        .content p {
            font-size: 0.95em;
            color: #e8e4dc;
            margin: 0; /* Remove left margin to avoid unnecessary space */
            text-align: left; /* Ensure text is aligned properly */
        }

        /*pulen */
        .bandul {
            display: flex;
            flex-direction: column; /* Stacks the text above the image */
            margin-bottom: 20px;
        }

        .bandul-text {
    text-align: center;
    font-size: 3em;
    margin-bottom: 50px;
    font-weight: bold;
    font-family: "Helvetica Neue";
    transform: scaleX(1.5);
}

.bandul-container {
    display: flex;
    
    justify-content: space-between;
    gap: 10px; /* Perkecil nilai ini jika ingin elemen lebih rapat */
}


.bandul-description {
    display: flex;
    flex-direction: column; /* Menyusun teks secara vertikal */
    max-width: 30%;
    padding: 40px;
    margin-top: 0;
    font-size: 0.9em;
}

.bandul-description a {
    margin-bottom: 10px; /* Menambahkan jarak antar teks */
    color: #333;
    text-align: left;
    width: 90%; /* Memastikan teks mengambil seluruh lebar container */
}

.fotobandul {
    max-width: 80%; /* Membatasi lebar gambar hingga 50% */
    display: flex;
    
    align-items: center; /* Menyelaraskan gambar secara vertikal */
}

.fotobandul img {
    max-width: 80%; /* Gambar menyesuaikan dengan container */
    height: auto; /* Memastikan proporsi gambar tetap */
}


        .post-section {
            margin-top: 40px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .post-section h3 {
            margin-bottom: 20px;
        }
        .post-section input, .post-section textarea, .post-section button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .post-section button {
            background-color: #283454;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        .post-section button:hover {
            background-color: #1f6394;
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

        <!-- Hero Section with video -->
        <section class="c-home-hero js-home-hero" data-component="HomeHero">
        <div class="c-home-hero__image-wrap">
            <div class="c-home-hero__video js-hero-background">
                <video playsinline="true" webkit-playsinline="true" preload="metadata" muted autoplay loop>
                    <source src="img/Bandul.mov" type="video/mp4">
                </video>
            </div>
        </div>

        
    </section>

    <!-- Main Content Section -->
    <div class="container">
        <div class="text-container">
            <h2 class="main-title">The Latest Tech for Sustainable Energy!</h2>
            <div class="container2">
        <h2>Hello <?= $_SESSION['name']; ?>, Welcome to Bandullurgy</h2>
        </div>
            <div class="description">
            Bandullurgy is an innovative and forward-thinking platform dedicated to showcasing the latest advancements in sustainable energy technology. Focused on environmentally friendly solutions, it highlights groundbreaking tools such as the Pendulum Power Generator (PULEN), an innovation that generates electricity by harnessing kinetic energy. PULEN is designed to enhance energy efficiency and promote sustainability, offering a clean alternative sources.    </div>
            <button class="button">LEARN MORE</button>
        </div>
        <div class="image-container">
            <img src="img/bandul2.png" alt="Pendulum Power Generator">
        </div>
    </div>
  
        <div class="tengah">
            <div class="tengah-text">
            As an educational platform, Bandullurgy serves as a trusted resource for both professionals and the general public, providing valuable insights into renewable energy technologies. Through its informative content, Bandullurgy aims to raise awareness about the importance of transitioning to sustainable and eco-friendly energy solutions.
            </div>
        </div>

    <div class="advantages">
        <div class="advantage-item">
            <div class="icon">
                <img src="img/ecof.png" alt="Clean and Green Energy">
            </div>
            <div class="content">
                <h3>Environmentally Friendly Energy</h3>
                <div class="items">
                Bandullurgy focuses on using clean, renewable energy technologies to reduce emissions, carbon footprints, and help preserve nature.            </div>
            </div>
        </div>
        
        <div class="advantage-item">
            <div class="icon">
                <img src="img/sus.png" alt="Sustainable Energy">
            </div>
            <div class="content">
                <h3>Sustainable Power Source</h3>
                <p>
                By relying on gravitational force and the pendulum's motion, Bandullurgy can generate electricity continuously without the need for additional fuel. </p>
            </div>
        </div>
        
        <div class="advantage-item">
            <div class="icon">
                <img src="img/ino.jpg" alt="Innovative and Efficient">
            </div>
            <div class="content">
                <h3>Innovative and Cost-Effective Technology</h3>
                <p>
                Bandullurgy efficiently converts kinetic energy into electricity, offering a cost-effective solution for affordable energy.                </p>
            </div>
        </div>
        </div>

        <div class="bandul">
    <div class="bandul-text">
        PULEN
    </div>
    <div class="bandul-container">
    <div class="bandul-description">
        <a>PULEN functions to generate electrical energy by utilizing the kinetic motion of the pendulum. This allows for continuous electricity generation without the need for additional fuel.</a>
        <a>As a tool that harnesses kinetic energy, PULEN plays a role in supporting the use of renewable, environmentally friendly energy, reducing dependence on fossil fuel sources.</a>
        <a>PULEN has very low operational costs since it does not require additional fuel or complex maintenance. By simply utilizing kinetic energy, PULEN can operate efficiently.</a>
        <a>PULEN can be used to provide power in areas that are not connected to the main electricity grid or in locations with limited infrastructure.</a>
    </div>
    <div class="fotobandul">
        <img src="img/pulen3d.png" alt="pulen">
    </div>
</div>
</div>
<!-- Post Content Section for Admin -->

    


    <footer>

    </footer>
</body>
</html>
