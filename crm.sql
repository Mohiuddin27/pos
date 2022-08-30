-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 10:55 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', 'superadmin', NULL, '$2y$10$/Bi2iChGCQohX.4sq7abk..C0BbvC7XfTdRXhTfV7eJbZERbTKn9m', NULL, '2022-08-03 23:50:32', '2022-08-03 23:50:32'),
(2, 'Md Mohiuddin', 'sobuj@gmail.com', 'mohiuddin', NULL, '$2y$10$BrR5tJ8FJgrt6UTOxSOY9ub10a5TwjTxAfWbHHFSbrRHGLSlsYIny', NULL, '2022-08-04 03:27:04', '2022-08-04 03:27:04');

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
(6, '2022_07_20_151605_create_parties_table', 2),
(7, '2022_07_21_165352_create_partytypes_table', 3),
(8, '2022_07_22_120434_create_partytypes_table', 4),
(9, '2022_07_22_134331_create_parties_table', 5),
(37, '2014_10_12_000000_create_users_table', 6),
(38, '2014_10_12_100000_create_password_resets_table', 6),
(39, '2014_10_12_200000_add_two_factor_columns_to_users_table', 6),
(40, '2019_08_19_000000_create_failed_jobs_table', 6),
(41, '2019_12_14_000001_create_personal_access_tokens_table', 6),
(42, '2022_07_24_140949_create_parties_table', 6),
(43, '2022_07_24_154008_create_partytypes_table', 6),
(44, '2022_08_02_052024_create_permission_tables', 6),
(45, '2022_08_04_054627_create_admins_table', 7),
(46, '2022_08_05_122859_create_parties_table', 8),
(47, '2022_08_10_165652_create_product_units_table', 9),
(48, '2022_08_10_165908_create_products_table', 10),
(49, '2022_08_11_042825_create_product_categories_table', 11),
(50, '2022_08_11_042935_create_product_brands_table', 11),
(51, '2022_08_11_120533_create_products_table', 12),
(52, '2022_08_17_041521_create_warehouses_table', 13),
(53, '2022_08_17_042540_create_warehouses_table', 14);

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
(2, 'App\\Models\\Admin', 1),
(26, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternative_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_limit` decimal(8,2) DEFAULT NULL,
  `current_due` decimal(8,2) NOT NULL DEFAULT 0.00,
  `opening_due` decimal(8,2) NOT NULL DEFAULT 0.00,
  `party_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` date DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `contact_person`, `email`, `mobile_no`, `alternative_mobile_no`, `address`, `district`, `country`, `credit_limit`, `current_due`, `opening_due`, `party_type`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Hasan Ali', 'Hasan Ali', 'ali@gmail.com', '01890123456', '01890123456', 'Dhaka,Bangladesh', 'Dhaka', 'Bangladesh', '2000.00', '0.00', '0.00', '2', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-05 06:30:37', '2022-08-05 06:30:37'),
(2, 'Naziul Hasan', 'Naziul Hasan', 'n@gmail.com', '01670654321', '01670654321', 'Comilla,Bangladesh', 'Comilla', 'Bangladesh', '1000.00', '0.00', '0.00', '2', 1, 1, 1, '2022-08-12', 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-06 16:27:34', '2022-08-12 09:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `partytypes`
--

CREATE TABLE `partytypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` date DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partytypes`
--

INSERT INTO `partytypes` (`id`, `type_name`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'walking', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-04 08:56:32', '2022-08-04 08:56:32'),
(2, 'Regular', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-04 10:26:34', '2022-08-04 10:26:34'),
(3, 'Customer', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-04 10:26:54', '2022-08-04 10:26:54'),
(4, 'Supplier', 1, 1, NULL, NULL, NULL, NULL, 'Inactive', 'No', '2022-08-04 10:27:26', '2022-08-04 23:59:04');

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
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2022-08-02 22:59:28', '2022-08-02 22:59:28'),
(2, 'partytype.index', 'admin', 'partytype', '2022-08-02 22:59:28', '2022-08-02 22:59:28'),
(3, 'party.type.create', 'admin', 'partytype', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(4, 'partytype.edit', 'admin', 'partytype', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(5, 'partytype.update', 'admin', 'partytype', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(6, 'partytype.temporary.delete', 'admin', 'partytype', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(7, 'party.index', 'admin', 'party', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(8, 'party.create', 'admin', 'party', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(9, 'party.view', 'admin', 'party', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(10, 'party.edit', 'admin', 'party', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(11, 'party.update', 'admin', 'party', '2022-08-02 22:59:29', '2022-08-02 22:59:29'),
(12, 'party.temporary.delete', 'admin', 'party', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(13, 'recycle.bin', 'admin', 'recycle', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(14, 'party.trash', 'admin', 'recycle', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(15, 'party.restore', 'admin', 'recycle', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(16, 'party.permanently.delete', 'admin', 'recycle', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(17, 'admin.create', 'admin', 'admin', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(18, 'admin.view', 'admin', 'admin', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(19, 'admin.edit', 'admin', 'admin', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(20, 'admin.delete', 'admin', 'admin', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(21, 'admin.approve', 'admin', 'admin', '2022-08-02 22:59:30', '2022-08-02 22:59:30'),
(22, 'role.create', 'admin', 'role', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(23, 'role.view', 'admin', 'role', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(24, 'role.edit', 'admin', 'role', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(25, 'role.delete', 'admin', 'role', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(26, 'role.update', 'admin', 'role', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(27, 'profile.view', 'admin', 'profile', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(28, 'profile.edit', 'admin', 'profile', '2022-08-02 22:59:31', '2022-08-02 22:59:31'),
(29, 'permission.index', 'admin', 'permission', '2022-08-05 08:23:51', '2022-08-05 08:23:51'),
(30, 'permission.create', 'admin', 'permission', '2022-08-05 09:32:33', '2022-08-05 09:32:33'),
(31, 'permission.edit', 'admin', 'permission', '2022-08-05 09:33:02', '2022-08-05 09:33:02'),
(32, 'permission.update', 'admin', 'permission', '2022-08-05 09:33:37', '2022-08-05 09:33:37'),
(34, 'permission.delete', 'admin', 'permission', '2022-08-05 11:44:45', '2022-08-05 11:44:45'),
(36, 'blog.create', 'admin', 'blog', '2022-08-06 11:14:14', '2022-08-06 11:14:14');

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
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
  `opening_stock` int(11) NOT NULL,
  `remainder_quantity` int(11) NOT NULL DEFAULT 0,
  `purchase_price` decimal(12,2) NOT NULL,
  `sale_price` decimal(12,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `sale_quantity` int(11) NOT NULL DEFAULT 0,
  `total_purchase_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_sale_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remaining_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `purchase_quantity` int(11) DEFAULT NULL,
  `type` enum('regular','serialize','service') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'regular',
  `stock_check` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `items_in_box` int(11) DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `image`, `barcode_no`, `barcode`, `category_id`, `brand_id`, `unit_id`, `opening_stock`, `remainder_quantity`, `purchase_price`, `sale_price`, `discount`, `notes`, `model_no`, `current_stock`, `sale_quantity`, `total_purchase_price`, `total_sale_price`, `remaining_price`, `purchase_quantity`, `type`, `stock_check`, `items_in_box`, `status`, `is_deleted`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'PRIMO ZX4', NULL, 'a33cbd6c22b9514c2a214bd92ed391ad.jpg', NULL, NULL, 6, 7, 10, 500, 234, '20000.00', '25000.00', NULL, 'Walton Primo 8 offers a full package under budget', 'ZX4', 0, 0, '0.00', '0.00', '0.00', NULL, 'regular', 'Yes', 400, 'Active', 'No', 1, NULL, NULL, NULL, NULL, NULL, '2022-08-11 23:30:46', '2022-08-11 23:30:46'),
(7, 'Apple iPhone', NULL, '17e54dcddd1930959b97e8d02bd002bc.jpg', NULL, NULL, 6, 6, 10, 30, 30, '30000.00', '35000.00', NULL, 'With the wide display', '11', 0, 0, '0.00', '0.00', '0.00', NULL, 'regular', 'Yes', 30, 'Active', 'No', 1, NULL, NULL, NULL, NULL, NULL, '2022-08-11 23:33:56', '2022-08-11 23:33:56'),
(8, 'Iphone', NULL, '216eb5905f54a4a390efcda576802deb.jpg', NULL, NULL, 6, 6, 10, 234, 32, '230000.00', '300000.00', NULL, 'Well', 'i-13', 0, 0, '0.00', '0.00', '0.00', NULL, 'regular', 'Yes', 234, 'Active', 'No', 1, 1, 1, '2022-08-12 15:29:05', 1, '2022-08-12 15:07:15', '2022-08-12 03:59:17', '2022-08-12 09:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` date DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `name`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(4, 'Toys R Us', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:09:37', '2022-08-11 23:09:37'),
(5, 'Amazon', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:09:57', '2022-08-11 23:09:57'),
(6, 'Apple', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:10:09', '2022-08-11 23:10:09'),
(7, 'Walton', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:10:23', '2022-08-11 23:10:23'),
(8, 'testtwo', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:44:22', '2022-08-12 11:45:22'),
(9, 'test', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:51:23', '2022-08-12 11:52:01'),
(10, 'testone', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 12:00:55', '2022-08-12 12:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` date DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 'Apps & Games', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:06:56', '2022-08-11 23:06:56'),
(4, 'Clothing, Shoes and Jewelry', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:07:15', '2022-08-11 23:07:15'),
(5, 'Computers', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:07:26', '2022-08-11 23:07:26'),
(6, 'Electronics', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:07:43', '2022-08-11 23:07:43'),
(7, 'Sports & Outdoors', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:07:58', '2022-08-11 23:07:58'),
(8, 'Tools & Home Improvement', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:08:09', '2022-08-11 23:08:09'),
(9, 'Toys & Games', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:08:21', '2022-08-11 23:08:21'),
(10, 'test', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:43:02', '2022-08-12 11:43:40'),
(11, 'test', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:50:04', '2022-08-12 11:50:34'),
(12, 'test', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:59:46', '2022-08-12 12:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_units`
--

CREATE TABLE `product_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` date DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_units`
--

INSERT INTO `product_units` (`id`, `name`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(6, 'Kg', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:20:03', '2022-08-11 23:20:03'),
(7, 'Meter', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:20:16', '2022-08-11 23:20:16'),
(8, 'Liter', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:20:27', '2022-08-11 23:20:27'),
(9, 'Nos', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:21:31', '2022-08-11 23:21:31'),
(10, 'Piece', 1, NULL, NULL, NULL, NULL, NULL, 'Active', 'No', '2022-08-11 23:21:52', '2022-08-11 23:21:52'),
(11, 'test', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:45:50', '2022-08-12 12:01:53'),
(12, 'test', 1, 1, NULL, NULL, 1, '2022-08-12', 'Inactive', 'Yes', '2022-08-12 11:52:18', '2022-08-12 11:53:13');

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
(2, 'superadmin', 'admin', '2022-08-02 22:59:28', '2022-08-02 22:59:28'),
(15, 'admin', 'admin', '2022-08-06 00:19:58', '2022-08-06 00:19:58'),
(26, 'test', 'admin', '2022-08-08 12:04:42', '2022-08-08 12:04:42');

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
(1, 2),
(1, 15),
(1, 26),
(2, 2),
(2, 15),
(2, 26),
(3, 2),
(3, 15),
(3, 26),
(4, 2),
(4, 15),
(4, 26),
(5, 2),
(5, 15),
(5, 26),
(6, 2),
(6, 15),
(6, 26),
(7, 2),
(7, 15),
(7, 26),
(8, 2),
(8, 26),
(9, 2),
(9, 15),
(9, 26),
(10, 2),
(10, 15),
(11, 2),
(11, 15),
(11, 26),
(12, 2),
(13, 2),
(13, 15),
(14, 2),
(14, 15),
(15, 2),
(15, 15),
(16, 2),
(16, 15),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(23, 15),
(24, 2),
(24, 15),
(25, 2),
(25, 15),
(26, 2),
(26, 15),
(27, 2),
(27, 15),
(27, 26),
(28, 2),
(28, 15),
(28, 26),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(34, 2),
(36, 2),
(36, 15);

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
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah zahid joy', 'abdullahzahidjoy@gmail.com', NULL, '$2y$10$XA1xRrAwob6HOOA4..v0VO01S3ncu.5XNVQINgW0yJ9bSL3d9ID/S', NULL, NULL, NULL, '2022-08-02 22:59:28', '2022-08-02 22:59:28'),
(2, 'Md Mohiuddin sobuj', 'sobuj@gmail.com', NULL, '$2y$10$2wVoVbaPjYMBC0E0m2AcEuRh1j1mbN1KBReD9eFdcxLkFLJKb2o.e', NULL, NULL, NULL, '2022-08-03 10:34:27', '2022-08-03 22:55:37'),
(4, 'test', 'test@gmail.com', NULL, '$2y$10$X1yoGhVJ.hpbitJiUFS1VOfBLDLtzgSw1vGVN.eVHkI8iaP7F/tci', NULL, NULL, NULL, '2022-08-05 22:51:38', '2022-08-05 22:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `minimum_stock` int(11) NOT NULL DEFAULT 0,
  `maximum_stock` int(11) NOT NULL DEFAULT 0,
  `transfer_id` bigint(20) DEFAULT NULL,
  `status` enum('Inactive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_by` bigint(20) UNSIGNED DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `product_id`, `current_stock`, `minimum_stock`, `maximum_stock`, `transfer_id`, `status`, `is_deleted`, `created_by`, `updated_by`, `restored_by`, `restored_at`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'test', 5, 100, 20, 200, 1, 'Active', 'No', 1, NULL, NULL, NULL, NULL, NULL, '2022-08-16 23:19:23', '2022-08-16 23:19:23'),
(4, 'test_two', 5, 50, 10, 200, 2, 'Active', 'No', 1, NULL, NULL, NULL, NULL, NULL, '2022-08-16 23:42:35', '2022-08-16 23:42:35'),
(5, 'test_three', 8, 70, 20, 100, 3, 'Active', 'No', 1, 1, NULL, NULL, NULL, NULL, '2022-08-16 23:43:07', '2022-08-16 23:47:30'),
(6, 'test_four', 5, 43, 12, 90, 4, 'Active', 'No', 1, 1, NULL, NULL, NULL, NULL, '2022-08-16 23:48:11', '2022-08-16 23:53:38'),
(7, 'name', 7, 34, 2, 345, 5, 'Inactive', 'Yes', 1, NULL, NULL, NULL, 1, '2022-08-17 05:56:38', '2022-08-16 23:56:29', '2022-08-16 23:56:38'),
(8, 'test_five', 8, 200, 10, 300, 6, 'Inactive', 'Yes', 1, 1, NULL, NULL, 1, '2022-08-17 05:58:46', '2022-08-16 23:58:06', '2022-08-16 23:58:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parties_email_unique` (`email`),
  ADD UNIQUE KEY `parties_mobile_no_unique` (`mobile_no`),
  ADD UNIQUE KEY `parties_alternative_mobile_no_unique` (`alternative_mobile_no`);

--
-- Indexes for table `partytypes`
--
ALTER TABLE `partytypes`
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
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_units`
--
ALTER TABLE `product_units`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partytypes`
--
ALTER TABLE `partytypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
