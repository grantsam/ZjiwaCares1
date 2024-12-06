document.getElementById('payButton').addEventListener('click', function() {
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


// Handle success button click
document.getElementById('successButton').addEventListener('click', function () {
    // Redirect to a new page on success
    window.location.href = 'detail-pembayaran.html'; // Ganti 'success.html' dengan halaman yang diinginkan
});

document.getElementById('failButton').addEventListener('click', function () {
    alert('Pembayaran gagal. Silakan coba lagi.');
    // You can redirect or perform other actions here
});

