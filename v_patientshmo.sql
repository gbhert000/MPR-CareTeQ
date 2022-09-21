-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 21, 2022 at 07:05 AM
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
-- Database: `CareTeQ`
--

-- --------------------------------------------------------

--
-- Structure for view `v_patientshmo`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_patientshmo`  AS SELECT `a`.`CODE` AS `Code`, `b`.`identifier` AS `Firstidentifier`, `b`.`clientType` AS `FirstclientType`, `b`.`hmoAccountID` AS `FirsthmoAccountID`, `b`.`hmoName` AS `FirsthmoName`, `b`.`otherHmoName` AS `FirstotherHmoName`, `b`.`memberLname` AS `FirstmemberLname`, `b`.`memberFname` AS `FirstmemberFname`, `b`.`memberMname` AS `FirstmemberMname`, `b`.`memberEname` AS `FirstmemberEname`, `b`.`patientName` AS `FirstpatientName`, `b`.`memberType` AS `Firstmembertype`, `b`.`memberSex` AS `Firstmembersex`, `b`.`memberBDay` AS `FirstmemberBDay`, `c`.`identifier` AS `Secondidentifier`, `c`.`clientType` AS `SecondclientType`, `c`.`hmoAccountID` AS `SecondhmoAccountID`, `c`.`hmoName` AS `SecondhmoName`, `c`.`otherHmoName` AS `SecondotherHmoName`, `c`.`memberLname` AS `SecondmemberLname`, `c`.`memberFname` AS `SecondmemberFname`, `c`.`memberMname` AS `SecondmemberMname`, `c`.`memberEname` AS `SecondmemberEname`, `c`.`patientName` AS `SecondpatientName`, `c`.`memberType` AS `Secondmembertype`, `c`.`memberSex` AS `Secondmembersex`, `c`.`memberBDay` AS `SecondmemberBDay`, `d`.`identifier` AS `Thirdidentifier`, `d`.`clientType` AS `ThirdclientType`, `d`.`hmoAccountID` AS `ThirdhmoAccountID`, `d`.`hmoName` AS `ThirdhmoName`, `d`.`otherHmoName` AS `ThirdotherHmoName`, `d`.`memberLname` AS `ThirdmemberLname`, `d`.`memberFname` AS `ThirdmemberFname`, `d`.`memberMname` AS `ThirdmemberMname`, `d`.`memberEname` AS `ThirdmemberEname`, `d`.`patientName` AS `ThirdpatientName`, `d`.`memberType` AS `Thirdmembertype`, `d`.`memberSex` AS `Thirdmembersex`, `d`.`memberBDay` AS `ThirdmemberBDay`, `e`.`identifier` AS `Fourthidentifier`, `e`.`clientType` AS `FourthclientType`, `e`.`hmoAccountID` AS `FourthhmoAccountID`, `e`.`hmoName` AS `FourthhmoName`, `e`.`otherHmoName` AS `FourthotherHmoName`, `e`.`memberLname` AS `FourthmemberLname`, `e`.`memberFname` AS `FourthmemberFname`, `e`.`memberMname` AS `FourthmemberMname`, `e`.`memberEname` AS `FourthmemberEname`, `e`.`patientName` AS `FourthpatientName`, `e`.`memberType` AS `Fourthmembertype`, `e`.`memberSex` AS `Fourthmembersex`, `e`.`memberBDay` AS `FourthmemberBDay` FROM ((((`u_hispatients` `a` left join `u_hispatientshealthcare` `b` on(`a`.`CODE` = `b`.`patientCode` and `b`.`identifier` = '1')) left join `u_hispatientshealthcare` `c` on(`a`.`CODE` = `c`.`patientCode` and `c`.`identifier` = '2')) left join `u_hispatientshealthcare` `d` on(`a`.`CODE` = `d`.`patientCode` and `d`.`identifier` = '3')) left join `u_hispatientshealthcare` `e` on(`a`.`CODE` = `e`.`patientCode` and `e`.`identifier` = '4'))  ;

--
-- VIEW `v_patientshmo`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE 
 
VIEW `CareTeQ`.`v_multipleicd` AS
    SELECT DISTINCT
        `a`.`U_PATIENTID` AS `U_PATIENTID`,
        `b`.`visitID` AS `visitID`,
        `a`.`DOCNO` AS `docno`,
        `b`.`U_ICDCODE` AS `U_ICDCODE`,
        `b`.`U_ICDDESC` AS `U_ICDDESC`,
        `a`.`COMPANY` AS `company`
    FROM
        (`CareTeQ`.`u_hisvisits` `a`
        LEFT JOIN `CareTeQ`.`u_hispatienticds` `b` ON (`b`.`visitID` = `a`.`DOCNO`))