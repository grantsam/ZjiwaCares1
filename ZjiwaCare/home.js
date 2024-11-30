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



// Fungsi untuk menampilkan deskripsi berdasarkan gejala yang dipilih
function showGejala(type) {
    const description = document.getElementById('gejala-description');
    
    if (type === 'depresi') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Depresi adalah gangguan kesehatan mental yang umum dan serius yang ditandai dengan suasana hati yang rendah, 
            kehilangan minat atau kesenangan, dan berbagai gejala fisik dan mental lainnya. Meskipun kesedihan adalah emosi 
            yang normal, depresi berbeda karena intensitas dan durasinya yang lebih besar, serta dampaknya yang signifikan 
            pada kehidupan sehari-hari.</p>`;
    } else if (type === 'stres') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Stres adalah reaksi alami tubuh terhadap situasi yang penuh tekanan. Ini adalah alarm internal yang memperingatkan 
            kita bahwa ada sesuatu yang perlu dihadapi. Dalam kadar yang wajar, stres bisa memotivasi kita untuk bertindak dan 
            mencapai tujuan. Namun, jika dibiarkan berlarut-larut dan tidak dikelola dengan baik, stres bisa menjadi musuh 
            terselubung kesehatan mental kita.</p>`;
    } else if (type === 'kecemasan') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Gangguan kecemasan adalah perasaan khawatir atau takut yang intens dan menetap. Meskipun rasa cemas sesekali adalah 
            normal, terutama dalam situasi yang penuh tekanan, kecemasan yang berlebihan dan berkepanjangan dapat mengganggu 
            kehidupan sehari-hari.</p>`;
    } else if (type === 'mood') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Gangguan mood adalah kelompok gangguan kesehatan mental yang ditandai dengan perubahan suasana hati yang ekstrem dan 
            berlangsung lama. Gangguan ini berbeda dengan fluktuasi emosi normal yang dialami semua orang, karena intensitas, durasi, 
            dan dampaknya yang lebih signifikan terhadap kehidupan sehari-hari.</p>`;
    } else if (type === 'trauma') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Trauma adalah reaksi emosional yang intens dan berkepanjangan terhadap peristiwa yang sangat menegangkan atau menakutkan. 
            Peristiwa tersebut bisa berupa kekerasan fisik atau seksual, kecelakaan, bencana alam, perang, atau penganiayaan.</p>`;
    } else if (type === 'kecanduan') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Kecanduan atau adiksi adalah kondisi saat seseorang tidak dapat berhenti mengkonsumsi suatu zat atau melakukan sebuah 
            kegiatan. Orang dengan kecanduan akan kehilangan kontrol terhadap perilakunya meskipun hal itu bisa merusak kehidupan 
            rumah tangga, pekerjaan, atau hubungan pertemanannya. Segera dapatkan bantuan profesional untuk mengatasi kecanduan serta 
            mendapatkan cara yang tepat untuk mengatasinya.</p>`;
    } else if (type === 'hubungan') {
        description.innerHTML = `<p style="font-size: 13px; color: #333; text-align: justify; margin: 20px 0;">
            Terapi keluarga dan hubungan adalah bentuk terapi bicara yang bertujuan membantu individu dalam mengatasi berbagai masalah 
            hubungan. Terapis berlatih membantu para peserta untuk memahami pola komunikasi dan interaksi antar sesama, mengidentifikasi 
            sumber konflik, dan mengembangkan keterampilan komunikasi dan manajemen konflik yang lebih efektif.</p>`;
    }
}
