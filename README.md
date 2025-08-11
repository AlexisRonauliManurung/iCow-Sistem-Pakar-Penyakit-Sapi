Tentu, berikut adalah draf README.md yang dibuat berdasarkan analisis file-file yang Anda berikan untuk proyek "iCow - Sistem Pakar Penyakit Sapi".

-----

# iCow - Sistem Pakar Diagnosis Penyakit Sapi

iCow adalah sistem pakar berbasis web yang dirancang untuk membantu peternak atau pengguna umum dalam mendiagnosis kemungkinan penyakit pada sapi berdasarkan gejala-gejala yang diamati. Sistem ini akan memberikan daftar kemungkinan penyakit beserta persentase kecocokan dan solusi penanganan awal.

## Fitur Utama

  - **Diagnosis Interaktif**: Pengguna akan dipandu melalui serangkaian pertanyaan "ya/tidak" mengenai gejala yang dialami sapi.
  - **Hasil Diagnosis Berbasis Persentase**: Sistem menggunakan metode perhitungan untuk mencocokkan gejala yang dipilih dengan basis pengetahuan penyakit dan menampilkannya dalam bentuk persentase.
  - **Informasi Penyakit Lengkap**: Hasil diagnosis utama akan menampilkan:
      - Nama penyakit yang terdeteksi.
      - Penjelasan (deskripsi) mengenai penyakit tersebut.
      - Gambar yang relevan dengan penyakit (jika tersedia).
      - Persentase kecocokan gejala.
      - Solusi penanganan awal.
      - Video referensi dari YouTube untuk pemahaman lebih lanjut.
  - **Daftar Penyakit Lain**: Selain penyakit utama, sistem juga menampilkan daftar penyakit lain yang mungkin cocok dengan gejala yang ada.
  - **Riwayat Diagnosis**: Setiap hasil diagnosis akan disimpan ke dalam database untuk keperluan pencatatan.

## Tampilan Aplikasi

\<table\>
\<tr\>
\<td\>\<img src="[httpsis.com/api/screenshots/capture?url=https%3A%2F%2Fgithub.com%2FAlexisRonauliManurung%2FiCow-Sistem-Pakar-Penyakit-Sapi\&width=800](https://www.google.com/search?q=https://httpsis.com/api/screenshots/capture%3Furl%3Dhttps%253A%252F%252Fgithub.com%252FAlexisRonauliManurung%252FiCow-Sistem-Pakar-Penyakit-Sapi%26width%3D800)" alt="Halaman Utama"\>\</td\>
\<td\>\<img src="[httpsis.com/api/screenshots/capture?url=https%3A%2F%2Fgithub.com%2FAlexisRonauliManurung%2FiCow-Sistem-Pakar-Penyakit-Sapi%2Fblob%2Fmain%2Fdiagnosa.php\&width=800](https://www.google.com/search?q=https://httpsis.com/api/screenshots/capture%3Furl%3Dhttps%253A%252F%252Fgithub.com%252FAlexisRonauliManurung%252FiCow-Sistem-Pakar-Penyakit-Sapi%252Fblob%252Fmain%252Fdiagnosa.php%26width%3D800)" alt="Proses Diagnosa"\>\</td\>
\</tr\>
\<tr\>
\<td align="center"\>\<i\>Halaman Utama\</i\>\</td\>
\<td align="center"\>\<i\>Proses Diagnosa\</i\>\</td\>
\</tr\>
\</table\>

## Alur Kerja Sistem

