# 📝 Aplikasi Kuis Online

Aplikasi Kuis Online berbasis web yang dirancang untuk memudahkan pelaksanaan ujian, kuis, atau evaluasi secara digital. Proyek ini dibangun menggunakan arsitektur MVC (Model-View-Controller) kustom dengan PHP native agar performanya ringan dan terstruktur dengan baik.

## 🚀 Fitur Utama

* **Sistem Autentikasi**: Login dan register untuk Siswa/Peserta dan Admin.
* **Manajemen Kuis**: Admin dapat membuat, mengubah, dan menghapus soal kuis.
* **Multi-Pilihan**: Mendukung soal pilihan ganda dengan kunci jawaban otomatis.
* **Skor Real-Time**: Hasil evaluasi dan nilai langsung muncul setelah kuis selesai.
* **Desain Responsif**: Tampilan antarmuka yang nyaman diakses melalui HP maupun laptop.

## 🛠️ Teknologi yang Digunakan

* **Backend**: PHP 8.x (Custom MVC Architecture)
* **Dependency Manager**: Composer
* **Frontend**: HTML5, CSS3, JavaScript
* **Server Configuration**: Apache (`.htaccess` URL Routing)

## 📁 Struktur Direktori

```text
├── app/              # Semua logika ada disini
├── core/             # Logika inti aplikasi (Database, Controller Utama, Routing)
├── public/           # File statis yang bisa diakses publik (CSS, JS, Gambar)
├── vendor/           # Library pihak ketiga (di-generate oleh Composer)
├── views/            # File tampilan/antarmuka (HTML/PHP template)
├── .htaccess         # Konfigurasi routing URL agar lebih rapi/clean URL
├── composer.json     # Konfigurasi dependensi project
├── index.php         # Entry point utama aplikasi
└── web.php           # Pengaturan rute (Routes) aplikasi
```

## ⚙️ Cara Instalasi & Menjalankan Proyek

### 1. Prasyarat
Pastikan Anda sudah menginstal:
* PHP (versi 8.0 ke atas direkomendasikan)
* MySQL / MariaDB
* Apache Web Server (XAMPP/Laragon)
* Composer

### 2. Langkah-Langkah

1. **Clone atau Download Repositori**
   ```bash
   git clone https://github.com
   cd nama-repo
   ```

2. **Instal Dependensi via Composer**
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   * Buat database baru di phpMyAdmin bernama `valquis`.
   * Import file yang bernama `valquis-with-database.sql` (jika ada) ke dalam database tersebut.
   * Sesuaikan kredensial database Anda di dalam folder `core/` (misal pada file konfigurasi database).

4. **Jalankan Aplikasi**
   * Pindahkan folder proyek ke dalam direktori `htdocs` (jika menggunakan XAMPP) atau `www` (jika menggunakan Laragon).
   * Buka browser dan akses URL: `http://localhost/nama-folder-proyek`

---
Dibuat dengan ❤️ untuk kemudahan edukasi digital.
