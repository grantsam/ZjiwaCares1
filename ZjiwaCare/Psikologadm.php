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