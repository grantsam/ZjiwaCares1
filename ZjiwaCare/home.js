 // Menampilkan nama pengguna saat halaman dimuat
 window.onload = function() {
    var loggedInUser = localStorage.getItem('loggedInUser');
    var authButton = document.getElementById('auth-button');

    if (loggedInUser) {
        document.getElementById('user-name').textContent = loggedInUser; // Tampilkan nama pengguna
        authButton.textContent = 'Logout'; // Ubah tombol menjadi Logout
        
        // Setup Logout Functionality
        authButton.onclick = function() {
            localStorage.removeItem('loggedInUser'); // Hapus data pengguna dari LocalStorage
            window.location.reload(); // Muat ulang halaman untuk memperbarui tampilan
        };
    } else {
        authButton.textContent = 'Login'; // Jika belum login
        
        // Setup Login Functionality
        authButton.onclick = function() {
            window.location.href = 'login.html'; // Arahkan pengguna ke halaman login
        };
    }

    // Menambahkan efek animasi saat halaman dimuat
    document.getElementById('1000').classList.add('fade-in');
};