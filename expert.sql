-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2015 at 06:19 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

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
(1, 1, 26, '2015-09-19', '12:00', '01:00', 1);

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
-- Table structure for table `expert_category`
--

CREATE TABLE IF NOT EXISTS `expert_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_category`
--

INSERT INTO `expert_category` (`id`, `name`) VALUES
(1, 'Career Counselling'),
(2, 'Travel'),
(3, 'Health'),
(4, 'Life style'),
(5, 'Others');

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
-- Table structure for table `expert_hobby`
--

CREATE TABLE IF NOT EXISTS `expert_hobby` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `expinyrs` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `skills` text
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_hobby`
--

INSERT INTO `expert_hobby` (`id`, `user`, `category`, `expinyrs`, `description`, `skills`) VALUES
(3, 40, 2, '5', 'dv dv', NULL),
(4, 41, 2, '2015', 'dddddd', NULL),
(7, 39, 2, '10', 'Travel', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expert_hobbyawards`
--

CREATE TABLE IF NOT EXISTS `expert_hobbyawards` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hobby` int(11) NOT NULL,
  `awards` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_hobbyawards`
--

INSERT INTO `expert_hobbyawards` (`id`, `user`, `hobby`, `awards`) VALUES
(3, 40, 3, 'oscar'),
(4, 41, 4, 'oscar'),
(7, 39, 7, 'Award 1');

-- --------------------------------------------------------

--
-- Table structure for table `expert_hobbyeducation`
--

CREATE TABLE IF NOT EXISTS `expert_hobbyeducation` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hobby` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `yearofpassing` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_hobbyeducation`
--

