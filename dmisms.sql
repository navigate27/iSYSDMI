-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2016 at 11:00 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dmisms`
--
CREATE DATABASE IF NOT EXISTS `dmisms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dmisms`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tnum` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  `lastsignin` datetime NOT NULL,
  `signin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1032 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `tnum`, `user`, `pass`, `type`, `stat`, `lastsignin`, `signin`) VALUES
(1023, 'F20161281033', 'F20161281033', 'admin', 1, 1, '2016-04-19 19:35:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activity`, `datetime`) VALUES
(87, '<i class=''fa fa-sign-in''></i> Teacher<span class=''text-success''><strong></strong></span> signed in', '2016-04-19 11:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `a_notes`
--

CREATE TABLE IF NOT EXISTS `a_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `notes` text NOT NULL,
  `date` datetime NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `a_notes`
--

INSERT INTO `a_notes` (`id`, `title`, `notes`, `date`, `stat`) VALUES
(1, 'My Title', 'The quick brown fox jumps over the lazy dog.', '2016-02-06 12:22:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1004 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept`) VALUES
(1001, 'Kinder'),
(1002, 'Elementary'),
(1003, 'Junior High');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `val` int(11) NOT NULL,
  `sal` int(11) NOT NULL,
  `fhm` int(11) NOT NULL,
  `grad` int(11) NOT NULL,
  `choir` int(11) NOT NULL,
  `early` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `loyal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `val`, `sal`, `fhm`, `grad`, `choir`, `early`, `friend`, `loyal`) VALUES
(1, 100, 50, 30, 1000, 1000, 1000, 500, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `e_notes`
--

CREATE TABLE IF NOT EXISTS `e_notes` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `notes` text NOT NULL,
  `date` datetime NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `e_notes`
--

INSERT INTO `e_notes` (`id`, `title`, `notes`, `date`, `stat`) VALUES
(28, 'Untitled Title', 'Blank Note', '2016-04-03 04:08:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `e_summary`
--

CREATE TABLE IF NOT EXISTS `e_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `books` int(11) NOT NULL,
  `tfee` int(11) NOT NULL,
  `pe` int(11) NOT NULL,
  `sc` int(11) NOT NULL,
  `misc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `e_summary`
--

INSERT INTO `e_summary` (`id`, `month`, `books`, `tfee`, `pe`, `sc`, `misc`) VALUES
(35, 'Jan', 0, 0, 0, 0, 0),
(36, 'Feb', 0, 0, 0, 0, 0),
(37, 'Mar', 0, 0, 0, 0, 0),
(38, 'Apr', 0, 0, 0, 0, 0),
(39, 'May', 0, 0, 0, 0, 0),
(40, 'Jun', 0, 0, 0, 0, 0),
(41, 'Jul', 0, 0, 0, 0, 0),
(42, 'Aug', 0, 0, 0, 0, 0),
(43, 'Sep', 0, 0, 0, 0, 0),
(44, 'Oct', 0, 0, 0, 0, 0),
(45, 'Nov', 0, 0, 0, 0, 0),
(46, 'Dec', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE IF NOT EXISTS `fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `books` int(11) NOT NULL,
  `tfee` int(11) NOT NULL,
  `pe` int(11) NOT NULL,
  `sc` int(11) NOT NULL,
  `misc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `level`, `books`, `tfee`, `pe`, `sc`, `misc`) VALUES
(1, '2001', 2500, 10000, 1200, 2500, 2000),
(2, '2002', 3000, 8000, 1000, 1000, 3600),
(3, '2003', 5500, 0, 0, 0, 0),
(4, '2004', 2000, 0, 0, 0, 0),
(5, '2005', 2500, 18000, 1000, 1000, 4000),
(6, '2006', 0, 0, 0, 0, 0),
(7, '2007', 0, 0, 0, 0, 0),
(8, '2008', 0, 0, 0, 0, 0),
(9, '2009', 1500, 12000, 450, 350, 3500),
(10, '2010', 10000, 20000, 200, 250, 8000),
(11, '2011', 4500, 22000, 1000, 2500, 8000),
(12, '2012', 4500, 25000, 2500, 2500, 9900),
(13, '2013', 5000, 30000, 2500, 3000, 8000),
(14, '2014', 4500, 35000, 2500, 3000, 8500);

-- --------------------------------------------------------

--
-- Table structure for table `gr_notes`
--

CREATE TABLE IF NOT EXISTS `gr_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `date` datetime NOT NULL,
  `tnum` varchar(255) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2015 ;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level`, `dept`) VALUES
(2001, 'Nursery', '1001'),
(2002, 'Kindergarten 1', '1001'),
(2003, 'Kindergarten 2', '1001'),
(2004, 'Kindergarten 3', '1001'),
(2005, 'Grade 1', '1002'),
(2006, 'Grade 2', '1002'),
(2007, 'Grade 3', '1002'),
(2008, 'Grade 4', '1002'),
(2009, 'Grade 5', '1002'),
(2010, 'Grade 6', '1002'),
(2011, 'Grade 7', '1003'),
(2012, 'Grade 8', '1003'),
(2013, 'Grade 9', '1003'),
(2014, 'Grade 10', '1003');

-- --------------------------------------------------------

--
-- Table structure for table `lib_books`
--

CREATE TABLE IF NOT EXISTS `lib_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `edition` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `lib_books`
--

