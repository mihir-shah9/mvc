-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 02:59 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complete_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `country` varchar(20) NOT NULL,
  `addressType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `id`, `address`, `city`, `state`, `zipcode`, `country`, `addressType`) VALUES
(15, 0, 'a', 'a', 'a', 12345, 'a', 'billing'),
(16, 0, 'b', 'b', 'b', 34567, 'b', 'shipping'),
(17, 0, 'aa', 'aa', 'aa', 364001, 'aa', 'billing'),
(18, 0, 'bb', 'bb', 'bb', 364002, 'bb', 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`, `createdDate`) VALUES
(5, 'mihir', '7c3d596ed03ab9116c547b0eb678b247', '0', '2021-03-08 05:17:35'),
(6, 'mihir', '1f32aa4c9a1d2ea010adcf2348166a04', '1', '2021-03-08 08:06:44'),
(7, 'mihir', '1630937c3d00b4f4b153599d93469963', '1', '2021-03-14 07:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(64) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(10, 'category', 'color', 'color', 'select', 'int', 2, '2'),
(11, 'product', 'color1', 'color1', 'select', 'int', 2, '2'),
(12, 'product', 'brand', 'brand', 'select', 'int', 3, '3');

-- --------------------------------------------------------

--
-- Table structure for table `attributeoption`
--

CREATE TABLE `attributeoption` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributeoption`
--

INSERT INTO `attributeoption` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(2, 'color', 10, 1),
(3, 'brand', 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parentId` int(20) DEFAULT NULL,
  `pathId` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `description`, `parentId`, `pathId`) VALUES
(15, 'pilow', 0, 'good', 0, '15'),
(16, 'beds', 0, 'good', 0, '16');

-- --------------------------------------------------------

--
-- Table structure for table `cgroup`
--

CREATE TABLE `cgroup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(255) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cgroup`
--

INSERT INTO `cgroup` (`id`, `name`, `status`, `createdDate`) VALUES
(4, 'wholesale', 1, '2021-03-02 10:36:46'),
(5, 'retail', 0, '2021-03-08 05:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `cmspage`
--

CREATE TABLE `cmspage` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `identifier` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cmspage`
--

INSERT INTO `cmspage` (`id`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(6, 'c', 'c', 'c', 1, '2021-03-09 05:18:28'),
(7, 'abc', 'aa', 'abc', 0, '2021-03-09 07:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `firstname`, `lastname`, `email`, `password`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(21, 'mihir ', 'shah', 'm@gmail.com', '7e7576bde8baa58874dc2a8a752ee3dc', 1234554321, '1', '2021-03-09 07:09:28', '0000-00-00 00:00:00'),
(22, 'mihir', 'shah', 'm@gmail.com', '594f803b380a41396ed63dca39503542', 1234554321, '1', '2021-03-09 07:11:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `code`, `description`, `status`, `createdDate`) VALUES
(13, 'tv', 'a', 'aa', '0', '2021-03-07 15:39:45'),
(14, 'tv', 'aa', 'a', '0', '2021-03-07 15:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`) VALUES
(68, 'a', 'laptop', '111', '1', '1', 'good', '0', '2021-03-05 05:25:52', '2021-03-09 07:30:03'),
(74, 'ba234', 'laptop', '12345', '1', '2', 'good', '0', '2021-03-13 10:59:16', '2021-03-13 10:59:57'),
(79, 'aszx', 'laptop', '123456', '2', '2', 'good', '0', '2021-03-17 11:21:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `productgroupprice`
--

CREATE TABLE `productgroupprice` (
  `entityId` int(20) NOT NULL,
  `productId` int(20) NOT NULL,
  `customerGroupId` int(20) NOT NULL,
  `price` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productgroupprice`
--

INSERT INTO `productgroupprice` (`entityId`, `productId`, `customerGroupId`, `price`) VALUES
(19, 74, 4, '5555'),
(20, 74, 5, '5555'),
(39, 68, 4, '11111'),
(40, 68, 5, '11111'),
(41, 79, 4, '22222'),
(42, 79, 5, '22222');

-- --------------------------------------------------------

--
-- Table structure for table `productmedia`
--

CREATE TABLE `productmedia` (
  `mediaId` int(20) NOT NULL,
  `productId` int(20) NOT NULL,
  `label` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `small` tinyint(255) NOT NULL,
  `thumb` tinyint(255) NOT NULL,
  `base` tinyint(255) NOT NULL,
  `gallery` tinyint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productmedia`
--

INSERT INTO `productmedia` (`mediaId`, `productId`, `label`, `image`, `small`, `thumb`, `base`, `gallery`) VALUES
(6, 75, 'aaaa', 'background.png', 0, 1, 0, 1),
(27, 74, '', 'background.jpg', 0, 0, 0, 0),
(28, 74, '', 'back.png', 0, 0, 0, 0),
(32, 79, '', 'back.png', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(7, 'tv', 'aa', 12345, 'good', '1', '2021-03-07 16:40:47'),
(8, 'laptop', 'aa', 1234567, 'good', '1', '2021-03-09 07:46:19'),
(9, 'laptop', 'aa', 1111111111, 'aa', '0', '2021-03-09 07:47:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cgroup`
--
ALTER TABLE `cgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cmspage`
--
ALTER TABLE `cmspage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `productmedia`
--
ALTER TABLE `productmedia`
  ADD PRIMARY KEY (`mediaId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attributeoption`
--
ALTER TABLE `attributeoption`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cgroup`
--
ALTER TABLE `cgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cmspage`
--
ALTER TABLE `cmspage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  MODIFY `entityId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `productmedia`
--
ALTER TABLE `productmedia`
  MODIFY `mediaId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributeoption`
--
ALTER TABLE `attributeoption`
  ADD CONSTRAINT `attributeoption_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
