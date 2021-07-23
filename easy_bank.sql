-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2021 at 12:22 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_logs`
--

INSERT INTO `access_logs` (`id`, `ip`, `Account_ID`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 3, '2021-06-22 15:01:38', '2021-06-22 15:01:38'),
(2, '127.0.0.1', 3, '2021-06-22 15:21:45', '2021-06-22 15:21:45'),
(3, '127.0.0.1', 3, '2021-06-22 15:21:52', '2021-06-22 15:21:52'),
(7, '::1', 3, '2021-06-23 07:32:31', '2021-06-23 07:32:31'),
(8, '::1', 3, '2021-06-23 07:34:02', '2021-06-23 07:34:02'),
(9, '::1', 3, '2021-06-23 13:14:12', '2021-06-23 13:14:12'),
(11, '::1', 3, '2021-06-23 14:23:57', '2021-06-23 14:23:57'),
(12, '::1', 3, '2021-06-23 14:59:17', '2021-06-23 14:59:17'),
(13, '::1', 3, '2021-06-23 15:01:14', '2021-06-23 15:01:14'),
(14, '::1', 3, '2021-06-24 05:12:54', '2021-06-24 05:12:54'),
(15, '::1', 3, '2021-06-24 05:49:42', '2021-06-24 05:49:42'),
(16, '::1', 3, '2021-07-19 13:34:26', '2021-07-19 13:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Account_ID` int(11) NOT NULL,
  `Fee` float NOT NULL,
  `Balance` int(11) NOT NULL DEFAULT 0,
  `Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Account_ID`, `Fee`, `Balance`, `Type`) VALUES
(3, 7.5, 12177, 'Pro'),
(11, 7.5, 0, 'Pro');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Branch_ID` int(11) NOT NULL,
  `City` varchar(40) NOT NULL,
  `Address` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Branch_ID`, `City`, `Address`) VALUES
(1, 'Roma', 'Via dei cerchi 92'),
(2, 'Roma', 'Via del casaletto 200'),
(3, 'Roma', 'Via Arno 36'),
(4, 'Firenze', 'Via Toselli 99'),
(5, 'Firenze', 'Via Traversari 81'),
(6, 'Napoli', 'Via Loffredi 2'),
(7, 'Napoli', 'Via Duomo 81'),
(8, 'Aosta', 'Via Chambery 5'),
(9, 'Verona', 'Via Pontida 22'),
(10, 'Torino', 'Via Perrone 10'),
(11, 'Torino', 'Via Guastalla 33'),
(12, 'Milano', 'Viale Montenero 44'),
(13, 'Milano', 'Via Vignola 2');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `Status` varchar(20) NOT NULL,
  `Number` varchar(16) NOT NULL,
  `Month` varchar(2) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `CVV` varchar(4) NOT NULL,
  `PIN` varchar(6) NOT NULL,
  `Balance` int(11) DEFAULT NULL,
  `Payment_Date` varchar(2) DEFAULT NULL,
  `Card_ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `ActivationDate` date NOT NULL,
  `Favorite` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`Status`, `Number`, `Month`, `Year`, `CVV`, `PIN`, `Balance`, `Payment_Date`, `Card_ID`, `Account_ID`, `ActivationDate`, `Favorite`) VALUES
('Active', '4031755065335678', '03', '24', '378', '1445', 11631, NULL, 6, 3, '2020-03-04', 1),
('Active', '4115162610577789', '04', '25', '568', '25663', NULL, '03', 5, 3, '2020-10-10', 0),
('Active', '5291974827221441', '01', '22', '366', '8871', 546, NULL, 4, 3, '2021-02-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `card_types`
--

CREATE TABLE `card_types` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Vendor` varchar(20) NOT NULL,
  `Monthly_Max` int(11) NOT NULL,
  `Daily_Max` int(11) NOT NULL,
  `Tax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_types`
--

INSERT INTO `card_types` (`ID`, `Name`, `Type`, `Vendor`, `Monthly_Max`, `Daily_Max`, `Tax`) VALUES
(4, 'Easy Debit', 'Debit', 'Visa', 1000, 600, 0),
(5, 'Easy Credit', 'Credit', 'Mastercard', 5500, 2500, 3),
(6, 'Easy Bancomat', 'Bancomat', 'Visa', 3600, 1200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `ID` int(11) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `Month` varchar(2) NOT NULL,
  `Year` year(4) NOT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`ID`, `Account_ID`, `Month`, `Year`, `Balance`) VALUES
(1, 3, '01', 2021, 8894),
(2, 3, '02', 2021, 12193),
(3, 3, '03', 2021, 13879),
(4, 3, '04', 2021, 17762),
(5, 3, '05', 2021, 15185),
(6, 3, '12', 2020, 10733);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `Loan_ID` int(11) NOT NULL,
  `Amount` mediumint(9) NOT NULL,
  `Tax` tinyint(4) NOT NULL,
  `StartDate` date NOT NULL,
  `Returned` mediumint(9) NOT NULL DEFAULT 0,
  `Total` mediumint(9) NOT NULL,
  `Fee` int(11) NOT NULL DEFAULT 150,
  `Account_ID` int(11) NOT NULL,
  `Favorite` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`Loan_ID`, `Amount`, `Tax`, `StartDate`, `Returned`, `Total`, `Fee`, `Account_ID`, `Favorite`) VALUES
