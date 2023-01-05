-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2022 at 07:34 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidompul`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dompul`
--

CREATE TABLE `tb_dompul` (
  `id` int(11) NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `otp` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `refresh_token` varchar(100) NOT NULL,
  `expired` datetime NOT NULL,
  `time_refresh` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dompul`
--

INSERT INTO `tb_dompul` (`id`, `nomor`, `otp`, `id_user`, `token`, `refresh_token`, `expired`, `time_refresh`, `status`) VALUES
(1, '0895361034833', '', 4, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, '08953610348333', '', 4, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, '0895361034833', '123', 2, 'a17cc6ff-263d-4d0d-877f-b65413eb1a9c', 'af43a1d3-29e2-4fd8-9758-c1962da50ae0', '2022-12-22 03:35:03', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nomor`
--

CREATE TABLE `tb_nomor` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `proses` varchar(20) NOT NULL DEFAULT 'checking',
  `tanggal_periksa` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nomor`
--

INSERT INTO `tb_nomor` (`id`, `id_user`, `nomor`, `status`, `proses`, `tanggal_periksa`, `response`) VALUES
(1, 2, '081953910339', 'Checking', 'Queue', '2022-12-22 01:30:52', ''),
(2, 2, '0895361034833', 'Not Yet', 'Done', '2022-12-22 01:30:53', ''),
(3, 2, '08953610348332', 'Not Yet', 'Done', '2022-12-22 02:01:02', '{\"statusCode\":200,\"statusMessage\":\"OK\",\"statusDescription\":\"Request succeeded without error\",\"result\":{\"errorCode\":\"00\",\"errorMessage\":\"Success\",\"data\":{\"dukcapil\":\"Not Yet\"}}}'),
(4, 2, '123', 'Not Yet', 'Done', '2022-12-22 02:01:12', ''),
(5, 2, '1231', 'Checking', 'Queue', '2022-12-22 02:01:12', ''),
(6, 2, '1231313\r\n', 'Checking', 'Queue', '2022-12-22 02:01:12', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id` int(11) NOT NULL,
  `panel_key` varchar(100) NOT NULL,
  `app_name` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  `client_key` varchar(50) DEFAULT NULL,
  `server_key` varchar(50) DEFAULT NULL,
  `url_handle_notification` text,
  `isProduction` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id`, `panel_key`, `app_name`, `domain`, `client_key`, `server_key`, `url_handle_notification`, `isProduction`) VALUES
(1, 'xxsbsd2mu4i1', 'Dompul Panel', 'http://localhost/wapa/index.php', 'SB-Mid-client-G699eb4x0NgQLdEL', 'SB-Mid-server-RH4S3FpXeevCsj6M5hNbWf5k', 'index.php/io/midtrans', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `email`, `password`, `level`, `phone_number`, `start_date`, `status`, `last_login`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, '', '2022-12-21 13:54:07', 1, '2022-12-21 13:57:17'),
(2, 'client10@gmail.com', '$2y$10$wj3d1cT7V6zlnRITDk2qnei.Sayggk53KwpcmuKHI0BhvwNNX0u3.', 1, '0895361034833', '2022-12-21 00:00:00', 1, '2022-12-21 13:57:17'),
(3, 'client11@gmail.com', '$2y$10$VInqtTqBipA0wL0N0p0TTuUpMC5P.APeLyqedW6zEl2mDT6x/B6ve', 1, '5412312', '2022-12-21 00:00:00', 1, '2022-12-21 13:57:17'),
(4, 'client12@gmail.com', '$2y$10$50vMQDrsbU7RNJqbTqrhiOgPHgCrN77S/dNWPUYi98gqbSRgT11.O', 1, '0895361034833', '2022-12-21 00:00:00', 1, '2022-12-21 13:57:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dompul`
--
ALTER TABLE `tb_dompul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nomor`
--
ALTER TABLE `tb_nomor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dompul`
--
ALTER TABLE `tb_dompul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_nomor`
--
ALTER TABLE `tb_nomor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
