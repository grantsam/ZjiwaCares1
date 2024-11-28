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
        }
        if($data['image'] == ''){
            echo '<img src="1.png">';   
        }
        else{
            echo '<img src = "'.$data['image'].'">';
        }

    ?>
    <h3> <?= $_SESSION['user_id'] ?> </h3>
    <a href="update_dashboard.php" class="btn">update profile</a>
    </div>

</body>
</html>