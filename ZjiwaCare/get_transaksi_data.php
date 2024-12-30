<?php
include 'database.php';

// Query untuk menghitung data sesuai kondisi
$query = "SELECT 
    COUNT(*) AS total_transaksi,
    SUM(CASE WHEN LOWER(status) = 'berhasil' THEN 1 ELSE 0 END) AS transaksi_sukses,
    SUM(CASE WHEN LOWER(status) = 'gagal' THEN 1 ELSE 0 END) AS transaksi_gagal,
    SUM(CASE WHEN status IS NULL THEN 1 ELSE 0 END) AS transaksi_pending,
    SUM(CASE WHEN LOWER(status) = 'berhasil' THEN harga ELSE 0 END) AS total_pendapatan
FROM pembayaran";

$result = $db->query($query);
$data = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($data);

$db->close();
?>
