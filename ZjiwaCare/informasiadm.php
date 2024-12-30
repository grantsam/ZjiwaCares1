<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_zjiwa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Handle Delete Operation
if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success_message = "<div class='alert alert-success mt-4'>Artikel berhasil dihapus!</div>";
    } else {
        $error_message = "<div class='alert alert-danger mt-4'>Error menghapus artikel!</div>";
    }
    $stmt->close();
}

// Handle Edit Operation
if (isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $judul = $_POST['judul'];
    $gambar = $_POST['gambar'];
    $url = $_POST['url'];
    $kategori = $_POST['kategori'];

    $edit_sql = "UPDATE artikel SET judul = ?, gambar = ?, url = ?, kategori = ? WHERE id = ?";
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param("ssssi", $judul, $gambar, $url, $kategori, $id);

    if ($stmt->execute()) {
        $success_message = "<div class='alert alert-success mt-4'>Artikel berhasil diperbarui!</div>";
    } else {
        $error_message = "<div class='alert alert-danger mt-4'>Error memperbarui artikel!</div>";
    }
    $stmt->close();
}

// Handle Add Operation
if (isset($_POST['add'])) {
    $judul = $_POST['judul'];
    $gambar = $_POST['gambar'];
    $url = $_POST['url'];
    $kategori = $_POST['kategori'];

    $add_sql = "INSERT INTO artikel (judul, gambar, url, kategori) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($add_sql);
    $stmt->bind_param("ssss", $judul, $gambar, $url, $kategori);

    if ($stmt->execute()) {
        $success_message = "<div class='alert alert-success mt-4'>Artikel berhasil ditambahkan!</div>";
    } else {
        $error_message = "<div class='alert alert-danger mt-4'>Error menambahkan artikel!</div>";
    }
    $stmt->close();
}

// Fetch article for editing if edit_id is set
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_fetch_sql = "SELECT * FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($edit_fetch_sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch all articles for display
$query = "SELECT * FROM artikel ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare - Admin Informasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            border-radius: 5px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        #sidebarToggle {
            position: fixed;
            left: 250px;
            top: 10px;
            z-index: 1001;
            transition: all 0.3s;
        }

        .sidebar-collapsed {
            margin-left: -250px;
        }

        .main-content-expanded {
            margin-left: 0;
        }

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

            .modal-confirm {
                color: #636363;
                width: 400px;
            }

            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                border: none;
                text-align: center;
            }

            .modal-confirm .modal-header {
                border-bottom: none;
                position: relative;
            }

            .modal-confirm .modal-footer {
                border-top: none;
                padding: 15px 20px 15px;
                text-align: center;
                border-radius: 5px;
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
                    <a class="nav-link" href="home.html">
                        <i class="bi bi-speedometer2"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">
                        <i class="bi bi-people"></i>
                        Psikolog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transaksiadm.php">
                        <i class="bi bi-cash-stack"></i>
                        Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="informasiadm.php">
                        <i class="bi bi-person"></i>
                        informasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i>
                        Pengaturan
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
            <h1>Kelola Informasi</h1>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0"><?php echo $edit_data ? 'Edit Artikel' : 'Tambah Artikel Baru'; ?></h5>
            </div>
            <div class="card-body">
                <form action="informasiadm.php" method="POST">
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="<?php echo $edit_data ? htmlspecialchars($edit_data['judul']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">URL Gambar</label>
                        <input type="text" class="form-control" id="gambar" name="gambar"
                            value="<?php echo $edit_data ? htmlspecialchars($edit_data['gambar']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL Artikel/Video</label>
                        <input type="text" class="form-control" id="url" name="url"
                            value="<?php echo $edit_data ? htmlspecialchars($edit_data['url']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="Baca Informasi" <?php echo ($edit_data && $edit_data['kategori'] == 'Baca Informasi') ? 'selected' : ''; ?>>Baca Informasi</option>
                            <option value="Tonton Video" <?php echo ($edit_data && $edit_data['kategori'] == 'Tonton Video') ? 'selected' : ''; ?>>Tonton Video</option>
                        </select>
                    </div>
                    <button type="submit" name="<?php echo $edit_data ? 'edit' : 'add'; ?>" class="btn btn-primary">
                        <?php echo $edit_data ? 'Update Artikel' : 'Tambah Artikel'; ?>
                    </button>
                    <?php if ($edit_data): ?>
                        <a href="informasiadm.php" class="btn btn-secondary">Batal</a>
                    <?php endif; ?>
                </form>
                <?php
                if (isset($success_message))
                    echo $success_message;
                if (isset($error_message))
                    echo $error_message;
                ?>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Artikel</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>URL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . htmlspecialchars($row['id']) . "</td>
                                        <td>" . htmlspecialchars($row['judul']) . "</td>
                                        <td>" . htmlspecialchars($row['kategori']) . "</td>
                                        <td>" . htmlspecialchars($row['url']) . "</td>
                                        <td>
                                            <a href='informasiadm.php?edit_id=" . $row['id'] . "' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i></a>
                                            <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row['id'] . "'><i class='bi bi-trash'></i></button>
                                        </td>
                                    </tr>";

                                    // Delete Confirmation Modal for each row
                                    echo "<div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-confirm'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='deleteModalLabel'>Konfirmasi Hapus</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p>Apakah Anda yakin ingin menghapus artikel ini?</p>
                                                    <p class='text-warning'><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <form method='POST'>
                                                        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                        <button type='submit' name='delete' class='btn btn-danger'>Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Belum ada artikel</td></tr>";
                            }
                            ?>
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
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
            document.querySelector('.main-content').classList.toggle('main-content-expanded');
        });

        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('sidebar-collapsed');
            document.querySelector('.main-content').classList.add('main-content-expanded');
        }

        window.addEventListener('resize', function () {
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
<?php
$conn->close();
?>