<?php
include 'database.php';
session_start();

// Cek apakah session data ada
if (isset($_SESSION['nama']) && isset($_SESSION['tanggalLahir']) && isset($_SESSION['umur']) && isset($_SESSION['jenisKelamin']) &&
    isset($_SESSION['pendidikan']) && isset($_SESSION['alamat']) && isset($_SESSION['tanggalKonsultasi']) && isset($_SESSION['waktuKonsultasi'])) 
{

    // Ambil data dari session
    $nama = $_SESSION['nama'];
    $tanggalLahir = $_SESSION['tanggalLahir'];
    $umur = $_SESSION['umur'];
    $jenisKelamin = $_SESSION['jenisKelamin'];
    $pendidikan = $_SESSION['pendidikan'];
    $alamat = $_SESSION['alamat'];
    $tanggalKonsultasi = $_SESSION['tanggalKonsultasi'];
    $waktuKonsultasi = $_SESSION['waktuKonsultasi'];
    $username = $_SESSION["username"];
    $contact = $_SESSION["contact"];
    $harga = $_SESSION['selected_harga'];



} else {
    echo "<p>Data booking tidak ditemukan. Silakan isi form terlebih dahulu.</p>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bayar.css">
</head>

<body>

    <div class="pembayaran col-lg-12 d-flex align-items-center" style="border: 1px solid red;">
        <div class="inner-div mx-auto col-lg-12align-items-center " style=" width: 600px; height: auto;">

            <div class="container">
                <h3 class="text-center mb-4">Detail Transaksi</h3>
                <div class="detail-box">
                    <!-- Informasi Layanan -->
                    <h5 class="fw-bold">Informasi Layanan</h5>
                    <p class="mb-1"><strong>Nama Layanan:</strong> Konsultasi Kesehatan</p>
                    <p class="mb-1"><strong>Tanggal:</strong> <?php echo $tanggalKonsultasi; ?></p>
                    <p class="mb-3"><strong>Durasi:</strong> 1 Jam</p>

                    <hr>

                    <!-- Informasi Pelanggan -->
                    <h5 class="fw-bold">Informasi Pelanggan</h5>
                    <p class="mb-1"><strong>Nama:</strong> <?php echo $nama; ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?php echo $username; ?></p>
                    <p class="mb-3"><strong>Nomor Telepon:</strong> <?php echo $contact; ?></p>

                    <hr>

                    <!-- Informasi Pembayaran -->
                    <h5 class="fw-bold">Informasi Pembayaran</h5>
                    <p class="mb-1">
                        <strong>Metode Pembayaran:</strong>
                        <span class="ms-2" id="paymentMethodDisplay"></span>
                    </p>
                    <p class="mb-1"><strong>Status Pembayaran:</strong> Berhasil</p>
                    <p class="mb-3 d-flex align-items-center">
                        <strong>ID Transaksi:</strong>
                        <span class="ms-2" id="transactionIdDisplay"></span>
                    </p>

                    <hr>

                    <!-- Ringkasan Biaya -->
                    <h5 class="fw-bold">Ringkasan Biaya</h5>
                    <div class="d-flex justify-content-between">
                        <p>Harga Layanan</p>
                        <p>Rp <?php echo $harga; ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Biaya Admin</p>
                        <p>Rp 5.000</p>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <p>Total</p>
                        <p>Rp 155.000</p>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <div class="text-center mt-4">
                    <a href="https://example.com" class="btn btn-primary">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <script src="detail-pembayaran.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>