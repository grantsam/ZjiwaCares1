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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h1>dashboard</h1>
    <h3>Selamat datang <?= $_SESSION["username"] ?></h3>
    <form action="dashboard.php" method="POST">
        <button type= "submit" name= "logout">Log out</button>
    </form>

    <div class="profile">
    <?php
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $result = $db->query($sql);

        if($result->num_rows>0) {
            $data = $result->fetch_assoc();
            // Perbarui session dengan data terbaru 
            $_SESSION["name"] = $data["name"];
            $_SESSION["username"] = $data["username"];
            $_SESSION["contact"] = $data["contact"];
            $_SESSION["data_kelahiran"] = $data["data_kelahiran"];
            $_SESSION["umur"] = $data["umur"];
            $_SESSION["jenis_kelamin"] = $data["jenis_kelamin"];
            $_SESSION["pendidikan_karir"] = $data["pendidikan_karir"];
            $_SESSION["alamat"] = $data["alamat"];
        } else {
            echo "No user found.";
        }
        if($data['image'] == ''){
            echo '<img src="1.png">';   
        }
        else{
            echo '<img src = "'.$data['image'].'">';
        }

    ?>
    <h3> username :<?= $_SESSION['username'] ?> </h3>
    <h3> name :<?= $_SESSION['name'] ?> </h3>
    <h3> contact :<?= $_SESSION['contact'] ?> </h3>
    <h3> tempat, tanggal lahir :<?= $_SESSION["data_kelahiran"] ?> </h3>
    <h3> umur :<?= $_SESSION['umur'] ?> </h3>
    <h3> jenis kelamin :<?= $_SESSION['jenis_kelamin'] ?> </h3>
    <h3> pendidikan / karir :<?= $_SESSION['pendidikan_karir'] ?> </h3>
    <h3> alamat :<?= $_SESSION['alamat'] ?> </h3>

    <a href="update_dashboard.php" class="btn">Update Profile</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>