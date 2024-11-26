<?php
session_start();
include 'config.php';

// Cek apakah user admin
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Menambah Data Listrik (khusus admin)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_data'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $power_voltage = $_POST['power_voltage'];

    $sql = "INSERT INTO listrik (date, time, power_voltage) VALUES ('$date', '$time', '$$power_voltage')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Service berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}

   

// Hapus Data Listrik (khusus admin)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_data'])) {
    $data_id = $_POST['data_id'];

    $sql = "DELETE FROM listrik WHERE id='$data_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}

// Ambil data dari database
$sql = "SELECT id, date, time, power_voltage FROM listrik ORDER BY id ASC";
$listrik = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Listrik - Bandullurgy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e8e4dc;
            color: #333;
        }
        
        /* Header Styling */
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
            text-align: center;
            padding: 100px 20px;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #283454;
            color: white;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #283454;
            color: white;
            cursor: pointer;
        }

        button:hover {
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
    
    <!-- Content Section -->
<section class="content">
    <h2>Total Electricity Power Generated Per Day!</h2>

    <!-- Form untuk Menambah Data -->
    <?php if ($isAdmin): ?>
        <form method="POST" action="">
            <input type="date" name="date" placeholder="Tanggal" required>
            <input type="time" name="time" placeholder="Waktu" required>
            <input type="text" name="power_voltage" placeholder="Daya Listrik (V)" required>
            <input type="text" name="status" placeholder="Status" required>
            <button type="submit" name="add_data">Tambah Data</button>
        </form>
    <?php endif; ?>

    <!-- Tabel untuk Menampilkan Data Listrik -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Time</th>
                <th>Electricity Power (V)</th>
                <?php if ($isAdmin): ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($listrik->num_rows > 0): ?>
                <?php while ($row = $listrik->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['date']; ?></td>
                        <td><?= $row['time']; ?></td>
                        <td><?= $row['power_voltage']; ?></td>
                        
                        <?php if ($isAdmin): ?>
                            <td>
                                <form method="POST" action="" style="display: inline;">
                                    <input type="hidden" name="data_id" value="<?= $row['id']; ?>">
                                    <button type="submit" name="delete_data" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= $isAdmin ? 6 : 5; ?>">Belum ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

</body>
</html>
