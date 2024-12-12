document.addEventListener('DOMContentLoaded', function () {
    // Generate transaction ID on page load
    const transactionId = 'TXN-' + uuid.v4();
    sessionStorage.setItem('transactionId', transactionId);
    document.getElementById('transactionIdInput').value = transactionId; // Tampilkan ID transaksi

    // Initialize payment button handler
    const payButton = document.getElementById('payButton');
    const paymentForm = document.getElementById('paymentForm');
    const selectedPaymentMethodInput = document.getElementById('selectedPaymentMethod');

    if (payButton) {
        payButton.addEventListener('click', function (e) {
            e.preventDefault();
            const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked');
            const vaPaymentInfo = document.getElementById('vaPaymentInfo');

            if (selectedPayment) {
                // Store selected payment method in hidden input
                selectedPaymentMethodInput.value = selectedPayment.value;

                // Show VA payment info
                if (vaPaymentInfo) {
                    vaPaymentInfo.style.display = 'block';
                    vaPaymentInfo.scrollIntoView({ behavior: 'smooth' });
                }
            } else {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
            }
        });
    }

    // Initialize success button handler
    const successButton = document.getElementById('successButton');
    if (successButton) {
        successButton.addEventListener('click', function (e) {
            // Don't prevent default - let the form submit
            const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked');
            if (selectedPayment) {
                selectedPaymentMethodInput.value = selectedPayment.value;
                paymentForm.submit();
                window.location.href = "detail-pembayaran.php";
            } else {
                e.preventDefault();
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
            }
        });
    }

    // Initialize fail button handler
    const failButton = document.getElementById('failButton');
    if (failButton) {
        failButton.addEventListener('click', function () {
            alert('Pembayaran gagal. Silakan coba lagi.');
        });
    }
});