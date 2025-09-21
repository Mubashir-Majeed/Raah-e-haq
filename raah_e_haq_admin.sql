-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2025 at 11:44 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raah_e_haq_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics_events`
--

CREATE TABLE `analytics_events` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_properties` json DEFAULT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PKR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analytics_events`
--

INSERT INTO `analytics_events` (`id`, `user_id`, `event_type`, `event_category`, `event_name`, `event_properties`, `page_url`, `referrer`, `ip_address`, `user_agent`, `session_id`, `value`, `currency`, `created_at`, `updated_at`) VALUES
(1, 1, 'ride_request', 'conversion', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '30.21.120.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_912594', NULL, 'PKR', '2025-09-13 11:13:02', '2025-09-17 08:13:02'),
(2, 1, 'payment_made', 'engagement', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '89.162.254.148', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_819693', 390.00, 'PKR', '2025-09-12 20:13:02', '2025-09-17 08:13:02'),
(3, 1, 'ride_request', 'performance', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '173.33.15.250', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_482310', NULL, 'PKR', '2025-08-31 12:13:02', '2025-09-17 08:13:02'),
(4, 3, 'driver_verification', 'engagement', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '143.87.108.148', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_846109', NULL, 'PKR', '2025-09-12 01:13:02', '2025-09-17 08:13:02'),
(5, 3, 'page_view', 'business_metrics', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '63.127.244.225', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_320226', NULL, 'PKR', '2025-09-13 20:13:02', '2025-09-17 08:13:02'),
(6, 3, 'page_view', 'performance', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '196.60.104.5', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_399203', NULL, 'PKR', '2025-09-16 10:13:02', '2025-09-17 08:13:02'),
(7, 3, 'button_click', 'business_metrics', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '179.77.141.168', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_508692', NULL, 'PKR', '2025-09-08 06:13:02', '2025-09-17 08:13:02'),
(8, 1, 'user_registration', 'user_behavior', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '73.100.83.65', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_900976', NULL, 'PKR', '2025-08-24 18:13:02', '2025-09-17 08:13:02'),
(9, 1, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '85.214.174.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_820091', NULL, 'PKR', '2025-08-19 13:13:02', '2025-09-17 08:13:02'),
(10, 1, 'user_registration', 'engagement', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '66.78.67.155', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_608169', NULL, 'PKR', '2025-08-20 22:13:02', '2025-09-17 08:13:02'),
(11, 2, 'user_registration', 'performance', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '148.136.120.16', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_422696', NULL, 'PKR', '2025-09-10 06:13:02', '2025-09-17 08:13:02'),
(12, 2, 'user_registration', 'engagement', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '102.86.19.47', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_529571', NULL, 'PKR', '2025-08-22 13:13:02', '2025-09-17 08:13:02'),
(13, 2, 'driver_verification', 'engagement', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '11.102.207.97', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_783752', NULL, 'PKR', '2025-08-30 13:13:02', '2025-09-17 08:13:02'),
(14, 1, 'user_registration', 'performance', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '111.160.74.160', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_239343', NULL, 'PKR', '2025-09-07 13:13:02', '2025-09-17 08:13:02'),
(15, 1, 'ride_request', 'business_metrics', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '87.61.89.150', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_120201', NULL, 'PKR', '2025-09-15 19:13:02', '2025-09-17 08:13:02'),
(16, 2, 'ride_request', 'performance', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '141.225.208.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_448716', NULL, 'PKR', '2025-08-23 02:13:02', '2025-09-17 08:13:02'),
(17, 3, 'form_submit', 'business_metrics', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '24.164.16.197', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_114400', NULL, 'PKR', '2025-08-17 19:13:02', '2025-09-17 08:13:02'),
(18, 2, 'payment_made', 'user_behavior', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '235.164.143.176', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_344277', 1112.00, 'PKR', '2025-08-28 14:13:02', '2025-09-17 08:13:02'),
(19, 2, 'form_submit', 'user_behavior', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '183.133.145.214', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_271612', NULL, 'PKR', '2025-09-04 21:13:02', '2025-09-17 08:13:02'),
(20, 1, 'payment_made', 'engagement', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '229.144.191.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_835916', 555.00, 'PKR', '2025-08-20 07:13:02', '2025-09-17 08:13:02'),
(21, 1, 'form_submit', 'engagement', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '41.65.76.43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_997070', NULL, 'PKR', '2025-08-26 17:13:02', '2025-09-17 08:13:02'),
(22, 2, 'page_view', 'user_behavior', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '119.201.82.182', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_961510', NULL, 'PKR', '2025-08-25 13:13:02', '2025-09-17 08:13:02'),
(23, 3, 'ride_complete', 'business_metrics', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '235.126.39.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_589335', NULL, 'PKR', '2025-08-25 07:13:02', '2025-09-17 08:13:02'),
(24, 3, 'page_view', 'business_metrics', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '87.99.118.119', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_646216', NULL, 'PKR', '2025-09-09 23:13:02', '2025-09-17 08:13:02'),
(25, 1, 'page_view', 'business_metrics', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '61.155.211.143', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_778602', NULL, 'PKR', '2025-09-12 23:13:02', '2025-09-17 08:13:02'),
(26, 1, 'ride_request', 'conversion', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '95.167.126.57', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_657415', NULL, 'PKR', '2025-08-19 17:13:02', '2025-09-17 08:13:02'),
(27, 3, 'user_registration', 'conversion', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '189.113.89.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_748213', NULL, 'PKR', '2025-08-24 09:13:02', '2025-09-17 08:13:02'),
(28, 3, 'page_view', 'performance', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '21.60.10.162', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_407153', NULL, 'PKR', '2025-09-12 09:13:02', '2025-09-17 08:13:02'),
(29, 2, 'ride_complete', 'user_behavior', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '55.1.35.200', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_727592', NULL, 'PKR', '2025-09-06 14:13:03', '2025-09-17 08:13:03'),
(30, 2, 'button_click', 'user_behavior', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '212.233.79.57', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_405242', NULL, 'PKR', '2025-09-09 22:13:03', '2025-09-17 08:13:03'),
(31, 3, 'page_view', 'business_metrics', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '218.116.76.244', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_430312', NULL, 'PKR', '2025-08-30 03:13:03', '2025-09-17 08:13:03'),
(32, 1, 'user_registration', 'conversion', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '177.62.152.89', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_464127', NULL, 'PKR', '2025-09-16 15:13:03', '2025-09-17 08:13:03'),
(33, 1, 'ride_request', 'engagement', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '155.106.60.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_397794', NULL, 'PKR', '2025-08-29 13:13:03', '2025-09-17 08:13:03'),
(34, 1, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '79.47.53.221', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_935028', NULL, 'PKR', '2025-08-23 11:13:03', '2025-09-17 08:13:03'),
(35, 1, 'button_click', 'engagement', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '11.237.97.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_573711', NULL, 'PKR', '2025-08-31 04:13:03', '2025-09-17 08:13:03'),
(36, 2, 'payment_made', 'business_metrics', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '58.240.249.98', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_275212', 1868.00, 'PKR', '2025-09-11 09:13:03', '2025-09-17 08:13:03'),
(37, 1, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '5.62.105.94', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_886148', NULL, 'PKR', '2025-09-12 07:13:03', '2025-09-17 08:13:03'),
(38, 2, 'ride_complete', 'business_metrics', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '130.136.119.222', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_274963', NULL, 'PKR', '2025-08-24 11:13:03', '2025-09-17 08:13:03'),
(39, 3, 'page_view', 'performance', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '154.12.241.143', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_325637', NULL, 'PKR', '2025-09-08 18:13:03', '2025-09-17 08:13:03'),
(40, 2, 'page_view', 'business_metrics', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '165.86.33.133', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_215952', NULL, 'PKR', '2025-09-04 21:13:03', '2025-09-17 08:13:03'),
(41, 1, 'ride_complete', 'engagement', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '193.239.225.63', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_995612', NULL, 'PKR', '2025-08-19 23:13:03', '2025-09-17 08:13:03'),
(42, 2, 'ride_request', 'conversion', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '69.219.28.11', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_496516', NULL, 'PKR', '2025-08-29 15:13:03', '2025-09-17 08:13:03'),
(43, 1, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '150.129.17.169', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_723598', NULL, 'PKR', '2025-09-16 12:13:03', '2025-09-17 08:13:03'),
(44, 2, 'ride_complete', 'business_metrics', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '52.189.18.182', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_142691', NULL, 'PKR', '2025-09-07 04:13:03', '2025-09-17 08:13:03'),
(45, 2, 'payment_made', 'conversion', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '184.143.117.127', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_867317', 475.00, 'PKR', '2025-09-06 22:13:03', '2025-09-17 08:13:03'),
(46, 2, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '29.239.212.93', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_241203', NULL, 'PKR', '2025-09-03 21:13:03', '2025-09-17 08:13:03'),
(47, 2, 'form_submit', 'conversion', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '72.15.162.30', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_264366', NULL, 'PKR', '2025-08-25 05:13:03', '2025-09-17 08:13:03'),
(48, 2, 'page_view', 'business_metrics', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '57.58.88.151', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_147301', NULL, 'PKR', '2025-08-27 13:13:03', '2025-09-17 08:13:03'),
(49, 3, 'ride_request', 'performance', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '91.208.195.248', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_849727', NULL, 'PKR', '2025-09-06 04:13:03', '2025-09-17 08:13:03'),
(50, 1, 'page_view', 'user_behavior', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '80.90.46.210', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_616345', NULL, 'PKR', '2025-09-03 07:13:03', '2025-09-17 08:13:03'),
(51, 3, 'ride_complete', 'business_metrics', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '196.178.118.88', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_668906', NULL, 'PKR', '2025-08-23 03:13:03', '2025-09-17 08:13:03'),
(52, 3, 'form_submit', 'user_behavior', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '107.113.120.158', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_583984', NULL, 'PKR', '2025-08-23 12:13:03', '2025-09-17 08:13:03'),
(53, 1, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '225.158.227.36', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_813754', NULL, 'PKR', '2025-09-05 09:13:03', '2025-09-17 08:13:03'),
(54, 3, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '206.52.166.176', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_643429', NULL, 'PKR', '2025-08-21 18:13:03', '2025-09-17 08:13:03'),
(55, 3, 'driver_verification', 'engagement', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '113.177.248.52', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_952309', NULL, 'PKR', '2025-09-03 03:13:03', '2025-09-17 08:13:03'),
(56, 1, 'ride_complete', 'performance', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '178.60.204.49', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_532276', NULL, 'PKR', '2025-09-13 13:13:03', '2025-09-17 08:13:03'),
(57, 3, 'payment_made', 'engagement', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '110.40.18.93', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_997706', 1382.00, 'PKR', '2025-08-26 16:13:03', '2025-09-17 08:13:03'),
(58, 3, 'user_registration', 'conversion', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '154.181.17.50', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_897669', NULL, 'PKR', '2025-09-16 06:13:03', '2025-09-17 08:13:03'),
(59, 2, 'ride_request', 'business_metrics', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '66.240.52.180', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_817301', NULL, 'PKR', '2025-09-16 11:13:03', '2025-09-17 08:13:03'),
(60, 1, 'form_submit', 'user_behavior', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '131.102.124.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_214313', NULL, 'PKR', '2025-09-13 12:13:03', '2025-09-17 08:13:03'),
(61, 3, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '197.131.59.240', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_175958', NULL, 'PKR', '2025-08-25 16:13:03', '2025-09-17 08:13:03'),
(62, 2, 'page_view', 'user_behavior', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '252.245.6.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_369805', NULL, 'PKR', '2025-09-06 17:13:03', '2025-09-17 08:13:03'),
(63, 3, 'driver_verification', 'business_metrics', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '210.180.184.158', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_932038', NULL, 'PKR', '2025-09-08 16:13:03', '2025-09-17 08:13:03'),
(64, 2, 'ride_complete', 'business_metrics', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '23.211.129.122', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_572973', NULL, 'PKR', '2025-08-27 19:13:03', '2025-09-17 08:13:03'),
(65, 3, 'ride_complete', 'performance', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '207.231.143.211', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_432474', NULL, 'PKR', '2025-09-08 15:13:03', '2025-09-17 08:13:03'),
(66, 1, 'user_registration', 'user_behavior', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '56.203.108.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_223036', NULL, 'PKR', '2025-08-18 01:13:03', '2025-09-17 08:13:03'),
(67, 3, 'ride_complete', 'user_behavior', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '215.19.246.127', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_449826', NULL, 'PKR', '2025-08-18 10:13:03', '2025-09-17 08:13:03'),
(68, 3, 'button_click', 'conversion', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '89.38.137.238', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_732978', NULL, 'PKR', '2025-08-27 21:13:03', '2025-09-17 08:13:03'),
(69, 1, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '76.27.45.33', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_530177', 916.00, 'PKR', '2025-09-06 17:13:03', '2025-09-17 08:13:03'),
(70, 1, 'form_submit', 'engagement', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '175.233.56.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_235684', NULL, 'PKR', '2025-09-07 07:13:03', '2025-09-17 08:13:03'),
(71, 3, 'user_registration', 'business_metrics', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '93.234.205.198', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_899299', NULL, 'PKR', '2025-08-27 16:13:03', '2025-09-17 08:13:03'),
(72, 3, 'payment_made', 'user_behavior', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '223.183.80.126', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_422404', 1179.00, 'PKR', '2025-08-28 01:13:03', '2025-09-17 08:13:03'),
(73, 1, 'ride_complete', 'business_metrics', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '207.35.101.151', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_188319', NULL, 'PKR', '2025-09-11 11:13:03', '2025-09-17 08:13:03'),
(74, 1, 'payment_made', 'conversion', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '204.116.182.96', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_463408', 709.00, 'PKR', '2025-08-22 11:13:03', '2025-09-17 08:13:03'),
(75, 2, 'page_view', 'business_metrics', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '165.103.62.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_818602', NULL, 'PKR', '2025-09-05 05:13:03', '2025-09-17 08:13:03'),
(76, 1, 'ride_request', 'conversion', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '18.233.181.217', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_448682', NULL, 'PKR', '2025-08-20 07:13:03', '2025-09-17 08:13:03'),
(77, 3, 'form_submit', 'user_behavior', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '227.79.216.30', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_101208', NULL, 'PKR', '2025-09-06 14:13:03', '2025-09-17 08:13:03'),
(78, 3, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '121.173.204.241', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_445827', 788.00, 'PKR', '2025-08-26 09:13:03', '2025-09-17 08:13:03'),
(79, 3, 'button_click', 'conversion', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '116.149.240.2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_779016', NULL, 'PKR', '2025-09-13 21:13:03', '2025-09-17 08:13:03'),
(80, 1, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '99.5.190.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_242689', NULL, 'PKR', '2025-09-07 08:13:03', '2025-09-17 08:13:03'),
(81, 2, 'page_view', 'conversion', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '185.51.63.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_419755', NULL, 'PKR', '2025-08-28 02:13:03', '2025-09-17 08:13:03'),
(82, 1, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '235.38.181.172', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_195482', NULL, 'PKR', '2025-08-27 10:13:03', '2025-09-17 08:13:03'),
(83, 1, 'form_submit', 'conversion', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '9.15.79.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_200759', NULL, 'PKR', '2025-08-28 16:13:03', '2025-09-17 08:13:03'),
(84, 2, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '185.23.83.135', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_537132', NULL, 'PKR', '2025-08-30 10:13:03', '2025-09-17 08:13:03'),
(85, 2, 'ride_request', 'engagement', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '160.175.102.105', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_338315', NULL, 'PKR', '2025-09-01 16:13:03', '2025-09-17 08:13:03'),
(86, 3, 'form_submit', 'business_metrics', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '226.136.96.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_476396', NULL, 'PKR', '2025-09-05 14:13:03', '2025-09-17 08:13:03'),
(87, 2, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '123.104.236.244', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_121936', NULL, 'PKR', '2025-08-26 01:13:03', '2025-09-17 08:13:03'),
(88, 2, 'page_view', 'conversion', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '59.193.28.162', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_600761', NULL, 'PKR', '2025-08-25 14:13:03', '2025-09-17 08:13:03'),
(89, 1, 'page_view', 'performance', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '227.110.223.41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_701810', NULL, 'PKR', '2025-09-07 07:13:03', '2025-09-17 08:13:03'),
(90, 1, 'payment_made', 'engagement', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '43.52.16.243', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_834077', 1447.00, 'PKR', '2025-08-21 13:13:03', '2025-09-17 08:13:03'),
(91, 2, 'ride_complete', 'business_metrics', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '17.80.241.17', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_601996', NULL, 'PKR', '2025-09-06 07:13:03', '2025-09-17 08:13:03'),
(92, 2, 'driver_verification', 'conversion', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '214.33.78.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_978319', NULL, 'PKR', '2025-08-21 21:13:03', '2025-09-17 08:13:03'),
(93, 1, 'button_click', 'user_behavior', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '251.170.201.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_694879', NULL, 'PKR', '2025-08-23 00:13:03', '2025-09-17 08:13:03'),
(94, 2, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '225.64.136.118', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_245976', NULL, 'PKR', '2025-09-04 13:13:03', '2025-09-17 08:13:03'),
(95, 2, 'driver_verification', 'user_behavior', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '128.34.180.73', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_416839', NULL, 'PKR', '2025-09-12 13:13:03', '2025-09-17 08:13:03'),
(96, 1, 'page_view', 'business_metrics', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '50.141.156.121', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_384146', NULL, 'PKR', '2025-08-28 05:13:03', '2025-09-17 08:13:03'),
(97, 3, 'page_view', 'performance', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '130.234.93.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_494653', NULL, 'PKR', '2025-09-02 22:13:03', '2025-09-17 08:13:03'),
(98, 2, 'payment_made', 'engagement', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '221.234.2.254', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_758576', 943.00, 'PKR', '2025-09-12 11:13:03', '2025-09-17 08:13:03'),
(99, 3, 'ride_request', 'conversion', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '253.232.193.126', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_403205', NULL, 'PKR', '2025-09-07 10:13:03', '2025-09-17 08:13:03'),
(100, 1, 'button_click', 'engagement', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '107.58.133.216', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_343635', NULL, 'PKR', '2025-08-29 16:13:03', '2025-09-17 08:13:03'),
(101, 2, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '13.234.199.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_631195', NULL, 'PKR', '2025-08-20 17:13:03', '2025-09-17 08:13:03'),
(102, 2, 'driver_verification', 'business_metrics', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '66.26.175.25', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_210056', NULL, 'PKR', '2025-08-29 07:13:03', '2025-09-17 08:13:03'),
(103, 3, 'driver_verification', 'business_metrics', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '197.86.78.83', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_170421', NULL, 'PKR', '2025-08-29 17:13:03', '2025-09-17 08:13:03'),
(104, 2, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '120.227.139.150', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_144116', 1422.00, 'PKR', '2025-08-23 14:13:03', '2025-09-17 08:13:03'),
(105, 2, 'user_registration', 'performance', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '225.70.46.78', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_411623', NULL, 'PKR', '2025-09-12 07:13:03', '2025-09-17 08:13:03'),
(106, 3, 'form_submit', 'engagement', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '12.15.224.223', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_626695', NULL, 'PKR', '2025-09-12 22:13:03', '2025-09-17 08:13:03'),
(107, 2, 'page_view', 'conversion', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '52.20.24.225', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_314846', NULL, 'PKR', '2025-09-08 16:13:03', '2025-09-17 08:13:03'),
(108, 2, 'ride_complete', 'engagement', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '220.185.137.192', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_642735', NULL, 'PKR', '2025-08-23 18:13:03', '2025-09-17 08:13:03'),
(109, 3, 'user_registration', 'performance', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '14.85.10.35', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_593103', NULL, 'PKR', '2025-09-02 00:13:03', '2025-09-17 08:13:03'),
(110, 1, 'form_submit', 'conversion', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '91.92.76.162', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_152274', NULL, 'PKR', '2025-08-21 04:13:04', '2025-09-17 08:13:04'),
(111, 2, 'payment_made', 'performance', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '174.187.202.228', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_599453', 537.00, 'PKR', '2025-09-02 23:13:04', '2025-09-17 08:13:04'),
(112, 3, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '253.143.234.250', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_118325', NULL, 'PKR', '2025-09-08 08:13:04', '2025-09-17 08:13:04'),
(113, 1, 'form_submit', 'engagement', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '24.146.170.227', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_307485', NULL, 'PKR', '2025-08-25 08:13:04', '2025-09-17 08:13:04'),
(114, 1, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '150.78.210.65', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_669890', NULL, 'PKR', '2025-08-30 02:13:04', '2025-09-17 08:13:04'),
(115, 3, 'button_click', 'performance', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '40.133.185.150', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_429236', NULL, 'PKR', '2025-08-24 04:13:04', '2025-09-17 08:13:04');
INSERT INTO `analytics_events` (`id`, `user_id`, `event_type`, `event_category`, `event_name`, `event_properties`, `page_url`, `referrer`, `ip_address`, `user_agent`, `session_id`, `value`, `currency`, `created_at`, `updated_at`) VALUES
(116, 2, 'payment_made', 'engagement', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '78.165.226.24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_574186', 566.00, 'PKR', '2025-08-20 03:13:04', '2025-09-17 08:13:04'),
(117, 1, 'page_view', 'conversion', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '247.73.239.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_181822', NULL, 'PKR', '2025-09-11 02:13:04', '2025-09-17 08:13:04'),
(118, 2, 'user_registration', 'engagement', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '235.229.93.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_747073', NULL, 'PKR', '2025-09-07 16:13:04', '2025-09-17 08:13:04'),
(119, 2, 'user_registration', 'user_behavior', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '127.186.241.228', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_905264', NULL, 'PKR', '2025-09-08 15:13:04', '2025-09-17 08:13:04'),
(120, 3, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '163.211.130.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_919310', NULL, 'PKR', '2025-08-30 21:13:04', '2025-09-17 08:13:04'),
(121, 3, 'button_click', 'conversion', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '153.130.194.10', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_845599', NULL, 'PKR', '2025-09-05 04:13:04', '2025-09-17 08:13:04'),
(122, 1, 'button_click', 'user_behavior', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '255.34.167.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_739912', NULL, 'PKR', '2025-08-19 01:13:04', '2025-09-17 08:13:04'),
(123, 3, 'form_submit', 'performance', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '138.157.50.121', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_390089', NULL, 'PKR', '2025-09-07 23:13:04', '2025-09-17 08:13:04'),
(124, 3, 'driver_verification', 'performance', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '198.229.192.72', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_948024', NULL, 'PKR', '2025-08-30 21:13:04', '2025-09-17 08:13:04'),
(125, 3, 'form_submit', 'performance', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '190.201.183.15', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_904867', NULL, 'PKR', '2025-09-12 00:13:04', '2025-09-17 08:13:04'),
(126, 3, 'button_click', 'conversion', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '59.245.162.224', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_472295', NULL, 'PKR', '2025-09-10 13:13:04', '2025-09-17 08:13:04'),
(127, 1, 'user_registration', 'engagement', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '234.206.97.162', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_843345', NULL, 'PKR', '2025-08-28 23:13:04', '2025-09-17 08:13:04'),
(128, 1, 'page_view', 'user_behavior', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '95.161.10.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_810850', NULL, 'PKR', '2025-08-21 13:13:04', '2025-09-17 08:13:04'),
(129, 1, 'form_submit', 'performance', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '182.154.244.96', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_343164', NULL, 'PKR', '2025-08-31 17:13:04', '2025-09-17 08:13:04'),
(130, 3, 'driver_verification', 'conversion', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '157.108.9.199', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_636319', NULL, 'PKR', '2025-09-12 21:13:04', '2025-09-17 08:13:04'),
(131, 1, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '49.128.2.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_161372', 163.00, 'PKR', '2025-08-25 18:13:04', '2025-09-17 08:13:04'),
(132, 2, 'ride_request', 'user_behavior', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '207.82.219.152', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_405625', NULL, 'PKR', '2025-09-05 00:13:04', '2025-09-17 08:13:04'),
(133, 1, 'payment_made', 'business_metrics', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '192.91.191.107', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_568299', 1282.00, 'PKR', '2025-09-10 18:13:04', '2025-09-17 08:13:04'),
(134, 3, 'payment_made', 'conversion', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '151.169.111.106', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_204940', 1344.00, 'PKR', '2025-08-31 05:13:04', '2025-09-17 08:13:04'),
(135, 2, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '188.179.180.193', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_739504', NULL, 'PKR', '2025-08-26 10:13:04', '2025-09-17 08:13:04'),
(136, 1, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '232.79.133.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_731198', NULL, 'PKR', '2025-09-14 12:13:04', '2025-09-17 08:13:04'),
(137, 2, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '196.38.160.172', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_548210', 645.00, 'PKR', '2025-08-24 17:13:04', '2025-09-17 08:13:04'),
(138, 1, 'form_submit', 'user_behavior', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '38.77.130.145', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_732881', NULL, 'PKR', '2025-09-04 02:13:04', '2025-09-17 08:13:04'),
(139, 1, 'page_view', 'performance', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '250.220.3.174', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_768612', NULL, 'PKR', '2025-09-13 08:13:04', '2025-09-17 08:13:04'),
(140, 2, 'button_click', 'performance', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '23.247.13.100', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_967596', NULL, 'PKR', '2025-09-13 04:13:04', '2025-09-17 08:13:04'),
(141, 1, 'ride_request', 'conversion', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '157.126.105.56', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_873085', NULL, 'PKR', '2025-09-03 18:13:04', '2025-09-17 08:13:04'),
(142, 1, 'driver_verification', 'user_behavior', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '169.229.107.44', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_986832', NULL, 'PKR', '2025-08-23 03:13:04', '2025-09-17 08:13:04'),
(143, 1, 'user_registration', 'conversion', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '81.75.188.20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_983354', NULL, 'PKR', '2025-08-22 10:13:04', '2025-09-17 08:13:04'),
(144, 2, 'user_registration', 'user_behavior', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '125.155.223.105', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_430494', NULL, 'PKR', '2025-08-25 03:13:04', '2025-09-17 08:13:04'),
(145, 1, 'page_view', 'user_behavior', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '135.74.20.164', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_464395', NULL, 'PKR', '2025-08-28 00:13:04', '2025-09-17 08:13:04'),
(146, 2, 'button_click', 'performance', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '144.143.81.238', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_957091', NULL, 'PKR', '2025-09-05 01:13:04', '2025-09-17 08:13:04'),
(147, 1, 'form_submit', 'business_metrics', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '250.181.14.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_138375', NULL, 'PKR', '2025-09-03 14:13:04', '2025-09-17 08:13:04'),
(148, 2, 'ride_request', 'business_metrics', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '196.214.42.174', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_922564', NULL, 'PKR', '2025-08-20 20:13:04', '2025-09-17 08:13:04'),
(149, 3, 'driver_verification', 'business_metrics', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '245.150.242.146', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_864449', NULL, 'PKR', '2025-08-30 18:13:04', '2025-09-17 08:13:04'),
(150, 3, 'ride_request', 'conversion', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '139.252.97.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_226702', NULL, 'PKR', '2025-09-16 08:13:04', '2025-09-17 08:13:04'),
(151, 3, 'ride_complete', 'performance', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '202.160.214.110', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_231540', NULL, 'PKR', '2025-09-03 04:13:04', '2025-09-17 08:13:04'),
(152, 3, 'page_view', 'performance', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '152.87.178.234', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_581157', NULL, 'PKR', '2025-08-31 04:13:04', '2025-09-17 08:13:04'),
(153, 1, 'driver_verification', 'business_metrics', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '42.161.255.159', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_847739', NULL, 'PKR', '2025-09-11 07:13:04', '2025-09-17 08:13:04'),
(154, 3, 'ride_request', 'business_metrics', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '21.207.93.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_159402', NULL, 'PKR', '2025-09-16 14:13:04', '2025-09-17 08:13:04'),
(155, 3, 'button_click', 'user_behavior', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '121.182.7.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_785575', NULL, 'PKR', '2025-09-08 09:13:04', '2025-09-17 08:13:04'),
(156, 3, 'form_submit', 'user_behavior', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '180.182.146.176', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_803318', NULL, 'PKR', '2025-09-17 02:13:04', '2025-09-17 08:13:04'),
(157, 3, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '34.180.234.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_363444', NULL, 'PKR', '2025-09-13 09:13:04', '2025-09-17 08:13:04'),
(158, 2, 'button_click', 'business_metrics', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '248.28.33.251', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_480460', NULL, 'PKR', '2025-09-06 02:13:04', '2025-09-17 08:13:04'),
(159, 2, 'ride_complete', 'business_metrics', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '19.122.149.97', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_785499', NULL, 'PKR', '2025-09-05 23:13:04', '2025-09-17 08:13:04'),
(160, 2, 'user_registration', 'conversion', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '187.232.202.124', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_232950', NULL, 'PKR', '2025-08-23 19:13:04', '2025-09-17 08:13:04'),
(161, 1, 'form_submit', 'engagement', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '180.73.42.10', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_974107', NULL, 'PKR', '2025-09-01 16:13:04', '2025-09-17 08:13:04'),
(162, 3, 'payment_made', 'business_metrics', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '121.180.225.103', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_841056', 142.00, 'PKR', '2025-09-13 16:13:04', '2025-09-17 08:13:04'),
(163, 2, 'button_click', 'conversion', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '90.184.147.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_150892', NULL, 'PKR', '2025-09-01 14:13:04', '2025-09-17 08:13:04'),
(164, 2, 'driver_verification', 'business_metrics', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '41.7.182.169', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_888752', NULL, 'PKR', '2025-09-15 12:13:04', '2025-09-17 08:13:04'),
(165, 3, 'ride_request', 'performance', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '220.30.9.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_112016', NULL, 'PKR', '2025-08-21 17:13:04', '2025-09-17 08:13:04'),
(166, 3, 'form_submit', 'business_metrics', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '209.18.143.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_663710', NULL, 'PKR', '2025-08-23 16:13:04', '2025-09-17 08:13:04'),
(167, 1, 'ride_request', 'conversion', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '235.169.123.163', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_654169', NULL, 'PKR', '2025-08-28 22:13:04', '2025-09-17 08:13:04'),
(168, 1, 'ride_request', 'performance', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '117.234.137.27', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_954499', NULL, 'PKR', '2025-08-28 23:13:04', '2025-09-17 08:13:04'),
(169, 3, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '231.235.110.89', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_786173', NULL, 'PKR', '2025-09-07 22:13:04', '2025-09-17 08:13:04'),
(170, 3, 'ride_request', 'business_metrics', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '8.194.170.36', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_727808', NULL, 'PKR', '2025-09-15 17:13:04', '2025-09-17 08:13:04'),
(171, 1, 'payment_made', 'engagement', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '71.55.119.105', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_442009', 282.00, 'PKR', '2025-09-15 07:13:04', '2025-09-17 08:13:04'),
(172, 3, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '115.188.255.101', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_926029', 1505.00, 'PKR', '2025-08-28 17:13:04', '2025-09-17 08:13:04'),
(173, 3, 'user_registration', 'business_metrics', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '49.144.97.217', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_778888', NULL, 'PKR', '2025-09-11 04:13:04', '2025-09-17 08:13:04'),
(174, 2, 'user_registration', 'user_behavior', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '241.194.237.127', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_572536', NULL, 'PKR', '2025-08-18 07:13:04', '2025-09-17 08:13:04'),
(175, 3, 'page_view', 'user_behavior', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '49.237.72.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_884102', NULL, 'PKR', '2025-09-04 06:13:04', '2025-09-17 08:13:04'),
(176, 2, 'button_click', 'user_behavior', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '185.56.130.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_739154', NULL, 'PKR', '2025-09-12 15:13:04', '2025-09-17 08:13:04'),
(177, 2, 'payment_made', 'business_metrics', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '139.220.226.167', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_858442', 922.00, 'PKR', '2025-09-09 06:13:04', '2025-09-17 08:13:04'),
(178, 2, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '219.75.60.68', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_835598', NULL, 'PKR', '2025-09-11 12:13:04', '2025-09-17 08:13:04'),
(179, 1, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '87.146.204.41', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_623590', NULL, 'PKR', '2025-08-22 20:13:04', '2025-09-17 08:13:04'),
(180, 3, 'payment_made', 'business_metrics', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '30.105.53.74', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_721357', 118.00, 'PKR', '2025-09-07 14:13:04', '2025-09-17 08:13:04'),
(181, 2, 'payment_made', 'user_behavior', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '57.24.151.145', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_162017', 1772.00, 'PKR', '2025-08-23 07:13:05', '2025-09-17 08:13:05'),
(182, 3, 'payment_made', 'performance', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '72.57.2.114', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_687263', 1533.00, 'PKR', '2025-09-02 13:13:05', '2025-09-17 08:13:05'),
(183, 1, 'driver_verification', 'conversion', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '158.134.180.39', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_779784', NULL, 'PKR', '2025-09-11 09:13:05', '2025-09-17 08:13:05'),
(184, 3, 'payment_made', 'conversion', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '21.86.180.106', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_416058', 1855.00, 'PKR', '2025-09-12 08:13:05', '2025-09-17 08:13:05'),
(185, 3, 'user_registration', 'conversion', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '139.190.84.221', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_768969', NULL, 'PKR', '2025-09-01 15:13:05', '2025-09-17 08:13:05'),
(186, 1, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '96.15.198.79', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_558907', NULL, 'PKR', '2025-08-26 02:13:05', '2025-09-17 08:13:05'),
(187, 2, 'button_click', 'engagement', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '17.243.90.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_737192', NULL, 'PKR', '2025-09-15 02:13:05', '2025-09-17 08:13:05'),
(188, 1, 'ride_request', 'engagement', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '149.251.28.191', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_288078', NULL, 'PKR', '2025-09-15 18:13:05', '2025-09-17 08:13:05'),
(189, 2, 'page_view', 'business_metrics', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '184.87.139.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_910214', NULL, 'PKR', '2025-09-15 17:13:05', '2025-09-17 08:13:05'),
(190, 1, 'form_submit', 'business_metrics', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '198.38.140.234', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_601509', NULL, 'PKR', '2025-09-15 15:13:05', '2025-09-17 08:13:05'),
(191, 3, 'driver_verification', 'conversion', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '223.179.222.137', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_427295', NULL, 'PKR', '2025-09-11 04:13:05', '2025-09-17 08:13:05'),
(192, 1, 'user_registration', 'performance', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '98.189.127.172', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_520044', NULL, 'PKR', '2025-08-29 21:13:05', '2025-09-17 08:13:05'),
(193, 3, 'button_click', 'user_behavior', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '84.68.58.45', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_610344', NULL, 'PKR', '2025-08-24 18:13:05', '2025-09-17 08:13:05'),
(194, 1, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '2.23.159.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_360172', NULL, 'PKR', '2025-09-11 05:13:05', '2025-09-17 08:13:05'),
(195, 2, 'ride_request', 'performance', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '208.86.62.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_797703', NULL, 'PKR', '2025-09-13 22:13:05', '2025-09-17 08:13:05'),
(196, 2, 'driver_verification', 'engagement', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '11.40.187.11', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_339307', NULL, 'PKR', '2025-09-03 11:13:05', '2025-09-17 08:13:05'),
(197, 1, 'user_registration', 'business_metrics', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '216.217.255.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_681419', NULL, 'PKR', '2025-09-16 14:13:05', '2025-09-17 08:13:05'),
(198, 3, 'form_submit', 'business_metrics', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '197.92.139.198', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_551086', NULL, 'PKR', '2025-09-08 07:13:05', '2025-09-17 08:13:05'),
(199, 2, 'driver_verification', 'conversion', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '229.71.136.224', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_471697', NULL, 'PKR', '2025-08-27 01:13:05', '2025-09-17 08:13:05'),
(200, 2, 'ride_complete', 'engagement', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '214.23.179.191', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_569692', NULL, 'PKR', '2025-09-04 20:13:05', '2025-09-17 08:13:05'),
(201, 2, 'page_view', 'conversion', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '140.44.244.247', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_105391', NULL, 'PKR', '2025-09-13 05:13:05', '2025-09-17 08:13:05'),
(202, 3, 'button_click', 'performance', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '179.86.249.100', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_944318', NULL, 'PKR', '2025-08-30 12:13:05', '2025-09-17 08:13:05'),
(203, 2, 'user_registration', 'engagement', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '71.156.155.224', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_928901', NULL, 'PKR', '2025-08-29 02:13:05', '2025-09-17 08:13:05'),
(204, 1, 'driver_verification', 'business_metrics', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '210.122.15.107', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_332627', NULL, 'PKR', '2025-09-04 16:13:05', '2025-09-17 08:13:05'),
(205, 3, 'form_submit', 'performance', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '16.241.31.238', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_267644', NULL, 'PKR', '2025-08-22 09:13:05', '2025-09-17 08:13:05'),
(206, 1, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '203.49.246.83', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_752329', NULL, 'PKR', '2025-09-06 12:13:05', '2025-09-17 08:13:05'),
(207, 3, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '189.180.210.215', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_994964', 868.00, 'PKR', '2025-09-10 19:13:05', '2025-09-17 08:13:05'),
(208, 2, 'user_registration', 'business_metrics', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '119.57.112.178', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_604538', NULL, 'PKR', '2025-08-25 12:13:05', '2025-09-17 08:13:05'),
(209, 1, 'driver_verification', 'user_behavior', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '13.73.38.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_512206', NULL, 'PKR', '2025-08-26 12:13:05', '2025-09-17 08:13:05'),
(210, 1, 'form_submit', 'business_metrics', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '65.97.131.170', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_815068', NULL, 'PKR', '2025-09-16 04:13:05', '2025-09-17 08:13:05'),
(211, 2, 'page_view', 'conversion', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '149.253.147.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_280007', NULL, 'PKR', '2025-08-30 17:13:05', '2025-09-17 08:13:05'),
(212, 3, 'payment_made', 'engagement', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '113.226.31.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_526573', 761.00, 'PKR', '2025-09-07 21:13:05', '2025-09-17 08:13:05'),
(213, 1, 'ride_request', 'conversion', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '159.100.121.227', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_178082', NULL, 'PKR', '2025-09-11 12:13:05', '2025-09-17 08:13:05'),
(214, 1, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '212.61.183.91', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_428005', NULL, 'PKR', '2025-09-10 03:13:05', '2025-09-17 08:13:05'),
(215, 2, 'button_click', 'business_metrics', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '219.15.91.138', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_754299', NULL, 'PKR', '2025-09-14 03:13:05', '2025-09-17 08:13:05'),
(216, 1, 'driver_verification', 'business_metrics', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '35.128.108.232', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_478037', NULL, 'PKR', '2025-08-23 22:13:05', '2025-09-17 08:13:05'),
(217, 2, 'user_registration', 'performance', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '47.61.200.203', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_749667', NULL, 'PKR', '2025-08-29 11:13:05', '2025-09-17 08:13:05'),
(218, 3, 'form_submit', 'user_behavior', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '143.76.159.112', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_489716', NULL, 'PKR', '2025-09-04 17:13:05', '2025-09-17 08:13:05'),
(219, 3, 'ride_request', 'conversion', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '36.76.93.41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_324616', NULL, 'PKR', '2025-08-27 09:13:05', '2025-09-17 08:13:05'),
(220, 1, 'form_submit', 'conversion', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '145.208.87.201', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_525308', NULL, 'PKR', '2025-09-14 05:13:05', '2025-09-17 08:13:05'),
(221, 2, 'driver_verification', 'user_behavior', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '161.209.80.182', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_891374', NULL, 'PKR', '2025-08-24 08:13:05', '2025-09-17 08:13:05'),
(222, 3, 'payment_made', 'business_metrics', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '8.155.83.72', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_919229', 1225.00, 'PKR', '2025-09-14 15:13:05', '2025-09-17 08:13:05'),
(223, 2, 'form_submit', 'engagement', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '53.237.244.138', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_641591', NULL, 'PKR', '2025-08-25 18:13:05', '2025-09-17 08:13:05'),
(224, 3, 'ride_complete', 'engagement', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '61.46.112.200', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_518261', NULL, 'PKR', '2025-08-27 14:13:05', '2025-09-17 08:13:05'),
(225, 3, 'ride_request', 'performance', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '72.8.13.214', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_631702', NULL, 'PKR', '2025-09-04 08:13:05', '2025-09-17 08:13:05'),
(226, 3, 'ride_request', 'user_behavior', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '52.216.79.186', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_708510', NULL, 'PKR', '2025-09-11 21:13:05', '2025-09-17 08:13:05'),
(227, 2, 'payment_made', 'business_metrics', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '139.197.162.201', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_333016', 688.00, 'PKR', '2025-08-27 19:13:05', '2025-09-17 08:13:05'),
(228, 2, 'ride_request', 'conversion', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '222.92.226.139', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_751929', NULL, 'PKR', '2025-09-11 02:13:05', '2025-09-17 08:13:05'),
(229, 1, 'ride_complete', 'performance', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '182.223.35.197', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_747031', NULL, 'PKR', '2025-09-16 00:13:05', '2025-09-17 08:13:05'),
(230, 3, 'driver_verification', 'performance', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '146.34.140.95', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_216582', NULL, 'PKR', '2025-09-14 23:13:05', '2025-09-17 08:13:05');
INSERT INTO `analytics_events` (`id`, `user_id`, `event_type`, `event_category`, `event_name`, `event_properties`, `page_url`, `referrer`, `ip_address`, `user_agent`, `session_id`, `value`, `currency`, `created_at`, `updated_at`) VALUES
(231, 1, 'driver_verification', 'user_behavior', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '215.177.95.231', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_226465', NULL, 'PKR', '2025-09-15 04:13:05', '2025-09-17 08:13:05'),
(232, 1, 'ride_request', 'conversion', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '215.149.79.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_535962', NULL, 'PKR', '2025-09-05 22:13:05', '2025-09-17 08:13:05'),
(233, 3, 'user_registration', 'conversion', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '247.183.45.122', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_746448', NULL, 'PKR', '2025-08-29 12:13:05', '2025-09-17 08:13:05'),
(234, 1, 'user_registration', 'business_metrics', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '56.210.179.24', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_112523', NULL, 'PKR', '2025-09-08 07:13:05', '2025-09-17 08:13:05'),
(235, 3, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '109.7.46.218', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_697409', NULL, 'PKR', '2025-09-09 04:13:05', '2025-09-17 08:13:05'),
(236, 1, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '32.207.100.71', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_246264', NULL, 'PKR', '2025-08-24 19:13:05', '2025-09-17 08:13:05'),
(237, 3, 'user_registration', 'performance', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '189.139.87.251', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_736673', NULL, 'PKR', '2025-09-01 06:13:05', '2025-09-17 08:13:05'),
(238, 3, 'ride_complete', 'engagement', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '166.243.212.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_922695', NULL, 'PKR', '2025-09-08 16:13:05', '2025-09-17 08:13:05'),
(239, 3, 'payment_made', 'user_behavior', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '247.230.216.182', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_681036', 292.00, 'PKR', '2025-09-13 12:13:05', '2025-09-17 08:13:05'),
(240, 2, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '224.102.208.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_918509', 610.00, 'PKR', '2025-09-01 07:13:05', '2025-09-17 08:13:05'),
(241, 1, 'ride_complete', 'engagement', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '89.151.207.150', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_950781', NULL, 'PKR', '2025-09-08 17:13:05', '2025-09-17 08:13:05'),
(242, 1, 'ride_request', 'business_metrics', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '119.248.148.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_963608', NULL, 'PKR', '2025-08-31 11:13:05', '2025-09-17 08:13:05'),
(243, 3, 'user_registration', 'conversion', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '106.203.116.128', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_424499', NULL, 'PKR', '2025-09-16 03:13:05', '2025-09-17 08:13:05'),
(244, 1, 'ride_request', 'business_metrics', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '8.220.43.214', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_495032', NULL, 'PKR', '2025-09-13 08:13:05', '2025-09-17 08:13:05'),
(245, 2, 'ride_complete', 'engagement', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '228.201.182.234', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_160743', NULL, 'PKR', '2025-08-23 09:13:05', '2025-09-17 08:13:05'),
(246, 2, 'page_view', 'engagement', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '99.194.248.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_690790', NULL, 'PKR', '2025-08-23 17:13:05', '2025-09-17 08:13:05'),
(247, 2, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '170.201.223.43', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_117116', 605.00, 'PKR', '2025-09-05 18:13:05', '2025-09-17 08:13:05'),
(248, 3, 'driver_verification', 'engagement', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '163.170.248.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_367646', NULL, 'PKR', '2025-08-20 05:13:05', '2025-09-17 08:13:05'),
(249, 1, 'ride_request', 'conversion', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '1.89.84.44', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_857514', NULL, 'PKR', '2025-09-16 12:13:05', '2025-09-17 08:13:05'),
(250, 2, 'payment_made', 'user_behavior', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '27.25.175.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_102505', 749.00, 'PKR', '2025-09-04 08:13:06', '2025-09-17 08:13:06'),
(251, 3, 'payment_made', 'user_behavior', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '30.39.240.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_554247', 1881.00, 'PKR', '2025-08-25 07:13:06', '2025-09-17 08:13:06'),
(252, 2, 'ride_complete', 'user_behavior', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '225.98.189.31', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_845894', NULL, 'PKR', '2025-08-19 14:13:06', '2025-09-17 08:13:06'),
(253, 3, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '19.155.76.117', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_698567', NULL, 'PKR', '2025-08-24 09:13:06', '2025-09-17 08:13:06'),
(254, 3, 'payment_made', 'engagement', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '58.64.148.138', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_903925', 1594.00, 'PKR', '2025-08-23 00:13:06', '2025-09-17 08:13:06'),
(255, 1, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '124.170.2.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_670252', NULL, 'PKR', '2025-08-18 08:13:06', '2025-09-17 08:13:06'),
(256, 3, 'ride_complete', 'business_metrics', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '40.182.66.182', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_179257', NULL, 'PKR', '2025-08-27 02:13:06', '2025-09-17 08:13:06'),
(257, 3, 'ride_request', 'engagement', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '102.86.93.70', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_344556', NULL, 'PKR', '2025-08-21 03:13:06', '2025-09-17 08:13:06'),
(258, 2, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '156.35.146.39', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_321217', NULL, 'PKR', '2025-08-23 03:13:06', '2025-09-17 08:13:06'),
(259, 2, 'driver_verification', 'user_behavior', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '49.255.105.115', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_826613', NULL, 'PKR', '2025-08-20 18:13:06', '2025-09-17 08:13:06'),
(260, 2, 'button_click', 'performance', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '249.113.233.210', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_285853', NULL, 'PKR', '2025-08-26 22:13:06', '2025-09-17 08:13:06'),
(261, 3, 'user_registration', 'business_metrics', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '99.113.232.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_402991', NULL, 'PKR', '2025-09-07 10:13:06', '2025-09-17 08:13:06'),
(262, 2, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '48.128.243.112', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_713766', NULL, 'PKR', '2025-09-09 22:13:06', '2025-09-17 08:13:06'),
(263, 1, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '46.197.180.16', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_996486', NULL, 'PKR', '2025-09-05 19:13:06', '2025-09-17 08:13:06'),
(264, 3, 'page_view', 'business_metrics', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '135.105.8.151', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_583138', NULL, 'PKR', '2025-08-18 19:13:06', '2025-09-17 08:13:06'),
(265, 3, 'page_view', 'user_behavior', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '183.148.163.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_342122', NULL, 'PKR', '2025-08-20 05:13:06', '2025-09-17 08:13:06'),
(266, 2, 'payment_made', 'business_metrics', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '85.22.235.193', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_229771', 136.00, 'PKR', '2025-08-21 15:13:06', '2025-09-17 08:13:06'),
(267, 1, 'button_click', 'user_behavior', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '90.209.255.191', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_408527', NULL, 'PKR', '2025-08-25 07:13:06', '2025-09-17 08:13:06'),
(268, 3, 'payment_made', 'business_metrics', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '162.232.238.16', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_794044', 1178.00, 'PKR', '2025-09-02 12:13:06', '2025-09-17 08:13:06'),
(269, 2, 'user_registration', 'engagement', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '248.146.43.165', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_305258', NULL, 'PKR', '2025-09-09 10:13:06', '2025-09-17 08:13:06'),
(270, 1, 'form_submit', 'user_behavior', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '79.67.184.96', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_693032', NULL, 'PKR', '2025-09-06 08:13:06', '2025-09-17 08:13:06'),
(271, 3, 'form_submit', 'conversion', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '151.70.211.67', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_387225', NULL, 'PKR', '2025-09-07 00:13:06', '2025-09-17 08:13:06'),
(272, 2, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '172.166.208.185', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_968511', 1786.00, 'PKR', '2025-09-09 07:13:06', '2025-09-17 08:13:06'),
(273, 2, 'driver_verification', 'conversion', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '234.251.180.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_543801', NULL, 'PKR', '2025-09-01 23:13:06', '2025-09-17 08:13:06'),
(274, 2, 'button_click', 'user_behavior', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '228.62.2.201', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_720319', NULL, 'PKR', '2025-09-07 06:13:06', '2025-09-17 08:13:06'),
(275, 1, 'ride_complete', 'conversion', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '128.155.234.239', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_386025', NULL, 'PKR', '2025-09-11 00:13:06', '2025-09-17 08:13:06'),
(276, 1, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '93.92.193.209', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_614995', 402.00, 'PKR', '2025-09-09 00:13:06', '2025-09-17 08:13:06'),
(277, 2, 'payment_made', 'business_metrics', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '53.231.70.76', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_845918', 1296.00, 'PKR', '2025-08-20 00:13:06', '2025-09-17 08:13:06'),
(278, 2, 'page_view', 'business_metrics', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '223.25.159.169', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_527922', NULL, 'PKR', '2025-08-18 13:13:06', '2025-09-17 08:13:06'),
(279, 3, 'page_view', 'business_metrics', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '21.116.150.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_737046', NULL, 'PKR', '2025-08-26 22:13:06', '2025-09-17 08:13:06'),
(280, 2, 'ride_complete', 'engagement', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '252.181.172.98', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_162293', NULL, 'PKR', '2025-09-07 11:13:06', '2025-09-17 08:13:06'),
(281, 1, 'button_click', 'conversion', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '8.176.56.189', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_978753', NULL, 'PKR', '2025-08-22 19:13:06', '2025-09-17 08:13:06'),
(282, 3, 'driver_verification', 'business_metrics', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '44.253.19.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_396564', NULL, 'PKR', '2025-09-04 14:13:06', '2025-09-17 08:13:06'),
(283, 1, 'ride_complete', 'business_metrics', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '250.175.206.57', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_345866', NULL, 'PKR', '2025-08-24 08:13:06', '2025-09-17 08:13:06'),
(284, 3, 'page_view', 'user_behavior', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '31.6.186.141', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_189121', NULL, 'PKR', '2025-09-05 20:13:06', '2025-09-17 08:13:06'),
(285, 3, 'ride_request', 'engagement', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '251.62.9.236', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_499401', NULL, 'PKR', '2025-09-16 03:13:06', '2025-09-17 08:13:06'),
(286, 1, 'button_click', 'business_metrics', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '174.67.129.80', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_629807', NULL, 'PKR', '2025-08-22 23:13:06', '2025-09-17 08:13:06'),
(287, 2, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '79.153.169.254', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_605426', NULL, 'PKR', '2025-09-05 01:13:06', '2025-09-17 08:13:06'),
(288, 1, 'payment_made', 'conversion', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '121.43.115.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_570139', 1276.00, 'PKR', '2025-09-08 23:13:06', '2025-09-17 08:13:06'),
(289, 2, 'form_submit', 'performance', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '59.231.38.188', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_703264', NULL, 'PKR', '2025-08-28 03:13:06', '2025-09-17 08:13:06'),
(290, 2, 'button_click', 'business_metrics', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '5.182.31.87', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_618619', NULL, 'PKR', '2025-09-01 20:13:06', '2025-09-17 08:13:06'),
(291, 2, 'form_submit', 'business_metrics', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '248.228.93.67', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_394287', NULL, 'PKR', '2025-08-31 08:13:06', '2025-09-17 08:13:06'),
(292, 1, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '34.70.52.120', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_297337', NULL, 'PKR', '2025-09-03 09:13:06', '2025-09-17 08:13:06'),
(293, 3, 'ride_complete', 'conversion', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '157.78.67.248', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_627370', NULL, 'PKR', '2025-09-09 01:13:06', '2025-09-17 08:13:06'),
(294, 3, 'form_submit', 'business_metrics', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '215.87.189.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_739394', NULL, 'PKR', '2025-08-18 11:13:06', '2025-09-17 08:13:06'),
(295, 1, 'driver_verification', 'business_metrics', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '36.33.28.205', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_973490', NULL, 'PKR', '2025-09-02 18:13:06', '2025-09-17 08:13:06'),
(296, 2, 'button_click', 'business_metrics', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '8.137.60.174', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_647280', NULL, 'PKR', '2025-09-13 00:13:06', '2025-09-17 08:13:06'),
(297, 1, 'ride_request', 'engagement', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '28.252.32.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_445863', NULL, 'PKR', '2025-09-03 04:13:06', '2025-09-17 08:13:06'),
(298, 1, 'ride_request', 'engagement', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '240.59.162.118', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_498994', NULL, 'PKR', '2025-08-27 09:13:06', '2025-09-17 08:13:06'),
(299, 3, 'driver_verification', 'business_metrics', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '156.214.121.122', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_892202', NULL, 'PKR', '2025-08-19 16:13:06', '2025-09-17 08:13:06'),
(300, 2, 'user_registration', 'engagement', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '39.113.204.159', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_145710', NULL, 'PKR', '2025-08-22 16:13:06', '2025-09-17 08:13:06'),
(301, 3, 'form_submit', 'performance', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '233.131.28.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_813598', NULL, 'PKR', '2025-09-07 06:13:06', '2025-09-17 08:13:06'),
(302, 2, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '24.179.205.33', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_828887', NULL, 'PKR', '2025-09-13 17:13:06', '2025-09-17 08:13:06'),
(303, 1, 'ride_complete', 'performance', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '47.238.60.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_668536', NULL, 'PKR', '2025-08-18 01:13:06', '2025-09-17 08:13:06'),
(304, 2, 'driver_verification', 'performance', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '137.244.149.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_765951', NULL, 'PKR', '2025-09-13 22:13:06', '2025-09-17 08:13:06'),
(305, 3, 'form_submit', 'user_behavior', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '182.102.55.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_453293', NULL, 'PKR', '2025-09-01 18:13:06', '2025-09-17 08:13:06'),
(306, 1, 'form_submit', 'engagement', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '179.70.134.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_226503', NULL, 'PKR', '2025-09-14 20:13:06', '2025-09-17 08:13:06'),
(307, 2, 'ride_request', 'engagement', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '86.72.81.158', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_126392', NULL, 'PKR', '2025-09-01 05:13:06', '2025-09-17 08:13:06'),
(308, 2, 'ride_request', 'business_metrics', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '196.226.172.56', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_766694', NULL, 'PKR', '2025-08-24 12:13:06', '2025-09-17 08:13:06'),
(309, 3, 'page_view', 'business_metrics', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '236.177.196.123', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_167443', NULL, 'PKR', '2025-08-21 18:13:06', '2025-09-17 08:13:06'),
(310, 1, 'button_click', 'performance', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '187.174.160.233', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_584828', NULL, 'PKR', '2025-09-14 21:13:06', '2025-09-17 08:13:06'),
(311, 1, 'ride_complete', 'business_metrics', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '95.140.47.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_760692', NULL, 'PKR', '2025-08-23 07:13:06', '2025-09-17 08:13:06'),
(312, 2, 'form_submit', 'user_behavior', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '109.93.63.111', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_562881', NULL, 'PKR', '2025-08-28 02:13:06', '2025-09-17 08:13:06'),
(313, 3, 'user_registration', 'engagement', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '253.132.60.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_510157', NULL, 'PKR', '2025-09-12 02:13:06', '2025-09-17 08:13:06'),
(314, 3, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '81.214.159.181', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_820527', NULL, 'PKR', '2025-09-08 12:13:06', '2025-09-17 08:13:06'),
(315, 1, 'user_registration', 'engagement', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '49.192.101.105', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_683097', NULL, 'PKR', '2025-09-02 03:13:06', '2025-09-17 08:13:06'),
(316, 1, 'ride_complete', 'business_metrics', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '220.147.187.88', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_995001', NULL, 'PKR', '2025-09-04 10:13:06', '2025-09-17 08:13:06'),
(317, 2, 'button_click', 'conversion', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '220.50.115.2', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_624255', NULL, 'PKR', '2025-09-04 04:13:06', '2025-09-17 08:13:06'),
(318, 3, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '122.51.22.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_204790', NULL, 'PKR', '2025-09-06 05:13:06', '2025-09-17 08:13:06'),
(319, 2, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '99.4.252.154', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_442049', NULL, 'PKR', '2025-08-28 11:13:06', '2025-09-17 08:13:06'),
(320, 2, 'form_submit', 'user_behavior', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '200.75.201.67', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_179811', NULL, 'PKR', '2025-09-08 15:13:06', '2025-09-17 08:13:06'),
(321, 2, 'button_click', 'conversion', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '61.143.142.123', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_251537', NULL, 'PKR', '2025-08-25 17:13:06', '2025-09-17 08:13:06'),
(322, 2, 'ride_complete', 'performance', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '61.116.247.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_668857', NULL, 'PKR', '2025-09-06 22:13:07', '2025-09-17 08:13:07'),
(323, 2, 'driver_verification', 'performance', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '12.251.90.67', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_531984', NULL, 'PKR', '2025-08-20 19:13:07', '2025-09-17 08:13:07'),
(324, 3, 'ride_complete', 'user_behavior', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '136.237.1.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_964159', NULL, 'PKR', '2025-08-21 11:13:07', '2025-09-17 08:13:07'),
(325, 3, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '103.68.193.91', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_930902', NULL, 'PKR', '2025-08-19 14:13:07', '2025-09-17 08:13:07'),
(326, 3, 'ride_request', 'user_behavior', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '163.5.96.40', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_390461', NULL, 'PKR', '2025-09-13 04:13:07', '2025-09-17 08:13:07'),
(327, 3, 'button_click', 'conversion', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '37.254.42.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_842828', NULL, 'PKR', '2025-09-10 20:13:07', '2025-09-17 08:13:07'),
(328, 3, 'form_submit', 'user_behavior', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '117.38.76.229', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_785418', NULL, 'PKR', '2025-08-30 10:13:07', '2025-09-17 08:13:07'),
(329, 1, 'driver_verification', 'user_behavior', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '71.247.233.202', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_389374', NULL, 'PKR', '2025-09-11 12:13:07', '2025-09-17 08:13:07'),
(330, 3, 'button_click', 'business_metrics', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '187.137.177.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_524467', NULL, 'PKR', '2025-08-23 06:13:07', '2025-09-17 08:13:07'),
(331, 1, 'driver_verification', 'user_behavior', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '60.94.211.83', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_189401', NULL, 'PKR', '2025-09-02 11:13:07', '2025-09-17 08:13:07'),
(332, 2, 'page_view', 'conversion', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '160.218.120.222', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_137180', NULL, 'PKR', '2025-09-13 18:13:07', '2025-09-17 08:13:07'),
(333, 2, 'payment_made', 'business_metrics', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '72.245.117.254', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_728832', 828.00, 'PKR', '2025-09-16 18:13:07', '2025-09-17 08:13:07'),
(334, 3, 'page_view', 'performance', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '130.171.81.153', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_642183', NULL, 'PKR', '2025-09-05 10:13:07', '2025-09-17 08:13:07'),
(335, 3, 'form_submit', 'business_metrics', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '251.63.226.228', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_929962', NULL, 'PKR', '2025-08-21 12:13:07', '2025-09-17 08:13:07'),
(336, 2, 'ride_request', 'conversion', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '1.123.140.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_641484', NULL, 'PKR', '2025-09-13 17:13:07', '2025-09-17 08:13:07'),
(337, 1, 'driver_verification', 'conversion', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '8.114.233.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_464583', NULL, 'PKR', '2025-08-21 04:13:07', '2025-09-17 08:13:07'),
(338, 1, 'form_submit', 'engagement', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '154.242.137.248', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_385975', NULL, 'PKR', '2025-09-03 12:13:07', '2025-09-17 08:13:07'),
(339, 1, 'ride_request', 'engagement', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '112.33.239.17', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_908403', NULL, 'PKR', '2025-08-20 06:13:07', '2025-09-17 08:13:07'),
(340, 1, 'ride_request', 'business_metrics', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '100.232.7.227', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_933989', NULL, 'PKR', '2025-08-25 20:13:07', '2025-09-17 08:13:07'),
(341, 2, 'ride_request', 'engagement', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '47.152.180.68', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_687934', NULL, 'PKR', '2025-09-08 13:13:07', '2025-09-17 08:13:07'),
(342, 3, 'payment_made', 'engagement', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '111.26.208.236', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_869488', 812.00, 'PKR', '2025-09-08 17:13:07', '2025-09-17 08:13:07'),
(343, 1, 'user_registration', 'performance', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '71.215.193.28', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_340865', NULL, 'PKR', '2025-08-29 17:13:07', '2025-09-17 08:13:07'),
(344, 2, 'button_click', 'performance', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '248.201.220.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_451938', NULL, 'PKR', '2025-09-07 15:13:07', '2025-09-17 08:13:07');
INSERT INTO `analytics_events` (`id`, `user_id`, `event_type`, `event_category`, `event_name`, `event_properties`, `page_url`, `referrer`, `ip_address`, `user_agent`, `session_id`, `value`, `currency`, `created_at`, `updated_at`) VALUES
(345, 2, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '102.60.177.89', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_802417', NULL, 'PKR', '2025-09-11 12:13:07', '2025-09-17 08:13:07'),
(346, 2, 'ride_complete', 'conversion', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '191.138.70.57', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_414449', NULL, 'PKR', '2025-09-13 15:13:07', '2025-09-17 08:13:07'),
(347, 2, 'ride_request', 'performance', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '111.215.227.116', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_376388', NULL, 'PKR', '2025-08-20 20:13:07', '2025-09-17 08:13:07'),
(348, 1, 'ride_request', 'engagement', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '249.156.19.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_729260', NULL, 'PKR', '2025-09-08 20:13:07', '2025-09-17 08:13:07'),
(349, 3, 'button_click', 'user_behavior', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '127.12.180.248', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_379799', NULL, 'PKR', '2025-09-03 03:13:07', '2025-09-17 08:13:07'),
(350, 1, 'driver_verification', 'conversion', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '187.93.122.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_812270', NULL, 'PKR', '2025-08-19 00:13:07', '2025-09-17 08:13:07'),
(351, 3, 'button_click', 'performance', 'Book Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '188.127.52.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_662307', NULL, 'PKR', '2025-08-18 12:13:07', '2025-09-17 08:13:07'),
(352, 1, 'form_submit', 'business_metrics', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '197.166.56.130', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_403338', NULL, 'PKR', '2025-08-27 23:13:07', '2025-09-17 08:13:07'),
(353, 2, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '115.96.185.20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_985356', NULL, 'PKR', '2025-09-06 09:13:07', '2025-09-17 08:13:07'),
(354, 3, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '174.8.233.177', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_250300', 1006.00, 'PKR', '2025-08-30 23:13:07', '2025-09-17 08:13:07'),
(355, 3, 'form_submit', 'business_metrics', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '118.199.29.180', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_907761', NULL, 'PKR', '2025-09-13 04:13:07', '2025-09-17 08:13:07'),
(356, 1, 'ride_request', 'engagement', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '168.11.220.223', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_580535', NULL, 'PKR', '2025-09-03 07:13:07', '2025-09-17 08:13:07'),
(357, 2, 'form_submit', 'user_behavior', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '78.152.61.152', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_583138', NULL, 'PKR', '2025-09-02 00:13:07', '2025-09-17 08:13:07'),
(358, 3, 'ride_complete', 'performance', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '233.64.23.66', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_112904', NULL, 'PKR', '2025-09-05 07:13:07', '2025-09-17 08:13:07'),
(359, 1, 'driver_verification', 'engagement', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '215.208.3.245', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_545513', NULL, 'PKR', '2025-08-26 22:13:07', '2025-09-17 08:13:07'),
(360, 2, 'user_registration', 'business_metrics', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '118.203.226.42', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_441204', NULL, 'PKR', '2025-08-18 19:13:07', '2025-09-17 08:13:07'),
(361, 3, 'ride_complete', 'business_metrics', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '144.134.166.137', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_565087', NULL, 'PKR', '2025-09-16 04:13:07', '2025-09-17 08:13:07'),
(362, 2, 'form_submit', 'performance', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '134.138.92.135', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_666115', NULL, 'PKR', '2025-08-30 10:13:07', '2025-09-17 08:13:07'),
(363, 2, 'ride_complete', 'engagement', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '159.81.188.180', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_169741', NULL, 'PKR', '2025-08-18 10:13:07', '2025-09-17 08:13:07'),
(364, 1, 'user_registration', 'performance', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '246.215.193.249', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_876243', NULL, 'PKR', '2025-09-06 05:13:07', '2025-09-17 08:13:07'),
(365, 1, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '65.150.92.25', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_587803', NULL, 'PKR', '2025-09-08 10:13:07', '2025-09-17 08:13:07'),
(366, 3, 'form_submit', 'conversion', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '142.132.114.34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_600980', NULL, 'PKR', '2025-09-12 10:13:07', '2025-09-17 08:13:07'),
(367, 1, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '212.54.181.60', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_510904', NULL, 'PKR', '2025-09-03 04:13:07', '2025-09-17 08:13:07'),
(368, 2, 'ride_request', 'user_behavior', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '55.223.192.13', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_144232', NULL, 'PKR', '2025-08-20 21:13:07', '2025-09-17 08:13:07'),
(369, 2, 'driver_verification', 'performance', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '146.125.152.205', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_409289', NULL, 'PKR', '2025-09-13 08:13:07', '2025-09-17 08:13:07'),
(370, 3, 'payment_made', 'user_behavior', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '81.125.109.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_991759', 432.00, 'PKR', '2025-09-11 06:13:07', '2025-09-17 08:13:07'),
(371, 2, 'form_submit', 'engagement', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '90.96.236.112', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_778179', NULL, 'PKR', '2025-08-30 11:13:07', '2025-09-17 08:13:07'),
(372, 1, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '28.111.155.128', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_159209', NULL, 'PKR', '2025-09-05 18:13:07', '2025-09-17 08:13:07'),
(373, 2, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '68.157.173.52', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_541472', NULL, 'PKR', '2025-08-19 07:13:07', '2025-09-17 08:13:07'),
(374, 3, 'payment_made', 'conversion', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '203.8.73.209', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_945239', 1830.00, 'PKR', '2025-08-28 14:13:07', '2025-09-17 08:13:07'),
(375, 1, 'button_click', 'performance', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '54.107.182.159', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_197791', NULL, 'PKR', '2025-09-06 20:13:07', '2025-09-17 08:13:07'),
(376, 2, 'payment_made', 'engagement', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '82.71.134.201', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_656647', 1261.00, 'PKR', '2025-08-28 15:13:07', '2025-09-17 08:13:07'),
(377, 3, 'button_click', 'conversion', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '252.174.172.169', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_291478', NULL, 'PKR', '2025-09-04 01:13:07', '2025-09-17 08:13:07'),
(378, 2, 'form_submit', 'conversion', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '56.143.104.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_245625', NULL, 'PKR', '2025-09-16 20:13:07', '2025-09-17 08:13:07'),
(379, 2, 'payment_made', 'conversion', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '107.51.25.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_491121', 1035.00, 'PKR', '2025-09-07 19:13:07', '2025-09-17 08:13:07'),
(380, 2, 'ride_complete', 'engagement', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '209.182.200.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_931501', NULL, 'PKR', '2025-09-02 13:13:07', '2025-09-17 08:13:07'),
(381, 1, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '58.142.236.27', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_113186', NULL, 'PKR', '2025-09-04 00:13:07', '2025-09-17 08:13:07'),
(382, 3, 'page_view', 'performance', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '121.166.32.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_172907', NULL, 'PKR', '2025-08-24 21:13:07', '2025-09-17 08:13:07'),
(383, 1, 'ride_complete', 'engagement', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '60.224.59.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_305309', NULL, 'PKR', '2025-09-08 05:13:07', '2025-09-17 08:13:07'),
(384, 3, 'payment_made', 'user_behavior', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '102.189.13.131', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_930014', 1833.00, 'PKR', '2025-09-13 19:13:07', '2025-09-17 08:13:07'),
(385, 3, 'button_click', 'business_metrics', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '142.151.188.171', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_568895', NULL, 'PKR', '2025-08-31 02:13:07', '2025-09-17 08:13:07'),
(386, 3, 'ride_complete', 'performance', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '7.151.85.40', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_554122', NULL, 'PKR', '2025-09-16 07:13:07', '2025-09-17 08:13:07'),
(387, 2, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '185.214.185.119', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_113016', NULL, 'PKR', '2025-08-23 19:13:07', '2025-09-17 08:13:07'),
(388, 3, 'user_registration', 'engagement', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '55.201.97.156', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_265562', NULL, 'PKR', '2025-09-01 18:13:07', '2025-09-17 08:13:07'),
(389, 1, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '229.59.85.105', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_242814', NULL, 'PKR', '2025-09-06 06:13:07', '2025-09-17 08:13:07'),
(390, 3, 'form_submit', 'conversion', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '190.235.107.5', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_705256', NULL, 'PKR', '2025-08-27 09:13:07', '2025-09-17 08:13:07'),
(391, 2, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '47.162.213.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_938622', NULL, 'PKR', '2025-09-06 11:13:07', '2025-09-17 08:13:07'),
(392, 1, 'ride_request', 'business_metrics', 'Scheduled Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '78.80.206.50', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_784837', NULL, 'PKR', '2025-09-09 14:13:07', '2025-09-17 08:13:07'),
(393, 2, 'payment_made', 'user_behavior', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '169.173.42.195', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_142764', 1398.00, 'PKR', '2025-09-12 15:13:07', '2025-09-17 08:13:07'),
(394, 3, 'user_registration', 'engagement', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '173.146.244.57', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_838565', NULL, 'PKR', '2025-08-24 21:13:07', '2025-09-17 08:13:07'),
(395, 2, 'ride_request', 'conversion', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '210.102.62.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_317244', NULL, 'PKR', '2025-08-28 22:13:07', '2025-09-17 08:13:07'),
(396, 3, 'user_registration', 'engagement', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '201.48.223.4', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_295176', NULL, 'PKR', '2025-08-28 04:13:07', '2025-09-17 08:13:07'),
(397, 1, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '15.140.185.159', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_665342', NULL, 'PKR', '2025-09-05 07:13:07', '2025-09-17 08:13:07'),
(398, 1, 'driver_verification', 'engagement', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '44.173.104.46', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_545452', NULL, 'PKR', '2025-09-06 13:13:07', '2025-09-17 08:13:07'),
(399, 1, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '164.116.44.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_427652', NULL, 'PKR', '2025-08-26 14:13:07', '2025-09-17 08:13:07'),
(400, 2, 'payment_made', 'performance', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '68.175.176.166', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_226509', 1443.00, 'PKR', '2025-09-14 23:13:07', '2025-09-17 08:13:07'),
(401, 2, 'payment_made', 'performance', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '81.168.219.223', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_869605', 608.00, 'PKR', '2025-08-30 22:13:07', '2025-09-17 08:13:07'),
(402, 3, 'page_view', 'engagement', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '230.181.113.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_555686', NULL, 'PKR', '2025-08-17 21:13:07', '2025-09-17 08:13:07'),
(403, 3, 'driver_verification', 'engagement', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '63.119.199.196', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_647976', NULL, 'PKR', '2025-08-21 06:13:07', '2025-09-17 08:13:07'),
(404, 1, 'payment_made', 'user_behavior', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '58.148.41.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_866291', 638.00, 'PKR', '2025-08-27 02:13:07', '2025-09-17 08:13:07'),
(405, 3, 'page_view', 'user_behavior', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '71.166.11.115', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_656616', NULL, 'PKR', '2025-08-30 21:13:08', '2025-09-17 08:13:08'),
(406, 1, 'button_click', 'business_metrics', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '230.79.154.32', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_352670', NULL, 'PKR', '2025-08-25 17:13:08', '2025-09-17 08:13:08'),
(407, 3, 'payment_made', 'business_metrics', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '46.34.32.251', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_716402', 1013.00, 'PKR', '2025-09-09 13:13:08', '2025-09-17 08:13:08'),
(408, 1, 'ride_request', 'performance', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '206.10.114.189', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_377143', NULL, 'PKR', '2025-08-25 21:13:08', '2025-09-17 08:13:08'),
(409, 2, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '94.113.160.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_131736', NULL, 'PKR', '2025-08-21 10:13:08', '2025-09-17 08:13:08'),
(410, 2, 'form_submit', 'business_metrics', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '84.96.183.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_329518', NULL, 'PKR', '2025-08-25 11:13:08', '2025-09-17 08:13:08'),
(411, 3, 'user_registration', 'business_metrics', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '99.182.61.127', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_793116', NULL, 'PKR', '2025-08-22 00:13:08', '2025-09-17 08:13:08'),
(412, 2, 'ride_complete', 'performance', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '80.138.140.113', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_661333', NULL, 'PKR', '2025-08-17 23:13:08', '2025-09-17 08:13:08'),
(413, 1, 'ride_complete', 'performance', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '244.43.71.86', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_928664', NULL, 'PKR', '2025-08-23 13:13:08', '2025-09-17 08:13:08'),
(414, 1, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '116.146.252.45', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_739188', NULL, 'PKR', '2025-09-05 23:13:08', '2025-09-17 08:13:08'),
(415, 2, 'driver_verification', 'user_behavior', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '134.48.234.141', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_556934', NULL, 'PKR', '2025-08-20 02:13:08', '2025-09-17 08:13:08'),
(416, 1, 'user_registration', 'user_behavior', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '30.129.233.114', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_480433', NULL, 'PKR', '2025-08-19 20:13:08', '2025-09-17 08:13:08'),
(417, 3, 'page_view', 'engagement', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '250.92.80.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_578530', NULL, 'PKR', '2025-09-03 05:13:08', '2025-09-17 08:13:08'),
(418, 3, 'ride_complete', 'engagement', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '22.244.245.21', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_944774', NULL, 'PKR', '2025-09-01 18:13:08', '2025-09-17 08:13:08'),
(419, 1, 'page_view', 'performance', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '54.131.125.114', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_826058', NULL, 'PKR', '2025-08-24 20:13:08', '2025-09-17 08:13:08'),
(420, 2, 'ride_complete', 'conversion', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '14.58.4.240', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_221413', NULL, 'PKR', '2025-09-10 01:13:08', '2025-09-17 08:13:08'),
(421, 2, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '80.178.221.46', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_322107', NULL, 'PKR', '2025-09-07 17:13:08', '2025-09-17 08:13:08'),
(422, 1, 'payment_made', 'engagement', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '122.110.243.162', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_769428', 687.00, 'PKR', '2025-09-12 18:13:08', '2025-09-17 08:13:08'),
(423, 1, 'ride_request', 'user_behavior', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '92.230.251.179', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_414376', NULL, 'PKR', '2025-09-08 11:13:08', '2025-09-17 08:13:08'),
(424, 1, 'ride_complete', 'user_behavior', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '75.127.174.111', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_987410', NULL, 'PKR', '2025-09-04 10:13:08', '2025-09-17 08:13:08'),
(425, 2, 'button_click', 'business_metrics', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '188.232.36.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_304853', NULL, 'PKR', '2025-09-16 12:13:08', '2025-09-17 08:13:08'),
(426, 3, 'form_submit', 'engagement', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '203.90.64.218', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_334766', NULL, 'PKR', '2025-08-18 03:13:08', '2025-09-17 08:13:08'),
(427, 2, 'form_submit', 'user_behavior', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '237.112.2.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_157782', NULL, 'PKR', '2025-08-26 17:13:08', '2025-09-17 08:13:08'),
(428, 3, 'form_submit', 'user_behavior', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '219.148.199.226', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_245930', NULL, 'PKR', '2025-09-08 08:13:08', '2025-09-17 08:13:08'),
(429, 2, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '84.156.233.171', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_448992', NULL, 'PKR', '2025-08-24 11:13:08', '2025-09-17 08:13:08'),
(430, 2, 'payment_made', 'performance', 'Commission Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '6.182.60.163', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_594725', 250.00, 'PKR', '2025-09-17 03:13:08', '2025-09-17 08:13:08'),
(431, 2, 'ride_complete', 'conversion', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '80.243.71.22', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_683268', NULL, 'PKR', '2025-09-08 00:13:08', '2025-09-17 08:13:08'),
(432, 1, 'form_submit', 'business_metrics', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '235.20.25.119', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_487493', NULL, 'PKR', '2025-09-12 00:13:08', '2025-09-17 08:13:08'),
(433, 3, 'button_click', 'engagement', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '89.131.73.219', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_770322', NULL, 'PKR', '2025-08-27 06:13:08', '2025-09-17 08:13:08'),
(434, 2, 'user_registration', 'performance', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '57.203.249.175', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_385278', NULL, 'PKR', '2025-08-17 17:13:08', '2025-09-17 08:13:08'),
(435, 2, 'form_submit', 'performance', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '209.150.92.119', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_775939', NULL, 'PKR', '2025-09-06 19:13:08', '2025-09-17 08:13:08'),
(436, 3, 'page_view', 'conversion', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '187.202.246.82', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_970067', NULL, 'PKR', '2025-09-14 23:13:08', '2025-09-17 08:13:08'),
(437, 2, 'ride_complete', 'conversion', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '83.110.44.87', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_875962', NULL, 'PKR', '2025-09-05 03:13:08', '2025-09-17 08:13:08'),
(438, 3, 'page_view', 'performance', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '56.4.237.215', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_944269', NULL, 'PKR', '2025-08-20 02:13:08', '2025-09-17 08:13:08'),
(439, 1, 'form_submit', 'engagement', 'Registration Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '156.168.197.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_480236', NULL, 'PKR', '2025-09-14 10:13:08', '2025-09-17 08:13:08'),
(440, 3, 'button_click', 'engagement', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '87.83.190.196', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_545549', NULL, 'PKR', '2025-08-25 12:13:08', '2025-09-17 08:13:08'),
(441, 2, 'user_registration', 'engagement', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '103.6.239.212', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_545601', NULL, 'PKR', '2025-09-06 22:13:08', '2025-09-17 08:13:08'),
(442, 3, 'driver_verification', 'business_metrics', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '122.32.254.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_986651', NULL, 'PKR', '2025-08-25 09:13:08', '2025-09-17 08:13:08'),
(443, 2, 'payment_made', 'performance', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '74.107.229.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_595961', 1895.00, 'PKR', '2025-09-07 10:13:08', '2025-09-17 08:13:08'),
(444, 3, 'driver_verification', 'engagement', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '32.164.237.36', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_267834', NULL, 'PKR', '2025-09-13 23:13:08', '2025-09-17 08:13:08'),
(445, 3, 'payment_made', 'business_metrics', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '247.141.52.95', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_317137', 1100.00, 'PKR', '2025-08-21 22:13:08', '2025-09-17 08:13:08'),
(446, 3, 'driver_verification', 'conversion', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '118.15.28.142', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_482694', NULL, 'PKR', '2025-09-15 08:13:08', '2025-09-17 08:13:08'),
(447, 1, 'ride_complete', 'user_behavior', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '127.119.58.199', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_321998', NULL, 'PKR', '2025-08-29 15:13:08', '2025-09-17 08:13:08'),
(448, 1, 'user_registration', 'business_metrics', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '131.75.227.227', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_705476', NULL, 'PKR', '2025-08-25 00:13:08', '2025-09-17 08:13:08'),
(449, 3, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '204.6.191.166', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_188257', NULL, 'PKR', '2025-09-15 20:13:08', '2025-09-17 08:13:08'),
(450, 1, 'ride_complete', 'business_metrics', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '251.25.119.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_520384', NULL, 'PKR', '2025-09-14 17:13:08', '2025-09-17 08:13:08'),
(451, 1, 'driver_verification', 'business_metrics', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '167.63.192.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_128424', NULL, 'PKR', '2025-09-11 04:13:08', '2025-09-17 08:13:08'),
(452, 1, 'ride_complete', 'engagement', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '151.110.116.39', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_791741', NULL, 'PKR', '2025-08-31 14:13:08', '2025-09-17 08:13:08'),
(453, 2, 'payment_made', 'user_behavior', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '224.192.185.194', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_596068', 1978.00, 'PKR', '2025-09-15 01:13:08', '2025-09-17 08:13:08'),
(454, 1, 'driver_verification', 'user_behavior', 'Verification Rejected', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '183.234.79.131', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_351209', NULL, 'PKR', '2025-09-10 04:13:08', '2025-09-17 08:13:08'),
(455, 2, 'ride_request', 'performance', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '46.192.172.76', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_733406', NULL, 'PKR', '2025-08-28 03:13:08', '2025-09-17 08:13:08'),
(456, 1, 'form_submit', 'user_behavior', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '218.122.247.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_499841', NULL, 'PKR', '2025-08-21 19:13:08', '2025-09-17 08:13:08'),
(457, 2, 'payment_made', 'performance', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '138.216.194.161', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_897188', 965.00, 'PKR', '2025-08-22 21:13:08', '2025-09-17 08:13:08'),
(458, 2, 'driver_verification', 'performance', 'Verification Approved', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '6.123.45.175', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_784858', NULL, 'PKR', '2025-08-31 13:13:08', '2025-09-17 08:13:08'),
(459, 1, 'user_registration', 'performance', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '50.88.19.229', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_655849', NULL, 'PKR', '2025-09-17 03:13:08', '2025-09-17 08:13:08');
INSERT INTO `analytics_events` (`id`, `user_id`, `event_type`, `event_category`, `event_name`, `event_properties`, `page_url`, `referrer`, `ip_address`, `user_agent`, `session_id`, `value`, `currency`, `created_at`, `updated_at`) VALUES
(460, 3, 'form_submit', 'performance', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '28.114.171.76', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_641330', NULL, 'PKR', '2025-09-02 06:13:08', '2025-09-17 08:13:08'),
(461, 3, 'ride_complete', 'performance', 'Payment Processed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '159.240.14.70', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_455832', NULL, 'PKR', '2025-09-01 19:13:08', '2025-09-17 08:13:08'),
(462, 2, 'button_click', 'engagement', 'Cancel Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '161.28.227.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_529268', NULL, 'PKR', '2025-08-21 20:13:09', '2025-09-17 08:13:09'),
(463, 2, 'ride_request', 'user_behavior', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '244.78.207.152', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_850455', NULL, 'PKR', '2025-09-10 23:13:09', '2025-09-17 08:13:09'),
(464, 3, 'form_submit', 'performance', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '109.151.159.77', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_737438', NULL, 'PKR', '2025-09-15 06:13:09', '2025-09-17 08:13:09'),
(465, 1, 'form_submit', 'business_metrics', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '131.37.38.220', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_625279', NULL, 'PKR', '2025-08-22 03:13:09', '2025-09-17 08:13:09'),
(466, 3, 'user_registration', 'performance', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '51.229.68.75', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_496118', NULL, 'PKR', '2025-08-17 11:13:09', '2025-09-17 08:13:09'),
(467, 1, 'driver_verification', 'user_behavior', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '79.179.213.154', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_800044', NULL, 'PKR', '2025-09-04 18:13:09', '2025-09-17 08:13:09'),
(468, 2, 'page_view', 'conversion', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '87.81.182.167', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_770708', NULL, 'PKR', '2025-09-09 13:13:09', '2025-09-17 08:13:09'),
(469, 2, 'user_registration', 'performance', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '66.8.48.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_558827', NULL, 'PKR', '2025-08-28 06:13:09', '2025-09-17 08:13:09'),
(470, 2, 'ride_complete', 'business_metrics', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '99.208.105.24', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_666620', NULL, 'PKR', '2025-08-19 08:13:09', '2025-09-17 08:13:09'),
(471, 2, 'page_view', 'user_behavior', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '119.120.79.141', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_735730', NULL, 'PKR', '2025-09-09 01:13:09', '2025-09-17 08:13:09'),
(472, 2, 'button_click', 'performance', 'Submit Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '21.31.214.174', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_719527', NULL, 'PKR', '2025-09-09 15:13:10', '2025-09-17 08:13:10'),
(473, 3, 'page_view', 'engagement', 'Dashboard View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '147.143.74.128', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_266827', NULL, 'PKR', '2025-09-16 04:13:10', '2025-09-17 08:13:10'),
(474, 3, 'ride_request', 'business_metrics', 'Instant Ride', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '54.124.68.182', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_603262', NULL, 'PKR', '2025-08-19 08:13:10', '2025-09-17 08:13:10'),
(475, 1, 'user_registration', 'business_metrics', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '185.142.205.197', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_378070', NULL, 'PKR', '2025-08-21 04:13:10', '2025-09-17 08:13:10'),
(476, 1, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '250.124.66.207', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_928090', NULL, 'PKR', '2025-09-06 04:13:10', '2025-09-17 08:13:10'),
(477, 3, 'ride_request', 'conversion', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '70.126.71.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_595801', NULL, 'PKR', '2025-09-17 01:13:10', '2025-09-17 08:13:10'),
(478, 1, 'button_click', 'engagement', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '87.168.103.253', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_462581', NULL, 'PKR', '2025-09-09 16:13:10', '2025-09-17 08:13:10'),
(479, 2, 'ride_complete', 'conversion', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '163.6.93.137', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_879008', NULL, 'PKR', '2025-09-08 06:13:10', '2025-09-17 08:13:10'),
(480, 3, 'form_submit', 'conversion', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '62.168.212.75', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_430801', NULL, 'PKR', '2025-09-07 12:13:10', '2025-09-17 08:13:10'),
(481, 1, 'form_submit', 'user_behavior', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '205.192.187.64', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_486711', NULL, 'PKR', '2025-09-14 05:13:10', '2025-09-17 08:13:10'),
(482, 1, 'ride_complete', 'conversion', 'Rating Submitted', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '253.173.253.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_464451', NULL, 'PKR', '2025-09-01 20:13:10', '2025-09-17 08:13:10'),
(483, 3, 'ride_complete', 'performance', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '251.112.2.252', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_184149', NULL, 'PKR', '2025-08-20 22:13:10', '2025-09-17 08:13:10'),
(484, 3, 'ride_request', 'performance', 'Ride Cancellation', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '88.198.6.194', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_531413', NULL, 'PKR', '2025-09-07 20:13:10', '2025-09-17 08:13:10'),
(485, 3, 'user_registration', 'engagement', 'Driver Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '7.122.91.62', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_805919', NULL, 'PKR', '2025-09-02 06:13:10', '2025-09-17 08:13:10'),
(486, 1, 'page_view', 'performance', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '151.181.73.93', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_536868', NULL, 'PKR', '2025-08-18 00:13:10', '2025-09-17 08:13:10'),
(487, 3, 'user_registration', 'user_behavior', 'Admin Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '77.176.71.124', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_401311', NULL, 'PKR', '2025-08-25 08:13:10', '2025-09-17 08:13:10'),
(488, 3, 'form_submit', 'performance', 'Feedback Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '221.52.87.217', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_934508', NULL, 'PKR', '2025-09-05 09:13:10', '2025-09-17 08:13:10'),
(489, 1, 'page_view', 'business_metrics', 'Profile View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '24.75.206.60', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_891355', NULL, 'PKR', '2025-09-11 10:13:10', '2025-09-17 08:13:10'),
(490, 2, 'form_submit', 'business_metrics', 'Driver Application', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '24.227.47.121', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_497618', NULL, 'PKR', '2025-09-04 23:13:10', '2025-09-17 08:13:10'),
(491, 2, 'page_view', 'conversion', 'Settings View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '178.10.233.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_570706', NULL, 'PKR', '2025-09-07 12:13:10', '2025-09-17 08:13:10'),
(492, 3, 'button_click', 'user_behavior', 'Update Profile', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '219.208.173.195', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_940539', NULL, 'PKR', '2025-08-25 16:13:10', '2025-09-17 08:13:10'),
(493, 1, 'page_view', 'performance', 'Ride History View', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '147.126.176.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_225612', NULL, 'PKR', '2025-08-25 08:13:10', '2025-09-17 08:13:10'),
(494, 1, 'driver_verification', 'user_behavior', 'Document Upload', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '176.105.197.47', 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0', 'session_428903', NULL, 'PKR', '2025-08-19 02:13:10', '2025-09-17 08:13:10'),
(495, 2, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '230.158.13.200', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_532244', NULL, 'PKR', '2025-09-14 03:13:10', '2025-09-17 08:13:10'),
(496, 1, 'user_registration', 'user_behavior', 'Passenger Registration', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '116.163.14.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_778927', NULL, 'PKR', '2025-08-28 01:13:10', '2025-09-17 08:13:10'),
(497, 2, 'payment_made', 'user_behavior', 'Wallet Top-up', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '198.102.101.226', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_736479', 1686.00, 'PKR', '2025-08-25 15:13:10', '2025-09-17 08:13:10'),
(498, 3, 'payment_made', 'user_behavior', 'Ride Payment', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '4.114.171.175', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_485056', 516.00, 'PKR', '2025-08-17 14:13:10', '2025-09-17 08:13:10'),
(499, 1, 'ride_complete', 'user_behavior', 'Ride Completed', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '19.5.13.66', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1', 'session_130036', NULL, 'PKR', '2025-09-10 01:13:10', '2025-09-17 08:13:10'),
(500, 2, 'form_submit', 'engagement', 'Contact Form', '{\"page\": \"/dashboard\", \"device\": \"mobile\", \"browser\": \"Chrome\", \"section\": \"main\"}', 'https://raah-e-haq.com/dashboard', 'https://google.com', '109.146.134.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_397965', NULL, 'PKR', '2025-09-05 20:13:10', '2025-09-17 08:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `key`, `value`, `type`, `category`, `description`, `is_public`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'Raah-e-Haq', 'string', 'general', 'Application name', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(2, 'app_version', '1.0.0', 'string', 'general', 'Application version', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(3, 'maintenance_mode', '0', 'boolean', 'general', 'Enable maintenance mode', 0, '2025-09-17 07:31:43', '2025-09-17 07:32:16'),
(4, 'support_email', 'support@raah-e-haq.com', 'string', 'general', 'Support email address', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(5, 'support_phone', '+92-300-1234567', 'string', 'general', 'Support phone number', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(6, 'base_fare', '50', 'number', 'fare', 'Base fare in PKR', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(7, 'per_km_rate', '15', 'number', 'fare', 'Rate per kilometer in PKR', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(8, 'per_minute_rate', '2', 'number', 'fare', 'Rate per minute in PKR', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(9, 'minimum_fare', '100', 'number', 'fare', 'Minimum fare in PKR', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(10, 'surge_multiplier', '1.5', 'number', 'fare', 'Surge pricing multiplier', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(11, 'platform_commission', '0.15', 'number', 'fare', 'Platform commission percentage (0.15 = 15%)', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(12, 'driver_commission', '0.85', 'number', 'fare', 'Driver commission percentage (0.85 = 85%)', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(13, 'push_notifications_enabled', '1', 'boolean', 'notification', 'Enable push notifications', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(14, 'email_notifications_enabled', '1', 'boolean', 'notification', 'Enable email notifications', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(15, 'sms_notifications_enabled', '0', 'boolean', 'notification', 'Enable SMS notifications', 0, '2025-09-17 07:31:43', '2025-09-17 07:32:17'),
(16, 'notification_sound', '1', 'boolean', 'notification', 'Enable notification sounds', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(17, 'ride_reminder_minutes', '5', 'number', 'notification', 'Ride reminder minutes before pickup', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(18, 'max_passengers', '4', 'number', 'app', 'Maximum passengers per ride', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(19, 'ride_timeout_minutes', '10', 'number', 'app', 'Ride request timeout in minutes', 0, '2025-09-17 07:31:43', '2025-09-17 07:31:43'),
(20, 'driver_search_radius', '5', 'number', 'app', 'Driver search radius in kilometers', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(21, 'auto_assign_drivers', '1', 'boolean', 'app', 'Automatically assign drivers to rides', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(22, 'allow_scheduled_rides', '1', 'boolean', 'app', 'Allow scheduled rides', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(23, 'max_schedule_days', '7', 'number', 'app', 'Maximum days for scheduling rides', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(24, 'require_phone_verification', '1', 'boolean', 'security', 'Require phone number verification', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(25, 'require_driver_verification', '1', 'boolean', 'security', 'Require driver verification', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(26, 'max_login_attempts', '5', 'number', 'security', 'Maximum login attempts before lockout', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(27, 'session_timeout_minutes', '60', 'number', 'security', 'Session timeout in minutes', 0, '2025-09-17 07:31:44', '2025-09-17 07:31:44'),
(28, 'enable_two_factor', '0', 'boolean', 'security', 'Enable two-factor authentication', 0, '2025-09-17 07:31:44', '2025-09-17 07:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `severity` enum('low','medium','high','critical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `model_type`, `model_id`, `old_values`, `new_values`, `description`, `ip_address`, `user_agent`, `session_id`, `severity`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 1, 'logout', NULL, NULL, NULL, NULL, 'User Admin User logged out', '58.101.160.76', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_991396', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-24 22:48:18', '2025-09-17 07:48:18'),
(2, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '33.118.48.13', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_230711', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-20 08:48:18', '2025-09-17 07:48:18'),
(3, 3, 'delete', 'User', 3, NULL, NULL, 'User Test Passenger deleted a record', '130.94.122.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_910236', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-08 11:48:18', '2025-09-17 07:48:18'),
(4, 1, 'view', 'User', 1, NULL, NULL, 'User Admin User viewed records', '144.137.204.118', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_550388', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-31 00:48:18', '2025-09-17 07:48:18'),
(5, 1, 'login', NULL, NULL, NULL, NULL, 'User Admin User logged in successfully', '233.183.81.249', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_309478', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-13 08:48:18', '2025-09-17 07:48:18'),
(6, 2, 'logout', NULL, NULL, NULL, NULL, 'User Test Driver logged out', '198.60.206.232', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_551247', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-06 08:48:18', '2025-09-17 07:48:18'),
(7, 3, 'delete', 'User', 3, NULL, NULL, 'User Test Passenger deleted a record', '208.200.233.213', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_108538', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-01 01:48:18', '2025-09-17 07:48:18'),
(8, 2, 'logout', NULL, NULL, NULL, NULL, 'User Test Driver logged out', '82.195.149.46', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_501493', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-14 12:48:18', '2025-09-17 07:48:18'),
(9, 2, 'view', 'User', 2, NULL, NULL, 'User Test Driver viewed records', '117.245.248.3', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_380653', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-06 11:48:18', '2025-09-17 07:48:18'),
(10, 3, 'delete', 'User', 3, NULL, NULL, 'User Test Passenger deleted a record', '171.45.251.41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_278572', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-28 05:48:18', '2025-09-17 07:48:18'),
(11, 3, 'update', 'User', 3, NULL, NULL, 'User Test Passenger updated a record', '165.80.146.145', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_108462', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-12 12:48:18', '2025-09-17 07:48:18'),
(12, 2, 'view', 'User', 2, NULL, NULL, 'User Test Driver viewed records', '181.42.12.99', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_147687', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-16 20:48:18', '2025-09-17 07:48:18'),
(13, 3, 'logout', NULL, NULL, NULL, NULL, 'User Test Passenger logged out', '174.254.99.9', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_421445', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-17 20:48:18', '2025-09-17 07:48:18'),
(14, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '230.64.121.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_759871', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-14 09:48:18', '2025-09-17 07:48:18'),
(15, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '241.42.219.165', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_961097', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-18 03:48:18', '2025-09-17 07:48:18'),
(16, 3, 'login', NULL, NULL, NULL, NULL, 'User Test Passenger logged in successfully', '200.85.100.21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_144814', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-02 13:48:18', '2025-09-17 07:48:18'),
(17, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '59.14.171.23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_554491', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-04 20:48:18', '2025-09-17 07:48:18'),
(18, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '120.46.188.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_124873', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-16 06:48:19', '2025-09-17 07:48:19'),
(19, 3, 'logout', NULL, NULL, NULL, NULL, 'User Test Passenger logged out', '1.169.10.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_783790', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-25 05:48:19', '2025-09-17 07:48:19'),
(20, 2, 'view', 'User', 2, NULL, NULL, 'User Test Driver viewed records', '253.130.22.144', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_156459', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-20 14:48:19', '2025-09-17 07:48:19'),
(21, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '39.153.105.35', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_381301', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-31 14:48:19', '2025-09-17 07:48:19'),
(22, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '154.23.44.110', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_142698', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-27 11:48:19', '2025-09-17 07:48:19'),
(23, 1, 'login', NULL, NULL, NULL, NULL, 'User Admin User logged in successfully', '240.165.223.25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_932572', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-24 05:48:19', '2025-09-17 07:48:19'),
(24, 1, 'logout', NULL, NULL, NULL, NULL, 'User Admin User logged out', '44.95.151.9', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_380410', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-27 05:48:19', '2025-09-17 07:48:19'),
(25, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '174.187.133.145', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_302340', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-09 16:48:19', '2025-09-17 07:48:19'),
(26, 1, 'view', 'User', 1, NULL, NULL, 'User Admin User viewed records', '124.172.29.32', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_379228', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-01 07:48:19', '2025-09-17 07:48:19'),
(27, 3, 'logout', NULL, NULL, NULL, NULL, 'User Test Passenger logged out', '173.195.42.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_248644', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-22 12:48:19', '2025-09-17 07:48:19'),
(28, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '95.18.195.128', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_338858', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-14 15:48:19', '2025-09-17 07:48:19'),
(29, 3, 'login', NULL, NULL, NULL, NULL, 'User Test Passenger logged in successfully', '32.27.214.195', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_412054', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-12 03:48:19', '2025-09-17 07:48:19'),
(30, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '149.40.37.172', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_205786', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-02 21:48:19', '2025-09-17 07:48:19'),
(31, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '184.116.174.218', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_337282', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-25 18:48:19', '2025-09-17 07:48:19'),
(32, 3, 'delete', 'User', 3, NULL, NULL, 'User Test Passenger deleted a record', '14.9.96.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_621611', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-16 07:48:19', '2025-09-17 07:48:19'),
(33, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '255.172.203.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_706837', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-19 02:48:19', '2025-09-17 07:48:19'),
(34, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '64.92.97.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_124181', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-28 00:48:19', '2025-09-17 07:48:19'),
(35, 1, 'login', NULL, NULL, NULL, NULL, 'User Admin User logged in successfully', '80.244.230.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_396602', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-24 07:48:19', '2025-09-17 07:48:19'),
(36, 2, 'login', NULL, NULL, NULL, NULL, 'User Test Driver logged in successfully', '192.85.244.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_516724', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-28 22:48:19', '2025-09-17 07:48:19'),
(37, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '99.83.84.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_826567', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-19 22:48:19', '2025-09-17 07:48:19'),
(38, 1, 'create', 'User', 1, NULL, NULL, 'User Admin User created a new record', '56.208.37.224', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_807986', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-08 23:48:19', '2025-09-17 07:48:19'),
(39, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '65.89.193.81', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_310049', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-01 18:48:19', '2025-09-17 07:48:19'),
(40, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '200.27.249.201', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_882802', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-30 15:48:19', '2025-09-17 07:48:19'),
(41, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '229.4.153.219', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_725820', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-04 12:48:19', '2025-09-17 07:48:19'),
(42, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '82.35.98.120', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_306034', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-15 00:48:19', '2025-09-17 07:48:19'),
(43, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '67.25.178.49', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_899602', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-22 20:48:19', '2025-09-17 07:48:19'),
(44, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '237.252.160.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_665447', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-06 10:48:19', '2025-09-17 07:48:19'),
(45, 1, 'login', NULL, NULL, NULL, NULL, 'User Admin User logged in successfully', '126.96.79.249', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_970043', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-03 03:48:19', '2025-09-17 07:48:19'),
(46, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '32.242.148.116', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_406534', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-17 08:48:19', '2025-09-17 07:48:19'),
(47, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '168.182.221.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_230457', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-21 01:48:19', '2025-09-17 07:48:19'),
(48, 1, 'login', NULL, NULL, NULL, NULL, 'User Admin User logged in successfully', '62.28.43.149', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_669882', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-18 02:48:19', '2025-09-17 07:48:19'),
(49, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '74.233.18.75', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_126446', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-26 04:48:19', '2025-09-17 07:48:19'),
(50, 2, 'update', 'User', 2, NULL, NULL, 'User Test Driver updated a record', '19.214.171.106', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_467017', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-20 05:48:19', '2025-09-17 07:48:19'),
(51, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '125.246.212.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_457084', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-04 09:48:19', '2025-09-17 07:48:19'),
(52, 1, 'login', NULL, NULL, NULL, NULL, 'User Admin User logged in successfully', '88.44.36.2', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_389158', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-12 13:48:19', '2025-09-17 07:48:19'),
(53, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '103.241.158.158', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_520607', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-04 09:48:19', '2025-09-17 07:48:19'),
(54, 3, 'view', 'User', 3, NULL, NULL, 'User Test Passenger viewed records', '84.19.111.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_975109', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-03 00:48:19', '2025-09-17 07:48:19'),
(55, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '30.26.136.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_812761', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(56, 1, 'view', 'User', 1, NULL, NULL, 'User Admin User viewed records', '187.51.201.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_107535', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-18 14:48:19', '2025-09-17 07:48:19'),
(57, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '251.90.237.130', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_427022', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-06 11:48:19', '2025-09-17 07:48:19'),
(58, 2, 'logout', NULL, NULL, NULL, NULL, 'User Test Driver logged out', '66.56.30.33', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_508891', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-18 03:48:19', '2025-09-17 07:48:19'),
(59, 1, 'update', 'User', 1, NULL, NULL, 'User Admin User updated a record', '112.27.251.238', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_936595', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-30 22:48:19', '2025-09-17 07:48:19'),
(60, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '109.130.65.118', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_742688', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-08 03:48:19', '2025-09-17 07:48:19'),
(61, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '199.232.104.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_194278', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-06 10:48:19', '2025-09-17 07:48:19'),
(62, 3, 'update', 'User', 3, NULL, NULL, 'User Test Passenger updated a record', '227.109.116.203', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_889724', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-10 16:48:19', '2025-09-17 07:48:19'),
(63, 2, 'login', NULL, NULL, NULL, NULL, 'User Test Driver logged in successfully', '196.220.125.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_761170', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-01 05:48:19', '2025-09-17 07:48:19'),
(64, 1, 'view', 'User', 1, NULL, NULL, 'User Admin User viewed records', '6.29.190.243', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_699728', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-27 07:48:19', '2025-09-17 07:48:19'),
(65, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '134.8.152.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_938267', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-04 10:48:19', '2025-09-17 07:48:19'),
(66, 3, 'view', 'User', 3, NULL, NULL, 'User Test Passenger viewed records', '10.104.120.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_553564', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-16 01:48:19', '2025-09-17 07:48:19'),
(67, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '123.204.251.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_379135', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-28 23:48:19', '2025-09-17 07:48:19'),
(68, 1, 'logout', NULL, NULL, NULL, NULL, 'User Admin User logged out', '245.28.224.14', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_988971', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-19 08:48:19', '2025-09-17 07:48:19'),
(69, 2, 'view', 'User', 2, NULL, NULL, 'User Test Driver viewed records', '51.119.178.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_715611', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-24 07:48:19', '2025-09-17 07:48:19'),
(70, 3, 'view', 'User', 3, NULL, NULL, 'User Test Passenger viewed records', '159.88.183.40', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_855220', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-16 14:48:19', '2025-09-17 07:48:19'),
(71, 1, 'create', 'User', 1, NULL, NULL, 'User Admin User created a new record', '191.183.22.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_131951', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-09 06:48:19', '2025-09-17 07:48:19'),
(72, 3, 'update', 'User', 3, NULL, NULL, 'User Test Passenger updated a record', '9.11.70.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_492740', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-24 01:48:19', '2025-09-17 07:48:19'),
(73, 1, 'create', 'User', 1, NULL, NULL, 'User Admin User created a new record', '227.89.12.125', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_621024', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-09 13:48:19', '2025-09-17 07:48:19'),
(74, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '153.43.155.90', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_193410', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-25 14:48:19', '2025-09-17 07:48:19'),
(75, 3, 'view', 'User', 3, NULL, NULL, 'User Test Passenger viewed records', '237.212.42.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_772552', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-13 01:48:19', '2025-09-17 07:48:19'),
(76, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '134.115.192.130', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_663308', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-30 22:48:19', '2025-09-17 07:48:19'),
(77, 1, 'logout', NULL, NULL, NULL, NULL, 'User Admin User logged out', '115.49.35.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_933441', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-15 12:48:19', '2025-09-17 07:48:19'),
(78, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '83.246.23.148', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_706770', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-26 03:48:19', '2025-09-17 07:48:19'),
(79, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '2.199.124.91', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_397840', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-19 12:48:19', '2025-09-17 07:48:19'),
(80, 2, 'export', 'User', 2, NULL, NULL, 'User Test Driver exported data', '203.107.79.131', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_498787', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-09 23:48:19', '2025-09-17 07:48:19'),
(81, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '151.149.19.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_234833', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-18 10:48:19', '2025-09-17 07:48:19'),
(82, 1, 'create', 'User', 1, NULL, NULL, 'User Admin User created a new record', '198.193.233.179', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_916724', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-15 11:48:19', '2025-09-17 07:48:19'),
(83, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '66.207.216.238', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_599658', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-16 06:48:19', '2025-09-17 07:48:19'),
(84, 3, 'create', 'User', 3, NULL, NULL, 'User Test Passenger created a new record', '100.137.191.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_406814', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-19 00:48:19', '2025-09-17 07:48:19'),
(85, 2, 'logout', NULL, NULL, NULL, NULL, 'User Test Driver logged out', '124.160.2.49', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_963026', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-24 00:48:19', '2025-09-17 07:48:19'),
(86, 3, 'update', 'User', 3, NULL, NULL, 'User Test Passenger updated a record', '246.118.188.25', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_404915', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-18 12:48:19', '2025-09-17 07:48:19'),
(87, 3, 'update', 'User', 3, NULL, NULL, 'User Test Passenger updated a record', '110.140.116.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_646748', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-10 22:48:19', '2025-09-17 07:48:19'),
(88, 3, 'export', 'User', 3, NULL, NULL, 'User Test Passenger exported data', '230.37.54.246', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_402500', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-11 22:48:19', '2025-09-17 07:48:19'),
(89, 3, 'logout', NULL, NULL, NULL, NULL, 'User Test Passenger logged out', '79.1.219.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_211687', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-26 18:48:19', '2025-09-17 07:48:19'),
(90, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '66.113.183.73', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_206243', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-25 02:48:19', '2025-09-17 07:48:19'),
(91, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '212.247.138.154', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_941564', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-14 01:48:19', '2025-09-17 07:48:19'),
(92, 1, 'export', 'User', 1, NULL, NULL, 'User Admin User exported data', '224.29.140.38', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_142708', 'high', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-28 10:48:19', '2025-09-17 07:48:19'),
(93, 1, 'update', 'User', 1, NULL, NULL, 'User Admin User updated a record', '123.97.72.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_578267', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-23 20:48:19', '2025-09-17 07:48:19'),
(94, 2, 'create', 'User', 2, NULL, NULL, 'User Test Driver created a new record', '230.54.86.125', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_226538', 'low', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-17 13:48:19', '2025-09-17 07:48:19'),
(95, 2, 'export', 'User', 2, NULL, NULL, 'User Test Driver exported data', '168.212.31.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_629778', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-03 15:48:19', '2025-09-17 07:48:19'),
(96, 2, 'delete', 'User', 2, NULL, NULL, 'User Test Driver deleted a record', '32.255.40.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'session_841684', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-25 22:48:19', '2025-09-17 07:48:19'),
(97, 3, 'logout', NULL, NULL, NULL, NULL, 'User Test Passenger logged out', '6.89.20.4', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_374343', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-26 12:48:19', '2025-09-17 07:48:19'),
(98, 2, 'export', 'User', 2, NULL, NULL, 'User Test Driver exported data', '42.236.7.231', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_492302', 'medium', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-09-11 05:48:19', '2025-09-17 07:48:19'),
(99, 1, 'update', 'User', 1, NULL, NULL, 'User Admin User updated a record', '222.62.60.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'session_300332', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-21 05:48:19', '2025-09-17 07:48:19'),
(100, 1, 'delete', 'User', 1, NULL, NULL, 'User Admin User deleted a record', '125.240.49.189', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'session_797279', 'critical', '{\"os\": \"Windows\", \"browser\": \"Chrome\"}', '2025-08-19 03:48:19', '2025-09-17 07:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('promotion','announcement','feature','advertisement') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'promotion',
  `position` enum('home_top','home_middle','home_bottom','ride_complete','profile') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home_top',
  `target_audience` enum('all','passengers','drivers') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT '0',
  `click_count` int NOT NULL DEFAULT '0',
  `view_count` int NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `image_url`, `action_url`, `action_text`, `type`, `position`, `target_audience`, `is_active`, `start_date`, `end_date`, `display_order`, `click_count`, `view_count`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '50% Off First Ride', 'Get 50% discount on your first ride with Raah-e-Haq', 'https://via.placeholder.com/400x200/011c72/ffffff?text=50%25+Off+First+Ride', '/rides/new', 'Book Now', 'promotion', 'home_top', 'passengers', 1, '2025-09-16 07:32:17', '2025-10-17 07:32:17', 1, 25, 150, 1, '2025-09-17 07:32:17', '2025-09-17 07:32:17'),
(2, 'Driver Referral Program', 'Refer a driver and earn PKR 1000 bonus', 'https://via.placeholder.com/400x200/058a0b/ffffff?text=Driver+Referral+Program', '/referral', 'Learn More', 'promotion', 'home_middle', 'all', 1, '2025-09-17 07:32:17', '2025-11-16 07:32:17', 2, 12, 89, 1, '2025-09-17 07:32:17', '2025-09-17 07:32:17'),
(3, 'Safety First', 'All our drivers are verified and vehicles are regularly inspected', 'https://via.placeholder.com/400x200/ce0a0a/ffffff?text=Safety+First', '/safety', 'Read More', 'announcement', 'home_bottom', 'all', 1, NULL, NULL, 3, 8, 45, 1, '2025-09-17 07:32:17', '2025-09-17 07:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_analytics`
--

