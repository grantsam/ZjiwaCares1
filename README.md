# ZjiwaCare Project

Proyek ini adalah implementasi website untuk ZjiwaCare yang dikembangkan menggunakan **HTML**, **CSS**, **JavaScript**, dan **PHP**. Proyek ini juga menggunakan database MySQL untuk menyimpan data.

---

## Prasyarat

Pastikan Anda memiliki perangkat berikut:
- **XAMPP** atau server lokal lain yang mendukung PHP, Apache, dan MySQL.
- Browser web untuk mengakses aplikasi.

---

## Struktur Proyek

```plaintext
ZjiwaCares1/
├── .vs
├──ZjiwaCare
    ├── 1.png
    ├── 2.png
    ├── appstore.png
    ├── artikel1.png    
    ├── dashboard.php
    ├── layanan.css
    └── ...
├── database/
    └── database.sql
```
## Cara Menjalankan Proyek
Ekstrak atau pindahkan seluruh isi folder proyek ini ke dalam folder htdocs di XAMPP.
Lokasi default untuk folder htdocs:
```URL
C:/xampp/htdocs/
```

Setelah dipindahkan, struktur folder Anda akan terlihat seperti ini:
```URL
C:/xampp/htdocs/ZjiwaCares1/
```

## Menjalankan Proyek di server lokal
1. Buka XAMPP Control Panel.
2. Aktifkan Apache dan MySQL dengan menekan tombol "Start".
3. Buka browser, lalu akses website menggunakan URL:
```URL
http://localhost/ZjiwaCare/home.html
```

## Mengaktifkan Database
1. Buka phpMyAdmin melalui browser dengan Menekan tombol admin pada Mysql di XAMPP.
2. Klik New untuk membuat database baru, beri nama misalnya zjiwacare.
3. Pilih database yang baru dibuat, lalu buka tab Import.
4. Klik Go untuk mengimpor database.

## Memeriksa Koneksi Database
Pastikan file Booking.php dan file PHP lainnya sudah memiliki konfigurasi koneksi database yang benar di database.php , seperti contoh:
```PHP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zjiwacare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
```

## Catatan Tambahan
1. Pastikan semua file berada dalam struktur folder yang benar saat dijalankan.
2. Jika Anda memindahkan proyek ke server lain atau hosting online, perbarui file koneksi database (seperti Booking.php) agar sesuai dengan konfigurasi server.

## Teknologi yang digunakan

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL


