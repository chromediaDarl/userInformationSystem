-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 09, 2014 at 03:08 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `usermgtdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirm`
--

CREATE TABLE `confirm` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `confirm`
--

INSERT INTO `confirm` (`id`, `userid`, `email`, `confirmkey`, `is_confirmed`) VALUES
(1, 5, 'kimberlydarl.barbadillo@chromedia.com', 'e31f8487d386d12fd5070651ab4a3805', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `salt`, `password`, `is_active`) VALUES
(1, 'sample@sample.com', 'Sample Firstname', 'Sample Lastname', '605c32e47ae6ce4e6012535b310d77f1', 'e9c35189fb9d367933e5bee8187854f5172dfcfff3933a41c1b779eddd9a7860', 1),
(2, 'kimberlydarlbarbadillo@gmail.com', 'Kimberly', 'Barbadillo', 'd6bc9a5fbab087dfb0fbfa3ab24ad9df', 'c646edb1ad0f067a66a4830a070022790bcdba46204cd915537e42c3e3bc2aea', 0),
(3, 'sample2@sample.com', 'Sample Account', 'Sample Lastname', 'f718833c564cab8909770f5d3d895098', 'cfa8b36b2ad2d609a33ac1af71e90c2533166646ba8a917dd57d8bdb4d7ea66c', 0),
(4, 'kimmy@dora.com', 'kimmy', 'dora', 'ea3bcf536c73d950835969cb81782384', 'ca4268be3d58c8d782c67139b018aea49f2a47f241d2e53e126d3ef0147a2799', 1),
(5, 'kimberlydarl.barbadillo@chromedia.com', 'Kimberly', 'Barbadillo', 'dd0c4792d7ec3645265824ffa2aba84c', '53f126e417822b14d89f2779053f03fe73a40a922e4db1c60a071989e0e0863c', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `confirm`
--
ALTER TABLE `confirm`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_8FD3A344F132696E` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `confirm`
--
ALTER TABLE `confirm`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `confirm`
--
ALTER TABLE `confirm`
ADD CONSTRAINT `FK_8FD3A344F132696E` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
