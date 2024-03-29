SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ragnarok`
--

-- --------------------------------------------------------

--
-- Table structure for table `crypto_invoice`
--

CREATE TABLE `crypto_invoice` (
  `id` bigint(20) NOT NULL,
  `account_id` int(11) DEFAULT 0,
  `invoice` varchar(250) DEFAULT NULL,
  `order_id` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `amount` decimal(20,8) NOT NULL DEFAULT 0.00000000,
  `amount_in_coin` decimal(20,8) DEFAULT 0.00000000,
  `amount_credits` decimal(20,8) DEFAULT 0.00000000,
  `currency` varchar(20) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `batch` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crypto_invoice`
--
ALTER TABLE `crypto_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crypto_invoice`
--
ALTER TABLE `crypto_invoice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