CREATE TABLE `daily_analytics` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `new_users` int NOT NULL DEFAULT '0',
  `active_users` int NOT NULL DEFAULT '0',
  `total_users` int NOT NULL DEFAULT '0',
  `new_drivers` int NOT NULL DEFAULT '0',
  `active_drivers` int NOT NULL DEFAULT '0',
  `total_drivers` int NOT NULL DEFAULT '0',
  `new_passengers` int NOT NULL DEFAULT '0',
  `active_passengers` int NOT NULL DEFAULT '0',
  `total_passengers` int NOT NULL DEFAULT '0',
  `total_rides` int NOT NULL DEFAULT '0',
  `completed_rides` int NOT NULL DEFAULT '0',
  `cancelled_rides` int NOT NULL DEFAULT '0',
  `total_distance_km` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_duration_minutes` int NOT NULL DEFAULT '0',
  `average_ride_distance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `average_ride_duration` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_revenue` decimal(12,2) NOT NULL DEFAULT '0.00',
  `driver_earnings` decimal(12,2) NOT NULL DEFAULT '0.00',
  `platform_commission` decimal(12,2) NOT NULL DEFAULT '0.00',
  `average_ride_fare` decimal(8,2) NOT NULL DEFAULT '0.00',
  `average_driver_earning` decimal(8,2) NOT NULL DEFAULT '0.00',
  `ride_completion_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `driver_acceptance_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `average_wait_time_minutes` decimal(8,2) NOT NULL DEFAULT '0.00',
  `customer_satisfaction_score` decimal(3,2) NOT NULL DEFAULT '0.00',
  `unique_locations` int NOT NULL DEFAULT '0',
  `top_locations` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_analytics`
