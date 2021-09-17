-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 10:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbiom`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbiom`
--

CREATE TABLE `tbiom` (
  `noiom` char(13) NOT NULL,
  `tgliom` date NOT NULL,
  `kduser` char(10) NOT NULL,
  `ket` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbiom`
--

INSERT INTO `tbiom` (`noiom`, `tgliom`, `kduser`, `ket`) VALUES
('2020/IOM/1', '2020-07-10', 'admin', 'initial iom'),
('2020/IOM/10', '2020-07-30', 'CHF001', '123'),
('2020/IOM/11', '2020-09-12', 'CHF002', 'asd'),
('2020/IOM/12', '2020-09-12', 'CHF001', 'Tes'),
('2020/IOM/2', '2020-07-21', 'CHF001', 'test iiom'),
('2020/IOM/3', '2020-07-21', 'CHF001', 'Lorem ipsum dolor sit amet'),
('2020/IOM/4', '2020-07-21', 'MM001', 'Lorem ipsum dolor sit amet'),
('2020/IOM/5', '2020-07-21', 'MM001', 'Lorem ipsum dolor sit amet'),
('2020/IOM/6', '2020-07-21', 'MM001', 'Lorem ipsum dolor sit amet'),
('2020/IOM/7', '2020-07-30', 'ADMIN', 'TEST'),
('2020/IOM/8', '2020-07-30', 'ADMIN', ''),
('2020/IOM/9', '2020-07-30', 'ADMIN', ''),
('2021/IOM/13', '2021-09-15', 'ADMIN', '');

--
-- Triggers `tbiom`
--
DELIMITER $$
CREATE TRIGGER `nodiom_new` BEFORE INSERT ON `tbiom` FOR EACH ROW SET NEW.noiom = CONCAT(DATE_FORMAT(NOW(), "%Y"),"/IOM/",(select max(cast(substring(noiom,10,length(noiom)) as unsigned)) + 1 as maxiom from tbiom))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbiomdet`
--

CREATE TABLE `tbiomdet` (
  `noiom` char(13) NOT NULL,
  `kditem` char(10) NOT NULL,
  `stsiom` char(1) NOT NULL,
  `tglselesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbiomdet`
--

INSERT INTO `tbiomdet` (`noiom`, `kditem`, `stsiom`, `tglselesai`) VALUES
('2020/IOM/1', 'A001', '3', NULL),
('2020/IOM/2', 'A001', '3', '2021-09-15'),
('2020/IOM/3', 'A002', '3', '2020-07-21'),
('2020/IOM/3', 'D001', '1', NULL),
('2020/IOM/4', 'D001', '3', '2020-07-21'),
('2020/IOM/5', 'D001', '0', NULL),
('2020/IOM/6', 'A001', '1', NULL),
('2020/IOM/6', 'A002', '0', NULL),
('2020/IOM/7', 'A001', '3', '2020-07-30'),
('2020/IOM/7', 'A002', '3', '2020-07-30'),
('2020/IOM/7', 'D001', '3', '2020-07-30'),
('2020/IOM/7', 'H001', '3', '2020-07-30'),
('2020/IOM/10', 'A002', '3', '2020-07-30'),
('2020/IOM/11', 'A001', '2', NULL),
('2020/IOM/11', 'D001', '0', NULL),
('2020/IOM/12', 'A001', '0', NULL),
('2020/IOM/12', 'D001', '0', NULL),
('2021/IOM/13', 'A001', '0', NULL);

--
-- Triggers `tbiomdet`
--
DELIMITER $$
CREATE TRIGGER `trigger_tanggal_selesai` BEFORE UPDATE ON `tbiomdet` FOR EACH ROW BEGIN
    IF NEW.stsiom = 3 THEN
        SET NEW.tglselesai = NOW();
    ELSE
        SET NEW.tglselesai = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbitm`
--

CREATE TABLE `tbitm` (
  `kditem` char(10) NOT NULL,
  `nmitem` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbitm`
--

INSERT INTO `tbitm` (`kditem`, `nmitem`) VALUES
('A001', 'Aplikasi Baru'),
('A002', 'Modifikasi Aplikasi'),
('D001', 'Perubahan Data'),
('H001', 'Perbaikan Hardware');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `kduser` char(10) NOT NULL,
  `nmuser` char(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nmdept` char(50) NOT NULL,
  `stsappr` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`kduser`, `nmuser`, `password`, `nmdept`, `stsappr`) VALUES
('ADMIN', 'admin', '$2y$10$ilfTLYlqZ4l92EnojLtDcuIuc8zQ.a17GG8qBZrGA5jVgdmBkCJv.', 'admin', '2'),
('CHF001', 'Boiardi', '$2y$10$I.M9HKrmmubLdZ42O5g9qe2LOKYjqf0Ju/gdeXI4vM6WWj2ARwgBy', 'IT', '2'),
('CHF002', 'Hammer', '$2y$10$VxH/NL.btdbBJ3TzbAcm6O9oUxnagibsKy2EdxvWRj3c3hKAz3ivu', 'IT', '1'),
('CHF003', 'Hu', '$2y$10$n/8x.R8EKUKJZ4ToYNafIeijogZuEMxWxfSu4OH755b1AK36dTTHW', 'IT', '0'),
('MM001', 'Dave', '$2y$10$D2qt1sLdJdl892IGUbdN6ehNiUI9U1jbO9JpjZ5EmT5LYGwrNBAWq', 'Multimedia', '2'),
('MM002', 'Bob', '$2y$10$dtpwpzbv0vTRQ8DPavUAPuE4IEpLXS95KLvyw.AaBngBxbmK01r36', 'Multimedia', '1'),
('MM003', 'Halsey', '$2y$10$sc.9a24VxhV1u/OzgwTC/uVDSAR0K9ic5vTQc7Zu8y2GYLSKQ82j6', 'Multimedia', '0');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_iomdet`
-- (See below for the actual view)
--
CREATE TABLE `v_iomdet` (
`noiom` char(13)
,`kditem` char(10)
,`nmitem` char(50)
,`stsiom` char(1)
,`tglselesai` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_iomlist`
-- (See below for the actual view)
--
CREATE TABLE `v_iomlist` (
`noiomint` int(8) unsigned
,`noiom` char(13)
,`tgliom` date
,`nmuser` char(50)
,`nmdept` char(50)
,`ket` char(100)
,`stsiom` char(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_maxnoiom`
-- (See below for the actual view)
--
CREATE TABLE `v_maxnoiom` (
`max_noiom` varchar(13)
);

-- --------------------------------------------------------

--
-- Structure for view `v_iomdet`
--
DROP TABLE IF EXISTS `v_iomdet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_iomdet`  AS  select `a`.`noiom` AS `noiom`,`a`.`kditem` AS `kditem`,`b`.`nmitem` AS `nmitem`,`a`.`stsiom` AS `stsiom`,`a`.`tglselesai` AS `tglselesai` from (`tbiomdet` `a` join `tbitm` `b`) where (`a`.`kditem` = `b`.`kditem`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_iomlist`
--
DROP TABLE IF EXISTS `v_iomlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_iomlist`  AS  select cast(concat(substr(`tbiom`.`noiom`,1,4),substr(`tbiom`.`noiom`,10,length(`tbiom`.`noiom`))) as unsigned) AS `noiomint`,`tbiom`.`noiom` AS `noiom`,`tbiom`.`tgliom` AS `tgliom`,`tbuser`.`nmuser` AS `nmuser`,`tbuser`.`nmdept` AS `nmdept`,`tbiom`.`ket` AS `ket`,`tbiomdet`.`stsiom` AS `stsiom` from ((`tbiom` join `tbuser`) join `tbiomdet`) where ((`tbiom`.`kduser` = `tbuser`.`kduser`) and (`tbiom`.`noiom` = `tbiomdet`.`noiom`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_maxnoiom`
--
DROP TABLE IF EXISTS `v_maxnoiom`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_maxnoiom`  AS  select concat(date_format(now(),'%Y'),'/IOM/',(select max(cast(substr(`tbiom`.`noiom`,10,length(`tbiom`.`noiom`)) as unsigned)) AS `maxiom` from `tbiom`)) AS `max_noiom` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbiom`
--
ALTER TABLE `tbiom`
  ADD PRIMARY KEY (`noiom`),
  ADD KEY `kduser` (`kduser`);

--
-- Indexes for table `tbiomdet`
--
ALTER TABLE `tbiomdet`
  ADD KEY `noiom` (`noiom`),
  ADD KEY `kditem` (`kditem`);

--
-- Indexes for table `tbitm`
--
ALTER TABLE `tbitm`
  ADD PRIMARY KEY (`kditem`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`kduser`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbiom`
--
ALTER TABLE `tbiom`
  ADD CONSTRAINT `tbiom_ibfk_1` FOREIGN KEY (`kduser`) REFERENCES `tbuser` (`kduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbiomdet`
--
ALTER TABLE `tbiomdet`
  ADD CONSTRAINT `tbiomdet_ibfk_1` FOREIGN KEY (`noiom`) REFERENCES `tbiom` (`noiom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbiomdet_ibfk_2` FOREIGN KEY (`kditem`) REFERENCES `tbitm` (`kditem`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
