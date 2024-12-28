<?php
include 'database.php';
session_start();

// Pastikan booking_id digunakan di pembayaran
if (isset($_SESSION['booking_id'])) {
    $booking_id = $_SESSION['booking_id'];
} else {
    echo "<div class='alert alert-danger'>Booking ID tidak ditemukan.</div>";
    exit;
}

// Move the payment processing to the top
if (isset($_POST["submit"])) {
    if (isset($_SESSION['username']) && isset($_POST['paymentMethod'])) {
        try {

            // Get session data
            $id_transaksi = $_POST['id_transaksi'];
            $username = $_SESSION['username'];
            $nama = $_SESSION['nama'];
            $tanggalLahir = $_SESSION['tanggalLahir'];
            $umur = (int) $_SESSION['umur'];
            $jeniskelamin = $_SESSION['jenisKelamin'];
            $pendidikan = $_SESSION['pendidikan'];
            $alamat = $_SESSION['alamat'];
            $tanggalKonsultasi = $_SESSION['tanggalKonsultasi'];
            $waktuKonsultasi = $_SESSION['waktuKonsultasi'];
            $psikolog = $_SESSION['selected_psikolog'];
            $harga = $_SESSION['selected_harga'];
            $metode_pembayaran = $_POST['paymentMethod'];

            $query = "INSERT INTO pembayaran (
                id_transaksi, username, nama, tanggal_lahir, umur, 
                jenis_kelamin, pendidikan, alamat, 
                tanggal_konsultasi, waktu_konsultasi, 
                psikolog, harga, metode_pembayaran, booking_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $db->prepare($query)) {
                $stmt->bind_param(
                    "ssssissssssssi",
                    $id_transaksi,
                    $username,
                    $nama,
                    $tanggalLahir,
                    $umur,
                    $jeniskelamin,
                    $pendidikan,
                    $alamat,
                    $tanggalKonsultasi,
                    $waktuKonsultasi,
                    $psikolog,
                    $harga,
                    $metode_pembayaran,
                    $booking_id
                );

                if ($stmt->execute()) {
                    $_SESSION['payment_success'] = true;
                    header("Location: detail-pembayaran.php");
                    exit;
                } else {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
            } else {
                throw new Exception("Error preparing statement: " . $db->error);
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Missing required data. Please ensure you are logged in and have selected a payment method.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bayar.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="#">
                <img src="img/ZjiwaCare.png" alt="ZjiwaCare Logo" width="100">
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
                        <a class="nav-link box-nav" href="informasi.html">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav" href="komunitas.html">Komunitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link box-nav active" href="riwayat.html">Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary box-login" href="login.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Section-->
    <section>
        <div class="pembayaran col-lg-12 d-flex align-items-center" style="border: 1px solid red;">
            <div class="inner-div mx-auto col-lg-12align-items-center " style=" width: 600px; height: auto;">
                <h4>Pembayaran Konsultasi</h4>
                <h5 style="padding: 10px;">pilih Metode Pembayaran</h5>
                <div class="px-3">
                    <form id="paymentForm" action="bayar.php" method="POST">
                        <!-- E-Wallet -->
                        <h5 class="fw-light">E-Wallet</h5>
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="gopay" value="gopay">
                            <label class="form-check-label d-flex align-items-center" for="gopay">
                                <img src="./img/image 23.png" alt="Gopay" style="height: 30px;" class="me-2">
                            </label>
                        </div>
                        <div class="form-check border p-3 rounded mb-2">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="ovo" value="ovo">
                            <label class="form-check-label d-flex align-items-center" for="ovo">
                                <img src="./img/image 24.png" alt="OVO" style="height: 30px;" class="me-2">
                            </label>
                        </div>
                        <!-- Transfer Bank -->
                        <div>
                            <h5 class="fw-light">Transfer Bank</h5>
                            <div class="form-check border p-3 rounded mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bca" value="bca">
                                <label class="form-check-label d-flex align-items-center" for="bca">
                                    <img src="./img/image 25.png" alt="BCA" style="height: 30px;" class="me-2">
                                </label>
                            </div>
                            <div class="form-check border p-3 rounded mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="mandiri"
                                    value="mandiri">
                                <label class="form-check-label d-flex align-items-center" for="mandiri">
                                    <img src="./img/image 26.png" alt="Mandiri" style="height: 30px;" class="me-2">
                                </label>
                            </div>
                            <div class="form-check border p-3 rounded mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bri" value="bri">
                                <label class="form-check-label d-flex align-items-center" for="bri">
                                    <img src="./img/image 27.png" alt="BRI" style="height: 30px;" class="me-2">
                                </label>
                            </div>
                            <div class="form-check border p-3 rounded mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bni" value="bni">
                                <label class="form-check-label d-flex align-items-center" for="bni">
                                    <img src="./img/image 28.png" alt="BNI" style="height: 30px;" class="me-2">
                                </label>
                            </div>

                        </div>
                        <input type="hidden" name="id_transaksi" id="transactionIdInput">
                        <div>
                            <h5 class="fw-bold mt-4">Kartu Debit/Kredit</h5>
                            <div class="form-check border p-3 rounded mb-2">
                                <input class="form-check-input" type="radio" name="creditcard" id="creditCard"
                                    data-bs-toggle="collapse" data-bs-target="#creditCardForm" aria-expanded="false"
                                    aria-controls="creditCardForm">
                                <label class="form-check-label d-flex align-items-center" for="creditCard">
                                    <span class="fw-bold">+ Tambahkan Kartu Debit/Kredit</span>
                                </label>
                            </div>

                            <!-- Form Collapse -->
                            <div class="collapse" id="creditCardForm">
                                <div class="form-collapse">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama di Kartu</label>
                                        <input type="text" class="form-control" id="cardname" name="card_name required"
                                            placeholder="Masukkan nama sesuai kartu">
                                    </div>
                                    <div class="mb-3">
                                        <label for="cardNumber" class="form-label">Nomor Kartu</label>
                                        <input type="text" class="form-control" id="cardNumber" name="card_number"
                                            placeholder="Masukkan nomor kartu" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="expiryDate" class="form-label">Tanggal Kedaluwarsa (BB/TT) </label>
                                        <input type="month" class="form-control" id="expiryDate" name="card_date"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="password" class="form-control" id="cvv" placeholder="Masukkan CVV"
                                            name="card_cvv" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cvv" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="card_address" required
                                            placeholder="Masukkan Alamat Tagihan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="cvv" class="form-label">Kode Pos</label>
                                        <input type="password" class="form-control" id="code_post" name="card_pos"
                                            required placeholder="Masukkan Kode Pos">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Add a hidden input for the selected payment method -->
                        <input type="hidden" name="selectedPaymentMethod" id="selectedPaymentMethod">   

                        <!-- Button -->
                        <button class="btn btn-success m-3" id="payButton">Bayar</button>

                        <!-- VA Payment Info -->
                        <div id="vaPaymentInfo" class="mt-4" style="display: none;">
                            <h5>Informasi Virtual Account</h5>
                            <p>Nomor VA: 1234567890</p>
                            <p>Jumlah Pembayaran: Rp 100.000</p>
                            <button name="submit" class="btn btn-success" id="successButton">Berhasil</button>
                            <button class="btn btn-danger" id="failButton">Gagal</button>
                        </div>
                    </form>
                </div>
    </section>


    <!-- Footer -->
    <footer class=" text-center bg-light py-4">
        <div class="container-1">
            <div class="row">
                <div class="col-lg-6 text-left">
                    <h5>ZjiwaCare</h5>
                    <p>PT. Zjiwa Care Nusantara<br>
                        Jl. Ketintang Baru No. 100, Surabaya, Jawa Timur<br>
                        zjiwacare01@gmail.com / +62 - 812-3456-7890</p>
                </div>
                <div class="col-lg-3">
                    <h6>Layanan Konsumen</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6>Download App</h6>
                    <a href="#"><img src="img/playstore.png" alt="Play Store" width="100"></a><br>
                    <a href="#"><img src="img/appstore.png" alt="App Store" width="100"></a>
                </div>
            </div>
            <p class="mt-4">COPY RIGHT 2024 - ZJIWACARE</p>
        </div>
    </footer>


    <script src="bayar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>

</body>

</html>