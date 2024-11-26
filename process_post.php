<?php
session_start();
include 'config.php'; // Pastikan koneksi ke database

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Validasi input
    if (!empty($title) && !empty($content)) {
        // Menyimpan data ke database
        $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman blog setelah posting berhasil
            header("Location: blog.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill in both fields.";
    }
}
?>
