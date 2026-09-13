-- 1. Tabel Admin (untuk login)
CREATE TABLE `admin` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `nama_lengkap` VARCHAR(100) NOT NULL
);

-- 2. Tabel Profil (Halaman Profil Perusahaan)
CREATE TABLE `profil` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `sejarah` TEXT,
  `visi` TEXT,
  `misi` TEXT,
  `nilai_perusahaan` TEXT,
  `alamat` TEXT,
  `telepon` VARCHAR(20),
  `email` VARCHAR(100),
  `maps_embed` TEXT
);

-- 3. Tabel Produk / Layanan
CREATE TABLE `produk` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_produk` VARCHAR(150) NOT NULL,
  `gambar` VARCHAR(255) NOT NULL,
  `deskripsi` TEXT NOT NULL
);

-- 4. Tabel Artikel
CREATE TABLE `artikel` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `judul` VARCHAR(200) NOT NULL,
  `thumbnail` VARCHAR(255) NOT NULL,
  `ringkasan` TEXT NOT NULL,
  `isi_artikel` LONGTEXT NOT NULL,
  `tanggal` DATE NOT NULL
);

-- 5. Tabel Galeri
CREATE TABLE `galeri` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `judul` VARCHAR(150) NOT NULL,
  `foto` VARCHAR(255) NOT NULL
);

-- Data Awal Akun Admin (password : admin123)
INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) 
VALUES ('admin', '$2a$12$UXSsKEsaSUnjw76D/TZQSOc3f7dTkrecIzRVYxad5884UxkGe4byW', 'Administrator');

-- Data Awal Profil Perusahaan
INSERT INTO `profil` (`sejarah`, `visi`, `misi`, `nilai_perusahaan`, `alamat`, `telepon`, `email`, `maps_embed`) 
VALUES (
  'PT Digital Solusi Nusantara didirikan untuk memberikan layanan IT terbaik.',
  'Menjadi perusahaan teknologi terdepan dan terpercaya.',
  'Memberikan solusi IT yang inovatif dan berkualitas tinggi.',
  'Integritas, Inovasi, Professionalism.',
  'Jl. Telekomunikasi No. 1, Bandung',
  '081234567890',
  'info@digitalsolusi.com',
  '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.306822291586!2d107.6293427749969!3d-6.973007093027668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adcf1f7871%3A0x673c68383c24201e!2sSMK%20Negeri%204%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
);