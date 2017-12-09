-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 11:32 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gabi`
--

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `machine_name` text NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`ID`, `machine_name`, `title`) VALUES
(1, 'url', 'כותרת');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_ID` int(11) NOT NULL,
  `source` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `order` int(11) NOT NULL,
  `internal` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `parent`, `title`, `url`, `order`, `internal`) VALUES
(1, 0, 'תפריט1גכ', 'index2', 1, 0),
(2, 1, 'תפריט2', 'dd', 0, 1),
(3, 2, 'תפריט5', 'געכע', 0, 0),
(5, 0, 'עכעכע', 'כעכע', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `machine_name` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `machine_name`, `title`, `content`, `keywords`, `description`) VALUES
(2, 'index', 'דף הבית שלי', '<p>ג<strong>כע</strong>ג<s>כעכ</s>עכע</p>\r\n', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `rate` float NOT NULL,
  `comment` text NOT NULL,
  `nick` text NOT NULL,
  `time` int(11) NOT NULL,
  `IP` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`ID`, `rate`, `comment`, `nick`, `time`, `IP`) VALUES
(1, 5, 'מקצוען, דייקן ואמין', 'יוסי', 1485591535, ''),
(2, 5, 'איכותי ויעיל!', 'שמעוון', 1490421109, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
