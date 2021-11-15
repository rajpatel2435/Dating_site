-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 04:28 PM
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
-- Database: `datingsite`
--
CREATE DATABASE IF NOT EXISTS `datingsite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `datingsite`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `message`, `senderID`, `receiverID`, `time`, `seen`, `type`) VALUES
(7, 'Hii', 2, 1, '2021-05-02 18:14:05', 1, 'message'),
(8, '', 1, 2, '2021-05-02 18:14:19', 1, 'wink'),
(9, 'Hii', 1, 2, '2021-05-02 18:15:02', 1, 'message'),
(10, '', 1, 2, '2021-05-02 18:15:09', 1, 'wink'),
(11, '', 1, 2, '2021-05-02 18:24:20', 1, 'wink'),
(12, 'How are you?', 1, 2, '2021-05-02 18:24:38', 1, 'message'),
(13, 'I m fine!', 1, 2, '2021-05-02 18:24:47', 1, 'message'),
(14, 'HEy admin', 2, 1, '2021-05-02 18:25:25', 1, 'message'),
(15, '', 2, 4, '2021-05-02 19:05:11', 1, 'addFav'),
(16, '', 2, 7, '2021-05-02 19:05:15', 1, 'addFav'),
(17, '', 2, 11, '2021-05-02 19:05:19', 1, 'addFav'),
(18, '', 3, 16, '2021-05-02 19:15:13', 1, 'addFav'),
(19, '', 3, 22, '2021-05-02 19:15:19', 1, 'addFav'),
(20, '', 3, 24, '2021-05-02 19:15:23', 1, 'addFav'),
(21, '', 3, 4, '2021-05-02 19:15:28', 1, 'addFav'),
(22, '', 6, 2, '2021-05-02 19:18:12', 1, 'addFav'),
(23, '', 6, 5, '2021-05-02 19:18:15', 1, 'addFav'),
(24, '', 6, 13, '2021-05-02 19:18:18', 1, 'addFav'),
(25, '', 6, 14, '2021-05-02 19:18:22', 1, 'addFav'),
(26, '', 9, 6, '2021-05-02 19:27:50', 1, 'addFav'),
(27, '', 9, 11, '2021-05-02 19:27:54', 1, 'addFav'),
(28, '', 9, 16, '2021-05-02 19:27:58', 1, 'addFav'),
(29, '', 16, 2, '2021-05-02 19:28:28', 0, 'addFav'),
(30, '', 16, 23, '2021-05-02 19:28:33', 0, 'addFav'),
(31, '', 16, 10, '2021-05-02 19:28:37', 0, 'addFav'),
(32, '', 16, 18, '2021-05-02 19:28:45', 0, 'addFav'),
(33, '', 22, 2, '2021-05-02 19:34:28', 0, 'addFav'),
(34, '', 22, 9, '2021-05-02 19:34:31', 0, 'addFav'),
(35, '', 22, 14, '2021-05-02 19:34:37', 0, 'addFav'),
(36, '', 2, 4, '2021-05-02 19:39:58', 1, 'wink'),
(37, '', 2, 8, '2021-05-02 19:40:01', 1, 'wink'),
(38, '', 2, 11, '2021-05-02 19:40:06', 1, 'wink'),
(39, '', 2, 24, '2021-05-02 19:40:09', 1, 'wink'),
(40, 'Hii', 2, 12, '2021-05-02 19:40:26', 1, 'message'),
(41, 'How are you?', 2, 12, '2021-05-02 19:40:32', 1, 'message'),
(42, '', 6, 3, '2021-05-02 19:41:08', 1, 'wink'),
(43, '', 6, 9, '2021-05-02 19:41:12', 1, 'wink'),
(44, '', 6, 20, '2021-05-02 19:41:17', 1, 'wink'),
(45, 'HEYY!', 6, 3, '2021-05-02 19:41:25', 1, 'message'),
(46, '', 9, 8, '2021-05-02 19:42:47', 1, 'addFav'),
(47, '', 9, 15, '2021-05-02 19:42:51', 1, 'wink'),
(48, '', 9, 16, '2021-05-02 19:42:55', 1, 'wink'),
(49, '', 9, 22, '2021-05-02 19:43:00', 1, 'wink'),
(50, 'Hii Jason!', 9, 6, '2021-05-02 19:44:03', 0, 'message'),
(51, 'I m fine! Wbu?', 9, 6, '2021-05-02 19:44:18', 0, 'message'),
(52, '', 16, 2, '2021-05-02 19:44:48', 0, 'addFav'),
(53, '', 16, 2, '2021-05-02 19:44:50', 0, 'wink'),
(54, '', 16, 2, '2021-05-02 19:44:53', 0, 'wink'),
(55, '', 16, 10, '2021-05-02 19:44:57', 0, 'wink'),
(56, '', 16, 2, '2021-05-02 19:44:59', 0, 'wink'),
(57, '', 16, 14, '2021-05-02 19:45:03', 0, 'wink'),
(58, 'Hii Stella', 16, 2, '2021-05-02 19:45:12', 0, 'message'),
(59, '', 22, 3, '2021-05-02 19:45:35', 0, 'wink'),
(60, '', 22, 14, '2021-05-02 19:45:38', 0, 'wink'),
(61, 'Heyy mary, r u fine?... I heard u met an accident!', 22, 14, '2021-05-02 19:46:03', 0, 'message'),
(62, '', 24, 10, '2021-05-02 19:48:09', 0, 'wink'),
(63, '', 24, 18, '2021-05-02 19:48:13', 0, 'wink'),
(64, '', 24, 23, '2021-05-02 19:48:16', 0, 'wink'),
(65, 'HELLO ZARAA!', 24, 23, '2021-05-02 19:48:25', 0, 'message'),
(66, '', 24, 19, '2021-05-02 19:48:42', 0, 'addFav'),
(67, '', 24, 5, '2021-05-02 19:48:46', 0, 'addFav'),
(68, '', 24, 20, '2021-05-02 19:48:50', 0, 'addFav');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `age` int(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `membership` varchar(50) NOT NULL,
  `fav` varchar(1000) NOT NULL,
  `bio` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `winks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `password`, `gender`, `age`, `city`, `membership`, `fav`, `bio`, `image`, `winks`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 'male', 20, 'Montreal', 'premium', ' ', ' ', ' default.png', 3),
