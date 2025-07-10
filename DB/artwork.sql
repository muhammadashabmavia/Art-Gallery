-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 11:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artwork`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ClearPurchaseStatus` ()  BEGIN
    -- Update the purchase status to 'Clear' for purchases with a status of 'Pending'
    UPDATE purchase
    SET p_status = 'Cleared'
    WHERE p_status = 'Pending'
      AND TIMESTAMPDIFF(SECOND, purchase_date, NOW()) >= 300; -- 300 seconds = 5 minutes
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CART_ID` int(5) UNSIGNED NOT NULL,
  `Artwork_ID` int(5) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CAT_ID` int(5) UNSIGNED NOT NULL,
  `Cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CAT_ID`, `Cat_name`) VALUES
(0, 'Illustration'),
(1, 'Design'),
(2, 'Painting'),
(3, '3d'),
(4, 'Arts'),
(5, 'Minimal'),
(6, 'Abstract'),
(7, 'Oil Painting'),
(8, 'psd');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `method_ID` int(5) UNSIGNED NOT NULL,
  `Method_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`method_ID`, `Method_Name`) VALUES
(1, 'Card'),
(2, 'Payoneer');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_ID` int(5) UNSIGNED NOT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `method_id` int(5) UNSIGNED DEFAULT NULL,
  `p_email` varchar(50) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `p_status` varchar(20) DEFAULT NULL,
  `p_country` varchar(20) DEFAULT NULL,
  `Artwork_ID` int(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Purchase_ID`, `purchase_price`, `method_id`, `p_email`, `purchase_date`, `p_status`, `p_country`, `Artwork_ID`) VALUES
(30, '70.00', 2, 'rafiahasan76@gmail.com', '2024-01-09 13:17:50', 'Cleared', 'Pakistan', 22),
(37, '20.00', 2, 'rafia@gmail.com', '2024-01-10 12:17:56', 'Cleared', 'Pakistan', 32),
(38, '90.00', 2, 'Huzaifa1@gmail.com', '2024-01-10 12:18:37', 'Cleared', 'Pakistan', 27),
(39, '25.00', 2, 'Huzaifa1@gmail.com', '2024-01-10 12:18:37', 'Cleared', 'Pakistan', 28),
(40, '70.00', 2, 'Huzaifa1@gmail.com', '2024-01-10 12:18:37', 'Cleared', 'Pakistan', 31),
(41, '70.00', 2, 'rafiahasan76@gmail.com', '2024-01-10 12:35:23', 'Cleared', 'Pakistan', 31),
(42, '990.00', 2, 'jimmdav4@gmail.com', '2024-01-10 17:18:40', 'Pending', 'Pakistan', 35),
(43, '990.00', 1, 'jimmdav4@gmail.com', '2024-01-10 17:43:40', 'Pending', 'Pakistan', 35);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `SELLER_ID` int(5) UNSIGNED NOT NULL,
  `First_Name` varchar(20) DEFAULT NULL,
  `Last_Name` varchar(20) DEFAULT NULL,
  `Seller_Password` varchar(8) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Profile_Pic` longblob DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `cnic` varchar(13) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `registered_at` date DEFAULT curdate(),
  `isAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SELLER_ID`, `First_Name`, `Last_Name`, `Seller_Password`, `Address`, `Email`, `Profile_Pic`, `dateofbirth`, `country`, `username`, `cnic`, `city`, `registered_at`, `isAdmin`) VALUES
(1, 'Umair', 'Ahmed', 'Umair112', 'near karachi bakary', 'umairahmed44990@gmail.com', 0x433a78616d70706874646f637344424d532d6d617374657244424d532d6d6173746572617373657473696d6167657361736861622e6a7067, '2000-10-07', 'Pakistan', 'umairnft', '2147483647', 'karachi', NULL, NULL),
(2, NULL, NULL, '$2y$10$8', NULL, 'umair@gmail.com', NULL, NULL, NULL, 'Umair', NULL, NULL, NULL, NULL),
(4, NULL, NULL, '$2y$10$w', NULL, 'rafiaa@gmail.com', NULL, NULL, NULL, 'rafiaaaaaa', NULL, NULL, NULL, NULL),
(8, NULL, NULL, 'admin123', NULL, 'admin@gmail.com', NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, 1),
(10, NULL, NULL, 'Ashab123', NULL, 'Ashab@gmail.com', NULL, NULL, NULL, 'Ashab', NULL, NULL, NULL, NULL),
(18, NULL, NULL, 'umair990', NULL, 'umairahmed44990@gmail.com', NULL, NULL, NULL, 'Umair Ahmed', NULL, NULL, '2024-01-05', 0),
(19, NULL, NULL, '321', NULL, 'rafiahasan76@gmail.com', NULL, NULL, NULL, 'rafiahasan', NULL, NULL, '2024-01-09', 0),
(20, NULL, NULL, '12345', NULL, 'areeba12@gmail.com', NULL, NULL, NULL, 'areeba_ahmed', NULL, NULL, '2024-01-10', 0),
(21, NULL, NULL, '123456', NULL, 'syedashab80@gmail.com', NULL, NULL, NULL, 'muhammadashab80', NULL, NULL, '2024-01-11', 0);

--
-- Triggers `seller`
--
DELIMITER $$
CREATE TRIGGER `seller_insert` BEFORE INSERT ON `seller` FOR EACH ROW BEGIN
    DECLARE userCount INT;

    -- Check if the email already exists
    SELECT COUNT(*) INTO userCount FROM seller WHERE email = NEW.email;

    -- If the email already exists, raise an error
    IF userCount > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'User with this email is already registered.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `uploadartwork`
--

