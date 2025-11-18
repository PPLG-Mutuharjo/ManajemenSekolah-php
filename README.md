🏛️ Persiapan Database (Struktur Tabel siswa)
Sebelum siswa membuat file PHP, mereka perlu tabel siswa. Minta mereka menjalankan query SQL ini di phpMyAdmin (di dalam database db_sekolah yang sudah ada).

CREATE TABLE siswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nis VARCHAR(20) NOT NULL UNIQUE,
    kelas VARCHAR(10) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
