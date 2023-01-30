-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 07:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kingstudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cateID` int(11) NOT NULL,
  `cateType` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cateID`, `cateType`) VALUES
(1, 'Printing'),
(2, 'Photo Shooting'),
(3, 'Video Shooting'),
(4, 'Photo + Video shooting');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `Cname` varchar(10) DEFAULT NULL,
  `Cemail` varchar(40) DEFAULT NULL,
  `Cphone` varchar(20) DEFAULT NULL,
  `Cpassword` varchar(20) DEFAULT NULL,
  `Caddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Cname`, `Cemail`, `Cphone`, `Cpassword`, `Caddress`) VALUES
(1, 'Micheal', 'm@gmail.com', '0123456', '123', 'YGN'),
(2, 'Mi Shwe Ay', 's@gmail.com', '12345', '123', 'Hantharyadi'),
(3, 'Phone Gyii', 'knaing159753@gmail.com', '09977593656', '123', 'Rakhine');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `packageID` int(11) NOT NULL,
  `package_name` varchar(20) DEFAULT NULL,
  `package_price` int(11) DEFAULT NULL,
  `package_image` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `cateID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`packageID`, `package_name`, `package_price`, `package_image`, `Description`, `cateID`) VALUES
(18, 'Wedding Shooting ', 100000, 'Pimages/_wedding.png', 'Professional photographers will shoot.', 4),
(19, 'Shin Pyu (2d-1night)', 1300000, 'Pimages/_Novitate.PNG', 'Professional photographers will shoot.', 4),
(20, 'A4 - 4×6 (10-pic)', 40000, 'Pimages/_A4(46).JPG', 'Full photo color quality will be achieved.', 1),
(21, 'A4 - full size (10-p', 50000, 'Pimages/_A4full.jpg', 'Full photo color quality will be achieved.', 1),
(22, 'Indoor Photo Shootin', 500000, 'Pimages/_lisa.png', 'Professional photographers will shoot.', 2),
(23, 'AD video', 1000000, 'Pimages/_Canon A1.png', 'Professional photographers will shoot.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Sname` varchar(20) DEFAULT NULL,
  `Sdob` varchar(30) DEFAULT NULL,
  `Sposition` varchar(20) DEFAULT NULL,
  `Sphone` varchar(20) DEFAULT NULL,
  `Semail` varchar(20) DEFAULT NULL,
  `Saddress` varchar(255) DEFAULT NULL,
  `Ssalary` int(11) DEFAULT NULL,
  `FDOE` date DEFAULT NULL,
  `Sattendance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Sname`, `Sdob`, `Sposition`, `Sphone`, `Semail`, `Saddress`, `Ssalary`, `FDOE`, `Sattendance`) VALUES
(1, 'Mg Hla', '1995-06-18', 'video Editor', '5451384', 'm@gmail.com', 'NY', 300001, '2022-11-04', 2),
(2, 'Ma Tin Shwe', '1999-01-22', 'Room Desinger', '2458668', 't@gmail.com', 'Myo', 400000, '2022-11-16', 2),
(3, 'Rosé', '2003-03-10', 'Graphic Desinger', '0956565565', 'r@gmail.com', 'YGN', 500000, '2022-11-02', 5);

-- --------------------------------------------------------

--
-- Table structure for table `undate`
--

CREATE TABLE `undate` (
  `DateID` int(11) NOT NULL,
  `UnDate` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `undate`
--

INSERT INTO `undate` (`DateID`, `UnDate`) VALUES
(2, '2022-12-30'),
(3, '2022-12-17'),
(4, '2022-12-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cateID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packageID`),
  ADD KEY `cateID` (`cateID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `undate`
--
ALTER TABLE `undate`
  ADD PRIMARY KEY (`DateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `packageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `undate`
--
ALTER TABLE `undate`
  MODIFY `DateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`cateID`) REFERENCES `category` (`cateID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
