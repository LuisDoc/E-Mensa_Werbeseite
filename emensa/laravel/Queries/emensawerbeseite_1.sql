-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 16. Dez 2021 um 14:53
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `emensawerbeseite`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `allergen`
--

CREATE TABLE `allergen` (
  `code` char(4) NOT NULL,
  `name` varchar(300) NOT NULL,
  `typ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `allergen`
--

INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
('a', 'Getreideprodukte', 'Getreide (Gluten)'),
('a1', 'Weizen', 'Allergen'),
('a2', 'Roggen', 'Allergen'),
('a3', 'Gerste', 'Allergen'),
('a4', 'Dinkel', 'Allergen'),
('a5', 'Hafer', 'Allergen'),
('a6', 'Dinkel', 'Allergen'),
('b', 'Fisch', 'Allergen'),
('c', 'Krebstiere', 'Allergen'),
('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
('e', 'Sellerie', 'Allergen'),
('f', 'Milch und Laktose', 'Allergen'),
('f1', 'Butter', 'Allergen'),
('f2', 'Käse', 'Allergen'),
('f3', 'Margarine', 'Allergen'),
('g', 'Sesam', 'Allergen'),
('h', 'Nüsse', 'Allergen'),
('h1', 'Mandeln', 'Allergen'),
('h2', 'Haselnüsse', 'Allergen'),
('h3', 'Walnüsse', 'Allergen'),
('i', 'Erdnüsse', 'Allergen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwort` varchar(200) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `anzahlfehler` int(11) NOT NULL,
  `anzahlanmeldungen` int(11) NOT NULL,
  `letzteanmeldung` datetime DEFAULT NULL,
  `letzterfehler` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `email`, `passwort`, `admin`, `anzahlfehler`, `anzahlanmeldungen`, `letzteanmeldung`, `letzterfehler`) VALUES
(1, 'Nilusche57@gmail.com', '$2y$10$bZ185gHihgJNTeQA0CLL8.Aq/L7DZ4UzNvwPSI6X1f8h5iBmJ5d5G', 0, 0, 0, '2021-12-06 12:09:43', NULL),
(5, 'test@example.com', '$2y$10$p6wBCT7mpYbsEY6f1drZvuCaqSNG0YQzphQR.y5HoZ3jnlXB22mKm', 0, 5, 7, '2021-12-12 02:11:16', '2021-12-12 18:50:35');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ersteller`
--

CREATE TABLE `ersteller` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `ersteller`
--

INSERT INTO `ersteller` (`name`, `email`) VALUES
('nilusche', 'Nilusche29@gmail.com'),
('test', 'Nilusche57@gmail.com'),
('test', 'test@example.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht`
--

