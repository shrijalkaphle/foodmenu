-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2019 at 09:40 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodmenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `tableno` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Beverages'),
(5, 'soft Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `created_at`, `seen_status`) VALUES
(2, 'Table 5 has placed an order', '2019-03-14 04:56:31', 1),
(3, 'Table 6 has placed an order', '2019-03-12 10:23:57', 1),
(4, 'Table 6 has placed an order', '2019-03-12 10:14:48', 1),
(5, 'Table 6 has placed an order', '2019-03-12 10:14:48', 1),
(6, 'Table 9 has placed an order', '2019-03-12 10:14:48', 1),
(7, 'Table 9 has placed an order', '2019-03-12 10:14:48', 1),
(8, 'Table 9 has placed an order', '2019-03-12 10:14:48', 1),
(9, 'Table 3 has placed an order', '2019-03-12 10:14:48', 1),
(10, 'Table 3 has placed an order', '2019-03-12 10:14:48', 1),
(11, 'Table 3 has placed an order', '2019-03-12 10:14:48', 1),
(12, 'Table 3 has placed an order', '2019-03-12 10:14:48', 1),
(13, 'Table 3 has placed an order', '2019-03-12 10:14:48', 1),
(14, 'Table 3 has placed an order', '2019-03-12 10:26:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered`
--

CREATE TABLE `ordered` (
  `id` int(11) NOT NULL,
  `tableno` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered`
--

INSERT INTO `ordered` (`id`, `tableno`, `productid`, `qty`) VALUES
(90, 3, 3, 1),
(91, 3, 4, 1),
(92, 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `tableno` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `tableno`, `price`) VALUES
(25, 1, 490),
(39, 3, 320),
(40, 3, 170),
(41, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `catid` int(1) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `catid`, `name`, `price`, `image`) VALUES
(3, 4, 'CocaCola', 150, 'coke.png'),
(4, 2, 'Chicken Momo', 170, 'momo.jpeg'),
(5, 2, 'Sausage', 100, 'sussage.jpg'),
(6, 2, 'Pizza', 390, 'pizza.jpg'),
(7, 2, 'Burger', 250, 'burger.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `productid`, `qty`, `datetime`) VALUES
(1, 5, 46, '2019-03-10 08:41:38'),
(2, 3, 33, '2019-03-10 08:41:38'),
(3, 4, 1, '2019-03-10 08:41:38'),
(4, 4, 1, '2019-03-10 09:05:14'),
(5, 3, 1, '2019-03-12 10:51:11'),
(6, 6, 1, '2019-03-12 10:51:11'),
(7, 4, 1, '2019-03-12 10:51:11'),
(8, 7, 1, '2019-03-12 10:51:11'),
(9, 3, 1, '2019-03-12 10:51:11'),
(10, 4, 1, '2019-03-12 10:51:11'),
(11, 4, 1, '2019-03-12 10:56:56'),
(12, 5, 1, '2019-03-12 10:56:56'),
(13, 4, 1, '2019-03-12 10:56:56'),
(14, 4, 1, '2019-03-12 11:05:02'),
(15, 4, 4, '2019-03-12 11:06:08'),
(16, 5, 4, '2019-03-12 11:06:08'),
(17, 7, 10, '2019-03-12 11:06:08'),
(18, 3, 1, '2019-03-12 11:06:30'),
(19, 5, 1, '2019-03-12 11:06:30'),
(20, 4, 1, '2019-03-12 11:06:30'),
(21, 3, 1, '2019-03-12 11:07:22'),
(22, 4, 1, '2019-03-12 11:07:22'),
(23, 5, 1, '2019-03-12 11:07:22'),
(24, 6, 1, '2019-03-12 11:07:22'),
(25, 7, 2, '2019-03-12 11:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `username`, `password`, `phone`, `dob`, `role`) VALUES
(1, 'Shrijal', 'Kaphle', 'admin', 'admin', '9843564504', '2017-07-11', 'admin'),
(6, 'Shrijal', 'Kaphle', 'shrijal', 'shrijal', '9843564504', '', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ordered`
--
ALTER TABLE `ordered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
