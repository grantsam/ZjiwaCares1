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
    $stmt = $db->prepare("DELETE FROM psychologists WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
  } elseif (isset($_POST['update'])) {
    // Update data
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $profesi = $_POST['profesi'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Upload foto baru jika ada
    $foto = $_POST['current_foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
      $foto = 'img/' . basename($_FILES['foto']['name']);
      move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    $stmt = $db->prepare("UPDATE psychologists SET nama = ?, spesialisasi = ?, deskripsi = ?, harga = ?, foto = ? WHERE id = ?");
    $stmt->bind_param('sssdsd', $nama, $profesi, $deskripsi, $harga, $foto, $id);
    $stmt->execute();
    $stmt->close();
  }
}

// Ambil data dari database
$result = $db->query("SELECT * FROM psychologists");

// Ambil data untuk update jika ada parameter ID
$psychologist = null;
if (isset($_GET['edit_id'])) {
  $edit_id = $_GET['edit_id'];
  $stmt = $db->prepare("SELECT * FROM psychologists WHERE id = ?");
  $stmt->bind_param('i', $edit_id);
  $stmt->execute();
  $psychologist = $stmt->get_result()->fetch_assoc();
  $stmt->close();
}
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
  <main>
    <div class="container mt-4 daftar-psikolog">
      <h2 class="text-left mb-4">Daftar Psikolog</h2>

      <!-- Form Tambah/Update Psikolog -->
      <div class="form-section mb-4">
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $psychologist['id'] ?? '' ?>">
          <input type="hidden" name="current_foto" value="<?= $psychologist['foto'] ?? '' ?>">
          <div class="row align-items-center">
            <div class="col-md-8">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Psikolog</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Psikolog" value="<?= htmlspecialchars($psychologist['nama'] ?? '') ?>" required>
              </div>
              <div class="mb-3">
                <label for="spesialisasi" class="form-label">Spesialisasi</label>
                <input type="text" class="form-control" id="spesialisasi" name="profesi" placeholder="Spesialisasi" value="<?= htmlspecialchars($psychologist['spesialisasi'] ?? '') ?>" required>
              </div>
              <div class="mb-3">
                <label for="harga" class="form-label">Harga Konsultasi</label>
                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Konsultasi" value="<?= htmlspecialchars($psychologist['harga'] ?? '') ?>" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi" required><?= htmlspecialchars($psychologist['deskripsi'] ?? '') ?></textarea>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <label for="foto" class="form-label d-block">Upload Gambar</label>
              <img src="<?= htmlspecialchars($psychologist['foto'] ?? 'https://via.placeholder.com/120') ?>" alt="Profil" class="profile-img mb-3">
              <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
              <button type="submit" class="btn btn-success mt-3 w-100" name="<?= $psychologist ? 'update' : 'add' ?>"><?= $psychologist ? 'Update' : 'Tambah' ?></button>
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
              <th>Spesialisasi</th>
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
                  <a href="?edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
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
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