--

INSERT INTO `daily_analytics` (`id`, `date`, `new_users`, `active_users`, `total_users`, `new_drivers`, `active_drivers`, `total_drivers`, `new_passengers`, `active_passengers`, `total_passengers`, `total_rides`, `completed_rides`, `cancelled_rides`, `total_distance_km`, `total_duration_minutes`, `average_ride_distance`, `average_ride_duration`, `total_revenue`, `driver_earnings`, `platform_commission`, `average_ride_fare`, `average_driver_earning`, `ride_completion_rate`, `driver_acceptance_rate`, `average_wait_time_minutes`, `customer_satisfaction_score`, `unique_locations`, `top_locations`, `created_at`, `updated_at`) VALUES
(1, '2025-09-17', 3, 1, 3, 1, 1, 1, 1, 1, 1, 50, 10, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, 91.00, 5.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:10', '2025-09-17 08:13:10'),
(2, '2025-09-16', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 86.00, 3.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(3, '2025-09-15', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 88.00, 4.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(4, '2025-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 91.00, 8.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(5, '2025-09-13', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 89.00, 6.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(6, '2025-09-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 92.00, 5.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(7, '2025-09-11', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 93.00, 8.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(8, '2025-09-10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 86.00, 4.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(9, '2025-09-09', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 85.00, 6.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(10, '2025-09-08', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 89.00, 8.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:11', '2025-09-17 08:13:11'),
(11, '2025-09-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 92.00, 4.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(12, '2025-09-06', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 90.00, 6.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(13, '2025-09-05', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 94.00, 8.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(14, '2025-09-04', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 90.00, 5.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(15, '2025-09-03', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 87.00, 8.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(16, '2025-09-02', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 92.00, 6.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(17, '2025-09-01', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 91.00, 8.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:12', '2025-09-17 08:13:12'),
(18, '2025-08-31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 95.00, 4.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:13', '2025-09-17 08:13:13'),
(19, '2025-08-30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 85.00, 4.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:13', '2025-09-17 08:13:13'),
(20, '2025-08-29', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 92.00, 6.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:14', '2025-09-17 08:13:14'),
(21, '2025-08-28', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 89.00, 5.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:14', '2025-09-17 08:13:14'),
(22, '2025-08-27', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 88.00, 3.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:14', '2025-09-17 08:13:14'),
(23, '2025-08-26', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 88.00, 3.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:14', '2025-09-17 08:13:14'),
(24, '2025-08-25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 89.00, 8.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:14', '2025-09-17 08:13:14'),
(25, '2025-08-24', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 95.00, 6.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:14', '2025-09-17 08:13:14'),
(26, '2025-08-23', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 89.00, 3.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:15', '2025-09-17 08:13:15'),
(27, '2025-08-22', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 94.00, 7.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:15', '2025-09-17 08:13:15'),
(28, '2025-08-21', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 95.00, 4.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:15', '2025-09-17 08:13:15'),
(29, '2025-08-20', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 95.00, 5.00, 4.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:15', '2025-09-17 08:13:15'),
(30, '2025-08-19', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 93.00, 3.00, 5.00, 0, '[\"Lahore\", \"Karachi\", \"Islamabad\", \"Rawalpindi\", \"Faisalabad\"]', '2025-09-17 08:13:15', '2025-09-17 08:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `driver_documents`
--

CREATE TABLE `driver_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_locations`
--

CREATE TABLE `driver_locations` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED DEFAULT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speed` decimal(5,2) DEFAULT NULL,
  `heading` decimal(5,2) DEFAULT NULL,
  `accuracy` decimal(8,2) DEFAULT NULL,
  `status` enum('online','offline','busy','available') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `last_seen_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_locations`
--

INSERT INTO `driver_locations` (`id`, `driver_id`, `vehicle_id`, `latitude`, `longitude`, `address`, `speed`, `heading`, `accuracy`, `status`, `last_seen_at`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 31.49390000, 74.36610000, '146, Garden Town, Karachi', 7.00, 295.00, 25.00, 'offline', '2025-09-17 01:09:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 76}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(2, 2, 1, 31.49390000, 74.36670000, '37, Model Town, Rawalpindi', 19.00, 33.00, 24.00, 'offline', '2025-09-16 18:12:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 99}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(3, 2, 1, 31.49420000, 74.36700000, '197, Main Boulevard, Karachi', 12.00, 73.00, 13.00, 'offline', '2025-09-17 03:57:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 71}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(4, 2, 1, 31.49400000, 74.36800000, '35, Defence Phase, Karachi', 13.00, 279.00, 38.00, 'offline', '2025-09-17 05:22:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 74}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(5, 2, 1, 31.49400000, 74.36730000, '108, Garden Town, Islamabad', 22.00, 249.00, 15.00, 'offline', '2025-09-17 06:01:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 91}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(6, 2, 1, 31.49390000, 74.36740000, '48, Cantt Area, Islamabad', 24.00, 339.00, 9.00, 'offline', '2025-09-16 11:09:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 96}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(7, 2, 1, 31.49310000, 74.36660000, '52, Main Boulevard, Faisalabad', 18.00, 160.00, 39.00, 'offline', '2025-09-17 02:03:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 98}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(8, 2, 1, 31.49370000, 74.36560000, '11, Defence Phase, Islamabad', 6.00, 321.00, 33.00, 'offline', '2025-09-16 22:25:24', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 23}', '2025-09-17 08:34:24', '2025-09-17 08:34:24'),
(9, 2, 1, 31.60840000, 74.42360000, '114, Faisal Town, Islamabad', 25.00, 178.00, 6.00, 'offline', '2025-09-16 13:53:58', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 78}', '2025-09-17 08:35:58', '2025-09-17 08:35:58'),
(10, 2, 1, 31.60830000, 74.42450000, '46, Cantt Area, Karachi', 15.00, 173.00, 13.00, 'offline', '2025-09-16 17:51:58', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 74}', '2025-09-17 08:35:58', '2025-09-17 08:35:58'),
(11, 2, 1, 31.60890000, 74.42350000, '56, Garden Town, Lahore', 0.00, 208.00, 16.00, 'offline', '2025-09-17 04:17:58', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 63}', '2025-09-17 08:35:58', '2025-09-17 08:35:58'),
(12, 2, 1, 31.60830000, 74.42370000, '126, Johar Town, Faisalabad', 10.00, 48.00, 39.00, 'offline', '2025-09-16 12:25:58', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 82}', '2025-09-17 08:35:58', '2025-09-17 08:35:58'),
(13, 2, 1, 31.60830000, 74.42330000, '36, Faisal Town, Faisalabad', 2.00, 252.00, 35.00, 'offline', '2025-09-16 17:28:58', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 21}', '2025-09-17 08:35:58', '2025-09-17 08:35:58'),
(14, 2, 1, 31.60850000, 74.42270000, '20, Garden Town, Karachi', 9.00, 208.00, 24.00, 'offline', '2025-09-17 03:08:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 82}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(15, 2, 1, 31.60780000, 74.42320000, '151, Main Boulevard, Faisalabad', 10.00, 53.00, 41.00, 'offline', '2025-09-16 12:31:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 87}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(16, 2, 1, 31.60740000, 74.42390000, '174, Defence Phase, Karachi', 5.00, 311.00, 48.00, 'offline', '2025-09-17 02:44:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 99}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(17, 2, 1, 31.60790000, 74.42310000, '137, Main Boulevard, Faisalabad', 0.00, 160.00, 46.00, 'offline', '2025-09-16 22:36:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 20}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(18, 2, 1, 31.60880000, 74.42390000, '126, Faisal Town, Karachi', 22.00, 240.00, 45.00, 'offline', '2025-09-16 08:48:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 92}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(19, 2, 1, 31.60930000, 74.42490000, '34, Model Town, Islamabad', 21.00, 26.00, 47.00, 'offline', '2025-09-16 15:45:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 21}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(20, 2, 1, 31.60850000, 74.42400000, '118, Gulberg Road, Lahore', 21.00, 110.00, 15.00, 'offline', '2025-09-16 16:04:59', '{\"app_version\": \"1.0.0\", \"network_type\": \"4G\", \"battery_level\": 59}', '2025-09-17 08:35:59', '2025-09-17 08:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `status` enum('success','failed','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'failed',
  `failure_reason` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `attempted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `email`, `ip_address`, `user_agent`, `status`, `failure_reason`, `user_id`, `attempted_at`, `created_at`, `updated_at`) VALUES
(1, 'driver@raah-e-haq.com', '101.167.250.154', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-18 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(2, 'passenger@raah-e-haq.com', '88.219.24.151', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-09-14 17:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(3, 'passenger@raah-e-haq.com', '199.230.49.62', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-08-23 06:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(4, 'admin@raah-e-haq.com', '169.16.21.42', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'account_locked', NULL, '2025-08-23 15:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(5, 'admin@raah-e-haq.com', '118.152.220.232', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'wrong_password', NULL, '2025-09-04 22:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(6, 'passenger@raah-e-haq.com', '35.166.105.221', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-05 01:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(7, 'admin@raah-e-haq.com', '185.150.177.66', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-09 07:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(8, 'driver@raah-e-haq.com', '148.56.105.74', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'account_locked', NULL, '2025-09-05 10:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(9, 'driver@raah-e-haq.com', '81.52.5.78', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-08-29 10:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(10, 'passenger@raah-e-haq.com', '231.72.230.142', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'too_many_attempts', NULL, '2025-08-17 20:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(11, 'passenger@raah-e-haq.com', '195.56.163.156', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-25 13:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(12, 'driver@raah-e-haq.com', '158.242.118.26', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-08-25 15:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(13, 'driver@raah-e-haq.com', '34.232.102.206', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-12 05:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(14, 'driver@raah-e-haq.com', '15.90.76.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-09-03 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(15, 'driver@raah-e-haq.com', '64.3.112.217', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-13 20:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(16, 'admin@raah-e-haq.com', '47.239.4.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 1, '2025-08-26 00:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(17, 'driver@raah-e-haq.com', '60.8.46.159', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-08-30 18:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(18, 'passenger@raah-e-haq.com', '54.71.48.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-08-23 14:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(19, 'admin@raah-e-haq.com', '188.55.142.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 1, '2025-09-13 04:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(20, 'admin@raah-e-haq.com', '190.178.122.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'account_locked', NULL, '2025-08-24 11:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(21, 'driver@raah-e-haq.com', '145.41.216.216', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'account_locked', NULL, '2025-09-02 03:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(22, 'driver@raah-e-haq.com', '16.235.104.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-08-26 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(23, 'passenger@raah-e-haq.com', '208.141.230.226', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 3, '2025-08-22 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(24, 'driver@raah-e-haq.com', '125.160.105.17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 2, '2025-08-26 06:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(25, 'admin@raah-e-haq.com', '137.4.200.173', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 1, '2025-09-07 03:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(26, 'admin@raah-e-haq.com', '232.141.171.215', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 1, '2025-08-19 08:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(27, 'driver@raah-e-haq.com', '181.71.185.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 2, '2025-08-25 04:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(28, 'passenger@raah-e-haq.com', '52.146.190.57', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-01 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(29, 'admin@raah-e-haq.com', '209.92.42.29', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-02 22:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(30, 'passenger@raah-e-haq.com', '114.28.168.117', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-29 00:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(31, 'driver@raah-e-haq.com', '111.68.37.61', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'account_locked', NULL, '2025-09-03 07:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(32, 'admin@raah-e-haq.com', '16.125.118.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-08-20 02:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(33, 'driver@raah-e-haq.com', '28.183.155.28', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-08-20 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(34, 'passenger@raah-e-haq.com', '183.173.84.140', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'account_locked', NULL, '2025-08-28 04:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(35, 'passenger@raah-e-haq.com', '183.228.245.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-09-14 08:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(36, 'passenger@raah-e-haq.com', '177.109.67.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'wrong_password', NULL, '2025-09-15 10:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(37, 'passenger@raah-e-haq.com', '239.145.228.108', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-09-12 23:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(38, 'admin@raah-e-haq.com', '175.11.20.191', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'wrong_password', NULL, '2025-09-14 08:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(39, 'admin@raah-e-haq.com', '224.5.150.140', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'account_locked', NULL, '2025-08-22 03:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(40, 'driver@raah-e-haq.com', '192.97.233.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-09-10 16:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(41, 'admin@raah-e-haq.com', '80.62.211.146', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'wrong_password', NULL, '2025-09-12 12:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(42, 'admin@raah-e-haq.com', '20.120.104.176', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 1, '2025-09-09 00:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(43, 'driver@raah-e-haq.com', '214.32.45.86', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'too_many_attempts', NULL, '2025-09-06 08:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(44, 'passenger@raah-e-haq.com', '245.125.174.227', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-09-12 22:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(45, 'driver@raah-e-haq.com', '107.47.85.224', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 2, '2025-08-29 14:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(46, 'admin@raah-e-haq.com', '82.128.147.85', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-21 07:48:19', '2025-09-17 07:48:19', '2025-09-17 07:48:19'),
(47, 'admin@raah-e-haq.com', '4.147.236.245', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-30 00:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(48, 'passenger@raah-e-haq.com', '97.151.47.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-08-23 15:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(49, 'passenger@raah-e-haq.com', '244.68.146.172', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-09-11 16:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(50, 'admin@raah-e-haq.com', '5.77.124.85', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 1, '2025-09-08 18:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(51, 'admin@raah-e-haq.com', '161.55.8.215', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 1, '2025-08-31 05:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(52, 'driver@raah-e-haq.com', '224.104.72.216', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-19 22:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(53, 'admin@raah-e-haq.com', '53.126.44.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-20 07:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(54, 'driver@raah-e-haq.com', '252.118.127.241', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 2, '2025-08-29 10:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(55, 'driver@raah-e-haq.com', '33.82.184.4', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-31 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(56, 'driver@raah-e-haq.com', '242.71.161.225', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-09-13 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(57, 'driver@raah-e-haq.com', '51.142.198.182', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-28 17:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(58, 'admin@raah-e-haq.com', '61.212.227.50', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-15 00:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(59, 'driver@raah-e-haq.com', '214.6.239.85', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-27 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(60, 'admin@raah-e-haq.com', '145.53.60.139', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 1, '2025-09-13 09:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(61, 'admin@raah-e-haq.com', '196.73.159.48', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 1, '2025-08-25 15:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(62, 'admin@raah-e-haq.com', '35.114.166.229', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-08-28 04:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(63, 'passenger@raah-e-haq.com', '209.254.217.145', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'account_locked', NULL, '2025-08-19 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(64, 'driver@raah-e-haq.com', '251.167.193.170', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-09-09 20:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(65, 'admin@raah-e-haq.com', '209.223.151.253', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-23 23:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(66, 'passenger@raah-e-haq.com', '154.255.83.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'account_locked', NULL, '2025-09-14 02:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(67, 'admin@raah-e-haq.com', '63.206.132.204', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'wrong_password', NULL, '2025-09-02 22:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(68, 'driver@raah-e-haq.com', '230.102.213.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-29 09:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(69, 'passenger@raah-e-haq.com', '52.223.85.254', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-11 19:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(70, 'admin@raah-e-haq.com', '55.239.193.180', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'account_locked', NULL, '2025-09-08 23:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(71, 'passenger@raah-e-haq.com', '158.154.255.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-08-19 08:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(72, 'passenger@raah-e-haq.com', '105.101.26.8', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-04 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(73, 'admin@raah-e-haq.com', '52.95.129.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-01 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(74, 'passenger@raah-e-haq.com', '135.239.102.92', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-09-12 02:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(75, 'driver@raah-e-haq.com', '31.110.229.145', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 2, '2025-08-24 00:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(76, 'passenger@raah-e-haq.com', '168.6.139.163', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-08-29 18:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(77, 'passenger@raah-e-haq.com', '67.71.234.51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'account_locked', NULL, '2025-08-30 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(78, 'admin@raah-e-haq.com', '129.139.80.39', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 1, '2025-09-16 23:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(79, 'admin@raah-e-haq.com', '83.209.196.6', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-25 02:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(80, 'passenger@raah-e-haq.com', '246.195.50.64', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 3, '2025-09-13 22:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(81, 'admin@raah-e-haq.com', '150.12.207.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'account_locked', NULL, '2025-09-03 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(82, 'driver@raah-e-haq.com', '24.129.221.154', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-09-09 18:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(83, 'driver@raah-e-haq.com', '135.57.171.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'wrong_password', NULL, '2025-09-12 09:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(84, 'passenger@raah-e-haq.com', '215.199.67.176', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-14 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(85, 'admin@raah-e-haq.com', '185.177.118.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 1, '2025-08-20 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(86, 'admin@raah-e-haq.com', '11.79.148.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 1, '2025-09-09 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(87, 'driver@raah-e-haq.com', '215.217.100.182', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-09-02 21:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(88, 'passenger@raah-e-haq.com', '85.220.190.183', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-15 13:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(89, 'driver@raah-e-haq.com', '9.165.196.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-08-31 20:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(90, 'driver@raah-e-haq.com', '131.207.224.12', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-04 07:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(91, 'driver@raah-e-haq.com', '242.238.11.135', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 2, '2025-08-25 17:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(92, 'admin@raah-e-haq.com', '208.225.92.237', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-03 20:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(93, 'passenger@raah-e-haq.com', '206.180.190.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-08-29 14:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(94, 'passenger@raah-e-haq.com', '255.44.79.239', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-04 05:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(95, 'passenger@raah-e-haq.com', '69.195.57.43', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-26 05:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(96, 'passenger@raah-e-haq.com', '54.15.196.114', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-08-24 00:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(97, 'driver@raah-e-haq.com', '72.17.57.166', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'user_not_found', NULL, '2025-08-27 03:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(98, 'driver@raah-e-haq.com', '85.185.224.81', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-09-02 14:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(99, 'driver@raah-e-haq.com', '45.2.107.89', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-08-18 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(100, 'driver@raah-e-haq.com', '211.58.213.15', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-09-17 06:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(101, 'driver@raah-e-haq.com', '67.249.196.23', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'wrong_password', NULL, '2025-08-19 19:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(102, 'admin@raah-e-haq.com', '17.51.39.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 1, '2025-09-05 11:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(103, 'driver@raah-e-haq.com', '125.8.51.68', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-09-05 21:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(104, 'passenger@raah-e-haq.com', '205.12.138.75', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-09-01 13:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(105, 'admin@raah-e-haq.com', '201.100.53.164', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-27 17:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(106, 'admin@raah-e-haq.com', '141.171.106.249', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-16 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(107, 'driver@raah-e-haq.com', '189.143.25.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'too_many_attempts', NULL, '2025-08-24 03:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(108, 'admin@raah-e-haq.com', '134.65.16.51', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-01 19:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(109, 'passenger@raah-e-haq.com', '153.123.79.18', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-09-03 03:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(110, 'passenger@raah-e-haq.com', '20.81.42.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-09-12 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(111, 'admin@raah-e-haq.com', '172.54.60.228', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-08-21 03:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(112, 'driver@raah-e-haq.com', '121.102.193.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-31 00:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(113, 'passenger@raah-e-haq.com', '200.111.68.173', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-21 11:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(114, 'driver@raah-e-haq.com', '211.168.92.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 2, '2025-09-03 18:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(115, 'driver@raah-e-haq.com', '236.38.126.75', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 2, '2025-09-04 10:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(116, 'passenger@raah-e-haq.com', '35.85.53.205', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-23 02:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(117, 'driver@raah-e-haq.com', '221.203.163.24', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-03 16:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(118, 'driver@raah-e-haq.com', '186.40.254.4', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'user_not_found', NULL, '2025-09-06 19:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(119, 'driver@raah-e-haq.com', '231.82.60.135', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'account_locked', NULL, '2025-08-18 13:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(120, 'passenger@raah-e-haq.com', '194.189.240.206', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'account_locked', NULL, '2025-09-15 14:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(121, 'admin@raah-e-haq.com', '93.134.33.137', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-23 08:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(122, 'driver@raah-e-haq.com', '230.194.235.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-08-21 00:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(123, 'passenger@raah-e-haq.com', '182.211.208.174', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-15 17:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(124, 'admin@raah-e-haq.com', '173.42.35.152', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-23 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(125, 'admin@raah-e-haq.com', '27.17.230.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'account_locked', NULL, '2025-08-30 17:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(126, 'admin@raah-e-haq.com', '7.12.110.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-27 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(127, 'passenger@raah-e-haq.com', '36.194.43.158', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'too_many_attempts', NULL, '2025-08-29 11:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(128, 'passenger@raah-e-haq.com', '226.170.37.159', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-09-12 05:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(129, 'passenger@raah-e-haq.com', '233.186.82.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 3, '2025-09-11 07:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(130, 'driver@raah-e-haq.com', '134.201.98.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-09-01 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(131, 'admin@raah-e-haq.com', '136.217.239.103', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-09-08 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(132, 'admin@raah-e-haq.com', '29.25.93.244', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 1, '2025-08-20 22:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(133, 'admin@raah-e-haq.com', '57.128.155.44', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 1, '2025-09-16 09:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(134, 'driver@raah-e-haq.com', '55.41.106.197', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'failed', 'wrong_password', NULL, '2025-08-22 18:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(135, 'passenger@raah-e-haq.com', '88.67.245.151', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-08-22 04:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(136, 'admin@raah-e-haq.com', '22.127.188.221', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-02 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(137, 'passenger@raah-e-haq.com', '144.72.168.207', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-08-26 01:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(138, 'passenger@raah-e-haq.com', '236.56.239.112', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-08-17 15:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(139, 'driver@raah-e-haq.com', '241.84.82.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'success', NULL, 2, '2025-08-24 11:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(140, 'driver@raah-e-haq.com', '156.126.252.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'too_many_attempts', NULL, '2025-08-21 08:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(141, 'admin@raah-e-haq.com', '111.33.126.2', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'too_many_attempts', NULL, '2025-09-15 07:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(142, 'driver@raah-e-haq.com', '160.131.80.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'failed', 'account_locked', NULL, '2025-09-04 15:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(143, 'driver@raah-e-haq.com', '169.102.110.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'success', NULL, 2, '2025-09-14 14:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(144, 'passenger@raah-e-haq.com', '33.250.95.14', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-08-29 19:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(145, 'admin@raah-e-haq.com', '141.240.77.165', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', 'blocked', NULL, NULL, '2025-09-06 12:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(146, 'admin@raah-e-haq.com', '233.2.253.6', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'blocked', NULL, NULL, '2025-08-19 23:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(147, 'passenger@raah-e-haq.com', '131.195.17.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'success', NULL, 3, '2025-09-13 05:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(148, 'admin@raah-e-haq.com', '246.250.110.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'failed', 'user_not_found', NULL, '2025-09-09 16:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(149, 'passenger@raah-e-haq.com', '55.229.89.209', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-11 11:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20'),
(150, 'driver@raah-e-haq.com', '183.101.90.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', 'blocked', NULL, NULL, '2025-09-16 20:48:20', '2025-09-17 07:48:20', '2025-09-17 07:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_17_100606_create_roles_table', 2),
(5, '2025_09_17_100615_create_role_user_table', 2),
(6, '2025_09_17_100730_add_additional_fields_to_users_table', 2),
(7, '2025_09_17_112912_add_country_to_users_table', 3),
(8, '2025_09_17_114943_create_vehicles_table', 4),
(9, '2025_09_17_115013_create_driver_documents_table', 4),
(10, '2025_09_17_115751_create_rides_table', 5),
(11, '2025_09_17_120755_create_wallets_table', 6),
(12, '2025_09_17_120827_create_transactions_table', 6),
(13, '2025_09_17_121935_create_app_settings_table', 7),
(14, '2025_09_17_122026_create_notifications_table', 7),
(15, '2025_09_17_122147_create_banners_table', 7),
(16, '2025_09_17_123403_create_audit_logs_table', 8),
(17, '2025_09_17_123507_create_login_attempts_table', 8),
(18, '2025_09_17_123556_create_security_events_table', 8),
(19, '2025_09_17_125244_create_analytics_events_table', 9),
(20, '2025_09_17_125353_create_daily_analytics_table', 9),
(21, '2025_09_17_131442_create_driver_locations_table', 10),
(22, '2025_09_17_131609_create_ride_tracking_table', 10),
(23, '2025_09_17_133901_create_referrals_table', 11),
(24, '2025_09_17_134029_create_referral_rewards_table', 11),
(25, '2025_09_17_134145_create_referral_settings_table', 11),
(26, '2025_09_17_140831_create_support_tickets_table', 12),
(27, '2025_09_17_140957_create_ticket_replies_table', 12),
(28, '2025_09_17_141146_create_ticket_categories_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('info','success','warning','error','promotion','announcement') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `target_audience` enum('all','passengers','drivers','specific_users') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `target_user_ids` json DEFAULT NULL,
  `delivery_method` enum('push','in_app','email','sms','all') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'push',
  `status` enum('draft','scheduled','sent','failed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivery_stats` json DEFAULT NULL,
  `image_url` text COLLATE utf8mb4_unicode_ci,
  `action_url` text COLLATE utf8mb4_unicode_ci,
  `action_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `type`, `target_audience`, `target_user_ids`, `delivery_method`, `status`, `scheduled_at`, `sent_at`, `delivery_stats`, `image_url`, `action_url`, `action_text`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to Raah-e-Haq!', 'Thank you for joining our ride-sharing platform. Enjoy safe and comfortable rides!', 'info', 'all', NULL, 'push', 'sent', NULL, '2025-09-16 07:32:17', '{\"sent\": 48, \"failed\": 2, \"total_users\": 50}', NULL, NULL, NULL, 1, '2025-09-17 07:32:17', '2025-09-17 07:32:17'),
(2, 'New Feature: Scheduled Rides', 'You can now schedule your rides in advance! Book your ride up to 7 days ahead.', 'announcement', 'passengers', NULL, 'push', 'scheduled', '2025-09-17 09:32:17', NULL, NULL, NULL, NULL, NULL, 1, '2025-09-17 07:32:17', '2025-09-17 07:32:17'),
(3, 'Driver Bonus Program', 'Complete 10 rides this week and earn a 20% bonus on your earnings!', 'promotion', 'drivers', NULL, 'push', 'draft', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-17 07:32:17', '2025-09-17 07:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint UNSIGNED NOT NULL,
  `referrer_id` bigint UNSIGNED NOT NULL,
  `referred_id` bigint UNSIGNED NOT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reward_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bonus_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `reward_type` enum('ride_credit','cash','discount') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ride_credit',
  `level` int NOT NULL DEFAULT '1',
  `metadata` json DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referrer_id`, `referred_id`, `referral_code`, `status`, `reward_amount`, `bonus_amount`, `reward_type`, `level`, `metadata`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'REFA73E3AE3', 'completed', 0.00, 0.00, 'ride_credit', 2, '{\"source\": \"app\", \"campaign\": \"default\"}', '2025-09-17 09:01:42', '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(2, 3, 2, 'REF646599BF', 'pending', 0.00, 0.00, 'ride_credit', 3, '{\"source\": \"social_media\", \"campaign\": \"default\"}', NULL, '2025-09-17 09:04:23', '2025-09-17 09:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `referral_rewards`
--

CREATE TABLE `referral_rewards` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referral_id` bigint UNSIGNED DEFAULT NULL,
  `reward_type` enum('ride_credit','cash','discount','bonus') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ride_credit',
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','credited','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `level` int NOT NULL DEFAULT '1',
  `credited_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_settings`
--

CREATE TABLE `referral_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('string','number','boolean','json') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_settings`
--

INSERT INTO `referral_settings` (`id`, `key`, `value`, `description`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'max_levels', '3', 'Referral system setting for max_levels', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(2, 'reward_type', 'ride_credit', 'Referral system setting for reward_type', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(3, 'new_user_bonus', '100', 'Referral system setting for new_user_bonus', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(4, 'level_1_referrer_reward', '50', 'Referral system setting for level_1_referrer_reward', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(5, 'level_2_referrer_reward', '25', 'Referral system setting for level_2_referrer_reward', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(6, 'level_3_referrer_reward', '10', 'Referral system setting for level_3_referrer_reward', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(7, 'reward_expiry_days', '30', 'Referral system setting for reward_expiry_days', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(8, 'min_rides_for_completion', '1', 'Referral system setting for min_rides_for_completion', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42'),
(9, 'referral_code_length', '8', 'Referral system setting for referral_code_length', 'string', 1, '2025-09-17 09:01:42', '2025-09-17 09:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `id` bigint UNSIGNED NOT NULL,
  `ride_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint UNSIGNED DEFAULT NULL,
  `pickup_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_latitude` decimal(10,8) NOT NULL,
  `pickup_longitude` decimal(11,8) NOT NULL,
  `dropoff_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dropoff_latitude` decimal(10,8) NOT NULL,
  `dropoff_longitude` decimal(11,8) NOT NULL,
  `ride_type` enum('instant','scheduled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'instant',
  `scheduled_time` timestamp NULL DEFAULT NULL,
  `vehicle_type` enum('car','bike','rickshaw','van') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'car',
  `passenger_count` int NOT NULL DEFAULT '1',
  `special_instructions` text COLLATE utf8mb4_unicode_ci,
  `base_fare` decimal(8,2) NOT NULL DEFAULT '0.00',
  `distance_fare` decimal(8,2) NOT NULL DEFAULT '0.00',
  `time_fare` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total_fare` decimal(8,2) NOT NULL DEFAULT '0.00',
  `driver_earnings` decimal(8,2) NOT NULL DEFAULT '0.00',
  `platform_commission` decimal(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','searching','accepted','arrived','started','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `cancellation_reason` enum('passenger','driver','system','weather','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancellation_note` text COLLATE utf8mb4_unicode_ci,
  `cancelled_by` bigint UNSIGNED DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `arrived_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `distance_km` decimal(8,2) DEFAULT NULL,
  `duration_minutes` int DEFAULT NULL,
  `payment_method` enum('cash','card','wallet','bank_transfer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `ride_id`, `passenger_id`, `driver_id`, `vehicle_id`, `pickup_address`, `pickup_latitude`, `pickup_longitude`, `dropoff_address`, `dropoff_latitude`, `dropoff_longitude`, `ride_type`, `scheduled_time`, `vehicle_type`, `passenger_count`, `special_instructions`, `base_fare`, `distance_fare`, `time_fare`, `total_fare`, `driver_earnings`, `platform_commission`, `status`, `cancellation_reason`, `cancellation_note`, `cancelled_by`, `requested_at`, `accepted_at`, `arrived_at`, `started_at`, `completed_at`, `cancelled_at`, `distance_km`, `duration_minutes`, `payment_method`, `payment_status`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 'RIDE-000001', 3, 2, 1, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'scheduled', NULL, 'rickshaw', 3, 'Please call when you arrive', 122.00, 286.00, 99.00, 507.00, 405.60, 101.40, 'arrived', NULL, NULL, NULL, '2025-09-09 11:22:28', '2025-08-18 11:34:28', NULL, NULL, NULL, NULL, 5.00, 53, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:28', '2025-09-17 07:05:28'),
(2, 'RIDE-000002', 3, NULL, NULL, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', '2025-09-17 15:05:28', 'rickshaw', 1, 'Please call when you arrive', 83.00, 139.00, 154.00, 376.00, 300.80, 75.20, 'pending', NULL, NULL, NULL, '2025-09-06 00:41:28', NULL, NULL, NULL, NULL, NULL, 45.00, 25, 'cash', 'pending', NULL, '2025-09-17 07:05:28', '2025-09-17 07:05:28'),
(3, 'RIDE-000003', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'scheduled', NULL, 'van', 1, 'Please call when you arrive', 173.00, 181.00, 97.00, 451.00, 360.80, 90.20, 'accepted', NULL, NULL, NULL, '2025-08-17 19:08:28', '2025-09-08 16:53:28', NULL, NULL, NULL, NULL, 23.00, 53, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:28', '2025-09-17 07:05:28'),
(4, 'RIDE-000004', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'instant', NULL, 'bike', 3, 'Please call when you arrive', 117.00, 123.00, 60.00, 300.00, 240.00, 60.00, 'searching', NULL, NULL, NULL, '2025-09-10 23:56:28', '2025-09-07 01:49:28', NULL, NULL, NULL, NULL, 41.00, 15, 'cash', 'pending', NULL, '2025-09-17 07:05:28', '2025-09-17 07:05:28'),
(5, 'RIDE-000005', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', '2025-09-17 22:05:28', 'rickshaw', 3, NULL, 116.00, 394.00, 69.00, 579.00, 463.20, 115.80, 'started', NULL, NULL, NULL, '2025-09-10 21:11:28', '2025-09-10 16:42:28', NULL, NULL, NULL, NULL, 32.00, 90, 'cash', 'pending', NULL, '2025-09-17 07:05:28', '2025-09-17 07:05:28'),
(6, 'RIDE-000006', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', NULL, 'car', 1, NULL, 55.00, 382.00, 54.00, 491.00, 392.80, 98.20, 'started', NULL, NULL, NULL, '2025-09-04 05:55:28', '2025-08-27 01:16:28', NULL, NULL, NULL, NULL, 20.00, 65, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:28', '2025-09-17 07:05:28'),
(7, 'RIDE-000007', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', '2025-09-18 03:05:29', 'car', 2, NULL, 122.00, 181.00, 134.00, 437.00, 349.60, 87.40, 'started', NULL, NULL, NULL, '2025-09-12 02:56:29', '2025-08-23 21:55:29', NULL, NULL, NULL, NULL, 32.00, 88, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(8, 'RIDE-000008', 3, NULL, NULL, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'instant', NULL, 'car', 4, 'Please call when you arrive', 143.00, 101.00, 83.00, 327.00, 261.60, 65.40, 'pending', NULL, NULL, NULL, '2025-09-05 20:02:29', NULL, NULL, NULL, NULL, NULL, 50.00, 89, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(9, 'RIDE-000009', 3, NULL, NULL, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'scheduled', NULL, 'car', 3, 'Please call when you arrive', 131.00, 198.00, 139.00, 468.00, 374.40, 93.60, 'pending', NULL, NULL, NULL, '2025-08-29 14:18:29', NULL, NULL, NULL, NULL, NULL, 28.00, 77, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(10, 'RIDE-000010', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'scheduled', '2025-09-18 05:05:29', 'bike', 1, 'Please call when you arrive', 123.00, 110.00, 79.00, 312.00, 249.60, 62.40, 'completed', NULL, NULL, NULL, '2025-09-08 22:12:29', '2025-08-22 12:17:29', NULL, NULL, '2025-08-19 07:25:29', NULL, 30.00, 111, 'cash', 'paid', '2025-08-28 22:37:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(11, 'RIDE-000011', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', NULL, 'car', 3, NULL, 99.00, 309.00, 87.00, 495.00, 396.00, 99.00, 'accepted', NULL, NULL, NULL, '2025-09-12 05:02:29', '2025-08-21 09:19:29', NULL, NULL, NULL, NULL, 42.00, 41, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(12, 'RIDE-000012', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', '2025-09-18 00:05:29', 'bike', 2, NULL, 121.00, 373.00, 77.00, 571.00, 456.80, 114.20, 'searching', NULL, NULL, NULL, '2025-08-25 15:13:29', '2025-09-01 02:54:29', NULL, NULL, NULL, NULL, 10.00, 95, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(13, 'RIDE-000013', 3, NULL, NULL, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'instant', NULL, 'rickshaw', 3, 'Please call when you arrive', 119.00, 298.00, 101.00, 518.00, 414.40, 103.60, 'pending', NULL, NULL, NULL, '2025-08-20 06:26:29', NULL, NULL, NULL, NULL, NULL, 27.00, 65, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(14, 'RIDE-000014', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'instant', '2025-09-17 22:05:29', 'rickshaw', 3, NULL, 108.00, 347.00, 109.00, 564.00, 451.20, 112.80, 'arrived', NULL, NULL, NULL, '2025-08-21 01:04:29', '2025-09-10 20:58:29', NULL, NULL, NULL, NULL, 12.00, 118, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(15, 'RIDE-000015', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'scheduled', NULL, 'bike', 2, NULL, 180.00, 379.00, 60.00, 619.00, 495.20, 123.80, 'cancelled', 'weather', 'Ride cancelled due to traffic', NULL, '2025-08-20 05:14:29', '2025-09-01 16:16:29', NULL, NULL, NULL, '2025-08-24 05:34:29', 5.00, 19, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(16, 'RIDE-000016', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'scheduled', '2025-09-17 15:05:29', 'car', 3, 'Please call when you arrive', 149.00, 215.00, 102.00, 466.00, 372.80, 93.20, 'cancelled', 'weather', 'Ride cancelled due to traffic', NULL, '2025-09-02 04:24:29', '2025-08-20 01:02:29', NULL, NULL, NULL, '2025-08-23 20:50:29', 9.00, 60, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(17, 'RIDE-000017', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'scheduled', '2025-09-17 15:05:29', 'car', 3, 'Please call when you arrive', 129.00, 107.00, 97.00, 333.00, 266.40, 66.60, 'completed', NULL, NULL, NULL, '2025-08-23 08:33:29', '2025-09-09 11:49:29', NULL, NULL, '2025-08-20 16:05:29', NULL, 44.00, 111, 'wallet', 'paid', '2025-08-29 20:23:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(18, 'RIDE-000018', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'instant', '2025-09-17 23:05:29', 'bike', 4, 'Please call when you arrive', 92.00, 126.00, 127.00, 345.00, 276.00, 69.00, 'arrived', NULL, NULL, NULL, '2025-08-27 21:31:29', '2025-09-02 10:42:29', NULL, NULL, NULL, NULL, 35.00, 51, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(19, 'RIDE-000019', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'scheduled', '2025-09-17 18:05:29', 'van', 4, 'Please call when you arrive', 165.00, 382.00, 82.00, 629.00, 503.20, 125.80, 'completed', NULL, NULL, NULL, '2025-09-05 15:14:29', '2025-08-26 22:55:29', NULL, NULL, '2025-08-24 00:13:29', NULL, 27.00, 85, 'card', 'paid', '2025-09-09 03:07:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(20, 'RIDE-000020', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'scheduled', NULL, 'bike', 3, NULL, 60.00, 243.00, 75.00, 378.00, 302.40, 75.60, 'cancelled', 'other', 'Ride cancelled due to passenger request', NULL, '2025-08-31 13:09:29', '2025-08-30 02:05:29', NULL, NULL, NULL, '2025-08-18 19:13:29', 20.00, 16, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(21, 'RIDE-000021', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'scheduled', NULL, 'car', 4, 'Please call when you arrive', 82.00, 435.00, 84.00, 601.00, 480.80, 120.20, 'started', NULL, NULL, NULL, '2025-08-31 14:25:29', '2025-09-05 12:02:29', NULL, NULL, NULL, NULL, 48.00, 23, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(22, 'RIDE-000022', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'instant', NULL, 'bike', 3, 'Please call when you arrive', 87.00, 261.00, 154.00, 502.00, 401.60, 100.40, 'arrived', NULL, NULL, NULL, '2025-08-19 12:31:29', '2025-09-16 10:42:29', NULL, NULL, NULL, NULL, 15.00, 54, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(23, 'RIDE-000023', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'scheduled', NULL, 'rickshaw', 2, 'Please call when you arrive', 197.00, 443.00, 187.00, 827.00, 661.60, 165.40, 'arrived', NULL, NULL, NULL, '2025-09-08 13:08:29', '2025-09-02 18:34:29', NULL, NULL, NULL, NULL, 9.00, 42, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(24, 'RIDE-000024', 3, 2, 1, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'instant', '2025-09-17 22:05:29', 'van', 3, NULL, 76.00, 403.00, 158.00, 637.00, 509.60, 127.40, 'accepted', NULL, NULL, NULL, '2025-08-17 23:35:29', '2025-09-17 07:05:29', NULL, NULL, NULL, NULL, 41.00, 107, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(25, 'RIDE-000025', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', '2025-09-18 01:05:29', 'bike', 1, NULL, 52.00, 271.00, 120.00, 443.00, 354.40, 88.60, 'arrived', NULL, NULL, NULL, '2025-08-26 16:20:29', '2025-08-18 07:51:29', NULL, NULL, NULL, NULL, 29.00, 34, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(26, 'RIDE-000026', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'scheduled', NULL, 'bike', 4, 'Please call when you arrive', 131.00, 433.00, 112.00, 676.00, 540.80, 135.20, 'completed', NULL, NULL, NULL, '2025-08-26 12:12:29', '2025-09-07 03:50:29', NULL, NULL, '2025-09-05 15:59:29', NULL, 23.00, 21, 'bank_transfer', 'paid', '2025-08-29 09:11:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(27, 'RIDE-000027', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'scheduled', '2025-09-17 12:05:29', 'car', 3, 'Please call when you arrive', 191.00, 129.00, 190.00, 510.00, 408.00, 102.00, 'arrived', NULL, NULL, NULL, '2025-08-23 16:16:29', '2025-08-18 13:55:29', NULL, NULL, NULL, NULL, 24.00, 50, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(28, 'RIDE-000028', 3, 2, 1, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'instant', '2025-09-17 13:05:29', 'rickshaw', 4, NULL, 128.00, 389.00, 196.00, 713.00, 570.40, 142.60, 'completed', NULL, NULL, NULL, '2025-09-10 09:38:29', '2025-09-02 08:09:29', NULL, NULL, '2025-08-18 13:31:29', NULL, 47.00, 52, 'wallet', 'paid', '2025-08-24 02:24:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(29, 'RIDE-000029', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', '2025-09-18 03:05:29', 'van', 3, 'Please call when you arrive', 191.00, 212.00, 143.00, 546.00, 436.80, 109.20, 'completed', NULL, NULL, NULL, '2025-08-27 17:25:29', '2025-09-03 07:16:29', NULL, NULL, '2025-09-09 01:45:29', NULL, 34.00, 19, 'card', 'paid', '2025-08-19 17:58:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(30, 'RIDE-000030', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'instant', NULL, 'rickshaw', 4, 'Please call when you arrive', 85.00, 423.00, 148.00, 656.00, 524.80, 131.20, 'completed', NULL, NULL, NULL, '2025-09-10 06:15:29', '2025-08-29 18:05:29', NULL, NULL, '2025-08-18 20:56:29', NULL, 34.00, 81, 'wallet', 'paid', '2025-08-23 20:44:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(31, 'RIDE-000031', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', NULL, 'rickshaw', 1, NULL, 129.00, 430.00, 150.00, 709.00, 567.20, 141.80, 'started', NULL, NULL, NULL, '2025-09-06 18:13:29', '2025-08-17 10:36:29', NULL, NULL, NULL, NULL, 33.00, 64, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(32, 'RIDE-000032', 3, NULL, NULL, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'scheduled', '2025-09-17 13:05:29', 'car', 1, 'Please call when you arrive', 54.00, 197.00, 191.00, 442.00, 353.60, 88.40, 'pending', NULL, NULL, NULL, '2025-08-21 14:00:29', NULL, NULL, NULL, NULL, NULL, 9.00, 64, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(33, 'RIDE-000033', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'instant', NULL, 'van', 1, 'Please call when you arrive', 72.00, 317.00, 125.00, 514.00, 411.20, 102.80, 'started', NULL, NULL, NULL, '2025-08-25 06:55:29', '2025-09-13 18:29:29', NULL, NULL, NULL, NULL, 44.00, 64, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(34, 'RIDE-000034', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'instant', '2025-09-17 09:05:29', 'car', 3, NULL, 167.00, 106.00, 121.00, 394.00, 315.20, 78.80, 'searching', NULL, NULL, NULL, '2025-08-20 13:53:29', '2025-09-14 13:00:29', NULL, NULL, NULL, NULL, 22.00, 27, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(35, 'RIDE-000035', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', NULL, 'rickshaw', 1, 'Please call when you arrive', 134.00, 357.00, 78.00, 569.00, 455.20, 113.80, 'arrived', NULL, NULL, NULL, '2025-09-13 11:56:29', '2025-08-30 00:15:29', NULL, NULL, NULL, NULL, 23.00, 35, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(36, 'RIDE-000036', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'scheduled', '2025-09-17 15:05:29', 'car', 2, NULL, 154.00, 188.00, 51.00, 393.00, 314.40, 78.60, 'completed', NULL, NULL, NULL, '2025-09-12 19:13:29', '2025-08-31 18:13:29', NULL, NULL, '2025-08-25 07:53:29', NULL, 46.00, 47, 'cash', 'paid', '2025-09-16 03:55:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(37, 'RIDE-000037', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'instant', '2025-09-18 07:05:29', 'rickshaw', 3, NULL, 188.00, 337.00, 123.00, 648.00, 518.40, 129.60, 'started', NULL, NULL, NULL, '2025-08-22 11:51:29', '2025-08-25 21:59:29', NULL, NULL, NULL, NULL, 26.00, 87, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(38, 'RIDE-000038', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'scheduled', NULL, 'bike', 2, 'Please call when you arrive', 66.00, 471.00, 174.00, 711.00, 568.80, 142.20, 'cancelled', 'passenger', 'Ride cancelled due to driver unavailable', NULL, '2025-08-31 07:03:29', '2025-09-07 12:47:29', NULL, NULL, NULL, '2025-09-14 04:13:29', 17.00, 65, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(39, 'RIDE-000039', 3, NULL, NULL, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'scheduled', '2025-09-18 07:05:29', 'bike', 3, NULL, 123.00, 287.00, 125.00, 535.00, 428.00, 107.00, 'pending', NULL, NULL, NULL, '2025-09-11 17:39:29', NULL, NULL, NULL, NULL, NULL, 27.00, 35, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(40, 'RIDE-000040', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', '2025-09-17 16:05:29', 'van', 3, NULL, 67.00, 230.00, 103.00, 400.00, 320.00, 80.00, 'cancelled', 'weather', 'Ride cancelled due to passenger request', NULL, '2025-08-27 12:09:29', '2025-09-07 15:50:29', NULL, NULL, NULL, '2025-08-19 04:26:29', 22.00, 69, 'cash', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(41, 'RIDE-000041', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'scheduled', NULL, 'bike', 2, 'Please call when you arrive', 164.00, 213.00, 144.00, 521.00, 416.80, 104.20, 'completed', NULL, NULL, NULL, '2025-09-09 07:11:29', '2025-08-22 13:22:29', NULL, NULL, '2025-09-16 19:34:29', NULL, 33.00, 107, 'bank_transfer', 'paid', '2025-09-16 23:41:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(42, 'RIDE-000042', 3, 2, 1, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'instant', NULL, 'car', 1, NULL, 124.00, 138.00, 86.00, 348.00, 278.40, 69.60, 'started', NULL, NULL, NULL, '2025-09-08 12:28:29', '2025-09-01 08:43:29', NULL, NULL, NULL, NULL, 13.00, 107, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(43, 'RIDE-000043', 3, 2, 1, 'Karachi Airport', 24.90650000, 67.16020000, 'Clifton, Karachi', 24.81650000, 67.01020000, 'instant', NULL, 'bike', 2, NULL, 91.00, 104.00, 90.00, 285.00, 228.00, 57.00, 'started', NULL, NULL, NULL, '2025-08-29 03:35:29', '2025-09-05 02:54:29', NULL, NULL, NULL, NULL, 26.00, 88, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(44, 'RIDE-000044', 3, 2, 1, 'Faisalabad City Center', 31.45040000, 73.13500000, 'University of Agriculture, Faisalabad', 31.42040000, 73.10500000, 'instant', NULL, 'van', 1, 'Please call when you arrive', 60.00, 490.00, 120.00, 670.00, 536.00, 134.00, 'arrived', NULL, NULL, NULL, '2025-09-08 17:04:29', '2025-09-06 14:41:29', NULL, NULL, NULL, NULL, 7.00, 85, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(45, 'RIDE-000045', 3, 2, 1, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', '2025-09-18 06:05:29', 'van', 4, 'Please call when you arrive', 111.00, 295.00, 114.00, 520.00, 416.00, 104.00, 'arrived', NULL, NULL, NULL, '2025-09-09 22:05:29', '2025-09-10 15:37:29', NULL, NULL, NULL, NULL, 21.00, 59, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(46, 'RIDE-000046', 3, NULL, NULL, 'Islamabad Blue Area', 33.68440000, 73.04790000, 'F-8 Markaz, Islamabad', 33.69440000, 73.05790000, 'instant', '2025-09-17 15:05:29', 'bike', 1, 'Please call when you arrive', 115.00, 194.00, 158.00, 467.00, 373.60, 93.40, 'pending', NULL, NULL, NULL, '2025-09-03 07:57:29', NULL, NULL, NULL, NULL, NULL, 24.00, 94, 'wallet', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(47, 'RIDE-000047', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', NULL, 'van', 4, NULL, 102.00, 356.00, 199.00, 657.00, 525.60, 131.40, 'accepted', NULL, NULL, NULL, '2025-09-13 13:54:29', '2025-08-27 05:03:29', NULL, NULL, NULL, NULL, 44.00, 98, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(48, 'RIDE-000048', 3, 2, 1, 'Rawalpindi Saddar', 33.56510000, 73.01690000, 'Bahria Town, Rawalpindi', 33.48510000, 72.99690000, 'instant', '2025-09-18 00:05:29', 'car', 4, 'Please call when you arrive', 195.00, 488.00, 78.00, 761.00, 608.80, 152.20, 'searching', NULL, NULL, NULL, '2025-08-19 18:44:29', '2025-09-06 22:38:29', NULL, NULL, NULL, NULL, 35.00, 89, 'card', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(49, 'RIDE-000049', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'instant', '2025-09-17 14:05:29', 'rickshaw', 2, 'Please call when you arrive', 198.00, 491.00, 193.00, 882.00, 705.60, 176.40, 'started', NULL, NULL, NULL, '2025-09-10 12:23:29', '2025-08-28 14:50:29', NULL, NULL, NULL, NULL, 5.00, 108, 'bank_transfer', 'pending', NULL, '2025-09-17 07:05:29', '2025-09-17 07:05:29'),
(50, 'RIDE-000050', 3, 2, 1, 'Gulberg, Lahore', 31.52040000, 74.35870000, 'DHA Phase 5, Lahore', 31.45040000, 74.40870000, 'instant', '2025-09-17 14:05:29', 'van', 2, 'Please call when you arrive', 165.00, 265.00, 173.00, 603.00, 482.40, 120.60, 'completed', NULL, NULL, NULL, '2025-08-28 23:38:29', '2025-08-28 15:31:29', NULL, NULL, '2025-08-25 08:48:29', NULL, 27.00, 30, 'bank_transfer', 'paid', '2025-09-02 16:03:29', '2025-09-17 07:05:29', '2025-09-17 07:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `ride_tracking`
--

CREATE TABLE `ride_tracking` (
  `id` bigint UNSIGNED NOT NULL,
  `ride_id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speed` decimal(5,2) DEFAULT NULL,
  `heading` decimal(5,2) DEFAULT NULL,
  `tracking_type` enum('pickup','en_route','arrived','started','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_route',
  `tracked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ride_tracking`
--

INSERT INTO `ride_tracking` (`id`, `ride_id`, `driver_id`, `latitude`, `longitude`, `address`, `speed`, `heading`, `tracking_type`, `tracked_at`, `route_data`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 31.45030000, 73.13510000, '187, Gulberg Road, Karachi', 28.00, 344.00, 'started', '2025-09-17 06:54:59', '{\"eta_minutes\": 29, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(2, 1, 2, 31.44785714, 73.13235714, '28, Defence Phase, Rawalpindi', 27.00, 43.00, 'started', '2025-09-17 08:33:59', '{\"eta_minutes\": 26, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(3, 1, 2, 31.44611429, 73.13041429, '105, Model Town, Karachi', 27.00, 313.00, 'started', '2025-09-17 06:44:59', '{\"eta_minutes\": 23, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(4, 1, 2, 31.44417143, 73.12807143, '41, Main Boulevard, Islamabad', 16.00, 50.00, 'started', '2025-09-17 08:08:59', '{\"eta_minutes\": 23, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(5, 1, 2, 31.44142857, 73.12612857, '144, Johar Town, Islamabad', 20.00, 146.00, 'started', '2025-09-17 08:34:59', '{\"eta_minutes\": 15, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(6, 1, 2, 31.44018571, 73.12418571, '84, Gulberg Road, Islamabad', 28.00, 123.00, 'started', '2025-09-17 08:25:59', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(7, 1, 2, 31.43704286, 73.12224286, '152, Model Town, Karachi', 17.00, 217.00, 'started', '2025-09-17 08:22:59', '{\"eta_minutes\": 10, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(8, 1, 2, 31.43500000, 73.11960000, '189, Garden Town, Rawalpindi', 29.00, 48.00, 'started', '2025-09-17 08:06:59', '{\"eta_minutes\": 10, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(9, 1, 2, 31.43305714, 73.11805714, '186, Model Town, Islamabad', 21.00, 324.00, 'started', '2025-09-17 08:01:59', '{\"eta_minutes\": 20, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(10, 1, 2, 31.43061429, 73.11601429, '5, Johar Town, Faisalabad', 21.00, 23.00, 'started', '2025-09-17 06:46:59', '{\"eta_minutes\": 18, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(11, 1, 2, 31.42877143, 73.11347143, '118, Garden Town, Islamabad', 49.00, 45.00, 'started', '2025-09-17 07:08:59', '{\"eta_minutes\": 28, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(12, 1, 2, 31.42652857, 73.11162857, '24, Faisal Town, Islamabad', 30.00, 327.00, 'started', '2025-09-17 06:38:59', '{\"eta_minutes\": 30, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(13, 1, 2, 31.42518571, 73.10958571, '80, Defence Phase, Karachi', 16.00, 313.00, 'started', '2025-09-17 07:38:59', '{\"eta_minutes\": 22, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(14, 1, 2, 31.42214286, 73.10734286, '73, Model Town, Karachi', 29.00, 328.00, 'started', '2025-09-17 07:06:59', '{\"eta_minutes\": 22, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(15, 1, 2, 31.42020000, 73.10510000, '52, Faisal Town, Faisalabad', 25.00, 349.00, 'started', '2025-09-17 07:29:59', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(16, 3, 2, 33.68430000, 73.04750000, '61, Johar Town, Faisalabad', 44.00, 72.00, 'started', '2025-09-17 08:05:59', '{\"eta_minutes\": 10, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(17, 3, 2, 33.68532857, 73.04922857, '87, Model Town, Rawalpindi', 47.00, 130.00, 'started', '2025-09-17 06:47:59', '{\"eta_minutes\": 21, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(18, 3, 2, 33.68675714, 73.05095714, '45, Cantt Area, Lahore', 23.00, 143.00, 'started', '2025-09-17 07:29:59', '{\"eta_minutes\": 12, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(19, 3, 2, 33.68868571, 73.05208571, '143, Defence Phase, Lahore', 27.00, 234.00, 'started', '2025-09-17 07:28:59', '{\"eta_minutes\": 7, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(20, 3, 2, 33.68991429, 73.05381429, '141, Model Town, Islamabad', 15.00, 46.00, 'started', '2025-09-17 07:15:59', '{\"eta_minutes\": 8, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(21, 3, 2, 33.69144286, 73.05484286, '183, Johar Town, Karachi', 19.00, 62.00, 'started', '2025-09-17 07:47:59', '{\"eta_minutes\": 29, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(22, 3, 2, 33.69297143, 73.05657143, '2, Main Boulevard, Lahore', 15.00, 0.00, 'started', '2025-09-17 07:48:59', '{\"eta_minutes\": 21, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(23, 3, 2, 33.69490000, 73.05840000, '170, Johar Town, Rawalpindi', 36.00, 12.00, 'started', '2025-09-17 08:02:59', '{\"eta_minutes\": 29, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(24, 5, 2, 33.68410000, 73.04810000, '21, Defence Phase, Lahore', 46.00, 160.00, 'arrived', '2025-09-17 07:41:59', '{\"eta_minutes\": 28, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(25, 5, 2, 33.68546923, 73.04826923, '82, Johar Town, Faisalabad', 47.00, 337.00, 'arrived', '2025-09-17 07:46:59', '{\"eta_minutes\": 28, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(26, 5, 2, 33.68623846, 73.04963846, '167, Johar Town, Islamabad', 30.00, 147.00, 'arrived', '2025-09-17 08:15:59', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(27, 5, 2, 33.68680769, 73.05050769, '3, Faisal Town, Faisalabad', 26.00, 274.00, 'arrived', '2025-09-17 06:57:59', '{\"eta_minutes\": 9, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(28, 5, 2, 33.68707692, 73.05137692, '168, Main Boulevard, Faisalabad', 47.00, 15.00, 'arrived', '2025-09-17 08:12:59', '{\"eta_minutes\": 27, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(29, 5, 2, 33.68874615, 73.05224615, '145, Defence Phase, Karachi', 21.00, 89.00, 'arrived', '2025-09-17 08:30:59', '{\"eta_minutes\": 23, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(30, 5, 2, 33.68901538, 73.05261538, '78, Faisal Town, Karachi', 45.00, 161.00, 'arrived', '2025-09-17 07:28:59', '{\"eta_minutes\": 6, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(31, 5, 2, 33.68928462, 73.05288462, '66, Garden Town, Islamabad', 43.00, 300.00, 'arrived', '2025-09-17 06:50:59', '{\"eta_minutes\": 26, \"traffic_condition\": \"moderate\", \"distance_remaining\": 4}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(32, 5, 2, 33.69035385, 73.05365385, '72, Johar Town, Islamabad', 50.00, 105.00, 'arrived', '2025-09-17 06:51:59', '{\"eta_minutes\": 21, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(33, 5, 2, 33.69172308, 73.05532308, '163, Johar Town, Faisalabad', 50.00, 321.00, 'arrived', '2025-09-17 08:25:59', '{\"eta_minutes\": 17, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(34, 5, 2, 33.69189231, 73.05599231, '165, Johar Town, Faisalabad', 48.00, 166.00, 'arrived', '2025-09-17 07:32:59', '{\"eta_minutes\": 25, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(35, 5, 2, 33.69336154, 73.05636154, '195, Main Boulevard, Faisalabad', 30.00, 73.00, 'arrived', '2025-09-17 07:31:59', '{\"eta_minutes\": 23, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(36, 5, 2, 33.69353077, 73.05713077, '89, Main Boulevard, Karachi', 41.00, 341.00, 'arrived', '2025-09-17 08:35:59', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 4}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(37, 5, 2, 33.69450000, 73.05790000, '138, Johar Town, Islamabad', 18.00, 117.00, 'arrived', '2025-09-17 08:09:59', '{\"eta_minutes\": 16, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(38, 6, 2, 33.68460000, 73.04740000, '163, Garden Town, Karachi', 48.00, 334.00, 'started', '2025-09-17 07:29:59', '{\"eta_minutes\": 19, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(39, 6, 2, 33.68566923, 73.04896923, '142, Garden Town, Islamabad', 48.00, 321.00, 'started', '2025-09-17 07:47:59', '{\"eta_minutes\": 22, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(40, 6, 2, 33.68543846, 73.04913846, '192, Gulberg Road, Lahore', 39.00, 115.00, 'started', '2025-09-17 07:49:59', '{\"eta_minutes\": 20, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(41, 6, 2, 33.68630769, 73.04980769, '199, Model Town, Faisalabad', 49.00, 326.00, 'started', '2025-09-17 07:30:59', '{\"eta_minutes\": 28, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(42, 6, 2, 33.68727692, 73.05067692, '97, Defence Phase, Faisalabad', 17.00, 127.00, 'started', '2025-09-17 07:04:59', '{\"eta_minutes\": 28, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(43, 6, 2, 33.68824615, 73.05134615, '100, Gulberg Road, Karachi', 29.00, 158.00, 'started', '2025-09-17 07:52:59', '{\"eta_minutes\": 16, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(44, 6, 2, 33.68871538, 73.05291538, '197, Model Town, Islamabad', 44.00, 127.00, 'started', '2025-09-17 07:27:59', '{\"eta_minutes\": 23, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(45, 6, 2, 33.69028462, 73.05318462, '81, Defence Phase, Karachi', 44.00, 179.00, 'started', '2025-09-17 07:05:59', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(46, 6, 2, 33.69045385, 73.05415385, '44, Garden Town, Faisalabad', 25.00, 227.00, 'started', '2025-09-17 08:34:59', '{\"eta_minutes\": 16, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(47, 6, 2, 33.69162308, 73.05512308, '50, Johar Town, Karachi', 27.00, 135.00, 'started', '2025-09-17 06:36:59', '{\"eta_minutes\": 24, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(48, 6, 2, 33.69249231, 73.05589231, '196, Faisal Town, Rawalpindi', 30.00, 346.00, 'started', '2025-09-17 07:57:59', '{\"eta_minutes\": 29, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:35:59', '2025-09-17 08:35:59'),
(49, 6, 2, 33.69276154, 73.05586154, '19, Defence Phase, Islamabad', 24.00, 155.00, 'started', '2025-09-17 08:03:00', '{\"eta_minutes\": 21, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(50, 6, 2, 33.69413077, 73.05753077, '60, Main Boulevard, Lahore', 41.00, 301.00, 'started', '2025-09-17 07:08:00', '{\"eta_minutes\": 28, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(51, 6, 2, 33.69480000, 73.05770000, '79, Johar Town, Rawalpindi', 28.00, 105.00, 'started', '2025-09-17 06:50:00', '{\"eta_minutes\": 22, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(52, 7, 2, 33.56500000, 73.01700000, '174, Cantt Area, Rawalpindi', 38.00, 204.00, 'started', '2025-09-17 08:35:00', '{\"eta_minutes\": 13, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(53, 7, 2, 33.55926667, 73.01576667, '186, Johar Town, Islamabad', 37.00, 244.00, 'started', '2025-09-17 08:15:00', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(54, 7, 2, 33.55473333, 73.01373333, '125, Main Boulevard, Lahore', 28.00, 157.00, 'started', '2025-09-17 08:07:00', '{\"eta_minutes\": 10, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(55, 7, 2, 33.54940000, 73.01280000, '22, Faisal Town, Islamabad', 26.00, 231.00, 'started', '2025-09-17 06:54:00', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(56, 7, 2, 33.54376667, 73.01156667, '37, Main Boulevard, Lahore', 22.00, 312.00, 'started', '2025-09-17 07:42:00', '{\"eta_minutes\": 15, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(57, 7, 2, 33.53853333, 73.01003333, '68, Defence Phase, Lahore', 46.00, 220.00, 'started', '2025-09-17 06:42:00', '{\"eta_minutes\": 25, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(58, 7, 2, 33.53290000, 73.00910000, '106, Garden Town, Karachi', 21.00, 264.00, 'started', '2025-09-17 07:44:00', '{\"eta_minutes\": 24, \"traffic_condition\": \"heavy\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(59, 7, 2, 33.52766667, 73.00726667, '153, Main Boulevard, Islamabad', 31.00, 64.00, 'started', '2025-09-17 08:29:00', '{\"eta_minutes\": 11, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(60, 7, 2, 33.52213333, 73.00653333, '187, Model Town, Faisalabad', 50.00, 224.00, 'started', '2025-09-17 08:35:00', '{\"eta_minutes\": 6, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(61, 7, 2, 33.51680000, 73.00440000, '191, Cantt Area, Faisalabad', 29.00, 172.00, 'started', '2025-09-17 08:04:00', '{\"eta_minutes\": 20, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(62, 7, 2, 33.51216667, 73.00346667, '19, Johar Town, Faisalabad', 38.00, 40.00, 'started', '2025-09-17 08:35:00', '{\"eta_minutes\": 29, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(63, 7, 2, 33.50653333, 73.00273333, '192, Faisal Town, Islamabad', 19.00, 326.00, 'started', '2025-09-17 06:37:00', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(64, 7, 2, 33.50160000, 73.00120000, '88, Model Town, Islamabad', 29.00, 285.00, 'started', '2025-09-17 08:20:00', '{\"eta_minutes\": 7, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(65, 7, 2, 33.49596667, 72.99916667, '18, Faisal Town, Islamabad', 20.00, 138.00, 'started', '2025-09-17 07:33:00', '{\"eta_minutes\": 27, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(66, 7, 2, 33.49083333, 72.99793333, '44, Cantt Area, Lahore', 40.00, 74.00, 'started', '2025-09-17 06:42:00', '{\"eta_minutes\": 14, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(67, 7, 2, 33.48500000, 72.99710000, '172, Garden Town, Faisalabad', 33.00, 184.00, 'started', '2025-09-17 07:58:00', '{\"eta_minutes\": 24, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(68, 11, 2, 33.68470000, 73.04780000, '196, Defence Phase, Karachi', 27.00, 338.00, 'started', '2025-09-17 08:33:00', '{\"eta_minutes\": 30, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(69, 11, 2, 33.68520909, 73.04920909, '141, Garden Town, Faisalabad', 35.00, 14.00, 'started', '2025-09-17 08:16:00', '{\"eta_minutes\": 17, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(70, 11, 2, 33.68661818, 73.04941818, '118, Main Boulevard, Lahore', 39.00, 102.00, 'started', '2025-09-17 07:39:00', '{\"eta_minutes\": 23, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(71, 11, 2, 33.68752727, 73.05022727, '104, Gulberg Road, Islamabad', 43.00, 263.00, 'started', '2025-09-17 08:00:00', '{\"eta_minutes\": 11, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(72, 11, 2, 33.68783636, 73.05123636, '171, Faisal Town, Faisalabad', 31.00, 355.00, 'started', '2025-09-17 07:04:00', '{\"eta_minutes\": 27, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(73, 11, 2, 33.68884545, 73.05204545, '15, Faisal Town, Lahore', 39.00, 147.00, 'started', '2025-09-17 06:47:00', '{\"eta_minutes\": 30, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(74, 11, 2, 33.68985455, 73.05335455, '182, Johar Town, Rawalpindi', 45.00, 180.00, 'started', '2025-09-17 07:09:00', '{\"eta_minutes\": 11, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(75, 11, 2, 33.69056364, 73.05466364, '132, Model Town, Rawalpindi', 35.00, 222.00, 'started', '2025-09-17 06:36:00', '{\"eta_minutes\": 29, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(76, 11, 2, 33.69157273, 73.05557273, '185, Johar Town, Faisalabad', 40.00, 179.00, 'started', '2025-09-17 07:19:00', '{\"eta_minutes\": 22, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(77, 11, 2, 33.69258182, 73.05578182, '135, Johar Town, Lahore', 23.00, 190.00, 'started', '2025-09-17 06:43:00', '{\"eta_minutes\": 13, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(78, 11, 2, 33.69339091, 73.05749091, '85, Faisal Town, Rawalpindi', 36.00, 320.00, 'started', '2025-09-17 08:27:00', '{\"eta_minutes\": 5, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(79, 11, 2, 33.69400000, 73.05840000, '130, Model Town, Rawalpindi', 40.00, 121.00, 'started', '2025-09-17 08:35:00', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(80, 14, 2, 24.90680000, 67.15970000, '30, Garden Town, Islamabad', 32.00, 321.00, 'en_route', '2025-09-17 07:55:00', '{\"eta_minutes\": 19, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(81, 14, 2, 24.88830000, 67.13040000, '151, Johar Town, Faisalabad', 44.00, 229.00, 'en_route', '2025-09-17 08:13:00', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(82, 14, 2, 24.87090000, 67.10000000, '20, Defence Phase, Lahore', 31.00, 172.00, 'en_route', '2025-09-17 08:18:00', '{\"eta_minutes\": 23, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(83, 14, 2, 24.85300000, 67.07050000, '141, Cantt Area, Karachi', 30.00, 145.00, 'en_route', '2025-09-17 08:34:00', '{\"eta_minutes\": 22, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(84, 14, 2, 24.83400000, 67.04060000, '1, Gulberg Road, Lahore', 37.00, 178.00, 'en_route', '2025-09-17 06:48:00', '{\"eta_minutes\": 29, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(85, 14, 2, 24.81610000, 67.00990000, '87, Defence Phase, Islamabad', 43.00, 354.00, 'en_route', '2025-09-17 08:26:00', '{\"eta_minutes\": 9, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(86, 18, 2, 24.90700000, 67.16040000, '194, Garden Town, Lahore', 25.00, 183.00, 'arrived', '2025-09-17 07:42:00', '{\"eta_minutes\": 21, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(87, 18, 2, 24.89374286, 67.13907143, '79, Gulberg Road, Islamabad', 22.00, 158.00, 'arrived', '2025-09-17 06:56:00', '{\"eta_minutes\": 14, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(88, 18, 2, 24.88058571, 67.11774286, '19, Main Boulevard, Rawalpindi', 41.00, 220.00, 'arrived', '2025-09-17 07:38:00', '{\"eta_minutes\": 13, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(89, 18, 2, 24.86812857, 67.09561429, '54, Gulberg Road, Rawalpindi', 15.00, 153.00, 'arrived', '2025-09-17 06:53:00', '{\"eta_minutes\": 17, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(90, 18, 2, 24.85507143, 67.07418571, '124, Cantt Area, Faisalabad', 16.00, 114.00, 'arrived', '2025-09-17 08:34:00', '{\"eta_minutes\": 14, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(91, 18, 2, 24.84271429, 67.05295714, '193, Cantt Area, Faisalabad', 21.00, 260.00, 'arrived', '2025-09-17 07:29:00', '{\"eta_minutes\": 16, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(92, 18, 2, 24.82905714, 67.03142857, '173, Gulberg Road, Islamabad', 41.00, 342.00, 'arrived', '2025-09-17 08:25:00', '{\"eta_minutes\": 15, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(93, 18, 2, 24.81670000, 67.01070000, '89, Johar Town, Faisalabad', 30.00, 70.00, 'arrived', '2025-09-17 08:00:00', '{\"eta_minutes\": 26, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(94, 21, 2, 33.68450000, 73.04770000, '177, Johar Town, Islamabad', 35.00, 315.00, 'pickup', '2025-09-17 08:05:00', '{\"eta_minutes\": 7, \"traffic_condition\": \"heavy\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(95, 21, 2, 33.68553333, 73.04843333, '125, Gulberg Road, Rawalpindi', 37.00, 112.00, 'pickup', '2025-09-17 06:48:00', '{\"eta_minutes\": 16, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(96, 21, 2, 33.68566667, 73.04936667, '62, Johar Town, Rawalpindi', 43.00, 285.00, 'pickup', '2025-09-17 08:16:00', '{\"eta_minutes\": 22, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(97, 21, 2, 33.68640000, 73.04990000, '41, Model Town, Lahore', 35.00, 205.00, 'pickup', '2025-09-17 08:08:00', '{\"eta_minutes\": 27, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(98, 21, 2, 33.68753333, 73.05153333, '76, Gulberg Road, Rawalpindi', 43.00, 211.00, 'pickup', '2025-09-17 07:23:00', '{\"eta_minutes\": 8, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(99, 21, 2, 33.68896667, 73.05256667, '168, Gulberg Road, Islamabad', 42.00, 66.00, 'pickup', '2025-09-17 08:05:00', '{\"eta_minutes\": 8, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(100, 21, 2, 33.68890000, 73.05340000, '40, Defence Phase, Lahore', 33.00, 16.00, 'pickup', '2025-09-17 08:05:00', '{\"eta_minutes\": 15, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(101, 21, 2, 33.69073333, 73.05343333, '87, Main Boulevard, Karachi', 27.00, 164.00, 'pickup', '2025-09-17 08:17:00', '{\"eta_minutes\": 8, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(102, 21, 2, 33.69076667, 73.05476667, '136, Model Town, Faisalabad', 49.00, 312.00, 'pickup', '2025-09-17 06:42:00', '{\"eta_minutes\": 22, \"traffic_condition\": \"heavy\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(103, 21, 2, 33.69140000, 73.05570000, '61, Model Town, Faisalabad', 17.00, 244.00, 'pickup', '2025-09-17 08:32:00', '{\"eta_minutes\": 8, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(104, 21, 2, 33.69253333, 73.05603333, '109, Main Boulevard, Faisalabad', 27.00, 48.00, 'pickup', '2025-09-17 07:42:00', '{\"eta_minutes\": 17, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(105, 21, 2, 33.69366667, 73.05676667, '6, Faisal Town, Lahore', 36.00, 130.00, 'pickup', '2025-09-17 07:51:00', '{\"eta_minutes\": 11, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(106, 21, 2, 33.69480000, 73.05800000, '40, Johar Town, Islamabad', 48.00, 126.00, 'pickup', '2025-09-17 07:52:00', '{\"eta_minutes\": 9, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(107, 22, 2, 31.52040000, 74.35860000, '119, Garden Town, Faisalabad', 23.00, 64.00, 'en_route', '2025-09-17 06:40:00', '{\"eta_minutes\": 23, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(108, 22, 2, 31.51403636, 74.36334545, '34, Model Town, Faisalabad', 19.00, 169.00, 'en_route', '2025-09-17 07:50:00', '{\"eta_minutes\": 12, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(109, 22, 2, 31.50787273, 74.36789091, '179, Johar Town, Karachi', 44.00, 100.00, 'en_route', '2025-09-17 06:47:00', '{\"eta_minutes\": 17, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(110, 22, 2, 31.50160909, 74.37203636, '3, Faisal Town, Karachi', 18.00, 163.00, 'en_route', '2025-09-17 07:47:00', '{\"eta_minutes\": 26, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(111, 22, 2, 31.49504545, 74.37648182, '115, Model Town, Karachi', 44.00, 283.00, 'en_route', '2025-09-17 08:27:00', '{\"eta_minutes\": 10, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(112, 22, 2, 31.48878182, 74.38142727, '140, Model Town, Islamabad', 47.00, 39.00, 'en_route', '2025-09-17 08:32:00', '{\"eta_minutes\": 11, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(113, 22, 2, 31.48251818, 74.38557273, '139, Model Town, Lahore', 15.00, 353.00, 'en_route', '2025-09-17 06:37:00', '{\"eta_minutes\": 14, \"traffic_condition\": \"heavy\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(114, 22, 2, 31.47565455, 74.39101818, '149, Faisal Town, Rawalpindi', 50.00, 176.00, 'en_route', '2025-09-17 07:46:00', '{\"eta_minutes\": 13, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(115, 22, 2, 31.46899091, 74.39516364, '27, Defence Phase, Faisalabad', 41.00, 128.00, 'en_route', '2025-09-17 07:36:00', '{\"eta_minutes\": 24, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(116, 22, 2, 31.46332727, 74.39910909, '137, Gulberg Road, Faisalabad', 39.00, 34.00, 'en_route', '2025-09-17 07:10:00', '{\"eta_minutes\": 17, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(117, 22, 2, 31.45656364, 74.40445455, '198, Garden Town, Rawalpindi', 29.00, 217.00, 'en_route', '2025-09-17 07:06:00', '{\"eta_minutes\": 14, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(118, 22, 2, 31.45010000, 74.40910000, '193, Cantt Area, Rawalpindi', 36.00, 256.00, 'en_route', '2025-09-17 06:56:00', '{\"eta_minutes\": 21, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(119, 23, 2, 24.90600000, 67.16030000, '45, Model Town, Islamabad', 27.00, 251.00, 'arrived', '2025-09-17 08:36:00', '{\"eta_minutes\": 6, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:00', '2025-09-17 08:36:00'),
(120, 23, 2, 24.88810000, 67.13040000, '82, Garden Town, Faisalabad', 26.00, 163.00, 'arrived', '2025-09-17 06:44:01', '{\"eta_minutes\": 9, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(121, 23, 2, 24.87050000, 67.09970000, '15, Model Town, Rawalpindi', 18.00, 98.00, 'arrived', '2025-09-17 08:25:01', '{\"eta_minutes\": 13, \"traffic_condition\": \"light\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(122, 23, 2, 24.85300000, 67.07030000, '3, Cantt Area, Islamabad', 16.00, 325.00, 'arrived', '2025-09-17 07:18:01', '{\"eta_minutes\": 25, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(123, 23, 2, 24.83470000, 67.03970000, '187, Johar Town, Islamabad', 20.00, 243.00, 'arrived', '2025-09-17 08:05:01', '{\"eta_minutes\": 5, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(124, 23, 2, 24.81610000, 67.01040000, '26, Cantt Area, Islamabad', 35.00, 79.00, 'arrived', '2025-09-17 06:45:01', '{\"eta_minutes\": 21, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(125, 24, 2, 31.45020000, 73.13550000, '166, Main Boulevard, Islamabad', 36.00, 349.00, 'pickup', '2025-09-17 07:58:01', '{\"eta_minutes\": 26, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(126, 24, 2, 31.44621429, 73.13081429, '43, Cantt Area, Islamabad', 27.00, 109.00, 'pickup', '2025-09-17 08:25:01', '{\"eta_minutes\": 28, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(127, 24, 2, 31.44132857, 73.12692857, '196, Main Boulevard, Faisalabad', 36.00, 102.00, 'pickup', '2025-09-17 07:59:01', '{\"eta_minutes\": 29, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(128, 24, 2, 31.43734286, 73.12234286, '60, Model Town, Rawalpindi', 38.00, 145.00, 'pickup', '2025-09-17 08:24:01', '{\"eta_minutes\": 8, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(129, 24, 2, 31.43375714, 73.11825714, '185, Johar Town, Lahore', 17.00, 274.00, 'pickup', '2025-09-17 08:12:01', '{\"eta_minutes\": 28, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(130, 24, 2, 31.42937143, 73.11307143, '138, Cantt Area, Islamabad', 27.00, 342.00, 'pickup', '2025-09-17 07:28:01', '{\"eta_minutes\": 23, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(131, 24, 2, 31.42458571, 73.10948571, '135, Gulberg Road, Karachi', 37.00, 120.00, 'pickup', '2025-09-17 08:33:01', '{\"eta_minutes\": 14, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(132, 24, 2, 31.41990000, 73.10490000, '195, Main Boulevard, Karachi', 27.00, 120.00, 'pickup', '2025-09-17 08:07:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(133, 25, 2, 33.56490000, 73.01730000, '9, Gulberg Road, Karachi', 35.00, 92.00, 'arrived', '2025-09-17 07:42:01', '{\"eta_minutes\": 28, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(134, 25, 2, 33.55470000, 73.01420000, '159, Gulberg Road, Islamabad', 50.00, 218.00, 'arrived', '2025-09-17 07:48:01', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(135, 25, 2, 33.54510000, 73.01170000, '110, Model Town, Faisalabad', 24.00, 342.00, 'arrived', '2025-09-17 07:07:01', '{\"eta_minutes\": 5, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(136, 25, 2, 33.53510000, 73.00960000, '176, Model Town, Islamabad', 42.00, 139.00, 'arrived', '2025-09-17 07:32:01', '{\"eta_minutes\": 16, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(137, 25, 2, 33.52500000, 73.00680000, '112, Cantt Area, Islamabad', 41.00, 117.00, 'arrived', '2025-09-17 07:53:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(138, 25, 2, 33.51560000, 73.00490000, '182, Johar Town, Rawalpindi', 42.00, 315.00, 'arrived', '2025-09-17 07:32:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(139, 25, 2, 33.50550000, 73.00200000, '46, Model Town, Islamabad', 49.00, 335.00, 'arrived', '2025-09-17 06:57:01', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(140, 25, 2, 33.49520000, 72.99930000, '158, Johar Town, Karachi', 34.00, 199.00, 'arrived', '2025-09-17 07:17:01', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(141, 25, 2, 33.48530000, 72.99690000, '163, Defence Phase, Rawalpindi', 30.00, 137.00, 'arrived', '2025-09-17 07:03:01', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(142, 27, 2, 33.56510000, 73.01720000, '42, Cantt Area, Faisalabad', 47.00, 107.00, 'en_route', '2025-09-17 08:05:01', '{\"eta_minutes\": 20, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(143, 27, 2, 33.55186667, 73.01376667, '113, Garden Town, Lahore', 15.00, 20.00, 'en_route', '2025-09-17 06:46:01', '{\"eta_minutes\": 26, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(144, 27, 2, 33.53833333, 73.01013333, '100, Defence Phase, Rawalpindi', 20.00, 138.00, 'en_route', '2025-09-17 08:21:01', '{\"eta_minutes\": 10, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(145, 27, 2, 33.52550000, 73.00680000, '21, Garden Town, Karachi', 24.00, 96.00, 'en_route', '2025-09-17 07:36:01', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(146, 27, 2, 33.51156667, 73.00376667, '71, Model Town, Islamabad', 19.00, 147.00, 'en_route', '2025-09-17 08:35:01', '{\"eta_minutes\": 14, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(147, 27, 2, 33.49813333, 72.99993333, '141, Gulberg Road, Faisalabad', 39.00, 287.00, 'en_route', '2025-09-17 07:48:01', '{\"eta_minutes\": 5, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(148, 27, 2, 33.48480000, 72.99700000, '179, Faisal Town, Karachi', 50.00, 118.00, 'en_route', '2025-09-17 07:34:01', '{\"eta_minutes\": 16, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(149, 31, 2, 33.56530000, 73.01690000, '16, Johar Town, Rawalpindi', 48.00, 326.00, 'started', '2025-09-17 07:27:01', '{\"eta_minutes\": 21, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(150, 31, 2, 33.55337143, 73.01384286, '53, Cantt Area, Rawalpindi', 44.00, 264.00, 'started', '2025-09-17 07:28:01', '{\"eta_minutes\": 20, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(151, 31, 2, 33.54254286, 73.01118571, '103, Garden Town, Faisalabad', 19.00, 263.00, 'started', '2025-09-17 07:00:01', '{\"eta_minutes\": 6, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(152, 31, 2, 33.53131429, 73.00882857, '5, Johar Town, Karachi', 28.00, 274.00, 'started', '2025-09-17 06:48:01', '{\"eta_minutes\": 6, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(153, 31, 2, 33.51978571, 73.00507143, '99, Faisal Town, Rawalpindi', 20.00, 189.00, 'started', '2025-09-17 07:29:01', '{\"eta_minutes\": 24, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(154, 31, 2, 33.50785714, 73.00311429, '192, Faisal Town, Islamabad', 18.00, 152.00, 'started', '2025-09-17 08:15:01', '{\"eta_minutes\": 20, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(155, 31, 2, 33.49622857, 72.99985714, '28, Gulberg Road, Faisalabad', 44.00, 171.00, 'started', '2025-09-17 07:46:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 4}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(156, 31, 2, 33.48520000, 72.99650000, '180, Model Town, Faisalabad', 39.00, 245.00, 'started', '2025-09-17 07:10:01', '{\"eta_minutes\": 16, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(157, 33, 2, 31.52030000, 74.35890000, '161, Faisal Town, Lahore', 23.00, 225.00, 'en_route', '2025-09-17 06:51:01', '{\"eta_minutes\": 8, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(158, 33, 2, 31.51282222, 74.36395556, '2, Johar Town, Faisalabad', 49.00, 233.00, 'en_route', '2025-09-17 08:16:01', '{\"eta_minutes\": 23, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(159, 33, 2, 31.50434444, 74.36981111, '71, Johar Town, Lahore', 40.00, 344.00, 'en_route', '2025-09-17 07:01:01', '{\"eta_minutes\": 5, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(160, 33, 2, 31.49656667, 74.37556667, '59, Model Town, Islamabad', 23.00, 220.00, 'en_route', '2025-09-17 07:21:01', '{\"eta_minutes\": 15, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(161, 33, 2, 31.48978889, 74.38052222, '185, Defence Phase, Karachi', 23.00, 356.00, 'en_route', '2025-09-17 08:11:01', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(162, 33, 2, 31.48141111, 74.38687778, '185, Main Boulevard, Lahore', 34.00, 294.00, 'en_route', '2025-09-17 07:12:01', '{\"eta_minutes\": 17, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(163, 33, 2, 31.47393333, 74.39213333, '73, Cantt Area, Lahore', 34.00, 266.00, 'en_route', '2025-09-17 07:59:01', '{\"eta_minutes\": 14, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(164, 33, 2, 31.46555556, 74.39778889, '170, Faisal Town, Rawalpindi', 35.00, 208.00, 'en_route', '2025-09-17 07:16:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(165, 33, 2, 31.45817778, 74.40364444, '174, Garden Town, Islamabad', 43.00, 351.00, 'en_route', '2025-09-17 08:32:01', '{\"eta_minutes\": 6, \"traffic_condition\": \"light\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(166, 33, 2, 31.45060000, 74.40890000, '174, Defence Phase, Karachi', 41.00, 62.00, 'en_route', '2025-09-17 07:50:01', '{\"eta_minutes\": 25, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(167, 35, 2, 33.56560000, 73.01700000, '49, Garden Town, Lahore', 43.00, 198.00, 'pickup', '2025-09-17 08:14:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"light\", \"distance_remaining\": 2}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(168, 35, 2, 33.55874615, 73.01506154, '56, Faisal Town, Karachi', 49.00, 73.00, 'pickup', '2025-09-17 08:36:01', '{\"eta_minutes\": 19, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(169, 35, 2, 33.55319231, 73.01372308, '174, Garden Town, Faisalabad', 27.00, 354.00, 'pickup', '2025-09-17 07:32:01', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(170, 35, 2, 33.54613846, 73.01228462, '52, Cantt Area, Karachi', 36.00, 96.00, 'pickup', '2025-09-17 08:13:01', '{\"eta_minutes\": 19, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(171, 35, 2, 33.54078462, 73.01034615, '169, Garden Town, Rawalpindi', 17.00, 234.00, 'pickup', '2025-09-17 07:28:01', '{\"eta_minutes\": 6, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(172, 35, 2, 33.53453077, 73.00940769, '41, Model Town, Faisalabad', 33.00, 155.00, 'pickup', '2025-09-17 06:45:01', '{\"eta_minutes\": 11, \"traffic_condition\": \"light\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(173, 35, 2, 33.52817692, 73.00766923, '103, Garden Town, Faisalabad', 36.00, 260.00, 'pickup', '2025-09-17 08:06:01', '{\"eta_minutes\": 24, \"traffic_condition\": \"moderate\", \"distance_remaining\": 10}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(174, 35, 2, 33.52222308, 73.00603077, '162, Main Boulevard, Lahore', 28.00, 351.00, 'pickup', '2025-09-17 08:29:01', '{\"eta_minutes\": 25, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(175, 35, 2, 33.51616923, 73.00499231, '32, Faisal Town, Rawalpindi', 48.00, 306.00, 'pickup', '2025-09-17 08:27:01', '{\"eta_minutes\": 6, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(176, 35, 2, 33.51001538, 73.00345385, '23, Johar Town, Islamabad', 47.00, 137.00, 'pickup', '2025-09-17 06:55:01', '{\"eta_minutes\": 14, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(177, 35, 2, 33.50366154, 73.00181538, '37, Cantt Area, Karachi', 20.00, 311.00, 'pickup', '2025-09-17 07:39:01', '{\"eta_minutes\": 5, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(178, 35, 2, 33.49720769, 73.00027692, '62, Johar Town, Faisalabad', 27.00, 13.00, 'pickup', '2025-09-17 08:26:01', '{\"eta_minutes\": 27, \"traffic_condition\": \"heavy\", \"distance_remaining\": 4}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(179, 35, 2, 33.49145385, 72.99843846, '169, Garden Town, Lahore', 36.00, 232.00, 'pickup', '2025-09-17 07:16:01', '{\"eta_minutes\": 23, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(180, 35, 2, 33.48530000, 72.99680000, '168, Model Town, Rawalpindi', 29.00, 88.00, 'pickup', '2025-09-17 07:45:01', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(181, 37, 2, 31.52020000, 74.35840000, '115, Main Boulevard, Karachi', 47.00, 283.00, 'en_route', '2025-09-17 08:21:01', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(182, 37, 2, 31.51242222, 74.36385556, '16, Faisal Town, Faisalabad', 39.00, 48.00, 'en_route', '2025-09-17 08:28:01', '{\"eta_minutes\": 6, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(183, 37, 2, 31.50494444, 74.37031111, '9, Gulberg Road, Faisalabad', 28.00, 161.00, 'en_route', '2025-09-17 08:12:01', '{\"eta_minutes\": 17, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(184, 37, 2, 31.49696667, 74.37546667, '181, Gulberg Road, Faisalabad', 22.00, 265.00, 'en_route', '2025-09-17 08:04:01', '{\"eta_minutes\": 21, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(185, 37, 2, 31.48878889, 74.38142222, '163, Faisal Town, Lahore', 41.00, 41.00, 'en_route', '2025-09-17 07:57:01', '{\"eta_minutes\": 22, \"traffic_condition\": \"heavy\", \"distance_remaining\": 2}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(186, 37, 2, 31.48121111, 74.38597778, '75, Main Boulevard, Faisalabad', 17.00, 36.00, 'en_route', '2025-09-17 07:54:01', '{\"eta_minutes\": 7, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(187, 37, 2, 31.47383333, 74.39183333, '21, Garden Town, Rawalpindi', 15.00, 280.00, 'en_route', '2025-09-17 07:55:01', '{\"eta_minutes\": 20, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(188, 37, 2, 31.46555556, 74.39768889, '52, Gulberg Road, Faisalabad', 22.00, 94.00, 'en_route', '2025-09-17 08:08:01', '{\"eta_minutes\": 19, \"traffic_condition\": \"heavy\", \"distance_remaining\": 2}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(189, 37, 2, 31.45867778, 74.40354444, '130, Garden Town, Lahore', 36.00, 345.00, 'en_route', '2025-09-17 07:29:01', '{\"eta_minutes\": 17, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:01', '2025-09-17 08:36:01'),
(190, 37, 2, 31.45060000, 74.40880000, '153, Main Boulevard, Faisalabad', 36.00, 328.00, 'en_route', '2025-09-17 07:00:02', '{\"eta_minutes\": 13, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(191, 42, 2, 31.45080000, 73.13530000, '46, Johar Town, Karachi', 25.00, 55.00, 'started', '2025-09-17 08:16:02', '{\"eta_minutes\": 20, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(192, 42, 2, 31.44830000, 73.13260000, '152, Cantt Area, Faisalabad', 23.00, 57.00, 'started', '2025-09-17 07:50:02', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 4}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(193, 42, 2, 31.44510000, 73.12970000, '68, Garden Town, Karachi', 17.00, 62.00, 'started', '2025-09-17 07:11:02', '{\"eta_minutes\": 29, \"traffic_condition\": \"heavy\", \"distance_remaining\": 2}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(194, 42, 2, 31.44340000, 73.12780000, '180, Model Town, Lahore', 19.00, 124.00, 'started', '2025-09-17 07:45:02', '{\"eta_minutes\": 10, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(195, 42, 2, 31.44020000, 73.12450000, '49, Garden Town, Karachi', 49.00, 263.00, 'started', '2025-09-17 06:58:02', '{\"eta_minutes\": 26, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(196, 42, 2, 31.43810000, 73.12210000, '63, Main Boulevard, Faisalabad', 31.00, 291.00, 'started', '2025-09-17 07:00:02', '{\"eta_minutes\": 19, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(197, 42, 2, 31.43530000, 73.12030000, '200, Defence Phase, Karachi', 16.00, 128.00, 'started', '2025-09-17 07:00:02', '{\"eta_minutes\": 13, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(198, 42, 2, 31.43300000, 73.11780000, '146, Cantt Area, Islamabad', 43.00, 260.00, 'started', '2025-09-17 08:34:02', '{\"eta_minutes\": 25, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(199, 42, 2, 31.43090000, 73.11540000, '77, Cantt Area, Lahore', 37.00, 184.00, 'started', '2025-09-17 07:34:02', '{\"eta_minutes\": 17, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02');
INSERT INTO `ride_tracking` (`id`, `ride_id`, `driver_id`, `latitude`, `longitude`, `address`, `speed`, `heading`, `tracking_type`, `tracked_at`, `route_data`, `created_at`, `updated_at`) VALUES
(200, 42, 2, 31.42810000, 73.11240000, '93, Gulberg Road, Karachi', 18.00, 224.00, 'started', '2025-09-17 08:18:02', '{\"eta_minutes\": 27, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(201, 42, 2, 31.42510000, 73.10960000, '97, Defence Phase, Islamabad', 30.00, 123.00, 'started', '2025-09-17 08:09:02', '{\"eta_minutes\": 21, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(202, 42, 2, 31.42260000, 73.10750000, '194, Cantt Area, Faisalabad', 22.00, 217.00, 'started', '2025-09-17 08:01:02', '{\"eta_minutes\": 26, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(203, 42, 2, 31.42060000, 73.10540000, '83, Defence Phase, Lahore', 21.00, 322.00, 'started', '2025-09-17 07:46:02', '{\"eta_minutes\": 5, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(204, 43, 2, 24.90700000, 67.15980000, '76, Main Boulevard, Faisalabad', 41.00, 20.00, 'started', '2025-09-17 06:55:02', '{\"eta_minutes\": 11, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(205, 43, 2, 24.89334286, 67.13917143, '117, Cantt Area, Rawalpindi', 31.00, 350.00, 'started', '2025-09-17 07:43:02', '{\"eta_minutes\": 28, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(206, 43, 2, 24.88088571, 67.11784286, '167, Garden Town, Rawalpindi', 45.00, 199.00, 'started', '2025-09-17 07:38:02', '{\"eta_minutes\": 8, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(207, 43, 2, 24.86802857, 67.09601429, '86, Model Town, Islamabad', 46.00, 317.00, 'started', '2025-09-17 07:01:02', '{\"eta_minutes\": 5, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(208, 43, 2, 24.85537143, 67.07458571, '144, Defence Phase, Karachi', 24.00, 139.00, 'started', '2025-09-17 07:25:02', '{\"eta_minutes\": 25, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(209, 43, 2, 24.84251429, 67.05325714, '111, Defence Phase, Lahore', 46.00, 22.00, 'started', '2025-09-17 07:19:02', '{\"eta_minutes\": 16, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(210, 43, 2, 24.82945714, 67.03182857, '124, Defence Phase, Lahore', 41.00, 101.00, 'started', '2025-09-17 06:57:02', '{\"eta_minutes\": 10, \"traffic_condition\": \"moderate\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(211, 43, 2, 24.81700000, 67.01030000, '116, Faisal Town, Faisalabad', 42.00, 14.00, 'started', '2025-09-17 07:40:02', '{\"eta_minutes\": 13, \"traffic_condition\": \"light\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(212, 44, 2, 31.45010000, 73.13530000, '152, Garden Town, Rawalpindi', 20.00, 198.00, 'started', '2025-09-17 08:22:02', '{\"eta_minutes\": 11, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(213, 44, 2, 31.44736667, 73.13116667, '68, Gulberg Road, Rawalpindi', 40.00, 159.00, 'started', '2025-09-17 06:38:02', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(214, 44, 2, 31.44373333, 73.12883333, '72, Gulberg Road, Karachi', 28.00, 60.00, 'started', '2025-09-17 06:39:02', '{\"eta_minutes\": 6, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(215, 44, 2, 31.44000000, 73.12490000, '175, Faisal Town, Karachi', 43.00, 328.00, 'started', '2025-09-17 07:58:02', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(216, 44, 2, 31.43716667, 73.12196667, '125, Cantt Area, Islamabad', 50.00, 152.00, 'started', '2025-09-17 08:16:02', '{\"eta_minutes\": 11, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(217, 44, 2, 31.43323333, 73.11783333, '116, Garden Town, Faisalabad', 48.00, 156.00, 'started', '2025-09-17 07:34:02', '{\"eta_minutes\": 6, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(218, 44, 2, 31.43060000, 73.11520000, '101, Garden Town, Lahore', 33.00, 7.00, 'started', '2025-09-17 07:07:02', '{\"eta_minutes\": 23, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(219, 44, 2, 31.42656667, 73.11176667, '167, Johar Town, Lahore', 28.00, 118.00, 'started', '2025-09-17 08:02:02', '{\"eta_minutes\": 23, \"traffic_condition\": \"light\", \"distance_remaining\": 4}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(220, 44, 2, 31.42373333, 73.10783333, '126, Defence Phase, Lahore', 29.00, 208.00, 'started', '2025-09-17 06:49:02', '{\"eta_minutes\": 22, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(221, 44, 2, 31.42060000, 73.10460000, '120, Main Boulevard, Lahore', 27.00, 360.00, 'started', '2025-09-17 06:36:02', '{\"eta_minutes\": 18, \"traffic_condition\": \"light\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(222, 45, 2, 33.68450000, 73.04840000, '179, Garden Town, Islamabad', 20.00, 106.00, 'pickup', '2025-09-17 07:41:02', '{\"eta_minutes\": 21, \"traffic_condition\": \"heavy\", \"distance_remaining\": 2}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(223, 45, 2, 33.68566923, 73.04866923, '123, Defence Phase, Karachi', 40.00, 260.00, 'pickup', '2025-09-17 07:57:02', '{\"eta_minutes\": 8, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(224, 45, 2, 33.68623846, 73.04933846, '70, Faisal Town, Faisalabad', 19.00, 116.00, 'pickup', '2025-09-17 07:42:02', '{\"eta_minutes\": 5, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(225, 45, 2, 33.68680769, 73.04990769, '85, Model Town, Rawalpindi', 18.00, 15.00, 'pickup', '2025-09-17 08:02:02', '{\"eta_minutes\": 21, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(226, 45, 2, 33.68727692, 73.05097692, '48, Johar Town, Faisalabad', 17.00, 337.00, 'pickup', '2025-09-17 08:12:02', '{\"eta_minutes\": 14, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(227, 45, 2, 33.68854615, 73.05214615, '92, Johar Town, Faisalabad', 43.00, 6.00, 'pickup', '2025-09-17 08:19:02', '{\"eta_minutes\": 13, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(228, 45, 2, 33.68911538, 73.05251538, '144, Defence Phase, Karachi', 24.00, 263.00, 'pickup', '2025-09-17 08:20:02', '{\"eta_minutes\": 24, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(229, 45, 2, 33.68958462, 73.05368462, '115, Main Boulevard, Faisalabad', 44.00, 179.00, 'pickup', '2025-09-17 08:09:02', '{\"eta_minutes\": 20, \"traffic_condition\": \"heavy\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(230, 45, 2, 33.69055385, 73.05395385, '119, Cantt Area, Lahore', 30.00, 272.00, 'pickup', '2025-09-17 08:36:02', '{\"eta_minutes\": 5, \"traffic_condition\": \"heavy\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(231, 45, 2, 33.69142308, 73.05502308, '48, Gulberg Road, Islamabad', 38.00, 248.00, 'pickup', '2025-09-17 08:34:02', '{\"eta_minutes\": 12, \"traffic_condition\": \"light\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(232, 45, 2, 33.69209231, 73.05609231, '38, Johar Town, Islamabad', 32.00, 138.00, 'pickup', '2025-09-17 07:05:02', '{\"eta_minutes\": 7, \"traffic_condition\": \"moderate\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(233, 45, 2, 33.69286154, 73.05596154, '59, Cantt Area, Lahore', 31.00, 52.00, 'pickup', '2025-09-17 07:24:02', '{\"eta_minutes\": 11, \"traffic_condition\": \"heavy\", \"distance_remaining\": 7}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(234, 45, 2, 33.69403077, 73.05703077, '64, Garden Town, Islamabad', 46.00, 351.00, 'pickup', '2025-09-17 07:48:02', '{\"eta_minutes\": 29, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(235, 45, 2, 33.69400000, 73.05760000, '1, Main Boulevard, Islamabad', 27.00, 360.00, 'pickup', '2025-09-17 08:00:02', '{\"eta_minutes\": 5, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(236, 47, 2, 33.56550000, 73.01690000, '10, Model Town, Faisalabad', 27.00, 129.00, 'pickup', '2025-09-17 07:11:02', '{\"eta_minutes\": 23, \"traffic_condition\": \"light\", \"distance_remaining\": 10}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(237, 47, 2, 33.55792727, 73.01488182, '24, Defence Phase, Karachi', 20.00, 233.00, 'pickup', '2025-09-17 07:40:02', '{\"eta_minutes\": 10, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(238, 47, 2, 33.55005455, 73.01366364, '176, Gulberg Road, Rawalpindi', 46.00, 289.00, 'pickup', '2025-09-17 08:28:02', '{\"eta_minutes\": 20, \"traffic_condition\": \"heavy\", \"distance_remaining\": 9}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(239, 47, 2, 33.54318182, 73.01114545, '7, Faisal Town, Islamabad', 39.00, 321.00, 'pickup', '2025-09-17 06:59:02', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(240, 47, 2, 33.53560909, 73.00952727, '90, Main Boulevard, Lahore', 26.00, 325.00, 'pickup', '2025-09-17 08:26:02', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(241, 47, 2, 33.52823636, 73.00790909, '75, Garden Town, Rawalpindi', 32.00, 340.00, 'pickup', '2025-09-17 06:41:02', '{\"eta_minutes\": 7, \"traffic_condition\": \"moderate\", \"distance_remaining\": 8}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(242, 47, 2, 33.52096364, 73.00649091, '81, Johar Town, Islamabad', 31.00, 356.00, 'pickup', '2025-09-17 08:36:02', '{\"eta_minutes\": 20, \"traffic_condition\": \"light\", \"distance_remaining\": 3}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(243, 47, 2, 33.51429091, 73.00467273, '167, Garden Town, Rawalpindi', 46.00, 54.00, 'pickup', '2025-09-17 08:16:02', '{\"eta_minutes\": 22, \"traffic_condition\": \"light\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(244, 47, 2, 33.50681818, 73.00235455, '101, Faisal Town, Islamabad', 15.00, 333.00, 'pickup', '2025-09-17 06:57:02', '{\"eta_minutes\": 7, \"traffic_condition\": \"moderate\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(245, 47, 2, 33.49964545, 73.00043636, '196, Main Boulevard, Faisalabad', 38.00, 303.00, 'pickup', '2025-09-17 06:36:02', '{\"eta_minutes\": 26, \"traffic_condition\": \"light\", \"distance_remaining\": 8}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(246, 47, 2, 33.49217273, 72.99911818, '180, Cantt Area, Islamabad', 23.00, 190.00, 'pickup', '2025-09-17 08:01:02', '{\"eta_minutes\": 7, \"traffic_condition\": \"moderate\", \"distance_remaining\": 4}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(247, 47, 2, 33.48560000, 72.99680000, '114, Model Town, Faisalabad', 42.00, 352.00, 'pickup', '2025-09-17 07:43:02', '{\"eta_minutes\": 23, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(248, 49, 2, 31.52040000, 74.35830000, '156, Defence Phase, Islamabad', 39.00, 348.00, 'arrived', '2025-09-17 07:23:02', '{\"eta_minutes\": 9, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(249, 49, 2, 31.51155000, 74.36525000, '193, Gulberg Road, Karachi', 25.00, 119.00, 'arrived', '2025-09-17 06:57:02', '{\"eta_minutes\": 18, \"traffic_condition\": \"light\", \"distance_remaining\": 6}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(250, 49, 2, 31.50290000, 74.37160000, '104, Faisal Town, Karachi', 16.00, 251.00, 'arrived', '2025-09-17 07:54:02', '{\"eta_minutes\": 18, \"traffic_condition\": \"moderate\", \"distance_remaining\": 2}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(251, 49, 2, 31.49435000, 74.37775000, '31, Garden Town, Karachi', 19.00, 184.00, 'arrived', '2025-09-17 07:39:02', '{\"eta_minutes\": 27, \"traffic_condition\": \"moderate\", \"distance_remaining\": 4}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(252, 49, 2, 31.48490000, 74.38420000, '151, Model Town, Karachi', 34.00, 280.00, 'arrived', '2025-09-17 08:10:02', '{\"eta_minutes\": 13, \"traffic_condition\": \"moderate\", \"distance_remaining\": 5}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(253, 49, 2, 31.47625000, 74.39025000, '150, Model Town, Karachi', 17.00, 110.00, 'arrived', '2025-09-17 07:41:02', '{\"eta_minutes\": 20, \"traffic_condition\": \"heavy\", \"distance_remaining\": 8}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(254, 49, 2, 31.46840000, 74.39580000, '200, Main Boulevard, Karachi', 33.00, 118.00, 'arrived', '2025-09-17 07:34:02', '{\"eta_minutes\": 5, \"traffic_condition\": \"heavy\", \"distance_remaining\": 10}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(255, 49, 2, 31.45905000, 74.40225000, '143, Gulberg Road, Lahore', 15.00, 51.00, 'arrived', '2025-09-17 08:34:02', '{\"eta_minutes\": 9, \"traffic_condition\": \"heavy\", \"distance_remaining\": 3}', '2025-09-17 08:36:02', '2025-09-17 08:36:02'),
(256, 49, 2, 31.45010000, 74.40920000, '154, Cantt Area, Rawalpindi', 37.00, 297.00, 'arrived', '2025-09-17 08:25:02', '{\"eta_minutes\": 23, \"traffic_condition\": \"heavy\", \"distance_remaining\": 1}', '2025-09-17 08:36:02', '2025-09-17 08:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'Full access to all features and settings', '2025-09-17 05:09:05', '2025-09-17 05:09:05'),
(2, 'driver', 'Driver', 'Can manage rides and view assigned passengers', '2025-09-17 05:09:05', '2025-09-17 05:09:05'),
(3, 'passenger', 'Passenger', 'Can book rides and manage their profile', '2025-09-17 05:09:05', '2025-09-17 05:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `security_events`
--

CREATE TABLE `security_events` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `severity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `event_data` json DEFAULT NULL,
  `status` enum('new','investigating','resolved','false_positive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `resolution_notes` text COLLATE utf8mb4_unicode_ci,
  `resolved_by` bigint UNSIGNED DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `security_events`
--

INSERT INTO `security_events` (`id`, `user_id`, `event_type`, `severity`, `description`, `ip_address`, `user_agent`, `event_data`, `status`, `resolution_notes`, `resolved_by`, `resolved_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'unauthorized_access', 'low', 'Unauthorized access attempt detected for user Test Driver', '116.246.139.253', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 7, \"location\": \"Pakistan\"}', 'new', NULL, NULL, NULL, '2025-09-08 19:48:20', '2025-09-17 07:48:20'),
(2, 2, 'suspicious_login', 'high', 'Suspicious login attempt detected for user Test Driver', '224.194.253.150', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 5, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-09-10 08:48:20', '2025-09-17 07:48:20'),
(3, 1, 'unauthorized_access', 'medium', 'Unauthorized access attempt detected for user Admin User', '236.45.237.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 3, \"location\": \"Pakistan\"}', 'new', NULL, NULL, NULL, '2025-09-12 01:48:20', '2025-09-17 07:48:20'),
(4, 2, 'suspicious_login', 'low', 'Suspicious login attempt detected for user Test Driver', '248.112.109.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 9, \"location\": \"Pakistan\"}', 'new', NULL, NULL, NULL, '2025-09-05 00:48:20', '2025-09-17 07:48:20'),
(5, 2, 'unauthorized_access', 'low', 'Unauthorized access attempt detected for user Test Driver', '82.56.170.217', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 9, \"location\": \"Pakistan\"}', 'resolved', 'Issue resolved by security team', 1, '2025-09-12 07:48:20', '2025-09-15 01:48:20', '2025-09-17 07:48:20'),
(6, 3, 'suspicious_login', 'high', 'Suspicious login attempt detected for user Test Passenger', '97.167.48.113', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 9, \"location\": \"Pakistan\"}', 'new', NULL, NULL, NULL, '2025-08-26 13:48:20', '2025-09-17 07:48:20'),
(7, 1, 'unauthorized_access', 'critical', 'Unauthorized access attempt detected for user Admin User', '30.18.56.143', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 2, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-09-14 17:48:20', '2025-09-17 07:48:20'),
(8, 1, 'multiple_failed_attempts', 'medium', 'Multiple failed login attempts detected for user Admin User', '74.124.177.133', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 2, \"location\": \"Pakistan\"}', 'investigating', NULL, NULL, NULL, '2025-09-08 04:48:20', '2025-09-17 07:48:20'),
(9, 3, 'suspicious_login', 'high', 'Suspicious login attempt detected for user Test Passenger', '60.73.126.192', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 6, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-09-12 01:48:20', '2025-09-17 07:48:20'),
(10, 2, 'suspicious_login', 'medium', 'Suspicious login attempt detected for user Test Driver', '152.43.123.97', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 7, \"location\": \"Pakistan\"}', 'resolved', 'Issue resolved by security team', 1, '2025-09-07 07:48:20', '2025-09-01 13:48:20', '2025-09-17 07:48:20'),
(11, 1, 'multiple_failed_attempts', 'medium', 'Multiple failed login attempts detected for user Admin User', '68.163.65.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 8, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-09-03 18:48:20', '2025-09-17 07:48:20'),
(12, 2, 'suspicious_activity', 'critical', 'Suspicious activity detected for user Test Driver', '91.53.198.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 8, \"location\": \"Pakistan\"}', 'resolved', 'Issue resolved by security team', 1, '2025-09-16 07:48:20', '2025-09-06 07:48:20', '2025-09-17 07:48:20'),
(13, 1, 'suspicious_login', 'low', 'Suspicious login attempt detected for user Admin User', '245.254.235.84', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 4, \"location\": \"Pakistan\"}', 'investigating', NULL, NULL, NULL, '2025-09-02 09:48:20', '2025-09-17 07:48:20'),
(14, 1, 'suspicious_login', 'low', 'Suspicious login attempt detected for user Admin User', '145.124.100.109', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 2, \"location\": \"Pakistan\"}', 'investigating', NULL, NULL, NULL, '2025-09-10 01:48:20', '2025-09-17 07:48:20'),
(15, 1, 'multiple_failed_attempts', 'medium', 'Multiple failed login attempts detected for user Admin User', '54.68.16.234', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 5, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-08-30 08:48:20', '2025-09-17 07:48:20'),
(16, 2, 'suspicious_activity', 'critical', 'Suspicious activity detected for user Test Driver', '200.49.230.230', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 10, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-09-10 05:48:20', '2025-09-17 07:48:20'),
(17, 1, 'unauthorized_access', 'high', 'Unauthorized access attempt detected for user Admin User', '216.109.208.218', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 5, \"location\": \"Pakistan\"}', 'new', NULL, NULL, NULL, '2025-08-30 01:48:20', '2025-09-17 07:48:20'),
(18, 1, 'unauthorized_access', 'medium', 'Unauthorized access attempt detected for user Admin User', '104.194.174.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 4, \"location\": \"Pakistan\"}', 'investigating', NULL, NULL, NULL, '2025-09-06 11:48:20', '2025-09-17 07:48:20'),
(19, 3, 'suspicious_login', 'medium', 'Suspicious login attempt detected for user Test Passenger', '251.207.74.243', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 1, \"location\": \"Pakistan\"}', 'resolved', 'Issue resolved by security team', 1, '2025-09-14 07:48:20', '2025-08-29 22:48:20', '2025-09-17 07:48:20'),
(20, 1, 'unauthorized_access', 'high', 'Unauthorized access attempt detected for user Admin User', '64.161.223.157', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 4, \"location\": \"Pakistan\"}', 'resolved', 'Issue resolved by security team', 1, '2025-09-17 07:48:20', '2025-08-22 06:48:20', '2025-09-17 07:48:20'),
(21, 2, 'suspicious_login', 'low', 'Suspicious login attempt detected for user Test Driver', '207.130.202.39', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', '{\"attempts\": 3, \"location\": \"Pakistan\"}', 'resolved', 'Issue resolved by security team', 1, '2025-09-13 07:48:20', '2025-08-27 02:48:20', '2025-09-17 07:48:20'),
(22, 2, 'suspicious_login', 'low', 'Suspicious login attempt detected for user Test Driver', '14.108.213.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 3, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-09-08 19:48:20', '2025-09-17 07:48:20'),
(23, 1, 'unauthorized_access', 'low', 'Unauthorized access attempt detected for user Admin User', '124.206.208.253', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 3, \"location\": \"Pakistan\"}', 'false_positive', NULL, NULL, NULL, '2025-08-24 03:48:20', '2025-09-17 07:48:20'),
(24, 2, 'multiple_failed_attempts', 'high', 'Multiple failed login attempts detected for user Test Driver', '131.117.137.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0', '{\"attempts\": 4, \"location\": \"Pakistan\"}', 'investigating', NULL, NULL, NULL, '2025-09-13 04:48:20', '2025-09-17 07:48:20'),
(25, 2, 'suspicious_login', 'low', 'Suspicious login attempt detected for user Test Driver', '137.57.248.219', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36', '{\"attempts\": 10, \"location\": \"Pakistan\"}', 'investigating', NULL, NULL, NULL, '2025-08-17 16:48:21', '2025-09-17 07:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bElKVlJiiKlyxYmUu52m7KjbbUY7IEdZI0GbutT0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlRSQlFzcTM1VTl2dU1rRnBNZFVFaTlXeHRrRUkzRjVXMk1RbTZ6SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758177862),
('hw0FHOLe6j58J4yl8mgaWO3ix74XPWBVqj5xUl2q', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiclJybExTTVZxUk1YZkFZWmxUZ0JCV3BWdHZ4TEt3b0tGdjNDWHRmWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1758117654);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `assigned_to` bigint UNSIGNED DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('technical','billing','account','ride_issue','driver_issue','general','complaint','suggestion') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `priority` enum('low','medium','high','urgent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `status` enum('open','in_progress','pending_customer','resolved','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `source` enum('web','mobile_app','email','phone','chat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `attachments` json DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `ticket_number`, `user_id`, `assigned_to`, `subject`, `description`, `category`, `priority`, `status`, `source`, `attachments`, `metadata`, `resolved_at`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, 'TK202549595', 3, 1, 'App keeps crashing on Android', 'The app crashes every time I try to book a ride. It happens right after I select my destination. I\'ve tried restarting the app and my phone but the issue persists.', 'technical', 'high', 'open', 'mobile_app', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-20 10:03:25', '2025-09-17 10:03:25'),
(2, 'TK202589603', 3, 1, 'App keeps crashing on Android', 'The app crashes every time I try to book a ride. It happens right after I select my destination. I\'ve tried restarting the app and my phone but the issue persists.', 'technical', 'high', 'open', 'mobile_app', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-23 10:05:26', '2025-09-17 10:05:26'),
(3, 'TK202534688', 3, 1, 'Payment not processed for ride', 'I was charged for a ride but the payment didn\'t go through. The driver said the payment failed but I can see the charge on my bank statement.', 'billing', 'urgent', 'in_progress', 'web', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-08 10:05:26', '2025-09-17 10:05:26'),
(4, 'TK202571449', 3, 1, 'Cannot update profile information', 'I\'m trying to update my phone number in my profile but the changes are not saving. The form shows success but when I refresh, the old number is still there.', 'account', 'medium', 'pending_customer', 'web', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-22 10:05:26', '2025-09-17 10:05:26'),
(5, 'TK202580945', 2, 1, 'Driver took wrong route', 'The driver took a much longer route than necessary, which increased the fare significantly. I asked him to take the shorter route but he refused.', 'ride_issue', 'medium', 'resolved', 'mobile_app', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', '2025-09-13 10:05:26', NULL, '2025-09-08 10:05:26', '2025-09-17 10:05:26'),
(6, 'TK202513122', 2, 1, 'Driver was rude and unprofessional', 'The driver was very rude during the ride. He was talking on the phone loudly and made inappropriate comments. This is not acceptable behavior.', 'driver_issue', 'high', 'in_progress', 'mobile_app', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-10 10:05:26', '2025-09-17 10:05:26'),
(7, 'TK202528899', 3, 1, 'How to cancel a ride?', 'I need to know how to cancel a ride that I\'ve already booked. I can\'t find the cancel option in the app.', 'general', 'low', 'closed', 'chat', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, '2025-09-16 10:05:26', '2025-08-25 10:05:26', '2025-09-17 10:05:26'),
(8, 'TK202597650', 3, 1, 'Poor customer service experience', 'I had a terrible experience with your customer service. The representative was not helpful and didn\'t resolve my issue. Very disappointed.', 'complaint', 'high', 'open', 'email', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-04 10:05:26', '2025-09-17 10:05:26'),
(9, 'TK202560447', 3, 1, 'Add option to tip driver in cash', 'It would be great if you could add an option to tip the driver in cash instead of only through the app. Sometimes I prefer to give cash tips.', 'suggestion', 'low', 'open', 'web', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-20 10:05:26', '2025-09-17 10:05:26'),
(10, 'TK202561288', 3, 1, 'App not working on iOS 17', 'The app is not working properly on iOS 17. It keeps freezing and the map doesn\'t load correctly. Please fix this compatibility issue.', 'technical', 'urgent', 'in_progress', 'mobile_app', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-01 10:05:26', '2025-09-17 10:05:26'),
(11, 'TK202580376', 2, 1, 'Refund request for cancelled ride', 'I need a refund for a ride that was cancelled by the driver. The driver cancelled after I had already paid and waited for 15 minutes.', 'billing', 'high', 'pending_customer', 'phone', NULL, '{\"os_version\": \"Android 13 / iOS 17\", \"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-03 10:05:26', '2025-09-17 10:05:26'),
(12, 'TK202579655', 3, 1, 'Sample Support Ticket 1', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'general', 'high', 'closed', 'mobile_app', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-07-22 10:05:26', '2025-09-17 10:05:26'),
(13, 'TK202561975', 2, NULL, 'Sample Support Ticket 2', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'ride_issue', 'high', 'pending_customer', 'phone', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-31 10:05:26', '2025-09-17 10:05:26'),
(14, 'TK202534084', 2, NULL, 'Sample Support Ticket 3', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'driver_issue', 'high', 'resolved', 'web', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-14 10:05:26', '2025-09-17 10:05:26'),
(15, 'TK202572816', 2, 1, 'Sample Support Ticket 4', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'complaint', 'low', 'open', 'chat', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-07-29 10:05:26', '2025-09-17 10:05:26'),
(16, 'TK202535962', 2, 1, 'Sample Support Ticket 5', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'general', 'low', 'open', 'mobile_app', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-22 10:05:26', '2025-09-17 10:05:26'),
(17, 'TK202595590', 3, 1, 'Sample Support Ticket 6', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'technical', 'medium', 'open', 'chat', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-11 10:05:26', '2025-09-17 10:05:26'),
(18, 'TK202599518', 2, NULL, 'Sample Support Ticket 7', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'general', 'urgent', 'open', 'web', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-30 10:05:26', '2025-09-17 10:05:26'),
(19, 'TK202547286', 2, NULL, 'Sample Support Ticket 8', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'technical', 'high', 'in_progress', 'chat', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-07-19 10:05:26', '2025-09-17 10:05:26'),
(20, 'TK202529969', 3, NULL, 'Sample Support Ticket 9', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'billing', 'low', 'resolved', 'email', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-04 10:05:26', '2025-09-17 10:05:26'),
(21, 'TK202582808', 3, 1, 'Sample Support Ticket 10', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'account', 'high', 'open', 'chat', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-28 10:05:26', '2025-09-17 10:05:26'),
(22, 'TK202536394', 2, 1, 'Sample Support Ticket 11', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'complaint', 'medium', 'open', 'chat', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-23 10:05:26', '2025-09-17 10:05:26'),
(23, 'TK202540343', 2, 1, 'Sample Support Ticket 12', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'complaint', 'medium', 'pending_customer', 'web', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-15 10:05:26', '2025-09-17 10:05:26'),
(24, 'TK202544106', 2, 1, 'Sample Support Ticket 13', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'ride_issue', 'low', 'closed', 'mobile_app', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-10 10:05:26', '2025-09-17 10:05:26'),
(25, 'TK202594680', 2, 1, 'Sample Support Ticket 14', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'technical', 'medium', 'in_progress', 'email', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-09-09 10:05:26', '2025-09-17 10:05:26'),
(26, 'TK202525908', 2, NULL, 'Sample Support Ticket 15', 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.', 'technical', 'low', 'in_progress', 'web', NULL, '{\"app_version\": \"1.2.3\", \"device_info\": \"Sample device information\"}', NULL, NULL, '2025-08-01 10:05:26', '2025-09-17 10:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3B82F6',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `auto_assignment_rules` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `slug`, `description`, `color`, `icon`, `sort_order`, `is_active`, `auto_assignment_rules`, `created_at`, `updated_at`) VALUES
(1, 'Technical Support', 'technical', 'Technical issues and app problems', '#3B82F6', 'fas fa-cog', 1, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(2, 'Billing & Payments', 'billing', 'Payment and billing related issues', '#10B981', 'fas fa-credit-card', 2, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(3, 'Account Issues', 'account', 'Account management and profile issues', '#8B5CF6', 'fas fa-user', 3, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(4, 'Ride Issues', 'ride_issue', 'Problems with rides and bookings', '#F59E0B', 'fas fa-car', 4, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(5, 'Driver Issues', 'driver_issue', 'Driver-related problems and concerns', '#EF4444', 'fas fa-id-card', 5, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(6, 'General Inquiry', 'general', 'General questions and information', '#6B7280', 'fas fa-question-circle', 6, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(7, 'Complaints', 'complaint', 'Service complaints and feedback', '#DC2626', 'fas fa-exclamation-triangle', 7, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25'),
(8, 'Suggestions', 'suggestion', 'Feature suggestions and improvements', '#059669', 'fas fa-lightbulb', 8, 1, NULL, '2025-09-17 10:03:25', '2025-09-17 10:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('reply','note','status_change','assignment') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'reply',
  `attachments` json DEFAULT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT '0',
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_replies`
--

INSERT INTO `ticket_replies` (`id`, `ticket_id`, `user_id`, `message`, `type`, `attachments`, `is_internal`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Thank you for contacting us. We have received your request and are looking into this matter. We will get back to you with an update soon.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(2, 5, 1, 'Thank you for contacting us. We have received your request and are looking into this matter. We will get back to you with an update soon.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(3, 5, 1, 'Your issue has been resolved. We have processed your refund and it should reflect in your account within 2-3 business days. Thank you for your patience.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(4, 6, 1, 'Thank you for contacting us. We have received your request and are looking into this matter. We will get back to you with an update soon.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(5, 7, 1, 'Thank you for contacting us. We have received your request and are looking into this matter. We will get back to you with an update soon.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(6, 7, 1, 'Your issue has been resolved. We have processed your refund and it should reflect in your account within 2-3 business days. Thank you for your patience.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(7, 10, 1, 'Thank you for contacting us. We have received your request and are looking into this matter. We will get back to you with an update soon.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(8, 10, 1, 'Internal note: Customer has been contacted via phone. Issue escalated to technical team.', 'note', NULL, 1, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(9, 11, 1, 'Internal note: Customer has been contacted via phone. Issue escalated to technical team.', 'note', NULL, 1, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(10, 15, 2, 'This is a sample reply to the support ticket.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(11, 22, 1, 'This is a sample reply to the support ticket.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26'),
(12, 25, 1, 'This is a sample reply to the support ticket.', 'reply', NULL, 0, NULL, '2025-09-17 10:05:26', '2025-09-17 10:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ride_id` bigint UNSIGNED DEFAULT NULL,
  `wallet_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('ride_payment','wallet_topup','wallet_withdrawal','driver_earning','refund','commission','bonus','penalty') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ride_payment',
  `status` enum('pending','completed','failed','cancelled','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `net_amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PKR',
  `payment_method` enum('cash','card','wallet','bank_transfer','jazzcash','easypaisa','sadapay') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `payment_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `failed_at` timestamp NULL DEFAULT NULL,
  `processed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `user_id`, `ride_id`, `wallet_id`, `type`, `status`, `amount`, `fee`, `net_amount`, `currency`, `payment_method`, `payment_reference`, `gateway_transaction_id`, `description`, `notes`, `metadata`, `processed_at`, `failed_at`, `processed_by`, `created_at`, `updated_at`) VALUES
(1, 'TXN-00000001', 3, 10, 3, 'ride_payment', 'completed', 312.00, 15.60, 296.40, 'PKR', 'cash', 'REF-919231', NULL, 'Payment for ride RIDE-000010', NULL, NULL, '2025-08-19 07:25:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(2, 'TXN-00000002', 2, 10, 2, 'driver_earning', 'completed', 249.60, 0.00, 249.60, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000010', NULL, NULL, '2025-08-19 07:25:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(3, 'TXN-00000003', 1, 10, NULL, 'commission', 'completed', 62.40, 0.00, 62.40, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000010', NULL, NULL, '2025-08-19 07:25:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(4, 'TXN-00000004', 3, 17, 3, 'ride_payment', 'completed', 333.00, 16.65, 316.35, 'PKR', 'card', 'REF-814005', NULL, 'Payment for ride RIDE-000017', NULL, NULL, '2025-08-20 16:05:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(5, 'TXN-00000005', 2, 17, 2, 'driver_earning', 'completed', 266.40, 0.00, 266.40, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000017', NULL, NULL, '2025-08-20 16:05:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(6, 'TXN-00000006', 1, 17, NULL, 'commission', 'completed', 66.60, 0.00, 66.60, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000017', NULL, NULL, '2025-08-20 16:05:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(7, 'TXN-00000007', 3, 19, 3, 'ride_payment', 'completed', 629.00, 31.45, 597.55, 'PKR', 'jazzcash', 'REF-471217', NULL, 'Payment for ride RIDE-000019', NULL, NULL, '2025-08-24 00:13:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(8, 'TXN-00000008', 2, 19, 2, 'driver_earning', 'completed', 503.20, 0.00, 503.20, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000019', NULL, NULL, '2025-08-24 00:13:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(9, 'TXN-00000009', 1, 19, NULL, 'commission', 'completed', 125.80, 0.00, 125.80, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000019', NULL, NULL, '2025-08-24 00:13:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(10, 'TXN-00000010', 3, 26, 3, 'ride_payment', 'completed', 676.00, 33.80, 642.20, 'PKR', 'sadapay', 'REF-338901', NULL, 'Payment for ride RIDE-000026', NULL, NULL, '2025-09-05 15:59:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(11, 'TXN-00000011', 2, 26, 2, 'driver_earning', 'completed', 540.80, 0.00, 540.80, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000026', NULL, NULL, '2025-09-05 15:59:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(12, 'TXN-00000012', 1, 26, NULL, 'commission', 'completed', 135.20, 0.00, 135.20, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000026', NULL, NULL, '2025-09-05 15:59:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(13, 'TXN-00000013', 3, 28, 3, 'ride_payment', 'completed', 713.00, 35.65, 677.35, 'PKR', 'cash', 'REF-488133', NULL, 'Payment for ride RIDE-000028', NULL, NULL, '2025-08-18 13:31:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(14, 'TXN-00000014', 2, 28, 2, 'driver_earning', 'completed', 570.40, 0.00, 570.40, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000028', NULL, NULL, '2025-08-18 13:31:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(15, 'TXN-00000015', 1, 28, NULL, 'commission', 'completed', 142.60, 0.00, 142.60, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000028', NULL, NULL, '2025-08-18 13:31:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(16, 'TXN-00000016', 3, 29, 3, 'ride_payment', 'completed', 546.00, 27.30, 518.70, 'PKR', 'wallet', 'REF-890383', NULL, 'Payment for ride RIDE-000029', NULL, NULL, '2025-09-09 01:45:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(17, 'TXN-00000017', 2, 29, 2, 'driver_earning', 'completed', 436.80, 0.00, 436.80, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000029', NULL, NULL, '2025-09-09 01:45:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(18, 'TXN-00000018', 1, 29, NULL, 'commission', 'completed', 109.20, 0.00, 109.20, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000029', NULL, NULL, '2025-09-09 01:45:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(19, 'TXN-00000019', 3, 30, 3, 'ride_payment', 'completed', 656.00, 32.80, 623.20, 'PKR', 'card', 'REF-849546', NULL, 'Payment for ride RIDE-000030', NULL, NULL, '2025-08-18 20:56:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(20, 'TXN-00000020', 2, 30, 2, 'driver_earning', 'completed', 524.80, 0.00, 524.80, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000030', NULL, NULL, '2025-08-18 20:56:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(21, 'TXN-00000021', 1, 30, NULL, 'commission', 'completed', 131.20, 0.00, 131.20, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000030', NULL, NULL, '2025-08-18 20:56:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(22, 'TXN-00000022', 3, 36, 3, 'ride_payment', 'completed', 393.00, 19.65, 373.35, 'PKR', 'wallet', 'REF-353140', NULL, 'Payment for ride RIDE-000036', NULL, NULL, '2025-08-25 07:53:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(23, 'TXN-00000023', 2, 36, 2, 'driver_earning', 'completed', 314.40, 0.00, 314.40, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000036', NULL, NULL, '2025-08-25 07:53:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(24, 'TXN-00000024', 1, 36, NULL, 'commission', 'completed', 78.60, 0.00, 78.60, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000036', NULL, NULL, '2025-08-25 07:53:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(25, 'TXN-00000025', 3, 41, 3, 'ride_payment', 'completed', 521.00, 26.05, 494.95, 'PKR', 'wallet', 'REF-976715', NULL, 'Payment for ride RIDE-000041', NULL, NULL, '2025-09-16 19:34:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(26, 'TXN-00000026', 2, 41, 2, 'driver_earning', 'completed', 416.80, 0.00, 416.80, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000041', NULL, NULL, '2025-09-16 19:34:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(27, 'TXN-00000027', 1, 41, NULL, 'commission', 'completed', 104.20, 0.00, 104.20, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000041', NULL, NULL, '2025-09-16 19:34:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(28, 'TXN-00000028', 3, 50, 3, 'ride_payment', 'completed', 603.00, 30.15, 572.85, 'PKR', 'card', 'REF-326327', NULL, 'Payment for ride RIDE-000050', NULL, NULL, '2025-08-25 08:48:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(29, 'TXN-00000029', 2, 50, 2, 'driver_earning', 'completed', 482.40, 0.00, 482.40, 'PKR', 'wallet', NULL, NULL, 'Earning from ride RIDE-000050', NULL, NULL, '2025-08-25 08:48:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(30, 'TXN-00000030', 1, 50, NULL, 'commission', 'completed', 120.60, 0.00, 120.60, 'PKR', 'wallet', NULL, NULL, 'Platform commission from ride RIDE-000050', NULL, NULL, '2025-08-25 08:48:29', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(31, 'TXN-00000031', 3, NULL, 3, 'wallet_topup', 'completed', 1653.00, 33.06, 1619.94, 'PKR', 'cash', 'TOPUP-605778', 'GW-174037784', 'Wallet top-up', NULL, NULL, '2025-08-30 11:17:49', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(32, 'TXN-00000032', 3, NULL, 3, 'wallet_topup', 'failed', 1766.00, 35.32, 1730.68, 'PKR', 'cash', 'TOPUP-395490', 'GW-341081640', 'Wallet top-up', NULL, NULL, '2025-08-19 01:17:49', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(33, 'TXN-00000033', 3, NULL, 3, 'wallet_topup', 'failed', 1211.00, 24.22, 1186.78, 'PKR', 'sadapay', 'TOPUP-961549', 'GW-481674085', 'Wallet top-up', NULL, NULL, '2025-08-31 00:17:49', NULL, NULL, '2025-09-17 07:17:49', '2025-09-17 07:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `cnic`, `address`, `country`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@raah-e-haq.com', NULL, NULL, NULL, NULL, 'active', '2025-09-17 05:09:05', '$2y$12$1tt/05plLF4rSnOuH1Y8juOmH8ccMOBinofXM3yw429uFUtOyr1m.', 'E6nrJkUkXY', '2025-09-17 05:09:05', '2025-09-17 05:09:05'),
(2, 'Test Driver', 'driver@raah-e-haq.com', NULL, NULL, NULL, NULL, 'active', '2025-09-17 05:09:05', '$2y$12$1tt/05plLF4rSnOuH1Y8juOmH8ccMOBinofXM3yw429uFUtOyr1m.', 'QMpZ1INzFg', '2025-09-17 05:09:05', '2025-09-17 05:09:05'),
(3, 'Test Passenger', 'passenger@raah-e-haq.com', NULL, NULL, NULL, NULL, 'active', '2025-09-17 05:09:05', '$2y$12$1tt/05plLF4rSnOuH1Y8juOmH8ccMOBinofXM3yw429uFUtOyr1m.', '18zxsORB2h', '2025-09-17 05:09:05', '2025-09-17 05:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` bigint UNSIGNED NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_images` text COLLATE utf8mb4_unicode_ci,
  `insurance_document` text COLLATE utf8mb4_unicode_ci,
  `registration_document` text COLLATE utf8mb4_unicode_ci,
  `verification_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `driver_id`, `vehicle_type`, `make`, `model`, `year`, `color`, `license_plate`, `registration_number`, `vehicle_images`, `insurance_document`, `registration_document`, `verification_status`, `rejection_reason`, `verified_at`, `verified_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'bike', 'Daihatsu', 'Alto', '2017', 'Red', 'LHR-6895', 'REG-996623', '\"[\\\"vehicle1.jpg\\\",\\\"vehicle2.jpg\\\"]\"', 'insurance.pdf', 'registration.pdf', 'pending', NULL, NULL, NULL, '2025-09-17 07:05:02', '2025-09-17 07:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pending_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_earnings` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_spent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','suspended','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PKR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `pending_balance`, `total_earnings`, `total_spent`, `status`, `currency`, `created_at`, `updated_at`) VALUES
(1, 1, 3048.00, 315.00, 9345.00, 2294.00, 'active', 'PKR', '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(2, 2, 1332.00, 329.00, 4135.00, 4150.00, 'active', 'PKR', '2025-09-17 07:17:49', '2025-09-17 07:17:49'),
(3, 3, 1238.00, 96.00, 7853.00, 1507.00, 'active', 'PKR', '2025-09-17 07:17:49', '2025-09-17 07:17:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics_events`
--
ALTER TABLE `analytics_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analytics_events_event_type_created_at_index` (`event_type`,`created_at`),
  ADD KEY `analytics_events_event_category_created_at_index` (`event_category`,`created_at`),
  ADD KEY `analytics_events_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `analytics_events_session_id_created_at_index` (`session_id`,`created_at`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `app_settings_key_unique` (`key`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `audit_logs_action_created_at_index` (`action`,`created_at`),
  ADD KEY `audit_logs_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_created_by_foreign` (`created_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `daily_analytics`
--
ALTER TABLE `daily_analytics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `daily_analytics_date_unique` (`date`),
  ADD KEY `daily_analytics_date_index` (`date`);

--
-- Indexes for table `driver_documents`
--
ALTER TABLE `driver_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_documents_driver_id_foreign` (`driver_id`),
  ADD KEY `driver_documents_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_locations_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `driver_locations_driver_id_last_seen_at_index` (`driver_id`,`last_seen_at`),
  ADD KEY `driver_locations_status_last_seen_at_index` (`status`,`last_seen_at`),
  ADD KEY `driver_locations_latitude_longitude_index` (`latitude`,`longitude`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_attempts_user_id_foreign` (`user_id`),
  ADD KEY `login_attempts_email_attempted_at_index` (`email`,`attempted_at`),
  ADD KEY `login_attempts_ip_address_attempted_at_index` (`ip_address`,`attempted_at`),
  ADD KEY `login_attempts_status_attempted_at_index` (`status`,`attempted_at`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_created_by_foreign` (`created_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referrals_referral_code_unique` (`referral_code`),
  ADD KEY `referrals_referrer_id_status_index` (`referrer_id`,`status`),
  ADD KEY `referrals_referred_id_status_index` (`referred_id`,`status`),
  ADD KEY `referrals_referral_code_index` (`referral_code`),
  ADD KEY `referrals_level_status_index` (`level`,`status`);

--
-- Indexes for table `referral_rewards`
--
ALTER TABLE `referral_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_rewards_user_id_status_index` (`user_id`,`status`),
  ADD KEY `referral_rewards_referral_id_status_index` (`referral_id`,`status`),
  ADD KEY `referral_rewards_reward_type_status_index` (`reward_type`,`status`),
  ADD KEY `referral_rewards_level_status_index` (`level`,`status`);

--
-- Indexes for table `referral_settings`
--
ALTER TABLE `referral_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_settings_key_unique` (`key`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rides_ride_id_unique` (`ride_id`),
  ADD KEY `rides_passenger_id_foreign` (`passenger_id`),
  ADD KEY `rides_driver_id_foreign` (`driver_id`),
  ADD KEY `rides_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `rides_cancelled_by_foreign` (`cancelled_by`);

--
-- Indexes for table `ride_tracking`
--
ALTER TABLE `ride_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_tracking_ride_id_tracked_at_index` (`ride_id`,`tracked_at`),
  ADD KEY `ride_tracking_driver_id_tracked_at_index` (`driver_id`,`tracked_at`),
  ADD KEY `ride_tracking_tracking_type_tracked_at_index` (`tracking_type`,`tracked_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `security_events`
--
ALTER TABLE `security_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `security_events_resolved_by_foreign` (`resolved_by`),
  ADD KEY `security_events_event_type_created_at_index` (`event_type`,`created_at`),
  ADD KEY `security_events_severity_status_index` (`severity`,`status`),
  ADD KEY `security_events_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `support_tickets_ticket_number_unique` (`ticket_number`),
  ADD KEY `support_tickets_user_id_status_index` (`user_id`,`status`),
  ADD KEY `support_tickets_assigned_to_status_index` (`assigned_to`,`status`),
  ADD KEY `support_tickets_category_status_index` (`category`,`status`),
  ADD KEY `support_tickets_priority_status_index` (`priority`,`status`),
  ADD KEY `support_tickets_status_created_at_index` (`status`,`created_at`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_categories_name_unique` (`name`),
  ADD UNIQUE KEY `ticket_categories_slug_unique` (`slug`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_replies_ticket_id_created_at_index` (`ticket_id`,`created_at`),
  ADD KEY `ticket_replies_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `ticket_replies_type_created_at_index` (`type`,`created_at`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_transaction_id_unique` (`transaction_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_ride_id_foreign` (`ride_id`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`),
  ADD KEY `transactions_processed_by_foreign` (`processed_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_license_plate_unique` (`license_plate`),
  ADD KEY `vehicles_driver_id_foreign` (`driver_id`),
  ADD KEY `vehicles_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_user_id_unique` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics_events`
--
ALTER TABLE `analytics_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daily_analytics`
--
ALTER TABLE `daily_analytics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `driver_documents`
--
ALTER TABLE `driver_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_locations`
--
ALTER TABLE `driver_locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `referral_rewards`
--
ALTER TABLE `referral_rewards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_settings`
--
ALTER TABLE `referral_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `ride_tracking`
--
ALTER TABLE `ride_tracking`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `security_events`
--
ALTER TABLE `security_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analytics_events`
--
ALTER TABLE `analytics_events`
  ADD CONSTRAINT `analytics_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `driver_documents`
--
ALTER TABLE `driver_documents`
  ADD CONSTRAINT `driver_documents_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_documents_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD CONSTRAINT `driver_locations_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `driver_locations_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_referred_id_foreign` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referral_rewards`
--
ALTER TABLE `referral_rewards`
  ADD CONSTRAINT `referral_rewards_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `referral_rewards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rides`
--
ALTER TABLE `rides`
  ADD CONSTRAINT `rides_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rides_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rides_passenger_id_foreign` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rides_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ride_tracking`
--
ALTER TABLE `ride_tracking`
  ADD CONSTRAINT `ride_tracking_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ride_tracking_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `security_events`
--
ALTER TABLE `security_events`
  ADD CONSTRAINT `security_events_resolved_by_foreign` FOREIGN KEY (`resolved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `security_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `support_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD CONSTRAINT `ticket_replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_ride_id_foreign` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
