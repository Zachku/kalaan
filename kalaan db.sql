-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19.05.2014 klo 22:59
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Vedos taulusta `catches`
--

INSERT INTO `catches` (`catch_id`, `user_id`, `lake_id`, `lure_id`, `fish_id`, `date`, `image_url`, `coord_latitude`, `coord_longitude`) VALUES
(26, 3, NULL, NULL, NULL, NULL, NULL, 61.4974, 23.8167),
(27, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 5, NULL, NULL, NULL, NULL, '\\images\\catch_images\\800350928.png', NULL, NULL),
(29, 5, NULL, NULL, NULL, NULL, '\\images\\catch_images\\316842629.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Rakenne taululle `fishes`
--

CREATE TABLE IF NOT EXISTS `fishes` (
  `fish_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`fish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

--
-- Vedos taulusta `lakes`
--

INSERT INTO `lakes` (`lake_id`, `town`, `lake_name`) VALUES
(1, 'town', 'lake'),
(2, 'town', 'lake'),
(3, 'town', 'lake'),
(4, 'town2', 'lake2');

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

--
-- Vedos taulusta `lures`
--

INSERT INTO `lures` (`lure_id`, `brand`, `model`, `weight`, `color`, `url`) VALUES
(2, 'lure', 'lure', NULL, '', NULL),
(3, 'lure brand', 'lure model', NULL, '', NULL),
(4, 'rapalan ', 'joku', NULL, '', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_image_url`, `motto`, `register_date`) VALUES
(1, 'k', 'k', 'k', '', '', NULL),
(2, 'k', 'k', '$2a$13$FG00mf29HG9MRRH2TMpeHe/Fur0E9xnK1SOLjXiEpJcNuAh.muZY.', '', '', '2014-05-10'),
(3, 'moro', 'moro', '$2a$13$rG5Ej.kKNpdWe5MbB6lVE.dI5pvzXhen9MEf2o5tJIRB5cH0QMbM6', '', '', '2014-05-10'),
(4, 'user', 'user', '$2a$13$isOoiS8cI7HcqLjCpGOmle0SmpsEa107Nq0ACS88MvOsj4tv2wafW', 'user', 'user', '2014-05-14'),
(5, 'jaa', 'ja', '$2a$13$tTzcYvYn8r7Zz5jvRxjvlerI7kWth4HxnHXlsTydgK9fw4yG8kq4.', 'jaa', 'jaa', '2014-05-15');

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
