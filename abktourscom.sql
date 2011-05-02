-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2011 at 06:27 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abktourscom`
--

-- --------------------------------------------------------

--
-- Table structure for table `jos_hotel`
--

DROP TABLE IF EXISTS `jos_hotel`;
CREATE TABLE IF NOT EXISTS `jos_hotel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_rate` double NOT NULL,
  `min_rate` double NOT NULL,
  `star` int(11) NOT NULL,
  `description` text NOT NULL,
  `checkout` varchar(255) NOT NULL,
  `checkin` varchar(255) NOT NULL,
  `floor_num` int(11) NOT NULL,
  `rest_num` int(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `built` varchar(255) NOT NULL,
  `parking_service` varchar(255) NOT NULL,
  `s24` varchar(255) NOT NULL,
  `room_volt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jos_hotel`
--


-- --------------------------------------------------------

--
-- Table structure for table `jos_hotel_group`
--

DROP TABLE IF EXISTS `jos_hotel_group`;
CREATE TABLE IF NOT EXISTS `jos_hotel_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `jos_hotel_group`
--

INSERT INTO `jos_hotel_group` (`id`, `name`) VALUES
(1, 'Battambang Hotel'),
(2, 'Kamport Hotel'),
(3, 'Kep Hotel'),
(4, 'Koh Kong Hotel'),
(5, 'Kompong Tom Hotel'),
(6, 'Phnom Penh Hotel'),
(7, 'Siem Reap Hotel'),
(8, 'Syhanoukvill Hotels');
