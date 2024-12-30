<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare-Cari Psikolog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cari-psikolog.css">
</head>
    
<body class="fade-in">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="home.html">
                <img src="ZjiwaCare.png" alt="ZjiwaCare Logo" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link box-nav active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="layanan.html">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="informasi2.php">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="komunitas2.html">Komunitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="riwayat.html">Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary box-login" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        <h1>Ingin Mulai Konsultasi?</h1>
        <p>Yuk, Kenali Psikolog Kami!</p>

        <div class="psychologist-list">
            <?php
            include 'database.php';

            // Periksa koneksi
            if ($db->connect_error) {
                die("Koneksi gagal: " . $db->connect_error);
            }

            // Query untuk mengambil data psikolog
            $sql = "SELECT * FROM psychologists";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="psychologist-card">
                        <img src="' . $row['foto'] . '" alt="Psychologist Photo">
                        <div class="psychologist-info">
                            <h2>' . $row['nama'] . '</h2>
                            <p>' . $row['spesialisasi'] . '</p>
                            <p>' . $row['deskripsi'] . '</p><br>
                            <div class="button-group">
                            <a href="booking.php?nama=' . urlencode($row['nama']) . '&spesialisasi=' . urlencode($row['spesialisasi']) . '&harga=' . urlencode($row['harga']) . '" class="btn">Buat Jadwal</a>
                            <a href="home.html" class="btn">Chat</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>Tidak ada data psikolog tersedia.</p>";
            }

            $db->close();
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img src="img/ZjiwaCare.png" alt="ZjiwaCare Logo">
            <p>PT. Zjiwa Care Nusantara</p>
            <p>Jl. Keitintang Baru No. 100, Surabaya, Jawa Timur</p>
            <p>zjiwacare01@gmail.com / +62 - 812-3456-7890</p>
        </div>
        <div class="footer-links">
            <h4>Layanan Konsumen</h4>
            <p><a href="#">FAQ</a></p>
            <p><a href="#">Hubungi Kami</a></p>
        </div>
        <div class="footer-apps">
            <h4>Download App</h4>
            <a href="#"><img src="img/playstore.png" alt="Google Play"></a>
            <a href="#"><img src="img/appstore.png" alt="App Store"></a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>COPYRIGHT 2024 - ZJIWACARE</p>
    </div>

    </footer>

    </main>
    <script src="home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
    </html>
