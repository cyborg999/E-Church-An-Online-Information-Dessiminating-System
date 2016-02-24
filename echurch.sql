-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2015 at 06:14 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `echurch`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `description`, `user_id`, `dateadded`, `deleted`) VALUES
(6, 'Police Reports Differ From Video of McDonald Shooting', 'Hundreds of pages of documents released by Chicago officials show police officers depicting a starkly contrasting narrative to squad car video footage showing a white officer shooting a black teenager 16 times', 24, '2015-12-06 05:02:27', 0),
(7, 'Canadian Government Reaffirms Plan to Legalize Pot', 'In a speech laying out policy plans, Governor General David Johnston said the new Liberal government would make recreational use of the drug legal, but that it would also regulate and restrict access—though details about those restrictions were not forthcoming', 24, '2015-12-06 05:02:42', 0),
(8, 'President Obama to Deliver Address on Terrorism', 'President Obama will deliver a primetime address to the nation Sunday night on the threat of terrorism, following last week''s killing of 14 Americans in San Bernardino and the recent attacks in Paris.', 24, '2015-12-06 05:02:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) NOT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `municipality`, `name`, `deleted`) VALUES
(1, 'boac', 'Tamakoma Branch', NULL),
(2, 'boac', 'Boac Branch #1', NULL),
(3, 'boac', 'Boac Branch #2', NULL),
(4, 'mogpog', 'Mogpog Branch', NULL),
(5, 'gasan', 'Gasan Branch', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) unsigned NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `dateadded` datetime DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `filename`, `type`, `size`, `dateadded`, `service_id`) VALUES
(17, 'http://localhost/echurch/server/php/files/lefian_s_commune__forecrest__by_nonohara_susu-d6egsn7%20%284%29.jpg', NULL, NULL, NULL, 9),
(19, 'http://localhost/echurch/server/php/files/binyag%20%281%29.jpg', NULL, NULL, NULL, 10),
(20, 'http://localhost/echurch/server/php/files/wedding.jpg', NULL, NULL, NULL, 13),
(21, 'http://localhost/echurch/server/php/files/bendisyon.jpg', NULL, NULL, NULL, 14),
(22, 'http://localhost/echurch/server/php/files/a1.jpg', NULL, NULL, NULL, 15),
(23, 'http://localhost/echurch/server/php/files/a2.png', NULL, NULL, NULL, 17),
(24, 'http://localhost/echurch/server/php/files/s3.jpg', NULL, NULL, NULL, 16),
(25, 'http://localhost/echurch/server/php/files/2.png', NULL, NULL, NULL, 18),
(26, 'http://localhost/echurch/server/php/files/5.png', NULL, NULL, NULL, 19),
(27, 'http://localhost/echurch/server/php/files/dddddddddddddd.png', NULL, NULL, NULL, 20),
(28, 'http://localhost/echurch/server/php/files/taloleft%20cya.png', NULL, NULL, NULL, 21),
(29, 'http://localhost/echurch/server/php/files/1.jpg', NULL, NULL, NULL, 63),
(30, 'http://localhost/echurch/server/php/files/2.jpg', NULL, NULL, NULL, 64),
(31, 'http://localhost/echurch/server/php/files/3.jpg', NULL, NULL, NULL, 65),
(32, 'http://localhost/echurch/server/php/files/5.jpg', NULL, NULL, NULL, 67),
(33, 'http://localhost/echurch/server/php/files/6.jpg', NULL, NULL, NULL, 68),
(34, 'http://localhost/echurch/server/php/files/7.jpg', NULL, NULL, NULL, 69),
(35, 'http://localhost/echurch/server/php/files/8.jpg', NULL, NULL, NULL, 70),
(36, 'http://localhost/echurch/server/php/files/9.jpg', NULL, NULL, NULL, 71),
(37, 'http://localhost/echurch/server/php/files/12.jpg', NULL, NULL, NULL, 75),
(38, 'http://localhost/echurch/server/php/files/16.jpg', NULL, NULL, NULL, 74),
(39, 'http://localhost/echurch/server/php/files/14.jpg', NULL, NULL, NULL, 73),
(40, 'http://localhost/echurch/server/php/files/13.jpg', NULL, NULL, NULL, 72),
(41, 'http://localhost/echurch/server/php/files/7%20%281%29.jpg', NULL, NULL, NULL, 66),
(42, 'http://localhost/echurch/server/php/files/1%20%281%29.jpg', NULL, NULL, NULL, 80),
(43, 'http://localhost/echurch/server/php/files/4.jpg', NULL, NULL, NULL, 79),
(44, 'http://localhost/echurch/server/php/files/11.jpg', NULL, NULL, NULL, 77),
(45, 'http://localhost/echurch/server/php/files/13%20%281%29.jpg', NULL, NULL, NULL, 76),
(46, 'http://localhost/echurch/server/php/files/3%20%281%29.jpg', NULL, NULL, NULL, 78);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `message`, `title`, `recipient_id`, `seen`, `dateadded`, `from`) VALUES
(1, 'test2143242', 'hello', 41, 0, '2015-10-25 21:03:15', 0),
(2, '49!!!!', 'test', 44, 1, '2015-10-25 22:02:29', 0),
(3, 'hello admin, \n\nfrom isd manager', 'test', 45, 0, '2015-10-25 22:17:26', 49),
(4, 'Dropdowns are automatically positioned via CSS within the normal flow of the document. This means dropdowns may be cropped by parents with certain overflow properties or appear out of bounds of the viewport. Address these issues on your own as they arise.', 'May require additional positioning', 44, 1, '2015-10-25 22:31:52', 24),
(5, 'As of v3.1.0, we''ve deprecated .pull-right on dropdown menus. To right-align a menu, use .dropdown-menu-right. Right-aligned nav components in the navbar use a mixin version of this class to automatically align the menu. To override it, use .dropdown-menu', 'Deprecated .pull-right alignment', 44, 1, '2015-10-25 22:32:06', 24);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `pob` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `religion` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `firstname`, `lastname`, `middlename`, `age`, `sex`, `dob`, `address`, `userid`, `civil_status`, `pob`, `photo`, `contact_number`, `religion`, `nationality`) VALUES
(51, 'jordan2344', 'sadiwa', 'dlr', '', 'male', '1970-01-01', '', 24, 'Single', '', '', '234242', '', 'afghan'),
(66, 'Jordan', 'Sadiwa', 'De los Reyes', '0', 'male', '2015-12-02', 'Sandejas St. Pasay,City', 86, 'Single', 'Marinduque', NULL, '09182959171', '', ''),
(67, 'Jordan', 'Sadiwa', 'De los Reyes', '0', 'male', '2015-12-02', 'Sandejas St. Pasay,City', 87, 'Single', 'Marinduque', NULL, '09182959171', '', ''),
(68, 'Jhon2', 'Doe2', 'MidalNaym23', '0', 'female', '2015-12-02', 'Address2', 88, 'Married', 'Marinduque2', NULL, '09182959171', '', 'barbadian'),
(69, 'Jhon2', 'Doe', 'MidalNaym', '0', 'male', '2015-12-02', 'Address', 0, 'Single', 'Marinduque', NULL, '09182959171', '', 'afghan'),
(70, '', '', '', '', '', '1970-01-01', '', 89, NULL, NULL, NULL, '09182959171', '', ''),
(71, '', '', '', '', '', '1970-01-01', '', 91, NULL, NULL, NULL, '09182959181', '', ''),
(72, '', '', '', '', '', '1970-01-01', '', 92, NULL, NULL, NULL, '09182959181', '', ''),
(73, '', '', '', '', '', '1970-01-01', '', 93, NULL, NULL, NULL, '09182959171', '', ''),
(74, '', '', '', '', '', '0000-00-00', '', 94, NULL, NULL, NULL, NULL, '', ''),
(75, '', '', '', '', '', '0000-00-00', '', 95, NULL, NULL, NULL, NULL, '', ''),
(76, 'Jordan', 'Sadiw', 'Delr', '-1', 'male', '2015-12-09', 'Pili', 96, 'Single', 'Marinduque', NULL, '09182959171', '', 'afghan'),
(77, 'Jordan', 'Sadiwa', '', '-1', 'male', '2015-12-16', '', 97, 'Single', '', NULL, '09182959171', '', 'afghan'),
(78, 'Jordan2', 'Sadiwa', 'De Los Reyes', '-1', 'male', '2015-12-07', 'Sandejas St. Pasay,City', 98, 'Single', 'Marinduque', NULL, '09182959171', '', 'afghan'),
(79, 'Jordan', 'Sadiwa', 'De los Reyes', '-1', 'male', '2015-12-09', '', 99, 'Single', '', NULL, '09182959171', '', 'afghan'),
(80, 'jordan', 'sadiwa', '', '', 'male', '1970-01-01', '', 100, 'Single', '', NULL, '09182959171', '', 'afghan');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `message_type` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `shortcode` varchar(255) NOT NULL,
  `request_id` longtext NOT NULL,
  `message` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `to` varchar(255) DEFAULT NULL,
  `viewed` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message_type`, `mobile_number`, `shortcode`, `request_id`, `message`, `timestamp`, `to`, `viewed`) VALUES
(11, 'incoming', '639181234567', '29290123456', '5048303030534D41525430303030303239323030303', 'test+message', '1383609498.44', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requirement`
--

