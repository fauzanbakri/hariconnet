-- SQL to create `tim` table
-- Columns: idTim (int, PK, auto_increment), idBc (varchar(10)), nama (varchar(100)), chatId (varchar(100))
CREATE TABLE IF NOT EXISTS `tim` (
  `idTim` int(10) NOT NULL AUTO_INCREMENT,
  `idBc` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `chatId` varchar(100) NOT NULL,
  PRIMARY KEY (`idTim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
