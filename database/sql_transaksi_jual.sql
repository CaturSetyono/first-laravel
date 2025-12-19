-- ============================================
-- SQL SCRIPT: MODUL TRANSAKSI JUAL
-- Database: proyek_web
-- Tanggal: 2025-11-26
-- ============================================

-- Gunakan database yang sesuai
-- USE proyek_web;

-- ============================================
-- 1. TABEL PELANGGAN
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

-- ============================================
-- 2. TABEL JUAL (Header Transaksi)
-- ============================================

CREATE TABLE IF NOT EXISTS `jual` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` INT(11) DEFAULT NULL,
  `tanggal` DATE DEFAULT NULL,
  `jumlah_pembelian` INT(11) DEFAULT NULL COMMENT 'Total nilai transaksi',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` TINYINT(4) DEFAULT NULL COMMENT 'Kasir yang melayani',
  PRIMARY KEY (`id`),
  KEY `FK_jual_pelanggan` (`pelanggan_id`),
  KEY `FK_jual_user` (`user_id`),
  CONSTRAINT `FK_jual_pelanggan` FOREIGN KEY (`pelanggan_id`) 
    REFERENCES `pelanggan` (`id`) 
    ON UPDATE CASCADE 
    ON DELETE SET NULL,
  CONSTRAINT `FK_jual_user` FOREIGN KEY (`user_id`) 
    REFERENCES `users` (`id`) 
    ON UPDATE CASCADE 
    ON DELETE SET NULL
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='Tabel header transaksi penjualan';

-- ============================================
-- 3. TABEL DETAIL_JUAL (Detail Transaksi)
-- ============================================

CREATE TABLE IF NOT EXISTS `detail_jual` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `jual_id` INT(11) DEFAULT NULL COMMENT 'Relasi ke tabel jual',
  `barang_id` BIGINT(20) DEFAULT NULL COMMENT 'Relasi ke tabel barang',
  `qty` INT(11) DEFAULT NULL COMMENT 'Jumlah barang dibeli',
  `harga_sekarang` INT(11) DEFAULT NULL COMMENT 'Harga saat transaksi',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `user_id` INT(11) DEFAULT 1 COMMENT 'User yang merekam',
  PRIMARY KEY (`id`),
  KEY `FK_detail_jual` (`jual_id`),
  KEY `FK_detail_jual_barang` (`barang_id`),
  CONSTRAINT `FK_detail_jual` FOREIGN KEY (`jual_id`) 
    REFERENCES `jual` (`id`) 
    ON UPDATE CASCADE 
    ON DELETE CASCADE,
  CONSTRAINT `FK_detail_jual_barang` FOREIGN KEY (`barang_id`) 
    REFERENCES `barang` (`id`) 
    ON UPDATE CASCADE 
    ON DELETE RESTRICT
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel detail item transaksi penjualan';

-- ============================================
-- 4. INDEXES UNTUK PERFORMA
-- ============================================

-- Index untuk pencarian berdasarkan tanggal
CREATE INDEX idx_jual_tanggal ON jual(tanggal);

-- Index untuk pencarian berdasarkan pelanggan
CREATE INDEX idx_jual_pelanggan ON jual(pelanggan_id);

-- Index untuk pencarian detail berdasarkan barang
CREATE INDEX idx_detail_barang ON detail_jual(barang_id);

-- ============================================
-- 5. VIEWS (OPSIONAL)
-- ============================================

-- View untuk laporan penjualan lengkap
CREATE OR REPLACE VIEW v_laporan_jual AS
SELECT 
    j.id AS no_transaksi,
    j.tanggal,
    p.nama_pelanggan,
    p.telp_hp,
    u.name AS kasir,
    j.jumlah_pembelian AS total,
    COUNT(dj.id) AS jumlah_item
FROM jual j
LEFT JOIN pelanggan p ON j.pelanggan_id = p.id
LEFT JOIN users u ON j.user_id = u.id
LEFT JOIN detail_jual dj ON j.id = dj.jual_id
GROUP BY j.id, j.tanggal, p.nama_pelanggan, p.telp_hp, u.name, j.jumlah_pembelian
ORDER BY j.tanggal DESC, j.id DESC;

