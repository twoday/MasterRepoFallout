-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2013 at 02:51 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `falloutchronicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `access_level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `name`, `access_level`) VALUES
(1, 'Game Development', 1),
(2, 'General', 1),
(3, 'Market', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start` tinyint(1) NOT NULL DEFAULT '0',
  `content` varchar(1500) NOT NULL,
  `post_time` datetime NOT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_forum_id` (`topic_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_forums`
--

CREATE TABLE IF NOT EXISTS `sub_forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sub_forums`
--

INSERT INTO `sub_forums` (`id`, `forum_id`, `name`) VALUES
(1, 1, 'Updates'),
(2, 1, 'Request'),
(3, 2, 'Help'),
(4, 2, 'Off-Topic'),
(5, 2, 'Guild'),
(6, 3, 'Equipment'),
(7, 3, 'Food'),
(8, 3, 'Resources'),
(9, 3, 'Miscellaneous'),
(10, 3, 'Shop');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_forum_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(100) NOT NULL,
  `last_poster` int(11) NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_forum_id` (`sub_forum_id`,`user_id`,`last_poster`),
  KEY `sub_forum_id_2` (`sub_forum_id`,`user_id`,`last_poster`),
  KEY `user_id` (`user_id`),
  KEY `last_poster` (`last_poster`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sub_forums`
--
ALTER TABLE `sub_forums`
  ADD CONSTRAINT `sub_forums_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`sub_forum_id`) REFERENCES `sub_forums` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `topics_ibfk_4` FOREIGN KEY (`last_poster`) REFERENCES `users` (`user_id`);
