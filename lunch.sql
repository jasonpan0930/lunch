-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 12:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lunch`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `num` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`num`, `price`) VALUES
(0, 0),
(1, 60),
(2, 70),
(3, 80),
(4, 90),
(5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `int_parameters`
--

CREATE TABLE `int_parameters` (
  `name` varchar(100) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `int_parameters`
--

INSERT INTO `int_parameters` (`name`, `value`) VALUES
('ordering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `student_name` varchar(100) DEFAULT NULL,
  `dish` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`student_name`, `dish`) VALUES
('jasonpan', '八塊雞塊'),
('jasonpan', '八塊雞塊'),
('jasonpan', '卡拉雞腿堡'),
('jason', '八塊雞塊'),
('jason', '八塊雞塊'),
('jason', 'XL卡拉雞腿堡'),
('frompc', 'XL卡拉雞腿堡'),
('jjj', 'XL卡拉雞腿堡'),
('jjj', 'XL卡拉雞腿堡'),
('jjj', 'XL卡拉雞腿堡');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `restaurant` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`restaurant`, `telephone`) VALUES
('肯德基', ''),
('姊妹飯桶', ''),
('日光', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `seat` int(11) NOT NULL,
  `account` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `eat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`seat`, `account`, `password`, `money`, `eat`) VALUES
(29, '29', '910609', 0, 0),
(26, 'frompc', 'jason', 800, 0),
(26, 'jason', 'jason', 5600, 3),
(26, 'jasonpan', 'jason', 7173, 3),
(26, 'Jjj', 'jason', -600, 0),
(0, 'root', 'root', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `varchar_parameters`
--

CREATE TABLE `varchar_parameters` (
  `name` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `varchar_parameters`
--

INSERT INTO `varchar_parameters` (`name`, `value`) VALUES
('today_restaurant', '肯德基');

-- --------------------------------------------------------

--
-- Table structure for table `姊妹飯桶`
--

CREATE TABLE `姊妹飯桶` (
  `dish` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `姊妹飯桶`
--

INSERT INTO `姊妹飯桶` (`dish`, `price`) VALUES
('測試', 0);

-- --------------------------------------------------------

--
-- Table structure for table `日光`
--

CREATE TABLE `日光` (
  `dish` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `肯德基`
--

CREATE TABLE `肯德基` (
  `dish` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `肯德基`
--

INSERT INTO `肯德基` (`dish`, `price`) VALUES
('八塊雞塊', 110),
('XL卡拉雞腿堡', 200),
('卡拉雞腿堡', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`account`);

--
-- Indexes for table `varchar_parameters`
--
ALTER TABLE `varchar_parameters`
  ADD PRIMARY KEY (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
