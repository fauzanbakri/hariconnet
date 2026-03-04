-- SQL to create `basecamp` table
-- Based on provided structure screenshot
CREATE TABLE IF NOT EXISTS `basecamp` (
  `idBc` int(11) NOT NULL AUTO_INCREMENT,
  `kp` varchar(20) NOT NULL,
  `mitra` text NOT NULL,
  `lat` varchar(30) NOT NULL,
  `longi` varchar(30) NOT NULL,
  `sloc` varchar(5) NOT NULL,
  `namaAkun` text NOT NULL,
  `kendaraan` varchar(5) NOT NULL,
  PRIMARY KEY (`idBc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
