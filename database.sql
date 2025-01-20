-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `image`) VALUES
(21,	'Bahrajnský Duel: Hamilton a Verstappen Zahajují Sezónu v Stylu',	'První závod sezóny Formule 1...',	'2021-03-28 00:00:00',	'upload/bahrajn.jpeg'),
(22,	'Drama v Imole: Verstappenův Deštivý Den Slávy',	'Grand Prix Emilia-Romagna 2021...',	'2021-04-18 00:00:00',	'upload/imola.jpeg'),
(24,	'\"Hamiltonova Dominance v Portimão: Detailní Pohled na Grand Prix Portugalska 2021\"',	'Grand Prix Portugalska 2021...',	'2021-05-02 00:00:00',	'upload/portugalsko.jpeg'),
(25,	'Hamilton vs. Verstappen: Souboj Strategií na Španělské Grand Prix',	'Grand Prix Španělska 2021...',	'2021-05-09 00:00:00',	'upload/spanelsko.jpeg'),
(26,	'Změna Stráží v Monaku: Verstappen Přebírá Vedení v Šampionátu',	'Grand Prix Monaka 2021...',	'2021-05-23 00:00:00',	'upload/monako.jpeg'),
(27,	'Pérezovo První Vítězství u Red Bullu: Dramatická Grand Prix Ázerbájdžánu 2021',	'Grand Prix Ázerbájdžánu 2021...',	'2021-06-06 00:00:00',	'upload/azerbaijan.jpeg'),
(28,	'Red Bull versus Mercedes: Souboj Strategií na Francouzském Okruhu',	'Grand Prix Francie 2021...',	'2021-06-20 00:00:00',	'upload/francie.jpeg'),
(29,	'Verstappenova Show na Red Bull Ringu: Dominance na Domácím Okruhu',	'Grand Prix Štýrska 2021...',	'2021-06-27 00:00:00',	'upload/styrsko.jpeg'),
(30,	'Red Bull Ring, Red Bull King: Verstappen Dominuje i Druhý Rakouský Závod',	'Grand Prix Rakouska 2021...',	'2021-07-04 00:00:00',	'upload/rakousko.jpeg'),
(31,	'Drama Na Domácí Půdě: Hamiltonova Kontroverzní Cesta K Vítězství na Silverstone',	'Grand Prix Velké Británie 2021...',	'2021-07-18 00:00:00',	'upload/britanie.webp'),
(32,	'Oconův První Triumf: Překvapivé Vítězství v Chaotickém Závodě v Maďarsku',	'Grand Prix Maďarska 2021...',	'2021-08-01 00:00:00',	'upload/madarsko.jpeg'),
(33,	'Plavba ve Spa: Verstappen a Russell Zazářili v Deštivém Chaosu',	'Grand Prix Belgie 2021...',	'2021-08-29 00:00:00',	'upload/belgie.jpeg'),
(34,	'Nizozemský Triumf: Verstappen Ovládl Zandvoort',	'Grand Prix Nizozemska 2021...',	'2021-09-05 00:00:00',	'upload/nizozemsko.jpeg'),
(35,	'Kolize Titánů v Monze: Ricciardo vede historické dvojité vítězství v Itálii Ricciardo vyhrává',	'Grand Prix Itálie 2021...',	'2021-09-12 00:00:00',	'upload/italie.webp'),
(36,	'Hamiltonův Historický Moment: 100 Vítězství v Grand Prix Ruska',	'Grand Prix Ruska 2021...',	'2021-09-26 00:00:00',	'upload/rusko.jpeg');

-- 2025-01-20 12:57:15
