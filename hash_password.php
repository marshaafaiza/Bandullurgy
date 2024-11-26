<?php
$password = 'password123'; // Password admin yang mau di-hash
echo password_hash($password, PASSWORD_DEFAULT);
?>
