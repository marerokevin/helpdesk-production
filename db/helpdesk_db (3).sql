-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 07:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(20) NOT NULL,
  `department` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `user` varchar(30) NOT NULL,
  `os` varchar(20) NOT NULL,
  `computerName` varchar(30) NOT NULL,
  `macAddress` varchar(30) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `edr` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `department`, `type`, `user`, `os`, `computerName`, `macAddress`, `ipAddress`, `edr`, `email`) VALUES
(1, 'Accounting', 'Dekstop ', 'Joy Christian Pareja', 'Win10', 'WS-GPI142i', '04-0E-3C-11-13-96', '192.168.5.25', 1, ''),
(2, 'Accounting', 'Dekstop ', 'Maricel Montano', 'Win10', 'WS-GPI03', '04:0E:3C:11:12:FB ', '192.168.5.21', 1, ''),
(3, 'Accounting', 'Laptop', 'Acctg. Laptop', 'Win10', 'Desktop-6ar20EI', '48:5F:99:8C:6D:4D', 'Dynamic', 0, ''),
(4, 'Accounting', 'Dekstop ', 'Melly Jenna Arive', 'Win10', 'WS-GPI05', '9C:7B:EF:A5:7A:4A', '192.168.5.22', 1, ''),
(5, 'Accounting', 'Dekstop ', 'Nicole Cabildo', 'Win10', 'C2112-297', '9C:7B:EF:A5:7A:80', '192.168.5.23', 1, ''),
(6, 'Accounting', 'Dekstop ', 'Myra Villanueva', 'Win10', 'WS-GPI01', 'C4:65:16:3D:D2:6D', '192.168.5.24', 1, ''),
(7, 'Accounting', 'Laptop', 'Acctg. Laptop', 'Win10', 'WS-GPIL289', 'C8:58:C0:96:2F:AE', 'Dynamic', 0, ''),
(8, 'Accounting', 'Dekstop ', 'Gerina Beri', 'Win7', 'WS-GPI06', 'FC:4D:D4:36:73:BF', '192.168.5.20', 0, ''),
(9, 'Administration', 'SERVER', 'GPSS Server', 'Win Server 201', 'WIN-GFTNBG9NB8A', 'I8-66-DA-8B-32-43', '192.168.5.108', 1, ''),
(10, 'Administration', 'SERVER', 'AD Server', 'Win Server 201', 'GPI-FILESVR', '08-94-EF-39-F9-CE', '192.168.5.250', 1, ''),
(11, 'Administration', 'SERVER', 'PPD-Server 1', 'Win Server 201', 'GPH-FS-001', '4C-D9-8F-7B-F4-B0', '172.24.33.1', 1, ''),
(12, 'Administration', 'SERVER', 'PPD-Server 2', 'Win Server 201', 'GPH-FS-002', '4C-D9-8F-86-F9-49', '172.24.33.2', 1, ''),
(13, 'Administration', 'SERVER', 'MIS/SYSTEM KAIZEN', 'Win Server 201', 'G DMS', '50-9A-4C-7B-F0-01', '192.168.5.217', 1, ''),
(14, 'Administration', 'SERVER/VM', 'HyperV-Server', 'Win Server 201', 'GPI-VCSVR', 'EC-AA-A0-19-A5-39', '192.168.5.199', 1, ''),
(15, 'Administration', 'SERVER', 'Admin-System', 'Win10', 'DESTOP-2KTREUD ', '00-50-56-B4-24-16', '192.168.5.1', 1, ''),
(16, 'Administration', 'SERVER/VM', 'Japan Test', 'Win10', 'DESKTOP-NJA09SE', '00-50-56-B4-5A-94', '192.168.5.107', 1, ''),
(17, 'Administration', 'Laptop', 'MIS Printer ID Thinkpad', 'Win10', 'GPI-ADMIN', 'CA-58-C0-96-28-82', 'Dynamic ', 1, ''),
(18, 'Administration', 'Laptop', 'Frank Apil', 'Win10', 'C2203-023', '14-13-33-40-A1-D1', 'Dynamic', 1, ''),
(19, 'Administration', 'Laptop', 'Gemma Calalo', 'Win10', 'WS401-2021-7', '', 'Dynamic', 1, ''),
(20, 'Administration', 'Laptop', 'GPSS2-Laptop', 'Win10', 'PC-GPSS', '8C-47-BE-56-B9-21', '192.168.5.220', 1, ''),
(21, 'Administration', 'Laptop', 'Felmhar Vivo/ HP Laptop', 'Win10', 'C2204-027', 'C8-5A-CF-75-4E-B4', 'Dynamic', 1, ''),
(22, 'Administration', 'Laptop', 'John Carlo Sierra', 'Win10', 'WS-GPIL288', 'C8-58-C0-96-21-BB', 'Dynamic', 1, ''),
(23, 'Administration', 'Laptop', 'Rio Monzon', 'Win10', 'C2202-003', '', 'Dynamic', 1, ''),
(24, 'Administration', 'Laptop', 'CLINIC HP Laptop', 'Win10', 'C2202-010', 'C8-5A-CF-75-FE-65', 'Dynamic', 1, ''),
(25, 'Administration', 'Laptop', 'Rinalyn Dulce', 'Win10', 'C2203-022', '14-13-33-40-B4-65', 'Dynamic ', 1, ''),
(26, 'Administration', 'Laptop', 'Jonathan Nemedez', 'Win10', 'C2110-233', '', 'Dynamic', 0, ''),
(27, 'Administration', 'Dekstop ', 'John Spencer Sandigan', 'Win10', 'C2209-037', '1C-1B-0D-B3-AA-65', '192.168.60.140', 1, 'mis.techsupport@glory.com.ph'),
(28, 'Administration', 'Dekstop ', 'CLINIC PC', 'Win10', 'WS-GPI53', '1C-1B-0D-DF-65-B0', '192.168.5.19', 1, ''),
(29, 'Administration', 'Dekstop ', 'Interpreter PC', 'Win10', 'C2110-269', '40-8D-5C-D1-64-0F', '192.168.5.15', 1, ''),
(30, 'Administration', 'Dekstop ', 'Aileen Domo', 'Win10', 'WS-GPI198', '74-27-EA-B3-4F-80', '192.168.5.32', 1, 'mis.staff@glory.com.ph'),
(31, 'Administration', 'Dekstop ', 'Antonio Negrite', 'Win10', 'C2207-034', '84-A9-3E-72-3A-C9', '192.168.5.37', 0, ''),
(32, 'Administration', 'Dekstop ', 'Tricy Ann Escamillas', 'Win10', 'WS-GPI274', 'E0-D5-5E-99-42-62', '192.168.60.247', 1, ''),
(33, 'Administration', 'Dekstop ', 'Cedrick James Orozo', 'Win10', 'C2210-176', 'E0-D5-5E-35-E7-2E', '192.168.60.53', 1, 'mis.dev@glory.com.ph'),
(34, 'Administration', 'Laptop', 'John Lord Alonzo', 'Win10', 'C2202-009', 'C8-5A-CF-76-40-DA', '192.168.5.3', 1, ''),
(35, 'Administration', 'Laptop', 'Clinic', 'Win10', 'C2110-178', 'D0-C5-D3-26-21-E4', 'Dynamic', 1, ''),
(36, 'Administration', 'Laptop', 'Rose Ann Alega', 'Win11', 'C2202-012', '14-13-33-41-4f-79', 'Dynamic', 1, ''),
(37, 'Administration', 'SERVER', 'Payroll Server', 'Win7', 'GPI-SVRPAYROLL', '00-50-56-B4-05-D3', '192.168.5.103', 1, ''),
(38, 'Administration', 'Dekstop ', 'Francisco Ramirez', 'Win7', 'C2106-162', '1C-1B-0D-32-CC-F1', '192.168.5.12', 1, ''),
(39, 'Administration', 'Dekstop ', 'Jonathan Natuel', 'Win7', 'WS-GPI195', '38-60-77-0E-38-EE', '192.168.60.149', 1, ''),
(40, 'Administration', 'Dekstop ', 'FEM Engineer', 'Win7', 'C2106-006', '40-8D-5C-61-05-18', '192.168.60.139', 0, ''),
(41, 'Administration', 'Dekstop ', 'Elaine Sangalang', 'Win7', 'WS-GPI13', '70-8B-CD-55-E0-A8', '192.168.5.17', 1, ''),
(42, 'Administration', 'Dekstop ', 'Ralph Gabriel Parma', 'Win7', 'WS-GPI15', 'BC-EE-7B-9E-45-5D', '192.168.5.11', 1, ''),
(43, 'Administration', 'Dekstop ', 'Charisse Digo', 'Win7', 'WS-GPI273', 'E0-D5-5E-93-D9-BB', '192.168.60.246', 1, ''),
(44, 'Administration', 'Dekstop ', 'Rusitha Audrey Bornasal', 'Win7', 'C2110-190', 'F0-79-59-92-95-84', '192.168.5.7', 1, ''),
(45, 'Administration', 'Dekstop ', 'Ern Clarice Abuloc', 'Win8', 'WS-GPI71', '40-8D-5C-3E-02-F5', '192.168.5.18', 1, ''),
(46, 'Administration', 'SERVER', 'AWMS Server', 'Windows Server', 'GPISVR-AWMS', '00-50-56-B4-20-1A', '192.168.5.117', 1, ''),
(47, 'Administration', 'SERVER', 'DTR Server', 'Windows Server', 'Glory-DTR', '00-50-56-B4-3E-6A', '192.168.5.184', 1, ''),
(48, 'Administration', 'SERVER', 'MIS System', 'Windows Server', 'GPI-WSUS', '00-50-56-B4-6B-FC', '192.168.5.105', 1, ''),
(49, 'Administration', 'SERVER/VM', 'GPI-SVRAD', 'Windows Server', 'GPI-SVRAD', '00-50-56-B4-7F-48', '192.168.5.101', 1, ''),
(50, 'Direct Kaizen Operation', 'Laptop', 'Francisco Lozano', 'Win10', 'GPI-19', '54-E1-AD-00-A2-E9', '192.168.60.64', 1, ''),
(51, 'Direct Kaizen Operation', 'Dekstop ', 'Elmer Bautista', 'Win8', 'WS0GPI173', '54-A0-50-E8-5C-96', '192.168.5.152', 1, ''),
(52, 'Direct Kaizen Operation', 'Dekstop ', 'Manny Herrera', 'Win8', 'C2106-144', '70-8B-CD-58-9B-C1', '192.168.60.160', 1, ''),
(53, 'Direct Kaizen Operation', 'Dekstop ', 'Jaypee Mercado', 'Win8', 'DESKTOP-GEFU97A', 'B8-85-84-AE-82-82', '192.168.5.30', 1, ''),
(54, 'Japanese', 'Laptop', 'Akira Toku', 'Win10', 'WS401-2021-1', '18:47:3d:4b:30:cf', 'Dynamic', 1, ''),
(55, 'Japanese', 'Laptop', 'Tetsuya Hatozaki', 'Win10', 'WS401-2021-6', '1A:47:3D:4B:7F:03', 'Dynamic', 1, ''),
(56, 'Japanese', 'Laptop', 'Tomoyuki Ozawa', 'Win10', 'WS401-2021-4', 'AC:22:0B:2A:F5:C0', 'Dynamic', 1, ''),
(57, 'Japanese', 'Laptop', 'Fumiya Kojima', 'Win10', 'WS401-2021-2', 'D8:5E:D3:51:08:20', 'Dynamic', 1, ''),
(58, 'Japanese', 'Laptop', 'Shigeyuki Fukunaga', 'Win10', 'GMC02433', 'D8:12:65:60:80:IF', 'Dynamic', 1, ''),
(59, 'Parts Inspection', 'Laptop', 'Benjie Paras', 'Win10', 'GPI-PI', '00:2B:67:78:70:58', '192.168.5.9', 1, ''),
(60, 'Parts Inspection', 'Laptop', 'Alvin Benavente ', 'Win10', 'C2110-223', 'D0-C5-D3-25-FE-77', 'Dynamic', 1, ''),
(61, 'Parts Inspection', 'Laptop', 'Ramina Miguel', 'Win7', 'WS-GPIL135', '30-65-EC-41-3E-A5', '192.168.60.123', 1, ''),
(62, 'Parts Inspection', 'Laptop', 'Brenisa Domingo', 'Win7', 'WS-GPIL36', '30-65-EC-41-3E-93', '192.168.60.122', 1, ''),
(63, 'Parts Inspection', 'Laptop', 'Renalyn Mongol', 'Win7', 'WS-GPIL151 ', 'C4-54-44-82-D3-8E', '192.168.60.230', 1, ''),
(64, 'Parts Inspection', 'Dekstop ', 'Lea Besas', 'Win7', 'WS-GPI73', '1C-1B-0D-32-C5-C0', '192.168.60.113', 1, ''),
(65, 'Parts Inspection', 'Dekstop ', 'Mydel Genise', 'Win7', 'WS-GPI199', '40-8D-5C-D3-16-AB', '192.168.60.143', 1, ''),
(66, 'Parts Inspection', 'Dekstop ', 'Liza Ordonez', 'Win7', 'C2106-043', '1C-1B-0D-D9-E8-69', '192.168.60.130', 1, ''),
(67, 'Parts Inspection', 'Dekstop ', 'Merry Bantugan', 'Win7', 'C2203-020', '04-7C-16-16-5F-4B', '192.168.5.46', 1, ''),
(68, 'Parts Inspection', 'Dekstop ', 'Ivy Del Mundo', 'Win7', 'WS-GPI267', '30-9C-23-9C-6E-02', '192.168.60.182', 1, ''),
(69, 'Parts Inspection', 'Dekstop ', 'Ian Jay Jacobo', 'Win7', 'WS-GPI269', '30-9C-23-9C-6E-53', '192.168.60.197', 1, ''),
(70, 'Parts Inspection', 'Dekstop ', 'Melody Odviar', 'Win7', 'C2106-027', '40-8D-5C-D1-64-09', '192.168.5.40', 1, ''),
(71, 'Parts Inspection', 'Dekstop ', 'Jasper Odasco', 'Win7', 'WS-GPI32', 'D0-27-88-7E-7E-7F', '192.168.5.39', 1, ''),
(72, 'Parts Inspection', 'Dekstop ', 'Luche Labanza', 'Win7', 'WS-GPI34', 'D0-27-88-7E-7F-04', '192.168.5.51', 0, ''),
(73, 'Parts Inspection', 'Dekstop ', 'Shaydell Villaraza', 'Win7', 'C2106-137', '74-D0-2B-95-7B-ED', '192.168.60.238', 1, ''),
(74, 'Parts Inspection', 'Dekstop ', 'Jypsy Abad', 'Win7', 'WS-GPI278', 'F8-A9-63-90-E6-20', '192.168.60.135', 1, ''),
(75, 'Parts Inspection', 'Dekstop ', 'Shiela Raquel', 'Win7', 'C2106-033', 'B4-2E-99-DC-F0-54', '192.168.5.49', 1, ''),
(76, 'Parts Inspection', 'Dekstop ', 'Roslyn Manansala', 'Win8', 'WS-GPI235', '1C-1B-0D-28-86-48', '192.168.5.79', 1, ''),
(77, 'Parts Inspection', 'Dekstop ', 'Angelyn Ocampo', 'Win8', 'WS-GPI236', '1C-1B-0D-28-8D-B8', '192.168.5.78', 1, ''),
(78, 'Parts Inspection', 'Dekstop ', 'Mylene Nuera', 'Win8', 'WS-GPI223', '1C-1B-0D-32-CD-33', '192.168.5.68', 1, ''),
(79, 'Parts Inspection', 'Dekstop ', 'Jonaliza Businos ', 'Win8', 'WS-GPI224', '1C-1B-0D-32-CF-64', '192.168.60.114', 1, ''),
(80, 'Parts Inspection', 'Dekstop ', 'No User', 'Win8', 'WS-GPI220', '1C-1B-0D-32-CF-CE', '192.168.5.70', 1, ''),
(81, 'Parts Inspection', 'Dekstop ', 'Shaira Mariz Cada', 'Win8', 'WS-GPI219', '1C-1B-0D-32-D0-3C', '192.168.5.69', 1, ''),
(82, 'Parts Inspection', 'Dekstop ', 'Cherry Manalo', 'Win8', 'WS-GPI218', '1C-1B-0D-38-55-8B', '192.168.5.48', 1, ''),
(83, 'Parts Inspection', 'Dekstop ', 'Corazon Caso', 'Win8', 'WS-GPI221', '1C-1B-0D-38-5A-F6', '192.168.5.71', 1, ''),
(84, 'Parts Inspection', 'Dekstop ', 'Romnell Pulido', 'Win8', 'WS-GPI227', '1C-1B-0D-38-5F-92', '192.168.5.73', 1, ''),
(85, 'Parts Inspection', 'Dekstop ', 'Niestle Quibral', 'Win8', 'WS-GPI234', '1C-1B-0D-38-61-DA', '192.168.5.80', 1, ''),
(86, 'Parts Inspection', 'Dekstop ', 'Maricel Delos Santos', 'Win8', 'WS-GPI229', '1C-1B-0D-38-95-CC', '192.168.5.75', 1, ''),
(87, 'Parts Inspection', 'Dekstop ', 'Wilma Sosa', 'Win8', 'WS-GPI222', '1C-1B-0D-38-9E-B8', '192.168.5.67', 1, ''),
(88, 'Parts Inspection', 'Dekstop ', 'Nova Jane Buenaflor', 'Win8', 'WS-GPI226', '1C-1B-0D-38-9E-BB', '192.168.5.72', 1, ''),
(89, 'Parts Inspection', 'Dekstop ', 'Catherine Marcelo', 'Win8', 'GPI231', '1C-1B-0D-38-9E-DD', '192.168.5.42', 1, ''),
(90, 'Parts Inspection', 'Dekstop ', 'Abegail Pedragosa ', 'Win8', 'WS-GPI228', '1C-1B-0D-38-96-02', '192.168.5.74', 1, ''),
(91, 'Parts Inspection', 'Dekstop ', 'Dave Mark Bermullo', 'Win8', 'PI-GPI183', '40-8D-5C-61-03-40', '192.168.5.54', 1, ''),
(92, 'Parts Inspection', 'Dekstop ', 'Rey Angie Talamisan', 'Win8', 'WS-GPI181', '40-8D-5C-64-02-0A', '192.168.5.56', 1, ''),
(93, 'Parts Inspection', 'Dekstop ', 'Jacklyn Villanueva ', 'Win8', 'WS-GPI190', '40-8D-5C-C1-FB-FA', '192.168.5.61', 1, ''),
(94, 'Parts Inspection', 'Dekstop ', 'Vanissa Garcia', 'Win8', 'PI-GPI201', '40-8D-5C-C1-FC-36', '192.168.5.63', 1, ''),
(95, 'Parts Inspection', 'Dekstop ', 'Emmarie Coyoca', 'Win8', 'PI-GPI202', '40-8D-5C-D3-14-59', '192.168.5.64', 1, ''),
(96, 'Parts Inspection', 'Dekstop ', 'Myla Nuga', 'Win8', 'PI-GPI200', '40-8D-5C-D3-14-5A', '192.168.5.62', 1, ''),
(97, 'Parts Inspection', 'Dekstop ', 'Saria Joy Lopez', 'WIn8', 'WS-GPI204', '40-8D-5C-D3-14-5B', '192.168.5.66', 1, ''),
(98, 'Parts Inspection', 'Dekstop ', 'Nelyn Sitombo', 'Win8', 'WS-GPI189', 'E0-D5-5E-99-42-28', '192.168.5.57', 1, ''),
(99, 'Parts Inspection', 'Dekstop ', 'Jenina Ibas', 'Win8', 'C2110-226', '74-D0-2B-95-7B-EB', '192.168.60.110', 1, ''),
(100, 'Parts Inspection', 'Dekstop ', 'Caselyn Tardio ', 'Win8', 'WS-GPI192', '40-8D-5C-C1-FB-FB', '192.168.60.111', 1, ''),
(101, 'Parts Inspection', 'Dekstop ', 'Ruth Esther Gabrielle ', 'Win8', 'WS-GPI237', '1C-1B-0D-28-86-3F', '192.168.5.77', 1, ''),
(102, 'Parts Inspection', 'Dekstop ', 'Rosemher Sugui', 'Win8', 'WS-GPI233', '1C-1B-0D-38-A6-56', '192.168.5.81', 0, ''),
(103, 'Parts Inspection', 'Dekstop ', 'Anita Dela Cruz', 'Win8', 'WS-GPI230', '1C-1B-0D-32-CF-3C', '192.168.5.158', 1, ''),
(104, 'Parts Inspection', 'Dekstop ', 'PI Staff', 'Win8', 'WS-GPI203', '40-8D-5C-D3-00-96', '192.168.5.65', 1, ''),
(105, 'Parts Inspection', 'Dekstop ', 'Rosemarie Jinky Manalo', 'Win8', 'WS-GPI209', '40-8D-5C-FB-B3-8E', '192.168.5.47', 1, ''),
(106, 'Parts Inspection', 'Dekstop ', 'PI Staff', 'Win8', 'WS-GPI185', '40-8D-5C-62-D4-35', '192.168.5.52', 0, ''),
(107, 'Parts Production', 'Desktop', 'Osoyos, Shielo Joy / MARICRIS', 'Win 10', 'CAD-PC', '00:4E:01:AC:19:44', '172.24.33.120', 1, ''),
(108, 'Parts Production', 'Dekstop ', 'Melvin Beltran', 'Win10', 'C2111-289', '04-0E-3C-1F-1B-37', '172.24.33.128', 1, ''),
(109, 'Parts Production', 'Dekstop ', 'Analyn Cadocoy', 'Win10', 'C2111-291', '04-0E-3C-1F-1B-5A', '172.24.33.141', 1, ''),
(110, 'Parts Production', 'Dekstop ', 'Shielo Joy Osoyos', 'Win10', 'WS1204-2021', '80-E8-2C-FB-67-88', '172.24.33.150', 1, ''),
(111, 'Parts Production', 'Dekstop ', 'Shielo Joy Osoyos', 'Win10', 'C2111-285', '9C-7B-EF-22-6C-DA', '172.24.33.191', 1, ''),
(112, 'Parts Production', 'Dekstop ', 'Rizza Becious', 'Win10', 'WS-STGPI187', 'D0-37-45-06-D6-77', '172.24.35.70', 1, ''),
(113, 'Parts Production', 'Dekstop ', 'Roel Magat', 'Win10', 'C2202-006', 'D0-67-E5-19-50-A4', '172.24.33.85', 1, ''),
(114, 'Parts Production', 'Dekstop ', 'Michelle Llamera', 'Win10', 'C2111-293', '58-D5-6E-01-3E-1D', '172.24.33.111', 1, ''),
(115, 'Parts Production', 'Laptop', 'Michelle Malubay', 'Win11', 'LAPTOP-IQ6CUUVD', '00-2B-67-78-7D-C6', 'Dynamic', 1, ''),
(116, 'Parts Production', 'Dekstop ', 'Maricris Lerit', 'Win11', 'ABC351CM22', '9C-7B-EF-22-F7-9C', '172.24.33.151', 1, ''),
(117, 'Parts Production', 'Dekstop ', 'Christopher Trajico', 'Win7', 'C2111-281', '00-27-0E-16-A7-23', '172.24.33.115', 1, ''),
(118, 'Parts Production', 'Dekstop ', 'Ryan Rolle', 'Win7', 'WS-GPI-ST117', '1C-1B-0D-32-CD-32', '172.24.33.117', 1, ''),
(119, 'Parts Production', 'Dekstop ', 'Michelle Malubay', 'Win7', 'C2208-035', '40-8D-5C-D3-1F-59', '172.24.33.106', 1, ''),
(120, 'Parts Production', 'Dekstop ', 'Kristel Rafallo', 'Win7', 'WS-GPI-ST122', '7C-C2-C6-0A-46-FB', '172.24.33.223', 1, ''),
(121, 'Parts Production', 'Dekstop ', 'Jacquelyn Gabato', 'Win7', 'WS-GPI-ST110', 'D0-27-88-54-85-69', '172.24.33.110', 1, ''),
(122, 'Parts Production', 'Dekstop ', 'Katarina Cuevas', 'Win7', 'C2111-287', 'D0-27-88-54-85-CF', '172.24.33.112', 1, ''),
(123, 'Parts Production', 'Dekstop ', 'Ma. Jesusa Garcia', 'Win7', 'WS-GPI ST105', 'E0-D5-5E-58-46-7B', '172.24.33.135', 1, ''),
(124, 'Parts Production', 'Dekstop ', 'PM Staff', 'Win7', 'WS-GPI-ST113', 'BC-EE-7B-9E-05-BE', '172.24.33.113', 1, ''),
(125, 'Parts Production', 'Dekstop ', 'Ardina Anthony ', 'Win7', 'WS-GPI42', 'D0-37-45-A0-BC-FF', '172.24.33.142', 1, ''),
(126, 'Parts Production', 'Dekstop ', 'Joya Reynan Karl', 'Win7', 'GLORY-PC', '7C-C2-C6-4B-6A-F3', '172.24.33.155', 1, ''),
(127, 'Parts Production', 'Dekstop ', 'Phillip Cabuco', 'Win8', 'WS-GPI-ST133', '40-8D-5C-CB-D1-49', '172.24.33.133', 1, ''),
(128, 'PPIC', 'Laptop', 'Mario Laforteza', 'Win10', 'C2212-045', 'F8-9E-94-02-89-AB', 'Dynamic', 1, ''),
(129, 'PPIC', 'Laptop', 'Chona Cortez', 'Win10', 'C2103-021', 'C8-5A-CF-75-0F-4A', '192.168.60.195', 1, ''),
(130, 'PPIC', 'Dekstop ', 'Mary Jane Pacuan', 'Win10', 'C2106-088', 'E0-D5-5E-EA-DD-8C', '192.168.5.85', 1, ''),
(131, 'PPIC', 'Dekstop ', 'Caludine Joy', 'Win10', 'C2106-087', 'E0-D5-5E-E9-72-90', '192.168.5.31', 1, ''),
(132, 'PPIC', 'Dekstop ', 'Klarence Santiago', 'Win10', 'C2106-147', '00-E0-70-0E-D3-FE', '192.168.60.82', 1, ''),
(133, 'PPIC', 'Dekstop ', 'Alelie Mae Tamio', 'Win10', 'C2106-076', 'E0-D5-5E-79-79-8B', '192.168.60.98', 1, ''),
(134, 'PPIC', 'Dekstop ', 'Marlyn Mendez', 'Win10', 'C2106-075', 'C8-9C-DC-BF-6F-2F', '192.168.5.93', 1, ''),
(135, 'PPIC', 'Dekstop ', 'Naomi Calderon', 'Win10', 'C2110-214', 'E0-05-5E-3E-B5-70', '192.168.60.58', 1, ''),
(136, 'PPIC', 'Dekstop ', 'Jamie Domol', 'Win10', 'C2106-113', '40-8D-5C-64-00-12', '192.168.60.61', 1, ''),
(137, 'PPIC', 'Dekstop ', 'Jonnalyn Maigue', 'Win7', 'C2106-081', '30-9C-23-9C-6E-BA', '192.168.5.89', 1, ''),
(138, 'PPIC', 'Dekstop ', 'Abegail Torres', 'Win7', 'C2106-077', '1C-1B-0D-38-5F-4E', '192.168.5.94', 1, ''),
(139, 'PPIC', 'Dekstop ', 'Maricar Gummayao', 'Win7', 'WS-GPI152', '50-E5-49-CA-48-B2', '192.168.5.84', 1, ''),
(140, 'PPIC', 'Dekstop ', 'Janine Barliso', 'Win7', 'WS-GPI165', 'B8-97-5A-4C-09-B0', '192.168.60.225', 1, ''),
(141, 'PPIC', 'Dekstop ', 'Sherelyn Bunag', 'Win7', 'C2106-079', 'BC-EE-7B-99-DB-F7', '192.168.5.83', 1, ''),
(142, 'PPIC', 'Dekstop ', 'Ernald Fagutan /Ace Lyola', 'Win7', 'WS-GPI49', 'D0-27-88-54-85-6D', '192.168.5.87', 1, ''),
(143, 'PPIC', 'Dekstop ', 'Elardie Mendoza', 'Win7', 'WS-GPI285', 'D0-27-88-77-6E-8D', '192.168.60.73', 1, ''),
(144, 'PPIC', 'Dekstop ', 'Luisa Palomeras', 'Win7', 'C2302-001', '74-56-3C-13-EE-4B', '192.168.5.44', 1, ''),
(145, 'PPIC', 'Dekstop ', 'PM Staff', 'Win7', 'C2106-084', 'D8-50-E6-D2-60-09', '192.168.5.91', 1, ''),
(146, 'PPIC', 'Dekstop ', 'Sheryll Ramirez', 'Win7', 'C2205-030', 'E0-D5-5E-3A-06-A7', '192.168.5.97', 0, ''),
(147, 'PPIC', 'Dekstop ', 'Eries Cabrera', 'Win7', 'C2106-080', 'D0-27-88-54-86-DE', '192.168.5.96', 1, ''),
(148, 'PPIC', 'Dekstop ', 'Nestor Umali', 'Win7', 'WS-GPI257', 'E0-D5-5E-58-46-97', '192.168.60.157', 1, ''),
(149, 'PPIC', 'Dekstop ', 'Vilma Almendras', 'Win7', 'WS-GPI258', 'E0-D5-5E-58-4C-13', '192.168.60.159', 1, ''),
(150, 'Production 1', 'Laptop', 'Lemuel Semillano(thinkpad)', 'Win10', 'GPI-PROD', '08-D2-3E-FC-A3-23', 'Dynamic', 1, ''),
(151, 'Production 1', 'Laptop', 'Jaysar Igaya/RBW200', 'Win10', 'DESKTOP-VEJ6MMU', '2C-3B-70-1F-01-25', 'Dynamic', 1, ''),
(152, 'Production 1', 'Dekstop ', 'Robert Cabangunay', 'Win7', 'WS-GPI67', '00-1E-8C-C9-CA-DC', '192.168.60.99', 1, ''),
(153, 'Production 1', 'Dekstop ', 'Eva Evangelista', 'Win7', 'C2110-196', '10-BF-48-B7-6E-32', '192.168.5.154', 1, ''),
(154, 'Production 1', 'Dekstop ', 'Wenna Cornejo', 'Win7', 'WS-GPI216', '1C-1B-0D-21-CC-04', '192.168.5.157', 1, ''),
(155, 'Production 1', 'Dekstop ', 'Malen Tondeng', 'Win7', 'C2106-044', '1C-1B-0D-21-CC-04', '192.168.60.241', 0, ''),
(156, 'Production 1', 'Dekstop ', 'Lemuel Semillano ', 'Win7', 'WS-GPI250', '1C-1B-0D-9A-A5-B8', '192.168.5.164', 1, ''),
(157, 'Production 1', 'Dekstop ', 'Ronel Alisangco', 'Win7', 'WS-GPI253', '1C-1B-0D-D9-EA-46', '192.168.60.183', 0, ''),
(158, 'Production 1', 'Dekstop ', 'Marissa Canto', 'Win7', 'WS-GPI252', '1C-1B-0D-DF-65-F7', '192.168.60.228', 1, ''),
(159, 'Production 1', 'Dekstop ', 'Michael Villasanta', 'Win7', 'WS-GPI197', '40-8D-5C-D1-63-E9', '192.168.5.156', 1, ''),
(160, 'Production 1', 'Dekstop ', 'Aris Jose', 'Win7', 'WS-GPI270', 'E0-D5-5E-3E-B5-7B', '192.168.5.162', 1, ''),
(161, 'Production 1', 'Dekstop ', 'Fernaliza Bernal', 'Win7', 'WS-GPI181', '44-87-FC-88-C0-EB', '192.168.60.11', 1, ''),
(162, 'Production 1', 'Dekstop ', 'Felina Hernandez', 'Win7', 'WS-GPI263', 'E0-D5-5E-93-D9-BF', '192.168.60.161', 1, ''),
(163, 'Production 1', 'Dekstop ', 'Jasure Vargas', 'Win7', 'WS-GPI69', '70-4D-7B-2C-A8-D7', '192.168.60.218', 1, ''),
(164, 'Production 1', 'Dekstop ', 'Joy Quilantang', 'Win7', 'WS-GPI145', 'AC-22-0B-2B-87-49', '192.168.60.203', 1, ''),
(165, 'Production 1', 'Dekstop ', 'Dana Pelina', 'Win7', 'WS-GPI170-PC', 'AC-22-0B-2B-07-43', '192.168.5.153', 0, ''),
(166, 'Production 1', 'Dekstop ', 'Jonar Mojica', 'Win7', 'C2106-049', 'B4-2E-99-64-0E-B4', '192.168.5.240', 1, ''),
(167, 'Production 1', 'Dekstop ', 'Sir Fukunaga Desktop 2 (webcam', 'Win7', 'WS-GPI260', '', '192.168.60.137', 0, ''),
(168, 'Production 1', 'Dekstop ', 'Deserie Baldisimo', 'Win7', 'Production Test', 'EC-F4-BB-0F-A4-6A', '192.168.60.116', 1, ''),
(169, 'Production 1', 'Laptop', 'Jonar Mojica', 'Win8', 'DESKTOP-5HHA732', 'D4-6D-6D-45-38-0F', 'Dynamic', 0, ''),
(170, 'Production 2', 'Laptop', 'Dina Lisboa', 'Win10', 'GPI-PROD 2', 'C8-58-C0-96-22-0B', 'Dynamic', 0, ''),
(171, 'Production 2', 'Dekstop ', 'Lanie Bagon/GLR', 'Win10', 'WS-GPI292', '18-C0-4D-56-A0-22', '192.168.5.131', 1, ''),
(172, 'Production 2', 'Dekstop ', 'Noemi Roxas', 'Win10', 'WS-GPI276', 'E0-D5-5E-9D-06-71', '192.168.60.59', 1, ''),
(173, 'Production 2', 'Dekstop ', 'Emyria Sarte', 'Win10', 'C2106-068', 'E0-D5-5E-79-85', '192.168.5.167', 1, ''),
(174, 'Production 2', 'Dekstop ', 'Dina Lisboa', 'Win10', 'C2106-096', '74-D4-35-F6-0A-81', '192.168.5.171', 1, ''),
(175, 'Production 2', 'Dekstop ', 'Marvin Ilao', 'Win10', 'C2106-128', 'D8-5E-D3-DF-DC-2F', '192.168.60.74', 1, ''),
(176, 'Production 2', 'Dekstop ', 'Elma Culla', 'Win10', 'C2106-031', 'E0-D5-5E-7D-F1-2D', '192.168.5.130', 1, ''),
(177, 'Production 2', 'Dekstop ', 'Cherrylyn Deseo', 'Win10', 'WS-GPI64i', 'E0-D5-5E-79-84-70', '192.168.60.108', 1, ''),
(178, 'Production 2', 'Dekstop ', 'Old PC Sir Azuma to GPI', 'Win10', 'C2106-046', 'E0-D5-5E-35-E6-AC', '192.168.5.13', 1, ''),
(179, 'Production 2', 'Dekstop ', 'Marvin Ilao New', 'Win10', 'C2210-045', 'D8-5E-D3-DF-CB-67', '192.168.5.43', 1, ''),
(180, 'Production 2', 'Dekstop ', 'Edwin Tolentino', 'Win7', 'WS-GPI80', '10-78-D2-DA-C1-A8', '192.168.60.150', 1, ''),
(181, 'Production 2', 'Dekstop ', 'Federico Dealagdon', 'Win7', 'WS-GPI27', '70-8B-CD-58-21-13', '192.168.60.71', 1, ''),
(182, 'Production 2', 'Dekstop ', 'Merry Beth cinco', 'Win7', 'C2106-070', '1C-1B-0D-99-9F-7D', '192.168.5.177', 1, ''),
(183, 'Production 2', 'Dekstop ', 'Jeany Lynn Bucayan', 'Win7', 'C2106-136', '1C-1B-0D-99-D5-2E', '192.168.60.79', 1, ''),
(184, 'Production 2', 'Dekstop ', 'Ruben Delgado', 'Win7', 'WS-GPI249', '1C-1B-0D-99-7A-F0', '192.168.60.103', 1, ''),
(185, 'Production 2', 'Dekstop ', 'Jonalyn Rivamonte', 'Win7', 'WS-GPI261', 'E0-D5-5E-58-47-A3', '192.168.60.77', 1, ''),
(186, 'Production 2', 'Dekstop ', 'Chayrena Ramos', 'Win7', 'C2106-130', '1C-1B-0D-DF-65-A5', '192.168.60.173', 1, ''),
(187, 'Production 2', 'Dekstop ', 'Rey Vidal', 'Win7', 'C2110-212', '70-8B-CD-55-E2-9E', '192.168.60.118', 1, ''),
(188, 'Production 2', 'Dekstop ', 'Hazel Ann Dela Torre', 'Win7', 'C2106-090', '74-D0-2B-CA-CE-5A', '192.168.60.168', 1, ''),
(189, 'Production 2', 'Dekstop ', 'Nicky Lipata', 'Win7', 'WS-GPI256', '1C-1B-0D-DF-65-A3', '192.168.60.25', 1, ''),
(190, 'Production 2', 'Dekstop ', 'Scanning', 'Win7', 'C2106-122', 'AC-22-0B-80-5F-87', '192.168.60.76', 1, ''),
(191, 'Production 2', 'Dekstop ', 'Haydee Custodio', 'Win7', 'C2106-093', '40-8D-5C-FC-4D-76', '192.168.60.149', 1, ''),
(192, 'Production 2', 'Dekstop ', 'Wennie Naungayan', 'Win8', 'C2106-095', '54-A0-50 -E8-5D-E9', '192.168.5.170', 1, ''),
(193, 'Production 2', 'Dekstop ', 'Noemi Roxas', 'Win8', 'C2110-189', '1C-1B-0D-32-CC-EF', '192.168.5.166', 1, ''),
(194, 'Production 2', 'Dekstop ', 'Leivic Luig', 'Win8', 'WS-GPI38', '94-DE-80-B3-FE-DC', '192.168.60.174', 1, ''),
(195, 'Production 2', 'Dekstop ', 'Rey Armillo', 'Win8', 'C2106-125', 'F0-79-59-92-95-B6', '192.168.5.174', 1, ''),
(196, 'Prod Support', 'Dekstop ', 'Yori Tagle', 'Win8', 'DESKTOP-3MM0TCT', 'D0-C5-D3-25-FE-4B', 'Dynamic', 1, ''),
(197, 'Prod2', 'Laptop', 'P2 Staff', 'Win8', 'P2Technician-PC', '08-3E-8E-24-8A-6D', '172.22.37.156', 1, ''),
(198, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss126', '74-70-FD-D6-D8-BE', '172.22.37.228', 1, ''),
(199, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss127', '74-70-FD-D6-D6-ED', '172.22.37.70', 0, ''),
(200, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss213', '84-B8-B8-1B-4E-96', '172.22.37.195', 0, ''),
(201, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss114', '74-70-FD-D6-D4-68', '172.22.37.239', 1, ''),
(202, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss9', '68-EC-C5-97-95-2E', '172.22.37.45', 1, ''),
(203, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss118', '74-70-FD-D6-09-22', '172.22.36.254', 0, ''),
(204, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'DESKTOP-OHVO9O3', '74-70-FD-D6-D7-42', '172.22.37.10', 1, ''),
(205, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss65', '74-70-FD-D6-D7-83', '172.22.37.13', 1, ''),
(206, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss125', '74-70-FD-D6-D8-4C', '172.22.37.187', 1, ''),
(207, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss13', '7C-2A-31-54-24-4B', '172.22.37.192', 1, ''),
(208, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss63', '7C-2A-31-07-2A-B5', '172.22.37.2', 1, ''),
(209, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss113', '74-70-FD-D6-D9-1D', '172.22.37.231', 1, ''),
(210, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss31', '7C-2A-31-54-18-A2', '172.22.37.232', 1, ''),
(211, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss138', '4A-A5-B0-A8-76-4B', '172.22.37.253', 1, ''),
(212, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss92', '7C-2A-31-53-CD-ED', '172.22.37.27', 1, ''),
(213, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss43', '7C-2A-31-4-CD-ED', '172.22.37.28', 1, ''),
(214, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss10', '68-EC-C5-98-3B-86', '172.22.37.29', 1, ''),
(215, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss82', '7C-2A-31-07-2A-B0', '172.22.37.3', 1, ''),
(216, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss78', '74-70-7D-80-F8-72', '172.22.37.30', 1, ''),
(217, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss98', '7C-2A-31-54-18-C0', '172.22.37.31', 1, ''),
(218, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss74', '74-70-FD-80-FA-F2', '172.22.37.32', 1, ''),
(219, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss136', '74-70-FD-D6-D8-B5', '172.22.37.38', 1, ''),
(220, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss12', '7C-2A-31-54-2A-DB', '172.22.37.4', 1, ''),
(221, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss67', '7C-2A-31-07-25-01', '172.22.37.5', 1, ''),
(222, 'Production 1', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss115', '7C-2A-31-54-18-E8', '172.22.37.6', 1, ''),
(223, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'DESKTOP-3NT2049', '7C-2A-31-54-23-33', '172.22.37.64', 1, ''),
(224, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'DESKTOP-LKM4H67', '7C-2A-31-54-26-30', '172.22.37.68', 1, ''),
(225, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gp-gpss91', '7C-2A-31-54-2A-C8', '172-22.37.83', 1, ''),
(226, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi- gpss2', '68-EC-C-97-94-E7', '172.22.36.11', 1, ''),
(227, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss100', '7C-2A-31-54-IE-FC', '172.22.37.77', 1, ''),
(228, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss139', '74-70-FD-D6-D8-AF', '172.22.37.58', 1, ''),
(229, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss14', '7C-2A-31-54-18-E3', '172.22.37.81', 1, ''),
(230, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss16', '7C-2A-31-54-24-5A', '172.22.36.15', 1, ''),
(231, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss19', '7C-2A-31-54-1B-A4', '172.22.36.16', 1, ''),
(232, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss20', '7C-2A-31-54-23-BA', '172.22.36.9', 1, ''),
(233, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss21', '7C-2A-31-54-19-52', '172.22.37.66', 1, ''),
(234, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss23', '7C-2A-31-54-23-1A', '172.22.37.62', 1, ''),
(235, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss27', '7C-2A-31-54-27-C5', '172.22.37.82', 1, ''),
(236, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss37', '7C-2A-31-54-23-0B', '172.22.37.60', 1, ''),
(237, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss38', '7C-2A-31-54-24-7D', '172.22.37.67', 1, ''),
(238, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss6', '68-EC-C5-97-A3-A1', '172.22.37.43', 1, ''),
(239, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss7', '38-DE-AD-3F-7B-22', '172.22.36.13', 1, ''),
(240, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss73', '74-70-FD-D6-D3-D8', '172.22.36.130', 0, ''),
(241, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss93', '7C-24-31-54-23-2E', '172.22.37.70', 0, ''),
(242, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss26', '7C-2A-31-54-1F-1E', '172.22.37.105', 1, ''),
(243, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss32', '7C-2A-31-54-16-54', '172.22.37.80', 1, ''),
(244, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss41', '7C-2A-31-54-17-85', '172.22.37.106', 1, ''),
(245, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'DESKTOP-T2AIECR', '74-70-FD-06-08-A5', '172.22.37.21', 1, ''),
(246, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss101', '7C-2A-31-54-23-6A', '172.22.37.110', 1, ''),
(247, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss103', '7C-2A-31-54-27-89', '172.22.37.14', 1, ''),
(248, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss104', '7C-2A-31-54-29-5A', '172.22.38.211', 1, ''),
(249, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss105', '7C-2A-31-54-24-69', '172.22.36.75', 1, ''),
(250, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss106', '7C-2A-31-54-26-FD', '172.22.36.134', 1, ''),
(251, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss107', '7C-2A-31-54-18-25', '172.22.37.87', 1, ''),
(252, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss109', '7C-2A-31-07-2A-BA', '172.22.37.119', 1, ''),
(253, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss11', '7C-2A-31-54-1B-9B', '172.22.36.133', 0, ''),
(254, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss111', '74-70-FD-D6-D5-E9', '172.22.37.222', 0, ''),
(255, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss112', '7C-2A-31-07-24-94', '172.22.37.16', 1, ''),
(256, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss116', '74-70-FD-D6-D9-22', '172.22.36.118', 1, ''),
(257, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss117', '7C-2A-31-07-2A-8D', '172.22.37.24', 1, ''),
(258, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss118', '7C-2A-31-07-24-B6', '172.22.37.104', 1, ''),
(259, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss119', '7C-21-31-07-29-20', '172.22.37.86', 1, ''),
(260, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss120', '7C-2A-32-07-25-0B', '172.22.36.131', 1, ''),
(261, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss122', '74-70-FD-D6-D5-53', '172.22.37.121', 1, ''),
(262, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss123', '74-70-FD-D6-D7-5B', '172.22.37.85', 1, ''),
(263, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss130', '74-70-FD-D6-D8-91', '172.22.38.209', 1, ''),
(264, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss131', '74-70-FD-D6-D7-CE', '172.22.38.208', 1, ''),
(265, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss137', '7C-2A-31-07-24-58', '172.22.38.213', 1, ''),
(266, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss140', '74-70-FD-D6-D4-8B', '172.22.37.103', 1, ''),
(267, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss15', '7C-2A-31-54-17-C1', '172.22.36.7', 1, ''),
(268, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss17', '7C-2A-31-54-2A-5F', '172.22.36.80', 1, ''),
(269, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss24', '7C-2A-31-54-1B-B9', '172.22.36.21', 1, ''),
(270, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss25', '7C-2A-31-54-18-07', '172.22.37.79', 1, ''),
(271, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss28', '7C-2A-31-54-23-BF', '172.22.37.107', 1, ''),
(272, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss29', '7C-2A-31-54-1F-4B', '172.22.37.84', 1, ''),
(273, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss3', '6A-E9-8D-EC-29-F0', '172.22.36.6', 1, ''),
(274, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss34', '7C-2A-31-54-16-13', '172.22.37.61', 1, ''),
(275, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss36', '7C-2A-31-54-27-B6', '172.22.36.5', 1, ''),
(276, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss4', '68-EC-C5-98-37-E4', '172.22.36.19', 1, ''),
(277, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss42', '7C-2A-31-54-23-6F', '172.22.36.8', 1, ''),
(278, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss44', '7C-2A-31-54-2B-0D', 'Dynamic', 0, ''),
(279, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss45', '7C-2A-31-54-27-93', '172.22.37.78', 1, ''),
(280, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss46', '7C-2A-31-54-24-46', '172.22.37.118', 0, ''),
(281, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss47', '7C-2A-31-54-27-C0', '172.22.37.117', 1, ''),
(282, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss48', '37-2A-31-54-18-AC', '172.22.38.212', 1, ''),
(283, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss49', '7C-2A-31-54-15-FF', '172.22.36.43', 1, ''),
(284, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss5', '68-EC-C5-97-94-97', '172.22.36.17', 1, ''),
(285, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss50', '7C-2A-31-54-28-88', '172.22.37.225', 0, ''),
(286, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss51', '7C-2A-31-07-24-62', '172.22.36.18', 1, ''),
(287, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss52', '74-70-FD-D6-D6-C5', '172.22.37.20', 1, ''),
(288, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss53', '74-70-FD-D6-D8-23', '172.22.37.25', 1, ''),
(289, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss54', '74-70-FD-D6-D5-B7', '172.22.37.59', 1, ''),
(290, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss57', '7C-2A-31-07-28-F9', '172.22.37.65', 1, ''),
(291, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss58', '74-70-FD-D6-D7-47', '172.22.37.18', 1, ''),
(292, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss59', '74-70-FD-D6-D5-CB', '172.22.37.108', 1, ''),
(293, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss60', '74-70-FD-D6-D7-A6', '172.22.37.36', 1, ''),
(294, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss61', '74-70-FD-D6-D5-44', '172.22.37.19', 1, ''),
(295, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss62', '74-70-FD-D6-D8-33', '172.22.37.4', 1, ''),
(296, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss66', '74-70-FD-D6-D7-97', '172.22.37.63', 1, ''),
(297, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss68', '74-70-FD-D6-D6-98', '172.22.37.114', 1, ''),
(298, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss69', '74-70-FD-D6-D6-43', '172.22.36.127', 1, ''),
(299, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss70', '74-70-FD-D6-D9-13', '172.22.37.111', 1, ''),
(300, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss71', '7C-2A-31-07-24-AC', '172.22.36.128', 1, ''),
(301, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss72', '74-70-FD-D6-D6-2F', '172.22.36.146', 1, ''),
(302, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss77', '7C-2A-31-07-27-EF', '172.22.36.136', 1, ''),
(303, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss79', '7C-2A-31-07-20-D3', '172.22.36.135', 1, ''),
(304, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss8', '68-EC-C5-98-37-7B', '172.22.36.4', 1, ''),
(305, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss81', '7C-2A-31-07-24-75', '172.22.37.124', 1, ''),
(306, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss83', '7C-2A-31-07-28-E4', '172.22.36.139', 1, ''),
(307, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss84', '74-70-FD-D6-D7-D3', '172.22.38.203', 1, ''),
(308, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss88', '74-70-FD-D6-D7-A2', '172.22.38.103', 0, ''),
(309, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss90', '74-70-FD-D6-D8-14', '172.22.37.221', 1, ''),
(310, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpigpss91', '7C-2A-31-54-2A-C7', '172.22.36.58', 0, ''),
(311, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss94', '7C-2A-31-54-18-3A', '172.22.36.10', 1, ''),
(312, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss95', '7C-2A-31-54-28-8D', '172.22.36.12', 1, ''),
(313, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss96', '7C-2A-31-54-23-E2', '172.22.36.14', 1, ''),
(314, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss97', '7C-2A-31-54-17-77', '172.22.37.34', 1, ''),
(315, 'Production 2', 'Tablet', 'Production Staff', 'Win10', 'gpi-gpss99', '7C-2A-31-54-23-E7', '172.22.37.109', 1, ''),
(316, 'Production 2', 'Tablet', 'Production Staff', 'Win8', 'gpi-gpss87', '4A-AE-E7-AC-47-CB', '172.22.37.220', 1, ''),
(317, 'Production Support', 'Laptop', 'Jinelyn Sabejon', 'Win10', 'WS-GPIL21', 'AC-ED-5C-53-56-7E', 'Dynamic', 1, ''),
(318, 'Production Support', 'Dekstop ', 'Sherilyn Barron', 'Win10', 'C2106-146', 'B4-2E-99-00-97-D2', '192.168.60.43', 1, ''),
(319, 'Production Support', 'Dekstop ', 'Marjorie Catabay', 'Win10', 'C2106-150', 'B4-2E-99-00-9D-C7', '192.168.60.46', 0, ''),
(320, 'Production Support', 'Dekstop ', 'Digna Gonzales', 'Win7', 'C2106-091', '70-8B-CD-55-E2-05', '192.168.60.56', 1, ''),
(321, 'Production Support', 'Dekstop ', 'Justine Saliva', 'Win7', 'C2106-165', '1C-1B-0D-28-8E-BB', '192.168.60.75', 1, ''),
(322, 'Production Support', 'Dekstop ', 'Justine Saliva', 'Win7', 'C2106-164', 'D0-27-88-77-6E-8E', '192.168.5.178', 1, ''),
(323, 'Production Support', 'Dekstop ', 'Rose Bella Austria', 'Win7', 'C2106-167', '40-8D-5C-6E-F0-47', '192.168.5.205', 0, ''),
(324, 'Production Support', 'Dekstop ', 'John Yuri Tagle', 'Win7', 'C2106-148', '50-46-5D-67-9C-AA', '192.168.5.41', 1, ''),
(325, 'Production Support', 'Dekstop ', 'Procious Mae Cudiamat', 'Win7', 'C2106-166', '54-A0-50-E8-5E-42', '192.168.5.207', 0, ''),
(326, 'Production Support', 'Dekstop ', 'Annalyn Pagatpat', 'Win7', 'C2106-109', 'BC-EE-7B-9E-45-1E', '192.168.60.204', 0, ''),
(327, 'Production Support', 'Dekstop ', 'Checksheet PC', 'Win7', 'C2303-003', '74-56-3C-1A-1F-81', '192.168.5.202', 1, ''),
(328, 'Production Support', 'Dekstop ', 'Sherilyn Barron', 'Win7', 'WS-GPI207', '40-8D-5C-6E-F1-11', '192.168.60.106', 0, ''),
(329, 'Production Support', 'Dekstop ', 'Cherry Pinpin', 'Win7', 'C2110-185', '04-0E-3C-10-E3-C4', '192.168.5.204', 1, ''),
(330, 'Production Support', 'Dekstop ', 'Anjelica Mendoza', 'Win8', 'C2106-118', '1C-1B-0D-38-5F-C3', '192.168.60.2', 1, ''),
(331, 'Production Technology', 'Laptop', 'Nolieson Catigan', 'Win10', 'GLORY-PRODTECH', 'C8-58-C0-96-28-D2', 'Dynamic', 1, ''),
(332, 'Production Technology', 'Dekstop ', 'Ranelyn Castro', 'Win10', 'ecadgpi01', 'A4-BB-6D-AC-EF-5F', '192.168.5.160', 1, ''),
(333, 'Production Technology', 'Dekstop ', 'Nolieson Catigan', 'Win10', 'WS-GPI59', 'E0-D5-5E-3F-38-61', '192.168.60.213', 1, ''),
(334, 'Production Technology', 'Dekstop ', 'Jessa Escultura', 'Win7', 'ecadgpi02', 'A4-BB-6D-AD-39-87', '192.168.5.26', 0, ''),
(335, 'Production Technology', 'Dekstop ', 'Roan Mae Bermas', 'Win7', 'C2106-052', 'D8-50-E6-D2-60-02', '192.168.60.3', 1, ''),
(336, 'Production Technology', 'Dekstop ', 'Paulo Estrellano', 'Win7', 'C2106-051', '1C-1B-0D-95-DF-A2', '192.168.60.54', 0, ''),
(337, 'Production Technology', 'Dekstop ', 'Carlito Magpatoc', 'Win8', 'C2106-115', '40-8D-5C-FB-A3-1B', '192.168.60.4', 1, ''),
(338, 'Purchasing', 'Laptop', 'Nerio Gelle', 'Win10', 'LUT89M1', '18-47-3D-4B-8B-2F', 'Dynamic', 0, ''),
(339, 'Purchasing', 'Laptop', 'Laptop Purch', 'Win10', 'DESKTOP-ODQOADP', 'B0-C0-90-59-6B-E6', 'Dynamic', 0, ''),
(340, 'Purchasing', 'Laptop', 'Vacant (old laptop)', 'Win10', 'GPI-MAIKO', 'C8-58-C0-96-2F-68', 'Dynamic', 0, ''),
(341, 'Purchasing', 'Laptop', 'Laptop Purch', 'Win10', 'GPI-Purchasing', 'C8-58-C0-9F-5E-CA', 'Dynamic', 1, ''),
(342, 'Purchasing', 'Dekstop ', 'Nemfa Villanroque', 'Win10', 'C2106-073', '1C-1B-0D-28-8A-FB', '192.168.60.7', 1, ''),
(343, 'Purchasing', 'Dekstop ', 'Lyziel Semillano', 'Win10', 'C2106-074', 'B8-97-5A-4C-0A-88', '192.168.60.5', 1, ''),
(344, 'Purchasing', 'Dekstop ', 'Genny Desacula', 'Win10', 'C2106-126', 'E0-D5-5E-3D-B3-E3', '192.168.60.16', 1, ''),
(345, 'Purchasing', 'Dekstop ', 'Vacant', 'Win10', 'DESKTOP-IFPM7C7', '40-8D-5C-6E-F0-FD', '192.168.60.18', 1, ''),
(346, 'Purchasing', 'Dekstop ', 'Vacant', 'Win10', 'C2106-132', 'E0-D5-5E-58-46-9B', '192.168.60.72', 1, ''),
(347, 'Purchasing', 'Dekstop ', 'Jonald Lapan', 'Win10', 'C2106-119', 'B8-97-5A-4C-0A-B9', '192.168.60.24', 1, ''),
(348, 'Purchasing', 'Dekstop ', 'Emil Alvarez', 'Win7', 'C2106-055', '1C-1B-0D-9A-39-0C', '192.168.60.23', 1, ''),
(349, 'Purchasing', 'Dekstop ', 'Jacqueline Servida', 'Win7', 'WS-GPI116', '74-D0-2B-95-68-08', '192.168.60.22', 1, ''),
(350, 'Purchasing', 'Dekstop ', 'Carmi Agbulos', 'Win7', 'C2016-061', 'E0-D5-5E-58-4C-26', '192.168.60.8', 1, ''),
(351, 'Purchasing', 'Dekstop ', 'loraine Legaspina', 'Win7', 'C2106-121', '1C-1B-0D-DA-07-37', '192.168.60.55', 1, ''),
(352, 'Purchasing', 'Dekstop ', 'Shiela Castuli', 'Win7', 'C2106-065', '1C-1B-0D-28-86-32', '192.168.60.17', 1, ''),
(353, 'Purchasing', 'Dekstop ', 'Michael Ardiente', 'Win7', 'C2106-069', '30-9C-23-9C-6F-1D', '192.168.60.21', 1, ''),
(354, 'Purchasing', 'Dekstop ', 'Joel Naranjo', 'Win7', 'WS-GPI92', '1C-1B-0D-99-D9-2D', '192.168.60.13', 1, ''),
(355, 'Purchasing', 'Dekstop ', 'Vacant', 'Win7', 'C2106-120', '50-46-5D-A7-DD-C7', '192.168.60.19', 1, ''),
(356, 'Purchasing', 'Dekstop ', 'Christian Ragel', 'Win7', 'C2106-056', '74-56-3C-10-F6-DD', '192.168.60.9', 1, ''),
(357, 'Purchasing', 'Dekstop ', 'Camille Tonga', 'Win8', 'C2106-059', 'D8-5E-D3-9F-02-34', '192.168.60.38', 1, ''),
(358, 'Purchasing', 'Dekstop ', 'Jason Bautista', 'Win8', 'C2106-127', '1C-1B-0D-38-A3-8A', '192.168.60.6', 1, ''),
(359, 'Purchasing', 'Dekstop ', 'Arnold Raganit', 'Win8', 'WS-GPI238', '1C-1B-0D-28-86-3E', '192.168.60.239', 1, ''),
(360, 'Purchasing', 'Dekstop ', 'Andrea Fado', 'Win8', 'C2106-124', '1C-1B-0D-1D-9C-7A', '192.168.60.14', 1, ''),
(361, 'Purchasing', 'Dekstop ', 'Nerio Gelle', 'Win8', 'C2112-305', '1C-1B-0D-96-D6-FB', '192.168.60.90', 1, ''),
(362, 'Purchasing', 'Dekstop ', 'Ronalyn Sagullo', 'Win8', 'C2106-123', '1C-1B-0D-96-D6-DD', '192.168.60.233', 1, ''),
(363, 'Quality Assurance', 'Dekstop ', 'John Rey Lamberto', 'Win10', 'C2106-161', '04-0E-3C-1F-1B-07', '192.168.5.168', 1, ''),
(364, 'Quality Assurance', 'Laptop', 'QA Old Laptop', 'Win10', 'GPIL17', '14-2D-27-2B-F0-0B', 'Dynamic', 1, ''),
(365, 'Quality Assurance', 'Dekstop ', 'QA Staff', 'Win10', 'C2106-154', '70-8B-CD-58-24-72', '192.168.60.181', 1, ''),
(366, 'Quality Assurance', 'Dekstop ', 'Jay Mar Dela Cruz', 'Win10', 'C2106-159', 'AC-22-0B-74-D4-84', '192.168.60.28', 1, ''),
(367, 'Quality Assurance', 'Laptop', 'QA New Laptop', 'Win10', 'C2210-044', '3C-F1-71-03-81-30', 'Dynamic', 1, ''),
(368, 'Quality Assurance', 'Laptop', 'Raymond Reyes', 'Win10', 'GPI-QA', 'C8-58-C0-96-21-75', 'Dynamic', 1, ''),
(369, 'Quality Assurance', 'Laptop', 'Carmela Jordan', 'Win10', 'C2202-004', 'C8-5A-CF-75-1F-E7', 'Dynamic', 1, ''),
(370, 'Quality Assurance', 'Dekstop ', 'Arlene Lontoc', 'Win7', 'WS-GPI103', '40-8D-5C-6E-F0-3C', '192.168.60.27', 1, ''),
(371, 'Quality Assurance', 'Dekstop ', 'Claudine Delmo', 'Win7', 'WS-GPI133', 'AC-22-0B-74-E0-07', '192.168.60.44', 1, ''),
(372, 'Quality Assurance', 'Dekstop ', 'Jayson Torres', 'Win7', 'WS-GPI132', '1C-1B-0D-DF-57-4C', '192.168.60.65', 1, ''),
(373, 'Quality Assurance', 'Dekstop ', 'Renan Joya', 'Win7', 'C2106-156', 'FC-AA-14-1E-D6-CF', '192.168.60.42', 1, ''),
(374, 'Quality Assurance', 'Dekstop ', 'Micah Alvarez', 'Win8', 'C2106-155', '40-8D-5C-FB-B3-8C', '192.168.60.29', 1, ''),
(375, 'Quality Assurance', 'Dekstop ', 'Elmalyn Pahimnayan', 'Win8', 'WS-GPI104', '40-8D-5C-FB-B9-92', '192.168.60.66', 1, ''),
(376, 'Quality Control', 'Laptop', 'Wilma Lagrono (Think Pad)', 'Win10', 'GPI-QC', '08-D2-3E-FE-2E-87', 'Dynamic', 1, ''),
(377, 'Quality Control', 'Laptop', 'Shiela Alinio Checksheet area', 'Win10', 'Checksheet-PC', '9C-D2-1E-58-8A-E3', 'Dynamic', 0, ''),
(378, 'Quality Control', 'Dekstop ', 'Shiela Alinio Checksheet area', 'Win10', 'C2106-170', '1C-1B-0D-96-D6-FA', '192.168.60.52', 1, ''),
(379, 'Quality Control', 'Dekstop ', 'Checksheet PC (former Sir Kawa', 'Win10', 'C2203-026', 'D8-C8-8A-C9-C0-8B', '192.168.5.45', 0, ''),
(380, 'Quality Control', 'Dekstop ', 'Lilybeth Arguellas', 'Win7', 'C2207-003', 'A4-BA-DB-C1-27-FA', '192.168.5.29', 0, ''),
(381, 'Quality Control', 'Dekstop ', 'Wilma Logrono', 'Win7', 'C2106-085', 'AC-22-0B-2A-EA-9D', '192.168.60.48', 0, ''),
(382, 'Quality Control', 'Dekstop ', 'Nolsan Ciudad', 'Win7', 'C2106-151', '74-D4-35-BA-38-9D', '192.168.60.50', 1, ''),
(383, 'Quality Control', 'Dekstop ', 'Joanna Marie Moises', 'Win7', 'C2106-105', 'E0-D5-5E-93-D9-9A', '192.168.60.189', 0, ''),
(384, 'Quality Control', 'Dekstop ', 'Bobby Didal', 'Win7', 'C2106-086', 'BC-EE-7B-9E-43-FB', '192.168.60.49', 1, ''),
(385, 'Quality Control', 'Dekstop ', 'Filipina Alcantara', 'Win7', 'C2106-149', 'BC-EE-7B-9E-45-01', '192.168.60.51', 1, ''),
(386, 'Quality Control', 'Dekstop ', 'Mary Ann Delgado', 'Win8', 'WS-GPIL187', '1C-39-47-36-09-2A', '192.168.60.240', 1, ''),
(387, 'System Kaizen', 'Dekstop ', 'Shermaye Cosa', 'Win7', 'C2106-138', 'B8-97-5A-81-31-2B', '192.168.5.38', 1, ''),
(388, 'System Kaizen', 'Dekstop ', 'Bobby John Solomon', 'Win7', 'C2106-139', '1C-1B-0D-96-D6-FD', '192.168.5.127', 1, ''),
(389, 'System Kaizen', 'Dekstop ', 'System Kaizen(staff)', 'Win7', 'C2106-142', '1C-1B-0D-96-D7-01', '192.168.60.47', 1, ''),
(390, 'Warehouse', 'Dekstop ', 'Leonardo Abueni', 'Win10', 'DESKTOP-K0BK6VI', 'B8-97-5A-5E-A3-60', '192.168.5.136', 1, ''),
(391, 'Warehouse', 'Dekstop ', 'Warehouse staff', 'Win10', 'DESKTOP-P0CFGCJ', 'BC-EE-7B-9E-45-27', '192.168.5.142', 1, ''),
(392, 'Warehouse', 'Dekstop ', 'PPIC Staff', 'Win10', 'C2110-201', 'AC-22-0B-2A-F5-D2', '192.168.60.100', 1, ''),
(393, 'Warehouse', 'Dekstop ', 'Desiree Yacon (tablet)', 'Win10', 'DESKTOP-LD8K550', '74-70-FD-D6-D4-72', 'Dynamic', 1, ''),
(394, 'Warehouse', 'Dekstop ', 'Desiree Yacon', 'Win7', 'C2106-015', 'E0-D5-5E-58-46-9E', '192.168.60.133', 1, ''),
(395, 'Warehouse', 'Dekstop ', 'Dhonna Yalung', 'Win7', 'C2208-036', 'D8-5E-D3-51-08-20', '192.168.60.200', 1, ''),
(396, 'Warehouse', 'Dekstop ', 'Susan Monterde', 'Win7', 'WS-GPI43', '1C-1B-0D-98-9D-32', '192.168.60.78', 1, ''),
(397, 'Warehouse', 'Dekstop ', 'Orlando Manalo', 'Win7', 'WS-GPI130', '74-D0-2B-CA-CC-88', '192.168.60.115', 1, ''),
(398, 'Warehouse', 'Dekstop ', 'Julius Tamayo', 'Win7', 'C2106-016', 'AC-22-0B-2A-F5-D5', '192.168.5.132', 1, ''),
(399, 'Warehouse', 'Dekstop ', 'Antonietta Gawaran', 'Win7', 'C2106-017', 'AC-22-0B-2A-F5-C0', '192.168.60.124', 1, ''),
(400, 'Warehouse', 'Dekstop ', 'Leaflor Maligsa', 'Win7', 'WS-GPI115', '1C-1B-0D-DF-66-1C', '192.168.60.125', 1, ''),
(401, 'Warehouse', 'Dekstop ', 'Marvin Bernardo', 'Win7', 'C2110-202', '74-D0-2B-CA-CC-8A', '192.168.60.126', 1, ''),
(402, 'Warehouse', 'Dekstop ', 'Jane Pauline Llanera', 'Win7', 'WS-GPI113', '74-D0-2B-95-67-72', '192.168.60.199', 0, ''),
(403, 'Warehouse', 'Dekstop ', 'Bernadeth Nazareno', 'Win7', 'WS-GPI129', 'AC-22-0B-74-ED-31', '192.168.60.217', 1, ''),
(404, 'Warehouse', 'Dekstop ', 'Princess Pauni', 'Win7', 'C2110-204', 'FC-AA-14-1E-D2-AB', '192.168.60.146', 1, ''),
(405, 'Warehouse', 'Dekstop ', 'Mary Jane Dela Vega', 'Win7', 'WS-GPI131', '74-D0-2B-95-7A-75', '192.168.5.139', 1, ''),
(406, 'Warehouse', 'Dekstop ', 'Maricel Aydalla', 'Win7', 'WS-GPI68', '1C-1B-0D-98-9D-22', '192.168.60.232', 1, ''),
(407, 'Warehouse', 'Dekstop ', 'Eric Florindo', 'Win7', 'WS-GPI41', 'D0-27-88-7C-21-B0', '192.168.60.68', 1, ''),
(408, 'Warehouse', 'Dekstop ', 'Eric Mugas', 'Win7', 'WS-GPI51', '00-01-6C-6E-31-2C', '192.168.5.149', 1, ''),
(409, 'Warehouse', 'Dekstop ', 'Lorie Nacor', 'Win7', 'WS-GPI119', '74-D0-2B-95-67-69', '192.168.5.150', 1, ''),
(410, 'Warehouse', 'Dekstop ', 'Raymond Due', 'Win7', 'WS-GPI39', 'C8-9C-DC-BF-6E-13', '192.168.5.134', 1, ''),
(411, 'Warehouse', 'Dekstop ', 'Orlando Manalo VMI GPI 1', 'Win8', 'WS-GPI232', '74-56-3C-13-FC-0C', '192.168.5.86', 0, ''),
(412, 'Warehouse', 'Dekstop ', 'Melvin Lazaga', 'Win8', 'WS-GPI161', 'B8-97-5A-81-3C-4C', '192.168.60.131', 1, ''),
(413, 'Warehouse', 'Dekstop ', 'PPIC Staff', 'Win8', 'WS-GPI163', 'B8-97-5A-5F-93-31', '192.168.5.147', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `pmsaction`
--

CREATE TABLE `pmsaction` (
  `id` int(11) NOT NULL,
  `deviceName` varchar(100) NOT NULL,
  `action` varchar(300) NOT NULL,
  `performedBy` varchar(100) NOT NULL,
  `Date` varchar(200) NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(10) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `approvedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pmsaction`
--

INSERT INTO `pmsaction` (`id`, `deviceName`, `action`, `performedBy`, `Date`, `month`, `year`, `approved`, `comments`, `approvedBy`) VALUES
(1, 'GPI-PROD 2', 'This is a sample action', 'Cedrick James Orozo', '2023-04-25', 'April', '2023', 1, 'n/a', ''),
(2, 'GPI-PROD 2', 'From 2022', 'Cedrick James Orozo', '2023-04-25', 'April', '2022', 1, 'n/a', ''),
(5, 'WS-GPI292', 'Physical Cleaning of the unit', 'Cedrick James M. Orozo', '2023-04-25', 'April', '2023', 1, 'kimi', 'Cedrick James Orozo'),
(6, 'WS-GPI292', 'Physical Cleaning of the unit', 'Cedrick James M. Orozo', '2023-04-25', 'April', '2022', 0, '', ''),
(7, 'WS-GPI292', 'Physical Cleaning of the unit', 'Cedrick James M. Orozo', '2023-04-25', 'April', '2022', 0, '', ''),
(8, 'C2210-176', 'Orayt', 'Cedrick James M. Orozo', '2023-04-25', 'November', '2023', 1, 'hehe', '');

-- --------------------------------------------------------

--
-- Table structure for table `pmsschedule`
--

CREATE TABLE `pmsschedule` (
  `id` int(11) NOT NULL,
  `January` varchar(100) NOT NULL,
  `February` varchar(100) NOT NULL,
  `March` varchar(100) NOT NULL,
  `April` varchar(100) NOT NULL,
  `May` varchar(100) NOT NULL,
  `June` varchar(100) NOT NULL,
  `July` varchar(100) NOT NULL,
  `August` varchar(100) NOT NULL,
  `September` varchar(100) NOT NULL,
  `October` varchar(100) NOT NULL,
  `November` varchar(100) NOT NULL,
  `December` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pmsschedule`
--

INSERT INTO `pmsschedule` (`id`, `January`, `February`, `March`, `April`, `May`, `June`, `July`, `August`, `September`, `October`, `November`, `December`) VALUES
(1, 'Parts Inspection', 'Parts Production', 'Production 1', 'Production 2', 'PPIC', 'Warehouse', 'Production Technology and Purchasing', 'Quality Control', 'Production Support', 'System Kaizen and Direct Operation Kaizen', 'Administration', 'Accounting and Quality Assurance');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(10) NOT NULL,
  `id_technical` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `section` int(10) NOT NULL,
  `delivery` int(10) NOT NULL,
  `quality` int(10) NOT NULL,
  `total_rating` int(10) NOT NULL,
  `rating_date` varchar(15) NOT NULL,
  `jo_no` varchar(20) NOT NULL,
  `rater` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(10) NOT NULL,
  `date_filled` varchar(20) NOT NULL,
  `status2` varchar(50) NOT NULL,
  `requestorUsername` varchar(20) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `request_to` varchar(3) NOT NULL COMMENT 'request to fem or mis',
  `request_category` varchar(30) NOT NULL,
  `request_details` varchar(240) NOT NULL,
  `computerName` varchar(20) DEFAULT NULL,
  `reqstart_date` varchar(20) NOT NULL,
  `reqfinish_date` varchar(20) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `approving_head` varchar(50) NOT NULL,
  `head_approval_date` varchar(20) DEFAULT NULL,
  `head_remarks` varchar(200) DEFAULT NULL,
  `approving_admin` varchar(50) DEFAULT NULL,
  `admin_remarks` varchar(50) DEFAULT NULL,
  `admin_approved_date` varchar(20) DEFAULT NULL,
  `assignedPersonnel` varchar(50) DEFAULT NULL,
  `assignedPersonnelName` varchar(50) DEFAULT NULL,
  `approved_finish_date` varchar(20) DEFAULT NULL,
  `actual_finish_date` varchar(20) DEFAULT NULL,
  `action1` varchar(200) DEFAULT NULL,
  `action2` varchar(200) DEFAULT NULL,
  `action3` varchar(200) DEFAULT NULL,
  `action1Date` varchar(20) DEFAULT NULL,
  `action2Date` varchar(20) DEFAULT NULL,
  `action3Date` varchar(20) DEFAULT NULL,
  `action` varchar(300) DEFAULT NULL,
  `recommendation` varchar(200) DEFAULT NULL,
  `confirm_finish_date` varchar(20) DEFAULT NULL,
  `rating_delivery` varchar(1) DEFAULT NULL,
  `rating_quality` varchar(1) DEFAULT NULL,
  `rating_final` float(10,2) DEFAULT NULL,
  `rateDate` varchar(20) DEFAULT NULL,
  `ratedBy` varchar(30) DEFAULT NULL,
  `perform_by` varchar(50) DEFAULT NULL,
  `technical_remarks` varchar(200) DEFAULT NULL,
  `requestor_remarks` varchar(200) DEFAULT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(4) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `reasonOfCancellation` varchar(200) DEFAULT NULL,
  `cancelledBy` varchar(50) DEFAULT NULL,
  `accept_termsandconddition` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `date_filled`, `status2`, `requestorUsername`, `requestor`, `email`, `department`, `request_to`, `request_category`, `request_details`, `computerName`, `reqstart_date`, `reqfinish_date`, `telephone`, `approving_head`, `head_approval_date`, `head_remarks`, `approving_admin`, `admin_remarks`, `admin_approved_date`, `assignedPersonnel`, `assignedPersonnelName`, `approved_finish_date`, `actual_finish_date`, `action1`, `action2`, `action3`, `action1Date`, `action2Date`, `action3Date`, `action`, `recommendation`, `confirm_finish_date`, `rating_delivery`, `rating_quality`, `rating_final`, `rateDate`, `ratedBy`, `perform_by`, `technical_remarks`, `requestor_remarks`, `month`, `year`, `attachment`, `reasonOfCancellation`, `cancelledBy`, `accept_termsandconddition`) VALUES
(120, '2023-03-31', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Email', '', '', '', '', '', 'Production Head', '2023-03-31', ' ', '', ' tapos na', '2023-03-31', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-04', '', '', '', '', '', '', 'Fix email server kineme', '', '', '4', '5', 4.50, '', '', 'To be assign by Admin', '', 'Very Good', 'Mar', '2023', '', '', '', 'Yes I agree on the terms and conditions.'),
(121, '2023-03-31', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'My computer is not responding. Please check it immediately.', 'C2110-203', '2023-04-03', '2023-04-06', '143', 'Production Head', '2023-04-04', 'hello', '', ' eme', '2023-04-04', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-11', 'hahaha', 'hhehe', '', '', '', '', 'finish na', '', '', '5', '5', 5.00, '2023-04-14', '', 'To be assign by Admin', '', 'asdasd', 'Mar', '2023', '../upload_files/2303-3107-5101.Summary-Report for Members.pdf.pdf', '', '', 'True'),
(122, '2023-03-31', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Network', 'please check immediately', '', '2023-04-03', '2023-04-05', '156', 'Production Head', '2023-03-31', '', '', '', '2023-04-03', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-03', '', '', '', '', '', '', 'Fic network issue.', '', '', '', '', 3.50, '', '', 'To be assign by Admin', '', 'haha', 'Mar', '2023', '', '', '', 'True'),
(123, '2023-03-31', 'cancelled', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Network', 'asd', '', '2023-04-03', '2023-04-05', '143', 'Production Head', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', 'To be assign by Admin', '', '', 'Mar', '2023', '', 'asdasdasd', 'Production Head', 'True'),
(125, '2023-03-31', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'asd', 'asdasd', '2023-04-05', '2023-04-08', '156', 'Production Head', '2023-04-03', ' ', '', ' ', '2023-04-03', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-03', '', '', '', '', '', '', ' ', '', '', '5', '5', 5.00, '2023-04-17', 'Cedrick James Orozo', 'To be assign by Admin', '', '', 'Mar', '2023', '', '', '', 'True'),
(126, '2023-04-03', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Telephone', 'Keypads are not working properly. Please check this immediately. Please', '', '2023-04-05', '2023-04-07', '252', 'Production Head', '2023-04-04', 'apaka eme', '', ' eme nama neto', '2023-04-04', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-04', '', '', '', '', '', '', 'asdasd', '', '', '5', '2', 3.50, '2023-04-14', '', 'To be assign by Admin', '', 'yes', 'Apr', '2023', '../upload_files/2304-0310-3737.Summary-Report for Leaders.pdf.pdf', '', '', 'True'),
(127, '2023-04-03', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'My computer is now booting.', 'C2110-2032', '2023-04-04', '2023-04-07', '143', 'Production Head', '2023-04-03', 'Please', '', ' asdas', '2023-04-04', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-04', '', '', '', '', '', '', 'dfghdfghdfgh', '', '', '5', '2', 3.50, '2023-04-14', '', 'To be assign by Admin', '', 'very good', 'Apr', '2023', '', '', '', 'True'),
(128, '2023-04-03', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'There too many pop ups in my computer. Please check if this contains virus.', 'C2110-203', '2023-04-04', '2023-04-07', '142', 'Production Head', '2023-04-03', 'N/A', '', ' Please attend this immediately', '2023-04-03', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-04', '', '', '', '', '', '', 'asdasd', '', '', '5', '5', 5.00, '2023-04-14', 'Cedrick James Orozo', '', '', 'ok', 'Apr', '2023', '', '', '', 'True'),
(129, '2023-04-03', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'Please ememememem', 'C2110-203', '2023-04-05', '2023-04-07', '123', 'Production Head', '2023-04-03', '', '', ' asdasd', '2023-04-03', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-03', '', '', '', '', '', '', 'asdfsdfsd', '', '', '', '', 5.00, '', '', '', '', 'asdfasdf', 'Apr', '2023', '', '', '', 'True'),
(130, '2023-04-04', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Email', 'napaka eme naman talga neto', '', '2023-04-05', '2023-04-07', '256', 'Production Head', '2023-04-04', 'abay napakaeme nga talaga.', '', ' tunay nga ikaw ay napaka eme', '2023-04-04', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-04', '', '', '', '', '', '', 'aking ineme and eme na ito', '', '', '', '', 5.00, '', '', '', '', 'no comment', 'Apr', '2023', '../upload_files/2304-0409-4830.JAC06829.JPG.jpg', '', '', 'True'),
(131, '2023-04-04', 'cancelled', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Network', 'I have a problem with my connection. I cannot access the 5.250', '', '2023-04-12', '2023-04-14', '256', 'Production Head', '2023-04-04', 'n/a', '', ' n/a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', 'wrong', 'Administrator', 'True'),
(132, '2023-04-04', 'rated', 'produser', 'Dustin Henderson', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'My computer is not working properly. Applications are not responding. It hangs everytime.', 'C2110-0978', '2023-04-05', '2023-04-11', '123', 'Production Head', '2023-04-11', 'Please attend this immediately', '', 'Try to check the date of purchased.', '2023-04-11', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-12', 'Perform system restore and check the storage for assestment', 'Back-up Drive C and D', 'Back-up email', '2023-04-06', '2023-04-07', '2023-04-07', 'After doing system restore, the problem still exist. I therefore conculde that this unit has to upgrade it\'s hard drive to ssd. ', 'MIS recommends to purchase a new SSD with 1TB of storage.', '', '4', '5', 4.50, '2023-04-08', 'Dustin Henderson', '', '', 'I commend the personnel for immediately responding my concern.', 'Apr', '2023', '', '', '', 'True'),
(133, '2023-04-12', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Telephone', 'check hehhahehae', '', '2023-04-13', '2023-04-19', '256', 'Production Head', '2023-04-12', 'idk', '', ' idts', '2023-04-12', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-15', 'asdasd', '', '', '', '', '', 'as&apos;s&apos;sasd&apos;as', 'rereaerer&apos;erer', '', '4', '2', 3.00, '2023-04-17', 'Cedrick James Orozo', '', '', 'comment', 'Apr', '2023', '', '', '', 'True'),
(134, '2023-04-19', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'It seems like my unit contains a lot of virus. There are too many pop-up message and alert.', 'C2110-203', '2023-04-14', '2023-04-17', '256', 'Production Head', '2023-04-16', '', '', ' n/a', '2023-04-18', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-20', 'Need to purchase anti-virus before we proceed.', 'Install Anti-virus', 'Install ERD', '', 'April 13, 2023', 'April 15, 2023', 'aasdfasdfasd', 'asdfasd', '', '5', '5', 5.00, '2023-04-20', 'Cedrick James Orozo', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(135, '2023-04-13', 'inprogress', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Network', 'I dont have network', '', '2023-04-14', '2023-04-19', '123', 'Production Head', '2023-04-13', 'n/a', '', '', '2023-04-14', 'GP-22-722', 'Cedrick James Orozo', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(136, '2023-04-13', 'inprogress', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Telephone', 'Please check my telephone key pads.', '', '2023-04-18', '2023-04-20', '156', 'Production Head', '2023-04-21', '', '', ' ', '2023-04-21', 'GP-22-722', 'Cedrick James M. Orozo', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(137, '2023-04-13', 'inprogress', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Email', 'We want to change the mis.dev@glory.com.ph to c.orozo@glory.com.ph', '', '2023-04-17', '2023-04-19', '142', 'Production Head', '2023-04-21', '', '', ' ', '2023-04-21', 'GP-17-571', 'VIVO, FELMHAR', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(138, '2023-04-14', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'Please check our department computer.', 'C2110-2032', '2023-04-17', '2023-04-20', '256', 'Production Head', '', '', '', ' ', '2023-04-14', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-15', '', '', '', '', '', '', 'We discovered that the laptop&apos;s battery is blowted', 'we recoomend to purchase a new one that is indicated in the quoatation', '', '5', '5', 5.00, '', 'Production Head', '', '', '', 'Apr', '2023', '../upload_files/2304-1409-5805.JAC06827.JPG.jpg', '', '', 'True'),
(139, '2023-04-14', 'cancelled', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'Please check our department computer.', 'C2110-2032', '2023-04-17', '2023-04-20', '256', 'Production Head', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '../upload_files/2304-1410-0056.JAC06827.JPG.jpg', 'duplicate', '', 'True'),
(140, '2023-04-14', 'cancelled', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'Please check our department computer.', 'C2110-2032', '2023-04-17', '2023-04-20', '256', 'Production Head', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '../upload_files/2304-1410-0132.JAC06827.JPG.jpg', 'duplicate lang', 'Nathan', 'True'),
(141, '2023-04-14', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'Please check our department computer.', 'C2110-2032', '2023-04-17', '2023-04-20', '256', 'Production Head', '', '', '', ' ', '2023-04-20', 'GP-17-571', 'VIVO, FELMHAR', '', '2023-04-20', '', '', '', '', '', '', 'asefasefasf', '', '', '5', '5', 5.00, '', 'Production Head', '', '', '', 'Apr', '2023', '../upload_files/2304-1410-0452.JAC06827.JPG.jpg', '', '', 'True'),
(142, '2023-04-14', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'adasdasdasd', 'C2110-2032', '2023-04-18', '2023-04-19', '143', 'Production Head', '', '', '', ' ', '2023-04-14', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-14', '', '', '', '', '', '', 'asdasd', '', '', '5', '5', 5.00, '', '', '', '', 'asdfasdf', 'Apr', '2023', '../upload_files/2304-1410-0530.JAC06827.JPG.jpg', '', '', 'True'),
(143, '2023-04-14', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'sdfwdf', 'C2110-2032', '2023-04-18', '2023-04-19', '3412', 'Production Head', '', '', '', ' ', '2023-04-20', 'GP-22-722', 'Cedrick James M. Orozo', '', '2023-04-20', '', '', '', '', '', '', 'wergtwr3t', '', '', '5', '5', 5.00, '', 'Production Head', '', '', 'qwefqwe', 'Apr', '2023', '../upload_files/2304-1410-0610.JAC06828.JPG.jpg', '', '', 'True'),
(144, '2023-04-14', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'fwefgwgf', 'C2110-2032', '2023-04-17', '2023-04-20', '121234', 'Production Head', '', '', '', ' ', '2023-04-20', 'GP-17-571', 'VIVO, FELMHAR', '', '2023-04-20', 'adqwewer', '', '', 'April 20, 2023', '', '', 'agwer', '', '', '5', '5', 5.00, '', 'Production Head', '', '', '', 'Apr', '2023', '../upload_files/2304-1410-0827.JAC06828.JPG.jpg', '', '', 'True'),
(145, '2023-04-15', 'rated', 'GP-22-722', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Administration', 'mis', 'Telephone', 'Need to change the telephone', '', '2023-04-17', '2023-04-19', '143', 'Admin Head', '2023-04-15', '', '', ' ', '2023-04-15', 'GP-22-722', 'Cedrick James Orozo', '', '2023-04-15', 'Check the telephone', '', '', 'April 15, 2023', '', '', 'Found out the unit is too old. Need to purchase a new one', '', '', '5', '4', 4.50, '2023-04-15', 'Cedrick James Orozo', '', '', 'n/a', 'Apr', '2023', '', '', '', 'True'),
(146, '2023-04-15', 'inprogress', 'GP-22-722', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Administration', 'mis', 'Computer', 'sample', '1225', '2023-04-17', '2023-04-19', '123', 'Admin Head', '2023-04-15', '', '', ' ', '2023-04-21', 'GP-22-729', 'Kevin Roy Marero', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(147, '2023-04-17', 'rated', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'fem', 'Facilities', 'sample', '', '2023-04-18', '2023-04-20', '123', 'Production Head', '2023-04-17', 'n/a', '', ' N/A', '2023-04-17', 'fem', 'Fem Member', '', '2023-04-17', 'this is my first action', '', '', 'April 17, 2023', '', '', 'this is my last action', 'i dont have any recommendation', '', '5', '5', 5.00, '2023-04-17', 'Cedrick James Orozo', '', '', '', 'Apr', '2023', '../upload_files/2304-1706-5949.JAC06828.JPG.jpg', '', '', 'True'),
(148, '2023-04-20', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Network', 'samp', '', '2023-04-21', '2023-04-24', '123', 'Production Head', '2023-04-20', '', '', ' ', '2023-04-20', 'GP-17-571', 'VIVO, FELMHAR', '', '2023-04-20', '', '', '', '', '', '', 'qwdqwdqwd', 'qwdqwd', '', '5', '5', 5.00, '', 'Production Head', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(149, '2023-04-20', 'rated', 'prodhead', 'Production Head', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Email', 'sdgsdfg', '', '2023-04-21', '2023-04-24', '143', 'Production Head', '2023-04-20', '', '', ' ', '2023-04-20', 'GP-22-722', 'Cedrick James M. Orozo', '', '2023-04-20', '', '', '', '', '', '', 'asfsdgsdsgf', '', '', '5', '5', 5.00, '', 'Production Head', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(150, '2023-04-21', 'cancelled', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Telephone', 'asfsdf', '', '2023-04-24', '2023-04-28', '112', 'Production Head', '2023-04-21', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', 'wdwqd', 'Nathan', 'True'),
(151, '2023-04-21', 'head', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Telephone', 'we34twe', '', '2023-04-24', '2023-04-27', '213', 'Production Head', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', 'Apr', '2023', '', '', '', 'True'),
(152, '2023-04-24', 'head', 'produser', 'Cedrick James Orozo', 'mis.dev@glory.com.ph', 'Production', 'mis', 'Computer', 'sam', 'C2110-203', '2023-04-25', '2023-04-26', '143', 'Production Head', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Apr', '2023', '', NULL, NULL, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `sender`
--

CREATE TABLE `sender` (
  `id` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sender`
--

INSERT INTO `sender` (`id`, `email`, `password`) VALUES
(1, 'helpdesk@glorylocal.com.ph', 'Xc71k9^h1');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `link`) VALUES
(1, 'http://192.168.60.53/helpdesk');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `department`, `email`, `level`) VALUES
(1, 'admin', 'admin', 'Nathan', 'Administration', 'j.nemedez@glory.com.ph', 'admin'),
(6, 'prodhead', '123', 'Production Head', 'Production', 'mis.dev@glory.com.ph', 'head'),
(7, 'produser', '123', 'Cedrick James Orozo', 'Production', 'mis.dev@glory.com.ph', 'user'),
(12, 'GP-11-306', 'GP-11-306', 'NEMEDEZ, NATHAN', 'Administration', 'j.nemedez@glory.com.ph', 'admin'),
(13, 'GP-12-356', 'GP-12-356', 'RAMIREZ, FRANCISCO', 'Administration', 'f.ramirez@glory.com.ph', 'fem'),
(15, 'GP-18-622', 'GP-18-622', 'ABLAZA, JOHN LESTER', 'PPIC', 'vmi@glory.com.ph', 'user'),
(16, 'GP-18-576', 'GP-18-576', 'ABUENI, LEONARDO', 'PPIC', 'l.abueni@glory.com.ph', 'user'),
(18, 'GP-17-503', 'GP-17-503', 'AGAHAN, JOHN RONNEL', 'Purchasing', 'j.agahan@glory.com.ph', 'user'),
(25, 'GP-06-190', 'GP-06-190', 'ALCANTARA, FILIPINA', 'Quality Control', 'f.alcantara@glory.com.ph', 'user'),
(26, 'GP-16-460', 'GP-16-460', 'ALCASODA, FLORALYN', 'PPIC', 'f.alcasoda@glory.com.ph', 'user'),
(27, 'GP-15-437', 'GP-15-437', 'ALEGA, ROSE ANN', 'Administration', 'hr_training@glory.com.ph', 'user'),
(30, 'GP-13-361', 'GP-13-361', 'ALINIO, SHIELA', 'Quality Control', 's.alinio@glory.com.ph', 'user'),
(31, 'GP-12-335', 'GP-12-335', 'ALISANGCO, RONEL', 'Production 1', 'r.alisangco@glory.com.ph', 'user'),
(33, 'GP-18-608', 'GP-18-608', 'ALMENDRAS, VILMA', 'PPIC', 'v.almendras@glory.com.ph', 'user'),
(34, 'GP-16-461', 'GP-16-461', 'ALONZO, JOHN LORD', 'Administration', 'hr_compensation@glory.com.ph', 'user'),
(36, 'GP-12-322', 'GP-12-322', 'ALVAREZ, EMIL', 'Purchasing', 'e.alvarez@glory.com.ph', 'user'),
(37, 'GP-15-442', 'GP-15-442', 'ALVAREZ, KRIZEL MICAH ANNE', 'Quality Assurance', 'm.alvarez@glory.com.ph', 'user'),
(38, 'GP-19-681', 'GP-19-681', 'ANDRES, ARCEL', 'Quality Assurance', 'pco@glory.com.ph', 'user'),
(43, 'CG-1664', 'CG-1664', 'ARCILLANA, MARY ROSE', 'PPIC', 'impexstaff@glory.com.ph', 'user'),
(44, 'GP-15-422', 'GP-15-422', 'ARDIENTE, MICHAEL', 'Purchasing', 'm.ardiente@glory.com.ph', 'user'),
(47, 'GP-08-232', 'GP-08-232', 'ARIVE, MELLY JENNA', 'Accounting', 'mj.potente@glory.com.ph', 'user'),
(48, 'GP-08-214', 'GP-08-214', 'ARMILLO, REY', 'Production 2', 'r.armillo@glory.com.ph', 'user'),
(51, 'GP-08-215', 'GP-08-215', 'ASUELO, OSCAR JR.', 'Production Support', 'o.asuelo@glory.com.ph', 'user'),
(52, 'GP-17-537', 'GP-17-537', 'ASUNCION, DENISE LI ANNIE', 'PPIC', 'd.asuncion@glory.com.ph', 'user'),
(53, 'GP-17-505', 'GP-17-505', 'AYDALLA, MARICEL', 'PPIC', 'm.aydalla@glory.com.ph', 'user'),
(55, 'GP-10-250', 'GP-10-250', 'BALDESIMO, DESERIE', 'Production 1', 'd.baldesimo@glory.com.ph', 'user'),
(59, 'GP-17-541', 'GP-17-541', 'BARRON, SHERILYN', 'Production Support', 'psstaff2@glory.com.ph', 'user'),
(60, 'GP-21-707', 'GP-21-707', 'BAUTISTA, JASON', 'Purchasing ', 'purchasing.staff10@glory.com.ph', 'user'),
(61, 'GP-10-245', 'GP-10-245', 'BAUTISTA, RELYN', 'Production 1', 'r.bautista@glory.com.ph', 'user'),
(64, 'GP-02-141', 'GP-02-141', 'BELTRAN, MELVIN', 'Parts Production', 'm.beltran@glory.com.ph', 'user'),
(65, 'GP-18-627', 'GP-18-627', 'BENAVENTE, ALVIN', 'Parts Inspection', 'a.benavente@glory.com.ph', 'user'),
(67, 'GP-20-687', 'GP-20-687', 'BERINGUELA, FRANCIS DIVINO NINO', 'Administration', 'f.beringuela@glory.com.ph', 'user'),
(68, 'GP-18-581', 'GP-18-581', 'BERMAS, ROAN MAE', 'Production Technology', 'r.bermas@glory.com.ph', 'user'),
(69, 'GP-10-246', 'GP-10-246', 'BERNAL, FERNALIZA', 'Production 1', 'f.bernal@glory.com.ph', 'user'),
(70, 'GP-18-628', 'GP-18-628', 'BERNARDO, MARVIN', 'PPIC', 'm.bernardo@glory.com.ph', 'user'),
(72, 'GP-19-678', 'GP-19-678', 'BORNASAL, RUSITHA AUDREY', 'Administration', 'hr@glory.com.ph', 'user'),
(73, 'GP-07-205', 'GP-07-205', 'BRILLANTES, KRISLYN', 'Production 2', 'prod2sectionstaff1@glory.com.ph', 'user'),
(74, 'GP-12-329', 'GP-12-329', 'BUCAYAN, JEANY LYNN', 'Production 2', 'j.bucayan@glory.com.ph', 'user'),
(75, 'GP-14-404', 'GP-14-404', 'BUYAO, ROMAL', 'Production Technology', 'r.buyao@glory.com.ph', 'user'),
(79, 'GP-14-390', 'GP-14-390', 'CADOCOY, ANALYN', 'Parts Production', 'a.cadocoy@glory.com.ph', 'user'),
(80, 'GP-15-426', 'GP-15-426', 'CALDERON, NAOMI', 'PPIC', 'n.calderon@glory.com.ph', 'user'),
(82, 'GP-18-629', 'GP-18-629', 'CAMANTE, REY', 'Production 2', 'prod2partsprep@glory.com.ph', 'user'),
(83, 'GP-13-367', 'GP-13-367', 'CANTO, MARISSA', 'Production 1', 'm.canto@glory.com.ph', 'user'),
(88, 'GP-16-480', 'GP-16-480', 'CASTRO, RANELYN', 'Production Technology', 'r.castro@glory.com.ph', 'user'),
(89, 'GP-10-248', 'GP-10-248', 'CASTULI, SHEILA', 'Purchasing', 's.castuli@glory.com.ph', 'user'),
(90, 'CG-0370', 'CG-0370', 'CERA, LEIRA', 'PPIC', 'impexstaff2@glory.com.ph', 'user'),
(91, 'GP-11-283', 'GP-11-283', 'CINCO, MERRY BETH', 'Production 2', 'm.cinco@glory.com.ph', 'user'),
(92, 'GP-01-116', 'GP-01-116', 'CIUDAD, NOLSAN', 'Quality Control', 'n.ciudad@glory.com.ph', 'user'),
(94, 'GP-13-372', 'GP-13-372', 'COMIA, JOEY', 'Parts Inspection', 'j.comia@glory.com.ph', 'user'),
(95, 'GP-12-343', 'GP-12-343', 'CORNEJO, WENNA ROSE', 'Production 1', 'w.cornejo@glory.com.ph', 'user'),
(97, 'GP-01-132', 'GP-01-132', 'CORTEZ, CHONA', 'PPIC', 'c.cortez@glory.com.ph', 'user'),
(101, 'GP-13-365', 'GP-13-365', 'CUDIAMAT, PRECIOUS MAE', 'Production Support', 'supplies@glory.com.ph', 'user'),
(103, 'GP-00-109', 'GP-00-109', 'CULLA, ELMA', 'Production 2', 'e.culla@glory.com.ph', 'user'),
(104, 'GP-12-345', 'GP-12-345', 'CUSTODIO, HAYDEE', 'Production 2', 'h.custodio@glory.com.ph', 'user'),
(108, 'GP-14-406', 'GP-14-406', 'DE MESA, MYR JOY', 'PPIC', 'm.demesa@glory.com.ph', 'user'),
(110, 'GP-10-251', 'GP-10-251', 'DE ROXAS, JACQUELYN', 'Production 2', 'rbgescrow@glory.com.ph', 'user'),
(111, 'GP-18-633', 'GP-18-633', 'DEALAGDON JR., FEDERICO', 'Production 2', 'packaging@glory.com.ph', 'user'),
(112, 'GP-18-632', 'GP-18-632', 'DEL MUNDO, IVY', 'Parts Inspection', 'pistaff4@glory.com.ph', 'user'),
(113, 'CG-1646', 'CG-1646', 'DELA CRUZ, JAYMAR', 'Quality Assurance', 'qa.staff1@glory.com.ph', 'user'),
(114, 'GP-12-358', 'GP-12-358', 'DELA CRUZ, JUVILYN', 'Production 2', 'glr@glory.com.ph', 'user'),
(116, 'GP-16-466', 'GP-16-466', 'DELA TORRE, HAZEL ANN', 'Production 2', 'h.delatorre@glory.com.ph', 'user'),
(117, 'GP-17-548', 'GP-17-548', 'DELA VEGA, MARY JANE', 'PPIC', 'prstaff1@glory.com.ph', 'user'),
(118, 'GP-12-324', 'GP-12-324', 'DELGADO, MARY ANN', 'QC', 'm.delgado@glory.com.ph', 'user'),
(119, 'GP-12-330', 'GP-12-330', 'DELGADO, RUBEN JR.', 'Production 2', 'prod2partsprep@glory.com.ph', 'user'),
(121, 'CG-1315', 'CG-1315', 'Delmo, Les Claudine', 'Quality Assurance', 'qa.staff4@glory.com.ph', 'user'),
(122, 'GP-19-685', 'GP-19-685', 'DELOS REYES, NIFRAN', 'Direct Operation Kaizen', 'dokstaff@glory.com.ph', 'user'),
(124, 'GP-01-125', 'GP-01-125', 'DESACULA, GENNY', 'Purchasing', 'g.desacula@glory.com.ph', 'user'),
(125, 'GP-12-346', 'GP-12-346', 'DESEO, CHERRYLYN', 'Production 2', 'c.deseo@glory.com.ph', 'user'),
(126, 'GP-06-178', 'GP-06-178', 'DIDAL, BOBBY', 'Quality Control', 'b.didal@glory.com.ph', 'user'),
(128, 'GP-02-145', 'GP-02-145', 'DOMINGO, BRENISA', 'Parts Inspection', 'b.domingo@glory.com.ph', 'user'),
(130, 'GP-18-634', 'GP-18-634', 'DUE, RAYMOND', 'PPIC', 'r.due@glory.com.ph', 'user'),
(131, 'GP-01-130', 'GP-01-130', 'DULATRE, RHEA LIZA', 'Purchasing', 'r.dulatre@glory.com.ph', 'user'),
(132, 'GP-17-523', 'GP-17-523', 'DULCE, RINALYN', 'Administration', 'r.dulce@glory.com.ph', 'user'),
(133, 'CG-1147', 'CG-1147', 'DUNGCA RANATO S.', 'Purchasing ', 'purchasingstaff08@glory.com.ph', 'user'),
(137, 'user', 'user', 'Employee test', 'Administration', 'j.nemedez@glory.com.ph', 'user'),
(138, 'GP-21-714', 'GP-21-714', 'ERIES CABRERA', 'PPIC', 'e.cabrera@glory.com.ph', 'user'),
(139, 'GP-18-614', 'GP-18-614', 'ESCAMILLAS, TRICY ANN', 'Administration', 't.escamillas@glory.com.ph', 'user'),
(141, 'GP-17-512', 'GP-17-512', 'ESCULTURA, JESSA', 'Japan Trainee', 'j.escultura@glory.com.ph', 'user'),
(143, 'GP-12-351', 'GP-12-351', 'EVANGELISTA, EVA', 'Production 1', 'e.lanquino@glory.com.ph', 'user'),
(144, 'CG-1622', 'CG-1622', 'FADO, ANDREA', 'Purchasing ', 'purchasing.staff1@glory.com.ph', 'user'),
(145, 'GP-18-610', 'GP-18-610', 'FAGUTAN, ERNALD', 'PPIC', 'impexprocessor@glory.com.ph', 'user'),
(148, 'GP-12-347', 'GP-12-347', 'FLORINDO, ERIC', 'PPIC', 'e.florindo@glory.com.ph', 'user'),
(149, 'GP-18-611', 'GP-18-611', 'Francisco, Lozano', 'Direct Operation Kaizen', 'dokstaff@glory.com.ph', 'user'),
(150, 'GP-21-710', 'GP-21-710', 'FUMIYA KOJIMA', 'Japanese', 'f.kojima@glory.com.ph', 'user'),
(151, 'GP-14-383', 'GP-14-383', 'GABATO, IAN ROY', 'Purchasing', 'i.gabato@glory.com.ph', 'user'),
(156, 'GP-17-501', 'GP-17-501', 'GARCIA, MARK JOSEPH', 'PPIC', 'm.garcia@glory.com.ph', 'user'),
(157, 'GP-15-429', 'GP-15-429', 'GAWARAN, ANTONIETA', 'PPIC', 'a.gawaran@glory.com.ph', 'user'),
(158, 'GP-21-713', 'GP-21-713', 'GAYAS, JANE MARGARETTE', 'Accounting', 'j.gayas@glory.com.ph', 'user'),
(159, 'GP-14-384', 'GP-14-384', 'GENISE, MICHAEL', 'Parts Inspection', 'm.genise@glory.com.ph', 'user'),
(160, 'GP-15-431', 'GP-15-431', 'GENISE, MYDEL', 'Parts Inspection', 'm.incognito@glory.com.ph', 'user'),
(161, 'GP-21-712', 'GP-21-712', 'Gerald Ben Ermita', 'Quality Assurance', 'so@glory.com.ph', 'user'),
(164, 'GP-10-247', 'GP-10-247', 'GONZALES, DIGNA', 'Production Support', 'd.gonzales@glory.com.ph', 'user'),
(165, 'GP-14-418', 'GP-14-418', 'GONZALES, MYRA FLOR', 'Accounting', 'm.villanueva@glory.com.ph', 'user'),
(173, 'GP-13-373', 'GP-13-373', 'HERNANDEZ, FELINA', 'Production 1', 'f.hernandez@glory.com.ph', 'user'),
(174, 'GP-16-479', 'GP-16-479', 'HERRERA, EDMAR', 'Parts Production', 'h.herrera@glory.com.ph', 'user'),
(177, 'GP-12-350', 'GP-12-350', 'ILAO, MARVIN', 'Production 2', 'm.ilao@glory.com.ph', 'user'),
(180, 'GP-22-720', 'GP-22-720', 'Jayson Torres', 'Quality Assurance', 'so@glory.com.ph', 'user'),
(181, 'GP-20-702', 'GP-20-702', 'JORDAN, CARMELA', 'Quality Assurance', 'c.jordan@glory.com.ph', 'user'),
(182, 'GP-14-408', 'GP-14-408', 'JOSE, ARIS', 'Production 1', 'a.jose@glory.com.ph', 'user'),
(183, 'GP-23-760', 'GP-23-760', 'JOYA, RENAN', 'Quality Assurance', 'pco@glory.com.ph', 'user'),
(185, 'KATARINA CUEVAS', 'GL-1041', 'KATARINA CUEVAS', 'Parts Production', 'moulding.staff2@glory.com.ph', 'user'),
(186, 'GP-19-680', 'GP-19-680', 'KOMORI, MAIKO ', 'Purchasing', 'm.komori@glory.com.ph', 'user'),
(187, 'GP-19-665', 'GP-19-665', 'LABANZA, LUCHE', 'Parts Inspection', 'l.labanza@glory.com.ph', 'user'),
(188, 'GP-11-299', 'GP-11-299', 'LAFORTEZA, MARIO A', 'PPIC', 'm.laforteza@glory.com.ph', 'user'),
(190, 'CG-1710', 'CG-1710', 'Lamberto, John Rey', 'Quality Assurance', 'qa.staff@glory.com.ph', 'user'),
(192, 'GP-07-199', 'GP-07-199', 'LAPAN, JONALD JOHN', 'Purchasing', 'j.lapan@glory.com.ph', 'user'),
(193, 'GP-22-715', 'GP-22-715', 'Lapurga, Jennielaine', 'Quality Assurance', 'j.lapurga@glory.com.ph', 'user'),
(194, 'GP-12-327', 'GP-12-327', 'LAZAGA, MELVIN', 'PPIC', 'm.lazaga@glory.com.ph', 'user'),
(196, 'GP-11-285', 'GP-11-285', 'LEGASPINA, LORAINE', 'Purchasing', 'l.legaspina@glory.com.ph', 'user'),
(197, 'GP-15-421', 'GP-15-421', 'LERIT, MARICRIS', 'Parts Production', 'm.lerit@glory.com.ph', 'user'),
(207, 'GP-10-257', 'GP-10-257', 'LUIG, LEIVIC', 'Production 2', 'rbgfinalinsp@glory.com.ph', 'user'),
(211, 'GP-06-174', 'GP-06-174', 'MACOB, IVAN DANIEL', 'PPIC', 'i.macob@glory.com.ph', 'user'),
(212, 'GP-07-206', 'GP-07-206', 'MACOB, MARIA CARMEN', 'Accounting', 'c.macob@glory.com.ph', 'user'),
(214, 'GP-22-728', 'GP-22-728', 'MAGBUO, MARISSA', 'Parts Inspection', 'pi.staff@glory.com.ph', 'user'),
(216, 'GP-07-202', 'GP-07-202', 'MAGPATOC, CARLITO', 'Production Technology', 'c.magpatoc@glory.com.ph', 'user'),
(219, 'GP-22-717', 'GP-22-717', 'MAIGUE, JONNALYN', 'PPIC', 'j.maigue@glory.com.ph', 'user'),
(220, 'GP-18-638', 'GP-18-638', 'MALIGSA, LEAFLOR', 'PPIC', 'prstaff8@glory.com.ph', 'user'),
(221, 'GP-11-303', 'GP-11-303', 'MALUBAY, MICHELLE', 'Parts Production', 'm.malubay@glory.com.ph', 'user'),
(224, 'GP-12-352', 'GP-12-352', 'MANALO, ORLANDO', 'PPIC', 'o.manalo@glory.com.ph', 'user'),
(225, 'GP-16-490', 'GP-16-490', 'MANALO, ROSEMARIE JINKY', 'Parts Inspection', 'j.manalo@glory.com.ph', 'user'),
(226, 'GP-18-639', 'GP-18-639', 'MANALON, CHERRY ROSE', 'Parts Inspection', 'pi.auditor02@glory.com.ph', 'user'),
(231, 'GP-07-209', 'GP-07-209', 'Manny Herrera', 'Direct Operation Kaizen', 'h.herrera@glory.com.ph', 'user'),
(234, 'GP-14-417', 'GP-14-417', 'MARCELO, CATHERINE', 'Parts Inspection', 'c.marcelo@glory.com.ph', 'user'),
(235, 'GP-19-683', 'GP-19-683', 'MARCILLA, LENLYN', 'Administration', 'healthbenefits@glory.com.ph', 'user'),
(238, 'maxim', 'maxim', 'MAXIM', 'Administration', 'maxim@glory.com.ph', 'user'),
(239, 'GP-18-595', 'GP-18-595', 'MENDEZ, MARLYN', 'PPIC', 'm.mendez@glory.com.ph', 'user'),
(240, 'GP-14-409', 'GP-14-409', 'MENDOZA, ANJELICA', 'Production Technology', 'a.mendoza@glory.com.ph', 'user'),
(241, 'GP-18-616', 'GP-18-616', 'MENDOZA, CHARISSE', 'Administration', 'recruitment@glory.com.ph', 'user'),
(243, 'GP-00-098', 'GP-00-098', 'MENDOZA, ELARDE', 'PPIC', 'crating@glory.com.ph', 'user'),
(248, 'GP-14-382', 'GP-14-382', 'MIGUEL, RAMINA', 'Parts Inspection', 'r.miguel@glory.com.ph', 'user'),
(252, 'GP-16-471', 'GP-16-471', 'MOGOL, RENALYN', 'Parts Inspection', 'r.mogol@glory.com.ph', 'user'),
(253, 'GP-12-323', 'GP-12-323', 'MOISES, JOANNA MARIE', 'Quality Control', 'j.moises@glory.com.ph', 'user'),
(255, 'GP-07-210', 'GP-07-210', 'MOJICA, JONAR', 'Production 1', 'j.mojica@glory.com.ph', 'user'),
(256, 'GP-11-304', 'GP-11-304', 'MOJICA, RICHARD', 'Parts Production', 'r.mojica@glory.com.ph', 'user'),
(258, 'GP-07-196', 'GP-07-196', 'MONTANO, MARICEL', 'Accounting', 'm.montano@glory.com.ph', 'user'),
(259, 'GP-16-472', 'GP-16-472', 'MONTERDE, SUSAN', 'PPIC', 's.monterde@glory.com.ph', 'user'),
(261, 'GP-18-596', 'GP-18-596', 'MUGAS, JOHN ERIC', 'PPIC', 'prstaff13@glory.com.ph', 'user'),
(262, 'GP-16-473', 'GP-16-473', 'NACOR JR., LORIE', 'PPIC', 'l.nacor@glory.com.ph', 'user'),
(263, 'GP-08-220', 'GP-08-220', 'NARANJO, JOEL', 'Purchasing', 'j.naranjo@glory.com.ph', 'user'),
(264, 'GP-08-216', 'GP-08-216', 'NAUNGAYAN, WENNIE', 'Production 2', 'w.naungayan@glory.com.ph', 'user'),
(265, 'GP-14-393', 'GP-14-393', 'NAZARENO, BERNADETTE', 'PPIC', 'b.endaya@glory.com.ph', 'user'),
(266, 'nippi', 'nippi', 'NIPPI', 'Nippi', 'nippi@glory.com.ph', 'user'),
(269, 'GP-11-297', 'GP-11-297', 'OBANA, RECELL', 'Parts Production', 'moulding.staff@glory.com.ph', 'user'),
(272, 'GP-08-222', 'GP-08-222', 'ODASCO, JESPER', 'Parts Inspection', 'j.odasco@glory.com.ph', 'user'),
(273, 'GP-15-449', 'GP-15-449', 'ODVIAR, MELODY', 'Parts Inspection', 'm.odviar@glory.com.ph', 'user'),
(276, 'GP-18-641', 'GP-18-641', 'OLGINA, RAVEN', 'Quality Assurance', 'r.olgina@glory.com.ph', 'user'),
(281, 'GP-12-354', 'GP-12-354', 'ORDONEZ, LIZA', 'Parts Inspection', 'pistaff1@glory.com.ph', 'user'),
(282, 'GP-10-260', 'GP-10-260', 'OSOYOS, SHIELO JOY', 'Parts Production', 's.osoyos@glory.com.ph', 'user'),
(283, 'GP-11-278', 'GP-11-278', 'PACUAN, MARY JANE', 'PPIC', 'mj.pacuan@glory.com.ph', 'user'),
(284, 'GP-17-550', 'GP-17-550', 'PAGATPAT, ANNALYN', 'Production Support', 'a.pagatpat@glory.com.ph', 'user'),
(285, 'GP-14-388', 'GP-14-388', 'PAGULAYAN, JOHN MORONI', 'Parts Inspection', 'j.pagulayan@glory.com.ph', 'user'),
(287, 'CG-1488', 'CG-1488', 'PAHIMNAYAN, ELMALYN', 'Quality Assurance', 'qa.staff@glory.com.ph', 'user'),
(289, 'GP-97-064', 'GP-97-064', 'PALOMERAS, LUISA', 'PPIC', 'l.palomeras@glory.com.ph', 'user'),
(291, 'GP-22-738', 'GP-22-738', 'PAREJA, JOY CHRISTIAN', 'Accounting', 'j.pareja@glory.com.ph', 'user'),
(294, 'GP-19-672', 'GP-19-672', 'PAUNI, PRINCESS', 'PPIC', 'p.pauni@glory.com.ph', 'user'),
(297, 'GP-02-142', 'GP-02-142', 'PELINA, DANA', 'Production 1', 'd.pelina@glory.com.ph', 'user'),
(300, 'GP-17-564', 'GP-17-564', 'PLATA, DECHRISTINE', 'PPIC', 'd.plata@glory.com.ph', 'user'),
(301, 'powerlane', 'powerlane', 'POWERLANE', 'Powerlane', 'powerlane@glory.com.ph', 'user'),
(307, 'GP-20-688', 'GP-20-688', 'PRUDENTE, ALYSSA JENINE', 'Administration', 'nurse@glory.com.ph', 'user'),
(310, 'GP-08-224', 'GP-08-224', 'Quilantang, Joy', 'Production 1', 'j.quilantang@glory.com.ph', 'user'),
(311, 'GP-18-600', 'GP-18-600', 'RAGANIT, ARNOLD', 'Purchasing', 'a.raganit@glory.com.ph', 'user'),
(312, 'GP-19-684', 'GP-19-684', 'RAGEL, CHRISTIAN', 'Purchasing', 'c.ragel@glory.com.ph', 'user'),
(314, 'GP-12-344', 'GP-12-344', 'RAMOS, CHAREYNA', 'Production 2', 'c.ramos@glory.com.ph', 'user'),
(317, 'GP-11-286', 'GP-11-286', 'RESURECCION, MARGIE', 'Production 1', 'm.resureccion@glory.com.ph', 'user'),
(318, 'GP-08-225', 'GP-08-225', 'RIVAMONTE, JONALYN', 'Production 2', 'j.rivamonte@glory.com.ph', 'user'),
(321, 'GP-15-437', 'GP-15-437', 'ROBILON, ROSE ANN', 'Administration', 'hr_training@glory.com.ph', 'user'),
(324, 'GP-10-262', 'GP-10-262', 'ROJAS, NOEMI', 'Production 2', 'n.rojas@glory.com.ph', 'user'),
(325, 'GP-06-181', 'GP-06-181', 'ROLLE, RYAN', 'Parts Production', 'r.rolle@glory.com.ph', 'user'),
(326, 'GP-13-366', 'GP-13-366', 'ROQUE, KAREN', 'Production 2', 'prod2sectionstaff1@glory.com.ph', 'user'),
(328, 'GP-16-476', 'GP-16-476', 'SABEJON, JINELYN', 'Production Support', 'prod.suppliesstaff1@glory.com.ph', 'user'),
(329, 'CG-1697', 'CG-1697', 'SAGULLO, RONALYN', 'Purchasing ', 'purchasing.staff2@glory.com.ph', 'user'),
(331, 'GP-18-646', 'GP-18-646', 'SALIVA, JUSTINE JOYCE', 'Production Support', 'auditraining@glory.com.ph', 'user'),
(334, 'GP-11-309', 'GP-11-309', 'SAMSON, SONNY', 'Parts Production', 's.samson@glory.com.ph', 'user'),
(337, 'GP-22-736', 'GP-22-736', 'SANGALANG, ELAINE', 'Administration', 'e.sangalang@glory.com.ph', 'user'),
(338, 'GP-19-679', 'GP-19-679', 'SANTIAGO, KLARENCE', 'PPIC', 'k.santiago@glory.com.ph', 'user'),
(339, 'GP-22-719', 'GP-22-719', 'SANTIAGO, RODIL', 'PPIC', 'r.santiago@glory.com.ph', 'user'),
(341, 'GP-17-519', 'GP-17-519', 'SARABIA, JUNNEL JOSEPH', 'PPIC', 'impexprocessor@glory.com.ph', 'user'),
(344, 'GP-07-204', 'GP-07-204', 'SARTE, EMYRIA', 'Production 2', 'e.sarte@glory.com.ph', 'user'),
(346, 'GP-02-146', 'GP-02-146', 'SERVIDA, JACQUELINE', 'Purchasing', 'j.servida@glory.com.ph', 'user'),
(352, 'GP-20-701', 'GP-20-701', 'TAGLE, JOHN YORI ', 'Production Support', 'a.asuelo@glory.com.ph', 'user'),
(356, 'GP-12-359', 'GP-12-359', 'TAMAYO, JULIUS CEZAR', 'PPIC', 'j.tamayo@glory.com.ph', 'user'),
(357, 'GP-12-359', 'GP-12-359', 'TAMAYO, JULIUS CEZAR', 'PPIC', 'j.tamayo@glory.com.ph', 'user'),
(358, 'GP-18-609', 'GP-18-609', 'TAMIO, ALLELIE MAE', 'PPIC', 'a.tamio@glory.com.ph', 'user'),
(359, 'GP-18-609', 'GP-18-609', 'TAMIO, ALLELIE MAE', 'PPIC', 'a.tamio@glory.com.ph', 'user'),
(360, 'GP-15-454', 'GP-15-454', 'TATING, RICHARD', 'Parts Inspection', 'pistaff3@glory.com.ph', 'user'),
(363, 'GP-11-312', 'GP-11-312', 'TICONG, ANGELO', 'Parts Production', 'a.ticong@glory.com.ph', 'user'),
(366, 'GP-15-438', 'GP-15-438', 'TOLENTINO, EDWIN', 'Production 2', 'e.tolentino@glory.com.ph', 'user'),
(369, 'GP-08-228', 'GP-08-228', 'TONDENG, MARILYN', 'Production 1', 'm.tondeng@glory.com.ph', 'user'),
(370, 'GP-08-228', 'GP-08-228', 'TONDENG, MARILYN', 'Production 1', 'm.tondeng@glory.com.ph', 'user'),
(371, 'GP-18-604', 'GP-18-604', 'TONGA, CAMILLE', 'Purchasing', 'c.tonga@glory.com.ph', 'user'),
(372, 'GP-18-604', 'GP-18-604', 'TONGA, CAMILLE', 'Purchasing', 'c.tonga@glory.com.ph', 'user'),
(373, 'GP-21-709', 'GP-21-709', 'TORRES, ABEGAIL', 'PPIC', 'a.torres@glory.com.ph', 'user'),
(375, 'TORRES, ÑINO', 'GP-18-613', 'TORRES, ÑINO', 'Parts Inspection', 'n.torres@glory.com.ph', 'user'),
(378, 'GP-99-069', 'GP-99-069', 'UMALI, NESTOR', 'PPIC', 'crating2@glory.com.ph', 'user'),
(380, 'GP-17-521', 'GP-17-521', 'VARGAS, JASUNE', 'Production 1', 'technician_staff3@glory.com.ph', 'user'),
(381, 'GP-17-521', 'GP-17-521', 'VARGAS, JASUNE', 'Production 1', 'technician_staff3@glory.com.ph', 'user'),
(385, 'GP-05-167', 'GP-05-167', 'VIDAL JR., REYNALDO', 'Production 2', 'r.vidal@glory.com.ph', 'user'),
(386, 'GP-18-606', 'GP-18-606', 'VILLANROQUE, NEMFA', 'Purchasing', 'n.villanroque@glory.com.ph', 'user'),
(387, 'GP-18-606', 'GP-18-606', 'VILLANROQUE, NEMFA', 'Purchasing', 'n.villanroque@glory.com.ph', 'user'),
(390, 'GP-17-522', 'GP-17-522', 'VILLARAZA, JESHAYDEL', 'Parts Inspection', 'pistaff2@glory.com.ph', 'user'),
(391, 'GP-17-522', 'GP-17-522', 'VILLARAZA, JESHAYDEL', 'Parts Inspection', 'pistaff2@glory.com.ph', 'user'),
(392, 'GP-06-193', 'GP-06-193', 'VILLASANTA, MICHAEL', 'Production 1', 'm.villasanta@glory.com.ph', 'user'),
(395, 'GP-10-244', 'GP-10-244', 'YACON, DESERIE', 'PPIC', 'd.ayos@glory.com.ph', 'user'),
(396, 'GP-10-268', 'GP-10-268', 'YALUNG, IDHONNAH', 'PPIC', 'i.yalung@glory.com.ph', 'user'),
(397, 'GP-22-718', 'GP-22-718', 'Antonio Negrite Jr', 'Administration', 'a.negrite@glory.com.ph', 'fem'),
(400, 'CG-0676', 'CG-0676', 'EDVIR LUMAGUI', 'Administration', 'fem.staff@glory.com.ph', 'fem'),
(402, 'fem', 'fem', 'Francisco Ramirez', 'Administration', 'f.ramirez@glory.com.ph', 'fem'),
(403, 'GP-22-756', 'GP-22-756', 'FRANK B. APIL', 'Administration', 'f.apil@glory.com.ph', 'fem'),
(404, 'CG-1420', 'CG-1420', 'Jenmark Rondero', 'Administration', 'f.ramirez@glory.com.ph', 'fem'),
(405, 'GP-11-301', 'GP-11-301', 'MAGAT, ROEL', 'Administration', 'r.magat@glory.com.ph', 'fem'),
(406, 'CG-0827', 'CG-0827', 'Mark Lawrence Lopez', 'Administration', 'f.ramirez@glory.com', 'fem'),
(407, 'GP-17-516', 'GP-17-516', 'NATUEL, JONATHAN JR.', 'Administration', 'fem1@glory.com.ph', 'fem'),
(408, 'GP-22-730', 'GP-22-730', 'PARMA, RALPH GABRIEL', 'Administration', 'femstaff@glory.com.ph', 'fem'),
(409, 'CG-0712', 'CG-0712', 'RALPH GABRIEL PARMA', 'Administration', 'f.ramirez@glory.com.ph', 'fem'),
(410, 'GP-16-478', 'GP-16-478', 'SIERRA, JOHN CARLO', 'Administration', 'jc.sierra@glory.com.ph', 'fem'),
(411, 'GP-97-059', 'GP-97-059', 'BAUTISTA, ELMER', 'Direct Operation Kaizen', 'e.bautista@glory.com.ph', 'head'),
(412, 'GP-12-321', 'GP-12-321', 'Benjie Paras', 'Parts Inspection', 'b.paras@glory.com.ph', 'head'),
(413, 'GP-06-185', 'GP-06-185', 'BERI, GERINA', 'Accounting', 'g.beri@glory.com.ph', 'head'),
(414, 'GP-10-273', 'GP-10-273', 'CALALO, GEMMA', 'Administration', 'g.anda@glory.com.ph', 'head'),
(415, 'GP-11-277', 'GP-11-277', 'CATIGAN, NOLIESON', 'Production Technology', 'n.catigan@glory.com.ph', 'head'),
(416, 'GP-21-708', 'GP-21-708', 'FUKUNAGA, SHIGEYUKI ', 'Japanese', 's.fukunaga@glory.com.ph', 'head'),
(417, 'GP-14-381', 'GP-14-381', 'GELLE, NERIO', 'Purchasing', 'n.gelle@glory.com.ph', 'head'),
(418, 'lem', 'lem', 'Lemuel Semillano', 'Production 1', 'l.semillano@glory.com.ph', 'head'),
(419, 'GP-97-055', 'GP-97-055', 'LISBOA, DINA', 'Production 2', 'd.lisboa@glory.com.ph', 'head'),
(420, 'GP-14-397', 'GP-14-397', 'LONTOC, ARLENE', 'Quality Assurance', 'a.delapaz@glory.com.ph', 'head'),
(421, 'GP-11-305', 'GP-11-305', 'MONZON, RIO', 'Administration', 'r.monzon@glory.com.ph', 'head'),
(423, 'GP-19-653', 'GP-19-653', 'OZAWA, TOMOYUKI ', 'Japanese', 't.ozawa@glory.com.ph', 'head'),
(424, 'GP-98-079', 'GP-98-079', 'PINPIN, CHERRY', 'Production Support', 'c.pinpin@glory.com.ph', 'head'),
(425, 'GP-94-005', 'GP-94-005', 'REYES, RAYMOND', 'Quality Assurance', 'r.reyes@glory.com.ph', 'head'),
(426, 'GP-11-310', 'GP-11-310', 'SAPALASAN, ELOISA', 'Parts Production', 'e.sapalasan@glory.com.ph', 'head'),
(427, 'GP-03-158', 'GP-03-158', 'SEMILLANO, LYZIEL', 'Purchasing', 'l.sanchez@glory.com.ph', 'head'),
(428, 'GP-10-271', 'GP-10-271', 'SHERMAYNE, COSA', 'System Kaizen', 's.pepito@glory.com.ph', 'head'),
(429, 'GP-10-269', '5022011', 'Sheryll Ramirez', 'PPIC', 's.ramirez@glory.com.ph', 'head'),
(430, 'GP-20-691', 'GP-20-691', 'TOKU, AKIRA ', 'Japanese', 'a.toku@glory.com.ph', 'head'),
(431, 'GP-01-115', 'GP-01-115', 'Wilma, Logrono', 'Quality Control', 'w.logrono@glory.com.ph', 'head'),
(432, 'CG-1374', 'CG-1374', 'Aileen D. Domo', 'Administration', 'mis.staff@glory.com.ph', 'mis'),
(433, 'GP-22-722', 'GP-22-722', 'Cedrick James M. Orozo', 'Administration', 'mis.dev@glory.com.ph', 'mis'),
(434, 'GP-22-729', 'GP-22-729', 'Kevin Roy Marero', 'Administration', 'mis.support@glory.com.ph', 'mis'),
(435, 'mis', 'm1s', 'Nathan Nemedez', 'Administration', 'j.nemedez@glory.com.ph', 'mis'),
(436, 'CG-1732', 'CG-1732', 'SANDIGAN, JOHN SPENCER', 'Administration', 'mis.techsupport@glory.com.ph', 'mis'),
(437, 'GP-17-571', 'GP-17-571', 'VIVO, FELMHAR', 'Administration', 'mis@glory.com.ph', 'mis'),
(438, 'GP-123-456', 'GP-123-456', 'Eleven', ' Quality Control', 'eleven@glory.com.ph', 'user'),
(439, 'GP-123-45623', 'GP-123-456', 'Dustin ', ' Administration', 'dustin@glory.com.ph', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmsaction`
--
ALTER TABLE `pmsaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmsschedule`
--
ALTER TABLE `pmsschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sender`
--
ALTER TABLE `sender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT for table `pmsaction`
--
ALTER TABLE `pmsaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pmsschedule`
--
ALTER TABLE `pmsschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `sender`
--
ALTER TABLE `sender`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