CREATE TABLE IF NOT EXISTS `requirement` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirement`
--

INSERT INTO `requirement` (`id`, `service_id`, `title`) VALUES
(3, 9, 'asdasd '),
(10, 10, 'Birth Certificate '),
(11, 10, 'Marriage Contract of Parent '),
(12, 10, 'Application Form '),
(13, 13, 'Baptismal Certificate '),
(14, 13, 'Confirmation Certificate '),
(15, 13, 'Cenomar(NSO) '),
(16, 13, 'Marriage License '),
(17, 13, 'Marriage Banns '),
(18, 13, 'Permit to Marry '),
(19, 13, 'Marriage Contract '),
(20, 13, 'List of Ninong and Ninang '),
(21, 18, 'sdad '),
(22, 18, '23 '),
(23, 19, 'jhg '),
(24, 63, 'requirement 1 '),
(28, 64, 'requirement 2 '),
(29, 64, 'Required. Defines the message to be sent. Each line should be separated with a LF (\\n). Lines should not exceed 70 characters '),
(30, 64, 'Windows note: If a full stop is found on the beginning of a line in the message, it might be removed. To solve this problem, replace the full stop with a double dot: ');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL,
  `overview` text NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `startdate` text NOT NULL,
  `enddate` text NOT NULL,
  `special` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29731 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `overview`, `dateadded`, `user_id`, `startdate`, `enddate`, `special`, `approved`) VALUES
(29673, '89', '2015-12-06 16:11:27', 24, '12/06/2015 06:00:00', '12/06/2015 08:00:00', 0, 0),
(29674, '89', '2015-12-06 16:11:27', 24, '12/13/2015 06:00:00', '12/13/2015 08:00:00', 0, 0),
(29675, '89', '2015-12-06 16:11:27', 24, '12/20/2015 06:00:00', '12/20/2015 08:00:00', 0, 0),
(29676, '89', '2015-12-06 16:11:27', 24, '12/27/2015 06:00:00', '12/27/2015 08:00:00', 0, 0),
(29677, '89', '2015-12-06 16:11:27', 24, '01/03/2016 06:00:00', '01/03/2016 08:00:00', 0, 0),
(29678, '89', '2015-12-06 16:11:27', 24, '01/10/2016 06:00:00', '01/10/2016 08:00:00', 0, 0),
(29679, '89', '2015-12-06 16:11:27', 24, '01/17/2016 06:00:00', '01/17/2016 08:00:00', 0, 0),
(29680, '89', '2015-12-06 16:11:27', 24, '01/24/2016 06:00:00', '01/24/2016 08:00:00', 0, 0),
(29681, '89', '2015-12-06 16:11:27', 24, '01/31/2016 06:00:00', '01/31/2016 08:00:00', 0, 0),
(29682, '89', '2015-12-06 16:11:27', 24, '02/07/2016 06:00:00', '02/07/2016 08:00:00', 0, 0),
(29683, '89', '2015-12-06 16:11:27', 24, '02/14/2016 06:00:00', '02/14/2016 08:00:00', 0, 0),
(29684, '89', '2015-12-06 16:11:27', 24, '02/21/2016 06:00:00', '02/21/2016 08:00:00', 0, 0),
(29685, '89', '2015-12-06 16:11:27', 24, '02/28/2016 06:00:00', '02/28/2016 08:00:00', 0, 0),
(29686, '89', '2015-12-06 16:11:27', 24, '03/06/2016 06:00:00', '03/06/2016 08:00:00', 0, 0),
(29687, '89', '2015-12-06 16:11:27', 24, '03/13/2016 06:00:00', '03/13/2016 08:00:00', 0, 0),
(29688, '89', '2015-12-06 16:11:27', 24, '03/20/2016 06:00:00', '03/20/2016 08:00:00', 0, 0),
(29689, '89', '2015-12-06 16:11:27', 24, '03/27/2016 06:00:00', '03/27/2016 08:00:00', 0, 0),
(29690, '89', '2015-12-06 16:11:27', 24, '04/03/2016 06:00:00', '04/03/2016 08:00:00', 0, 0),
(29691, '89', '2015-12-06 16:11:27', 24, '04/10/2016 06:00:00', '04/10/2016 08:00:00', 0, 0),
(29692, '89', '2015-12-06 16:11:27', 24, '04/17/2016 06:00:00', '04/17/2016 08:00:00', 0, 0),
(29693, '89', '2015-12-06 16:11:27', 24, '04/24/2016 06:00:00', '04/24/2016 08:00:00', 0, 0),
(29694, '89', '2015-12-06 16:11:27', 24, '05/01/2016 06:00:00', '05/01/2016 08:00:00', 0, 0),
(29695, '89', '2015-12-06 16:11:27', 24, '05/08/2016 06:00:00', '05/08/2016 08:00:00', 0, 0),
(29696, '89', '2015-12-06 16:11:27', 24, '05/15/2016 06:00:00', '05/15/2016 08:00:00', 0, 0),
(29697, '89', '2015-12-06 16:11:27', 24, '05/22/2016 06:00:00', '05/22/2016 08:00:00', 0, 0),
(29698, '89', '2015-12-06 16:11:27', 24, '05/29/2016 06:00:00', '05/29/2016 08:00:00', 0, 0),
(29699, '89', '2015-12-06 16:11:27', 24, '06/05/2016 06:00:00', '06/05/2016 08:00:00', 0, 0),
(29700, '89', '2015-12-06 16:11:27', 24, '06/12/2016 06:00:00', '06/12/2016 08:00:00', 0, 0),
(29701, '89', '2015-12-06 16:11:27', 24, '06/19/2016 06:00:00', '06/19/2016 08:00:00', 0, 0),
(29702, '89', '2015-12-06 16:11:27', 24, '06/26/2016 06:00:00', '06/26/2016 08:00:00', 0, 0),
(29703, '89', '2015-12-06 16:11:27', 24, '07/03/2016 06:00:00', '07/03/2016 08:00:00', 0, 0),
(29704, '89', '2015-12-06 16:11:27', 24, '07/10/2016 06:00:00', '07/10/2016 08:00:00', 0, 0),
(29705, '89', '2015-12-06 16:11:27', 24, '07/17/2016 06:00:00', '07/17/2016 08:00:00', 0, 0),
(29706, '89', '2015-12-06 16:11:27', 24, '07/24/2016 06:00:00', '07/24/2016 08:00:00', 0, 0),
(29707, '89', '2015-12-06 16:11:27', 24, '07/31/2016 06:00:00', '07/31/2016 08:00:00', 0, 0),
(29708, '89', '2015-12-06 16:11:27', 24, '08/07/2016 06:00:00', '08/07/2016 08:00:00', 0, 0),
(29709, '89', '2015-12-06 16:11:27', 24, '08/14/2016 06:00:00', '08/14/2016 08:00:00', 0, 0),
(29710, '89', '2015-12-06 16:11:27', 24, '08/21/2016 06:00:00', '08/21/2016 08:00:00', 0, 0),
(29711, '89', '2015-12-06 16:11:27', 24, '08/28/2016 06:00:00', '08/28/2016 08:00:00', 0, 0),
(29712, '89', '2015-12-06 16:11:27', 24, '09/04/2016 06:00:00', '09/04/2016 08:00:00', 0, 0),
(29713, '89', '2015-12-06 16:11:27', 24, '09/11/2016 06:00:00', '09/11/2016 08:00:00', 0, 0),
(29714, '89', '2015-12-06 16:11:27', 24, '09/18/2016 06:00:00', '09/18/2016 08:00:00', 0, 0),
(29715, '89', '2015-12-06 16:11:27', 24, '09/25/2016 06:00:00', '09/25/2016 08:00:00', 0, 0),
(29716, '89', '2015-12-06 16:11:27', 24, '10/02/2016 06:00:00', '10/02/2016 08:00:00', 0, 0),
(29717, '89', '2015-12-06 16:11:27', 24, '10/09/2016 06:00:00', '10/09/2016 08:00:00', 0, 0),
(29718, '89', '2015-12-06 16:11:27', 24, '10/16/2016 06:00:00', '10/16/2016 08:00:00', 0, 0),
(29719, '89', '2015-12-06 16:11:27', 24, '10/23/2016 06:00:00', '10/23/2016 08:00:00', 0, 0),
(29720, '89', '2015-12-06 16:11:27', 24, '10/30/2016 06:00:00', '10/30/2016 08:00:00', 0, 0),
(29721, '89', '2015-12-06 16:11:27', 24, '11/06/2016 06:00:00', '11/06/2016 08:00:00', 0, 0),
(29722, '89', '2015-12-06 16:11:27', 24, '11/13/2016 06:00:00', '11/13/2016 08:00:00', 0, 0),
(29723, '89', '2015-12-06 16:11:27', 24, '11/20/2016 06:00:00', '11/20/2016 08:00:00', 0, 0),
(29724, '89', '2015-12-06 16:11:27', 24, '11/27/2016 06:00:00', '11/27/2016 08:00:00', 0, 0),
(29725, '89', '2015-12-06 16:11:27', 24, '12/04/2016 06:00:00', '12/04/2016 08:00:00', 0, 0),
(29727, '85', '2015-12-06 16:12:57', 24, '12/06/2015 08:30:00', '12/06/2015 09:00:00', 0, 0),
(29730, '84', '2015-12-06 16:31:14', 24, '12/08/2015 09:30:00', '12/08/2015 10:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `special` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `dateadded`, `special`) VALUES
(83, 'Event #1', 'Pages you view in incognito tabs won’t stick around in your browser’s history, cookie store, or search history after you’ve closed all of your incognito tabs. Any files you download or bookmarks you create will be kept. Learn more about incognito browsing', '2015-12-06 00:00:00', 0),
(84, 'Event # 2', 'Pages you view in incognito tabs won’t stick around in your browser’s history, cookie store, or search history after you’ve closed all of your incognito tabs. Any files you download or bookmarks you create will be kept. Learn more about incognito browsing', '2015-12-06 00:00:00', 0),
(85, 'sdasd', 'asdasd', '2015-12-06 00:00:00', 0),
(86, 'sdasd', 'asdasd', '2015-12-06 00:00:00', 1),
(87, 'sdasd', 'asdasd', '2015-12-06 00:00:00', 0),
(88, 'sdasd', 'asdasd', '2015-12-06 00:00:00', 0),
(89, 'Misan', 'asdasd', '2015-12-06 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) unsigned NOT NULL,
  `about` text,
  `mobile` text,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `slogan` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `about`, `mobile`, `phone`, `fax`, `email`, `slogan`) VALUES
(3, 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.edited', '09182959171', '+032 962 53', 'fax2', 'johndoe@gmail.com', 'Pages you view in incognito tabs won’t stick around in your browser’s history, cookie store, or search history after you’ve closed all of your incognito tabs. Any files you download or bookmarks you create will be kept. Learn more about incognito browsing');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(500) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `desc`, `date_added`, `cover`) VALUES
(25, 'eChurch', 'Going incognito doesn’t hide your browsing from your employer, your internet service provider, or the websites you visit.asdasd', '2015-12-04 09:28:25', 'uploads/NEW_SPORT_BANNER1.jpg'),
(26, 'eChurch ', 'Learn more about incognito browsing Going incognito doesn’t hide your browsing from your employer, your internet service provider, or the websites you visit.', '2015-12-04 10:23:39', 'uploads/3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  `requirement` text,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `date_registered`, `deleted`, `type`, `status`, `note`, `requirement`, `branch_id`) VALUES
(24, 'sudoadmin', '3c54e129eff2d3796423c11fb46a3264', 'admin@gmail.com', '2015-08-19 12:55:41', 0, 'admin', 0, NULL, NULL, NULL),
(97, 'supersuper233', '3c54e129eff2d3796423c11fb46a3264', 'susada@gmail.com', '2015-12-06 15:17:31', 0, 'secretary', 1, NULL, NULL, 1),
(98, 'user_123', '3c54e129eff2d3796423c11fb46a3264', 'user_123@gmail.com', '2015-12-06 15:18:36', 0, 'applicant', 0, NULL, NULL, NULL),
(99, 'user_1235', '3c54e129eff2d3796423c11fb46a3264', 'user_123@gmail.com', '2015-12-06 17:08:34', 0, 'applicant', 0, NULL, NULL, NULL),
(100, 'user404', '3c54e129eff2d3796423c11fb46a3264', 'user404@gmail.com', '2015-12-06 17:12:18', 0, 'secretary', 1, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`), ADD KEY `title` (`title`), ADD KEY `description` (`description`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`), ADD KEY `userid` (`userid`), ADD FULLTEXT KEY `FullText` (`firstname`,`lastname`,`middlename`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirement`
--
ALTER TABLE `requirement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `requirement`
--
ALTER TABLE `requirement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29731;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
