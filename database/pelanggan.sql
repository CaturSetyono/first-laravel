-- ============================================
-- TABEL PELANGGAN
-- Menyimpan data pelanggan
-- ============================================

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` VARCHAR(50) DEFAULT NULL,
  `jenis_kelamin` CHAR(1) DEFAULT NULL COMMENT 'L=Laki-laki, P=Perempuan',
  `alamat` VARCHAR(100) DEFAULT NULL,
  `telp_hp` VARCHAR(25) DEFAULT NULL,
  `email` VARCHAR(50) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel master pelanggan';

-- Data sample pelanggan
INSERT INTO `pelanggan` (`nama_pelanggan`, `jenis_kelamin`, `alamat`, `telp_hp`, `email`, `created_at`, `updated_at`) VALUES
('Budi Santoso', 'L', 'Jl. Merdeka No. 10, Jakarta', '081234567890', 'budi@email.com', NOW(), NOW()),
('Siti Nurhaliza', 'P', 'Jl. Sudirman No. 25, Bandung', '082345678901', 'siti@email.com', NOW(), NOW()),
('Ahmad Wijaya', 'L', 'Jl. Gatot Subroto No. 5, Surabaya', '083456789012', 'ahmad@email.com', NOW(), NOW()),
('Dewi Lestari', 'P', 'Jl. Diponegoro No. 15, Yogyakarta', '084567890123', 'dewi@email.com', NOW(), NOW()),
('Rudi Hartono', 'L', 'Jl. Ahmad Yani No. 30, Semarang', '085678901234', 'rudi@email.com', NOW(), NOW());
