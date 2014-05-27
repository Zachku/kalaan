-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27.05.2014 klo 20:29
-- Palvelimen versio: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kalaan`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `catches`
--

CREATE TABLE IF NOT EXISTS `catches` (
  `catch_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `lake_id` int(11) DEFAULT NULL,
  `lure_id` int(11) DEFAULT NULL,
  `fish_id` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `coord_latitude` float DEFAULT NULL,
  `coord_longitude` float DEFAULT NULL,
  PRIMARY KEY (`catch_id`),
  KEY `user_id` (`user_id`),
  KEY `lake_id` (`lake_id`),
  KEY `lure_id` (`lure_id`),
  KEY `fish_id` (`fish_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Rakenne taululle `fishes`
--

CREATE TABLE IF NOT EXISTS `fishes` (
  `fish_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`fish_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Vedos taulusta `fishes`
--

INSERT INTO `fishes` (`fish_id`, `name`) VALUES
(3, 'Ahven'),
(4, 'Allikkosalakka'),
(5, 'Ankerias'),
(6, 'Elska'),
(7, 'Hauki'),
(8, 'Harjus'),
(9, 'Hietatokko'),
(10, 'Hopearuutana'),
(11, 'Härkäsimppu'),
(12, 'Kampela'),
(13, 'Isosimppu'),
(14, 'Isotuulenkala'),
(15, 'Imukala'),
(16, 'Karppi'),
(17, 'Kiiski'),
(18, 'Kilohaili'),
(19, 'Kivennuoliainen'),
(20, 'Kirjoeväsimppu'),
(21, 'Kirjolohi'),
(22, 'Kivinilkka'),
(23, 'Kivisimppu'),
(24, 'Kuha'),
(25, 'Kuore'),
(26, 'Kolmipiikki'),
(27, 'Kymenpiikki'),
(28, 'Lahna'),
(29, 'Liejutokko'),
(30, 'Lohi'),
(31, 'Made'),
(32, 'Miekkasärki'),
(33, 'Muikku'),
(34, 'Mutu'),
(35, 'Mustatäplätokko'),
(36, 'Mustatokko'),
(37, 'Nahkiainen'),
(38, 'Nieriä'),
(39, 'Rautu'),
(40, 'Nokkakala'),
(41, 'Pasuri'),
(42, 'Piikkikampela'),
(43, 'Piikkimonni'),
(44, 'Piikkisimppu'),
(45, 'Pikkutuulenkala'),
(46, 'Rasvakala'),
(47, 'Rantaneula'),
(48, 'Ruutana'),
(49, 'Vimpa'),
(50, 'Turpa'),
(51, 'Toutain'),
(52, 'Salakka'),
(53, 'Seitsenruototokko'),
(54, 'Siika'),
(55, 'Silokampela'),
(56, 'Silakka'),
(57, 'Siloneula'),
(58, 'Sorva'),
(59, 'Sulkava'),
(60, 'Suutari'),
(61, 'Särki'),
(62, 'Särmäneula'),
(63, 'Säyne'),
(64, 'Taimen'),
(65, 'Teisti'),
(66, 'Turska'),
(67, 'Törö'),
(68, 'Vaskikala'),
(69, 'Seipi');

-- --------------------------------------------------------

--
-- Rakenne taululle `lakes`
--

CREATE TABLE IF NOT EXISTS `lakes` (
  `lake_id` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(60) NOT NULL,
  `lake_name` varchar(60) NOT NULL,
  PRIMARY KEY (`lake_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Rakenne taululle `lures`
--

CREATE TABLE IF NOT EXISTS `lures` (
  `lure_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `weight` float DEFAULT NULL,
  `color` varchar(40) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lure_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `profile_image_url` varchar(100) DEFAULT NULL,
  `motto` text,
  `register_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `catches`
--
ALTER TABLE `catches`
  ADD CONSTRAINT `catches_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `catches_ibfk_2` FOREIGN KEY (`lake_id`) REFERENCES `lakes` (`lake_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `catches_ibfk_3` FOREIGN KEY (`lure_id`) REFERENCES `lures` (`lure_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `catches_ibfk_4` FOREIGN KEY (`fish_id`) REFERENCES `fishes` (`fish_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
