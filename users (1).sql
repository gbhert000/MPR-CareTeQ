-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 14, 2022 at 04:04 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` int(2) NOT NULL DEFAULT 0,
  `COMPANY` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `companyCode` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `BRANCH` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `userName`, `user_role`, `COMPANY`, `companyCode`, `BRANCH`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Kier Aguilar', '', 0, '', '', '', 'kier@gmail.com', NULL, '$2y$10$GdGw.wShy1QTkQLs5cJbX.1WVL1RXIFy/cSDw9WEZ1tuW/CLv/YmW', NULL, NULL, NULL, '9UCMeuI8VY8eJdp6557RkU0CYrKFIAEbgldQOYlf37wI193KWIHtzeuPwXWx', NULL, NULL, '2022-07-31 16:10:08', '2022-07-31 16:10:08'),
(83, 'Kier Aguilar', 'kraglr25', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'obito@gmail.com', NULL, '$2y$10$1XGCCuIfMJiyPaNKb/JG5eedWUXYX63mjbG0/XSWs.y/VRCtgseNa', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 16:05:23', '2022-08-23 16:05:23'),
(87, 'aguilar, kier  ', 'obito', 0, 'Eastern Pangasinan District Hospital', 'EPDH', NULL, 'cardodalisay182517@gmail.com', '2022-08-30 05:37:24', '$2y$10$eCfkscYcVdmN5CH3AGQ9..A2q.7KafLL09wSLjqCir2wPf5tizQc.', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 00:40:06', '2022-08-30 05:37:24'),
(91, 'aguilar, kier  ', 'kraglr25asd', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'aguilarkier17@gmail.com', '2022-08-30 01:00:30', '$2y$10$GES5x1289NcznOFw40SpbuwDxsgGtzRzdPE9syfVdexmyWatP63H2', NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-30 00:58:26', '2022-08-30 01:00:30'),
(115, 'aguilar, kier  ', 'obito_k', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'klaguilar.1doc@gmail.com', '2022-09-06 01:46:27', '$2y$10$2xjRSGrNqZvoIB0s.uGrleVXABuNdS.lVJjECgVMah518hfNKh4bS', NULL, NULL, NULL, 'bE377GKkaSZ0nmeszXahXhgS144clCmlrgkiK74WMR580oI3RSbpoUW6kkiR', NULL, NULL, '2022-09-06 01:45:18', '2022-09-06 05:48:32'),
(118, 'Retiro, Gilbert  ', 'gibo777', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'glretiro.1doc@gmail.com', '2022-09-06 04:59:18', '$2y$10$STxCugAtFp.ZhWfKRkhgbuDJgoORzxYDFASa.ZnRo8gGKdbA/J7vm', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-06 04:58:37', '2022-09-06 04:59:18'),
(132, 'Delos reyes, Gilbert Dordas ', 'gbhert09', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'gbhert09@gmail.com', '2022-09-06 21:17:19', '$2y$10$AskfaJNcbcTf.nhL9l07bu4BllDzm2hoagHfHIyKizRcKg.TPE84W', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-06 21:14:33', '2022-09-06 21:17:19'),
(133, 'palisoc, jay vee ', 'palisoc_jv', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'jbpalisoc.1doc@gmail.com', '2022-09-06 22:00:41', '$2y$10$pMiWWeWPvvHuMEl75lno4OmmmGpQXumvd7bpxwFK/eqLyEIbskXHi', NULL, NULL, NULL, 'eRwJgZbSttiYsRlXeBThHZXkl4BNom0IWpqCargktFdzrHJtTwbtKvDWeCkw', NULL, NULL, '2022-09-06 21:25:07', '2022-09-11 19:15:14'),
(135, 'daniel, allysa s ', 'daniel_a', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'asdaniel.1doc@gmail.com', '2022-09-06 21:34:23', '$2y$10$yybuWCXRAPxETfAzKuussutAJFUoD73WeTGExihjlFmzFaJzdxSzK', NULL, NULL, NULL, 'cAmHrzjSSWivxbB3hbjpx4jqleacPlOUphRFccKwJdkTp6j04wkT4fqS3hgJ', NULL, NULL, '2022-09-06 21:28:12', '2022-09-06 21:34:23'),
(136, 'Francia, Nicaella Sapida ', 'francia_n', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'nsfrancia.1doc@gmail.com', '2022-09-06 21:29:15', '$2y$10$KFtSdfQ/QJQrfhigBYXCKuLlrU3rFVtLA3106I07IVI1MBRNZiIg6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-06 21:28:55', '2022-09-06 21:29:15'),
(143, 'Ricafrente, Jose Andrei  ', 'ricafrente_j', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'avricafrente@gmail.com', NULL, '$2y$10$Tl8lNhjcSPfKURwCeEpF9e1SaURp1TZJJ740N.bJiQt3gP3M4IHhi', NULL, NULL, NULL, 'Fz3uUy3TtBFel1HY4ifbphHxZ8wwhMbfLli7fqyqat9l3LODyVcUJI9gU2yR', NULL, NULL, '2022-09-06 21:45:04', '2022-09-06 21:46:15'),
(145, 'aguilar, kier  ', 'luna_k', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'kraglr25@gmail.com', '2022-09-06 21:49:52', '$2y$10$OeUa1Iy6eEGJ2F/kKZbTHefqSsnPhfj/gCiNQN0KcBCF9zEhzwbmu', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-06 21:49:18', '2022-09-06 21:49:52'),
(149, 'ricafrente, akel villarosa ', 'villarosa_j', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'jvricafrente.1doc@gmail.com', '2022-09-06 22:48:27', '$2y$10$rdfp8iKd5QQPSqbwAxY.h.DihJVj3xVL1AXbV7eOz729L6uSSMvMq', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-06 22:47:51', '2022-09-06 22:48:27'),
(153, 'Francia, Nicaella  ', 'nsfrancia', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'imnicaella18@gmail.com', '2022-09-07 15:46:53', '$2y$10$HdM3hBzu4dJvwNz89xqEE.Jm7IOFXUaatA8b/F1HWaFoH/Z6Lq/Xu', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 15:45:56', '2022-09-07 15:46:53'),
(154, 'Dela Cruz, Mark Anthony Sarquilla ', 'Maks1', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'markanthony15dlc@gmail.com', '2022-09-07 15:46:37', '$2y$10$/ijsWvKz639161uacaUc/eqIZYxe6EwvcvKBEy/iaihZGctBLj5Vm', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 15:46:04', '2022-09-07 15:46:37'),
(155, 'Cureg, Manuel Gannaban Jr', 'mgcuregjr', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'mgcureg.1doc@gmail.com', '2022-09-07 15:46:40', '$2y$10$biXO5w3DGHj1VM.Q2/Tu/.2WAy8FOFKjiw/6OaCMcPDnETVPOIK9G', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 15:46:10', '2022-09-07 15:46:40'),
(156, 'Colminas, Julius B ', 'colminas_j', 0, 'Pangasinan Provincial Hospital (PPH)', 'PPH1', NULL, 'jbcolminas.1doc@gmail.com', '2022-09-07 16:04:41', '$2y$10$s.7kllXdfqbM8q7loCdWsO8qvpPVqJUQ4NBpeT6MZ7SHlM3FDI3zq', NULL, NULL, NULL, '8XXjrsWkIJdPIPylhqMNMjYxRs5KVsXiPp50TIF3XDHcrWRSvtv5JCk4vzP2', NULL, NULL, '2022-09-07 15:59:07', '2022-09-07 16:04:41'),
(157, 'Tarectecan, Wenie Jane  ', 'tarectecan_w', 0, 'Dasol Community Hospital (DCH)', 'DCH1', NULL, 'dasolcommunityhospital@gmail.com', '2022-09-07 16:48:47', '$2y$10$HgXBO1SbWE2G0djPALCVYu51KnqGqV2vsl4lG7KiJzSuUE09Z/yEe', NULL, NULL, NULL, 'Fz3TwK8GZLhVn5zMiVqX3sHjkh2wxug6oUTS0f34mxeN5hsee4YfTZiA6xiU', NULL, NULL, '2022-09-07 16:48:15', '2022-09-07 17:53:40'),
(158, 'Alvarez, Gelen  ', 'alvarez_g', 0, 'Bolinao Community Hospital (BCH)', 'BCH1', NULL, 'gelensalvarez@yahoo.com', '2022-09-07 16:49:47', '$2y$10$JRV3Ss17GbyoGv0cX8/3D.ZIsLXqfF9h25gwYjR6D6RTGW2LIYt1.', NULL, NULL, NULL, '91F6BOYKVP73eRvJCZoiyzf7tgJCfCAGnEMpvWcK4JmDCyksoABchuiNyH8t', NULL, NULL, '2022-09-07 16:48:37', '2022-09-07 17:52:30'),
(160, 'Camba, Carl Emil  ', 'camba_c', 0, 'Western Pangasinan District Hospital (WPDH)', 'WDH1', NULL, 'wpdhalaminosnew@yahoo.com', '2022-09-07 16:50:27', '$2y$10$nwk9Ra.Sf0MjJfBgfGADNeE48lPnkf1ZVF0LQf1lPKt0RNP22MCJq', NULL, NULL, NULL, 'PvR0sLIcLzoo3LEXrpfRSzhDwn5BavLmzQQ57AgbW74CBhxXmUQCOlBMcN2l', NULL, NULL, '2022-09-07 16:49:58', '2022-09-07 17:45:13'),
(161, 'Panlilio, Irwin M. ', 'panlilio_i', 0, 'Pozorrubio Community Hospital (PCH)', 'PCH1', NULL, 'pozmunhospital@gmail.com', '2022-09-07 16:50:25', '$2y$10$1umtoKEQULBayw3bsh8Ax.XTPeS/70WB.cyrn8qrr3W3nfsm0uYwy', NULL, NULL, NULL, 'HXQW3jMoJeyYbp1m8LDFebbtMyJVTSTkvQOSO1mHDGMgERXE3DLVrR8U2d0n', NULL, NULL, '2022-09-07 16:50:03', '2022-09-07 17:45:03'),
(162, 'Delcastillo, Judith  ', 'delcastillo_j', 0, 'Mapandan Community Hospital (MapCH)', 'MCH1', NULL, 'judithdelcastillo71@gmail.com', '2022-09-07 16:51:53', '$2y$10$FNEe.ZDfsoLO3tlDD3xDx.FhrW4Md9AB1jHTC.B71dkbGhKyczlnW', NULL, NULL, NULL, '0cOcIACG70xrWpzjgtLZzA6bfZh1LXZCa6ecj69v3kjKljzFOC9wlyxu7EHp', NULL, NULL, '2022-09-07 16:51:26', '2022-09-08 22:17:30'),
(164, 'Muego, Susana  ', 'muego_s1', 0, 'Urdaneta District Hospital (UDH)', 'UDH1', NULL, 'udhphilhealth@gmail.com', '2022-09-07 16:52:15', '$2y$10$KUl8mEvBiH6y/lzgVhXkgeU4Szp9qSCErVO05oJMPiG2vYWz4qUTW', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 16:51:48', '2022-09-07 16:52:15'),
(165, 'Ulanday, Jennymae Ginez  ', 'ulanday_j', 0, 'Asingan Community Hospital (ACH)', 'ACH1', NULL, 'Jenmae1120@yahoo.com', '2022-09-07 16:53:21', '$2y$10$QFLuiYQWyQGPu6xeVQmdduiwQEMOSdWdn5Xr05y43PfMUCMUE8/1W', NULL, NULL, NULL, 'xXDLPVBbXhcM9Edya4Ne830brkzzzF2Mten7Ke6oOtuTT3QyhkEyXkE5VSq3', NULL, NULL, '2022-09-07 16:52:49', '2022-09-07 17:49:33'),
(167, 'Pe, Peter  ', 'pe_p', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'phpe.1doc@gmail.com', '2022-09-07 16:55:28', '$2y$10$fZkI04hAg/J2IYsI3E12QuQPG7xN9IAw51kW.mn/nzTk4xiiVL8Oy', NULL, NULL, NULL, 'tnUMrhO5c1mmXep49RMK0OTEQAWZWumtvpul4uCOTvtBFbKoXFnt63TpoTUT', NULL, NULL, '2022-09-07 16:55:02', '2022-09-07 17:39:49'),
(169, 'Antolin, Sharon Grace  ', 'antolin_s', 0, 'Umingan Community Hospital (UCH)', 'UCH1', NULL, 'antolinsharongrace@gmail.com', '2022-09-07 16:56:48', '$2y$10$TLw9aPlkPNetvzVxgnMXPuBN.ySL3CtJjv5JiAXx.gJf5Ssq5G1IG', NULL, NULL, NULL, 'vmtyaSaC6kLO5565SPleNrzoXSoyTKBzsYdvqckLyZf2RYWeEkfAOZUX0Csq', NULL, NULL, '2022-09-07 16:56:30', '2022-09-07 17:57:40'),
(170, 'Ancheta, Marlo  ', 'ancheta_m', 0, 'Pangasinan Provincial Hospital (PPH)', 'PPH1', NULL, 'ancheta_marlo@yahoo.com', '2022-09-07 16:59:27', '$2y$10$VCtUpGnzNBtD/FHPjJalvedy/hadOrXEy/oyii4pt9asQ54yr5Hv6', NULL, NULL, NULL, 'LIZWeQfMK1Zr7eMzVn5kElmFU52IHxNFLiyKeHMrf2OZCoYyflV0tg6iTB5E', NULL, NULL, '2022-09-07 16:57:41', '2022-09-07 18:00:24'),
(172, 'Caisip, Mark Ivan M. ', 'caisip_m', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'markivancaisip@gmail.com', '2022-09-07 16:59:24', '$2y$10$jRIUcQb7FkbZZXPxKkGPKexmGSoRy1UzUnM8FPoViRqJETRvZobei', NULL, NULL, NULL, 'jeAWWJtDq1AlpZuinYKR27iKBurcXzxZRimJ4abvRZJ0BBZe6gFaWTWdxVVj', NULL, NULL, '2022-09-07 16:58:58', '2022-09-07 17:46:50'),
(173, 'Bautista, Jofrey  ', 'bautista_j', 0, 'Eastern Pangasinan District Hospital', 'EPDH', NULL, 'Popoykunone3@gmail.com', '2022-09-07 17:00:50', '$2y$10$Awd8iJ5tex0UhrHllsSb9eLacLMxR2cVd6QfdqpBotcjRTf6SryPO', NULL, NULL, NULL, '9WbaBsKrlrOjZemQzRMkamTx49evmMvyufpAz4NWRXDxHbpPVZgLg5xXcIAI', NULL, NULL, '2022-09-07 17:00:32', '2022-09-07 17:41:26'),
(174, 'Embuido, Juanito A. ', 'embuido_j', 0, 'Lingayen District Hospital (LDH)', 'LDH1', NULL, 'genpeds_au@yahoo.com', '2022-09-07 17:03:24', '$2y$10$gjMIg/TYos7gLFVC4u03DuorN0089UivpC5dwQBZYpVSGysjnKFka', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 17:01:29', '2022-09-07 17:03:24'),
(176, 'Bucala, Jhonna Mae N. ', 'bucala_j', 0, 'Manaoag Community Hospital (ManCH)', 'ManCH1', NULL, 'bucalajhonna08@gmail.com', '2022-09-07 17:05:31', '$2y$10$Z0WeUNZDCtRK79nKB6Ofg.EcYKkPSd2IN0xs59yUMxwEmxyxVWp.m', NULL, NULL, NULL, 'vSes5xsUxmLXHJfsUukxgKXqFYNUAenXfTYHAMcITRe5K2o3RAROhRIxE8pA', NULL, NULL, '2022-09-07 17:04:24', '2022-09-07 17:42:28'),
(179, 'Bugayong, Cecilia C. ', 'bugayong_c', 0, 'Mangatarem District Hospital (MDH)\n', 'MDH1', NULL, 'bugayongcecilia@gmail.com', '2022-09-07 17:08:38', '$2y$10$hApmmZvmz3EoIP.mqB74fOky6YVSCmxRqhEij/ZOoaxZn8lWRGtuC', NULL, NULL, NULL, '8v0IUp6jwqtVCNiPihatTynbBCk3HPCM1dyy9rP4zEG0MYCU3qn1GSEdglLl', NULL, NULL, '2022-09-07 17:08:16', '2022-09-07 17:40:51'),
(180, 'Muego, Susana V. ', 'Muego_S', 0, 'Urdaneta District Hospital (UDH)\n', 'UDH1', NULL, 'Svmuego8@gmail.com', '2022-09-07 17:42:39', '$2y$10$IU8hHC5TifRdlkiXFi.IYO6bY0Sn4tQVcfkySggYDnHTvGWPtnVq2', NULL, NULL, NULL, 'JN9zHhAR2XJTearlYsN1jgFo0KPzSkynQTlmOQIciyqxWm0do6mYZ3gYSvGI', NULL, NULL, '2022-09-07 17:42:15', '2022-09-07 18:09:12'),
(185, 'Aguilar, Kier Luna ', 'aguilar_k25', 0, 'Bayambang District Hospital (BDH)', 'BDH1', NULL, 'aguilarkier25@yahoo.com', '2022-09-07 17:51:41', '$2y$10$8Jb.6X0rFAPwoc4hUn.uDel.aeDiiNZuy2oQuMTxGITQ9GGhJOPCS', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-07 17:51:09', '2022-09-07 17:51:41'),
(186, 'Pioquinto, Carlo dominick F. ', 'pioquinto_c', 0, 'Mapandan Community Hospital (MapCH)\n', 'MCH1', NULL, 'carlos.dominick.pioquinto.com@gmail.com', '2022-09-07 17:59:02', '$2y$10$vmPw1gmnBrVhScsbcR5ESuryaFK1bLHfzRfw2obuGJwun9U0OyZdS', NULL, NULL, NULL, 'nQQnkYBtrlh3YjTX601SzGuMNdtMuoneDIOhP2GPsMMJV4GEiydccsToY7pC', NULL, NULL, '2022-09-07 17:58:37', '2022-09-07 18:01:03'),
(187, 'Embuido, Juanito E ', 'embuido_j1', 0, 'Lingayen District Hospital (LDH)', 'LDH1', NULL, 'jroaofficial02@gmail.com', '2022-09-07 18:04:06', '$2y$10$cmIKPFR9qhD1peaXWCP4tuVoe38X38TW0c22paJlBoA2rAZp5ajQ6', NULL, NULL, NULL, 'oaoyosDNQ3p8p9TuXchQ4fNilCdwfL1y6CRnsELS3Rs6VfDvCdYOeJmms3io', NULL, NULL, '2022-09-07 17:58:55', '2022-09-07 18:04:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
