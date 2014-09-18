-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2014 at 07:54 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `Bid_lowest_price` decimal(20,2) DEFAULT NULL,
  `bid_higest_price` decimal(20,2) DEFAULT NULL,
  `bid_description` varchar(255) DEFAULT NULL,
  `bid_comments` varchar(255) DEFAULT NULL,
  `user_id` char(18) NOT NULL,
  `property_id` char(18) NOT NULL,
  PRIMARY KEY (`bid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=318 ;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `Bid_lowest_price`, `bid_higest_price`, `bid_description`, `bid_comments`, `user_id`, `property_id`) VALUES
(5, '99999999.99', '99999999.99', 'thisisusers0bidforprop1', 'mymaxbid2', '0', '4'),
(7, '10.00', '20.00', 'thisisusers 0 bid for prop1', 'thisisusers 0 bidfor prop1', '2', '2'),
(8, '99999999.99', '99999999.99', 'thisisusers0bidforprop1', 'thisisusers0bidforprop1', '0', '4'),
(9, '99999999.99', '99999999.99', 'thisisusers0bidforprop2', 'thisisusers0bidforprop2', '0', '2'),
(11, '99999999.00', '99999999.00', 'thisisusers 0 bid for prop1', 'thisis users 0 bid for prop1', '2', '2'),
(12, '700.00', '99999999.99', 'posted65', 'posted', '0', '4'),
(14, '5600.00', '3200.00', 'description', 'bidcomments', '2', '4'),
(17, '5600.00', '3200.00', 'description', 'bidcomments', '2', '4'),
(18, '7.00', '1000000.00', 'posted', 'posted', '0', '6'),
(19, '56.00', '56.00', '56', '56', '', '6'),
(20, '78.00', '78.00', '78', '78', '', ''),
(22, '6700.00', '320000.00', 'description', 'bidcomments', '2', '1'),
(24, '560000.00', '320000.00', 'description', 'bidcomments', '6', '5'),
(26, '5600.00', '3200.00', 'description', 'bidcomments', '2', '1'),
(27, '560000.00', '320000.00', 'descriptionGototrustedorg', 'bidcommentsGototrustedorg', '5', '4'),
(29, '5600.00', '3200.00', 'description', 'bidcomments', '5', '1'),
(31, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(33, '5600.00', '3200.00', 'description', 'bidcomments', '2', '1'),
(35, '5600.00', '3200.00', 'description', 'bidcomments', '1', '4'),
(37, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(39, '5600.00', '3200.00', 'description', 'bidcomments', '6', '1'),
(41, '5600.00', '3200.00', 'description', 'bidcomments', '1', '4'),
(43, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(45, '5600.00', '3200.00', 'description', 'bidcomments', '1', '1'),
(47, '5600.00', '3200.00', 'description', 'bidcomments', '1', '4'),
(49, '5600.00', '3200.00', 'description', 'bidcomments', '4', '1'),
(51, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(53, '560000.00', '320000.00', 'description', 'bidcomments', '6', '4'),
(55, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(57, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(59, '5600.00', '3200.00', 'description', 'bidcomments', '2', '1'),
(61, '5600.00', '3200.00', 'description', 'bidcomments', '6', '1'),
(63, '5600.00', '3200.00', 'description', 'bidcomments', '5', '1'),
(65, '5600.00', '3200.00', 'description', 'bidcomments', '3', '1'),
(67, '5600.00', '3200.00', 'description', 'bidcomments', '3', '1'),
(69, '56.00', '32.00', 'description', 'bid comments', '1', '1'),
(71, '560000.00', '320000.00', 'description', 'bidcomments', '4', '4'),
(311, '6.00', '10000.00', 'bid 10 - 100 jkhjh', 'bid', '0', '2'),
(312, '6.00', '10000.00', 'bid 10 - 100 jkhjh', 'bid', '0', '2'),
(313, '99999999.99', '10000.00', 'bid 10 - 100 jkhjh', 'bid', '0', '2'),
(314, '6798797.00', '10000.00', 'bid 10 - 100 jkhjh', 'bid', '0', '2'),
(315, '6798779897.00', '10000.00', 'bid 10 - 100 jkhjh', 'bid', '0', '2'),
(316, '0.00', '0.00', '', '', '3', '1'),
(317, '0.00', '0.00', '', '', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `property_items`
--

CREATE TABLE IF NOT EXISTS `property_items` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `auction_start_date` date DEFAULT NULL,
  `auction_close_date` date DEFAULT NULL,
  `property_comments` varchar(100) DEFAULT NULL,
  `property_address` varchar(100) DEFAULT NULL,
  `auction_actual_selling_price` decimal(10,2) DEFAULT NULL,
  `property_reserve_price` decimal(10,2) DEFAULT NULL,
  `current_successful_bidder_user` varchar(100) DEFAULT NULL,
  `property_photo` varchar(100) DEFAULT NULL,
  `property_rooms` varchar(100) DEFAULT NULL,
  `property_description` varchar(255) NOT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=299 ;

--
-- Dumping data for table `property_items`
--

INSERT INTO `property_items` (`property_id`, `auction_start_date`, `auction_close_date`, `property_comments`, `property_address`, `auction_actual_selling_price`, `property_reserve_price`, `current_successful_bidder_user`, `property_photo`, `property_rooms`, `property_description`) VALUES
(2, '2014-04-17', '2014-04-25', 'this is a great house3', '128 out there city3', '99999999.00', '0.00', '0 00', '2', '5', 'this is a great house3'),
(4, '0000-00-00', '0000-00-00', 'I wish', '1 wish full thinking Dublin', '0.00', '0.00', '0 00', '3', '9', 'Iwish'),
(6, '0000-00-00', '0000-00-00', 'new big estate2', 'new big estate2', '99999999.00', '0.00', '67 00', '4', '9', 'new big estate'),
(8, '0000-00-00', '0000-00-00', 'new big estate', 'new big estate', '0.00', '0.00', '1 00', '3', '9', 'new big estate 5'),
(10, '0000-00-00', '0000-00-00', 'new big estate', 'new big estate', '450000.00', '100.00', '2', '2', '6587568765', 'new big estate'),
(12, '2014-04-09', '2014-04-13', 'new big estate', 'new big estate', '0.00', '1.00', '6587568765', '6', '3', 'new big estate'),
(14, '2014-04-02', '2014-04-09', 'new big estate5', 'new big estate5', '454545.00', '454545.00', '6587568765', '1', '6587568765', 'new big estate 5'),
(16, '2014-04-08', '2014-04-24', 'a super new house', 'a super new address', '100000.00', '100000.00', '6587568765', '6', '5', 'a super new house'),
(18, '0000-00-00', '0000-00-00', 'a super new house', 'a super new house', '50000.00', '50000.00', '6', '1', '6', 'a super new house d'),
(20, '0000-00-00', '0000-00-00', 'a super new house', 'a super new house', '0.00', '1.00', 'a super new house', '7', '5', 'a super new house'),
(22, '2014-04-09', '2014-04-14', 'a super new house', 'a super new house', '0.00', '1.00', '6587568765', '8', '4', 'a super new house'),
(24, '0000-00-00', '0000-00-00', 'new big house', 'new big estate', '100000.00', '100000.00', '6587568765', '5', '4', 'new big estate'),
(26, '2014-04-09', '2014-04-30', 'a super new house', 'a super new house', '60000.00', '0.00', '60000 00', '8', '5', 'a super new house 3'),
(28, '2014-04-02', '2014-04-09', 'a super new house', 'a super new house', '0.00', '1.00', '6587568765', '1', '5', 'a super new house'),
(30, '2014-04-08', '2014-04-09', 'a super new house', 'a super new house', '0.00', '1.00', '6587568765', '3', '5', 'a super new house'),
(32, '0000-00-00', '0000-00-00', 'a super new house', 'a super new house', '0.00', '1.00', '6', '4', '4', 'a super new house'),
(298, '0000-00-00', '0000-00-00', 'nice', '3', '78.00', '0.00', '78 00', '10', '3', 'new prop');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_password` varchar(25) DEFAULT NULL,
  `user_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_address`, `user_email`, `user_phone`, `user_password`, `user_description`) VALUES
(1, 'gareth', ' outh there', ' user@dit.ie', '12345', 'apassword', ' A bidder'),
(2, 'user2', ' outh there', ' user@dit.ie', '12345', 'apassword', ' A bidder'),
(3, 'user 3', ' outh there', ' user@dit.ie', '12345', 'apassword', ' A bidder'),
(4, 'user 4', ' outh there', ' user@dit.ie', '12345', 'apassword', ' A bidder'),
(5, 'user 5', ' outh there', ' user@dit.ie', '12345', 'apassword', ' A bidder'),
(6, 'user 6', ' outh there', ' user@dit.ie', '12345', 'apassword', ' A bidder');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