1.  **Mulai Diagnosa**: Pengguna memulai sesi diagnosa dari halaman utama atau halaman diagnosa.
2.  **Proses Tanya Jawab**: Sistem akan menampilkan satu per satu pertanyaan gejala. Pengguna menjawab "Ya" jika sapi mengalami gejala tersebut atau "Tidak" jika tidak.
3.  **Pengumpulan Gejala**: Setiap jawaban "Ya" akan disimpan sebagai gejala yang terpilih.
4.  **Kalkulasi Hasil**: Setelah semua pertanyaan selesai (atau jika sistem sudah cukup yakin), sistem akan membandingkan kumpulan gejala yang terpilih dengan aturan (rule) penyakit yang ada di basis pengetahuan (`data_penyakit.php`). Persentase kecocokan dihitung berdasarkan jumlah gejala yang cocok dibagi dengan total gejala untuk suatu penyakit.
5.  **Tampilan Hasil**:
      * Penyakit dengan persentase tertinggi akan ditampilkan sebagai diagnosis utama.
      * Informasi detail seperti deskripsi, solusi, gambar, dan video akan ditampilkan.
      * Penyakit lain yang juga memiliki kecocokan akan ditampilkan di bawahnya.
6.  **Penyimpanan Hasil**: Hasil diagnosis utama (penyakit, persentase, dan gejala terpilih) disimpan ke dalam tabel `hasil_diagnosa` di database.

## Teknologi yang Digunakan

  * **Backend**: PHP
  * **Frontend**: HTML, CSS, JavaScript
  * **Framework/Library**: Bootstrap 5
  * **Database**: MySQL/MariaDB

## Struktur Database

Sistem ini menggunakan database bernama `sistem_pakar_sapi` dengan tabel-tabel berikut:

1.  **`gejala`**: Menyimpan data master gejala.

      * `kode_gejala` (VARCHAR, PK)
      * `nama_gejala` (TEXT)

2.  **`penyakit`**: Menyimpan data master penyakit.

      * `kode_penyakit` (VARCHAR, PK)
      * `nama_penyakit` (VARCHAR)
      * `solusi` (TEXT)

3.  **`penyakit_gejala`**: Tabel relasi yang menghubungkan penyakit dengan gejalanya.

      * `id` (INT, PK)
      * `kode_penyakit` (FK)
      * `kode_gejala` (FK)

4.  **`hasil_diagnosa`**: Menyimpan riwayat setiap sesi diagnosis.

      * `id` (INT, PK)
      * `tanggal` (DATETIME)
      * `gejala_terpilih` (TEXT)
      * `penyakit_terdeteksi` (TEXT)
      * `persentase` (INT)
      * `solusi` (TEXT) - *Catatan: Berdasarkan file `sistem_pakar_sapi.sql`, kolom ini ada, meskipun pada `diagnosa.php` tidak terlihat ada proses `INSERT` ke kolom ini.*
      * `ip_address` (VARCHAR)
      * `user_agent` (TEXT)

## Cara Instalasi dan Penggunaan

1.  **Clone Repositori**:

    ```bash
    git clone https://github.com/AlexisRonauliManurung/iCow-Sistem-Pakar-Penyakit-Sapi.git
    ```

2.  **Setup Database**:

      * Buat sebuah database baru di server MySQL/MariaDB Anda dengan nama `sistem_pakar_sapi`.
      * Impor file `sistem_pakar_sapi.sql` ke dalam database yang baru Anda buat.

3.  **Konfigurasi Koneksi**:

      * Buka file `koneksi.php`.
      * Sesuaikan variabel `$host`, `$username`, `$password`, dan `$database` dengan konfigurasi server database Anda.

    <!-- end list -->

    ```php
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "sistem_pakar_sapi";
    ?>
    ```

4.  **Jalankan Aplikasi**:

      * Letakkan semua file proyek di dalam direktori root server web Anda (misalnya `htdocs` untuk XAMPP atau `www` untuk WAMP).
      * Buka browser dan akses alamat `http://localhost/[nama-folder-proyek]/`.

## Tim Pengembang

Proyek iCow ini dikembangkan sebagai bagian dari tugas Ujian Tengah Semester mata kuliah Sistem Pakar oleh mahasiswa Teknik Informatika Universitas Lampung:

  * **Alexis Ronauli Manurung** (2215061109)
  * **Mohammad Malvin Rafi** (2215061074)
  * **Aisyah Rahma Hasan** (2215061086)
