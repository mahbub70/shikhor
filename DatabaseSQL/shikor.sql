-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2022 at 10:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shikor`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `desc`, `image`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'New Title', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>', '69e270c1-59e9-4a49-a92d-a31734fe055e.webp', 'admin', NULL, '2022-07-14 01:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `academic_classes`
--

CREATE TABLE `academic_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_classes`
--

INSERT INTO `academic_classes` (`id`, `name`, `desc`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Leandra Landry Class', 'Inventore veniam, qu. Desc', 'admin', '2022-06-30 00:05:13', '2022-06-30 00:56:13'),
(2, 'Renee Whitney', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">pe and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishin</span>', 'admin', '2022-07-14 01:22:08', '2022-07-14 01:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$ilIGtBW31Gaiv57GoDwMhOmcqnH//qD3uU.wYeRImCQIgytkL8MZS', '1b15ebf3-95d5-4591-9596-9a961ed1781a_1.jpg', NULL, '2022-06-29 03:32:36', '2022-07-03 03:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Adele Merritt', NULL, 1, '2022-07-13 23:32:03', NULL),
(5, 'Tara Cain', NULL, 1, '2022-07-13 23:32:07', NULL),
(6, 'Fritz Guthrie', NULL, 1, '2022-07-13 23:32:10', NULL),
(7, 'Robin Garrett', NULL, 1, '2022-07-13 23:32:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_videos`
--

CREATE TABLE `class_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_videos`
--

