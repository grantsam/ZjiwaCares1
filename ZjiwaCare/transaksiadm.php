<?php
include 'database.php';

// Ambil data transaksi dari database
$query = "SELECT * FROM pembayaran";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi-Admin</title>
    <link rel="stylesheet" href="transaksiadm.css">
</head>

<body>
    <header>
        <img src="ZjiwaCare.png" alt="ZJiwa Care Logo" class="logo">
        <nav>
            <a href="#">Psikolog</a>
            <a href="#">Informasi</a>
            <a href="#">Transaksi</a>
            <a href="#">Laporan</a>
            <a href="#">Profile</a>
        </nav>
        <a class="admin-button" href="login.html">Admin</a>
    </header>

    <div class="container">
        <h2>Detail Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Booking ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Waktu Konsultasi</th>
                    <th>Psikolog</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['id_transaksi']) . "</td>
                            <td>" . htmlspecialchars($row['booking_id']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['nama']) . "</td>
                            <td>" . htmlspecialchars($row['tanggal_konsultasi']) . "</td>
                            <td>" . htmlspecialchars($row['waktu_konsultasi']) . "</td>
                            <td>" . htmlspecialchars($row['psikolog']) . "</td>
                            <td>Rp " . number_format($row['harga'], 2, ',', '.') . "</td>
                            <td>" . htmlspecialchars($row['metode_pembayaran']) . "</td>
                            <td><span class='status'>" . htmlspecialchars($row['status']) . "</span></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Belum ada transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Tutup koneksi
$db->close();
?>
