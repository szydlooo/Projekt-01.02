-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 08:23 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `disliked`
--

CREATE TABLE `disliked` (
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disliked`
--

INSERT INTO `disliked` (`user_id`, `post_id`) VALUES
(12, 50),
(12, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likes`
--

CREATE TABLE `likes` (
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `post_id`) VALUES
(0, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `ID` int(11) NOT NULL,
  `TimeStamp` datetime NOT NULL,
  `FileName` varchar(96) NOT NULL,
  `Tytuł` text NOT NULL,
  `userId` int(11) NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT 0,
  `liked` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID`, `TimeStamp`, `FileName`, `Tytuł`, `userId`, `removed`, `liked`) VALUES
(29, '2023-03-29 14:09:50', 'img/b26ffc2d47cd3d0aa68ba43b6758556c717102f6207390754cba6a2b24e20ff1.webp', '123', 8, 0, 0),
(30, '2023-03-29 14:10:56', 'img/08d4b0aa46764fea302993cec129f111e66eb9145ec3cfca68d8fe4ddc0d0e5e.webp', '123', 8, 1, 0),
(31, '2023-03-29 14:13:17', 'img/53f4c0f18ce8b53062734633089808426ab4347b6fa22a5791e220dcd9bd9547.webp', '123', 9, 1, 0),
(32, '2023-03-29 14:27:49', 'img/0a089fbcb45f0a92ffa572ef59f4a5c7923cd846b434c753a02da93c550f5696.webp', '123', 8, 1, 0),
(33, '2023-03-29 14:31:34', 'img/0b91a9ed8df7c8dbb2f10353b3e591d733d0e5d1c57697353af04fcee6737967.webp', '12333', 8, 1, 0),
(34, '2023-03-29 15:10:49', 'img/d38bca326a18c44d69a1cba8c875ffa04d6b9c2d43b312aefe2bd57948716576.webp', '12331213', 8, 1, 0),
(35, '2023-03-29 15:11:32', 'img/3c367cbe395adbc313c766d68b796259b46689c08c51fb1b7f5f8c95f181c2c6.webp', '123123123', 8, 1, 0),
(36, '2023-03-29 15:11:32', 'img/1fbc106aaf9fd3e975005544bbeb40cf56efea58e852e8a89c3e61e957a88d2e.webp', '123123123', 8, 1, 0),
(37, '2023-03-29 15:24:34', 'img/9c90829e07630bfc98f04cfa3e7a0b4b97a0c5c29ba69cc88a515dcfce445003.webp', '12312312', 8, 1, 0),
(38, '2023-03-29 15:24:42', 'img/ac0983243431754e011ccae34a04b083571c6baaedb324f6cd16ecc36bcd6f4c.webp', '8888', 8, 1, 0),
(39, '2023-03-29 15:27:40', 'img/18b1b2f23c8bd9c9005f1aa67d3bd4abec13a64dde16c474eb646b30034b2909.webp', '123', 8, 1, 0),
(40, '2023-03-29 15:27:48', 'img/4d77603272038ba98ac1e3dffed128b00e7716b87c864c7aeb50d026f446aac0.webp', '12312', 8, 1, 0),
(41, '2023-03-29 15:35:29', 'img/f648b00d68b80d670aac31f35064c54a912ae0876267119155a2ea90be1c0912.webp', '21312312', 8, 1, 0),
(42, '2023-03-29 15:37:03', 'img/14edae5ac954774a76e595144ab9535390c6fad5b86f0b7e2a37945e8678e166.webp', '12312312', 8, 1, 0),
(43, '2023-03-29 15:44:13', 'img/2afa10465004b37ae4e350b3da770488f641034570a121c38cc6ba2109c40826.webp', 'chuj', 8, 0, 0),
(44, '2023-03-29 15:45:09', 'img/91caf143edcba02cc36c4e0ae33de172dc3b4849d9d4dd375841ec74de01a5a3.webp', '231321', 8, 1, 0),
(45, '2023-03-29 15:51:54', 'img/1f4a9f6047aee3e52df75f1c1a385d033da8e0302620b848f90e1853a42d113b.webp', 'bob', 8, 1, 0),
(46, '2023-03-29 15:58:15', 'img/07bc1aa427f8b5f3b9878382e6a20ffc5eefe3d0197c545ff8017adff21f6081.webp', '12321', 8, 0, 0),
(47, '2023-04-19 14:19:40', 'img/82c1ea658042f6fb493babac1e5bcf1315cccde350fbc53a5a7c747a46772176.webp', 'POKA CIPE', 8, 1, 0),
(48, '2023-04-19 15:09:32', 'img/39c54e0c51b745ec93daebaa2367da410cec9e9443c33ad6282b8d21cbecdbf1.webp', '123', 8, 0, 0),
(49, '2023-04-19 15:09:45', 'img/d43bcce28010c2384229876d7d243b9fe4e16cc513fcd76d544a1be792a43f62.webp', '123', 8, 0, 0),
(50, '2023-04-19 15:14:59', 'img/51681d2cbdd7396a184fc19bd279703150a79591923a716bd746e73075679014.webp', '12312312', 8, 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, '123@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$YUlORm1pS2Y1NE9KTTFBdw$ddwU0OjPkLS5knY16MJHQT7tNCzyYVRm8C9kUQX1ftk'),
(4, 'chuj@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WW5iNzhGbWlaTVZIeUFNSg$YqWtGxRpSiGOZaXLYOM0BA/MsziB3MP5JOw2d2JZaAE'),
(5, 'dchuj@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UENSVzlHbng2M0Vwenk3eQ$NqNe2QtPHs0WJNTpM2d3hMtfTK6tQV8OUdCaR5O96EE'),
(6, 'ckiuu@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Ymo1eWhxS1Jsb0NBa1VTSA$Bid98s+r0HlhWrNknh/OHHWAlpX1Ueasa6MC+4cIsZs'),
(7, '123@1', '$argon2i$v=19$m=65536,t=4,p=1$Lk11cVFCOG80Qk5GUnpPdQ$n9TSrJIpB4MlGNR2eDbCosoKPUzxo6TrR8MLFSytmPI'),
(8, '1233@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$bGhhVW9XeFB0OUtvL0tGSQ$OYnZP2jn7BUxugujbCfwJL/jJGfYgfZKnlZJd96j/SU'),
(9, 'chuj123@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$UjdwMGNHNHBxT1k4UWtlbQ$zn5uNfiGUotchX/QrVhinXXTGLir91uRkGRIM4TzA+k'),
(10, '12312312@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$SWtQU3BvMVBRZlpjcFRDbw$qKPnddU3OuxsAbj+KjXr+YZ0v587qLY9gXi2SYvK1Xc'),
(12, '333@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$QlhXbzdPemIwVXFrWDY0Tw$zPyR7fEL5sLoF4ouJHsDmunb4IG0zxxC6UXrea/8QgM');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
