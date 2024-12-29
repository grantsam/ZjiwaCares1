<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_zjiwa"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $gambar = $_POST['gambar'];
    $url = $_POST['url'];
    $kategori = $_POST['kategori'];

    // Query untuk menyimpan artikel ke database
    $sql = "INSERT INTO artikel (judul, gambar, url, kategori) VALUES ('$judul', '$gambar', '$url', '$kategori')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-4'>Artikel berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZjiwaCare-Admin Psikolog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Psikologadm.css">
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
                        <a class="nav-link box-nav active" href="#">Psikolog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="#">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="#">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="#">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary box-login" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<body>



    <main>
    <div class="container mt-4 daftar-psikolog">
      <h2 class="text-left mb-4">Tambah Informasi</h2>

    <div class="container">
        <form action="informasiadm.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">URL Gambar</label>
                <input type="text" class="form-control" id="gambar" name="gambar" required>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL Artikel/Video</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="Baca Informasi">Baca Informasi</option>
                    <option value="Tonton Video">Tonton Video</option>
                </select><br>
            </div>
            <button type="submit" class="btn btn-success mt-3 w-100" name="submit">Tambah Artikel</button>
        </form>
    </div>
</main>
</body>
</html>
