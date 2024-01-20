-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 02:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profiles`
--

CREATE TABLE `admin_profiles` (
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `profile_user_id` int(11) NOT NULL,
  `profile_employee_id` int(11) NOT NULL,
  `profile_user_image` varchar(255) NOT NULL,
  `profile_user_father_name` varchar(255) NOT NULL,
  `profile_user_mother_name` varchar(255) NOT NULL,
  `profile_user_gender` varchar(255) NOT NULL,
  `profile_user_address` text NOT NULL,
  `profile_user_dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_profiles`
--

INSERT INTO `admin_profiles` (`profile_id`, `profile_user_id`, `profile_employee_id`, `profile_user_image`, `profile_user_father_name`, `profile_user_mother_name`, `profile_user_gender`, `profile_user_address`, `profile_user_dob`, `created_at`, `updated_at`) VALUES
(4, 1, 100001, 'public/files/admin_images/1-1698759661.jpg', 'ASM Abdul Kader', 'Sabina Yeasmin', 'Male', 'Dhaka,Nikunja', '1998-03-01', '2023-07-19 00:39:54', '2023-10-31 13:41:01'),
(7, 2, 2, 'public/files/admin_images/male.png', 'Abdul Kader', 'Sabina Yeasmin', 'Male', 'Incepta', '2023-07-01', '2023-07-23 04:06:46', '2023-07-23 04:06:46'),
(8, 12, 100012, 'public/files/admin_images/12-1697688497.jpg', 'ASM Abdul Kader', 'Sabina Yeasmin', 'Male', 'Dhaka', NULL, '2023-10-19 04:08:17', '2023-10-19 04:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `logo_id` bigint(20) UNSIGNED NOT NULL,
  `logo_position` varchar(255) NOT NULL,
  `logo_for` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo_type` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `logo_image_dimention` varchar(255) DEFAULT NULL COMMENT 'Width x Height',
  `logo_image_size` varchar(255) DEFAULT NULL COMMENT 'KB',
  `logo_status` text NOT NULL DEFAULT 'Inactive',
  `logo_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`logo_id`, `logo_position`, `logo_for`, `company_name`, `logo_type`, `logo_image`, `logo_image_dimention`, `logo_image_size`, `logo_status`, `logo_delete`, `created_at`, `updated_at`) VALUES
(14, 'admin_top', 'admin', 'Dreams', 'image', 'public/files/web_images/admin_top-1690452065.png', '200x60', '2686', 'Inactive', 0, '2023-07-27 10:01:05', '2023-10-31 13:06:35'),
(16, 'admin_bottom', 'admin', 'Dreams', 'text', 'SPARK IT SOLUTION', NULL, NULL, 'Active', 0, '2023-07-27 10:52:12', '2023-07-27 10:52:22'),
(18, 'spark_top', 'spark', 'Spark It Solution', 'image', 'public/files/web_images/spark-it/spark_top-1691473972.png', '200x60', '2287', 'Inactive', 0, '2023-08-08 05:52:52', '2023-08-08 06:25:58'),
(19, 'spark_top', 'spark', 'Spark It Solution', 'image', 'public/files/web_images/spark-it/spark_top-1691475282.png', '160x80', '4297', 'Inactive', 1, '2023-08-08 06:14:42', '2023-08-08 06:31:39'),
(20, 'spark_top', 'spark', 'Spark It Solution', 'image', 'public/files/web_images/spark-it/spark_top-1691475951.png', '160x80', '2639', 'Active', 0, '2023-08-08 06:25:51', '2023-08-08 06:25:58'),
(21, 'admin_top', 'admin', 'Dreams', 'image', 'public/files/web_images/admin_top-1698757536.png', '200x60', '10179', 'Inactive', 0, '2023-10-31 13:05:36', '2023-10-31 13:05:36'),
(22, 'admin_top', 'admin', 'Dreams', 'image', 'public/files/web_images/admin_top-1698757566.png', '200x60', '10179', 'Active', 0, '2023-10-31 13:06:06', '2023-10-31 13:08:00'),
(23, 'admin_top', 'admin', 'Dreams', 'text', 'PMIS', NULL, NULL, 'Inactive', 0, '2023-10-31 13:07:02', '2023-10-31 13:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_11_063548_create_reset_password_permissions_table', 2),
(7, '2023_07_13_053444_create_admin_profiles_table', 3),
(8, '2023_07_25_100314_create_logos_table', 4),
(9, '2023_08_03_154446_create_spark_contacts_table', 5),
(10, '2023_08_06_160926_create_spark_main_sliders_table', 6),
(11, '2023_08_06_161257_create_spark_main_slider_headlines_table', 6),
(12, '2023_10_04_125712_create_teachers_table', 7),
(13, '2023_10_17_130209_create_students_table', 8),
(14, '2023_10_19_095009_create_supervisors_table', 9),
(15, '2023_10_22_120824_create_phases_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('test@gmail.com', '$2y$10$0y1stswBtq2OB0X2lUrn2eAfYMA1SxYFoyZLnDnKBE3tRA1jsZzrq', '2023-07-27 10:22:33'),
('test2@gmail.com', '$2y$10$FS7TbQi8y0x6Op0ITzzZvubGStSJko4WyF8oRNDAqjOOHcT3DYetO', '2023-07-27 10:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

CREATE TABLE `phases` (
  `phase_id` bigint(20) UNSIGNED NOT NULL,
  `phase_row_id` int(11) NOT NULL,
  `phase_student_id` int(11) NOT NULL,
  `phase_supervisor_id` int(11) NOT NULL,
  `phase_cosupervisor_id` int(11) NOT NULL,
  `phase_defence_topic` text DEFAULT NULL,
  `phase_title_defense_type` text DEFAULT NULL,
  `phase_title_defence_start_date` date DEFAULT NULL,
  `phase_title_defence_end_date` time DEFAULT NULL,
  `phase_title_defense_description` text DEFAULT NULL,
  `phase_title_defense_objective` text DEFAULT NULL,
  `phase_title_defense_motivation` text DEFAULT NULL,
  `phase_title_defense_instruction` text DEFAULT NULL,
  `phase_title_defence_file` varchar(255) DEFAULT NULL,
  `phase_title_defence_remark` varchar(255) DEFAULT NULL,
  `phase_title_defence_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `phase_pre_defence_start_date` date DEFAULT NULL,
  `phase_pre_defence_end_date` time DEFAULT NULL,
  `phase_pre_defence_instruction` text DEFAULT NULL,
  `phase_pre_defence_file` varchar(255) DEFAULT NULL,
  `phase_pre_defence_description` text DEFAULT NULL,
  `phase_pre_defence_remark` varchar(255) DEFAULT NULL,
  `phase_pre_defence_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `phase_final_defence_start_date` date DEFAULT NULL,
  `phase_final_defence_end_date` time DEFAULT NULL,
  `phase_final_defence_instruction` text DEFAULT NULL,
  `phase_final_defence_file` varchar(255) DEFAULT NULL,
  `phase_final_defence_description` text DEFAULT NULL,
  `phase_final_defence_remark` varchar(255) DEFAULT NULL,
  `phase_final_result` float DEFAULT NULL,
  `phase_final_result_date` timestamp NULL DEFAULT NULL,
  `phase_final_defence_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `phase_status` varchar(255) NOT NULL DEFAULT '0' COMMENT '0=initial , 1=title defense , 2=pre defense , 3=final defense',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phases`
--

INSERT INTO `phases` (`phase_id`, `phase_row_id`, `phase_student_id`, `phase_supervisor_id`, `phase_cosupervisor_id`, `phase_defence_topic`, `phase_title_defense_type`, `phase_title_defence_start_date`, `phase_title_defence_end_date`, `phase_title_defense_description`, `phase_title_defense_objective`, `phase_title_defense_motivation`, `phase_title_defense_instruction`, `phase_title_defence_file`, `phase_title_defence_remark`, `phase_title_defence_status`, `phase_pre_defence_start_date`, `phase_pre_defence_end_date`, `phase_pre_defence_instruction`, `phase_pre_defence_file`, `phase_pre_defence_description`, `phase_pre_defence_remark`, `phase_pre_defence_status`, `phase_final_defence_start_date`, `phase_final_defence_end_date`, `phase_final_defence_instruction`, `phase_final_defence_file`, `phase_final_defence_description`, `phase_final_defence_remark`, `phase_final_result`, `phase_final_result_date`, `phase_final_defence_status`, `phase_status`, `created_at`, `updated_at`) VALUES
(2, 6, 12, 13, 14, 'Test', 'Research based project', '2023-10-23', '19:55:00', 'ttt', 'yyyy', 'uuuu', '<p>eee</p>', 'public/files/pre_defense/12-1698073804.pdf', '22', 'Taken', '2023-10-31', '19:58:00', NULL, 'public/files/pre_defense/12-1698073872.pdf', '<p>sasad</p>', '22', 'Taken', '2023-10-31', '10:44:00', '<p>Final-ins</p>', 'public/files/final_defense/12-1698126373.pdf', 'My final <b>defense</b>', '90', 44.6667, '2023-10-24 07:58:19', 'Taken', '4', '2023-10-22 06:41:31', '2023-10-24 07:58:19'),
(4, 7, 15, 13, 9, 'Test', 'Research', '2023-10-25', '09:25:00', 'sss', 'ss', 'sss', '<p>Be are p-1</p>', 'public/files/title_defense/15-1698135949.pdf', '70', 'Taken', '2023-10-26', '17:26:00', '<p>Be aware phase-2</p>', 'public/files/pre_defense/15-1698136015.pdf', 'DDDD', '88', 'Taken', '2023-10-28', '10:27:00', '<p>Be aware p-3</p>', 'public/files/final_defense/15-1698136080.pdf', 'Ho', '80', 79.3333, '2023-10-24 08:28:21', 'Taken', '4', '2023-10-24 08:24:37', '2023-10-24 08:28:21'),
(5, 8, 17, 18, 13, 'Mango detection with AI', 'Project', '2023-11-01', '06:54:00', 'jdhfjksdfk sdjkfhsdjk', 'dfkljsdfhjk', 'fglkjdh fldgjdlkf fdgdfg', '<p>You have to write<br></p>', 'public/files/title_defense/17-1698758510.pdf', '65', 'Taken', '2023-11-02', '03:23:00', '<p>fdgdgfd <br></p>', 'public/files/pre_defense/17-1698758660.pdf', 'dflkjdlsk fdlgkjdlk lkfdgjkl d', '45', 'Taken', '2023-11-03', '15:44:00', '<p>dsfsd gh fhgh fhg sdffgdhfg <br></p>', 'public/files/final_defense/17-1698758754.pdf', 'fgfd dfg d', '90', 66.6667, '2023-10-31 13:26:51', 'Taken', '4', '2023-10-31 13:18:24', '2023-10-31 13:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_permissions`
--

