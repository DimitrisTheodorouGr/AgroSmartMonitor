-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 29 Σεπ 2023 στις 14:38:36
-- Έκδοση διακομιστή: 10.4.16-MariaDB
-- Έκδοση PHP: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `farm_db2`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `jobs`
--

CREATE TABLE `jobs` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(30) DEFAULT NULL,
  `J_TIMESTAMP` date DEFAULT NULL,
  `J_STATUS` varchar(30) DEFAULT NULL,
  `ERGERNCY` varchar(30) DEFAULT NULL,
  `ID_AFM` varchar(10) DEFAULT NULL,
  `NOTE` text DEFAULT NULL,
  `ID_PARCEL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `job_uses_product`
--

CREATE TABLE `job_uses_product` (
  `ID_PRODUCT` int(11) NOT NULL,
  `ID_JOBS` int(11) NOT NULL,
  `AMOUNT` int(11) DEFAULT NULL,
  `COST` float DEFAULT NULL,
  `ID_PARCEL` int(11) DEFAULT NULL,
  `TOTAL_COST` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `parcel`
--

CREATE TABLE `parcel` (
  `ID` int(11) NOT NULL,
  `LAT_R_U` varchar(30) DEFAULT NULL,
  `LON_R_U` varchar(30) DEFAULT NULL,
  `LAT_R_D` varchar(30) DEFAULT NULL,
  `LON_R_D` varchar(30) DEFAULT NULL,
  `LAT_L_U` varchar(30) DEFAULT NULL,
  `LON_L_U` varchar(30) DEFAULT NULL,
  `LAT_L_D` varchar(30) DEFAULT NULL,
  `LON_L_D` varchar(30) DEFAULT NULL,
  `LOCATION` varchar(40) DEFAULT NULL,
  `CROP` varchar(30) DEFAULT NULL,
  `ID_AFM2` varchar(10) DEFAULT NULL,
  `MORGEN` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `person`
--

CREATE TABLE `person` (
  `ID_AFM` varchar(10) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `SURNAME` varchar(30) NOT NULL,
  `COMPANY_NAME` varchar(30) DEFAULT NULL,
  `TYPE_OF_BUSSNESS` varchar(50) NOT NULL,
  `PHONE` varchar(10) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `CITY` varchar(30) NOT NULL,
  `ADDRESS` varchar(30) NOT NULL,
  `TK` varchar(5) NOT NULL,
  `DOY` varchar(30) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `CITYID_OWA` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `person_has_sensor`
--

CREATE TABLE `person_has_sensor` (
  `ID_DEV` varchar(30) DEFAULT NULL,
  `ID_P` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `DESCRIPTION` longtext DEFAULT NULL,
  `COMPANY` varchar(50) DEFAULT NULL,
  `PRICE` float DEFAULT NULL,
  `CROP_USED_IN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `sensor`
--

CREATE TABLE `sensor` (
  `ID_DEVICE` varchar(30) NOT NULL,
  `TYPE` varchar(10) DEFAULT NULL,
  `LONGITUDE` varchar(30) DEFAULT NULL,
  `LATITUDE` varchar(30) DEFAULT NULL,
  `LAST_ACTIVE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `s_values`
--

CREATE TABLE `s_values` (
  `ID_V` int(11) NOT NULL,
  `DEVICE` varchar(30) DEFAULT NULL,
  `QUALITY_OF_V` varchar(30) NOT NULL,
  `HUMIDITY_AIR` float DEFAULT NULL,
  `TEMPERATURE_AIR` float DEFAULT NULL,
  `MOISTURE_GRD` float DEFAULT NULL,
  `TEMPERATURE_GRD_50CM` float DEFAULT NULL,
  `TEMPERATURE_GRD_100CM` float DEFAULT NULL,
  `LEAF_WEATNESS` float DEFAULT NULL,
  `PHOTOSENSOR` float DEFAULT NULL,
  `ATMOPHERIC_PRESSURE` float DEFAULT NULL,
  `BATTERY` float DEFAULT NULL,
  `WIND_SPEED` float DEFAULT NULL,
  `WIND_DIRECTION` float DEFAULT NULL,
  `RAIN_SENSOR` float DEFAULT NULL,
  `V_Timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_AFM` (`ID_AFM`),
  ADD KEY `ID_PARCEL` (`ID_PARCEL`);

--
-- Ευρετήρια για πίνακα `job_uses_product`
--
ALTER TABLE `job_uses_product`
  ADD KEY `ID_PRODUCT` (`ID_PRODUCT`),
  ADD KEY `ID_JOBS` (`ID_JOBS`),
  ADD KEY `ID_PARCEL` (`ID_PARCEL`);

--
-- Ευρετήρια για πίνακα `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_AFM2` (`ID_AFM2`);

--
-- Ευρετήρια για πίνακα `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`ID_AFM`);

--
-- Ευρετήρια για πίνακα `person_has_sensor`
--
ALTER TABLE `person_has_sensor`
  ADD KEY `ID_DEV` (`ID_DEV`),
  ADD KEY `ID_P` (`ID_P`);

--
-- Ευρετήρια για πίνακα `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Ευρετήρια για πίνακα `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`ID_DEVICE`);

--
-- Ευρετήρια για πίνακα `s_values`
--
ALTER TABLE `s_values`
  ADD PRIMARY KEY (`ID_V`),
  ADD KEY `DEVICE` (`DEVICE`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `jobs`
--
ALTER TABLE `jobs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `parcel`
--
ALTER TABLE `parcel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `s_values`
--
ALTER TABLE `s_values`
  MODIFY `ID_V` int(11) NOT NULL AUTO_INCREMENT;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`ID_AFM`) REFERENCES `person` (`ID_AFM`),
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`ID_PARCEL`) REFERENCES `parcel` (`ID`);

--
-- Περιορισμοί για πίνακα `job_uses_product`
--
ALTER TABLE `job_uses_product`
  ADD CONSTRAINT `job_uses_product_ibfk_1` FOREIGN KEY (`ID_PRODUCT`) REFERENCES `product` (`ID`),
  ADD CONSTRAINT `job_uses_product_ibfk_2` FOREIGN KEY (`ID_JOBS`) REFERENCES `jobs` (`ID`),
  ADD CONSTRAINT `job_uses_product_ibfk_3` FOREIGN KEY (`ID_PARCEL`) REFERENCES `parcel` (`ID`);

--
-- Περιορισμοί για πίνακα `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`ID_AFM2`) REFERENCES `person` (`ID_AFM`);

--
-- Περιορισμοί για πίνακα `person_has_sensor`
--
ALTER TABLE `person_has_sensor`
  ADD CONSTRAINT `person_has_sensor_ibfk_1` FOREIGN KEY (`ID_DEV`) REFERENCES `sensor` (`ID_DEVICE`),
  ADD CONSTRAINT `person_has_sensor_ibfk_2` FOREIGN KEY (`ID_P`) REFERENCES `person` (`ID_AFM`);

--
-- Περιορισμοί για πίνακα `s_values`
--
ALTER TABLE `s_values`
  ADD CONSTRAINT `s_values_ibfk_1` FOREIGN KEY (`DEVICE`) REFERENCES `sensor` (`ID_DEVICE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
