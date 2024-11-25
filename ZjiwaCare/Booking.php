<?php
$koneksi = mysqli_connect("localhost", "root", "", "users_zjiwa");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $umur = $_POST['umur'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $pendidikan = $_POST['pendidikan'];
    $alamat = $_POST['alamat'];
    $tanggalKonsultasi = $_POST['tanggalKonsultasi'];
    $waktuKonsultasi = $_POST['waktuKonsultasi'];

    // Query
    $query = "INSERT INTO booking (nama, tanggalLahir, umur, jenisKelamin, pendidikan, alamat, tanggalKonsultasi, waktuKonsultasi)
              VALUES ('$nama', '$tanggalLahir', $umur, '$jenisKelamin', '$pendidikan', '$alamat', '$tanggalKonsultasi', '$waktuKonsultasi')";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
