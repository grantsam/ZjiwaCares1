// Mengambil nilai metode pembayaran dari sessionStorage
const selectedPaymentMethod = sessionStorage.getItem('selectedPaymentMethod');

// Mengambil nilai metode pembayaran dari sessionStorage transactionId
const transactionId = sessionStorage.getItem('transactionId');
document.getElementById('transactionIdDisplay').innerText = transactionId; // Tampilkan ID transaksi
