-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2013 at 04:23 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taskman`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `noteid` int(11) NOT NULL AUTO_INCREMENT,
  `note` text NOT NULL,
  `task` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `submitted` datetime NOT NULL,
  `reported` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`noteid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(95) NOT NULL,
  `slug` varchar(95) NOT NULL,
  `notes` text NOT NULL,
  `duedate` date NOT NULL,
  `duetime` time NOT NULL,
  `project` varchar(100) DEFAULT NULL,
  `projectSlug` varchar(100) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `access` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `edited` datetime NOT NULL,
  `completed` tinyint(4) NOT NULL DEFAULT '0',
  `completed_stamp` datetime NOT NULL,
  `reported` tinyint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `slug`, `notes`, `duedate`, `duetime`, `project`, `projectSlug`, `owner`, `access`, `created`, `edited`, `completed`, `completed_stamp`, `reported`) VALUES
(10, 'Testing Task', 'testing-task', 'This is a test foo 1 2', '0000-00-00', '00:00:00', '', '', 1, 1, '2013-03-26 13:52:43', '2013-03-27 19:14:49', 1, '2013-03-27 19:27:26', 0),
(11, 'Testing Task 2', 'testing-task-2', 'This is a test!', '0000-00-00', '00:00:00', '', '', 1, 3, '2013-03-26 13:58:09', '2013-03-27 19:29:02', 0, '0000-00-00 00:00:00', 1),
(12, 'Testing Task 2', 'testing-task-2', 'This is a test!', '0000-00-00', '00:00:00', '', '', 1, 1, '2013-03-26 14:00:07', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 'Testing', 'testing', 'this is a test, part 1', '2013-05-04', '15:01:00', '0', '0', 7, 1, '2013-03-28 13:27:53', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 'Testing Project Addition', 'testing-project-addition', 'Testing SQL insertion for NULL project addition', '0000-00-00', '00:00:00', NULL, '', 7, 1, '2013-03-28 15:33:39', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `reported` tinyint(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `reported`) VALUES
(1, 'Testing', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'test@test.com', '2013-03-20 10:25:00', 0),
(7, 'Sebhael', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'sebhael@gmail.com', '2013-03-27 17:44:07', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
