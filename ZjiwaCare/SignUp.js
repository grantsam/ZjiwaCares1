/*
// Fungsi untuk memvalidasi dan menyimpan data input form ke LocalStorage
function validateForm() {
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var termsChecked = document.getElementById('terms').checked;

    // Validasi persetujuan syarat dan ketentuan
    if (!termsChecked) {
        alert("Anda harus menyetujui syarat dan ketentuan.");
        return false;
    }

    // Ambil data pengguna yang sudah ada dari LocalStorage atau buat array baru jika belum ada
    var users = JSON.parse(localStorage.getItem('users')) || [];
    
    // Buat objek pengguna baru
    var newUser = {
        name: name,
        phone: phone,
        email: email,
        password: password
    };
    
    // Tambahkan pengguna baru ke array users
    users.push(newUser);
    
    // Simpan data pengguna ke LocalStorage
    localStorage.setItem('users', JSON.stringify(users));

    // Log pengguna baru yang baru saja ditambahkan
    console.log("Pengguna baru telah didaftarkan:", newUser);
    
    // Log seluruh data pengguna yang tersimpan di LocalStorage
    console.log("Seluruh data pengguna terdaftar:", users);

    // Tampilkan pesan pendaftaran berhasil
    document.getElementById('message').style.display = 'block';
    document.getElementById('message').textContent = 'Pendaftaran berhasil!';
    console.log("Seluruh data pengguna terdaftar:", users);
    return false; // Mencegah pengiriman form untuk demonstrasi
}

*/