INSERT INTO `class_videos` (`id`, `title`, `description`, `class_name`, `type`, `author`, `link`, `video_file`, `video_thumb`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Culpa tenetur doloru', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span>', 'Stephanie Joseph', 1, 'Odit excepturi accus', NULL, 'eb88a546f91037c8e2f59a2eda24041f30f2cf34-62cfa7b9b2ad33.mp4', 'thumbnail_62cfce3cd7a263.jpg', 1, '2022-07-14 02:05:16', '2022-07-14 02:05:16'),
(4, 'Eum ex omnis est aut', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span>', 'Hayley Case', 0, 'Omnis eum quia commo', NULL, 'whatsapp-62cfca99a5c514.mp4', 'thumbnail_62cfce0bb14ad4.webp', 1, '2022-07-14 02:04:27', '2022-07-14 02:04:27'),
(5, 'Enim error repudiand', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span>', 'Kiona Herring', 1, 'Ullam aut molestiae', '<iframe width=\"853\" height=\"480\" src=\"https://www.youtube.com/embed/0U5JbmPAiwQ\" title=\"15 Best Books On Selling\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 'thumbnail_62cfd0e29f31e5.png', 1, '2022-07-14 02:16:34', '2022-07-14 02:16:34'),
(6, 'Molestiae nobis labo', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span>', 'Cameron Mccullough', 2, 'Delectus expedita d', '<iframe width=\"853\" height=\"480\" src=\"https://www.youtube.com/embed/0U5JbmPAiwQ\" title=\"15 Best Books On Selling\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 'thumbnail_62cfd0c2293096.jpg', 1, '2022-07-14 02:16:02', '2022-07-14 02:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `class_video_instructions`
--

CREATE TABLE `class_video_instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_video_instructions`
--

INSERT INTO `class_video_instructions` (`id`, `title`, `desc`, `button_text`, `button_link`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Molestiae sunt autem', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span>', 'Click Here', '#', 'admin', NULL, '2022-07-13 23:31:28');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcqs`
--

CREATE TABLE `mcqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currect_ans` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcqs`
--

INSERT INTO `mcqs` (`id`, `class_id`, `year`, `question`, `option_one`, `option_two`, `option_three`, `option_four`, `currect_ans`, `added_by`, `created_at`, `updated_at`) VALUES
(3, 1, 2002, 'Tempore fugiat omn', 'Nisi dolor aliquam e', 'Sit animi velit v', 'Veniam quaerat do e', 'Qui quia numquam est', 'Aspernatur aut dolor', 'admin', '2022-07-14 01:20:36', '2022-07-14 01:20:36'),
(4, 1, 1990, 'Tenetur ea sit ea si', 'Culpa eos impedit', 'Et tempor sint ut m', 'Proident ad excepte', 'Quia quo est libero', 'Necessitatibus eos s', 'admin', '2022-07-14 01:20:40', '2022-07-14 01:20:40'),
(5, 1, 1990, 'Laboris earum volupt', 'Et nisi quam dolorem', 'Voluptates possimus', 'Odio elit aut sed q', 'Nisi eum sunt quia a', 'Magna voluptatum ad', 'admin', '2022-07-14 01:20:44', '2022-07-14 01:20:44'),
(6, 1, 1998, 'Sint odio corporis', 'Laborum Dolor cillu', 'Voluptatem Quod vit', 'Illo magni aperiam i', 'Inventore excepturi', 'Et ad aliquip reicie', 'admin', '2022-07-14 01:20:47', '2022-07-14 01:20:47'),
(7, 1, 1997, 'Similique lorem maxi', 'Eu pariatur Omnis q', 'Neque impedit eveni', 'Nobis mollit et ab s', 'Eum voluptatem dolor', 'Eos aut nihil numqu', 'admin', '2022-07-14 01:20:51', '2022-07-14 01:20:51'),
(8, 1, 1992, 'Quia debitis pariatu', 'Non fuga Nobis id n', 'Sed praesentium qui', 'Reiciendis exercitat', 'Reprehenderit qui iu', 'Doloremque aliquip e', 'admin', '2022-07-14 01:22:37', '2022-07-14 01:22:37'),
(9, 2, 1994, 'Est ipsum reprehende', 'Blanditiis esse moll', 'Sit voluptates cons', 'Sunt neque eos omni', 'Eveniet reprehender', 'Animi rem sequi omn', 'admin', '2022-07-14 01:22:40', '2022-07-14 01:22:40'),
(10, 1, 2018, 'Non ratione dolor in', 'Quo accusantium ex i', 'Minima dicta quod au', 'Eum fuga Dolore dol', 'Dicta deserunt vero', 'Tempor magna eius qu', 'admin', '2022-07-14 01:22:47', '2022-07-14 01:22:47'),
(11, 2, 2010, 'Quis cupiditate volu', 'Est adipisicing est', 'Similique dolor qui', 'Pariatur Cupidatat', 'Inventore ullamco la', 'Non ad fuga Illo de', 'admin', '2022-07-14 01:22:50', '2022-07-14 01:22:50');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_12_040030_create_admins_table', 1),
(6, '2022_06_12_104721_create_class_videos_table', 1),
(7, '2022_06_20_112629_create_categories_table', 1),
(8, '2022_06_20_113324_create_products_table', 1),
(9, '2022_06_29_091946_create_success_people_table', 1),
(10, '2022_06_29_115228_create_about_us_table', 2),
(11, '2022_06_30_055806_create_academic_classes_table', 3),
(12, '2022_06_30_072516_create_mcqs_table', 4),
(13, '2022_07_02_172522_create_orders_table', 5),
(14, '2022_07_03_032046_create_class_video_instructions_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transection_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `due` int(11) DEFAULT NULL,
  `delivery_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `customer_name`, `customer_address`, `customer_phone`, `customer_qty`, `transection_id`, `unit_price`, `total`, `advance`, `due`, `delivery_status`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(4, 6, 'Eliana Booker', 'Reprehenderit non c', '1234567890', '1', 'Quia recusandae Eaq', 649, 649, 649, 0, 0, 3, 'admin', '2022-07-14 01:24:07', '2022-07-14 01:26:00'),
(5, 8, 'Melanie Leon', 'Hic libero dolor min', '123456', '2', 'Repellendus Optio', 418, 836, 100, 736, 0, 1, 'admin', '2022-07-14 01:27:25', NULL),
(6, 9, 'Madaline Cotton', 'Sint ullam cupidatat', '2222', '2', 'Nostrum corrupti ex', 580, 1160, 1000, 160, 0, 1, 'admin', '2022-07-14 01:27:57', NULL),
(7, 8, 'Tanisha Mathews', 'Quo fugit qui labor', '9804', '2', 'Sit non quam evenie', 418, 836, 100, 736, 0, 1, 'admin', '2022-07-14 01:28:25', NULL),
(8, 7, 'Frances Bailey', 'Sint repudiandae rem', '1476', '2', 'Voluptas molestiae a', 914, 1828, 1828, 0, 0, 3, 'admin', '2022-07-14 01:28:48', '2022-07-14 01:31:48');

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
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `writter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `writter`, `desc`, `image`, `qty`, `price`, `status`, `created_at`, `updated_at`) VALUES
(5, 7, 'Ivory Poole', 'Kevyn David', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span>', 'product_62cfb8674da9c5.webp', 672, 705, 1, '2022-07-13 23:32:30', '2022-07-14 00:32:07'),
(6, 4, 'Dexter Montoya', 'Beau Mays', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in cl</span><br>', 'product_62cfb855e00bf6.png', 754, 649, 1, '2022-07-14 00:27:14', '2022-07-14 01:24:07'),
(7, 6, 'Allistair Daugherty', 'Rogan Frank', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in cl</span>', 'product_62cfb8434a8837.jpg', 511, 914, 1, '2022-07-14 00:27:26', '2022-07-14 01:28:48'),
(8, 5, 'Buckminster Dunlap', 'Jaden Reynolds', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in cl</span>', 'product_62cfb833c76d18.jpg', 133, 418, 1, '2022-07-14 00:27:37', '2022-07-14 01:28:25'),
(9, 5, 'Sonia Gardner', 'Hermione Vargas', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in cl</span>', 'product_62cfb762953e99.jpg', 556, 580, 1, '2022-07-14 00:27:46', '2022-07-14 01:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `success_people`
--

CREATE TABLE `success_people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `success_people`
--

INSERT INTO `success_people` (`id`, `name`, `batch_id`, `address`, `position`, `grade`, `message`, `desc`, `image`, `added_by`, `created_at`, `updated_at`) VALUES
(12, 'Stella Berry', 'Minus et voluptatem', 'Labore reiciendis et', 'Aspernatur recusanda', 'Sed excepturi ducimu', 'Sint veniam ipsa', 'Earum eius voluptatu.', '289f3432-f9cf-4fb5-90e1-8329ba3cbb51-12.jpg', 'admin', '2022-07-14 00:42:15', '2022-07-14 00:45:33'),
(13, 'Robert Blackwell', 'Quam at esse nemo i', 'Harum rem soluta mag', 'Eu voluptate ut quo', 'Vitae adipisci moles', 'Assumenda adipisci d', 'Delectus, neque quo .', '620fa1de-480b-410d-ad3b-4fba350d3283-13.jpg', 'admin', '2022-07-14 00:42:38', '2022-07-14 00:43:50'),
(14, 'Brianna Maynard', 'Expedita est et Nam', 'Nam elit quidem atq', 'Nesciunt consectetu', 'Veritatis aut dolor', 'Totam id architecto', 'Quam nostrum est min.', 'f620d111-0129-428d-8d06-49a9c167b335-14.jpg', 'admin', '2022-07-14 00:44:49', '2022-07-14 00:45:19'),
(15, 'Florence Walters', 'Et proident volupta', 'Cupiditate omnis in', 'Sit aut proident m', 'Sit assumenda et ir', 'Et quae incidunt es', 'Culpa ut quis magni .', '594829c0-e699-4a57-80fd-5dc597e9270d-15.jpg', 'admin', '2022-07-14 00:45:06', '2022-07-14 00:45:06'),
(20, 'Zenia Mendoza', 'Nobis error et facil', 'Aut excepteur laboru', 'Deserunt itaque non', 'Ipsam irure sint ut', 'Deserunt aut officia', '<span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">pe and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishin</span>', '1397c693-8ccf-4dfe-ba6d-0dd94caf2c6c-20.jpg', 'admin', '2022-07-14 01:15:45', '2022-07-14 01:17:01');

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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `last_login` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `last_login`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'Macy Vance', 'miwesivywa@mailinator.com', NULL, '$2y$10$L.2MVO1mHffzRfkVjU1MR./MB8imQ2q9/KzinlEww9uUIf6Lhfjni', 'default.jpg', '2022-07-13 23:15:10', 1, NULL, '2022-07-13 23:15:10', '2022-07-13 23:15:10'),
(10, 'Gretchen Mckenzie', 'wifaxuze@mailinator.com', NULL, '$2y$10$6LLkVtkDzqCELSN2m0sEJ.E9B37smyWh2SOzpLbiwDjrpixiCHaSq', 'default.jpg', '2022-07-13 23:15:21', 1, NULL, '2022-07-13 23:15:21', '2022-07-13 23:15:21'),
(11, 'Danielle Walsh', 'zabuvopu@mailinator.com', NULL, '$2y$10$Auaq71kRVVrqG1LtMINhhOzCvbKvGm2nWjhGIvYngdX3QvOsh.o8e', 'default.jpg', '2022-07-13 23:15:29', 1, NULL, '2022-07-13 23:15:29', '2022-07-13 23:15:29'),
(12, 'Hayes Marks', 'fico@mailinator.com', NULL, '$2y$10$lu3J9YhRcEel8XsvfwCqm.e3.p53JKLfbcSHyUnMpxIC2SOfz2ZKi', 'default.jpg', '2022-07-13 23:15:36', 1, NULL, '2022-07-13 23:15:36', '2022-07-13 23:15:36'),
(13, 'Lucius Mills', 'qepa@mailinator.com', NULL, '$2y$10$vzceU23k6OyJcje.mKKW5eAw/plgJ19wBi7AAGwM5bQGR.TQ9KMlm', 'default.jpg', '2022-07-13 23:15:42', 1, NULL, '2022-07-13 23:15:42', '2022-07-13 23:15:42'),
(14, 'Tamekah Bradshaw', 'gyjojak@mailinator.com', NULL, '$2y$10$bvBiSvKzE6wOP6z/xZe71e/MCYTTtNjpPRu.5lVWuoMnoAEpJQ5GC', 'default.jpg', '2022-07-13 23:15:49', 1, NULL, '2022-07-13 23:15:49', '2022-07-13 23:15:49'),
(15, 'Keith House', 'kegyl@mailinator.com', NULL, '$2y$10$VTgBq0KosvxzyJ6NRuhDCu9vux5M8JxKp7ZZvUKhsvD.UOwY/w9Re', 'default.jpg', '2022-07-13 23:15:57', 1, NULL, '2022-07-13 23:15:57', '2022-07-13 23:15:57'),
(16, 'Mufutau Lloyd', 'cevosef@mailinator.com', NULL, '$2y$10$Viww5yz7WUlxGrnXmzxV.utroGLrxWFRhf2v2KMNCE8H9149pL6Pe', 'default.jpg', '2022-07-13 23:16:04', 1, NULL, '2022-07-13 23:16:04', '2022-07-13 23:16:04'),
(17, 'Madaline Witt', 'tupyvorer@mailinator.com', NULL, '$2y$10$rZrBlP9l/7r0YVhqblMq8OvEeiuJaeNOVY7gvDarLdXTHDdoKqcqu', 'default.jpg', '2022-07-13 23:16:11', 1, NULL, '2022-07-13 23:16:11', '2022-07-13 23:16:11'),
(18, 'Megan Rios', 'zuqohybelo@mailinator.com', NULL, '$2y$10$X5s0528V2ufbpN6/DEGMzuXx6lnJQNw5Z5LbtJrYvN04mp/7Gy646', 'default.jpg', '2022-07-13 23:16:18', 1, NULL, '2022-07-13 23:16:18', '2022-07-13 23:16:18'),
(19, 'Keelie Petty', 'vitoqe@mailinator.com', NULL, '$2y$10$Uks78PvEuW9lTPMz/cK28uYuAkFw4OTxHeR.gRfCFmTgV7VqFv/NC', 'default.jpg', '2022-07-13 23:16:25', 1, NULL, '2022-07-13 23:16:25', '2022-07-13 23:16:25'),
(20, 'Nero Bruce', 'luwemuwiji@mailinator.com', NULL, '$2y$10$v30llKQgrvis4A2fJMy6.Os9gy4TZQmNbEQaBJMQGWX7uK3HwUKD.', 'default.jpg', '2022-07-13 23:16:32', 1, NULL, '2022-07-13 23:16:32', '2022-07-13 23:16:32'),
(21, 'Gareth Hess', 'gihynu@mailinator.com', NULL, '$2y$10$b/tefg/ym9N3X/b.SYRfrucBpQW2EOBKrALAbrAVB2HHZeLLz.9su', 'default.jpg', '2022-07-13 23:16:39', 1, NULL, '2022-07-13 23:16:39', '2022-07-13 23:16:39'),
(22, 'Ray Ayala', 'wedodisubo@mailinator.com', NULL, '$2y$10$t5167gtWOKM.lPO7vp7u9OOJVbykWZ2rNSW6NpaW3jzxc6IuMNmtG', 'default.jpg', '2022-07-13 23:16:46', 1, NULL, '2022-07-13 23:16:46', '2022-07-13 23:16:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_classes`
--
ALTER TABLE `academic_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_videos`
--
ALTER TABLE `class_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_video_instructions`
--
ALTER TABLE `class_video_instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mcqs`
--
ALTER TABLE `mcqs`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `success_people`
--
ALTER TABLE `success_people`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `academic_classes`
--
ALTER TABLE `academic_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_videos`
--
ALTER TABLE `class_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_video_instructions`
--
ALTER TABLE `class_video_instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcqs`
--
ALTER TABLE `mcqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `success_people`
--
ALTER TABLE `success_people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
