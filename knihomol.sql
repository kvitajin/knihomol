
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `knihomol`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `autor`
--

CREATE TABLE `autor` (
  `id_autor` int(11) NOT NULL,
  `jmeno` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Vypisuji data pro tabulku `autor`
--

INSERT INTO `autor` (`id_autor`, `jmeno`) VALUES
(1, 'asdf');

-- --------------------------------------------------------

--
-- Struktura tabulky `kniha`
--

CREATE TABLE `kniha` (
  `id_kniha` int(11) NOT NULL,
  `nazev` varchar(70) COLLATE utf8_bin NOT NULL,
  `stav` int(11) NOT NULL,
  `ck_id_autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Vypisuji data pro tabulku `kniha`
--

INSERT INTO `kniha` (`id_kniha`, `nazev`, `stav`, `ck_id_autor`) VALUES
(1, 'se poser', 1, 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id_autor`);

--
-- Klíče pro tabulku `kniha`
--
ALTER TABLE `kniha`
  ADD PRIMARY KEY (`id_kniha`),
  ADD KEY `ck_id_autor` (`ck_id_autor`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `autor`
--
ALTER TABLE `autor`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `kniha`
--
ALTER TABLE `kniha`
  MODIFY `id_kniha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `kniha`
--
ALTER TABLE `kniha`
  ADD CONSTRAINT `ck_id_autor` FOREIGN KEY (`ck_id_autor`) REFERENCES `autor` (`id_autor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
