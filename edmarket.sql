-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2014 at 06:34 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `artist` varchar(30) DEFAULT NULL,
  `album` varchar(30) DEFAULT NULL,
  `format` varchar(3) DEFAULT NULL,
  `des` varchar(160) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qavail` int(4) DEFAULT NULL,
  `albart` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `artist`, `album`, `format`, `des`, `price`, `qavail`, `albart`) VALUES
(1, 'Camo & Krooked', 'Move Around', 'cd', 'A great album by Camo & Krooked.', '12.99', 499, 'images/cddefault.png'),
(2, 'Tristam', 'Party For The Living', 'cd', 'His first release!', '13.99', 600, 'images/cddefault.png'),
(3, 'Daft Punk', 'Discovery', 'cd', 'Daft Punks greatest album!', '5.99', 700, 'images/cddefault.png'),
(4, 'Avicii', 'True', 'cd', 'His latest album.', '15.99', 200, 'images/cddefault.png'),
(5, 'Tiesto', 'Nyana', 'cd', 'Not really a fan of this dude but I need more artists that have cds.', '1.99', 3, 'images/cddefault.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
