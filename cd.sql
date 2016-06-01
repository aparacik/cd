-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Cze 2016, 15:58
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cd`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `premiere` date NOT NULL,
  `describe` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`, `created`) VALUES
(1, '0fade7f498d15c8ae9344099e45c52', 1, '2016-05-26'),
(2, 'f5e722194e94f8b2e8291cba111e5f', 2, '2016-05-26'),
(3, '7fd0dc28db1b5252f0aca04247cf21', 3, '2016-05-26'),
(4, '8aba9e5bd39b60776e104141e92a6b', 4, '2016-05-26'),
(5, '2c65be6257246d2123fc17958818c0', 5, '2016-05-26'),
(6, '24b1f730b009c2e2863bc3ed5e32b5', 6, '2016-05-26'),
(7, '0588f59014485510aac3bd9fdc2695', 7, '2016-05-26'),
(8, '5fe3cdf81caa907ea25cf356e3271f', 8, '2016-05-26'),
(9, '2664c206999e7419517ee39e177797', 9, '2016-05-26'),
(10, '7ce2a3d1fe81e452ad817f9548f217', 10, '2016-05-26'),
(11, '1a2ad2eec673b0e5eafc7e97027785', 11, '2016-05-26'),
(12, '6ec72d2c48dcce4fd226ad7e31f063', 9, '2016-05-26'),
(13, 'd0c134594a40d56a596b81c861dfb7', 9, '2016-05-26'),
(14, 'afa26cd05e41beaa1812e44bd2fed0', 9, '2016-05-30'),
(15, 'fbac12e2d3e01143820998fd125b9a', 9, '2016-05-30'),
(16, '0a1a3455de46734bdad7ddf8adf19d', 9, '2016-05-30'),
(17, '757bd29ecd25f5616d0eb5aec668f6', 12, '2016-05-30'),
(18, 'dc26ac2f0a2e87d81cce0f09ba2d58', 13, '2016-05-30'),
(19, 'd7a04c7025925ab6cb3b7ee48b6e7c', 14, '2016-05-30'),
(20, '0c11607e48d1d82ca988fdd51908c2', 15, '2016-05-30'),
(21, '4076b423ca1e3b2698ec7204fa6577', 16, '2016-05-30'),
(22, '08f68c844f68c693daf15c74c1a2aa', 17, '2016-05-30'),
(23, '63b4f91cf8f3dcf5b300797302b995', 18, '2016-05-30'),
(24, 'a049d7d4ed234ea7bc40e8e0476fc6', 19, '2016-05-30'),
(25, '8d3589ae462b6095885a440f7b7803', 20, '2016-05-30'),
(26, 'b82bc18a58fd0f4940517ca74e2793', 21, '2016-05-30'),
(27, '5c8cb2ecae7925e428a141bd24f154', 22, '2016-05-30'),
(28, 'da005149934a1444919ec6c250affb', 23, '2016-05-30'),
(29, 'dcf244820932d1bb96de4a0cbb4911', 24, '2016-05-30'),
(30, '73dd38797f9716d266dbc60802e3a0', 25, '2016-05-30'),
(31, '212780a5422c67b80d17d5510fab86', 26, '2016-05-30'),
(32, 'cdd6f293a3e75bc6cd866093efe881', 27, '2016-05-30'),
(33, '98398924b2b8d1b7c2fed2501f5c4b', 28, '2016-05-30'),
(34, '375fec3906c06096237cd8783ab30c', 29, '2016-05-30'),
(35, 'df35411644acb90df56f509c66e87b', 30, '2016-05-30'),
(36, '52972d076d4b0cbc349127d6fe0250', 31, '2016-05-30'),
(37, '1eaca0b6088ab51488d8312a49fb49', 32, '2016-05-30'),
(38, '0cccfeabe70a0a074082c2b1740f76', 33, '2016-05-30'),
(39, '45c14c8e91976851470c4400fff120', 34, '2016-05-30'),
(40, 'ad3e8cf7432ea8c28558fa7eb2c6ea', 35, '2016-05-30'),
(41, '1c14ef1c81a204feba18ffc9882bb4', 35, '2016-05-30'),
(42, 'fcf874e2d956d2e894e63b08913b14', 35, '2016-05-30'),
(43, '5b884885fc4edb0bcb509cc6f95f11', 35, '2016-05-30'),
(44, '1a001f747d739e27bae461331bc18f', 36, '2016-05-31'),
(45, '444dd43db581dd77e1191508798068', 37, '2016-05-31'),
(46, '58a5cb49b3868b6ed182cd0496d712', 38, '2016-05-31'),
(47, 'e248b1557fc70979092ddf1ad113c1', 39, '2016-05-31'),
(48, '400732a5e0fd9d52bb356cceed54d5', 40, '2016-05-31'),
(49, '74062ec969d6fa897ae5595a0b9477', 41, '2016-05-31'),
(50, '3fffbcb92ed1609f829f5ed4aff135', 42, '2016-05-31'),
(51, 'f1c87b66d72ff15463138dd09ed527', 43, '2016-05-31'),
(52, '0fb0baa9e478d0a106bcf872e62390', 44, '2016-05-31'),
(53, 'ca1d5e5e33ce7bb041d57b51fa35c8', 45, '2016-05-31'),
(54, 'd549b155d60f501578da892e89cf97', 46, '2016-05-31'),
(55, '63ecc933c573dd61f2cd3b17399765', 47, '2016-05-31'),
(56, '2265367b0c33a34c7665c868d45783', 48, '2016-05-31'),
(57, 'e37e85a98954fdcc8039f53d0ed04a', 49, '2016-05-31'),
(58, '6eae9ee5f2a043ddef297ebde29d7d', 50, '2016-05-31'),
(59, 'aca08bb03868724cd1e7b984427685', 51, '2016-05-31'),
(60, '4d13de24e1d3d51a30eb7ce5e0f4dd', 52, '2016-05-31'),
(61, '4d770a8f87dd4482b44da92020f632', 53, '2016-05-31'),
(62, 'c1dfd96eea8cc2b62785275bca38ac', 54, '2016-05-31'),
(63, '49528c78ab65b909a799fa01d7210a', 55, '2016-05-31'),
(64, '034125580d6b49bcbb843d3b1a1e0c', 35, '2016-05-31'),
(65, '3b92a281bba1b0b0912e1a2e2a04d0', 35, '2016-05-31'),
(66, 'd473f7352d4415d5517273f9aecf8d', 35, '2016-05-31'),
(67, '7b7136d4d7df79005ca10b90a87b09', 35, '2016-05-31'),
(68, '3b7ea703ba7e4bbd74b614c126533f', 35, '2016-05-31'),
(69, '8abc82a851bde471c9451708e9fc86', 56, '2016-05-31'),
(70, '8968cf65fed430a11419671230c920', 57, '2016-05-31'),
(71, '9a3e61b6bcc8abec08f195526c3132', 35, '2016-05-31'),
(72, 'd9a6c08362fe4fff38123e22461a64', 35, '2016-05-31'),
(73, 'c303b906a267f1b0ba45ea027a6759', 58, '2016-05-31'),
(74, '8c37f69a6a16fa0b5ac79afd29ba31', 35, '2016-06-01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `role` varchar(255) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(255) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` varchar(255) CHARACTER SET latin1 NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
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
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
