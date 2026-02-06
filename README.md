# Sistem Informasi Admin Bimbingan Belajar

Aplikasi web berbasis Laravel untuk membantu pengelolaan
data operasional bimbingan belajar (bimbel), meliputi
data siswa, guru, kelas, absensi, jadwal, dan keuangan.
Project ini dibuat sebagai portofolio pengembangan web.


## Fitur Utama
- Login & logout admin
- Manajemen data siswa
- Manajemen data guru
- Manajemen jadwal siswa dan guru
- Absensi massal siswa
- Pembuatan barcode, pengiriman ke email, dan scan absensi untuk guru
- Penghitungan gaji pengajar berdasarkan jam
- Pencatatan pembayaran/pemasukan dan pengeluaran
- Rekap guru
- Rekap dan laporan transaksi
- Proteksi halaman admin

## Tech Stack
- PHP
- Laravel
- MySQL
- Bootstrap
- HTML & CSS


# Konsep Pengembangan
Aplikasi ini dibangun menggunakan konsep MVC (Model–View–Controller) untuk memisahkan logika program, tampilan, dan pengolahan data.


## Role Pengguna
- Admin


## Keamanan
- Autentikasi menggunakan session
- Password disimpan dalam bentuk hash
- Validasi input pada setiap form


# Cara Menjalankan Project
1. Clone repository ini
2. Import database ke MySQL
3. Copy file `.env.example` menjadi `.env`
4. Atur konfigurasi database pada file `.env`
5. Jalankan perintah berikut:
    php artisan key:generate
    php artisan serve
6. Akses aplikasi melalui browser


## Akun Demo
Email: bimbimbelajar@gmail.com  
Password: menujugenerasiemas


# Catatan
Project ini dibuat sebagai latihan dan portofolio untuk meningkatkan kemampuan backend web development
menggunakan Laravel.


--Naura Okta Vianis--
