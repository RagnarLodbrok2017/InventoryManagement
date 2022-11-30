-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 04:28 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Football', 'a good category items', NULL, '2022-11-06 17:32:36'),
(2, 'Foods', 'a work of chipsy', NULL, '2022-11-18 19:10:49'),
(7, 'Electronic', 'Electronic devices', '2022-11-18 19:09:11', '2022-11-18 19:09:48'),
(8, 'Laptops', 'Laptops', '2022-11-18 19:10:24', '2022-11-18 19:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` bigint(20) DEFAULT 0,
  `pay_amount` bigint(20) DEFAULT 0,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `email_verified_at`, `password`, `address`, `phone`, `balance`, `pay_amount`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Mohsen', 'ahmedmohsen@gmail.com', NULL, NULL, 'giza st 1200 b 2', '01165856475', 0, 0, 'backend/customer/1668794008.png', NULL, '2022-11-18 15:53:28', '2022-11-18 15:53:28'),
(2, 'Mona moatz', 'mona203@gmail.com', NULL, NULL, 'fayoum st 8941 b 20', '0115678456', 0, 0, 'backend/customer/1668794191.png', NULL, '2022-11-18 15:56:31', '2022-11-18 15:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `address`, `salary`, `joining_date`, `nid`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed ortega', 'ahmedortega@yahoo.com', 'Egypt cairo', '8000', '2022-05-31', '(123) 456-7890', '01156835121', 'backend/employee/1667488491.png', '2022-11-03 13:14:51', '2022-11-03 18:16:57'),
(3, 'Mohamed Tito', 'mohamed@mydomain.com', 'Egypt Giza st 123000', '7000', '2022-10-02', '(123) 456-7890', '01023649593', 'backend/employee/1667506454.png', '2022-11-03 17:03:34', '2022-11-13 15:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `details`, `amount`, `expense_date`, `created_at`, `updated_at`) VALUES
(1, 'Current Bill', 1500, '2022-11-11', '2022-11-12 10:22:28', '2022-11-12 10:58:58'),
(2, 'Computer bill', 6550, '2022-11-12', '2022-11-12 10:42:07', '2022-11-12 10:57:46'),
(3, 'Mars Bill', 2000, '2022-10-19', '2022-11-12 12:54:07', '2022-11-12 11:09:22'),
(4, 'Toy bill', 3200, '2022-11-12', '2022-11-12 10:55:33', '2022-11-12 10:58:05'),
(5, 'Current Bill', 2555, '2022-11-12', '2022-11-12 11:41:54', '2022-11-12 12:24:52'),
(6, 'Current Bill', 1200, '2022-11-12', '2022-11-12 11:44:09', '2022-11-12 11:44:09'),
(7, 'Computer bill', 2400, '2022-11-12', '2022-11-12 11:45:01', '2022-11-12 12:31:47'),
(8, 'Toy bill', 2500, '2022-11-12', '2022-11-12 11:49:41', '2022-11-12 11:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_10_31_164308_create_employees_table', 2),
(5, '2022_11_03_150702_create_employees_table', 3),
(6, '2022_11_03_151248_create_employees_table', 4),
(7, '2022_11_04_161140_create_suppliers_table', 5),
(8, '2022_11_06_151001_create_category_table', 6),
(9, '2022_11_08_174628_create_products_table', 7),
(10, '2022_11_12_105916_create_expenses_table', 8),
(11, '2022_11_12_150243_create_salaries_table', 9),
(12, '2022_11_18_170012_create_customers_table', 10),
(13, '2022_11_19_163152_create_shopping_card_table', 11),
(14, '2022_11_19_181802_create_shopping_card_table', 12),
(15, '2022_11_19_181930_create_shopping_card_table', 13),
(16, '2022_11_19_182521_create_shopping_cart_table', 14),
(17, '2022_11_19_190248_create_shopping_cart_table', 15),
(18, '2022_11_25_151540_create_payment_table', 16),
(19, '2022_11_25_222957_create_orders_table', 17),
(20, '2022_11_25_231014_create_orders_products_table', 18),
(21, '2022_11_26_192310_create_orders_products_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_quantity` int(11) DEFAULT 0,
  `total_payment` int(11) DEFAULT 0,
  `tax` int(11) DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT '2022-11-25',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_quantity`, `total_payment`, `tax`, `discount`, `month`, `year`, `date`, `user_id`, `customer_id`, `payment_id`, `created_at`, `updated_at`) VALUES
(1, 95, 934648, 5, 1, 'November', '2022', '2022-11-26', 1, 1, 1, '2022-11-26 17:25:25', '2022-11-26 17:25:25'),
(2, 95, 943635, 5, 0, 'November', '2022', '2022-11-26', 1, 1, 2, '2022-11-26 17:43:34', '2022-11-26 17:43:34'),
(3, 95, 943635, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 3, '2022-11-26 17:47:57', '2022-11-26 17:47:57'),
(4, 98, 793475, 5, 20, 'November', '2022', '2022-11-26', 1, 1, 5, '2022-11-26 18:00:16', '2022-11-26 18:00:16'),
(5, 98, 980175, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 2, '2022-11-26 18:03:54', '2022-11-26 18:03:54'),
(6, 98, 980175, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 2, '2022-11-26 18:11:25', '2022-11-26 18:11:25'),
(7, 3, 117600, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 2, '2022-11-26 18:17:25', '2022-11-26 18:17:25'),
(8, 2, 126000, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 2, '2022-11-26 18:18:50', '2022-11-26 18:18:50'),
(9, 6, 131460, 5, 0, 'November', '2022', '2022-11-26', 1, 1, 2, '2022-11-26 18:26:14', '2022-11-26 18:26:14'),
(10, 2, 11970, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 1, '2022-11-26 18:30:42', '2022-11-26 18:30:42'),
(11, 3, 117600, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 3, '2022-11-26 18:31:29', '2022-11-26 18:31:29'),
(12, 2, 24360, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 1, '2022-11-26 18:32:29', '2022-11-26 18:32:29'),
(13, 5, 84840, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 2, '2022-11-26 18:34:04', '2022-11-26 18:34:04'),
(14, 2, 22523, 5, 0, 'November', '2022', '2022-11-26', 1, 2, 2, '2022-11-26 18:37:20', '2022-11-26 18:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_payment` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `total_payment`, `quantity`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 2, 1, NULL, NULL),
(2, NULL, NULL, 2, 7, NULL, NULL),
(3, NULL, NULL, 2, 9, NULL, NULL),
(4, NULL, NULL, 2, 2, NULL, NULL),
(5, NULL, NULL, 2, 6, NULL, NULL),
(6, NULL, NULL, 2, 11, NULL, NULL),
(7, NULL, NULL, 2, 8, NULL, NULL),
(8, NULL, NULL, 2, 10, NULL, NULL),
(9, 137900, 14, 4, 1, NULL, NULL),
(10, 150800, 13, 4, 7, NULL, NULL),
(11, 18000, 1, 4, 9, NULL, NULL),
(12, 246000, 41, 4, 2, NULL, NULL),
(13, 75600, 14, 4, 6, NULL, NULL),
(14, 196000, 7, 4, 11, NULL, NULL),
(15, 81200, 7, 4, 8, NULL, NULL),
(16, 28000, 1, 4, 10, NULL, NULL),
(17, 137900, 14, 5, 1, NULL, NULL),
(18, 150800, 13, 5, 7, NULL, NULL),
(19, 18000, 1, 5, 9, NULL, NULL),
(20, 246000, 41, 5, 2, NULL, NULL),
(21, 75600, 14, 5, 6, NULL, NULL),
(22, 196000, 7, 5, 11, NULL, NULL),
(23, 81200, 7, 5, 8, NULL, NULL),
(24, 28000, 1, 5, 10, NULL, NULL),
(25, 137900, 14, 6, 1, NULL, NULL),
(26, 150800, 13, 6, 7, NULL, NULL),
(27, 18000, 1, 6, 9, NULL, NULL),
(28, 246000, 41, 6, 2, NULL, NULL),
(29, 75600, 14, 6, 6, NULL, NULL),
(30, 196000, 7, 6, 11, NULL, NULL),
(31, 81200, 7, 6, 8, NULL, NULL),
(32, 28000, 1, 6, 10, NULL, NULL),
(33, 56000, 1, 7, 12, NULL, NULL),
(34, 28000, 1, 7, 11, NULL, NULL),
(35, 28000, 1, 7, 10, NULL, NULL),
(36, 120000, 2, 8, 13, NULL, NULL),
(37, 56000, 2, 9, 11, NULL, NULL),
(38, 28000, 1, 9, 10, NULL, NULL),
(39, 11600, 1, 9, 8, NULL, NULL),
(40, 18000, 1, 9, 9, NULL, NULL),
(41, 11600, 1, 9, 7, NULL, NULL),
(42, 6000, 1, 10, 2, NULL, NULL),
(43, 5400, 1, 10, 6, NULL, NULL),
(44, 28000, 1, 11, 11, NULL, NULL),
(45, 56000, 1, 11, 12, NULL, NULL),
(46, 28000, 1, 11, 10, NULL, NULL),
(47, 23200, 2, 12, 7, NULL, NULL),
(48, 28000, 1, 13, 11, NULL, NULL),
(49, 18000, 1, 13, 9, NULL, NULL),
(50, 23200, 2, 13, 8, NULL, NULL),
(51, 11600, 1, 13, 7, NULL, NULL),
(52, 11600, 1, 14, 8, NULL, NULL),
(53, 9850, 1, 14, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardDetails` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `type`, `cardDetails`, `created_at`, `updated_at`) VALUES
(1, 'CreditCardPayment', 'CreditCardPayment', '2022-11-25 14:03:46', '2022-11-25 14:03:46'),
(2, 'PayPalPayment', 'PayPalPayment', '2022-11-25 14:04:11', '2022-11-25 14:04:11'),
(3, 'WireTransfer', 'WireTransfer', '2022-11-25 14:04:20', '2022-11-25 14:10:38'),
(4, 'Cash Pay', 'Cash pay', '2022-11-25 14:04:37', '2022-11-25 14:10:59'),
(5, 'Fawry Payment', 'Fawry Payment', '2022-11-25 14:04:55', '2022-11-25 14:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `root` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` bigint(20) DEFAULT 0,
  `selling_price` bigint(20) DEFAULT NULL,
  `buying_date` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) DEFAULT 0,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `root`, `buying_price`, `selling_price`, `buying_date`, `photo`, `quantity`, `supplier_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Ball', '#b1245', 'b1245', 8500, 9850, '2022-11-09', 'backend/product/1668188364.webp', 35, 4, 1, NULL, '2022-11-16 17:22:27'),
(2, 'kranshi', '#254651', 'sa2021', 5000, 6000, '2022-10-31', 'backend/product/1668188376.webp', 214, 4, 2, '2022-11-09 20:02:31', '2022-11-11 15:39:36'),
(6, 'Xiamoi', '#2651', '51515', NULL, 5400, '2022-11-07', 'backend/product/1668806437.jpeg', 123, 1, 7, '2022-11-18 19:20:38', '2022-11-18 19:20:38'),
(7, 'S21 Ultra', '#2643', '6652', NULL, 11600, '2022-11-06', 'backend/product/1668806482.jpeg', 80, 1, 7, '2022-11-18 19:21:22', '2022-11-18 19:21:22'),
(8, 'S22 Ultra', '#2663', '56541', NULL, 11600, '2022-11-06', 'backend/product/1668806522.jpeg', 80, 4, 7, '2022-11-18 19:22:02', '2022-11-18 19:22:02'),
(9, 'Note 10 Ultra', '#2688', '6561', NULL, 18000, '2022-11-06', 'backend/product/1668806552.jpeg', 71, 4, 7, '2022-11-18 19:22:33', '2022-11-18 19:22:33'),
(10, 'Hp pavilion s51', '#3518', '2151', NULL, 28000, '2022-11-06', 'backend/product/1668806606.jpeg', 71, 5, 8, '2022-11-18 19:23:26', '2022-11-18 19:23:26'),
(11, 'HP pavilion b80', '#3517', '5415', NULL, 28000, '2022-11-06', 'backend/product/1668806634.jpeg', 68, 5, 8, '2022-11-18 19:23:54', '2022-11-18 19:23:54'),
(12, 'Lenovo IdeaPad Gaming 3 15', '#38152', '484ss', NULL, 56000, '2022-11-01', 'backend/product/1668806690.jpeg', 68, 5, 8, '2022-11-18 19:24:50', '2022-11-18 19:24:50'),
(13, 'Lenovo IdeaPad Gaming 100', '#38111', '484lap', NULL, 60000, '2022-11-01', 'backend/product/1668806721.jpeg', 50, 5, 8, '2022-11-18 19:25:21', '2022-11-18 19:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT '2022-11-12',
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT 'Base pay',
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `month`, `year`, `amount`, `details`, `date`, `type`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'February', '2022', 9000, NULL, '2022-11-12', 'Base pay', 1, '2022-11-12 16:52:13', '2022-11-14 15:10:06'),
(2, 'March', '2022', 8000, NULL, '2022-11-12', 'Base pay', 1, '2022-11-12 16:53:18', '2022-11-12 16:53:18'),
(3, 'April', '2022', 7000, NULL, '2022-11-12', 'Equity', 1, '2022-11-12 16:54:05', '2022-11-12 16:54:05'),
(7, 'March', '2022', 7000, NULL, '2022-11-13', 'Base pay', 3, '2022-11-13 15:43:23', '2022-11-13 15:43:23'),
(8, 'February', '2022', 7000, NULL, '2022-11-13', 'Equity', 3, '2022-11-13 15:45:12', '2022-11-14 15:09:58'),
(9, 'April', '2022', 7000, NULL, '2022-11-13', 'Commission', 3, '2022-11-13 15:45:31', '2022-11-13 15:45:31'),
(11, 'July', '2022', 8000, NULL, '2022-11-16', 'Base pay', 1, '2022-11-16 16:36:25', '2022-11-16 16:36:25'),
(12, 'June', '2022', 8000, NULL, '2022-11-16', 'Base pay', 1, '2022-11-16 16:36:30', '2022-11-16 16:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `product_price` int(11) DEFAULT 0,
  `total_payment` int(11) DEFAULT 0,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `product_name`, `quantity`, `product_price`, `total_payment`, `product_id`, `customer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(40, 'Lenovo IdeaPad Gaming 100', 2, 60000, 120000, 13, NULL, 3, '2022-11-25 13:04:57', '2022-11-25 13:04:58'),
(42, 'kranshi', 1, 6000, 6000, 2, NULL, 3, '2022-11-25 13:11:53', '2022-11-25 13:11:53'),
(43, 'S22 Ultra', 3, 11600, 34800, 8, NULL, 3, '2022-11-25 13:12:05', '2022-11-25 13:12:06'),
(69, 'kranshi', 9, 6000, 54000, 2, NULL, 1, '2022-11-26 18:37:25', '2022-11-28 17:01:01'),
(70, 'Xiamoi', 1, 5400, 5400, 6, NULL, 1, '2022-11-26 18:37:25', '2022-11-26 18:37:25'),
(71, 'S22 Ultra', 1, 11600, 11600, 8, NULL, 1, '2022-11-26 18:37:26', '2022-11-26 18:37:26'),
(72, 'Hp pavilion s51', 1, 28000, 28000, 10, NULL, 1, '2022-11-26 18:37:28', '2022-11-26 18:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `photo`, `shopname`, `created_at`, `updated_at`) VALUES
(1, 'magda ahmed', 'magda@mydomain.com', '01156568926', 'full street address', 'backend/supplier/1667660990.png', 'Faramawy', '2022-11-04 16:38:32', '2022-11-12 11:06:37'),
(4, 'Mohamed Maro', 'mohamedmaro@gmail.com', '01254587032', 'full street address', 'backend/supplier/1667587683.png', 'Mac', '2022-11-04 16:48:03', '2022-11-12 11:06:27'),
(5, 'Ahmed Yasser', 'ayasser@gmail.com', '01156864123', 'Mdinty Cairo', 'backend/supplier/1668258444.png', 'BrandsHun', '2022-11-12 11:07:24', '2022-11-12 11:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$12$JQnOLosNvFG1Tfoj3rXS9.u805/xHhtfEJD.90QDeOjakAQN3Bl0y', NULL, NULL, NULL),
(2, 'Ahmed Rezk', 'ahmed@admin.com', NULL, '$2y$10$fToLQZcEbERGq56k7w/HOu21sAFYUBovmXvKBsMieABdj5ziWo6F.', NULL, '2022-10-21 15:47:59', '2022-10-21 15:47:59'),
(3, 'Mohamed Rezk', 'mohamed@gmail.com', NULL, '$2y$10$ly6Sp6.JsHTsHOlHQ90Rvu4AzSMp6JeYnO5IP4PDXgtSjMV/5CZfq', NULL, '2022-10-26 15:04:33', '2022-10-26 15:04:33'),
(4, 'ahmed rezk', 'ahmed@yahoo.com', NULL, '$2y$10$oUelRpQ5uCxxVjMnMI9ghOx49c/TmcdkuwHcmfda4QD5.i4VSG1.G', NULL, '2022-10-26 15:20:24', '2022-10-26 15:20:24'),
(5, 'Mahmoud El Nakieb', 'mahmoud@yahoo.com', NULL, '$2y$10$EGiwdZKU0EXyqybNWdrf/.LBz7/aTtmkXJjXyJu0Q7VJayWLvL4e.', NULL, '2022-10-26 15:29:57', '2022-10-26 15:29:57'),
(6, 'Mahmoud Rezkk', 'mahmoud@mahm.com', NULL, '$2y$10$X0.TnecmZLE1aGW5KPrJEuts4C7TkTHc7tn3/hK1EsxHGOUvHiyM6', NULL, '2022-10-26 15:30:54', '2022-10-26 15:30:54'),
(7, 'aaaaaaaaaaaaaaa', 'aaaaaaaa@aaaaa.aaaaaa', NULL, '$2y$10$vcJvNTpuD1W79nD7O3kAbO1v9Vavm7gky6wleE7omtUM7/kIY5sVq', NULL, NULL, NULL),
(8, 'aaaaaaaasssss', 'aaaa@ads.ass', NULL, '$2y$10$MJ.0xK/x43KLm4G2a7o7WeBka3Qtv5SAt6dlSl7RSsI0L.IY3zXdy', NULL, NULL, NULL),
(9, 'asasas1', 'asdasd@sad.asd', NULL, '$2y$10$StObole2/ed6xLRXD.qSi.Js8b0cikVSiF/Z4m6Mc.4jp1hvFZ.jK', NULL, NULL, NULL),
(10, 'asasas1a', 'admin@admi22n.com', NULL, '$2y$10$hL.RTDM9Xm/IWQO7GPFH/.w4ZuZNFwD3BiQvlb3inrvOCXaPvVQ8O', NULL, NULL, NULL),
(11, 'Helal Mohamed', 'ahmedrmohamed@gmaill.com', NULL, '$2y$10$9QyPNU1/n.Yt1IFOWRj62.YZnU/WYn1LO6A1RwHVrPJWop5QA6lQ6', NULL, NULL, NULL),
(12, 'Mohamed Rezkaas', 'admin@assacdmin.com', NULL, '$2y$10$i6H6jTgPXx34Nv8f66MdN.7ydZqKoCme3G0Gkmd1/3sUW.azRvh9W', NULL, NULL, NULL),
(13, 'adminsssc', 'admasdin@admin.admin', NULL, '$2y$10$.wmG85Vr4OOaMfvBt888yujgTlIaAHxroQWChOSnyJ5MEu3lAvZKS', NULL, NULL, NULL),
(14, 'Mohamed Rezkssc', 'mohamed2020@gmail.com', NULL, '$2y$10$zxwWlhUKdSUAqdVtThJfzuHPe2E/6k2plW2eoNICn5ZekPbmPsxk.', NULL, NULL, NULL),
(15, 'maged mohamed', 'maged20320@yahoo.com', NULL, '$2y$10$18NojxyoSIfIONqJVBeEBeJTTrHUA4sFSf6FinNiJBFBqyStpbNXi', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_products_order_id_foreign` (`order_id`),
  ADD KEY `orders_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salaries_employee_id_month_unique` (`employee_id`,`month`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_cart_product_id_foreign` (`product_id`),
  ADD KEY `shopping_cart_customer_id_foreign` (`customer_id`),
  ADD KEY `shopping_cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shopping_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