(2, 'Stella', 'stella@gmail.com', 'stella', 'female', 26, 'Montreal', 'premium', '  Kevin Tyler Zion', 'It’s too “a.m.” for me.', '2profile.png', 6),
(3, 'Aurora', 'aurora@gmail.com', 'aurora', 'female', 23, 'Montreal', 'regular', '  Steven Felix Bryan Kevin', 'I had fun once, it was horrible.', '3profile.png', 2),
(4, 'Kevin', 'kevin@gmail.com', 'kevin', 'male', 30, 'Sherbrooke', 'regular', ' ', 'Don’t give up on your dreams. Keep sleeping.', '4profile.png', 1),
(5, 'Alice', 'alice@gmail.com', 'alice', 'female', 35, 'Ottawa', 'guest', ' ', ' ', ' default.png', 0),
(6, 'Jason', 'jason@gmail.com', 'jason', 'male', 27, 'Sherbrooke', 'premium', '  Stella Alice Athena Mary', 'Don’t sit like a rock, work like a clock.', '6profile.png', 0),
(7, 'Tyler', 'tyler@gmail.com', 'tyler', 'male', 33, 'Montreal', 'guest', ' ', ' ', ' default.png', 0),
(8, 'Diego', 'diego@gmail.com', 'diego', 'male', 28, 'Laval', 'regular', ' ', 'Silence is golden. Duct tape is silver.', '8profile.png', 1),
(9, 'Sarah', 'sarah@gmail.com', 'sarah', 'female', 24, 'Laval', 'premium', '  Jason Zion Steven Diego', 'Your Attitude determines your direction', '9profile.png', 1),
(10, 'Clara', 'clara@gmail.com', 'clara', 'female', 35, 'Laval', 'regular', ' ', 'I’m not short, I’m concentrated awesome', '10profile.png', 2),
(11, 'Zion', 'zion@gmail.com', 'zion', 'male', 38, 'Sherbrooke', 'guest', ' ', ' ', ' default.png', 1),
(12, 'Brody', 'brody@gmail.com', 'brody', 'male', 41, 'Montreal', 'guest', ' ', ' ', ' default.png', 0),
(13, 'Athena', 'athena@gmail.com', 'athena', 'female', 27, 'Montreal', 'guest', ' ', ' ', ' default.png', 0),
(14, 'Mary', 'mary@gmail.com', 'mary', 'female', 30, 'Ottawa', 'regular', ' ', 'A smile is the most beautiful curve on a woman’s body.', '14profile.png', 2),
(15, 'Joel', 'joel@gmail.com', 'joel', 'male', 29, 'Ottawa', 'guest', ' ', ' ', ' default.png', 1),
(16, 'Steven', 'steven@gmail.com', 'steven', 'male', 42, 'Ottawa', 'premium', '  Stella Zara Clara Andrea Stella', 'Live for the moments you can’t put into words.', '16profile.png', 1),
(17, 'Marcus', 'marcus@gmail.com', 'marcus', 'male', 25, 'Ottawa', 'guest', ' ', ' ', ' default.png', 0),
(18, 'Andrea', 'andrea@gmail.com', 'andrea', 'female', 27, 'Ottawa', 'regular', ' ', 'You only live once, but if you do it right, once is enough.', '18profile.png', 1),
(19, 'Remi', 'remi@gmail.com', 'remi', 'female', 28, 'Sherbrooke', 'guest', ' ', ' ', ' default.png', 0),
(20, 'Lilly', 'lilly@gmail.com', 'lilly', 'female', 37, 'Sherbrooke', 'guest', ' ', ' ', ' default.png', 1),
(21, 'Amy', 'amy@gmail.com', 'amy', 'female', 23, 'Laval', 'guest', ' ', ' ', ' default.png', 0),
(22, 'Felix', 'felix@gmail.com', 'felix', 'male', 31, 'Laval', 'premium', '  Stella Sarah Mary', 'Sunsets prove that the end can be beautiful.', '22profile.png', 1),
(23, 'Zara', 'zara@gmail.com', 'zara', 'female', 25, 'Sherbrooke', 'regular', ' ', 'Gracefulness makes you more gorgeous.', '23profile.png', 1),
(24, 'Bryan', 'bryan@gmail.com', 'bryan', 'male', 36, 'Laval', 'premium', '  Remi Alice Lilly', 'Do more of what makes you happy.', '24profile.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `receiverID` (`receiverID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiverID`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
