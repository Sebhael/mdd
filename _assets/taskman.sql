-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2013 at 08:56 PM
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
  `asset` text,
  `submitted` datetime NOT NULL,
  `reported` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`noteid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `owner`) VALUES
(1, 'Test', 7);

-- --------------------------------------------------------

--
-- Table structure for table `group_member`
--

CREATE TABLE IF NOT EXISTS `group_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `member` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `slug`, `notes`, `duedate`, `duetime`, `project`, `projectSlug`, `owner`, `access`, `created`, `edited`, `completed`, `completed_stamp`, `reported`) VALUES
(10, 'Testing Task', 'testing-task', 'This is a test foo 1 2', '0000-00-00', '00:00:00', '', '', 1, 1, '2013-03-26 13:52:43', '2013-03-27 19:14:49', 1, '2013-03-27 19:27:26', 0),
(11, 'Testing Task 2', 'testing-task-2', 'This is a test!', '0000-00-00', '00:00:00', '', '', 1, 3, '2013-03-26 13:58:09', '2013-03-27 19:29:02', 0, '0000-00-00 00:00:00', 1),
(12, 'Testing Task 2', 'testing-task-2', 'This is a test!', '0000-00-00', '00:00:00', '', '', 1, 1, '2013-03-26 14:00:07', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 'Pet the Cat', 'pet-the-cat', 'The cat, it requires petting.', '2013-03-29', '09:19:00', NULL, '', 7, 1, '2013-03-29 16:46:02', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 'Beat Han Solo''s Kessel Run record', 'beat-han-solos-kessel-run-record', '12 parsecs? Psh!', '0000-00-00', '00:00:00', NULL, '', 7, 1, '2013-03-29 16:48:59', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 'Make a list of tasks to be completed', 'make-a-list-of-tasks-to-be-completed', 'Then complete this task.', '0000-00-00', '00:00:00', NULL, '', 7, 1, '2013-03-29 16:49:34', '0000-00-00 00:00:00', 1, '2013-03-29 16:49:36', 0);

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
  `newsletter` tinyint(11) NOT NULL DEFAULT '0',
  `reported` tinyint(11) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `newsletter`, `reported`, `admin`) VALUES
(1, 'Testing', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'test@test.com', '2013-03-20 10:25:00', 1, 0, 0),
(7, 'Sebhael', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'sebhael@gmail.com', '2013-03-27 17:44:07', 1, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
