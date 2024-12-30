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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare - Admin Psikolog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom styles for sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            padding-top: 20px;
            background-color: #212529;
            width: 250px;
            transition: all 0.3s;
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
            margin: 5px 0;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            border-radius: 5px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Toggle button styles */
        #sidebarToggle {
            position: fixed;
            left: 250px;
            top: 10px;
            z-index: 1001;
            transition: all 0.3s;
        }

        /* Sidebar collapsed state */
        .sidebar-collapsed {
            margin-left: -250px;
        }

        .main-content-expanded {
            margin-left: 0;
        }

        /* Profile image styles */
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar-active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            #sidebarToggle {
                left: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="position-sticky">
            <div class="px-3 mb-4">
                <h3 class="text-white">ZjiwaCare</h3>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">
                        <i class="bi bi-speedometer2"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin.php">
                        <i class="bi bi-people"></i>
                        Psikolog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transaksiadm.php">
                        <i class="bi bi-calendar-check"></i>
                        Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="informasiadm.php">
                        <i class="bi bi-person"></i>
                        informasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usersadm.php">
                        <i class="bi bi-gear"></i>
                        users
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Toggle Button -->
    <button class="btn btn-dark" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manajemen Psikolog</h1>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Form Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0"><?= $psychologist ? 'Edit' : 'Tambah' ?> Psikolog</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $psychologist['id'] ?? '' ?>">
                    <input type="hidden" name="current_foto" value="<?= $psychologist['foto'] ?? '' ?>">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Psikolog</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($psychologist['nama'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="spesialisasi" class="form-label">Spesialisasi</label>
                                <input type="text" class="form-control" id="spesialisasi" name="profesi" value="<?= htmlspecialchars($psychologist['spesialisasi'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Konsultasi</label>
                                <input type="text" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($psychologist['harga'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= htmlspecialchars($psychologist['deskripsi'] ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="<?= htmlspecialchars($psychologist['foto'] ?? 'https://via.placeholder.com/120') ?>" alt="Profil" class="profile-img mb-3">
                                <input type="file" class="form-control mb-3" id="foto" name="foto" accept="image/*">
                                <button type="submit" class="btn btn-primary w-100" name="<?= $psychologist ? 'update' : 'add' ?>">
                                    <?= $psychologist ? 'Update' : 'Tambah' ?> Psikolog
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Psikolog</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                <td><img src="<?= htmlspecialchars($row['foto']) ?>" alt="Profil" class="img-thumbnail" width="50"></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['spesialisasi']) ?></td>
                                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                <td><?= htmlspecialchars($row['harga']) ?></td>
                                <td>
                                    <a href="?edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
            document.querySelector('.main-content').classList.toggle('main-content-expanded');
        });

        // Responsive handling
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('sidebar-collapsed');
            document.querySelector('.main-content').classList.add('main-content-expanded');
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.add('sidebar-collapsed');
                document.querySelector('.main-content').classList.add('main-content-expanded');
            } else {
                document.getElementById('sidebar').classList.remove('sidebar-collapsed');
                document.querySelector('.main-content').classList.remove('main-content-expanded');
            }
        });
    </script>
</body>
</html>