-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2017 at 01:16 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u729226423_art`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_arsip`
--

CREATE TABLE `data_arsip` (
  `id` int(11) NOT NULL,
  `noarsip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pencipta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_pengolah` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` text COLLATE utf8_unicode_ci NOT NULL,
  `ket` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nobox` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tgl_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `data_arsip`
--

INSERT INTO `data_arsip` (`id`, `noarsip`, `pencipta`, `unit_pengolah`, `tanggal`, `uraian`, `ket`, `kode`, `jumlah`, `nobox`, `lokasi`, `media`, `file`, `tgl_input`, `tgl_update`) VALUES
(1, '103/D1.1/SDM.01/2016', '5', '4', '2016-11-11', 'Melalui rapat dewan direksi, prosedur rekrutmen pegawai mengalami perubahan sesuai dengan perkembangan dan kebutuhan perusahaan.', 'asli', 'SDM.01', 1, 'B01001', '2', '5', 'SURAT_DINAS_Prosedur_Rekrutmen2.pdf', '2017-11-10 02:44:54', '2017-11-10 02:44:54'),
(2, '22/A2/HKP.01.01/2011', '5', '4', '2011-11-01', 'Keputusan Direksi mengenai Kebijakan Tata Kelola Kearsipan dalam lingkungan internal perusahaan. Mulai dari penciptaan, pengolahan hingga retensi', 'asli', 'HKP.01.02', 1, 'B02003', '2', '5', 'KEPUTUSAN_DIREKSI_Keputusan_Direksi_Mengenai_Tata_Kelola_Arsip.pdf', '2017-11-10 02:39:50', '2017-11-10 02:39:50'),
(3, '110/KEU.03/2017', '5', '4', '2017-08-10', 'Surat Perintah Kerja dalam kegiatan pengadaan server oleh vendor PT ABC pada tahun anggaran 2017', 'asli', 'KEU.03', 1, 'B100382828', '2', '5', 'SPK_Pengadaan_Server1.pdf', '2017-11-10 02:44:20', '2017-11-10 02:44:20'),
(4, '08/TR/SDM.03.01/2015', '5', '4', '2015-04-02', 'Surat tugas kepada software engineer senior dari perusahaan untuk mengikuti pelatihan mengenai Machine Learning', 'asli', 'SDM.03.01', 1, 'B9088829', '2', '5', 'SURAT_TUGAS_Pelatihan_Machine_Learning_Syauqi.pdf', '2017-11-10 02:45:49', '2017-11-10 02:45:49'),
(5, '17/A1.3/KEU.01/2016', '5', '4', '2016-12-25', 'Rencana Anggaran pada bidang produksi, meliputi anggaran prototype, desain produk sampai dengan pengadaan ATK', 'asli', 'KEU.01', 1, 'B9020020', '2', '5', 'RABBidang_Produksi_2016.pdf', '2017-11-10 02:45:54', '2017-11-10 02:45:54'),
(6, '101/B1/RND.01/2017', '8', '3', '2017-01-01', 'Laporan penelitian dan pengembangan indexing tools menggunakan Struts 2 Java Framework untuk pengembangan aplikasi kearsipan', 'asli', 'RND.01', 5, 'B9829920', '5', '2', 'LAPORAN_Penelitian_Pengembangan_Indexing_Tools.pdf', '2017-11-10 03:22:21', '0000-00-00 00:00:00'),
(7, '99/A5/HKP.02/2016', '5', '4', '2016-12-10', 'Laporan hasil audit internal pada tahun anggaran 2016', 'asli', 'HKP.02', 2, 'B8292920', '5', '2', 'LAPORAN_Audit_Internal.pdf', '2017-11-10 03:38:28', '0000-00-00 00:00:00'),
(8, '88/E2/SDM.01.01/2017', '3', '2', '2017-07-10', 'Surat pengangkatan pegawai tetap setelah melalui masa percobaan selama 6 bulan', 'asli', 'SDM.01.01', 1, 'B982002', '4', '2', 'SURAT_DINAS_Surat_Pengangkatan_Pegawai.pdf', '2017-11-10 03:53:14', '0000-00-00 00:00:00'),
(9, '192/K1/UMUM.01/2017', '7', '6', '2017-06-13', 'Laporan inventarisasi PT Arteri', 'asli', 'UMUM.02', 50, 'B8292922', '2', '2', 'LAPORAN_Laporan_Inventory.pdf', '2017-11-10 04:11:52', '0000-00-00 00:00:00'),
(11, '29/A1/SDM.05/2017', '3', '2', '2017-04-10', 'Surat pemberhentian pegawai oleh Manajer HRD', 'asli', 'SDM.05', 1, 'B9200202', '5', '2', 'SURAT_DINAS_Surat_Pemberhentian_Kerja1.pdf', '2017-11-10 04:30:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_kode`
--

CREATE TABLE `master_kode` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retensi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_kode`
--

INSERT INTO `master_kode` (`id`, `kode`, `nama`, `retensi`) VALUES
(5, 'SDM.01', 'Rekrutmen Pegawai', 1),
(6, 'SDM.02', 'Mutasi Pegawai', 1),
(7, 'SDM.03', 'Pengembangan Pegawai', 1),
(8, 'SDM.04', 'Cuti Pegawai', 3),
(9, 'SDM.03.01', 'Pelatihan Pegawai', 1),
(10, 'SDM.03.02', 'Beasiswa Pegawai', 1),
(11, 'SDM.01.01', 'Pengangakatan Pegawai', 1),
(12, 'SDM.05', 'Pemberhentian Pegawai', 5),
(13, 'KEU.01', 'Rencana Anggaran', 10),
(14, 'KEU.02', 'Realisasi Anggaran Pegawai', 10),
(15, 'KEU.03', 'Realisasi Anggaran Umum dan Rumah Tangga', 10),
(16, 'HKP.01', 'Peraturan Perusahaan', 5),
(17, 'HKP.01.01', 'Peraturan Direksi Perusahaan', 5),
(18, 'HKP.01.02', 'Keputusan Direksi Perusahaan', 5),
(19, 'HKP.02', 'Pengawasan Internal', 10),
(20, 'RND.01', 'Penelitian dan Pengembangan', 3),
(21, 'UMUM.01', 'Inventarisasi Barang Bergerak', 5),
(22, 'UMUM.02', 'Inventarisasi Barang Tidak Bergerak', 5);

-- --------------------------------------------------------

--
-- Table structure for table `master_lokasi`
--

CREATE TABLE `master_lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_lokasi`
--

INSERT INTO `master_lokasi` (`id`, `nama_lokasi`) VALUES
(2, 'Gedung A, Unit II'),
(4, 'Gedung B, Unit III'),
(5, 'Gedung C, Unit IV');

-- --------------------------------------------------------

--
-- Table structure for table `master_media`
--

CREATE TABLE `master_media` (
  `id` int(11) NOT NULL,
  `nama_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_media`
--

INSERT INTO `master_media` (`id`, `nama_media`) VALUES
(5, 'Audio Cassette'),
(6, 'Audio Disc'),
(4, 'Blueprint'),
(3, 'Kartografi'),
(2, 'Tekstual'),
(7, 'Video Cartridge');

-- --------------------------------------------------------

--
-- Table structure for table `master_pencipta`
--

CREATE TABLE `master_pencipta` (
  `id` int(11) NOT NULL,
  `nama_pencipta` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_pencipta`
--

INSERT INTO `master_pencipta` (`id`, `nama_pencipta`) VALUES
(5, 'Bidang Hukum dan Tata Laksana'),
(3, 'Bidang Kepegawaian'),
(6, 'Bidang Keuangan'),
(4, 'Bidang Pengadaan'),
(8, 'Bidang Produksi'),
(7, 'Bidang Umum dan Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `master_pengolah`
--

CREATE TABLE `master_pengolah` (
  `id` int(11) NOT NULL,
  `nama_pengolah` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_pengolah`
--

INSERT INTO `master_pengolah` (`id`, `nama_pengolah`) VALUES
(4, 'Sekretariat Hukum dan Tata Laksana'),
(2, 'Sekretariat Kepegawaian'),
(5, 'Sekretariat Pengadaan'),
(6, 'Sekretariat Umum dan Rumah Tangga'),
(3, 'Unit Kearsipan');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipe` enum('admin','user') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id`, `username`, `password`, `tipe`) VALUES
<<<<<<< HEAD
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sirkulasi`
--
=======
(1,	'admin',	'$2y$10$jMkQG1dAUFiYU5a3FhJjZOHEEjeYUKQ2KhFIFK3ZOxlJtcrOwcFOC',	'admin'),
(2,	'user',	'$2y$10$mVPu.seT1X8.htSGFHOPEOulKJTDatFG6GeZIi9KdgZoXXZiyacCO',	'user');
>>>>>>> 8e4ad0fc60c770b594f6aabf3ccde53a3b3541bc

CREATE TABLE `sirkulasi` (
  `id` int(11) NOT NULL,
  `noarsip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username_peminjam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8_unicode_ci,
  `tgl_pinjam` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tgl_haruskembali` datetime NOT NULL,
<<<<<<< HEAD
  `tgl_pengembalian` datetime NOT NULL,
  `tgl_transaksi` datetime NOT NULL
=======
  `tgl_pengembalian` datetime DEFAULT NULL,
  `tgl_transaksi` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `noarsip` (`noarsip`),
  KEY `username_peminjam` (`username_peminjam`),
  KEY `tgl_pinjam` (`tgl_pinjam`),
  KEY `tgl_pengembalian` (`tgl_pengembalian`),
  KEY `tgl_haruskembali` (`tgl_haruskembali`)
>>>>>>> 8e4ad0fc60c770b594f6aabf3ccde53a3b3541bc
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username_transaksi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
<<<<<<< HEAD
  `tgl_transaksi` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
=======
  `tgl_transaksi` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kode_transaksi` (`kode_transaksi`),
  KEY `username_transaksi` (`username_transaksi`),
  KEY `tgl_transaksi` (`tgl_transaksi`)
>>>>>>> 8e4ad0fc60c770b594f6aabf3ccde53a3b3541bc
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_arsip`
--
ALTER TABLE `data_arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`noarsip`),
  ADD KEY `pencipta` (`pencipta`),
  ADD KEY `unit_pengolah` (`unit_pengolah`);
ALTER TABLE `data_arsip` ADD FULLTEXT KEY `uraian` (`uraian`);

--
-- Indexes for table `master_kode`
--
ALTER TABLE `master_kode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_lokasi` (`nama_lokasi`);

--
-- Indexes for table `master_media`
--
ALTER TABLE `master_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_media` (`nama_media`);

--
-- Indexes for table `master_pencipta`
--
ALTER TABLE `master_pencipta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pencipta` (`nama_pencipta`);

--
-- Indexes for table `master_pengolah`
--
ALTER TABLE `master_pengolah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pengolah` (`nama_pengolah`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sirkulasi`
--
ALTER TABLE `sirkulasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_arsip`
--
ALTER TABLE `data_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `master_kode`
--
ALTER TABLE `master_kode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_media`
--
ALTER TABLE `master_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_pencipta`
--
ALTER TABLE `master_pencipta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `master_pengolah`
--
ALTER TABLE `master_pengolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sirkulasi`
--
ALTER TABLE `sirkulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_log`
--
ALTER TABLE `system_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

<<<<<<< HEAD
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
=======
-- 2017-11-12 02:28:31
>>>>>>> 8e4ad0fc60c770b594f6aabf3ccde53a3b3541bc
