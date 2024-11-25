<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "users_zjiwa";

$db = mysqli_connect($hostname, $username, $password, $database_name); 

if($db->connect_error) {
    echo "koneksi rusak";
    die("error"); 
}

echo "koneksi berhasil";

?>