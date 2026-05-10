-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 09:45 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `ID` int(111) NOT NULL,
  `expense_title` varchar(1000) NOT NULL,
  `group_id` varchar(100) NOT NULL,
  `expense_member1` varchar(100) NOT NULL,
  `expense_member2` varchar(100) NOT NULL,
  `expense_member3` varchar(100) NOT NULL,
  `expense_member4` varchar(100) NOT NULL,
  `expense_member5` varchar(100) NOT NULL,
  `expense_member6` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`ID`, `expense_title`, `group_id`, `expense_member1`, `expense_member2`, `expense_member3`, `expense_member4`, `expense_member5`, `expense_member6`) VALUES
(30, 'milk', '20', '0', '0', '50', '0', '', ''),
(31, 'food', '20', '200', '0', '0', '0', '', ''),
(32, 'Dinner', '20', '0', '600', '0', '0', '', ''),
(33, 'mess', '21', '0', '0', '0', '2000', '', ''),
(34, 'Dinner', '21', '0', '0', '0', '400', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expense_contributionss`
--

CREATE TABLE `expense_contributionss` (
  `id` int(100) NOT NULL,
  `group_id` varchar(999) NOT NULL,
  `payer_id` varchar(999) NOT NULL,
  `payee_id` varchar(999) NOT NULL,
  `balance` varchar(999) NOT NULL,
  `screen_shot` varchar(999) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_contributionss`
--

INSERT INTO `expense_contributionss` (`id`, `group_id`, `payer_id`, `payee_id`, `balance`, `screen_shot`, `dt`) VALUES
(163, '20', '3', '1', '37', 'uploads/payment.jpg', '2025-03-24 08:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `memer_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`, `memer_no`) VALUES
(96, 20, 1, 'M1'),
(97, 20, 2, 'M2'),
(98, 20, 3, 'M3'),
(99, 20, 4, 'M4'),
(100, 21, 1, 'M1'),
(101, 21, 2, 'M2'),
(102, 21, 3, 'M3'),
(103, 21, 15, 'M4'),
(104, 22, 2, 'M1'),
(105, 22, 3, 'M2'),
(106, 22, 15, 'M3');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblexpense`
--

CREATE TABLE `tblexpense` (
  `ID` int(10) NOT NULL,
  `UserId` int(10) NOT NULL,
  `ExpenseDate` date DEFAULT NULL,
  `ExpenseItem` varchar(200) DEFAULT NULL,
  `ExpenseCost` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblexpense`
--

INSERT INTO `tblexpense` (`ID`, `UserId`, `ExpenseDate`, `ExpenseItem`, `ExpenseCost`, `NoteDate`) VALUES
(1, 2, '2019-05-15', 'Milk', '63', NULL),
(2, 2, '2019-05-15', 'Vegitables', '520', '2019-05-15 10:06:19'),
(3, 2, '2019-05-15', 'Household Items', '5200', '2019-05-15 10:07:08'),
(4, 2, '2019-05-14', 'Milk', '83', '2019-05-15 10:07:27'),
(5, 2, '2019-05-14', 'Bed Sheets', '1120', '2019-05-15 10:07:49'),
(6, 2, '2019-05-12', 'Fruits', '890', '2019-05-15 10:08:09'),
(7, 2, '2019-05-10', 'Household Items', '5600', '2019-05-15 10:08:26'),
(8, 2, '2019-04-24', 'Milk', '102', '2019-05-15 10:08:44'),
(9, 2, '2019-05-08', 'Bed Sheets', '890', '2019-05-15 10:08:57'),
(10, 2, '2018-12-19', 'Household Items', '1120', '2019-05-15 10:09:34'),
(11, 2, '2018-12-19', 'Fruits', '560', '2019-05-15 10:09:52'),
(13, 2, '2018-12-20', 'Tour of Manali', '30000', '2019-05-15 10:15:47'),
(14, 2, '2019-05-14', 'Milk', '360', '2019-05-15 10:21:31'),
(15, 3, '2019-05-15', 'Milk', '123', '2019-05-15 10:29:56'),
(16, 3, '2019-05-15', 'Household Items', '360', '2019-05-15 10:30:06'),
(17, 3, '2019-05-15', 'Bed Sheets', '3000', '2019-05-15 10:30:18'),
(18, 3, '2019-05-07', 'Milk', '123', '2019-05-15 10:30:28'),
(19, 3, '2019-05-14', 'Household Items', '3600', '2019-05-15 10:30:38'),
(20, 2, '2019-05-14', 'Electric Board Extension', '300', '2019-05-15 15:11:33'),
(21, 2, '2019-04-11', 'Milk', '123', '2019-05-15 17:50:24'),
(22, 2, '2019-04-10', 'Household Items', '520', '2019-05-15 17:50:37'),
(23, 2, '2019-05-16', 'Household Items', '360', '2019-05-16 07:29:54'),
(25, 8, '2019-05-17', 'Milk', '3600', '2019-05-17 05:35:13'),
(26, 8, '2019-05-16', 'Bed Sheets', '1025', '2019-05-17 05:35:42'),
(27, 1, '2019-05-17', 'Computer Mouse', '500', '2019-05-18 05:19:05'),
(30, 1, '2019-05-18', 'Milk + Bread', '80', '2019-05-18 05:22:01'),
(31, 10, '2019-05-16', 'Computer Mouse', '500', '2019-05-18 05:35:45'),
(32, 10, '2019-05-17', 'Milk+Bread', '80', '2019-05-18 05:36:06'),
(33, 10, '2019-05-18', 'Room Rent', '10000', '2019-05-18 05:36:26'),
(35, 10, '2024-04-12', 'tv', '25000', '2024-04-12 16:36:07'),
(36, 10, '2024-04-14', 'shopping', '1500', '2024-04-14 05:02:55'),
(37, 11, '2024-12-20', 'shopping', '25000', '2024-12-04 08:24:58'),
(38, 13, '2025-03-03', 'shopping', '25000', '2025-03-07 08:17:53'),
(39, 1, '2025-03-18', 'shopping', '25000', '2025-03-18 11:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(150) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `qr_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `Email`, `MobileNumber`, `Password`, `RegDate`, `qr_code`) VALUES
(1, 'Rajeshwari', 'raj@gmail.com', 5655555655, '202cb962ac59075b964b07152d234b70', '2019-05-15 08:52:27', ''),
(2, 'Meenakhi', 'meena@gmail.com', 8989898897, '81dc9bdb52d04dc20036dbd8313ed055', '2019-05-15 08:52:27', ''),
(3, 'Khusbu', 'khusi@gmail.com', 5645798897, '202cb962ac59075b964b07152d234b70', '2019-05-15 08:52:27', ''),
(4, 'Shantanu Bhardwaj', 'shan@gmail.com', 7895641236, '202cb962ac59075b964b07152d234b70', '2019-05-17 05:13:23', ''),
(8, 'Test', 'test@gmail.com', 5656556565, '202cb962ac59075b964b07152d234b70', '2019-05-17 05:34:16', ''),
(9, 'Anuj kumar', 'phpgurukulofficial@gmail.com', 1234567890, 'f925916e2754e5e03f75dd58a5733251', '2019-05-18 05:31:47', ''),
(10, 'Test User demo', 'testuser@gmail.com', 987654321, 'f925916e2754e5e03f75dd58a5733251', '2019-05-18 05:34:53', ''),
(11, 'Kushal Dhole', 'kushaldhole@hotmail.com', 9890546711, '827ccb0eea8a706c4c34a16891f84e7b', '2024-04-12 16:37:12', ''),
(12, 'Kushal Dhole', 'kushalasdasdasdaddhole@hotmail.com', 9890546711, 'a360b6120e4c7bb18a96aacbed8b3b71', '2025-03-07 03:12:17', ''),
(13, 'Kushal Dhole', 'shraddhasd@gmail.com', 9890546711, '6347e156a4da2275c25453a49bb1a8fe', '2025-03-07 08:11:42', ''),
(14, 'Kushal Dhole', 'khusiaaaaa@gmail.com', 9890546711, 'llllll', '2025-03-20 09:05:10', 'images/qr/001.jpg'),
(15, 'Sakshi G Raut ', 'sakshi@gmail.com', 9767407318, 'sakshi', '2025-03-24 08:20:59', 'images/qr/Qrsak.png'),
(16, '123', 'sakshi1@gmail.com', 6798542378, '123', '2025-03-24 08:40:07', 'images/qr/Qrsak.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`group_id`, `group_name`, `group_description`, `created_by`) VALUES
(20, 'Groceries', 'Daily needs', '3'),
(21, 'Expenses', 'Monthly Groceries', '15'),
(22, 'Goa', '8000fd', '15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `expense_contributionss`
--
ALTER TABLE `expense_contributionss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblexpense`
--
ALTER TABLE `tblexpense`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `ID` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `expense_contributionss`
--
ALTER TABLE `expense_contributionss`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblexpense`
--
ALTER TABLE `tblexpense`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `user_group` (`group_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
