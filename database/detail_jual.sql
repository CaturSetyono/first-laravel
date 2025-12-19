-- ============================================
-- TABEL DETAIL_JUAL (Detail Transaksi Penjualan)
-- Menyimpan detail item barang per transaksi
-- ============================================

-- CATATAN: Pastikan tabel 'jual' dan 'barang' sudah ada sebelum menjalankan script ini

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

-- Index untuk performa
CREATE INDEX idx_detail_barang ON detail_jual(barang_id);
