-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 14, 2023 alle 15:02
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_ititv`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Svuota la tabella prima dell'inserimento `tbladmin`
--

TRUNCATE TABLE `tbladmin`;
--
-- Dump dei dati per la tabella `tbladmin`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Svuota la tabella prima dell'inserimento `tblcategory`
--

TRUNCATE TABLE `tblcategory`;
--
-- Dump dei dati per la tabella `tblcategory`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Svuota la tabella prima dell'inserimento `tblcomments`
--

TRUNCATE TABLE `tblcomments`;
--
-- Dump dei dati per la tabella `tblcomments`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tblmail`
--


--
-- Svuota la tabella prima dell'inserimento `tblmail`
--

TRUNCATE TABLE `tblmail`;
--
-- Dump dei dati per la tabella `tblmail`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tblmaildest`
--

CREATE TABLE `tblmaildest` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Svuota la tabella prima dell'inserimento `tblmaildest`
--

TRUNCATE TABLE `tblmaildest`;
--
-- Dump dei dati per la tabella `tblmaildest`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Svuota la tabella prima dell'inserimento `tblpages`
--

TRUNCATE TABLE `tblpages`;
--
-- Dump dei dati per la tabella `tblpages`
--
------------------------------------------------------

--
-- Struttura della tabella `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `PostAltDet` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Svuota la tabella prima dell'inserimento `tblposts`
--

TRUNCATE TABLE `tblposts`;
--
-- Dump dei dati per la tabella `tblposts`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Svuota la tabella prima dell'inserimento `tblsubcategory`
--

TRUNCATE TABLE `tblsubcategory`;
--
-- Dump dei dati per la tabella `tblsubcategory`
--

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `AdminUserName` (`AdminUserName`);

--
-- Indici per le tabelle `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `id` (`id`);

--
-- Indici per le tabelle `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indici per le tabelle `tblmail`
--
ALTER TABLE `tblmail`
  ADD UNIQUE KEY `emailSender` (`emailSender`);

--
-- Indici per le tabelle `tblmaildest`
--
ALTER TABLE `tblmaildest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_2` (`id`);

--
-- Indici per le tabelle `tblpages`
--
ALTER TABLE `tblpages`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- Indici per le tabelle `tblposts`
--
ALTER TABLE `tblposts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indici per le tabelle `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD UNIQUE KEY `SubCategoryId` (`SubCategoryId`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `tblmaildest`
--
ALTER TABLE `tblmaildest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
