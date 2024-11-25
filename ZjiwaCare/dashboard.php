<?php

session_start();
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
</head>
<body>
    <h1>dashboard</h1>
    <h3>Selamat datang <?= $_SESSION["username"] ?></h3>
    <form action="dashboard.php" method="POST">
        <button type= "submit" name= "logout">Log out</button>
    </form>

</body>
</html>