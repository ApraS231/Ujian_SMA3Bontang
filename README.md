# Sistem Manajemen Ujian SMAN 3 Bontang

Aplikasi web berbasis Laravel untuk mengelola penjadwalan, pengawasan, dan pelaksanaan ujian di SMAN 3 Bontang.

## Fitur Utama

- **Manajemen Ujian**: Buat, edit, dan hapus jadwal ujian.
- **Manajemen Ruangan**: Kelola daftar ruangan beserta kapasitasnya.
- **Manajemen Siswa**: Impor data siswa dari file Excel.
- **Penjadwalan Sesi**: Alokasikan siswa ke ruangan dan sesi ujian secara otomatis berdasarkan kelas.
- **Kartu Ujian**: Cetak kartu ujian kolektif untuk semua peserta.
- **Absensi Digital**: Pengawas dapat mencatat kehadiran siswa secara digital.
- **Berita Acara**: Pengawas dapat mencatat kejadian selama ujian berlangsung.

## Prasyarat

Pastikan lingkungan pengembangan Anda memenuhi persyaratan berikut:

- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (MySQL, PostgreSQL, dll.)

## Langkah-langkah Instalasi

1.  **Klon Repositori**
    ```bash
    git clone https://github.com/username/repo-name.git
    cd repo-name
    ```

2.  **Instal Dependensi**
    Instal dependensi PHP dengan Composer dan dependensi JavaScript dengan NPM.
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan konfigurasikan variabel environment, terutama koneksi database.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan atur `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai dengan konfigurasi database Anda.

4.  **Hasilkan Kunci Aplikasi**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi Database**
    Buat tabel-tabel yang diperlukan di database Anda.
    ```bash
    php artisan migrate
    ```

6.  **Buat Akun Pengguna Awal**
    Jalankan seeder untuk membuat akun panitia dan pengawas default.
    ```bash
    php artisan db:seed
    ```
    - **Panitia**: `panitia@example.com` / `password`
    - **Pengawas**: `pengawas@example.com` / `password`

7.  **Kompilasi Aset Frontend**
    ```bash
    npm run dev
    ```

8.  **Jalankan Server Pengembangan**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang akan dapat diakses di `http://localhost:8000`.

## Alur Kerja Aplikasi

1.  **Panitia**:
    - Login sebagai panitia.
    - Impor data siswa melalui menu "Siswa".
    - Tambahkan ruangan ujian melalui menu "Ruangan".
    - Gunakan wizard "Ujian" untuk membuat jadwal ujian baru, memilih ruangan, dan mengalokasikan siswa.
    - Cetak kartu ujian dari menu "Ujian".
2.  **Pengawas**:
    - Login sebagai pengawas.
    - Lihat jadwal mengawas di dashboard.
    - Lakukan absensi digital dan catat berita acara saat ujian berlangsung.
