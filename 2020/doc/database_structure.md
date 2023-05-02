# Struttura del database

### Tabella delle comunicazioni
``` sql
CREATE TABLE `comunicazioni` (
  `Numero` int NOT NULL AUTO_INCREMENT,
  `Titolo` mediumtext NOT NULL,
  `Corpo` mediumtext NOT NULL,
  `Tag` varchar(255) NOT NULL,
  PRIMARY KEY (`Numero`)
) ENGINE=InnoDB AUTO_INCREMENT=781 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```


### Tabella degli eventi (Eventi tipo video covid) --> gestione_contenuti.php
``` sql
CREATE TABLE `eventi` (
  `ID_Evento` int NOT NULL AUTO_INCREMENT,
  `ID_Informazione` int NOT NULL,
  `Orario` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Evento`),
  KEY `ID_Informazione` (`ID_Informazione`),
  CONSTRAINT `eventi_ibfk_1` FOREIGN KEY (`ID_Informazione`) REFERENCES `informazioni_temporizzate` (`ID_Informazione`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Tabella delle informazioni temporizzate (Eventi tipo video covid) --> gestione_contenuti.php
``` sql
CREATE TABLE `informazioni_temporizzate` (
  `ID_Informazione` int NOT NULL AUTO_INCREMENT,
  `URL_File` varchar(255) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Data_inizio` varchar(50) NOT NULL,
  `Data_fine` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Informazione`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### Tabella delle giornate (Argomento culturale del giorno) --> eventi.php
``` sql
CREATE TABLE `giornate` (
  `UID` int NOT NULL AUTO_INCREMENT,
  `Giorno` int NOT NULL,
  `Mese` int NOT NULL,
  `Evento` varchar(200) NOT NULL,
  `Informazioni` varchar(2000) NOT NULL,
  `Immagini` varchar(30) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```