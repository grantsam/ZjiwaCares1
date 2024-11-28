<?php
include 'database.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){
    $update_name = mysqli_real_escape_string($db,$_POST['update_name']);    
    $update_username = mysqli_real_escape_string($db,$_POST['update_username']);

    mysqli_query($db,"UPDATE `users` SET name = '$update_name', username = '$update_username' WHERE id = '$user_id' ");

    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : '';
    $update_password = mysqli_real_escape_string($db, hash('sha256', $_POST['update_password']));
    $new_password = mysqli_real_escape_string($db, hash('sha256', $_POST['new_password']));
    $confirm_password = mysqli_real_escape_string($db, hash('sha256', $_POST['confirm_password']));


    if(!empty($update_password) || !empty($new_password) || !empty($confirm_password)){
        if($update_password != $old_password){
            $message[] = 'old password not matched!';
        }
        else if($new_password != $confirm_password){
            $message[] = 'confirm password not matched';
        }
        else{
            mysqli_query($db,"UPDATE `users` SET password = '$confirm_password' WHERE id = '$user_id' ");
            $message[] = 'password updated successfully!';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="update-profile">
    <?php
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        $result = $db->query($sql);

        if($result->num_rows>0) {
            $data = $result->fetch_assoc();
        }
        

    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
            if($data['image'] == ''){
                echo '<img src="1.png">';   
            }
            else{
                echo '<img src = "'.$data['image'].'">';
            }

            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
        ?>
        <div class="flex">
            <div class="inputBox">
                <span>name :</span>
                <input type="text" name="update_name" value="<?php echo $data['name'] ?> " class="box">
                <span>username :</span>
                <input type="text" name="update_username" value="<?php echo $data['username'] ?> " class="box">
                <span>update your pic :</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_password" value="<?php echo $data['password'] ?>">
                <span>old password :</span>
                <input type="password" name="update_password" placeholder="enter previous password" class="box">
                <span>new password :</span>
                <input type="password" name="new_password" placeholder="enter new password" class="box">
                <span>confirm password :</span>
                <input type="password" name="confirm_password" placeholder="confirm new password" class="box">
            </div>  
        </div>
        <input type="submit" value="update profile" name="update_profile" class="btn">
        <a href="dashboard.php" class="delete-btn">go back</a>
    </form>

</div>

</body>
</html>