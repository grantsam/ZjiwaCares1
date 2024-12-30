<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zjiwa-info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="informasi.css">
</head>

<body class="fade-in">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="informasi2.html">
                <img src="ZjiwaCare.png" alt="ZjiwaCare Logo" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="layanan.html">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav active" href="informasi2.php">Informasi</a>
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


        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root"; // Sesuaikan dengan username database Anda
        $password = ""; // Sesuaikan dengan password database Anda
        $dbname = "users_zjiwa"; // Ganti dengan nama database Anda

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mendapatkan data dari tabel 'artikel'
        $sql = "SELECT * FROM artikel";
        $result = $conn->query($sql);
        ?>

            <!-- Baca Informasi Section -->
            <section id="baca-informasi">
                <div class="container">
                    <div class="row">
                        <!-- Container untuk Box Baca Informasi -->
                        <div class="col-lg-12 ms-5">
                            <div class="baca-informasi-heading">
                                <h2>Baca Informasi</h2>
                            </div>

                            <div class="row mt-4">
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Hanya menampilkan artikel yang termasuk kategori "Baca Informasi"
                                        if ($row['kategori'] == 'Baca Informasi') {
                                            echo '<div class="baca-informasi-box card mx-2 d-flex flex-column" style="width: 18rem;">';
                                            echo '<img src="' . $row['gambar'] . '" class="card-img-top" alt="' . $row['judul'] . '">';
                                            echo '<div class="card-body d-flex flex-grow-1 flex-column">';
                                            echo '<p class="card-text">' . $row['judul'] . '</p>';
                                            echo '<button class="btn btn-primary mt-auto" onclick="window.open(\'' . $row['url'] . '\', \'_blank\');">Baca</button>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    echo "<p>Tidak ada artikel untuk ditampilkan.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tonton Video Section -->
            <section id="tonton-video">
                <div class="container">
                    <div class="row">
                        <!-- Container untuk Box Tonton Video -->
                        <div class="col-lg-12 ms-5">
                            <div class="baca-informasi-heading">
                                <h2>Tonton Video</h2>
                            </div>

                            <div class="row mt-4">
                                <?php
                                if ($result->num_rows > 0) {
                                    // Mengulang lagi untuk kategori "Tonton Video"
                                    $result->data_seek(0); // Reset pointer hasil query
                                    while ($row = $result->fetch_assoc()) {
                                        // Hanya menampilkan artikel yang termasuk kategori "Tonton Video"
                                        if ($row['kategori'] == 'Tonton Video') {
                                            echo '<div class="baca-informasi-box card mx-2 d-flex flex-column" style="width: 18rem;">';
                                            echo '<img src="' . $row['gambar'] . '" class="card-img-top" alt="' . $row['judul'] . '">';
                                            echo '<div class="card-body d-flex flex-grow-1 flex-column">';
                                            echo '<p class="card-text">' . $row['judul'] . '</p>';
                                            echo '<button class="btn btn-primary mt-auto" onclick="window.open(\'' . $row['url'] . '\', \'_blank\');">Tonton</button>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    echo "<p>Tidak ada video untuk ditampilkan.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            // Tutup koneksi
            $conn->close();
            ?>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="ZjiwaCare.png" alt="ZjiwaCare Logo">
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
                <a href="#"><img src="playstore.png" alt="Google Play"></a>
                <a href="#"><img src="appstore.png" alt="App Store"></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>COPYRIGHT 2024 - ZJIWACARE</p>
        </div>
    </footer>

    <script src="informasi.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