-- View untuk detail penjualan per item
CREATE OR REPLACE VIEW v_detail_penjualan AS
SELECT 
    j.id AS no_transaksi,
    j.tanggal,
    p.nama_pelanggan,
    b.nama_barang,
    dj.qty,
    b.satuan,
    dj.harga_sekarang,
    (dj.qty * dj.harga_sekarang) AS subtotal
FROM detail_jual dj
INNER JOIN jual j ON dj.jual_id = j.id
LEFT JOIN pelanggan p ON j.pelanggan_id = p.id
INNER JOIN barang b ON dj.barang_id = b.id
ORDER BY j.tanggal DESC, j.id DESC;

-- ============================================
-- 6. STORED PROCEDURE (OPSIONAL)
-- ============================================

-- Procedure untuk mendapatkan total penjualan per periode
DELIMITER $$

CREATE PROCEDURE sp_total_penjualan_periode(
    IN p_tanggal_awal DATE,
    IN p_tanggal_akhir DATE
)
BEGIN
    SELECT 
        DATE(tanggal) AS tanggal,
        COUNT(id) AS jumlah_transaksi,
        SUM(jumlah_pembelian) AS total_penjualan
    FROM jual
    WHERE tanggal BETWEEN p_tanggal_awal AND p_tanggal_akhir
    GROUP BY DATE(tanggal)
    ORDER BY tanggal DESC;
END$$

DELIMITER ;

-- ============================================
-- 7. TRIGGER (OPSIONAL)
-- ============================================

-- Trigger untuk update stok barang setelah insert detail_jual
DELIMITER $$

CREATE TRIGGER trg_after_insert_detail_jual
AFTER INSERT ON detail_jual
FOR EACH ROW
BEGIN
    -- Kurangi stok barang
    UPDATE barang 
    SET stok = stok - NEW.qty
    WHERE id = NEW.barang_id;
END$$

DELIMITER ;

-- Trigger untuk restore stok barang setelah delete detail_jual
DELIMITER $$

CREATE TRIGGER trg_after_delete_detail_jual
AFTER DELETE ON detail_jual
FOR EACH ROW
BEGIN
    -- Kembalikan stok barang
    UPDATE barang 
    SET stok = stok + OLD.qty
    WHERE id = OLD.barang_id;
END$$

DELIMITER ;

-- ============================================
-- 8. QUERY TESTING
-- ============================================

-- Test 1: Lihat semua pelanggan
-- SELECT * FROM pelanggan;

-- Test 2: Lihat semua transaksi
-- SELECT * FROM v_laporan_jual;

-- Test 3: Lihat detail transaksi tertentu
-- SELECT * FROM v_detail_penjualan WHERE no_transaksi = 1;

-- Test 4: Total penjualan hari ini
-- SELECT COUNT(*) AS jumlah_transaksi, SUM(jumlah_pembelian) AS total
-- FROM jual 
-- WHERE DATE(tanggal) = CURDATE();

-- Test 5: Top 5 pelanggan berdasarkan total pembelian
-- SELECT 
--     p.nama_pelanggan,
--     COUNT(j.id) AS jumlah_transaksi,
--     SUM(j.jumlah_pembelian) AS total_pembelian
-- FROM jual j
-- INNER JOIN pelanggan p ON j.pelanggan_id = p.id
-- GROUP BY p.id, p.nama_pelanggan
-- ORDER BY total_pembelian DESC
-- LIMIT 5;

-- ============================================
-- SELESAI
-- ============================================

-- Catatan:
-- 1. Pastikan tabel 'users' dan 'barang' sudah ada sebelum menjalankan script ini
-- 2. Sesuaikan nama database dengan proyek Anda
-- 3. Foreign key constraint akan error jika tabel referensi belum ada
-- 4. Trigger untuk update stok bersifat opsional, bisa juga dilakukan di aplikasi