(1, 5600, 3, '2020-12-20', 450, 5150, 150, 3, 1),
(2, 500, 5, '2021-03-01', 0, 525, 150, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `SafeDepositBox`
--

CREATE TABLE `SafeDepositBox` (
  `ID` int(11) NOT NULL,
  `Branch_ID` int(11) NOT NULL,
  `Sector` varchar(4) NOT NULL,
  `Fee` smallint(6) NOT NULL,
  `Level` tinyint(4) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `Account_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SafeDepositBox`
--

INSERT INTO `SafeDepositBox` (`ID`, `Branch_ID`, `Sector`, `Fee`, `Level`, `StartDate`, `Account_ID`) VALUES
(1, 5, '3C', 30, 3, '2020-01-01', 3),
(2, 8, '3B', 10, 2, '2021-05-17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `CF` varchar(16) NOT NULL,
  `Account_ID` int(11) NOT NULL,
  `StartDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `CF`, `Account_ID`, `StartDate`) VALUES
(1, 'DOEJHN72A01H501F', 3, '2020-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `Transaction_ID` int(11) NOT NULL,
  `InOut` varchar(4) NOT NULL,
  `Agent` varchar(60) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Amount` float NOT NULL,
  `Date` date NOT NULL,
  `Number` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Transaction_ID`, `InOut`, `Agent`, `Type`, `Amount`, `Date`, `Number`) VALUES
(1, 'in', 'Leonard Hoffmann', 'Receiving', 120.5, '2021-03-19', '4031755065335678'),
(2, 'out', 'Martin Appleseed', 'Sending', 88.15, '2021-03-19', '5291974827221441'),
(3, 'out', 'Starbucks Coffee', 'Payment', 7.5, '2021-03-17', '5291974827221441'),
(4, 'out', 'Nike Inc.', 'Payment', 254.22, '2021-03-18', '4115162610577789'),
(5, 'in', 'Albert Austin', 'Receiving', 12.5, '2021-03-18', '4031755065335678'),
(6, 'out', 'Apple Inc.', 'Payment', 499.15, '2021-03-19', '4031755065335678'),
(7, 'in', 'Amazon', 'Refund', 55.22, '2021-03-18', '5291974827221441'),
(8, 'out', 'Amazon', 'Payment', 55.22, '2021-03-14', '5291974827221441'),
(9, 'in', 'Leonard Hoffmann', 'Receiving', 22.5, '2021-03-19', '5291974827221441'),
(10, 'out', 'Netflix', 'Subscription', 17.99, '2021-03-19', '4031755065335678'),
(11, 'out', 'McDonald\'s', 'Payment', 14.22, '2021-03-18', '4031755065335678'),
(12, 'in', 'Albert Austin', 'Receiving', 5.5, '2021-03-13', '4031755065335678');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `CF` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Residence` varchar(40) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Passwd` varchar(120) NOT NULL,
  `Profile_Img` varchar(30) DEFAULT 'default.jpg',
  `Dob` date NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CF`, `Email`, `Name`, `Surname`, `Residence`, `Phone`, `Passwd`, `Profile_Img`, `Dob`, `updated_at`, `created_at`) VALUES
('DOEJHN72A01H501A', 'ciao@ciao.com', 'Test', 'Test', 'Rome', '334589658', '$2y$10$ZEfywU.kZbtt/ob8WI.zUO7A3yi4S8QbcJ41KOSRQ6KTYapsHiWe.', 'default.jpg', '1972-01-01', '2021-06-23 13:22:30', '2021-06-23 13:22:30'),
('DOEJHN72A01H501F', 'johndoe@gmail.com', 'John', 'Doe', 'Rome', '3342589710', '$2y$10$2aXANJjLASKf9fjR5W/qAu9B8Op9qL9jClDKRQ4GCoO1YXaANJfj.', 'profile.png', '1972-01-01', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Account_ID` (`id`),
  ADD KEY `FK_Account_ID` (`Account_ID`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branch_ID`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`Number`),
  ADD KEY `idx_9` (`Account_ID`),
  ADD KEY `idx_10` (`Card_ID`);

--
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_8` (`Account_ID`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`Loan_ID`),
  ADD KEY `idx_3` (`Account_ID`);

--
-- Indexes for table `SafeDepositBox`
--
ALTER TABLE `SafeDepositBox`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_4` (`Account_ID`),
  ADD KEY `idx_5` (`Branch_ID`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_1` (`Account_ID`),
  ADD KEY `idx_2` (`CF`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`Transaction_ID`),
  ADD KEY `idx_11` (`Number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `Branch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `card_types`
--
ALTER TABLE `card_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `Loan_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `SafeDepositBox`
--
ALTER TABLE `SafeDepositBox`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD CONSTRAINT `FK_Account_ID` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`);

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`Card_ID`) REFERENCES `card_types` (`ID`),
  ADD CONSTRAINT `cards_ibfk_2` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`);

--
-- Constraints for table `SafeDepositBox`
--
ALTER TABLE `SafeDepositBox`
  ADD CONSTRAINT `SafeDepositBox_ibfk_1` FOREIGN KEY (`Branch_ID`) REFERENCES `branch` (`Branch_ID`),
  ADD CONSTRAINT `SafeDepositBox_ibfk_2` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`Account_ID`) REFERENCES `accounts` (`Account_ID`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`CF`) REFERENCES `users` (`CF`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`Number`) REFERENCES `cards` (`Number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
