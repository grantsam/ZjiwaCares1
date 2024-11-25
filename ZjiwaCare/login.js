/*
// Fungsi untuk memvalidasi login berdasarkan data pendaftaran
function validateForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Ambil data pengguna dari LocalStorage
    var users = JSON.parse(localStorage.getItem('users')) || [];

    // Log array seluruh pengguna yang ada di LocalStorage
    console.log("Data pengguna terdaftar:", users);

    // Cari apakah pengguna sudah terdaftar
    var userFound = users.find(function(user) {
        return user.email === email && user.password === password;
    });

    if (userFound) {
        // Jika pengguna ditemukan, tampilkan pesan sukses
        document.getElementById('loginMessage').style.display = 'block';
        document.getElementById('loginMessage').textContent = 'Login berhasil!';
        
        // Log detail pengguna yang berhasil login
        console.log("Pengguna berhasil login:", userFound);
    } else {
        // Jika tidak, tampilkan pesan gagal
        document.getElementById('loginMessage').style.display = 'block';
        document.getElementById('loginMessage').textContent = 'Email atau password salah.';

        // Log jika pengguna tidak ditemukan
        console.log("Pengguna tidak ditemukan atau password salah. Email yang dicari:", email);
    }

    return false; // Mencegah pengiriman form untuk demonstrasi
}

*/
