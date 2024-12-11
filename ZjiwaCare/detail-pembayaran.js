// Mengambil nilai metode pembayaran dari sessionStorage
const selectedPaymentMethod = sessionStorage.getItem('selectedPaymentMethod');

// Menampilkan nilai di elemen dengan id 'paymentMethodDisplay'
document.getElementById('paymentMethodDisplay').innerText = selectedPaymentMethod ? `${selectedPaymentMethod}` : 'Tidak ada metode pembayaran yang dipilih.';

// Mengambil nilai metode pembayaran dari sessionStorage transactionId
const transactionId = sessionStorage.getItem('transactionId');
document.getElementById('transactionIdDisplay').innerText = transactionId; // Tampilkan ID transaksi
