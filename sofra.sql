-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 02:24 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sofra`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'meals', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(2, 'desserts', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(3, 'bakery and pastries', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(4, 'sandwiches', '2022-03-17 22:00:00', '2022-03-17 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category_restaurant`
--

CREATE TABLE `category_restaurant` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_restaurant`
--

INSERT INTO `category_restaurant` (`id`, `restaurant_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL),
(2, 1, 4, NULL, NULL),
(10, 3, 1, '2022-03-26 22:00:00', '2022-03-26 22:00:00'),
(11, 3, 2, '2022-03-26 22:00:00', '2022-03-26 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tanta', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(2, 'mansoura', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(3, 'banha', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(4, 'naser city', '2022-03-17 22:00:00', '2022-03-17 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `password`, `region_id`, `address`, `image`, `pin_code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'mohamed ibrahiem', 'mohamed@yahoo.com', '01153225410', '$2y$10$loYthfVXGSJ4zQjYAgQ7NeLHWKwTWJH5UzezdjtJ5eFICrTzVDorq', 1, 'tanta', 'uploads/clients/mohamed ibrahiem/1648035363male.png', NULL, 1, '2022-03-23 09:36:03', '2022-04-04 15:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('complaint','suggestion','inquiry') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `type`, `created_at`, `updated_at`) VALUES
(3, 'mohamed ibrahiem', 'mohamed@yahoo.com', '01153225410', 'This Is Suggestion Message', 'suggestion', '2022-03-24 22:00:00', '2022-03-24 22:00:00');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `offer_price` decimal(8,2) DEFAULT NULL,
  `preparing_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `status` enum('enabled','disabled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `offer_price`, `preparing_time`, `image`, `restaurant_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'item4', 'description for item4', '30.00', '0.00', '10', 'uploads/items/item4/1647613445admin.png', 1, 'enabled', '2022-03-18 12:24:05', '2022-03-18 12:24:05'),
(2, 'item5', 'description for item5', '50.00', '0.00', '15', 'uploads/items/item5/1647613538icons8-shopping-100.png', 1, 'enabled', '2022-03-18 12:25:38', '2022-03-18 12:25:38'),
(3, 'item6', 'description for item6', '55.00', '0.00', '20', 'uploads/items/item6/1647614021icons8-shopping-100.png', 1, 'enabled', '2022-03-18 12:33:41', '2022-03-18 12:33:41'),
(4, 'item7', 'description for item7', '35.00', '0.00', '15', 'uploads/items/item7/1647617643error.png', 1, 'enabled', '2022-03-18 13:34:03', '2022-03-18 13:34:03'),
(5, 'item00', 'description for item00', '38.00', '0.00', '10', 'uploads/items/item00/1647783031695.jpg', 1, 'enabled', '2022-03-20 11:30:31', '2022-03-20 11:30:31'),
(7, 'item', 'description', '35.00', '0.00', '15', 'uploads/items/item/1647783031695.jpg', 3, 'enabled', '2022-03-26 22:00:00', '2022-03-26 22:00:00'),
(8, 'item10', 'description', '50.00', '0.00', '10', 'uploads/items/item/1647614021icons8-shopping-100.png', 3, 'enabled', '2022-03-26 22:00:00', '2022-03-26 22:00:00'),
(9, 'item11', 'description', '40.00', '0.00', '10', 'uploads/items/item/1647613445admin.png', 3, 'enabled', '2022-03-26 22:00:00', '2022-03-26 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE `item_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_order`
--

INSERT INTO `item_order` (`id`, `item_id`, `order_id`, `price`, `quantity`, `notes`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '38.00', 2, 'no onion plz', NULL, NULL),
(2, 3, 1, '55.00', 2, 'no tomato', NULL, NULL),
(3, 5, 2, '38.00', 2, 'no onion plz', NULL, NULL),
(4, 5, 3, '38.00', 2, 'no onion plz', NULL, NULL),
(5, 5, 4, '38.00', 2, 'no onion plz', NULL, NULL),
(6, 5, 5, '38.00', 2, 'no onion plz', NULL, NULL),
(7, 2, 6, '50.00', 2, 'no onion plz', NULL, NULL),
(8, 1, 7, '30.00', 2, 'no onion plz', NULL, NULL),
(9, 4, 7, '35.00', 1, 'no tomato', NULL, NULL),
(10, 1, 8, '30.00', 2, 'no onion plz', NULL, NULL),
(11, 4, 8, '35.00', 1, 'no tomato', NULL, NULL),
(12, 1, 9, '30.00', 4, 'no onion plz', NULL, NULL),
(13, 1, 10, '30.00', 4, 'no onion plz', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_03_17_230640_create_categories_table', 1),
(5, '2022_03_17_230640_create_category_restaurant_table', 1),
(6, '2022_03_17_230640_create_cities_table', 1),
(7, '2022_03_17_230640_create_clients_table', 1),
(8, '2022_03_17_230640_create_contacts_table', 1),
(9, '2022_03_17_230640_create_item_order_table', 1),
(10, '2022_03_17_230640_create_items_table', 1),
(11, '2022_03_17_230640_create_notifications_table', 1),
(12, '2022_03_17_230640_create_offers_table', 1),
(13, '2022_03_17_230640_create_orders_table', 1),
(14, '2022_03_17_230640_create_payment_methods_table', 1),
(15, '2022_03_17_230640_create_regions_table', 1),
(16, '2022_03_17_230640_create_restaurants_table', 1),
(17, '2022_03_17_230640_create_reviews_table', 1),
(18, '2022_03_17_230640_create_settings_table', 1),
(19, '2022_03_17_230640_create_transactions_table', 1),
(20, '2022_03_17_230650_create_foreign_keys', 1),
(21, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(22, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(23, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(24, '2016_06_01_000004_create_oauth_clients_table', 2),
(25, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(27, '2022_03_28_091558_create_permission_tables', 3),
(28, '2014_10_12_000000_create_users_table', 4),
(29, '2022_05_06_231602_create_tokens_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 4),
(3, 'App\\User', 2),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notificationable_id` int(11) NOT NULL,
  `notificationable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `notificationable_id`, `notificationable_type`, `is_read`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 12:00:37', '2022-03-23 12:00:37'),
(2, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 2, '2022-03-23 12:29:32', '2022-03-23 12:29:32'),
(3, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 3, '2022-03-23 12:34:00', '2022-03-23 12:34:00'),
(4, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 4, '2022-03-23 12:37:10', '2022-03-23 12:37:10'),
(5, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 5, '2022-03-23 12:37:25', '2022-03-23 12:37:25'),
(6, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 6, '2022-03-23 12:49:22', '2022-03-23 12:49:22'),
(7, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 7, '2022-03-23 17:06:18', '2022-03-23 17:06:18'),
(8, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 8, '2022-03-23 17:07:04', '2022-03-23 17:07:04'),
(9, 'تأكيد توصيل الطلب للعميل', 'تم توصيل الطلب رقم 1 للعميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:01:37', '2022-03-23 19:01:37'),
(10, 'تأكيد توصيل الطلب للعميل', 'تم توصيل الطلب رقم 1 للعميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:05:29', '2022-03-23 19:05:29'),
(11, 'تأكيد توصيل الطلب للعميل', 'تم توصيل الطلب رقم 1 للعميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:07:09', '2022-03-23 19:07:09'),
(12, 'تأكيد توصيل الطلب للعميل', 'تم توصيل الطلب رقم 1 للعميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:12:11', '2022-03-23 19:12:11'),
(13, 'رفض الطلب من العميل', 'تم رفض استلام الطلب رقم 1 من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:15:18', '2022-03-23 19:15:18'),
(14, 'رفض الطلب من العميل', 'تم رفض استلام الطلب رقم 1 من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:20:16', '2022-03-23 19:20:16'),
(15, 'رفض الطلب من العميل', 'تم رفض استلام الطلب رقم 1 من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:21:48', '2022-03-23 19:21:48'),
(16, 'رفض الطلب من العميل', 'تم رفض استلام الطلب رقم 1 من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:22:16', '2022-03-23 19:22:16'),
(17, 'رفض الطلب من العميل', 'تم رفض استلام الطلب رقم 1 من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:23:47', '2022-03-23 19:23:47'),
(18, 'تأكيد توصيل الطلب للعميل', 'تم توصيل الطلب رقم 1 للعميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 1, '2022-03-23 19:24:13', '2022-03-23 19:24:13'),
(19, 'تأكيد توصيل الطلب للعميل', 'تم توصيل الطلب رقم 3 للعميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 3, '2022-03-23 19:25:06', '2022-03-23 19:25:06'),
(20, 'رفض الطلب من العميل', 'تم رفض استلام الطلب رقم 5 من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 5, '2022-03-23 19:25:21', '2022-03-23 19:25:21'),
(26, 'قبول الطلب', 'تم قبول الطلب رقم 7 من المطعم restaurant 1', 1, 'App\\Models\\Client', 0, 7, '2022-03-24 13:24:50', '2022-03-24 13:24:50'),
(28, 'تأكيد توصيل وانهاء الطلب', 'تم توصيل الطلب رقم 1 للعميل mohamed ibrahiem', 1, 'App\\Models\\Client', 0, 1, '2022-03-24 13:37:54', '2022-03-24 13:37:54'),
(29, 'تأكيد توصيل وانهاء الطلب', 'تم توصيل الطلب رقم 3 للعميل mohamed ibrahiem', 1, 'App\\Models\\Client', 0, 3, '2022-03-24 15:24:08', '2022-03-24 15:24:08'),
(30, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 9, '2022-05-06 21:29:21', '2022-05-06 21:29:21'),
(31, 'طلب جديد', 'لديك طلب جديد من العميل mohamed ibrahiem', 1, 'App\\Models\\Restaurant', 0, 10, '2022-05-06 22:17:38', '2022-05-06 22:17:38'),
(32, 'رفض الطلب', 'تم رفض الطلب رقم 10 من المطعم restaurant 1', 1, 'App\\Models\\Client', 0, 10, '2022-05-06 22:19:37', '2022-05-06 22:19:37'),
(33, 'قبول الطلب', 'تم قبول الطلب رقم 8 من المطعم restaurant 1', 1, 'App\\Models\\Client', 0, 8, '2022-05-06 22:20:08', '2022-05-06 22:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('164fbb2901938b938cf88ce5632b73e77b4b19dc4f9e5e74e37c0bf7d435227dfa4399117d8c5191', 1, 1, 'API Token', '[]', 0, '2022-03-23 09:37:33', '2022-03-23 09:37:33', '2023-03-23 11:37:33'),
('20d1253b7e8c7084bd9dea9d076311b3fb2bac850e46859a5ec906aa141937b336015363ac204a60', 1, 1, 'API Token', '[]', 0, '2022-03-23 10:49:48', '2022-03-23 10:49:48', '2023-03-23 12:49:48'),
('287df63d76d5b706856229565a90311f16473ca61eb1e44b65f65e9ff6e75f99f19c2f658c3ad10b', 1, 1, 'API Token', '[]', 0, '2022-03-23 09:36:03', '2022-03-23 09:36:03', '2023-03-23 11:36:03'),
('388a52af2c21c98ea6d68649ea01967170a4efd0c4cd92083b05582edbf41915e1c507baa90c26a7', 1, 1, 'API Token', '[]', 0, '2022-05-06 21:28:18', '2022-05-06 21:28:18', '2023-05-06 23:28:18'),
('41af08f5ef0939e662082f62ee88090e6f5e992550c27c516ef9a2d93a07a22b1ba55715274153ae', 1, 1, 'API Token', '[]', 0, '2022-03-23 20:36:46', '2022-03-23 20:36:46', '2023-03-23 22:36:46'),
('4a93fa0dd02be0d25e49056c255b16cdeeea9ff8a2c8c15cb47e5a93fdfb8f2b00f826d3abc27cdf', 1, 1, 'API Token', '[]', 0, '2022-03-24 17:50:22', '2022-03-24 17:50:22', '2023-03-24 19:50:22'),
('4d48a842500741f91f44342a1e8e277b48b993710c41c7d2e7bf80be5eb3b639d2ebfec7bfb91237', 1, 1, 'API Token', '[]', 0, '2022-03-23 11:52:26', '2022-03-23 11:52:26', '2023-03-23 13:52:26'),
('52ea8722fa81cc1f7311c7b258ab0ff3c485a00a99dfaafd2799e01f32a195367784c219a0a408c5', 1, 1, 'API Token', '[]', 0, '2022-03-23 09:36:27', '2022-03-23 09:36:27', '2023-03-23 11:36:27'),
('7fa510308d4e7bebad43f7809cc073a966dd5a6f7a6ac865b1b47ac45186c1ccf15c36636869d8ad', 1, 1, 'API Token', '[]', 0, '2022-03-26 16:14:57', '2022-03-26 16:14:57', '2023-03-26 18:14:57'),
('921060ee5479c5aecc2cd5f4dbc476694783c29b7ec0d20553670015e010943df860f49369c72786', 2, 1, 'API Token', '[]', 0, '2022-03-23 18:57:16', '2022-03-23 18:57:16', '2023-03-23 20:57:16'),
('cb6003c83431ef20f436bfb257446a2141452e7105644e6af982c35ddd28d0a3b637dd9a624ecde3', 1, 1, 'API Token', '[]', 0, '2022-03-23 09:38:02', '2022-03-23 09:38:02', '2023-03-23 11:38:02'),
('e1caa52c1b23183786392d32cf9739650295868e1066854ee0c59c8e67d0e3a9113c45a70bc367a8', 1, 1, 'API Token', '[]', 0, '2022-05-06 22:01:21', '2022-05-06 22:01:21', '2023-05-07 00:01:21'),
('eb1e69198681c34c9b70f79e50c36ad465675075089db2c8688226a9b7233e40a7d4e5d230db309e', 1, 1, 'API Token', '[]', 0, '2022-05-06 21:50:29', '2022-05-06 21:50:29', '2023-05-06 23:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Sofra Personal Access Client', 'ZYG6dEZGR3gdlcjrRG0G7HiN9eVdz7KiRXwe66F2', NULL, 'http://localhost', 1, 0, 0, '2022-03-23 09:34:43', '2022-03-23 09:34:43'),
(2, NULL, 'Sofra Password Grant Client', 'ozSUyA8lI7nybpMBXvfYgX1l3hRbt9SzhsaycZTF', 'users', 'http://localhost', 0, 1, 0, '2022-03-23 09:34:43', '2022-03-23 09:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-23 09:34:43', '2022-03-23 09:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `description`, `start_at`, `end_at`, `image`, `restaurant_id`, `status`, `created_at`, `updated_at`) VALUES
(2, '35% offer', '35% offer for any order', '2022-03-19 02:00:00', '2022-03-22 02:00:00', 'uploads/offers/35% offer/1648318513icons8-e-commerce-100.png', 1, 'available', '2022-03-26 16:15:13', '2022-03-26 16:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `cost` decimal(8,2) NOT NULL DEFAULT '0.00',
  `delivery_cost` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `delivery_at` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','received','refused','accepted','rejected','completed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` decimal(8,2) NOT NULL DEFAULT '0.00',
  `client_delivery_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `restaurant_delivery_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `client_id` int(10) UNSIGNED NOT NULL,
  `net` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `address`, `notes`, `cost`, `delivery_cost`, `total`, `restaurant_id`, `payment_method_id`, `delivery_at`, `status`, `commission`, `client_delivery_confirm`, `restaurant_delivery_confirm`, `client_id`, `net`, `created_at`, `updated_at`) VALUES
(1, 'tanta', 'no notes', '186.00', '15.00', '201.00', 1, 2, '45 minute', 'completed', '55.80', 1, 1, 1, '145.20', '2022-03-23 12:00:37', '2022-03-24 13:37:54'),
(2, 'tanta', 'no notes', '76.00', '15.00', '91.00', 1, 2, '45 minute', 'pending', '22.80', 0, 0, 1, '68.20', '2022-03-23 12:29:32', '2022-03-23 12:29:32'),
(3, 'tanta', 'no notes', '76.00', '15.00', '91.00', 1, 2, '45 minute', 'completed', '22.80', 1, 1, 1, '68.20', '2022-03-23 12:34:00', '2022-03-24 15:24:08'),
(4, 'tanta', 'no notes', '76.00', '15.00', '91.00', 1, 2, '45 minute', 'pending', '22.80', 0, 0, 1, '68.20', '2022-03-23 12:37:10', '2022-03-23 12:37:10'),
(5, 'tanta', 'no notes', '76.00', '15.00', '91.00', 1, 2, '45 minute', 'refused', '22.80', -1, 0, 1, '68.20', '2022-03-23 12:37:25', '2022-03-23 19:25:21'),
(6, 'tanta', 'no notes', '100.00', '15.00', '115.00', 1, 2, '45 minute', 'pending', '30.00', 0, 0, 1, '85.00', '2022-03-23 12:49:22', '2022-03-23 12:49:22'),
(7, 'tanta', 'no notes', '95.00', '15.00', '110.00', 1, 2, '45 minute', 'accepted', '28.50', 0, 0, 1, '81.50', '2022-03-23 17:06:18', '2022-03-24 13:24:50'),
(8, 'tanta', 'no notes', '95.00', '15.00', '110.00', 1, 2, '45 minute', 'accepted', '28.50', 0, 0, 1, '81.50', '2022-03-23 17:07:04', '2022-05-06 22:20:08'),
(9, 'tanta', 'no notes', '120.00', '15.00', '135.00', 1, 1, '45 minute', 'pending', '60.00', 0, 0, 1, '75.00', '2022-05-06 21:29:21', '2022-05-06 21:29:21'),
(10, 'tanta', 'no notes', '120.00', '15.00', '135.00', 1, 1, '45 minute', 'rejected', '60.00', 0, 0, 1, '75.00', '2022-05-06 22:17:38', '2022-05-06 22:19:37');

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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'vodafone cash', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(2, 'cash on delivery', '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(3, 'credit card', '2022-03-17 22:00:00', '2022-03-17 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `routes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `guard_name`, `created_at`, `updated_at`, `routes`) VALUES
(1, 'user-list', 'المستخدمين', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'users.index'),
(2, 'user-create', 'المستخدمين', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'users.create,users.store'),
(3, 'user-edit', 'المستخدمين', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'users.edit,users.update'),
(4, 'user-delete', 'المستخدمين', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'users.destroy'),
(5, 'role-list', 'الصلاحيات', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'roles.index'),
(6, 'role-create', 'الصلاحيات', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'roles.create,roles.store'),
(7, 'role-edit', 'الصلاحيات', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'roles.edit,roles.update'),
(8, 'role-delete', 'الصلاحيات', 'web', '2022-03-28 07:47:45', '2022-03-28 07:47:45', 'roles.destroy'),
(9, 'cities-list', 'المدن', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'cities.index'),
(10, 'cities-create', 'المدن', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'cities.create,cities.store'),
(11, 'cities-edit', 'المدن', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'cities.edit,cities.update'),
(12, 'cities-delete', 'المدن', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'cities.destroy'),
(13, 'regions-list', 'المناطق', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'regions.index'),
(14, 'regions-create', 'المناطق', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'regions.create,regions.store'),
(15, 'regions-edit', 'المناطق', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'regions.edit,regions.update'),
(16, 'regions-delete', 'المناطق', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'regions.destroy'),
(17, 'categories-list', 'التصنيفات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'categories.index'),
(18, 'categories-create', 'التصنيفات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'categories.create,categories.store'),
(19, 'categories-edit', 'التصنيفات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'categories.edit,categories.update'),
(20, 'categories-delete', 'التصنيفات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'categories.destroy'),
(21, 'transactions-list', 'المدفوعات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'transactions.index'),
(22, 'transactions-create', 'المدفوعات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'transactions.create,transactions.store'),
(23, 'transactions-edit', 'المدفوعات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'transactions.edit,transactions.update'),
(24, 'transactions-delete', 'المدفوعات', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'transactions.destroy'),
(25, 'transactions-filter', 'المدفوعات-فلتره', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'transactions.filter'),
(26, 'offers-list', 'العروض', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'offers.index'),
(27, 'offers-create', 'العروض', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'offers.create,offers.store'),
(28, 'offers-edit', 'العروض', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'offers.edit,offers.update'),
(29, 'offers-delete', 'العروض', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'offers.destroy'),
(30, 'offers-filter', 'العروض-فلتره', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'offers.filter'),
(31, 'offers-show', 'العروض', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'offers.show'),
(32, 'restaurants-list', 'المطاعم', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.index'),
(33, 'restaurants-create', 'المطاعم', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.create,restaurants.store'),
(34, 'restaurants-edit', 'المطاعم', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.edit,restaurants.update'),
(35, 'restaurants-delete', 'المطاعم', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.destroy'),
(36, 'restaurants-filter', 'المطاعم-فلتره', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.filter'),
(37, 'restaurants-activate', 'المطاعم-تفعيل', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurant-activate'),
(38, 'restaurants-deactivate', 'المطاعم-الغاء تفعيل', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurant-deactivate'),
(39, 'restaurants-status-filter', 'المطاعم-فلتره', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.status-filter'),
(40, 'restaurants-show', 'المطاعم', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'restaurants.show'),
(41, 'payment-methods-list', 'طرق الدفع', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'payment-methods.index'),
(42, 'payment-methods-create', 'طرق الدفع', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'payment-methods.create,payment-methods.store'),
(43, 'payment-methods-edit', 'طرق الدفع', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'payment-methods.edit,payment-methods.update'),
(44, 'payment-methods-delete', 'طرق الدفع', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'payment-methods.destroy'),
(45, 'clients-list', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'clients.index'),
(46, 'clients-create', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'clients.create,clients.store'),
(47, 'clients-edit', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'clients.edit,clients.update'),
(48, 'clients-delete', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'clients.destroy'),
(49, 'clients-filter', 'العملاء-فلتره', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'clients.filter'),
(50, 'clients-activate', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'activate'),
(51, 'clients-deactivate', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'deactivate'),
(52, 'clients-active-filter', 'العملاء', 'web', '2022-03-28 22:00:00', '2022-03-28 22:00:00', 'clients.active-filter'),
(53, 'orders-list', 'الطلبات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.index'),
(54, 'orders-create', 'الطلبات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.create,orders.store'),
(55, 'orders-edit', 'الطلبات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.edit,orders.update'),
(56, 'orders-delete', 'الطلبات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.destroy'),
(57, 'orders-filter', 'الطلبات-فلتره', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.filter'),
(58, 'orders-filter-status', 'الطلبات-فلتره', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.filter-status'),
(59, 'orders-show', 'الطلبات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.show'),
(60, 'orders-print', 'الطلبات-طباعه', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'orders.print-order'),
(61, 'contacts-list', 'الرسائل', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'contacts.index'),
(62, 'contacts-filter', 'الرسائل', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'contacts.filter'),
(63, 'contacts-show', 'الرسائل', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'contacts.show'),
(64, 'settings-list', 'الاعدادات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'settings.index'),
(65, 'settings-edit', 'الاعدادات', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'settings.update'),
(66, 'language', 'اللغه', 'web', '2022-03-30 22:00:00', '2022-03-30 22:00:00', 'lang');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'said street', 1, '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(2, 'alhelw street', 1, '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(3, 'algish street', 1, '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(4, 'universty street', 2, '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(5, 'algish street', 3, '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(6, 'makram abid street', 4, '2022-03-17 22:00:00', '2022-03-17 22:00:00'),
(7, 'almithaq street', 4, '2022-03-17 22:00:00', '2022-03-17 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `minimum_order` decimal(8,2) NOT NULL,
  `delivery_fee` decimal(8,2) NOT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `pin_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `email`, `phone`, `second_phone`, `password`, `region_id`, `minimum_order`, `delivery_fee`, `whatsapp`, `image`, `status`, `is_active`, `pin_code`, `created_at`, `updated_at`) VALUES
(1, 'restaurant 1', 'restaurant1@yahoo.com', '01011563248', '01122049044', '$2y$10$xTP4tBdcBrcGlwmROO08hu93/MbxsiKYJVnv8R8.UE3j9z/c7Tlcy', 1, '50.00', '15.00', '01055612144', 'uploads/restaurants/restaurant 1/1648151700695.jpg', 'open', 1, NULL, '2022-03-23 09:37:33', '2022-04-04 17:18:30'),
(3, 'restaurant 2', 'restaurant2@yahoo.com', '01011643198', '01011643128', '$2y$10$xTP4tBdcBrcGlwmROO08hu93/MbxsiKYJVnv8R8.UE3j9z/c7Tlcy', 6, '40.00', '15.00', '01011643198', 'uploads/restaurants/restaurant 2/1647564525icons8-e-commerce-100.png', 'open', 1, NULL, '2022-03-27 04:14:13', '2022-03-31 11:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `comment`, `rate`, `restaurant_id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 'good restaurant and food is very good', '5', 1, 1, '2022-03-23 20:02:47', '2022-03-23 20:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superAdmin', 'المدير العام', 'web', '2022-03-28 07:47:45', '2022-03-28 07:49:04'),
(2, 'Admin', 'المدير', 'web', '2022-03-28 07:48:53', '2022-03-28 07:48:53'),
(3, 'User', 'مستخدم', 'web', '2022-03-28 07:49:32', '2022-03-28 07:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `commission_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_app` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` decimal(8,2) NOT NULL,
  `fb_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tw_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insta_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `android_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ios_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `commission_text`, `about_app`, `phone`, `email`, `commission`, `fb_url`, `tw_url`, `insta_url`, `android_url`, `ios_url`, `bank_account`, `created_at`, `updated_at`) VALUES
(1, 'Odit dolores harum a', 'Non omnis aut proide', '01153225410', 'info@sofra.com', '0.50', 'www.facebook.com', 'www.twitter.com', 'www.instagram.com/', 'android', 'ios', '12012254762210247', NULL, '2022-03-25 18:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `tokenable_id` int(11) NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('android','ios') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `tokenable_id`, `tokenable_type`, `token`, `type`, `created_at`, `updated_at`) VALUES
(4, 1, 'App\\Models\\Client', 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8', 'android', '2022-05-06 22:19:51', '2022-05-06 22:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `notes`, `restaurant_id`, `date`, `created_at`, `updated_at`) VALUES
(1, '30.00', 'first amount', 1, '2022-03-23', '2022-03-23 22:00:00', '2022-03-23 22:00:00');

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
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_name`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Ibrahiem', 'mohamed@yahoo.com', NULL, '$2y$10$iGtxHHotFq4.cW0ouNa6aeGyp9TDRnn.WvMsWiFtzLLZ3Nx07G3lO', 'superAdmin', 'active', '4z1YBlBusljPocYxFipGqLAXrvdI91afjFqsqDpDIWU5qABQzqXYmqHeByY4', '2022-03-28 07:47:45', '2022-03-28 07:47:45'),
(3, 'sofra user', 'user@sofra.com', NULL, '$2y$10$2arKTHq42v1e3O.W4fFLl.4SG9s4Hyn8emhXtxG9IJdgbW9sgzIFe', 'User', 'active', NULL, '2022-03-28 07:55:13', '2022-03-28 07:55:13'),
(4, 'Admin', 'admin@sofra.com', NULL, '$2y$10$4Iy4i31db5Xe9Ra9CaGZ4OCnrWVvaTwg1PwWX0MurtS1Lv/CNvaPS', 'Admin', 'active', NULL, '2022-03-28 07:55:40', '2022-03-28 07:55:40');

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
-- Indexes for table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_restaurant_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `category_restaurant_category_id_foreign` (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_name_unique` (`name`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`),
  ADD KEY `clients_region_id_foreign` (`region_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_name_unique` (`name`),
  ADD KEY `items_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_order_item_id_foreign` (`item_id`),
  ADD KEY `item_order_order_id_foreign` (`order_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `orders_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `orders_client_id_unique` (`client_id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_city_id_foreign` (`city_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurants_name_unique` (`name`),
  ADD UNIQUE KEY `restaurants_email_unique` (`email`),
  ADD UNIQUE KEY `restaurants_phone_unique` (`phone`),
  ADD UNIQUE KEY `restaurants_second_phone_unique` (`second_phone`),
  ADD UNIQUE KEY `restaurants_whatsapp_unique` (`whatsapp`),
  ADD KEY `restaurants_region_id_foreign` (`region_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `reviews_client_id_foreign` (`client_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_restaurant_id_foreign` (`restaurant_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_order`
--
ALTER TABLE `item_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_restaurant`
--
ALTER TABLE `category_restaurant`
  ADD CONSTRAINT `category_restaurant_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_restaurant_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_order`
--
ALTER TABLE `item_order`
  ADD CONSTRAINT `item_order_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
