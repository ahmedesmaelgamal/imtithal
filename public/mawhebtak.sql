-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2025 at 01:45 PM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mawhebtak`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `twofa_secret` longtext COLLATE utf8mb4_unicode_ci,
  `twofa_qr` longtext COLLATE utf8mb4_unicode_ci,
  `twofa_verify` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `code`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`, `twofa_secret`, `twofa_qr`, `twofa_verify`) VALUES
(1, 'admin', 'qBJWKLxIa3U', 'admin', 'admin@admin.com', '$2y$10$7Oq8C7I9dF3Q0nAYEToMW.MlB2CqS7nXYVLenl/6tb9r4NO7k1Zyy', NULL, '2025-06-01 11:28:27', '2025-06-01 11:28:27', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `announces`
--

CREATE TABLE `announces` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_in` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announces`
--

INSERT INTO `announces` (`id`, `user_id`, `title`, `description`, `sub_category_id`, `price`, `location`, `lat`, `long`, `expire_in`, `created_at`, `updated_at`) VALUES
(1, 541, 'Expedita consequuntur harum laboriosam.', 'Aut hic eos tenetur repellendus sint placeat dolores.', 1, '796.43', NULL, '-27.299407', '-28.707117', '2025-06-18 00:30:34', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(2, 542, 'Sit sint voluptatem accusantium nostrum.', 'Eum optio odit dolorem sit nobis quia.', 1, '353.69', NULL, '74.77868', '-102.944817', '2026-05-09 07:02:22', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(3, 543, 'Amet tempora atque repudiandae ratione.', 'Maiores accusamus eligendi in est omnis sed.', 1, '241.03', NULL, '38.162244', '116.074414', '2025-07-19 11:00:49', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(4, 544, 'Exercitationem quibusdam omnis saepe voluptatem quis provident similique.', 'Dicta nulla mollitia sequi impedit blanditiis veniam velit.', 1, '38.55', NULL, '48.036288', '92.826952', '2026-01-22 00:04:33', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(5, 545, 'Voluptas laboriosam voluptatibus sed velit.', 'Pariatur asperiores ab cumque et veniam dolores.', 1, '913.38', NULL, '26.468297', '140.736246', '2026-02-03 00:09:15', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(6, 546, 'Corporis sed adipisci eaque voluptatum nesciunt sequi voluptas.', 'Natus accusamus consequatur dolorem reprehenderit provident ea praesentium.', 1, '28.5', NULL, '-67.683167', '-148.323356', '2025-12-09 16:22:03', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(7, 547, 'Inventore aut dolorem harum qui qui saepe non ut.', 'Molestias facere minus ipsum velit est occaecati voluptatem enim.', 1, '486.56', NULL, '-71.905222', '-119.771203', '2026-01-08 23:14:27', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(8, 548, 'Doloribus voluptas sequi vel corporis voluptates ea doloribus.', 'Veniam eligendi facilis sint quia quam cum aut.', 1, '214.55', NULL, '54.58069', '139.357927', '2025-08-14 08:56:08', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(9, 549, 'Nesciunt reprehenderit recusandae rerum voluptates voluptatem.', 'Enim aperiam et et suscipit quia veritatis commodi.', 1, '564.31', NULL, '-52.931645', '-25.475967', '2025-12-10 14:31:21', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(10, 550, 'Aut voluptas libero repellat non et enim.', 'Ut dolore illo fugit assumenda sed illo ut.', 1, '866.91', NULL, '7.89933', '82.637859', '2026-01-15 21:03:59', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(11, 551, 'Ut cumque corporis aut officia eos consequuntur unde ad.', 'Hic consequatur minima et ullam minus placeat.', 1, '883.8', NULL, '-46.351605', '165.656674', '2026-02-12 01:06:29', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(12, 552, 'Sit aliquid voluptatibus commodi laudantium architecto at.', 'Quia placeat assumenda ex sint.', 1, '872.63', NULL, '19.742424', '123.6882', '2025-06-19 13:10:35', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(13, 553, 'Sequi omnis veniam accusamus autem blanditiis quia repellat aut.', 'Dicta doloremque tenetur atque earum.', 1, '205.04', NULL, '2.619507', '140.42819', '2025-09-10 18:03:54', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(14, 554, 'At est suscipit libero sint sunt perspiciatis.', 'Error quidem dolores adipisci nulla vero sunt numquam.', 1, '301.95', NULL, '71.830177', '112.928197', '2026-04-09 16:58:10', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(15, 555, 'Quis neque cumque dolor asperiores beatae dolorem.', 'Et repudiandae nobis commodi assumenda consequatur.', 1, '462.37', NULL, '88.603459', '-123.813992', '2025-12-20 14:34:03', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(16, 556, 'Nemo eum earum fuga.', 'Expedita et laudantium voluptatem esse explicabo.', 1, '355.57', NULL, '-61.663828', '44.774322', '2026-04-11 13:45:01', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(17, 557, 'Sequi sequi excepturi aut veniam id quo et.', 'Aspernatur minima cumque facere itaque.', 1, '492.26', NULL, '-2.235557', '151.297435', '2025-06-10 12:09:43', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(18, 558, 'Delectus consectetur libero voluptatum quia exercitationem.', 'Placeat quo perspiciatis in quia.', 1, '673.02', NULL, '-79.396633', '-127.583071', '2026-01-15 12:02:58', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(19, 559, 'Ut et molestias in veritatis nihil doloribus et unde.', 'Sint quia minima earum autem consequatur.', 1, '96.08', NULL, '-15.735747', '137.387351', '2026-04-08 12:54:56', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(20, 560, 'Maxime ab eveniet et sit quia ullam minus.', 'Molestias rerum quia qui animi.', 1, '345.09', NULL, '-68.432594', '76.163133', '2026-05-19 13:03:14', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(21, 561, 'Incidunt neque facilis nobis numquam illum.', 'Aliquid quia occaecati possimus dolor et cumque.', 1, '547.57', NULL, '-88.841388', '11.931291', '2025-11-20 14:31:41', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(22, 562, 'Omnis magnam nostrum qui totam quia amet.', 'Voluptas odio voluptatem voluptas debitis animi quia aut.', 1, '701.76', NULL, '-3.410188', '76.693198', '2025-07-25 11:31:18', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(23, 563, 'Et saepe deserunt nihil non voluptatem id velit dolorem.', 'Aliquid officiis est quia assumenda.', 1, '259.92', NULL, '-18.211406', '175.872569', '2026-05-28 19:46:33', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(24, 564, 'Consectetur asperiores consequatur quidem in.', 'Excepturi ab voluptatum ut tempora illum.', 1, '126.19', NULL, '75.5554', '-1.177185', '2025-07-22 00:54:37', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(25, 565, 'Est nemo natus expedita et et inventore ab.', 'Dolorum et veniam in quia voluptatem ut.', 1, '683.65', NULL, '88.242107', '-102.287803', '2026-03-26 05:55:26', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(26, 566, 'Enim ipsum aut magnam est.', 'Nam delectus velit voluptatem hic sunt exercitationem.', 1, '966.49', NULL, '-35.221452', '117.965313', '2026-01-03 16:50:46', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(27, 567, 'Assumenda in adipisci quam rem doloremque eos voluptatibus.', 'Non inventore repellat sunt voluptas eaque ea delectus.', 1, '394.87', NULL, '54.529566', '-58.031991', '2025-08-26 02:06:29', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(28, 568, 'Repellendus tempore repellat libero exercitationem.', 'Modi pariatur qui iste.', 1, '925.46', NULL, '15.440575', '73.543625', '2026-02-17 01:54:30', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(29, 569, 'Est ut excepturi eveniet distinctio ipsa amet.', 'Odio reiciendis sunt quos tenetur vitae fuga totam.', 1, '699.1', NULL, '53.859174', '151.942271', '2025-06-09 10:04:17', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(30, 570, 'Corporis et esse unde.', 'Debitis suscipit asperiores molestiae maxime error recusandae iusto.', 1, '71.13', NULL, '-69.772007', '24.759297', '2026-02-17 17:00:08', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(31, 571, 'Impedit aut fugiat consequatur eaque fugiat suscipit dolor.', 'Aperiam blanditiis eos accusantium velit.', 1, '727.6', NULL, '68.219391', '-137.89216', '2026-01-26 17:38:37', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(32, 572, 'Sit impedit dignissimos officiis.', 'Qui aliquid nobis voluptatem magni non quia vel.', 1, '528.53', NULL, '-61.459665', '19.571809', '2026-03-06 08:49:21', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(33, 573, 'Ut eos sunt quo ut et.', 'Ex necessitatibus sed nesciunt distinctio cupiditate cum.', 1, '735.48', NULL, '-71.336192', '-99.531778', '2026-01-10 01:36:57', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(34, 574, 'Commodi beatae quia nihil expedita.', 'Accusantium nobis quaerat nulla ipsa.', 1, '681.73', NULL, '-82.642716', '-173.229178', '2025-10-05 04:17:18', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(35, 575, 'Tempore voluptates explicabo magni quia nostrum et incidunt.', 'Et qui ipsam facere est consequatur eveniet.', 1, '277.37', NULL, '56.949737', '-145.078865', '2026-04-28 22:35:38', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(36, 576, 'Doloribus eum qui quam accusamus delectus magnam enim.', 'Sint officia voluptate vero quibusdam at.', 1, '502.2', NULL, '-70.464719', '110.384671', '2026-03-27 06:27:14', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(37, 577, 'Quia a est provident ut accusantium magni.', 'Voluptas earum eaque asperiores qui repellendus.', 1, '535.65', NULL, '-65.188176', '-117.984848', '2025-06-04 08:54:11', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(38, 578, 'Saepe itaque dolorem vel non.', 'Omnis ex officia exercitationem quasi molestiae magnam quis illo.', 1, '611.03', NULL, '29.283386', '-101.096603', '2025-12-28 10:57:47', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(39, 579, 'Dolor iste facere recusandae facilis ut voluptatem.', 'In nemo et error reprehenderit.', 1, '476.34', NULL, '-7.636679', '28.795248', '2026-04-21 18:39:07', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(40, 580, 'Quo facere alias mollitia.', 'Sunt sapiente sapiente quam voluptatem.', 1, '725.61', NULL, '28.259579', '-80.237156', '2025-06-12 12:57:37', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(41, 581, 'Magnam voluptates et officia sed quos hic quia laudantium.', 'Explicabo delectus et ipsa beatae nemo autem saepe.', 1, '837.07', NULL, '33.042504', '-54.380849', '2025-11-03 22:30:54', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(42, 582, 'In consequatur consequatur in totam placeat illum.', 'Fugiat nisi facere deleniti delectus iste ullam rerum et.', 1, '109.87', NULL, '52.649746', '59.118626', '2026-02-17 11:51:35', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(43, 583, 'A non iure et.', 'Exercitationem ipsum hic sint at.', 1, '244.46', NULL, '84.981379', '6.386943', '2025-11-21 15:34:41', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(44, 584, 'Soluta sunt ad laudantium ut.', 'Dolor ipsum porro quia.', 1, '759.14', NULL, '-80.820687', '166.112229', '2026-05-17 14:18:44', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(45, 585, 'Veritatis quaerat quis qui iste.', 'Tempore porro laboriosam illum amet quaerat sed qui.', 1, '161.78', NULL, '-34.45137', '47.329361', '2025-11-26 01:38:43', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(46, 586, 'Provident molestiae perferendis officia maxime ut blanditiis.', 'Sint quibusdam enim dolores laudantium.', 1, '349.72', NULL, '-77.214981', '115.243976', '2025-07-30 10:45:07', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(47, 587, 'Pariatur non dolor quia et deleniti est.', 'Sint et aut ut et eum veritatis doloremque.', 1, '850.03', NULL, '-58.872584', '174.529687', '2026-05-04 19:53:00', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(48, 588, 'Quidem voluptate dolore accusantium.', 'Est ipsa quia eum est.', 1, '698.01', NULL, '-75.481917', '-58.064981', '2025-10-15 12:41:17', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(49, 589, 'Voluptas dolores hic fugiat reprehenderit qui commodi voluptates.', 'Alias libero quia aut vel optio.', 1, '953.24', NULL, '-64.833264', '-57.434454', '2025-07-02 20:41:29', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(50, 590, 'Ex enim non pariatur ut.', 'Ipsa sit et molestias.', 1, '210.01', NULL, '-64.81773', '6.095372', '2026-04-16 18:26:40', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(51, 591, 'Voluptates aliquam quas atque facere alias facilis assumenda.', 'Voluptatem tempora consectetur non.', 1, '997.48', NULL, '89.909288', '-119.476432', '2026-05-31 22:28:59', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(52, 592, 'Doloribus atque accusamus hic sit commodi.', 'Cupiditate modi et ducimus vitae quia enim suscipit.', 1, '519.27', NULL, '43.269822', '-79.83049', '2025-07-18 03:16:19', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(53, 593, 'Et ratione et culpa facere.', 'Et voluptates totam placeat provident impedit accusamus magni.', 1, '506.75', NULL, '-15.599524', '9.097284', '2026-05-20 18:52:15', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(54, 594, 'Saepe sed aut in est.', 'Quidem expedita alias autem rerum ducimus.', 1, '702.05', NULL, '-78.132681', '81.299766', '2025-12-19 09:57:38', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(55, 595, 'Delectus earum est itaque nostrum omnis officia.', 'Corrupti illo rerum qui aut.', 1, '729.83', NULL, '1.468996', '-50.133993', '2026-04-25 01:56:26', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(56, 596, 'Facere similique et impedit alias mollitia.', 'Quis rem et reiciendis ut porro.', 1, '504.71', NULL, '76.108921', '-42.273968', '2026-03-13 14:46:21', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(57, 597, 'In labore voluptatem cumque enim impedit inventore.', 'Libero laborum deserunt fuga animi ipsam voluptas et.', 1, '244.32', NULL, '-29.639638', '-108.70657', '2026-01-28 07:48:43', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(58, 598, 'Minima magni ratione veniam suscipit eos maxime qui.', 'Ut inventore aut iusto expedita iure dolorum.', 1, '525.63', NULL, '-31.995337', '22.336663', '2025-10-02 03:42:06', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(59, 599, 'Illo provident magnam nihil dolor asperiores.', 'Doloribus est iusto repellat.', 1, '744.24', NULL, '-89.303711', '-114.874496', '2026-02-09 22:28:13', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(60, 600, 'Earum est placeat quod soluta et dolores dolorem voluptate.', 'Et cum illum possimus.', 1, '356', NULL, '-22.013339', '167.361819', '2025-09-21 15:22:09', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(61, 601, 'Est expedita dolorum harum at sunt consequatur.', 'Maxime magni delectus commodi aut non ad.', 1, '199.13', NULL, '30.566955', '176.392915', '2025-11-09 06:30:46', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(62, 602, 'In non quia magnam voluptas aliquam eos placeat.', 'Nobis totam qui vel eveniet.', 1, '253.27', NULL, '35.494694', '172.906969', '2026-01-30 14:06:54', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(63, 603, 'In sint et numquam illum.', 'Quam et pariatur eos eos eum.', 1, '609.81', NULL, '51.243434', '141.525247', '2025-12-22 04:40:26', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(64, 604, 'Consequuntur et vel sint aut perspiciatis.', 'Aperiam officiis ea reprehenderit repudiandae animi.', 1, '890.97', NULL, '61.994597', '-36.728217', '2026-02-08 12:51:30', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(65, 605, 'Officia ullam officia sapiente et non voluptatem quis.', 'Dicta facilis aut libero.', 1, '570.44', NULL, '40.916534', '40.573305', '2025-11-03 11:53:46', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(66, 606, 'Nam laboriosam error sit totam aut quae.', 'Incidunt doloribus qui omnis fuga.', 1, '867.5', NULL, '-82.93723', '45.616051', '2026-02-08 13:16:05', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(67, 607, 'Ut voluptatem sequi quo accusantium non.', 'Aut accusantium repudiandae quia et nostrum quia amet.', 1, '885.66', NULL, '44.83049', '150.162007', '2025-07-23 06:23:23', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(68, 608, 'Dolorem numquam nihil et nobis.', 'Voluptas odit eveniet esse ut.', 1, '644.34', NULL, '-14.239118', '54.989192', '2025-12-27 12:05:54', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(69, 609, 'Vitae perferendis adipisci sapiente eligendi.', 'Voluptatum culpa earum aliquam exercitationem provident sit explicabo.', 1, '55.03', NULL, '23.032317', '-28.758398', '2025-07-29 15:23:13', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(70, 610, 'Eius numquam assumenda nemo beatae ad est.', 'Quo similique molestiae natus totam ut tenetur expedita.', 1, '695.98', NULL, '84.145953', '-37.64927', '2025-07-05 12:42:35', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(71, 611, 'Qui debitis qui et sit voluptates non.', 'Iure aut aspernatur minus voluptatem.', 1, '990.82', NULL, '-63.193122', '-55.481325', '2026-02-08 18:25:58', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(72, 612, 'Et quisquam harum consectetur et ullam esse.', 'Quia sint eum autem voluptatem dolore qui.', 1, '669.15', NULL, '-43.224793', '99.574678', '2025-11-27 07:57:20', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(73, 613, 'Error qui amet nesciunt enim illum.', 'Rerum incidunt ea sed deleniti.', 1, '443.55', NULL, '39.379712', '-128.296168', '2025-12-19 09:00:21', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(74, 614, 'Odio beatae ut quia neque quas nihil nulla.', 'Architecto veniam et temporibus perspiciatis quisquam dolorem.', 1, '609.77', NULL, '-80.049685', '18.116402', '2025-06-20 19:08:58', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(75, 615, 'Facilis vitae unde quis qui odit sed perspiciatis.', 'Accusantium consequuntur ullam voluptas quaerat minima sunt voluptate nulla.', 1, '744.78', NULL, '-55.295501', '-33.320263', '2026-05-02 03:15:00', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(76, 616, 'Omnis non temporibus odit quisquam sint voluptate.', 'Cupiditate dolore aliquam consequatur laboriosam rerum optio fugiat impedit.', 1, '983.36', NULL, '-64.907504', '145.874335', '2025-10-03 14:57:26', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(77, 617, 'Neque sint voluptate tenetur exercitationem iste.', 'Distinctio minima quidem exercitationem et officiis dignissimos.', 1, '163.62', NULL, '80.959341', '-44.222977', '2026-04-07 04:12:21', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(78, 618, 'Est voluptatem iure quisquam laudantium.', 'Id odio eius dolores et explicabo neque rerum.', 1, '290.14', NULL, '-28.792552', '-18.080063', '2025-06-02 09:59:41', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(79, 619, 'In et sunt unde quo omnis reiciendis veniam.', 'Necessitatibus corporis animi perferendis maiores quae.', 1, '877.88', NULL, '-81.513675', '102.52722', '2025-12-15 00:46:37', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(80, 620, 'Fugiat iste sint esse pariatur illum ut.', 'Et error laudantium reprehenderit perferendis tempore ut.', 1, '124.63', NULL, '-71.382351', '-139.140955', '2026-01-13 04:32:22', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(81, 621, 'Nemo quae id ut est ut nihil ut.', 'Ullam illum officia ullam.', 1, '255.21', NULL, '-29.832221', '17.926003', '2026-02-06 03:46:59', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(82, 622, 'Optio reiciendis ut quia deleniti qui libero.', 'Optio aspernatur nesciunt officiis perspiciatis velit.', 1, '518.25', NULL, '-24.186707', '-55.948008', '2026-05-17 01:12:41', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(83, 623, 'Dolorem vitae ea quis.', 'Animi esse ea cumque laboriosam accusamus laboriosam.', 1, '261.82', NULL, '-21.043781', '14.24284', '2025-07-21 21:00:00', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(84, 624, 'Commodi hic qui velit similique cupiditate.', 'Reprehenderit consequatur quas ipsam consequatur.', 1, '228.38', NULL, '34.253881', '157.695996', '2026-03-26 13:47:48', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(85, 625, 'Accusantium eius voluptatum id fugit culpa amet vel.', 'Velit fugit totam dignissimos explicabo.', 1, '825.03', NULL, '-71.22017', '39.502014', '2025-12-25 17:58:12', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(86, 626, 'Ab in magnam quae cupiditate eius sunt.', 'Et repellat vel dicta aliquid dolorum.', 1, '976', NULL, '18.749306', '-10.108606', '2025-12-04 00:29:44', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(87, 627, 'Consequatur modi quia totam.', 'Aut quibusdam rerum tempore ut consectetur.', 1, '321.79', NULL, '88.56486', '33.961728', '2025-08-17 04:36:00', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(88, 628, 'Dolor sequi non dolores culpa.', 'Ut harum consequuntur voluptatem aliquid eligendi perferendis commodi.', 1, '713.47', NULL, '-64.766347', '-48.774194', '2025-08-12 15:32:08', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(89, 629, 'Et sunt dolores molestiae aspernatur.', 'Porro fugiat velit dicta numquam ad vitae.', 1, '933.63', NULL, '2.296794', '-25.329433', '2025-12-18 22:28:54', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(90, 630, 'Id rerum id blanditiis voluptas maiores sint quia beatae.', 'Ipsam ad nihil soluta voluptatibus quis nesciunt.', 1, '876.49', NULL, '-18.421152', '-17.475052', '2026-05-01 21:15:06', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(91, 631, 'Et quibusdam eveniet voluptatibus vel quia voluptatum molestias laboriosam.', 'Voluptate laborum cum debitis est veritatis doloribus.', 1, '632.34', NULL, '-86.707134', '-98.279311', '2025-10-27 13:57:52', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(92, 632, 'Nihil in ea cum et pariatur accusantium harum.', 'Autem et unde et velit accusamus quaerat.', 1, '657.74', NULL, '13.235206', '-13.755862', '2026-03-06 14:00:37', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(93, 633, 'Aut enim maiores molestiae voluptatem placeat.', 'Dolorem ducimus a quia officia tempore corrupti facere.', 1, '704.05', NULL, '-52.844447', '41.270913', '2025-10-18 15:42:13', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(94, 634, 'Autem expedita et expedita illum id sint.', 'Eligendi dignissimos placeat quia deserunt explicabo incidunt vitae.', 1, '139.49', NULL, '4.2721', '-26.405591', '2026-01-01 00:31:18', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(95, 635, 'Quasi non eum qui corrupti accusantium optio et.', 'Tenetur ullam molestiae dolore.', 1, '923.57', NULL, '-71.746237', '177.950186', '2025-12-18 13:11:14', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(96, 636, 'Nam non ex quam tenetur est neque id.', 'Aut enim qui iste corrupti atque laboriosam ipsa.', 1, '562.39', NULL, '-38.326515', '-128.22216', '2025-07-30 10:22:45', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(97, 637, 'Enim et in expedita harum.', 'Aliquid ipsa occaecati itaque rerum.', 1, '573.62', NULL, '-87.747049', '97.924304', '2026-02-20 07:03:33', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(98, 638, 'Nesciunt quo qui alias dolorem sequi consequatur.', 'Dolorem ut quae aperiam earum.', 1, '136.93', NULL, '82.293496', '-134.218696', '2025-07-31 06:35:53', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(99, 639, 'Rerum dolorem laboriosam veritatis quaerat facere ratione.', 'Unde nesciunt dolorem vel earum vitae est perspiciatis.', 1, '421.68', NULL, '-80.63873', '-118.985055', '2025-11-15 10:37:39', '2025-06-01 11:29:10', '2025-06-01 11:29:10'),
(100, 640, 'Sint aut inventore quis nulla.', 'Aut commodi odit sint praesentium corporis quaerat non.', 1, '378.57', NULL, '-44.132507', '-174.273366', '2026-02-17 14:13:40', '2025-06-01 11:29:10', '2025-06-01 11:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint NOT NULL COMMENT '0: gigs, 1: announces, 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"amet\",\"ar\":\"alias\"}', 1, 2, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(2, '{\"en\":\"numquam\",\"ar\":\"voluptatem\"}', 1, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(3, '{\"en\":\"cumque\",\"ar\":\"laborum\"}', 1, 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(4, '{\"en\":\"aut\",\"ar\":\"quasi\"}', 1, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(5, '{\"en\":\"adipisci\",\"ar\":\"totam\"}', 0, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(6, '{\"en\":\"ad\",\"ar\":\"et\"}', 1, 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(7, '{\"en\":\"et\",\"ar\":\"fugiat\"}', 0, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(8, '{\"en\":\"est\",\"ar\":\"sunt\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(9, '{\"en\":\"sed\",\"ar\":\"dolore\"}', 1, 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(10, '{\"en\":\"error\",\"ar\":\"placeat\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(11, '{\"en\":\"dolores\",\"ar\":\"voluptas\"}', 0, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(12, '{\"en\":\"molestias\",\"ar\":\"reiciendis\"}', 1, 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(13, '{\"en\":\"et\",\"ar\":\"laudantium\"}', 0, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(14, '{\"en\":\"in\",\"ar\":\"voluptatibus\"}', 1, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(15, '{\"en\":\"eum\",\"ar\":\"et\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(16, '{\"en\":\"modi\",\"ar\":\"eum\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(17, '{\"en\":\"aut\",\"ar\":\"ut\"}', 0, 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(18, '{\"en\":\"nulla\",\"ar\":\"asperiores\"}', 1, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(19, '{\"en\":\"enim\",\"ar\":\"laborum\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(20, '{\"en\":\"occaecati\",\"ar\":\"hic\"}', 1, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(21, '{\"en\":\"voluptatem\",\"ar\":\"et\"}', 1, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(22, '{\"en\":\"consequatur\",\"ar\":\"et\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(23, '{\"en\":\"voluptatem\",\"ar\":\"provident\"}', 1, 2, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(24, '{\"en\":\"error\",\"ar\":\"reprehenderit\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(25, '{\"en\":\"sequi\",\"ar\":\"ex\"}', 1, 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(26, '{\"en\":\"culpa\",\"ar\":\"nihil\"}', 1, 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(27, '{\"en\":\"ab\",\"ar\":\"pariatur\"}', 0, 2, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(28, '{\"en\":\"ipsum\",\"ar\":\"aliquid\"}', 1, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(29, '{\"en\":\"sequi\",\"ar\":\"sed\"}', 0, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(30, '{\"en\":\"tenetur\",\"ar\":\"qui\"}', 0, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(31, '{\"en\":\"ex\",\"ar\":\"eveniet\"}', 1, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(32, '{\"en\":\"consequatur\",\"ar\":\"ea\"}', 1, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(33, '{\"en\":\"repellat\",\"ar\":\"eum\"}', 1, 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(34, '{\"en\":\"dignissimos\",\"ar\":\"eos\"}', 1, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(35, '{\"en\":\"voluptatem\",\"ar\":\"qui\"}', 0, 2, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(36, '{\"en\":\"beatae\",\"ar\":\"voluptas\"}', 1, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(37, '{\"en\":\"quam\",\"ar\":\"animi\"}', 1, 2, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(38, '{\"en\":\"magnam\",\"ar\":\"ut\"}', 1, 2, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(39, '{\"en\":\"sint\",\"ar\":\"quaerat\"}', 1, 2, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(40, '{\"en\":\"aut\",\"ar\":\"eius\"}', 1, 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(41, '{\"en\":\"qui\",\"ar\":\"eaque\"}', 1, 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(42, '{\"en\":\"aut\",\"ar\":\"minima\"}', 1, 2, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(43, '{\"en\":\"rem\",\"ar\":\"corrupti\"}', 1, 2, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(44, '{\"en\":\"nesciunt\",\"ar\":\"eveniet\"}', 1, 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(45, '{\"en\":\"aut\",\"ar\":\"et\"}', 0, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(46, '{\"en\":\"dolor\",\"ar\":\"odit\"}', 0, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(47, '{\"en\":\"numquam\",\"ar\":\"sit\"}', 0, 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(48, '{\"en\":\"sunt\",\"ar\":\"quibusdam\"}', 1, 2, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(49, '{\"en\":\"est\",\"ar\":\"quia\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(50, '{\"en\":\"facilis\",\"ar\":\"voluptatem\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(51, '{\"en\":\"quidem\",\"ar\":\"ea\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(52, '{\"en\":\"soluta\",\"ar\":\"atque\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(53, '{\"en\":\"est\",\"ar\":\"pariatur\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(54, '{\"en\":\"labore\",\"ar\":\"accusantium\"}', 1, 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(55, '{\"en\":\"facere\",\"ar\":\"quod\"}', 1, 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(56, '{\"en\":\"voluptas\",\"ar\":\"similique\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(57, '{\"en\":\"ipsa\",\"ar\":\"voluptatum\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(58, '{\"en\":\"quia\",\"ar\":\"natus\"}', 0, 2, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(59, '{\"en\":\"ut\",\"ar\":\"aspernatur\"}', 1, 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(60, '{\"en\":\"consectetur\",\"ar\":\"repellat\"}', 1, 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(61, '{\"en\":\"commodi\",\"ar\":\"ex\"}', 0, 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(62, '{\"en\":\"explicabo\",\"ar\":\"non\"}', 1, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(63, '{\"en\":\"in\",\"ar\":\"sed\"}', 1, 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(64, '{\"en\":\"cumque\",\"ar\":\"et\"}', 1, 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(65, '{\"en\":\"deleniti\",\"ar\":\"deserunt\"}', 1, 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(66, '{\"en\":\"nesciunt\",\"ar\":\"magni\"}', 1, 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(67, '{\"en\":\"eum\",\"ar\":\"natus\"}', 1, 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(68, '{\"en\":\"totam\",\"ar\":\"omnis\"}', 1, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(69, '{\"en\":\"sed\",\"ar\":\"magnam\"}', 1, 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(70, '{\"en\":\"cumque\",\"ar\":\"qui\"}', 1, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(71, '{\"en\":\"dolorum\",\"ar\":\"voluptas\"}', 1, 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(72, '{\"en\":\"quae\",\"ar\":\"necessitatibus\"}', 1, 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(73, '{\"en\":\"aut\",\"ar\":\"quasi\"}', 1, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(74, '{\"en\":\"rerum\",\"ar\":\"exercitationem\"}', 0, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(75, '{\"en\":\"maxime\",\"ar\":\"reprehenderit\"}', 1, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(76, '{\"en\":\"magni\",\"ar\":\"minus\"}', 1, 2, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(77, '{\"en\":\"eligendi\",\"ar\":\"quaerat\"}', 1, 1, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(78, '{\"en\":\"dolorem\",\"ar\":\"delectus\"}', 1, 1, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(79, '{\"en\":\"quo\",\"ar\":\"illum\"}', 1, 0, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(80, '{\"en\":\"consectetur\",\"ar\":\"quis\"}', 0, 1, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(81, '{\"en\":\"odit\",\"ar\":\"adipisci\"}', 1, 2, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(82, '{\"en\":\"voluptate\",\"ar\":\"quo\"}', 0, 1, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(83, '{\"en\":\"ut\",\"ar\":\"nesciunt\"}', 1, 1, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(84, '{\"en\":\"est\",\"ar\":\"nihil\"}', 0, 1, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(85, '{\"en\":\"ut\",\"ar\":\"ut\"}', 1, 0, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(86, '{\"en\":\"voluptatem\",\"ar\":\"nisi\"}', 0, 0, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(87, '{\"en\":\"eum\",\"ar\":\"fuga\"}', 1, 1, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(88, '{\"en\":\"autem\",\"ar\":\"aperiam\"}', 1, 2, '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(89, '{\"en\":\"ut\",\"ar\":\"quo\"}', 1, 2, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(90, '{\"en\":\"laborum\",\"ar\":\"laborum\"}', 0, 2, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(91, '{\"en\":\"alias\",\"ar\":\"rerum\"}', 0, 2, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(92, '{\"en\":\"et\",\"ar\":\"et\"}', 1, 2, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(93, '{\"en\":\"veniam\",\"ar\":\"hic\"}', 1, 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(94, '{\"en\":\"laboriosam\",\"ar\":\"consequatur\"}', 1, 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(95, '{\"en\":\"dolore\",\"ar\":\"ex\"}', 1, 2, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(96, '{\"en\":\"quia\",\"ar\":\"quam\"}', 1, 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(97, '{\"en\":\"aperiam\",\"ar\":\"et\"}', 1, 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(98, '{\"en\":\"aperiam\",\"ar\":\"deserunt\"}', 1, 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(99, '{\"en\":\"debitis\",\"ar\":\"vel\"}', 0, 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(100, '{\"en\":\"culpa\",\"ar\":\"non\"}', 1, 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(101, '{\"en\":\"eos\",\"ar\":\"ut\"}', 1, 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(102, '{\"en\":\"corporis\",\"ar\":\"ratione\"}', 1, 2, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(103, '{\"en\":\"quas\",\"ar\":\"temporibus\"}', 0, 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(104, '{\"en\":\"nihil\",\"ar\":\"assumenda\"}', 0, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(105, '{\"en\":\"odio\",\"ar\":\"accusantium\"}', 1, 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(106, '{\"en\":\"quos\",\"ar\":\"animi\"}', 1, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(107, '{\"en\":\"illo\",\"ar\":\"magnam\"}', 0, 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(108, '{\"en\":\"expedita\",\"ar\":\"aperiam\"}', 1, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(109, '{\"en\":\"nemo\",\"ar\":\"in\"}', 0, 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(110, '{\"en\":\"ut\",\"ar\":\"impedit\"}', 1, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(111, '{\"en\":\"magnam\",\"ar\":\"sapiente\"}', 1, 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(112, '{\"en\":\"consectetur\",\"ar\":\"earum\"}', 1, 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(113, '{\"en\":\"quis\",\"ar\":\"totam\"}', 0, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(114, '{\"en\":\"ea\",\"ar\":\"cupiditate\"}', 0, 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(115, '{\"en\":\"doloremque\",\"ar\":\"sint\"}', 0, 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(116, '{\"en\":\"debitis\",\"ar\":\"harum\"}', 0, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(117, '{\"en\":\"aut\",\"ar\":\"impedit\"}', 1, 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(118, '{\"en\":\"atque\",\"ar\":\"perspiciatis\"}', 1, 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(119, '{\"en\":\"fuga\",\"ar\":\"enim\"}', 1, 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(120, '{\"en\":\"et\",\"ar\":\"sequi\"}', 1, 2, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(121, '{\"en\":\"aut\",\"ar\":\"excepturi\"}', 0, 2, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(122, '{\"en\":\"eaque\",\"ar\":\"sit\"}', 1, 2, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(123, '{\"en\":\"nihil\",\"ar\":\"ad\"}', 1, 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(124, '{\"en\":\"inventore\",\"ar\":\"eum\"}', 1, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(125, '{\"en\":\"est\",\"ar\":\"velit\"}', 1, 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(126, '{\"en\":\"ea\",\"ar\":\"est\"}', 1, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(127, '{\"en\":\"et\",\"ar\":\"quidem\"}', 0, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(128, '{\"en\":\"quis\",\"ar\":\"ea\"}', 1, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(129, '{\"en\":\"ipsa\",\"ar\":\"quae\"}', 1, 2, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(130, '{\"en\":\"occaecati\",\"ar\":\"nesciunt\"}', 1, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(131, '{\"en\":\"perferendis\",\"ar\":\"fugit\"}', 1, 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(132, '{\"en\":\"dolorem\",\"ar\":\"voluptate\"}', 1, 2, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(133, '{\"en\":\"dolor\",\"ar\":\"id\"}', 0, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(134, '{\"en\":\"qui\",\"ar\":\"libero\"}', 1, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(135, '{\"en\":\"magnam\",\"ar\":\"quis\"}', 1, 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(136, '{\"en\":\"ut\",\"ar\":\"sint\"}', 0, 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(137, '{\"en\":\"quae\",\"ar\":\"quaerat\"}', 1, 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(138, '{\"en\":\"aliquam\",\"ar\":\"quis\"}', 1, 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(139, '{\"en\":\"consequatur\",\"ar\":\"facere\"}', 1, 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(140, '{\"en\":\"enim\",\"ar\":\"vel\"}', 0, 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(141, '{\"en\":\"itaque\",\"ar\":\"quidem\"}', 1, 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(142, '{\"en\":\"cumque\",\"ar\":\"tempore\"}', 1, 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(143, '{\"en\":\"quia\",\"ar\":\"doloribus\"}', 1, 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(144, '{\"en\":\"recusandae\",\"ar\":\"accusantium\"}', 1, 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(145, '{\"en\":\"et\",\"ar\":\"commodi\"}', 1, 2, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(146, '{\"en\":\"libero\",\"ar\":\"fugit\"}', 1, 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(147, '{\"en\":\"maxime\",\"ar\":\"id\"}', 1, 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(148, '{\"en\":\"delectus\",\"ar\":\"et\"}', 1, 2, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(149, '{\"en\":\"sit\",\"ar\":\"tempore\"}', 1, 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(150, '{\"en\":\"repudiandae\",\"ar\":\"et\"}', 1, 2, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(151, '{\"en\":\"necessitatibus\",\"ar\":\"dolorem\"}', 1, 2, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(152, '{\"en\":\"suscipit\",\"ar\":\"pariatur\"}', 1, 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(153, '{\"en\":\"corrupti\",\"ar\":\"sed\"}', 1, 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(154, '{\"en\":\"sint\",\"ar\":\"assumenda\"}', 1, 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(155, '{\"en\":\"in\",\"ar\":\"est\"}', 1, 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(156, '{\"en\":\"ad\",\"ar\":\"aut\"}', 0, 2, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(157, '{\"en\":\"nisi\",\"ar\":\"est\"}', 0, 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(158, '{\"en\":\"voluptatem\",\"ar\":\"quia\"}', 1, 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(159, '{\"en\":\"est\",\"ar\":\"quis\"}', 1, 2, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(160, '{\"en\":\"voluptatem\",\"ar\":\"voluptatum\"}', 0, 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(161, '{\"en\":\"doloremque\",\"ar\":\"fuga\"}', 0, 2, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(162, '{\"en\":\"quam\",\"ar\":\"animi\"}', 1, 2, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(163, '{\"en\":\"eos\",\"ar\":\"omnis\"}', 1, 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(164, '{\"en\":\"explicabo\",\"ar\":\"commodi\"}', 1, 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(165, '{\"en\":\"aut\",\"ar\":\"animi\"}', 1, 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(166, '{\"en\":\"provident\",\"ar\":\"similique\"}', 1, 2, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(167, '{\"en\":\"laboriosam\",\"ar\":\"autem\"}', 1, 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(168, '{\"en\":\"eum\",\"ar\":\"quis\"}', 1, 2, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(169, '{\"en\":\"amet\",\"ar\":\"enim\"}', 0, 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(170, '{\"en\":\"facere\",\"ar\":\"quis\"}', 1, 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(171, '{\"en\":\"quis\",\"ar\":\"porro\"}', 1, 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(172, '{\"en\":\"quo\",\"ar\":\"fuga\"}', 1, 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(173, '{\"en\":\"magnam\",\"ar\":\"magnam\"}', 0, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(174, '{\"en\":\"voluptas\",\"ar\":\"quis\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(175, '{\"en\":\"est\",\"ar\":\"sapiente\"}', 1, 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(176, '{\"en\":\"laborum\",\"ar\":\"quia\"}', 0, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(177, '{\"en\":\"ut\",\"ar\":\"occaecati\"}', 1, 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(178, '{\"en\":\"veniam\",\"ar\":\"sed\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(179, '{\"en\":\"earum\",\"ar\":\"est\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(180, '{\"en\":\"perferendis\",\"ar\":\"quia\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(181, '{\"en\":\"quisquam\",\"ar\":\"ut\"}', 0, 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(182, '{\"en\":\"quaerat\",\"ar\":\"voluptatem\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(183, '{\"en\":\"molestias\",\"ar\":\"dolor\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(184, '{\"en\":\"occaecati\",\"ar\":\"est\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(185, '{\"en\":\"vel\",\"ar\":\"omnis\"}', 1, 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(186, '{\"en\":\"saepe\",\"ar\":\"dolor\"}', 1, 2, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(187, '{\"en\":\"ut\",\"ar\":\"eum\"}', 1, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(188, '{\"en\":\"rerum\",\"ar\":\"quasi\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(189, '{\"en\":\"repellendus\",\"ar\":\"commodi\"}', 0, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(190, '{\"en\":\"enim\",\"ar\":\"incidunt\"}', 1, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(191, '{\"en\":\"et\",\"ar\":\"repudiandae\"}', 1, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(192, '{\"en\":\"ratione\",\"ar\":\"aspernatur\"}', 0, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(193, '{\"en\":\"quam\",\"ar\":\"ut\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(194, '{\"en\":\"officia\",\"ar\":\"nulla\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(195, '{\"en\":\"rerum\",\"ar\":\"quasi\"}', 0, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(196, '{\"en\":\"ex\",\"ar\":\"voluptatum\"}', 1, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(197, '{\"en\":\"aut\",\"ar\":\"nam\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(198, '{\"en\":\"sed\",\"ar\":\"ipsa\"}', 0, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(199, '{\"en\":\"dicta\",\"ar\":\"dolorum\"}', 1, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(200, '{\"en\":\"est\",\"ar\":\"non\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(201, '{\"en\":\"magni\",\"ar\":\"quos\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(202, '{\"en\":\"esse\",\"ar\":\"quaerat\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(203, '{\"en\":\"cumque\",\"ar\":\"earum\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(204, '{\"en\":\"officia\",\"ar\":\"consequatur\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(205, '{\"en\":\"eum\",\"ar\":\"voluptate\"}', 0, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(206, '{\"en\":\"aut\",\"ar\":\"odit\"}', 0, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(207, '{\"en\":\"sint\",\"ar\":\"unde\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(208, '{\"en\":\"unde\",\"ar\":\"voluptatem\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(209, '{\"en\":\"est\",\"ar\":\"accusamus\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(210, '{\"en\":\"totam\",\"ar\":\"vel\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(211, '{\"en\":\"et\",\"ar\":\"occaecati\"}', 0, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(212, '{\"en\":\"neque\",\"ar\":\"enim\"}', 0, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(213, '{\"en\":\"similique\",\"ar\":\"et\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(214, '{\"en\":\"incidunt\",\"ar\":\"adipisci\"}', 1, 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(215, '{\"en\":\"dolor\",\"ar\":\"velit\"}', 1, 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(216, '{\"en\":\"omnis\",\"ar\":\"voluptate\"}', 1, 2, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(217, '{\"en\":\"odio\",\"ar\":\"officiis\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(218, '{\"en\":\"at\",\"ar\":\"placeat\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(219, '{\"en\":\"rem\",\"ar\":\"ut\"}', 0, 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(220, '{\"en\":\"voluptatem\",\"ar\":\"odit\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(221, '{\"en\":\"ullam\",\"ar\":\"dicta\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(222, '{\"en\":\"at\",\"ar\":\"voluptas\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(223, '{\"en\":\"vero\",\"ar\":\"sit\"}', 0, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(224, '{\"en\":\"dolor\",\"ar\":\"doloribus\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(225, '{\"en\":\"dignissimos\",\"ar\":\"recusandae\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(226, '{\"en\":\"recusandae\",\"ar\":\"et\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(227, '{\"en\":\"architecto\",\"ar\":\"laborum\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(228, '{\"en\":\"ex\",\"ar\":\"aut\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(229, '{\"en\":\"et\",\"ar\":\"aut\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(230, '{\"en\":\"facere\",\"ar\":\"vel\"}', 1, 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(231, '{\"en\":\"cupiditate\",\"ar\":\"eligendi\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(232, '{\"en\":\"rerum\",\"ar\":\"vitae\"}', 1, 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(233, '{\"en\":\"totam\",\"ar\":\"quo\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(234, '{\"en\":\"blanditiis\",\"ar\":\"voluptatem\"}', 1, 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(235, '{\"en\":\"optio\",\"ar\":\"nulla\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(236, '{\"en\":\"corrupti\",\"ar\":\"itaque\"}', 1, 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(237, '{\"en\":\"voluptas\",\"ar\":\"ut\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(238, '{\"en\":\"recusandae\",\"ar\":\"autem\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(239, '{\"en\":\"odio\",\"ar\":\"necessitatibus\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(240, '{\"en\":\"sunt\",\"ar\":\"libero\"}', 1, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(241, '{\"en\":\"voluptatem\",\"ar\":\"assumenda\"}', 0, 2, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(242, '{\"en\":\"repudiandae\",\"ar\":\"ut\"}', 0, 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(243, '{\"en\":\"ut\",\"ar\":\"enim\"}', 1, 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(244, '{\"en\":\"voluptas\",\"ar\":\"nobis\"}', 1, 2, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(245, '{\"en\":\"aperiam\",\"ar\":\"quibusdam\"}', 0, 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(246, '{\"en\":\"in\",\"ar\":\"nemo\"}', 0, 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(247, '{\"en\":\"perferendis\",\"ar\":\"error\"}', 1, 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(248, '{\"en\":\"sed\",\"ar\":\"expedita\"}', 1, 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(249, '{\"en\":\"nobis\",\"ar\":\"enim\"}', 1, 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(250, '{\"en\":\"asperiores\",\"ar\":\"omnis\"}', 1, 1, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(251, '{\"en\":\"deleniti\",\"ar\":\"exercitationem\"}', 0, 2, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(252, '{\"en\":\"repellat\",\"ar\":\"sit\"}', 1, 2, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(253, '{\"en\":\"qui\",\"ar\":\"eaque\"}', 1, 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(254, '{\"en\":\"sit\",\"ar\":\"nam\"}', 1, 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(255, '{\"en\":\"accusantium\",\"ar\":\"quia\"}', 1, 1, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(256, '{\"en\":\"fugit\",\"ar\":\"nemo\"}', 1, 2, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(257, '{\"en\":\"voluptate\",\"ar\":\"quo\"}', 1, 2, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(258, '{\"en\":\"est\",\"ar\":\"quidem\"}', 1, 2, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(259, '{\"en\":\"blanditiis\",\"ar\":\"dolores\"}', 1, 2, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(260, '{\"en\":\"qui\",\"ar\":\"dicta\"}', 1, 2, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(261, '{\"en\":\"aut\",\"ar\":\"assumenda\"}', 1, 0, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(262, '{\"en\":\"aperiam\",\"ar\":\"voluptatibus\"}', 1, 0, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(263, '{\"en\":\"omnis\",\"ar\":\"in\"}', 1, 2, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(264, '{\"en\":\"magnam\",\"ar\":\"non\"}', 1, 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(265, '{\"en\":\"eum\",\"ar\":\"recusandae\"}', 1, 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(266, '{\"en\":\"labore\",\"ar\":\"aliquid\"}', 1, 0, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(267, '{\"en\":\"rerum\",\"ar\":\"praesentium\"}', 0, 2, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(268, '{\"en\":\"tenetur\",\"ar\":\"dolor\"}', 1, 0, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(269, '{\"en\":\"reiciendis\",\"ar\":\"porro\"}', 0, 0, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(270, '{\"en\":\"aut\",\"ar\":\"ut\"}', 0, 2, '2025-06-01 11:28:59', '2025-06-01 11:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_comment_id` bigint UNSIGNED DEFAULT NULL,
  `post_reply_id` bigint UNSIGNED DEFAULT NULL,
  `reply` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`id`, `user_id`, `post_comment_id`, `post_reply_id`, `reply`, `created_at`, `updated_at`) VALUES
(1, 511, 11, 1, 'Consequatur quo dolorem consequatur.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(2, 514, 12, 1, 'Quia inventore velit tempore laborum impedit voluptatem magnam.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(3, 517, 13, 1, 'Dolore officiis quo rerum.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(4, 520, 14, 1, 'Aliquam dolor vel iste voluptatem alias et.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(5, 523, 15, 1, 'Sunt voluptate numquam laboriosam dolorem.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(6, 526, 16, 1, 'Aut vero quia suscipit nesciunt aspernatur.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(7, 529, 17, 1, 'Voluptas quo neque nisi corrupti aspernatur.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(8, 532, 18, 1, 'Sit maxime iste a nulla quas reprehenderit quasi.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(9, 535, 19, 1, 'Quos aut necessitatibus velit sit voluptatum sapiente.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(10, 538, 20, 1, 'Voluptas enim reiciendis et.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(11, 642, 16, NULL, '@Hilton Mueller III', '2025-06-02 06:33:14', '2025-06-02 06:33:14'),
(12, 642, 16, NULL, '@Hilton Mueller III', '2025-06-02 06:33:20', '2025-06-02 06:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('complaints','advertisement') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `subject`, `message`, `user_id`, `phone`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Similique error tempore repellendus numquam dolores.', 'Rerum perferendis soluta sed fugiat qui. Aut eum vel ducimus consequatur porro distinctio. Ex ut ea dolor quasi et. Consequatur laudantium ex vero qui ullam molestiae. At dolorem ut officiis.', NULL, '1-520-291-4340', 'advertisement', 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(2, 'Mollitia autem possimus aut in.', 'Quis quaerat veniam aliquid deserunt ut. Ut animi eos magni dolores. Sapiente est doloribus quia ea commodi laborum ullam. Beatae beatae a est dolores laudantium odio.', NULL, '+15096333049', 'complaints', 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(3, 'Dolorem fugiat pariatur quod adipisci.', 'Quo quas molestiae quos adipisci. Vitae sit iusto et accusamus nisi. Occaecati rerum ea iste voluptatibus illo tempora voluptatibus.', NULL, '+16076279199', 'advertisement', 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(4, 'Magnam molestiae beatae est qui dignissimos non.', 'Magni sunt ipsam quis et. Hic dolorem ex ullam quis et sit.', NULL, '1-312-318-4622', 'complaints', 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(5, 'Adipisci accusantium porro officia.', 'Laboriosam est sed ea tempora est est. Minus rerum suscipit beatae odit repellendus eveniet tempore laudantium.', NULL, '760-883-8573', 'advertisement', 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(6, 'Consectetur impedit nisi vel nostrum.', 'Quas voluptatem sed rerum ex nostrum et veniam. Quis minus quos perspiciatis et. Sed ut maiores tenetur voluptatibus omnis atque optio. Nihil nihil dignissimos perferendis dolorem ut voluptate et.', NULL, '1-630-524-7440', 'advertisement', 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(7, 'Voluptatum sequi iure rerum id.', 'Qui omnis placeat sit amet iusto ipsam. Eos natus voluptas eum voluptatem amet quod quia et. Dicta quo deserunt dicta totam asperiores.', NULL, '+1-734-249-3786', 'advertisement', 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(8, 'Qui ab occaecati aliquid dolor occaecati rerum.', 'Sit dolore ea eligendi molestiae consectetur sunt. Consequatur minus ut eveniet et iure architecto maiores. Praesentium accusamus recusandae voluptates ducimus. Odio magni debitis quidem placeat molestiae quia omnis.', NULL, '+1 (775) 722-02', 'complaints', 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(9, 'Aut et consequatur officiis ea aut.', 'Id sequi est vero est sed. Ex modi dolorem aliquid veritatis cumque accusamus.', NULL, '+1 (304) 714-79', 'advertisement', 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(10, 'Odit quis aut et fugiat atque.', 'Neque dolorem et rem esse. Suscipit qui fugit impedit dolor dolores similique ea. Ut nisi ipsa sit earum sed. Quo voluptas explicabo tempore sit repudiandae consequatur maxime.', NULL, '279-524-6457', 'advertisement', 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'Argentina', 'USD', '2025-06-01 12:57:34', '2025-06-01 12:57:34'),
(2, 'Egypt', 'EGP', '2025-06-01 12:57:41', '2025-06-01 12:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `device_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` enum('android','ios') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'android',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_tokens`
--

INSERT INTO `device_tokens` (`id`, `user_id`, `device_token`, `device_type`, `created_at`, `updated_at`) VALUES
(2, 1, 'f7bttjncRPGQcpqS9F8ZLl:APA91bHA18zMikR2qSmCvTNKc1KuSpA58Dat9ehu2RzD8X4l1qvRiK2k6VQiz_HmNzlgU04WUwOGwLSFD4g-4hz_zE-hQgko3rPvrOuHJCnf3G6V3eKrIM8', 'android', '2025-06-02 09:29:27', '2025-06-02 09:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `dirty_words`
--

CREATE TABLE `dirty_words` (
  `id` bigint UNSIGNED NOT NULL,
  `word` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dirty_words`
--

INSERT INTO `dirty_words` (`id`, `word`, `created_at`, `updated_at`) VALUES
(1, 'الاهلي', '2025-06-01 13:41:11', '2025-06-01 13:41:11'),
(2, 'امام', '2025-06-01 13:55:40', '2025-06-01 13:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `is_end` tinyint(1) NOT NULL DEFAULT '0',
  `event_limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `category_id`, `title`, `description`, `from`, `to`, `location`, `lat`, `long`, `is_public`, `is_free`, `is_end`, `event_limit`, `event_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 271, 81, 'Est hic iure consequatur.', 'Quam exercitationem reiciendis vero. Sunt sunt eum non ut iure illo sit. Aperiam vel voluptas velit. In nesciunt aliquid et ipsum sapiente hic eum.', '2008-07-16 00:00:00', '1988-04-19 00:00:00', '2037 Nienow Walk\nPort Enola, MT 00563-1960', '-39.407693', '131.306765', 0, 0, 0, '84', '48.06', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(2, 272, 82, 'Dicta maxime et qui officia.', 'Distinctio sit dolores in in ipsa ut. Ad aut dignissimos sed ad. Sapiente quaerat laborum et eum commodi hic at.', '1989-07-04 00:00:00', '1979-11-09 00:00:00', '355 Sporer Center Suite 052\nEast Francesco, VA 97608', '70.102947', '141.451962', 1, 0, 1, '1', '41.04', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(3, 273, 83, 'Velit similique debitis corporis voluptatem alias qui.', 'Doloribus distinctio dolores laboriosam laudantium et repellendus. Delectus eligendi eveniet adipisci id doloribus culpa eaque. Est consectetur rem quo earum voluptatem dicta. Quia fugit voluptatibus repellendus rerum id ratione molestiae odit.', '2006-05-05 00:00:00', '1976-12-25 00:00:00', '271 Beatty Inlet Suite 499\nEast Oran, NE 21196', '12.577574', '-96.876906', 0, 0, 0, '12', '12.23', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(4, 274, 84, 'Voluptatem aut in dolorum aut iure est expedita.', 'Molestiae voluptatum dicta accusantium et eligendi eos voluptas. Inventore earum est qui placeat distinctio placeat ad. Occaecati eius voluptates delectus voluptatibus quo.', '2022-08-16 00:00:00', '2021-02-22 00:00:00', '2540 Schulist Knoll Suite 317\nHettingerport, MS 96992', '53.048908', '14.832254', 0, 1, 0, '0', '52.61', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(5, 275, 85, 'Sint eum assumenda nam aspernatur.', 'Voluptatibus quos autem quam autem repellat ea labore. Dolore quidem dolor ipsa totam deleniti occaecati laborum. Sapiente dolor similique et commodi vel laudantium. Et dolorem ut sed non alias laboriosam ut.', '2000-09-11 00:00:00', '1997-12-13 00:00:00', '71294 Gibson Harbor\nNew Alycia, NH 03441-6500', '88.989945', '-175.917415', 0, 1, 1, '72', '23.41', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(6, 276, 86, 'Tempore dolores natus unde.', 'Dolor quis qui consequatur quo praesentium. Eum alias ut ab. Ipsa ut id temporibus voluptate placeat veritatis. Qui quis corrupti quia officia a voluptate blanditiis.', '2011-04-04 00:00:00', '1999-10-01 00:00:00', '85057 Bayer Station Apt. 604\nPort Brendan, KS 97924-0126', '31.521', '104.11558', 0, 0, 1, '25', '77.06', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(7, 277, 87, 'Quibusdam libero sint pariatur ea maiores voluptatum.', 'Doloribus quaerat ut ipsa iure tempore excepturi quia. Et quidem aliquam aut aut. Eum enim totam labore alias ut minus et repudiandae.', '1980-09-28 00:00:00', '1982-08-23 00:00:00', '9702 Asa Brooks Suite 131\nEast Katarina, HI 13756-8388', '18.32473', '13.163103', 0, 1, 1, '64', '82.55', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(8, 278, 88, 'Omnis totam ut et quas.', 'Qui magni rem fugit vel quia ex et. Omnis minima omnis fuga beatae sit enim modi. Commodi eveniet natus ad rem cumque et.', '2025-04-28 00:00:00', '1973-11-05 00:00:00', '419 Rahsaan Drive\nGunnerland, MS 35778-9767', '32.878571', '-148.764788', 1, 0, 0, '25', '28.12', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(9, 279, 89, 'Unde et et ea dicta totam.', 'Eius nobis blanditiis excepturi qui in dolorum sint odio. Tenetur eveniet omnis praesentium sapiente quidem. Quo vel similique quidem possimus.', '1972-08-09 00:00:00', '2022-06-24 00:00:00', '442 Micah Throughway\nEast Wilhelmland, VT 27726-0794', '30.340285', '127.514351', 0, 0, 1, '31', '72.28', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(10, 280, 90, 'Aperiam inventore ut alias quos autem.', 'In accusamus maxime possimus similique non et. Rem nihil sed eius. Molestiae iusto modi odit quas et. Omnis beatae eum sunt.', '1983-06-06 00:00:00', '1983-02-27 00:00:00', '71777 Keebler Loop\nPacochaport, TN 32882', '-58.393264', '-52.509854', 0, 1, 1, '3', '97.13', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(11, 282, 91, 'Quis qui sapiente libero enim.', 'Quo dolorum vero est doloribus accusamus cupiditate consequatur. Est nulla tempore quaerat aliquid rerum fugiat. Aut et est pariatur deserunt voluptatum.', '1987-05-23 00:00:00', '1999-03-16 00:00:00', '960 Priscilla Summit Apt. 303\nMarksbury, OH 85718-3880', '70.217474', '26.664731', 1, 0, 0, '0', '27.68', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(12, 283, 92, 'Est fugiat ducimus earum delectus necessitatibus excepturi nisi.', 'Alias iste vero voluptate illum mollitia voluptates. Voluptas omnis sunt repellat rerum ut blanditiis autem ut. Dolorem aliquam ab praesentium nemo omnis. Corporis impedit ut eos voluptatum distinctio.', '1999-09-26 00:00:00', '1993-11-01 00:00:00', '5531 Marshall Center Apt. 217\nLillyhaven, WY 42696-4764', '0.553118', '-87.767709', 0, 1, 0, '52', '40.87', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(13, 285, 94, 'Aut quia libero consequatur optio.', 'Provident ex asperiores dolor facere. Et sit provident enim necessitatibus. Exercitationem possimus ut ut quia reiciendis debitis.', '2006-03-10 00:00:00', '2009-01-03 00:00:00', '58784 Rhea Pass\nLake Gudrun, AR 72104-3404', '56.358196', '172.779992', 1, 1, 0, '44', '39.49', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(14, 286, 95, 'Velit minus commodi enim adipisci impedit.', 'Corrupti et aut veniam illum molestiae voluptatem voluptatibus aut. Illo totam explicabo placeat accusantium maiores aliquam. Tempora perspiciatis praesentium accusantium explicabo corporis alias. Blanditiis ipsam nulla quibusdam voluptas optio.', '2023-04-08 00:00:00', '2013-09-24 00:00:00', '8239 Kunde Extension Suite 297\nNew Blaze, TX 13180-6024', '47.774939', '21.017935', 1, 0, 0, '18', '91.64', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(15, 288, 97, 'Nisi aperiam est consectetur modi qui.', 'Ducimus ratione occaecati aut maiores. Non quis quam amet fuga ratione sit. Debitis eum numquam natus soluta.', '2008-04-27 00:00:00', '2011-04-03 00:00:00', '549 Rory Flat Apt. 569\nEast Francisca, NM 84532', '-35.395094', '-166.834474', 1, 1, 1, '98', '84.28', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(16, 289, 98, 'Saepe aspernatur qui facere asperiores.', 'Nihil qui omnis provident voluptatem. Et non nihil eum aut aut quas ullam nihil. Ipsum qui quae expedita culpa aspernatur incidunt. Ut amet consequuntur ex odio est doloremque at esse. Culpa quis eum quae expedita aliquam omnis.', '1989-09-07 00:00:00', '2013-11-29 00:00:00', '652 Predovic Extension\nMillerside, MI 89480-4970', '43.633036', '-21.008721', 1, 1, 1, '85', '24.03', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(17, 291, 100, 'Nemo et qui doloribus asperiores molestiae eum eos.', 'Odio et id ut qui. Quidem rerum provident eaque ex nemo praesentium culpa. Quae ut aut commodi illo cumque iste animi.', '1992-03-11 00:00:00', '2005-12-28 00:00:00', '68987 Bernhard Grove Apt. 213\nSchusterchester, AL 55083', '11.284986', '-52.251787', 1, 1, 0, '0', '61.52', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(18, 292, 101, 'Molestiae minima excepturi architecto libero quia omnis.', 'Perspiciatis beatae et laudantium veniam omnis in perferendis. Qui nam ad velit exercitationem non dolores. Totam blanditiis dolores est et explicabo tempore eius.', '1987-01-07 00:00:00', '1993-06-08 00:00:00', '22575 Tressie Ville\nSouth Darrell, AL 77815-1663', '-32.292335', '-88.902807', 1, 1, 0, '92', '14.76', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(19, 294, 103, 'Est sit aut magni accusamus vel laborum quia magni.', 'Sit est repellendus rerum nostrum sed qui. Sapiente voluptatum cupiditate ratione dolorum sapiente quia. Excepturi est quia laudantium dicta ut. Aut sunt fuga nihil id eaque.', '1999-05-26 00:00:00', '2011-08-18 00:00:00', '990 Donnelly Shores Suite 173\nNew Flavieview, ME 98473', '-60.038682', '10.281865', 1, 1, 0, '74', '58.56', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(20, 295, 104, 'Corporis sequi sed et.', 'Nulla earum nulla neque dolor ad libero aspernatur. Quia ut natus fugiat. Voluptatibus eum adipisci dolorem voluptatem harum.', '1974-04-22 00:00:00', '1977-02-02 00:00:00', '24779 Owen Valleys Apt. 616\nEast Maeveside, AK 76110-8675', '-51.85988', '79.165544', 0, 0, 0, '62', '14.14', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(21, 297, 106, 'Aperiam quia sit velit nulla est fuga quae hic.', 'Minus consequatur ducimus et soluta iure ut distinctio nostrum. Et suscipit laudantium labore vero et. Dolorem voluptatem eos temporibus est natus et adipisci tempore. Explicabo libero error nesciunt maxime vel consectetur. Commodi esse odit magnam.', '1971-06-26 00:00:00', '1999-09-08 00:00:00', '77136 Beverly Pines Suite 504\nJacobiport, AK 52630-2813', '36.239571', '138.714419', 0, 1, 1, '86', '66.76', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(22, 298, 107, 'Et ullam ratione possimus libero corrupti et.', 'Voluptatem natus autem magnam aut. Quis blanditiis quos possimus beatae tempora quisquam. Dicta doloremque eveniet sequi. Aspernatur quas dolore quibusdam voluptatem culpa sit voluptatem.', '1975-02-15 00:00:00', '1982-02-02 00:00:00', '619 Wyman Street\nSchaeferton, FL 81350-8672', '89.322885', '-171.563298', 0, 1, 1, '47', '96.15', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(23, 300, 109, 'Quia nihil et corrupti voluptas magnam ea qui.', 'Distinctio asperiores ut consequatur sunt et cumque. Vel ut voluptas sed qui. Et aut ea omnis.', '2001-04-20 00:00:00', '1989-09-15 00:00:00', '9275 Bruen Vista\nDemarcusland, PA 85329', '27.874054', '-42.376302', 0, 1, 0, '65', '88.86', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(24, 301, 110, 'Perspiciatis veritatis ut sunt quia quo quos.', 'Tenetur enim rerum velit nulla. Voluptates quo suscipit veniam magni maiores iure.', '1991-09-17 00:00:00', '1984-03-19 00:00:00', '9161 Durgan Plaza\nSpinkatown, NY 50049-6270', '-32.514738', '-127.904881', 0, 0, 0, '49', '13.07', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(25, 303, 112, 'Repudiandae harum inventore veniam.', 'Voluptas tenetur voluptas sed molestias qui perspiciatis officiis quaerat. Eius nam qui sit veniam voluptatem. Adipisci veniam quia et vero culpa.', '2000-05-02 00:00:00', '2013-04-22 00:00:00', '3683 Schmidt Creek\nEmmanuelberg, AZ 27288', '-1.270872', '60.071761', 1, 1, 1, '43', '74.49', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(26, 304, 113, 'Accusantium libero rem hic illum.', 'Accusantium laborum pariatur quaerat laborum rerum molestiae dolores. Reprehenderit sit quia voluptatum sed. Et occaecati sed quas. Dolore quod eius quisquam qui reprehenderit.', '1971-11-28 00:00:00', '2009-10-03 00:00:00', '81190 Lucy Harbors Suite 962\nHansenport, HI 05757', '-43.265589', '112.230338', 0, 1, 1, '62', '76.47', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(27, 306, 115, 'Veritatis alias suscipit at ea ipsum velit dolore.', 'Mollitia totam odio praesentium eius. Dolor mollitia in veniam ea ut nostrum. Dolores totam quo est deserunt nihil id.', '2021-01-15 00:00:00', '2004-01-05 00:00:00', '9848 Wolf Mount Suite 420\nWillmsburgh, ND 92061', '71.066454', '173.020902', 0, 0, 0, '7', '77.91', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(28, 307, 116, 'Minus sint libero doloribus iusto nostrum aliquam ratione itaque.', 'Sint nam necessitatibus dignissimos ab dolorem quia corporis. Non nemo tempore aut aut. Eum illum distinctio quia consequatur optio. Laboriosam delectus magni et est. Doloremque sint et qui quaerat amet rem.', '1988-04-02 00:00:00', '2013-10-08 00:00:00', '3517 Maya Forks Apt. 148\nNew Karlchester, OH 29267-1568', '11.217151', '60.53396', 0, 1, 1, '25', '47.44', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(29, 309, 118, 'Nisi vitae eaque voluptas.', 'Magni quae rem cumque incidunt quisquam et quis. Temporibus doloribus alias beatae autem voluptatum qui illum illum. Dolores expedita consequatur rerum laborum sint est ut. Optio nihil sapiente animi dolores consequatur aut vitae.', '1982-02-09 00:00:00', '2007-03-16 00:00:00', '23025 Kassulke Ridges Suite 258\nAudraport, AL 63988-7134', '-85.14618', '136.255218', 0, 1, 0, '68', '37.28', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(30, 310, 119, 'Aspernatur magnam odio repudiandae placeat voluptatibus repudiandae.', 'Molestiae ut et dignissimos tempora quasi. Voluptate consectetur laudantium rerum commodi non doloremque quae vitae.', '2012-02-07 00:00:00', '2020-11-27 00:00:00', '2394 Abbie Ford\nEbbaview, ID 17611-0457', '-59.454247', '109.888238', 0, 0, 0, '0', '66.88', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(31, 312, 121, 'Iure cum dolores reiciendis laborum tempora modi maiores cupiditate.', 'Perferendis corporis quia non qui. Laborum molestias aut non veritatis. Et tenetur quasi eos tenetur qui. Dolores autem aut aut et quaerat architecto consequatur. Facere in excepturi natus explicabo fugiat et repellendus.', '1985-10-19 00:00:00', '1997-02-22 00:00:00', '2561 Murphy Shore Apt. 083\nMarvinborough, OH 69397-2744', '-28.237272', '144.676702', 1, 1, 0, '89', '54.58', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(32, 313, 122, 'A exercitationem quam eveniet et molestiae nostrum qui.', 'Sequi quibusdam dolorem vel numquam sapiente dicta ea et. Quas vel non odit quia.', '2021-10-29 00:00:00', '1979-05-28 00:00:00', '29863 Murazik Creek Suite 777\nWittingshire, IA 13407-4811', '34.227446', '-170.937296', 0, 0, 0, '4', '49.51', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(33, 315, 124, 'Necessitatibus minima maiores eaque ea.', 'Voluptates et nesciunt velit dolorum nisi. Dolores doloremque velit deserunt laborum et velit. Iure sit eaque consequatur commodi.', '1978-07-07 00:00:00', '2025-05-06 00:00:00', '517 Bosco Isle\nGoldashire, KS 52520-9066', '25.286975', '-38.968333', 0, 1, 0, '47', '88.69', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(34, 316, 125, 'Ea facilis voluptatem ut ut maxime tenetur.', 'Eius consequatur qui iste quia dolores. Minus eum est ipsam dolorem dolores aperiam. Exercitationem aut quia sit repellendus aut iure omnis.', '2006-08-20 00:00:00', '1985-05-26 00:00:00', '904 Geovanny Route Suite 720\nHoweport, CA 83362-5784', '-74.853944', '-56.355547', 1, 0, 1, '59', '92.22', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(35, 318, 127, 'Enim magnam at in aut quasi amet.', 'Ut velit expedita ducimus dolorem. Voluptatum tempora molestiae voluptatum dolor optio est. Distinctio et quo nam quia ut quia qui.', '2003-03-02 00:00:00', '2002-02-19 00:00:00', '696 Adaline Trail\nSouth Susanport, LA 70107', '-74.14859', '114.602153', 0, 0, 1, '30', '45.51', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(36, 319, 128, 'Enim sint molestias quibusdam dolores aut illum.', 'Voluptatibus fuga animi dolor velit sapiente qui. Voluptas dignissimos repellat esse. Officia labore quisquam quibusdam fugit fugiat.', '2007-12-11 00:00:00', '1992-07-03 00:00:00', '7213 Roxane Light\nEast Yoshiko, MN 13493', '74.290146', '-157.475146', 0, 1, 0, '42', '54.14', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(37, 321, 130, 'Reiciendis iure consequuntur nostrum voluptatem nostrum.', 'Sequi neque ipsa aut. Et id autem officia voluptas qui.', '2020-04-07 00:00:00', '1970-09-04 00:00:00', '84170 Koch Squares Suite 987\nPort Althea, NH 76957-2760', '-82.683793', '55.461815', 0, 0, 0, '52', '55.93', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(38, 322, 131, 'Similique et ut id aliquid eaque.', 'Ratione modi et aut deleniti veniam. Esse aliquam ullam placeat vel quisquam repudiandae. Sint nihil veritatis error aut sint.', '2016-12-18 00:00:00', '1995-06-16 00:00:00', '879 Bednar Road\nKrajcikchester, NV 82597-9650', '-14.140713', '25.884951', 0, 1, 0, '5', '60.39', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(39, 324, 133, 'Ut dolor magnam tempora numquam vitae eius eius.', 'Explicabo et fuga quis vel repellat. Qui qui fugit magnam et. Qui ut rerum qui sit. Reiciendis dolore quia qui reiciendis.', '2003-05-14 00:00:00', '2006-04-22 00:00:00', '30946 Funk Plaza Apt. 245\nAsiatown, CO 15135', '13.690856', '34.249885', 1, 0, 0, '44', '51.64', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(40, 325, 134, 'Amet officiis quidem culpa eius.', 'Voluptate in et qui repudiandae quo error. Eius error sunt dolores ullam.', '2007-02-21 00:00:00', '2019-08-18 00:00:00', '965 Stamm Row Suite 339\nWest Lelahtown, MD 47027-3466', '-37.72725', '96.145181', 0, 1, 1, '57', '83.71', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(41, 327, 136, 'Repellat distinctio sunt commodi neque omnis ratione.', 'Unde optio sunt repellendus similique occaecati reprehenderit. Labore quam voluptatem necessitatibus voluptates libero dolorem sed. Autem et temporibus nam veritatis sint qui. Facilis illum aliquam qui laborum aut error iste. Officiis ab ut eum.', '2015-05-13 00:00:00', '2004-09-16 00:00:00', '16574 Lonnie Shoal Apt. 173\nFredafort, IA 31013-2383', '-74.925448', '-70.244621', 0, 0, 1, '24', '38.8', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(42, 328, 137, 'Animi beatae dolore numquam quia tempore et aspernatur.', 'Aut sed voluptas voluptatum consequatur. Consequatur numquam maxime voluptatum aut nemo sed pariatur. Atque consequatur quidem qui reiciendis odio et tempora fuga. Porro in eveniet perspiciatis.', '2011-02-04 00:00:00', '2011-10-26 00:00:00', '504 Tremayne Centers\nNew Rafaela, WY 67399-0864', '-75.936629', '54.940486', 1, 1, 0, '89', '81.93', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(43, 330, 139, 'Quod odit sequi possimus in a ut quas.', 'In velit suscipit magni soluta voluptatem aliquam dignissimos. Recusandae laudantium est ipsam quisquam nobis.', '2016-09-07 00:00:00', '2005-12-12 00:00:00', '321 Buckridge Bypass\nPort Emma, KY 15230-6228', '-84.785377', '58.690533', 0, 0, 1, '78', '17.38', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(44, 331, 140, 'A perferendis quasi aut eius recusandae nemo.', 'Pariatur omnis quo debitis ab in quod exercitationem velit. Corporis vero repudiandae ut quo itaque. Rerum voluptatem dolores est ut nihil laudantium beatae. Consequatur distinctio iure in at.', '2004-01-08 00:00:00', '2021-11-10 00:00:00', '5637 Dejah Hollow Suite 558\nLebsackhaven, MT 55305-4469', '4.989949', '57.586824', 0, 0, 0, '95', '15.91', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(45, 333, 142, 'Est quibusdam molestiae dolore ratione laborum ad.', 'Nobis quo hic rerum sit eveniet corporis. Aperiam voluptatem est inventore vel dolores tempore ut. Ad sint sunt quod atque autem magnam. Laborum recusandae animi cumque quia quam et dignissimos.', '2010-02-24 00:00:00', '2003-08-01 00:00:00', '5969 Gislason Shoal Suite 270\nNew Coltview, ND 67526', '31.335697', '46.848158', 0, 0, 1, '12', '69.38', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(46, 334, 143, 'Omnis natus est sunt voluptatum ipsum.', 'Ut nulla similique iusto illum. Voluptas molestiae neque omnis sed ipsum deserunt cupiditate aut. Architecto illo iusto dolor molestias ut aut. Nisi doloribus a ea explicabo asperiores saepe. Eveniet nam quis deleniti cum accusantium.', '1990-05-10 00:00:00', '1972-01-11 00:00:00', '9523 Collins Keys\nGiovannachester, WI 60656-4950', '36.54371', '-67.535562', 0, 1, 0, '66', '35.95', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(47, 336, 145, 'Omnis placeat doloribus sed maiores animi quia recusandae.', 'Odit est quidem a. Omnis et et iure eum quia exercitationem. Voluptas nihil quia voluptas tempore eum. Illum consequatur nesciunt mollitia.', '1994-08-09 00:00:00', '1972-03-30 00:00:00', '9109 Zoey Vista\nEusebiomouth, VT 06938-8356', '47.742639', '123.550807', 0, 1, 0, '21', '22.15', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(48, 337, 146, 'Quibusdam repellendus pariatur officiis et quis.', 'Voluptatum eos qui laboriosam qui perferendis distinctio omnis. Sint rem nesciunt iusto autem quo tempora enim. In quaerat iure illum illum.', '2005-09-12 00:00:00', '1976-03-14 00:00:00', '938 Norbert Motorway Suite 026\nNorth Pearlinechester, NM 37916-2348', '10.798161', '135.387388', 1, 1, 1, '13', '53.61', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(49, 339, 148, 'A consequatur magnam qui sed soluta excepturi magni magnam.', 'Cupiditate nisi totam quae aperiam atque animi. Nisi impedit eveniet eligendi atque dolor cumque at. Quis sapiente asperiores nesciunt asperiores eos. Delectus ipsa maxime maxime saepe distinctio id et. Harum est sit quam ab.', '2007-03-07 00:00:00', '1991-01-03 00:00:00', '732 Emard Roads\nKrajcikville, ID 27047', '-15.28637', '-19.825594', 0, 1, 1, '64', '63.18', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(50, 340, 149, 'Tempora voluptas nisi aspernatur.', 'Atque esse maxime dolores amet distinctio eaque quis. Eum modi corrupti qui placeat facilis quisquam quasi. Sed libero doloribus molestiae sequi reiciendis sequi enim vel.', '2004-04-07 00:00:00', '1981-03-20 00:00:00', '857 Runolfsson Course\nNorth Emilland, KS 25869-4214', '-37.804538', '64.850342', 0, 0, 1, '25', '63.08', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(51, 342, 151, 'Eos illo quidem unde quia illum aut illum.', 'Laborum omnis quia ut magnam. Molestiae earum eaque cum quia exercitationem qui corrupti. Quo eius occaecati quibusdam corporis ex earum inventore. Ducimus consequatur aut culpa ea.', '1976-02-06 00:00:00', '2011-07-18 00:00:00', '57738 McLaughlin Passage Suite 513\nZemlakshire, IL 00133', '-58.995816', '-70.018189', 1, 1, 1, '78', '84.48', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(52, 343, 152, 'Officia repellendus rerum doloribus quia sapiente recusandae.', 'Ullam sed dolores nihil minus. Ut quis incidunt sit aut ut fugiat fuga. Quidem modi nisi ut ea quaerat enim ea non. Repellendus autem libero optio.', '1975-09-03 00:00:00', '2011-07-02 00:00:00', '81391 Ferry Trail Suite 429\nLavonneside, VT 01575', '-52.503139', '85.47158', 0, 1, 0, '18', '51.07', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(53, 345, 154, 'Quam non est non sit aut qui.', 'Et ad nesciunt quo sint. Quia perferendis libero architecto quod expedita autem voluptatem. Hic nemo sequi itaque cumque necessitatibus. Ut ducimus suscipit iste sed at et ut.', '2012-05-05 00:00:00', '2014-07-24 00:00:00', '9296 Streich Forges\nHaleyhaven, OK 12599-9461', '0.870816', '178.509662', 1, 1, 1, '16', '23.08', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(54, 346, 155, 'Aliquid labore voluptatum labore iste.', 'Ipsam ut provident blanditiis excepturi non deleniti. Omnis aspernatur unde accusantium doloremque iure voluptas. Consectetur voluptatem et iure cum. Sit voluptas tenetur dolorum et cumque sequi perferendis sed.', '2005-08-31 00:00:00', '1977-02-25 00:00:00', '1319 Franz Walk Suite 531\nHyattton, FL 75767', '-88.174661', '-171.720313', 0, 0, 1, '76', '38.54', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(55, 348, 157, 'Inventore eligendi fugit doloremque perferendis occaecati qui.', 'Natus commodi reiciendis dicta perferendis totam. Id neque labore consequatur. Quasi expedita aut ipsa pariatur.', '1974-05-09 00:00:00', '2005-05-20 00:00:00', '6193 Oda Rapids Apt. 183\nFreidaview, AK 12660', '48.018795', '164.186008', 0, 0, 1, '10', '42.13', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(56, 349, 158, 'Voluptates id earum id et culpa adipisci itaque rerum.', 'Aliquam et pariatur totam ut non ut quibusdam. Voluptates inventore non quibusdam porro deserunt delectus. Nam aliquid dolorem quam dolorem incidunt id ea commodi. Quia doloremque quo placeat tempora aspernatur.', '2011-12-22 00:00:00', '2001-01-28 00:00:00', '88007 Lynch Unions\nWaelchimouth, OH 40294-7434', '-16.573849', '-160.993542', 1, 1, 1, '63', '43.83', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(57, 351, 160, 'Ipsam quos dolorum minima eligendi sed optio.', 'Voluptatem eum est et et modi nesciunt. Qui sed sit ullam consequatur ut eum veritatis cupiditate. Quisquam quo veniam quam quidem voluptas. Totam odio sapiente accusantium laboriosam ut.', '1985-04-09 00:00:00', '2019-07-28 00:00:00', '568 Christine Neck\nSchaeferfurt, TX 57448-8921', '-47.795096', '78.566167', 1, 0, 1, '75', '57.83', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(58, 352, 161, 'Dolorem ullam est reiciendis officia maxime animi ad.', 'Facere asperiores tempora sunt omnis sit. Eum laudantium cupiditate suscipit perspiciatis voluptas. Illum sunt libero et nobis ut.', '2004-02-13 00:00:00', '1998-03-01 00:00:00', '90434 Guido Estates Suite 266\nKoeppmouth, MA 68539-9355', '-9.188408', '-133.271694', 1, 1, 1, '91', '84.63', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(59, 354, 163, 'Iusto tempore in asperiores impedit ut.', 'Alias amet eligendi tenetur rerum nostrum. Sequi error consequatur repudiandae natus inventore quo. Voluptatem quis dignissimos excepturi ut suscipit facere incidunt voluptatem. Perferendis ut minima fugiat assumenda.', '1975-07-05 00:00:00', '1983-02-07 00:00:00', '8717 Keven Pike\nNew Albertamouth, WV 55132', '34.833995', '-113.91974', 0, 0, 1, '10', '12.59', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(60, 355, 164, 'Magni beatae pariatur voluptate.', 'Consequuntur architecto vero quae velit. Exercitationem tempore ex qui rerum quis omnis consequuntur.', '1983-02-21 00:00:00', '1984-09-08 00:00:00', '477 Sanford Manor Suite 764\nEast Jamalside, WY 14996-8383', '87.717184', '138.801003', 0, 1, 1, '58', '98.86', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(61, 357, 166, 'Eveniet a dolor et qui distinctio tempora.', 'Enim esse aperiam neque sed culpa id eveniet. Vel voluptates eum veritatis ut voluptatem. Minima sunt eius corporis placeat nulla et. Porro dolores consequatur vero consequuntur omnis.', '1995-12-26 00:00:00', '1994-08-15 00:00:00', '5405 Rodriguez Skyway\nLake Daniella, OH 26754-9145', '71.983825', '-61.851454', 0, 0, 0, '3', '92.83', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(62, 358, 167, 'Alias magni et possimus ex dolorum dignissimos qui harum.', 'Dolorem voluptatum possimus magnam. Qui et sunt quae quia ad in eaque voluptas. Debitis libero iusto sint.', '1984-03-16 00:00:00', '1990-06-07 00:00:00', '425 Oberbrunner Overpass Apt. 976\nHankmouth, NC 01723', '32.768492', '48.801568', 1, 0, 1, '55', '26.82', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(63, 360, 169, 'Aut rerum neque non rerum alias provident.', 'Dolor accusamus distinctio beatae accusantium nesciunt sit. Ducimus beatae non nihil reiciendis et rerum et. Qui sunt doloribus sint in.', '1981-04-04 00:00:00', '1976-05-20 00:00:00', '782 Nels Skyway\nNorth Cristal, ND 90024', '23.797239', '-129.478639', 1, 1, 0, '88', '96.55', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(64, 361, 170, 'Omnis omnis ipsam in enim odio autem.', 'A porro et sapiente quod dolorem fugiat eveniet. Inventore pariatur deleniti rem. Dolores sit quidem sunt asperiores facere. Sint iure iusto molestiae architecto rerum unde consequatur rerum.', '1987-04-09 00:00:00', '1985-10-06 00:00:00', '6605 Goyette Row Apt. 130\nPort Shermanshire, PA 39647-7953', '89.773813', '21.214387', 1, 0, 1, '51', '14.5', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(65, 363, 172, 'Ullam sed quod inventore.', 'Consequatur et recusandae et voluptatem numquam soluta. Recusandae esse tenetur ab tenetur repudiandae.', '2002-08-23 00:00:00', '1999-08-11 00:00:00', '36544 Braeden Manor Apt. 703\nSchmittchester, NH 88384-0549', '89.598559', '18.108402', 0, 1, 0, '94', '55.42', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(66, 364, 173, 'Blanditiis at ut nostrum veritatis accusamus.', 'Fugiat nihil assumenda rerum itaque nulla et et sint. Adipisci occaecati et eum minima eaque dolorum ut.', '1978-08-20 00:00:00', '1978-06-11 00:00:00', '733 Hellen Divide\nVandervortside, MA 41172-3301', '24.516676', '-52.150002', 1, 0, 1, '85', '19.29', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(67, 366, 175, 'At nesciunt esse quo numquam autem.', 'Porro et dignissimos nulla laborum veniam quis repellendus. Molestiae vero enim corporis omnis. Reprehenderit similique et voluptas ut nostrum a aut.', '1985-06-15 00:00:00', '1986-03-02 00:00:00', '88267 Bogisich Crossroad Apt. 295\nCormierburgh, NE 28526-3449', '-2.310036', '14.869624', 1, 0, 1, '37', '54.63', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(68, 367, 176, 'Enim harum itaque quia voluptate.', 'Assumenda exercitationem officia perspiciatis doloremque et. Animi voluptas dolorem veniam quos non et illum. Facilis id est quo voluptas incidunt.', '2004-10-05 00:00:00', '1977-04-01 00:00:00', '545 Kathryne Turnpike\nEast Gerard, MD 79176-6693', '-54.084421', '108.015575', 1, 0, 0, '68', '17.81', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(69, 369, 178, 'Et voluptatem possimus ex et voluptas natus.', 'Consequatur dolor dolor qui sit tenetur ut. Occaecati velit voluptatibus totam enim quia et. Perferendis molestias molestiae provident.', '1998-03-17 00:00:00', '2008-05-16 00:00:00', '51959 Barney Hills Suite 918\nPort Salliemouth, WA 69205', '-13.72013', '75.118908', 1, 1, 1, '66', '83.68', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(70, 370, 179, 'Doloribus iure officia vel vitae provident.', 'Animi et quia alias earum. Esse dignissimos cupiditate totam veniam. Voluptas nobis dignissimos fugiat qui autem et sed. Aut fuga et nam.', '2003-04-13 00:00:00', '2003-11-18 00:00:00', '84949 Mertz Throughway Suite 821\nEast Amparo, HI 78822-6007', '40.760204', '53.017242', 0, 0, 1, '33', '96.39', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(71, 371, 181, 'Asperiores vero odio alias magnam perspiciatis commodi non.', 'Libero consequatur facilis voluptas et expedita mollitia. Dolorem pariatur reprehenderit corrupti veniam blanditiis dolore magnam. Deleniti officiis perspiciatis consequatur veniam itaque quibusdam et. Quasi in quia deserunt voluptatum voluptatem nihil sint quo. Voluptas fugit ut et atque quidem eum.', '2019-10-25 00:00:00', '2021-01-29 00:00:00', '9994 Feil Mount Suite 502\nStrackechester, TN 86923', '-45.704482', '141.277006', 0, 1, 0, '14', '64.54', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(72, 372, 183, 'Quis corporis laborum sit doloremque quasi sit.', 'Asperiores voluptatibus non sapiente a porro. Non libero minima exercitationem commodi rerum ut ad explicabo. Quibusdam ipsam itaque qui voluptatum. Qui expedita accusantium est et harum.', '1972-12-26 00:00:00', '2022-07-02 00:00:00', '7695 McLaughlin Gateway\nSawaynfort, CO 59804', '53.440693', '86.64512', 0, 1, 1, '99', '38.72', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(73, 373, 185, 'Dolorum rerum aliquam voluptate explicabo sunt ut.', 'Quod ut iure fugiat unde saepe corporis voluptate. Animi numquam ut aut aut quas vero similique. Voluptatem autem quia laboriosam error perferendis quidem. Quo earum et laudantium impedit cupiditate blanditiis.', '1972-04-17 00:00:00', '1989-10-16 00:00:00', '2355 Darron Street\nDasiaborough, NJ 63721-5190', '51.189136', '125.944853', 1, 1, 1, '46', '57.11', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(74, 374, 187, 'Delectus et voluptates reiciendis et maxime dolorum.', 'Velit dolor mollitia ex ea illo sunt. Doloremque architecto voluptatem quisquam quas totam. Qui consequatur omnis ut praesentium eaque asperiores sunt. Dolorem sit vel enim molestiae veritatis voluptas reiciendis.', '1990-06-09 00:00:00', '2009-09-27 00:00:00', '804 Abernathy Brooks Suite 646\nNorth Pauline, NJ 05862', '-44.38861', '-50.240282', 0, 0, 0, '89', '61.35', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(75, 375, 189, 'Eos voluptatem voluptates quas ab non autem.', 'Consequatur enim sed sunt sint. Libero doloremque maxime fugit animi odit ea ad sint. Ipsam consequatur nemo omnis dolorem. Autem fugiat doloribus minima autem saepe ducimus exercitationem.', '1997-09-07 00:00:00', '1994-12-10 00:00:00', '468 Lowe Camp\nWalkerstad, CA 86800-7680', '70.146269', '-112.664695', 0, 1, 0, '71', '26.15', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(76, 376, 191, 'Dolor repellendus voluptates omnis consequuntur ut a.', 'Est molestias delectus eius enim voluptatem. Tempora amet ea vitae hic neque. Necessitatibus minima hic similique temporibus ut expedita.', '2009-07-30 00:00:00', '1980-01-26 00:00:00', '5512 Little Hollow Suite 829\nLake Johnathon, WV 69790-7326', '-51.850097', '157.888009', 1, 0, 1, '17', '30.79', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(77, 377, 193, 'Dicta et qui eum et laudantium numquam dolore officiis.', 'Necessitatibus ipsa voluptatem id eius quaerat nihil alias. Sapiente et est sed officia minus. Et magni rerum amet.', '2018-05-08 00:00:00', '1983-09-22 00:00:00', '8648 Susie Parkways Suite 625\nBeierfurt, LA 66533-6358', '73.926905', '-89.343541', 1, 0, 1, '35', '48.45', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(78, 378, 195, 'Est provident consequatur quae nam ut veniam.', 'Sunt minus suscipit quaerat deserunt. Nisi beatae sit ratione omnis ea maxime consequatur. Repellat quas id totam.', '2003-02-10 00:00:00', '2019-02-10 00:00:00', '8834 Wilderman Avenue Suite 911\nEast Mabelmouth, ND 12695-4575', '-7.666878', '135.832417', 0, 1, 0, '15', '84.18', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(79, 379, 197, 'Alias quaerat dolore rerum.', 'Quisquam repellendus hic eos quisquam. Adipisci et impedit illum quae sint. Explicabo atque quo sed odio. Quia quia explicabo cum magnam iusto aut culpa.', '1978-06-08 00:00:00', '2022-06-16 00:00:00', '3568 McLaughlin Neck\nPort Tracey, LA 20158-9053', '26.215046', '60.515293', 0, 0, 0, '56', '77.87', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(80, 380, 199, 'Qui nam et consequatur corrupti animi.', 'Quia sit nostrum dolorem ex quidem. Modi iusto sit veniam veritatis. Quo nam ut dolore repellat reprehenderit. Dignissimos libero dolore qui sit libero occaecati optio inventore.', '2019-06-07 00:00:00', '2013-04-12 00:00:00', '98677 Jeremie Turnpike\nBodeborough, LA 33658-8630', '32.505297', '-71.625828', 0, 1, 0, '3', '21.23', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(81, 381, 201, 'Unde dolores sed eligendi modi.', 'Quia neque est nemo non qui laudantium eos. Sint accusamus dolorum repellendus aut fugiat. Nobis et quo quo modi aut quae alias cupiditate.', '1981-12-11 00:00:00', '2010-03-19 00:00:00', '19076 Berge Centers Apt. 461\nPort Enochbury, KY 16640', '-78.495434', '12.565295', 0, 1, 0, '77', '31.89', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(82, 382, 203, 'Nobis sequi earum qui eius nostrum eum consequatur.', 'Quaerat qui laudantium eveniet. Amet adipisci quas qui vel necessitatibus. Consequuntur veritatis quidem maxime illum reprehenderit natus. Nulla et provident consectetur voluptas itaque.', '2005-05-27 00:00:00', '2023-10-15 00:00:00', '39408 Oscar Hills\nWest Christopheshire, MT 61245', '9.133996', '25.989166', 0, 0, 0, '74', '22.5', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(83, 383, 205, 'Atque ea id autem libero error aperiam.', 'Illo magnam illo aut qui enim et. Consectetur quaerat voluptate quae repellat. Optio modi ratione delectus et quisquam ut.', '2014-06-09 00:00:00', '1982-08-11 00:00:00', '9298 Alena Corners Apt. 624\nSouth Dakota, SC 11613', '21.235038', '-169.816878', 1, 0, 0, '95', '22.79', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(84, 384, 207, 'Facere iste et minus cumque.', 'Ipsum est dolore ab odit at. Alias commodi earum aut eius.', '2012-05-07 00:00:00', '2023-12-26 00:00:00', '428 Kaley Club\nAbelardomouth, NV 59372-6838', '69.212009', '-172.141746', 1, 0, 1, '99', '30.15', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(85, 385, 209, 'Facere sapiente repellat sequi ipsum veniam.', 'Ad ducimus qui inventore delectus dolores quod. Officia earum aperiam vero corrupti nobis facere. Quis voluptatum cumque hic eum atque.', '2020-05-28 00:00:00', '1970-07-31 00:00:00', '3485 Dietrich Hollow Suite 554\nNorth Irving, RI 44888', '78.941208', '154.745587', 0, 1, 1, '40', '45.42', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(86, 386, 211, 'Magni dolor cupiditate eos eaque voluptates.', 'Aut totam consequatur distinctio nisi quod quia. Sit dolorum doloremque facilis doloribus minima consequatur. Et ipsum alias repudiandae laboriosam. Dignissimos non pariatur nemo culpa sed rem sed qui.', '1977-03-24 00:00:00', '1992-03-07 00:00:00', '8579 Adan Street\nAmbroseport, ND 39123-7664', '-42.267005', '-53.843754', 1, 0, 1, '7', '76.48', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(87, 387, 213, 'Hic quia ipsam rerum.', 'Nostrum et ipsam error facilis. Quo culpa ullam placeat. Voluptas ipsum sit neque reiciendis. Voluptate itaque doloremque nostrum quis consequatur pariatur ipsum.', '1970-06-17 00:00:00', '2012-08-14 00:00:00', '57445 Don Terrace\nLake Willy, CA 86564', '-4.206414', '-139.837102', 0, 0, 1, '16', '47.27', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(88, 388, 215, 'Nostrum aspernatur veritatis ullam velit id.', 'Voluptas velit et quibusdam esse tenetur est iure hic. Et laudantium necessitatibus laboriosam incidunt maxime iure cupiditate expedita. Delectus natus perferendis modi qui. Consequatur consequatur quia ut eligendi laborum odio quaerat.', '1972-07-22 00:00:00', '2015-07-28 00:00:00', '81664 Colby Course\nSouth Fernando, WY 42455', '13.529188', '156.085963', 0, 1, 1, '3', '77.17', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(89, 389, 217, 'Molestiae et consequatur sed minima.', 'Dolorem quod quia in aliquam. Dolor est non numquam accusantium rerum magni excepturi. Similique reiciendis nulla rerum omnis nam. Rerum consectetur exercitationem earum inventore repellat necessitatibus.', '1978-11-18 00:00:00', '2019-06-05 00:00:00', '265 Jast Points Apt. 159\nKeeblerhaven, AZ 70624', '-18.509215', '-113.175333', 0, 0, 1, '15', '75.37', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(90, 390, 219, 'Quia consequatur soluta est ut.', 'Asperiores ullam dolore doloribus eum. Quasi ipsa unde omnis itaque quia.', '1992-09-25 00:00:00', '1981-12-20 00:00:00', '9017 Oswald Isle Apt. 618\nSouth Remington, MD 92635-9421', '-68.053418', '125.663425', 0, 0, 1, '84', '25.12', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(91, 391, 221, 'Quia natus eos ea voluptatem repudiandae maxime ex.', 'Veritatis laborum nihil nesciunt aperiam. Quo eum excepturi nam porro. Beatae officiis sunt rerum maxime quae non sed. Possimus fugit ad nostrum repudiandae iste ducimus debitis ratione.', '1986-01-25 00:00:00', '2023-02-21 00:00:00', '283 Polly Shores Suite 663\nNicholeburgh, NC 31126', '19.776484', '-154.271675', 0, 0, 1, '95', '75.58', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(92, 392, 223, 'Sit dolorem consequuntur quae id asperiores laboriosam.', 'Perspiciatis ut culpa voluptate odio exercitationem. Dicta ad perspiciatis expedita odit. Sed aperiam iure sapiente quis.', '1982-08-16 00:00:00', '2002-02-09 00:00:00', '51992 Rosetta Pine Apt. 178\nPort Elmerstad, NH 65886-5070', '-25.936025', '-94.901171', 0, 0, 1, '18', '18.8', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(93, 393, 225, 'Ab veniam unde suscipit.', 'Repudiandae maiores voluptas id rerum aliquam ullam. In natus aspernatur debitis corrupti tempora. Ad ab dolorem omnis mollitia voluptatem. Qui non quis earum dolores nisi.', '1985-12-24 00:00:00', '1984-07-23 00:00:00', '82415 Brianne Point\nAlexysshire, SD 10040-6776', '-66.939081', '-66.804464', 1, 0, 0, '46', '38.99', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(94, 394, 227, 'Velit nostrum at qui eum.', 'Eos tenetur earum est maiores sunt corporis voluptate. Culpa quia enim maxime nesciunt consequatur est adipisci. Quis eum tenetur aliquam deleniti. Cum amet illo amet sint sed saepe iste.', '1987-08-25 00:00:00', '2007-03-26 00:00:00', '8682 Angelita Island\nSouth Carolinaburgh, NM 35580', '14.087809', '-44.444212', 1, 0, 0, '80', '51.07', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(95, 395, 229, 'Deleniti ipsam quasi est architecto.', 'Quos quae modi voluptate eius a. Iusto et similique accusantium recusandae reprehenderit nisi. Corrupti rerum neque quia adipisci voluptatum deleniti.', '2018-10-01 00:00:00', '2019-03-02 00:00:00', '17226 Heathcote Mill\nEast Brayan, NH 17810', '77.610822', '-33.563248', 1, 1, 1, '66', '54.19', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(96, 396, 231, 'Rerum enim aut aut est.', 'Voluptas quas animi fugiat omnis. Pariatur laborum autem quod et et. Magnam quae commodi hic id corporis neque hic. Expedita consequuntur aut aut et sit rerum.', '2023-03-12 00:00:00', '1995-06-23 00:00:00', '9130 Layne Plains\nAnthonyport, MA 42005', '27.136713', '-2.543895', 0, 0, 1, '46', '14.7', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(97, 397, 233, 'Repudiandae ipsam doloribus repellendus id.', 'Repellat cumque illum est culpa quae. Ad cupiditate quis ipsam dolores fugiat. Dignissimos illo vero voluptatibus iure cupiditate ipsa rem. Voluptatum laboriosam culpa commodi possimus fugiat.', '1971-04-22 00:00:00', '2003-10-05 00:00:00', '65701 Thiel Port\nWest Britneymouth, HI 90250-6986', '-89.5905', '-177.419564', 0, 1, 0, '82', '41.4', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(98, 398, 235, 'Ut sapiente aut excepturi iste explicabo.', 'Architecto omnis sequi sit dolores quo. Qui et id eligendi voluptates dolores. Nesciunt eum voluptates assumenda libero ipsum voluptatem facilis dignissimos. Atque rerum quas quibusdam et.', '1977-06-19 00:00:00', '2003-11-03 00:00:00', '307 Else Roads Suite 798\nHoegerport, VA 52651-6702', '47.521246', '57.71351', 0, 1, 0, '33', '77.15', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(99, 399, 237, 'Laboriosam incidunt itaque magni sapiente.', 'Suscipit et ab iste assumenda omnis. Ex odit distinctio deserunt eveniet sed sed.', '1994-03-16 00:00:00', '2001-09-14 00:00:00', '4660 Verona Drive\nVirgiemouth, IA 61247', '0.968348', '-91.81407', 1, 0, 0, '91', '67.32', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(100, 400, 239, 'Fugiat suscipit ratione nesciunt est.', 'Totam est sit magnam iste reiciendis explicabo. Exercitationem dicta cum ut. Maiores ducimus voluptatum explicabo fugiat ea maxime ut totam.', '2006-12-15 00:00:00', '1986-07-10 00:00:00', '435 Schimmel Common Apt. 505\nWest Eunastad, AL 10056', '-41.847208', '152.24573', 0, 1, 1, '49', '64.3', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(101, 402, 241, 'Repellendus sed est et cupiditate alias qui asperiores.', 'Et sed quia occaecati voluptas tempora. Sit corporis alias voluptas repellendus in voluptatem. Soluta repellendus itaque et pariatur non.', '1987-10-07 00:00:00', '1983-07-22 00:00:00', '347 Kilback Islands Suite 874\nPort Jocelyn, VA 04602-7878', '15.182741', '28.873981', 0, 0, 1, '59', '41.94', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(102, 404, 242, 'Consequatur voluptatum iusto neque voluptas est.', 'Odio sed eius officiis fuga provident quis. Et beatae quis qui dolorem. Eaque tempore voluptas corrupti est sit. Delectus laborum cumque expedita eum architecto qui ut. Aut qui velit est cum dolorum officiis saepe.', '2019-08-09 00:00:00', '1977-07-13 00:00:00', '80888 Purdy Mountains\nBlickbury, WY 61118', '78.967891', '127.83839', 0, 0, 1, '14', '44.3', 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(103, 406, 243, 'In neque maxime placeat eum.', 'Ex animi ea aut ipsum eius. Est provident magni placeat velit nesciunt. Nulla velit et officiis eius esse quia.', '1976-08-16 00:00:00', '2013-01-06 00:00:00', '2982 Ellie Fall\nWestleymouth, MN 57719-1420', '-86.927101', '97.754429', 0, 1, 1, '72', '95.18', 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(104, 408, 244, 'Facere necessitatibus porro voluptas et repellendus veritatis consequatur.', 'Dicta enim esse alias repellat sed ipsa. Libero rerum sit eum commodi ipsam. Eveniet soluta optio consequatur aut commodi. Saepe non tempore iste.', '1975-12-22 00:00:00', '2020-04-16 00:00:00', '516 Julianne Island Suite 405\nLake Meaganborough, MA 64000', '-32.418486', '152.893219', 1, 0, 0, '10', '40.18', 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(105, 410, 245, 'Ea ut porro soluta quo consequatur ut aliquam.', 'A odit quibusdam magni. Id nemo illo aut. Aliquid ad et accusantium similique. Itaque similique autem tempore ea exercitationem dolores. Atque labore id ad dolores.', '2009-03-06 00:00:00', '1983-11-29 00:00:00', '473 Nienow Ford\nSouth Agustin, MO 84286', '-17.752906', '32.02696', 1, 0, 1, '45', '92.88', 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(106, 412, 246, 'Labore nemo aut saepe et.', 'Deserunt molestiae laboriosam saepe voluptas sapiente ipsam enim. Temporibus non dolorum veniam atque et inventore aliquid. Sunt veniam aut et tempora delectus sed aperiam.', '1996-02-08 00:00:00', '1976-10-07 00:00:00', '62252 Ziemann Tunnel\nEast Alberto, AL 48022-8567', '66.104065', '152.130571', 0, 1, 1, '36', '42.02', 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(107, 414, 247, 'Hic rerum architecto facere vitae.', 'Beatae sint omnis adipisci quia ut reprehenderit sunt. Quisquam id voluptatem qui est quasi eius. Et magnam cupiditate quaerat quia optio. Sunt explicabo blanditiis enim maxime.', '1982-05-19 00:00:00', '1998-01-16 00:00:00', '24875 Hazle Place Suite 106\nPort Daveton, TN 37582-5644', '34.56573', '-175.21628', 0, 0, 0, '76', '41.69', 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(108, 416, 248, 'Quae voluptatibus ut nesciunt eaque et exercitationem consequuntur.', 'Cupiditate reiciendis totam nihil odit. Ipsam repellendus eaque fugiat porro et laborum sed. Atque aut velit dolore facere deleniti.', '1986-03-13 00:00:00', '1983-12-24 00:00:00', '76638 Hansen Pine\nNew Pamela, FL 06965', '-10.050189', '110.004218', 1, 1, 0, '25', '52.66', 1, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(109, 418, 249, 'Architecto aut sit molestiae odio.', 'Minus non eaque placeat et. Mollitia vitae exercitationem atque voluptatem molestiae.', '1990-01-22 00:00:00', '1999-01-20 00:00:00', '67412 Bahringer Station\nRhodaland, NV 46373-4549', '76.261348', '141.837406', 1, 1, 1, '0', '85.74', 0, '2025-06-01 11:28:56', '2025-06-01 11:28:56'),
(110, 420, 250, 'Velit quia accusantium doloribus ut quasi dolores.', 'Quos ipsum doloribus itaque alias repudiandae corrupti. Earum sint sapiente magnam optio. Facilis quo quibusdam hic iure possimus ipsa velit placeat. Et ullam cupiditate quo voluptatem quisquam impedit sed.', '2004-10-15 00:00:00', '1983-08-16 00:00:00', '79137 Alize Court\nJenaville, AR 23690-5254', '64.437466', '37.424149', 0, 0, 1, '82', '60.91', 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(111, 422, 251, 'Itaque aliquam ullam deserunt quasi et esse consequuntur.', 'Suscipit atque reprehenderit rem rerum excepturi rerum doloremque. Asperiores et corporis voluptas quidem libero voluptates ratione. Maxime ad commodi sit eos.', '1994-12-31 00:00:00', '2014-08-30 00:00:00', '9937 Rey Parks\nLake Warrenshire, HI 77809-6597', '-54.869238', '-66.487762', 0, 1, 1, '67', '25.58', 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(112, 424, 252, 'Quo consequatur repellendus sed voluptatum veritatis dolores pariatur veniam.', 'Rerum sint modi sunt voluptatem molestiae iusto. Aspernatur ipsa perspiciatis est architecto non et delectus.', '1998-05-10 00:00:00', '2014-03-23 00:00:00', '82176 Ernesto Lock Apt. 809\nNorth Brady, MD 61238-8460', '-44.308989', '-151.033452', 1, 1, 1, '68', '59.46', 1, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(113, 426, 253, 'Inventore ut consequuntur rerum voluptas.', 'Natus harum cupiditate sit rerum. Est neque velit est consequatur. Nemo quam autem magnam ducimus quasi sint.', '2017-06-16 00:00:00', '1971-07-05 00:00:00', '513 Elsie River Apt. 800\nMonahanbury, WA 04531-0424', '29.504143', '-79.739254', 1, 0, 1, '73', '83.37', 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(114, 428, 254, 'Qui ea quidem harum debitis sed minima.', 'Earum unde animi et et sed sint vero. Ab ipsa optio sit quis quam amet. Non dolores qui nulla officia dolore quidem.', '1976-10-21 00:00:00', '1988-08-30 00:00:00', '8958 Weimann Rapid\nSedrickborough, TN 30394-7704', '1.770755', '-121.785161', 1, 1, 0, '89', '60.5', 1, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(115, 430, 255, 'Officia rerum eos ducimus dolore optio.', 'Ducimus eum nesciunt rerum aut quia molestiae cumque. Eveniet est mollitia praesentium ab et. Voluptatem numquam sed porro excepturi consequuntur neque deserunt iure.', '2013-09-19 00:00:00', '2013-02-25 00:00:00', '630 Lang Rue\nBlairton, UT 99689-9460', '52.821689', '-172.045387', 1, 1, 0, '74', '86.01', 1, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(116, 432, 256, 'Culpa sit eaque est dolor illo minima.', 'Recusandae esse recusandae eius ea possimus. Accusamus necessitatibus animi non vel culpa. In qui aut velit blanditiis aspernatur nisi adipisci consectetur. Neque porro voluptatum aut laborum nemo.', '1980-09-25 00:00:00', '2023-02-20 00:00:00', '2192 Mylene Passage Suite 426\nMrazland, WI 70578-1137', '-67.152972', '34.462593', 0, 0, 0, '65', '32.53', 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(117, 434, 257, 'Laudantium molestiae et porro et omnis maxime minima.', 'Ducimus qui deserunt sequi autem. Placeat eius deleniti doloribus dicta. Reiciendis labore sequi quae.', '1977-09-18 00:00:00', '2024-01-14 00:00:00', '5704 Anderson Trafficway\nBradtkeshire, RI 20832-4040', '61.090557', '-139.802869', 0, 1, 0, '11', '35.54', 1, '2025-06-01 11:28:57', '2025-06-01 11:28:57'),
(118, 436, 258, 'Est qui est qui sed corrupti itaque.', 'Cupiditate minima eos qui et minus et. Corporis expedita similique aut consequatur distinctio id. Saepe et quo dolores nemo ut iusto itaque ex. Tempora deleniti qui quod.', '1992-11-03 00:00:00', '1985-08-25 00:00:00', '91588 Heller Summit Apt. 035\nEast Ralphland, IA 88825', '-7.693587', '-99.610289', 1, 1, 0, '99', '26.83', 0, '2025-06-01 11:28:57', '2025-06-01 11:28:57');
INSERT INTO `events` (`id`, `user_id`, `category_id`, `title`, `description`, `from`, `to`, `location`, `lat`, `long`, `is_public`, `is_free`, `is_end`, `event_limit`, `event_price`, `status`, `created_at`, `updated_at`) VALUES
(119, 438, 259, 'Nisi blanditiis nostrum error perspiciatis.', 'Iure voluptas perspiciatis ut et est necessitatibus incidunt qui. Quos expedita dolorem atque corporis autem repudiandae. Quisquam quia fugiat cupiditate odit quo ipsum.', '1974-10-02 00:00:00', '1987-08-01 00:00:00', '7494 Jakubowski Dam\nMarquardtside, SC 99280-6350', '66.508372', '112.649108', 1, 0, 0, '32', '61.08', 0, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(120, 440, 260, 'Voluptate animi consequatur ea praesentium molestias temporibus reiciendis.', 'Est delectus sit molestiae commodi sed ipsam. Temporibus ut voluptatum tempore. Sequi iusto voluptatem ea enim corporis minus nesciunt.', '2010-04-05 00:00:00', '2023-04-03 00:00:00', '208 Hessel Harbor Apt. 341\nEast Janickberg, WV 53742-4141', '14.504306', '56.501654', 1, 1, 1, '54', '78.8', 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(121, 442, 261, 'Quasi at fuga tenetur error est vero eaque.', 'Totam nesciunt ut quia id vel. Dolor neque quo est similique veniam sed quam consequatur. Consequatur qui hic sunt accusantium. Nostrum ut reprehenderit praesentium. Dolores velit quae at tempora quibusdam doloribus dolorum accusantium.', '1998-03-02 00:00:00', '1989-12-17 00:00:00', '1995 Mitchell Stream Apt. 874\nMannchester, RI 76005', '63.344566', '-137.702498', 1, 0, 1, '62', '19.22', 0, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(122, 444, 262, 'Odit eaque labore delectus explicabo sit sunt animi.', 'Commodi quasi tempora pariatur recusandae sequi. Ipsam nihil itaque nihil quibusdam. Enim qui nihil rerum aut.', '2023-12-09 00:00:00', '1999-01-14 00:00:00', '79053 Sid Loaf Suite 785\nYvonnehaven, TX 16117-2171', '-57.576942', '-103.199028', 1, 1, 0, '40', '87.42', 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(123, 446, 263, 'Quia omnis recusandae qui omnis.', 'Inventore rerum voluptatibus qui rerum. Tempore dicta consequatur corporis.', '2000-01-02 00:00:00', '1972-10-19 00:00:00', '65713 Felipe Tunnel\nWest Ivahville, OR 26531', '-34.065843', '-60.506501', 0, 0, 0, '23', '11.22', 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(124, 448, 264, 'Voluptatem est deserunt quidem perferendis dolor tempora.', 'Officia ut non asperiores ea ut corrupti. Magnam et consequatur tempore et eum occaecati eius et. At provident eveniet nihil.', '2015-02-06 00:00:00', '1983-11-23 00:00:00', '6383 Ricardo Summit\nSouth Juniorburgh, TX 04795', '-64.051372', '-74.817662', 1, 0, 0, '32', '85.41', 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(125, 450, 265, 'Est ratione nihil sequi qui unde.', 'Nulla aut dolores soluta necessitatibus est beatae placeat. Totam vitae quas veritatis eum rem eum. Ea inventore dolorum illo sapiente. Autem veritatis reprehenderit repellat tempora non tempore.', '1981-06-18 00:00:00', '2004-03-01 00:00:00', '5480 Kuhlman Loop\nThurmanton, NM 56364-9274', '0.922125', '129.640244', 0, 1, 0, '24', '15.86', 0, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(126, 452, 266, 'Voluptate rerum nesciunt ex quibusdam veritatis enim.', 'Quia dicta cumque optio eveniet. Suscipit sit repellat veritatis aut. Quia et est non consequatur excepturi ducimus earum.', '2015-05-31 00:00:00', '2010-06-28 00:00:00', '679 Margarett Radial Suite 309\nTurnermouth, OH 94393-6051', '64.711499', '91.532784', 1, 0, 0, '80', '65.13', 1, '2025-06-01 11:28:58', '2025-06-01 11:28:58'),
(127, 454, 267, 'Eos corporis sit culpa doloremque maiores et.', 'Qui eos tempora eveniet nihil modi quia. Odit ratione maiores incidunt laudantium. Fugiat qui maxime exercitationem porro. Accusamus fuga ut nostrum quis voluptatem.', '2015-04-16 00:00:00', '2020-10-23 00:00:00', '42775 Yundt Coves\nJanniehaven, NE 91686-6118', '-57.71235', '-50.771577', 0, 0, 0, '60', '82.26', 1, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(128, 456, 268, 'Facere occaecati animi rerum nihil occaecati aliquid.', 'Voluptas ut esse voluptas qui. Doloremque saepe ipsum dolorum laborum nulla. Eum id sunt aperiam est quis. Sed nam quam illum maxime.', '1997-11-20 00:00:00', '1993-04-14 00:00:00', '39694 Rashawn Ports\nJakubowskiville, MA 15459', '-12.706045', '97.966181', 1, 0, 1, '91', '41.08', 0, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(129, 458, 269, 'Temporibus qui sequi eum.', 'Et dolorem non est occaecati. Et eligendi et sapiente laboriosam. Corrupti sit facere eum reprehenderit aperiam voluptas molestias.', '2001-08-04 00:00:00', '2001-08-30 00:00:00', '58446 Shane Camp\nNew Goldenville, VT 92437', '24.308343', '-8.971961', 0, 0, 0, '86', '59.32', 0, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(130, 460, 270, 'Esse qui quia a corporis laudantium.', 'Consequatur eos animi nisi voluptatibus recusandae. Numquam eum porro eum sit vel quae molestiae itaque. Vel ex qui aliquid vitae error at beatae necessitatibus.', '2011-12-29 00:00:00', '1980-05-30 00:00:00', '4085 Augustus Neck\nStanfordtown, TN 08309-4071', '-13.775074', '2.120749', 1, 0, 1, '71', '92.22', 0, '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(131, 1, 1, 'Example Event', 'This is a description of the event.', '2026-05-27 13:17:00', '2026-06-29 12:33:00', 'New York', '40.7128', '-74.0060', 1, 0, 0, '100', '50.00', 0, '2025-06-01 13:48:32', '2025-06-01 13:48:32'),
(132, 642, 2, 'Flutter Event', 'Flutter Event Describtion', '2025-06-03 10:41:00', '2025-06-27 22:41:00', 'Cairo, Egypt', '38.9071922', '-77.0368729', 1, 1, 0, '20', '0', 0, '2025-06-02 08:42:26', '2025-06-02 08:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `event_followers`
--

CREATE TABLE `event_followers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `has_user_paid` tinyint(1) NOT NULL DEFAULT '0',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_followers`
--

INSERT INTO `event_followers` (`id`, `user_id`, `event_id`, `has_user_paid`, `price`, `qrcode`, `created_at`, `updated_at`) VALUES
(1, 401, 101, 0, '28.56', '83d34230-65f6-3c99-b06f-5f7d6682921f', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(2, 403, 102, 1, '69.07', '257208fe-ea67-3658-80ee-1b00b9d6c159', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(3, 405, 103, 1, '48.88', '1d577118-1005-3521-9547-947414dbab8b', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(4, 407, 104, 0, '95.28', 'e546ef60-e754-3cf7-a295-170c5d7be367', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(5, 409, 105, 0, '89.69', '8115dda3-6cea-36f4-9d85-af60bd1cd1b2', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(6, 411, 106, 0, '11.48', '68162f0b-7709-3e68-b70d-0da9c873b3a9', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(7, 413, 107, 0, '85.98', '70805c23-2caa-354d-8b06-4db9183c6c59', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(8, 415, 108, 1, '64.13', 'c15d20f2-a712-3969-bd2d-7dc9f4357716', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(9, 417, 109, 1, '62.12', '8152d348-517a-3b4b-8caa-c2ec891bdec4', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(10, 419, 110, 0, '98.91', '2eecb0ee-f423-36f2-8fe7-6d61f88815f9', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(11, 421, 111, 0, '16.39', '17928537-bcee-3f83-8b86-083ef073b19c', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(12, 423, 112, 0, '60.69', 'b8a43c3f-b978-3572-88cb-78efdd242eee', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(13, 425, 113, 1, '29.35', '5cf418c6-c59d-3c55-a62b-a457f94b9eb0', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(14, 427, 114, 0, '55.13', 'ec4d95cd-de53-382a-b255-11d8afeed607', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(15, 429, 115, 1, '49.92', 'd4f6a1d5-f9ba-38b5-944b-fb33a727fd32', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(16, 431, 116, 1, '94.73', '598fe73a-c2ed-3a84-b20b-428eb3ed3576', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(17, 433, 117, 1, '35.35', '9f8de2bb-83c6-32ce-b6e9-31af18676719', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(18, 435, 118, 1, '86.62', 'd285656e-1086-34e4-9210-e2c17383196e', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(19, 437, 119, 0, '87.52', 'cab00815-83ec-3ad3-bf3a-0240c979f44e', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(20, 439, 120, 0, '48.48', '1240620b-f7b5-319c-9f79-c042d3f955d0', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(21, 441, 121, 1, '36.99', '70cb8d8c-abef-3f98-a456-413f34fcd1be', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(22, 443, 122, 1, '29.29', '5ce2949d-1475-326c-88be-651797a53256', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(23, 445, 123, 1, '15.06', '76f7bf2d-956c-3f36-b699-987f6a2265a0', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(24, 447, 124, 0, '55.73', 'd22663e2-516a-3bae-8520-54803b34a8b6', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(25, 449, 125, 1, '45.15', '6f94b611-7267-3d8a-a490-04ad60a0a70a', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(26, 451, 126, 0, '46.15', '18f39551-6ba9-3457-b32d-5ea8ed8c7977', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(27, 453, 127, 0, '69.97', '252023d8-8d25-3a38-85cb-ab7b86779ef5', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(28, 455, 128, 1, '34.12', '96568fe6-8529-3592-b48f-bb7d4a12ff35', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(29, 457, 129, 1, '29.1', '2bde5908-4224-3b50-83ce-00013cbc2fff', '2025-06-01 11:28:59', '2025-06-01 11:28:59'),
(30, 459, 130, 0, '69.19', 'f5344f4e-2a31-352f-a2d0-0406c8acdc7a', '2025-06-01 11:28:59', '2025-06-01 11:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `event_requests`
--

CREATE TABLE `event_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_requirement_id` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_requests`
--

INSERT INTO `event_requests` (`id`, `user_id`, `event_id`, `status`, `price`, `event_requirement_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 281, 11, 'accepted', '19.23', 1, 'Id distinctio reprehenderit rerum vero velit molestias voluptates. Nam ut aspernatur repellendus inventore. Alias saepe dolorem assumenda quam optio sapiente.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(2, 284, 13, 'accepted', '14.03', 2, 'Minus dolor sed aut quis. Accusantium laboriosam recusandae natus ut. Ex quia accusamus qui aut ratione sint consequatur.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(3, 287, 15, 'accepted', '56.35', 3, 'Blanditiis ut facilis eligendi rerum dolorum natus. Consectetur aliquam sint quisquam ullam error quos veniam. Enim numquam eos quia occaecati. Vero commodi ab deserunt iure quis.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(4, 290, 17, 'accepted', '52.84', 4, 'Recusandae officia repudiandae doloribus necessitatibus. Est qui quae minus ipsum cumque blanditiis quod. Tempora ipsam deserunt natus et molestiae adipisci illum.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(5, 293, 19, 'rejected', '43.08', 5, 'Dolorem repudiandae cupiditate vero sit. Nam unde qui repudiandae inventore.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(6, 296, 21, 'accepted', '83.29', 6, 'Deserunt voluptates delectus voluptates doloribus occaecati quas. Ullam a aspernatur quisquam vitae repellat.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(7, 299, 23, 'accepted', '81.89', 7, 'Nam sed aut et excepturi. Aut sit fugit eveniet velit voluptatum et. Illum consequuntur quisquam omnis aliquam aperiam.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(8, 302, 25, 'pending', '40.23', 8, 'Et omnis assumenda quo qui. Impedit id ipsam qui et. Eaque facere enim autem et quisquam dolorem. Ab officiis molestiae quis qui nobis.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(9, 305, 27, 'rejected', '84.46', 9, 'Repudiandae assumenda quasi hic ut recusandae id sed nihil. Et cupiditate itaque inventore rerum ipsam molestiae et atque. Nemo enim qui sed qui sit vero quod.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(10, 308, 29, 'rejected', '45.84', 10, 'Vitae laborum odit officiis. Impedit in ut id ipsum quo fugit. Eius fugiat iste consequuntur iure. Facere quibusdam et dolores magnam tenetur accusamus eligendi.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(11, 311, 31, 'rejected', '41.36', 11, 'Nostrum sed omnis molestiae. Ratione eaque enim est ipsum. Eum minus sint quos ut rerum voluptatem. Tenetur recusandae aut et facere rem maxime.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(12, 314, 33, 'accepted', '77.59', 12, 'Perferendis laborum quo aut earum et dolorem. Aut eum provident aliquid sit odio. Voluptate nesciunt consequatur eos aspernatur sed totam ut aut.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(13, 317, 35, 'pending', '41.86', 13, 'Ut non eaque illo rerum. Autem molestiae molestiae occaecati. Natus quaerat enim voluptatibus amet dolore labore.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(14, 320, 37, 'pending', '29.86', 14, 'Deserunt aut ut hic. Eum fugiat aut ut consequatur quidem. Soluta aut fugiat iusto. Optio ut dolorem eius laboriosam ullam fugiat.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(15, 323, 39, 'rejected', '92.55', 15, 'Ducimus qui dolores voluptatibus amet quaerat non consequuntur. Earum atque qui doloribus eum. Minus quia id minima sit aut.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(16, 326, 41, 'rejected', '35.25', 16, 'Dolor ut quae facere omnis dicta unde veniam. Similique et placeat sit id rerum suscipit tenetur. Nobis quis sequi doloribus doloremque ut officia. Vel labore ullam autem sit vitae maxime odio.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(17, 329, 43, 'pending', '96.66', 17, 'Alias blanditiis provident cupiditate quisquam minus. Molestiae et praesentium et consectetur esse. Quia omnis nihil dolor in et non.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(18, 332, 45, 'rejected', '48.85', 18, 'Repudiandae dolor labore at enim doloremque libero. Laborum perspiciatis voluptas aut et est fugiat. Pariatur optio nesciunt qui illo dolor magni. Deserunt qui omnis quo est in voluptatem.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(19, 335, 47, 'pending', '81.43', 19, 'Quidem cumque omnis fugit qui. Quia consequuntur ut praesentium autem dicta eos. Hic excepturi dolor deserunt et consequatur quae. Nostrum voluptas molestiae odio id.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(20, 338, 49, 'rejected', '52.38', 20, 'Magnam dolorem delectus perspiciatis dignissimos reiciendis. Dolores cum reiciendis sit pariatur. At iure fuga est tempora incidunt illum veniam. Est architecto omnis voluptate maxime quo inventore.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(21, 341, 51, 'accepted', '56.12', 21, 'Suscipit dicta non occaecati consequatur temporibus voluptatem. Similique alias quia nihil similique ut. Pariatur distinctio vel molestias quos reprehenderit. Laboriosam eligendi sunt soluta quae.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(22, 344, 53, 'rejected', '79.44', 22, 'Autem facilis similique quia repellat quod in sit. Corrupti dolor repellat adipisci sed alias sunt quia. Quis omnis veniam est porro et sit.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(23, 347, 55, 'accepted', '89.32', 23, 'Beatae et velit labore laboriosam veniam hic eveniet. Dolores sit et modi et quia tempore voluptatem. Et incidunt dolorem et dicta dolores deserunt.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(24, 350, 57, 'rejected', '89.6', 24, 'Nihil sunt non non ipsa. Soluta earum beatae modi eligendi deserunt in.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(25, 353, 59, 'pending', '76.08', 25, 'Esse dolore eaque occaecati quam aliquam assumenda earum. Minima exercitationem dolorem aut et molestias dolorem. Placeat repellat eos nihil qui dignissimos minus odio. Quae et aut quo rem neque.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(26, 356, 61, 'rejected', '43.46', 26, 'Quaerat qui ut ut corporis accusamus esse est in. Reiciendis nobis deleniti asperiores. Tempore quo adipisci illum dignissimos minima nesciunt eum. Unde ea omnis accusamus dolore aut dolor.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(27, 359, 63, 'rejected', '31.23', 27, 'Voluptatum vel omnis libero inventore ut quam. At et officia voluptatibus et. Et architecto sint et eos eos asperiores aut. Aut placeat nesciunt ipsam est eius.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(28, 362, 65, 'pending', '73.87', 28, 'Quasi reiciendis est excepturi ut error ipsam sint. Ut voluptas tempora rem rerum et voluptate. Doloribus mollitia et enim libero ea.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(29, 365, 67, 'pending', '63.83', 29, 'Corporis suscipit quisquam perspiciatis saepe reiciendis. Aliquid occaecati aut ipsa assumenda quod aperiam modi. Labore quaerat quidem error eveniet.', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(30, 368, 69, 'pending', '83.46', 30, 'Aut omnis occaecati iusto eaque. Beatae laudantium sunt non optio. Ex consequuntur laudantium qui commodi.', '2025-06-01 11:28:53', '2025-06-01 11:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `event_requirements`
--

CREATE TABLE `event_requirements` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_requirements`
--

INSERT INTO `event_requirements` (`id`, `event_id`, `sub_category_id`, `price`, `country_currency`, `created_at`, `updated_at`) VALUES
(1, 12, 41, '676.06', 'ERN', '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(2, 14, 42, '225.82', 'KES', '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(3, 16, 43, '159.99', 'CDF', '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(4, 18, 44, '613.66', 'RWF', '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(5, 20, 45, '499.59', 'GEL', '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(6, 22, 46, '595.87', 'AFN', '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(7, 24, 47, '574.29', 'KRW', '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(8, 26, 48, '771.05', 'LYD', '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(9, 28, 49, '437.06', 'DOP', '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(10, 30, 50, '694.04', 'AFN', '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(11, 32, 51, '654.83', 'SOS', '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(12, 34, 52, '182.35', 'OMR', '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(13, 36, 53, '378.43', 'AED', '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(14, 38, 54, '721.42', 'CUC', '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(15, 40, 55, '695.33', 'MZN', '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(16, 42, 56, '224.69', 'AUD', '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(17, 44, 57, '599.32', 'HNL', '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(18, 46, 58, '239.99', 'MDL', '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(19, 48, 59, '477.52', 'DZD', '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(20, 50, 60, '900.39', 'MZN', '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(21, 52, 61, '180.41', 'IDR', '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(22, 54, 62, '579.84', 'MGA', '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(23, 56, 63, '671.7', 'MKD', '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(24, 58, 64, '114.54', 'THB', '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(25, 60, 65, '435.61', 'JOD', '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(26, 62, 66, '578.74', 'GYD', '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(27, 64, 67, '627.51', 'IRR', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(28, 66, 68, '472.26', 'ANG', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(29, 68, 69, '583.42', 'MMK', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(30, 70, 70, '382.3', 'MDL', '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(31, 71, 71, '629.74', 'SLL', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(32, 72, 72, '670.14', 'BYN', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(33, 73, 73, '697.79', 'MKD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(34, 74, 74, '303.46', 'MDL', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(35, 75, 75, '650.85', 'BIF', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(36, 76, 76, '26.29', 'JOD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(37, 77, 77, '66.06', 'PYG', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(38, 78, 78, '936.53', 'SBD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(39, 79, 79, '561.02', 'CAD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(40, 80, 80, '601.38', 'XPF', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(41, 81, 81, '344.71', 'TMT', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(42, 82, 82, '415.07', 'IDR', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(43, 83, 83, '159.88', 'BND', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(44, 84, 84, '826.2', 'JOD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(45, 85, 85, '84.07', 'GTQ', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(46, 86, 86, '692.15', 'AUD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(47, 87, 87, '349.77', 'HUF', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(48, 88, 88, '458.81', 'PYG', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(49, 89, 89, '512.67', 'TMT', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(50, 90, 90, '628.11', 'BSD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(51, 91, 91, '372.92', 'VND', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(52, 92, 92, '165.46', 'LAK', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(53, 93, 93, '78.35', 'HNL', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(54, 94, 94, '728.9', 'USD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(55, 95, 95, '865.47', 'SEK', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(56, 96, 96, '517.62', 'KGS', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(57, 97, 97, '191.55', 'BSD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(58, 98, 98, '182.08', 'SRD', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(59, 99, 99, '490.99', 'HNL', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(60, 100, 100, '439.56', 'LSL', '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(61, 131, 2, '50.00', 'USD', '2025-06-01 13:48:32', '2025-06-01 13:48:32'),
(62, 131, 3, '75.00', 'EUR', '2025-06-01 13:48:32', '2025-06-01 13:48:32'),
(63, 132, 1, '300', 'USD', '2025-06-02 08:42:26', '2025-06-02 08:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `user_id`, `title`, `description`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gaming Dealer', 'Itaque hic alias odit optio maxime voluptas voluptate. Laboriosam placeat praesentium et est debitis cupiditate et. Placeat dolore dolorum nihil quo harum voluptatem alias.\n\nAccusantium porro qui consequatur recusandae mollitia eos. Nihil quo recusandae aut. Non nesciunt distinctio aut et. Velit eos qui expedita adipisci quo repudiandae.\n\nSunt cupiditate perferendis voluptatem non possimus quia. Est atque sed itaque optio omnis consequatur. Architecto consequuntur aut enim ut in. Voluptas non necessitatibus perspiciatis quo quidem.', '2022-06-14', '2023-07-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(2, 2, 'Transit Police OR Railroad Police', 'Tempora iste quia sed sed quia quibusdam. Est sequi corrupti autem molestiae. Cupiditate et ut ea velit minus.\n\nAliquam et ullam et dolor. Et est aut optio et quibusdam ex. Qui officiis deleniti minus voluptatem. Eos ducimus labore consequatur similique eius.\n\nNon ipsum velit omnis exercitationem. Dolores fuga nostrum atque sint nisi in. Sit quaerat dolores eos velit totam. Dolorum repellendus aliquid itaque.', '2020-08-09', '2023-07-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(3, 3, 'Musical Instrument Tuner', 'Eum eius earum at et. Doloremque optio voluptas quia doloribus provident. Consectetur quisquam at ex. Minima est laborum sit omnis quos velit.\n\nBlanditiis eos tempora eum eaque sint enim iste. Odit et et laudantium neque architecto sunt rem. Possimus minima facere qui ab quaerat excepturi aut. Aut exercitationem doloremque suscipit.\n\nNumquam accusamus omnis animi esse nisi corporis. Voluptates excepturi suscipit placeat id omnis. Reprehenderit necessitatibus quasi aut beatae tempora ut et.', '2017-02-18', '2025-04-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(4, 4, 'Opticians', 'Ipsam inventore qui labore. Omnis voluptatem voluptatem aut dignissimos et voluptas. Eos est molestiae libero assumenda et quisquam maxime. Qui est occaecati est ut ea quis magnam.\n\nEt necessitatibus aut aut vel natus deleniti dolores. Aspernatur corporis omnis temporibus dolor incidunt accusamus a voluptatem. Et velit error fugiat corrupti sit nemo rerum officia. Maxime consequuntur recusandae qui dolorem accusamus ipsum ut asperiores.\n\nEt quia omnis labore voluptas dolores. Sunt officiis ducimus cupiditate. Doloribus nobis harum culpa architecto temporibus aut eaque. Et laborum minima quis illo deserunt molestias repellendus.', '2021-10-31', '2023-07-19', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(5, 5, 'Rehabilitation Counselor', 'Aliquid ratione qui qui suscipit aut ut. Quas maiores repudiandae laudantium rerum reiciendis aut. Eaque ad itaque nobis voluptates omnis et.\n\nEt quisquam nemo culpa qui. Rerum enim ex asperiores est aut voluptatem dolores dignissimos. Asperiores fugiat aliquid officia nihil illo sunt dolores.\n\nOdio impedit sit consequatur voluptate eos. Et sed officia voluptas quod debitis amet. Natus velit quia occaecati est necessitatibus et culpa praesentium.', '2022-03-31', '2024-01-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(6, 6, 'Food Science Technician', 'Doloribus vel tempora dolor. Placeat accusamus nihil sunt. Veniam et quasi ad nulla nemo. Omnis illum vero aperiam eligendi maiores perspiciatis eum.\n\nDolore maiores aut consequatur iste quisquam consequuntur. Voluptatem minus aut deserunt saepe distinctio. Dignissimos natus enim assumenda. Cumque quod reprehenderit rerum et eum atque.\n\nIn deleniti consequatur voluptatem repellendus impedit. Quaerat eos veniam magni explicabo ab cum. Maxime qui sint ut.', '2015-08-12', '2023-06-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(7, 7, 'Stonemason', 'Id mollitia labore porro nihil quos similique. Id ipsa amet quia corrupti. Similique pariatur nam asperiores. Ratione quisquam et qui et animi. Enim ea molestias fugiat doloremque explicabo itaque.\n\nFacere in consequatur in et ipsa. Sapiente aut ad accusamus optio eos. Voluptatem autem nam sit autem.\n\nEt rerum nesciunt ipsum voluptatum nemo beatae. Illo rem laboriosam repudiandae odit tempore alias quia. Exercitationem ullam enim qui impedit dolorum quia nulla. Ut harum voluptatibus reiciendis.', '2019-11-29', '2023-09-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(8, 8, 'Geographer', 'Nisi amet asperiores et commodi ea. Eum nihil est maxime eos modi laudantium. Quisquam et est aliquid voluptatem maiores quod voluptate cum. Aliquam aut amet rerum quo.\n\nAnimi unde voluptas quae amet ut ut ut. Numquam excepturi dicta dolores sint. Non veniam nihil laborum animi sapiente.\n\nPossimus qui nihil voluptatem quam dicta omnis. Molestias aliquam in eos et. Expedita cumque molestiae ea eum.', '2019-08-04', '2023-07-23', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(9, 9, 'Airline Pilot OR Copilot OR Flight Engineer', 'Minus aut et vero quia itaque qui perspiciatis. Inventore est modi repellendus sed sint doloremque quo.\n\nProvident autem consequatur aliquam et. Placeat dolorem quidem enim magnam. Molestias explicabo tempora optio delectus eveniet.\n\nEum ullam minima perspiciatis et. Pariatur possimus consequatur voluptatem aliquid in expedita quia. Non libero omnis quasi et maiores. Placeat voluptatum voluptatem modi labore aperiam repellat.', '2017-01-13', '2024-05-17', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(10, 10, 'Pipefitter', 'Facere accusantium incidunt nihil consequatur velit et. Itaque culpa ut minus rem. Autem et provident voluptatem et fugiat voluptatibus. Magni minima consequatur id natus enim iure.\n\nAliquam deserunt minus odio ipsum rem earum iste. Odio commodi non impedit. Rerum harum dolore quibusdam voluptate.\n\nUt sed quasi aliquid distinctio. Sapiente quia quia atque voluptas impedit rerum quod id. At consequatur id sit. Deleniti incidunt rem quia minus veniam sit non.', '2016-04-20', '2023-06-22', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(11, 11, 'Insulation Worker', 'Nobis assumenda dolores iste dicta accusamus ut inventore. Non beatae minus sed quia cupiditate nobis ducimus. Rerum ipsam ducimus doloribus ad.\n\nExpedita et ipsum ea. Error ut eum dolores aliquid corporis. Alias tempore non optio assumenda. Adipisci ducimus consequuntur ut praesentium.\n\nOfficia quibusdam dolore molestiae accusantium quam qui dolor. Fuga veniam in est et ullam facilis quae. Architecto in voluptas et repudiandae officia voluptatem. Accusamus harum sit qui ut.', '2018-05-17', '2024-02-17', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(12, 12, 'Model Maker', 'Non quidem explicabo necessitatibus ut debitis. Est perspiciatis culpa ut ab porro vitae. Natus cum aut corrupti ea sapiente harum adipisci.\n\nVel quos dolores distinctio molestiae. Animi officiis rerum et. Quod ut sequi tempore soluta distinctio qui laborum esse. Doloribus sint consectetur ut autem.\n\nNam architecto et excepturi minima dolorem dolores. Tenetur quos facilis ipsam aut rem voluptatem vitae. Accusamus consequatur amet est temporibus ut qui nihil quis. In labore ut nihil odit voluptatum corrupti.', '2021-01-24', '2024-05-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(13, 13, 'Statement Clerk', 'Cumque repudiandae ut illo cum natus. Ipsa rerum ad et quam. Accusamus omnis vitae rerum. Eligendi et eveniet tempore quam mollitia ut.\n\nOptio placeat sequi optio asperiores accusantium enim doloribus dolores. Doloremque nihil ipsa et quia. Quidem eaque et consectetur provident accusantium fugiat eius eum. Quis porro rem ut ipsam atque expedita qui.\n\nQuia eos corporis hic eum sint voluptates. Dicta quae magnam harum et numquam. Dolorum assumenda magnam assumenda quasi. Repudiandae deleniti id quaerat excepturi et.', '2023-05-24', '2024-11-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(14, 14, 'Psychiatric Aide', 'Quia est vel maiores et. Quaerat omnis dolorem perferendis quia dolores nihil.\n\nUt aut accusamus sunt. Rerum omnis eum excepturi est quibusdam et. Vel qui modi molestiae accusantium ut ad. Similique fugiat aperiam recusandae ab quas saepe.\n\nEt qui dicta at. Et dolor quo illo blanditiis et reiciendis ullam. Quo in autem et minima. Sapiente eos voluptatem ut est voluptas.', '2018-08-03', '2024-03-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(15, 15, 'Religious Worker', 'Et accusantium odio voluptatem et. Culpa mollitia a facere odio qui id.\n\nMagnam ipsam ducimus in in tempora minus veniam. Pariatur sit aut voluptatum necessitatibus provident architecto omnis corporis. Consequatur iste incidunt esse est cupiditate. Fugit aut quisquam ut sit.\n\nAliquam doloribus dolores ab omnis qui enim. Consectetur cum a delectus recusandae corrupti reiciendis accusantium. Corrupti et ab officiis id. Qui libero quae laudantium mollitia accusantium ea.', '2016-08-29', '2023-12-10', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(16, 16, 'Amusement Attendant', 'Ut sunt deserunt iste laborum architecto. Fugiat soluta est dolor suscipit occaecati delectus rerum. Totam non reprehenderit eum voluptas.\n\nCum est cumque maiores voluptas ratione. Delectus voluptatem cupiditate consequatur consequatur dolore dicta quo. Vel repudiandae vero ut eveniet fugiat sed. Facere nisi consequatur animi consequatur. Vel nesciunt nam eligendi expedita debitis itaque repudiandae accusamus.\n\nEst voluptas nam quia enim atque. Deleniti et sint nihil enim. Nemo pariatur soluta dolore accusantium aut ut tenetur.', '2020-08-19', '2023-11-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(17, 17, 'Medical Appliance Technician', 'Quas amet vel odit iste molestiae doloribus dolorum. Sequi ut mollitia sunt. Et est praesentium quia repudiandae incidunt odio. Autem aut sit consectetur dolorem sint necessitatibus aliquid.\n\nQuo nisi magni in reiciendis distinctio voluptatem. Quos voluptas nesciunt consectetur veritatis quia quia dicta. Deserunt nulla voluptate vel veritatis.\n\nLaudantium porro sequi delectus molestiae non. Voluptatem atque consequuntur ab non doloribus. Harum sunt ipsam quidem incidunt alias non repudiandae. Repellendus quas sit accusantium possimus commodi rerum aperiam.', '2019-06-14', '2023-11-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(18, 18, 'Surveying Technician', 'Illum sit vero a tempora. Delectus praesentium quibusdam eaque quia id voluptatum deleniti. Officia maiores eum recusandae et laborum ea itaque. Saepe labore rerum omnis esse voluptatem nihil ea.\n\nEt ut quis sapiente nisi et. Nulla recusandae in aut consequuntur corporis dolorem harum. Fugit dolorem earum aperiam deserunt. Eveniet corrupti harum nemo vero.\n\nDolores ab magnam qui harum. Voluptas nemo corrupti perferendis temporibus. Incidunt qui enim beatae sed quo dolore sit. Perferendis voluptatum ratione dicta fugit et rerum.', '2021-09-05', '2024-06-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(19, 19, 'Word Processors and Typist', 'Amet culpa voluptatum placeat similique in voluptatibus non. Odio soluta doloremque possimus qui deleniti voluptatem rerum.\n\nSimilique iusto ut dolorem labore qui. Qui blanditiis repudiandae illum animi perferendis assumenda voluptate. Sunt ut blanditiis officia ut enim similique velit. Rerum quaerat voluptas eius cupiditate nihil quisquam totam.\n\nUnde temporibus nisi beatae nemo recusandae. Et quia aliquam eos saepe dolor qui nisi reiciendis. Placeat quibusdam natus numquam.', '2019-04-01', '2025-02-02', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(20, 20, 'Electromechanical Equipment Assembler', 'Et cumque nihil animi et harum ipsum. Similique ratione doloremque repellendus dolor nisi corrupti. Blanditiis maiores exercitationem ut et.\n\nQuidem ipsam ea inventore quo non cum. Maiores dolorem repudiandae libero.\n\nBlanditiis dolorem qui quo perspiciatis perferendis culpa consequatur. Qui accusantium delectus quia qui esse consequatur.', '2018-06-27', '2023-11-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(21, 21, 'Buyer', 'Ipsam repudiandae sit atque perferendis maiores eum. Nam omnis omnis architecto voluptate in. Esse odio ut esse veritatis excepturi nihil rerum. Ipsam quasi sed inventore voluptas numquam.\n\nDignissimos beatae sint odit quo amet qui. Quam atque quam maiores explicabo. Sint aspernatur consequatur facilis aut.\n\nUt qui recusandae velit rem voluptate maxime sunt. Nulla quo itaque occaecati cum sequi molestias. Aliquid eum exercitationem maxime non est fugiat at. Ad non facilis esse ut vel. Repellendus praesentium vero eligendi ratione sapiente ipsa possimus.', '2022-07-10', '2024-03-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(22, 22, 'Manager Tactical Operations', 'Ad tenetur dignissimos sunt ipsa consequatur architecto. Est dolorem nesciunt aut consectetur libero quis et saepe. Quasi debitis maxime fugit rem ea.\n\nNon commodi molestiae asperiores ab inventore. Inventore impedit eos aut. Sequi explicabo impedit saepe ex expedita voluptatem id.\n\nNemo hic illum similique est qui odio. Praesentium ut vel sit architecto id. Eaque numquam qui repellat aut corrupti est natus. Aut voluptas aspernatur omnis officiis possimus.', '2019-11-03', '2024-08-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(23, 23, 'Director Of Social Media Marketing', 'Facilis illo est ut eligendi reiciendis cupiditate. Consequatur corporis minus voluptas et. Exercitationem pariatur sit sed veniam. Debitis voluptas et voluptatem ab in quia.\n\nNeque perspiciatis aperiam a eius. Dolorem omnis tempore saepe delectus et vel. Cupiditate consectetur sunt enim eligendi qui. Similique quam exercitationem autem et. Consequatur enim fugit eum deleniti.\n\nOfficiis quaerat voluptatem non adipisci voluptatem quaerat repellat velit. Quia quia voluptas quas deleniti. Quia sapiente eum recusandae suscipit perferendis necessitatibus. Sit consequuntur quia porro praesentium in blanditiis ut sed.', '2020-08-05', '2024-06-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(24, 24, 'Warehouse', 'Ducimus fugiat in voluptatum nemo vero vel rerum. Pariatur repellendus autem quaerat quod modi labore et soluta. Architecto et ut occaecati consequatur. Explicabo at consequatur corporis veniam dolor eaque quo. Laudantium nisi incidunt aliquid fugiat adipisci.\n\nSed excepturi ipsum ut voluptatum. Veniam nobis necessitatibus et. Doloribus et assumenda et aut minus voluptates necessitatibus nihil.\n\nMagni exercitationem voluptas sed consequatur ullam. Qui ipsum corporis facere nesciunt natus dolores. Minima est saepe id facere.', '2015-11-25', '2024-12-22', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(25, 25, 'Telephone Operator', 'Quia sapiente est voluptatem magnam tempora molestiae eum. Illo odio minima ullam dolor consequatur natus adipisci. Sint provident nobis illum iure quae et.\n\nSint dolorem id repellat dicta rerum ipsum aut. Ut nihil officia exercitationem similique. Totam hic ea tempore quaerat quam blanditiis soluta.\n\nQuam ut perferendis maxime quo esse omnis. Molestiae libero doloribus in qui. Dicta explicabo occaecati sit et dolore est quis. Eius pariatur quaerat nobis molestias quae enim.', '2017-11-06', '2025-01-16', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(26, 26, 'Marine Cargo Inspector', 'Et voluptate itaque natus non itaque veritatis maiores. Nisi qui voluptatem cupiditate voluptatem est vero voluptatem. Commodi voluptatibus eius at voluptas possimus et quo id. Veniam quos provident qui eius.\n\nVeniam incidunt explicabo molestiae et qui quibusdam. Necessitatibus impedit adipisci dolor labore iusto voluptas omnis. Aut eos incidunt fugiat deserunt repellat sed.\n\nIpsa aut enim officia rerum accusamus maxime et. Cum magnam non at. Voluptate et consequatur vel neque amet laborum magni et.', '2022-06-03', '2024-09-07', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(27, 27, 'Order Clerk', 'Repellat consequatur facere ipsam molestiae deserunt dignissimos distinctio ad. Soluta temporibus rem accusantium est. Eum blanditiis nihil sapiente. Eligendi necessitatibus vel similique.\n\nLaborum consequatur in tempore et. Maxime incidunt et atque veritatis animi corrupti vel. In et ipsa quod at distinctio sed culpa. Rerum eum quaerat ut sint et voluptates.\n\nAlias dicta dolorem dolore nihil enim. Totam in excepturi sint facere. Qui nemo atque ut aliquam. Beatae ut enim nihil.', '2018-01-11', '2023-12-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(28, 28, 'Personal Trainer', 'Et officiis nisi rem consequatur. Asperiores sed perferendis suscipit voluptas suscipit minima voluptates. Harum rem et porro saepe deleniti est.\n\nEius itaque impedit voluptatem quisquam enim recusandae minus. Facere minima expedita perspiciatis nobis aut quod. Esse modi molestias et sunt quo possimus ut.\n\nSed in at qui quas. Natus et qui non. Aliquid quo perferendis corporis incidunt. Pariatur quos est omnis neque molestias expedita.', '2020-07-07', '2024-04-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(29, 29, 'Mental Health Counselor', 'Aut voluptates voluptate perspiciatis esse dolorem. Dolores explicabo nisi eum et. Velit sit mollitia rerum quod. Facilis itaque sunt et magni expedita quae.\n\nLaboriosam aliquid deleniti sint ea impedit dolorem eum velit. Facilis accusantium pariatur et est asperiores officiis quidem reprehenderit. Inventore odit odit laudantium et animi debitis quod. Et expedita autem delectus et vel. Laborum id nam et enim ut maiores.\n\nRerum eaque tenetur sed nam. Repudiandae fuga totam ut non voluptas. Dolore libero non aut dolore. Odit molestiae quas molestiae doloremque.', '2019-04-14', '2024-12-13', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(30, 30, 'Cartographer', 'Quia molestiae et quam fugit distinctio magnam expedita. Ut est sapiente eveniet eum sint quam.\n\nIn voluptatem quas non sunt iure quas sunt. Cum quibusdam qui architecto et. Et itaque hic adipisci accusamus dolor. Omnis molestias excepturi veritatis et eius optio cumque assumenda.\n\nNesciunt voluptatem earum eius tempore eligendi quod eveniet consequatur. Adipisci blanditiis commodi odit quos inventore. Quam dolores et qui dolores quia. Qui odio sequi ut et mollitia. Quas harum aliquid tempore perspiciatis.', '2020-07-31', '2025-05-05', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(31, 31, 'Cartoonist', 'Odit commodi explicabo doloremque non. Repellendus eum quibusdam iure distinctio ut. Voluptas delectus aut sint alias cum.\n\nEt repudiandae non illum ipsa. Qui repellendus eius labore minus et velit minima. Et est ut omnis id placeat. Beatae magnam illo laboriosam quia vero quaerat sunt. Est est qui corrupti consectetur ratione porro.\n\nAssumenda repudiandae unde aliquam eligendi non non. Maxime autem a quia a voluptatibus aut. Dolor quas voluptas quos dolor ut laboriosam. Blanditiis est eum aut.', '2020-09-15', '2025-04-07', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(32, 32, 'Transportation Manager', 'Delectus odio quo possimus vel occaecati. Qui praesentium non quos eaque labore eum exercitationem velit. Qui consectetur in quaerat placeat aliquid fugit maiores.\n\nAssumenda qui ipsa hic tempora ullam. Architecto dolor nobis harum recusandae eos. Debitis vel molestiae expedita voluptatem. Aut voluptatibus repellendus quia et cupiditate libero consequuntur beatae.\n\nQuibusdam aut rem iure modi aspernatur voluptatibus. Sit dolor blanditiis molestiae magnam in. Aut explicabo non quos ea eveniet sunt qui.', '2018-07-31', '2023-11-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(33, 33, 'Fashion Designer', 'Cumque corporis vel alias sint vitae. Ipsam cum et delectus consequatur. Harum et quos nemo dolores.\n\nTenetur necessitatibus tempore facilis ut. Iure adipisci magni vero sit. Sit facere dolor ullam rerum aspernatur cupiditate fugiat. Est dicta nemo voluptas necessitatibus odio.\n\nLibero possimus itaque deserunt atque. Soluta voluptates deserunt quia. Ipsum accusamus praesentium aut. Architecto quia consequatur tempore.', '2017-06-30', '2023-06-22', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(34, 34, 'Respiratory Therapist', 'Sed distinctio ducimus quidem necessitatibus quod. Fugit enim omnis qui. Nemo earum dignissimos consequatur consequuntur dicta blanditiis. Soluta cum est necessitatibus ducimus nisi est.\n\nCum facere cupiditate et maxime. Cupiditate molestias molestiae dolore. Nesciunt et soluta est dicta fugit sunt quas. Iusto sint suscipit laboriosam praesentium unde omnis.\n\nSed et quam sed qui aliquam quia. Sed distinctio nobis est cum expedita aut. Sint corrupti mollitia omnis cupiditate eius.', '2019-08-17', '2025-03-31', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(35, 35, 'Council', 'Sequi qui eum laudantium voluptatem consequuntur sint a neque. Autem quisquam sed dolores. Tenetur explicabo fugit velit repellendus consequatur optio quod debitis. Et dolores aut et nisi esse exercitationem non.\n\nRecusandae eos fugiat nisi libero earum aut dolor. Temporibus totam laborum veniam at. Similique ut dolorum nesciunt qui quasi. Excepturi quo repellendus explicabo nostrum rem et. Corporis sint molestiae in asperiores.\n\nNon et non consectetur molestiae vel rerum. Eum deleniti asperiores et repellendus beatae. Earum sequi nesciunt consequatur atque ea in. Fugiat eius a rerum nulla eligendi odio nihil perspiciatis. Modi quisquam aut beatae asperiores.', '2020-01-03', '2024-04-10', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(36, 36, 'Railroad Yard Worker', 'Id aut sunt debitis est dolore. Quibusdam dolorum omnis hic quo quidem consequatur error. Reiciendis quae quam harum non quia non vel. Cupiditate ipsum in nisi quia.\n\nId ut animi qui dicta recusandae tenetur explicabo deleniti. Ipsam consequatur autem numquam laborum qui illum harum unde. Qui ea aut magnam ut qui.\n\nQuia commodi quod ea dolores molestiae aliquid. Laborum ut qui in vel voluptatem est aliquid soluta. Omnis et earum iusto nostrum placeat eaque dolore possimus. Laudantium corrupti reiciendis et enim quam repudiandae.', '2018-06-14', '2025-04-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(37, 37, 'Door To Door Sales', 'Voluptatibus vel adipisci et ut aliquam quasi omnis. Voluptas nesciunt quia iure veritatis. Ut nemo delectus facilis nostrum corporis dignissimos. Iure suscipit voluptatum et nihil molestiae voluptatum omnis.\n\nModi nesciunt consectetur quis deleniti et. Ipsa commodi reprehenderit omnis et deleniti cupiditate.\n\nQuaerat voluptatibus nesciunt assumenda et distinctio. Eum corrupti ut laboriosam accusantium. Id architecto commodi velit libero voluptatum est.', '2017-07-23', '2024-08-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(38, 38, 'Recreation Worker', 'Nam aspernatur non amet pariatur. Et illum laudantium id nisi ut. Nam voluptatem laboriosam voluptas qui sit libero quam beatae.\n\nSunt dolore dolor accusamus provident voluptatibus ut repellat. Sunt inventore voluptas sequi. Ex quia officiis maxime.\n\nSed earum quibusdam est corporis. Ut qui rem in ea odio.', '2019-08-20', '2024-05-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(39, 39, 'Animal Husbandry Worker', 'Corporis cumque praesentium enim et consequatur. Velit porro sit quo voluptas. Enim eos impedit voluptatem voluptas libero occaecati ut.\n\nQuibusdam ullam laudantium rerum. Sunt placeat earum eius sint.\n\nSoluta unde adipisci corporis. Mollitia ut odio sapiente dolor nesciunt dignissimos facere. Qui in qui ut et aliquid voluptatem.', '2018-06-01', '2023-10-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(40, 40, 'Judge', 'Ut rerum molestiae architecto iure est fugiat iure. Mollitia placeat repellat necessitatibus. Voluptatum adipisci id fugiat praesentium quae.\n\nEt dolor in porro exercitationem laboriosam. Quae tempora omnis enim quo sunt nulla. Delectus tempora odio quos ut labore in quos.\n\nVoluptas sint impedit in perferendis ut eligendi. Doloremque odio fugit deserunt eius cupiditate. Adipisci dolores labore omnis eaque delectus. Ipsam deserunt quia quos rerum unde.', '2020-06-12', '2024-10-12', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(41, 41, 'Food Service Manager', 'Dicta tenetur delectus sit temporibus. Qui sunt in necessitatibus excepturi odio. Maiores pariatur illo et et. Sequi iusto nisi tempore reiciendis architecto.\n\nDolor nisi veniam est id. Cumque reprehenderit consequuntur ad maiores. Et quo optio ad earum aut commodi.\n\nTempora quia magnam odio dicta. Mollitia officia qui qui delectus. Qui voluptatem et sed est et corporis quisquam. Recusandae et iusto vel nulla ut debitis rerum sit.', '2018-12-16', '2024-03-20', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(42, 42, 'Computer Systems Analyst', 'Deserunt voluptates id facere voluptatem. Ipsum inventore accusamus aperiam architecto debitis in rerum. Autem molestiae est provident tenetur laborum repellendus consequatur.\n\nQuia magnam voluptatem repudiandae ea dicta. Tempora aut quaerat cupiditate nihil optio dolorem recusandae. Aperiam culpa vero amet.\n\nEnim ipsa et eos. Impedit non eum repellat facere aliquid aut. Explicabo et harum distinctio. Est excepturi officia est consequatur totam facere dolores.', '2015-09-07', '2025-04-02', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(43, 43, 'Engineering', 'Adipisci fuga aperiam quidem numquam. Officiis ad debitis quo nulla. Commodi eligendi veniam ipsa quibusdam et accusamus. Laboriosam sit laboriosam ea labore blanditiis sit. Quasi enim facere ab et id odit.\n\nCulpa aut sed aut aut blanditiis minima et. Odit voluptatibus autem eveniet nobis ratione. Praesentium quasi sunt provident dicta veritatis et.\n\nDolore in et omnis repellendus. Ea soluta iure pariatur voluptas et possimus reprehenderit ut. Ipsum voluptatem corrupti rerum dolor maxime ut. Suscipit non porro officia.', '2017-10-06', '2024-05-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(44, 44, 'Anesthesiologist', 'Voluptatem similique deleniti ut suscipit adipisci architecto minus. Est sint sit repudiandae aspernatur. Enim quae pariatur rem est sint.\n\nLaborum recusandae at eum. A perspiciatis veniam tempore sed reprehenderit quasi repellendus. Laudantium veritatis aspernatur iusto rerum. Temporibus odio fuga tenetur necessitatibus.\n\nDolores magnam ut qui modi ad. Saepe provident pariatur quis vero minima ipsa. Quisquam tempora temporibus et voluptatibus. Ut impedit praesentium repellat quibusdam dolores odio ipsa veniam.', '2018-02-13', '2023-08-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(45, 45, 'Office Machine Operator', 'Quibusdam error harum qui. Repudiandae voluptatem nisi aut facilis saepe quaerat. Qui porro tempora velit vitae perferendis.\n\nUt beatae eligendi culpa voluptates. Quibusdam qui debitis quo maxime. Est aut quibusdam mollitia vero ex. Eligendi qui culpa alias eveniet sapiente voluptatibus autem eos.\n\nSit et animi quasi praesentium voluptatibus accusantium. Et ipsa quia similique sit fuga itaque quia. Voluptas doloribus mollitia quos laborum.', '2016-03-21', '2024-03-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(46, 46, 'Library Science Teacher', 'Hic nulla ut rem quis. Vel repellendus est vel.\n\nError quos blanditiis vel ipsa sint ea culpa. Fugiat facilis quasi enim doloribus dolore exercitationem nisi. Quae illo nesciunt rerum qui esse aut consectetur. Sit delectus vero dolor accusantium occaecati.\n\nSaepe cumque et ratione in magni enim dolorem sint. Sint perferendis vero explicabo est libero laudantium. Esse adipisci autem eum unde dolorem quam tempora nostrum.', '2018-01-10', '2025-03-26', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(47, 47, 'Health Specialties Teacher', 'Id et numquam a quia. Officia quia commodi mollitia ducimus quis corporis ut. Alias fugit totam qui consequuntur.\n\nFuga aut libero officiis harum laboriosam. Deserunt aspernatur laudantium qui sit molestiae cupiditate. Quia nam sit incidunt voluptatem omnis.\n\nPerferendis quasi in aut numquam magnam aut. Placeat beatae et beatae aliquam ullam aperiam vitae. Aliquam doloremque nemo nisi consectetur a aut facere.', '2019-12-24', '2023-11-11', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(48, 48, 'CSI', 'Debitis qui sit et voluptatum et quo non. Deserunt ipsum iusto officiis temporibus eaque consequuntur aut. Explicabo provident consequuntur suscipit quasi eveniet aut voluptate. Ea provident enim optio et expedita molestiae.\n\nVitae eos molestiae repellendus consequuntur doloribus occaecati aperiam. Rerum eum in voluptatem aperiam. In dicta voluptatibus omnis quod similique. Nesciunt dolorem perspiciatis facere et adipisci pariatur suscipit.\n\nQuidem nihil et vitae corporis. Tempore commodi non reprehenderit et ut non ut totam. Excepturi impedit aut atque non qui. Et fugiat amet praesentium exercitationem quod et qui unde.', '2019-04-05', '2024-05-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(49, 49, 'Statement Clerk', 'Cupiditate laboriosam et reiciendis perferendis possimus maxime. Velit aut facilis rerum. Eum ut blanditiis laboriosam ducimus.\n\nEt et exercitationem reiciendis dolorum. Consectetur ut explicabo placeat aliquid. Natus debitis accusantium quisquam autem et quibusdam nobis doloribus. Occaecati omnis dolorum ab.\n\nEa laborum officia praesentium itaque cumque aliquid illum. Numquam aut vel blanditiis ratione alias consequatur. Non et optio cupiditate molestias reiciendis ut.', '2015-11-15', '2024-07-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(50, 50, 'Paperhanger', 'Corporis pariatur cupiditate laboriosam rerum. Cum magni quisquam earum dolores est dolorem at. Assumenda voluptatem eos illum excepturi esse iusto dicta.\n\nAb molestiae reiciendis libero quasi autem cum saepe. Fugiat sunt voluptate voluptatem placeat repellat facilis praesentium consequuntur. Et soluta magni tempore sed rerum aut.\n\nFugit rerum quibusdam aut earum eos libero enim. Quis porro alias consectetur quia est sunt in.', '2019-01-06', '2025-02-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(51, 51, 'Deburring Machine Operator', 'Tenetur perspiciatis voluptatibus consequatur assumenda. Illum facere qui et.\n\nDolores autem praesentium dignissimos ipsam reprehenderit vero. Ea natus quis qui facere. Labore sint molestias nostrum eos porro repellat natus. Sit cum ipsa est voluptas omnis quo aut.\n\nOccaecati consequatur quia aut id quos sit. Quis animi exercitationem iusto voluptatem suscipit incidunt tempora. Et modi hic aut occaecati totam blanditiis saepe. Non libero dolorem error officia quia omnis sit.', '2020-11-12', '2024-02-07', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(52, 52, 'Massage Therapist', 'Voluptas tempore dolorum eius eum omnis molestiae earum. Aliquid nisi voluptas provident culpa eum eos non rem. Et debitis animi quia vel dolore.\n\nUt ut molestias nisi aperiam similique accusantium earum ipsum. Consectetur nisi vitae non voluptate. Placeat aut ut quos sed. Et nam fugiat a esse est temporibus.\n\nEnim amet hic explicabo alias et tempore. Numquam nemo illum id similique nobis facere corporis ea. Est nisi optio tenetur libero. Est sed molestias esse dicta exercitationem et assumenda sed.', '2021-09-24', '2024-04-29', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(53, 53, 'Plate Finisher', 'Atque quaerat quos impedit. Deleniti atque aliquid pariatur voluptatum velit ut. Ipsum officia rerum cupiditate eius.\n\nPossimus et id accusamus sunt fuga sed. Consectetur mollitia veniam quia maiores occaecati culpa. Deleniti in ipsa mollitia alias.\n\nVoluptatem et nam doloribus et nam dicta. Qui aut consequatur ratione officiis nam. Voluptatem quis rem culpa maiores ab delectus sint ut. Harum harum iste ut quia qui tempore.', '2021-03-31', '2024-12-31', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(54, 54, 'Warehouse', 'Nesciunt dolores et ut. Rerum aut ut dicta adipisci illo aliquam. Qui minus est sit eum. Ipsam explicabo illum debitis eum cum et.\n\nVoluptatem et non accusantium a consectetur eius ipsam. Alias id vel ea.\n\nRerum optio similique quo est quasi perferendis suscipit. Non consequatur eius rem qui. Illum quaerat dolor culpa. Provident non commodi nisi adipisci aut et consequatur.', '2022-01-31', '2023-06-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(55, 55, 'Automotive Glass Installers', 'Dolores ipsa officia laborum velit. Id vel unde vel a voluptates dolore perferendis minima. Voluptatibus totam doloremque nihil iste omnis.\n\nOfficiis et id ipsum eligendi labore. Assumenda dolorem dignissimos corporis pariatur a labore. Iste at laboriosam animi laborum. Sed non corporis qui velit pariatur.\n\nRerum aperiam atque cum non qui. Quas odit accusamus vero dolor voluptas. Quisquam voluptatem culpa voluptatem magnam doloribus eum eum amet.', '2021-01-20', '2023-06-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(56, 56, 'Gas Pumping Station Operator', 'Cupiditate sapiente est totam eum id et. Omnis consequatur velit voluptatem. Minus est ab deserunt architecto officia.\n\nCorrupti rerum amet ipsum sit consequatur. Quam maxime tenetur eos aut. Esse laborum unde rerum explicabo natus perferendis quidem dolorem.\n\nIllo sunt officiis eos laudantium odit. Quis et quidem molestias. Iure facere omnis a qui voluptas id perspiciatis. Non sit architecto dolores quis.', '2022-10-14', '2023-09-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(57, 57, 'Engraver', 'Et sequi velit labore sit corrupti eligendi rerum. Delectus autem et quo consequatur quia rerum sapiente. Nesciunt enim harum officia nisi ipsum reprehenderit. Unde ullam ratione cumque tempore.\n\nIste nihil qui laborum officiis eos aut. Consequuntur dolorem esse magnam. Molestiae debitis quia enim porro dolor rerum. Sit eum ut commodi est at nobis autem.\n\nDeserunt illo sequi aut temporibus voluptas nihil consequatur. Voluptatem at dolores quae cumque deleniti non magnam. Qui suscipit accusamus adipisci sint tempora sequi distinctio. Et velit enim porro modi molestias ex fugit.', '2021-07-21', '2025-04-23', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(58, 58, 'Economist', 'Nisi provident tempore tenetur nihil facilis dolores. Eveniet molestiae sed harum iusto nihil. Temporibus earum illum at eum ut libero. Quia qui perferendis sapiente dolorem.\n\nAd cupiditate dicta quas tempora illo quo inventore. Ut nam enim quae et totam iste consequatur.\n\nUt officiis dolor illo a dolore. Maxime qui quo et unde eveniet fugiat. Accusamus odio in nisi eum eos voluptatem et. Quia deleniti provident minus eveniet dolor similique. Est dolorem commodi non non voluptates.', '2022-11-23', '2024-12-29', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(59, 59, 'Brokerage Clerk', 'Cum deleniti eaque quasi enim non. Quibusdam illo veniam deserunt id eum harum sed. Laboriosam corrupti vero vel odio expedita dolore nemo. Neque quis ea non quas natus est commodi cum.\n\nLaudantium est impedit aut quia. Aut nihil rerum voluptas repellendus tempore. Ipsam excepturi sit quo consequuntur rem sit qui ut.\n\nPerspiciatis sed alias explicabo. Velit rem nobis dolorum explicabo quia dolorum consequatur veritatis. Necessitatibus est aspernatur laudantium voluptatem quam. Inventore recusandae alias et unde omnis quam nihil.', '2018-11-03', '2024-04-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(60, 60, 'Clinical Laboratory Technician', 'Est repudiandae a et iure eos sed. Nostrum voluptas explicabo ipsa doloremque. Ipsa ad doloribus fugiat fuga totam excepturi porro sit. Perspiciatis est minus commodi unde in.\n\nIusto iusto molestias voluptatem aut facilis. Velit sunt nisi et laboriosam veniam.\n\nQuam id magnam magnam occaecati. Voluptas nihil minima quos sint delectus vel cumque. Voluptates quibusdam non quisquam ab commodi natus aliquid. Qui possimus eveniet voluptate qui unde id. Ipsum enim ex quam totam.', '2018-06-25', '2025-03-26', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(61, 61, 'Aircraft Launch and Recovery Officer', 'Rerum cupiditate ea ratione vel exercitationem odio. Atque placeat error voluptas dolore laudantium. Et et sed doloribus dicta repellat impedit sequi. Ea natus molestiae ullam tempore eum ratione sint. Eum enim quam enim atque tempora unde.\n\nDoloribus est autem nihil. Architecto voluptatem quo laboriosam dolor quibusdam atque. Dolorem deserunt fugit ipsa voluptas itaque.\n\nSequi commodi quo consequuntur quaerat voluptatem repellat. Voluptates maxime quibusdam vel corporis accusamus id. Odio deleniti aut ut. Labore est sit tempore impedit. Accusamus repellat quia velit voluptates modi incidunt.', '2018-06-07', '2025-04-13', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(62, 62, 'Farm and Home Management Advisor', 'Inventore sit ea optio officiis. Recusandae praesentium quod tempora minima rerum perspiciatis. Cupiditate vel laborum soluta eveniet ad dolore. Modi reprehenderit aut pariatur aliquid odio voluptatem voluptas corporis.\n\nDolorum fuga amet hic illo. Odio eaque aut voluptas architecto hic. Ad voluptas et quod.\n\nPariatur sed error accusamus ea maiores laborum saepe. Magni nulla iure et delectus cumque inventore. Eum ut explicabo quo. A ex aut id quia mollitia.', '2016-02-28', '2023-12-01', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(63, 63, 'Project Manager', 'Delectus sunt aut aut est maiores. Dolore iure et voluptatibus qui illum. Est commodi quaerat quidem vitae aspernatur.\n\nEx aperiam laudantium quis odio. Voluptas minus perspiciatis voluptatem. Et sapiente nemo nemo.\n\nSed itaque aliquid dolores nostrum vel. Et quia est nihil. Facilis excepturi voluptatibus quaerat consequatur. Qui reiciendis nesciunt amet enim non.', '2019-04-07', '2023-09-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(64, 64, 'Electronic Masking System Operator', 'Nesciunt error ipsa sint sit vel iste et. Ea quia neque autem deserunt. Et similique est ad laudantium.\n\nExcepturi aliquid aliquam recusandae ut. Quis et velit enim et fuga incidunt. Ipsum voluptatum nihil enim iure aut.\n\nAd et voluptatibus omnis voluptatibus ut. Sunt fuga totam non natus similique molestias.', '2019-02-02', '2023-08-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(65, 65, 'User Experience Researcher', 'Pariatur sequi officia sit eligendi nisi provident sint deleniti. Cum dolorem voluptatibus et accusamus ut vel enim. Nam omnis nihil itaque cum. A sunt impedit repellendus repudiandae quisquam.\n\nOmnis debitis voluptatem mollitia velit a et. Aut voluptates non aut numquam. Eveniet ut temporibus sit autem dignissimos ut necessitatibus. Aut assumenda recusandae sed qui incidunt.\n\nDolores quae aut in atque voluptatibus unde quis. Sunt eos veritatis laborum in sapiente a architecto. Dolores necessitatibus dolores sed fugiat nobis praesentium est et. Non inventore totam voluptas voluptas a et.', '2022-08-20', '2023-10-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(66, 66, 'Orthotist OR Prosthetist', 'Et incidunt ea et error et sit eaque. Aut nam quibusdam temporibus molestiae occaecati non. Est dicta officiis quae. Magni veniam est optio labore.\n\nIusto quidem et et ipsam dignissimos. Doloribus est at quia at debitis vel. Dolores dolore et unde sint ex rerum repellendus et.\n\nNumquam necessitatibus deserunt nulla cum sed delectus. Ullam natus saepe officia necessitatibus. Quasi nihil earum quos quia tempora labore. Qui animi sint consectetur autem neque eos sunt.', '2019-01-29', '2024-08-31', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(67, 67, 'Manicurists', 'Aut et qui sed et nemo. Provident voluptates aut quisquam provident exercitationem. Iure quaerat commodi aliquam autem. Nostrum harum rerum sit ut quasi laborum sunt sint.\n\nDoloribus molestiae quasi delectus nesciunt totam est autem. Dolor quia doloribus quia numquam veniam. Atque animi fugiat eaque minima facere aut. Aliquam aliquam veniam voluptate doloremque.\n\nEaque autem quidem provident. In dolore est quae aut. Aut dolore laudantium pariatur debitis laborum officiis.', '2015-08-31', '2023-11-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(68, 68, 'Vice President Of Marketing', 'Corporis aut consectetur esse accusamus temporibus dolores ea. Voluptas ea qui error expedita sed corrupti culpa. Exercitationem quae praesentium odit ut et.\n\nVoluptas vero dignissimos asperiores. Assumenda ab excepturi magnam voluptas sed nihil et. Quod illo quis nostrum illum sunt consectetur ut.\n\nQuia aperiam suscipit cumque amet enim ad ut. Quis aperiam inventore eum ut enim.', '2023-04-13', '2024-05-02', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(69, 69, 'Choreographer', 'Ut voluptas quos quo ut in. Nulla recusandae dolor dolores sed in quis. Animi sunt aut doloribus veritatis aliquid enim.\n\nEst dolorem iusto mollitia. Corrupti ipsum ut sint impedit eum. Aut asperiores qui aut porro numquam aut in. Ab doloremque et et soluta sunt.\n\nDignissimos labore pariatur cumque. Pariatur quia hic laboriosam optio similique. Autem ut animi perspiciatis exercitationem est.', '2019-12-02', '2024-06-19', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(70, 70, 'Cabinetmaker', 'Aperiam quasi culpa debitis dolore aut. Atque dicta repellendus et amet aut ex autem. Asperiores dolores et facilis omnis in. Ea eum neque perspiciatis autem ut repellat.\n\nEsse dolorum numquam enim delectus. Quod sint dicta ut autem et harum aut. Ea quam omnis facilis ea et qui voluptatem.\n\nInventore officia atque qui vitae dignissimos reprehenderit. Aut provident vero enim deleniti voluptas temporibus. Architecto ab minima optio porro optio sint qui.', '2015-11-03', '2024-08-12', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(71, 71, 'Personal Care Worker', 'Earum aliquam cupiditate odio voluptatum. Vel ea optio deleniti dolorem sed commodi. Tempora neque consequuntur sit doloremque.\n\nDolore a a rerum ipsum. Tempora libero consequatur laborum consequatur beatae quis sed perferendis. Impedit eligendi enim quisquam mollitia.\n\nTenetur recusandae quos debitis reiciendis vitae. Similique accusantium possimus architecto sit voluptatem quaerat et. Magnam voluptas nobis distinctio fugiat laudantium. Voluptatem accusamus ad architecto.', '2019-03-04', '2023-07-20', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(72, 72, 'Philosophy and Religion Teacher', 'Adipisci dolore doloribus neque non odit. Molestiae nisi ut nihil reiciendis modi.\n\nOdit odio quam dolorum consectetur quae. Veritatis eveniet excepturi vero voluptas et odio et.\n\nCumque voluptatem et recusandae harum. Voluptas voluptatibus quae ipsum quos.', '2019-02-03', '2024-09-07', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(73, 73, 'Waste Treatment Plant Operator', 'Sed odit quod natus aut eos quaerat. Voluptatem eaque et vel. Voluptatibus dolorum vero quas distinctio. Facere enim est et et natus quisquam et et.\n\nNisi quia architecto consequatur maiores. Voluptatem adipisci corrupti est consectetur. Impedit reiciendis quia dolor voluptatum eum ducimus. Dolore accusamus modi sed id beatae ut.\n\nSit maiores ut nostrum sed et iure. Sed sed amet placeat ut. Deleniti perferendis accusantium earum mollitia laborum cupiditate qui.', '2019-08-18', '2024-09-11', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(74, 74, 'Aircraft Body Repairer', 'Ipsa ea fugiat necessitatibus corrupti. Sequi nobis nam optio quod necessitatibus. Vitae illo quia explicabo nobis est aut voluptatibus. Vitae asperiores vel iusto esse eligendi quisquam.\n\nIste accusantium omnis consequuntur ullam commodi dolorem ut. Est est delectus recusandae possimus odit. Deserunt et aspernatur adipisci esse repellendus.\n\nEum deserunt deserunt in quam dolor minus. Officiis ut numquam quaerat. Et quam occaecati aut quo voluptatem eum magni. Alias ipsam quo nihil quidem. Deleniti voluptas voluptate aliquam.', '2022-02-07', '2024-02-05', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(75, 75, 'State', 'Sunt corrupti officiis autem enim voluptatum est. Consequatur quo totam rerum earum aut quo ipsum quisquam. Culpa ut optio ipsa omnis maxime pariatur.\n\nAssumenda modi harum neque sed. Sed consequuntur quo est rerum. Blanditiis dolores error minima neque. Optio expedita et tenetur repellendus natus repellat.\n\nVoluptatem est id saepe. Tempore sed dignissimos possimus voluptatem.', '2017-12-16', '2024-07-03', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(76, 76, 'New Accounts Clerk', 'Magni quo voluptatem aut consequatur aut laudantium aut. Asperiores iusto mollitia sint. Delectus sunt illo doloremque voluptas aliquid dolor dolorem.\n\nDelectus dicta laboriosam quibusdam quia ex sit. Recusandae aperiam omnis consequatur beatae enim mollitia praesentium dolores. Ut voluptatem ut ipsum impedit hic.\n\nTemporibus debitis eius facere explicabo totam a. Consequatur temporibus dolore qui ab. Nostrum ipsam sunt corrupti quaerat et ducimus molestiae. Inventore accusantium adipisci dolorum et sunt delectus.', '2016-01-09', '2023-11-10', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(77, 77, 'Social Scientists', 'Cupiditate dolores non et architecto. Consequatur ipsum et iure. In ipsam est facilis maiores. Mollitia impedit aut qui alias totam facilis.\n\nOmnis voluptas unde ut et voluptatem molestias minus. Dolor eligendi voluptate est et. Ducimus ut sunt nostrum ut officia. Ut recusandae consequatur impedit. Ut libero necessitatibus nemo voluptas maiores quia dignissimos est.\n\nSequi quaerat quam voluptatem quos aut voluptatem ratione. Ut voluptatum iste libero fuga doloribus. Vitae pariatur ut neque adipisci. Ducimus quod quia voluptatem quos.', '2019-07-26', '2024-11-23', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(78, 78, 'Parking Lot Attendant', 'Repellendus fugiat quia consequatur culpa laboriosam aut. Impedit rerum quibusdam doloremque doloremque non nihil. Exercitationem in ratione quos. Voluptas quia repellendus praesentium molestias mollitia magnam. Dolores ullam qui hic voluptatem veniam molestias quasi itaque.\n\nBeatae minus autem magnam est eius amet expedita. Quod non dolor accusamus. Iste culpa id velit odit praesentium autem laborum.\n\nFugiat occaecati explicabo odit quis suscipit. Eum ex alias fugit quam numquam. Neque totam molestiae non facilis vero. Cupiditate porro voluptas consequatur.', '2022-08-11', '2024-10-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(79, 79, 'Wellhead Pumper', 'Perferendis cum et similique id doloribus molestias voluptatem. Qui ut id molestiae qui voluptatibus nisi porro. Nobis consequuntur quos neque.\n\nEt dolorum ut et aliquam qui voluptas. Illum doloremque nostrum labore voluptatum. Ipsum architecto voluptas praesentium explicabo eos culpa aut.\n\nArchitecto distinctio possimus ut amet. Quia culpa molestiae velit voluptatem. Quisquam asperiores dolor aspernatur et explicabo adipisci sunt. Aliquid labore deleniti pariatur eligendi beatae sunt.', '2017-01-19', '2023-08-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(80, 80, 'Private Household Cook', 'Dolor vel quod facilis sed aut aut repellat. Pariatur sint nam velit. Quis et dolores eos mollitia. Possimus quia dolor voluptatum.\n\nOmnis occaecati cumque laudantium reiciendis. Iusto iusto in consequatur iure omnis sit repudiandae. Quidem voluptatem nulla quibusdam sed error maxime sequi voluptates. Sit eum commodi reprehenderit totam quia velit enim error. Enim aut architecto nulla accusamus ipsum cumque.\n\nEius tenetur ea iste sit soluta assumenda ut. Saepe repellat voluptas perferendis sequi. Fugit et dicta deserunt nesciunt occaecati perspiciatis.', '2023-05-01', '2024-06-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(81, 81, 'Equal Opportunity Representative', 'Mollitia ipsam non ipsam repellendus fugit corrupti. Molestiae eius magnam quo dolor minima. Quae eum quae molestiae. Nihil facere officia modi porro exercitationem aut eum.\n\nId esse consectetur blanditiis cum sapiente. Natus repellendus dolorum numquam ex aut nam. Ipsum non sint omnis voluptatem molestiae aut.\n\nTempore quia fuga magni qui. Totam expedita sapiente culpa nesciunt et delectus.', '2015-09-09', '2024-12-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(82, 82, 'Terrazzo Workes and Finisher', 'Atque voluptatem saepe a officiis. Rerum voluptatem quas ipsam minima reiciendis velit nemo. Sed voluptatem quis facilis id ullam assumenda. Consequatur est voluptatem voluptate. Ut et possimus veritatis non.\n\nRerum quibusdam sint rerum. Occaecati rerum a ut quia ratione exercitationem voluptate. Est vel et veniam cupiditate consequatur tempore sit. Eius nisi omnis rem dignissimos vel.\n\nAutem et harum voluptates culpa. Quia ea sint soluta eum repellendus consequatur est doloribus. Optio accusantium amet qui.', '2019-03-12', '2023-12-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(83, 83, 'Security Systems Installer OR Fire Alarm Systems Installer', 'Mollitia aut accusamus iusto quis. In sapiente porro rem quis ut natus eaque omnis. Mollitia deleniti modi explicabo omnis rerum.\n\nMagnam distinctio culpa quia qui totam nihil sint ipsa. Et iure voluptas voluptas sunt aut ex non. Esse et consequatur voluptas sequi nulla molestiae perferendis.\n\nAssumenda quisquam ducimus voluptates ut qui. Aut enim saepe vel omnis. Quam perspiciatis qui laboriosam dolorum rerum.', '2021-10-14', '2024-06-23', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(84, 84, 'Foundry Mold and Coremaker', 'Enim inventore voluptatem deleniti ut consequatur nesciunt. Velit accusamus id vero minus maiores aspernatur ratione. Perferendis error possimus accusantium necessitatibus dolorem vel quas. Iste alias explicabo assumenda ut cumque vel tempora.\n\nQuis aut aut ipsa ad ducimus. Enim iure commodi ipsam et optio libero in repudiandae. Eius veniam et accusantium minima numquam. Qui dolores quo ut consequatur dolor cumque nobis.\n\nAnimi explicabo qui enim magnam in reiciendis labore. Nihil et fugit aut vel. Ullam alias a rerum. Ipsa veritatis sint eos molestiae quis error aut.', '2017-10-08', '2024-05-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44');
INSERT INTO `experiences` (`id`, `user_id`, `title`, `description`, `from`, `to`, `created_at`, `updated_at`) VALUES
(85, 85, 'Computer Security Specialist', 'Vitae voluptates corporis impedit sint eius. Amet eius beatae qui dicta qui et repellat. Et aliquid eum facere.\n\nRecusandae illo reiciendis debitis. Rerum quae qui nobis id aperiam esse animi earum. Nihil consequatur eius alias cupiditate mollitia dolor et. Iure quas consectetur quo. Omnis eveniet consequuntur laudantium aut.\n\nDeserunt perferendis quo odio maxime occaecati ut. Debitis accusamus ducimus aliquid maiores. Modi consequatur est et voluptatem aspernatur dolor eaque. Qui sunt corporis consequatur mollitia architecto. Pariatur eos sint provident perspiciatis in neque velit sed.', '2015-07-31', '2025-03-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(86, 86, 'Radiologic Technologist and Technician', 'Minus cum et qui ut minus eius. Nobis deleniti autem natus commodi. Dicta maiores nisi ullam ab distinctio in. Accusantium voluptas voluptatem omnis tenetur. Voluptatum adipisci quis rerum omnis.\n\nSed alias odio nemo qui. In consequuntur ipsum cupiditate vel unde et enim. Ducimus quaerat eos recusandae alias et dolor.\n\nAd voluptatibus fuga quisquam et commodi vitae ea. Et aliquid corporis aut repudiandae eaque labore et ab.', '2019-04-22', '2024-06-03', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(87, 87, 'Graphic Designer', 'Sunt ut culpa modi quibusdam. Ut et quia illo suscipit mollitia at et. Ratione sit nisi reiciendis.\n\nSapiente ratione sint harum voluptatum blanditiis voluptatem est sequi. Quaerat sapiente similique est illo debitis. Beatae ullam iure cupiditate nihil cum cumque voluptatum. Id illo molestiae vero repudiandae et fugiat. Aut unde nemo accusantium omnis debitis delectus perspiciatis.\n\nMolestias in error officiis provident. Itaque autem sit aut explicabo enim laboriosam rerum. Non et vel quia deserunt temporibus doloremque. Vero et sint necessitatibus impedit ut architecto blanditiis nesciunt.', '2016-10-04', '2024-01-16', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(88, 88, 'Mapping Technician', 'Odit et qui et reprehenderit assumenda pariatur. Et totam accusantium esse tempore dolore vero aut. Dignissimos recusandae fugiat velit voluptas quisquam asperiores.\n\nPorro cum sit necessitatibus voluptatem eaque. Est quia omnis cumque quaerat vero. Officiis incidunt laborum quia consectetur at libero qui labore. At neque mollitia commodi magni accusantium alias nihil.\n\nCorrupti nisi sint saepe qui quis. Officia error quis debitis architecto cum sit. Similique dolorem quam molestiae dignissimos aperiam. Cupiditate qui ducimus autem ab omnis quia.', '2017-05-11', '2023-08-02', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(89, 89, 'Lathe Operator', 'Neque at tenetur praesentium aut. Est ut nulla ut delectus quam ut explicabo. Voluptates repellendus natus doloribus porro deserunt ut. Voluptas eum accusantium enim adipisci nobis quia.\n\nDistinctio incidunt quidem voluptatibus ad nemo ea. Quo fugit doloremque et aut minima ipsa esse. Quidem explicabo quidem quasi nobis alias illo iste. Assumenda corrupti et odio vero id officiis.\n\nUnde nesciunt qui rerum dolorem consequatur magni voluptates. Consequuntur recusandae quae corrupti vel officia explicabo corrupti ducimus. Ad voluptatum vero voluptatum aut rem necessitatibus tempora. Enim suscipit soluta eum minima.', '2017-11-22', '2024-11-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(90, 90, 'Night Security Guard', 'Dolores nobis quos quia sint mollitia reprehenderit illo quam. Dolorem tempora occaecati unde quaerat quia numquam. Odit asperiores ex et quia doloribus iusto quo. Optio ipsam quisquam est natus consequuntur. Non sunt incidunt molestiae velit sed dolores facere deserunt.\n\nQuia enim animi ipsa aut aliquam beatae. Enim quia natus molestiae accusantium commodi ad itaque. Et aut porro sint voluptatem dolores consectetur qui sint. Pariatur et aspernatur sunt illo aperiam.\n\nUt ipsa laboriosam ea unde minus rerum saepe. Qui rerum voluptas illo omnis voluptates est. Id rerum sunt ut ut libero deserunt. Ea ex repellat omnis est non ipsum veniam.', '2020-07-04', '2023-10-08', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(91, 91, 'Meat Packer', 'Et qui quibusdam id est aspernatur amet quo. Culpa voluptas eveniet vel deleniti deleniti voluptas voluptas.\n\nRem et ut doloremque. Quia odit nesciunt id sunt nisi impedit. Quis aliquam est nesciunt accusamus dolor sunt. Ipsam consequatur harum dolor velit molestiae aut quia neque.\n\nFuga ut repudiandae non necessitatibus. Recusandae sed sed voluptate atque. Architecto aliquid impedit quaerat doloremque.', '2023-03-12', '2024-02-26', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(92, 92, 'Railroad Switch Operator', 'Possimus ab magni commodi non inventore repudiandae voluptate. Illo fuga id voluptas iusto magni et. Voluptatem id optio et iure non in illum velit. Quis autem repudiandae rem.\n\nOfficia eos odio beatae similique at. Voluptas et impedit perferendis est ut. Maiores eum tempora nostrum consequatur perspiciatis. Voluptatum deserunt ab libero molestiae vel sit.\n\nAut rerum id qui iure odit. Laudantium voluptate eius non optio sunt et. Temporibus placeat aliquam illum ut maiores dignissimos. Repellendus pariatur esse illo sunt quidem accusantium rerum. Quae et sunt deserunt.', '2017-11-03', '2023-12-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(93, 93, 'Marine Architect', 'Placeat id fuga sit doloribus. Optio asperiores rerum optio enim. Magnam molestiae eius praesentium sit.\n\nVelit ut occaecati ducimus ut. Hic molestias voluptatum et illo qui dolorem. Rerum perferendis voluptatum nisi placeat provident est omnis. Quia repellendus et iure culpa.\n\nConsectetur dolor et accusamus consequuntur natus. Nulla nisi architecto praesentium iure doloremque. Necessitatibus quis debitis ipsum repudiandae non velit. Amet voluptatem adipisci qui neque molestiae nesciunt.', '2022-10-08', '2023-11-11', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(94, 94, 'Airfield Operations Specialist', 'Ut autem odio quo laboriosam. Magnam debitis ad pariatur non error ducimus. Omnis occaecati doloribus quo odio dolorem mollitia harum aspernatur.\n\nRerum optio ullam sint et velit quas possimus. Et et aliquid hic et saepe consectetur. Blanditiis velit nobis iure tempora. Excepturi quia aut vel.\n\nPerspiciatis molestiae impedit non blanditiis et enim. Nulla aliquid eveniet soluta id perspiciatis. Voluptas exercitationem et odio esse qui praesentium numquam. Et voluptatem voluptas nemo exercitationem sunt eaque aut.', '2017-09-23', '2024-06-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(95, 95, 'Preschool Teacher', 'Ducimus vel ut enim voluptatum magni nesciunt voluptatem et. Dolore eveniet et aut possimus qui vel soluta. Accusantium voluptates modi et consequatur qui eaque mollitia.\n\nVeniam incidunt aut consequuntur ea in. Labore magnam voluptates sed porro. Maiores vero sint maiores qui ad vel. Et eum rerum nesciunt dolor sunt sed. Corporis in laborum eum non delectus nemo ea.\n\nFacilis quasi perspiciatis nesciunt est quaerat est omnis. Voluptatem deserunt non quos magnam illum sit. Qui expedita sunt dolor doloremque animi eligendi.', '2018-04-22', '2025-03-08', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(96, 96, 'Plate Finisher', 'Qui recusandae eligendi suscipit et amet. Aut et numquam et est sit sint. Ab quis et at vero aut. Sed quia optio totam sint autem ut.\n\nAut minus ut modi similique voluptas. Praesentium similique totam ut omnis. Aperiam esse neque iure doloremque quia ad similique.\n\nSed sit commodi ipsam ex pariatur omnis dignissimos. Vel tempora fugiat maiores laborum. Et dignissimos veritatis illo.', '2019-09-04', '2024-02-07', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(97, 97, 'Grinder OR Polisher', 'Est repudiandae reprehenderit maxime fugiat. Nihil velit expedita qui eaque qui aliquam itaque. Praesentium est aut eos velit eum est.\n\nVel repudiandae voluptate nisi mollitia et nobis. Ut illo esse repellat cumque occaecati quibusdam similique rerum. Fugit nam non nemo aut inventore est. Corrupti ab ut sed.\n\nRatione accusantium dolorem impedit suscipit. Tempore aut non sequi labore. Sapiente aspernatur earum quia omnis veniam et eum.', '2018-04-17', '2023-09-13', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(98, 98, 'Crossing Guard', 'Et soluta doloremque dolorum cupiditate dolorem dicta officiis. Quis veniam reprehenderit quia nam inventore omnis quod magni.\n\nIpsum ea deserunt laudantium sunt. Dolor quo odio enim dolorem aut molestiae dolorem. Nesciunt nihil aut ut placeat. Id eius culpa id quis nihil ut reiciendis.\n\nDolores perspiciatis iure eius distinctio ipsum dolores. Minima eum officiis impedit delectus. Totam autem eaque aut iste. Officia sit libero cum tempore.', '2020-02-21', '2024-10-25', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(99, 99, 'Telecommunications Equipment Installer', 'Et aliquam amet nihil repudiandae voluptatem numquam enim. Enim eum ea dolore blanditiis dolorem temporibus. Voluptatem voluptatem mollitia et et.\n\nConsequuntur corporis deleniti eum aut nam illum reprehenderit. Eos doloribus est rem qui aspernatur ipsum. Aut tenetur architecto fugit. Consequatur nulla molestiae voluptatem corporis assumenda.\n\nEa laudantium sunt reiciendis consectetur molestias quaerat quo. Corporis corporis aut assumenda quod et. Aliquid error in ut et nesciunt.', '2020-05-01', '2023-12-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(100, 100, 'Construction Equipment Operator', 'Ex enim sapiente voluptates voluptas. Recusandae qui inventore dolorum omnis. Ut non deserunt aut non facilis. Commodi tempora et qui omnis repellat facilis.\n\nEa tenetur aperiam dolorum pariatur. Natus rerum et a quae minima.\n\nMagni incidunt ut et voluptas rerum libero repellat. Qui ipsa mollitia aut voluptatem sit neque odit. Et neque sequi ratione qui.', '2015-11-24', '2023-07-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(101, 101, 'Gas Appliance Repairer', 'Voluptas et qui repudiandae. Dolorem natus et libero repellat.\n\nEst quo ut veniam atque optio delectus. Eum soluta voluptatem ex excepturi autem temporibus consequatur. Ea et deleniti architecto nemo eius sapiente. Qui optio repellat et et labore. Consequatur temporibus repellat facere at aut nobis blanditiis cumque.\n\nNam vitae dolores rerum sed sint qui cumque. Ipsum excepturi eos aut eaque autem. Eaque temporibus quis non qui ipsa deleniti.', '2018-02-21', '2024-03-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(102, 102, 'Self-Enrichment Education Teacher', 'Et molestias quia ullam alias sed ea. Quam sed nihil sapiente. Neque quia accusamus mollitia et quam. Perferendis reprehenderit qui quo ex.\n\nSit consequatur aut ad ipsa. Sit rem ipsam eum quod sunt. Error fuga odio ut tenetur atque cum soluta molestias.\n\nMagni eos omnis inventore officiis. Expedita nihil non omnis eaque explicabo. Recusandae voluptas eveniet ut est quae.', '2020-05-11', '2024-07-03', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(103, 103, 'Food Servers', 'Aut autem soluta officia voluptas consequatur unde et. Modi pariatur est sit voluptas rerum culpa.\n\nDolores repellat quas mollitia et est qui ea. Autem tempora ut ea totam debitis qui aliquid. Minima aut consectetur qui dignissimos. Suscipit laudantium impedit iusto ducimus nihil.\n\nDistinctio qui molestias quibusdam necessitatibus rerum rerum. Sequi doloremque iure laudantium suscipit ut exercitationem. Minima magni voluptas adipisci.', '2016-06-09', '2025-01-10', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(104, 104, 'House Cleaner', 'Et et qui quibusdam inventore facere quia illum. Nihil quasi numquam minima. Consequatur aperiam minima veniam. Aut eos illum alias maiores.\n\nExercitationem magni vel asperiores quo quia corrupti. Eos eum laborum optio iusto molestiae qui odit. Sit suscipit quos hic sed voluptas est odio iusto.\n\nVoluptatem sit labore in et distinctio sapiente. Nihil rem nisi ipsam voluptas deserunt dolore unde aut. Labore quo aliquid hic voluptate est.', '2023-02-07', '2024-02-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(105, 105, 'Casting Machine Set-Up Operator', 'Quia deserunt veniam sed provident culpa animi nulla. Omnis beatae est rerum voluptas repellendus voluptatem. Delectus at similique impedit officiis.\n\nIste aut corrupti aut quia ipsum. Repellat reprehenderit officiis qui voluptatem explicabo pariatur dolorum praesentium. Voluptatibus ducimus ut molestiae ducimus eveniet fugit.\n\nRecusandae quisquam deleniti dolorum et at delectus non rerum. Laborum ut incidunt itaque quas dolorum fugiat. Possimus quibusdam deleniti quaerat non. Repudiandae et quo expedita et maiores.', '2021-09-09', '2024-04-03', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(106, 106, 'Avionics Technician', 'Omnis qui ex laboriosam et sapiente. Consectetur impedit accusamus eaque modi et dolor. Cumque consequatur aut vel soluta quos. Ut rerum nihil modi similique aut. Non dignissimos dolorem delectus in adipisci.\n\nLibero saepe sint et commodi quos. Aspernatur sunt fuga eius qui tempore. Aut non aperiam porro illo voluptatibus et.\n\nQuidem quia maiores sit saepe aut fugiat numquam. Amet eaque exercitationem omnis eum. Assumenda id aperiam ut perferendis et corporis.', '2023-01-23', '2023-10-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(107, 107, 'Immigration Inspector OR Customs Inspector', 'Numquam enim placeat omnis libero. Consequuntur magni nam odit quidem. Eveniet laborum exercitationem quisquam quae quia id. Sit vero aut molestiae aperiam dolorem optio. Nisi sunt et cum quam.\n\nQuaerat accusantium quis quo aut ex velit. Sed quia reprehenderit voluptatem omnis sequi enim. Occaecati totam id ut consequatur eum sit dolorem. Consequatur deleniti porro atque optio odio est sequi.\n\nQuia omnis recusandae sit similique voluptatem. Qui veritatis consequatur perferendis laboriosam aut illo.', '2023-03-25', '2024-01-11', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(108, 108, 'Production Laborer', 'Rerum sequi voluptas earum. Et inventore suscipit harum iure recusandae exercitationem rerum. Aspernatur eligendi neque aut neque. Vel vel in omnis eius non dignissimos ad.\n\nIusto perspiciatis deleniti velit incidunt architecto nam odio. Minus nemo exercitationem repellat voluptate dolorem blanditiis.\n\nQui culpa et porro. Porro magnam qui sint sint. Quam sint pariatur possimus velit. Nisi cum libero molestias quam voluptatibus.', '2021-02-07', '2024-02-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(109, 109, 'Visual Designer', 'Earum iure dolores beatae similique voluptates aliquid assumenda. Dolorum est voluptatum qui esse maiores sequi. Voluptas qui quas ut doloribus eligendi. Tempora ut suscipit expedita est dolorem.\n\nNihil doloremque nisi et et veritatis voluptatem. Quam ullam voluptatem eum autem rerum molestias quia. Ad voluptatibus harum architecto pariatur animi itaque cupiditate molestiae. Quas assumenda laboriosam debitis quam quam accusantium accusamus.\n\nUt consequatur aut sunt ipsam. Adipisci culpa vel et sed veniam maiores. Delectus et corporis quia odio quia. Et cupiditate et et est ipsum qui iusto.', '2015-09-13', '2023-12-13', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(110, 110, 'Public Transportation Inspector', 'Sint nihil consequatur asperiores rem nam. Doloremque incidunt voluptatum aut omnis numquam mollitia neque. Doloribus animi necessitatibus inventore quisquam neque aut.\n\nHic totam adipisci quis ab id quis. Minus soluta fuga voluptatibus dolor repellat autem nihil amet. Odio et quis aut neque fugiat. Neque qui illum sit natus nisi dolorem.\n\nOccaecati ut sint possimus voluptates. Voluptatem animi quaerat qui nihil et. Fugiat consequatur odio error eum quas. Blanditiis eius quo nulla saepe tenetur.', '2020-12-11', '2024-07-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(111, 111, 'Surgeon', 'Saepe eaque eos iusto dolores nostrum recusandae sapiente culpa. Quo aut saepe doloribus et rerum at. Atque et tempora fuga magni impedit voluptas eum. Beatae tenetur excepturi minus repellat.\n\nEnim consequatur recusandae nam eos temporibus. Quidem ad numquam et perferendis ipsam. Non enim illum et eius exercitationem molestiae enim. Consequatur est laudantium expedita et ut quam cupiditate doloribus. Inventore nemo assumenda hic adipisci eum sit neque alias.\n\nNihil reiciendis tempora quas et vel culpa consequuntur quidem. Non temporibus quo voluptatibus illo sed. Aliquam qui architecto natus voluptatum itaque sed ut. Aut aliquid consequuntur a et minima eius.', '2017-08-11', '2024-08-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(112, 112, 'Warehouse', 'Cumque sit autem excepturi maiores rerum. Consequatur enim ullam ipsa et a porro. Similique odio consequatur eligendi dolor provident eum quia veniam.\n\nAssumenda ipsam et a debitis id quae vel possimus. Corrupti cum quas voluptatibus nostrum. Dolores possimus dignissimos ad doloremque provident voluptate inventore aut.\n\nDignissimos porro voluptatem quasi voluptatem et iste temporibus. Ullam aut hic ut voluptas enim qui. Consectetur reiciendis dolore velit reiciendis. Voluptatem dolor quos aut in sint nemo enim error.', '2018-06-29', '2024-11-20', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(113, 113, 'Administrative Services Manager', 'Aspernatur aut voluptatem qui repellendus nostrum perferendis. Non non non odio vel quibusdam consequuntur optio. Molestias eos quos magnam fugit a commodi deleniti. Alias deleniti ut necessitatibus voluptate et sit dolor voluptas.\n\nQuis qui nulla fugiat enim sit illo. Laborum sunt enim dolorem facilis dolores. Mollitia voluptas architecto amet cum ipsum. Quasi et accusantium suscipit quos.\n\nMolestiae et laborum est asperiores sapiente. Recusandae aut nemo blanditiis ratione quia. Eveniet aut voluptatem quasi autem ratione amet.', '2022-06-21', '2024-07-01', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(114, 114, 'Funeral Director', 'Nam assumenda omnis voluptas est veniam qui. Earum beatae temporibus tenetur porro voluptate. Soluta neque deserunt atque dolorem inventore vel qui. Commodi ullam enim ipsam doloribus autem consequatur enim autem.\n\nVoluptatem qui iste nesciunt quam et. Temporibus tempore quisquam est quos earum.\n\nOfficia quaerat voluptatum et laboriosam. Inventore qui illo possimus iste voluptas fugit cupiditate et. Aliquam autem quis ut dolorum et.', '2022-04-23', '2025-04-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(115, 115, 'Business Teacher', 'Dicta a ab voluptatem eius modi repudiandae aut. Provident voluptate voluptatem blanditiis reiciendis necessitatibus in repellat nihil. Voluptas non in est et labore. Officiis quo dolorum beatae ipsa accusamus dolor et.\n\nUt rerum quae quam. Eveniet ipsa aut distinctio aut quia. Pariatur veritatis voluptatum ullam fugiat omnis ad.\n\nFacere harum et reiciendis qui eius. Dolores maiores est consequuntur eveniet et. Qui numquam iusto vel quibusdam saepe quis. Qui enim necessitatibus esse placeat et minima. Inventore voluptatum ut ex consectetur aut perferendis alias et.', '2016-06-28', '2025-03-06', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(116, 116, 'Counseling Psychologist', 'Delectus sed rerum perferendis est id repellat quo qui. Corporis ducimus est voluptatem quis est. Sapiente et tempora sapiente error.\n\nConsequatur laborum nemo error est consequatur quod sed. Non consequatur ut quis consequatur ea consequatur non. Quaerat atque corporis asperiores culpa et. Asperiores id praesentium aut voluptatibus sed velit minima.\n\nProvident delectus illum sunt. Nam animi odit enim. Fugit qui officiis dolores ut quis dignissimos. Molestiae vel maiores dolores temporibus non velit.', '2017-10-19', '2024-12-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(117, 117, 'Survey Researcher', 'Iure excepturi dolor distinctio dolorem soluta. Quia id quidem occaecati sed distinctio. Ipsum saepe quis repudiandae in eveniet. Eum deserunt corrupti dolorem.\n\nTemporibus optio officiis beatae dolores minus odio culpa. Tempore inventore voluptatum nisi culpa quae. Vel sunt explicabo quia voluptatem praesentium consequatur.\n\nPerferendis hic et hic vel quia. Magni qui sapiente maxime id. Tempora consectetur eligendi quia minus omnis. Temporibus eum et debitis tempora vel.', '2017-03-08', '2024-04-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(118, 118, 'Production Laborer', 'In ad voluptatem molestiae labore id. Asperiores molestias velit ea. Voluptatem molestias molestias voluptas reprehenderit non ipsam totam.\n\nEveniet voluptas sint fugit rem ex sit sapiente. Nihil similique ut in adipisci tenetur aut cum. Quo doloribus assumenda laudantium non asperiores. Provident modi aut fuga sint.\n\nIpsa commodi enim quidem asperiores eaque. Et quis laudantium occaecati cupiditate aut. Sed fugiat doloribus vel voluptatum placeat eligendi ut eaque.', '2023-05-24', '2025-01-03', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(119, 119, 'Mixing and Blending Machine Operator', 'Sapiente aspernatur excepturi hic quia iusto dolores adipisci. Sed consequuntur eum nulla. Laboriosam dignissimos dolores nulla dolor. Mollitia ad sed sed doloremque sint.\n\nNihil aspernatur temporibus aspernatur. Eaque amet perspiciatis aut et. Praesentium et cupiditate ea delectus id. Sit voluptate a sit similique iste sed.\n\nUt tenetur quas occaecati odio repellendus eum omnis eaque. Iusto quia qui dolore. Assumenda necessitatibus in ut tenetur inventore sunt. Nisi fugit fugiat voluptatem aut provident consequatur nobis.', '2018-07-08', '2023-07-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(120, 120, 'Curator', 'Qui optio dolor qui quidem asperiores consequatur. Nihil vitae earum voluptatem commodi autem. Quia nostrum maiores vitae et harum dicta esse et.\n\nOfficiis nisi voluptatum optio. Vitae id dicta consequatur necessitatibus voluptatem maiores. Inventore fuga odio autem sed. Aut non dolorem qui sint reprehenderit officiis veniam.\n\nQuam odio laborum repudiandae rerum iste aspernatur saepe. Fuga repellat ut maxime voluptatem dolorem. Vitae autem aliquam incidunt numquam qui iusto. Pariatur suscipit nemo eius sed nobis id sunt.', '2021-07-24', '2024-09-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(121, 121, 'Computer Operator', 'Id est molestiae unde sed ut est id. Suscipit provident deleniti sed neque. Necessitatibus sapiente inventore aspernatur iste eos. Commodi odio omnis in eum.\n\nDolores magnam aspernatur temporibus ipsum. Esse dolor et aperiam facilis. Officia nam et repellendus et. In ullam dolorem pariatur sit enim.\n\nEx qui officia ipsa iure earum alias. Molestiae molestiae ad nam vel. Totam in eos quo.', '2023-04-07', '2024-07-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(122, 122, 'Fishery Worker', 'Delectus illo qui dicta iste nam iste. Illum cumque qui dolore aut. Libero nulla quos doloribus et ut nobis. Eos officia odio ab quam et.\n\nAccusantium corrupti sunt sit hic quo doloremque ducimus. Itaque facilis consequatur illum soluta. Facere asperiores in in temporibus est voluptatem.\n\nQuo totam in debitis et. Quia aut aliquid non odio est molestiae. Possimus autem amet atque dolore.', '2016-03-05', '2025-04-08', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(123, 123, 'Railroad Switch Operator', 'Quod facere minima in expedita. Laudantium consequuntur quia quasi voluptates.\n\nNisi omnis nesciunt harum. Provident porro et dolores omnis. Fugit molestiae vitae ducimus ut facilis vel. Illo ipsa harum autem nemo provident alias.\n\nVel consequatur aspernatur neque. Numquam non nam unde aut aliquid similique possimus. Minima sit assumenda pariatur nesciunt.', '2015-11-04', '2025-01-29', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(124, 124, 'License Clerk', 'Incidunt quis delectus at facilis autem non et vitae. Voluptatem ullam animi laborum ab. Quo dolor et repellat nihil. Reprehenderit autem tenetur aut non possimus nam nostrum.\n\nNobis nostrum amet eaque quos quia optio. Possimus sapiente quisquam possimus fugit. Quia sint harum et qui quo consequatur vel.\n\nQui nemo quasi molestiae repudiandae officia sunt. Corporis ut rerum iusto quasi quia quibusdam distinctio. Amet temporibus magnam porro libero voluptas.', '2015-12-15', '2024-08-03', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(125, 125, 'Molding Machine Operator', 'Totam ipsum quasi rerum. Molestiae id id aspernatur. Rerum earum facere omnis sunt perferendis necessitatibus. Reiciendis dolorum eos dolorem.\n\nImpedit rerum maiores autem et perferendis. In at voluptatum qui velit. Facere et explicabo quibusdam quae molestias distinctio. Sapiente at nostrum laudantium laboriosam eligendi harum earum.\n\nQui impedit voluptas inventore doloremque aut. Sed dolores omnis ut voluptatem. Doloribus aut inventore aspernatur maxime et aliquid rerum.', '2016-12-14', '2024-05-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(126, 126, 'Glass Cutting Machine Operator', 'Vero quia ad ut maiores aut reprehenderit harum. Eos non est excepturi accusantium nemo.\n\nSimilique ratione et soluta atque molestias cum. Doloribus qui voluptatum quos quia alias dicta. Hic animi ea rerum animi libero.\n\nQuam non cupiditate tempore aut earum. Esse sed sunt ut fugiat est. Itaque a iure ut minima in ut nulla.', '2022-01-04', '2024-06-10', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(127, 127, 'Garment', 'Debitis et molestiae doloribus occaecati nobis consectetur porro. Maiores praesentium nihil voluptas itaque ipsum veniam. Optio consequatur exercitationem consequatur nihil. Omnis quidem nesciunt vero et fuga libero est. Inventore voluptas rerum omnis esse saepe ea molestiae neque.\n\nOdio sunt ut rerum dolores odit sint. Nobis et explicabo et omnis. Quasi blanditiis tempore voluptas placeat in minus. Illum quis consectetur consequatur sed nemo dignissimos nihil.\n\nMinima ducimus quo aut odio. Deleniti molestias labore voluptatum dolorem ut error officia. Harum quia sed autem reiciendis. Occaecati aut rerum minima et dolore voluptatem ut. Minus ut error tempora minima quae corrupti laudantium.', '2017-04-27', '2024-08-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(128, 128, 'Public Transportation Inspector', 'Rerum recusandae enim qui. Omnis numquam dolorem qui sit consequatur nulla sed labore. Quaerat voluptate voluptatem rem facere occaecati. Atque aliquid hic rerum enim.\n\nQuisquam ratione fuga harum eaque quia qui voluptatem non. Omnis qui quidem error molestiae voluptatem quae accusantium. Atque unde est incidunt ratione. Dicta aliquam reiciendis id voluptatem est nulla unde.\n\nNatus vel cupiditate consequatur doloremque ab. Qui laudantium facere est illo sunt perspiciatis. Sit magni velit quia quia. Cum vel perspiciatis eius dicta facilis quia unde.', '2016-03-09', '2025-03-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(129, 129, 'Pastry Chef', 'Velit dignissimos odit dicta ex voluptatibus earum. Eum qui soluta eius. Nesciunt quasi aut optio porro et modi natus. Officiis voluptas debitis esse est consequatur tenetur ea architecto.\n\nNesciunt blanditiis ex aut officiis vel illo. Ut consequatur quod nam dolor similique deleniti. Et esse quo ut deserunt.\n\nNihil et omnis omnis id rem dolores. Inventore recusandae voluptas sit et. Earum est minima incidunt. Voluptatibus aliquid facilis consequatur ratione numquam velit distinctio.', '2022-09-18', '2025-02-25', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(130, 130, 'Audiologist', 'Ut enim quae minus sit. Voluptas dignissimos quas non rerum est. Velit consequatur praesentium nulla odit et nemo est est. Aperiam corporis iste debitis illum sed labore qui animi.\n\nLibero quisquam eaque quos doloribus asperiores. Suscipit commodi sed dignissimos dolor eligendi. Eos voluptate consequatur rerum facilis. Est est asperiores eum.\n\nIn eos in totam dolore dignissimos beatae. Voluptas cumque et unde ipsum. Id veniam delectus beatae cumque.', '2018-07-04', '2025-01-29', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(131, 131, 'Printing Machine Operator', 'Ipsam est perferendis ut consequuntur. Fuga accusantium vel aut et accusamus. Hic neque voluptatem earum.\n\nQuibusdam deleniti qui eius dolores soluta excepturi explicabo. Perferendis aspernatur est iusto voluptatum voluptas assumenda aut qui. At facere dolor facilis eius alias aperiam. Temporibus sed eum dolorum autem dolorum expedita consectetur.\n\nEa dolorem repellendus qui ipsa. Similique nihil inventore ut quisquam impedit iusto quasi. Exercitationem enim consectetur fugit quos aliquid sed id.', '2019-01-09', '2024-12-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(132, 132, 'Securities Sales Agent', 'Placeat vel expedita eligendi ipsa. Et vitae ea asperiores. Distinctio exercitationem est doloribus modi maiores. Ab aperiam alias ut iusto ex deserunt.\n\nExcepturi et enim nostrum facere corrupti. Laboriosam sed est ut ea nihil. Aut autem vero illo aliquid minus. Neque omnis nihil ratione illo est enim ut.\n\nAccusantium harum est earum dolores debitis eius et magni. Harum qui adipisci eum suscipit odio dolorum eos qui.', '2016-10-24', '2024-01-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(133, 133, 'Biological Technician', 'Est necessitatibus voluptatem veniam doloribus voluptatum blanditiis. Nam necessitatibus qui illo minima possimus reprehenderit. At est quia aperiam aspernatur non error dolores. Natus et corporis nostrum maxime.\n\nNatus at dolorem iusto sunt. Delectus natus omnis odio repellat qui consequuntur sit. Non doloribus adipisci voluptatum aliquam rerum illum. Est quia vel rem impedit.\n\nVitae laudantium et reiciendis maxime consectetur reprehenderit quaerat ut. Blanditiis iste aliquid beatae quidem. Et modi aut dolor beatae optio error voluptas.', '2015-11-24', '2023-08-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(134, 134, 'Janitor', 'Voluptates eveniet sit facilis rem tempore ab. Temporibus ipsa eveniet placeat sapiente aspernatur alias.\n\nSoluta et ea numquam facere ut. Voluptatem magnam provident non incidunt omnis. Id et omnis voluptas adipisci non reiciendis veritatis et. Tempore quisquam eligendi eum vel assumenda in.\n\nNisi cupiditate iste aspernatur amet. Enim vitae eaque sapiente eum molestiae sequi voluptates. Eligendi ipsa blanditiis commodi qui repellat mollitia ut nesciunt.', '2016-10-30', '2025-05-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(135, 135, 'Ship Mates', 'Doloribus doloribus at cum. Atque animi non et ea rerum. Dicta facilis accusantium facilis qui qui natus architecto. Amet sed sed sunt qui.\n\nSimilique sunt amet molestiae eligendi blanditiis. Officia et tempora quia aut odit. Voluptatem dolorem quia illum numquam neque ab. Incidunt doloremque sed autem quis rerum non nihil.\n\nSed natus sed quia officiis iure consequuntur. Eos est vel fuga tempore id. Nisi molestias et et animi dignissimos. Cumque quisquam neque impedit commodi quas dolorem quis.', '2017-11-27', '2025-01-07', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(136, 136, 'Architectural Drafter OR Civil Drafter', 'Sapiente ex et reiciendis corporis maiores deleniti corrupti. Aliquam ipsum quis ipsum amet suscipit deserunt et.\n\nMinima accusamus voluptatem dolor iusto quia. Hic quis esse accusantium minima cupiditate et sapiente. Earum quasi voluptatem qui in soluta impedit dolores.\n\nOccaecati rerum qui adipisci quibusdam qui. Atque officiis facilis quo at molestiae et mollitia. Aut et et rerum corporis. A provident sunt architecto veniam impedit.', '2015-08-26', '2023-08-13', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(137, 137, 'Airfield Operations Specialist', 'Aut temporibus est sunt similique et. Dignissimos quo sequi quisquam numquam. Omnis temporibus illum dolores commodi aut. Sit ab est ea earum aut eaque eum nulla. In ut est aspernatur modi illum.\n\nAspernatur eos animi architecto aut quia sit repellat. Sequi est aperiam perferendis. Rem pariatur voluptates libero sed.\n\nQui aut possimus dolores atque aut est nisi. Officia omnis itaque quae numquam doloremque est omnis. Et et quo tempore excepturi molestias. Esse in tempore nihil.', '2022-05-04', '2024-10-01', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(138, 138, 'Coremaking Machine Operator', 'Corrupti dolorum explicabo voluptas reiciendis temporibus. Dolores perferendis non ducimus qui dicta. Necessitatibus accusamus maiores ipsa itaque autem. Et impedit explicabo in voluptatibus qui rerum.\n\nLabore et expedita molestiae. Aliquam quia consectetur officia vel. Corporis aut deleniti corrupti suscipit veniam.\n\nAsperiores facere ea ut dolorem nihil. Quo aliquam repellendus voluptatibus labore cum accusantium. Consectetur rerum ut non. Incidunt fugit et error dolorem facilis nam enim.', '2021-04-17', '2023-11-26', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(139, 139, 'Aircraft Mechanics OR Aircraft Service Technician', 'Maiores doloribus amet nobis. Vitae iste quae quasi minima aut. Sunt facere beatae laborum voluptate qui ut et.\n\nIn eum placeat asperiores eligendi neque eaque dolores. Repudiandae veritatis fugit repellat modi architecto. Delectus magnam temporibus voluptatibus libero dolor.\n\nSed sit mollitia similique. Enim qui quia voluptas voluptas voluptatibus quibusdam. Maxime doloribus labore at facere hic omnis. Animi laborum quis et consequatur voluptates autem.', '2018-07-25', '2025-01-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(140, 140, 'Medical Laboratory Technologist', 'Quas magnam dolor commodi excepturi. Rerum occaecati perferendis illo amet autem. Eos blanditiis eum exercitationem. Expedita amet ut distinctio eum sequi velit neque.\n\nEx dolorum iure dolorum eos suscipit. Repellendus asperiores quia vitae maiores. Optio accusantium reprehenderit nihil asperiores sed. Voluptatem adipisci incidunt dicta molestiae dolorem.\n\nSunt et occaecati voluptatem eligendi eum qui. Et sed nihil temporibus dolores et aut inventore. Sequi commodi quia accusamus itaque exercitationem. Provident itaque et itaque dolore similique eligendi ut. Enim aut quas ratione aut mollitia perferendis qui aut.', '2016-03-07', '2023-08-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(141, 141, 'Gaming Surveillance Officer', 'Illum non aut et ipsa ipsam. Aspernatur sunt facere quaerat et. Qui animi officia molestiae ea commodi perferendis.\n\nUt nulla odio ea dolor possimus inventore quaerat. At reiciendis rerum eos eligendi quo rerum perferendis. Voluptatem magnam et deleniti quas aperiam.\n\nNon voluptatem ex minus ut. Cumque nemo ducimus ut voluptate eligendi. Fugiat est deleniti ea delectus.', '2021-04-26', '2023-07-29', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(142, 142, 'Avionics Technician', 'Optio odio nihil earum. Qui totam enim in alias et beatae ipsam. Aut quia sit nobis natus dolorum recusandae asperiores aut. Ullam recusandae rem dolorum voluptatem assumenda.\n\nSit nesciunt voluptatum est dolor itaque quae aperiam. Voluptatem iure debitis eum optio aspernatur sunt labore voluptatem. Ipsa exercitationem unde eos dolorem necessitatibus fugiat rem. Odio et aspernatur qui et quam aut placeat. Ut explicabo voluptate enim totam quo.\n\nNihil iure et repudiandae qui non voluptas. Et et eum repellat eaque qui. Ad officiis tempore esse voluptas culpa dolore dolor. Suscipit animi corrupti maiores.', '2018-07-08', '2025-01-19', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(143, 143, 'Logging Worker', 'Debitis enim et consequatur error eveniet consequuntur. Aut excepturi earum sint sequi excepturi illo aut. Aut architecto at perferendis et.\n\nEst et numquam doloremque sit ullam soluta reiciendis cupiditate. Praesentium similique qui eligendi qui. Sed iste sunt aliquam alias. Cumque quaerat doloremque sequi facilis beatae et eligendi. Eum laborum sit voluptas tempore nobis.\n\nEx aut vero in vitae tempora enim dignissimos. Nesciunt maiores autem non eligendi. Quis sit odit culpa corrupti ea nihil. Nam expedita saepe rem.', '2016-04-01', '2023-08-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(144, 144, 'Electric Motor Repairer', 'Nostrum id ad quo est quasi nostrum. Fugit eaque delectus ut voluptas ea. Est esse explicabo eum et. Sapiente non tempore sint aut quia distinctio. Fuga ratione enim rerum inventore quia minus vitae.\n\nDicta sint distinctio quia officia quo molestiae pariatur. Iure veniam alias dolor esse voluptatem unde magnam. Ut qui voluptatum sed. Magni ipsam reprehenderit est maiores fuga.\n\nFuga cumque quae voluptatem molestias vel. Quis ipsa itaque voluptatem minus eos sit eligendi. Eos nobis sint incidunt cumque fugit saepe.', '2017-03-09', '2025-02-22', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(145, 145, 'Brazing Machine Operator', 'Porro iste eum repellat eius possimus ut ex. Enim modi quos praesentium id consequatur. Repudiandae rerum blanditiis repellat mollitia adipisci rem.\n\nAnimi iste magnam deleniti eveniet minus placeat. Omnis molestiae est ullam molestiae velit. Quia est id consectetur enim odit distinctio consectetur qui. Inventore omnis vel eum.\n\nVoluptatibus ab blanditiis alias illo esse qui aut. Corporis hic corrupti ut voluptas non. Ducimus voluptas et laborum suscipit numquam.', '2020-05-13', '2023-11-05', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(146, 146, 'User Experience Researcher', 'Autem quisquam et at aspernatur repellendus. Quam debitis aut laudantium quis possimus occaecati quia. Dolorem aut numquam nostrum rerum minus est beatae.\n\nNostrum quia et laborum facere. Illo officiis ipsa suscipit temporibus nemo.\n\nQuis voluptatem unde magnam. Et et aut recusandae tempora.', '2016-12-13', '2023-12-10', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(147, 147, 'Product Promoter', 'Eligendi minima dolor dicta. Aspernatur laborum officia et provident. Eligendi fugiat iste eaque aliquam enim odit sit.\n\nPerspiciatis quod labore quisquam quisquam. Et nihil architecto id qui aut eius. Reiciendis quis pariatur fuga ut placeat sint aut occaecati. Enim nostrum asperiores iusto quibusdam facere ipsa eligendi.\n\nAutem architecto similique amet facilis et. Deleniti dignissimos omnis fuga sit est eos. Illum et quis consequatur est. Quia enim officiis ut consequatur ut eum incidunt.', '2020-08-07', '2025-05-26', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(148, 148, 'Cabinetmaker', 'Eos voluptate veniam ipsa voluptatibus odit doloremque eos. Aut magni laudantium nemo ducimus. Sit nobis voluptas perspiciatis tempore. Esse quas dignissimos qui dolorem ut.\n\nMinima tempore assumenda sunt facere sunt consequatur. Amet voluptatem architecto modi quas eaque totam. Aliquam quidem et quia quo. Molestiae qui eius dicta incidunt distinctio rerum cumque. Aut non qui sint et.\n\nLibero iure eveniet porro harum cumque earum. Harum qui aut architecto explicabo. Odit magni reprehenderit dolorum modi. Tempora ut pariatur odit. Voluptates necessitatibus esse quisquam quidem voluptate.', '2019-07-11', '2024-12-12', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(149, 149, 'Natural Sciences Manager', 'Sed unde et reiciendis quo possimus. Dolores neque totam reiciendis autem. Harum doloribus possimus consequuntur accusantium nisi.\n\nDolorem veritatis veritatis cumque aut. Quia minus ea necessitatibus. Eos iusto rerum velit dignissimos est. Unde totam unde repellendus ut dolores et cum.\n\nMollitia repudiandae et occaecati sunt corporis enim repudiandae. Accusantium sed laborum id unde vel iste. Quibusdam nostrum velit natus temporibus ratione occaecati quod.', '2020-02-17', '2024-01-19', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(150, 150, 'Tailor', 'Nihil sed facere magnam assumenda. Qui fugit laborum consequuntur voluptas qui. Eum iusto laboriosam et.\n\nNulla non totam quia voluptatem et voluptas eveniet odio. Nihil voluptatem sit facere nihil est aut. Ab est est placeat enim.\n\nNeque voluptas et veniam excepturi beatae beatae eligendi. Commodi dolor harum fugit. Ex voluptatum expedita illo aut quod. Sunt consequatur tempora blanditiis qui maiores.', '2021-12-06', '2025-03-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(151, 151, 'Welder and Cutter', 'Quod totam odit et nulla quis delectus est. Consectetur odit labore rerum et blanditiis ut molestiae. Pariatur rerum optio et nihil optio. Beatae aliquid sed nesciunt inventore voluptates enim similique.\n\nRepellat fugiat optio nam in neque fugiat unde. Praesentium voluptatem consequatur commodi veritatis.\n\nSimilique ipsum et quo voluptatem unde velit dolor. Dolor quidem id aspernatur tempore. Omnis est ut nemo est in ea.', '2020-12-27', '2024-03-16', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(152, 152, 'Athletes and Sports Competitor', 'Velit vero dolor quidem alias. Voluptatem aut quasi quo dolor dignissimos quia molestias. Asperiores qui eum facere. Minima consequatur eos tenetur debitis saepe itaque impedit. Animi dolor non nemo facere.\n\nSapiente corrupti quo libero qui et corrupti ipsum quo. Error culpa magnam nisi est qui qui.\n\nCorporis qui quas quas cupiditate. Libero quidem et ut hic ut. Pariatur provident vel voluptas quis. Recusandae sint repellat minus quidem non sapiente.', '2021-07-31', '2024-07-30', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(153, 153, 'Music Director', 'Explicabo nesciunt reiciendis et illum qui. Reiciendis molestiae aspernatur dolor amet. Eos molestiae quis sed quo aut autem id consequatur. Nemo error quo iusto autem ea neque.\n\nEum perspiciatis aut odit adipisci reprehenderit rerum voluptatem dignissimos. Dolor et earum est ab vel nesciunt vero ad. Autem laboriosam voluptatum ratione voluptas ipsa. Est et illum quam.\n\nConsequatur laboriosam quis doloribus reprehenderit. In error dolor qui cupiditate. Architecto doloribus et dolorem porro esse ut. Pariatur maxime commodi rerum dolores dicta est a.', '2016-03-05', '2024-09-04', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(154, 154, 'Welding Machine Setter', 'Explicabo rem tempora eligendi aliquid. Dolores et molestiae et nisi. Quo cupiditate vel vel aut temporibus excepturi minus. Dolore dolor dolorem consequatur vero quisquam impedit.\n\nQuis quia quidem aliquid excepturi soluta molestiae. Aut autem et voluptatum facilis reprehenderit autem totam. Enim quo laudantium beatae reprehenderit dolores.\n\nNulla magnam velit eligendi laudantium qui et ut. Et ducimus voluptate assumenda amet quis maiores quas. A velit cupiditate odio illum et.', '2020-07-06', '2023-07-19', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(155, 155, 'Waitress', 'Odio repellendus quod cum atque illo impedit. Saepe aperiam inventore et voluptas sint incidunt. Animi harum dolorem nisi est quia distinctio ea.\n\nDolor repellendus architecto repudiandae illo. Sunt sint eos sit quasi id nam. Dolores voluptatem aliquid impedit aut nisi et velit voluptatem.\n\nLibero quibusdam possimus repellendus praesentium distinctio ea. Necessitatibus est est dolorem ea quia. Nisi et ut dolorem et sit rerum. Et et necessitatibus ab tempora.', '2021-05-24', '2023-11-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(156, 156, 'Staff Psychologist', 'Fuga totam itaque dicta tempore. Repellat dolorum eos autem hic commodi.\n\nEst earum explicabo ut aut. Non at quaerat hic error vitae omnis. Tempora corporis praesentium et dignissimos rem. Dolore recusandae ex itaque harum recusandae hic est ut.\n\nEt explicabo est qui libero. Voluptatem officiis quis sit temporibus et corrupti. Libero consequatur libero eius. Praesentium sit ullam ea omnis non dolores excepturi.', '2019-11-13', '2024-12-08', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(157, 157, 'Operations Research Analyst', 'Dolor placeat a distinctio nobis. Amet voluptate et qui officia sit harum animi. Temporibus illo sunt asperiores est maiores.\n\nError eaque expedita cupiditate ut. Voluptas esse eius sit est veritatis deserunt adipisci. Et aliquid omnis placeat quisquam facilis illo nihil sequi. Est quidem sapiente porro voluptas.\n\nInventore alias a fuga eaque esse. Consequatur et omnis aliquid laborum. Consectetur corrupti esse dolorum expedita animi nostrum.', '2022-05-23', '2023-07-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(158, 158, 'Order Clerk', 'Reprehenderit doloremque impedit quam tempora. Nihil ut et excepturi. Quos aut ea eius sapiente voluptatum. Ullam sequi excepturi officiis tempore. Aspernatur aperiam repellat et.\n\nOmnis aliquam ut dolore doloribus in velit. Assumenda nesciunt et autem illo unde. Atque aut incidunt quia corrupti. Atque repellendus dolores animi ut dolorem.\n\nEnim error voluptatem libero et. Reprehenderit repellendus fugit delectus pariatur voluptatibus. Temporibus in iusto illum iusto minima excepturi.', '2018-02-01', '2024-11-09', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(159, 159, 'Gluing Machine Operator', 'Sapiente nemo voluptatem itaque blanditiis vero. Eveniet doloribus dolore reprehenderit pariatur voluptatem sunt. Non qui repellendus aut asperiores dolores et dolores illo.\n\nError explicabo magnam voluptas ex asperiores incidunt. Quo iusto vel sequi dolores voluptates.\n\nIpsam eligendi similique aut atque nesciunt ut. Odio occaecati maxime iusto eligendi voluptates commodi delectus. Molestias delectus at autem dolor.', '2019-11-30', '2024-09-17', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(160, 160, 'Airframe Mechanic', 'Voluptatum repudiandae nemo ipsam dolore eos perspiciatis. Ipsa non autem molestias rem et cum numquam. Temporibus vel assumenda fugit et et. Ad modi esse sit aperiam.\n\nNeque incidunt et consequuntur quis odit quod. Ipsum numquam explicabo odit tempore. Eos rerum et est nihil.\n\nQuidem consequuntur qui eos at dolor. Reprehenderit voluptatum excepturi recusandae voluptas est. Quis accusamus dolorem amet mollitia assumenda consectetur.', '2023-03-10', '2023-08-24', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(161, 161, 'Ambulance Driver', 'Voluptatem quis tenetur corporis qui tempore eligendi qui. Rem iste cupiditate sed culpa ducimus. Sunt nisi qui a explicabo.\n\nId rem autem rerum commodi illum explicabo voluptas. Ratione accusantium autem reprehenderit repellendus quam porro molestias sequi. Odio vero et blanditiis autem vel. Exercitationem similique sed doloremque accusantium est.\n\nDelectus minima aut optio minima. Inventore beatae est nisi aliquam sed debitis. Saepe qui nemo velit.', '2022-01-27', '2023-12-15', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(162, 162, 'Buffing and Polishing Operator', 'Est molestiae quae id rerum vero voluptatem molestias. Nulla molestiae quia neque et doloribus aspernatur eligendi. Porro voluptatem harum ab quis totam. Omnis cumque aperiam perferendis aut aliquam beatae quidem.\n\nMolestias earum aperiam aut cumque qui distinctio. Natus sit rerum temporibus neque voluptatem molestias. Veniam aperiam minima repellendus consequatur.\n\nEt sapiente distinctio aut non dolorum non. Qui deleniti numquam expedita. Molestiae inventore officia repellat est quidem.', '2015-11-15', '2025-01-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(163, 163, 'Metal Pourer and Caster', 'Dolorum esse non vel assumenda veniam perspiciatis quibusdam. Et sint qui eligendi temporibus. Et veritatis corporis animi rerum sed.\n\nLabore dolor consequuntur veniam qui fuga quia. Omnis voluptatem eligendi ad porro et.\n\nEt minus tenetur saepe perferendis vel cumque. Facere aut quasi inventore fuga in repellat error voluptatem.', '2018-04-29', '2025-04-25', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(164, 164, 'Real Estate Broker', 'Dolore error et consequuntur rem quibusdam ullam. Dolorem quo quibusdam perspiciatis qui dolor eum quia. Facilis laudantium voluptatem illum voluptatem ad porro et autem. Earum et et est nulla.\n\nDoloribus ratione ex sed tenetur. Aliquid natus eius rerum est quis et odio. Dolorem et vero sed voluptatem sint tempore voluptates adipisci. Nostrum quo quia voluptas et vitae itaque in.\n\nQuae nihil vero animi. Modi quia dolor sit. Optio repudiandae molestiae velit est magnam.', '2015-06-23', '2024-01-05', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(165, 165, 'Potter', 'Explicabo laudantium et illum. Deleniti doloremque suscipit error. Eos consequatur incidunt eligendi. Mollitia et non omnis distinctio. Est itaque ut expedita consequatur sunt enim.\n\nSed dolore impedit rerum fugiat quo officia at. Ipsam est est tempora ducimus.\n\nDolor iure dolore dolorem fugiat asperiores fugiat est et. Vel similique dolore culpa velit minus. Rerum dolorem in est omnis reprehenderit. Eum illo ut eius sunt quam qui.', '2018-09-01', '2024-01-28', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(166, 166, 'Commercial Diver', 'Ut explicabo est ex sit debitis officiis consequatur. Est ut et totam velit tempore rem porro. Officia fugit aspernatur suscipit.\n\nSint doloribus aut ut. Laborum ea id facilis aut est. Maiores cumque voluptas dolore atque.\n\nDistinctio aut non amet ut excepturi debitis in. Et fugiat cum iste consectetur tempore excepturi. Eos eos et cumque rerum qui repudiandae beatae.', '2018-03-18', '2024-01-17', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(167, 167, 'Command Control Center Officer', 'Illum et velit fugit. Quibusdam nihil quas ratione quaerat non omnis hic. Aut explicabo voluptatum quisquam nisi.\n\nFugit laborum enim possimus magni est numquam reprehenderit ut. Recusandae eos dolores ducimus numquam. Incidunt deleniti perferendis odio quibusdam veniam maxime. Doloremque fugiat molestias velit.\n\nVoluptas enim voluptas quidem eligendi veritatis qui ipsam. Quibusdam ad possimus atque vel rerum excepturi quod. Est nihil nam nisi accusantium.', '2023-05-28', '2025-05-02', '2025-06-01 11:28:44', '2025-06-01 11:28:44');
INSERT INTO `experiences` (`id`, `user_id`, `title`, `description`, `from`, `to`, `created_at`, `updated_at`) VALUES
(168, 168, 'Decorator', 'Doloremque sint esse consequatur et. Accusamus nostrum vel incidunt provident. Minus necessitatibus fugiat ut reiciendis nulla rerum at qui. Saepe et pariatur aut aut.\n\nAut dolor explicabo et nihil rerum rem quas. Libero et et voluptatem quasi nulla molestiae.\n\nAliquid amet dolores quisquam veritatis. In dolorum tempora dignissimos tempora facilis. At nisi voluptatem at eos suscipit quo.', '2017-01-21', '2024-10-14', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(169, 169, 'Real Estate Association Manager', 'Veniam perferendis provident quia qui est ea voluptate. Qui assumenda commodi quam repudiandae et vero. Eum tempora porro aliquam aut porro molestiae possimus.\n\nAut voluptatum odio blanditiis odit perferendis. Nihil sint esse magnam totam. Rerum magni magnam et eum ducimus.\n\nEt et expedita necessitatibus reiciendis harum occaecati. Ab maiores ut corporis qui reiciendis est tempora. Voluptas dolores voluptas officiis voluptatem.', '2021-11-15', '2023-09-17', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(170, 170, 'Landscape Artist', 'Quae eum qui ipsum officiis. Eligendi vitae doloremque provident rem et totam rem. Repellat consectetur quos et iste suscipit eos quis.\n\nUllam voluptates dolores et cum et placeat perferendis et. In alias neque molestias nemo. Perspiciatis quos sed cum commodi eligendi.\n\nQuod minima sint error illum ex. Sequi amet quos facere quis cumque eligendi commodi error. Et dolorem quaerat ut ratione veritatis. Nesciunt rerum sit magni error dolorem.', '2019-08-02', '2023-06-18', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(171, 171, 'Farmer', 'Eius soluta maxime temporibus beatae odio. Dolorem atque commodi enim quo. Sit sed illo fuga consectetur est tenetur.\n\nSed tempora ea eum voluptatem. Qui iure quia earum culpa non iure neque. Vitae qui alias optio.\n\nEt eligendi magni ut doloribus. Recusandae necessitatibus dignissimos sint odit quis est. Quis repudiandae quibusdam officiis eligendi molestiae nobis aut.', '2016-03-14', '2024-08-21', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(172, 172, 'Ship Mates', 'Nostrum id quae autem est cumque. Qui veritatis qui explicabo harum. Autem debitis et accusamus aut animi.\n\nVitae magnam sint totam tenetur aut illo. Qui id quod voluptate repellat maxime. Beatae illum harum ut distinctio rem. Quia doloribus in aspernatur illum dolore impedit voluptatem beatae.\n\nVoluptatum tenetur laborum quia et voluptatem ipsam quo. Deserunt perspiciatis et nihil odit. Totam reprehenderit consequatur quos atque. Quia sed et quod eveniet animi quia. Hic accusantium id modi dolor excepturi.', '2022-03-11', '2024-09-27', '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(173, 173, 'Gas Pumping Station Operator', 'Eum eaque id id consectetur dignissimos. Ipsa velit non atque minus veniam. Sed autem rerum dolores odit.\n\nQuo distinctio fugiat nihil nostrum sed saepe. Est dolores voluptatem iusto dolores doloribus. Doloribus totam laboriosam fuga perspiciatis quisquam. Aut eveniet labore cupiditate.\n\nSunt qui ea similique saepe. Ut delectus voluptas nam sit voluptates est. Qui eveniet placeat laudantium consequuntur amet.', '2018-11-01', '2025-01-26', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(174, 174, 'Nuclear Technician', 'Et libero similique quae sint qui repellat. Quae nemo reprehenderit excepturi quisquam. Quo consequuntur aspernatur aliquid consequatur ut. Qui eum repellendus est rerum velit.\n\nA sit impedit ullam quaerat adipisci sint. Repudiandae quo qui nisi saepe saepe necessitatibus perspiciatis. Dolore omnis incidunt dignissimos cum aperiam dolores sint. Eligendi voluptas similique saepe dolores aperiam quia.\n\nQui assumenda reprehenderit qui et possimus architecto quos. Laborum voluptatibus quo dolor in non quisquam. Rem ut et vel aut porro eum vel sit.', '2017-05-08', '2025-04-22', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(175, 175, 'Motorboat Operator', 'Vel veniam voluptas occaecati et. Et voluptatem saepe aut ut reprehenderit architecto dignissimos. Impedit voluptates iusto deleniti fugit voluptates qui illo. Voluptatem optio delectus et corporis est.\n\nNostrum suscipit tenetur sed eos. Ea qui in ut reprehenderit consequuntur vitae. Nihil vitae quis voluptas consequatur sint. Tempora consequatur ipsam et doloribus id excepturi mollitia. Similique dolorem qui libero eligendi et ullam animi.\n\nOmnis voluptates sed dolores alias sequi. Iusto consequatur porro sit est est.', '2016-07-27', '2024-01-18', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(176, 176, 'Ship Engineer', 'Recusandae reiciendis nam est amet. Nostrum suscipit excepturi nobis explicabo. Adipisci et vel et unde vero.\n\nMinus in et atque aperiam cum laudantium sed error. Aut est eveniet quia. Alias in eligendi consequatur est.\n\nNihil rerum veniam magnam facilis. Ducimus qui assumenda iusto voluptatem et. Neque voluptatem eligendi nesciunt sit. Non explicabo odio eaque est.', '2019-07-30', '2024-07-03', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(177, 177, 'Bartender', 'Nisi provident sed beatae tempora in aut earum quis. Doloremque ut dolores ducimus sit. Sint voluptatibus fuga blanditiis ab velit aut quidem. Ut autem commodi perferendis debitis est.\n\nEius qui corporis libero in fuga. Illo qui perferendis odit neque. Ad et eos atque et possimus delectus. Eos corrupti quia aut laudantium consequatur laudantium rerum et.\n\nSunt quis sed sit earum sit deleniti delectus. Ipsum facere corrupti cum eos perspiciatis. Mollitia libero enim at reprehenderit distinctio. Deserunt officia vel aliquam.', '2020-02-19', '2024-05-29', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(178, 178, 'Shampooer', 'Aliquid id ipsa laudantium odio amet accusamus qui nihil. Omnis consequuntur numquam et velit non molestias. Sequi libero dignissimos omnis ullam ut quia. Non nesciunt molestias laboriosam voluptatem et ea eos rerum.\n\nCorporis similique est quia aut et ut. Sit id error ipsum voluptatum laboriosam. Doloribus atque magni voluptas saepe. Quia molestias repudiandae totam harum unde nihil.\n\nTemporibus quia non enim explicabo omnis. Doloribus ratione voluptatem sed odio tempore. Quo pariatur deleniti consectetur odit nihil qui. Quos ducimus consequatur voluptatum repellat.', '2020-05-17', '2023-06-16', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(179, 179, 'Geological Sample Test Technician', 'Quo delectus adipisci dolorum quis sint a aut totam. Aspernatur voluptatem ipsum iste ducimus magni perspiciatis. Doloribus voluptatum molestias provident voluptatem quis adipisci voluptatibus.\n\nCorrupti quia vero culpa et. Provident sit quam totam eos tempora consequatur. Consequuntur et quibusdam ea molestias.\n\nVero deserunt natus voluptas est delectus quia culpa. Expedita inventore reprehenderit animi adipisci est optio. Placeat sint iste minus ut nulla ut rerum.', '2018-09-10', '2024-12-03', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(180, 180, 'Insurance Underwriter', 'Architecto facere rem repellat. Nihil dolore ab ut fuga. Aliquid rerum quia corrupti et odit.\n\nUt dignissimos nostrum consequuntur voluptatem. Eos ducimus aut consequuntur ipsam eum. Minus voluptas dolorem sed sit aut.\n\nNulla autem id eos veniam. Officia consectetur culpa eius sit. Blanditiis in deleniti magnam a ipsam eos distinctio. Asperiores sint repellat debitis inventore nemo et unde dolorem.', '2019-05-08', '2024-02-04', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(181, 181, 'Heating and Air Conditioning Mechanic', 'Error sequi odio nesciunt doloremque voluptatem nobis qui. Quaerat velit tempora et quidem aut ea. Consequatur eum accusamus unde aspernatur sint. Nostrum veritatis excepturi minus assumenda temporibus beatae.\n\nEos voluptas aut reprehenderit dolorem impedit. Reprehenderit officia expedita eos et.\n\nDolores ut maiores recusandae dolorem id amet. Quia repudiandae sunt aut debitis consequatur recusandae. Modi quia enim qui dolor eos. Sit odit incidunt nesciunt tempore facere ex asperiores.', '2016-04-16', '2023-09-09', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(182, 182, 'Education Administrator', 'Consequatur qui aut qui provident ea. Maxime deserunt ut magni sed iure sit. Ab quod voluptatem expedita provident. Sint sunt sed sed non aut eius.\n\nSunt optio laudantium itaque delectus autem qui repudiandae. Illo debitis molestiae sequi in totam. Sed asperiores cum reiciendis voluptates cupiditate omnis accusamus. Et ratione ut debitis nam eum quaerat.\n\nSint ipsum voluptatem nihil consequuntur eaque ratione. Quia in dolor asperiores labore quis vero. Voluptas sed in recusandae quasi nesciunt dolorem.', '2021-04-18', '2024-01-16', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(183, 183, 'Production Planning', 'Excepturi sit et quo. Est labore voluptatem nam in voluptatibus accusamus ipsum. Animi asperiores quibusdam minima sed quam.\n\nEt neque sint consequatur quam. Et nostrum ea earum laboriosam nemo ullam aspernatur. Dolore neque et ut provident tempora et dignissimos cum. Optio cupiditate atque quae delectus voluptas architecto vitae. Sunt et aspernatur labore deleniti culpa.\n\nQuia deserunt sapiente quos. Explicabo sint tenetur nihil suscipit et temporibus omnis velit.', '2021-06-24', '2024-07-19', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(184, 184, 'Occupational Health Safety Specialist', 'Non itaque ipsam quibusdam et. Fuga eos fugit neque dolorem nam. Animi placeat dolor est ad autem corporis error.\n\nEa qui in accusamus fugit est qui. Deleniti quia aut quidem est. Dolores quis dolores distinctio perspiciatis harum minus. Ut excepturi doloremque odit esse facere. Dignissimos quia quo sit.\n\nAut expedita qui dolores eos. Quisquam eaque cumque provident tempora maiores ea neque est. Illum et sit nisi qui eos.', '2021-11-03', '2024-02-21', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(185, 185, 'Engine Assembler', 'Id quia quas eius non. Repudiandae magni dignissimos hic ducimus cumque dolore recusandae. Incidunt molestiae velit et et est. Recusandae laboriosam eveniet quod possimus omnis omnis in praesentium.\n\nEx velit ex hic et quos nihil beatae accusamus. Eius ullam modi suscipit soluta quo amet aliquid. Quod voluptatem sit nisi consequatur.\n\nNecessitatibus et harum harum dignissimos. Doloribus atque commodi et omnis ipsam modi corporis. Non enim autem enim et voluptatibus. Quasi maiores totam amet corrupti blanditiis. Rerum ut ut nemo tenetur et ut culpa amet.', '2017-07-15', '2023-12-02', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(186, 186, 'Clinical School Psychologist', 'Ducimus suscipit autem quis ut recusandae reiciendis optio. Omnis repudiandae nulla dicta magnam. Dolore quidem quae pariatur asperiores in vero delectus alias. Velit dolorem ea enim eveniet asperiores reiciendis incidunt.\n\nQuo molestias rerum voluptatem culpa corrupti ullam. Iusto voluptatibus nulla temporibus officiis aspernatur suscipit.\n\nSit sequi veniam nemo est velit non qui. Eum voluptatem debitis vitae non dicta quaerat. Dolorem hic sequi laudantium ipsa.', '2016-04-11', '2024-12-28', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(187, 187, 'Metal Pourer and Caster', 'Aperiam minus qui tempora sunt porro velit quibusdam. Autem autem reprehenderit itaque autem id officiis. Quam id maiores facere sint accusamus deserunt nemo.\n\nNesciunt rerum expedita eum sequi delectus sequi id. Exercitationem porro iste non quia aut eligendi. Accusantium facere corporis et reiciendis vero eum laboriosam incidunt. Accusantium tempora facere odit quibusdam reiciendis non.\n\nSunt culpa eius omnis. Nesciunt est voluptatem similique odit non et. Aut sequi ut voluptatem quia. Et nam omnis natus vel nisi inventore non corrupti.', '2016-07-11', '2024-06-20', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(188, 188, 'Restaurant Cook', 'Harum facere voluptatem aut commodi quidem accusamus. Ducimus omnis odio labore omnis consequuntur corporis omnis. Provident sunt neque dolor provident voluptatibus.\n\nEt sit ex quam aut numquam qui explicabo. Molestiae nemo sunt totam. Porro voluptatibus beatae impedit porro doloribus aut officiis beatae. A ut temporibus veritatis ad velit iure.\n\nQui nihil officia esse vel in. Dolor iure voluptatibus ad mollitia hic quo. Esse odio et rerum corrupti.', '2018-07-05', '2024-06-14', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(189, 189, 'Title Examiner', 'Dolor voluptatum harum assumenda non amet eum. Facere quia cumque debitis veritatis at dolores. Vel fuga rerum atque et officiis facere dolor dolor.\n\nRerum sed ut quisquam alias occaecati. Fugit sed pariatur ut eligendi accusantium qui velit. In debitis doloremque rerum eum voluptatum. Inventore rem et aut.\n\nEius ad occaecati sunt velit eum exercitationem. Earum et hic ut animi omnis rem. Maxime ut voluptate repellat quos non qui. Dolores accusamus sed tempora sed.', '2020-12-11', '2025-04-20', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(190, 190, 'Credit Checkers Clerk', 'Nostrum ipsa voluptatem doloribus quia facere doloremque eveniet. Fugit est perspiciatis sunt consequatur. Minima odit quae cum ratione magni nulla vero. Accusantium vitae culpa neque facere quasi quis consequatur.\n\nIpsam ipsam ex nostrum quisquam velit voluptas qui facere. Ratione assumenda eligendi et error maxime voluptatum. Fugit ratione perferendis id est enim tempore mollitia. Dolores et nemo quas non doloribus.\n\nOmnis eos facilis qui nesciunt. Doloribus laboriosam laboriosam non ut ullam qui. Voluptates tempora aut reprehenderit suscipit dolore ut. Qui iusto harum nisi dolorum.', '2022-08-13', '2025-02-22', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(191, 191, 'Social Media Marketing Manager', 'Placeat eligendi facere architecto molestiae quis dolorum. Alias quo repudiandae aut occaecati dolorem dolores ut sunt. Sint voluptatum tempore tenetur aut enim harum esse voluptatum. Veritatis dignissimos assumenda facere ex consequuntur rem enim et.\n\nNumquam voluptates itaque enim qui sed ratione. Beatae quaerat incidunt expedita. Repellat aut quas possimus molestiae reiciendis similique. Nam placeat sint sint facere quibusdam praesentium aut amet.\n\nImpedit laborum qui similique a deleniti excepturi quae. Quia reiciendis voluptas quaerat. Quibusdam qui nihil quam vero ducimus suscipit. Iusto doloremque expedita ut non labore.', '2019-11-27', '2023-10-14', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(192, 192, 'Transformer Repairer', 'Non ea assumenda aliquid voluptatem aliquam. Dolorem maxime officia aut voluptates nisi aut dignissimos.\n\nExcepturi vel cumque corrupti aut eius non voluptatem et. Magni quod et voluptate est. Possimus nam dolore repellat est nihil et pariatur.\n\nEnim quibusdam repudiandae labore laboriosam voluptatem dolorum. Error dolorem et cumque eaque a et libero. Facilis ab id ad voluptas asperiores laborum architecto.', '2016-07-28', '2023-11-05', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(193, 193, 'Cutting Machine Operator', 'Cumque rerum totam distinctio. Quia aliquam molestiae et molestias harum. In mollitia culpa natus beatae odio tenetur ducimus. Reprehenderit est nemo autem eius cupiditate laborum.\n\nNihil totam nihil possimus voluptatem pariatur odio. Quo quas omnis sed eos explicabo dolorem. Sequi omnis esse deleniti eius accusantium qui. Delectus enim ab veritatis.\n\nEt est quia similique nisi non. Assumenda ut aut est maiores dicta unde qui. Dolore neque laboriosam dolor ipsam quam. Dolore aperiam rerum dolores sit repellat.', '2022-04-06', '2025-04-20', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(194, 194, 'Rail Car Repairer', 'Et sit voluptatem iure atque et. Dolorem quas harum quisquam molestiae aliquam debitis. Dolorum impedit sed est.\n\nVelit rerum odio ad accusantium temporibus. Provident impedit enim laudantium. Voluptatem est autem adipisci et est ex sequi id. Quisquam qui aliquid vel iusto nihil eveniet.\n\nRepellendus ipsum quasi facilis sed quia aut cum. Blanditiis ut fuga quis dicta laborum tempore. Optio tenetur sed rerum sequi sed cumque unde. Aspernatur alias illo perferendis cupiditate.', '2022-10-31', '2024-08-02', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(195, 195, 'Municipal Clerk', 'Sequi voluptate assumenda omnis. Consequuntur numquam numquam deserunt quia. Qui quia tenetur et fuga impedit recusandae sapiente.\n\nDebitis consequuntur id voluptatem et. Facere aut pariatur at eaque iure. Voluptas qui placeat rerum provident iusto id porro. Velit ratione rerum neque cumque laborum assumenda.\n\nQuasi temporibus in repellendus nihil quas aut quod. Officia ut vitae amet nemo aut. Aliquam repellendus recusandae ea natus.', '2021-05-21', '2023-09-12', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(196, 196, 'Technical Specialist', 'Laudantium molestias qui et aut quia. Est adipisci nobis nulla odit. Pariatur voluptas atque vel id hic.\n\nRecusandae quia ad optio commodi corrupti cupiditate totam. Est culpa et similique sint officiis et sit ut. Nostrum magni officiis rerum impedit magnam ipsam aut. Neque quas deserunt qui rem nihil quia.\n\nEst iste est et asperiores. Aut ab occaecati perferendis saepe fuga nobis. Amet praesentium est doloribus quia porro enim ut est.', '2022-07-18', '2024-02-23', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(197, 197, 'Municipal Court Clerk', 'Omnis totam aspernatur voluptates earum eligendi suscipit iste. Distinctio velit reiciendis delectus.\n\nQuia delectus laudantium accusantium voluptatibus. Facilis dolor ut iusto accusamus autem est dicta.\n\nMaiores totam cum ut asperiores voluptatibus sapiente dolores sit. Similique sint sequi tempora occaecati a sed voluptate. Omnis ut quia aut eum et. Culpa quod praesentium dolores tenetur saepe.', '2018-10-28', '2024-08-05', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(198, 198, 'Sawing Machine Setter', 'Voluptatibus et sed eveniet quibusdam molestiae est. Non omnis sunt eos aut et veniam incidunt. Molestias atque numquam et ab fugiat cumque voluptas. Rerum debitis est voluptas eius quis.\n\nCum doloremque esse expedita veritatis. Quae sit necessitatibus voluptates sed. Quis quam veniam quo. Assumenda nisi debitis voluptate error.\n\nTotam ab occaecati excepturi voluptate. Rerum commodi sint quia incidunt et similique laudantium temporibus. Voluptatem molestiae quas soluta magni doloribus in vero. Voluptatem labore quia fuga hic cum.', '2020-10-18', '2023-12-26', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(199, 199, 'Athletes and Sports Competitor', 'Non tempore quasi fugit exercitationem corporis autem. Incidunt praesentium molestias pariatur et illo rerum nesciunt.\n\nPraesentium magnam corrupti molestias voluptatem ipsa animi debitis nisi. Minima eligendi cumque facere temporibus voluptatem occaecati. Aliquam quisquam voluptas nemo dolorum.\n\nEt est sed nisi. Architecto beatae officiis excepturi fuga. Fuga deleniti rem necessitatibus et. Ducimus necessitatibus cumque fuga modi hic.', '2016-01-22', '2023-11-13', '2025-06-01 11:28:45', '2025-06-01 11:28:45'),
(200, 200, 'Social Scientists', 'Occaecati illo quos omnis occaecati in. Totam mollitia aut aut culpa esse magni. Provident ut hic animi laborum non cumque dolorem. Alias recusandae deserunt fuga.\n\nDistinctio nisi aut accusantium ipsum. Et dolorem aut quis voluptatem sunt. Numquam iure soluta inventore consequuntur ad laudantium omnis.\n\nMinima quam blanditiis et cumque molestiae dolor sit. Vero dignissimos quae perferendis ex ut sed sequi. Nobis odit aspernatur est nostrum.', '2017-06-04', '2024-11-08', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(201, 201, 'Animal Care Workers', 'Sed expedita enim provident rerum ut nisi repellendus. Exercitationem rerum laborum asperiores occaecati perspiciatis nobis explicabo. Quia magnam nemo in blanditiis et et magnam.\n\nAut molestiae repellat est explicabo consequatur recusandae totam qui. Et at sint ipsum. Nobis dicta nesciunt minima aut iusto.\n\nFacilis beatae eos itaque qui quaerat. Et reprehenderit qui quis quis.', '2019-02-01', '2024-05-12', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(202, 202, 'Audiologist', 'At accusamus quasi provident sint nisi facere. Quo aut consequatur incidunt. Facere et nam quo doloremque quasi occaecati.\n\nAnimi nam consectetur sunt beatae ut aut. Ut ipsa aut maxime consequatur animi. Eos quis occaecati sunt atque reiciendis corrupti magni.\n\nQuam ipsum excepturi eaque et. Facilis atque velit reprehenderit dolor. Consequatur autem quo quia commodi nesciunt molestiae.', '2019-12-12', '2024-03-16', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(203, 203, 'Ship Carpenter and Joiner', 'Quis beatae quidem quae quis. Voluptatem amet eveniet sit doloribus. Dolores et et vero aliquam necessitatibus omnis odit.\n\nVoluptatem et blanditiis et placeat dolorem amet maiores a. Et quis quod pariatur aut voluptas veniam. Sunt beatae optio voluptas eius.\n\nMinima iusto eum ut quae. Vel consequatur consequatur corporis officia sint esse voluptate fugiat. Vel vero necessitatibus aut eum nihil.', '2021-05-19', '2024-11-21', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(204, 204, 'Exhibit Designer', 'Sit ducimus dolores ea tempore provident earum. Qui nostrum mollitia totam voluptatem consequatur aperiam. Sed commodi et qui. Possimus velit cum est asperiores. Aliquid blanditiis excepturi esse quisquam ea commodi.\n\nPorro dolores saepe sint odit nihil excepturi alias. Dolores ea voluptatem maxime deserunt. Aut porro illum quasi commodi.\n\nVeritatis ut ex nulla quae. Est et maxime qui illo. Quo et sint rerum placeat temporibus voluptate ut dolor.', '2018-07-19', '2023-09-07', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(205, 205, 'Benefits Specialist', 'Soluta ut quaerat eos cupiditate perspiciatis. Enim eveniet recusandae corrupti rerum hic. Corrupti vero cupiditate sed voluptas quo. Qui est ducimus ut aut neque sapiente aut praesentium.\n\nAtque laboriosam culpa ab quia nemo voluptatem voluptas. Quia et sint officiis explicabo. Pariatur saepe dignissimos est placeat ipsum perspiciatis. Exercitationem et occaecati qui molestiae sunt ut. Illo veritatis ipsam id sit impedit rem sit.\n\nAmet quos error incidunt impedit doloremque. Impedit quae accusantium libero cumque sint molestiae nisi distinctio. Est neque incidunt a molestias et perspiciatis qui.', '2019-10-28', '2025-01-28', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(206, 206, 'Bindery Machine Operator', 'Repellat accusamus ad aut quia nemo. Voluptates nemo alias dolor culpa magni. Ratione cum asperiores sint ratione sapiente. Et non quia consequuntur quia.\n\nQuas deserunt sapiente laudantium inventore ipsam fuga. Corporis in omnis esse nihil aut culpa.\n\nAccusantium provident maiores accusantium autem sit culpa reiciendis. Nisi iure et nihil dolores totam expedita excepturi. Quis eaque labore sapiente officiis libero illum quia. Quaerat hic magni non eveniet quae. Consectetur atque provident reiciendis et.', '2021-12-27', '2025-05-16', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(207, 207, 'Railroad Yard Worker', 'Quis quia numquam blanditiis minima sequi in ut. Atque esse consequatur sapiente omnis.\n\nFacilis temporibus ullam asperiores temporibus autem labore omnis delectus. In autem qui non officiis quidem. Molestias voluptatem ad earum minus qui vero non. Consectetur iste non accusamus temporibus autem rerum.\n\nAutem repellat quia possimus tenetur ullam vel. Voluptatum qui ipsam voluptate quis delectus. Et aut laudantium ut veniam maxime.', '2016-07-15', '2023-07-07', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(208, 208, 'Housekeeper', 'Nesciunt cupiditate dolores qui qui labore laboriosam. Atque voluptatibus rerum laboriosam corrupti. Qui sed numquam exercitationem laborum provident unde. Molestiae corporis ex consectetur nisi et unde quas. Accusamus fugiat quibusdam repellendus delectus placeat dicta ad.\n\nRerum officia aspernatur dolorum cumque aut. Dolorem exercitationem eius ad expedita. Cumque dolores qui asperiores consequatur quas.\n\nUnde iure iure ut pariatur est. Corrupti porro et quasi dolore in velit.', '2021-02-12', '2025-04-19', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(209, 209, 'Plant Scientist', 'Doloremque ut voluptatem atque et illum minus voluptatibus facilis. Expedita aut reiciendis est architecto numquam ipsam. Ea voluptatem qui dolorem corporis.\n\nRerum sit vel qui. Est dolorem voluptatem eos provident et fugit aut. Doloribus quasi autem voluptas excepturi.\n\nFugiat ea iusto sunt rerum neque debitis. Magnam nam voluptatem deserunt illum. Nulla facere velit voluptatibus vel.', '2016-08-20', '2024-06-06', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(210, 210, 'Project Manager', 'Illo aut quia eos unde dolor ut voluptatem sunt. Aut at odit sed eveniet nihil porro occaecati in. Voluptas cumque dicta et accusamus rerum quis et. Veritatis magnam iusto fugit tempore.\n\nSint similique ipsum et quia quasi qui. Accusantium et eveniet nulla placeat. Sit reprehenderit enim iusto officiis reiciendis distinctio rerum. Voluptate molestiae omnis perferendis quod occaecati commodi quaerat eveniet.\n\nDignissimos voluptas impedit quod quas pariatur ipsa. Quae nulla asperiores omnis recusandae quia animi inventore. Minima saepe aspernatur molestiae iure similique totam quam. Et maiores consequatur perspiciatis iste.', '2016-02-03', '2024-09-30', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(211, 211, 'Religious Worker', 'Sapiente architecto animi qui voluptatem necessitatibus. Et aliquam et voluptas est sequi in. Dolores voluptas ullam dolores autem dicta qui. Corporis pariatur eligendi laudantium aut voluptatem.\n\nError atque pariatur ut velit nemo eos aut. Hic eos reprehenderit eveniet voluptatem qui et a. Eos aut deserunt optio. Soluta nisi ut natus facilis qui. Quia est est reprehenderit praesentium et.\n\nEa debitis quo illum repudiandae dolores. Odit consequatur tenetur asperiores. Et fuga fugiat nostrum fugit et.', '2019-10-22', '2025-03-06', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(212, 212, 'Chemistry Teacher', 'Et occaecati voluptatem ut ut beatae et rem eos. Voluptatem et cum qui iusto ut. Asperiores quibusdam recusandae optio natus et voluptas sit quos.\n\nNostrum accusantium repellat maxime ut temporibus ipsam velit. Sit rerum a numquam. Officia quidem aut repudiandae mollitia voluptate repellat.\n\nCulpa incidunt repellendus doloremque qui non. Quae animi culpa doloribus impedit pariatur totam eligendi. Et distinctio qui modi consequatur adipisci. Nemo dolorem quaerat quis et qui hic odio.', '2017-02-11', '2023-07-18', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(213, 213, 'Order Filler OR Stock Clerk', 'Molestiae sunt aut neque architecto explicabo qui. Totam quia officia quia a ipsam est consequatur. Numquam ea ullam reprehenderit quo nulla et incidunt minus.\n\nDolorem molestias similique ex adipisci aliquid. Dicta repellat quia deleniti. Eos veritatis praesentium officia nesciunt nemo deserunt vel nihil. Odio fugit dolorum voluptas excepturi ut rerum enim.\n\nDeleniti neque accusamus veniam magnam aliquam. Optio neque harum fuga impedit illum. Maiores optio eos suscipit.', '2016-08-30', '2024-09-07', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(214, 214, 'Electrical Power-Line Installer', 'Voluptates nulla unde earum quas minima nemo. Magnam consequuntur voluptatem nam sed laudantium. Modi voluptatem cum delectus sit vero. Nostrum omnis et sed quidem enim rerum facere.\n\nSed voluptas debitis id tempora. Et aut repellat ut recusandae deleniti.\n\nEt maiores officia sint sapiente sed suscipit. Quibusdam dolore aut odio tenetur rem eaque rerum. Harum eligendi blanditiis vitae necessitatibus minus harum.', '2020-12-30', '2023-10-24', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(215, 215, 'Hand Sewer', 'Suscipit debitis ducimus vel pariatur. Aut possimus molestias fugiat. Optio asperiores adipisci alias doloremque ut quasi unde officia.\n\nVoluptatem perferendis laboriosam dolores et tempore corrupti. Neque iure eos laboriosam error consequuntur repellat. Et molestiae vero error incidunt quo perferendis veritatis. Recusandae veritatis quaerat quod perferendis placeat illum cumque.\n\nQuae beatae dolor a nam. Possimus fugit tempora illo aspernatur iste. Qui est harum ut quis magni. Quibusdam aut eos qui voluptatem nisi quae.', '2017-04-22', '2025-03-01', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(216, 216, 'Producers and Director', 'Maxime quidem assumenda dolores et. Facere occaecati voluptatem provident ut nesciunt vitae repudiandae. Occaecati totam modi atque aut odio architecto. Omnis ad ad nam nam.\n\nDeleniti accusantium illo ut quisquam ut. Fuga quae modi asperiores necessitatibus laboriosam quis adipisci. Possimus illum qui quae deserunt adipisci. In in quod porro aut non. Atque vero velit quia excepturi magni animi et.\n\nNon officia minus nihil aut voluptatem totam officia. Est quisquam illum a explicabo fugiat at. Tempora inventore qui est quia enim sint.', '2018-10-28', '2025-04-12', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(217, 217, 'Title Examiner', 'Aut et minima nobis quod quia et vel. Sunt error quibusdam officiis quo. Alias nemo vel est qui molestiae. Blanditiis fuga iste ad nobis.\n\nReprehenderit reiciendis officia in et inventore quia. Sed dolorem praesentium repellat. Omnis qui qui ea veritatis dolor. Eum debitis alias nam ducimus.\n\nVoluptatum autem exercitationem aperiam est. Et veniam minus est occaecati ut tempore.', '2019-02-28', '2024-04-03', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(218, 218, 'Terrazzo Workes and Finisher', 'Reiciendis dolorem laboriosam eaque dolores aut nesciunt. Voluptatibus eos et quas suscipit. Dolor commodi occaecati sunt autem nulla ea consequatur.\n\nConsequatur possimus sequi sed ipsum libero nam. Qui delectus id quos omnis cupiditate. Voluptatibus odit quibusdam voluptatem deleniti impedit fuga. Dolores esse ducimus et necessitatibus quas mollitia eveniet. Necessitatibus ullam distinctio modi sit.\n\nNecessitatibus veritatis maiores cum. Quis magni et tenetur harum id et sed. Sint in rerum veritatis vero. Distinctio tempore excepturi eveniet.', '2020-01-08', '2024-09-27', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(219, 219, 'Cultural Studies Teacher', 'Qui sit illo ea quia. Dolorum error nam esse eos expedita delectus. Debitis fuga earum officia consequatur iusto animi laborum sed. Molestiae quasi quia explicabo.\n\nEa commodi consequatur vel commodi aspernatur libero maiores quibusdam. Modi quia voluptas aperiam eligendi. Eum autem quia nisi hic fugit.\n\nIusto commodi nihil et sint velit quis est. Quo eum voluptatem ducimus omnis. Est quos nisi enim.', '2018-01-20', '2024-11-14', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(220, 220, 'First-Line Supervisor-Manager of Landscaping, Lawn Service, and Groundskeeping Worker', 'Non unde atque velit et velit sint aliquid. Inventore atque cupiditate reiciendis enim. Quidem non deleniti quia error accusamus est. A soluta quae cumque eligendi itaque facere.\n\nEarum ex aut velit recusandae dignissimos. Exercitationem ut sequi ut recusandae ea enim. Ut debitis eligendi dignissimos itaque doloribus.\n\nQuos sed officia quo sequi. Sequi minima voluptatum dolor voluptatum quo dolores vel eveniet. Delectus molestias veniam vel mollitia recusandae ut consectetur.', '2019-11-26', '2023-12-27', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(221, 221, 'Metal Molding Operator', 'Quas mollitia sed maxime deleniti. Aut praesentium fugit non dignissimos blanditiis.\n\nEt suscipit exercitationem nesciunt. Nobis porro qui est molestias eaque. Quia fugit deleniti quasi reiciendis excepturi. Itaque sequi explicabo aut ab qui consequuntur nam. Magnam qui laudantium officia quisquam incidunt.\n\nNeque autem velit dolorum et sequi. Necessitatibus et et qui repellendus. Et totam consequuntur et ut occaecati. Qui ullam non distinctio maiores debitis qui laborum.', '2016-09-29', '2024-07-20', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(222, 222, 'Product Management Leader', 'Accusamus quae assumenda earum. Odio reprehenderit nihil tempora iure molestias provident. Omnis beatae quo aut qui tenetur cumque consequatur.\n\nCorrupti et placeat laborum corporis ipsam praesentium laboriosam. Nulla animi porro libero est aspernatur. Iste eum aut rerum.\n\nMinus nobis est sit maiores. Ducimus exercitationem eos quia aut maxime debitis necessitatibus. Beatae nihil magnam error commodi ad cumque in. Non ea rem distinctio aut.', '2016-06-25', '2023-08-15', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(223, 223, 'Radiation Therapist', 'Quibusdam omnis molestiae voluptas dolorem harum reiciendis. Vel quos commodi quia voluptate. Quia qui est voluptatem architecto dignissimos.\n\nQui in accusantium error rerum optio. Sit ad enim veritatis necessitatibus vel similique. Nemo reprehenderit ipsam ex consequatur.\n\nQuaerat enim occaecati rerum qui voluptatem eum placeat voluptatem. Consequatur aut facilis dolores repudiandae ducimus. Ducimus ipsa dicta consequatur quis eos. Laboriosam deserunt ut consequatur quas impedit.', '2020-03-09', '2025-05-04', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(224, 224, 'Mechanical Drafter', 'Fugit nulla veritatis quo commodi consequatur. Quos blanditiis recusandae et consequatur. Quod facilis facilis vitae dolores.\n\nMolestiae consectetur eum in ex minus qui. Suscipit tempore aut sunt. Quia est quae tenetur eaque explicabo.\n\nEst voluptatem debitis sed sunt omnis. Enim sapiente eligendi eos nihil voluptates temporibus. Ea eaque saepe dicta fugiat sit assumenda. Sit id exercitationem aliquid iusto.', '2023-03-23', '2024-08-16', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(225, 225, 'Textile Cutting Machine Operator', 'Qui voluptatem sequi est repudiandae assumenda. Quia qui quibusdam suscipit rerum provident omnis ea. Cupiditate dolorum autem non omnis aut incidunt similique. Omnis atque odio est repellat et sunt. Omnis pariatur laboriosam impedit magni quas occaecati consequatur.\n\nCommodi et ex qui eveniet. Unde doloremque sint eveniet tempore dolorum. Hic deserunt explicabo nihil natus et cum neque.\n\nVelit est et optio facere debitis ipsam qui quo. Aliquid totam eum atque corrupti voluptatum consequuntur expedita. Ipsam et doloremque et numquam vel recusandae.', '2020-03-31', '2024-10-30', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(226, 226, 'Dietetic Technician', 'Itaque mollitia qui et soluta sed ut. Possimus assumenda doloremque cum quo error. Quia deserunt tempora nam vel. Animi omnis voluptatem ut dolores vitae.\n\nDeserunt quo aperiam ad provident omnis. Ratione quod odit laboriosam quo quia voluptas. Molestiae repudiandae tenetur et ducimus deserunt ut. Est dolores a autem officia.\n\nQuod officiis sint repudiandae aspernatur quidem rem. Et qui non qui nostrum quis est. Vero et aut odit voluptate non maiores.', '2019-10-17', '2023-12-11', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(227, 227, 'House Cleaner', 'Quisquam nam quod sed iure error omnis rem quo. Eveniet sint laboriosam dolor culpa possimus animi. Laboriosam quisquam et quia. Numquam perspiciatis expedita omnis non enim ducimus quo.\n\nSapiente quasi mollitia unde. Inventore cumque blanditiis atque. Architecto exercitationem quia deserunt voluptatibus. Et quod quo et ratione qui deserunt.\n\nAsperiores quibusdam ea odit unde quia. Fugit omnis ullam vel exercitationem illum. Eos incidunt autem quas aut voluptatem amet ut. Omnis nulla est eum dolor porro.', '2020-06-01', '2025-01-20', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(228, 228, 'Taxi Drivers and Chauffeur', 'Quidem et eum tempora incidunt modi consequuntur beatae. Deserunt et sit deserunt quisquam iure molestiae. Corporis et dignissimos nemo delectus. Aspernatur sint et occaecati porro enim.\n\nAtque itaque voluptates recusandae explicabo. Voluptas dolorem et vel sequi a et hic. Deleniti vitae autem similique at maiores sit reprehenderit iure.\n\nQuia rem voluptatem cum et omnis id. Quo ipsum voluptas molestias sed molestiae sequi. Dolores consequatur ipsam modi et. Et eius tempore fugiat tempore et.', '2022-12-18', '2024-08-03', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(229, 229, 'Recreation and Fitness Studies Teacher', 'Officiis nisi animi repellat sed. Sapiente omnis error odit esse ducimus. Nisi beatae eos dolorem nam. Quisquam voluptatum quasi hic.\n\nEst omnis et cumque harum iusto voluptas ipsum. Libero et nostrum veniam. Quos accusamus ullam molestiae temporibus.\n\nMollitia magnam eius ut assumenda est voluptatem magnam ipsum. Nam ratione aut doloribus cum qui voluptatem.', '2018-07-31', '2025-02-08', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(230, 230, 'Pipelayer', 'Dolores non eos quas ex et saepe aut. Laborum veritatis consectetur quas autem. Porro consequuntur delectus sit. Optio praesentium ad aliquam accusantium modi.\n\nNihil omnis omnis porro. Animi sunt quo rem. Dolor odit eveniet veniam qui aliquam. Officia ab quibusdam suscipit ipsa veniam.\n\nDolores rerum iste iure sint. Repellendus harum est omnis voluptates vitae ratione. Assumenda aperiam eveniet dolorem aut quis omnis dolorem est.', '2023-01-28', '2024-09-13', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(231, 231, 'Log Grader and Scaler', 'Placeat sint voluptatem qui voluptatibus facere eos qui. Iste porro ad aliquid odio dicta atque adipisci. Aliquam consectetur vero atque quis sit aut eaque.\n\nQuos deserunt earum nemo officia velit. Voluptas culpa aliquid odit magnam est magnam. Sit quam est culpa ipsa. Minima aut nostrum sunt id neque pariatur.\n\nEaque sed et consequatur est aut sit earum quia. Itaque quam laborum nihil culpa. Natus reiciendis quaerat eum quis deleniti consequuntur veniam. Qui rem rerum quia dicta laborum iste fugit in.', '2022-06-21', '2023-10-17', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(232, 232, 'Animal Husbandry Worker', 'Rerum et aut ut quia beatae veniam voluptatem. Similique eos necessitatibus quae sit quia. Eum fugit iste laborum ratione. Dicta ut quis in laboriosam illo deserunt aut nisi.\n\nPerspiciatis quia nam deleniti harum dolorum quia minus. Eos ullam debitis iusto reiciendis vero et. Et et in omnis et ipsam enim. Libero at sed autem eum aperiam.\n\nCulpa eligendi eum soluta sit. Illo debitis magnam sequi in sunt. Ea animi illo voluptates reiciendis occaecati consequatur dicta. Quo repudiandae at molestias alias.', '2022-10-15', '2025-05-29', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(233, 233, 'Substation Maintenance', 'Aperiam et sed dolores omnis rem pariatur. Aspernatur eaque fugit ipsum. Recusandae vero nulla nihil quo blanditiis harum.\n\nCorrupti magnam fuga quia voluptatum laudantium inventore. Qui aut fugiat recusandae ut fugit tenetur aperiam voluptas. Voluptate mollitia omnis hic quis perferendis consequatur minima.\n\nHic omnis corrupti libero consectetur. Numquam et laborum aperiam nemo. Doloremque quo exercitationem doloremque iusto et id enim. Excepturi architecto sequi soluta vitae.', '2018-06-03', '2024-06-03', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(234, 234, 'Psychiatrist', 'Dicta deserunt explicabo et atque. Enim rerum eos omnis vitae in neque.\n\nIpsum omnis architecto unde corporis aperiam. Rerum dolores officiis repudiandae quae non ut dolor. Ut et sit numquam voluptate molestiae at aut aspernatur. Rem sint beatae quaerat modi officiis veritatis.\n\nDolorem provident aperiam adipisci ut quia velit non est. Repudiandae iste porro nam ut fuga tempore. Consequuntur corporis sed totam nesciunt recusandae nobis. Nam deserunt inventore cumque dolorem illo recusandae.', '2023-03-13', '2024-02-12', '2025-06-01 11:28:46', '2025-06-01 11:28:46'),
(235, 235, 'Deburring Machine Operator', 'Velit fugit quas tempore. Iusto dignissimos eum ad impedit. Amet natus nihil expedita incidunt.\n\nUt eum iusto magnam et sed. Placeat ad quis in culpa veritatis non culpa. Qui impedit ab tempore et doloribus autem voluptatem. Nobis soluta architecto quis inventore.\n\nQuis aut aspernatur earum ut ipsam nihil vero. Et enim quasi rerum fuga nesciunt quibusdam sit sint.', '2017-07-20', '2024-04-01', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(236, 236, 'Building Cleaning Worker', 'Fugiat laudantium voluptatem consequuntur est natus at earum dolorum. Quaerat rerum praesentium cum doloribus molestias assumenda. Reiciendis qui autem veritatis tempore praesentium soluta.\n\nVoluptatem blanditiis voluptates quam ipsa. Et qui a in placeat et. Veniam voluptatibus asperiores quidem velit dolores magni ducimus ut.\n\nDolore nihil in debitis aspernatur voluptatum. Ex odio tenetur ab. Vel ipsa quis minima. Vitae id aspernatur voluptatum atque distinctio.', '2020-08-06', '2025-05-23', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(237, 237, 'Surveying Technician', 'Ab eaque aperiam et doloribus eius cumque ullam nesciunt. Autem perspiciatis assumenda quia at quidem quam ratione voluptate. Non omnis ullam esse reprehenderit ut ut ratione.\n\nDolorem id odio omnis illum deleniti. Consequatur et molestias ullam aspernatur. Eveniet ipsa error et minus rem. Ut et omnis aperiam soluta.\n\nQui quasi nam ea quasi sed iure. At quisquam unde soluta. Voluptatem dolores perferendis ratione aut dolor eius. Animi odit et consectetur et consequatur in blanditiis cum.', '2022-02-04', '2025-05-09', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(238, 238, 'Cabinetmaker', 'Animi amet sed rerum dolor et sit ea. Aut placeat aut voluptates reiciendis. Occaecati sint debitis et nulla quo sed est.\n\nEt et nihil sint ad voluptatem. Alias perspiciatis provident est facilis eum voluptatem facilis. Neque autem ipsa est.\n\nUt soluta autem officia deleniti voluptas et. Error provident ut adipisci repellat et nesciunt perspiciatis. Incidunt cumque iure omnis officiis voluptas cum. Doloribus et omnis ea dolores.', '2019-09-12', '2023-08-09', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(239, 239, 'Airframe Mechanic', 'Assumenda natus voluptas voluptate neque. Et voluptas blanditiis doloremque. Quos quia maiores explicabo. Beatae eius corporis sint reprehenderit reprehenderit illo fugit.\n\nIpsam non tempore facere aspernatur qui et voluptatem. Inventore occaecati quidem consequatur repellendus facere dignissimos in voluptas. Debitis modi et dolor quasi voluptas. Tempore nobis voluptate rerum culpa aliquid id.\n\nVoluptatum minus et occaecati et. Eveniet sit reprehenderit quibusdam non assumenda. Provident odio est rerum quod et accusamus.', '2019-07-27', '2025-02-28', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(240, 240, 'Chemical Equipment Controller', 'Voluptas autem ut odit. Deleniti quaerat atque iure ut. Nemo ea sit qui soluta est ex cum. Dolor similique odit assumenda repellat consequuntur.\n\nUt officiis eum rerum voluptatem molestiae consectetur. Quaerat iusto ratione consequatur et eligendi. Cum eum autem voluptatem. Blanditiis aut dolores reiciendis veniam.\n\nOfficia et aut sunt voluptas. Ut sit et in. Placeat nobis voluptatem suscipit. Totam laborum vel neque amet perspiciatis iste ut.', '2020-04-26', '2023-11-11', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(241, 241, 'HR Specialist', 'Et sint vel id iure qui. Magni autem dignissimos molestiae et illum perferendis. Quo quisquam aut et. Odio rerum facere qui dolorem sit officiis.\n\nSed ipsa qui dicta labore amet. At reiciendis rerum officia dolores.\n\nQuas sed id at totam error veniam. Et quia voluptatem aut impedit animi. Optio ea ab earum facilis.', '2016-04-15', '2024-08-25', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(242, 242, 'Court Clerk', 'Sunt quod aut voluptatibus et aperiam cum illo. Doloremque et aliquid impedit et.\n\nUt odit accusantium tempore dolore qui neque veniam. Optio officia doloremque accusantium nostrum cumque hic rerum. Sunt non libero provident explicabo. Voluptatem sit modi officiis velit.\n\nRatione ipsum ut architecto quas. Esse quibusdam voluptatem at placeat laboriosam accusantium. Ipsum animi possimus vel omnis sit.', '2019-04-05', '2023-08-16', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(243, 243, 'Judge', 'Molestiae ad quisquam eius temporibus deleniti sint molestias. Dolor debitis vel enim fuga odio facilis libero. Aut sunt est earum quo natus qui.\n\nQui sit eum reiciendis cupiditate atque. Autem aut occaecati omnis qui reiciendis. Sint voluptatem omnis accusamus. Et eum autem fugit debitis eum provident ullam consequatur.\n\nConsequatur consequatur ad fugit repellat facilis assumenda. Placeat aut rerum qui sapiente. Cupiditate a incidunt quo voluptas ea doloremque in. Id similique est qui illo rerum sapiente occaecati aut.', '2018-04-21', '2023-12-23', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(244, 244, 'Event Planner', 'Reiciendis quia rerum sed quibusdam. Maxime suscipit dolorem sed laborum rerum consectetur culpa. In repellat et soluta qui soluta. Delectus et cum doloribus ipsa quam minus et.\n\nVoluptas sunt ad debitis architecto similique ut vitae. Architecto et quis in dolorem delectus laborum dolorem. Repudiandae ea quia qui totam tempore velit sit. Assumenda et iure expedita consectetur odio.\n\nQuia quia dolor et optio nam. Voluptatem et nemo soluta. Consectetur officiis sunt velit qui impedit sequi. Esse adipisci veniam est et aperiam ut sequi.', '2022-06-05', '2024-09-09', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(245, 245, 'Procurement Clerk', 'Molestias quia modi quod in quo officia. Ex at sint corporis quaerat. Non voluptas ullam doloremque debitis autem sint rem.\n\nSequi occaecati quis qui numquam ea et rerum sed. Sed sunt quae tempore adipisci. Facere non magnam ut consequatur nesciunt non qui.\n\nUt atque minima cupiditate rerum. Voluptas cupiditate ea vitae doloribus iure qui. Voluptatem alias assumenda ex mollitia. Eum rerum deserunt sit maxime accusamus optio magni.', '2016-01-28', '2023-07-31', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(246, 246, 'Fish Hatchery Manager', 'Fuga facere atque exercitationem alias ea eos. Consequatur reprehenderit est ipsum optio dolores nobis. Rerum deserunt quasi qui qui. Eveniet adipisci quas aliquam perspiciatis et provident.\n\nArchitecto inventore assumenda id. Qui praesentium sint harum nam. Dignissimos laborum eius officia quidem dolorem natus velit. Placeat soluta repellendus soluta cum ipsam.\n\nLaborum aut est rem. Quisquam quo laborum ex asperiores. Animi cupiditate harum consequatur. Debitis et quas quisquam aut laboriosam non.', '2018-05-09', '2024-02-10', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(247, 247, 'Correctional Officer', 'Dolore qui qui sequi sit voluptas quae ut. Et quia deleniti ad temporibus a ut asperiores. Quaerat numquam est velit.\n\nFugit qui dicta voluptas aut minus. Rerum quasi voluptate enim eveniet. Soluta optio architecto aliquam nemo consequatur fuga ipsum. Sint dolorum dolor fuga sequi et alias.\n\nAd veritatis rerum repudiandae beatae. Nobis molestiae tempora totam similique. Sint omnis qui cumque. Tempore fuga sit suscipit ut corporis.', '2016-10-24', '2023-10-15', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(248, 248, 'Admin', 'Id quo repellat explicabo ut. Quia et doloremque nisi. Itaque odio iste quae culpa voluptas suscipit quibusdam. Est itaque distinctio sit fuga omnis tempore assumenda.\n\nAperiam facilis dicta et quia dolorem sapiente blanditiis. Qui harum et tempora. Sapiente sint accusamus adipisci sed provident officia possimus veritatis.\n\nVitae qui dignissimos non beatae cum est. Recusandae ipsa iste saepe. Facere totam molestiae incidunt eum illo exercitationem sunt. Eligendi magni excepturi enim a placeat cum.', '2017-12-10', '2024-12-05', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(249, 249, 'Food Preparation', 'Ut earum similique rerum quia a. Nulla laudantium adipisci a maxime earum possimus optio eius. Et ea placeat ipsum est non quia debitis.\n\nRem dicta qui nobis architecto vero voluptates expedita. Expedita reiciendis sit quia iusto fuga aperiam. Sit fuga excepturi est sed id.\n\nNulla autem iure sequi qui delectus eligendi. Blanditiis enim labore neque illum veniam. Dolores et laborum nihil est natus.', '2015-08-06', '2025-01-23', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(250, 250, 'Writer OR Author', 'Aut quia est optio molestias sint occaecati pariatur. Totam laborum repellat asperiores dolores vitae. Labore ad aliquam est qui doloremque in culpa.\n\nAtque est deleniti placeat quo maiores cupiditate occaecati. Voluptas rerum expedita est. Repellendus dolores nihil dolor aut pariatur iste cupiditate.\n\nQui quia ipsa molestias inventore rem et maxime. Sit animi eligendi rerum reiciendis. Sit quis rerum pariatur sunt odit beatae. Officia vel recusandae quia sed placeat odit modi.', '2016-05-30', '2024-03-13', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(251, 251, 'Nuclear Technician', 'Modi hic voluptates praesentium libero. Facere dolor accusamus ut ipsa labore veniam. Rerum quos illum accusamus. Eos sit tenetur inventore facere assumenda nam impedit. Ipsa rerum esse exercitationem.\n\nUnde molestiae ipsum autem nulla tempore similique. Quo incidunt et enim excepturi.\n\nBlanditiis debitis sit eius et explicabo facere rerum. Repellendus et non molestiae repellat. Explicabo error enim minus eaque quia et sit. Beatae repellat quas nihil vel aliquam a dicta.', '2021-08-31', '2024-02-22', '2025-06-01 11:28:47', '2025-06-01 11:28:47');
INSERT INTO `experiences` (`id`, `user_id`, `title`, `description`, `from`, `to`, `created_at`, `updated_at`) VALUES
(252, 252, 'Computer Hardware Engineer', 'Eligendi reiciendis praesentium voluptas quo alias voluptate. Sint asperiores sunt quidem quis ut necessitatibus velit. Non sint dolorem et adipisci sed. Eius est nisi ab voluptas aliquid.\n\nSit at a aut autem ducimus ratione et. Dolorum quis reprehenderit in consequatur. Voluptatum eveniet qui eveniet magni. Molestiae molestiae consectetur cum exercitationem quasi sunt ut enim. Beatae corporis quo eum quasi et eius.\n\nDoloribus et quos sed non sit culpa maiores. Accusamus vero dignissimos inventore dolores aliquid aut. Qui ea id quis est. Eos officia sunt laborum eligendi debitis.', '2019-04-01', '2025-05-12', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(253, 253, 'Agricultural Inspector', 'Quia minima consequatur ea accusantium nulla labore rem. Consequatur fugit ut nisi esse illum voluptatibus molestias. Aut asperiores commodi quaerat nam facere aut. Sint qui labore delectus recusandae voluptas quos.\n\nEt et adipisci autem possimus architecto. Culpa ratione enim minima tempora amet. Rerum officiis necessitatibus et et consequatur dolorum officiis fuga.\n\nCommodi modi aliquid dolorem quam aut. Possimus ex eum eum hic. Itaque tempora voluptatem dolorum nobis officia ut nostrum. Placeat perspiciatis dolore rerum placeat.', '2022-07-15', '2024-03-23', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(254, 254, 'Shoe and Leather Repairer', 'Quia et nam sunt nihil soluta voluptatem. Fugiat perspiciatis ipsam molestiae voluptate explicabo libero earum. Fuga eum consequatur aut ipsa voluptates numquam mollitia. Delectus qui autem qui natus sunt ab tempore. Dolores aut unde quod laborum et.\n\nError in qui perferendis adipisci est dolorem. Voluptatum inventore officiis velit dolor eum velit laudantium. Veniam nobis accusantium quam assumenda non doloribus autem est. Consectetur voluptate vero doloribus minima debitis modi neque.\n\nMolestiae animi amet sunt voluptates quia repellat. Omnis qui suscipit ratione rem eius ad. Et aut qui maxime dolores eum voluptas.', '2022-08-02', '2023-12-27', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(255, 255, 'Insurance Investigator', 'Illum et quis expedita rem eum quaerat officiis. Assumenda eos molestiae omnis ut delectus ratione illum. Voluptas tempora illum et assumenda. Est dolores et occaecati perspiciatis numquam ex voluptatibus dolorum.\n\nEarum necessitatibus quam omnis sit et quis quos. Culpa et nostrum fugit consequatur ab omnis iusto. Vel velit laborum cumque ipsam.\n\nVoluptatem et officia numquam necessitatibus ut in. Quas saepe temporibus voluptatem recusandae ipsum. Aperiam quibusdam aliquid vitae laboriosam.', '2015-07-15', '2025-05-25', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(256, 256, 'Service Station Attendant', 'Molestias modi at eos quis sint earum atque. Quasi veniam aspernatur tempore. Odio labore omnis minima ipsa nemo cum. Et mollitia nobis quam voluptatibus nobis id voluptates nesciunt.\n\nRepellat atque architecto id sed officiis blanditiis deserunt recusandae. Necessitatibus qui quo vel tempore. Quae hic nobis in ut atque natus non.\n\nConsectetur aut porro voluptatibus commodi animi sint. Adipisci perferendis et omnis optio molestiae sint. Sequi esse iste saepe consequatur porro quisquam.', '2016-03-15', '2023-06-27', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(257, 257, 'Market Research Analyst', 'Temporibus dolores dolorum omnis consequuntur. Vitae accusamus tempora aspernatur perferendis. Qui delectus inventore magni facere voluptatem dolor. Qui quaerat dolorem consequuntur.\n\nDolorem aut sequi occaecati eos. Atque quaerat ipsum et. Voluptatem esse necessitatibus eos. Nulla hic fugiat sapiente ducimus illo illo.\n\nEt architecto saepe dolorem nisi ut vel corrupti accusamus. Repellat necessitatibus et autem necessitatibus. Quos explicabo optio sapiente odio voluptas est.', '2019-09-17', '2025-01-26', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(258, 258, 'Webmaster', 'Eos a quia voluptatibus quam. Rerum sunt possimus cupiditate suscipit exercitationem et. Et magnam aut possimus fugiat.\n\nAut ut quo sunt ut consectetur. Optio voluptas est temporibus laudantium quos distinctio accusantium. Vel officiis amet ea.\n\nVelit et tempora tempore voluptatibus. Quis mollitia rerum aut tempore ut. Amet aspernatur accusamus libero. Error qui iste dolorum ad dolor.', '2017-09-11', '2023-10-08', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(259, 259, 'Designer', 'Nulla odit rerum et error minus ducimus. Reiciendis voluptatem doloremque ex itaque et quae. Labore molestiae quis rem quasi dignissimos et rerum. Ut repellat quo harum et velit consequatur perferendis.\n\nPerferendis atque in ut quibusdam est a consequuntur. Vero quo numquam veritatis.\n\nCulpa eaque consequatur maxime. Eos optio non provident ipsa. A dolorum culpa ut aliquid voluptatem dolores. Veritatis aspernatur aut qui qui eaque quod.', '2018-09-17', '2024-02-11', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(260, 260, 'Locker Room Attendant', 'Explicabo temporibus nemo libero expedita. Dolores hic quia enim vitae. Voluptas alias excepturi illum dicta vero tenetur porro.\n\nDeleniti aut esse maxime ut expedita. Aut nulla deleniti aut qui. Est voluptatem quibusdam aut animi eveniet provident. Nulla eligendi eveniet praesentium distinctio et aut aperiam.\n\nNihil quis fugiat aut fugit. Mollitia sequi facere sed corrupti voluptatibus culpa illum omnis. Beatae dolorem id suscipit mollitia culpa eligendi nesciunt. Quibusdam eos aut accusantium quia ut aut est.', '2023-02-28', '2024-10-15', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(261, 261, 'Construction Equipment Operator', 'Sunt nisi facilis quia est placeat aspernatur est. Fuga pariatur praesentium dolor est molestias. Aliquam deleniti amet eligendi fuga.\n\nA facere maxime ea deserunt qui ipsam. In tempore aut fugit commodi eum dicta. Magni amet expedita in at.\n\nSunt itaque est iusto est et sint dolores. Est reprehenderit aspernatur voluptatem sunt est ea velit. Aut aperiam dolorum iure saepe molestiae est in. Fugiat amet mollitia velit nemo qui voluptatum dolorum iste.', '2019-02-28', '2024-03-20', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(262, 262, 'Gluing Machine Operator', 'Ad dolorum dolorem officiis eaque. Veniam et totam voluptatem sunt deleniti. Sint quia sint non non velit cum in nulla.\n\nVoluptatibus perspiciatis asperiores mollitia voluptas dolor veritatis modi doloribus. Vero voluptatem facilis provident et ut sint. Voluptatibus error ipsam consequatur autem. Occaecati temporibus molestiae et quas.\n\nRerum fuga nemo debitis aperiam repellat et asperiores ut. Nihil vel sequi harum perferendis cumque in voluptas. Maxime porro facilis tempora dolore aliquid doloremque.', '2020-01-15', '2024-10-20', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(263, 263, 'Continuous Mining Machine Operator', 'Voluptas odio dolorem placeat officia. Esse temporibus voluptates harum voluptas voluptas quaerat sit in. Minima provident inventore non aut rerum eius culpa. Ipsa neque quo alias ut quos neque.\n\nItaque distinctio magnam voluptatem dignissimos. In possimus eligendi eius aut. Quaerat maxime sint non quaerat nihil quia. Expedita voluptatem atque aut.\n\nOdio alias perspiciatis ducimus earum. Officiis omnis rem rem qui nemo fugit. Magni quia nostrum at beatae corrupti ea. Magni omnis quasi voluptas et doloribus reiciendis.', '2015-08-27', '2024-12-28', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(264, 264, 'Eligibility Interviewer', 'Eaque incidunt quas recusandae mollitia amet corporis aspernatur magnam. Et voluptatem consectetur accusantium illum voluptates suscipit. Delectus quasi sed eius rerum odit. Perferendis sed quibusdam saepe asperiores sunt eveniet.\n\nQuos aut aut ea suscipit consequatur et. Nemo rerum voluptatem laboriosam et omnis qui voluptate. Commodi tempora molestias est. Animi vitae quia nesciunt iusto sapiente.\n\nFuga pariatur consequuntur aut accusamus in repudiandae cum dolores. Tenetur deleniti facere rerum omnis voluptatem. Minima ullam nihil reprehenderit consectetur quae dignissimos voluptatum architecto. Quos aut unde distinctio quibusdam eum dolorum odio. Rem sapiente mollitia eligendi consectetur veniam iste.', '2021-03-19', '2024-10-08', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(265, 265, 'Credit Checker', 'Autem aut molestiae qui necessitatibus sint. Aliquid mollitia eius pariatur consequuntur repellendus sequi. Quod est et nostrum voluptatem dolore et quia.\n\nAspernatur in et officia incidunt. Eaque voluptas id id beatae delectus sit pariatur. Et magnam velit qui quod quo.\n\nRepellendus et rerum voluptatum iusto voluptatibus fugit assumenda. Odio velit inventore est nihil. Sint qui quas exercitationem labore.', '2018-09-23', '2023-06-04', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(266, 266, 'Well and Core Drill Operator', 'Est quos recusandae saepe nostrum ut ut esse distinctio. Voluptatibus earum illum quia possimus dolorem ab. Et odio quibusdam ea itaque sint ut sit.\n\nEt mollitia molestiae deserunt nesciunt. Sit enim quaerat praesentium et earum sint ipsa. In praesentium unde beatae quam in numquam. In excepturi omnis et eos aut. Quidem autem quidem harum quis sit in.\n\nSuscipit omnis temporibus exercitationem deleniti quidem sit sed voluptatum. Commodi qui dolores omnis odio vitae beatae. Et error tempore vel suscipit aut quos et.', '2015-08-28', '2024-03-10', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(267, 267, 'Animal Breeder', 'Ipsum iste sint porro et. Omnis nobis odit dicta autem minima facere. Reiciendis inventore porro debitis et aperiam in quia. Est omnis dicta rerum sit consequatur.\n\nQui excepturi consequatur dolores autem est rerum veritatis. Praesentium et et ratione. Illum corporis voluptas necessitatibus rerum qui explicabo. Molestiae et numquam error eligendi.\n\nDolorum ea fugit similique eum rerum amet non qui. Rerum pariatur ipsum nesciunt sit quam autem.', '2018-08-19', '2023-08-22', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(268, 268, 'Travel Agent', 'Velit quibusdam quidem minima. Porro voluptatem voluptatem impedit quia numquam ut amet. Consequatur voluptatem rerum error blanditiis nostrum labore sunt quis. At exercitationem iusto ea et ut error excepturi.\n\nNulla et at maxime voluptatem. Molestias quod ut ab aut.\n\nQuo quia beatae non cum accusamus dolorum aut. Minima ut et maiores officiis inventore. Perferendis vel aut est amet.', '2020-11-25', '2024-01-28', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(269, 269, 'Plating Operator OR Coating Machine Operator', 'Voluptas distinctio at impedit velit consequatur. Voluptatem rerum adipisci unde et. Repellendus sed aut est porro libero nihil. Error distinctio non sed omnis voluptatem.\n\nNisi nemo ad sint beatae. Voluptas molestiae nihil consequatur et libero eveniet harum. Quod tempore nam dolorem molestias dolor libero iure. Et est fuga eius consequuntur eos maxime.\n\nVoluptatem sed velit est necessitatibus iusto veritatis. Officiis voluptas non ut sed rerum. Culpa eum labore maxime delectus quo atque. Maxime expedita velit placeat sunt tenetur perspiciatis veritatis.', '2020-04-08', '2024-08-19', '2025-06-01 11:28:47', '2025-06-01 11:28:47'),
(270, 270, 'Chemical Plant Operator', 'Sed magni voluptatem doloribus veritatis architecto omnis adipisci. At quia perspiciatis aut repellendus aliquid tempora nihil est. Cumque quaerat qui ut quod quasi consectetur sit.\n\nLaborum explicabo nesciunt natus ea ipsam mollitia. Modi sit amet inventore occaecati architecto. Incidunt expedita nemo cumque blanditiis atque eos ipsam. Rerum id sed quisquam ut qui deleniti est.\n\nQuia quia dicta delectus temporibus est et quo. Rerum nisi consectetur corporis ut id a tempore.', '2023-05-29', '2023-08-23', '2025-06-01 11:28:47', '2025-06-01 11:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `favouriteable_id` bigint UNSIGNED NOT NULL,
  `favouriteable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `favouriteable_id`, `favouriteable_type`, `created_at`, `updated_at`) VALUES
(7, 641, 22, 'App\\Models\\UserJob', '2025-06-01 11:57:48', '2025-06-01 11:57:48'),
(9, 641, 13, 'App\\Models\\UserJob', '2025-06-01 11:57:51', '2025-06-01 11:57:51'),
(10, 1, 16, 'App\\Models\\UserJob', '2025-06-01 11:59:38', '2025-06-01 11:59:38'),
(17, 641, 18, 'App\\Models\\UserJob', '2025-06-01 12:12:38', '2025-06-01 12:12:38'),
(29, 642, 23, 'App\\Models\\UserJob', '2025-06-01 12:44:12', '2025-06-01 12:44:12'),
(30, 642, 22, 'App\\Models\\UserJob', '2025-06-01 12:44:13', '2025-06-01 12:44:13'),
(31, 642, 21, 'App\\Models\\UserJob', '2025-06-01 12:44:14', '2025-06-01 12:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint UNSIGNED NOT NULL,
  `follower_id` bigint UNSIGNED NOT NULL,
  `followed_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `followed_id`, `created_at`, `updated_at`) VALUES
(4, 642, 1, '2025-06-02 06:37:45', '2025-06-02 06:37:45'),
(14, 641, 1, '2025-06-02 09:07:52', '2025-06-02 09:07:52'),
(19, 641, 12, '2025-06-02 09:21:26', '2025-06-02 09:21:26'),
(24, 641, 7, '2025-06-02 09:22:33', '2025-06-02 09:22:33'),
(27, 641, 22, '2025-06-02 09:25:27', '2025-06-02 09:25:27'),
(29, 641, 2, '2025-06-02 09:26:40', '2025-06-02 09:26:40'),
(33, 641, 29, '2025-06-02 09:28:00', '2025-06-02 09:28:00'),
(34, 641, 31, '2025-06-02 09:28:01', '2025-06-02 09:28:01'),
(35, 641, 11, '2025-06-02 09:28:04', '2025-06-02 09:28:04'),
(38, 641, 4, '2025-06-02 09:29:04', '2025-06-02 09:29:04'),
(40, 641, 3, '2025-06-02 09:31:00', '2025-06-02 09:31:00'),
(41, 641, 33, '2025-06-02 09:32:39', '2025-06-02 09:32:39'),
(46, 641, 14, '2025-06-02 09:52:07', '2025-06-02 09:52:07'),
(47, 641, 41, '2025-06-02 09:55:16', '2025-06-02 09:55:16'),
(48, 641, 27, '2025-06-02 09:55:18', '2025-06-02 09:55:18'),
(64, 641, 641, '2025-06-02 12:36:38', '2025-06-02 12:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `gigs`
--

CREATE TABLE `gigs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gigs`
--

INSERT INTO `gigs` (`id`, `user_id`, `sub_category_id`, `category_id`, `title`, `description`, `location`, `lat`, `long`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Laudantium esse impedit eos dolorem.', 'Aut voluptatem quod placeat aspernatur totam placeat est. Omnis nostrum aperiam est ut. Omnis dolores omnis qui sunt aut eos.', '71585 Jackie Divide Suite 499\nJaylenside, ME 22430', '70.544725', '38.390662', '913.39', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(2, 2, 2, 3, 'Debitis voluptas atque rerum est porro molestiae.', 'Sed aut et voluptas deserunt quae. Repellat sed cum qui magni maxime nulla. Assumenda officiis porro porro iusto ut illo.', '550 Adella Alley\nFeestbury, NE 91897-4727', '8.364694', '-41.824667', '379.68', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(3, 3, 3, 5, 'Iste temporibus ut qui doloribus sed in et velit.', 'Dolor quis labore iusto distinctio. Facilis rerum voluptatibus necessitatibus sint et non sit. Laudantium officia consequuntur quo maiores velit molestiae fuga.', '5959 Sporer Ford Suite 663\nEvansville, GA 33507-7417', '-41.826833', '-140.090736', '68.78', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(4, 4, 4, 7, 'Est et voluptates aut est inventore ea.', 'Voluptas corrupti totam ipsum maiores ad. Adipisci ut non quo saepe rerum quae. Repudiandae occaecati ipsa voluptatem. Quisquam distinctio error aspernatur illum explicabo unde qui.', '5037 Casandra Spring Suite 583\nNorth Marceltown, WV 74215-8011', '87.815185', '-128.962879', '117.55', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(5, 5, 5, 9, 'Consectetur totam sit ipsam error.', 'Quo ea eveniet id et. Est sit autem aperiam animi tempora voluptas. Sit maxime ipsa ipsam sapiente sed.', '19987 Hubert Highway\nRudyhaven, CT 44341-1896', '4.279621', '113.741488', '61.53', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(6, 6, 6, 11, 'Qui odit earum voluptatum quaerat.', 'Quia tempora pariatur commodi vitae cupiditate eum temporibus et. Laudantium ea est aut et et labore tenetur. Itaque est voluptas quia magni exercitationem atque a et. Magnam est pariatur corporis quibusdam quod officia rerum eum.', '1209 Harvey Summit\nMitcheltown, MS 76973-0149', '4.359897', '143.853437', '740.02', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(7, 7, 7, 13, 'Sed ex quis quis aut.', 'Ipsam qui quaerat aut accusantium aut odio inventore. Deserunt voluptatem culpa pariatur tenetur autem quidem. Qui ipsa illum natus doloremque expedita. Ab quis aut dolor quos dolorum magni ea. Quia quisquam quos dolorem sed porro dolore eveniet.', '91580 Henriette Plaza\nMedhurstville, IL 36767', '-2.827952', '-13.781322', '796.91', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(8, 8, 8, 15, 'Fugit velit vel repellendus vel ut assumenda vitae.', 'Dicta qui autem rerum consequatur. Et voluptas aut consequuntur dolore sint aspernatur. Ipsa et cumque dicta impedit ad dolor nesciunt repellat.', '43487 Orpha Creek Suite 157\nDurganberg, DE 90840', '25.048718', '100.64203', '917.94', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(9, 9, 9, 17, 'Quas nihil provident nemo blanditiis quae repellat.', 'Velit sequi laboriosam sed est esse. Enim distinctio aliquid neque dolore. Et et aliquid rem eum excepturi.', '557 Kuhn Heights\nNicoleborough, NV 55518', '-76.370391', '19.126578', '19.31', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(10, 10, 10, 19, 'Eligendi et veritatis qui voluptatum aperiam.', 'Iste quasi repellendus ad minima aliquam est. Minus rerum distinctio minus voluptatum. Saepe ut optio alias rerum consectetur sed temporibus.', '9100 Gorczany Fall\nMaidaville, IA 60791', '45.416824', '78.648714', '521.18', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(11, 12, 11, 21, 'Dolores at veritatis ut est et.', 'Nesciunt consequatur illo explicabo ipsum. Quisquam incidunt temporibus et rerum et. Rerum laudantium ut facere reprehenderit error expedita. Distinctio distinctio nostrum ipsa id laborum laborum officia.', '1486 Yundt Course Suite 186\nLake Emmy, TX 47622', '44.218307', '-38.64909', '530.98', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(12, 14, 12, 23, 'Est earum maiores illum deleniti consequuntur iste.', 'Veniam neque temporibus deleniti est inventore rem. Eaque ipsum minima quia hic voluptatum ut. Tenetur aspernatur voluptatem iste est et aspernatur quasi eum. Exercitationem ea facilis omnis soluta vero praesentium.', '87868 Jude Squares Suite 237\nJenkinsburgh, CT 59816', '-29.148502', '-155.427308', '147.25', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(13, 16, 13, 25, 'Est ab aliquid sed doloribus.', 'Qui ullam expedita earum modi deserunt eum ut. Qui et dolorem voluptatum distinctio quisquam. Ut et id qui et voluptatem cupiditate. Occaecati dolores vel reiciendis repellat numquam assumenda similique.', '7744 Hayes Port\nNorth Stephanie, MS 14862', '-40.616474', '140.177858', '533.76', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(14, 18, 14, 27, 'Esse ipsa sit nam molestiae quia aliquam dolores quibusdam.', 'Sit et modi cumque ad. Quis fugit aut sed non aut quia. Rerum quam quaerat ipsam adipisci error et.', '144 Mikayla Mall\nSouth Kadenstad, CT 65843', '-27.494128', '-45.216565', '109.57', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(15, 20, 15, 29, 'Esse consequatur veritatis iusto est impedit rerum.', 'Suscipit sit quas unde possimus est. Harum quia sit porro. Odio harum alias provident et.', '1567 Littel Ranch Suite 954\nEast Adolphus, KS 58480', '18.283655', '-173.302976', '856.23', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(16, 22, 16, 31, 'Eos aut quidem quo.', 'Corporis sint sit reprehenderit nobis minima. Ut sint earum minima rerum et. Rerum ut expedita incidunt unde fugit ex. Iste nulla adipisci maxime quia suscipit.', '29404 Bauch Summit Suite 198\nSkylastad, NC 64316', '-22.727819', '40.350769', '170.95', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(17, 24, 17, 33, 'Aperiam fugiat provident sed quia quisquam.', 'Nisi tempore nulla consequatur quia labore quia. Ullam voluptas non autem laudantium aperiam cum voluptas. Ducimus consequuntur velit et enim pariatur voluptatem magnam sit. Dolore ullam in quidem ab optio placeat maxime commodi. Harum et dolores nihil laudantium assumenda nisi molestias.', '20110 Darion Gardens\nEast Omaview, MN 63091', '86.71855', '27.627133', '485.58', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(18, 26, 18, 35, 'Illo excepturi fuga est dolore quo ut qui ipsa.', 'Vitae error quia neque doloribus et autem eos. Laborum ut veritatis pariatur inventore tenetur aliquam. Dolorum sequi sit earum mollitia autem occaecati. Et natus tempore tempora voluptate ipsa.', '279 Waters Ford Apt. 456\nNorth Hazeltown, IN 11175', '67.933086', '10.259716', '832.85', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(19, 28, 19, 37, 'A sed reprehenderit ipsam quo quia.', 'Ex placeat ipsa quis est et. Architecto quas non est voluptatem. Autem et qui odit. Repellat rerum placeat quasi voluptatum consequatur qui ea mollitia. Omnis quam repellendus eligendi praesentium est odit est.', '54976 Collins Falls Apt. 203\nYasmeenmouth, KY 32734-6460', '-12.966922', '134.134911', '893.78', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(20, 30, 20, 39, 'Laborum voluptas repudiandae id qui.', 'Eos et vel maiores quaerat voluptatibus distinctio aliquid. Omnis eum fugit qui rerum incidunt ipsum.', '45841 Ortiz Harbor Suite 198\nRuntemouth, NV 78380-4267', '-10.67811', '1.471571', '407.02', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(21, 32, 21, 41, 'Eaque aliquam possimus fugiat aliquid voluptatem asperiores dolores sapiente.', 'Exercitationem autem quis eum voluptas. Quaerat sint molestiae eaque dolor corrupti deserunt. Id voluptates modi rerum repudiandae sed ratione. Consequatur autem et incidunt quia nam et fugiat.', '591 Tyrique Ports Apt. 381\nWuckertton, VT 73895', '4.522054', '-170.706918', '757.24', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(22, 34, 22, 43, 'Quisquam ad aut eveniet exercitationem hic aut animi.', 'Minima consectetur et distinctio laudantium ut libero. Ea odio rerum facilis nemo assumenda voluptates. Odio eaque voluptatum nobis aut aperiam aut.', '45746 Russell Lakes Suite 001\nNorth Charityton, ID 95834-6303', '52.914257', '-159.25467', '871.95', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(23, 36, 23, 45, 'Dolorum qui est ipsa accusamus dicta.', 'Et non reprehenderit aut commodi et iusto consequatur. Expedita quibusdam et eos corrupti cupiditate perferendis dolor. Dolores perspiciatis ut doloremque enim eligendi.', '256 Moen Lock Suite 128\nNorth Isacburgh, MA 42869-0168', '-40.164119', '122.261853', '74.03', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(24, 38, 24, 47, 'Voluptatem minus eligendi sequi.', 'Et et fugit repudiandae similique non ut sed. Sint dolorem incidunt quia quis commodi sequi deserunt ut. Et amet possimus qui sit. Et ad iste reiciendis distinctio sed et animi a.', '69657 Beatty Drive Apt. 582\nDietrichstad, KY 14681', '34.931237', '-56.603348', '552.92', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(25, 40, 25, 49, 'Voluptas illo optio quia et vero.', 'Omnis pariatur consequatur aperiam aut nihil. Alias consequatur dolores iusto. Et facere corporis qui aut et. Commodi voluptatem laboriosam deleniti reprehenderit officiis est quos.', '11629 Kenyatta Terrace Suite 017\nPort Wilbertmouth, MS 31651-9460', '14.862561', '76.520517', '558.85', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(26, 42, 26, 51, 'Nemo nulla illo culpa non id.', 'Et magni quis laboriosam qui. Velit praesentium est aut omnis. Natus quia quos corrupti modi sint est eveniet dolor. Dolor magnam facere non illo est aliquam ut.', '98335 Carley Pine Apt. 853\nTurcottebury, LA 56615-0084', '-83.359067', '-62.699657', '658.49', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(27, 44, 27, 53, 'Dolorem ut et sequi.', 'Quasi qui ut quam aliquid ipsa praesentium. Voluptas eos amet libero non. Provident illum nisi voluptates eius. Optio quae ipsa quia aliquam nesciunt rerum sed voluptatem. Ipsum dolorem reiciendis odio atque voluptatem.', '307 Rutherford Mill Suite 697\nAndersonstad, WV 72100-1169', '61.602809', '80.878055', '546.65', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(28, 46, 28, 55, 'Odit soluta aspernatur quo est voluptatem totam et.', 'Nisi ab debitis reiciendis omnis similique ut repellat. Autem magnam rerum doloremque eos et. Illo quia autem beatae ea et consectetur quas ad.', '414 Stracke Path Suite 584\nDaniellaton, MD 06788', '-30.298283', '-117.639785', '104.89', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(29, 48, 29, 57, 'Beatae veniam unde ex vel qui.', 'Quaerat esse illum non nihil nihil dolores. Quaerat iste est laudantium et. Quibusdam facilis laborum non commodi ex mollitia.', '9618 Fatima Glens\nBlandaton, NE 04195', '-84.688017', '151.624002', '302.72', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(30, 50, 30, 59, 'Quidem quia laborum hic eos occaecati.', 'Suscipit id eveniet consequatur maxime. Provident cumque ea et quasi.', '841 King Lodge\nAlishachester, IN 77725', '-39.067471', '28.572871', '832.15', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(31, 52, 31, 61, 'Et non at sunt sunt repudiandae dolorem.', 'Exercitationem nemo qui excepturi error recusandae inventore quos. Voluptas tempore blanditiis esse. Similique minima accusantium id facilis.', '1785 Daugherty Road\nWilmamouth, VA 71873', '-66.526467', '-30.274747', '977.46', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(32, 54, 32, 63, 'Accusantium est tenetur adipisci qui vel.', 'Sed distinctio in et ipsam consequatur. At non eum officia consequuntur repudiandae eveniet voluptas. Reprehenderit enim nam exercitationem. Et sunt perferendis blanditiis minus deleniti accusamus.', '311 Karen Mountain Suite 688\nLake Nia, SD 68869', '7.472598', '-173.451336', '799.21', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(33, 56, 33, 65, 'Minus earum excepturi est omnis.', 'Qui consequatur deserunt sequi tenetur consequuntur dolore. Est et et enim sint facilis ea ipsa dolor. Dolorem accusamus nobis quibusdam itaque voluptas molestiae iure. Cupiditate qui debitis aut corporis voluptas voluptatum autem. Dignissimos iste porro cumque est.', '9498 Ruecker Green Apt. 792\nLabadiebury, AK 24898-6935', '-49.455734', '-102.661821', '282.81', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(34, 58, 34, 67, 'Maiores ullam vitae eaque quod.', 'Ipsam est maxime voluptas tempore exercitationem. Nam repellat laborum et accusamus eos tempore vero. Fugiat et ut repellat. Maxime eos modi vel laudantium excepturi ut. Autem aut asperiores consequatur voluptas officia cum et quia.', '889 Haag Forges\nWest Jarrett, VT 34220-0594', '-45.409648', '-43.280741', '356.98', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(35, 60, 35, 69, 'Dolores ut voluptatem id nobis.', 'Consectetur reprehenderit numquam similique cumque et distinctio doloribus. In tenetur suscipit suscipit ut ut vero. Eos beatae qui sint consectetur quam non assumenda.', '32367 Cordie Glens Apt. 088\nLake Wilbertborough, OK 78754', '-67.055252', '50.471944', '144.8', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(36, 62, 36, 71, 'Nostrum perferendis nihil ut dolorem non.', 'Libero et odit laudantium in repudiandae. Velit accusantium repudiandae natus et repudiandae. Quas laboriosam id debitis rerum ea natus est. Sunt veritatis est consequatur qui.', '360 Swift Extension Suite 294\nElenaland, MD 09090', '-49.836154', '-132.798449', '326.72', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(37, 64, 37, 73, 'Voluptatum qui est quis natus error atque.', 'Reiciendis eveniet qui ea nisi ea sunt. Nulla corporis temporibus voluptas iure omnis. Sit in vitae quod quia quia.', '5059 Blanda Parkway\nWest Zakary, AR 69411-9163', '5.013373', '-157.473892', '350.37', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(38, 66, 38, 75, 'Reiciendis voluptate et natus sapiente.', 'Non asperiores voluptatibus nemo fuga. Nam laboriosam dolorem facere quos. Quis iure et incidunt alias incidunt. Perferendis laboriosam et laboriosam iusto numquam vero.', '887 Lowe Mount\nAnkundington, SC 39665', '33.019989', '79.03403', '507.87', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(39, 68, 39, 77, 'Eum dolorum expedita voluptatum architecto aperiam nihil.', 'Modi sint voluptatem autem blanditiis reiciendis. Veniam velit eveniet repellat quod cumque consequatur. Sint natus non qui.', '631 Elouise Place\nWest Hollieside, WI 41373-0021', '-81.547614', '144.932311', '848.3', 0, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(40, 70, 40, 79, 'Provident et blanditiis voluptatem.', 'Ab nesciunt totam ut nobis corrupti nihil. Omnis omnis omnis saepe alias officiis et est dolorem. Reiciendis error eius nobis tempore sapiente dignissimos nulla quasi. Dolor minima amet omnis error rerum temporibus et.', '59612 Harris Isle\nTreverville, RI 85125-4647', '63.958888', '93.847864', '778.25', 0, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(41, 641, 4, 4, 'as', 'ASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsa', 'A', '38.9071924', '-77.036872', '123', 1, '2025-06-02 11:21:00', '2025-06-02 11:21:00'),
(42, 641, 4, 4, 'as', 'ASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsa', 'A', '38.9071924', '-77.036872', '123', 1, '2025-06-02 11:21:06', '2025-06-02 11:21:06'),
(43, 641, 4, 4, 'as', 'ASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsaASAsaSAsa', 'A', '38.9071924', '-77.036872', '123', 1, '2025-06-02 11:21:27', '2025-06-02 11:21:27'),
(44, 641, 6, 6, 'dsdsa', 'sdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasda', 'sd', '38.9071926', '-77.0368724', '22222222', 1, '2025-06-02 11:23:28', '2025-06-02 11:23:28'),
(45, 641, 6, 6, 'dsdsa', 'sdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasdasdasdsadasasdasdasda', 'sd', '38.9071926', '-77.0368724', '22222222', 1, '2025-06-02 11:23:35', '2025-06-02 11:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `gig_requests`
--

CREATE TABLE `gig_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `gig_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gig_requests`
--

INSERT INTO `gig_requests` (`id`, `user_id`, `gig_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 11, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(2, 13, 12, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(3, 15, 13, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(4, 17, 14, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(5, 19, 15, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(6, 21, 16, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(7, 23, 17, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(8, 25, 18, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(9, 27, 19, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(10, 29, 20, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(11, 31, 21, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(12, 33, 22, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(13, 35, 23, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(14, 37, 24, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(15, 39, 25, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(16, 41, 26, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(17, 43, 27, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(18, 45, 28, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(19, 47, 29, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(20, 49, 30, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(21, 51, 31, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(22, 53, 32, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(23, 55, 33, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(24, 57, 34, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(25, 59, 35, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(26, 61, 36, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(27, 63, 37, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(28, 65, 38, 'rejected', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(29, 67, 39, 'accepted', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(30, 69, 40, 'pending', '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(31, 641, 1, 'pending', '2025-06-02 08:34:31', '2025-06-02 08:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `http_loggers`
--

CREATE TABLE `http_loggers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `file_name`, `mime_type`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\UserJob', 21, 'storage/userjob/63521748777479.jpg', 'image', '2025-06-01 11:31:19', '2025-06-01 11:31:19'),
(2, 'App\\Models\\UserJob', 22, 'storage/userjob/68871748777588.jpg', 'image', '2025-06-01 11:33:08', '2025-06-01 11:33:08'),
(3, 'App\\Models\\Event', 131, 'storage/event/25211748785712.mp4', 'video', '2025-06-01 13:48:32', '2025-06-01 13:48:32'),
(4, 'App\\Models\\Event', 132, 'storage/event/59861748853746.jpg', 'image', '2025-06-02 08:42:26', '2025-06-02 08:42:26'),
(5, 'App\\Models\\Gig', 45, 'storage/gig/33771748863415.jpg', 'image', '2025-06-02 11:23:35', '2025-06-02 11:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_08_20_143539_create_admins_table', 1),
(3, '2025_01_05_105610_create_settings_table', 1),
(4, '2025_01_15_000245_create_activity_log_table', 1),
(5, '2025_01_15_000246_add_event_column_to_activity_log_table', 1),
(6, '2025_01_15_000247_add_batch_uuid_column_to_activity_log_table', 1),
(7, '2025_01_27_123653_create_permission_tables', 1),
(8, '2025_04_28_162931_create_http_loggers_table', 1),
(9, '2025_04_29_140539_add_two_factor_fields_to_admins_table', 1),
(10, '2025_05_01_102528_create_user_types_table', 1),
(11, '2025_05_01_102529_create_user_sub_types_table', 1),
(12, '2025_05_01_102529_create_users_table', 1),
(13, '2025_05_01_104233_create_device_tokens_table', 1),
(14, '2025_05_01_104842_create_followers_table', 1),
(15, '2025_05_01_104940_create_sliders_table', 1),
(16, '2025_05_01_105459_create_user_sliders_table', 1),
(17, '2025_05_01_105725_create_contact_us_table', 1),
(18, '2025_05_01_110142_create_user_details_table', 1),
(19, '2025_05_01_112124_create_experiences_table', 1),
(20, '2025_05_01_112757_create_posts_table', 1),
(21, '2025_05_01_113509_create_post_reactions_table', 1),
(22, '2025_05_01_113727_create_post_comments_table', 1),
(23, '2025_05_01_113910_create_comment_replies_table', 1),
(24, '2025_05_01_114743_create_dirty_words_table', 1),
(25, '2025_05_01_114957_create_post_shares_table', 1),
(26, '2025_05_01_120030_create_categories_table', 1),
(27, '2025_05_01_120417_create_events_table', 1),
(28, '2025_05_01_121248_create_sub_categories_table', 1),
(29, '2025_05_01_121438_create_countries_table', 1),
(30, '2025_05_01_121505_create_event_requirements_table', 1),
(31, '2025_05_01_124443_create_event_requests_table', 1),
(32, '2025_05_01_124645_create_event_followers_table', 1),
(33, '2025_05_01_125401_create_user_jobs_table', 1),
(34, '2025_05_01_135158_create_media_table', 1),
(35, '2025_05_01_142815_create_notifications_table', 1),
(36, '2025_05_01_144508_create_wallet_transactions_table', 1),
(37, '2025_05_02_115051_create_gigs_table', 1),
(38, '2025_05_02_120006_create_gig_requests_table', 1),
(39, '2025_05_08_122255_create_jobs_table', 1),
(40, '2025_05_08_170814_create_notices_table', 1),
(41, '2025_05_12_123606_create_announces_table', 1),
(42, '2025_05_12_161312_create_unwanted_users_table', 1),
(43, '2025_05_18_145334_create_failed_jobs_table', 1),
(44, '2025_05_28_171055_create_favourites_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:unseen, 1:seen',
  `reference_id` bigint UNSIGNED DEFAULT NULL COMMENT 'id of the reference table',
  `reference_table` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'id of the reference table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `body`, `seen`, `reference_id`, `reference_table`, `created_at`, `updated_at`) VALUES
(1, 186, 'Ratione a optio nisi.', 'Nemo ea aspernatur iusto autem odit excepturi nulla.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(2, 50, 'Ad provident eos.', 'Odio pariatur aut nulla quo rerum sed blanditiis culpa.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(3, 51, 'Est impedit consequatur.', 'Itaque nostrum consequatur sed eligendi ad officiis.', 0, 5, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(4, 463, 'Et sed eos.', 'Eos dolor nam temporibus aut dicta consectetur alias suscipit et facere expedita omnis.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(5, 80, 'Architecto modi illum soluta.', 'Facilis omnis dolorem aut impedit dolorem assumenda sunt quia amet temporibus.', 0, 2, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(6, 535, 'Est in magnam.', 'Aperiam sunt hic consequatur iste natus ipsa dicta fugiat quam velit quis.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(7, 383, 'Dolore illo dolorem.', 'Consequatur rerum soluta et est illum eaque voluptatem ducimus eveniet voluptas aut.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(8, 341, 'Omnis fugit ipsum.', 'Odio hic mollitia deleniti quasi et voluptatem quis quia.', 0, 3, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(9, 76, 'Incidunt iste quos sint.', 'Ab minus eum ut recusandae est aut assumenda ab.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(10, 520, 'Impedit nobis veritatis et.', 'Commodi occaecati nihil laboriosam eius ut ducimus illo vel sequi nostrum consequatur.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(11, 178, 'Adipisci illum.', 'Ipsum dolorem neque non consequatur autem laboriosam et non.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(12, 358, 'In quos ipsum aut.', 'Voluptates consequatur quo alias dignissimos ut rerum vero.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(13, 357, 'Dolore delectus quia mollitia.', 'Vel corrupti possimus doloribus doloremque laboriosam rerum maiores quia tenetur eligendi atque doloremque.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(14, 405, 'Alias sint iusto.', 'Unde molestiae quibusdam corporis sit consequatur quo non qui officiis omnis possimus.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(15, 389, 'Distinctio magnam aliquam eveniet et.', 'Et fuga sunt nostrum quaerat quos inventore minus voluptate incidunt qui odit.', 0, 3, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(16, 518, 'Repellendus sit nemo.', 'Commodi unde vel non fuga voluptate molestiae.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(17, 346, 'Distinctio nisi eaque pariatur.', 'Necessitatibus qui occaecati non consectetur omnis culpa nostrum rem voluptatem maiores facere ipsa et.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(18, 478, 'Placeat quia a et.', 'Sed perferendis non voluptatem nemo et et tempora.', 0, 2, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(19, 377, 'Enim esse qui reiciendis.', 'Nostrum molestiae error placeat qui distinctio sed molestiae.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(20, 3, 'Laborum sed laborum.', 'Saepe sit et praesentium enim aspernatur neque.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(21, 521, 'Aut reprehenderit doloribus.', 'Fugiat et dolorum in maxime necessitatibus ullam.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(22, 297, 'Suscipit in est.', 'Tempora sequi eaque consequatur ullam nihil saepe delectus assumenda soluta possimus corporis.', 0, 5, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(23, 368, 'Consequatur delectus non.', 'Voluptas neque dolor excepturi iste autem debitis.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(24, 536, 'Quia optio corporis.', 'Ipsum suscipit alias voluptatem voluptatem eaque et accusantium ad excepturi voluptatem odio et.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(25, 441, 'Repudiandae possimus.', 'Eum veniam error sed quia voluptates aut eaque.', 0, 3, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(26, 17, 'Dolor quam vitae.', 'Provident qui soluta ratione exercitationem asperiores tempora.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(27, 83, 'Aut voluptas tempore.', 'Ipsa sed aut quaerat sed earum consectetur facere quidem rerum cupiditate qui.', 0, 3, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(28, 260, 'Laudantium ducimus.', 'Ab laudantium nobis doloribus harum optio et laudantium labore et autem et error.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(29, 351, 'Laudantium veritatis rem reprehenderit consectetur.', 'Aut quidem non nam et dignissimos quia.', 0, 2, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(30, 380, 'Qui totam voluptatem.', 'Et id accusantium dolorem enim rerum corporis qui.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(31, 318, 'Eius tenetur delectus est.', 'Autem eos minima non non voluptatem rerum rem optio quae natus architecto facere aut.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(32, 532, 'Natus dignissimos architecto dolor debitis.', 'Eius rerum incidunt consequuntur distinctio nulla odit qui voluptatem et voluptates dignissimos exercitationem.', 0, 3, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(33, 149, 'Harum deleniti a voluptates.', 'Est voluptatem perspiciatis est excepturi sint explicabo sed corporis reprehenderit sint soluta.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(34, 56, 'Error repudiandae.', 'Mollitia eveniet aliquam dolores nulla repellendus et et tenetur ipsa debitis qui et et.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(35, 429, 'Neque inventore dolor commodi.', 'Nihil sapiente quae laudantium perspiciatis voluptas provident magnam fugiat quas vel autem.', 0, 4, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(36, 321, 'Vel nulla id.', 'Aspernatur omnis aut consequatur officia error commodi possimus consectetur veniam consequatur minima vel.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(37, 252, 'Neque ut quia.', 'Voluptas velit itaque rerum unde repellat voluptatem consequatur.', 0, 1, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(38, 19, 'Ipsa vel exercitationem totam.', 'Nesciunt voluptatibus rerum omnis dignissimos at est velit est voluptatem harum.', 0, 2, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(39, 314, 'Quae eum sequi ullam.', 'Ipsam consectetur harum voluptatem quo voluptatum quis totam magni omnis aspernatur est autem et.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(40, 509, 'Sed nemo aut.', 'Fugit qui voluptatum fugit neque natus quia.', 0, 2, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(41, 136, 'Sapiente quidem assumenda inventore.', 'Dolor perspiciatis placeat provident ab officiis fugit minima corporis corporis laboriosam excepturi.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(42, 99, 'Quos cum autem.', 'Et expedita ipsa voluptas eos ut ipsa dolor et.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(43, 120, 'Ratione doloribus est autem.', 'Eos asperiores nisi voluptatem at enim tenetur est ullam consequatur dolores.', 0, 4, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(44, 130, 'Ipsam corporis et incidunt.', 'Voluptatem sint odit ipsam cumque voluptas sint consectetur ut ea cum culpa vero sit.', 0, 2, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(45, 333, 'Aut beatae sed quidem modi.', 'Eaque asperiores adipisci et ea eum ratione.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(46, 242, 'Ducimus officia sed error.', 'Sit iusto quia accusamus occaecati sint nesciunt quae soluta minus mollitia debitis sint eum.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(47, 533, 'Sint dicta voluptatem.', 'Ex aut nihil explicabo quas velit est tempore velit.', 0, 5, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(48, 260, 'Est odio iure.', 'Cupiditate et modi dolores quo et quo labore vitae voluptatem nulla voluptate.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(49, 445, 'Minus quisquam.', 'Explicabo et dolorum alias exercitationem voluptatibus quo consequatur.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(50, 97, 'Harum nulla consequatur.', 'Omnis eos nemo autem aliquid sequi ipsum id qui eum iure et.', 0, 5, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(51, 127, 'Quo rem non quibusdam impedit.', 'Repellendus qui inventore sequi iure hic vitae commodi inventore quaerat.', 0, 1, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(52, 211, 'Dolor omnis amet.', 'Minus nemo voluptas debitis et veritatis commodi alias.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(53, 519, 'Ut qui recusandae.', 'Repellendus quam sit quia in harum sit iste possimus.', 0, 5, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(54, 44, 'Asperiores nisi laborum.', 'Aut unde vel molestias aut magni expedita sapiente aut ut vel nisi tenetur.', 0, 5, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(55, 241, 'Velit officia ullam.', 'Voluptatum harum ea aliquam et temporibus sint saepe quas quis molestiae cum a.', 0, 3, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(56, 123, 'Iure mollitia tenetur sint.', 'Sit quia maxime quo molestias possimus rerum.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(57, 11, 'Qui a voluptas et.', 'Aliquid aut qui suscipit quia error ex et culpa nihil aut ut quibusdam consectetur.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(58, 454, 'Incidunt laboriosam deleniti.', 'Illum et nihil laudantium placeat error delectus quo atque nobis corporis vero sit.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(59, 68, 'Necessitatibus suscipit voluptatum.', 'Assumenda nesciunt reiciendis harum ab veniam ut non maiores ea voluptates quisquam voluptas eum.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(60, 512, 'Deleniti ex ut.', 'Dolore minus magni voluptates quis suscipit explicabo omnis ipsa nemo quia reprehenderit repellendus architecto.', 0, 5, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(61, 320, 'Magnam eligendi sed earum.', 'Praesentium eos et quas eos fugit odit rerum enim magni et ea ut praesentium.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(62, 484, 'Quaerat est aperiam architecto ut.', 'Vitae commodi ea quibusdam dolorum magnam omnis ducimus architecto et atque velit molestiae officiis.', 0, 4, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(63, 313, 'Perferendis harum autem.', 'Id iusto delectus numquam blanditiis facere est officiis quod.', 0, 2, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(64, 319, 'Et neque tenetur.', 'Adipisci libero exercitationem quos delectus nihil sed nisi.', 0, 2, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(65, 144, 'Autem aut dolor.', 'Explicabo quibusdam velit quo alias laudantium eius.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(66, 465, 'Dicta optio sunt doloremque.', 'Voluptatem odio quidem architecto ipsum officiis repellat rerum voluptas neque explicabo excepturi.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(67, 264, 'Qui doloribus autem.', 'Labore ratione unde numquam nostrum sunt est corrupti qui.', 0, 3, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(68, 252, 'Molestiae ipsa incidunt.', 'Perspiciatis est est velit excepturi repellat tempora laborum corrupti.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(69, 228, 'Quia ea earum.', 'Possimus et et sed corporis ipsam tempora ut explicabo reprehenderit neque nemo exercitationem.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(70, 210, 'Aliquid aut.', 'Ut quis accusantium voluptatem perferendis asperiores eos libero animi sunt nesciunt.', 0, 5, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(71, 297, 'Aliquid sit corrupti.', 'Laborum rem doloribus consequuntur recusandae hic consectetur aliquid numquam amet.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(72, 498, 'Sunt consequatur.', 'Recusandae aut ipsum sunt non alias molestiae iste voluptatem natus laudantium error perferendis.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(73, 394, 'Et alias voluptas voluptates.', 'In non deleniti temporibus inventore nam atque sed.', 0, 4, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(74, 32, 'Cupiditate nostrum dolore odit.', 'Accusantium et cupiditate assumenda pariatur ratione doloremque velit numquam et.', 0, 4, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(75, 68, 'Suscipit consectetur beatae.', 'Sunt totam corrupti id ad quia error consequatur.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(76, 29, 'Libero debitis voluptate.', 'Laboriosam mollitia repellat ut expedita veniam est sequi.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(77, 341, 'Doloremque molestiae voluptatem ea.', 'Quia animi rerum quibusdam ut quaerat mollitia alias aliquam ipsam.', 0, 5, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(78, 159, 'Voluptatum iste voluptas.', 'Unde qui vel voluptas excepturi sit illo.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(79, 167, 'Quam consequatur.', 'Dolor voluptatibus reiciendis autem mollitia vel quis quia possimus dignissimos.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(80, 331, 'Eaque ad occaecati sed autem.', 'Aut corrupti consequatur deserunt praesentium eaque officia praesentium sapiente voluptates quis.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(81, 456, 'Et unde.', 'Error fuga eius unde sed excepturi possimus saepe unde ducimus est autem sint aliquam.', 0, 5, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(82, 367, 'A nihil odit inventore asperiores.', 'Reiciendis voluptates est quia quis officia enim officia temporibus.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(83, 478, 'Adipisci delectus sit et.', 'Eaque ut voluptatibus pariatur impedit possimus ipsa deserunt eveniet nihil cupiditate vitae deserunt voluptatem enim.', 0, 4, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(84, 492, 'Voluptatibus et nulla porro.', 'Molestiae aut qui esse est repellendus doloremque excepturi veniam incidunt praesentium occaecati neque esse.', 0, 5, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(85, 243, 'Aut in aut.', 'Architecto aspernatur repellendus voluptatum necessitatibus officia saepe.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(86, 175, 'Nobis voluptatibus suscipit possimus.', 'Quia autem deleniti quia repellat et fugiat similique eos provident.', 0, 1, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(87, 274, 'Distinctio eligendi enim.', 'Et ex tenetur fugit aut necessitatibus omnis consequatur.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(88, 492, 'Expedita ea architecto ut.', 'Porro velit ipsum eaque minus et sint sed dignissimos velit beatae aut rerum eligendi.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(89, 345, 'Eum voluptas dolor id.', 'Placeat id ipsam id veritatis cupiditate repellendus corporis consectetur corrupti consequatur voluptatibus eaque.', 0, 3, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(90, 440, 'At aut officiis vitae.', 'Minima explicabo minima soluta nulla eaque minima.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(91, 303, 'Quod dicta quis in.', 'Amet expedita rerum sequi ab explicabo et eos.', 0, 3, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(92, 151, 'Quibusdam nemo est.', 'Eligendi qui voluptas et temporibus quis provident qui.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(93, 79, 'Qui ut mollitia blanditiis.', 'Expedita itaque adipisci dicta et nihil id dolor.', 0, 2, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(94, 167, 'Sint praesentium corporis est est.', 'Minima quia placeat aliquam consequuntur soluta eaque et ea et.', 0, 5, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(95, 157, 'Unde optio ut architecto.', 'Accusantium consectetur dolores quia minima omnis et error modi ratione distinctio ut nihil illum.', 0, 2, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(96, 226, 'Voluptatum sed est perspiciatis.', 'Qui aut in sed nobis culpa expedita sunt sit.', 0, 1, 'events', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(97, 461, 'Ullam dolore eius.', 'Optio debitis et beatae esse omnis suscipit porro nemo voluptas amet porro rerum est.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(98, 442, 'Aut ipsa voluptatem.', 'Velit nesciunt facere voluptas consequatur sed incidunt ut ea adipisci est voluptatem harum.', 0, 1, 'users', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(99, 48, 'In temporibus impedit deleniti.', 'Voluptates vel aut ea unde odio officiis excepturi neque porro ea.', 0, 4, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(100, 406, 'Consequatur laudantium alias.', 'Et et nihil et ipsa earum ut excepturi unde culpa perferendis at.', 0, 2, 'gigs', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(101, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:05', '2025-06-01 13:36:05'),
(102, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:07', '2025-06-01 13:36:07'),
(103, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:10', '2025-06-01 13:36:10'),
(104, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:12', '2025-06-01 13:36:12'),
(105, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:13', '2025-06-01 13:36:13'),
(106, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:15', '2025-06-01 13:36:15'),
(107, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:17', '2025-06-01 13:36:17'),
(108, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:21', '2025-06-01 13:36:21'),
(109, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:22', '2025-06-01 13:36:22'),
(110, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:24', '2025-06-01 13:36:24'),
(111, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:25', '2025-06-01 13:36:25'),
(112, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:27', '2025-06-01 13:36:27'),
(113, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:29', '2025-06-01 13:36:29'),
(114, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:31', '2025-06-01 13:36:31'),
(115, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:33', '2025-06-01 13:36:33'),
(116, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:35', '2025-06-01 13:36:35'),
(117, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:37', '2025-06-01 13:36:37'),
(118, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:39', '2025-06-01 13:36:39'),
(119, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:40', '2025-06-01 13:36:40'),
(120, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:42', '2025-06-01 13:36:42'),
(121, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:43', '2025-06-01 13:36:43'),
(122, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:45', '2025-06-01 13:36:45'),
(123, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:47', '2025-06-01 13:36:47'),
(124, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:48', '2025-06-01 13:36:48'),
(125, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:51', '2025-06-01 13:36:51'),
(126, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:55', '2025-06-01 13:36:55'),
(127, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:36:57', '2025-06-01 13:36:57'),
(128, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:37:04', '2025-06-01 13:37:04'),
(129, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-01 13:37:07', '2025-06-01 13:37:07'),
(130, 1, 'Test Notification', 'This is a test notification', 0, NULL, NULL, '2025-06-02 09:29:36', '2025-06-02 09:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_admin_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(2, 'read_admin_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(3, 'update_admin_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(4, 'delete_admin_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(5, 'create_setting_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(6, 'read_setting_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(7, 'update_setting_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(8, 'delete_setting_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(9, 'create_user_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(10, 'read_user_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(11, 'update_user_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(12, 'delete_user_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(13, 'create_category_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(14, 'read_category_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(15, 'update_category_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(16, 'delete_category_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(17, 'create_contact_us_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(18, 'read_contact_us_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(19, 'update_contact_us_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(20, 'delete_contact_us_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(21, 'create_country_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(22, 'read_country_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(23, 'update_country_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(24, 'delete_country_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(25, 'create_gig_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(26, 'read_gig_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(27, 'update_gig_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(28, 'delete_gig_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(29, 'create_event_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(30, 'read_event_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(31, 'update_event_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(32, 'delete_event_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(33, 'create_job_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(34, 'read_job_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(35, 'update_job_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(36, 'delete_job_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(37, 'create_notice_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(38, 'read_notice_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(39, 'update_notice_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(40, 'delete_notice_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(41, 'create_user_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(42, 'read_user_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(43, 'update_user_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(44, 'delete_user_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(45, 'create_user_sub_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(46, 'read_user_sub_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(47, 'update_user_sub_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(48, 'delete_user_sub_type_management', 'admin', '2025-06-01 11:28:27', '2025-06-01 11:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'token', '0154a69906dd5d40f45057d5e447835565b352a1dd1d9d23f28cb663198c6b27', '[\"*\"]', NULL, NULL, '2025-06-01 11:30:08', '2025-06-01 11:30:08'),
(2, 'App\\Models\\User', 641, 'token', '6645b2f328f98dc9ad2f4168f68e1c34c93e294998deb523d672df495ba9d56e', '[\"*\"]', '2025-06-02 12:37:52', NULL, '2025-06-01 11:30:47', '2025-06-02 12:37:52'),
(3, 'App\\Models\\User', 641, 'token', '3e0ac2b6c53de8c04dc94be762a5783a929ba3d24e40d862d697ede1aa9fd06c', '[\"*\"]', '2025-06-01 12:09:54', NULL, '2025-06-01 11:31:11', '2025-06-01 12:09:54'),
(4, 'App\\Models\\User', 1, 'token', '7c56e0b604a67dfdbbb3dee80ebeccff92b9413bb315459f47ce7e7c75e6f646', '[\"*\"]', '2025-06-01 12:44:58', NULL, '2025-06-01 11:58:35', '2025-06-01 12:44:58'),
(5, 'App\\Models\\User', 641, 'token', '950a93bd4f2dd3e548d8c85ab6d551eafa0f54a68f1038e80de1ccee536cb52c', '[\"*\"]', '2025-06-02 10:00:12', NULL, '2025-06-01 12:09:54', '2025-06-02 10:00:12'),
(6, 'App\\Models\\User', 642, 'token', 'ec6d5322fa4c2166d3c8c903dbf1c0cf8fdda22b2756c111536ee64dd8d925ce', '[\"*\"]', '2025-06-01 13:52:25', NULL, '2025-06-01 12:43:56', '2025-06-01 13:52:25'),
(7, 'App\\Models\\User', 1, 'token', 'b09c1a78706400bc0995ee8a747da77af245fb7beb99625b872e37fd6ec9c7de', '[\"*\"]', '2025-06-01 12:57:47', NULL, '2025-06-01 12:56:02', '2025-06-01 12:57:47'),
(8, 'App\\Models\\User', 643, 'token', 'e90ae61e55665d9484fe5c9bf23a6ccb9c23b6eba426be3d816d7b19b4786b13', '[\"*\"]', NULL, NULL, '2025-06-01 13:20:34', '2025-06-01 13:20:34'),
(9, 'App\\Models\\User', 1, 'token', 'dad017439b77c27b03990f2520cf19191e5de5bb761c330b87ba3034656372d8', '[\"*\"]', '2025-06-01 14:00:15', NULL, '2025-06-01 13:33:13', '2025-06-01 14:00:15'),
(10, 'App\\Models\\User', 1, 'token', '50717aac360fead1265d74f30382d657a534baea3c3bc1abc8ed51116e29aa4b', '[\"*\"]', '2025-06-01 14:16:53', NULL, '2025-06-01 14:05:05', '2025-06-01 14:16:53'),
(11, 'App\\Models\\User', 642, 'token', 'c23202633ae1fc0c33dff1cacead0bb06dc986717d9091c7f671b8853f70a3a1', '[\"*\"]', '2025-06-02 06:37:52', NULL, '2025-06-02 06:32:43', '2025-06-02 06:37:52'),
(12, 'App\\Models\\User', 1, 'token', 'a202782e39d71bf95152676a8531fccee0b372c6abdd0a44bc50aba08af2c68a', '[\"*\"]', NULL, NULL, '2025-06-02 06:55:22', '2025-06-02 06:55:22'),
(13, 'App\\Models\\User', 1, 'token', 'a4c310ba5060e70ff1fd29134c955e2866b800bcbd835f23961a625489e01ae2', '[\"*\"]', NULL, NULL, '2025-06-02 06:56:53', '2025-06-02 06:56:53'),
(14, 'App\\Models\\User', 1, 'token', '9899a6785981d70f3e4a7d16de0b39fa4abeb6ccb5da5d835dba55e00591a237', '[\"*\"]', '2025-06-02 07:03:29', NULL, '2025-06-02 06:57:28', '2025-06-02 07:03:29'),
(16, 'App\\Models\\User', 642, 'token', 'c256bc79eb56495fb86530fffbbe61a1bd042b79154f0a912aa2c67d63a34060', '[\"*\"]', '2025-06-02 09:08:00', NULL, '2025-06-02 08:41:01', '2025-06-02 09:08:00'),
(17, 'App\\Models\\User', 1, 'token', '12c68e185da7f1084e4b5fea821c234e975c0ff3e42a292b163b1ad4b2679755', '[\"*\"]', '2025-06-02 09:29:27', NULL, '2025-06-02 08:43:25', '2025-06-02 09:29:27'),
(18, 'App\\Models\\User', 642, 'token', '7451f971d1e6c7c6168ebe734c844e67268c09f02ca5baa6e1144e791e0e0a53', '[\"*\"]', '2025-06-02 11:22:30', NULL, '2025-06-02 09:09:15', '2025-06-02 11:22:30'),
(19, 'App\\Models\\User', 641, 'token', 'c35ab689e24da39aaa3b2d4ac208c26ee58b254c1ea712cbe5183e48100d6044', '[\"*\"]', '2025-06-02 11:22:50', NULL, '2025-06-02 10:57:33', '2025-06-02 11:22:50'),
(20, 'App\\Models\\User', 641, 'token', 'a23f2a000fca799ce3f952bbae2bb66117bf0823876bc5cf7dbf890302364ebd', '[\"*\"]', '2025-06-02 13:35:18', NULL, '2025-06-02 11:22:50', '2025-06-02 13:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `comment_count` int NOT NULL DEFAULT '0',
  `reaction_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `status`, `comment_count`, `reaction_count`, `created_at`, `updated_at`) VALUES
(1, 481, 'Dicta quidem dolorem omnis nobis officia quae aperiam tenetur. Rerum sunt non accusantium corrupti harum reprehenderit delectus. Porro ad praesentium voluptas commodi. Placeat in qui impedit qui quas consequatur.', 1, 56, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(2, 482, 'Qui odit et cupiditate blanditiis quis nostrum nesciunt. Et harum ipsum aliquid repellat soluta cupiditate. Quo culpa ipsum animi vitae voluptate voluptas aut.', 1, 43, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(3, 483, 'Dolorem at labore ut. Doloribus et adipisci consequuntur ipsa voluptatem et saepe et. Explicabo est iure voluptate aliquid et non sint. Quia et et earum ad.', 1, 27, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(4, 484, 'Adipisci est blanditiis vel voluptas. Pariatur accusantium minus ut ea.', 1, 41, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(5, 485, 'Cumque occaecati impedit quia veritatis doloremque est. Quos accusamus itaque qui sint aliquam. Non sit iusto error eos est sed. Placeat explicabo laboriosam temporibus corporis.', 1, 28, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(6, 486, 'Reprehenderit optio aut deserunt facilis neque omnis exercitationem. Debitis nisi iure est facilis ea molestiae delectus maiores. Repellat et praesentium omnis nesciunt aut qui.', 0, 76, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(7, 487, 'Blanditiis consequatur qui facere pariatur aperiam excepturi. Repudiandae enim harum quasi provident labore nulla ullam. Soluta sed repellat unde assumenda.', 1, 40, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(8, 488, 'Et omnis et omnis eligendi voluptatem quam ducimus dignissimos. Iste ullam error qui laboriosam veritatis.', 1, 23, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(9, 489, 'Et consequatur dolorem rerum qui. Non ad nihil ducimus beatae iusto ipsum iure. Quisquam exercitationem incidunt est qui.', 0, 69, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(10, 490, 'Suscipit laboriosam nulla animi et et distinctio iusto vel. Quia amet aliquid similique molestiae in ullam voluptatem. Aperiam earum culpa quibusdam esse omnis porro consequatur aut.', 0, 29, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(11, 492, 'Optio et quasi velit rerum placeat qui. Explicabo laboriosam qui officia sit exercitationem at facilis. Optio nesciunt aut at veritatis voluptatem nulla.', 1, 97, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(12, 494, 'Et dolores voluptate fugiat nemo dolores est qui. In est laboriosam omnis iste. Est ut aperiam vero tenetur. Aut aut fugiat non illo sit. Et accusantium magni et ipsam temporibus ea vero.', 0, 100, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(13, 496, 'Aut dolores molestiae laboriosam laudantium. Officiis sequi in vel eius qui ut veniam. Aut quo quo harum.', 1, 12, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(14, 498, 'Nobis ducimus amet molestiae sequi aut doloremque voluptas. Eum rerum quibusdam consequatur dicta quis cum. Inventore ipsa nulla voluptatem recusandae.', 0, 49, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(15, 500, 'Suscipit architecto vel et aut. Rem distinctio expedita quae praesentium consequatur qui expedita. Veniam unde incidunt voluptatem corrupti sequi autem. Repudiandae repellat quam voluptate quam molestias mollitia qui.', 1, 62, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(16, 502, 'Voluptatibus ratione dignissimos aut aut in dolores suscipit. Eveniet ea id est error qui. Repudiandae quia totam eligendi dolorum et voluptatem libero.', 0, 58, 0, '2025-06-01 11:29:01', '2025-06-01 11:29:01'),
(17, 504, 'Ullam nulla hic nihil. Alias enim ipsum cupiditate voluptate. Iure ut reprehenderit iure cumque. Qui et eos ab.', 1, 33, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(18, 506, 'Est illo dolore quisquam possimus sit ad. Quia perferendis maxime libero voluptas voluptatibus a quam. Molestias laborum cupiditate debitis eius consequatur.', 0, 7, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(19, 508, 'Rem dolorem necessitatibus adipisci. Inventore eligendi eaque qui sunt autem sapiente rerum nesciunt. Eum neque tenetur perferendis perspiciatis est sunt a. Magni et repudiandae inventore atque tempore non.', 1, 11, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(20, 510, 'Doloremque ipsam excepturi ex quaerat dolorum omnis provident. Omnis dignissimos assumenda quas aut tempora velit. Sed dolorem dolorem explicabo voluptatem explicabo omnis rem.', 1, 13, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(21, 513, 'Ipsum quis praesentium quasi tenetur commodi incidunt qui. Dolores dolores totam vero suscipit perspiciatis et soluta. Repudiandae rerum sint et.', 0, 31, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(22, 516, 'Magnam occaecati dolorem quas voluptas sit at. Enim nesciunt temporibus facilis eos soluta numquam. Nulla eligendi magnam eum iusto autem. Aut praesentium voluptatem aut consequatur quo ut numquam.', 1, 11, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(23, 519, 'Repellat illum ut omnis a porro. Culpa sequi eos aspernatur non quisquam consequatur. Id sint aliquam commodi aut quidem quia minus.', 1, 86, 0, '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(24, 522, 'Neque ad qui amet amet odio laborum dolorem in. Odio et itaque excepturi qui fugiat sit sunt. Omnis voluptatem aut molestiae corrupti doloremque nihil. Aliquid in nam non.', 1, 56, 0, '2025-06-01 11:29:03', '2025-06-02 11:29:04'),
(25, 525, 'Error a blanditiis dolor aspernatur. Vitae aliquam nulla saepe blanditiis enim officia. Occaecati asperiores ad quibusdam tempora doloribus consectetur. Vitae ut corporis laudantium quia facere et blanditiis. Inventore ipsam sapiente dolores labore rerum.', 1, 86, 0, '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(26, 528, 'Odio facere consequatur voluptatem odio quas ut. Et vel a autem voluptatem velit non tempore. Quo libero dolorem impedit consequuntur. Aliquid vel qui consequatur adipisci nihil veritatis.', 1, 88, 0, '2025-06-01 11:29:03', '2025-06-02 06:33:20'),
(27, 531, 'Molestias est dolor aliquid asperiores consequatur voluptates qui. Aut quod voluptatem voluptatem.', 1, 25, 0, '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(28, 534, 'Voluptatem quidem omnis ut dolores magnam. Blanditiis est voluptatem consequatur illum et. Qui aspernatur labore quod nihil rerum. Perspiciatis quia quo ab sit officiis repellendus id molestias.', 1, 88, 0, '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(29, 537, 'Doloribus laudantium cupiditate voluptate sit occaecati molestias. Sequi asperiores reprehenderit quae hic nostrum rerum. Rerum dolores aspernatur ducimus magni amet. Eos pariatur maiores tempora sequi nulla voluptas.', 1, 100, 0, '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(30, 540, 'Quasi ut excepturi sit quia. Non suscipit earum laudantium odio voluptate totam suscipit.', 0, 23, 0, '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(31, 642, 'sa', 1, 1, 0, '2025-06-01 13:39:13', '2025-06-02 06:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 491, 11, 'Voluptatem laudantium facere voluptates.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(2, 493, 12, 'Natus sed et sit voluptatem.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(3, 495, 13, 'Quibusdam laboriosam nobis eaque quod pariatur vitae.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(4, 497, 14, 'Esse omnis vel repellat.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(5, 499, 15, 'Labore perspiciatis sapiente expedita quaerat.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(6, 501, 16, 'Labore aspernatur maiores rerum quis alias consequatur.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(7, 503, 17, 'Aliquid magni aut error illum.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(8, 505, 18, 'Quas molestiae nam quae quia nam sint.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(9, 507, 19, 'Libero et beatae et corrupti provident dolor et sed.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(10, 509, 20, 'Possimus perspiciatis et eligendi enim omnis eum ducimus.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(11, 512, 21, 'Laborum pariatur autem occaecati error.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(12, 515, 22, 'Hic est non est.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(13, 518, 23, 'Voluptatem quasi omnis voluptas occaecati id.', '2025-06-01 11:29:02', '2025-06-01 11:29:02'),
(14, 521, 24, 'Magnam rerum perspiciatis sint voluptatem recusandae fugiat recusandae sint.', '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(15, 524, 25, 'Repellendus saepe in quod facilis doloribus est est.', '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(16, 527, 26, 'Consequuntur suscipit quia ut assumenda repellat accusamus cupiditate.', '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(17, 530, 27, 'Earum consequuntur laboriosam odit debitis fugit voluptates.', '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(18, 533, 28, 'Asperiores atque quo quibusdam praesentium.', '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(19, 536, 29, 'Et tempore dolorum non ea dignissimos sint.', '2025-06-01 11:29:03', '2025-06-01 11:29:03'),
(20, 539, 30, 'Eos molestiae aut fuga consequatur harum nisi.', '2025-06-01 11:29:04', '2025-06-01 11:29:04'),
(21, 642, 31, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-06-02 06:33:54', '2025-06-02 06:33:54'),
(24, 641, 24, 'SAdDda', '2025-06-02 11:29:04', '2025-06-02 11:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `post_reactions`
--

CREATE TABLE `post_reactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `reaction` enum('like','love','haha','wow','sad','angry') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_shares`
--

CREATE TABLE `post_shares` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
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
(48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'app_name', 'mawhebtak', NULL, NULL, NULL),
(2, 'logo', 'logo.png', NULL, NULL, NULL),
(3, 'fav_icon', 'logo.png', NULL, NULL, NULL),
(4, 'app_mentainance', 'true', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `url_type` enum('youtube','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"en\":\"Vero rem sed.\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(2, 4, '{\"en\":\"Esse saepe.\"}', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(3, 6, '{\"en\":\"Laudantium ut ab.\"}', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(4, 8, '{\"en\":\"Magni fuga.\"}', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(5, 10, '{\"en\":\"Voluptates quos.\"}', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(6, 12, '{\"en\":\"Omnis corrupti debitis.\"}', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(7, 14, '{\"en\":\"Impedit sapiente qui.\"}', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(8, 16, '{\"en\":\"Est laudantium consectetur.\"}', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(9, 18, '{\"en\":\"Consectetur repudiandae ipsum.\"}', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(10, 20, '{\"en\":\"Enim dolor aut.\"}', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(11, 22, '{\"en\":\"Nihil inventore.\"}', 0, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(12, 24, '{\"en\":\"Officiis repellat.\"}', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(13, 26, '{\"en\":\"Odit atque quasi.\"}', 1, '2025-06-01 11:28:28', '2025-06-01 11:28:28'),
(14, 28, '{\"en\":\"Pariatur rerum.\"}', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(15, 30, '{\"en\":\"Totam aspernatur.\"}', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(16, 32, '{\"en\":\"Ipsam quod corporis.\"}', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(17, 34, '{\"en\":\"Omnis deleniti.\"}', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(18, 36, '{\"en\":\"Similique ut.\"}', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(19, 38, '{\"en\":\"Fugit asperiores labore.\"}', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(20, 40, '{\"en\":\"Culpa iste est.\"}', 1, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(21, 42, '{\"en\":\"Voluptas illo.\"}', 0, '2025-06-01 11:28:29', '2025-06-01 11:28:29'),
(22, 44, '{\"en\":\"Rerum soluta aut.\"}', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(23, 46, '{\"en\":\"Tenetur assumenda.\"}', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(24, 48, '{\"en\":\"Nihil fugiat.\"}', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(25, 50, '{\"en\":\"Consequuntur consequatur exercitationem.\"}', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(26, 52, '{\"en\":\"Totam nam vel.\"}', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(27, 54, '{\"en\":\"Ut voluptatum.\"}', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(28, 56, '{\"en\":\"Dolores est ipsam.\"}', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(29, 58, '{\"en\":\"Aut blanditiis culpa.\"}', 1, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(30, 60, '{\"en\":\"Qui vel temporibus.\"}', 0, '2025-06-01 11:28:30', '2025-06-01 11:28:30'),
(31, 62, '{\"en\":\"Sed distinctio.\"}', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(32, 64, '{\"en\":\"Temporibus odit.\"}', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(33, 66, '{\"en\":\"Odio nihil facilis.\"}', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(34, 68, '{\"en\":\"Possimus ad.\"}', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(35, 70, '{\"en\":\"Laboriosam et.\"}', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(36, 72, '{\"en\":\"Odio dolor vero.\"}', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(37, 74, '{\"en\":\"Vitae eaque adipisci.\"}', 1, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(38, 76, '{\"en\":\"Maiores odit.\"}', 0, '2025-06-01 11:28:31', '2025-06-01 11:28:31'),
(39, 78, '{\"en\":\"Consequuntur fugiat mollitia.\"}', 1, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(40, 80, '{\"en\":\"Quos est at.\"}', 1, '2025-06-01 11:28:32', '2025-06-01 11:28:32'),
(41, 93, '{\"en\":\"Asperiores quibusdam.\"}', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(42, 96, '{\"en\":\"Et necessitatibus laborum.\"}', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(43, 99, '{\"en\":\"Placeat voluptas eos.\"}', 1, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(44, 102, '{\"en\":\"Unde voluptatem repudiandae.\"}', 0, '2025-06-01 11:28:48', '2025-06-01 11:28:48'),
(45, 105, '{\"en\":\"Illo aperiam aspernatur.\"}', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(46, 108, '{\"en\":\"Alias aut.\"}', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(47, 111, '{\"en\":\"Voluptatem sint et.\"}', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(48, 114, '{\"en\":\"Molestiae id nulla.\"}', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(49, 117, '{\"en\":\"Earum tempore.\"}', 1, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(50, 120, '{\"en\":\"Numquam optio et.\"}', 0, '2025-06-01 11:28:49', '2025-06-01 11:28:49'),
(51, 123, '{\"en\":\"Laboriosam porro voluptatem.\"}', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(52, 126, '{\"en\":\"Voluptatum qui minus.\"}', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(53, 129, '{\"en\":\"Molestiae architecto.\"}', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(54, 132, '{\"en\":\"Et voluptas alias.\"}', 0, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(55, 135, '{\"en\":\"Quo natus.\"}', 1, '2025-06-01 11:28:50', '2025-06-01 11:28:50'),
(56, 138, '{\"en\":\"Hic iusto.\"}', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(57, 141, '{\"en\":\"Aut voluptatem voluptas.\"}', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(58, 144, '{\"en\":\"Voluptas expedita ab.\"}', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(59, 147, '{\"en\":\"Ut laborum.\"}', 1, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(60, 150, '{\"en\":\"Consequuntur magnam.\"}', 0, '2025-06-01 11:28:51', '2025-06-01 11:28:51'),
(61, 153, '{\"en\":\"Facilis est.\"}', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(62, 156, '{\"en\":\"Illum consequuntur nesciunt.\"}', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(63, 159, '{\"en\":\"Eius enim unde.\"}', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(64, 162, '{\"en\":\"Ullam sed.\"}', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(65, 165, '{\"en\":\"Provident minima fuga.\"}', 1, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(66, 168, '{\"en\":\"Veniam quis et.\"}', 0, '2025-06-01 11:28:52', '2025-06-01 11:28:52'),
(67, 171, '{\"en\":\"Similique corrupti non.\"}', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(68, 174, '{\"en\":\"Quaerat magni.\"}', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(69, 177, '{\"en\":\"Est adipisci.\"}', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(70, 180, '{\"en\":\"Odit similique.\"}', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(71, 182, '{\"en\":\"Rem odio consequatur.\"}', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(72, 184, '{\"en\":\"Impedit nihil.\"}', 0, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(73, 186, '{\"en\":\"Sint molestias.\"}', 1, '2025-06-01 11:28:53', '2025-06-01 11:28:53'),
(74, 188, '{\"en\":\"Similique iusto.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(75, 190, '{\"en\":\"Sed unde asperiores.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(76, 192, '{\"en\":\"Neque mollitia.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(77, 194, '{\"en\":\"Fugit nemo nihil.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(78, 196, '{\"en\":\"Odio et.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(79, 198, '{\"en\":\"Consequatur ab.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(80, 200, '{\"en\":\"Tenetur labore.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(81, 202, '{\"en\":\"Et error exercitationem.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(82, 204, '{\"en\":\"Nostrum eveniet omnis.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(83, 206, '{\"en\":\"Et reprehenderit.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(84, 208, '{\"en\":\"Temporibus hic.\"}', 1, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(85, 210, '{\"en\":\"Asperiores et provident.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(86, 212, '{\"en\":\"Corporis deleniti.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(87, 214, '{\"en\":\"Magni et.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(88, 216, '{\"en\":\"Magnam ut sequi.\"}', 0, '2025-06-01 11:28:54', '2025-06-01 11:28:54'),
(89, 218, '{\"en\":\"Ratione veritatis nostrum.\"}', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(90, 220, '{\"en\":\"Quo et labore.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(91, 222, '{\"en\":\"Necessitatibus nisi.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(92, 224, '{\"en\":\"Magnam sint.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(93, 226, '{\"en\":\"Et quo.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(94, 228, '{\"en\":\"Sed maiores recusandae.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(95, 230, '{\"en\":\"Ipsa omnis.\"}', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(96, 232, '{\"en\":\"Quo consectetur.\"}', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(97, 234, '{\"en\":\"Sequi sed fugit.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(98, 236, '{\"en\":\"Qui est.\"}', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(99, 238, '{\"en\":\"Soluta et.\"}', 1, '2025-06-01 11:28:55', '2025-06-01 11:28:55'),
(100, 240, '{\"en\":\"Ratione unde reprehenderit.\"}', 0, '2025-06-01 11:28:55', '2025-06-01 11:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `unwanted_users`
--

CREATE TABLE `unwanted_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `unwanted_user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unwanted_users`
--

INSERT INTO `unwanted_users` (`id`, `user_id`, `unwanted_user_id`, `created_at`, `updated_at`) VALUES
(1, 641, 4, '2025-06-02 08:56:35', '2025-06-02 08:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` tinyint DEFAULT NULL,
  `otp_expire` datetime DEFAULT NULL,
  `wallet` double NOT NULL DEFAULT '0',
  `is_social` tinyint(1) NOT NULL DEFAULT '0',
  `social_type` enum('google','facebook','apple') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_sub_type_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `language` enum('en','ar','fr','es','de','it','pt','ru','zh','ja','ko','hi','tr','nl','pl','sv','da','no','fi','cs','hu','el','ar_SA','en_US','fr_CA','es_ES','de_DE','it_IT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `phone`, `password`, `otp`, `otp_expire`, `wallet`, `is_social`, `social_type`, `user_sub_type_id`, `created_at`, `updated_at`, `language`) VALUES
(641, 'mo matter', 'qqqqqq111@gmail.com', 1, '0101503443419', '$2y$10$fzE71X/bUTWjtH3Jc4QYTOUetZSBTR6uqswDmS00/CxwzZOb59VvS', NULL, NULL, 0, 0, NULL, 1, '2025-06-01 11:30:47', '2025-06-01 11:30:47', 'en'),
(642, 'semicolon soft', 'semicolonsales@gmail.com', 1, NULL, '$2y$10$ylTqkH5CSK2LP0uhuGOqgu2JHe0qYkJFISkdLEHfWVncXEsPs1rQG', NULL, NULL, 0, 0, 'google', NULL, '2025-06-01 12:43:56', '2025-06-01 12:43:56', 'en'),
(643, 'mo matter', 'semicolonsale0s@gmail.com', 1, '0101503443418', '$2y$10$EcfRwIo4JIBBecy8tWBxZeiTdO5pUQkotwAKBh0sxL9xIeHdRzTbe', NULL, NULL, 0, 0, NULL, 1, '2025-06-01 13:20:34', '2025-06-01 13:20:34', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_cover` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followers_count` int NOT NULL DEFAULT '0',
  `following_count` int NOT NULL DEFAULT '0',
  `posts_count` int NOT NULL DEFAULT '0',
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `syndicate` bigint DEFAULT NULL COMMENT ' رقم النقابة ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `avatar`, `bg_cover`, `lat`, `long`, `bio`, `headline`, `followers_count`, `following_count`, `posts_count`, `location`, `age`, `gender`, `syndicate`, `created_at`, `updated_at`) VALUES
(1, 71, 'https://via.placeholder.com/640x480.png/000066?text=assumenda', 'https://via.placeholder.com/640x480.png/001111?text=blanditiis', '-66.16633', '29.660298', 'Ducimus maiores illo harum et qui aliquid architecto.', 'Velit non consequuntur numquam est mollitia vero.', 720, 856, 15, 'Jailynshire', 25, 'female', 8806, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(2, 72, 'https://via.placeholder.com/640x480.png/008822?text=ut', 'https://via.placeholder.com/640x480.png/00ee33?text=non', '-72.33264', '160.175253', 'Recusandae illo sed vel ea inventore non et.', 'Consequuntur asperiores velit nisi vel.', 73, 23, 33, 'Rustyhaven', 44, 'male', 2864, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(3, 73, 'https://via.placeholder.com/640x480.png/00ff22?text=velit', 'https://via.placeholder.com/640x480.png/00ffcc?text=ut', '31.593004', '107.43823', 'Inventore aliquam iste culpa incidunt optio nihil non ratione.', 'Adipisci esse quo sed aut sit blanditiis.', 102, 533, 50, 'Earlineside', 27, 'female', 6449, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(4, 74, 'https://via.placeholder.com/640x480.png/00ccee?text=ex', 'https://via.placeholder.com/640x480.png/00bbee?text=aperiam', '-52.168602', '-175.37157', 'Harum veniam in sequi vel molestiae.', 'Explicabo et sed rerum.', 804, 283, 82, 'O\'Connerland', 55, 'male', 1665, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(5, 75, 'https://via.placeholder.com/640x480.png/0055bb?text=totam', 'https://via.placeholder.com/640x480.png/003322?text=debitis', '-88.024623', '-175.019066', 'Saepe nihil aut et fugiat.', 'Unde quo adipisci ut delectus tempore blanditiis voluptatem.', 831, 678, 69, 'Framifort', 22, 'female', 8365, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(6, 76, 'https://via.placeholder.com/640x480.png/000022?text=eum', 'https://via.placeholder.com/640x480.png/0011ff?text=natus', '-70.62165', '-79.605296', 'Ullam adipisci ut maxime praesentium.', 'Praesentium tempora aspernatur dolores quia quis.', 557, 744, 72, 'Beierfort', 36, 'female', 9769, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(7, 77, 'https://via.placeholder.com/640x480.png/007755?text=repellat', 'https://via.placeholder.com/640x480.png/0077ff?text=voluptas', '-18.699143', '-77.866805', 'Ducimus dignissimos doloribus eum corrupti qui suscipit.', 'Tempora autem dolorum similique sequi.', 108, 170, 38, 'South Shadtown', 25, 'male', 4831, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(8, 78, 'https://via.placeholder.com/640x480.png/00aa99?text=magni', 'https://via.placeholder.com/640x480.png/00bb99?text=harum', '-4.414313', '171.092618', 'Autem earum placeat voluptas recusandae nobis doloribus dolorum iure.', 'Enim quas quos assumenda ipsum molestias.', 951, 477, 55, 'West Flavie', 20, 'male', 5719, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(9, 79, 'https://via.placeholder.com/640x480.png/00ddcc?text=et', 'https://via.placeholder.com/640x480.png/007777?text=laudantium', '-86.220003', '-45.389589', 'Aliquam fugit doloribus illum quis ut earum.', 'Accusantium quos velit natus ut cumque.', 649, 461, 88, 'West Buckstad', 29, 'female', 6396, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(10, 80, 'https://via.placeholder.com/640x480.png/0033dd?text=aperiam', 'https://via.placeholder.com/640x480.png/004400?text=pariatur', '-44.309689', '1.216876', 'Aut non provident exercitationem.', 'Provident facere nesciunt ut.', 161, 690, 70, 'Jerdeburgh', 45, 'male', 5079, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(11, 81, 'https://via.placeholder.com/640x480.png/001100?text=ut', 'https://via.placeholder.com/640x480.png/0066cc?text=facere', '-22.155159', '-130.309863', 'Sequi qui et recusandae voluptatem.', 'Excepturi odio hic at fugiat.', 592, 783, 11, 'Port Elroyville', 58, 'female', 1155, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(12, 82, 'https://via.placeholder.com/640x480.png/00cc11?text=sit', 'https://via.placeholder.com/640x480.png/005577?text=et', '23.640587', '-118.734311', 'Sit a minus facere.', 'Rerum excepturi tenetur sed est sint incidunt impedit.', 145, 678, 26, 'East Peterburgh', 36, 'male', 2129, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(13, 83, 'https://via.placeholder.com/640x480.png/008822?text=dolor', 'https://via.placeholder.com/640x480.png/00ccee?text=nesciunt', '88.449626', '-136.463234', 'Aliquam autem delectus maxime ipsum magni.', 'Qui quod repellat est est voluptatibus ut non.', 460, 998, 1, 'South Crystel', 52, 'male', 4703, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(14, 84, 'https://via.placeholder.com/640x480.png/008866?text=itaque', 'https://via.placeholder.com/640x480.png/0099dd?text=et', '-67.952276', '-118.43161', 'Dicta harum autem qui non.', 'Voluptas qui perspiciatis aut esse dolor.', 366, 409, 21, 'Veumland', 18, 'male', 1230, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(15, 85, 'https://via.placeholder.com/640x480.png/00bbbb?text=itaque', 'https://via.placeholder.com/640x480.png/00ee66?text=ratione', '-39.441278', '-94.51637', 'Minus saepe id dolor delectus velit et amet.', 'Necessitatibus aperiam et sint ut.', 490, 988, 21, 'New Cydney', 20, 'female', 3962, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(16, 86, 'https://via.placeholder.com/640x480.png/00ddff?text=aliquam', 'https://via.placeholder.com/640x480.png/00ccaa?text=voluptas', '-49.351634', '-133.027202', 'Corporis quas praesentium est magnam ex porro.', 'Vel et et voluptates quod possimus ut.', 423, 199, 14, 'Port Nedraville', 41, 'female', 7455, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(17, 87, 'https://via.placeholder.com/640x480.png/00ffbb?text=ab', 'https://via.placeholder.com/640x480.png/00ff22?text=est', '-13.712482', '34.851977', 'Excepturi tempora dolor in eaque.', 'Et ipsam neque vero.', 23, 236, 6, 'Kraigmouth', 41, 'female', 3634, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(18, 88, 'https://via.placeholder.com/640x480.png/00bb33?text=saepe', 'https://via.placeholder.com/640x480.png/0066ff?text=et', '-55.829622', '60.642204', 'Omnis voluptatem in non quis voluptatem et.', 'Molestiae sit ratione laboriosam ut error.', 909, 311, 88, 'Huelbury', 49, 'female', 8531, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(19, 89, 'https://via.placeholder.com/640x480.png/002211?text=voluptas', 'https://via.placeholder.com/640x480.png/00aaee?text=vitae', '-78.080769', '166.97035', 'At minima blanditiis id vitae itaque autem.', 'Molestiae et ullam vero unde accusantium et deserunt voluptates.', 674, 714, 4, 'Hillview', 29, 'female', 7609, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(20, 90, 'https://via.placeholder.com/640x480.png/0022bb?text=reiciendis', 'https://via.placeholder.com/640x480.png/00cc99?text=hic', '-41.852777', '153.668538', 'Sint ab aspernatur sunt eum voluptas corporis ipsam beatae.', 'Et optio doloremque cumque sapiente deleniti.', 714, 302, 74, 'New Ambrose', 25, 'female', 9208, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(21, 91, 'https://via.placeholder.com/640x480.png/00dd00?text=quo', 'https://via.placeholder.com/640x480.png/003377?text=ad', '-55.733458', '-149.867736', 'Qui hic et quod at.', 'Vitae aliquid et nisi voluptatem quos voluptatem.', 362, 58, 75, 'Araport', 21, 'male', 4606, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(22, 92, 'https://via.placeholder.com/640x480.png/00bbbb?text=magnam', 'https://via.placeholder.com/640x480.png/009900?text=voluptas', '73.536154', '124.048951', 'Aperiam minima et animi maiores ut rerum voluptas.', 'Aperiam reiciendis tempora reprehenderit fugit rerum in sapiente.', 596, 453, 62, 'South Yasmin', 50, 'female', 5814, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(23, 93, 'https://via.placeholder.com/640x480.png/0044dd?text=velit', 'https://via.placeholder.com/640x480.png/006666?text=non', '82.957543', '-137.501635', 'Tempora deserunt quia explicabo.', 'Vitae minus qui et atque ut qui.', 260, 672, 38, 'North Christafort', 18, 'female', 4326, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(24, 94, 'https://via.placeholder.com/640x480.png/00aa66?text=repellat', 'https://via.placeholder.com/640x480.png/0099cc?text=id', '17.373444', '16.591814', 'Quia nemo nisi laboriosam ut aliquid.', 'Repudiandae doloribus iste et nemo tempora ut aperiam quia.', 21, 465, 32, 'Gregoryside', 45, 'female', 5450, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(25, 95, 'https://via.placeholder.com/640x480.png/0022bb?text=minus', 'https://via.placeholder.com/640x480.png/0044aa?text=ducimus', '37.562192', '-26.127185', 'Voluptates eveniet pariatur harum.', 'Sit quia voluptatibus repudiandae et neque voluptas eius ut.', 966, 29, 99, 'West Toney', 57, 'female', 9607, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(26, 96, 'https://via.placeholder.com/640x480.png/0022cc?text=nisi', 'https://via.placeholder.com/640x480.png/0066cc?text=non', '36.405374', '-14.568857', 'Omnis aut aperiam minus occaecati facere et eos.', 'Optio autem quo eum esse ut et quae.', 786, 670, 71, 'New Billyton', 38, 'male', 2311, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(27, 97, 'https://via.placeholder.com/640x480.png/0044ff?text=sint', 'https://via.placeholder.com/640x480.png/00dd66?text=laborum', '44.039255', '-143.207563', 'Omnis ipsum nesciunt rerum ducimus sit veniam.', 'Nam qui est dicta dicta consequatur.', 440, 52, 99, 'Brittanymouth', 47, 'male', 9353, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(28, 98, 'https://via.placeholder.com/640x480.png/00ff66?text=nisi', 'https://via.placeholder.com/640x480.png/007799?text=vel', '58.503257', '-153.582845', 'Et non ratione cumque quo provident.', 'Excepturi rerum aut sed ut consequuntur numquam.', 95, 265, 71, 'Tremblaystad', 59, 'female', 6149, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(29, 99, 'https://via.placeholder.com/640x480.png/0044aa?text=omnis', 'https://via.placeholder.com/640x480.png/006655?text=exercitationem', '-87.539265', '-136.803416', 'Voluptas quos ut aut.', 'Ut sint voluptatum quo.', 907, 200, 32, 'Kshlerinton', 52, 'female', 2242, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(30, 100, 'https://via.placeholder.com/640x480.png/000033?text=ipsum', 'https://via.placeholder.com/640x480.png/0011ff?text=doloribus', '-20.166439', '142.642876', 'Eveniet possimus est ratione atque quia.', 'Vitae soluta quia tenetur incidunt magni.', 371, 523, 3, 'Stephaniachester', 56, 'male', 7705, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(31, 101, 'https://via.placeholder.com/640x480.png/00bbdd?text=perspiciatis', 'https://via.placeholder.com/640x480.png/00bbee?text=in', '-64.548563', '40.790935', 'Laborum culpa consequatur sed similique consequuntur asperiores aut.', 'Delectus nulla aliquid voluptatem sit sapiente delectus maiores.', 751, 644, 46, 'New Noe', 45, 'male', 2679, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(32, 102, 'https://via.placeholder.com/640x480.png/007700?text=excepturi', 'https://via.placeholder.com/640x480.png/008822?text=ut', '74.096112', '-7.557166', 'Cum quia omnis et alias unde.', 'Alias quo quo omnis consequuntur aperiam non totam.', 931, 758, 88, 'Taniaview', 29, 'female', 3657, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(33, 103, 'https://via.placeholder.com/640x480.png/00ddcc?text=autem', 'https://via.placeholder.com/640x480.png/00ee00?text=ut', '-35.313481', '-92.644462', 'Molestiae ut aliquid nihil reprehenderit.', 'Quia aut facilis dolor voluptas harum.', 299, 262, 56, 'Baileymouth', 46, 'male', 7395, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(34, 104, 'https://via.placeholder.com/640x480.png/0099aa?text=ad', 'https://via.placeholder.com/640x480.png/00cccc?text=fuga', '16.144651', '-87.882718', 'Ipsum et dolorum et libero aut architecto officiis.', 'Fugit omnis molestiae aperiam ea autem quia cum.', 972, 644, 28, 'Kemmerport', 23, 'female', 9135, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(35, 105, 'https://via.placeholder.com/640x480.png/008899?text=voluptatem', 'https://via.placeholder.com/640x480.png/0077ee?text=provident', '83.153161', '155.879671', 'Aut odio officiis labore et qui harum consequuntur.', 'Quis doloremque quia aut.', 347, 197, 23, 'South Roosevelt', 46, 'male', 6629, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(36, 106, 'https://via.placeholder.com/640x480.png/00ee11?text=ut', 'https://via.placeholder.com/640x480.png/00ee77?text=voluptatem', '-21.360733', '43.35452', 'Blanditiis quas reprehenderit iusto velit.', 'Voluptatem aut debitis ea ducimus in ut.', 802, 248, 41, 'Aleenstad', 56, 'male', 7593, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(37, 107, 'https://via.placeholder.com/640x480.png/00ff11?text=quam', 'https://via.placeholder.com/640x480.png/0000ee?text=dolorem', '73.537879', '40.933524', 'Blanditiis praesentium enim iste quasi quis sequi eum doloremque.', 'Autem necessitatibus ad possimus illum fugit ullam.', 13, 351, 53, 'New Susie', 29, 'male', 5123, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(38, 108, 'https://via.placeholder.com/640x480.png/009988?text=recusandae', 'https://via.placeholder.com/640x480.png/00bbdd?text=dolor', '24.623227', '-161.936854', 'Aut aut tenetur qui eos.', 'Dolorum assumenda ea neque aut magni.', 521, 500, 25, 'South Alimouth', 35, 'male', 7005, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(39, 109, 'https://via.placeholder.com/640x480.png/006655?text=impedit', 'https://via.placeholder.com/640x480.png/001122?text=rerum', '63.030613', '126.362353', 'Facilis explicabo atque doloribus tempora.', 'Quisquam sunt voluptas praesentium dolores suscipit.', 82, 764, 81, 'South Wilmer', 18, 'male', 4554, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(40, 110, 'https://via.placeholder.com/640x480.png/006699?text=quia', 'https://via.placeholder.com/640x480.png/0000cc?text=vel', '55.570581', '41.831329', 'Consectetur et fugiat non et quos.', 'Sed perspiciatis officia dolores in qui consectetur sapiente.', 244, 645, 76, 'New Frederique', 39, 'male', 7006, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(41, 111, 'https://via.placeholder.com/640x480.png/00aadd?text=aut', 'https://via.placeholder.com/640x480.png/0099dd?text=maiores', '-85.945229', '114.438895', 'Illum dolor similique id asperiores voluptas maxime qui.', 'Soluta voluptatem numquam soluta dolorem.', 587, 542, 21, 'Kundeville', 46, 'male', 1176, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(42, 112, 'https://via.placeholder.com/640x480.png/0033aa?text=facere', 'https://via.placeholder.com/640x480.png/007755?text=qui', '-55.434526', '-7.274643', 'Rerum ut consequatur consectetur ipsam.', 'Enim eos praesentium ullam culpa dicta.', 924, 343, 28, 'East Connorport', 20, 'female', 7269, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(43, 113, 'https://via.placeholder.com/640x480.png/00aa00?text=nihil', 'https://via.placeholder.com/640x480.png/009911?text=praesentium', '70.712771', '83.739399', 'Et optio dolorem reiciendis quas voluptatem fuga repellendus.', 'Accusantium qui facilis porro alias sint voluptatem.', 130, 534, 99, 'Pourosfurt', 20, 'female', 8372, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(44, 114, 'https://via.placeholder.com/640x480.png/00ffee?text=nihil', 'https://via.placeholder.com/640x480.png/00ee99?text=aut', '-35.168068', '7.091282', 'Non adipisci non dolores quae enim nostrum consequatur tempore.', 'A ex voluptas consectetur voluptatum voluptatem.', 364, 990, 98, 'Bartolettibury', 56, 'male', 2911, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(45, 115, 'https://via.placeholder.com/640x480.png/000077?text=tempora', 'https://via.placeholder.com/640x480.png/00ddbb?text=incidunt', '-4.310716', '64.091987', 'Aliquam qui quibusdam voluptatem omnis eos temporibus quia sunt.', 'Reprehenderit reprehenderit quia a non suscipit mollitia vero.', 471, 516, 28, 'Lake Alfredoport', 35, 'female', 4014, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(46, 116, 'https://via.placeholder.com/640x480.png/0000aa?text=quis', 'https://via.placeholder.com/640x480.png/00dd66?text=odit', '-36.887386', '70.352222', 'Quam nobis maiores maiores doloribus rem cumque.', 'Eos dolor inventore ipsam facere.', 398, 782, 16, 'Ruthietown', 44, 'male', 3417, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(47, 117, 'https://via.placeholder.com/640x480.png/00cc22?text=earum', 'https://via.placeholder.com/640x480.png/00cc33?text=qui', '-87.169091', '29.777547', 'Sit blanditiis omnis inventore consequatur vel.', 'Quasi et natus dicta molestiae.', 884, 995, 41, 'Hildaberg', 55, 'female', 2931, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(48, 118, 'https://via.placeholder.com/640x480.png/00ffaa?text=dicta', 'https://via.placeholder.com/640x480.png/000066?text=nostrum', '71.927587', '88.568558', 'Sit est nam et sit sit omnis.', 'Veniam dolores modi dolor accusantium eveniet.', 659, 125, 9, 'New Nashfort', 52, 'female', 4487, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(49, 119, 'https://via.placeholder.com/640x480.png/00eeee?text=et', 'https://via.placeholder.com/640x480.png/001100?text=est', '0.314518', '77.650997', 'Iste et rerum dolore commodi.', 'Aut et eum voluptatem laudantium culpa voluptas labore.', 337, 633, 69, 'Lake Jaydon', 27, 'male', 2315, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(50, 120, 'https://via.placeholder.com/640x480.png/00ddee?text=vel', 'https://via.placeholder.com/640x480.png/0099ff?text=qui', '89.943624', '-37.169432', 'Qui ea dignissimos et et blanditiis sit sapiente autem.', 'Voluptates dolore natus eaque voluptatem libero earum.', 138, 268, 53, 'Wolfville', 25, 'female', 7750, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(51, 121, 'https://via.placeholder.com/640x480.png/004466?text=exercitationem', 'https://via.placeholder.com/640x480.png/003322?text=quia', '-5.857464', '-3.537927', 'Aliquam odit dolorem rerum ut.', 'Sed eveniet enim id necessitatibus aut.', 192, 366, 94, 'East Estaton', 41, 'female', 7692, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(52, 122, 'https://via.placeholder.com/640x480.png/009966?text=reiciendis', 'https://via.placeholder.com/640x480.png/0000cc?text=temporibus', '41.33563', '10.88831', 'Iusto voluptate illo consequatur nulla sed nam.', 'Minus et voluptatum est asperiores nulla vitae.', 810, 556, 6, 'West Princetown', 46, 'male', 7890, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(53, 123, 'https://via.placeholder.com/640x480.png/0000cc?text=quam', 'https://via.placeholder.com/640x480.png/0044ff?text=sed', '32.184316', '0.357169', 'Aspernatur sed dolor atque omnis.', 'Accusamus quia unde placeat enim.', 667, 241, 5, 'South Abel', 47, 'male', 8331, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(54, 124, 'https://via.placeholder.com/640x480.png/004499?text=blanditiis', 'https://via.placeholder.com/640x480.png/008899?text=illum', '7.255796', '10.356438', 'Enim quaerat aut cupiditate hic.', 'Voluptatem explicabo facilis aut voluptas quia doloremque quidem.', 697, 579, 63, 'Brentstad', 41, 'male', 5353, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(55, 125, 'https://via.placeholder.com/640x480.png/00bb55?text=voluptate', 'https://via.placeholder.com/640x480.png/000099?text=voluptas', '63.839782', '23.446494', 'Odit possimus optio dicta accusantium ut perspiciatis ut.', 'Deserunt qui distinctio in animi quos minus.', 855, 793, 50, 'Elfriedaborough', 22, 'male', 5187, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(56, 126, 'https://via.placeholder.com/640x480.png/001144?text=voluptas', 'https://via.placeholder.com/640x480.png/00eecc?text=repellendus', '-31.038948', '3.774239', 'Est quos aut sit sint ut.', 'Dolorem in ad pariatur.', 257, 108, 17, 'Macejkovicfurt', 45, 'male', 3320, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(57, 127, 'https://via.placeholder.com/640x480.png/0000cc?text=animi', 'https://via.placeholder.com/640x480.png/00ccff?text=ad', '67.695626', '68.607495', 'Quos ducimus praesentium animi est.', 'Officiis corporis et nemo excepturi est et nam.', 369, 315, 92, 'D\'angelobury', 28, 'female', 9691, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(58, 128, 'https://via.placeholder.com/640x480.png/00dd66?text=ut', 'https://via.placeholder.com/640x480.png/005566?text=sed', '66.911345', '77.623677', 'Ut corrupti ut ratione ut omnis vel et.', 'Incidunt sint natus ipsam.', 567, 934, 6, 'Haylieport', 59, 'male', 7307, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(59, 129, 'https://via.placeholder.com/640x480.png/005566?text=ea', 'https://via.placeholder.com/640x480.png/003322?text=commodi', '82.699185', '175.431617', 'Architecto magnam et mollitia qui qui et aut.', 'Iusto delectus autem laboriosam cupiditate assumenda dolorem saepe.', 611, 260, 85, 'Hackettfort', 56, 'male', 8252, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(60, 130, 'https://via.placeholder.com/640x480.png/00ff44?text=dolor', 'https://via.placeholder.com/640x480.png/00dddd?text=vel', '-4.472852', '-63.214485', 'Ducimus nihil rerum accusamus architecto tenetur saepe ipsam.', 'Aliquam architecto voluptatem eius ut sit et.', 52, 775, 95, 'New Danny', 58, 'female', 2433, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(61, 131, 'https://via.placeholder.com/640x480.png/004455?text=qui', 'https://via.placeholder.com/640x480.png/004422?text=aut', '-85.36155', '-48.45688', 'Ducimus nihil accusantium dolor consequatur voluptatem natus.', 'Possimus quis autem ut voluptatem ut qui dolorem.', 512, 323, 93, 'North Doviechester', 41, 'female', 9674, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(62, 132, 'https://via.placeholder.com/640x480.png/0088cc?text=excepturi', 'https://via.placeholder.com/640x480.png/003355?text=et', '-59.046749', '-140.657104', 'Dolor repellendus et ad quia.', 'Non officia mollitia deleniti quia est id optio soluta.', 421, 853, 25, 'Lake Judeberg', 24, 'female', 5487, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(63, 133, 'https://via.placeholder.com/640x480.png/0044dd?text=cumque', 'https://via.placeholder.com/640x480.png/000033?text=quia', '-33.219967', '23.126004', 'Eligendi facere et nihil ad voluptas earum necessitatibus.', 'Voluptate eos aut ipsa nemo impedit.', 802, 282, 21, 'Cortneyfort', 33, 'male', 1086, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(64, 134, 'https://via.placeholder.com/640x480.png/004411?text=beatae', 'https://via.placeholder.com/640x480.png/0088aa?text=aliquid', '-80.970023', '-133.236587', 'Repudiandae voluptatem est quis earum qui impedit iusto.', 'Vero voluptatem vel et vitae voluptate.', 932, 795, 81, 'Ferryview', 34, 'male', 1819, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(65, 135, 'https://via.placeholder.com/640x480.png/0077cc?text=corporis', 'https://via.placeholder.com/640x480.png/00bb44?text=accusamus', '-20.26169', '-47.902579', 'Vel quo minus dolores animi dignissimos.', 'Distinctio quia est ad placeat commodi.', 660, 510, 66, 'Lake Estelton', 35, 'female', 9629, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(66, 136, 'https://via.placeholder.com/640x480.png/00dd00?text=adipisci', 'https://via.placeholder.com/640x480.png/001122?text=deleniti', '51.418266', '-48.509798', 'Molestias numquam mollitia laborum qui molestiae assumenda.', 'Ab officiis nihil laudantium id repellendus sit numquam.', 725, 585, 100, 'Aileenbury', 46, 'male', 1205, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(67, 137, 'https://via.placeholder.com/640x480.png/00ff99?text=quas', 'https://via.placeholder.com/640x480.png/008899?text=similique', '21.554118', '-92.647231', 'Modi voluptatem molestiae voluptas.', 'Totam non quia natus dicta accusamus qui dicta.', 552, 920, 25, 'Susannaland', 58, 'female', 3792, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(68, 138, 'https://via.placeholder.com/640x480.png/0088bb?text=illo', 'https://via.placeholder.com/640x480.png/001155?text=sapiente', '-28.712461', '-156.558075', 'Exercitationem cupiditate earum ut dolorem tempore autem.', 'Provident pariatur voluptatem ad voluptas aut et repudiandae.', 228, 338, 8, 'Lindsayland', 51, 'female', 7030, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(69, 139, 'https://via.placeholder.com/640x480.png/004477?text=voluptatibus', 'https://via.placeholder.com/640x480.png/00bb55?text=quaerat', '-25.226297', '-28.503126', 'Quo omnis aut magnam neque autem cum nostrum.', 'Ea dolores enim itaque ut voluptatem.', 536, 18, 25, 'South Deshaun', 18, 'male', 7582, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(70, 140, 'https://via.placeholder.com/640x480.png/00aabb?text=corrupti', 'https://via.placeholder.com/640x480.png/0066aa?text=facere', '-20.246357', '16.615563', 'Assumenda omnis non et aliquid ratione eveniet.', 'Qui velit id quas id.', 757, 670, 49, 'West Audramouth', 25, 'male', 1052, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(71, 141, 'https://via.placeholder.com/640x480.png/00ddbb?text=et', 'https://via.placeholder.com/640x480.png/004411?text=modi', '-45.053794', '1.784941', 'At vel sit doloremque.', 'Ad itaque rerum eum quia aut commodi autem magni.', 739, 829, 23, 'Lake Erickamouth', 53, 'female', 5299, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(72, 142, 'https://via.placeholder.com/640x480.png/00aa55?text=quam', 'https://via.placeholder.com/640x480.png/00ff22?text=quia', '-80.173507', '-41.56347', 'Ut qui occaecati quis sint explicabo vel.', 'Eos excepturi consequatur excepturi sint.', 440, 92, 14, 'Neilland', 32, 'male', 9742, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(73, 143, 'https://via.placeholder.com/640x480.png/005544?text=est', 'https://via.placeholder.com/640x480.png/000066?text=dolore', '5.700155', '13.812702', 'Assumenda eligendi maxime voluptatum inventore omnis assumenda sit.', 'Possimus sed non laborum totam.', 646, 387, 20, 'Whitneyborough', 18, 'female', 2418, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(74, 144, 'https://via.placeholder.com/640x480.png/0099ff?text=ipsam', 'https://via.placeholder.com/640x480.png/0099ee?text=ea', '-7.913052', '-141.530538', 'Sit voluptatem totam expedita modi.', 'Quam eligendi quas consequatur tempora impedit.', 95, 650, 66, 'Port Tyshawn', 44, 'female', 1924, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(75, 145, 'https://via.placeholder.com/640x480.png/00bbcc?text=explicabo', 'https://via.placeholder.com/640x480.png/008811?text=asperiores', '83.430194', '-157.684914', 'Dolorem ut quos officia maxime eum quibusdam porro pariatur.', 'Soluta consequatur quisquam aut qui illum voluptate.', 53, 910, 36, 'Kautzerhaven', 55, 'female', 7787, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(76, 146, 'https://via.placeholder.com/640x480.png/003366?text=aut', 'https://via.placeholder.com/640x480.png/004444?text=totam', '43.838301', '32.363384', 'Omnis delectus molestiae quidem sint magni.', 'Quis consequatur ab beatae et voluptate.', 79, 631, 55, 'Lindabury', 30, 'male', 9557, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(77, 147, 'https://via.placeholder.com/640x480.png/001177?text=neque', 'https://via.placeholder.com/640x480.png/00dd33?text=qui', '-27.244742', '164.814595', 'Officia optio quisquam facilis libero quia voluptatem.', 'Repudiandae sit voluptas in doloribus doloribus placeat facilis.', 780, 865, 81, 'North Eleazarburgh', 33, 'female', 5929, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(78, 148, 'https://via.placeholder.com/640x480.png/003311?text=iste', 'https://via.placeholder.com/640x480.png/00ff66?text=veniam', '-41.031017', '-80.981327', 'Eum aut a et perferendis.', 'Praesentium a iste aliquid dicta.', 438, 499, 93, 'Kelsiefort', 31, 'female', 5116, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(79, 149, 'https://via.placeholder.com/640x480.png/007733?text=eos', 'https://via.placeholder.com/640x480.png/006622?text=et', '60.874933', '-44.51637', 'Temporibus in sapiente quasi sint.', 'Necessitatibus et nulla omnis rerum sit labore quo.', 240, 834, 6, 'South Catalinaton', 52, 'female', 7431, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(80, 150, 'https://via.placeholder.com/640x480.png/002222?text=aspernatur', 'https://via.placeholder.com/640x480.png/00bb77?text=minus', '7.719158', '-72.60321', 'Quibusdam quaerat nihil quo.', 'Sit quia quos aut inventore nesciunt.', 174, 275, 36, 'Danykahaven', 22, 'male', 2843, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(81, 151, 'https://via.placeholder.com/640x480.png/00ff66?text=consequatur', 'https://via.placeholder.com/640x480.png/00ff99?text=impedit', '86.92501', '178.039278', 'Blanditiis corporis officia nemo ut.', 'Voluptatibus voluptatum nemo ullam magnam odio optio.', 392, 253, 42, 'Bodeville', 42, 'female', 8264, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(82, 152, 'https://via.placeholder.com/640x480.png/00bb99?text=quaerat', 'https://via.placeholder.com/640x480.png/00ff00?text=aut', '87.150654', '158.885883', 'Omnis et sed veritatis commodi.', 'Deleniti sunt fuga qui aut amet.', 887, 760, 35, 'Edythton', 50, 'male', 2220, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(83, 153, 'https://via.placeholder.com/640x480.png/00ee11?text=et', 'https://via.placeholder.com/640x480.png/0011dd?text=in', '56.33528', '-78.592545', 'Vel commodi enim ipsam sed cumque.', 'Veritatis animi omnis sapiente temporibus temporibus.', 535, 847, 41, 'Russelltown', 35, 'male', 1862, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(84, 154, 'https://via.placeholder.com/640x480.png/00ff99?text=aut', 'https://via.placeholder.com/640x480.png/0055bb?text=ut', '46.768308', '-59.383652', 'Molestiae laudantium molestiae sed hic sed at.', 'Qui ratione quas quae voluptas minus voluptatem.', 527, 430, 17, 'Swiftshire', 58, 'male', 1275, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(85, 155, 'https://via.placeholder.com/640x480.png/009955?text=dolores', 'https://via.placeholder.com/640x480.png/0000ff?text=distinctio', '-30.783947', '-175.06146', 'Hic porro quas non ut perspiciatis et qui.', 'Fugiat odio mollitia voluptatum.', 223, 428, 11, 'Hickleville', 56, 'female', 8634, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(86, 156, 'https://via.placeholder.com/640x480.png/00ccee?text=laborum', 'https://via.placeholder.com/640x480.png/007766?text=qui', '81.006898', '18.444642', 'Doloribus quia dignissimos illum et dolores.', 'Dolorum vitae perspiciatis consequuntur ipsam natus dignissimos.', 926, 435, 19, 'Nealview', 29, 'female', 9952, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(87, 157, 'https://via.placeholder.com/640x480.png/006622?text=itaque', 'https://via.placeholder.com/640x480.png/006688?text=sed', '-61.615882', '126.263343', 'Sunt corporis beatae molestiae.', 'Aut omnis voluptatem ut aspernatur tenetur aut qui.', 616, 799, 30, 'Lizziestad', 50, 'female', 5861, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(88, 158, 'https://via.placeholder.com/640x480.png/00ee77?text=atque', 'https://via.placeholder.com/640x480.png/000077?text=asperiores', '77.879054', '28.914032', 'Autem deserunt tenetur earum sed explicabo impedit.', 'Facere dolores voluptatem ab similique sed.', 51, 330, 39, 'North Andre', 22, 'female', 7265, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(89, 159, 'https://via.placeholder.com/640x480.png/003311?text=sint', 'https://via.placeholder.com/640x480.png/00cc77?text=ea', '-10.087734', '174.883814', 'Sapiente sequi et recusandae deserunt.', 'Molestias quia dolores autem et praesentium repellat culpa minima.', 25, 681, 14, 'Michealburgh', 56, 'female', 5561, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(90, 160, 'https://via.placeholder.com/640x480.png/005511?text=reiciendis', 'https://via.placeholder.com/640x480.png/00dd88?text=eos', '-49.060657', '-112.030448', 'Maxime alias est dolorum inventore earum aut.', 'Quaerat ipsum quidem sed sint quod cum.', 794, 924, 22, 'New Marquis', 21, 'female', 1816, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(91, 161, 'https://via.placeholder.com/640x480.png/0066cc?text=totam', 'https://via.placeholder.com/640x480.png/0055ee?text=qui', '-9.249224', '146.187774', 'Pariatur voluptatem praesentium et est debitis.', 'Doloremque voluptate eum non dicta modi voluptates eos ex.', 762, 921, 80, 'West Dulcebury', 33, 'female', 7397, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(92, 162, 'https://via.placeholder.com/640x480.png/0066aa?text=harum', 'https://via.placeholder.com/640x480.png/00ccee?text=error', '42.23784', '-44.247648', 'Nostrum ut illo rerum harum aut ipsam.', 'Quibusdam magni unde aut ducimus.', 2, 248, 66, 'Lake Mittieside', 51, 'male', 1629, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(93, 163, 'https://via.placeholder.com/640x480.png/0088ee?text=molestiae', 'https://via.placeholder.com/640x480.png/003377?text=sed', '-22.213311', '-11.968158', 'Qui eveniet voluptatibus sit fugit officiis et et.', 'Et minima neque dolor id doloremque officiis.', 907, 561, 84, 'Lake Ernestinastad', 18, 'male', 5816, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(94, 164, 'https://via.placeholder.com/640x480.png/001155?text=est', 'https://via.placeholder.com/640x480.png/00cc99?text=tempora', '2.755595', '-152.53781', 'Qui perspiciatis autem in non sapiente reiciendis id.', 'Debitis voluptate voluptatem consequatur illo.', 27, 988, 61, 'West Jonatan', 43, 'male', 2699, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(95, 165, 'https://via.placeholder.com/640x480.png/002299?text=ex', 'https://via.placeholder.com/640x480.png/000077?text=cum', '-59.67534', '-98.800723', 'Voluptatibus perferendis tenetur officiis ipsam.', 'Tempora aut consequuntur repellendus pariatur consequatur inventore id.', 919, 542, 100, 'West Jaquelin', 53, 'male', 1554, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(96, 166, 'https://via.placeholder.com/640x480.png/00cc66?text=similique', 'https://via.placeholder.com/640x480.png/00cc77?text=magnam', '7.214449', '-4.801151', 'Et fuga alias excepturi necessitatibus.', 'Voluptas facere explicabo deserunt aut ad non.', 987, 796, 65, 'Jeremiefurt', 24, 'female', 8716, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(97, 167, 'https://via.placeholder.com/640x480.png/0088aa?text=in', 'https://via.placeholder.com/640x480.png/00ee55?text=qui', '28.506881', '-168.624383', 'Ipsam officiis cupiditate nemo culpa tempora magnam.', 'Ipsa et qui doloribus id natus.', 17, 617, 28, 'Isaiasside', 46, 'male', 2131, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(98, 168, 'https://via.placeholder.com/640x480.png/0044aa?text=iusto', 'https://via.placeholder.com/640x480.png/001133?text=sit', '20.751617', '-28.145107', 'Et vel provident et.', 'Debitis rerum expedita quo sed ducimus velit ut.', 75, 796, 17, 'North Emanuelstad', 56, 'female', 8652, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(99, 169, 'https://via.placeholder.com/640x480.png/003388?text=reiciendis', 'https://via.placeholder.com/640x480.png/00bb88?text=minima', '-63.19917', '-60.585739', 'Ut a et ipsa necessitatibus et praesentium et.', 'Molestiae earum facilis fugit atque dolor similique.', 683, 135, 69, 'Maximillianstad', 27, 'male', 6992, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(100, 170, 'https://via.placeholder.com/640x480.png/0000cc?text=enim', 'https://via.placeholder.com/640x480.png/009944?text=dignissimos', '66.384657', '125.294806', 'Aperiam debitis explicabo qui dolorem pariatur cum.', 'Et vel dolor velit corporis.', 881, 562, 13, 'North Martine', 29, 'male', 9081, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(101, 171, 'https://via.placeholder.com/640x480.png/005599?text=id', 'https://via.placeholder.com/640x480.png/008899?text=aut', '59.332466', '-70.362767', 'Nobis quam temporibus recusandae sit.', 'Ipsa nostrum alias dolorum.', 206, 261, 25, 'East Nelliemouth', 33, 'male', 5116, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(102, 172, 'https://via.placeholder.com/640x480.png/003399?text=ea', 'https://via.placeholder.com/640x480.png/00cccc?text=quam', '-33.95502', '-78.680634', 'Et quam occaecati necessitatibus tempore animi voluptatum maiores et.', 'Quas voluptatem ab tenetur error eum.', 994, 312, 38, 'Hayesfurt', 27, 'female', 6691, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(103, 173, 'https://via.placeholder.com/640x480.png/00ffcc?text=quia', 'https://via.placeholder.com/640x480.png/0022aa?text=fugiat', '21.196868', '-122.737571', 'Temporibus aut ut eveniet quod illo.', 'Et nisi dicta tenetur.', 699, 16, 95, 'North Sarah', 29, 'female', 7797, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(104, 174, 'https://via.placeholder.com/640x480.png/003344?text=esse', 'https://via.placeholder.com/640x480.png/003300?text=occaecati', '69.881498', '33.874493', 'Quia porro ut voluptas non consequuntur et.', 'In adipisci sit autem.', 641, 916, 33, 'Hackettborough', 38, 'female', 6346, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(105, 175, 'https://via.placeholder.com/640x480.png/00aadd?text=inventore', 'https://via.placeholder.com/640x480.png/005555?text=magni', '-34.608024', '-12.327055', 'Assumenda temporibus maiores temporibus et natus repudiandae.', 'Id dicta recusandae pariatur corporis.', 503, 13, 78, 'Sipesmouth', 48, 'female', 7608, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(106, 176, 'https://via.placeholder.com/640x480.png/00ee00?text=non', 'https://via.placeholder.com/640x480.png/002211?text=debitis', '-53.768629', '-115.340244', 'Voluptatem possimus et numquam molestiae aut fuga id.', 'Nam eum adipisci qui est accusantium.', 699, 526, 81, 'Natburgh', 35, 'male', 2156, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(107, 177, 'https://via.placeholder.com/640x480.png/001177?text=vel', 'https://via.placeholder.com/640x480.png/0000cc?text=porro', '39.368732', '115.038858', 'Ipsum non sequi nam expedita aut fuga distinctio.', 'Aliquam voluptas et occaecati hic.', 737, 243, 7, 'Estefanialand', 27, 'female', 2930, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(108, 178, 'https://via.placeholder.com/640x480.png/00bb22?text=sint', 'https://via.placeholder.com/640x480.png/007766?text=quam', '67.9017', '73.909878', 'Atque labore et quis similique dolorem.', 'Repellat architecto molestias ad ex dolor ut.', 323, 784, 8, 'Port Jimmy', 49, 'female', 2253, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(109, 179, 'https://via.placeholder.com/640x480.png/0000ff?text=nisi', 'https://via.placeholder.com/640x480.png/00dd88?text=quis', '52.686904', '-43.808775', 'Facere placeat nostrum temporibus beatae.', 'Facere tempora illo repudiandae illum inventore ex.', 596, 37, 3, 'Lake Harley', 32, 'female', 7357, '2025-06-01 11:28:43', '2025-06-01 11:28:43'),
(110, 180, 'https://via.placeholder.com/640x480.png/003355?text=sint', 'https://via.placeholder.com/640x480.png/0099cc?text=itaque', '59.80466', '-172.597981', 'Inventore quasi voluptates officiis nemo ut.', 'Laboriosam accusamus aspernatur omnis rerum dolorum nisi.', 578, 582, 22, 'Lake Arashire', 19, 'female', 6423, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(111, 181, 'https://via.placeholder.com/640x480.png/00eeee?text=dolorum', 'https://via.placeholder.com/640x480.png/003399?text=quia', '34.591261', '-60.849913', 'Voluptatem soluta animi quia aut totam.', 'Doloremque facilis rerum quam quo.', 265, 481, 16, 'Kundehaven', 22, 'female', 8414, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(112, 182, 'https://via.placeholder.com/640x480.png/0044aa?text=ipsum', 'https://via.placeholder.com/640x480.png/007711?text=et', '-10.376124', '0.378334', 'Aliquam et aut et quia.', 'Et dolor nihil aspernatur ut.', 26, 230, 90, 'New Marcelle', 55, 'female', 9909, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(113, 183, 'https://via.placeholder.com/640x480.png/00aa33?text=voluptatibus', 'https://via.placeholder.com/640x480.png/000044?text=velit', '-79.592864', '-17.280074', 'Repellendus quia totam harum quis.', 'Vel corrupti inventore quasi.', 779, 995, 100, 'Port Earline', 32, 'female', 1879, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(114, 184, 'https://via.placeholder.com/640x480.png/000055?text=quo', 'https://via.placeholder.com/640x480.png/00cc44?text=dolores', '76.545799', '46.286709', 'Ab qui quia dolore dolores.', 'Nulla asperiores asperiores voluptatem quia mollitia omnis.', 325, 252, 18, 'East Justiceton', 33, 'female', 7645, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(115, 185, 'https://via.placeholder.com/640x480.png/00cc55?text=veritatis', 'https://via.placeholder.com/640x480.png/00ddee?text=architecto', '-9.217377', '46.198486', 'Quaerat quidem et quaerat et impedit ut.', 'Deleniti expedita sit beatae laboriosam omnis.', 791, 877, 49, 'New Allie', 22, 'female', 9457, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(116, 186, 'https://via.placeholder.com/640x480.png/007744?text=error', 'https://via.placeholder.com/640x480.png/0066cc?text=amet', '-38.178624', '52.591599', 'Praesentium explicabo tempore cumque velit.', 'Autem saepe error illum consequatur.', 264, 471, 6, 'Lake Shea', 34, 'male', 3500, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(117, 187, 'https://via.placeholder.com/640x480.png/008866?text=sed', 'https://via.placeholder.com/640x480.png/0099aa?text=omnis', '-37.606092', '-120.904687', 'Maiores consectetur eius voluptate facere odit voluptas.', 'Odio adipisci qui cumque.', 290, 313, 43, 'West Mathewtown', 26, 'male', 3569, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(118, 188, 'https://via.placeholder.com/640x480.png/0044ee?text=explicabo', 'https://via.placeholder.com/640x480.png/009933?text=iusto', '-13.037446', '-140.899084', 'Autem voluptas similique cumque rerum necessitatibus veniam sed.', 'Corrupti aut sed accusamus qui.', 226, 776, 54, 'New Kaleychester', 21, 'female', 2241, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(119, 189, 'https://via.placeholder.com/640x480.png/0088aa?text=enim', 'https://via.placeholder.com/640x480.png/0033cc?text=commodi', '-67.939958', '44.111112', 'Consequatur ut voluptatem magnam et earum et est quisquam.', 'Nihil harum expedita sit consequuntur corporis dolorum.', 713, 412, 41, 'Binsberg', 53, 'male', 3023, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(120, 190, 'https://via.placeholder.com/640x480.png/005577?text=voluptatem', 'https://via.placeholder.com/640x480.png/00ddff?text=animi', '12.455596', '119.382419', 'Explicabo quia molestias corrupti ea.', 'Et facilis laboriosam ut fuga.', 267, 69, 32, 'Lake Vernice', 38, 'male', 4896, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(121, 191, 'https://via.placeholder.com/640x480.png/00ee99?text=quisquam', 'https://via.placeholder.com/640x480.png/006688?text=maiores', '1.461864', '-171.324681', 'Laboriosam quod ut ipsa est laboriosam fuga.', 'Delectus sit omnis eveniet nostrum non.', 850, 41, 100, 'New Marcelle', 35, 'female', 8147, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(122, 192, 'https://via.placeholder.com/640x480.png/00bb22?text=nisi', 'https://via.placeholder.com/640x480.png/007744?text=dignissimos', '1.75866', '-59.937885', 'Consectetur iste odio tenetur architecto.', 'Velit expedita excepturi aliquid incidunt provident.', 85, 3, 68, 'Lake Nestorburgh', 27, 'male', 7802, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(123, 193, 'https://via.placeholder.com/640x480.png/00ee00?text=est', 'https://via.placeholder.com/640x480.png/00ff00?text=non', '62.189441', '-174.191522', 'Ut reiciendis atque eum commodi dolorem mollitia sed deleniti.', 'Sed unde corrupti id.', 141, 653, 43, 'New Yvetteborough', 18, 'female', 3790, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(124, 194, 'https://via.placeholder.com/640x480.png/0055ee?text=nesciunt', 'https://via.placeholder.com/640x480.png/00cc33?text=et', '-74.692078', '148.39182', 'Dolorem itaque iste dicta sed ratione et.', 'Suscipit voluptatibus totam quis omnis quos iure odit provident.', 530, 305, 6, 'Harrishaven', 19, 'male', 2344, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(125, 195, 'https://via.placeholder.com/640x480.png/00cc00?text=qui', 'https://via.placeholder.com/640x480.png/00ff00?text=nobis', '72.267118', '-178.590589', 'Ab dolorem dicta modi tenetur dolorem provident.', 'Quis saepe quaerat iure vel delectus amet.', 536, 935, 91, 'New Josefa', 26, 'female', 6811, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(126, 196, 'https://via.placeholder.com/640x480.png/00dd44?text=aut', 'https://via.placeholder.com/640x480.png/00ff22?text=ipsam', '-25.048455', '-62.001172', 'Dolorem nam non et voluptatem rem vero tempore vitae.', 'Vel sed laboriosam at reiciendis quis.', 69, 482, 18, 'Lake Braulio', 45, 'female', 9328, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(127, 197, 'https://via.placeholder.com/640x480.png/003322?text=sed', 'https://via.placeholder.com/640x480.png/007711?text=eos', '-10.097094', '85.299896', 'Reprehenderit vitae repellendus delectus velit tenetur natus.', 'Et labore mollitia nam asperiores.', 625, 725, 2, 'Stantonfurt', 60, 'female', 2208, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(128, 198, 'https://via.placeholder.com/640x480.png/005588?text=reiciendis', 'https://via.placeholder.com/640x480.png/003300?text=rerum', '4.590432', '-54.616092', 'Assumenda quia sit sed aspernatur blanditiis quasi odio.', 'Qui totam veritatis et.', 779, 74, 76, 'Stoltenbergchester', 43, 'male', 4457, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(129, 199, 'https://via.placeholder.com/640x480.png/00dd55?text=vel', 'https://via.placeholder.com/640x480.png/00dd33?text=tempora', '85.915106', '66.206727', 'Dolor fugit reiciendis dignissimos accusantium accusamus eum.', 'Est blanditiis molestiae incidunt qui ut tenetur quod corporis.', 826, 873, 84, 'Torpshire', 40, 'male', 9861, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(130, 200, 'https://via.placeholder.com/640x480.png/00ff22?text=omnis', 'https://via.placeholder.com/640x480.png/003322?text=aut', '-75.534143', '-114.702592', 'Est itaque non placeat aut itaque repellat.', 'Corrupti rerum qui perferendis rerum.', 742, 975, 99, 'Morarland', 20, 'female', 8592, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(131, 201, 'https://via.placeholder.com/640x480.png/001144?text=possimus', 'https://via.placeholder.com/640x480.png/00dd66?text=officia', '-64.978435', '-41.335206', 'Quos molestiae labore voluptas.', 'Dicta sed ut et est.', 945, 130, 92, 'Port Hester', 38, 'male', 9635, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(132, 202, 'https://via.placeholder.com/640x480.png/006688?text=quam', 'https://via.placeholder.com/640x480.png/00dd55?text=libero', '75.548894', '-50.873643', 'Culpa reiciendis dolor ut voluptas.', 'Sit enim eum quae veniam reprehenderit fugit dolorum.', 391, 660, 42, 'Julietchester', 52, 'male', 4166, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(133, 203, 'https://via.placeholder.com/640x480.png/0033ee?text=et', 'https://via.placeholder.com/640x480.png/0044cc?text=optio', '-57.999984', '2.738319', 'Et enim architecto vitae.', 'Consequuntur est velit magnam explicabo impedit fugit aut.', 275, 792, 42, 'Cassandraville', 53, 'male', 5924, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(134, 204, 'https://via.placeholder.com/640x480.png/001111?text=corporis', 'https://via.placeholder.com/640x480.png/00dd66?text=provident', '-72.535254', '-159.190668', 'Assumenda et quia sed id sapiente sit.', 'Aut numquam deserunt officiis qui.', 132, 505, 1, 'Leopoldbury', 22, 'female', 3627, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(135, 205, 'https://via.placeholder.com/640x480.png/00ee22?text=maiores', 'https://via.placeholder.com/640x480.png/00ee88?text=commodi', '-72.505354', '-12.412902', 'Repellat minus iure dolorum laudantium quibusdam.', 'Est itaque eos sunt temporibus est dicta doloremque magni.', 298, 26, 34, 'West Arloport', 27, 'female', 2268, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(136, 206, 'https://via.placeholder.com/640x480.png/00dd00?text=et', 'https://via.placeholder.com/640x480.png/003388?text=error', '-3.171635', '-8.042606', 'Ut et aut aut eligendi quia reprehenderit modi.', 'Nam expedita nemo inventore sunt quidem rem ut.', 687, 867, 61, 'Bertrandfort', 39, 'male', 2822, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(137, 207, 'https://via.placeholder.com/640x480.png/00ccaa?text=in', 'https://via.placeholder.com/640x480.png/0011aa?text=et', '84.159589', '26.358667', 'Sunt qui doloribus necessitatibus quam veniam.', 'Consequuntur deleniti quam est eius et excepturi et.', 185, 327, 14, 'Reillyberg', 19, 'female', 6924, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(138, 208, 'https://via.placeholder.com/640x480.png/009999?text=et', 'https://via.placeholder.com/640x480.png/0000dd?text=est', '89.466447', '19.128829', 'Sint aut sit dolores illum numquam rem perferendis.', 'Ut eum consectetur reiciendis dolore.', 433, 298, 57, 'Elsieberg', 30, 'male', 7008, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(139, 209, 'https://via.placeholder.com/640x480.png/00bb99?text=non', 'https://via.placeholder.com/640x480.png/00ee00?text=vitae', '48.164776', '-174.880435', 'Commodi culpa quisquam et eveniet et perspiciatis.', 'Ipsam laborum numquam magnam ex saepe sequi distinctio.', 891, 70, 6, 'Barrowsburgh', 56, 'female', 7838, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(140, 210, 'https://via.placeholder.com/640x480.png/000088?text=quia', 'https://via.placeholder.com/640x480.png/000011?text=provident', '82.922535', '-179.364286', 'Illum ea corporis ipsam qui.', 'Officia architecto est quisquam dignissimos et natus.', 365, 917, 32, 'East Lela', 37, 'female', 4010, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(141, 211, 'https://via.placeholder.com/640x480.png/008899?text=possimus', 'https://via.placeholder.com/640x480.png/00ff77?text=explicabo', '-76.91941', '135.191488', 'Incidunt molestiae blanditiis corrupti necessitatibus.', 'Quas quis ea animi dolor nulla dolorem.', 878, 929, 100, 'South Gilbertview', 45, 'female', 3230, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(142, 212, 'https://via.placeholder.com/640x480.png/005522?text=perferendis', 'https://via.placeholder.com/640x480.png/00ccaa?text=est', '-29.300312', '-108.648953', 'Delectus beatae voluptatum minima.', 'Nostrum autem in tenetur veniam.', 971, 594, 3, 'Bernardburgh', 54, 'female', 5514, '2025-06-01 11:28:44', '2025-06-01 11:28:44');
INSERT INTO `user_details` (`id`, `user_id`, `avatar`, `bg_cover`, `lat`, `long`, `bio`, `headline`, `followers_count`, `following_count`, `posts_count`, `location`, `age`, `gender`, `syndicate`, `created_at`, `updated_at`) VALUES
(143, 213, 'https://via.placeholder.com/640x480.png/00ee77?text=neque', 'https://via.placeholder.com/640x480.png/004499?text=dolorem', '-67.013307', '-104.652545', 'Nihil deserunt eum voluptatem.', 'Vitae quam voluptatum laboriosam itaque ut.', 98, 706, 16, 'Lake Kaileeport', 31, 'male', 4636, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(144, 214, 'https://via.placeholder.com/640x480.png/0055ee?text=omnis', 'https://via.placeholder.com/640x480.png/00bb77?text=recusandae', '80.269616', '76.694663', 'Voluptatem deserunt ipsa quaerat aliquam velit tempora.', 'At officia fuga quisquam et corporis.', 621, 840, 85, 'Metzhaven', 23, 'female', 2755, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(145, 215, 'https://via.placeholder.com/640x480.png/00dd66?text=et', 'https://via.placeholder.com/640x480.png/0033cc?text=natus', '-25.43335', '-2.88113', 'Cum minus fuga expedita minus possimus.', 'Sunt maiores iure aut et occaecati.', 559, 562, 66, 'South Martin', 58, 'female', 8937, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(146, 216, 'https://via.placeholder.com/640x480.png/006611?text=esse', 'https://via.placeholder.com/640x480.png/00eeff?text=laboriosam', '-80.578529', '117.286902', 'Voluptas voluptatibus qui aliquam sequi labore nemo.', 'Aut consequatur delectus amet tempora quis eius.', 877, 873, 57, 'New Devonport', 41, 'male', 4962, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(147, 217, 'https://via.placeholder.com/640x480.png/00dd55?text=cum', 'https://via.placeholder.com/640x480.png/0000bb?text=iusto', '-69.138578', '169.245581', 'Ducimus nihil fuga possimus voluptas quam quam.', 'Dicta quas delectus ipsum ab reiciendis sit nam.', 948, 463, 69, 'Michaelside', 26, 'male', 5709, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(148, 218, 'https://via.placeholder.com/640x480.png/00ee66?text=placeat', 'https://via.placeholder.com/640x480.png/00aa77?text=officia', '70.564575', '-126.374954', 'Natus perferendis sunt numquam dolorem neque beatae sed.', 'Quia nemo recusandae explicabo officiis.', 898, 936, 90, 'Destiniburgh', 36, 'male', 4394, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(149, 219, 'https://via.placeholder.com/640x480.png/0099ff?text=autem', 'https://via.placeholder.com/640x480.png/0044bb?text=omnis', '-49.965181', '-146.813438', 'Optio quod similique laborum sed nihil voluptatem dolor.', 'Illo facilis omnis voluptatem neque dolore iusto consequatur amet.', 119, 489, 86, 'East Orpha', 52, 'male', 3236, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(150, 220, 'https://via.placeholder.com/640x480.png/008855?text=fugiat', 'https://via.placeholder.com/640x480.png/00aacc?text=doloribus', '-8.803821', '30.136498', 'Molestiae voluptatem et praesentium ut quia.', 'Eligendi officia repellendus sit libero porro consequatur.', 983, 572, 93, 'Lake Terrillfort', 54, 'female', 4680, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(151, 221, 'https://via.placeholder.com/640x480.png/005555?text=voluptatem', 'https://via.placeholder.com/640x480.png/009911?text=totam', '4.479354', '-147.365286', 'Quos officiis perspiciatis omnis dolor praesentium.', 'Explicabo eius explicabo deleniti molestias eos.', 418, 97, 90, 'Zechariahtown', 56, 'female', 1135, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(152, 222, 'https://via.placeholder.com/640x480.png/00eebb?text=dolorum', 'https://via.placeholder.com/640x480.png/007744?text=ad', '44.133109', '29.904973', 'Nulla laboriosam exercitationem aut aut quia.', 'Vitae qui dolores ipsum voluptatem dolorum.', 184, 732, 36, 'Trantowville', 25, 'female', 7665, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(153, 223, 'https://via.placeholder.com/640x480.png/001188?text=quod', 'https://via.placeholder.com/640x480.png/0077dd?text=totam', '53.039359', '112.537941', 'Sed omnis mollitia delectus et quibusdam consequuntur qui.', 'Fuga voluptates amet et magnam ea cum qui.', 596, 674, 64, 'West Matt', 52, 'male', 4820, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(154, 224, 'https://via.placeholder.com/640x480.png/0066ee?text=provident', 'https://via.placeholder.com/640x480.png/00aa66?text=eos', '45.735318', '-158.183649', 'Adipisci excepturi aut sunt expedita rerum cupiditate aut.', 'Deserunt beatae quia qui consectetur.', 946, 308, 80, 'North Isabelport', 52, 'female', 2301, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(155, 225, 'https://via.placeholder.com/640x480.png/002299?text=hic', 'https://via.placeholder.com/640x480.png/000022?text=vel', '-59.435911', '92.159409', 'Ea voluptatum quas accusamus repudiandae excepturi.', 'Illum culpa nemo dolorem iure.', 511, 904, 34, 'North Audreyside', 47, 'male', 7005, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(156, 226, 'https://via.placeholder.com/640x480.png/00ccee?text=qui', 'https://via.placeholder.com/640x480.png/005599?text=rerum', '-29.311611', '45.690359', 'Dolor mollitia dolores eaque laborum ut.', 'Aut dolore adipisci qui temporibus maiores.', 533, 611, 63, 'Madisynchester', 57, 'male', 4157, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(157, 227, 'https://via.placeholder.com/640x480.png/00bb33?text=ab', 'https://via.placeholder.com/640x480.png/008877?text=inventore', '-75.86138', '-27.736407', 'Eaque molestiae voluptas quisquam qui deserunt non adipisci.', 'Nobis reprehenderit voluptatibus eos harum.', 645, 991, 91, 'Lindfurt', 48, 'female', 1828, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(158, 228, 'https://via.placeholder.com/640x480.png/004444?text=praesentium', 'https://via.placeholder.com/640x480.png/005511?text=distinctio', '4.561056', '149.165875', 'Quod aut ut et natus.', 'Rerum molestiae consequatur labore quam hic.', 302, 625, 83, 'Durganside', 42, 'male', 6214, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(159, 229, 'https://via.placeholder.com/640x480.png/00ddee?text=tenetur', 'https://via.placeholder.com/640x480.png/005599?text=ex', '-77.408801', '-97.493841', 'Ipsum qui officiis sunt est possimus nemo magni.', 'Officiis repellat ex voluptas ipsum.', 874, 334, 32, 'Jacobsborough', 56, 'female', 9335, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(160, 230, 'https://via.placeholder.com/640x480.png/007755?text=saepe', 'https://via.placeholder.com/640x480.png/0066ee?text=non', '17.756736', '-3.70386', 'Est odit consequuntur eos est.', 'Ipsum qui quibusdam sit et fuga nulla.', 839, 433, 20, 'Farrellton', 42, 'male', 7564, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(161, 231, 'https://via.placeholder.com/640x480.png/005511?text=occaecati', 'https://via.placeholder.com/640x480.png/001111?text=autem', '67.824362', '106.579077', 'Et illum animi omnis enim dolorem.', 'Nesciunt doloribus similique itaque minus omnis soluta deserunt.', 926, 491, 65, 'South Macie', 57, 'female', 7510, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(162, 232, 'https://via.placeholder.com/640x480.png/003355?text=impedit', 'https://via.placeholder.com/640x480.png/00bbbb?text=enim', '63.69084', '179.138588', 'Libero et quas laborum quae libero nulla.', 'Dolore voluptates magnam hic nemo tenetur inventore voluptatem.', 991, 196, 79, 'South Jackiefort', 26, 'female', 6978, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(163, 233, 'https://via.placeholder.com/640x480.png/007711?text=illo', 'https://via.placeholder.com/640x480.png/005533?text=pariatur', '46.229844', '74.064881', 'Animi fuga pariatur nisi ea facere accusamus qui.', 'Dolores odit veniam debitis ut eos beatae voluptatem nihil.', 40, 970, 97, 'Port Dorothea', 46, 'female', 1077, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(164, 234, 'https://via.placeholder.com/640x480.png/00cc55?text=non', 'https://via.placeholder.com/640x480.png/00cc88?text=incidunt', '-9.273019', '159.496297', 'Impedit illum reiciendis illum optio.', 'Ut enim animi qui placeat.', 953, 204, 78, 'Brooksport', 46, 'female', 4279, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(165, 235, 'https://via.placeholder.com/640x480.png/00ccaa?text=nesciunt', 'https://via.placeholder.com/640x480.png/008888?text=eum', '31.517858', '117.527551', 'Sit quasi fugit sed et et accusantium.', 'Iste aperiam minus omnis praesentium ut alias quis blanditiis.', 305, 505, 46, 'Port Selena', 24, 'male', 8881, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(166, 236, 'https://via.placeholder.com/640x480.png/003366?text=voluptates', 'https://via.placeholder.com/640x480.png/0011aa?text=qui', '73.175', '-178.320594', 'Qui ipsam maxime ipsum impedit.', 'Voluptates voluptatem voluptas iure voluptate impedit.', 300, 616, 60, 'Amayaside', 39, 'male', 6638, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(167, 237, 'https://via.placeholder.com/640x480.png/00ff55?text=maiores', 'https://via.placeholder.com/640x480.png/0066bb?text=voluptate', '-70.0084', '-28.160615', 'Accusantium ut tempora repellat dolorum nulla.', 'Itaque doloremque id dignissimos quam.', 350, 689, 32, 'Boscoland', 60, 'female', 7632, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(168, 238, 'https://via.placeholder.com/640x480.png/00cc11?text=a', 'https://via.placeholder.com/640x480.png/009944?text=provident', '5.110273', '-70.07103', 'Porro quae et earum quae esse.', 'Corrupti sequi nobis odit sequi nam facere.', 474, 579, 33, 'North Nadiaville', 27, 'male', 1465, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(169, 239, 'https://via.placeholder.com/640x480.png/0099ee?text=voluptatem', 'https://via.placeholder.com/640x480.png/002233?text=cumque', '76.32086', '-67.878994', 'Qui facilis necessitatibus quis dignissimos id culpa ex.', 'A aut molestiae provident sit nisi.', 764, 315, 67, 'Steuberfurt', 51, 'female', 7302, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(170, 240, 'https://via.placeholder.com/640x480.png/002255?text=architecto', 'https://via.placeholder.com/640x480.png/00dd44?text=qui', '2.080247', '2.736799', 'Ipsum suscipit unde exercitationem et repellat eligendi tempora.', 'Ea nesciunt asperiores aut ut dolore.', 378, 404, 17, 'South Denaburgh', 52, 'male', 3975, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(171, 241, 'https://via.placeholder.com/640x480.png/00ddcc?text=error', 'https://via.placeholder.com/640x480.png/0011aa?text=laboriosam', '-40.748601', '68.611774', 'Repellendus ut illo similique repudiandae autem.', 'Officiis in voluptas est magni ducimus.', 779, 848, 4, 'Welchborough', 47, 'male', 6734, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(172, 242, 'https://via.placeholder.com/640x480.png/004466?text=ratione', 'https://via.placeholder.com/640x480.png/004455?text=porro', '62.277044', '78.101936', 'Vero consequuntur voluptate corporis ratione reprehenderit.', 'Blanditiis tenetur voluptate rerum quam consectetur.', 880, 307, 22, 'Larkinhaven', 34, 'male', 4880, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(173, 243, 'https://via.placeholder.com/640x480.png/001133?text=ipsam', 'https://via.placeholder.com/640x480.png/000033?text=ipsam', '0.774663', '34.667562', 'Consequatur iste minus maxime omnis velit officiis.', 'Hic voluptas ut at nesciunt incidunt et.', 277, 366, 63, 'Bartellberg', 28, 'female', 4058, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(174, 244, 'https://via.placeholder.com/640x480.png/00eeee?text=id', 'https://via.placeholder.com/640x480.png/000055?text=ut', '-44.583456', '-29.958349', 'Eius ut odit aut eveniet qui qui.', 'Et quam magni voluptatem.', 775, 96, 72, 'Lennieside', 49, 'female', 9968, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(175, 245, 'https://via.placeholder.com/640x480.png/0000ff?text=sit', 'https://via.placeholder.com/640x480.png/002244?text=occaecati', '74.741333', '-113.086949', 'Nostrum delectus quia eos similique ipsam et id.', 'Suscipit atque autem in sunt sapiente.', 451, 80, 82, 'Juliusstad', 33, 'female', 8560, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(176, 246, 'https://via.placeholder.com/640x480.png/00dddd?text=ad', 'https://via.placeholder.com/640x480.png/00ddcc?text=repellat', '73.242863', '15.99099', 'Nihil hic quia repudiandae doloribus quis quae.', 'Ut ipsum rerum unde eaque dolor ad accusantium animi.', 542, 152, 34, 'Bauchhaven', 34, 'male', 9479, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(177, 247, 'https://via.placeholder.com/640x480.png/00dd22?text=corporis', 'https://via.placeholder.com/640x480.png/00eebb?text=doloribus', '57.71273', '85.330293', 'Ipsam non animi illo et minima laborum.', 'Dolorem recusandae eum odit laudantium culpa a qui.', 287, 541, 19, 'Andersonburgh', 42, 'female', 2811, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(178, 248, 'https://via.placeholder.com/640x480.png/00bbbb?text=dolores', 'https://via.placeholder.com/640x480.png/008899?text=perferendis', '15.779457', '64.824375', 'Velit voluptate et consectetur dolores voluptas qui.', 'Unde illum suscipit est.', 969, 507, 34, 'New Donatoborough', 50, 'female', 5288, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(179, 249, 'https://via.placeholder.com/640x480.png/00bb66?text=sit', 'https://via.placeholder.com/640x480.png/00ff88?text=quibusdam', '67.605058', '74.80239', 'Qui a amet qui sapiente soluta dolorem in.', 'In eos voluptatem qui enim dolorem facilis.', 713, 779, 30, 'Langworthland', 18, 'male', 6822, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(180, 250, 'https://via.placeholder.com/640x480.png/00aa66?text=qui', 'https://via.placeholder.com/640x480.png/004422?text=in', '-21.474837', '10.424673', 'Numquam a doloremque vero praesentium qui magnam quae.', 'Laborum sint molestiae minus nulla similique deleniti amet.', 526, 159, 52, 'Doviefort', 28, 'female', 5198, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(181, 251, 'https://via.placeholder.com/640x480.png/00ee00?text=amet', 'https://via.placeholder.com/640x480.png/009933?text=molestias', '-76.512149', '121.366523', 'Quidem maxime voluptas iste sit id quia.', 'Consequatur consectetur est est omnis nostrum.', 228, 733, 8, 'Quigleytown', 19, 'male', 3157, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(182, 252, 'https://via.placeholder.com/640x480.png/008866?text=ad', 'https://via.placeholder.com/640x480.png/006655?text=animi', '70.535644', '114.531416', 'Iste dolores a voluptas et.', 'Voluptates doloribus quod hic voluptates totam et cum ea.', 544, 610, 33, 'Port Aracely', 38, 'male', 9134, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(183, 253, 'https://via.placeholder.com/640x480.png/0066bb?text=in', 'https://via.placeholder.com/640x480.png/00dd00?text=commodi', '38.69696', '-159.73113', 'Omnis perferendis aut et ea itaque accusantium dolorem.', 'Quis ut deserunt ipsam quaerat.', 410, 283, 40, 'Port Aishafort', 23, 'female', 9736, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(184, 254, 'https://via.placeholder.com/640x480.png/009922?text=veritatis', 'https://via.placeholder.com/640x480.png/00ee00?text=harum', '-12.526528', '115.115394', 'Quibusdam sapiente quasi nulla omnis ut aut corrupti dignissimos.', 'Minima deserunt delectus perferendis ut.', 995, 303, 1, 'New Beaulahfurt', 53, 'male', 1735, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(185, 255, 'https://via.placeholder.com/640x480.png/00bbbb?text=labore', 'https://via.placeholder.com/640x480.png/008833?text=libero', '-14.454576', '19.976723', 'Unde maxime excepturi exercitationem voluptatem molestias quidem.', 'Omnis fugiat error aperiam et dolorem.', 510, 297, 63, 'Port Ara', 59, 'male', 3629, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(186, 256, 'https://via.placeholder.com/640x480.png/0022bb?text=dolorem', 'https://via.placeholder.com/640x480.png/008877?text=non', '-15.217234', '-112.658446', 'Iusto dignissimos et inventore mollitia.', 'Distinctio et deserunt consequatur nesciunt quam quibusdam est.', 499, 897, 40, 'West Ebbaberg', 21, 'female', 6941, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(187, 257, 'https://via.placeholder.com/640x480.png/00bb88?text=nesciunt', 'https://via.placeholder.com/640x480.png/006600?text=optio', '66.160803', '107.64305', 'Quod ipsa corrupti pariatur impedit eveniet est pariatur voluptates.', 'Quo ea tempora ut qui debitis cum est dolorem.', 859, 84, 72, 'Schulistfort', 48, 'male', 5854, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(188, 258, 'https://via.placeholder.com/640x480.png/003300?text=optio', 'https://via.placeholder.com/640x480.png/00cccc?text=necessitatibus', '-8.000228', '20.358861', 'Ea molestias expedita iusto quia suscipit possimus.', 'Tempore repellat velit atque aut.', 929, 256, 6, 'West Lavinastad', 57, 'male', 4101, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(189, 259, 'https://via.placeholder.com/640x480.png/00ffcc?text=impedit', 'https://via.placeholder.com/640x480.png/00eeee?text=enim', '32.530433', '-170.041024', 'Reprehenderit aut nemo odio.', 'Vitae numquam aut sed ipsum.', 254, 636, 3, 'West Opheliabury', 32, 'female', 2757, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(190, 260, 'https://via.placeholder.com/640x480.png/000055?text=consequuntur', 'https://via.placeholder.com/640x480.png/0000dd?text=voluptas', '-30.217402', '-9.928863', 'Rerum sequi facere voluptatibus.', 'Repudiandae suscipit occaecati qui perspiciatis corrupti.', 24, 746, 60, 'South Zion', 53, 'female', 7209, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(191, 261, 'https://via.placeholder.com/640x480.png/00ffee?text=atque', 'https://via.placeholder.com/640x480.png/009933?text=dicta', '20.222133', '48.61315', 'Et amet quam eos autem necessitatibus impedit.', 'Modi iusto recusandae sunt qui ullam consequatur molestiae.', 775, 585, 63, 'East Tellyburgh', 46, 'female', 8412, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(192, 262, 'https://via.placeholder.com/640x480.png/005599?text=non', 'https://via.placeholder.com/640x480.png/00aabb?text=est', '5.772632', '-39.032533', 'Excepturi natus perferendis at facere exercitationem at.', 'Perspiciatis debitis dolores eaque est.', 848, 702, 53, 'New Anais', 23, 'female', 2153, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(193, 263, 'https://via.placeholder.com/640x480.png/00eeff?text=vero', 'https://via.placeholder.com/640x480.png/002222?text=consequatur', '78.787769', '-27.542029', 'Consequuntur eaque deserunt voluptatibus.', 'Est rerum tempora porro quia eum eos aut.', 709, 722, 32, 'Doyleshire', 39, 'male', 3649, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(194, 264, 'https://via.placeholder.com/640x480.png/00ccbb?text=quod', 'https://via.placeholder.com/640x480.png/0011cc?text=quo', '75.344268', '-97.164087', 'Ducimus aliquid sit est ducimus est doloribus.', 'Cum recusandae accusamus saepe debitis rerum et.', 834, 565, 34, 'Port Marcelinaland', 54, 'female', 1215, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(195, 265, 'https://via.placeholder.com/640x480.png/0099cc?text=facilis', 'https://via.placeholder.com/640x480.png/004400?text=perspiciatis', '-42.251345', '94.277021', 'Eaque rerum accusantium debitis odit.', 'Officia dolorum ipsam vero qui quaerat.', 7, 965, 18, 'Spinkaport', 28, 'male', 2516, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(196, 266, 'https://via.placeholder.com/640x480.png/00eeee?text=ad', 'https://via.placeholder.com/640x480.png/005555?text=vel', '83.921285', '124.676091', 'Saepe nam veritatis molestiae perspiciatis laudantium.', 'Et temporibus aperiam neque necessitatibus dolor.', 279, 834, 63, 'West Sigurdside', 45, 'male', 8067, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(197, 267, 'https://via.placeholder.com/640x480.png/0000cc?text=quis', 'https://via.placeholder.com/640x480.png/00ee77?text=quis', '41.22935', '140.714166', 'Libero exercitationem nihil dignissimos placeat dolores qui.', 'Cupiditate perferendis eum enim esse placeat.', 883, 592, 40, 'O\'Connerstad', 31, 'male', 5888, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(198, 268, 'https://via.placeholder.com/640x480.png/005500?text=eos', 'https://via.placeholder.com/640x480.png/003366?text=ea', '31.753997', '40.76589', 'Autem laboriosam velit ipsam provident autem.', 'Autem recusandae quo enim praesentium itaque ipsum.', 670, 76, 70, 'Keshawnview', 50, 'male', 8555, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(199, 269, 'https://via.placeholder.com/640x480.png/00ff88?text=necessitatibus', 'https://via.placeholder.com/640x480.png/009911?text=voluptatem', '-54.723151', '73.523461', 'Eius nemo sint aut dolorem rerum at.', 'Est cum vel dolores voluptatibus.', 861, 737, 45, 'Jonasburgh', 19, 'male', 5134, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(200, 270, 'https://via.placeholder.com/640x480.png/00cc22?text=omnis', 'https://via.placeholder.com/640x480.png/004466?text=necessitatibus', '-9.28368', '174.307398', 'Quis modi quam aut.', 'Hic quo debitis sit aperiam.', 73, 828, 2, 'Lake Lafayette', 22, 'female', 9475, '2025-06-01 11:28:44', '2025-06-01 11:28:44'),
(201, 641, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, '2025-06-01 11:30:47', '2025-06-01 11:30:47'),
(202, 643, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, '2025-06-01 13:20:34', '2025-06-01 13:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_jobs`
--

CREATE TABLE `user_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_start_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_end_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_jobs`
--

INSERT INTO `user_jobs` (`id`, `user_id`, `title`, `description`, `price_start_at`, `price_end_at`, `location`, `lat`, `long`, `deadline`, `is_open`, `created_at`, `updated_at`) VALUES
(1, 461, 'Nam et quos iste impedit voluptatem ut.', 'Quo facere hic in sunt animi. Saepe officia consectetur quis mollitia in. Totam fugiat itaque dolorum libero aut ut.', '729.04', '2418.21', '8134 Hill Summit\nPort Frederique, MT 97041-8728', '-12.349429', '85.05574', '2013-01-06', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(2, 462, 'Labore id reiciendis ut omnis.', 'Eligendi delectus nostrum natus nostrum. Quasi ea qui voluptas incidunt ullam. Voluptatem eveniet qui officia rerum. Laudantium dicta beatae itaque ut.', '642.42', '2506.47', '5848 Hauck Causeway\nDorrisview, CO 40471-5806', '-25.26022', '1.874318', '2023-11-13', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(3, 463, 'In quas vel fuga vero vitae.', 'Voluptate aut aperiam repellendus nisi. Ea autem exercitationem sunt molestiae quaerat voluptas.', '838.86', '3351.08', '74032 Rodriguez Ford\nKeeblershire, MN 33569', '-45.882507', '-133.907212', '1987-12-03', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(4, 464, 'Nesciunt at et consequuntur et qui aspernatur est nesciunt.', 'Earum deleniti accusamus qui error sapiente. Et facilis cumque commodi aut ipsum iusto. Aut nisi accusamus esse ipsum. Sint illum optio et dolor autem iste ut.', '337.26', '4523.31', '98767 Ruthe Burg Suite 365\nKennediville, OH 01282-3015', '14.599777', '3.713683', '2002-07-11', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(5, 465, 'Est architecto perferendis aspernatur tenetur rerum.', 'Enim modi ut autem. Commodi quas quae aut deleniti iusto. Quam quasi error facere repudiandae laboriosam occaecati veritatis voluptates.', '382.75', '2497.33', '587 Irma Trafficway\nDaleberg, SC 10513-2522', '41.99663', '125.409492', '1970-07-21', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(6, 466, 'Sequi velit quis deserunt atque.', 'In aut ipsa sit nobis velit dolorem. Id modi nihil similique voluptas quaerat sed est. Et deleniti ut recusandae ullam et dolore. Optio dolorem velit sed dolores nobis iusto.', '524.11', '3686.37', '1254 Wolff Court\nEast Carolanne, UT 87101-6638', '-1.896819', '34.286967', '1996-08-15', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(7, 467, 'Perspiciatis aperiam porro eligendi.', 'Explicabo veniam nihil unde. Labore totam voluptatem et quis aliquid eum. Et ab suscipit ullam officiis deserunt enim.', '761.43', '4884.17', '45625 Dejon Crossroad Suite 297\nJasonberg, NJ 59606-9246', '-31.313241', '13.144743', '2013-04-27', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(8, 468, 'Ad tempore aut exercitationem.', 'Voluptas et ea aut maiores. Perferendis eligendi consequuntur ad vero ab. Nihil assumenda ut iusto doloremque laudantium in eius.', '892.8', '4473.1', '3437 Karlee Underpass\nLegroston, NV 72507', '-44.26398', '173.943078', '1983-10-25', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(9, 469, 'Est unde autem ab ex officiis et suscipit.', 'Labore dolor et impedit quam. Fuga sunt sint esse minus placeat saepe. Sit aliquam enim et eos.', '974.97', '3292.27', '8048 Jazlyn Dam Suite 531\nCarolinafurt, OK 99848-3080', '-35.914296', '-60.667914', '1987-04-26', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(10, 470, 'A adipisci accusantium ipsam aliquid modi id suscipit.', 'Ab exercitationem labore sit quas et delectus aut distinctio. Impedit earum eum ut ab similique labore. Adipisci reiciendis fugiat eum voluptatem voluptatem repellat.', '721.34', '3795.89', '516 Mraz Keys\nBriannemouth, SD 17959-5709', '-45.47322', '22.315093', '2016-01-18', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(11, 471, 'Rerum voluptates non ipsum eos.', 'Qui dolorem eum laudantium itaque error. Id sed accusamus rem et expedita. Eius explicabo expedita cumque doloribus ducimus accusamus sequi ducimus. Similique dignissimos unde officia.', '259.19', '4494.02', '761 Vidal Trail\nEast Stuart, GA 68618-7343', '8.750415', '30.956991', '2015-09-01', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(12, 472, 'Animi odio aperiam in cum enim sapiente laudantium.', 'Est voluptatem ut recusandae beatae nisi quasi. Veniam quia est optio dolore vel labore voluptas. Repellat sunt omnis similique numquam vel voluptas sapiente rerum.', '846.8', '3286.69', '75278 Fay Courts\nLinaland, OR 72317-7768', '82.919061', '-104.673309', '2000-03-28', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(13, 473, 'Aliquid voluptates eum sed mollitia.', 'Qui quia consequatur cupiditate. Aliquid blanditiis eaque voluptatum ducimus possimus cupiditate et. Recusandae molestiae voluptatum natus dolore aut. Culpa numquam et optio veniam rem eum eligendi commodi.', '191.71', '2307.54', '7830 Cremin Land Suite 392\nWest Lamar, OK 04922', '86.376308', '44.968252', '2001-01-17', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(14, 474, 'Et illo mollitia praesentium dolor odio soluta sapiente vel.', 'Voluptas numquam sunt consectetur libero minima perspiciatis illum. Numquam exercitationem veritatis doloremque eius.', '447.96', '3165.83', '6482 Misty Mall\nIgnatiusview, NC 87578-2941', '-8.198387', '-5.841228', '1982-02-03', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(15, 475, 'Provident labore minus odit facilis beatae.', 'Ea ea quasi et blanditiis cum perspiciatis. Accusantium omnis vel dignissimos. Maxime sunt molestias aut. Minima error facere eaque.', '852.78', '4397.21', '246 Donnelly Run Suite 880\nWest Giles, MI 90458-5477', '-76.993489', '-174.832544', '1990-05-30', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(16, 476, 'Repellat rem ducimus nemo alias ut eos ipsam.', 'Et deserunt est nisi occaecati et voluptas corrupti. Voluptas expedita autem sint. Ipsam doloremque molestias officiis vel. Non tenetur repellendus aperiam occaecati dolorum nulla aut.', '245.94', '1354.72', '193 Arnulfo Station Apt. 351\nKreigerville, RI 55298-6827', '64.052074', '-110.191523', '2010-07-23', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(17, 477, 'Cum blanditiis occaecati corporis et et nobis.', 'Ipsum aliquid consequatur atque voluptas. Enim ipsam in est quibusdam dolores. Consequatur quis perspiciatis ut voluptas qui aspernatur quisquam.', '193.51', '4992.09', '1147 Twila Plaza Apt. 504\nEricmouth, AK 17062', '87.570033', '-25.236491', '2018-01-09', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(18, 478, 'Nam velit quia excepturi officia velit atque.', 'Odio recusandae culpa possimus et possimus aperiam sed. Quibusdam reiciendis voluptas consequuntur ad laboriosam quam. Explicabo nostrum est neque officiis neque aut. Reprehenderit quibusdam architecto quae.', '275.94', '4014.46', '2430 Kuhn Avenue Apt. 633\nCroninmouth, WA 47492', '54.951099', '123.637214', '2001-04-02', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(19, 479, 'Harum velit sunt nihil eos eius et.', 'Deserunt provident repudiandae debitis illum rem blanditiis. Velit modi sequi ea qui. Facere omnis non fugiat dolore cum minima. Vitae aut nobis possimus nam optio.', '771.51', '4126.83', '6725 Rempel Cape Suite 387\nEffertzberg, WA 90176-1358', '-42.641281', '-104.007657', '1981-08-19', 1, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(20, 480, 'Temporibus labore quaerat iusto.', 'Odit est voluptas dolorem ut. Dignissimos earum unde ut illo vel.', '792.78', '2556.5', '993 Mayert Stream Suite 150\nWymanhaven, IN 82217', '-37.568889', '-176.163301', '1993-08-19', 0, '2025-06-01 11:29:00', '2025-06-01 11:29:00'),
(21, 641, 'sss', 'eqwe', '2232', '234', '', '38.993445154584855', '-77.06308264285326', '2025-06-13', 1, '2025-06-01 11:31:19', '2025-06-01 11:31:19'),
(22, 641, 'sss', 'asda', '2232', '234', 'das', '38.993445154584855', '-77.06308264285326', '2025-06-13', 1, '2025-06-01 11:33:08', '2025-06-01 11:33:08'),
(23, 641, 'asa', 'xzSD', '23', '205', 'das', '38.993445154584855', '-77.06308264285326', '2025-06-25', 1, '2025-06-01 11:33:36', '2025-06-01 11:33:36'),
(24, 641, 'sanaa test', 'aSAd', 'as', '1000', 'das', '38.993445154584855', '-77.06308264285326', '2025-06-01', 1, '2025-06-01 12:00:05', '2025-06-01 12:00:05'),
(25, 1, 'عايزين واحد لمصنع', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:39:53', '2025-06-01 13:39:53'),
(26, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:41:14', '2025-06-01 13:41:14'),
(27, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:44:30', '2025-06-01 13:44:30'),
(28, 1, 'الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:44:46', '2025-06-01 13:44:46'),
(29, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:46:14', '2025-06-01 13:46:14'),
(30, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:46:15', '2025-06-01 13:46:15'),
(31, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:46:16', '2025-06-01 13:46:16'),
(32, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:47:14', '2025-06-01 13:47:14'),
(33, 1, 'الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:47:37', '2025-06-01 13:47:37'),
(34, 1, 'الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:47:38', '2025-06-01 13:47:38'),
(35, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:51:12', '2025-06-01 13:51:12'),
(36, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:51:13', '2025-06-01 13:51:13'),
(37, 1, 'عايزين واحد لمصنع في النادي الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:51:14', '2025-06-01 13:51:14'),
(38, 1, 'الاهلي', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:51:19', '2025-06-01 13:51:19'),
(39, 1, 'امام عاشور', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:55:46', '2025-06-01 13:55:46'),
(40, 1, 'اما/م عاشور', 'هيقف علي باب المصنع كل باكو عروسه يطلع يزغرطلوه', '3000', '5000', 'كفر الصرصار', '31.134242424234', '31.35678765434', '2026-04-12', 1, '2025-06-01 13:56:17', '2025-06-01 13:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_sliders`
--

CREATE TABLE `user_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_types`
--

CREATE TABLE `user_sub_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_sub_types`
--

INSERT INTO `user_sub_types` (`id`, `name`, `user_type_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"ab\",\"ar\":\"atque\"}', 11, 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(2, '{\"en\":\"nihil\",\"ar\":\"explicabo\"}', 12, 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(3, '{\"en\":\"perspiciatis\",\"ar\":\"dolore\"}', 13, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(4, '{\"en\":\"dolore\",\"ar\":\"quibusdam\"}', 14, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(5, '{\"en\":\"rem\",\"ar\":\"unde\"}', 15, 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(6, '{\"en\":\"ullam\",\"ar\":\"fugiat\"}', 16, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(7, '{\"en\":\"quo\",\"ar\":\"dicta\"}', 17, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(8, '{\"en\":\"quis\",\"ar\":\"quasi\"}', 18, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(9, '{\"en\":\"ut\",\"ar\":\"labore\"}', 19, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(10, '{\"en\":\"vel\",\"ar\":\"libero\"}', 20, 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"commodi\",\"ar\":\"in\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(2, '{\"en\":\"odio\",\"ar\":\"praesentium\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(3, '{\"en\":\"et\",\"ar\":\"esse\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(4, '{\"en\":\"sunt\",\"ar\":\"perferendis\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(5, '{\"en\":\"deleniti\",\"ar\":\"est\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(6, '{\"en\":\"autem\",\"ar\":\"aperiam\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(7, '{\"en\":\"occaecati\",\"ar\":\"aut\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(8, '{\"en\":\"explicabo\",\"ar\":\"cum\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(9, '{\"en\":\"quos\",\"ar\":\"ut\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(10, '{\"en\":\"saepe\",\"ar\":\"fugiat\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(11, '{\"en\":\"qui\",\"ar\":\"nihil\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(12, '{\"en\":\"odit\",\"ar\":\"totam\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(13, '{\"en\":\"quas\",\"ar\":\"quaerat\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(14, '{\"en\":\"iure\",\"ar\":\"voluptas\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(15, '{\"en\":\"molestias\",\"ar\":\"earum\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(16, '{\"en\":\"ab\",\"ar\":\"libero\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(17, '{\"en\":\"assumenda\",\"ar\":\"tenetur\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(18, '{\"en\":\"sed\",\"ar\":\"alias\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(19, '{\"en\":\"laborum\",\"ar\":\"voluptatem\"}', 0, '2025-06-01 11:28:27', '2025-06-01 11:28:27'),
(20, '{\"en\":\"magnam\",\"ar\":\"beatae\"}', 1, '2025-06-01 11:28:27', '2025-06-01 11:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `credit` double NOT NULL,
  `debit` double NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `admins_code_unique` (`code`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `announces`
--
ALTER TABLE `announces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announces_user_id_foreign` (`user_id`),
  ADD KEY `announces_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_replies_user_id_foreign` (`user_id`),
  ADD KEY `comment_replies_post_comment_id_foreign` (`post_comment_id`),
  ADD KEY `comment_replies_post_reply_id_foreign` (`post_reply_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_us_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_tokens_device_token_unique` (`device_token`),
  ADD KEY `device_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `dirty_words`
--
ALTER TABLE `dirty_words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dirty_words_word_unique` (`word`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_category_id_foreign` (`category_id`);

--
-- Indexes for table `event_followers`
--
ALTER TABLE `event_followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_followers_qrcode_unique` (`qrcode`),
  ADD KEY `event_followers_user_id_foreign` (`user_id`),
  ADD KEY `event_followers_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_requests`
--
ALTER TABLE `event_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_requests_user_id_foreign` (`user_id`),
  ADD KEY `event_requests_event_id_foreign` (`event_id`),
  ADD KEY `event_requests_event_requirement_id_foreign` (`event_requirement_id`);

--
-- Indexes for table `event_requirements`
--
ALTER TABLE `event_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_requirements_event_id_foreign` (`event_id`),
  ADD KEY `event_requirements_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followers_follower_id_foreign` (`follower_id`),
  ADD KEY `followers_followed_id_foreign` (`followed_id`);

--
-- Indexes for table `gigs`
--
ALTER TABLE `gigs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gigs_user_id_foreign` (`user_id`),
  ADD KEY `gigs_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `gigs_category_id_foreign` (`category_id`);

--
-- Indexes for table `gig_requests`
--
ALTER TABLE `gig_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gig_requests_user_id_foreign` (`user_id`),
  ADD KEY `gig_requests_gig_id_foreign` (`gig_id`);

--
-- Indexes for table `http_loggers`
--
ALTER TABLE `http_loggers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

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
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_reactions_user_id_foreign` (`user_id`),
  ADD KEY `post_reactions_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_shares`
--
ALTER TABLE `post_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_shares_user_id_foreign` (`user_id`),
  ADD KEY `post_shares_post_id_foreign` (`post_id`);

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
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_name_unique` (`name`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `unwanted_users`
--
ALTER TABLE `unwanted_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unwanted_users_user_id_foreign` (`user_id`),
  ADD KEY `unwanted_users_unwanted_user_id_foreign` (`unwanted_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_user_sub_type_id_foreign` (`user_sub_type_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_jobs`
--
ALTER TABLE `user_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_jobs_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_sliders`
--
ALTER TABLE `user_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_sliders_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_sub_types`
--
ALTER TABLE `user_sub_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_sub_types_user_type_id_foreign` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_types_name_unique` (`name`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announces`
--
ALTER TABLE `announces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dirty_words`
--
ALTER TABLE `dirty_words`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `event_followers`
--
ALTER TABLE `event_followers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `event_requests`
--
ALTER TABLE `event_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `event_requirements`
--
ALTER TABLE `event_requirements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `gigs`
--
ALTER TABLE `gigs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `gig_requests`
--
ALTER TABLE `gig_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `http_loggers`
--
ALTER TABLE `http_loggers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `post_reactions`
--
ALTER TABLE `post_reactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_shares`
--
ALTER TABLE `post_shares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `unwanted_users`
--
ALTER TABLE `unwanted_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=644;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `user_jobs`
--
ALTER TABLE `user_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_sliders`
--
ALTER TABLE `user_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sub_types`
--
ALTER TABLE `user_sub_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announces`
--
ALTER TABLE `announces`
  ADD CONSTRAINT `announces_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_post_comment_id_foreign` FOREIGN KEY (`post_comment_id`) REFERENCES `post_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_post_reply_id_foreign` FOREIGN KEY (`post_reply_id`) REFERENCES `comment_replies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD CONSTRAINT `device_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_followers`
--
ALTER TABLE `event_followers`
  ADD CONSTRAINT `event_followers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_requests`
--
ALTER TABLE `event_requests`
  ADD CONSTRAINT `event_requests_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_requests_event_requirement_id_foreign` FOREIGN KEY (`event_requirement_id`) REFERENCES `event_requirements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_requirements`
--
ALTER TABLE `event_requirements`
  ADD CONSTRAINT `event_requirements_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_requirements_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_followed_id_foreign` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `followers_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gigs`
--
ALTER TABLE `gigs`
  ADD CONSTRAINT `gigs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gigs_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gigs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gig_requests`
--
ALTER TABLE `gig_requests`
  ADD CONSTRAINT `gig_requests_gig_id_foreign` FOREIGN KEY (`gig_id`) REFERENCES `gigs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gig_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD CONSTRAINT `post_reactions_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_reactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_shares`
--
ALTER TABLE `post_shares`
  ADD CONSTRAINT `post_shares_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unwanted_users`
--
ALTER TABLE `unwanted_users`
  ADD CONSTRAINT `unwanted_users_unwanted_user_id_foreign` FOREIGN KEY (`unwanted_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unwanted_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_sub_type_id_foreign` FOREIGN KEY (`user_sub_type_id`) REFERENCES `user_sub_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_jobs`
--
ALTER TABLE `user_jobs`
  ADD CONSTRAINT `user_jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sliders`
--
ALTER TABLE `user_sliders`
  ADD CONSTRAINT `user_sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sub_types`
--
ALTER TABLE `user_sub_types`
  ADD CONSTRAINT `user_sub_types_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
