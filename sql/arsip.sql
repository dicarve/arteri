-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `data_arsip`;
CREATE TABLE `data_arsip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noarsip` varchar(100) NOT NULL,
  `pencipta` varchar(255) NOT NULL,
  `unit_pengolah` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` text NOT NULL,
  `ket` varchar(100) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nobox` varchar(10) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `media` varchar(255) NOT NULL,
  `file` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `master_kode`;
CREATE TABLE `master_kode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `retensi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_kode` (`id`, `kode`, `nama`, `retensi`) VALUES
(1,	'KU.05.04',	'Akumulasi SPM',	5),
(2,	'UM.01.02',	'Perjalanan dinas',	2);

DROP TABLE IF EXISTS `master_lokasi`;
CREATE TABLE `master_lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_lokasi` (`id`, `nama_lokasi`) VALUES
(1,	'lokasi 1');

DROP TABLE IF EXISTS `master_media`;
CREATE TABLE `master_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_media` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_media` (`id`, `nama_media`) VALUES
(1,	'media 1');

DROP TABLE IF EXISTS `master_pencipta`;
CREATE TABLE `master_pencipta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pencipta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_pencipta` (`id`, `nama_pencipta`) VALUES
(1,	'pencipta 1');

DROP TABLE IF EXISTS `master_pengolah`;
CREATE TABLE `master_pengolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengolah` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_pengolah` (`id`, `nama_pengolah`) VALUES
(1,	'pengolah 1');

DROP TABLE IF EXISTS `master_user`;
CREATE TABLE `master_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `tipe` enum('admin','user') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `master_user` (`id`, `username`, `password`, `tipe`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'admin'),
(2,	'user',	'ee11cbb19052e40b07aac0ca060c23ee',	'user');

-- 2017-08-11 15:39:30
