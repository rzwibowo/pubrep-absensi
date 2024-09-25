-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: zsofttadb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hr_costum_info`
--

DROP TABLE IF EXISTS `hr_costum_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_costum_info` (
  `Custom_No` int(11) DEFAULT '0',
  `Custom_Name` varchar(50) DEFAULT NULL,
  `Sort_HR` int(11) DEFAULT '0',
  `Sort_TA` int(11) DEFAULT '0',
  `Sort_AC` int(11) DEFAULT '0',
  `Sort_Pay` int(11) DEFAULT '0',
  `Be_Open` int(11) DEFAULT '0',
  `Be_Check` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_sidikjari`
--

DROP TABLE IF EXISTS `hr_sidikjari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_sidikjari` (
  `FID` int(11) DEFAULT NULL,
  `SidikJari0_9000` longtext,
  `SidikJari1_9000` longtext,
  `SidikJari2_9000` longtext,
  `SidikJari3_9000` longtext,
  `SidikJari4_9000` longtext,
  `SidikJari5_9000` longtext,
  `SidikJari6_9000` longtext,
  `SidikJari7_9000` longtext,
  `SidikJari8_9000` longtext,
  `SidikJari9_9000` longtext,
  `Kartu_9000` longtext,
  `Password_9000` longtext,
  `Wajah_9000` longtext,
  `Privilage_9000` int(11) DEFAULT '0',
  `SidikJari0_8000` longblob,
  `SidikJari1_8000` longblob,
  `SidikJari2_8000` longblob,
  `Kartu_8000` longblob,
  `Password_8000` int(11) DEFAULT '0',
  `Wajah_8000` longblob,
  `Privilege_8000` int(11) DEFAULT NULL,
  KEY `FID` (`FID`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_staff_info`
--

DROP TABLE IF EXISTS `hr_staff_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_staff_info` (
  `FID` double DEFAULT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `NIK` varchar(50) DEFAULT NULL,
  `DEPT_NAME` varchar(50) DEFAULT NULL,
  `JABATAN` varchar(50) DEFAULT NULL,
  `TGL_MASUK` varchar(50) DEFAULT NULL,
  `Notelp` varchar(50) DEFAULT NULL,
  `PHOTO` longblob,
  `COSTUM_1` varchar(50) DEFAULT NULL,
  `COSTUM_2` varchar(50) DEFAULT NULL,
  `COSTUM_3` varchar(50) DEFAULT NULL,
  `COSTUM_4` varchar(50) DEFAULT NULL,
  `COSTUM_5` varchar(50) DEFAULT NULL,
  `COSTUM_6` varchar(50) DEFAULT NULL,
  `COSTUM_7` varchar(50) DEFAULT NULL,
  `COSTUM_8` varchar(50) DEFAULT NULL,
  `COSTUM_9` varchar(50) DEFAULT NULL,
  `COSTUM_10` varchar(50) DEFAULT NULL,
  `COSTUM_11` varchar(50) DEFAULT NULL,
  `COSTUM_12` varchar(50) DEFAULT NULL,
  `COSTUM_13` varchar(50) DEFAULT NULL,
  `COSTUM_14` varchar(50) DEFAULT NULL,
  `COSTUM_15` varchar(50) DEFAULT NULL,
  `COSTUM_16` varchar(50) DEFAULT NULL,
  `BE_Active` varchar(50) DEFAULT NULL,
  `tgL_Keluar` varchar(50) DEFAULT NULL,
  `Alasan_Keluar` varchar(50) DEFAULT NULL,
  `Cat_Keluar` varchar(50) DEFAULT NULL,
  `Biokey` int(11) DEFAULT NULL,
  `SidikJari0_9000` longtext,
  `SidikJari1_9000` longtext,
  `SidikJari2_9000` longtext,
  `SidikJari3_9000` longtext,
  `SidikJari4_9000` longtext,
  `SidikJari5_9000` longtext,
  `SidikJari6_9000` longtext,
  `SidikJari7_9000` longtext,
  `SidikJari8_9000` longtext,
  `SidikJari9_9000` longtext,
  `Kartu_9000` longtext,
  `Password_9000` longtext,
  `Wajah_9000` longtext,
  `Privilage_9000` int(11) DEFAULT '0',
  `SidikJari0_8000` longblob,
  `SidikJari1_8000` longblob,
  `SidikJari2_8000` longblob,
  `Kartu_8000` longblob,
  `Password_8000` int(11) DEFAULT '0',
  `Wajah_8000` longblob,
  `Privilege_8000` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_staff_up
BEFORE UPDATE 
ON hr_staff_info FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('hr_staff_info', concat(old.fid, " | ", old.nama, " | ", old.nik, " | ", old.dept_name, " | ", old.jabatan, " | ", old.tgl_masuk), 'up') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_staff_del
before DELETE 
ON hr_staff_info FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('hr_staff_info', concat(old.fid, " | ", old.nama, " | ", old.nik, " | ", old.dept_name, " | ", old.jabatan, " | ", old.tgl_masuk), 'del') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `hr_sys`
--

DROP TABLE IF EXISTS `hr_sys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_sys` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NamaPerusahaan` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `NoTelp` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Logo` longblob,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hr_unit`
--

DROP TABLE IF EXISTS `hr_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hr_unit` (
  `IdUnit` varchar(10) DEFAULT NULL,
  `Namaunit` varchar(50) DEFAULT NULL,
  `Nodelevel` int(11) DEFAULT '0',
  `anakunit` varchar(10) DEFAULT NULL,
  `DisUser` varchar(255) DEFAULT NULL,
  KEY `IdUnit` (`IdUnit`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_unit_up
before update
ON hr_unit FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('hr_unit', concat(old.idunit, " | ", old.namaunit), 'up') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_unit_del
before DELETE 
ON hr_unit FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('hr_unit', concat(old.idunit, " | ", old.namaunit), 'del') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `m_autoupload`
--

DROP TABLE IF EXISTS `m_autoupload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_autoupload` (
  `AutoID` int(11) NOT NULL,
  `Jam_1` varchar(255) DEFAULT NULL,
  `Jam_2` varchar(255) DEFAULT NULL,
  `Jam_3` varchar(255) DEFAULT NULL,
  `Jam_4` varchar(255) DEFAULT NULL,
  `menit` int(11) DEFAULT NULL,
  `chk1` int(11) DEFAULT '0',
  `chk2` int(11) DEFAULT '0',
  `chk3` int(11) DEFAULT '0',
  `chk4` int(11) DEFAULT '0',
  `optjw` int(11) DEFAULT '0',
  `optjam` int(11) DEFAULT '0',
  PRIMARY KEY (`AutoID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `m_mesin`
--

DROP TABLE IF EXISTS `m_mesin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_mesin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NoMesin` int(11) DEFAULT NULL,
  `TipeMesin` varchar(255) DEFAULT NULL,
  `TipeKom` varchar(255) DEFAULT NULL,
  `AlamatIP` varchar(255) DEFAULT NULL,
  `PORT` int(11) DEFAULT NULL,
  `Password` int(11) DEFAULT NULL,
  `COM` int(11) DEFAULT NULL,
  `baudrate` int(11) DEFAULT NULL,
  `rt_sms` varchar(255) DEFAULT NULL,
  `rt_version` varchar(255) DEFAULT NULL,
  `Catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_anak`
--

DROP TABLE IF EXISTS `menu_anak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_anak` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_Induk_Id` int(11) DEFAULT NULL,
  `Menu_Name` varchar(255) DEFAULT NULL,
  `Menu_Caption` varchar(255) DEFAULT NULL,
  KEY `Id` (`Id`) USING BTREE,
  KEY `Menu_Induk_Id` (`Menu_Induk_Id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_induk`
--

DROP TABLE IF EXISTS `menu_induk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_induk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Menu_Name` varchar(255) DEFAULT NULL,
  `Menu_Caption` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mesininfo`
--

DROP TABLE IF EXISTS `mesininfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mesininfo` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `namamesin` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `alamatip` varchar(16) COLLATE latin1_general_ci DEFAULT NULL,
  `port` int(8) DEFAULT '6008',
  `pwd` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_angs`
--

DROP TABLE IF EXISTS `pay_angs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_angs` (
  `KodePinjaman` varchar(255) DEFAULT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `Angs_ke` int(11) DEFAULT NULL,
  `NominalBayar` decimal(19,4) DEFAULT NULL,
  `TglBayar` varchar(255) DEFAULT NULL,
  `UserInput` varchar(255) DEFAULT NULL,
  `TglInput` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_aturan`
--

DROP TABLE IF EXISTS `pay_aturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_aturan` (
  `KodeAturan` varchar(255) DEFAULT NULL,
  `NamaAturan` varchar(255) DEFAULT NULL,
  `KodePendapatan` varchar(255) DEFAULT NULL,
  `NamaPendapatan` varchar(255) DEFAULT NULL,
  `KodePotongan` varchar(255) DEFAULT NULL,
  `NamaPotongan` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_pendapatan`
--

DROP TABLE IF EXISTS `pay_pendapatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_pendapatan` (
  `KoPen` varchar(50) DEFAULT NULL,
  `KodeAturan` varchar(255) DEFAULT NULL,
  `Nama_Item` varchar(255) DEFAULT NULL,
  `Formula` int(11) DEFAULT NULL,
  `Nilai` decimal(19,4) DEFAULT '0.0000',
  `Periode` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `Operator` varchar(255) DEFAULT NULL,
  `Satuan` varchar(50) DEFAULT NULL,
  `NilaiOperator` int(11) DEFAULT '0',
  `NilaiHasil` decimal(19,4) DEFAULT '0.0000',
  `chkPersen` int(11) DEFAULT NULL,
  `ItemPendapatan` varchar(50) DEFAULT NULL,
  `chkaturanot` varchar(255) DEFAULT NULL,
  KEY `KodeAturan` (`KodeAturan`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_pinjaman`
--

DROP TABLE IF EXISTS `pay_pinjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_pinjaman` (
  `KodePinjaman` varchar(255) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `NamaStaff` varchar(255) DEFAULT NULL,
  `TglPinjam` varchar(255) DEFAULT NULL,
  `PinjamanPokok` decimal(19,4) DEFAULT NULL,
  `Bunga` decimal(18,3) DEFAULT '0.000',
  `Nilaibunga` decimal(19,4) DEFAULT NULL,
  `TotalPinjaman` decimal(19,4) DEFAULT NULL,
  `masaAngsuran` int(11) DEFAULT NULL,
  `NilaiAngsuran` decimal(19,4) DEFAULT NULL,
  `AutoDebet` int(11) DEFAULT NULL,
  `Lunas` int(11) DEFAULT '0',
  `tglLunas` int(11) DEFAULT '0',
  `SaldoPinjaman` varchar(255) DEFAULT NULL,
  UNIQUE KEY `KodePinjaman` (`KodePinjaman`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_potongan`
--

DROP TABLE IF EXISTS `pay_potongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_potongan` (
  `KoPot` varchar(50) DEFAULT NULL,
  `IDAturan` varchar(50) DEFAULT NULL,
  `Nama_Item` varchar(255) DEFAULT NULL,
  `Formula` int(11) DEFAULT NULL,
  `Nilai` decimal(19,4) DEFAULT '0.0000',
  `Periode` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `Operator` varchar(255) DEFAULT NULL,
  `Satuan` varchar(255) DEFAULT NULL,
  `NilaiOperator` int(11) DEFAULT '0',
  `NilaiHasil` decimal(19,4) DEFAULT '0.0000',
  `chkPersen` varchar(50) DEFAULT NULL,
  `ItemPendapatan` varchar(50) DEFAULT NULL,
  KEY `IDAturan` (`IDAturan`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_premi`
--

DROP TABLE IF EXISTS `pay_premi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_premi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `JamLembur` decimal(18,3) DEFAULT '0.000',
  `HariKerja` decimal(18,3) DEFAULT '0.000',
  `HariOFF` decimal(18,3) DEFAULT '0.000',
  `HariLibur` decimal(18,3) DEFAULT '0.000',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pay_staffx`
--

DROP TABLE IF EXISTS `pay_staffx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_staffx` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(255) DEFAULT NULL,
  `FID` int(11) DEFAULT NULL,
  `KodeAturan` varchar(50) DEFAULT NULL,
  `NamaAturan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FID` (`FID`) USING BTREE,
  KEY `KodeAturan` (`KodeAturan`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `r_ot`
--

DROP TABLE IF EXISTS `r_ot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `r_ot` (
  `R_Id` int(11) NOT NULL AUTO_INCREMENT,
  `R_awal` int(11) DEFAULT '0',
  `R_Akhir` int(11) DEFAULT '0',
  `R_Hasil` int(11) DEFAULT '0',
  PRIMARY KEY (`R_Id`),
  KEY `R_Id` (`R_Id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `set_ot`
--

DROP TABLE IF EXISTS `set_ot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `set_ot` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipeOT` varchar(255) DEFAULT NULL,
  `Op` varchar(255) DEFAULT NULL,
  `menit` int(11) DEFAULT NULL,
  `kali` decimal(18,3) DEFAULT '0.000',
  KEY `ID` (`ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_download`
--

DROP TABLE IF EXISTS `sys_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_download` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PolaRt` int(11) DEFAULT NULL,
  `cj1` varchar(255) DEFAULT NULL,
  `jam1` varchar(255) DEFAULT NULL,
  `cj2` varchar(255) DEFAULT NULL,
  `jam2` varchar(255) DEFAULT NULL,
  `cj3` varchar(255) DEFAULT NULL,
  `jam3` varchar(255) DEFAULT NULL,
  `cj4` varchar(255) DEFAULT NULL,
  `jam4` varchar(255) DEFAULT NULL,
  `ChkHapus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_sms`
--

DROP TABLE IF EXISTS `sys_sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_sms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AturanKirim` varchar(255) DEFAULT NULL,
  `t_Fid` varchar(255) DEFAULT NULL,
  `t_Nama` varchar(255) DEFAULT NULL,
  `t_NIK` varchar(255) DEFAULT NULL,
  `t_Dept` varchar(255) DEFAULT NULL,
  `t_Jab` varchar(255) DEFAULT NULL,
  `F_Fid` varchar(255) DEFAULT NULL,
  `F_Nama` varchar(255) DEFAULT NULL,
  `F_NIK` varchar(255) DEFAULT NULL,
  `F_Dept` varchar(255) DEFAULT NULL,
  `F_Jab` varchar(255) DEFAULT NULL,
  `c_Fid` varchar(255) DEFAULT NULL,
  `c_Nama` varchar(255) DEFAULT NULL,
  `c_NIK` varchar(255) DEFAULT NULL,
  `c_Dept` varchar(255) DEFAULT NULL,
  `c_Jab` varchar(255) DEFAULT NULL,
  `c_kirimTotal` varchar(255) DEFAULT NULL,
  `NoTotal` varchar(255) DEFAULT NULL,
  `JamTotal` varchar(255) DEFAULT NULL,
  `c_no2` varchar(255) DEFAULT NULL,
  `No2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `F_Fid` (`F_Fid`) USING BTREE,
  KEY `c_Fid` (`c_Fid`) USING BTREE,
  KEY `t_Fid` (`t_Fid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sys_user_info`
--

DROP TABLE IF EXISTS `sys_user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_name` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `User_Grade` int(11) DEFAULT NULL,
  `MenuAkses` varchar(255) DEFAULT NULL,
  `deptAkses` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ta_daftarijin`
--

DROP TABLE IF EXISTS `ta_daftarijin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_daftarijin` (
  `Fid` int(11) DEFAULT NULL,
  `IdIjin` int(11) DEFAULT NULL,
  `TipeIjin` int(11) DEFAULT NULL,
  `TglIjin` varchar(255) DEFAULT NULL,
  `chklangsung` int(11) DEFAULT NULL,
  `JamAwal` varchar(255) DEFAULT NULL,
  `JamAkhir` varchar(255) DEFAULT NULL,
  `JmlMenit` varchar(255) DEFAULT NULL,
  `Alasan` varchar(255) DEFAULT NULL,
  `TglInput` varchar(255) DEFAULT NULL,
  `UserInput` varchar(255) DEFAULT NULL,
  `TahunIjin` varchar(255) DEFAULT NULL,
  KEY `Fid` (`Fid`) USING BTREE,
  KEY `IdIjin` (`IdIjin`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_daftarijin_del
BEFORE DELETE 
ON ta_daftarijin FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('ta_daftarijin', concat(old.fid, " | ", old.tglijin, " | ", old.alasan), 'del') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ta_hari_libur`
--

DROP TABLE IF EXISTS `ta_hari_libur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_hari_libur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_libur` varchar(50) DEFAULT NULL,
  `tgl_libur` varchar(255) DEFAULT NULL,
  `TpLIbur` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ta_harian`
--

DROP TABLE IF EXISTS `ta_harian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_harian` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FID` varchar(255) DEFAULT NULL,
  `Tanggal` varchar(255) DEFAULT NULL,
  `Jadwal` varchar(255) DEFAULT NULL,
  `JamMasuk` varchar(255) DEFAULT NULL,
  `stattelat` varchar(255) NOT NULL,
  `Log` varchar(255) DEFAULT NULL,
  `statkirim` varchar(255) DEFAULT NULL,
  KEY `Tanggal` (`Tanggal`) USING BTREE,
  KEY `Id` (`Id`) USING BTREE,
  KEY `FID` (`FID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ta_jadwal_staffx`
--

DROP TABLE IF EXISTS `ta_jadwal_staffx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_jadwal_staffx` (
  `Fid` varchar(255) DEFAULT NULL,
  `NamaStaff` varchar(255) DEFAULT NULL,
  `Tanggal` varchar(255) DEFAULT NULL,
  `NoJadwal` varchar(255) DEFAULT NULL,
  `NoShift_1` varchar(255) DEFAULT NULL,
  `NoShift_2` varchar(255) DEFAULT NULL,
  `NoShift_3` varchar(255) DEFAULT NULL,
  `NoShift_4` varchar(255) DEFAULT NULL,
  `NoShift_5` varchar(255) DEFAULT NULL,
  `chk_gbng` varchar(255) DEFAULT NULL,
  KEY `Fid` (`Fid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_jadwalstaff_del
before DELETE 
ON ta_jadwal_staffx FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('ta_jadwal_staffx', concat(old.fid, " | ", old.tanggal, " | ", old.nojadwal), 'del') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ta_log`
--

DROP TABLE IF EXISTS `ta_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mach_id` varchar(255) DEFAULT NULL,
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `Kondisi` varchar(255) DEFAULT NULL,
  `Verifikasi` varchar(255) DEFAULT NULL,
  `In_out` varchar(255) DEFAULT NULL,
  `Tanggal_Log` varchar(50) DEFAULT NULL,
  `Jam_Log` varchar(255) DEFAULT NULL,
  `tgl_input` varchar(255) DEFAULT NULL,
  `user_input` varchar(255) DEFAULT NULL,
  `TA_MarkSMS` int(11) DEFAULT '0',
  `Pilih` int(11) DEFAULT '0',
  `DateTime` varchar(255) NOT NULL,
  KEY `Fid` (`Fid`) USING BTREE,
  KEY `Id` (`Id`) USING BTREE,
  KEY `Mach_id` (`Mach_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=228914 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ta_shift`
--

DROP TABLE IF EXISTS `ta_shift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_shift` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Shift` varchar(255) DEFAULT NULL,
  `Jam_masuk` varchar(255) DEFAULT NULL,
  `Jam_keluar` varchar(255) DEFAULT NULL,
  `Awal_masuk` varchar(255) DEFAULT NULL,
  `Akhir_masuk` varchar(255) DEFAULT NULL,
  `Awal_keluar` varchar(255) DEFAULT NULL,
  `Akhir_keluar` varchar(255) DEFAULT NULL,
  `awal_lembur` varchar(255) DEFAULT NULL,
  `T_telat` varchar(255) DEFAULT NULL,
  `T_PC` varchar(255) DEFAULT NULL,
  `Hari_kerja` varchar(255) DEFAULT NULL,
  `menit_kerja` varchar(255) DEFAULT NULL,
  `Menit_lembur_awal` varchar(255) DEFAULT NULL,
  `Menit_lembur_akhir` varchar(255) DEFAULT NULL,
  `chk_lembur_awal` varchar(255) DEFAULT NULL,
  `chk_lembur_akhir` varchar(255) DEFAULT NULL,
  `chk_harus_masuk` varchar(255) DEFAULT NULL,
  `chk_harus_keluar` varchar(255) DEFAULT NULL,
  `chk_Jadwal_lembur` varchar(255) DEFAULT NULL,
  `chk_besok` int(11) DEFAULT NULL,
  `chk_ist1` int(11) DEFAULT NULL,
  `ist1_1` varchar(255) DEFAULT NULL,
  `ist1_2` varchar(255) DEFAULT NULL,
  `chk_ist2` int(11) DEFAULT NULL,
  `ist2_1` varchar(255) DEFAULT NULL,
  `ist2_2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_shift_up
before UPDATE 
ON ta_shift FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('ta_shift', concat(old.id, " | ", old.nama_shift, " | ", old.jam_masuk, " | ", old.jam_keluar, " | chk_besok = ", old.chk_besok), 'up') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_shift_del
before DELETE 
ON ta_shift FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('ta_shift', concat(old.id, " | ", old.nama_shift, " | ", old.jam_masuk, " | ", old.jam_keluar, " | chk_besok = ", old.chk_besok), 'del') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ta_sys`
--

DROP TABLE IF EXISTS `ta_sys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_sys` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Record_Min` int(11) DEFAULT NULL,
  `chk_Lupa_Masuk` int(11) DEFAULT NULL,
  `chk_Lupa_Pulang` int(11) DEFAULT NULL,
  `Menit_Lupa_masuk` int(11) DEFAULT NULL,
  `Menit_Lupa_Pulang` int(11) DEFAULT NULL,
  `Hari_Istirahat` int(11) DEFAULT NULL,
  `Hari_Libur` int(11) DEFAULT NULL,
  `Hari_Lembur` int(11) DEFAULT NULL,
  `Fungsi_1` int(11) DEFAULT NULL,
  `Fungsi_2` int(11) DEFAULT NULL,
  `Fungsi_3` int(11) DEFAULT NULL,
  `Fungsi_4` int(11) DEFAULT NULL,
  `Fungsi_5` int(11) DEFAULT NULL,
  `Fungsi_bebas` int(11) DEFAULT NULL,
  `JmlIjin` int(11) DEFAULT '0',
  `Jam_Akhir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ta_timetable`
--

DROP TABLE IF EXISTS `ta_timetable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_timetable` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Jadwal` varchar(255) DEFAULT NULL,
  `Jadwal1` varchar(255) DEFAULT NULL,
  `jadwal2` varchar(255) DEFAULT NULL,
  `jadwal3` varchar(255) DEFAULT NULL,
  `jadwal4` varchar(255) DEFAULT NULL,
  `jadwal5` varchar(255) DEFAULT NULL,
  `chk_gabung` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_timetable_up
before UPDATE 
ON ta_timetable FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('ta_timetable', concat(old.id, " | ", old.nama_jadwal, " | ", old.jadwal1), 'up') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER log_timetable_del
before DELETE 
ON ta_timetable FOR EACH ROW
INSERT INTO tz_db_log (tbl_name, all_value, op_type)
VALUES ('ta_timetable', concat(old.id, " | ", old.nama_jadwal, " | ", old.jadwal1), 'del') */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ta_tipe_ijin`
--

DROP TABLE IF EXISTS `ta_tipe_ijin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ta_tipe_ijin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipe_ijin` varchar(50) DEFAULT NULL,
  `Be_del` varchar(50) DEFAULT NULL,
  KEY `Id` (`Id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_log`
--

DROP TABLE IF EXISTS `temp_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mach_id` varchar(255) DEFAULT NULL,
  `Fid` varchar(255) DEFAULT NULL,
  `Nama_Staff` varchar(255) DEFAULT NULL,
  `Kondisi` varchar(255) DEFAULT NULL,
  `Verifikasi` varchar(255) DEFAULT NULL,
  `In_out` varchar(255) DEFAULT NULL,
  `Tanggal_Log` varchar(50) DEFAULT NULL,
  `Jam_Log` varchar(255) DEFAULT NULL,
  `tgl_input` varchar(255) DEFAULT NULL,
  `user_input` varchar(255) DEFAULT NULL,
  `TA_MarkSMS` int(11) DEFAULT '0',
  `Pilih` int(11) DEFAULT '0',
  `DateTime` varchar(255) NOT NULL,
  KEY `Fid` (`Fid`) USING BTREE,
  KEY `Id` (`Id`) USING BTREE,
  KEY `Mach_id` (`Mach_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tz_db_log`
--

DROP TABLE IF EXISTS `tz_db_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tz_db_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_name` varchar(100) DEFAULT NULL,
  `all_value` text,
  `op_type` varchar(10) NOT NULL,
  `op_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'zsofttadb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-12 19:25:52
