<?php
include 'database.php';
session_start();

// Proses CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add'])) {
    // Tambah data
    $nama = $_POST['nama'];
    $profesi = $_POST['profesi'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Upload foto
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
      $foto = 'img/' . basename($_FILES['foto']['name']);
      move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    $stmt = $db->prepare("INSERT INTO psychologists (nama, spesialisasi, deskripsi, harga, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssds', $nama, $profesi, $deskripsi, $harga, $foto);
    $stmt->execute();
    $stmt->close();
  } elseif (isset($_POST['delete'])) {
    // Hapus data
    $id = $_POST['id'];
    $stmt = $db->prepare("DELETE FROM psikolog WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
  }
}

// Ambil data dari database
$result = $db->query("SELECT * FROM psychologists");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZjiwaCare - Admin Psikolog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Tambahkan gaya CSS Anda di sini */
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="home.html">
        <img src="ZjiwaCare.png" alt="ZjiwaCare Logo" width="100">
      </a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#">Psikolog</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Informasi</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container mt-4">
    <h2>Daftar Psikolog</h2>

    <!-- Form Tambah Psikolog -->
    <div class="form-section mb-4">
      <form method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-8">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="profesi" class="form-label">Profesi</label>
              <input type="text" class="form-control" id="profesi" name="profesi" required>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <label for="foto" class="form-label">Upload Foto</label>
            <input type="file" class="form-control mb-3" id="foto" name="foto" required>
            <button type="submit" name="add" class="btn btn-success">Tambah</button>
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


    <main>
    <div class="container mt-4 daftar-psikolog">
      <h2 class="text-left mb-4">Daftar Psikolog</h2>

    <!-- Form Tambah Psikolog -->
    <div class="form-section mb-4">
       <form action="" method="POST" enctype="multipart/form-data">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Psikolog</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Psikolog" required>
            </div>
            <div class="mb-3">
              <label for="spesialisasi" class="form-label">Spesialisasi</label>
              <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" placeholder="Spesialisasi" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga Konsultasi</label>
              <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Konsultasi" required>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"  required></textarea>
            </div>
          </div>
          <div class="col-md-4 text-center">
            <label for="foto" class="form-label d-block">Upload Gambar</label>
            <img src="https://via.placeholder.com/120" alt="Profil" class="profile-img mb-3">
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
            <button type="submit" class="btn btn-success mt-3 w-100" name="submit">Tambah</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Tabel Psikolog -->
    <div class="table-section">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Profil</th>
            <th>Nama</th>
            <th>Profesi</th>
            <th>Deskripsi</th>
            <th>Harga</th>
    <!-- PHP Logic -->
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Database configuration
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'users_zjiwa';

            // Connect to the database
            $db = new mysqli($host, $user, $password, $database);

            if ($db->connect_error) {
                die("Koneksi gagal: " . $db->connect_error);
            }

            // Handle file upload
            $foto = $_FILES['foto']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($foto);
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);

            // Insert data into the database
            $nama = $db->real_escape_string($_POST['nama']);
            $spesialisasi = $db->real_escape_string($_POST['spesialisasi']);
            $deskripsi = $db->real_escape_string($_POST['deskripsi']);
            $harga = $db->real_escape_string($_POST['harga']);

            $sql = "INSERT INTO psychologists (nama, spesialisasi, deskripsi, harga, foto) VALUES ('$nama', '$spesialisasi', '$deskripsi', '$harga', '$target_file')";

            if ($db->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
            } else {
                echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $db->error . "</div>";
            }
        }
        ?>

    <!-- Tabel Psikolog -->
    <div class="table-section">
      <table class="table table-striped align-middle">
        <thead class="table-light text-center">
          <tr>
            <th>No</th>
            <th>Profil</th>
            <th>Nama</th>
            <th>Spesialisasi</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><img src="<?= htmlspecialchars($row['foto']) ?>" alt="Profil" class="img-thumbnail" width="100"></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td><?= htmlspecialchars($row['spesialisasi']) ?></td>
              <td><?= htmlspecialchars($row['deskripsi']) ?></td>
              <td><?= htmlspecialchars($row['harga']) ?></td>
              <td>
                <form method="POST" class="d-inline">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" name="delete" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>

</html>
                  <?php
                        $sql = "SELECT * FROM psychologists ORDER BY id DESC";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td><img src='" . $row['foto'] . "' alt='Foto Psikolog' width='50'></td>";
                                echo "<td>" . $row['nama'] . "</td>";
                                echo "<td>" . $row['spesialisasi'] . "</td>";
                                echo "<td>" . $row['deskripsi'] . "</td>";
                                echo "<td>
                                    <a href='?edit=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                                  </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>Tidak ada data psikolog.</td></tr>";
                        }
                    ?>
        </tbody>
      </table>
    </div>
  </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

