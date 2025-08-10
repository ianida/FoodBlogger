-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2025 at 06:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodblogger`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `dname` varchar(30) NOT NULL,
  `cusine` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `videol` varchar(100) NOT NULL,
  `recepie` varchar(10000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `dname`, `cusine`, `course`, `videol`, `recepie`, `description`, `image`, `name`, `user_id`) VALUES
(49, 'chicken dish again', 'nepali', 'MainCourse', 'http://localhost:8011/FoodBlogger/assets/video/e5733b0e94c1af40969b1f880e0c725a.mp4', 'c2FzZGFzZA==', 'YXNkYXNk', 'http://localhost:8011/FoodBlogger/assets/img/chicken-karahi-final.jpg', 'siwawi userOne', 11),
(50, 'Chicken Karahi', 'Indian', 'MainCourse', 'http://localhost:8011/FoodBlogger/assets/video/74c640a9af4aa852f4780e47bc37a2af.mp4', 'Z2pnaGpnaGo=', 'Z2hqZ2hqZ2hqZ2hqZ2hq', 'http://localhost:8011/FoodBlogger/assets/img/chicken-karahi-final.jpg', 'siwawi userOne', 11),
(52, 'chicken chicken', 'Indian', 'Starter', 'http://localhost:8011/FoodBlogger/assets/video/74c640a9af4aa852f4780e47bc37a2af.mp4', 'ZHNmc2Rm', 'c2RmZHNm', 'http://localhost:8011/FoodBlogger/assets/img/chicken-karahi-final.jpg', 'rojar maharjan', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_videos_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `fk_videos_user` FOREIGN KEY (`user_id`) REFERENCES `signup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