INSERT INTO `lib_books` (`id`, `code`, `title`, `author`, `edition`, `descrip`, `cat`, `qty`, `date`, `stat`) VALUES
(2, '1012', 'Elementary Statistics', 'Bluman', 'Super Edition', '', 'Others', 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_books_cat`
--

CREATE TABLE IF NOT EXISTS `lib_books_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `lib_books_cat`
--

INSERT INTO `lib_books_cat` (`id`, `category`) VALUES
(1, 'Math'),
(2, 'Science'),
(3, 'History'),
(4, 'Filipiniana'),
(5, 'English'),
(6, 'Physical Education'),
(7, 'Computer'),
(8, 'MAPEH'),
(9, 'General References'),
(10, 'Thesis'),
(11, 'Religion'),
(12, 'Aralin Panlipunan'),
(13, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `lib_items`
--

CREATE TABLE IF NOT EXISTS `lib_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `stat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_notes`
--

CREATE TABLE IF NOT EXISTS `lib_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `notes` longtext NOT NULL,
  `date` datetime NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `lib_notes`
--

INSERT INTO `lib_notes` (`id`, `title`, `notes`, `date`, `stat`) VALUES
(8, 'Sample Title', 'Sample Content', '2016-01-26 14:37:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lib_settings`
--

CREATE TABLE IF NOT EXISTS `lib_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penalty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lib_settings`
--

INSERT INTO `lib_settings` (`id`, `penalty`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `lib_summary`
--

CREATE TABLE IF NOT EXISTS `lib_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `val` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lib_summary`
--

INSERT INTO `lib_summary` (`id`, `month`, `val`) VALUES
(1, 'Jun', 5),
(2, 'Jul', 10),
(3, 'Aug', 8),
(4, 'Sep', 22),
(5, 'Oct', 37),
(6, 'Nov', 29),
(7, 'Dec', 3),
(8, 'Jan', 2),
(9, 'Feb', 29),
(10, 'Mar', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lib_transact`
--

CREATE TABLE IF NOT EXISTS `lib_transact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snum` varchar(255) NOT NULL,
  `book_code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `due` date NOT NULL,
  `pen` varchar(255) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `quarter`
--

CREATE TABLE IF NOT EXISTS `quarter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qtr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quarter`
--

INSERT INTO `quarter` (`id`, `qtr`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `tnum` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3030 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `level_id`, `tnum`) VALUES
(3001, 'St. Agnes', 2001, 'F20161281027'),
(3002, 'St. Anne', 2001, ''),
(3003, 'St. Mary Goretti', 2002, ''),
(3004, 'St. Cecilia', 2002, ''),
(3005, 'St. Matthew', 2003, 'F20161281031'),
(3006, 'St. Claire', 2003, ''),
(3007, 'St. Lourdes', 2004, ''),
(3008, 'St. Rita', 2004, ''),
(3009, 'St. Anthony', 2005, ''),
(3010, 'St. Ignatius', 2005, 'F20131281028'),
(3011, 'St. Luke', 2006, ''),
(3012, 'St. John', 2006, ''),
(3013, 'St. Mark', 2007, ''),
(3014, 'St. Andrew', 2007, ''),
(3015, 'St. Dominic Savio', 2008, ''),
(3016, 'St. Peregrine', 2008, 'F20161281030'),
(3017, 'St. Lorenzo Ruiz', 2009, ''),
(3018, 'St. Paul', 2009, ''),
(3019, 'St. Monica', 2010, ''),
(3020, 'St. Augustine', 2010, ''),
(3021, 'St. Francis of Assisi', 2011, ''),
(3022, 'St. Rose of Lima', 2011, ''),
(3023, 'St. Michael', 2012, 'F20161281025'),
(3024, 'St. Therese of Avila', 2012, 'F20151281029'),
(3025, 'St. Pio of Pietrelcina', 2013, 'F20161281026'),
(3026, 'St. Pedro Calungsod', 2013, 'F20161281023'),
(3027, 'St. Martin of Tours', 2014, ''),
(3028, 'St. Jude Thaddeus', 2014, 'F20161281024'),
(3029, 'St. Thomas', 2008, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sysaccess` int(11) NOT NULL,
  `upfees` int(11) NOT NULL,
  `upbooks` int(11) NOT NULL,
  `delbooks` int(11) NOT NULL,
  `enroll` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sysaccess`, `upfees`, `upbooks`, `delbooks`, `enroll`) VALUES
(1, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_discount`
--

CREATE TABLE IF NOT EXISTS `student_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snum` varchar(255) NOT NULL,
  `val` int(11) NOT NULL,
  `sal` int(11) NOT NULL,
  `fhm` int(11) NOT NULL,
  `grad` int(11) NOT NULL,
  `choir` int(11) NOT NULL,
  `early` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `loyal` int(11) NOT NULL,
  `qe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_finance`
--

CREATE TABLE IF NOT EXISTS `student_finance` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `snum` varchar(255) NOT NULL,
  `bbooks` float NOT NULL,
  `btfee` float NOT NULL,
  `bpe` float NOT NULL,
  `bsc` float NOT NULL,
  `bmisc` float NOT NULL,
  `payment` float NOT NULL,
  `disc` float NOT NULL,
  `or` varchar(255) NOT NULL,
  `check` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `sy` varchar(255) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE IF NOT EXISTS `student_grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snum` varchar(255) NOT NULL,
  `subj_code` varchar(255) NOT NULL,
  `a` float NOT NULL,
  `b` float NOT NULL,
  `c` float NOT NULL,
  `d` float NOT NULL,
  `fr` float NOT NULL,
  `quarter` varchar(255) NOT NULL,
  `sy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7818 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_records`
--

CREATE TABLE IF NOT EXISTS `student_records` (
  `id` int(15) NOT NULL,
  `snum` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bday` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `bplace` varchar(512) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `sy` varchar(255) NOT NULL,
  `endate` date NOT NULL,
  `pts` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `father` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cnum` varchar(255) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  `refnum` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `imgpath` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_req`
--

CREATE TABLE IF NOT EXISTS `student_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snum` varchar(255) NOT NULL,
  `pic` int(11) NOT NULL,
  `birth` int(11) NOT NULL,
  `f137` int(11) NOT NULL,
  `good` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_code` varchar(255) NOT NULL,
  `subj` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `tnum` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subj_code` (`subj_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=303 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subj_code`, `subj`, `descrip`, `level`, `section`, `tnum`) VALUES
(1, '1001', 'English', '', '2001', '3001', ''),
(2, '1002', 'Math', '', '2001', '3001', ''),
(3, '1003', 'Science', '', '2001', '3001', ''),
(4, '1004', 'Filipino', '', '2001', '3001', ''),
(5, '1005', 'Mape', '', '2001', '3001', ''),
(6, '1006', 'English', '', '2001', '3002', ''),
(7, '1007', 'Math', '', '2001', '3002', ''),
(8, '1008', 'Science', '', '2001', '3002', 'F141013L'),
(9, '1009', 'Filipino', '', '2001', '3002', 'F141013L'),
(10, '1010', 'Mape', '', '2001', '3002', 'F221019V'),
(11, '1011', 'English', '', '2002', '3003', 'F181018G'),
(12, '1012', 'Math', '', '2002', '3003', 'F131017S'),
(13, '1013', 'Science', '', '2002', '3003', ''),
(14, '1014', 'Filipino', '', '2002', '3003', 'F131017S'),
(15, '1015', 'Mape', '', '2002', '3003', 'F101015E'),
(16, '1016', 'English', '', '2002', '3004', ''),
(17, '1017', 'Math', '', '2002', '3004', ''),
(18, '1018', 'Science', '', '2002', '3004', ''),
(19, '1019', 'Filipino', '', '2002', '3004', ''),
(20, '1020', 'Mape', '', '2002', '3004', ''),
(21, '1021', 'English', '', '2003', '3005', 'F181018G'),
(22, '1022', 'Math', '', '2003', '3005', 'F131017S'),
(23, '1023', 'Science', '', '2003', '3005', ''),
(24, '1024', 'Filipino', '', '2003', '3005', 'F131017S'),
(25, '1025', 'Mape', '', '2003', '3005', 'F101015E'),
(26, '1026', 'Computer', '', '2003', '3005', ''),
(27, '1027', 'English', '', '2003', '3006', ''),
(28, '1028', 'Math', '', '2003', '3006', ''),
(29, '1029', 'Science', '', '2003', '3006', ''),
(30, '1030', 'Filipino', '', '2003', '3006', ''),
(31, '1031', 'Mape', '', '2003', '3006', ''),
(32, '1032', 'Computer', '', '2003', '3006', ''),
(33, '1033', 'English', '', '2004', '3007', ''),
(34, '1034', 'Math', '', '2004', '3007', ''),
(35, '1035', 'Science', '', '2004', '3007', ''),
(36, '1036', 'Filipino', '', '2004', '3007', ''),
(37, '1037', 'Mape', '', '2004', '3007', ''),
(38, '1038', 'Computer', '', '2004', '3007', ''),
(39, '1039', 'Sibika', '', '2004', '3007', ''),
(40, '1040', 'English', '', '2004', '3008', ''),
(41, '1041', 'Math', '', '2004', '3008', ''),
(42, '1042', 'Science', '', '2004', '3008', ''),
(43, '1043', 'Filipino', '', '2004', '3008', ''),
(44, '1044', 'Mape', '', '2004', '3008', ''),
(45, '1045', 'Computer', '', '2004', '3008', ''),
(46, '1046', 'Sibika', '', '2004', '3008', ''),
(47, '1047', 'Mother Tongue', '', '2005', '3009', ''),
(48, '1048', 'English', '', '2005', '3009', ''),
(49, '1049', 'Math', '', '2005', '3009', ''),
(50, '1050', 'Science', '', '2005', '3009', ''),
(51, '1051', 'Filipino', '', '2005', '3009', ''),
(52, '1052', 'AP', '', '2005', '3009', ''),
(53, '1053', 'Edukasyon sa Pagpapakatao', '', '2005', '3009', ''),
(54, '1054', 'Music', '', '2005', '3009', ''),
(55, '1055', 'Arts', '', '2005', '3009', ''),
(56, '1056', 'PE', '', '2005', '3009', ''),
(57, '1057', 'Health', '', '2005', '3009', ''),
(58, '1058', 'Mapeh', '', '2005', '3009', ''),
(59, '1059', 'Computer', '', '2005', '3009', ''),
(60, '1060', 'Mother Tongue', '', '2005', '3010', ''),
(61, '1061', 'English', '', '2005', '3010', ''),
(62, '1062', 'Math', '', '2005', '3010', ''),
(63, '1063', 'Science', '', '2005', '3010', ''),
(64, '1064', 'Filipino', '', '2005', '3010', ''),
(65, '1065', 'AP', '', '2005', '3010', ''),
(66, '1066', 'Edukasyon sa Pagpapakatao', '', '2005', '3010', ''),
(67, '1067', 'Music', '', '2005', '3010', ''),
(68, '1068', 'Arts', '', '2005', '3010', ''),
(69, '1069', 'PE', '', '2005', '3010', ''),
(70, '1070', 'Health', '', '2005', '3010', ''),
(71, '1071', 'Mapeh', '', '2005', '3010', ''),
(72, '1072', 'Computer', '', '2005', '3010', ''),
(73, '1073', 'Mother Tongue', '', '2006', '3011', ''),
(74, '1074', 'English', '', '2006', '3011', ''),
(75, '1075', 'Math', '', '2006', '3011', ''),
(76, '1076', 'Science', '', '2006', '3011', ''),
(77, '1077', 'Filipino', '', '2006', '3011', ''),
(78, '1078', 'AP', '', '2006', '3011', ''),
(79, '1079', 'Edukasyon sa Pagpapakatao', '', '2006', '3011', ''),
(80, '1080', 'Music', '', '2006', '3011', ''),
(81, '1081', 'Arts', '', '2006', '3011', ''),
(82, '1082', 'PE', '', '2006', '3011', ''),
(83, '1083', 'Health', '', '2006', '3011', ''),
(84, '1084', 'Mapeh', '', '2006', '3011', ''),
(85, '1085', 'Computer', '', '2006', '3011', ''),
(86, '1086', 'Mother Tongue', '', '2006', '3012', ''),
(87, '1087', 'English', '', '2006', '3012', ''),
(88, '1088', 'Math', '', '2006', '3012', ''),
(89, '1089', 'Science', '', '2006', '3012', ''),
(90, '1090', 'Filipino', '', '2006', '3012', ''),
(91, '1091', 'AP', '', '2006', '3012', ''),
(92, '1092', 'Edukasyon sa Pagpapakatao', '', '2006', '3012', ''),
(93, '1093', 'Music', '', '2006', '3012', ''),
(94, '1094', 'Arts', '', '2006', '3012', ''),
(95, '1095', 'PE', '', '2006', '3012', ''),
(96, '1096', 'Health', '', '2006', '3012', ''),
(97, '1097', 'Mapeh', '', '2006', '3012', ''),
(98, '1098', 'Computer', '', '2006', '3012', ''),
(99, '1099', 'Mother Tongue', '', '2007', '3013', ''),
(100, '1100', 'English', '', '2007', '3013', ''),
(101, '1101', 'Math', '', '2007', '3013', ''),
(102, '1102', 'Science', '', '2007', '3013', ''),
(103, '1103', 'Filipino', '', '2007', '3013', ''),
(104, '1104', 'AP', '', '2007', '3013', ''),
(105, '1105', 'Edukasyon sa Pagpapakatao', '', '2007', '3013', ''),
(106, '1106', 'Music', '', '2007', '3013', ''),
(107, '1107', 'Arts', '', '2007', '3013', ''),
(108, '1108', 'PE', '', '2007', '3013', ''),
(109, '1109', 'Health', '', '2007', '3013', ''),
(110, '1110', 'Mapeh', '', '2007', '3013', ''),
(111, '1111', 'Computer', '', '2007', '3013', ''),
(112, '1112', 'Mother Tongue', '', '2007', '3014', ''),
(113, '1113', 'English', '', '2007', '3014', ''),
(114, '1114', 'Math', '', '2007', '3014', ''),
(115, '1115', 'Science', '', '2007', '3014', ''),
(116, '1116', 'Filipino', '', '2007', '3014', ''),
(117, '1117', 'AP', '', '2007', '3014', ''),
(118, '1118', 'Edukasyon sa Pagpapakatao', '', '2007', '3014', ''),
(119, '1119', 'Music', '', '2007', '3014', ''),
(120, '1120', 'Arts', '', '2007', '3014', ''),
(121, '1121', 'PE', '', '2007', '3014', ''),
(122, '1122', 'Health', '', '2007', '3014', ''),
(123, '1123', 'Mapeh', '', '2007', '3014', ''),
(124, '1124', 'Computer', '', '2007', '3014', ''),
(125, '1125', 'English', '', '2008', '3015', ''),
(126, '1126', 'Math', '', '2008', '3015', ''),
(127, '1127', 'Science', '', '2008', '3015', ''),
(128, '1128', 'Filipino', '', '2008', '3015', ''),
(129, '1129', 'AP', '', '2008', '3015', ''),
(130, '1130', 'EPP', '', '2008', '3015', ''),
(131, '1131', 'Edukasyon sa Pagpapakatao', '', '2008', '3015', ''),
(132, '1132', 'Music', '', '2008', '3015', ''),
(133, '1133', 'Arts', '', '2008', '3015', ''),
(134, '1134', 'PE', '', '2008', '3015', ''),
(135, '1135', 'Health', '', '2008', '3015', ''),
(136, '1136', 'Mapeh', '', '2008', '3015', ''),
(137, '1137', 'Computer', '', '2008', '3015', ''),
(138, '1138', 'English', '', '2008', '3016', ''),
(139, '1139', 'Math', '', '2008', '3016', ''),
(140, '1140', 'Science', '', '2008', '3016', ''),
(141, '1141', 'Filipino', '', '2008', '3016', ''),
(142, '1142', 'AP', '', '2008', '3016', ''),
(143, '1143', 'EPP', '', '2008', '3016', ''),
(144, '1144', 'Edukasyon sa Pagpapakatao', '', '2008', '3016', ''),
(145, '1145', 'Music', '', '2008', '3016', ''),
(146, '1146', 'Arts', '', '2008', '3016', ''),
(147, '1147', 'PE', '', '2008', '3016', ''),
(148, '1148', 'Health', '', '2008', '3016', ''),
(149, '1149', 'Mapeh', '', '2008', '3016', ''),
(150, '1150', 'Computer', '', '2008', '3016', ''),
(151, '1151', 'English', '', '2009', '3017', ''),
(152, '1152', 'Math', '', '2009', '3017', ''),
(153, '1153', 'Science', '', '2009', '3017', ''),
(154, '1154', 'Filipino', '', '2009', '3017', ''),
(155, '1155', 'Makabayan', '', '2009', '3017', ''),
(156, '1156', 'Hekasi', '', '2009', '3017', ''),
(157, '1157', 'EPP', '', '2009', '3017', ''),
(158, '1158', 'Mapeh', '', '2009', '3017', ''),
(159, '1159', 'Edukasyon sa Pagpapakatao', '', '2009', '3017', ''),
(160, '1160', 'Computer', '', '2009', '3017', ''),
(161, '1161', 'English', '', '2009', '3018', ''),
(162, '1162', 'Math', '', '2009', '3018', ''),
(163, '1163', 'Science', '', '2009', '3018', ''),
(164, '1164', 'Filipino', '', '2009', '3018', ''),
(165, '1165', 'Makabayan', '', '2009', '3018', ''),
(166, '1166', 'Hekasi', '', '2009', '3018', ''),
(167, '1167', 'EPP', '', '2009', '3018', ''),
(168, '1168', 'Mapeh', '', '2009', '3018', ''),
(169, '1169', 'Edukasyon sa Pagpapakatao', '', '2009', '3018', ''),
(170, '1170', 'Computer', '', '2009', '3018', ''),
(171, '1171', 'English', '', '2010', '3019', ''),
(172, '1172', 'Math', '', '2010', '3019', ''),
(173, '1173', 'Science', '', '2010', '3019', ''),
(174, '1174', 'Filipino', '', '2010', '3019', ''),
(175, '1175', 'Makabayan', '', '2010', '3019', ''),
(176, '1176', 'Hekasi', '', '2010', '3019', ''),
(177, '1177', 'EPP', '', '2010', '3019', ''),
(178, '1178', 'Mapeh', '', '2010', '3019', ''),
(179, '1179', 'Edukasyon sa Pagpapakatao', '', '2010', '3019', ''),
(180, '1180', 'Computer', '', '2010', '3019', ''),
(181, '1181', 'English', '', '2010', '3020', ''),
(182, '1182', 'Math', '', '2010', '3020', ''),
(183, '1183', 'Science', '', '2010', '3020', ''),
(184, '1184', 'Filipino', '', '2010', '3020', ''),
(185, '1185', 'Makabayan', '', '2010', '3020', ''),
(186, '1186', 'Hekasi', '', '2010', '3020', ''),
(187, '1187', 'EPP', '', '2010', '3020', ''),
(188, '1188', 'Mapeh', '', '2010', '3020', ''),
(189, '1189', 'Edukasyon sa Pagpapakatao', '', '2010', '3020', ''),
(190, '1190', 'Computer', '', '2010', '3020', ''),
(191, '1191', 'English', '', '2011', '3021', ''),
(192, '1192', 'Math', '', '2011', '3021', ''),
(193, '1193', 'Science', '', '2011', '3021', ''),
(194, '1194', 'Filipino', '', '2011', '3021', ''),
(195, '1195', 'AP', '', '2011', '3021', ''),
(196, '1196', 'TLE', '', '2011', '3021', ''),
(197, '1197', 'Mapeh', '', '2011', '3021', ''),
(198, '1198', 'Music', '', '2011', '3021', ''),
(199, '1199', 'Arts', '', '2011', '3021', ''),
(200, '1200', 'PE', '', '2011', '3021', ''),
(201, '1201', 'Health', '', '2011', '3021', ''),
(202, '1202', 'Edukasyon sa Pagpapakatao', '', '2011', '3021', ''),
(203, '1203', 'Computer', '', '2011', '3021', ''),
(204, '1204', 'English', '', '2011', '3022', ''),
(205, '1205', 'Math', '', '2011', '3022', ''),
(206, '1206', 'Science', '', '2011', '3022', ''),
(207, '1207', 'Filipino', '', '2011', '3022', ''),
(208, '1208', 'AP', '', '2011', '3022', ''),
(209, '1209', 'TLE', '', '2011', '3022', ''),
(210, '1210', 'Mapeh', '', '2011', '3022', ''),
(211, '1211', 'Music', '', '2011', '3022', ''),
(212, '1212', 'Arts', '', '2011', '3022', ''),
(213, '1213', 'PE', '', '2011', '3022', ''),
(214, '1214', 'Health', '', '2011', '3022', ''),
(215, '1215', 'Edukasyon sa Pagpapakatao', '', '2011', '3022', ''),
(216, '1216', 'Computer', '', '2011', '3022', ''),
(217, '1217', 'English', '', '2012', '3023', ''),
(218, '1218', 'Math', '', '2012', '3023', ''),
(219, '1219', 'Science', '', '2012', '3023', ''),
(220, '1220', 'Filipino', '', '2012', '3023', ''),
(221, '1221', 'AP', '', '2012', '3023', ''),
(222, '1222', 'TLE', '', '2012', '3023', ''),
(223, '1223', 'Mapeh', '', '2012', '3023', ''),
(224, '1224', 'Music', '', '2012', '3023', ''),
(225, '1225', 'Arts', '', '2012', '3023', ''),
(226, '1226', 'PE', '', '2012', '3023', ''),
(227, '1227', 'Health', '', '2012', '3023', ''),
(228, '1228', 'Edukasyon sa Pagpapakatao', '', '2012', '3023', ''),
(229, '1229', 'Computer', '', '2012', '3023', ''),
(230, '1230', 'English', '', '2012', '3024', ''),
(231, '1231', 'Math', '', '2012', '3024', ''),
(232, '1232', 'Science', '', '2012', '3024', ''),
(233, '1233', 'Filipino', '', '2012', '3024', ''),
(234, '1234', 'AP', '', '2012', '3024', ''),
(235, '1235', 'TLE', '', '2012', '3024', ''),
(236, '1236', 'Mapeh', '', '2012', '3024', ''),
(237, '1237', 'Music', '', '2012', '3024', ''),
(238, '1238', 'Arts', '', '2012', '3024', ''),
(239, '1239', 'PE', '', '2012', '3024', ''),
(240, '1240', 'Health', '', '2012', '3024', ''),
(241, '1241', 'Edukasyon sa Pagpapakatao', '', '2012', '3024', ''),
(242, '1242', 'Computer', '', '2012', '3024', ''),
(243, '1243', 'English', '', '2013', '3025', ''),
(244, '1244', 'Math', '', '2013', '3025', ''),
(245, '1245', 'Science', '', '2013', '3025', ''),
(246, '1246', 'Filipino', '', '2013', '3025', ''),
(247, '1247', 'AP', '', '2013', '3025', ''),
(248, '1248', 'TLE', '', '2013', '3025', ''),
(249, '1249', 'Mapeh', '', '2013', '3025', ''),
(250, '1250', 'Music', '', '2013', '3025', ''),
(251, '1251', 'Arts', '', '2013', '3025', ''),
(252, '1252', 'PE', '', '2013', '3025', ''),
(253, '1253', 'Health', '', '2013', '3025', ''),
(254, '1254', 'Edukasyon sa Pagpapakatao', '', '2013', '3025', ''),
(255, '1255', 'Computer', '', '2013', '3025', ''),
(256, '1256', 'Campus Journalism', '', '2013', '3025', ''),
(257, '1257', 'Statistics', '', '2013', '3025', ''),
(258, '1258', 'English', '', '2013', '3026', ''),
(259, '1259', 'Math', '', '2013', '3026', ''),
(260, '1260', 'Science', '', '2013', '3026', ''),
(261, '1261', 'Filipino', '', '2013', '3026', ''),
(262, '1262', 'AP', '', '2013', '3026', ''),
(263, '1263', 'TLE', '', '2013', '3026', ''),
(264, '1264', 'Mapeh', '', '2013', '3026', ''),
(265, '1265', 'Music', '', '2013', '3026', ''),
(266, '1266', 'Arts', '', '2013', '3026', ''),
(267, '1267', 'PE', '', '2013', '3026', ''),
(268, '1268', 'Health', '', '2013', '3026', ''),
(269, '1269', 'Edukasyon sa Pagpapakatao', '', '2013', '3026', ''),
(270, '1270', 'Computer', '', '2013', '3026', ''),
(271, '1271', 'Campus Journalism', '', '2013', '3026', ''),
(272, '1272', 'Statistics', '', '2013', '3026', ''),
(273, '1273', 'English', '', '2014', '3027', ''),
(274, '1274', 'Math', '', '2014', '3027', ''),
(275, '1275', 'Science', '', '2014', '3027', ''),
(276, '1276', 'Filipino', '', '2014', '3027', ''),
(277, '1277', 'AP', '', '2014', '3027', ''),
(278, '1278', 'TLE', '', '2014', '3027', ''),
(279, '1279', 'Mapeh', '', '2014', '3027', ''),
(280, '1280', 'Music', '', '2014', '3027', ''),
(281, '1281', 'Arts', '', '2014', '3027', ''),
(282, '1282', 'PE', '', '2014', '3027', ''),
(283, '1283', 'Health', '', '2014', '3027', ''),
(284, '1284', 'Edukasyon sa Pagpapakatao', '', '2014', '3027', ''),
(285, '1285', 'Computer', '', '2014', '3027', ''),
(286, '1286', 'Calculus', '', '2014', '3027', ''),
(287, '1287', 'Accounting', '', '2014', '3027', ''),
(288, '1288', 'English', '', '2014', '3028', ''),
(289, '1289', 'Math', '', '2014', '3028', ''),
(290, '1290', 'Science', '', '2014', '3028', ''),
(291, '1291', 'Filipino', '', '2014', '3028', ''),
(292, '1292', 'AP', '', '2014', '3028', ''),
(293, '1293', 'TLE', '', '2014', '3028', ''),
(294, '1294', 'Mapeh', '', '2014', '3028', ''),
(295, '1295', 'Music', '', '2014', '3028', ''),
(296, '1296', 'Arts', '', '2014', '3028', ''),
(297, '1297', 'PE', '', '2014', '3028', ''),
(298, '1298', 'Health', '', '2014', '3028', ''),
(299, '1299', 'Edukasyon sa Pagpapakatao', '', '2014', '3028', ''),
(300, '1300', 'Computer', '', '2014', '3028', ''),
(301, '1301', 'Calculus', '', '2014', '3028', ''),
(302, '1302', 'Accounting', '', '2014', '3028', '');

-- --------------------------------------------------------

--
-- Table structure for table `sy`
--

CREATE TABLE IF NOT EXISTS `sy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sy` varchar(255) NOT NULL,
  `studcount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `sy`
--

INSERT INTO `sy` (`id`, `sy`, `studcount`) VALUES
(10, '2014 - 2015', 0),
(11, '2015 - 2016', 0),
(12, '2016 - 2017', 0),
(13, '2017 - 2018', 0),
(14, '2018 - 2019', 0),
(15, '2019 - 2020', 0),
(16, '2020 - 2021', 0),
(17, '2021 - 2022', 0),
(18, '2022 - 2023', 0),
(19, '2023 - 2024', 0),
(20, '2024 - 2025', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_records`
--

CREATE TABLE IF NOT EXISTS `teacher_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tnum` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `endate` date NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '1',
  `img` blob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tnum` (`tnum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1034 ;

--
-- Dumping data for table `teacher_records`
--

INSERT INTO `teacher_records` (`id`, `tnum`, `fname`, `mname`, `lname`, `alias`, `bio`, `endate`, `stat`, `img`) VALUES
(1033, 'F20161281033', 'admin', 'admin', '', '', '01', '2016-04-01', 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
