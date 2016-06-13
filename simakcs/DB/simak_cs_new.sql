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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `agama` */

insert  into `agama`(`id_agama`,`nama_agama`) values (1,'Buddha'),(2,'Hindu'),(3,'Islam'),(4,'Kristen Protestan'),(5,'Kristen Katolik'),(6,'Konghuchu');

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
  CONSTRAINT `FK_alamat_calon_mahasiswa` FOREIGN KEY (`no_reg`) REFERENCES `biodata_calon_mahasiswa` (`no_reg`) ON UPDATE CASCADE,
  CONSTRAINT `FK_jenis_tinggal_mahasiswa` FOREIGN KEY (`id_jenis_tinggal`) REFERENCES `jenis_tinggal` (`id_jenis_tinggal`) ON UPDATE CASCADE,
  CONSTRAINT `FK_kabupaten_mahasiswa` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_kecamatan_mahasiswa` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON UPDATE CASCADE,
  CONSTRAINT `FK_provinsi_mahasiswa` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON UPDATE CASCADE,
  CONSTRAINT `FK_warganegara_mahasiswa` FOREIGN KEY (`id_kewarganegaraan`) REFERENCES `negara` (`id_negara`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `alamat_calon_mahasiswa` */

insert  into `alamat_calon_mahasiswa`(`no_reg`,`id_kewarganegaraan`,`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_jenis_tinggal`,`nik`,`alamat`,`kelurahan`,`dusun`,`rt`,`rw`,`kode_pos`,`no_telp`,`no_hp`,`email`,`kps`,`no_kps`) values ('00000001-CMHS-2016',1,1,1,1,1,'1995063005493001','Jln. Pulau Saelus 1 No. 1','Pedungan','Br. Karang Suwung',1,1,80222,'085338106836','085338106836','wayanpuguhsudarma@gmail.com',0,''),('00000002-CMHS-2016',1,1,1,1,1,'','','','',0,0,0,'','','',0,'');

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
  `angkatan` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`no_reg`),
  KEY `FK_agama_mahasiswa` (`id_agama`),
  KEY `FK_semester_mahasiswa` (`id_semester`),
  CONSTRAINT `FK_agama_mahasiswa` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`) ON UPDATE CASCADE,
  CONSTRAINT `FK_semester_mahasiswa` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `biodata_calon_mahasiswa` */

insert  into `biodata_calon_mahasiswa`(`no_reg`,`id_agama`,`id_semester`,`tgl_reg`,`nama_mahasiswa`,`tempat_lahir`,`tanggal_lahir`,`jenis_kelamin`,`prodi`,`asal_sma`,`angkatan`) values ('00000001-CMHS-2016',1,1,'2016-05-29 09:02:42','I Wayan Reroet Kupluk','Surabaya','1995-07-23',0,'S1 Teknik Informatika','SMK TI Bali Global Denpasar',2013),('00000002-CMHS-2016',1,1,'2016-06-12 20:43:29','dsasdadsasaddas','','0000-00-00',0,'S1 Teknik Informatika','',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_tinggal` */

insert  into `jenis_tinggal`(`id_jenis_tinggal`,`nama_jenis_tinggal`) values (1,'Kost'),(2,'Menumpang Tempat'),(3,'Bersama Orang Tua');

/*Table structure for table `kabupaten` */

DROP TABLE IF EXISTS `kabupaten`;

CREATE TABLE `kabupaten` (
  `id_kabupaten` smallint(4) NOT NULL AUTO_INCREMENT,
  `id_provinsi` smallint(4) DEFAULT NULL,
  `nama_kabupaten` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_kabupaten`),
  KEY `FK_kabupaten` (`id_provinsi`),
  CONSTRAINT `FK_kabupaten` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `kabupaten` */

insert  into `kabupaten`(`id_kabupaten`,`id_provinsi`,`nama_kabupaten`) values (1,1,'Denpasar');

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `id_kecamatan` smallint(4) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` smallint(4) DEFAULT NULL,
  `nama_kecamatan` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`),
  KEY `FK_kecamatan` (`id_kabupaten`),
  CONSTRAINT `FK_kecamatan` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `kecamatan` */

insert  into `kecamatan`(`id_kecamatan`,`id_kabupaten`,`nama_kecamatan`) values (1,1,'Denpasar Selatan');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `negara` */

insert  into `negara`(`id_negara`,`nama_negara`) values (1,'Indonesia');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `provinsi` */

insert  into `provinsi`(`id_provinsi`,`id_negara`,`nama_provinsi`) values (1,1,'Bali');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `semester` */

insert  into `semester`(`id_semester`,`tahun`,`tahun_ajaran`,`semester`,`tgl_mulai`,`tgl_selesai`,`berlaku`) values (1,2016,'2015/2016',0,'2015-08-05','2016-01-10',1);

/* Procedure structure for procedure `get_last_id` */

/*!50003 DROP PROCEDURE IF EXISTS  `get_last_id` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `get_last_id`()
BEGIN
SELECT
	no_reg,
	CONCAT(SUBSTRING(no_reg, -4), SUBSTRING(no_reg, 1,8))*1 AS nomor,
	SUBSTRING(no_reg,-4)*1 AS tahun,
	SUBSTRING(no_reg,1,8)*1 AS urutan
FROM biodata_calon_mahasiswa ORDER BY nomor DESC LIMIT 1;
    END */$$
DELIMITER ;

/*Table structure for table `calon_mahasiswa` */

DROP TABLE IF EXISTS `calon_mahasiswa`;

/*!50001 DROP VIEW IF EXISTS `calon_mahasiswa` */;
/*!50001 DROP TABLE IF EXISTS `calon_mahasiswa` */;

/*!50001 CREATE TABLE  `calon_mahasiswa`(
 `no_reg` char(18) ,
 `nama_mahasiswa` varchar(70) ,
 `tgl_reg` datetime ,
 `jenis_kelamin` tinyint(1) ,
 `asal_sma` varchar(30) ,
 `angkatan` smallint(4) ,
 `alamat` varchar(30) ,
 `no_telp` varchar(13) ,
 `email` varchar(30) ,
 `nomor` double 
)*/;

/*View structure for view calon_mahasiswa */

/*!50001 DROP TABLE IF EXISTS `calon_mahasiswa` */;
/*!50001 DROP VIEW IF EXISTS `calon_mahasiswa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `calon_mahasiswa` AS (select `b`.`no_reg` AS `no_reg`,`b`.`nama_mahasiswa` AS `nama_mahasiswa`,`b`.`tgl_reg` AS `tgl_reg`,`b`.`jenis_kelamin` AS `jenis_kelamin`,`b`.`asal_sma` AS `asal_sma`,`b`.`angkatan` AS `angkatan`,`a`.`alamat` AS `alamat`,`a`.`no_telp` AS `no_telp`,`a`.`email` AS `email`,(concat(substr(`b`.`no_reg`,-(4)),substr(`b`.`no_reg`,1,8)) * 1) AS `nomor` from (`biodata_calon_mahasiswa` `b` left join `alamat_calon_mahasiswa` `a` on((`b`.`no_reg` = `a`.`no_reg`))) order by (concat(substr(`b`.`no_reg`,-(4)),substr(`b`.`no_reg`,1,8)) * 1)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