INSERT INTO `expert_hobbyeducation` (`id`, `user`, `hobby`, `degree`, `institute`, `yearofpassing`) VALUES
(3, 40, 3, 'be', 'mu', '2015'),
(4, 41, 4, 'bsc', 'mu', '2015'),
(7, 39, 7, 'BE', 'SAKEC', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `expert_hobbyphotos`
--

CREATE TABLE IF NOT EXISTS `expert_hobbyphotos` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hobby` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_hobbyphotos`
--

INSERT INTO `expert_hobbyphotos` (`id`, `user`, `hobby`, `image`) VALUES
(7, 39, 7, 'batman.png'),
(8, 39, 7, 'astronaut.png');

-- --------------------------------------------------------

--
-- Table structure for table `expert_hobbyskill`
--

CREATE TABLE IF NOT EXISTS `expert_hobbyskill` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hobby` int(11) NOT NULL,
  `skills` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expert_hobbyskill`
--

INSERT INTO `expert_hobbyskill` (`id`, `user`, `hobby`, `skills`) VALUES
(5, 40, 3, 'skill'),
(6, 40, 3, 'travel'),
(7, 41, 4, 'skill'),
(12, 39, 7, 'lvslv'),
(13, 39, 7, 'slskdnnv');

-- --------------------------------------------------------

--
-- Table structure for table `expert_hobbyvideolinks`
--

CREATE TABLE IF NOT EXISTS `expert_hobbyvideolinks` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hobby` int(11) NOT NULL,
  `videolink` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_hobbyvideolinks`
--

INSERT INTO `expert_hobbyvideolinks` (`id`, `user`, `hobby`, `videolink`) VALUES
(3, 40, 3, ''),
(4, 41, 4, ''),
(7, 39, 7, 'https://www.youtube.com/watch?v=2IIUHleexIk');

-- --------------------------------------------------------

--
-- Table structure for table `expert_hobbywebsite`
--

CREATE TABLE IF NOT EXISTS `expert_hobbywebsite` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hobby` int(11) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_hobbywebsite`
--

INSERT INTO `expert_hobbywebsite` (`id`, `user`, `hobby`, `website`) VALUES
(1, 37, 1, 'bsdbdxb'),
(2, 37, 1, 'sbfbs'),
(5, 40, 3, 'wohlig.com'),
(6, 41, 4, ''),
(9, 39, 7, 'Web 1');

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
-- Table structure for table `expert_profession`
--

CREATE TABLE IF NOT EXISTS `expert_profession` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_profession`
--

INSERT INTO `expert_profession` (`id`, `user`, `category`, `description`) VALUES
(3, 40, 1, 'dv'),
(4, 41, 4, 'asdasda'),
(8, 39, 1, 'Integration'),
(12, 42, 4, 'dbsdzb');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professionaward`
--

CREATE TABLE IF NOT EXISTS `expert_professionaward` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `award` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_professionaward`
--

INSERT INTO `expert_professionaward` (`id`, `user`, `profession`, `award`) VALUES
(5, 40, 3, 'oscar'),
(6, 40, 3, 'filmfare'),
(7, 40, 3, 'ifa'),
(8, 41, 4, 'oscsae'),
(12, 39, 8, 'Award 1'),
(16, 42, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professioneducation`
--

CREATE TABLE IF NOT EXISTS `expert_professioneducation` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `yearofpassing` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_professioneducation`
--

INSERT INTO `expert_professioneducation` (`id`, `user`, `profession`, `degree`, `institute`, `yearofpassing`) VALUES
(3, 40, 3, 'bsc', 'mumbai university', '1995'),
(4, 41, 4, 'bsc', 'mu', '2015'),
(8, 39, 8, 'BE', 'SAKEC', '2014'),
(12, 42, 12, 'bsc', 'annjksn', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professionexperience`
--

CREATE TABLE IF NOT EXISTS `expert_professionexperience` (
  `id` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `companylogo` varchar(255) DEFAULT NULL,
  `jobdescription` text NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_professionexperience`
--

INSERT INTO `expert_professionexperience` (`id`, `profession`, `user`, `companyname`, `jobtitle`, `companylogo`, `jobdescription`, `startdate`, `enddate`) VALUES
(3, 3, 40, 'wohlig', 'dv', '1.jpg', 'dv', '2015-11-02', '2015-11-04'),
(4, 4, 41, 'wohlig', 'job', 'Hobbies_JSON.png', 'dwsc', '2015-11-04', '2015-11-07'),
(8, 8, 39, 'Wohlig', 'App Developer', 'delete-2561.png', 'Integration', '2015-01-16', '2015-11-11'),
(12, 12, 42, 'wohlig', 'kjasfhjk', NULL, 'kjahfjk', '2015-02-04', '2015-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professionphoto`
--

CREATE TABLE IF NOT EXISTS `expert_professionphoto` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_professionphoto`
--

INSERT INTO `expert_professionphoto` (`id`, `user`, `profession`, `image`) VALUES
(12, 40, 3, '11.jpg'),
(13, 40, 3, '21.jpg'),
(14, 40, 3, '3.jpg'),
(15, 40, 3, '22.jpg'),
(16, 40, 3, '12.jpg'),
(17, 40, 3, '23.jpg'),
(18, 40, 3, '13.jpg'),
(19, 40, 3, '31.jpg'),
(20, 40, 3, '24.jpg'),
(27, 39, 8, 'login-bg.jpg'),
(28, 39, 8, 'user.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professionskill`
--

CREATE TABLE IF NOT EXISTS `expert_professionskill` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `skills` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expert_professionskill`
--

INSERT INTO `expert_professionskill` (`id`, `user`, `profession`, `skills`) VALUES
(5, 40, 3, 'skill'),
(6, 40, 3, 'dvv'),
(7, 41, 4, 'skill'),
(8, 41, 4, 'skil'),
(9, 41, 4, 'liks'),
(10, 41, 4, 'kkk'),
(17, 39, 8, 'AnglarJS'),
(18, 39, 8, 'Javascript'),
(19, 42, 12, 'kjafbja'),
(20, 42, 12, 'akknvn');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professionvideolink`
--

CREATE TABLE IF NOT EXISTS `expert_professionvideolink` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `videolink` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_professionvideolink`
--

INSERT INTO `expert_professionvideolink` (`id`, `user`, `profession`, `videolink`) VALUES
(4, 40, 3, ''),
(5, 41, 4, ''),
(11, 39, 8, 'https://www.youtube.com/watch?v=Xc5fFvp8le4'),
(12, 39, 8, 'https://www.youtube.com/watch?v=E357cGzOGLM'),
(16, 42, 12, 'https://www.youtube.com/watch?v=E357cGzOGLM');

-- --------------------------------------------------------

--
-- Table structure for table `expert_professionwebsite`
--

CREATE TABLE IF NOT EXISTS `expert_professionwebsite` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `profession` int(11) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_professionwebsite`
--

INSERT INTO `expert_professionwebsite` (`id`, `user`, `profession`, `website`) VALUES
(3, 40, 3, 'wohlig.com'),
(4, 41, 4, ''),
(8, 39, 8, 'Web 1'),
(12, 42, 12, '');

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
(1, 26, 'What are advantages of laravel over codeigniter?');

-- --------------------------------------------------------

--
-- Table structure for table `expert_questionuser`
--

CREATE TABLE IF NOT EXISTS `expert_questionuser` (
  `id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_questionuser`
--

INSERT INTO `expert_questionuser` (`id`, `question`, `touser`, `status`) VALUES
(2, 1, 1, 2),
(4, 1, 1, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expert_transaction`
--

INSERT INTO `expert_transaction` (`id`, `fromuser`, `touser`, `amount`, `type`) VALUES
(1, 1, 26, 200001, '0'),
(2, 26, 1, 87000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `expert_usercategory`
--

CREATE TABLE IF NOT EXISTS `expert_usercategory` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(6, 'Booking', '', '', 'site/viewbooking', 1, 0, 1, 2, 'icon-user'),
(7, 'Transaction', '', '', 'site/viewtransaction', 1, 0, 1, 3, 'icon-user'),
(8, 'Question', '', '', 'site/viewquestion', 1, 0, 1, 4, 'icon-user'),
(9, 'Create Admins', '', '', 'site/viewuseradmin', 1, 0, 1, 1, 'icon-user'),
(10, 'Category', '', '', 'site/viewcategory', 1, 0, 1, 1, 'icon-user');

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
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(7, 3),
(8, 1),
(8, 2),
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active');

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
  `access` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL,
  `ameturetype` varchar(255) NOT NULL,
  `ametureprice` double NOT NULL,
  `professionalprice` double NOT NULL,
  `gender` varchar(255) NOT NULL,
  `twittersocial` varchar(255) NOT NULL,
  `youtubesocial` varchar(255) NOT NULL,
  `facebooksocial` varchar(255) NOT NULL,
  `isexpert` int(11) NOT NULL,
  `hobbyverification` int(11) NOT NULL,
  `professionverification` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `firstname`, `lastname`, `maidenname`, `type`, `shortspecialities`, `interests`, `honorsawards`, `wallet`, `access`, `contact`, `percent`, `ameturetype`, `ametureprice`, `professionalprice`, `gender`, `twittersocial`, `youtubesocial`, `facebooksocial`, `isexpert`, `hobbyverification`, `professionverification`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '0000-00-00', '', 'gheth', 'fgrst', 'ty', 'bytryt', 'rtr', '', '', '', 'wohlig', 'wohligname', '', 0, '', '', '', 0, '', '8989898989', 50, '', 0, 0, '1', 'rtbe', 'rtrb', 'rtyar', 0, 0, 0),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 4, '2015-09-07 13:40:45', 1, '', '', '1', 1, 'ahjbasj', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 1000, '', '', 70, '0', 250, 500, '', '', '', '', 0, 0, 0),
(26, 'Accountant', 'a63526467438df9566c508027d9cb06b', 'account@wohlig.com', 3, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', '8989898989', 50, '', 0, 0, '', '', '', '', 0, 0, 0),
(27, 'Moderator', 'a63526467438df9566c508027d9cb06b', 'moderator@wohlig.com', 2, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', '', 50, '', 0, 0, '', '', '', '', 0, 0, 0),
(28, 'ajhsbaj', '9189e4085a9a76fd59d76d688adb4bee', 'avinash2@wohlig.com', 2, '2015-09-07 13:35:52', 2, '', '', '', 1, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', '', 50, '', 0, 0, '', '', '', '', 0, 0, 0),
(31, '2', 'e3ceb5881a0a1fdaad01296d7554868d', '2@2.com', 4, '2015-09-12 07:01:46', 1, '', '', '2', 1, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '', 20000, '', '2', 60, '', 150, 400, '', '', '', '', 0, 0, 0),
(32, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig1@wohlig.com', NULL, '2015-11-18 11:04:53', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', '', 0, '', 0, 0, '', '', '', '', 0, 0, 0),
(33, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', NULL, '2015-11-18 11:11:20', NULL, NULL, '', '', 0, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 0, '', '', 0, '', 0, 0, '', '', '', '', 0, 0, 0),
(34, 'pooja1', '4bcc674371a91bf32377cd878d754527', 'pooja1@wohlig.com', 4, '2015-11-19 07:47:06', 2, '', '', 'faiyer45511', 4, '', '0000-00-00', '', 'airoli11', 'navimumbai11', 'maharashtra11', 'india11', '40070811', '', '', '', '', '', '', 0, '', '', '', 8001, '', '9898981', 7001, '', 25001, 50001, '1', 'twi11', 'you11', 'fb11', 0, 0, 0),
(39, 'Dhaval Gala', '9fd4b1c58bfbd10a6498754b7e1836c6', 'dhaval@wohlig.com', NULL, '2015-11-23 11:20:32', NULL, 'IMG_20150312_172654991_HDR1.jpg', '', '', 0, '', '0000-00-00', '', 'Grant Road', 'Mumbai', 'Maharashtra', 'India', '400007', '', '', '', 'Dhaval', 'Gala', '', 0, '', '', '', 0, '', '9029145077', 0, '', 0, 0, '1', 'twi.com', 'you.com', 'fb.com', 1, 0, 0),
(40, 'mahesh@wohlig.com', 'e10adc3949ba59abbe56e057f20f883e', 'mahesh@wohlig.com', NULL, '2015-11-23 12:16:12', NULL, '2.jpg', '', '', 0, '', '0000-00-00', '', 'mumbai', 'mumbai', 'maharastra', 'india', '421001', '', '', '', 'mahesh2', 'maurya', '', 0, '', '', '', 0, '', '87966666', 0, '', 0, 0, '1', '', '', '', 1, 0, 0),
(41, 'mahesh maurya', 'e10adc3949ba59abbe56e057f20f883e', 'm@wohlig.com', NULL, '2015-11-23 14:02:28', NULL, 'Professional_JSON1.png', '', '', 0, '', '0000-00-00', '', 'mumbai', 'mumbai', 'goa', 'india', '421001', '', '', '', 'mahesh', 'maurya', '', 0, '', '', '', 0, '', '8796644444', 0, '', 0, 0, '1', '', '', '', 1, 0, 0),
(42, 'asd aasd', '4297f44b13955235245b2497399d7a93', 'mahesh@mhaesh.com', NULL, '2015-11-24 09:46:09', NULL, 'Professional_JSON2.png', '', '', 0, '', '0000-00-00', '', 'my address', 'mum', 'maharashtra', 'india', '456465', '', '', '', 'asd', 'aasd', '', 0, '', '', '', 0, '', '8987453453', 0, '', 0, 0, '1', '', '', '', 1, 0, 0);

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
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

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
-- Indexes for table `expert_category`
--
ALTER TABLE `expert_category`
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
-- Indexes for table `expert_hobby`
--
ALTER TABLE `expert_hobby`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_hobbyawards`
--
ALTER TABLE `expert_hobbyawards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_hobbyeducation`
--
ALTER TABLE `expert_hobbyeducation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_hobbyphotos`
--
ALTER TABLE `expert_hobbyphotos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_hobbyskill`
--
ALTER TABLE `expert_hobbyskill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_hobbyvideolinks`
--
ALTER TABLE `expert_hobbyvideolinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_hobbywebsite`
--
ALTER TABLE `expert_hobbywebsite`
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
-- Indexes for table `expert_profession`
--
ALTER TABLE `expert_profession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professionaward`
--
ALTER TABLE `expert_professionaward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professioneducation`
--
ALTER TABLE `expert_professioneducation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professionexperience`
--
ALTER TABLE `expert_professionexperience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professionphoto`
--
ALTER TABLE `expert_professionphoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professionskill`
--
ALTER TABLE `expert_professionskill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professionvideolink`
--
ALTER TABLE `expert_professionvideolink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_professionwebsite`
--
ALTER TABLE `expert_professionwebsite`
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
-- Indexes for table `expert_usercategory`
--
ALTER TABLE `expert_usercategory`
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
-- Indexes for table `menuaccess`
--
ALTER TABLE `menuaccess`
  ADD UNIQUE KEY `menu` (`menu`,`access`);

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
-- AUTO_INCREMENT for table `expert_category`
--
ALTER TABLE `expert_category`
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
-- AUTO_INCREMENT for table `expert_hobby`
--
ALTER TABLE `expert_hobby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expert_hobbyawards`
--
ALTER TABLE `expert_hobbyawards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expert_hobbyeducation`
--
ALTER TABLE `expert_hobbyeducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expert_hobbyphotos`
--
ALTER TABLE `expert_hobbyphotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `expert_hobbyskill`
--
ALTER TABLE `expert_hobbyskill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `expert_hobbyvideolinks`
--
ALTER TABLE `expert_hobbyvideolinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expert_hobbywebsite`
--
ALTER TABLE `expert_hobbywebsite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT for table `expert_profession`
--
ALTER TABLE `expert_profession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `expert_professionaward`
--
ALTER TABLE `expert_professionaward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `expert_professioneducation`
--
ALTER TABLE `expert_professioneducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `expert_professionexperience`
--
ALTER TABLE `expert_professionexperience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `expert_professionphoto`
--
ALTER TABLE `expert_professionphoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `expert_professionskill`
--
ALTER TABLE `expert_professionskill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `expert_professionvideolink`
--
ALTER TABLE `expert_professionvideolink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `expert_professionwebsite`
--
ALTER TABLE `expert_professionwebsite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expert_usercategory`
--
ALTER TABLE `expert_usercategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
