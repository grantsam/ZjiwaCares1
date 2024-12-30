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

    $update_contact = mysqli_real_escape_string($db,$_POST['update_contact']);
    $update_data_kelahiran = mysqli_real_escape_string($db,$_POST['update_data_kelahiran']);
    $update_umur = mysqli_real_escape_string($db,$_POST['update_umur']);
    $update_jenis_kelamin = mysqli_real_escape_string($db,$_POST['update_jenis_kelamin']);
    $update_pendidikan_karir = mysqli_real_escape_string($db,$_POST['update_pendidikan_karir']);
    $update_alamat = mysqli_real_escape_string($db,$_POST['update_alamat']);

    mysqli_query($db,"UPDATE `users` SET contact = '$update_contact', data_kelahiran = '$update_data_kelahiran', umur = '$update_umur', jenis_kelamin = '$update_jenis_kelamin', pendidikan_karir = '$update_pendidikan_karir', alamat= '$update_alamat' WHERE id = '$user_id' ");

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="update_dashboard.css">
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
        <div class="update_dashboard-container">
            <form action="update_dashboard.php">
                <div class="form-group">
                    <table style="margin: 0 auto; text-align: left;" >
                        <tr>
                            <td>
                                <span>name :</span>
                            </td>
                            <td>
                                <input type="text" name="update_name" value="<?php echo $data['name'] ?> " class="box">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>username :</span>
                            </td>
                            <td>
                                <input type="text" name="update_username" value="<?php echo $data['username'] ?> " class="box">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>update your pic :</span>
                            </td>
                            <td>
                                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="old_password" value="<?php echo $data['password'] ?>">
                                <span>old password :</span>
                            </td>
                            <td>
                                <input type="password" name="update_password" placeholder="enter previous password" class="box">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>new password :</span>
                            </td>
                            <td>
                                <input type="password" name="new_password" placeholder="enter new password" class="box">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>confirm password :</span>
                            </td>
                            <td>
                                <input type="password" name="confirm_password" placeholder="confirm new password" class="box">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>contact :</span>
                            </td>
                            <td>
                                <input type="text" name="update_contact" value="<?php echo $data['contact'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>tempat, tanggal lahir :</span>
                            </td>
                            <td>
                                <input type="text" name="update_data_kelahiran" value="<?php echo $data['data_kelahiran'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>umur :</span>
                            </td>
                            <td>
                                <input type="text" name="update_umur" value="<?php echo $data['umur'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>jenis kelamin :</span>
                            </td>
                            <td>
                                <input type="text" name="update_jenis_kelamin" value="<?php echo $data['jenis_kelamin'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>pendidikan / karir :</span>
                            </td>
                            <td>
                                <input type="text" name="update_pendidikan_karir" value="<?php echo $data['pendidikan_karir'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>alamat :</span>
                            </td>
                            <td>
                                <input type="text" name="update_alamat" value="<?php echo $data['alamat'] ?>">
                            </td>
                        </tr>
                        <!--TABEL UNDERLINE!-->
                        <tr>
                            <td>
                                <input type="submit" value="update profile" name="update_profile" class="btn" style="background-color: #00695C; color: white;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="dashboard.php" class="delete-btn" style="background-color: #00695C; color: white;">go back</a>
                            </td>
                        </tr>
                    </table>
                </div>  
            </form>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