CREATE TABLE `reset_password_permissions` (
  `reset_id` bigint(20) UNSIGNED NOT NULL,
  `reset_user_id` int(11) NOT NULL,
  `reset_email` varchar(255) NOT NULL,
  `reset_status` text NOT NULL DEFAULT 'No',
  `reset_approved_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_password_permissions`
--

INSERT INTO `reset_password_permissions` (`reset_id`, `reset_user_id`, `reset_email`, `reset_status`, `reset_approved_by`, `created_at`, `updated_at`) VALUES
(5, 2, 'test@gmail.com', 'Yes', 'MD. MUTASIM NAIB SUMIT', '2023-07-12 05:09:04', '2023-07-25 02:52:11'),
(6, 2, 'test@gmail.com', 'Yes', 'MD. MUTASIM NAIB SUMIT', '2023-07-12 05:25:41', '2023-07-25 21:38:05'),
(7, 2, 'test@gmail.com', 'Yes', 'MD. MUTASIM NAIB SUMIT', '2023-07-24 22:25:27', '2023-07-27 10:22:33'),
(8, 8, 'test2@gmail.com', 'Yes', 'MD. MUTASIM NAIB SUMIT', '2023-07-27 10:21:51', '2023-07-27 10:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_row_id` bigint(20) UNSIGNED NOT NULL,
  `student_user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_facalty` varchar(255) NOT NULL,
  `student_department` varchar(255) NOT NULL,
  `student_batch` varchar(255) NOT NULL,
  `student_section` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_row_id`, `student_user_id`, `student_id`, `student_facalty`, `student_department`, `student_batch`, `student_section`, `created_at`, `updated_at`) VALUES
(2, 12, 1022007, 'FIST', 'EEE', '48', 'H', '2023-10-18 05:38:27', '2023-10-18 06:38:43'),
(3, 15, 654987123, 'FE', 'CSE', '47', 'H', '2023-10-24 08:16:19', '2023-10-24 08:16:19'),
(4, 17, 21515, 'FIST', 'CSE', '45', 'F', '2023-10-31 13:11:15', '2023-10-31 13:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `supervisor_student_id` int(11) NOT NULL,
  `supervisor_student_choice_1` int(11) DEFAULT NULL,
  `supervisor_student_choice_2` int(11) DEFAULT NULL,
  `supervisor_student_choice_3` int(11) DEFAULT NULL,
  `supervisor_student_accepted` int(11) DEFAULT NULL,
  `cosupervisor_student_choice_1` int(11) DEFAULT NULL,
  `cosupervisor_student_choice_2` int(11) DEFAULT NULL,
  `cosupervisor_student_choice_3` int(11) DEFAULT NULL,
  `cosupervisor_student_accepted` int(11) DEFAULT NULL,
  `supervisor_status` text NOT NULL DEFAULT 'Editable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`supervisor_id`, `supervisor_student_id`, `supervisor_student_choice_1`, `supervisor_student_choice_2`, `supervisor_student_choice_3`, `supervisor_student_accepted`, `cosupervisor_student_choice_1`, `cosupervisor_student_choice_2`, `cosupervisor_student_choice_3`, `cosupervisor_student_accepted`, `supervisor_status`, `created_at`, `updated_at`) VALUES
(6, 12, 13, 14, 9, 13, 9, 13, 14, 14, 'Edited', '2023-10-22 06:40:54', '2023-10-22 06:41:31'),
(7, 15, 9, 13, 14, 13, 14, 13, 9, 9, 'Edited', '2023-10-24 08:22:07', '2023-10-24 08:24:37'),
(8, 17, 13, 14, 18, 18, 9, 14, 13, 13, 'Edited', '2023-10-31 13:16:29', '2023-10-31 13:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_row_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_user_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `teacher_facalty` varchar(255) NOT NULL,
  `teacher_department` varchar(255) NOT NULL,
  `teacher_designation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_row_id`, `teacher_user_id`, `teacher_id`, `teacher_facalty`, `teacher_department`, `teacher_designation`, `created_at`, `updated_at`) VALUES
(1, 9, 123456789, 'FE', 'CSE', 'Professor', '2023-10-04 07:57:28', '2023-10-19 05:42:46'),
(2, 13, 654987, 'FE', 'CSE', 'Professor', '2023-10-19 05:58:00', '2023-10-19 05:58:00'),
(3, 14, 456321, 'FE', 'CSE', 'Professor', '2023-10-19 05:58:38', '2023-10-19 05:58:38'),
(4, 18, 452, 'FIST', 'CSE', 'Lecturer', '2023-10-31 13:12:17', '2023-10-31 13:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` text NOT NULL DEFAULT 'Active',
  `role` int(11) NOT NULL COMMENT 'Admin=1 , Supervisor=2 , Editor=3 , Teacher =4, Student=5',
  `delete` int(11) NOT NULL DEFAULT 0,
  `edit_basic` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No permission , 1 = Has permission',
  `edit_basic_endtime` timestamp NULL DEFAULT NULL,
  `edit_additional` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No permission , 1 = Has permission',
  `edit_additional_endtime` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `status`, `role`, `delete`, `edit_basic`, `edit_basic_endtime`, `edit_additional`, `edit_additional_endtime`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Shanto Hossen', 'santo@gmail.com', '01794973738', NULL, '$2y$10$8iA8aclNtsKDJY.ZyLYWIOxjq5eTohTzmfhlgSy.0NHEn.2lO08lu', 'Active', 1, 0, 1, NULL, 1, NULL, NULL, '2023-07-10 04:02:07', '2023-10-31 13:40:42'),
(3, 'MD. MUTASIM NAIBaa', 'test1@gmail.com', '01794973736', NULL, '$2y$10$Gu/boA.tvpz1u7aezqq0w.5WeVa4zp3m98DZ61ydIC8XYAylisXdm', 'Active', 3, 0, 0, NULL, 0, NULL, NULL, '2023-07-11 22:37:21', '2023-10-17 06:25:29'),
(8, 'TEST-2', 'test2@gmail.com', '01794973739', NULL, '$2y$10$6S4AwEi7Z4TZuHVWYHdg5OD2Lhe7Ms5t4uREYoPcuYit/0k2wM8tS', 'Active', 2, 0, 0, NULL, 0, NULL, NULL, '2023-07-24 04:52:27', '2023-07-26 05:22:50'),
(9, 'ASM ABDUL KADERs', 'teacher@gmail.coms', '123123255', NULL, '$2y$10$yCjkGeIlZRGR5WrgyQ0MtepBaP8AgIaWgVa3XX/Nedy6vjNNeYz7W', 'Active', 4, 0, 0, NULL, 0, NULL, NULL, '2023-10-04 07:57:28', '2023-10-23 12:59:04'),
(12, 'ওবাইদুল কাদের', 'oka@gmail.com', '123654', NULL, '$2y$10$SgaS51RdRAm2ICAUs2SVAOMUPWRl7ftdH48cWlenWkVwrYHmzl.aO', 'Active', 5, 0, 0, NULL, 0, NULL, NULL, '2023-10-18 05:38:27', '2023-10-18 09:07:06'),
(13, 'Abdus Sattar', 'sattar@gmail.com', '654987', NULL, '$2y$10$cQFFFve3Ux2Z1p6r69cY3.q.MToE.uGQd5p5rfAX/757T4gqek66K', 'Active', 4, 0, 0, NULL, 0, NULL, NULL, '2023-10-19 05:58:00', '2023-10-19 05:58:00'),
(14, 'Naim Sheikh', 'naim@gmail.com', '456321', NULL, '$2y$10$bSGt9sJs5b99ltVS/OtQpOeMwNvBeh6ElBnrROJqm9o1NS/jW0HHi', 'Active', 4, 0, 0, NULL, 0, NULL, NULL, '2023-10-19 05:58:38', '2023-10-19 05:58:38'),
(15, 'Sheikh Hasina', 'hasina@gmail.com', '654987123', NULL, '$2y$10$oF.VMs6qVdJYAzaMUrikt.E0ZLVNOD5hv80QUgbzgvwsG7FK.2vJG', 'Active', 5, 0, 0, NULL, 0, NULL, NULL, '2023-10-24 08:16:19', '2023-10-24 08:16:19'),
(16, 'student', 'student@gmail.com', '01835253166', NULL, '$2y$10$g.zI0biO5vke5MXY7pPR9ud8mhg4p1rPJvebM0JkEVs76hQdjJufK', 'Deactive', 3, 1, 0, NULL, 0, NULL, NULL, '2023-10-31 13:09:44', '2023-10-31 13:12:59'),
(17, 'student1', 'student1@gmail.com', '0154646544', NULL, '$2y$10$loQvaf3Tc.DSqBO/1nrww./eYsfPVKSuk299Gqbv.pSoXNmbEppJO', 'Active', 5, 0, 0, NULL, 0, NULL, NULL, '2023-10-31 13:11:15', '2023-10-31 13:11:15'),
(18, 'teacher', 'teacher@gmail.com', '021151545', NULL, '$2y$10$ibFoDqQC7IVPEJrjnHleIuDCozrJ754JKQn0WJYxXg3AoIA520Rm2', 'Active', 4, 0, 0, NULL, 0, NULL, NULL, '2023-10-31 13:12:17', '2023-10-31 13:12:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phases`
--
ALTER TABLE `phases`
  ADD PRIMARY KEY (`phase_id`);

--
-- Indexes for table `reset_password_permissions`
--
ALTER TABLE `reset_password_permissions`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_row_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`supervisor_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_row_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  MODIFY `profile_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `logo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phases`
--
ALTER TABLE `phases`
  MODIFY `phase_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reset_password_permissions`
--
ALTER TABLE `reset_password_permissions`
  MODIFY `reset_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_row_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `supervisor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_row_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
