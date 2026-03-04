-- SQL to create `tim` table
-- Schema based on provided screenshot
CREATE TABLE IF NOT EXISTS `tim` (
  `idTim` int(10) NOT NULL AUTO_INCREMENT,
  `idBc` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `chatId` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  PRIMARY KEY (`idTim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
