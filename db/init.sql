-- DROP TABLE IF EXISTS `SPECTACOLE`;

CREATE TABLE `SPECTACOLE` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `NUME` varchar(50) NOT NULL,
  `DESCRIERE` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `NR_BILETE_DISPONIBILE` int NOT NULL,
  `PRET_BILET` int NOT NULL,
  `DATA_SPECTACOL` timestamp NOT NULL,
  `LOCATIE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- DROP TABLE IF EXISTS `bilete`;
CREATE TABLE `bilete` (
  `nume` varchar(100) NOT NULL,
  `nr_bilete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- DROP TABLE IF EXISTS `utilizatori`;
CREATE TABLE `utilizatori` (
  `nume` varchar(30) NOT NULL,
  `parola` varchar(30) NOT NULL,
  `nr_bilete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `SPECTACOLE` (`ID`, `NUME`, `DESCRIERE`, `NR_BILETE_DISPONIBILE`, `PRET_BILET`, `DATA_SPECTACOL`, `LOCATIE`) VALUES
(1, 'Livada de visini', 'Livada de visini, simbol al unei lumi in schimbare, ieri, ca si azi, este o piesa despre o epoca aflata la crepuscul, careia o alta ii va lua locul.', 288,  50, '2020-05-27 19:30:00',  'TNB Teatrul National Bucuresti'),
(2, 'Cursa de soarece', 'Cursa de soareci este un irezistibil thriller clasic care imbina umorul negru, suspansul, situatiile-limita, emotia si jocurile intortocheate ale mintii', 398,  60, '2020-07-27 19:30:00',  'TNB Teatrul National Bucuresti'),
(3, 'Micul infern', 'O comedie despre iadul conjugal, asa cum numim, cei mai multi dintre noi, institutia matrimoniala, un spectacol care propune publicului contemporan - pentru care o casnicie de peste patru decenii poate parea curata utopie -un elogiu al vietii de familie.\'', 300,  50, '2020-05-27 19:30:00',  'TNB Teatrul National Bucuresti'),
(4, 'Livada de visini', 'Livada de visini, simbol al unei lumi in schimbare, ieri, ca si azi, este o piesa despre o epoca aflata la crepuscul, careia o alta ii va lua locul.', 200,  50, '2020-05-28 19:30:00',  'TNB Teatrul National Bucuresti'),
(5, 'Livada de visini', 'Livada de visini, simbol al unei lumi in schimbare, ieri, ca si azi, este o piesa despre o epoca afl…',  100,  45, '2020-05-28 17:30:00',  'TNB Teatrul National Bucuresti'),
(6, 'Micul infern', 'O comedie despre iadul conjugal, asa cum numim, cei mai multi dintre noi, institutia matrimoniala, un spectacol care propune publicului contemporan - pentru care o casnicie de peste patru decenii poate parea curata utopie -un elogiu al vietii de familie.', 250,  57, '2020-05-28 19:30:00',  'TNB Teatrul National Bucuresti'),
(7, 'Livada de visini', 'Livada de visini, simbol al unei lumi in schimbare, ieri, ca si azi, este o piesa despre o epoca afl…',  200,  45, '2020-05-27 19:30:00',  'TNB Teatrul National Bucuresti'),
(8, 'Cursa de soarece', 'Cursa de soareci este un irezistibil thriller clasic care imbina umorul negru, suspansul, situatiile-limita, emotia si jocurile intortocheate ale mintii', 400,  60, '2020-06-28 19:00:00',  'TNB Teatrul National Bucuresti'),
(9, 'Micul infern', 'bla',  288,  50, '2020-05-27 19:30:00',  'TNB Teatrul National Bucuresti'),
(10,  'Micul infern', 'test', 198,  45, '2020-05-27 19:30:00',  'Teatrul Metropolis'),
(11,  'O noapte furtunoasa',  'noapte', 250,  50, '2020-06-19 19:00:00',  'Teatrul Metropolis');


INSERT INTO `utilizatori` (`nume`, `parola`, `nr_bilete`) VALUES
('admin',	'idp2020',	0),
('andreea',	'parolaa',	0),
('david',	'pass',	0),
('user',	'parola',	0),
('valentina',	'parola',	0);


INSERT INTO `bilete` (`nume`, `nr_bilete`) VALUES
('Cursa de soarece',	0),
('Livada de visini',	0),
('Micul infern',	0);