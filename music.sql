-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 23, 2025 at 07:07 PM
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
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audio_filepath`
--

CREATE TABLE `tbl_audio_filepath` (
  `audio_filepath_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audio_filepath`
--

INSERT INTO `tbl_audio_filepath` (`audio_filepath_id`, `filename`, `filepath`) VALUES
(1, 'Bahay Kubo (Nipa Hut) - Filipino Nursery Rhymes - robie317.mp3', '../../uploads/audio_uploads/68a97a394ff86_Bahay Kubo (Nipa Hut) - Filipino Nursery Rhymes - robie317.mp3'),
(2, 'Birds of Time (original song) Enna Alouette × PrettyPatterns.wav', '../../uploads/audio_uploads/68a97b289860f_Birds of Time (original song) Enna Alouette × PrettyPatterns.wav'),
(3, 'powerup.wav', '../../uploads/audio_uploads/68a97e87104dc_powerup.wav'),
(4, 'cursor.wav', '../../uploads/audio_uploads/68a97eae44e2c_cursor.wav');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cover_filepath`
--

CREATE TABLE `tbl_cover_filepath` (
  `cover_filepath_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cover_filepath`
--

INSERT INTO `tbl_cover_filepath` (`cover_filepath_id`, `filename`, `filepath`) VALUES
(1, '1.png', '../../uploads/image_uploads/68a97a395075e_1.png'),
(2, 'Screenshot (188).png', '../../uploads/image_uploads/68a97b28990ed_Screenshot (188).png'),
(3, 'F3U-BJbaQAA_blO.jpg', '../../uploads/image_uploads/68a97e8711865_F3U-BJbaQAA_blO.jpg'),
(4, 'GicOEIZaYAE4pz6.jpg', '../../uploads/image_uploads/68a97eae4584e_GicOEIZaYAE4pz6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genres`
--

CREATE TABLE `tbl_genres` (
  `genre_id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_genres`
--

INSERT INTO `tbl_genres` (`genre_id`, `genre`) VALUES
(1, 'Country'),
(2, 'Electronic'),
(3, 'Funk'),
(4, 'Hip-hop'),
(5, 'Jazz'),
(6, 'Latin'),
(7, 'Pop'),
(8, 'Punk'),
(9, 'Raggae'),
(10, 'Rock'),
(11, 'Metal'),
(12, 'R&B'),
(13, 'Polka');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_music`
--

CREATE TABLE `tbl_music` (
  `music_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `album` varchar(255) DEFAULT NULL,
  `audio_filepath_id` int(11) NOT NULL,
  `cover_filepath_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_music`
--

INSERT INTO `tbl_music` (`music_id`, `title`, `artist`, `album`, `audio_filepath_id`, `cover_filepath_id`) VALUES
(3, 'Bahay Kubo', 'me', 'songs', 1, 1),
(4, 'Birds of Time', 'Enna', 'songs', 2, 2),
(5, 'Country', 'me', '', 3, 3),
(6, 'Pop', 'Enna', '', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_music_genre`
--

CREATE TABLE `tbl_music_genre` (
  `music_genre_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_music_genre`
--

INSERT INTO `tbl_music_genre` (`music_genre_id`, `music_id`, `genre_id`) VALUES
(1, 3, 1),
(3, 4, 7),
(4, 5, 1),
(5, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `review` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `music_id`, `rating`, `review`, `user_id`) VALUES
(2, 3, 1, 'bad', 5),
(3, 3, 5, 'nice', 5),
(4, 3, 5, 'Good', 5),
(5, 4, 5, 'good', 5),
(6, 4, 1, 'This is ass', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_streams`
--

CREATE TABLE `tbl_streams` (
  `user_id` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_streams`
--

INSERT INTO `tbl_streams` (`user_id`, `music_id`, `date`) VALUES
(5, 3, '2025-08-23 10:28:05'),
(5, 3, '2025-08-23 10:28:38'),
(5, 3, '2025-08-23 10:28:43'),
(5, 3, '2025-08-23 10:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `password`, `isAdmin`) VALUES
(5, 'user1', 'user1@example.com', '$2y$10$nUmfKOIu.VqutZ00MhuoPOYk9FXwwh0ce0jb0mZmSnsod8UqQtiuG', 0),
(6, 'admin', 'admin@example.com', '$2y$10$kg/evJZNy17AETRhhjH8luScqLBwrKiGRp9tMsGynlITnD.e87wte', 1),
(7, 'user2', 'user2@example.com', '$2y$10$Rgd8a9kccJAiP410QW1Ih.GJEPYG5OfyPZRJ8faNkiBZExAlUXYGm', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_audio_filepath`
--
ALTER TABLE `tbl_audio_filepath`
  ADD PRIMARY KEY (`audio_filepath_id`);

--
-- Indexes for table `tbl_cover_filepath`
--
ALTER TABLE `tbl_cover_filepath`
  ADD PRIMARY KEY (`cover_filepath_id`);

--
-- Indexes for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `tbl_music`
--
ALTER TABLE `tbl_music`
  ADD PRIMARY KEY (`music_id`);

--
-- Indexes for table `tbl_music_genre`
--
ALTER TABLE `tbl_music_genre`
  ADD PRIMARY KEY (`music_genre_id`),
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_streams`
--
ALTER TABLE `tbl_streams`
  ADD KEY `music_id` (`music_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_audio_filepath`
--
ALTER TABLE `tbl_audio_filepath`
  MODIFY `audio_filepath_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cover_filepath`
--
ALTER TABLE `tbl_cover_filepath`
  MODIFY `cover_filepath_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_genres`
--
ALTER TABLE `tbl_genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_music`
--
ALTER TABLE `tbl_music`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_music_genre`
--
ALTER TABLE `tbl_music_genre`
  MODIFY `music_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_music_genre`
--
ALTER TABLE `tbl_music_genre`
  ADD CONSTRAINT `tbl_music_genre_ibfk_1` FOREIGN KEY (`music_id`) REFERENCES `tbl_music` (`music_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_streams`
--
ALTER TABLE `tbl_streams`
  ADD CONSTRAINT `tbl_streams_ibfk_1` FOREIGN KEY (`music_id`) REFERENCES `tbl_music` (`music_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
