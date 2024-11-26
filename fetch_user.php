<?php
include 'config.php'; // Pakai file koneksi

$sql = "SELECT * FROM users"; // Query untuk ambil semua data dari tabel users
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>