CREATE TABLE `gericht` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `beschreibung` varchar(800) NOT NULL,
  `erfasst_am` date NOT NULL,
  `vegetarisch` tinyint(1) NOT NULL,
  `vegan` tinyint(1) NOT NULL,
  `preis_intern` double NOT NULL,
  `preis_extern` double NOT NULL CHECK (`preis_extern` > `preis_intern`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `gericht`
--

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegetarisch`, `vegan`, `preis_intern`, `preis_extern`) VALUES
(4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
(5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
(6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 1, 0, 2.5, 4.5),
(7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
(8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
(9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
(10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
(11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 1, 0, 2, 3),
(12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
(13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 1, 0, 2.5, 4.5),
(14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 1, 0, 3, 5),
(15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
(16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 1, 0, 1, 1.5),
(17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
(18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
(19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 1, 0, 1.25, 1.75),
(20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht_hat_allergen`
--

CREATE TABLE `gericht_hat_allergen` (
  `code` char(4) DEFAULT NULL,
  `gericht_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `gericht_hat_allergen`
--

INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
('a3', 4),
('f1', 4),
('a4', 4),
('h3', 4),
('d', 6),
('h1', 7),
('a2', 7),
('h3', 7),
('c', 7),
('a3', 8),
('h3', 10),
('d', 10),
('f', 10),
('f2', 12),
('h1', 12),
('a5', 12),
('a2', 9),
('i', 14),
('a1', 15),
('a4', 15),
('i', 15),
('f3', 15),
('h3', 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht_hat_kategorie`
--

CREATE TABLE `gericht_hat_kategorie` (
  `gericht_id` bigint(20) NOT NULL,
  `kategorie_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `gericht_hat_kategorie`
--

INSERT INTO `gericht_hat_kategorie` (`gericht_id`, `kategorie_id`) VALUES
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(9, 3),
(16, 4),
(17, 4),
(18, 4),
(16, 5),
(17, 5),
(18, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `id` bigint(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `eltern_id` bigint(20) DEFAULT NULL,
  `bildname` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`id`, `name`, `eltern_id`, `bildname`) VALUES
(2, 'Menus', NULL, 'kat_menu.gif'),
(3, 'Hauptspeisen', 2, 'kat_menu_haupt.bmp'),
(4, 'Vorspeisen', 2, 'kat_menu_vor.svg'),
(5, 'Desserts', 2, 'kat_menu_dessert.pic');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_24_105046_create_table_newsletter', 1),
(6, '2021_11_30_204332_create_ersteller_table', 2),
(7, '2021_11_30_205302_create_wunschgericht_table', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newsletter`
--

CREATE TABLE `newsletter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` enum('german','english') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'german',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `newsletter`
--

INSERT INTO `newsletter` (`id`, `username`, `email`, `language`, `created_at`, `updated_at`) VALUES
(16, 'test', 'test@example.com', 'german', NULL, NULL),
(17, 'test', 'Nilusche29@gmail.com', 'german', NULL, NULL),
(18, 'test', 'Nilusche09@gmail.com', 'german', NULL, NULL),
(19, 'test', 'test@net.com', 'german', NULL, NULL),
(20, 'test', 'test1@example.com', 'german', NULL, NULL),
(21, 'test', 'test1@example1.com', 'german', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wunschgericht`
--

CREATE TABLE `wunschgericht` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gerichtname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beschreibung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `ersteller_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `wunschgericht`
--

INSERT INTO `wunschgericht` (`id`, `gerichtname`, `beschreibung`, `created_at`, `ersteller_email`) VALUES
(2, 'test', 'test', '2021-11-30', 'test@example.com'),
(3, 'Currywurst', 'test', '2021-11-30', 'test@example.com'),
(4, 'curry', 'test', '2021-12-01', 'Nilusche29@gmail.com'),
(5, 'tes', 'tes', '2021-12-01', 'Nilusche57@gmail.com');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `allergen`
--
ALTER TABLE `allergen`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `ersteller`
--
ALTER TABLE `ersteller`
  ADD PRIMARY KEY (`email`);

--
-- Indizes für die Tabelle `gericht`
--
ALTER TABLE `gericht`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `idx_gerichtname` (`name`);

--
-- Indizes für die Tabelle `gericht_hat_allergen`
--
ALTER TABLE `gericht_hat_allergen`
  ADD KEY `gericht_hat_allergen_ibfk_2` (`gericht_id`),
  ADD KEY `code` (`code`);

--
-- Indizes für die Tabelle `gericht_hat_kategorie`
--
ALTER TABLE `gericht_hat_kategorie`
  ADD PRIMARY KEY (`kategorie_id`,`gericht_id`),
  ADD UNIQUE KEY `gericht_id` (`gericht_id`,`kategorie_id`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorie_ibfk_1` (`eltern_id`);

--
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indizes für die Tabelle `wunschgericht`
--
ALTER TABLE `wunschgericht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wunschgericht_ersteller_email_foreign` (`ersteller_email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wunschgericht`
--
ALTER TABLE `wunschgericht`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `gericht_hat_allergen`
--
ALTER TABLE `gericht_hat_allergen`
  ADD CONSTRAINT `gericht_hat_allergen_ibfk_2` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gericht_hat_allergen_ibfk_3` FOREIGN KEY (`code`) REFERENCES `allergen` (`code`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `gericht_hat_kategorie`
--
ALTER TABLE `gericht_hat_kategorie`
  ADD CONSTRAINT `gericht_hat_kategorie_ibfk_1` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gericht_hat_kategorie_ibfk_2` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`);

--
-- Constraints der Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD CONSTRAINT `kategorie_ibfk_1` FOREIGN KEY (`eltern_id`) REFERENCES `kategorie` (`id`);

--
-- Constraints der Tabelle `wunschgericht`
--
ALTER TABLE `wunschgericht`
  ADD CONSTRAINT `wunschgericht_ersteller_email_foreign` FOREIGN KEY (`ersteller_email`) REFERENCES `ersteller` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
