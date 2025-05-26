CREATE DATABASE IF NOT EXISTS sistem_pakar_sapi;
USE sistem_pakar_sapi;

-- Tabel gejala
CREATE TABLE IF NOT EXISTS gejala (
    kode_gejala VARCHAR(10) PRIMARY KEY,
    nama_gejala TEXT NOT NULL
);

-- Tabel penyakit
CREATE TABLE IF NOT EXISTS penyakit (
    kode_penyakit VARCHAR(10) PRIMARY KEY,
    nama_penyakit VARCHAR(100) NOT NULL,
    solusi TEXT NOT NULL
);

-- Tabel relasi penyakit-gejala
CREATE TABLE IF NOT EXISTS penyakit_gejala (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_penyakit VARCHAR(10) NOT NULL,
    kode_gejala VARCHAR(10) NOT NULL,
    FOREIGN KEY (kode_penyakit) REFERENCES penyakit(kode_penyakit),
    FOREIGN KEY (kode_gejala) REFERENCES gejala(kode_gejala)
);

-- Tabel hasil diagnosa (diperbarui)
CREATE TABLE IF NOT EXISTS hasil_diagnosa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    gejala_terpilih TEXT NOT NULL,
    penyakit_terdeteksi TEXT NOT NULL,
    persentase INT NOT NULL,
    solusi TEXT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT
);

-- Index untuk pencarian
CREATE INDEX idx_hasil_tanggal ON hasil_diagnosa(tanggal);
CREATE INDEX idx_hasil_penyakit ON hasil_diagnosa(penyakit_terdeteksi);