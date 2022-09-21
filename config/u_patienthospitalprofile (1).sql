-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 21, 2022 at 08:38 AM
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
-- Database: `careteq`
--

-- --------------------------------------------------------

--
-- Table structure for table `u_patienthospitalprofile`
--

CREATE TABLE `u_patienthospitalprofile` (
  `id` int(11) NOT NULL,
  `CODE` text DEFAULT NULL,
  `U_FIRSTNAME` text DEFAULT NULL,
  `U_MIDDLENAME` text DEFAULT NULL,
  `U_LASTNAME` text DEFAULT NULL,
  `U_EXTNAME` text DEFAULT NULL,
  `NAME` text DEFAULT NULL,
  `HOSPITALCODE` text DEFAULT NULL,
  `HOSPITALNAME` varchar(100) NOT NULL,
  `HOSPITALID` text DEFAULT NULL,
  `NHFR` int(11) DEFAULT NULL,
  `idSeries` varchar(11) DEFAULT NULL,
  `EDITEDBY` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `dateCreated` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `u_patienthospitalprofile`
--

INSERT INTO `u_patienthospitalprofile` (`id`, `CODE`, `U_FIRSTNAME`, `U_MIDDLENAME`, `U_LASTNAME`, `U_EXTNAME`, `NAME`, `HOSPITALCODE`, `HOSPITALNAME`, `HOSPITALID`, `NHFR`, `idSeries`, `EDITEDBY`, `note`, `dateCreated`) VALUES
(1, '8780-7864-6919', 'AS', '', 'ASD', '', 'ASD , AS  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000001', 4320, NULL, '', 'Registration', '0000-00-00'),
(3, '8780-7864-6921', 'ASASXX', '', 'ASDSDAS', '', 'ASDSDAS , ASASXX  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000002', 4320, NULL, '', 'Registration', '0000-00-00'),
(4, '8780-7864-6922', 'ASDASD', '', 'ASD', '', 'ASD , ASDASD  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000003', 4320, NULL, '', 'Registration', '0000-00-00'),
(5, '8780-7864-6923', 'YOO', '', 'JEONGYEON', '', 'JEONGYEON , YOO  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000004', 5829, NULL, '', 'Registration', '0000-00-00'),
(6, '8780-7864-6924', 'JENNIE', '', 'KIM', '', 'KIM , JENNIE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000005', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(7, '8780-7864-6925', 'JISOO', '', 'KIM', '', 'KIM , JISOO  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000006', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(8, '8780-7864-6926', 'ADAM WILSON', '', 'IBARROLLA', '', 'IBARROLLA , ADAM WILSON  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000007', 4320, NULL, 'kraglr25', 'Registration', '0000-00-00'),
(9, '8780-7864-6927', 'VINCENT', '', 'SUAREZ', '', 'SUAREZ, VINCENT  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000008', 4320, NULL, 'kraglr25', 'Registration', '0000-00-00'),
(10, '8780-7864-6930', 'KENT CLARK', '', 'CONSTANTINO', '', 'CONSTANTINO, KENT CLARK  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000009', 4320, NULL, 'kraglr25', 'Registration', '0000-00-00'),
(11, '8780-7864-6931', 'ANNE HARRIETTE', '', 'PONTIOSO', '', 'PONTIOSO, ANNE HARRIETTE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000010', 4320, NULL, 'kraglr25', 'Registration', '0000-00-00'),
(12, '8780-7864-6931', 'ANNE HARRIETTE', '', 'PONTIOSO', '', 'PONTIOSO, ANNE HARRIETTE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000011', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(13, '8780-7864-6932', 'MARC BILLIE', '', 'SANCHO', '', 'SANCHO, MARC BILLIE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000012', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(21, '8780-7864-6931', 'ANNE HARRIETTE', '', 'PONTIOSO', '', 'PONTIOSO, ANNE HARRIETTE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000011', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(22, '8780-7864-6931', 'ANNE HARRIETTE', '', 'PONTIOSO', '', 'PONTIOSO, ANNE HARRIETTE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000011', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(28, '8780-7864-6933', 'NICKIE', 'VELUZ', 'AGUILAR', '', 'AGUILAR, NICKIE VELUZ ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000013', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(32, '8780-7864-6934', 'CRIZZA', '', 'CADA', '', 'CADA, CRIZZA  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000014', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(34, '8780-7864-6934', NULL, NULL, NULL, NULL, 'CADA, CRIZZA', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000014', 5829, NULL, 'kraglr', 'Create Visit', '0000-00-00'),
(35, '8780-7864-6931', NULL, NULL, NULL, NULL, 'PONTIOSO, ANNE HARRIETTE', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000011', 5829, NULL, 'kraglr', 'Create Visit', '0000-00-00'),
(36, '8780-7864-6935', 'KENT CLARK', '', 'CONSTANTINO', '', 'CONSTANTINO, KENT CLARK  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000015', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(38, '8780-7864-6935', NULL, NULL, NULL, NULL, 'CONSTANTINO, KENT CLARK', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000015', 5829, NULL, 'kraglr', 'Create Visit', '0000-00-00'),
(39, '8780-7864-6931', 'ANNE HARRIETTE', '', 'PONTIOSO', '', 'PONTIOSO, ANNE HARRIETTE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000011', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(42, '8780-7864-6932', 'MARC BILLIE', '', 'SANCHO', '', 'SANCHO, MARC BILLIE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000017', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(43, '8780-7864-6934', 'CRIZZA', '', 'CADA', '', 'CADA, CRIZZA  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000018', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(44, '8780-7864-6935', 'KENT CLARK', '', 'CONSTANTINO', '', 'CONSTANTINO, KENT CLARK  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000019', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(45, '8780-7864-6934', 'CRIZZA', '', 'CADA', '', 'CADA, CRIZZA  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000020', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(46, '8780-7864-6926', NULL, NULL, NULL, NULL, 'IBARROLLA, ADAM WILSON', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000007', 4320, NULL, 'kraglr25', 'Create Visit', '0000-00-00'),
(47, '8780-7864-6933', 'NICKIE', 'VELUZ', 'AGUILAR', '', 'AGUILAR, NICKIE VELUZ ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000021', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(48, '8780-7864-6932', 'MARC BILLIE', '', 'SANCHO', '', 'SANCHO, MARC BILLIE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000022', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(49, '8780-7864-6925', 'JISOO', '', 'KIM', '', 'KIM, JISOO  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000023', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(50, '8780-7864-6936', 'BARRY', '', 'ALLEN', '', 'ALLEN, BARRY  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000024', 4320, NULL, 'kraglr25', 'Registration', '0000-00-00'),
(51, '8780-7864-6924', 'JENNIE', '', 'KIM', '', 'KIM, JENNIE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000025', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(52, '8780-7864-6936', 'BARRY', '', 'ALLEN', '', 'ALLEN, BARRY  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000026', 5829, NULL, 'kraglr', 'Update', '0000-00-00'),
(53, '8780-7864-6925', NULL, NULL, NULL, NULL, 'KIM, JISOO', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000006', 5829, NULL, 'kraglr', 'Create Visit', '0000-00-00'),
(54, '8780-7864-6937', 'OLIVER', '', 'QUEEN', '', 'QUEEN, OLIVER  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000027', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(55, '8780-7864-6938', 'FELICITY', '', 'QUEEN', '', 'QUEEN, FELICITY  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-0000028', 5829, NULL, 'kraglr', 'Registration', '0000-00-00'),
(56, '8780-7864-6938', 'FELICITY', '', 'QUEEN', '', 'QUEEN, FELICITY  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000029', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(57, '8780-7864-6937', 'OLIVER', '', 'QUEEN', '', 'QUEEN, OLIVER  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000030', 4320, NULL, 'kraglr25', 'Update', '0000-00-00'),
(58, '8780-7864-6943', 'JOHN MARK', '', 'PARAY', '', 'PARAY, JOHN MARK  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'kraglr25', 'Registration', NULL),
(59, '8780-7864-6944', 'SOMIN', '', 'JUNG', '', 'JUNG, SOMIN  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'kraglr25', 'Registration', '2022-08-30'),
(60, '8780-7864-6945', 'SHIN-HYE', '', 'PARK', '', 'PARK, SHIN-HYE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-000000045', 4320, '000000045', 'kraglr25', 'Registration', '2022-08-30'),
(61, '8780-7864-6946', 'SHAIRA MAE', '', 'ASENJO', '', 'ASENJO, SHAIRA MAE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-0000017', 4320, '0000017', 'kraglr25asd', 'Registration', '2022-08-30'),
(62, '8780-7864-6947', 'LAURENCE', '', 'VEGERANO', '', 'VEGERANO, LAURENCE  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'obito', 'Registration', '2022-08-30'),
(63, '8780-7864-6948', 'TRICIA', '', 'LOPEZ', '', 'LOPEZ, TRICIA  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-000057893', 5829, '000057893', 'obito', 'Registration', '2022-08-30'),
(64, '8780-7864-6949', 'JAMAICA', '', 'TIAMA', '', 'TIAMA, JAMAICA  ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'obito', 'Registration', '2022-08-30'),
(65, '8780-7864-6950', 'JOSE ANDREI', 'VVVVV', 'RICAFRENTE', '', 'RICAFRENTE, JOSE ANDREI VVVVV ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-123123123', 4320, '123123123', 'ricafrente_ja', 'Registration', '2022-08-31'),
(66, '8780-7864-6951', 'ALLYSA', '', 'DANIEL', '', 'DANIEL, ALLYSA  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'dalisay_CA', 'Registration', '2022-09-01'),
(67, '8780-7864-6952', 'HUBERT BLAINE', '', 'WOLFESCHLEGELSTEINHAUSENBERGERDORFF', '', 'WOLFESCHLEGELSTEINHAUSENBERGERDORFF, HUBERT BLAINE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'dalisay_CA', 'Registration', '2022-09-01'),
(68, '8780-7864-6953', 'KAYCEE', '', 'AGUILAR', '', 'AGUILAR, KAYCEE  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'dalisay_CA', 'Registration', '2022-09-01'),
(69, '8780-7864-6954', 'ALYSSA', 'DANIEL', 'SAYAT', '', 'SAYAT, ALYSSA DANIEL ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'daniel_a', 'Registration', '2022-09-02'),
(70, '8780-7864-6955', 'TOM', '', 'COS', '', 'COS, TOM  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-056666', 4320, '056666', 'dalisay_CA', 'Registration', '2022-09-02'),
(71, '8780-7864-6956', 'NATZU', '', 'DRAGNEEL', '', 'DRAGNEEL, NATZU  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'dalisay_CA', 'Registration', '2022-09-02'),
(72, '8780-7864-6957', 'LUCY', '', 'MORNINGSTAR', '', 'MORNINGSTAR, LUCY  ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'dalisay_CA', 'Registration', '2022-09-02'),
(73, '8780-7864-6958', 'JACK', 'COULDN\'T REACH', 'REACHER', '', 'REACHER, JACK COULDN\'T REACH ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'dalisay_CA', 'Registration', '2022-09-02'),
(74, '8780-7864-6959', 'MAVERICK', 'NA', 'AIRFORCE', '', 'AIRFORCE, MAVERICK NA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-26656532', 4320, '26656532', 'dalisay_CA', 'Registration', '2022-09-02'),
(75, '8780-7864-6960', 'JULIUS', 'B', 'COLMINAS', '', 'COLMINAS, JULIUS B ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'colminas_j', 'Registration', '2022-09-02'),
(76, '8780-7864-6961', 'GRAY', '', 'FULLBUSTER', '', 'FULLBUSTER, GRAY  ', 'LDH1', 'Lingayen District Hospital (LDH)', '01824-', 1824, NULL, 'aguilar_k', 'Registration', '2022-09-02'),
(77, '8780-7864-6962', 'LUFFY', 'D.', 'MONKEY', '', 'MONKEY, LUFFY D. ', 'LDH1', 'Lingayen District Hospital (LDH)', '01824-', 1824, NULL, 'aguilar_k', 'Registration', '2022-09-03'),
(78, '8780-7864-6963', 'ERZA', 'NA', 'SCARLET', '', 'SCARLET, ERZA NA ', 'LDH1', 'Lingayen District Hospital (LDH)', '01824-123456789', 1824, '123456789', 'aguilar_k', 'Registration', '2022-09-03'),
(79, '8780-7864-6964', 'ASDASD', '', 'ASDASD', '', 'ASDASD, ASDASD  ', 'PPH1', 'Pangasinan Provincial Hospital (PPH)', '01917-asdasd', 1917, 'asdasd', 'dalisay_CA', 'Registration', '2022-09-04'),
(80, '8780-7864-6965', 'AKEL', 'AKEL', 'AKEL', '', 'AKEL, AKEL AKEL ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'ricafrente_ja', 'Registration', '2022-09-04'),
(81, '8780-7864-6966', 'NNNNNNNN', 'NJJJJJJJJJJJJJ', 'NNNNNNNN', '', 'NNNNNNNN, NNNNNNNN NJJJJJJJJJJJJJ ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'ricafrente_ja', 'Registration', '2022-09-04'),
(82, '8780-7864-6968', 'BBBB', 'ASD', 'BBBBB', '', 'BBBBB, BBBB ASD ', 'PPH1', 'Pangasinan Provincial Hospital (PPH)', '01917-1236547889', 1917, '1236547889', 'dalisay_CA', 'Registration', '2022-09-04'),
(83, '8780-7864-6969', 'KIRIGAYA', 'NA', 'KAZUTO', '', 'KAZUTO, KIRIGAYA NA ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'obito', 'Registration', '2022-09-04'),
(96, '8780-7864-6970', 'JAMES', 'ONG', 'APOSTOL', '', 'APOSTOL, JAMES ONG ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'obito_k', 'Registration', '2022-09-08'),
(97, '8780-7864-6971', 'CARLOS DOMINICK', 'F', 'PIOQUINTO', '', 'PIOQUINTO, CARLOS DOMINICK F ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'pioquinto_c', 'Registration', '2022-09-08'),
(98, '8780-7864-6972', 'MARLO', 'GOMEZ', 'ANCHETA', '', 'ANCHETA, MARLO GOMEZ ', 'PPH1', 'Pangasinan Provincial Hospital (PPH)', '01917-', 1917, NULL, 'ancheta_m', 'Registration', '2022-09-08'),
(99, '8780-7864-6973', 'JUANITO', 'ASCRATE', 'EMBUIDO', '', 'EMBUIDO, JUANITO ASCRATE ', 'LDH1', 'Lingayen District Hospital (LDH)', '01824-123456', 1824, '123456', 'embuido_j1', 'Registration', '2022-09-08'),
(100, '8780-7864-6974', 'JHONNA MAE', 'NILO', 'BUCALA', '', 'BUCALA, JHONNA MAE NILO ', 'ManCH1', 'Manaoag Community Hospital (ManCH)', '04280-2022-0001', 4280, '2022-0001', 'bucala_j', 'Registration', '2022-09-08'),
(101, '8780-7864-6975', 'IRWIN', 'MANANDEG', 'PANLILIO', '', 'PANLILIO, IRWIN MANANDEG ', 'PCH1', 'Pozorrubio Community Hospital (PCH)', '02819-2022-000111', 2819, '2022-000111', 'panlilio_i', 'Registration', '2022-09-08'),
(102, '8780-7864-6976', 'CARL EMIL', 'TAWATAO', 'CAMBA', '', 'CAMBA, CARL EMIL TAWATAO ', 'WDH1', 'Western Pangasinan District Hospital (WPDH)', '03374-108108', 3374, '108108', 'camba_c', 'Registration', '2022-09-08'),
(103, '8780-7864-6977', 'SHARON GRACE', 'LEAL', 'ANTOLIN', '', 'ANTOLIN, SHARON GRACE LEAL ', 'UCH1', 'Umingan Community Hospital (UCH)', '02854-2022-00001', 2854, '2022-00001', 'antolin_s', 'Registration', '2022-09-08'),
(104, '8780-7864-6978', 'WENIE JANE', 'ROMERO', 'TARECTECAN', '', 'TARECTECAN, WENIE JANE ROMERO ', 'DCH1', 'Dasol Community Hospital (DCH)', '00475-2021-0478', 475, '2021-0478', 'tarectecan_w', 'Registration', '2022-09-08'),
(105, '8780-7864-6979', 'JENNYMAE', 'GINEZ', 'ULANDAY', '', 'ULANDAY, JENNYMAE GINEZ ', 'ACH1', 'Asingan Community Hospital (ACH)', '05939-', 5939, NULL, 'ulanday_j', 'Registration', '2022-09-08'),
(106, '8780-7864-6980', 'GELEN', 'SALES', 'ALVAREZ', '', 'ALVAREZ, GELEN SALES ', 'BCH1', 'Bolinao Community Hospital (BCH)', '07479-201122', 7479, '201122', 'alvarez_g', 'Registration', '2022-09-08'),
(107, '8780-7864-6981', 'MARK IVAN', 'MALLARI', 'CAISIP', '', 'CAISIP, MARK IVAN MALLARI ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-123456', 4320, '123456', 'caisip_m', 'Registration', '2022-09-08'),
(108, '8780-7864-6982', 'PETER', '-', 'PE', '', 'PE, PETER - ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-123456', 4320, '123456', 'pe_p', 'Registration', '2022-09-08'),
(109, '8780-7864-6983', 'JEROME', 'LABING', 'DELOS SANTOS', '', 'DELOS SANTOS, JEROME LABING ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'Maks1', 'Registration', '2022-09-08'),
(110, '8780-7864-6984', 'AAA', 'A', 'AAAA', '', 'AAAA, AAA A ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'obito_k', 'Registration', '2022-09-08'),
(111, '8780-7864-6985', 'SUSANA', 'VELICARIA', 'MUEGO', '', 'MUEGO, SUSANA VELICARIA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'obito_k', 'Registration', '2022-09-08'),
(112, '8780-7864-6986', 'CECILIA', 'CRUZ', 'BUGAYONG', '', 'BUGAYONG, CECILIA CRUZ ', 'PPH1', 'Pangasinan Provincial Hospital (PPH)', '01917-22011400', 1917, '22011400', 'colminas_j', 'Registration', '2022-09-08'),
(113, '8780-7864-6987', 'JUAN', 'A', 'DELACRUZ', '', 'DELACRUZ, JUAN A ', 'LDH1', 'Lingayen District Hospital (LDH)', '01824-', 1824, NULL, 'embuido_j1', 'Registration', '2022-09-08'),
(114, '8780-7864-6988', 'KHLOE MARGARETH', 'AGUILAR', 'MELENDEZ', '', 'MELENDEZ, KHLOE MARGARETH AGUILAR ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'aguilar_k25', 'Registration', '2022-09-08'),
(115, '8780-7864-6989', 'ROMERO', 'DELOS SANTOS', 'WENIE', '', 'WENIE, ROMERO DELOS SANTOS ', 'DCH1', 'Dasol Community Hospital (DCH)', '00475-2021-4087', 475, '2021-4087', 'tarectecan_w', 'Registration', '2022-09-08'),
(116, '8780-7864-6990', 'ASD', 'ASD', 'ASD', '', 'ASD, ASD ASD ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'aguilar_k25', 'Registration', '2022-09-12'),
(117, '8780-7864-6991', 'TEST', 'TEST', 'TEST', '', 'TEST, TEST TEST ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'aguilar_k25', 'Registration', '2022-09-13'),
(118, '8780-7864-6992', 'ASD', 'ASD', 'ASD', '', 'ASD, ASD ASD ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'obito', 'Registration', '2022-09-14'),
(119, '8780-7864-6993', 'PALISOC', 'BAUTISTA', 'JOHN JAYVEE', '', 'JOHN JAYVEE, PALISOC BAUTISTA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'palisoc_jv', 'Registration', '2022-09-15'),
(120, '8780-7864-6994', 'BORAT', 'DY', 'ANIMAL', '', 'ANIMAL, BORAT DY ', 'WDH1', 'Western Pangasinan District Hospital (WPDH)', '03374-0001111', 3374, '0001111', 'camba_c', 'Registration', '2022-09-15'),
(121, '8780-7864-6995', 'TRAFAGAL', 'D', 'LAW', '', 'LAW, TRAFAGAL D ', 'PPH1', 'Pangasinan Provincial Hospital (PPH)', '01917-', 1917, NULL, 'colminas_j', 'Registration', '2022-09-15'),
(122, '8780-7864-6996', 'LEONARD', 'COOPER', 'HOFSTADER', '', 'HOFSTADER, LEONARD COOPER ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'francia_n', 'Registration', '2022-09-15'),
(123, '8780-7864-6997', 'DVKLSJDKVH', 'EQWEQ', 'QWEQWE', '', 'QWEQWE, DVKLSJDKVH EQWEQ ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'obito', 'Registration', '2022-09-15'),
(124, '8780-7864-6998', 'KIER', 'LUNA', 'AGUILAR', '', 'AGUILAR, KIER LUNA ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'obito', 'Registration', '2022-09-15'),
(125, '8780-7864-6999', 'IVAN', 'NA', 'YUSON', '', 'YUSON, IVAN NA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'francia_n', 'Registration', '2022-09-15'),
(126, '8780-7864-7000', 'JOSHUA', 'VILLAROSA', 'ROMALES', '', 'ROMALES, JOSHUA VILLAROSA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'villarosa_j', 'Registration', '2022-09-16'),
(127, '8780-7864-7001', 'TONY', 'TONY', 'CHOPPER', '', 'CHOPPER, TONY TONY ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'Tersej', 'Registration', '2022-09-16'),
(128, '8780-7864-7002', 'MIKU', '01', 'HATSUNE', '', 'HATSUNE, MIKU 01 ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'Tersej', 'Registration', '2022-09-19'),
(129, '8780-7864-7003', 'LORIEL', 'PAULITE', 'MANABAT', '', 'MANABAT, LORIEL PAULITE ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'aguilar_k25', 'Registration', '2022-09-19'),
(130, '8780-7864-7004', 'CHERRY', 'GODZILLA', 'COSWAY', '', 'COSWAY, CHERRY GODZILLA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-098988', 4320, '098988', 'villarosa_j', 'Registration', '2022-09-20'),
(131, '8780-7864-7005', 'QWERTY', 'QWERTY', 'QWERTY', '', 'QWERTY, QWERTY QWERTY ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'aguilar_k17', 'Registration', '2022-09-20'),
(132, '8780-7864-7006', 'DENVER', '-', 'ARQUIZA', '', 'ARQUIZA, DENVER - ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'aguilar_k17', 'Registration', '2022-09-20'),
(133, '8780-7864-7007', 'ENRIQUE', 'T.', 'EUPALAO', '', 'EUPALAO, ENRIQUE T. ', 'EPDH', 'Eastern Pangasinan District Hospital', '05829-', 5829, NULL, 'aguilar_k17', 'Registration', '2022-09-20'),
(134, '8780-7864-7008', 'JOAN', 'PARAO', 'FE', '', 'FE, JOAN PARAO ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'daniel_a', 'Registration', '2022-09-21'),
(135, '8780-7864-7009', 'AKEL', 'VILLAROSA', 'RICAFRENTE', '', 'RICAFRENTE, AKEL VILLAROSA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-99999999999', 4320, '99999999999', 'villarosa_j', 'Registration', '2022-09-21'),
(136, '8780-7864-7010', 'LUFFY', 'MONKEY', 'D', '', 'D, LUFFY MONKEY ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-', 4320, NULL, 'justo_f', 'Registration', '2022-09-21'),
(137, '8780-7864-7011', 'ANDREI', 'RIRCA', 'VILLAROSA', '', 'VILLAROSA, ANDREI RIRCA ', 'BDH1', 'Bayambang District Hospital (BDH)', '04320-88888888888', 4320, '88888888888', 'villarosa_j', 'Registration', '2022-09-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `u_patienthospitalprofile`
--
ALTER TABLE `u_patienthospitalprofile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `u_patienthospitalprofile`
--
ALTER TABLE `u_patienthospitalprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
