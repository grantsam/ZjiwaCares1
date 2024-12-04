<?php
    include 'database.php';
    session_start();

    // Initialize variables with values from URL parameters, with proper security measures
    $psikolog = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : 'Tidak ada nama';
    $spesialisasi = isset($_GET['spesialisasi']) ? htmlspecialchars($_GET['spesialisasi']) : 'Tidak ada spesialisasi';
    $harga = isset($_GET['harga']) ? htmlspecialchars($_GET['harga']) : 'Tidak ada harga';

    // If we have parameters in the URL, store them in the session
if (isset($_GET['nama']) && isset($_GET['spesialisasi']) && isset($_GET['harga'])) {
    $_SESSION['selected_psikolog'] = $psikolog;
    $_SESSION['selected_spesialisasi'] = $spesialisasi;
    $_SESSION['selected_harga'] = $harga;
    
    // If you want to verify against database
    $nama = mysqli_real_escape_string($db, $_GET['nama']);
    $sql = "SELECT * FROM psychologists WHERE nama = '$nama'";
    $result = $db->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Update variables with database values for extra security
        $psikolog = htmlspecialchars($row['nama']);
        $spesialisasi = htmlspecialchars($row['spesialisasi']);
        $harga = htmlspecialchars($row['harga']);
        
        // Update session with verified values
        $_SESSION['selected_psikolog'] = $psikolog;
        $_SESSION['selected_spesialisasi'] = $spesialisasi;
        $_SESSION['selected_harga'] = $harga;
    }
}
// If we don't have URL parameters but have session data, use that
elseif (isset($_SESSION['selected_psikolog'])) {
    $psikolog = $_SESSION['selected_psikolog'];
    $spesialisasi = $_SESSION['selected_spesialisasi'];
    $harga = $_SESSION['selected_harga'];
}

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Sanitize input data
        $nama = mysqli_real_escape_string($db, $_POST['nama']);
        $tanggalLahir = mysqli_real_escape_string($db, $_POST['tanggalLahir']);
        $umur = (int)$_POST['umur'];
        $jenisKelamin = mysqli_real_escape_string($db, $_POST['jenisKelamin']);
        $pendidikan = mysqli_real_escape_string($db, $_POST['pendidikan']);
        $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
        $tanggalKonsultasi = mysqli_real_escape_string($db, $_POST['tanggalKonsultasi']);
        $waktuKonsultasi = mysqli_real_escape_string($db, $_POST['waktuKonsultasi']);

        // Create the query with properly escaped values
        $query = "INSERT INTO booking (nama, tanggalLahir, umur, jenisKelamin, pendidikan, alamat, 
                tanggalKonsultasi, waktuKonsultasi, psikolog, spesialisasi, harga)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
        // Use prepared statement
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param("ssissssssss", 
                $nama, $tanggalLahir, $umur, $jenisKelamin, $pendidikan, $alamat,
                $tanggalKonsultasi, $waktuKonsultasi, $psikolog, $spesialisasi, $harga
            );
            
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Error in preparing statement: " . $db->error . "</div>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking-ZjiwaCare</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="booking.css">
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container d-flex justify-content-center">
                <a class="navbar-brand" href="#">
                    <img src="img/ZjiwaCare.png" alt="ZjiwaCare Logo" width="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

        <!-- body -->
         <div class="container-1">
    <div class="col-sm-6">
        <h1>Formulir Pendaftaran Konsultasi</h1>
        <form class="" action="booking.php" method="POST">
            <div class="form-group row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="tanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" placeholder="Masukkan Tanggal Lahir" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="umur" name="umur" placeholder="Masukkan Umur" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-control" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" placeholder="Masukkan Pendidikan" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                </div>
            </div>
    </div>
</div>

<!-- Consultation Schedule Section -->
<div class="container-2">
    <h5 class="my-4">Jadwal Konsultasi</h5>
    <div class="row mb-3">
        <div class="table-consul col-md-6">
            <label for="tanggalKonsultasi" class="form-label">Tanggal Konsultasi</label>
            <input type="date" class="form-control" id="tanggalKonsultasi" name="tanggalKonsultasi" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Waktu Konsultasi</label>
            <div class="d-flex flex-wrap">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="waktuKonsultasi" id="time1" value="10.00 AM" required>
                    <label class="form-check-label" for="time1">10.00 AM</label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="waktuKonsultasi" id="time2" value="13.00 PM">
                    <label class="form-check-label" for="time2">13.00 PM</label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="waktuKonsultasi" id="time3" value="14.30 PM">
                    <label class="form-check-label" for="time3">14.30 PM</label>
                </div>
            </div>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="waktuKonsultasi" id="time4" value="16.30 PM">
                    <label class="form-check-label" for="time4">16.30 PM</label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="waktuKonsultasi" id="time5" value="18.00 PM">
                    <label class="form-check-label" for="time5">18.00 PM</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="waktuKonsultasi" id="time6" value="19.30 PM">
                    <label class="form-check-label" for="time6">19.30 PM</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Details Section -->
<div class="row my-5">
    <div class="col-md-6">
        <h6>Detail Layanan</h6>
        <p>Nama: <?php echo htmlspecialchars($psikolog); ?></p>
        <p>Spesialisasi: <?php echo htmlspecialchars($spesialisasi); ?></p>
        <p>Harga: <?php echo htmlspecialchars($harga); ?></p>
        
        <!-- If you still want a button to submit the form -->
        <button type="submit" class="btn btn-success">Submit Booking</button>
    </div>
</div>

</div>
</form>


      <!-- Footer -->
    <footer class="text-center bg-light py-4">
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


    </body>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="booking.js"></script>


</html>