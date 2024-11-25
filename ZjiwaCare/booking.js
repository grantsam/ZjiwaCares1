document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const bookNowBtn = document.getElementById("bookNowBtn"); // Ambil tombol Book Now
  
    // Fungsi untuk menyimpan data ke Local Storage
    function saveToLocalStorage() {
      const nama = document.getElementById("nama").value;
      const tempatTanggalLahir = document.getElementById("tempatTanggalLahir").value;
      const umur = document.getElementById("umur").value;
      const jenisKelamin = document.getElementById("jenisKelamin").value;
      const pendidikan = document.getElementById("pendidikan").value;
      const alamat = document.getElementById("alamat").value;
      const tanggalKonsultasi = document.getElementById("consultation-date").value;
      const waktuKonsultasi = document.querySelector('input[name="consultation-time"]:checked')?.value;
  
      if (!waktuKonsultasi) {
        alert("Harap pilih waktu konsultasi");
        return;
      }
  
      // Simpan data ke Local Storage
      const bookingData = {
        nama,
        tempatTanggalLahir,
        umur,
        jenisKelamin,
        pendidikan,
        alamat,
        tanggalKonsultasi,
        waktuKonsultasi
      };
  
      localStorage.setItem("bookingData", JSON.stringify(bookingData));
      alert("Data berhasil disimpan!");
  
      // Tampilkan data di console setelah disimpan
      console.log("Data disimpan ke Local Storage:", bookingData);
    }
  
    // Event listener untuk tombol Book Now
    bookNowBtn.addEventListener("click", function () {
      saveToLocalStorage(); // Panggil fungsi untuk menyimpan data saat tombol diklik
    });
  
    // Menampilkan data yang tersimpan di Local Storage
    function displaySavedData() {
      const savedData = JSON.parse(localStorage.getItem("bookingData"));
      if (savedData) {
        document.getElementById("nama").value = savedData.nama;
        document.getElementById("tempatTanggalLahir").value = savedData.tempatTanggalLahir;
        document.getElementById("umur").value = savedData.umur;
        document.getElementById("jenisKelamin").value = savedData.jenisKelamin;
        document.getElementById("pendidikan").value = savedData.pendidikan;
        document.getElementById("alamat").value = savedData.alamat;
        document.getElementById("consultation-date").value = savedData.tanggalKonsultasi;
        document.querySelector(`input[name="consultation-time"][value="${savedData.waktuKonsultasi}"]`).checked = true;
  
        // Log data ke console
        console.log("Data yang tersimpan ditampilkan:", savedData);
      }
    }
  
    // Panggil fungsi untuk menampilkan data saat halaman dimuat
    displaySavedData();
  });
  