document.getElementById('login-button').addEventListener('click', function() {
    window.location.href = 'login.html'; // Mengarahkan pengguna ke halaman login
});

// Menambahkan efek animasi saat halaman dimuat
window.onload = function() {
    document.getElementById('1000').classList.add('fade-in');
};