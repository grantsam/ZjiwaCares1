<?php

include 'database.php';
session_start();
$login_message="";
$user_id="";

if(isset($_SESSION["is_login"])){
    header("location: dashboard.php"); 
}

if(isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash('sha256',$password);
    $sql = "SELECT * FROM users where username='$username' 
    AND password = '$hash_password'
    ";
    $result = $db->query($sql);

    if($result->num_rows>0) {
        $data = $result->fetch_assoc();
        echo "username = " . $data["username"];
        echo "password = " . $data["password"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["name"] = $data["name"];
        $_SESSION["contact"] = $data["contact"];
        $_SESSION["is_login"] = true;
        $_SESSION["user_id"] = $data['id'];
        $_SESSION["data_kelahiran"] = $data['data_kelahiran'];
        $_SESSION["umur"] = $data['umur'];
        $_SESSION["jenis_kelamin"] = $data['jenis_kelamin'];
        $_SESSION["pendidikan_karir"] = $data['pendidikan_karir'];
        $_SESSION["alamat"] = $data['alamat'];
        $_SESSION["role"] = $data['role'];

        header("location: login.php");
    }
    else{
        $login_message =  "akun tidak ditemukan";
    }
    $db->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }

        .login-container {
            text-align: center;
            padding: 100px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        
        h2 {
            font-size: 36px;
            color: rgba(204, 94, 57, 1);
            margin-bottom: 40px;
            font-weight: bold;
        }
        
        td {
            padding: 10px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .button {
            background-color: #b5651d;
            color: white;
            padding: 10px 133px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #994c17;
        }


        .signup-text {
            margin-top: 20px;
            color: black;
            font-size: 14px;
        }

        .signup-text a {
            color: #4285f4;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }
        .message {
            margin-top: 20px;
            font-size: 14px;
            color: #28a745;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post" id="registerForm" onsubmit="return validateForm()">
            <div class="form-group">
                <h2>Login</h2>
                <table style="margin: 0 auto; text-align: left;">
                    <tr>  
                        <td>
                            <label for="email">Username</label>
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
                </table>
            <button type="submit" class="button" name="login">Login</button>
        </form>
        <div class="signup-text">
        Belum punya akun? <a href="SignUp.php">Sign Up</a>
        </div>
        <div class="message" id="loginMessage"></div>
        <h3><?= $login_message ?><h3>
    </div>

</body>
</html>
