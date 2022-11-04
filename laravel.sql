-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2022 at 08:39 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image_url`, `created_at`, `updated_at`) VALUES
(2, 'Hoodie', 'hoodie', 'uploads/ddf0bba3f9423346739e6a80b4163053.png', '2022-10-21 01:34:54', '2022-10-21 01:34:54'),
(3, 'Long Sleeve', 'long-sleeve', 'uploads/c0c946d00f3a14ec301413982e5d4fbc.png', '2022-10-21 01:37:35', '2022-10-21 01:37:35'),
(4, 'Men T-Shirt', 'men-t-shirt', 'uploads/64c1c1390cbb45c7d5e4fe3a8b953dc4.png', '2022-10-21 01:38:08', '2022-10-21 01:38:08'),
(5, 'Sweatshirt', 'sweatshirt', 'uploads/acc52a12234d09175f74a3f035b59ff4.png', '2022-10-21 01:38:43', '2022-10-21 01:38:43'),
(6, 'Women T-Shirt', 'women-t-shirt', 'uploads/227784178d271a28a6eb2138b563c393.png', '2022-10-21 01:39:05', '2022-10-21 01:39:05'),
(7, 'Test', 'test', 'uploads/130f4abb4421588f1e30ebe9c0362270.webp', '2022-10-23 18:18:16', '2022-10-23 18:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_day` int(11) NOT NULL,
  `start_month` int(11) NOT NULL,
  `end_day` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_tags` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `slug`, `start_day`, `start_month`, `end_day`, `image_url`, `product_tags`, `created_at`, `updated_at`, `description`, `seo_title`, `seo_description`) VALUES
(5, 'Independence Day', 'independence-day', 29, 6, 5, 'uploads/d4778d0cf86ec4e43f2924038e261861.webp', 'Custom,Disney birthday,Disney Family,Disney Trip Family Vacation,Disneyworld,Chicago', '2022-10-21 00:40:30', '2022-10-21 05:50:52', NULL, NULL, NULL),
(6, 'International Beer Day', 'international-beer-day', 26, 9, 5, 'uploads/12f7cadab42403d3c0b1dbb05fe4cfc2.webp', '111', '2022-10-21 00:44:31', '2022-10-21 00:44:31', NULL, NULL, NULL),
(7, 'MLB All-Star Game', 'mlb-all-star-game', 29, 6, 5, 'uploads/eb6abcdb61ab65042d7f14c1e710f5f0.webp', '111', '2022-10-21 00:53:52', '2022-10-21 00:53:52', NULL, NULL, NULL),
(8, 'Parents\' Day', 'parents-day', 26, 9, 5, 'uploads/4eb38626823fbf1fe7c160b8526cb127.webp', '111', '2022-10-21 00:55:11', '2022-10-21 00:55:11', NULL, NULL, NULL),
(9, 'Pride Month Day', 'pride-month-day', 30, 6, 5, 'uploads/55a914fc609c4a08e2c25cef7be15a20.webp', '111', '2022-10-21 00:56:02', '2022-10-21 00:56:02', NULL, NULL, NULL),
(10, 'Test', 'test', 1, 1, 1, 'uploads/5378371fe97391258e760a6efd20432e.png', 'test', '2022-11-02 08:14:19', '2022-11-02 09:46:20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(7, 'default', '{\"uuid\":\"635a3b8c-53b0-4a45-80c4-7b44c715bc0a\",\"displayName\":\"App\\\\Jobs\\\\SyncSiteEventJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SyncSiteEventJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SyncSiteEventJob\\\":3:{s:35:\\\"\\u0000App\\\\Jobs\\\\SyncSiteEventJob\\u0000web_hook\\\";s:96:\\\"http:\\/\\/nacamio.com\\/wp-admin\\/admin-ajax.php?action=LizadoCrm&controller=sync&task=sync&sync_type=\\\";s:36:\\\"\\u0000App\\\\Jobs\\\\SyncSiteEventJob\\u0000sync_type\\\";s:6:\\\"events\\\";s:31:\\\"\\u0000App\\\\Jobs\\\\SyncSiteEventJob\\u0000site\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\Site\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1667383641, 1667383641),
(8, 'default', '{\"uuid\":\"ff150c58-3d54-4a1a-8374-02e3ef9ea435\",\"displayName\":\"App\\\\Jobs\\\\SyncSiteEventJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SyncSiteEventJob\",\"command\":\"O:25:\\\"App\\\\Jobs\\\\SyncSiteEventJob\\\":3:{s:35:\\\"\\u0000App\\\\Jobs\\\\SyncSiteEventJob\\u0000web_hook\\\";s:96:\\\"http:\\/\\/nacamio.com\\/wp-admin\\/admin-ajax.php?action=LizadoCrm&controller=sync&task=sync&sync_type=\\\";s:36:\\\"\\u0000App\\\\Jobs\\\\SyncSiteEventJob\\u0000sync_type\\\";s:6:\\\"events\\\";s:31:\\\"\\u0000App\\\\Jobs\\\\SyncSiteEventJob\\u0000site\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\Site\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"}}', 0, NULL, 1667383876, 1667383876);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `lft` int(10) UNSIGNED DEFAULT NULL,
  `rgt` int(10) UNSIGNED DEFAULT NULL,
  `depth` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `type`, `link`, `page_id`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Home', 'internal_link', '/', NULL, NULL, 2, 3, 1, '2022-10-16 00:20:27', '2022-10-21 06:20:57', NULL),
(2, 'Hoodie', 'internal_link', 'hoodie', NULL, NULL, 4, 5, 1, '2022-10-16 00:20:54', '2022-10-22 05:36:19', NULL),
(3, 'Long Sleeve', 'internal_link', 'long-sleeve', NULL, NULL, 6, 7, 1, '2022-10-16 00:21:58', '2022-10-22 05:36:28', NULL),
(4, 'Men T-Shirt', 'internal_link', 'men-t-shirt', NULL, NULL, 8, 11, 1, '2022-10-16 00:22:55', '2022-10-22 05:36:36', NULL),
(5, 'Sweatshirt', 'internal_link', 'sweatshirt', NULL, 4, 9, 10, 2, '2022-10-16 00:23:51', '2022-10-22 05:36:43', NULL),
(6, 'Women T-Shirt', 'internal_link', 'women-t-shirt', NULL, NULL, 12, 13, 1, '2022-10-16 00:24:39', '2022-10-22 05:36:02', NULL),
(7, 'Contact', 'internal_link', 'contact', NULL, NULL, 14, 15, 1, '2022-10-21 06:20:46', '2022-10-21 06:20:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_05_05_115641_create_menu_items_table', 1),
(4, '2016_05_25_121918_create_pages_table', 1),
(5, '2017_04_10_195926_change_extras_to_longtext', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2020_03_31_114745_remove_backpackuser_model', 1),
(9, '2022_10_16_041426_create_permission_tables', 1),
(10, '2022_10_16_045013_create_tags_table', 1),
(11, '2022_10_16_045918_create_events_table', 1),
(12, '2022_10_16_065256_create_categories_table', 2),
(13, '2022_10_16_065311_create_orders_table', 2),
(14, '2022_10_16_065513_create_sites_table', 3),
(15, '2022_10_25_063447_create_posts_table', 4),
(16, '2022_11_02_064646_create_jobs_table', 5),
(17, '2015_08_04_131614_create_settings_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `extras` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `template`, `name`, `title`, `slug`, `content`, `extras`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'about_us', 'About us', 'About us', 'about-us', '<h1 class=\"post-heading\">About us</h1>\r\n<div id=\"article-content\">\r\n\r\n<strong>__SITE_NAME__</strong> is a global marketplace that empowers independent sellers to share today’s most daring, exciting and edgy fashion apparel. We help our community of sellers turn their ideas into successful businesses. Our platform connects them with millions of buyers looking for an alternative—something special with a human touch, for those moments in life that deserve imagination.\r\n\r\nWe provide customers with access to hundreds of unique designs made by passionate designers and artists. Unleash the power of great design to brighten the world around you.\r\n\r\n<b>Office Address</b>: __SITE_ADDRESS__\r\n<b>Phone</b>: __SITE_PHONE__\r\n<b>Office Hours: __SITE_OPEN_HOURS__\r\n<b>Email</b>:&nbsp;<a href=\"mailto:__SITE_CONTACT_EMAIL__\">__SITE_CONTACT_EMAIL__</a>\r\n\r\n</b></div>', NULL, '2022-10-16 00:25:49', '2022-10-16 00:25:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(11, 'Pages-index', 'web', NULL, NULL),
(12, 'Pages-view', 'web', NULL, NULL),
(13, 'Pages-create', 'web', NULL, NULL),
(14, 'Pages-update', 'web', NULL, NULL),
(15, 'Pages-delete', 'web', NULL, NULL),
(16, 'Files-index', 'web', NULL, NULL),
(17, 'Files-view', 'web', NULL, NULL),
(21, 'Users-index', 'web', NULL, NULL),
(22, 'Users-view', 'web', NULL, NULL),
(23, 'Users-create', 'web', NULL, NULL),
(24, 'Users-update', 'web', NULL, NULL),
(25, 'Users-delete', 'web', NULL, NULL),
(26, 'Roles-index', 'web', NULL, NULL),
(27, 'Roles-view', 'web', NULL, NULL),
(28, 'Roles-create', 'web', NULL, NULL),
(29, 'Roles-update', 'web', NULL, NULL),
(30, 'Roles-delete', 'web', NULL, NULL),
(31, 'Permissions-index', 'web', NULL, NULL),
(32, 'Permissions-view', 'web', NULL, NULL),
(33, 'Permissions-create', 'web', NULL, NULL),
(34, 'Permissions-update', 'web', NULL, NULL),
(35, 'Permissions-delete', 'web', NULL, NULL),
(36, 'Events-index', 'web', NULL, NULL),
(37, 'Events-view', 'web', NULL, NULL),
(38, 'Events-create', 'web', NULL, NULL),
(39, 'Events-update', 'web', NULL, NULL),
(40, 'Events-delete', 'web', NULL, NULL),
(41, 'Categories-index', 'web', NULL, NULL),
(42, 'Categories-view', 'web', NULL, NULL),
(43, 'Categories-create', 'web', NULL, NULL),
(44, 'Categories-update', 'web', NULL, NULL),
(45, 'Categories-delete', 'web', NULL, NULL),
(46, 'Sites-index', 'web', NULL, NULL),
(47, 'Sites-view', 'web', NULL, NULL),
(48, 'Sites-create', 'web', NULL, NULL),
(49, 'Sites-update', 'web', NULL, NULL),
(50, 'Sites-delete', 'web', NULL, NULL),
(51, 'Logs-index', 'web', NULL, NULL),
(56, 'Single Site-index', 'web', NULL, NULL),
(57, 'Single Site-view', 'web', NULL, NULL),
(58, 'Single Site-create', 'web', NULL, NULL),
(59, 'Single Site-update', 'web', NULL, NULL),
(60, 'Single Site-delete', 'web', NULL, NULL),
(61, 'Single Site-sync', 'web', NULL, NULL),
(62, 'Single Site-shippings', 'web', NULL, NULL),
(63, 'Menus-index', 'web', NULL, NULL),
(64, 'Single Site-orders', 'web', NULL, NULL),
(65, 'Single Site-products', 'web', NULL, NULL),
(66, 'Settings-index', 'web', '2022-11-03 00:52:28', '2022-11-03 00:52:28'),
(67, 'Sites field - Api key', 'web', '2022-11-03 01:45:17', '2022-11-03 01:45:17'),
(68, 'Sites field - Woocommerce consumer key', 'web', '2022-11-03 01:45:32', '2022-11-03 01:45:32'),
(69, 'Sites field - Woocommerce consumer secret', 'web', '2022-11-03 01:46:27', '2022-11-03 01:46:27'),
(70, 'Sites field - Google api key', 'web', '2022-11-03 01:47:30', '2022-11-03 01:47:30'),
(71, 'Sites field - Facebook api key', 'web', '2022-11-03 01:47:38', '2022-11-03 01:47:38'),
(72, 'Orders-index', 'web', NULL, NULL),
(73, 'Orders-view', 'web', NULL, NULL),
(74, 'Orders-create', 'web', NULL, NULL),
(75, 'Orders-update', 'web', NULL, NULL),
(76, 'Orders-delete', 'web', NULL, NULL),
(77, 'Tags-index', 'web', NULL, NULL),
(78, 'Tags-view', 'web', NULL, NULL),
(79, 'Tags-create', 'web', NULL, NULL),
(80, 'Tags-update', 'web', NULL, NULL),
(81, 'Tags-delete', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-10-16 00:04:14', '2022-11-02 23:40:04'),
(2, 'Products Manager', 'web', '2022-11-02 23:40:24', '2022-11-02 23:40:24'),
(3, 'Orders Manager', 'web', '2022-11-02 23:40:34', '2022-11-02 23:40:34'),
(4, 'Store Admin', 'web', '2022-11-02 23:40:47', '2022-11-02 23:40:47');

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
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
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
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(46, 3),
(64, 3),
(56, 4),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(64, 4),
(65, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `name`, `description`, `value`, `field`, `active`, `created_at`, `updated_at`) VALUES
(1, 'web_hook_admin', 'Web hook admin', '', 'https://gearmentstore.com', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 06:11:45'),
(5, 'web_hook_api', 'Web hook api', NULL, 'https://gearmentstore.com/product-api', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 06:11:45'),
(6, 'product_cat_seo_title', 'Product cat - SEO title', NULL, '%%term_title%% %%sep%% %%sitename%%', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 07:09:59'),
(7, 'product_cat_meta_description', 'Product cat - Meta description', NULL, 'Products tagged %%term_title%% Collection from %%sitename%% for your team, organization or event online. Free Shipping, Discount and thousands of design ideas.', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}', 1, NULL, '2022-11-03 07:09:07'),
(8, 'product_tag_seo_title', 'Product tag - SEO title', NULL, '%%term_title%% %%sep%% %%sitename%%', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 07:09:59'),
(9, 'product_tag_meta_description', 'Product tag - Meta description', NULL, 'Products tagged %%term_title%% Collection from %%sitename%% for your team, organization or event online. Free Shipping, Discount and thousands of design ideas.', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}', 1, NULL, '2022-11-03 07:09:07'),
(10, 'product_color_seo_title', 'Product color - SEO title', NULL, '%%term_title%% %%sep%% %%sitename%%', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 07:09:59'),
(11, 'product_color_meta_description', 'Product color - Meta description', NULL, 'Products tagged %%term_title%% Collection from %%sitename%% for your team, organization or event online. Free Shipping, Discount and thousands of design ideas.', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}', 1, NULL, '2022-11-03 07:09:07'),
(12, 'product_design_seo_title', 'Product design - SEO title', NULL, '%%term_title%% %%sep%% %%sitename%%', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 07:09:59'),
(13, 'product_design_meta_description', 'Product design - Meta description', NULL, 'Products tagged %%term_title%% Collection from %%sitename%% for your team, organization or event online. Free Shipping, Discount and thousands of design ideas.', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}', 1, NULL, '2022-11-03 07:09:07'),
(14, 'product_event_seo_title', 'Product event - SEO title', NULL, '%%term_title%% %%sep%% %%sitename%%', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"text\"}', 1, NULL, '2022-11-03 07:09:59'),
(15, 'product_event_meta_description', 'Product event - Meta description', NULL, 'Products tagged %%term_title%% Collection from %%sitename%% for your team, organization or event online. Free Shipping, Discount and thousands of design ideas.', '{\"name\":\"value\",\"label\":\"Value\",\"type\":\"textarea\"}', 1, NULL, '2022-11-03 07:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `product_api_url` varchar(255) DEFAULT NULL,
  `product_start_id` int(11) DEFAULT '0',
  `product_end_id` int(11) DEFAULT '0',
  `product_limit_per_call` int(11) DEFAULT '1',
  `product_api_next_page` int(11) DEFAULT '0',
  `product_call_interval` varchar(255) DEFAULT NULL,
  `product_detail_api_url` varchar(255) DEFAULT NULL,
  `product_detail_limit_per_call` int(11) DEFAULT '1',
  `import_to_wp_limit_per_call` int(11) DEFAULT '1',
  `product_detail_call_interval` varchar(255) DEFAULT NULL,
  `import_to_wp_interval` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `topbar_content` text,
  `site_address` varchar(255) DEFAULT NULL,
  `site_domain` varchar(255) DEFAULT NULL,
  `administration_email_address` varchar(255) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `contact_email_address` varchar(255) DEFAULT NULL,
  `site_open_hours` varchar(255) DEFAULT NULL,
  `web_hook` varchar(255) DEFAULT NULL,
  `product_tags` text,
  `product_events` text,
  `site_map` text,
  `woocommerce_consumer_key` varchar(255) DEFAULT NULL,
  `woocommerce_consumer_secret` varchar(255) DEFAULT NULL,
  `html_scripts_header` text,
  `html_scripts_footer` text,
  `html_scripts_after_body` text,
  `html_scripts_before_body` text,
  `google_api_key` varchar(255) DEFAULT NULL,
  `facebook_api_key` varchar(255) DEFAULT NULL,
  `search_config_active` varchar(255) DEFAULT 'yes',
  `search_config_keywords` text,
  `shipper_methods_options` text,
  `last_sync` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `api_key`, `product_api_url`, `product_start_id`, `product_end_id`, `product_limit_per_call`, `product_api_next_page`, `product_call_interval`, `product_detail_api_url`, `product_detail_limit_per_call`, `import_to_wp_limit_per_call`, `product_detail_call_interval`, `import_to_wp_interval`, `site_title`, `tagline`, `topbar_content`, `site_address`, `site_domain`, `administration_email_address`, `site_phone`, `contact_email_address`, `site_open_hours`, `web_hook`, `product_tags`, `product_events`, `site_map`, `woocommerce_consumer_key`, `woocommerce_consumer_secret`, `html_scripts_header`, `html_scripts_footer`, `html_scripts_after_body`, `html_scripts_before_body`, `google_api_key`, `facebook_api_key`, `search_config_active`, `search_config_keywords`, `shipper_methods_options`, `last_sync`) VALUES
(10, 'DEcAFN2Cnh0Q2wc9', 'https://camonspa.vn/lizado/lizado-admin/index.php?c=Product&a=api_index', 10161, 11000, 100, 0, 'everyminutes', 'https://camonspa.vn/lizado/lizado-admin/index.php?c=Product&a=api_show', 1, 1, 'everyminutes', 'everyminutes', 'Nacamio', 'Spice up your life.', '<a style=\"color:black;font-weight:400;font-size:15px;text-decoration: underline;\" href=\"https://nacamio.com\">Happy Father\'s Day up to 50% OFF</a>', '218 Otter Circle, Fayetteville, GA, 30215 USA.', 'nacamio.com', 'support@nacamio.com', '+1 678 582 2699', 'support@nacamio.com', '(Mon - Fri, 9am - 6pm)', 'https://gearmentstore.com', '7,8', '1,3,4,5', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.9192451473004!2d-83.9880871!3d33.86597199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f5b9a4493ed501%3A0x57823b76685d9401!2s1640%20Terry%20Mill%20Ln%2C%20Grayson%2C%20GA%2030017%2C%20USA!5e0!3m2!1sen!2s!4v1662175008783!5m2!1sen!2s', 'ck_df73e801cd9c092878c630ae59b50dcf3b71c295', 'cs_c47a9b40edf60c57778ab482c2319c68e713816a', NULL, NULL, NULL, NULL, 'GTM-5HWGWJX', NULL, 'yes', 'hihi,haha,hehe', '{\"shipper_methods\":{\"1\":{\"1\":{\"date_delivery\":\"3\"},\"2\":{\"date_delivery\":\"5\"}}}}', '2022-10-31 11:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'tag1', NULL, '2022-11-03 06:31:00', '2022-11-03 06:33:56'),
(2, 'tag2', NULL, '2022-11-03 06:32:12', '2022-11-03 06:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `site_id`) VALUES
(1, 'webmaster', 'webmaster@gmail.com', NULL, '$2y$10$gTb46tNUpSDmK4neQGovQuBMwhMeXs33wj6l80kiUmlVp5YjVM50W', 'B80JvKwklwAsjzmVrumZRLjtTyAxjI3boTovDbbOAkfF3q90tRzLSGjhFUps', NULL, NULL, NULL),
(2, 'Site manager nacamio.com', 'site_manager_nacamio@gmail.com', NULL, '$2y$10$3a9tngihwch6bPk2pBMn1OnBt22ese1PWmYgRP8f.qxPtj7uanPRK', 'D1ushHsHJseZKIs7ZFjW9mIeptnajRetl2csLmylMC3ymHjURlULxet2pG6N', '2022-11-03 00:15:45', '2022-11-03 01:30:09', 10),
(3, 'Orders Manager', 'order@gmail.com', NULL, '$2y$10$U9KquiXxs2kDuDyk9oFSKuRImNmmfZVk7R7mKINjt/92BxNtySAh2', NULL, '2022-11-03 06:37:20', '2022-11-03 06:37:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_name_unique` (`name`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`);

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
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_name_unique` (`name`),
  ADD UNIQUE KEY `orders_slug_unique` (`slug`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
