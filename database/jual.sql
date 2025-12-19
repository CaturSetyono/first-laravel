-- ============================================
-- TABEL JUAL (Header Transaksi Penjualan)
-- Menyimpan header/master transaksi penjualan
-- ============================================

-- CATATAN: Pastikan tabel 'pelanggan' dan 'users' sudah ada sebelum menjalankan script ini

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

-- Index untuk performa
CREATE INDEX idx_jual_tanggal ON jual(tanggal);
CREATE INDEX idx_jual_pelanggan ON jual(pelanggan_id);
