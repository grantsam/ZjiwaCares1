<?php
include 'database.php';

// Ambil data transaksi dari database
$query = "SELECT * FROM pembayaran";
$result = $db->query($query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZjiwaCare - Admin Transaksi</title>
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

        /* Status badge styles */
        .badge.status-pending {
            background-color: #ffc107;
        }

        .badge.status-success {
            background-color: #198754;
        }

        .badge.status-failed {
            background-color: #dc3545;
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
                    <a class="nav-link active" href="transaksiadm.php">
                        <i class="bi bi-cash-stack"></i>
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
            <h1>Data Transaksi</h1>
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
                        <h5 class="card-title text-muted">Total Transaksi</h5>
                        <h2 class="card-text" id="totalTransaksi">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Transaksi Berhasil</h5>
                        <h2 class="card-text" id="transaksiSukses">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Transaksi Gagal</h5>
                        <h2 class="card-text" id="transaksiGagal">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Transaksi Pending</h5>
                        <h2 class="card-text" id="transaksiPending">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Pendapatan</h5>
                        <h2 class="card-text" id="totalPendapatan">Rp0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Transaksi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Booking ID</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Tanggal Konsultasi</th>
                                <th>Waktu</th>
                                <th>Psikolog</th>
                                <th>Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Tentukan class untuk status badge
                                    $statusClass = 'bg-secondary';
                                    switch (strtolower($row['status'])) {
                                        case 'pending':
                                            $statusClass = 'bg-warning';
                                            break;
                                        case 'success':
                                        case 'berhasil':
                                            $statusClass = 'bg-success';
                                            break;
                                        case 'failed':
                                        case 'gagal':
                                            $statusClass = 'bg-danger';
                                            break;
                                    }

                                    echo "<tr>
                                        <td>" . htmlspecialchars($row['id_transaksi']) . "</td>
                                        <td>" . htmlspecialchars($row['booking_id']) . "</td>
                                        <td>" . htmlspecialchars($row['username']) . "</td>
                                        <td>" . htmlspecialchars($row['nama']) . "</td>
                                        <td>" . htmlspecialchars($row['tanggal_konsultasi']) . "</td>
                                        <td>" . htmlspecialchars($row['waktu_konsultasi']) . "</td>
                                        <td>" . htmlspecialchars($row['psikolog']) . "</td>
                                        <td>Rp " . number_format($row['harga'], 2, ',', '.') . "</td>
                                        <td>" . htmlspecialchars($row['metode_pembayaran']) . "</td>
                                        <td><span class='badge $statusClass'>" . htmlspecialchars($row['status']) . "</span></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='10' class='text-center'>Belum ada transaksi</td></tr>";
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
    <script>
        async function fetchTransactionData() {
            try {
                const response = await fetch('get_transaksi_data.php'); // Pastikan file ini adalah file PHP di atas
                const data = await response.json();

                // Update nilai elemen berdasarkan hasil data
                document.querySelector('#totalTransaksi').textContent = data.total_transaksi || 0;
                document.querySelector('#transaksiSukses').textContent = data.transaksi_sukses || 0;
                document.querySelector('#transaksiGagal').textContent = data.transaksi_gagal || 0;
                document.querySelector('#transaksiPending').textContent = data.transaksi_pending || 0;
                document.querySelector('#totalPendapatan').textContent =
                    new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.total_pendapatan || 0);
            } catch (error) {
                console.error('Failed to fetch transaction data:', error);
            }
        }

        // Panggil fungsi saat halaman dimuat
        window.addEventListener('DOMContentLoaded', fetchTransactionData);
    </script>


</body>

</html>
<?php
$db->close();
?>