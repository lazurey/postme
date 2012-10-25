-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2012 at 02:50 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sause`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `addr_id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'address id',
  `uid` int(32) NOT NULL COMMENT 'user id',
  `addr_tag` varchar(256) NOT NULL COMMENT 'address tag',
  `address` varchar(1024) NOT NULL COMMENT 'address',
  `status` varchar(64) DEFAULT NULL COMMENT 'status',
  `remark` varchar(256) DEFAULT NULL COMMENT 'remark',
  PRIMARY KEY (`addr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(32) NOT NULL AUTO_INCREMENT,
  `uid` int(32) NOT NULL,
  `event_name` varchar(256) DEFAULT NULL,
  `event_location` varchar(256) NOT NULL,
  `max_sum` int(16) NOT NULL,
  `remark` varchar(256) DEFAULT NULL,
  `event_detail` varchar(1024) DEFAULT NULL,
  `deadline` varchar(32) DEFAULT NULL,
  `status` varchar(256) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='event table' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(32) NOT NULL AUTO_INCREMENT COMMENT 'user id',
  `id` varchar(64) NOT NULL COMMENT 'user name',
  `pwd` varchar(256) NOT NULL COMMENT 'password',
  `img` varchar(256) NOT NULL COMMENT 'avatar',
  `email` varchar(256) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='user table' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_event`
--

CREATE TABLE IF NOT EXISTS `user_event` (
  `uid` int(32) NOT NULL,
  `event_id` int(32) NOT NULL,
  `status` varchar(256) NOT NULL,
  `remark` varchar(512) NOT NULL,
  `addr_id` int(32) NOT NULL,
  PRIMARY KEY (`uid`,`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='user event relate table';
