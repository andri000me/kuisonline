-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2015 at 11:37 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kuisonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `jurusan`) VALUES
(1, 'guru fisika', 'IPA'),
(2, 'guru kimia', 'IPA'),
(3, 'guru biologi', 'IPA'),
(4, 'guru geografi', 'IPS'),
(5, 'guru ekonomi', 'IPS'),
(6, 'guru sosiologi', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`) VALUES
(1, 'IPA'),
(2, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE IF NOT EXISTS `pelajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id`, `nama`, `jurusan`) VALUES
(1, 'Fisika', 'IPA'),
(2, 'Kimia', 'IPA'),
(3, 'Biologi', 'IPA'),
(4, 'Geografi', 'IPS'),
(5, 'Ekonomi', 'IPS'),
(6, 'Sosiologi', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `id_person` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `level`, `id_person`) VALUES
(1, 'admin', 'admin', 'admin', '0'),
(2, 'siswa1', 'admin', 'siswa', '1'),
(3, 'siswa2', 'admin', 'siswa', '2'),
(4, 'guru1', 'admin', 'guru', '1'),
(5, 'guru2', 'admin', 'guru', '2');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `jurusan`) VALUES
(1, 'siswa ipa 1', 'IPA'),
(2, 'siswa ipa 2', 'IPA'),
(3, 'siswa ipa 3', 'IPA'),
(4, 'siswa ipa 4', 'IPA'),
(5, 'siswa ips 1', 'IPS'),
(6, 'siswa ips 2', 'IPS'),
(7, 'siswa ips 3', 'IPS'),
(8, 'siswa ips 4', 'IPS'),
(9, 'Siswa ipa 5', 'IPA');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soal` text,
  `opsi_a` text,
  `opsi_b` text,
  `opsi_c` text,
  `opsi_d` text,
  `opsi_e` text,
  `jawaban` char(10) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_pembuat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `id_mapel`, `id_pembuat`) VALUES
(1, 'soal fisika 1', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'A', 1, 1),
(2, 'soal fisika 2', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'B', 1, 1),
(3, 'soal fisika 3', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'C', 1, 1),
(4, 'soal fisika 4', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'D', 1, 1),
(5, 'soal kimia 1', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'A', 2, 2),
(6, 'soal kimia 2', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'B', 2, 2),
(7, 'soal kimia 3', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'C', 2, 2),
(8, 'soal kimia 4', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'D', 2, 2),
(9, 'soal biologi 1', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'A', 3, 3),
(10, 'soal biologi 2', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'B', 3, 3),
(11, 'soal biologi 3', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'C', 3, 3),
(12, 'soal biologi 4', 'jawaban a', 'jawaban b', 'jawaban c', 'jawaban c', 'jawaban d', 'D', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE IF NOT EXISTS `ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_pembuat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id`, `judul`, `jumlah_soal`, `waktu`, `id_mapel`, `id_pembuat`) VALUES
(1, 'Ujian fisika 1', 4, 2, 1, 1),
(2, 'Ujian fisika 2', 4, 2, 1, 1),
(3, 'Ujian fisika 3', 4, 2, 1, 1),
(7, 'ujian kimia 1', 2, 2, 2, 2),
(8, 'tes fisika', 3, 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_detil`
--

CREATE TABLE IF NOT EXISTS `ujian_detil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `jawaban` char(10) DEFAULT NULL,
  `opsi_benar` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `ujian_detil`
--

INSERT INTO `ujian_detil` (`id`, `id_ujian`, `id_siswa`, `id_soal`, `jawaban`, `opsi_benar`) VALUES
(10, 1, 1, 2, 'A', 'B'),
(11, 1, 1, 3, 'C', 'C'),
(12, 1, 1, 1, 'A', 'A'),
(13, 1, 1, 4, 'D', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `ujian_hasil`
--

CREATE TABLE IF NOT EXISTS `ujian_hasil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `jumlah_benar` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `ujian_hasil`
--

INSERT INTO `ujian_hasil` (`id`, `id_ujian`, `id_siswa`, `jumlah_benar`, `nilai`) VALUES
(77, 1, 1, 3, 75);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
