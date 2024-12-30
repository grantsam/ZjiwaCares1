<?php
include 'database.php'; 
session_start();
$user_id = $_SESSION['user_id'];
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: home.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg" >
                    <div class="card-header" style="background-color: #FCF4EC; color: #333;">
                        <h1 class="text-center">Dashboard</h1>
                        <h3 class="text-center">Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?></h3>
                    </div>
                    <div class="card-body">

                        <?php
                        $sql = "SELECT * FROM users WHERE id = '$user_id'";
                        $result = $db->query($sql);

                        if($result->num_rows > 0) {
                            $data = $result->fetch_assoc();
                            // Perbarui session dengan data terbaru
                            $_SESSION = array_merge($_SESSION, $data);
                        } else {
                            echo "<div class='alert alert-danger'>No user found.</div>";
                        }
                        ?>

                        <div class="text-center mb-3">
                            <?php if (empty($data['image'])): ?>
                                <img src="1.png" class="rounded-circle" alt="Default Profile" width="150">
                            <?php else: ?>
                                <img src="<?= htmlspecialchars($data['image']) ?>" class="rounded-circle" alt="Profile Image" width="150">
                            <?php endif; ?>
                        </div>
                        
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%; padding-left: 20px;">Username</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['username']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Name</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['name']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Contact</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['contact']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Tempat, Tanggal Lahir</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['data_kelahiran']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Umur</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['umur']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Jenis Kelamin</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['jenis_kelamin']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Pendidikan / Karir</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['pendidikan_karir']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Alamat</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['alamat']) ?></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 20px;">Role</th>
                                <td style="padding-left: 20px;"><?= htmlspecialchars($_SESSION['role']) ?></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="update_dashboard.php" class="btn" style="background-color: #19807F; color: white;">Update Profile</a>
                            <a href="home.html" class="btn" style="background-color: #19807F; color: white;">Home</a>
                        </div>
                        <form action="dashboard.php" method="POST" class="mt-3">
                            <button type="submit" name="logout" class="btn w-100" style="background-color: #19807F; color: white;">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
