-- Create table for Gangguan OLT Berulang Dashboard
-- Run this query in your MySQL database (via phpMyAdmin or MySQL CLI)

CREATE TABLE IF NOT EXISTS `gangguan_olt` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_insiden` VARCHAR(100) DEFAULT NULL,
  `devicename` VARCHAR(255) DEFAULT NULL,
  `nama_petugas` VARCHAR(100) DEFAULT NULL,
  `tanggal_gangguan` DATETIME DEFAULT NULL,
  `penyebab` TEXT,
  `raw_row` LONGTEXT,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_devicename` (`devicename`),
  KEY `idx_tanggal` (`tanggal_gangguan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
