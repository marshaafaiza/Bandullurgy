<?php
session_start();

// Check if the user is logged in and is an admin
// Periksa apakah session sudah dimulai dan apakah pengguna sudah login
include 'config.php';

// Ambil data pengguna
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);




// Ensure session ID is set and fetch data
if (isset($_SESSION['id'])) {
    // Fetch data for the logged-in admin
    $sql = "SELECT id, name, email FROM users WHERE id = '" . $_SESSION['id'] . "'";
    $result = $conn->query($sql);


    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "No user data found for this session.";
        exit;
    }

    // Fetch all users for delete options
    $users = $conn->query("SELECT id, name, email FROM users");
} else {
    echo "Session ID is not set.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
        /* Styling as before */
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
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding-top: 70px; /* Add padding to avoid overlap with header */
        }
        .profile-container {
            max-width: 800px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-info {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-section {
            margin-top: 20px;
        }
        .form-section h3 {
            margin-bottom: 10px;
        }
        .form-section input, .form-section select, .form-section button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-section button {
            background-color: #283454;
            color: #fff;
            cursor: pointer;
        }
        .form-section button:hover {
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
            <a href="profile.php">Profile</a>
            <?php if (isset($_SESSION['name'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Profile Container -->
    <div class="profile-container">
        <h2>Welcome, <?= $_SESSION['name']; ?> (Admin)</h2>
        
        <!-- Profile Info Section -->
        <div class="profile-info">
            <div>
                <p><strong>ID:</strong> <?= isset($user['id']) ? $user['id'] : 'No ID available'; ?></p>
                <p><strong>Name:</strong> <?= isset($user['name']) ? $user['name'] : 'No name available'; ?></p>
                <p><strong>Email:</strong> <?= isset($user['email']) ? $user['email'] : 'No email available'; ?></p>
            </div>
        </div>

        <!-- Add User Section -->
        <div class="form-section">
            <h3>Add User</h3>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="add_user">Add User</button>
            </form>
        </div>

        <!-- Delete User Section -->
        <div class="form-section">
            <h3>Delete User</h3>
            <form method="POST" action="">
                <select name="user_id" required>
                    <?php while ($row = $users->fetch_assoc()): ?>
                        <option value="<?= $row['id']; ?>"><?= $row['name']; ?> (<?= $row['email']; ?>)</option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="delete_user">Delete User</button>
            </form>
        </div>
    </div>
</body>
</html>
