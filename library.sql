-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2022 at 02:04 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `photo` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `photo`, `phone`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$7304Pvm7ltt7JDGWY04Z5O1FACALCy.DyzWELjhT5CMjaFl35OAwa', NULL, '65214584', 1),
(2, 'khalil', 'amk@gmail.com', '$2y$10$Jru4PRqA8Ubaq1x1.01z4u5O/8q2g8vhGKuq/Ljza1DAIRWDMmk0y', NULL, NULL, 0),
(4, 'ahmed', 'qayssar@gmail.com', '$2y$10$6IpKdX/8850oRd6Sk42ypOS.rP2Tx7mHpX3F5LCx/xJDcktHP5gGe', NULL, NULL, 0),
(7, 'Ila Ramirez', 'gegynylawi@mailinator.com', '$2y$10$kn8cwLfQu//WanTrcAo9KuezEV7OaMmLbdLL2UJzn3IZHUgwd7E8S', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `field` text NOT NULL,
  `description` text NOT NULL,
  `paid_status` varchar(20) NOT NULL,
  `available` varchar(20) NOT NULL,
  `accept_status` int(11) NOT NULL DEFAULT 0,
  `photo` text DEFAULT NULL,
  `price` double DEFAULT NULL,
  `faculty_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculities`
--

CREATE TABLE `faculities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `photo` text DEFAULT NULL,
  `uni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculities`
--

INSERT INTO `faculities` (`id`, `name`, `description`, `photo`, `uni_id`) VALUES
(2, 'wrerr', 'erere', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `photo` text DEFAULT NULL,
  `phone` text NOT NULL,
  `fac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `photo`, `phone`, `fac_id`) VALUES
(1, 'Cameran Doyle', 'adam@yahoo.com', '$2y$10$rli9OCyed3n7MeJlv0cLHeqdxChKV58tXN6GLg1I3s4Dh1MK.Lwu.', 'gustas-brazaitis-xNKy-Cu20d4-unsplash.jpg', '69532581', 2);

-- --------------------------------------------------------

--
-- Table structure for table `univerisities`
--

CREATE TABLE `univerisities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sub_admin_id` int(11) NOT NULL,
  `photo` text DEFAULT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `univerisities`
--

INSERT INTO `univerisities` (`id`, `name`, `sub_admin_id`, `photo`, `address`, `description`) VALUES
(1, 'kwait', 2, 'fotis-fotopoulos-LJ9KY8pIH3E-unsplash.jpg', 'addressssss', ''),
(2, 'الكويت', 4, NULL, 'adress', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `faculities`
--
ALTER TABLE `faculities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uni_id` (`uni_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fac_id` (`fac_id`);

--
-- Indexes for table `univerisities`
--
ALTER TABLE `univerisities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `sub_admin_id` (`sub_admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculities`
--
ALTER TABLE `faculities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `univerisities`
--
ALTER TABLE `univerisities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `faculities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculities`
--
ALTER TABLE `faculities`
  ADD CONSTRAINT `faculities_ibfk_1` FOREIGN KEY (`uni_id`) REFERENCES `univerisities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `faculities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `univerisities`
--
ALTER TABLE `univerisities`
  ADD CONSTRAINT `univerisities_ibfk_1` FOREIGN KEY (`sub_admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
