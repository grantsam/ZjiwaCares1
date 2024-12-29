<?php
// Mulai sesi untuk menangkap data user yang login
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Konfigurasi database
include 'database.php';

// Variabel untuk menyimpan data booking
$bookings = [];

try {
    // Ambil data booking berdasarkan user_id
    $stmt = $db->prepare("
        SELECT 
            booking.psikolog, 
            booking.spesialisasi, 
            booking.tanggalKonsultasi AS tanggalKonsultasi, 
            booking.waktuKonsultasi AS waktuKonsultasi, 
            booking.harga, 
            pembayaran.id_transaksi,
            psychologists.foto AS foto
        FROM 
            booking
        LEFT JOIN 
            pembayaran 
        ON 
            booking.booking_id = pembayaran.booking_id
        LEFT JOIN 
            psychologists
        ON 
            booking.psikolog = psychologists.nama
        WHERE 
            booking.user_id = ?

    ");
    if ($stmt) {
        $stmt->bind_param("i", $user_id); // Bind parameter
        $stmt->execute();
        $result = $stmt->get_result(); // Ambil hasil query

        // Simpan hasil dalam array $bookings
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }

        $stmt->close();
    } else {
        throw new Exception("Error preparing statement: " . $db->error);
    }
} catch (Exception $e) {
    // Tampilkan pesan error (opsional, untuk debugging)
    echo "<div class='alert alert-danger'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Konsultasi - ZjiwaCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="riwayat-konsultasi.css">
</head>

<body class="fade-in">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="riwayat-konsultasi.php">
                <img src="ZjiwaCare.png" alt="ZjiwaCare Logo" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="layanan.php">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="informasi2.php">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="komunitas2.php">Komunitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav active" href="riwayat.html">Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary box-login" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Section -->
    <section class="my-5">
        <div class="container">
            <h1 class="mb-4">Riwayat Konsultasi</h1>
            <?php if (empty($bookings)): ?>
                <p class="text-muted">Belum ada riwayat konsultasi.</p>
            <?php else: ?>
                <?php foreach ($bookings as $booking): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                <img src="<?= $booking['foto'] ?>" alt="Doctor" class="img-fluid rounded-circle">
                                </div>
                                <div class="col-md-10">
                                    <p class="text-muted mb-0">
                                        <?= $booking['psikolog'] ?> - <?= $booking['spesialisasi'] ?>
                                    </p>
                                    <p class="mb-0">
                                        <?= $booking['tanggalKonsultasi'] ?><br>
                                        <?= $booking['waktuKonsultasi'] ?><br>
                                        Rp <?= number_format($booking['harga'], 2, ',', '.') ?>
                                        ID Transaksi:
                                        <?= $booking['id_transaksi'] ? $booking['id_transaksi'] : 'Belum ada transaksi' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center bg-light py-4">
        <div class="container">
            <p class="mt-4">COPY RIGHT 2024 - ZJIWACARE</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>