CREATE TABLE `uploadartwork` (
  `Artwork_ID` int(5) UNSIGNED NOT NULL,
  `a_name` varchar(50) NOT NULL,
  `a_price` decimal(10,2) DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Cat_ID` int(5) UNSIGNED DEFAULT NULL,
  `a_decs` longtext DEFAULT NULL,
  `a_status` varchar(20) DEFAULT NULL,
  `Seller_ID` int(5) UNSIGNED DEFAULT NULL,
  `a_image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploadartwork`
--

INSERT INTO `uploadartwork` (`Artwork_ID`, `a_name`, `a_price`, `upload_date`, `Cat_ID`, `a_decs`, `a_status`, `Seller_ID`, `a_image`) VALUES
(22, 'Woman Face art', '70.00', '2024-01-09 17:14:48', 6, 'Abstract geometric woman face art', 'Rejected', 19, 0x616273747261637420776f6d616e206172742e6a7067),
(23, 'Woman', '24.00', '2024-01-10 09:21:08', 3, 'woman illustration ', 'Published', 19, 0x776f6d616e2e6a706567),
(26, 'cowboy', '80.00', '2024-01-10 10:56:48', 0, 'vector art', 'Published', 19, 0x766563746f722e6a7067),
(27, 'Abstract Art', '90.00', '2024-01-10 14:58:43', 6, 'Abstract vector woman face', 'Published', 19, 0x776f6d616e2d696c6c757374726174696f6e322e6a7067),
(28, 'Abstract Flamingo wall art', '25.00', '2024-01-10 15:49:01', 6, 'vector geometric abstract art of flamingo in pink color', 'Published', 19, 0x61627374726163742d6172742d666c616d696e676f342e6a7067),
(29, 'Botanical Wall art', '45.00', '2024-01-10 15:49:37', 5, 'Minimal botanical wall art design', 'Published', 19, 0x77616c6c617274312e6a7067),
(30, 'illustration of woman', '50.00', '2024-01-10 15:50:19', 4, 'abstract vector art of woman face', 'Published', 19, 0x61627374726163742d6172742d776f6d616e2d666163652e6a7067),
(31, 'geometric art', '70.00', '2024-01-10 15:57:49', 1, 'abstract geometric woman art', 'Published', 20, 0x61627374726163742d776f6d616e2d6172742e6a7067),
(32, 'Panda', '20.00', '2024-01-10 16:01:33', 0, 'Panda illustration', 'Published', 20, 0x61627374726163742d6172742d70616e6461332e6a7067),
(33, 'Forest', '30.00', '2024-01-10 16:13:19', 8, 'Vector forest at night time', 'Published', 18, 0x666f726573742e6a7067),
(34, 'Man logo', '70.00', '2024-01-10 16:14:10', 4, 'vector man face logo art', 'Published', 18, 0x61627374726163742d6d616e2d666163652e6a7067),
(35, 'Forest animal with tent', '990.00', '2024-01-10 21:15:54', 3, 'Remember to mention the author and the source when using this image. Copy the attribution details below and include them on your project or website.', 'Published', 21, 0x33642d72656e646572696e672d666f726573742d616e696d616c2d776974682d74656e742e6a7067),
(36, 'Rendering of inspirational mood board', '100.00', '2024-01-10 21:45:08', 4, 'Remember to mention the author and the source when using this image. Copy the attribution details below and include them on your project or website.', 'Published', 21, 0x72656e646572696e672d696e737069726174696f6e616c2d6d6f6f642d626f6172642e6a7067);

--
-- Triggers `uploadartwork`
--
DELIMITER $$
CREATE TRIGGER `before_artwork_insert` BEFORE INSERT ON `uploadartwork` FOR EACH ROW BEGIN
    DECLARE artworkCount INT;
    DECLARE artworkStatus VARCHAR(255); -- Added variable to store artwork status

    -- Check if the artwork with the same name and category exists
    SELECT COUNT(*) INTO artworkCount 
    FROM uploadartwork 
    WHERE a_name = NEW.a_name AND CAT_ID = NEW.CAT_ID;

    -- If the artwork exists and has a status of 'published' or 'under revision', raise an error
    IF artworkCount > 0 THEN
        SELECT a_status INTO artworkStatus
        FROM uploadartwork 
        WHERE a_name = NEW.a_name AND CAT_ID = NEW.CAT_ID
        ORDER BY Artwork_ID DESC
        LIMIT 1;

        IF artworkStatus = 'published' THEN
            SET @errorMsg = 'Artwork with this name and category is already published.';
        ELSEIF artworkStatus = 'under revision' THEN
            SET @errorMsg = 'Artwork with this name and category is under revision.';
        END IF;

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = @errorMsg;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CART_ID`),
  ADD KEY `Cart_art_id_FK` (`Artwork_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`method_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_ID`),
  ADD KEY `Purchase_method_id_FK` (`method_id`),
  ADD KEY `Purchase_CART_ID_FK` (`Artwork_ID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SELLER_ID`);

--
-- Indexes for table `uploadartwork`
--
ALTER TABLE `uploadartwork`
  ADD PRIMARY KEY (`Artwork_ID`),
  ADD KEY `uploadartwork_seller_id_FK` (`Seller_ID`),
  ADD KEY `uploadartwork_cat_id_FK` (`Cat_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CART_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Purchase_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `SELLER_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `uploadartwork`
--
ALTER TABLE `uploadartwork`
  MODIFY `Artwork_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Cart_art_id_FK` FOREIGN KEY (`Artwork_ID`) REFERENCES `uploadartwork` (`Artwork_ID`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `Purchase_CART_ID_FK` FOREIGN KEY (`Artwork_ID`) REFERENCES `uploadartwork` (`Artwork_ID`),
  ADD CONSTRAINT `Purchase_method_id_FK` FOREIGN KEY (`method_id`) REFERENCES `payment_method` (`method_ID`);

--
-- Constraints for table `uploadartwork`
--
ALTER TABLE `uploadartwork`
  ADD CONSTRAINT `uploadartwork_cat_id_FK` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`CAT_ID`),
  ADD CONSTRAINT `uploadartwork_seller_id_FK` FOREIGN KEY (`Seller_ID`) REFERENCES `seller` (`SELLER_ID`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `ClearPurchaseStatusEvent` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-01-10 16:16:59' ON COMPLETION NOT PRESERVE ENABLE DO CALL ClearPurchaseStatus()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
