<?php
include 'database.php';
session_start();
$register_message = "";

if(isset($_SESSION["is_login"])){
    header("location: dashboard.php"); 
} 

if(isset($_POST["register"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $hash_password = hash("sha256",$password);

    try{
        $sql = "INSERT INTO users (username, password, name, contact) VALUES 
        ('$username','$hash_password', '$name', '$contact')";
    
        if($db->query($sql)){
            $register_message = "daftar akun berhasil, silahkan login";
        }
        else{
            $register_message = "daftar akun gagal silahkan coba lagi";
        }
    }
    catch(mysqli_sql_exception){
        $register_message = "username tidak ditemukan";
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewp
    
    rt" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="SignUp.css">
</head>
<body>
        <form action="SignUp.php" method="POST" id="registerForm" onsubmit="return validateForm()">
            <div class="form-group">
            <h1>Sign Up</h1>
            <table style="margin: 0 auto; text-align: left;">
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input name="username" type="text" id="email" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password</label>
                    </td>
                    <td>
                        <input name="password" type="password" id="password" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Nama Lengkap</label>
                    </td>
                    <td>
                        <input name="name" type="text" id="name" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone">No. Telepon</label>
                    </td>
                    <td>
                        <input name="contact" type="tel" id="phone" required>
                    </td>
                </tr>
            </table>
            <div class="checkbox-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">Saya setuju dengan<a href="https://servicedesk.layanan.go.id/privasi" target="_blank"> syarat dan ketentuan.</a></label>
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
                <div class="message" id="message">Pendaftaran berhasil!</div>
                <button name="register" type="submit" class="button">Daftar</button>
                <h3><?= $register_message ?></h3>
            </form>
        </div>
</body>
</html>