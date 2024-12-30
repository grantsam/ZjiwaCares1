<?php
session_start();
include 'database.php';
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare-Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <style>
        #symptoms-section {
            padding: 50px 0;
        }

        .gejala-boxes {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            margin-bottom: 20px;
        }

        .gejala-box {
            background-color: #ffece7;
            width: 12%;
            text-align: center;
            padding: 10px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gejala-box img {
            width: 70%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .gejala-box p {
            text-align: center;
            font-size: 12px;
            font-weight: 550;
            color: #d95d39;
            margin-top: 10px;
            line-height: 1.2;
        }

        #find-psychologist-button {
            background-color: #00695c;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        #find-psychologist-button:hover {
            background-color: #004d40;
        }

        .tes-box h3 {
            text-align: center;
            font-size: 18px;
            color: #d95d39;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .tes-box img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }
    </style>
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
                    <?php if ($is_admin): ?>
                        <li class="nav-item">
                            <a class="nav-link box-nav" href="admin.php">Dashboard</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="btn btn-primary box-login" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bagian Selamat Datang -->
    <main>
        <section id="welcome-section">
            <div class="welcome-content">
                <div class="welcome-text">
                    <h1>Selamat Datang Gen Z</h1>
                    <p>Kami hadir untuk membantumu</p>
                    <button id="btn-appointment" onclick="location.href='cari-psikolog.php';">Buat Janji</button>
                </div>
                <div class="welcome-image">
                    <img src="2.png" alt="Ilustrasi Selamat Datang">
                </div>
            </div>
        </section>
        <!-- Bagian Ketahui Gejalamu -->
        <section id="symptoms-section">
            <div class="gejala-content">
                <div class="gejala-image">
                    <img src="1.png" alt="Ilustrasi Gejala">
                </div>
                <div class="gejala-text">
                    <h2>Cari Tahu Gejalamu</h2>
                    <p>Telusuri informasi yang tersedia untuk mengetahui gejalamu</p>
                    <div class="gejala-boxes">
                        <div class="gejala-box" onclick="showGejala('depresi')">
                            <img src="img/depresi1.png">
                            <p>Depresi</p>
                        </div>
                        <div class="gejala-box" onclick="showGejala('stres')">
                            <img src="img/stress1.png">
                            <p>Stres</p>
                        </div>
                        <div class="gejala-box" onclick="showGejala('kecemasan')">
                            <img src="img/cemas1.png">
                            <p>Gangguan Kecemasan</p>
                        </div>
                        <div class="gejala-box" onclick="showGejala('mood')">
                            <img src="img/mood1.png">
                            <p>Gangguan Mood</p>
                        </div>
                        <div class="gejala-box" onclick="showGejala('trauma')">
                            <img src="img/trauma1.png">
                            <p>Trauma</p>
                        </div>
                        <div class="gejala-box" onclick="showGejala('kecanduan')">
                            <img src="img/candu.png">
                            <p>Kecanduan</p>
                        </div>
                        <div class="gejala-box" onclick="showGejala('hubungan')">
                            <img src="img/hubungan1.png">
                            <p>Keluarga & Hubungan</p>
                        </div>
                    </div>

                    <div id="gejala-description">
                        <p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
                            Depresi adalah gangguan kesehatan mental yang umum dan serius yang ditandai dengan suasana
                            hati yang rendah, kehilangan minat atau kesenangan, dan berbagai gejala fisik dan mental
                            lainnya. Meskipun kesedihan adalah emosi yang normal, depresi berbeda karena intensitas dan
                            durasinya yang lebih besar, serta dampaknya yang signifikan pada kehidupan sehari-hari.
                        </p>
                    </div>
                </div>
            </div>
            <button id="find-psychologist-button" onclick="location.href='cari-psikolog.php';">Cari Psikolog</button>
        </section>
        <!-- Section Tes Kesehatan Mental -->
        <section id="tes-kesehatan">
            <div class="tes-heading">
                <h2>Lakukan Tes Kesehatan Mental</h2>
                <p>Pemeriksaan cepat, hasil instan</p>
            </div>
            <div class="tes-boxes">
                <div class="tes-box">
                    <img src="img/tes-stress.png" alt="Tes Stress">
                    <h3>Tes Stress</h3><br><br>
                    <button onclick="location.href='#';">Kerjakan</button>
                </div>
                <div class="tes-box">
                    <img src="img/tes-cemas.png" alt="Tes Gangguan Kecemasan">
                    <h3>Tes Gangguan Kecemasan</h3><br>
                    <button onclick="location.href='#';">Kerjakan</button>
                </div>
                <div class="tes-box">
                    <img src="img/tes-depresi.png" alt="Tes Depresi">
                    <h3>Tes Depresi</h3><br><br>
                    <button onclick="location.href='#';">Kerjakan</button>
                </div>
                <div class="tes-box">
                    <img src="img/tes-mood.png" alt="Tes Gangguan Mood">
                    <h3>Tes Gangguan Mood</h3><br>
                    <button onclick="location.href='#';">Kerjakan</button>
                </div>
            </div>
        </section>
        <!-- Section Komunikasikan Bersama Layanan Kami -->
        <section id="layanan-komunikasi">
            <div class="layanan-heading">
                <h2>Komunikasikan Bersama Layanan Kami</h2>
                <p>Konseling secara nyaman bersama para ahli</p>
            </div>
            <div class="layanan-boxes">
                <div class="layanan-box">
                    <img src="konsul video.png" alt="gambar konsul video">
                    <h3>Konsultasi Video Call</h3>
                    <button onclick="location.href='layanan.html';">Selengkapnya</button>
                </div>
                <div class="layanan-box">
                    <img src="konsul chat.png" alt="Gambar Konsul chat">
                    <h3>Konsultasi Chat</h3>
                    <button onclick="location.href='layanan.html';">Selengkapnya</button>
                </div>
                <div class="layanan-box">
                    <img src="talk with me.png" alt="Gambar talk with me">
                    <h3>Talk With Me</h3>
                    <button onclick="location.href='layanan.html';">Selengkapnya</button>
                </div>
            </div>
        </section>
        <!-- Section Informasi Kesehatan Mental -->
        <section id="informasi-kesehatan">
            <div class="informasi-heading">
                <h2>Informasi Kesehatan Mental</h2>
                <p>Baca untuk ketahui tips dan informasi terbaru</p>
            </div>
            <div class="informasi-items">
                <div class="informasi-item">
                    <img src="artikel1.png" alt="Gambar Artikel 1">
                    <h3>10 Cara Menjaga Kesehatan Mental di Hari Kesehatan Mental Sedunia</h3>
                </div>
                <div class="informasi-item">
                    <img src="artikel2.png" alt="Gambar Artikel 2">
                    <h3>11 Kiat Berkomunikasi dengan Remaja</h3>
                </div>
                <div class="informasi-item">
                    <img src="artikel3.jpg" alt="Gambar Artikel 3">
                    <h3>Hari Kesehatan Mental Sedunia: Kapan Kita Harus ke Psikolog, Ya?</h3>
                </div>
            </div>
            <button class="lihat-semua" onclick="location.href='informasi2.php';">Lihat Semua</button>
        </section>
    </main>
    <!-- Footer -->
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

    <script src="home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>