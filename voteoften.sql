-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2014 at 09:47 PM
-- Server version: 5.6.17
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voteoften`
--
CREATE DATABASE IF NOT EXISTS `voteoften` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `voteoften`;

-- --------------------------------------------------------

--
-- Table structure for table `change_history`
--

DROP TABLE IF EXISTS `change_history`;
CREATE TABLE IF NOT EXISTS `change_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(2048) NOT NULL,
  `date` bigint(255) NOT NULL,
  `fixed` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `change_history`
--

INSERT INTO `change_history` (`id`, `description`, `date`, `fixed`) VALUES
(1, 'I created this really fancy change history page.  I alternate css.class id with the modulus of each row found: 0 or 1.', 1332097777, 0),
(2, 'Made change_history page public 2 times', 1332097806, 0),
(3, 'The last person to have logged into the system is logged in for the next user, even if it is a remote browser.  Yikes!\n\nThe fix was setting timeouts for inactivity and refreshing the session id.', 1332106842, 1),
(4, 'On the View voting history page; show the reasons and the date for each reason at the bottom of the page.', 1332101955, 0),
(5, 'The global value for $db doesn''t always work.', 1332101612, 0);

-- --------------------------------------------------------

--
-- Table structure for table `congressionaldistricts`
--

DROP TABLE IF EXISTS `congressionaldistricts`;
CREATE TABLE IF NOT EXISTS `congressionaldistricts` (
  `zipcode` int(11) NOT NULL,
  `district1` int(5) NOT NULL,
  `district2` int(5) NOT NULL,
  `district3` int(5) NOT NULL,
  `district4` int(5) NOT NULL,
  `district5` int(5) NOT NULL,
  PRIMARY KEY (`zipcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `congressionaldistricts`
--

INSERT INTO `congressionaldistricts` (`zipcode`, `district1`, `district2`, `district3`, `district4`, `district5`) VALUES
(80002, 7, 0, 0, 0, 0),
(80003, 2, 7, 0, 0, 0),
(80004, 7, 0, 0, 0, 0),
(80005, 2, 7, 0, 0, 0),
(80007, 2, 6, 7, 0, 0),
(80010, 7, 0, 0, 0, 0),
(80011, 6, 7, 0, 0, 0),
(80012, 7, 0, 0, 0, 0),
(80013, 6, 7, 0, 0, 0),
(80014, 1, 6, 7, 0, 0),
(80015, 6, 0, 0, 0, 0),
(80016, 6, 0, 0, 0, 0),
(80017, 7, 0, 0, 0, 0),
(80018, 6, 7, 0, 0, 0),
(80019, 7, 0, 0, 0, 0),
(80020, 2, 0, 0, 0, 0),
(80021, 2, 0, 0, 0, 0),
(80022, 7, 0, 0, 0, 0),
(80024, 7, 0, 0, 0, 0),
(80025, 2, 0, 0, 0, 0),
(80026, 2, 0, 0, 0, 0),
(80027, 2, 0, 0, 0, 0),
(80030, 2, 7, 0, 0, 0),
(80031, 2, 0, 0, 0, 0),
(80033, 7, 0, 0, 0, 0),
(80101, 6, 0, 0, 0, 0),
(80102, 6, 7, 0, 0, 0),
(80103, 6, 7, 0, 0, 0),
(80104, 6, 0, 0, 0, 0),
(80105, 6, 7, 0, 0, 0),
(80106, 5, 6, 0, 0, 0),
(80107, 6, 0, 0, 0, 0),
(80110, 1, 6, 0, 0, 0),
(80111, 1, 6, 0, 0, 0),
(80112, 6, 0, 0, 0, 0),
(80116, 6, 0, 0, 0, 0),
(80117, 6, 0, 0, 0, 0),
(80118, 6, 0, 0, 0, 0),
(80120, 1, 6, 0, 0, 0),
(80121, 1, 6, 0, 0, 0),
(80122, 6, 0, 0, 0, 0),
(80123, 1, 6, 7, 0, 0),
(80124, 6, 0, 0, 0, 0),
(80125, 6, 0, 0, 0, 0),
(80126, 6, 0, 0, 0, 0),
(80127, 6, 7, 0, 0, 0),
(80128, 6, 0, 0, 0, 0),
(80132, 5, 0, 0, 0, 0),
(80133, 5, 0, 0, 0, 0),
(80134, 6, 0, 0, 0, 0),
(80135, 6, 0, 0, 0, 0),
(80136, 6, 7, 0, 0, 0),
(80137, 6, 7, 0, 0, 0),
(80138, 6, 0, 0, 0, 0),
(80202, 1, 0, 0, 0, 0),
(80203, 1, 0, 0, 0, 0),
(80204, 1, 0, 0, 0, 0),
(80205, 1, 0, 0, 0, 0),
(80206, 1, 0, 0, 0, 0),
(80207, 1, 0, 0, 0, 0),
(80209, 1, 0, 0, 0, 0),
(80210, 1, 0, 0, 0, 0),
(80211, 1, 0, 0, 0, 0),
(80212, 1, 7, 0, 0, 0),
(80214, 1, 7, 0, 0, 0),
(80215, 7, 0, 0, 0, 0),
(80216, 1, 7, 0, 0, 0),
(80218, 1, 0, 0, 0, 0),
(80219, 1, 0, 0, 0, 0),
(80220, 1, 0, 0, 0, 0),
(80221, 1, 2, 7, 0, 0),
(80222, 1, 0, 0, 0, 0),
(80223, 1, 0, 0, 0, 0),
(80224, 1, 0, 0, 0, 0),
(80226, 1, 7, 0, 0, 0),
(80227, 1, 7, 0, 0, 0),
(80228, 6, 7, 0, 0, 0),
(80229, 2, 7, 0, 0, 0),
(80230, 1, 0, 0, 0, 0),
(80231, 1, 7, 0, 0, 0),
(80232, 1, 7, 0, 0, 0),
(80233, 2, 7, 0, 0, 0),
(80234, 2, 0, 0, 0, 0),
(80235, 1, 6, 7, 0, 0),
(80236, 1, 0, 0, 0, 0),
(80237, 1, 0, 0, 0, 0),
(80239, 1, 0, 0, 0, 0),
(80241, 2, 0, 0, 0, 0),
(80246, 1, 0, 0, 0, 0),
(80249, 1, 0, 0, 0, 0),
(80260, 2, 0, 0, 0, 0),
(80264, 1, 0, 0, 0, 0),
(80290, 1, 0, 0, 0, 0),
(80293, 1, 0, 0, 0, 0),
(80294, 1, 0, 0, 0, 0),
(80301, 2, 0, 0, 0, 0),
(80302, 2, 0, 0, 0, 0),
(80303, 2, 0, 0, 0, 0),
(80304, 2, 0, 0, 0, 0),
(80401, 6, 7, 0, 0, 0),
(80403, 2, 6, 7, 0, 0),
(80420, 5, 0, 0, 0, 0),
(80421, 5, 6, 0, 0, 0),
(80422, 2, 0, 0, 0, 0),
(80423, 2, 0, 0, 0, 0),
(80424, 2, 0, 0, 0, 0),
(80425, 6, 0, 0, 0, 0),
(80426, 2, 0, 0, 0, 0),
(80427, 2, 0, 0, 0, 0),
(80428, 3, 0, 0, 0, 0),
(80430, 3, 0, 0, 0, 0),
(80432, 5, 0, 0, 0, 0),
(80433, 6, 0, 0, 0, 0),
(80434, 3, 0, 0, 0, 0),
(80435, 2, 0, 0, 0, 0),
(80436, 2, 0, 0, 0, 0),
(80438, 2, 0, 0, 0, 0),
(80439, 2, 6, 0, 0, 0),
(80440, 5, 0, 0, 0, 0),
(80442, 2, 0, 0, 0, 0),
(80443, 2, 0, 0, 0, 0),
(80444, 2, 0, 0, 0, 0),
(80446, 2, 0, 0, 0, 0),
(80447, 2, 0, 0, 0, 0),
(80448, 5, 0, 0, 0, 0),
(80449, 5, 0, 0, 0, 0),
(80451, 2, 0, 0, 0, 0),
(80452, 2, 0, 0, 0, 0),
(80454, 6, 0, 0, 0, 0),
(80455, 2, 0, 0, 0, 0),
(80456, 5, 0, 0, 0, 0),
(80457, 6, 0, 0, 0, 0),
(80459, 2, 0, 0, 0, 0),
(80461, 5, 0, 0, 0, 0),
(80463, 2, 3, 0, 0, 0),
(80465, 6, 7, 0, 0, 0),
(80466, 2, 0, 0, 0, 0),
(80467, 3, 0, 0, 0, 0),
(80468, 2, 0, 0, 0, 0),
(80469, 3, 0, 0, 0, 0),
(80470, 6, 0, 0, 0, 0),
(80473, 3, 0, 0, 0, 0),
(80474, 2, 0, 0, 0, 0),
(80476, 2, 0, 0, 0, 0),
(80478, 2, 0, 0, 0, 0),
(80479, 3, 0, 0, 0, 0),
(80480, 3, 0, 0, 0, 0),
(80481, 2, 0, 0, 0, 0),
(80482, 2, 0, 0, 0, 0),
(80483, 3, 0, 0, 0, 0),
(80487, 3, 0, 0, 0, 0),
(80498, 2, 0, 0, 0, 0),
(80501, 2, 4, 0, 0, 0),
(80503, 2, 4, 0, 0, 0),
(80504, 2, 4, 0, 0, 0),
(80510, 2, 0, 0, 0, 0),
(80512, 4, 0, 0, 0, 0),
(80513, 4, 0, 0, 0, 0),
(80514, 2, 0, 0, 0, 0),
(80515, 4, 0, 0, 0, 0),
(80516, 2, 0, 0, 0, 0),
(80517, 4, 0, 0, 0, 0),
(80520, 2, 0, 0, 0, 0),
(80521, 4, 0, 0, 0, 0),
(80524, 4, 0, 0, 0, 0),
(80525, 4, 0, 0, 0, 0),
(80526, 4, 0, 0, 0, 0),
(80528, 4, 0, 0, 0, 0),
(80530, 2, 0, 0, 0, 0),
(80532, 4, 0, 0, 0, 0),
(80534, 4, 0, 0, 0, 0),
(80535, 4, 0, 0, 0, 0),
(80536, 4, 0, 0, 0, 0),
(80537, 4, 0, 0, 0, 0),
(80538, 4, 0, 0, 0, 0),
(80540, 2, 4, 0, 0, 0),
(80542, 4, 0, 0, 0, 0),
(80543, 4, 0, 0, 0, 0),
(80545, 4, 0, 0, 0, 0),
(80547, 4, 0, 0, 0, 0),
(80549, 4, 0, 0, 0, 0),
(80550, 4, 0, 0, 0, 0),
(80601, 2, 4, 7, 0, 0),
(80610, 4, 0, 0, 0, 0),
(80611, 4, 0, 0, 0, 0),
(80612, 4, 0, 0, 0, 0),
(80615, 4, 0, 0, 0, 0),
(80620, 4, 0, 0, 0, 0),
(80621, 2, 4, 0, 0, 0),
(80623, 4, 0, 0, 0, 0),
(80624, 4, 0, 0, 0, 0),
(80631, 4, 0, 0, 0, 0),
(80634, 4, 0, 0, 0, 0),
(80640, 2, 7, 0, 0, 0),
(80642, 4, 7, 0, 0, 0),
(80643, 4, 0, 0, 0, 0),
(80644, 4, 0, 0, 0, 0),
(80645, 4, 0, 0, 0, 0),
(80648, 4, 0, 0, 0, 0),
(80649, 4, 0, 0, 0, 0),
(80650, 4, 0, 0, 0, 0),
(80651, 4, 0, 0, 0, 0),
(80652, 4, 0, 0, 0, 0),
(80653, 4, 0, 0, 0, 0),
(80654, 4, 7, 0, 0, 0),
(80701, 4, 7, 0, 0, 0),
(80705, 4, 0, 0, 0, 0),
(80720, 4, 0, 0, 0, 0),
(80721, 4, 0, 0, 0, 0),
(80722, 4, 0, 0, 0, 0),
(80723, 4, 0, 0, 0, 0),
(80726, 4, 0, 0, 0, 0),
(80727, 4, 0, 0, 0, 0),
(80728, 4, 0, 0, 0, 0),
(80729, 4, 0, 0, 0, 0),
(80731, 4, 0, 0, 0, 0),
(80733, 4, 0, 0, 0, 0),
(80734, 4, 0, 0, 0, 0),
(80735, 4, 0, 0, 0, 0),
(80736, 4, 0, 0, 0, 0),
(80737, 4, 0, 0, 0, 0),
(80740, 4, 0, 0, 0, 0),
(80741, 4, 0, 0, 0, 0),
(80742, 4, 0, 0, 0, 0),
(80743, 4, 0, 0, 0, 0),
(80744, 4, 0, 0, 0, 0),
(80745, 4, 0, 0, 0, 0),
(80747, 4, 0, 0, 0, 0),
(80749, 4, 0, 0, 0, 0),
(80750, 4, 0, 0, 0, 0),
(80751, 4, 0, 0, 0, 0),
(80754, 4, 0, 0, 0, 0),
(80755, 4, 0, 0, 0, 0),
(80757, 4, 0, 0, 0, 0),
(80758, 4, 0, 0, 0, 0),
(80759, 4, 0, 0, 0, 0),
(80801, 4, 0, 0, 0, 0),
(80802, 4, 0, 0, 0, 0),
(80804, 4, 0, 0, 0, 0),
(80805, 4, 0, 0, 0, 0),
(80807, 4, 0, 0, 0, 0),
(80808, 5, 6, 0, 0, 0),
(80809, 5, 0, 0, 0, 0),
(80810, 4, 0, 0, 0, 0),
(80812, 4, 0, 0, 0, 0),
(80813, 5, 0, 0, 0, 0),
(80814, 5, 0, 0, 0, 0),
(80815, 4, 0, 0, 0, 0),
(80816, 5, 0, 0, 0, 0),
(80817, 5, 0, 0, 0, 0),
(80818, 4, 0, 0, 0, 0),
(80819, 5, 0, 0, 0, 0),
(80820, 5, 0, 0, 0, 0),
(80821, 4, 0, 0, 0, 0),
(80822, 4, 0, 0, 0, 0),
(80823, 4, 0, 0, 0, 0),
(80824, 4, 0, 0, 0, 0),
(80825, 4, 0, 0, 0, 0),
(80827, 5, 0, 0, 0, 0),
(80828, 4, 6, 0, 0, 0),
(80829, 5, 0, 0, 0, 0),
(80830, 6, 0, 0, 0, 0),
(80831, 5, 0, 0, 0, 0),
(80832, 5, 6, 0, 0, 0),
(80833, 6, 0, 0, 0, 0),
(80834, 4, 0, 0, 0, 0),
(80835, 5, 6, 0, 0, 0),
(80836, 4, 0, 0, 0, 0),
(80840, 5, 0, 0, 0, 0),
(80860, 5, 0, 0, 0, 0),
(80861, 4, 0, 0, 0, 0),
(80862, 4, 0, 0, 0, 0),
(80863, 5, 0, 0, 0, 0),
(80864, 5, 0, 0, 0, 0),
(80866, 5, 0, 0, 0, 0),
(80903, 5, 0, 0, 0, 0),
(80904, 5, 0, 0, 0, 0),
(80905, 5, 0, 0, 0, 0),
(80906, 5, 0, 0, 0, 0),
(80907, 5, 0, 0, 0, 0),
(80908, 5, 0, 0, 0, 0),
(80909, 5, 0, 0, 0, 0),
(80910, 5, 0, 0, 0, 0),
(80911, 5, 0, 0, 0, 0),
(80913, 5, 0, 0, 0, 0),
(80915, 5, 0, 0, 0, 0),
(80916, 5, 0, 0, 0, 0),
(80917, 5, 0, 0, 0, 0),
(80918, 5, 0, 0, 0, 0),
(80919, 5, 0, 0, 0, 0),
(80920, 5, 0, 0, 0, 0),
(80921, 5, 0, 0, 0, 0),
(80922, 5, 0, 0, 0, 0),
(80925, 5, 0, 0, 0, 0),
(80926, 5, 0, 0, 0, 0),
(80928, 5, 0, 0, 0, 0),
(80929, 5, 0, 0, 0, 0),
(80930, 5, 0, 0, 0, 0),
(81001, 3, 0, 0, 0, 0),
(81003, 3, 0, 0, 0, 0),
(81004, 3, 0, 0, 0, 0),
(81005, 3, 0, 0, 0, 0),
(81006, 3, 0, 0, 0, 0),
(81007, 3, 0, 0, 0, 0),
(81008, 3, 5, 0, 0, 0),
(81020, 3, 0, 0, 0, 0),
(81021, 4, 0, 0, 0, 0),
(81022, 3, 0, 0, 0, 0),
(81023, 3, 0, 0, 0, 0),
(81024, 3, 0, 0, 0, 0),
(81025, 3, 0, 0, 0, 0),
(81027, 3, 0, 0, 0, 0),
(81029, 4, 0, 0, 0, 0),
(81030, 4, 0, 0, 0, 0),
(81033, 4, 0, 0, 0, 0),
(81036, 4, 0, 0, 0, 0),
(81039, 3, 4, 0, 0, 0),
(81040, 3, 0, 0, 0, 0),
(81041, 4, 0, 0, 0, 0),
(81043, 4, 0, 0, 0, 0),
(81044, 4, 0, 0, 0, 0),
(81045, 4, 0, 0, 0, 0),
(81047, 4, 0, 0, 0, 0),
(81049, 3, 0, 0, 0, 0),
(81050, 3, 4, 0, 0, 0),
(81052, 4, 0, 0, 0, 0),
(81054, 3, 4, 0, 0, 0),
(81055, 3, 0, 0, 0, 0),
(81057, 4, 0, 0, 0, 0),
(81058, 3, 4, 0, 0, 0),
(81059, 3, 0, 0, 0, 0),
(81062, 4, 0, 0, 0, 0),
(81063, 4, 0, 0, 0, 0),
(81064, 3, 4, 0, 0, 0),
(81066, 3, 0, 0, 0, 0),
(81067, 3, 4, 0, 0, 0),
(81069, 3, 0, 0, 0, 0),
(81071, 4, 0, 0, 0, 0),
(81073, 4, 0, 0, 0, 0),
(81076, 4, 0, 0, 0, 0),
(81077, 3, 0, 0, 0, 0),
(81081, 3, 0, 0, 0, 0),
(81082, 3, 0, 0, 0, 0),
(81084, 4, 0, 0, 0, 0),
(81087, 4, 0, 0, 0, 0),
(81089, 3, 0, 0, 0, 0),
(81090, 4, 0, 0, 0, 0),
(81091, 3, 0, 0, 0, 0),
(81092, 4, 0, 0, 0, 0),
(81101, 3, 0, 0, 0, 0),
(81120, 3, 0, 0, 0, 0),
(81121, 3, 0, 0, 0, 0),
(81122, 3, 0, 0, 0, 0),
(81123, 3, 0, 0, 0, 0),
(81124, 3, 0, 0, 0, 0),
(81125, 3, 0, 0, 0, 0),
(81126, 3, 0, 0, 0, 0),
(81127, 3, 0, 0, 0, 0),
(81128, 3, 0, 0, 0, 0),
(81130, 3, 0, 0, 0, 0),
(81131, 3, 0, 0, 0, 0),
(81132, 3, 0, 0, 0, 0),
(81133, 3, 0, 0, 0, 0),
(81136, 3, 0, 0, 0, 0),
(81137, 3, 0, 0, 0, 0),
(81140, 3, 0, 0, 0, 0),
(81141, 3, 0, 0, 0, 0),
(81143, 3, 0, 0, 0, 0),
(81144, 3, 0, 0, 0, 0),
(81146, 3, 0, 0, 0, 0),
(81147, 3, 0, 0, 0, 0),
(81148, 3, 0, 0, 0, 0),
(81149, 3, 0, 0, 0, 0),
(81151, 3, 0, 0, 0, 0),
(81152, 3, 0, 0, 0, 0),
(81153, 3, 0, 0, 0, 0),
(81154, 3, 0, 0, 0, 0),
(81155, 3, 0, 0, 0, 0),
(81201, 5, 0, 0, 0, 0),
(81210, 3, 0, 0, 0, 0),
(81211, 5, 0, 0, 0, 0),
(81212, 5, 0, 0, 0, 0),
(81220, 3, 0, 0, 0, 0),
(81221, 5, 0, 0, 0, 0),
(81222, 5, 0, 0, 0, 0),
(81223, 5, 0, 0, 0, 0),
(81224, 3, 0, 0, 0, 0),
(81225, 3, 0, 0, 0, 0),
(81226, 5, 0, 0, 0, 0),
(81230, 3, 0, 0, 0, 0),
(81233, 5, 0, 0, 0, 0),
(81235, 3, 0, 0, 0, 0),
(81236, 5, 0, 0, 0, 0),
(81239, 3, 0, 0, 0, 0),
(81240, 5, 0, 0, 0, 0),
(81241, 3, 0, 0, 0, 0),
(81243, 3, 0, 0, 0, 0),
(81244, 5, 0, 0, 0, 0),
(81248, 3, 0, 0, 0, 0),
(81251, 5, 0, 0, 0, 0),
(81252, 3, 0, 0, 0, 0),
(81253, 3, 5, 0, 0, 0),
(81301, 3, 0, 0, 0, 0),
(81320, 3, 0, 0, 0, 0),
(81321, 3, 0, 0, 0, 0),
(81323, 3, 0, 0, 0, 0),
(81324, 3, 0, 0, 0, 0),
(81325, 3, 0, 0, 0, 0),
(81326, 3, 0, 0, 0, 0),
(81327, 3, 0, 0, 0, 0),
(81328, 3, 0, 0, 0, 0),
(81330, 3, 0, 0, 0, 0),
(81331, 3, 0, 0, 0, 0),
(81332, 3, 0, 0, 0, 0),
(81334, 3, 0, 0, 0, 0),
(81335, 3, 0, 0, 0, 0),
(81401, 3, 0, 0, 0, 0),
(81410, 3, 0, 0, 0, 0),
(81411, 3, 0, 0, 0, 0),
(81413, 3, 0, 0, 0, 0),
(81415, 3, 0, 0, 0, 0),
(81416, 3, 0, 0, 0, 0),
(81418, 3, 0, 0, 0, 0),
(81419, 3, 0, 0, 0, 0),
(81422, 3, 0, 0, 0, 0),
(81423, 3, 0, 0, 0, 0),
(81424, 3, 0, 0, 0, 0),
(81425, 3, 0, 0, 0, 0),
(81426, 3, 0, 0, 0, 0),
(81427, 3, 0, 0, 0, 0),
(81428, 3, 0, 0, 0, 0),
(81430, 3, 0, 0, 0, 0),
(81431, 3, 0, 0, 0, 0),
(81432, 3, 0, 0, 0, 0),
(81433, 3, 0, 0, 0, 0),
(81434, 3, 0, 0, 0, 0),
(81435, 3, 0, 0, 0, 0),
(81501, 3, 0, 0, 0, 0),
(81503, 3, 0, 0, 0, 0),
(81504, 3, 0, 0, 0, 0),
(81505, 3, 0, 0, 0, 0),
(81506, 3, 0, 0, 0, 0),
(81520, 3, 0, 0, 0, 0),
(81521, 3, 0, 0, 0, 0),
(81522, 3, 0, 0, 0, 0),
(81523, 3, 0, 0, 0, 0),
(81524, 3, 0, 0, 0, 0),
(81525, 3, 0, 0, 0, 0),
(81526, 3, 0, 0, 0, 0),
(81527, 3, 0, 0, 0, 0),
(81601, 3, 0, 0, 0, 0),
(81610, 3, 0, 0, 0, 0),
(81611, 3, 0, 0, 0, 0),
(81615, 3, 0, 0, 0, 0),
(81620, 2, 0, 0, 0, 0),
(81621, 2, 3, 0, 0, 0),
(81623, 2, 3, 0, 0, 0),
(81624, 3, 0, 0, 0, 0),
(81625, 3, 0, 0, 0, 0),
(81630, 3, 0, 0, 0, 0),
(81631, 2, 0, 0, 0, 0),
(81632, 2, 0, 0, 0, 0),
(81635, 3, 0, 0, 0, 0),
(81637, 2, 3, 0, 0, 0),
(81638, 3, 0, 0, 0, 0),
(81639, 3, 0, 0, 0, 0),
(81640, 3, 0, 0, 0, 0),
(81641, 3, 0, 0, 0, 0),
(81642, 3, 0, 0, 0, 0),
(81643, 3, 0, 0, 0, 0),
(81645, 2, 0, 0, 0, 0),
(81646, 3, 0, 0, 0, 0),
(81647, 3, 0, 0, 0, 0),
(81648, 3, 0, 0, 0, 0),
(81649, 2, 0, 0, 0, 0),
(81650, 3, 0, 0, 0, 0),
(81652, 3, 0, 0, 0, 0),
(81653, 3, 0, 0, 0, 0),
(81654, 3, 0, 0, 0, 0),
(81655, 2, 0, 0, 0, 0),
(81656, 3, 0, 0, 0, 0),
(81657, 2, 0, 0, 0, 0),
(82063, 4, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `electionlist_main`
--

DROP TABLE IF EXISTS `electionlist_main`;
CREATE TABLE IF NOT EXISTS `electionlist_main` (
  `electionid` int(8) NOT NULL AUTO_INCREMENT,
  `electionname` varchar(50) NOT NULL,
  `electionfinaldate` date NOT NULL,
  `district` varchar(9) NOT NULL,
  `description` tinytext NOT NULL,
  `allvoters` tinyint(1) NOT NULL COMMENT 'Mark True if all voters can vote in this election',
  PRIMARY KEY (`electionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `electionlist_sub`
--

DROP TABLE IF EXISTS `electionlist_sub`;
CREATE TABLE IF NOT EXISTS `electionlist_sub` (
  `electionid` int(8) NOT NULL,
  `competitor` varchar(50) NOT NULL,
  `politicalparty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statictext`
--

DROP TABLE IF EXISTS `statictext`;
CREATE TABLE IF NOT EXISTS `statictext` (
  `tkey` int(11) NOT NULL AUTO_INCREMENT,
  `webpage` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `english` text NOT NULL,
  `spanish` text NOT NULL,
  PRIMARY KEY (`tkey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `statictext`
--

INSERT INTO `statictext` (`tkey`, `webpage`, `category`, `english`, `spanish`) VALUES
(1, 'about.php', 'title_main', 'About VoteOften.org', 'Sobre VoteOften.org'),
(2, 'about.php', 'title_1', 'I call this web site VoteOften.org. The idea behind it was based on personal experiences with the voting process and can best be explained by an example.', ''),
(3, 'about.php', 'body_1', 'Supposed I consider myself to be a Democrat. This is to say I am registered with the Democratic Party and I pretty much always vote for democrats. That being said, if I am honest with myself there are those days where the candidate from another party says or does something that makes me want to cast my vote in his/her favor. Or perhaps the candidate I intended to vote for does or says something that I am not in agreement with and that makes me want to vote for the other candidate. If you had recorded each of these events throughout the course of the election cycle and looked at how you cast your vote daily, would the candidate you originally intended to vote for have the majority of votes? There is only one way to find out, vote often. Consider VoteOften.org to be your personal voting diary. For any election that is available to you, you can vote in once per day. At any time you can look at a graph that shows the history of your votes and why you voted the way you did. In addition to your voting history, you can see how other demographics are voting in your elections. Another fun feature of VoteOften.org is the ability to create your own ballots. These ballots can be for only you to vote on or something that all other VoteOften.org members can vote on. The choice is yours.', 'Fingir Me considero demócrata.  Me inscribo con El Partido Demócrata, y generalmente voto demócrata.  Yo que honesto, hay días cuándo el candidato de otro partido político habla dice o hace algo me gusta.  Tanto, yo quiero votar esa persona.  ?Yo que anotar cada vez creo que de esta manera durante el elecciones y miro mi votar al día, se me todavía voto para mi candidato en el real eleccione?  Hay único forma a enterarse, voteoften.'),
(4, 'about.php', 'title_2', 'How it works', 'Cómo funciona'),
(5, 'about.php', 'body_2', 'To get started, sign up for an account. You will be prompted with some questions. Your answers are anonymous. Your experience will be better the more information you are willing to put in the profile. However, you are not required to answer any of the profile questions.', 'VoteOften.org es tú privado votación diario.  Tú puedes votar una vez diario en disponible elecciones.  Todo el tiempo pueden mirar tus votos, mirar un grafico por tu votación diario y reexaminar tú razón para votación.  Además, tu puedan mirar como otros demográficos son votan.  Otro divertido detalle de VoteOften.org es crear  lo tuyo invitar a votares.  Estos votación puedan ser privado o público y puedo personalizable.  Tu decidir.'),
(6, 'about.php', 'title_3', 'Questions or Comments', ''),
(7, 'about.php', 'body_3', 'If you have any questions or comments about VoteOften.org, feel free to contact us via the <a href="menutemplate.php?process=sendcomment.php" /> Send us a comment</a> link on the About menu.', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
CREATE TABLE IF NOT EXISTS `userlogin` (
  `userid` int(8) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `loginname` varchar(20) NOT NULL,
  `password` varchar(512) NOT NULL,
  `zipcode` varchar(9) NOT NULL,
  `district` varchar(9) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `loginname` (`loginname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile1`
--

DROP TABLE IF EXISTS `userprofile1`;
CREATE TABLE IF NOT EXISTS `userprofile1` (
  `userid` int(8) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `race` varchar(50) NOT NULL,
  `politicalparty` varchar(20) NOT NULL,
  `dateofbirth` date NOT NULL,
  `income` varchar(50) NOT NULL,
  `conservative` int(2) NOT NULL,
  `liberal` int(2) NOT NULL,
  `religious` int(2) NOT NULL,
  `rightwing` int(2) NOT NULL,
  `leftwing` int(2) NOT NULL,
  `inthemiddle` int(2) NOT NULL,
  `fiscallyconservative` int(2) NOT NULL,
  `antibiggovernment` int(2) NOT NULL,
  `wealthy` int(2) NOT NULL,
  `middleclass` int(2) NOT NULL,
  `poor` int(2) NOT NULL,
  `profreespeech` int(2) NOT NULL,
  `proowningfirearms` int(2) NOT NULL,
  `prochoice` int(2) NOT NULL,
  `antifreespeech` int(2) NOT NULL,
  `againstowningfirearms` int(2) NOT NULL,
  `prolife` int(2) NOT NULL,
  `citydweller` int(2) NOT NULL,
  `ruraldweller` int(2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votescast`
--

DROP TABLE IF EXISTS `votescast`;
CREATE TABLE IF NOT EXISTS `votescast` (
  `userid` int(8) NOT NULL,
  `electionid` int(8) NOT NULL,
  `competitor` varchar(50) NOT NULL,
  `datecast` bigint(255) NOT NULL,
  `reason` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zgender`
--

DROP TABLE IF EXISTS `zgender`;
CREATE TABLE IF NOT EXISTS `zgender` (
  `genderid` int(11) NOT NULL AUTO_INCREMENT,
  `gendername` varchar(50) NOT NULL,
  PRIMARY KEY (`genderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `zgender`
--

INSERT INTO `zgender` (`genderid`, `gendername`) VALUES
(1, 'I don''t want to answer'),
(2, 'Male'),
(3, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `zincome`
--

DROP TABLE IF EXISTS `zincome`;
CREATE TABLE IF NOT EXISTS `zincome` (
  `incomeid` int(11) NOT NULL AUTO_INCREMENT,
  `incomename` varchar(50) NOT NULL,
  PRIMARY KEY (`incomeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `zincome`
--

INSERT INTO `zincome` (`incomeid`, `incomename`) VALUES
(1, 'I don''t want to answer'),
(2, '$0 - 8,500'),
(3, '$8,500 - 34,500'),
(4, '$34,500 - 83,600'),
(5, '$83,600 - 174,400'),
(6, '$174,400 - 379,150'),
(7, 'over $379,150');

-- --------------------------------------------------------

--
-- Table structure for table `zlanguage`
--

DROP TABLE IF EXISTS `zlanguage`;
CREATE TABLE IF NOT EXISTS `zlanguage` (
  `languageid` int(11) NOT NULL AUTO_INCREMENT,
  `languagename` varchar(50) NOT NULL,
  PRIMARY KEY (`languageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `zlanguage`
--

INSERT INTO `zlanguage` (`languageid`, `languagename`) VALUES
(1, 'English'),
(2, 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `zpoliticalparty`
--

DROP TABLE IF EXISTS `zpoliticalparty`;
CREATE TABLE IF NOT EXISTS `zpoliticalparty` (
  `politicalpartyid` int(11) NOT NULL AUTO_INCREMENT,
  `politicalpartyname` varchar(50) NOT NULL,
  PRIMARY KEY (`politicalpartyid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `zpoliticalparty`
--

INSERT INTO `zpoliticalparty` (`politicalpartyid`, `politicalpartyname`) VALUES
(1, 'I don''t want to answer'),
(2, 'Democrat'),
(3, 'Republican'),
(4, 'Communist'),
(5, 'Constitution'),
(6, 'Green'),
(7, 'Independent'),
(8, 'Libertarian'),
(9, 'Not Affiliated'),
(10, 'Socialist'),
(11, 'Tea Party');

-- --------------------------------------------------------

--
-- Table structure for table `zrace`
--

DROP TABLE IF EXISTS `zrace`;
CREATE TABLE IF NOT EXISTS `zrace` (
  `raceid` int(11) NOT NULL AUTO_INCREMENT,
  `racename` varchar(50) NOT NULL,
  PRIMARY KEY (`raceid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `zrace`
--

INSERT INTO `zrace` (`raceid`, `racename`) VALUES
(1, 'I don''t want to answer'),
(2, 'American Indian or Alaska Native'),
(3, 'Asian'),
(4, 'Black, African or Negro'),
(5, 'Caucasian'),
(6, 'Chinese'),
(7, 'Hispanic'),
(8, 'Japanese'),
(9, 'Korean'),
(10, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `zreligion`
--

DROP TABLE IF EXISTS `zreligion`;
CREATE TABLE IF NOT EXISTS `zreligion` (
  `religionid` int(11) NOT NULL AUTO_INCREMENT,
  `religionname` varchar(50) NOT NULL,
  PRIMARY KEY (`religionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `zreligion`
--

INSERT INTO `zreligion` (`religionid`, `religionname`) VALUES
(1, 'I don''t want to answer'),
(2, 'Catholic'),
(3, 'Islam'),
(4, 'Buddhism'),
(5, 'Hinduism'),
(6, 'Anglicanism'),
(7, 'Jehovah''s Witness'),
(8, 'Judaism'),
(9, 'Lutheranism'),
(10, 'Mormonism (LDS)'),
(11, 'Native American'),
(12, 'No Preference'),
(13, 'Protestant'),
(14, 'Rastafari'),
(15, 'Scientology'),
(16, 'Unitarian Universalist'),
(17, 'Other');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
