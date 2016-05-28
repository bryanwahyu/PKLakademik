/*
SQLyog Ultimate v8.61 
MySQL - 5.5.5-10.1.10-MariaDB-log : Database - simak_cs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`simak_cs` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `simak_cs`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(30) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `tgl_gabung` datetime DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`nama_admin`,`username`,`password`,`tgl_gabung`) values (1,'Reroet','reroet','628a98554d657ca8aa0577b07d56b602','2016-05-28 14:56:45');

/*Table structure for table `agama` */

DROP TABLE IF EXISTS `agama`;

CREATE TABLE `agama` (
  `id_agama` tinyint(2) NOT NULL AUTO_INCREMENT,
  `nama_agama` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `agama` */

/*Table structure for table `alamat_calon_mahasiswa` */

DROP TABLE IF EXISTS `alamat_calon_mahasiswa`;

CREATE TABLE `alamat_calon_mahasiswa` (
  `no_reg` char(18) NOT NULL,
  `id_kewarganegaraan` smallint(4) DEFAULT NULL,
  `id_provinsi` smallint(4) DEFAULT NULL,
  `id_kabupaten` smallint(4) DEFAULT NULL,
  `id_kecamatan` smallint(4) DEFAULT NULL,
  `id_jenis_tinggal` tinyint(2) DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `kelurahan` varchar(15) DEFAULT NULL,
  `dusun` varchar(20) DEFAULT NULL,
  `rt` tinyint(3) DEFAULT NULL,
  `rw` tinyint(3) DEFAULT NULL,
  `kode_pos` mediumint(5) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `kps` tinyint(1) DEFAULT NULL,
  `no_kps` char(32) DEFAULT NULL,
  PRIMARY KEY (`no_reg`),
  KEY `FK_kabupaten_mahasiswa` (`id_kabupaten`),
  KEY `FK_jenis_tinggal_mahasiswa` (`id_jenis_tinggal`),
  KEY `FK_kecamatan_mahasiswa` (`id_kecamatan`),
  KEY `FK_provinsi_mahasiswa` (`id_provinsi`),
  KEY `FK_warganegara_mahasiswa` (`id_kewarganegaraan`),
  CONSTRAINT `FK_jenis_tinggal_mahasiswa` FOREIGN KEY (`id_jenis_tinggal`) REFERENCES `jenis_tinggal` (`id_jenis_tinggal`) ON UPDATE CASCADE,
  CONSTRAINT `FK_kabupaten_mahasiswa` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_kecamatan_mahasiswa` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON UPDATE CASCADE,
  CONSTRAINT `FK_provinsi_mahasiswa` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON UPDATE CASCADE,
  CONSTRAINT `FK_warganegara_mahasiswa` FOREIGN KEY (`id_kewarganegaraan`) REFERENCES `negara` (`id_negara`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alamat_calon_mahasiswa` */

/*Table structure for table `biodata_calon_mahasiswa` */

DROP TABLE IF EXISTS `biodata_calon_mahasiswa`;

CREATE TABLE `biodata_calon_mahasiswa` (
  `no_reg` char(18) NOT NULL,
  `id_agama` tinyint(2) DEFAULT NULL,
  `id_semester` smallint(3) DEFAULT NULL,
  `tgl_reg` datetime DEFAULT NULL,
  `nama_mahasiswa` varchar(70) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` tinyint(1) DEFAULT NULL,
  `prodi` varchar(21) DEFAULT NULL,
  `asal_sma` varchar(30) DEFAULT NULL,
  `angkatan` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`no_reg`),
  KEY `FK_agama_mahasiswa` (`id_agama`),
  KEY `FK_semester_mahasiswa` (`id_semester`),
  CONSTRAINT `FK_agama_mahasiswa` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`) ON UPDATE CASCADE,
  CONSTRAINT `FK_penghubung_mahasiswa` FOREIGN KEY (`no_reg`) REFERENCES `alamat_calon_mahasiswa` (`no_reg`) ON UPDATE CASCADE,
  CONSTRAINT `FK_semester_mahasiswa` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `biodata_calon_mahasiswa` */

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `nip` char(18) NOT NULL,
  `nama_dosen` varchar(80) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

/*Table structure for table `dosen_pembimbing` */

DROP TABLE IF EXISTS `dosen_pembimbing`;

CREATE TABLE `dosen_pembimbing` (
  `id_dosen_pembimbing` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nip_dosen` char(18) DEFAULT NULL,
  `id_pkl` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id_dosen_pembimbing`),
  KEY `FK_dosen_pembimbing_pkl` (`id_pkl`),
  KEY `FK_nip_dosen_pembimbing` (`nip_dosen`),
  CONSTRAINT `FK_dosen_pembimbing_pkl` FOREIGN KEY (`id_pkl`) REFERENCES `pkl` (`id_pkl`) ON UPDATE CASCADE,
  CONSTRAINT `FK_nip_dosen_pembimbing` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen_pembimbing` */

/*Table structure for table `jenis_tinggal` */

DROP TABLE IF EXISTS `jenis_tinggal`;

CREATE TABLE `jenis_tinggal` (
  `id_jenis_tinggal` tinyint(2) NOT NULL AUTO_INCREMENT,
  `nama_jenis_tinggal` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_jenis_tinggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jenis_tinggal` */

/*Table structure for table `kabupaten` */

DROP TABLE IF EXISTS `kabupaten`;

CREATE TABLE `kabupaten` (
  `id_kabupaten` smallint(4) NOT NULL AUTO_INCREMENT,
  `id_provinsi` smallint(4) DEFAULT NULL,
  `nama_kabupaten` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_kabupaten`),
  KEY `FK_kabupaten` (`id_provinsi`),
  CONSTRAINT `FK_kabupaten` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kabupaten` */

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `id_kecamatan` smallint(4) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` smallint(4) DEFAULT NULL,
  `nama_kecamatan` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`),
  KEY `FK_kecamatan` (`id_kabupaten`),
  CONSTRAINT `FK_kecamatan` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kecamatan` */

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `nim` char(10) NOT NULL,
  `no_reg` char(18) DEFAULT NULL,
  `lulus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`nim`),
  UNIQUE KEY `jadi_mahasiswa` (`no_reg`),
  CONSTRAINT `FK_jadi_mahasiswa` FOREIGN KEY (`no_reg`) REFERENCES `biodata_calon_mahasiswa` (`no_reg`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mahasiswa` */

/*Table structure for table `negara` */

DROP TABLE IF EXISTS `negara`;

CREATE TABLE `negara` (
  `id_negara` smallint(4) NOT NULL AUTO_INCREMENT,
  `nama_negara` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_negara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `negara` */

/*Table structure for table `perusahaan` */

DROP TABLE IF EXISTS `perusahaan`;

CREATE TABLE `perusahaan` (
  `id_perusahaan` smallint(4) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(70) DEFAULT NULL,
  `alamat_perusahaan` varchar(80) DEFAULT NULL,
  `telepon_perusahaan` varchar(13) DEFAULT NULL,
  `jenis_usaha` varchar(20) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `perusahaan` */

/*Table structure for table `pkl` */

DROP TABLE IF EXISTS `pkl`;

CREATE TABLE `pkl` (
  `id_pkl` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nim` char(10) DEFAULT NULL,
  `id_semester` smallint(3) DEFAULT NULL,
  `id_perusahaan` smallint(4) DEFAULT NULL,
  `id_ketua_komisi` char(18) DEFAULT NULL,
  `judul_pkl` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pkl`),
  KEY `FK_mahasiswa_pkl` (`nim`),
  KEY `FK_semester_pkl` (`id_semester`),
  KEY `FK_perusahaan_tempat_pkl` (`id_perusahaan`),
  CONSTRAINT `FK_mahasiswa_pkl` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON UPDATE CASCADE,
  CONSTRAINT `FK_perusahaan_tempat_pkl` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON UPDATE CASCADE,
  CONSTRAINT `FK_semester_pkl` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pkl` */

/*Table structure for table `provinsi` */

DROP TABLE IF EXISTS `provinsi`;

CREATE TABLE `provinsi` (
  `id_provinsi` smallint(4) NOT NULL AUTO_INCREMENT,
  `id_negara` smallint(4) DEFAULT NULL,
  `nama_provinsi` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`),
  KEY `FK_provinsi` (`id_negara`),
  CONSTRAINT `FK_provinsi` FOREIGN KEY (`id_negara`) REFERENCES `negara` (`id_negara`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `provinsi` */

/*Table structure for table `semester` */

DROP TABLE IF EXISTS `semester`;

CREATE TABLE `semester` (
  `id_semester` smallint(3) NOT NULL AUTO_INCREMENT,
  `tahun` smallint(4) DEFAULT NULL,
  `tahun_ajaran` char(9) DEFAULT NULL,
  `semester` tinyint(1) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `berlaku` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `semester` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
