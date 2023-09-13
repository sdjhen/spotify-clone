-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2023 at 02:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotifyclone`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Bacon and Eggs', 1, 4, 'assets/img/artwork/album2.png'),
(2, 'Pizza head', 2, 10, 'assets/img/artwork/album1.png'),
(3, 'Dollar Stackz', 3, 2, 'assets/img/artwork/album3.png'),
(4, 'Sensational', 4, 9, 'assets/img/artwork/album5.png'),
(5, 'Explosive', 5, 8, 'assets/img/artwork/album7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Chick Pea'),
(2, 'Lexi'),
(3, 'Harv'),
(4, 'Dex'),
(5, 'Nacho');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Rap'),
(3, 'Pop'),
(4, 'House'),
(5, 'R&B'),
(6, 'Hip-Hop'),
(7, 'Classical'),
(8, 'Techno'),
(9, 'Indie'),
(10, 'Jazz');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlistSongs`
--

CREATE TABLE `playlistSongs` (
  `id` int(11) NOT NULL,
  `songID` int(11) NOT NULL,
  `playlistID` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(255) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Songs`
--

INSERT INTO `Songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'Summer Walk', 1, 1, 3, '3:18', 'assets/music/summer-walk-152722.mp3', 1, 121),
(2, 'Good Night', 2, 2, 10, '2:27', 'assets/music/good-night-160166.mp3', 2, 111),
(3, 'For Future Bass', 3, 3, 5, '2:29', 'assets/music/for-future-bass-159125.mp3', 3, 103),
(4, 'Lofi Chill', 4, 4, 9, '1:08', 'assets/music/lofi-chill-medium-version-159456.mp3', 4, 114),
(5, 'Eternity', 5, 5, 7, '2:25', 'assets/music/leva-eternity-149473.mp3', 5, 102),
(6, 'A Call to the Soul', 1, 1, 3, '2:39', 'assets/music/a-call-to-the-soul-149262.mp3', 2, 104),
(7, 'Ambient Classical', 2, 2, 6, '1:49', 'assets/music/ambient-classical-guitar-144998.mp3', 2, 112),
(8, 'Coniferous Forest', 1, 1, 2, '2:08', 'assets/music/coniferous-forest-142569.mp3', 4, 115),
(9, 'Easy Lifestyle', 2, 2, 1, '2:48', 'assets/music/easy-lifestyle-137766.mp3', 2, 117),
(10, 'Eco Technology', 2, 2, 3, '2:02', 'assets/music/eco-technology-145636.mp3', 3, 118),
(11, 'Floating Abstract', 2, 2, 4, '1:37', 'assets/music/floating-abstract-142819.mp3', 3, 99),
(12, 'Futuristic Beat', 2, 2, 1, '2:01', 'assets/music/futuristic-beat-146661.mp3', 4, 98),
(13, 'Modern Vlog', 3, 3, 3, '2:19', 'assets/music/modern-vlog-140795.mp3', 2, 101),
(14, 'My Universe', 3, 3, 2, '2:27', 'assets/music/my-universe-147152.mp3', 3, 96),
(15, 'Reflected Light', 3, 3, 4, '3:45', 'assets/music/reflected-light-147979.mp3', 4, 98),
(16, 'Relaxing', 4, 4, 9, '1:12', 'assets/music/relaxing-145038.mp3', 2, 131),
(17, 'Risk', 4, 4, 5, '1:13', 'assets/music/risk-136788.mp3', 3, 119),
(18, 'Smoke', 5, 5, 10, '1:59', 'assets/music/smoke-143172.mp3', 2, 90),
(19, 'Unlock Me', 5, 5, 7, '3:06', 'assets/music/unlock-me-149058.mp3', 3, 60),
(20, 'Waterfall', 5, 5, 6, '2:44', 'assets/music/waterfall-140894.mp3', 4, 86);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `registerdate` datetime NOT NULL,
  `profilepic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `registerdate`, `profilepic`) VALUES
(1, 'samh187', 'Sam', 'Hendry', 'Sdjhen@mail.com', '$2y$10$2GDt/Ci1c.q7Hz3eCc76K.Z52GW56jomlOof11mrOirtwnoMigs3m', '2023-07-26 00:00:00', 'assets/img/profilepics/profile.png'),
(4, 'samhen', 'Sam', 'Hen', 'Samhen@gmail.com', '$2y$10$batiO7VDDvS5iy9XypFX5ux4EXcKbmzOYqRLYUrhEZlto4dfjYDXy', '2023-07-28 00:00:00', 'assets/img/profilepics/profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
