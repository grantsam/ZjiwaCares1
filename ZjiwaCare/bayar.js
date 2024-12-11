
document.getElementById('payButton').addEventListener('click', function () {
    // Ambil elemen form
    const form = document.getElementById('paymentForm');
    // Cek apakah form valid
    if (form.checkValidity()) {
        // Tampilkan informasi VA
        document.getElementById('vaPaymentInfo').style.display = 'block';
    } else {
        // Jika tidak valid, tampilkan pesan kesalahan
        alert('Silakan lengkapi semua field yang diperlukan.');
    }
});

// GET DATA
document.getElementById('successButton').addEventListener('click', function (event) {
    event.preventDefault(); // Mencegah form dari pengiriman default

    // Ambil nilai metode pembayaran yang dipilih
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
    const selectedMethod = paymentMethod ? paymentMethod.value : 'Tidak ada metode yang dipilih';

    // Simpan pilihan ke sessionStorage
    sessionStorage.setItem('selectedPaymentMethod', selectedMethod);

    // Arahkan ke halaman detail-pembayaran
    window.location.href = 'detail-pembayaran.php';
});

document.getElementById('failButton').addEventListener('click', function () {
    alert('Pembayaran gagal. Silakan coba lagi.');
    // You can redirect or perform other actions here
});

//Transaction ID generator
document.addEventListener('DOMContentLoaded', function () {
    const transactionId = 'TXN-' + uuid.v4(); // Menghasilkan UUID
    // Simpan pilihan ke sessionStorage
    sessionStorage.setItem('transactionId', transactionId);

});
