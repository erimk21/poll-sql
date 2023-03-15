-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 mrt 2023 om 13:02
-- Serverversie: 10.4.25-MariaDB
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poll`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `optie`
--

CREATE TABLE `optie` (
  `id` int(3) NOT NULL,
  `poll` int(3) NOT NULL,
  `optie` varchar(255) NOT NULL,
  `stemmen` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `optie`
--

INSERT INTO `optie` (`id`, `poll`, `optie`, `stemmen`) VALUES
(1, 1, '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pol`
--

CREATE TABLE `pol` (
  `id` int(3) NOT NULL,
  `vraag` varchar(255) NOT NULL,
  `stem1` int(255) NOT NULL,
  `stem2` int(255) NOT NULL,
  `stem3` int(11) NOT NULL,
  `stem4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `pol`
--

INSERT INTO `pol` (`id`, `vraag`, `stem1`, `stem2`, `stem3`, `stem4`) VALUES
(1, '', 3, 3, 4, 3),
(2, '', 3, 3, 4, 3);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `optie`
--
ALTER TABLE `optie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `pol`
--
ALTER TABLE `pol`
  ADD PRIMARY KEY (`id`,`vraag`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `optie`
--
ALTER TABLE `optie`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `pol`
--
ALTER TABLE `pol`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
