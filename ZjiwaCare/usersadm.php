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
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success_message = "<div class='alert alert-success mt-4'>Pengguna berhasil dihapus!</div>";
    } else {
        $error_message = "<div class='alert alert-danger mt-4'>Error menghapus pengguna!</div>";
    }
    $stmt->close();
}

// Handle Edit Operation
if (isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $data_kelahiran = $_POST['data_kelahiran'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pendidikan_karir = $_POST['pendidikan_karir'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    // Handle image upload
    $image = $_POST['current_image']; // Keep existing image by default
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    $edit_sql = "UPDATE users SET username = ?, name = ?, contact = ?, image = ?, 
                 data_kelahiran = ?, umur = ?, jenis_kelamin = ?, pendidikan_karir = ?, 
                 alamat = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($edit_sql);
    $stmt->bind_param(
        "ssssssssssi",
        $username,
        $name,
        $contact,
        $image,
        $data_kelahiran,
        $umur,
        $jenis_kelamin,
        $pendidikan_karir,
        $alamat,
        $role,
        $id
    );

    if ($stmt->execute()) {
        $success_message = "<div class='alert alert-success mt-4'>Data pengguna berhasil diperbarui!</div>";
    } else {
        $error_message = "<div class='alert alert-danger mt-4'>Error memperbarui data pengguna!</div>";
    }
    $stmt->close();
}

// Fetch user for editing if edit_id is set
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_fetch_sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($edit_fetch_sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

// Fetch all users
$query = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare - Manajemen Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .user-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            margin-top: 10px;
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
                    <a class="nav-link" href="admin.php">
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
                    <a class="nav-link active" href="usersadm.php">
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
            <h1>Manajemen Pengguna</h1>
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

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Pengguna</h5>
                        <h2 class="card-text"><?php echo $result->num_rows; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Admin</h5>
                        <h2 class="card-text"><?php
                        $admin_count = 0;
                        $result_temp = $result;
                        while ($row = $result_temp->fetch_assoc()) {
                            if ($row['role'] == 'admin')
                                $admin_count++;
                        }
                        mysqli_data_seek($result, 0);
                        echo $admin_count;
                        ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Pengguna</h5>
                        <h2 class="card-text"><?php
                        echo $result->num_rows - $admin_count;
                        ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($edit_data): ?>
            <!-- Edit User Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Data Pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="usersadm.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $edit_data['image']; ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?php echo htmlspecialchars($edit_data['username']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo htmlspecialchars($edit_data['name']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    value="<?php echo htmlspecialchars($edit_data['contact']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <?php if ($edit_data['image']): ?>
                                    <img src="<?php echo htmlspecialchars($edit_data['image']); ?>" class="preview-image"
                                        alt="Current profile image">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_kelahiran" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="data_kelahiran" name="data_kelahiran"
                                    value="<?php echo htmlspecialchars($edit_data['data_kelahiran']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" class="form-control" id="umur" name="umur"
                                    value="<?php echo htmlspecialchars($edit_data['umur']); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="Laki-laki" <?php echo ($edit_data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php echo ($edit_data['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="user" <?php echo ($edit_data['role'] == 'user') ? 'selected' : ''; ?>>User
                                    </option>
                                    <option value="admin" <?php echo ($edit_data['role'] == 'admin') ? 'selected' : ''; ?>>
                                        Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pendidikan_karir" class="form-label">Pendidikan/Karir</label>
                            <textarea class="form-control" id="pendidikan_karir" name="pendidikan_karir"
                                rows="2"><?php echo htmlspecialchars($edit_data['pendidikan_karir']); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"
                                rows="3"><?php echo htmlspecialchars($edit_data['alamat']); ?></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="edit" class="btn btn-primary">Update Data</button>
                            <a href="usersadm.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Pengguna</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Role</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . htmlspecialchars($row['id']) . "</td>
                                        <td><img src='" . htmlspecialchars($row['image']) . "' class='user-image' alt='Profile'></td>
                                        <td>" . htmlspecialchars($row['username']) . "</td>
                                        <td>" . htmlspecialchars($row['name']) . "</td>
                                        <td>" . htmlspecialchars($row['contact']) . "</td>
                                        <td>" . htmlspecialchars($row['umur']) . "</td>
                                        <td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>
                                        <td><span class='badge bg-" . ($row['role'] == 'admin' ? 'primary' : 'secondary') . "'>"
                                        . htmlspecialchars($row['role']) . "</span></td>
                                        <td>" . date('d/m/Y', strtotime($row['created_at'])) . "</td>
                                        <td>
                                            <a href='usersadm.php?edit_id=" . $row['id'] . "' class='btn btn-sm btn-primary'><i class='bi bi-pencil'></i></a>
                                            <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row['id'] . "'><i class='bi bi-trash'></i></button>
                                        </td>
                                    </tr>";

                                    // Delete Confirmation Modal
                                    echo "<div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Konfirmasi Hapus</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p>Apakah Anda yakin ingin menghapus pengguna <strong>" . htmlspecialchars($row['username']) . "</strong>?</p>
                                                    <p class='text-danger'><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <form method='POST'>
                                                        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                        <button type='submit' name='delete' class='btn btn-danger'>Hapus</button> </form> </div> </div> </div> </div>";
                                }
                            } else {
                                echo "<tr><td colspan='10' class='text-center'>Tidak ada pengguna yang ditemukan.</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
            document.querySelector('.main-content').classList.toggle('main-content-expanded');
        });

        // Responsive handling
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
<?php $conn->close(); ?>