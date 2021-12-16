-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Gru 2021, 13:31
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `biblioteka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descri` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `books`
--

INSERT INTO `books` (`id`, `name`, `descri`, `author`) VALUES
(9, 'Ludzie bezdomni', NULL, 'Stefan Żeromski'),
(11, 'Mitologia', NULL, 'Jan Parandowski'),
(12, 'asdd', NULL, 'das');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211207124944', '2021-12-07 13:50:58', 55),
('DoctrineMigrations\\Version20211213161729', '2021-12-13 17:18:51', 82),
('DoctrineMigrations\\Version20211213164510', '2021-12-13 17:46:04', 94),
('DoctrineMigrations\\Version20211213164943', '2021-12-13 17:50:16', 244),
('DoctrineMigrations\\Version20211213174813', '2021-12-13 18:48:28', 681),
('DoctrineMigrations\\Version20211213194102', '2021-12-13 20:41:31', 163),
('DoctrineMigrations\\Version20211213195548', '2021-12-13 20:55:57', 132),
('DoctrineMigrations\\Version20211213213544', '2021-12-13 22:36:12', 167);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `bname_id` int(11) NOT NULL,
  `taken` date NOT NULL,
  `uemail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `reservations`
--

INSERT INTO `reservations` (`id`, `bname_id`, `taken`, `uemail`) VALUES
(9, 9, '2016-01-01', 2),
(29, 11, '2016-01-01', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$jlOM6huJhpFvntiLIEbVpuTWjgapdHYjuEeEz.WicteLuih/Xbay6'),
(2, 'user1@user.com', '[\"ROLE_USER\"]', '$2y$13$jlOM6huJhpFvntiLIEbVpuTWjgapdHYjuEeEz.WicteLuih/Xbay6'),
(3, 'user2@user.com', '[\"ROLE_USER\"]', '$2y$13$jlOM6huJhpFvntiLIEbVpuTWjgapdHYjuEeEz.WicteLuih/Xbay6');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4DA2391B973B07` (`bname_id`),
  ADD KEY `IDX_4DA239CB9DB6B8` (`uemail`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_4DA2391B973B07` FOREIGN KEY (`bname_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `FK_4DA239CB9DB6B8` FOREIGN KEY (`uemail`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
