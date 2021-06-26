-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 02:55 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipaylogger`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagesnipetts`
--

CREATE TABLE `imagesnipetts` (
  `id` int(11) NOT NULL,
  `imagename` varchar(255) NOT NULL,
  `solutionid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ref` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imagesnipetts`
--

INSERT INTO `imagesnipetts` (`id`, `imagename`, `solutionid`, `status`, `ref`) VALUES
(1, '60d584e2618c49.01876431.jpg', 27, 1, 'kexzvs7abi6t93gp28yqr5fnolj1h0m4wdc'),
(2, '60d5872797a999.26108773.png', 28, 1, 'kefsvn3mtz7pa9cxy15w46i02rjlgd8obqh'),
(3, 'P057-L_2.jpg', 29, 1, '7wcxrd2p8jongvt1a36hly9q4sfbizme5k0'),
(4, 'vase.jpg', 29, 1, '7wcxrd2p8jongvt1a36hly9q4sfbizme5k0'),
(5, 'mpesa.png', 37, 1, '8n9z7r3fjod1ca46v5gx2hbtqemwsypki0l'),
(6, 'vase.jpg', 37, 1, '8n9z7r3fjod1ca46v5gx2hbtqemwsypki0l'),
(7, 'mpesa.png', 41, 1, 'ap7gj526xnlryft841cbwdk0oes3i9mzqvh'),
(8, 'vase.jpg', 41, 1, 'ap7gj526xnlryft841cbwdk0oes3i9mzqvh'),
(9, '60d59c56e26169.38140295.png', 42, 1, 'oadh3ms6ri849bxep1wj05ltkynzgc2qvf7'),
(10, '60d59c56e2c624.45312701.png', 42, 1, 'oadh3ms6ri849bxep1wj05ltkynzgc2qvf7'),
(11, '60d5a40425f9e3.19861396.png', 43, 1, 's95xmrhtwoc06vl372ne1fiyz8dpqgakj4b'),
(12, '60d5a404263c60.00863737.png', 43, 1, 's95xmrhtwoc06vl372ne1fiyz8dpqgakj4b');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `description`) VALUES
(1, 'API', 'API integration'),
(2, 'Plugin ', 'Plugin integration'),
(6, 'Billing', 'Billing through API endpoints'),
(7, 'Solutions', 'Ready made systems for clients to use');

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subserviceid` int(11) NOT NULL,
  `problemDescription` text NOT NULL,
  `providesolution` text NOT NULL,
  `ref` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `solution`
--

INSERT INTO `solution` (`id`, `title`, `subserviceid`, `problemDescription`, `providesolution`, `ref`, `createdAt`, `updatedAt`) VALUES
(33, 'kjhbvc', 19, 'kjhgfd', 'oiujyhgf', 'g0vhwoi9dyf82r47mkjqps5bltaez36cxn1', '2021-06-25 10:31:04', '2021-06-25 10:31:04'),
(34, 'File not found', 5, 'lkjhgf', 'lkjhgf', 'kwm9n6lda5f0xc8eyzi32rbogqv7tshpj41', '2021-06-25 10:32:27', '2021-06-25 10:32:27'),
(35, 'lkjhg', 4, ';lkjhgf', 'sdfghj', '1gwpbhdy4m9sxj5n8qt3ezvo06licak2rf7', '2021-06-25 10:33:36', '2021-06-25 10:33:36'),
(36, 'lkjhgvcx', 3, 'lkjhgv', ';lkjh', 't8xopnf5keizjgqy62dbs0wacm1hv793l4r', '2021-06-25 10:34:52', '2021-06-25 10:34:52'),
(37, 'File not found', 4, 'kjh', 'lkjhgf', '8n9z7r3fjod1ca46v5gx2hbtqemwsypki0l', '2021-06-25 10:36:28', '2021-06-25 10:36:28'),
(38, 'lkjhg', 4, 'lkjhgf', 'poiuyhgf', 'wnmydthce1ki9fzq6b0oslar3x42g578pjv', '2021-06-25 10:45:37', '2021-06-25 10:45:37'),
(39, 'saghts', 4, 'kjhg', 'kjhghh', 'jyd71v8snh3ilrbko4ex6f0paq59tg2mwzc', '2021-06-25 10:48:53', '2021-06-25 10:48:53'),
(40, 'kjhgfv', 4, ';lkjhgfv', 'iujgfd', 'roqf8zd0i7el2bkcvw9jtyps6g1nh4ax35m', '2021-06-25 10:58:58', '2021-06-25 10:58:58'),
(41, 'kjhbvc', 3, 'lkjhgfd', 'jmnbvc', 'ap7gj526xnlryft841cbwdk0oes3i9mzqvh', '2021-06-25 11:03:59', '2021-06-25 11:03:59'),
(42, 'kjhgvc', 20, 'kjhgf', 'jhgv', 'oadh3ms6ri849bxep1wj05ltkynzgc2qvf7', '2021-06-25 11:05:26', '2021-06-25 11:05:26'),
(43, 'ghjk', 4, 'fcgh', 'jnm,hj', 's95xmrhtwoc06vl372ne1fiyz8dpqgakj4b', '2021-06-25 11:38:12', '2021-06-25 11:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `subservice`
--

CREATE TABLE `subservice` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subservice`
--

INSERT INTO `subservice` (`id`, `name`, `serviceId`, `description`) VALUES
(1, 'C2B', 1, 'fFGERGE'),
(2, 'B2B', 1, 'Business to Business integration'),
(3, 'B2C', 6, 'Business to Client integration'),
(4, 'Woocommerce', 2, 'iPay payment solution for Woocommerce Wordpress plugin '),
(5, 'Tickets 4 U', 7, 'This is a system that enable event organizers to advertise their events and enable attendees to buy tickets'),
(6, 'iPay Billing', 7, 'Billing application for Airtime, TV subscription and other Utilities like water, electricity etc'),
(7, 'Android ', 1, 'Android integration library'),
(8, 'rweee', 1, 'gegrthy'),
(9, 'lkjhg', 1, ';lkjh'),
(10, 'kjhg', 1, 'lkjhgf'),
(11, 'dfui', 1, 'rtrfghjkl'),
(12, 'jmnb', 1, 'ikuyhgfd'),
(13, 'ghjkl', 1, 'fghjkk'),
(14, 'fghjk', 1, 'ghjkl;'),
(15, 'ghjkl', 1, 'ghjkl;'),
(16, ';lkjnbv', 1, ';lmn '),
(17, ';lkjhg', 1, 'dfg'),
(18, 'dfghjk', 1, 'efghjnm'),
(19, 'kjhgf', 1, 'ijhgf'),
(20, 'jkhgf', 1, 'xcvb'),
(21, 'dfgh', 1, 'jhgfd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagesnipetts`
--
ALTER TABLE `imagesnipetts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solutionid` (`solutionid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subserviceid` (`subserviceid`);

--
-- Indexes for table `subservice`
--
ALTER TABLE `subservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serviceId` (`serviceId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagesnipetts`
--
ALTER TABLE `imagesnipetts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `solution`
--
ALTER TABLE `solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `subservice`
--
ALTER TABLE `subservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
