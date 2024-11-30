<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare-Cari Psikolog</title>
    <link rel="stylesheet" href="cari-psikolog.css">
</head>
<body id="1000">
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="img/ZjiwaCare.png" alt="Logo ZjiwaCare">
        </div>
        <nav>
            <a href="home.html">Home</a>
            <a href="layanan.html">Layanan</a>
            <a href="informasi.html">Informasi</a>
            <a href="komunitas.html">Komunitas</a>
            <a href="riwayat.html">Riwayat</a>
            <button id="login-button" href="login.html">Login</button>
        </nav>
    </header>
    <main>
        <h1>Ingin Mulai Konsultasi?</h1>
        <p>Yuk, Kenali Psikolog Kami!</p>

        <div class="psychologist-list">
            <?php
            // Koneksi ke database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "zjiwacare";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mengambil data psikolog
            $sql = "SELECT * FROM psychologists";
            $result = $conn->query($sql);

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
                            <a href="booking.html?nama=' . urlencode($row['nama']) . '&spesialisasi=' . urlencode($row['spesialisasi']) . '&harga=' . urlencode($row['harga']) . '" class="btn">Buat Jadwal</a>
                            <a href="' . $row['chat_url'] . '" class="btn">Chat</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>Tidak ada data psikolog tersedia.</p>";
            }

            $conn->close();
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
