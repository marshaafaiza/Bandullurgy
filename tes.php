<?php
echo "Current working directory: " . getcwd() . "<br>";
if (file_exists("config.php")) {
    echo "config.php ditemukan!";
} else {
    echo "config.php TIDAK ditemukan!";
}
?>
