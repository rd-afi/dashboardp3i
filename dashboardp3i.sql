-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2018 at 05:40 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboardp3i`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `no` int(11) NOT NULL,
  `schoolyear` int(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `position` varchar(256) NOT NULL,
  `employee_status` varchar(256) NOT NULL,
  `education` varchar(256) NOT NULL,
  `country_of_origin` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_tamu`
--

CREATE TABLE `dosen_tamu` (
  `no` int(11) NOT NULL,
  `schoolyear` int(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `country_of_origin` varchar(256) NOT NULL,
  `country_of_destination` varchar(256) NOT NULL,
  `institution` varchar(256) NOT NULL,
  `event` varchar(256) NOT NULL,
  `position` varchar(256) NOT NULL,
  `education` varchar(256) NOT NULL,
  `time_period` varchar(256) NOT NULL,
  `venue` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_io`
--

CREATE TABLE `mahasiswa_io` (
  `no` int(11) NOT NULL,
  `schoolyear` int(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `generation` int(4) NOT NULL,
  `faculty` varchar(256) NOT NULL,
  `study_program` varchar(256) NOT NULL,
  `degree` varchar(256) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `status` varchar(256) NOT NULL,
  `fee` int(11) NOT NULL,
  `country_of_origin` varchar(256) NOT NULL,
  `univ_origin` varchar(256) NOT NULL,
  `univ_dest` varchar(256) NOT NULL,
  `exchange_period` varchar(256) NOT NULL,
  `passport` varchar(256) NOT NULL,
  `inf` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_sisfo`
--

CREATE TABLE `mahasiswa_sisfo` (
  `id` int(11) NOT NULL,
  `schoolyear` int(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `name` varchar(256) NOT NULL,
  `generation` int(4) NOT NULL,
  `faculty` varchar(256) NOT NULL,
  `study_program` varchar(256) NOT NULL,
  `degree` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `status` varchar(256) NOT NULL,
  `fee` int(11) NOT NULL,
  `country_of_origin` varchar(256) NOT NULL,
  `univ_origin` varchar(256) NOT NULL,
  `univ_dest` varchar(256) NOT NULL,
  `exchange_period` varchar(256) NOT NULL,
  `inf` varchar(256) NOT NULL,
  `inf2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `dosen_tamu`
--
ALTER TABLE `dosen_tamu`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `mahasiswa_io`
--
ALTER TABLE `mahasiswa_io`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `mahasiswa_sisfo`
--
ALTER TABLE `mahasiswa_sisfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3878;
--
-- AUTO_INCREMENT for table `dosen_tamu`
--
ALTER TABLE `dosen_tamu`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=490;
--
-- AUTO_INCREMENT for table `mahasiswa_io`
--
ALTER TABLE `mahasiswa_io`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `mahasiswa_sisfo`
--
ALTER TABLE `mahasiswa_sisfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86190;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
