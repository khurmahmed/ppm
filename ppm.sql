

--
-- Database: `ppm`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(4) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `type`, `address`, `phone`, `firstname`, `lastname`, `email`, `created`) VALUES
(1, 1, NULL, '09876543212', 'khurm', 'ahmed', 'khurm@hotmail.com', '2014-03-30 02:58:25'),
(2, 1, NULL, '07965432312', 'Muskaan', 'Ahmed', 'muskaan@hotmail.com', '2014-03-30 04:47:28'),
(3, 2, NULL, '09786432132', 'Johnny', 'Cullin', 'john@hotmail.com', '2014-03-29 00:00:00'),
(4, 2, NULL, '07986543456', 'Henry', 'Mical', 'henry@hotmail.com', '2014-03-29 00:00:00'),
(5, 1, NULL, '09745687698', 'Natasha', 'Gilling', 'natasha@hotmail.com', '2014-03-29 00:00:00'),
(6, 2, NULL, '07845623451', 'Filey', 'Cherry', 'filey@hotmail.com', '2014-03-29 00:00:00'),
(7, 2, NULL, '07894563421', 'Rachel', 'Doggs', 'rachel@hotmail.com', '2014-03-29 00:00:00'),
(8, 1, NULL, '07645987612', 'Tyrar', 'Banks', 'tyra@hotmail.com', '2014-03-29 00:00:00'),
(9, 2, NULL, '072637625376', 'Indigo', 'Colour', 'indigo@hotmail.com', '2014-03-29 00:00:00'),
(10, 2, NULL, '08763543573', 'sarah', 'Rippen', 'holly@hotmail.com', '2014-03-29 00:00:00'),
(11, 2, NULL, '07652165367', 'simon', 'george', 'simon@hotmail.com', '2014-03-29 00:00:00'),
(12, 2, NULL, '07321765473', 'sarah', 'jarvish', 'sarah@hotmail.com', '2014-03-29 00:00:00'),
(13, 2, NULL, '08732647862', 'simuel', 'cloran', 'siuel@hotmail.com', '2014-03-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_address`
--

CREATE TABLE IF NOT EXISTS `client_address` (
  `id` int(11) unsigned NOT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `line_1` varchar(255) DEFAULT NULL,
  `line_2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postcode` (`postcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_address`
--

INSERT INTO `client_address` (`id`, `postcode`, `city`, `line_1`, `line_2`) VALUES
(1, 'hu5 2up', 'hull', '15 park grove', 'princess avenue'),
(2, 'BA9 4dq', 'birmingham', '34 sissily lane', 'ford'),
(3, 'm15 4nx', 'manchester', '4 huggard lane', 'millard'),
(4, 'S7 6bh', 'london', '34 ridding avenue', 'pillingtin lane'),
(5, 'Le2 9gy', 'Leeds', '34 octogan drive', 'lemar avenue'),
(6, 'n1 4ed', 'newcastle', '23 toon lane', 'toon street'),
(7, 'yo12 3rd', 'york', '34 castle road ', 'york street'),
(8, 'ox3 7yg', 'oxford', '34 oxford road', 'oxford street'),
(9, 'br8 3ed', 'brighton', '12 redding lane', 'glasgow road'),
(10, 'm8 6yg', 'manchester', '34 cook road', 'chicken road'),
(11, 'yo6 6th', 'york', '13 george street', 'george road'),
(12, 'mi3 7yh', 'middlesborough', '34 harrow lane', 'harrow'),
(13, 'ip1 4ed', 'ipswich', '34 firend road', 'firend');

-- --------------------------------------------------------

--
-- Table structure for table `client_budget`
--

CREATE TABLE IF NOT EXISTS `client_budget` (
  `id` int(11) unsigned NOT NULL,
  `from` int(7) unsigned NOT NULL,
  `to` int(7) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_budget`
--

INSERT INTO `client_budget` (`id`, `from`, `to`) VALUES
(1, 183481, 467990),
(2, 488808, 999999),
(3, 100210, 731682),
(4, 141846, 780256),
(5, 65514, 891284),
(6, 481869, 856588),
(7, 141846, 551261),
(8, 252874, 530443),
(9, 259813, 405537),
(10, 197360, 370841),
(11, 252874, 544322),
(12, 238995, 551261),
(13, 176542, 391658);

-- --------------------------------------------------------

--
-- Table structure for table `client_image_link`
--

CREATE TABLE IF NOT EXISTS `client_image_link` (
  `client_id` int(11) NOT NULL,
  `client_image_id` int(11) NOT NULL,
  KEY `client_id` (`client_id`,`client_image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

CREATE TABLE IF NOT EXISTS `client_types` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `client_types`
--

INSERT INTO `client_types` (`id`, `name`) VALUES
(1, 'buyer'),
(2, 'seller');

-- --------------------------------------------------------

--
-- Table structure for table `client_views_link`
--

CREATE TABLE IF NOT EXISTS `client_views_link` (
  `client_id` int(11) NOT NULL,
  `client_views_id` int(11) NOT NULL,
  KEY `client_id` (`client_id`,`client_views_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_views_link`
--

INSERT INTO `client_views_link` (`client_id`, `client_views_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(4, 0),
(4, 4),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client` int(11) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(2) DEFAULT 'UK' COMMENT 'country_code(2)',
  `town` varchar(100) DEFAULT NULL,
  `address_line` varchar(255) NOT NULL DEFAULT '' COMMENT 'House number / name and road name',
  `asking_price` decimal(8,0) unsigned NOT NULL,
  `geo_lat` float(10,6) NOT NULL,
  `geo_long` float(10,6) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `asking_price` (`asking_price`),
  KEY `geo_lat` (`geo_lat`,`geo_long`),
  KEY `postcode` (`postcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `client`, `postcode`, `city`, `country`, `town`, `address_line`, `asking_price`, `geo_lat`, `geo_long`, `created`) VALUES
(2, 3, 'm15 4nx', 'manchester', 'uk', 'manchester', '23 oxlay drive', 543964, 51.643002, 0.000000, '2014-03-29 00:00:00'),
(3, 6, 'sw2 3ed', 'london', 'uk', 'london', '34 teierny road', 100210, 51.449001, 0.000000, '2014-03-29 00:00:00'),
(4, 7, 'ne14 3ed', 'newcastle', 'uk', 'newcastle', '34 rilling lane', 245934, 54.973000, 0.000000, '2014-03-29 00:00:00'),
(5, 9, 'bn2 1yg', 'brighton', 'uk', 'brighton', '34 hazel drive', 114089, 50.824001, 0.000000, '2014-03-29 00:00:00'),
(6, 10, 'ex4 4rd', 'exeter', 'uk', 'exeter', '34 yomen road', 266752, 50.730000, 0.000000, '2014-03-29 00:00:00'),
(7, 11, 'ch4 7rg', 'cheshire', 'uk', 'cheshire', '34 cheshire lane', 467990, 53.167999, 0.000000, '2014-03-29 00:00:00'),
(8, 12, 'ts1 3ed', 'middlesborough', 'uk', 'middlesborough', '34 riy road', 162663, 54.571999, 0.000000, '2014-03-29 00:00:00'),
(9, 13, 'ip1 3ed', 'ipswich', 'uk', 'ipswich', '34 right road', 433294, 52.067001, 0.000000, '2014-03-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

CREATE TABLE IF NOT EXISTS `property_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL DEFAULT '0',
  `property` int(11) NOT NULL,
  `filename` varchar(36) NOT NULL DEFAULT '' COMMENT 'md5(name).jpg',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `property_image`
--

INSERT INTO `property_image` (`id`, `order`, `property`, `filename`, `created`) VALUES
(6, 0, 5, 'temp.jpg', '2014-03-28 00:00:00'),
(12, 0, 2, '1396038591.jpg', '2014-03-29 00:00:00'),
(13, 0, 2, '1396038596.jpg', '2014-03-29 00:00:00'),
(14, 0, 2, '1396038597.jpg', '2014-03-29 00:00:00'),
(15, 0, 2, '1396038602.jpg', '2014-03-29 00:00:00'),
(16, 0, 2, '1396038606.jpg', '2014-03-29 00:00:00'),
(17, 0, 3, '1396038669.jpg', '2014-03-29 00:00:00'),
(18, 0, 3, '1396038673.jpg', '2014-03-29 00:00:00'),
(19, 0, 3, '1396038676.jpg', '2014-03-29 00:00:00'),
(20, 0, 3, '1396038680.jpg', '2014-03-29 00:00:00'),
(21, 0, 3, '1396038685.jpg', '2014-03-29 00:00:00'),
(22, 0, 4, '1396038803.jpg', '2014-03-29 00:00:00'),
(23, 0, 4, '1396038806.jpg', '2014-03-29 00:00:00'),
(24, 0, 4, '1396038810.jpg', '2014-03-29 00:00:00'),
(25, 0, 4, '1396038816.jpg', '2014-03-29 00:00:00'),
(26, 0, 4, '1396038820.jpg', '2014-03-29 00:00:00'),
(27, 0, 5, '1396038887.jpg', '2014-03-29 00:00:00'),
(28, 0, 5, '1396038891.jpg', '2014-03-29 00:00:00'),
(29, 0, 5, '1396038895.jpg', '2014-03-29 00:00:00'),
(30, 0, 5, '1396038901.jpg', '2014-03-29 00:00:00'),
(31, 0, 5, '1396038906.jpg', '2014-03-29 00:00:00'),
(32, 0, 6, '1396039371.jpg', '2014-03-29 00:00:00'),
(33, 0, 6, '1396039387.jpg', '2014-03-29 00:00:00'),
(34, 0, 6, '1396039392.jpg', '2014-03-29 00:00:00'),
(35, 0, 6, '1396039397.jpg', '2014-03-29 00:00:00'),
(36, 0, 6, '1396039405.jpg', '2014-03-29 00:00:00'),
(37, 0, 7, '1396039561.jpg', '2014-03-29 00:00:00'),
(38, 0, 7, '1396039565.jpg', '2014-03-29 00:00:00'),
(39, 0, 7, '1396039570.jpg', '2014-03-29 00:00:00'),
(40, 0, 7, '1396039575.jpg', '2014-03-29 00:00:00'),
(41, 0, 7, '1396039581.jpg', '2014-03-29 00:00:00'),
(42, 0, 8, '1396039666.jpg', '2014-03-29 00:00:00'),
(43, 0, 8, '1396039673.jpg', '2014-03-29 00:00:00'),
(44, 0, 9, 'temp.jpg', '2014-03-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_image_link`
--

CREATE TABLE IF NOT EXISTS `property_image_link` (
  `property_id` int(11) NOT NULL,
  `property_image_id` int(11) NOT NULL,
  KEY `property_id` (`property_id`,`property_image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_image_link`
--

INSERT INTO `property_image_link` (`property_id`, `property_image_id`) VALUES
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 31),
(6, 32),
(6, 33),
(6, 34),
(6, 35),
(6, 36),
(7, 37),
(7, 38),
(7, 39),
(7, 40),
(7, 41),
(8, 42),
(8, 43),
(9, 44);

-- --------------------------------------------------------

--
-- Table structure for table `property_views`
--

CREATE TABLE IF NOT EXISTS `property_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `property` int(11) NOT NULL,
  `result` enum('like','offer','reject','unknown') NOT NULL DEFAULT 'unknown',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client` (`client`,`property`,`created`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `property_views`
--

INSERT INTO `property_views` (`id`, `client`, `property`, `result`, `created`) VALUES
(1, 1, 2, 'like', '2014-03-29 00:00:00'),
(2, 1, 3, 'offer', '2014-03-29 00:00:00'),
(3, 5, 4, 'unknown', '2014-03-30 00:00:00'),
(4, 4, 4, 'reject', '2014-03-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_views_link`
--

CREATE TABLE IF NOT EXISTS `property_views_link` (
  `property_id` int(11) NOT NULL,
  `property_views_id` int(11) NOT NULL,
  KEY `property_id` (`property_id`,`property_views_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_views_link`
--

INSERT INTO `property_views_link` (`property_id`, `property_views_id`) VALUES
(2, 1),
(3, 2),
(4, 3),
(4, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
