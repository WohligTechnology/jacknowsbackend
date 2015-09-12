-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2015 at 04:27 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expert`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(3, 'Accountant'),
(1, 'admin'),
(2, 'Moderator'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `expert_booking`
--

CREATE TABLE IF NOT EXISTS `expert_booking` (
  `id` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `date` date NOT NULL,
  `starttime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_booking`
--

INSERT INTO `expert_booking` (`id`, `fromuser`, `touser`, `date`, `starttime`, `endtime`, `status`) VALUES
(1, 5, 7, '2015-09-19', '12:00', '01:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `expert_bookingstatus`
--

CREATE TABLE IF NOT EXISTS `expert_bookingstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_bookingstatus`
--

INSERT INTO `expert_bookingstatus` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Complete'),
(4, 'Failed'),
(5, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `expert_certification`
--

CREATE TABLE IF NOT EXISTS `expert_certification` (
  `id` int(11) NOT NULL,
  `certificationid` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `certificationname` varchar(255) NOT NULL,
  `authorityname` varchar(255) NOT NULL,
  `licensenumber` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_certification`
--

INSERT INTO `expert_certification` (`id`, `certificationid`, `user`, `certificationname`, `authorityname`, `licensenumber`, `startdate`, `enddate`) VALUES
(1, '12', 4, '2', '2', '2', '0001-02-02', '0001-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `expert_course`
--

CREATE TABLE IF NOT EXISTS `expert_course` (
  `id` int(11) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `coursenumber` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_course`
--

INSERT INTO `expert_course` (`id`, `courseid`, `user`, `name`, `coursenumber`) VALUES
(1, '12', 4, '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `expert_education`
--

CREATE TABLE IF NOT EXISTS `expert_education` (
  `id` int(11) NOT NULL,
  `educationid` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `schoolname` varchar(255) NOT NULL,
  `fieldofstudy` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `degree` varchar(255) NOT NULL,
  `activities` varchar(255) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_education`
--

INSERT INTO `expert_education` (`id`, `educationid`, `user`, `schoolname`, `fieldofstudy`, `startdate`, `enddate`, `degree`, `activities`, `notes`) VALUES
(1, '1', 4, '1', '1', '2131-12-12', '2121-12-12', '121', '13', '1wdcsdc');

-- --------------------------------------------------------

--
-- Table structure for table `expert_language`
--

CREATE TABLE IF NOT EXISTS `expert_language` (
  `id` int(11) NOT NULL,
  `languageid` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `languagename` varchar(255) NOT NULL,
  `proficiancylevel` varchar(255) NOT NULL,
  `proficiancyname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_language`
--

INSERT INTO `expert_language` (`id`, `languageid`, `user`, `languagename`, `proficiancylevel`, `proficiancyname`) VALUES
(1, '1', 4, '1', '1', '12');

-- --------------------------------------------------------

--
-- Table structure for table `expert_patent`
--

CREATE TABLE IF NOT EXISTS `expert_patent` (
  `id` int(11) NOT NULL,
  `patentid` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `number` varchar(255) NOT NULL,
  `statusid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `officename` varchar(255) NOT NULL,
  `inventorid` varchar(255) NOT NULL,
  `inventorname` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_patent`
--

INSERT INTO `expert_patent` (`id`, `patentid`, `user`, `title`, `summary`, `number`, `statusid`, `status`, `officename`, `inventorid`, `inventorname`, `date`, `url`) VALUES
(1, 1, 4, '1', '1iub', '1', 1, '1', '1', '1', '1', '2013-12-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expert_publication`
--

CREATE TABLE IF NOT EXISTS `expert_publication` (
  `id` int(11) NOT NULL,
  `publicationid` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publishername` varchar(255) NOT NULL,
  `authorid` varchar(255) NOT NULL,
  `authorname` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `publicationurl` varchar(255) NOT NULL,
  `summary` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_publication`
--

INSERT INTO `expert_publication` (`id`, `publicationid`, `user`, `title`, `publishername`, `authorid`, `authorname`, `date`, `publicationurl`, `summary`) VALUES
(1, 1, 4, '1', '1', '1', '1', '1212-12-12', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expert_question`
--

CREATE TABLE IF NOT EXISTS `expert_question` (
  `id` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_question`
--

INSERT INTO `expert_question` (`id`, `fromuser`, `question`) VALUES
(1, 6, 'What are advantages of laravel over codeigniter?');

-- --------------------------------------------------------

--
-- Table structure for table `expert_questionuser`
--

CREATE TABLE IF NOT EXISTS `expert_questionuser` (
  `id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_questionuser`
--

INSERT INTO `expert_questionuser` (`id`, `question`, `touser`, `status`) VALUES
(2, 1, 13, 2),
(3, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expert_questionuserstatus`
--

CREATE TABLE IF NOT EXISTS `expert_questionuserstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_questionuserstatus`
--

INSERT INTO `expert_questionuserstatus` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Yes'),
(3, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `expert_skill`
--

CREATE TABLE IF NOT EXISTS `expert_skill` (
  `id` int(11) NOT NULL,
  `skillid` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `skillname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_skill`
--

INSERT INTO `expert_skill` (`id`, `skillid`, `user`, `skillname`) VALUES
(1, '12', 4, '2');

-- --------------------------------------------------------

--
-- Table structure for table `expert_transaction`
--

CREATE TABLE IF NOT EXISTS `expert_transaction` (
  `id` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_transaction`
--

INSERT INTO `expert_transaction` (`id`, `fromuser`, `touser`, `amount`, `type`) VALUES
(1, 1, 13, 200001, '0');

-- --------------------------------------------------------

--
-- Table structure for table `expert_usergallery`
--

CREATE TABLE IF NOT EXISTS `expert_usergallery` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_usergallery`
--

INSERT INTO `expert_usergallery` (`id`, `user`, `type`, `image`, `audio`, `video`) VALUES
(1, 4, 0, 'Nature_at_its_Best!!!2.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(6, 'Booking', '', '', 'site/viewbooking', 1, 0, 1, 2, 'icon-user'),
(7, 'Transaction', '', '', 'site/viewtransaction', 1, 0, 1, 3, 'icon-user'),
(8, 'Question', '', '', 'site/viewquestion', 1, 0, 1, 4, 'icon-user');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active'),
(3, 'Waiting'),
(4, 'Active Waiting'),
(5, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` int(11) NOT NULL,
  `json` text NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `maidenname` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `shortspecialities` text NOT NULL,
  `interests` text NOT NULL,
  `honorsawards` text NOT NULL,
  `wallet` double NOT NULL,
  `access` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `firstname`, `lastname`, `maidenname`, `type`, `shortspecialities`, `interests`, `honorsawards`, `wallet`, `access`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(4, 'pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, 'pratik', '1', 1, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(5, 'wohlig123', 'wohlig123', 'wohlig1@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(6, 'wohlig1', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 1, '2014-10-17 06:22:29', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(9, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@email.com', 2, '2014-12-03 11:06:19', 3, '', '', '123', 1, 'demojson', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(13, 'aaa', 'a208e5837519309129fa466b0c68396b', 'aaa3@email.com', 3, '2014-12-04 06:55:42', 3, NULL, '', '1', 2, 'userjson', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(14, 'Rohan Patil', 'aeae5b2f900e84d784a0f0111e650835', 'rohan@gmail.com', 1, '2015-01-04 10:20:37', 2, '', '', '1', 1, 'demojson', '2015-01-15', 'kacheri street', 'yashodatt apt', 'karjat', 'Maharashtra', 'India', '410201', 'rohan09@fb.com', 'rohan@google.com', '#rohand', '', '', '', 0, '', '', '', 0, ''),
(16, 'aaa', 'pass', 'avi@aaa.aaa', NULL, '2015-03-23 11:35:02', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(17, 'chin', 'f3abbf3960a3c7683c1a14eb176d1a28', 'chi@chi.com', 2, '2015-03-23 11:43:08', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(18, 'Avinash Ghare', '', '', 3, '2015-07-13 06:58:39', 1, 'https://graph.facebook.com/846541392081594/picture?width=150&height=150', '', '846541392081594', 0, '', '0000-00-00', '', ',', '', '', '', '', '846541392081594', '', '', '', '', '', 0, '', '', '', 0, ''),
(19, 'ambest media', '', 'ambestmediacloud@gmail.com', 3, '2015-07-13 07:15:31', 1, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '103739122467358278817', 0, '', '0000-00-00', '', ',', '', '', '', '', '', '103739122467358278817', '', '', '', '', 0, '', '', '', 0, ''),
(20, 'avinash_ghare', '', '', 3, '2015-07-13 07:22:56', 1, 'http://abs.twimg.com/sticky/default_profile_images/default_profile_1_normal.png', '', '2478104798', 0, '', '0000-00-00', '', ',', '', '', '', '', '', '', '2478104798', '', '', '', 0, '', '', '', 0, ''),
(21, NULL, 'a208e5837519309129fa466b0c68396b', 'a@aaa.com', 3, '2015-08-11 06:17:58', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(22, NULL, 'a208e5837519309129fa466b0c68396b', 'a23@aaa.com', 3, '2015-08-11 06:18:16', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, ''),
(25, 'Avinash Ghare', '', 'avinash@wohlig.com', 3, '2015-08-11 11:01:24', 1, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg', '', '118313183524893739637', 4, '', '0000-00-00', '', ',', '', '', '', '', '', '118313183524893739637', '', '', '', '', 0, '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `expert_booking`
--
ALTER TABLE `expert_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_bookingstatus`
--
ALTER TABLE `expert_bookingstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_certification`
--
ALTER TABLE `expert_certification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_course`
--
ALTER TABLE `expert_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_education`
--
ALTER TABLE `expert_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_language`
--
ALTER TABLE `expert_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_patent`
--
ALTER TABLE `expert_patent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_publication`
--
ALTER TABLE `expert_publication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_question`
--
ALTER TABLE `expert_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_questionuser`
--
ALTER TABLE `expert_questionuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_questionuserstatus`
--
ALTER TABLE `expert_questionuserstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_skill`
--
ALTER TABLE `expert_skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_transaction`
--
ALTER TABLE `expert_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_usergallery`
--
ALTER TABLE `expert_usergallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `expert_booking`
--
ALTER TABLE `expert_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_bookingstatus`
--
ALTER TABLE `expert_bookingstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expert_certification`
--
ALTER TABLE `expert_certification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_course`
--
ALTER TABLE `expert_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_education`
--
ALTER TABLE `expert_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_language`
--
ALTER TABLE `expert_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_patent`
--
ALTER TABLE `expert_patent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_publication`
--
ALTER TABLE `expert_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_question`
--
ALTER TABLE `expert_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_questionuser`
--
ALTER TABLE `expert_questionuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expert_questionuserstatus`
--
ALTER TABLE `expert_questionuserstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expert_skill`
--
ALTER TABLE `expert_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_transaction`
--
ALTER TABLE `expert_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `expert_usergallery`
--
ALTER TABLE `expert_usergallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
