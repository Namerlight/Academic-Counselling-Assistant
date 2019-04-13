-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2019 at 06:51 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aca`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `creator's_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `competitive_entrance_exams`
--

CREATE TABLE `competitive_entrance_exams` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ielts` double(8,2) DEFAULT NULL,
  `sat` double(8,2) DEFAULT NULL,
  `gre` double(8,2) DEFAULT NULL,
  `toefl` double(8,2) DEFAULT NULL,
  `gmat` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competitive_entrance_exams`
--

INSERT INTO `competitive_entrance_exams` (`username`, `ielts`, `sat`, `gre`, `toefl`, `gmat`, `created_at`, `updated_at`) VALUES
('masudurhimel', 6.50, NULL, NULL, NULL, NULL, '2019-03-17 14:06:40', '2019-03-17 14:06:40'),
('ridwanshourov', 6.00, NULL, 280.00, NULL, NULL, '2019-04-13 10:35:41', '2019-04-13 10:35:41'),
('rizonssh', 6.50, NULL, NULL, NULL, NULL, '2019-04-13 10:37:16', '2019-04-13 10:37:16'),
('toushuju', 7.00, NULL, 300.00, NULL, NULL, '2019-04-13 10:39:18', '2019-04-13 10:39:18'),
('bishwabrac', 6.00, NULL, NULL, NULL, NULL, '2019-04-13 10:41:05', '2019-04-13 10:41:05'),
('nabilNSU', 7.00, NULL, NULL, NULL, NULL, '2019-04-13 10:42:21', '2019-04-13 10:42:21'),
('muniraRahman', NULL, NULL, NULL, NULL, NULL, '2019-04-13 10:43:49', '2019-04-13 10:43:49'),
('engrmizan', NULL, NULL, NULL, NULL, NULL, '2019-04-13 10:48:46', '2019-04-13 10:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `average_annual_living_cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country`, `average_annual_living_cost`) VALUES
('Argentina', '6000'),
('Australia', '20571'),
('Belgium', '10000'),
('Canada', '17000'),
('China', '2700'),
('Denmark', '28000'),
('France', '20667'),
('Germany', '13667'),
('Hong Kong', '6600'),
('Japan', '14720'),
('Leeds', '13000'),
('Malaysia', '5600'),
('Netherlands', '11667'),
('New Zealand', '22500'),
('Russia', '2200'),
('Singapore', '17150'),
('South Korea', '4720'),
('Sweden', '9600'),
('Switzerland', '19667'),
('Taiwan', '3000'),
('United Kingdom', '13529'),
('United States', '15930');

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
(3, '2019_02_20_171305_create_students_table', 1),
(4, '2019_02_20_174955_create_admins_table', 2),
(5, '2019_02_21_182754_create_universities_table', 3),
(6, '2019_02_21_185616_create_university_programs_table', 4),
(7, '2019_02_22_190226_create_countries_table', 5),
(8, '2019_02_23_181943_add_subject_credit_points_to_students', 6),
(10, '2019_02_23_185331_create_competitive__entrance__exams_table', 7),
(11, '2019_03_15_192435_add_timestamp_to_students', 8),
(12, '2019_03_15_193006_add_timestamp_to_competitive_entrance_exams', 9),
(13, '2019_03_15_203238_update_foreign_key_to_competitive_entrance_exams', 10),
(14, '2019_03_17_170157_add_tokaten_to_users', 11),
(15, '2019_04_13_161104_create_student_acceptance_table', 12),
(16, '2019_04_13_161605_create_universities_requirements_table', 12);

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ssc_o_level` double(8,2) DEFAULT NULL,
  `hsc_a_level` double(8,2) DEFAULT NULL,
  `bachelor_subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bachelor_credit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cgpa_bachelor` double(8,2) DEFAULT NULL,
  `others` mediumtext COLLATE utf8mb4_unicode_ci,
  `academic_point` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `school_name`, `college_name`, `college_group`, `university`, `ssc_o_level`, `hsc_a_level`, `bachelor_subject`, `bachelor_credit`, `cgpa_bachelor`, `others`, `academic_point`, `created_at`, `updated_at`) VALUES
('masudurhimel', 'BAF Shaheen College Kurmitola', 'NDC', 'Science', 'North South University', 5.00, 5.00, 'CSE', '130', 3.93, 'Project experience + have research works', NULL, '2019-03-17 14:06:40', '2019-03-26 10:34:31'),
('ridwanshourov', 'DRMC', 'DRMC', 'Science', 'North South University', 5.00, 5.00, 'CSE', '130', 3.20, NULL, 660.00, '2019-04-13 10:35:41', '2019-04-13 10:35:41'),
('rizonssh', 'DRMC', 'NDC', 'Science', 'MIST', 5.00, 5.00, 'CSE', '160', 3.60, NULL, 425.00, '2019-04-13 10:37:15', '2019-04-13 10:37:15'),
('toushuju', 'ACC', 'NDC', 'Science', 'JU', 5.00, 5.00, 'BBA', '140', 3.80, NULL, 750.00, '2019-04-13 10:39:18', '2019-04-13 10:39:18'),
('bishwabrac', 'DRMC', 'NDC', 'Science', 'BRACU', 5.00, 5.00, 'LLB', '120', 3.20, NULL, 380.00, '2019-04-13 10:41:05', '2019-04-13 10:41:05'),
('nabilNSU', 'PKB', 'NDC', 'Science', 'NSU', 5.00, 5.00, 'BBA', '120', 3.20, NULL, 390.00, '2019-04-13 10:42:21', '2019-04-13 10:42:21'),
('muniraRahman', 'BAF Shaheen KTL', 'BAF Shaheen KTL', 'Science', 'DU', 5.00, 5.00, 'Botany', '160', 3.60, NULL, 360.00, '2019-04-13 10:43:49', '2019-04-13 10:43:49'),
('engrmizan', 'BAF Shaheen KTL', 'BAF Shaheen DHK', 'Science', 'RUET', 5.00, 5.00, 'Civil', '160', 3.50, NULL, 350.00, '2019-04-13 10:48:46', '2019-04-13 10:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `student_acceptance`
--

CREATE TABLE `student_acceptance` (
  `acceptance_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uni_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qs_ranking` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `research_output` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduate_employability_ranking` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_student` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_fees` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `qs_ranking`, `research_output`, `status`, `graduate_employability_ranking`, `total_student`, `average_fees`, `country`) VALUES
(1, 'Massachusetts Institute of Technology (MIT)', '#1', 'Very High', 'Private', NULL, '11,145', '48K-50K', 'United States'),
(2, 'Stanford University', '#2', 'Very High', 'Private', NULL, '16,135', '46K-48K', 'United States'),
(3, 'Harvard University', '#3', '', 'Private', NULL, '22,727', '', 'United States'),
(4, 'California Institute of Technology (Caltech)', '#4', 'Very High', 'Private', NULL, '2,239', '>60K', 'United States'),
(5, 'University of Oxford', '#5', 'Very High', 'Public', NULL, '20,631', '12K-14K', 'United Kingdom'),
(6, 'University of Cambridge', '#6', '', 'Public', NULL, '19,203', '', 'United Kingdom'),
(7, 'ETH Zurich - Swiss Federal Institute of Technology', '#7', 'Very High', 'Public', NULL, '18,003', '<2K', 'Switzerland'),
(8, 'Imperial College London', '#8', 'Very High', 'Public', NULL, '16,797', '12K-14K', 'United Kingdom'),
(9, 'University of Chicago', '#9', 'Very High', 'Private', NULL, '13,924', '50K-52K', 'United States'),
(10, 'UCL (University College London)', '#10', 'Very High', 'Public', NULL, '32,795', '12K-14K', 'United Kingdom'),
(11, 'National University of Singapore (NUS)', '#11', '', 'Public', NULL, '30,226', '', 'Singapore'),
(12, 'Nanyang Technological University, Singapore (NTU)', '#12', '', 'Public', NULL, '25,088', '', 'Singapore'),
(13, 'Princeton University', '#13', '', 'Private', NULL, '8,017', '', 'United States'),
(14, 'Cornell University', '#14', 'Very High', 'Private', NULL, '22,144', '50K-52K', 'United States'),
(15, 'Yale University', '#15', 'Very High', 'Private', NULL, '12,927', '50K-52K', 'United States'),
(16, 'Columbia University', '#16', '', 'Private', NULL, '26,160', '', 'United States'),
(17, 'Tsinghua University', '#17', '', 'Public', NULL, '36,403', '', 'China'),
(18, 'University of Edinburgh', '#18', 'Very High', 'Public', NULL, '29,222', '2K-4K', 'United Kingdom'),
(19, 'University of Pennsylvania', '#19', 'Very High', 'Private', NULL, '20,852', '52K-54K', 'United States'),
(20, 'University of Michigan', '#20', 'Very High', 'Public', NULL, '43,874', '14K-16K', 'United States'),
(21, 'Johns Hopkins University', '#21', 'Very High', 'Private', NULL, '16,657', '50K-52K', 'United States'),
(22, 'EPFL - Ecole Polytechnique Federale de Lausanne', '#22', 'Very High', 'Public', NULL, '10,492', '<2K', 'Switzerland'),
(23, 'University of Tokyo', '#23', '', 'Public', NULL, '27,407', '', 'Japan'),
(24, 'Australian National University', '#24', 'Very High', 'Public', NULL, '16,677', '14K-16K', 'Australia'),
(25, 'University of Hong Kong', '#25', '', 'Public', NULL, '20,203', '', 'Hong Kong'),
(26, 'Duke University', '#26', '', 'Private', NULL, '15,086', '', 'United States'),
(27, 'University of California, Berkeley (UCB)', '#27', 'Very High', 'Public', NULL, '40,056', '14K-16K', 'United States'),
(28, 'University of Toronto', '#28', 'Very High', 'Public', NULL, '73,064', '4K-6K', 'Canada'),
(29, 'University of Manchester', '#29', 'Very High', 'Public', NULL, '37,577', '10K-12K', 'United Kingdom'),
(30, 'Peking University', '#30', '', 'Public', NULL, '43,242', '', 'China'),
(31, 'King\'s College London', '#31', '', 'Public', NULL, '25,977', '', 'United Kingdom'),
(32, 'University of California, Los Angeles (UCLA)', '#32', 'Very High', 'Public', NULL, '43,800', '10K-12K', 'United States'),
(33, 'McGill University', '#33', 'Very High', 'Public', NULL, '29,102', '4K-6K', 'Canada'),
(34, 'Northwestern University', '#34', 'Very High', 'Private', NULL, '18,924', '50K-52K', 'United States'),
(35, 'Kyoto University', '#35', '', 'Public', NULL, '23,081', '', 'Japan'),
(36, 'Seoul National University', '#36', '', 'Public', NULL, '28,482', '', 'South Korea'),
(37, 'Hong Kong University of Science and Technology', '#37', '', 'Public', NULL, '10,666', '', 'Hong Kong'),
(38, 'London School of Economics and Political Science (LSE)', '#38', '', 'Public', NULL, '10,357', '', 'United Kingdom'),
(39, 'University of Melbourne', '#39', '', 'Public', NULL, '44,365', '', 'Australia'),
(40, 'KAIST - Korea Advanced Institute of Science & Technology', '#40', '', 'Public', NULL, '9,812', '', 'South Korea'),
(41, 'University of California, San Diego (UCSD)', '#41', '', 'Public', NULL, '33,935', '', 'United States'),
(42, 'University of Sydney', '#42', 'Very High', 'Public', NULL, '44,817', '28K-30K', 'Australia'),
(43, 'New York University (NYU)', '#43', 'Very High', 'Private', NULL, '44,433', '48K-50K', 'United States'),
(44, 'Fudan University', '#44', '', 'Public', NULL, '31,354', '', 'China'),
(45, 'University of New South Wales (UNSW Sydney)', '#45', 'Very High', 'Public', NULL, '40,326', '6K-8K', 'Australia'),
(46, 'Carnegie Mellon University', '#46', 'Very High', 'Private', NULL, '13,991', '54K-56K', 'United States'),
(47, 'University of British Columbia', '#47', 'Very High', 'Public', NULL, '52,970', '2K-4K', 'Canada'),
(48, 'University of Queensland', '#48', 'Very High', 'Public', NULL, '39,436', '6K-8K', 'Australia'),
(49, 'Chinese University of Hong Kong (CUHK)', '#49', '', 'Public', NULL, '17,705', '', 'Hong Kong'),
(50, 'Universite PSL', '#50', 'Very High', 'Public', NULL, '20,234', '2K-4K', 'France'),
(51, 'University of Bristol', '#51', 'Very High', 'Public', NULL, '21,906', '12K-14K', 'United Kingdom'),
(52, 'Delft University of Technology', '#52', 'Very High', 'Public', NULL, '17,703', '2K-4K', 'Netherlands'),
(53, 'University of Wisconsin-Madison', '#53', 'Very High', 'Public', NULL, '39,282', '32K-34K', 'United States'),
(54, 'University of Warwick', '#54', 'Very High', 'Public', NULL, '20,884', '12K-14K', 'United Kingdom'),
(55, 'City University of Hong Kong', '#55', '', 'Public', NULL, '9,566', '', 'Hong Kong'),
(56, 'Brown University', '#56', 'Very High', 'Private', NULL, '9,564', '52K-54K', 'United States'),
(57, 'University of Amsterdam', '#57', 'Very High', 'Public', NULL, '23,962', '2K-4K', 'Netherlands'),
(58, 'Tokyo Institute of Technology', '#58', '', 'Public', NULL, '9,962', '', 'Japan'),
(59, 'Monash University', '#=59', '', 'Public', NULL, '57,764', '', 'Australia'),
(60, 'Shanghai Jiao Tong University', '#=59', '', 'Public', NULL, '40,830', '', 'China'),
(61, 'Technical University of Munich', '#61', 'Very High', 'Public', NULL, '39,323', '<2K', 'Germany'),
(62, 'Ludwig-Maximilians-Universität München', '#62', 'Very High', 'Public', NULL, '34,689', '<2K', 'Germany'),
(63, 'University of Texas at Austin', '#63', '', 'Public', NULL, '48,485', '', 'United States'),
(64, 'Ruprecht-Karls-Universitat Heidelberg', '#64', 'Very High', 'Public', NULL, '20,800', '<2K', 'Germany'),
(65, 'Ecole Polytechnique', '#65', 'Very High', 'Public', NULL, '2,908', '<2K', 'France'),
(66, 'University of Washington', '#66', '', 'Public', NULL, '52,346', '', 'United States'),
(67, 'Osaka University', '#67', '', 'Public', NULL, '22,520', '', 'Japan'),
(68, 'Zhejiang University', '#68', '', 'Public', NULL, '33,650', '', 'China'),
(69, 'Georgia Institute of Technology', '#=69', 'Very High', 'Public', NULL, '22,007', '8K-10K', 'United States'),
(70, 'University of Glasgow', '#=69', 'Very High', 'Public', NULL, '25,150', '2K-4K', 'United Kingdom'),
(71, 'University of Illinois at Urbana-Champaign', '#71', '', 'Public', NULL, '43,283', '', 'United States'),
(72, 'National Taiwan University (NTU)', '#72', '', 'Public', NULL, '30,625', '', 'Taiwan'),
(73, 'Universidad de Buenos Aires (UBA)', '#73', '', 'Public', NULL, '122,298', '', 'Argentina'),
(74, 'Durham University', '#74', 'Very High', 'Public', NULL, '17,259', '12K-14K', 'United Kingdom'),
(75, 'Sorbonne University', '#=75', 'Very High', 'Public', NULL, '41,777', '<2K', 'France'),
(76, 'University of Sheffield', '#=75', 'Very High', 'Public', NULL, '26,429', '10K-12K', 'United Kingdom'),
(77, 'Tohoku Univeristy', '#78', 'Very High', 'Public', NULL, '26,472', '<2K', 'Japan'),
(78, 'University of Zurich', '#=79', 'Very High', 'Public', NULL, '29,112', '10K-12K', 'Switzerland'),
(79, 'University of Birmingham', '#=79', 'Very High', 'Public', NULL, '31,177', '<2K', 'United Kingdom'),
(80, 'University of Copenhagen', '#81', 'Very High', 'Public', NULL, '45,422', '<2K', 'Denmark'),
(81, 'KU Leuven', '#82', 'Very High', 'Public', NULL, '29,928', '10K-12K', 'Belgium'),
(82, 'University of Nottingham', '#=83', '', 'Private', NULL, '3,114', '', 'United Kingdom'),
(83, 'Pohang University of Science and Technology (POSTECH)', '#=83', 'Very High', 'Public', NULL, '26,211', '8K-10K', 'South Korea'),
(84, 'University of North Carolina, Chapel Hill', '#85', 'Very High', 'Public', NULL, '29,981', '4K-6K', 'United States'),
(85, 'University of Auckland', '#86', '', 'Private', NULL, '25,226', '', 'New Zealand'),
(86, 'Korea University', '#=87', 'Very High', 'Private', NULL, '6,752', '44K-46K', 'South Korea'),
(87, 'Rice University', '#=87', '', 'Public', NULL, '15,140', '', 'United States'),
(88, 'Universiti Malaya (UM)', '#89', 'Very High', 'Public', NULL, '43,603', '10K-12K', 'Malaysia'),
(89, 'Ohio State University', '#90', '', 'Public', NULL, '30,904', '', 'United States'),
(90, 'Lomonosov Moscow State University', '#91', '', 'Public', NULL, '18,431', '', 'Russia'),
(91, 'University of Western Australia', '#92', '', 'Public', NULL, '27,786', '', 'Australia'),
(92, 'Lund University', '#=93', 'Very High', 'Private', NULL, '26,508', '50K-52K', 'Sweden'),
(93, 'Boston University', '#=93', 'Very High', 'Public', NULL, '30,842', '12K-14K', 'United States'),
(94, 'University of Leeds', '#95', 'Very High', 'Public', NULL, '45,218', '18K-20K', 'Leeds'),
(95, 'Pennsylvania State University', '#96', '', 'Public', NULL, '23,197', '', 'United States'),
(96, 'University of Southampton', '#98', '', 'Public', NULL, '16,152', '', 'United Kingdom'),
(97, 'University of St Andrews', '#99', 'Very High', 'Public', NULL, '8,535', '2K-4K', 'United Kingdom'),
(98, 'University of Science and Technology of China', '#=100', 'Very High', 'Public', NULL, '37,670', '10K-12K', 'China'),
(99, 'Eindhoven University of Technology', '#=100', '', 'Private', NULL, '23,142', '', 'Netherlands'),
(100, 'Purdue University', '#=100', 'Very High', 'Public', NULL, '35,430', '14K-16K', 'United States'),
(101, 'Sungkyunkwan University (SKKU)', '#=100', 'Very High', 'Private', NULL, '13,474', '48K-50K', 'South Korea');

-- --------------------------------------------------------

--
-- Table structure for table `universities_requirements`
--

CREATE TABLE `universities_requirements` (
  `uni_id` int(10) UNSIGNED NOT NULL,
  `university_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gre_reqs` double NOT NULL,
  `ielts_reqs` double NOT NULL,
  `cgpa_reqs` double NOT NULL,
  `uni_score` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university_programs`
--

CREATE TABLE `university_programs` (
  `uni_prog_id` int(11) NOT NULL,
  `university_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `university_programs`
--

INSERT INTO `university_programs` (`uni_prog_id`, `university_name`, `program_name`) VALUES
(1, 'Massachusetts Institute of Technology (MIT)', 'Aerospace Engineering'),
(2, 'Massachusetts Institute of Technology (MIT)', 'Atmospheric Chemistry'),
(3, 'Massachusetts Institute of Technology (MIT)', 'Civil and Environmental Systems'),
(4, 'Massachusetts Institute of Technology (MIT)', 'Electrical Science and Engineering'),
(5, 'Massachusetts Institute of Technology (MIT)', 'International Development'),
(6, 'Massachusetts Institute of Technology (MIT)', 'Middle Eastern Studies'),
(7, 'Massachusetts Institute of Technology (MIT)', 'Statistics and Data Science'),
(8, 'Harvard University', 'African and African American Studies'),
(9, 'Harvard University', 'Classics'),
(10, 'Harvard University', 'English'),
(11, 'Harvard University', 'History and Science'),
(12, 'Harvard University', 'Molecular and Cellular Biology'),
(13, 'Harvard University', 'Romance Languages and Literatures'),
(14, 'Harvard University', 'Visual and Environmental Studies'),
(15, 'Stanford University', 'Artificial Intelligence Graduate Certificate'),
(16, 'Stanford University', 'Stanford Innovation and Entrepreneurship Certificate'),
(17, 'Stanford University', 'Biomedical Informatics: Data, Modeling and Analysis Graduate Certificate'),
(18, 'Stanford University', 'Civil and Environmental Engineering MS Degree'),
(19, 'Stanford University', 'Electrical Engineering MS Degree'),
(20, 'Stanford University', 'Financial Risk Analysis and Management Graduate Certificate'),
(21, 'California Institute of Technology (Caltech)', 'Biology and Biological Engineering'),
(22, 'California Institute of Technology (Caltech)', 'Applied and Computational Mathematics'),
(23, 'California Institute of Technology (Caltech)', 'Geobiology'),
(24, 'California Institute of Technology (Caltech)', 'Business, Economics & Management'),
(25, 'California Institute of Technology (Caltech)', 'Political Science'),
(26, 'California Institute of Technology (Caltech)', 'Control and Dynamical Systems'),
(27, 'California Institute of Technology (Caltech)', 'Philosophy'),
(28, 'Oxford University', 'Archaeology and Anthropology'),
(29, 'Oxford University', 'Classics and English'),
(30, 'Oxford University', 'Engineering Science'),
(31, 'Oxford University', 'History (Ancient and Modern)'),
(32, 'Oxford University', 'Law'),
(33, 'Oxford University', 'Modern Languages'),
(34, 'Oxford University', 'Physics'),
(35, 'Cambridge University', 'Anglo-Saxon, Norse, and Celtic'),
(36, 'Cambridge University', 'Computer Science'),
(37, 'Cambridge University', 'History'),
(38, 'Cambridge University', 'Law'),
(39, 'Cambridge University', 'Medicine (Graduate Course)'),
(40, 'Cambridge University', 'Theology, Religion, and Philosophy of Religion'),
(41, 'Nanyang Technological University, Singapore (NTU)', 'Accountancy and Business'),
(42, 'Nanyang Technological University, Singapore (NTU)', 'Engineering'),
(43, 'Nanyang Technological University, Singapore (NTU)', 'Social Sciences'),
(44, 'Nanyang Technological University, Singapore (NTU)', 'Premier Scholars Programmes'),
(45, 'ETH Zurich - Swiss Federal Institute of Technology', 'Computer Science Bachelor'),
(46, 'ETH Zurich - Swiss Federal Institute of Technology', 'Electrical Engineering and Information Technology Bachelor'),
(47, 'ETH Zurich - Swiss Federal Institute of Technology', 'Materials Science Bachelor'),
(48, 'ETH Zurich - Swiss Federal Institute of Technology', 'Mechanical Engineering Bachelor'),
(49, 'Princeton University', 'Bachelor of Science in Engineering (B.S.E.)'),
(50, 'Princeton University', 'Art and Archaeology'),
(51, 'Princeton University', 'East Asian Studies'),
(52, 'Princeton University', 'German'),
(53, 'Princeton University', 'Neuroscience'),
(54, 'Princeton University', 'Slavic Languages and Literatures'),
(55, 'Princeton University', 'Computer Science'),
(56, 'Imperial College London', 'Aeronautical Engineering with a Year Abroad'),
(57, 'Imperial College London', 'Biological Sciences with Management'),
(58, 'Imperial College London', 'Biotechnology with Spanish for Science'),
(59, 'Imperial College London', 'Chemistry with Spanish for Science'),
(60, 'Imperial College London', 'Electrical and Electronic Engineering with a Year Abroad'),
(61, 'Imperial College London', 'Mathematics'),
(62, 'Imperial College London', 'Medical Biosciences'),
(63, 'University of Chicago', 'Master of Science from the Committee on Computational and Applied Mathematics (MCAM)'),
(64, 'University of Chicago', 'Graduate Program in Biophysical Sciences'),
(65, 'University of Chicago', 'Master of Science Program in Computer Science'),
(66, 'University of Chicago', 'Master of Science in Financial Mathematics'),
(67, 'University of Chicago', 'Master of Science in the Physical Sciences Division'),
(68, 'University of Chicago', 'Master of Science in Statistics'),
(69, 'UCL (University College London', 'Advanced Architectural Research PG Cert'),
(70, 'UCL (University College London', 'Child Health MRes'),
(71, 'UCL (University College London', 'Developmental Psychology and Clinical Practice MSc'),
(72, 'UCL (University College London', 'European Studies: European Society MA/PG Dip'),
(73, 'UCL (University College London', 'Landscape Architecture MLA'),
(74, 'UCL (University College London', 'Paediatric Dentistry MSc/PG Dip/PG Cert'),
(75, 'UCL (University College London', 'Public Diplomacy and Global Communication MA'),
(76, 'UCL (University College London', 'Space Syntax: Architecture and Cities MSc'),
(77, 'National University of Singapore (NUS)', 'Chinese Language'),
(78, 'National University of Singapore (NUS)', 'Theatre Studies'),
(79, 'National University of Singapore (NUS)', 'Global Studies'),
(80, 'National University of Singapore (NUS)', 'Industrial Design'),
(81, 'National University of Singapore (NUS)', 'Industrial and Systems Engineering'),
(82, 'National University of Singapore (NUS)', 'Applied Mathematics with specialisation in Mathematical Modelling and Data Analytics'),
(83, 'National University of Singapore (NUS)', 'Life Sciences'),
(84, 'National University of Singapore (NUS)', 'Physics (with specialisation in Quantum Technologies)'),
(85, 'Cornell University', 'Africana Studies'),
(86, 'Cornell University', 'Biological Sciences'),
(87, 'Cornell University', 'Computer Science'),
(88, 'Cornell University', 'Fiber Science and Apparel Design'),
(89, 'Cornell University', 'Human Development'),
(90, 'Cornell University', 'Mathematics'),
(91, 'Cornell University', 'Religious Studies'),
(92, 'Yale University', 'African Studies (B.A.)'),
(93, 'Yale University', 'Astrophysics (B.S.)'),
(94, 'Yale University', 'Computer Science and Psychology (B.A.)'),
(95, 'Yale University', 'Engineering Sciences (Chemical) (B.S.)'),
(96, 'Yale University', 'Film and Media Studies (B.A.)'),
(97, 'Yale University', 'History of Science, Medicine, and Public Health (B.A.)'),
(98, 'Yale University', 'Mathematics and Philosophy (B.A.)'),
(99, 'Yale University', 'Philosophy (B.A.)'),
(100, 'Yale University', 'Russian and East European Studies (B.A.)'),
(101, 'Columbia University', 'American Studies'),
(102, 'Columbia University', 'Chemical Physics'),
(103, 'Columbia University', 'Economics-Mathematics'),
(104, 'Columbia University', 'French and Francophone Studies'),
(105, 'Columbia University', 'Linguistics (Special Concentration)'),
(106, 'Columbia University', 'Regional Studies'),
(107, 'Tsinghua University', 'Architecture'),
(108, 'Tsinghua University', 'Aeronautical and Astronautical Engineering'),
(109, 'Tsinghua University', 'Mathematics and Physics'),
(110, 'Tsinghua University', 'Economics'),
(111, 'Tsinghua University', 'Painting'),
(112, 'Edinburgh University', 'Accounting and Business (MA) NN14'),
(113, 'Edinburgh University', 'Artificial Intelligence (BSc) G700'),
(114, 'Edinburgh University', 'Celtic and Linguistics (MA) QQ15'),
(115, 'Edinburgh University', 'Computer Science (BSc) G400'),
(116, 'Edinburgh University', 'Fashion (BA) W230'),
(117, 'Edinburgh University', 'Geophysics (MEarthPhys) M7G6'),
(118, 'University of Pennsylvania', '#'),
(119, 'University of Pennsylvania', 'Architecture: Design (Intensive), BA'),
(120, 'University of Pennsylvania', 'Comparative Literature: Theory, BA'),
(121, 'University of Pennsylvania', 'English: Drama, BA'),
(122, 'University of Pennsylvania', 'History of Art, Minor'),
(123, 'University of Pennsylvania', 'Mathematics: Biological Mathematics, BA'),
(124, 'University of Pennsylvania', 'Philosophy: Humanistic Philosophy, BA'),
(125, 'University of Pennsylvania', 'South Asia Regional Studies, MA'),
(126, 'John Hopkins University', 'Applied Biomedical Engineering'),
(127, 'John Hopkins University', 'Computer Science'),
(128, 'John Hopkins University', 'Environmental Engineering'),
(129, 'John Hopkins University', 'Information Systems Engineering'),
(130, 'John Hopkins University', 'Technical Management'),
(131, 'EPFL - Ecole Polytechnique Federale de Lausanne', 'Chemistry and Chemical Engineering'),
(132, 'EPFL - Ecole Polytechnique Federale de Lausanne', 'Computer Science'),
(133, 'EPFL - Ecole Polytechnique Federale de Lausanne', 'Mechanical Engineering'),
(134, 'EPFL - Ecole Polytechnique Federale de Lausanne', 'Life Sciences Engineering'),
(135, 'EPFL - Ecole Polytechnique Federale de Lausanne', 'Environmental Sciences and Engineering'),
(136, 'University of Tokyo', 'International Program in Economics'),
(137, 'University of Tokyo', 'International Graduate Program in the Field of Civil Engineering and Infrastructure Studies'),
(138, 'University of Tokyo', 'Architecture and Urban Design Program'),
(139, 'University of Tokyo', 'The English Program in Information Science and Technology'),
(140, 'Australian National University', 'Bachelor of Actuarial Studies'),
(141, 'Australian National University', 'Bachelor of Philosophy (Honours) / Bachelor of Arts (Honours)'),
(142, 'Australian National University', 'Bachelor of Science (Psychology)'),
(143, 'Australian National University', 'Master of Accounting'),
(144, 'University of Hong Kong', 'Civil Engineering'),
(145, 'University of Hong Kong', 'Computer Science'),
(146, 'University of Hong Kong', 'Electrical and Electronic Engineering'),
(147, 'University of Hong Kong', 'Industrial and Manufacturing Systems Engineering'),
(148, 'Duke University', 'African and African American Studies'),
(149, 'Duke University', 'Computer Science'),
(150, 'Duke University', 'French Studies'),
(151, 'Duke University', 'Mechanical Engineering*'),
(152, 'Duke University', 'Romance Studies'),
(153, 'University of California, Berkeley (UCB)', 'Applied Mathematics'),
(154, 'University of California, Berkeley (UCB)', 'Chinese Studies'),
(155, 'University of California, Berkeley (UCB)', 'Electrical Engineering and Computer Sciences/Materials Science and Engineering Joint Major'),
(156, 'University of California, Berkeley (UCB)', 'Geosystems'),
(157, 'University of California, Berkeley (UCB)', 'Lesbian, Gay, Bisexual, and Transgender Studies'),
(158, 'University of California, Berkeley (UCB)', 'New Media'),
(159, 'University of California, Berkeley (UCB)', 'Social and Cultural Factors in Environmental Design'),
(160, 'University of Toronto', 'Biological Chemistry'),
(161, 'University of Toronto', 'Computer Science'),
(162, 'University of Toronto', 'Environmental Chemistry'),
(163, 'University of Toronto', 'Geographical Information Systems'),
(164, 'University of Toronto', 'Italian'),
(165, 'University of Toronto', 'Mental Health Studies'),
(166, 'University of Toronto', 'Planetary Science'),
(167, 'University of Toronto', 'Urban Studies'),
(168, 'University of Manchester', 'Accounting and Finance'),
(169, 'University of Manchester', 'Civil Engineering'),
(170, 'University of Manchester', 'Environmental Sciences'),
(171, 'University of Manchester', 'Leadership & Management (Education)'),
(172, 'University of Manchester', 'Pharmacy and Pharmaceutical Sciences'),
(173, 'University of Manchester', 'Speech and Hearing'),
(174, 'Peking University', 'Probability   and Statistics'),
(175, 'Peking University', 'Intelligence   Science and Technology'),
(176, 'Peking University', 'Chemical   Biology'),
(177, 'Peking University', 'Geochemical'),
(178, 'King\'s College London', 'BEng Electronic Engineering'),
(179, 'King\'s College London', 'BSc Computer Science with Management & a Year Abroad'),
(180, 'King\'s College London', 'MSc Advanced Computing'),
(181, 'King\'s College London', 'MSc Electronic Engineering with Management'),
(182, 'King\'s College London', 'MSc Urban Informatics'),
(183, 'University of California, Los Angeles (UCLA)', 'Anthropology'),
(184, 'University of California, Los Angeles (UCLA)', 'Civil and Environmental Engineering'),
(185, 'University of California, Los Angeles (UCLA)', 'Epidemiology'),
(186, 'University of California, Los Angeles (UCLA)', 'International Development Studies'),
(187, 'University of California, Los Angeles (UCLA)', 'Molecular and Medical Pharmacology'),
(188, 'University of California, Los Angeles (UCLA)', 'Psychobiology'),
(189, 'Hong Kong University of Science and Technology', 'BEng in Chemical Engineering'),
(190, 'Hong Kong University of Science and Technology', 'BEng in Computer Engineering'),
(191, 'Hong Kong University of Science and Technology', 'BEng in Industrial Engineering and Engineering Management'),
(192, 'Hong Kong University of Science and Technology', 'BSc in Data Science and Technology'),
(193, 'McGill University', 'Accounting'),
(194, 'McGill University', 'Computer Science (Faculty of Arts)'),
(195, 'McGill University', 'Entrepreneurship for Science Students (Faculty of Science)'),
(196, 'McGill University', 'International Business'),
(197, 'McGill University', 'Music Entrepreneurship'),
(198, 'McGill University', 'Religion and Globalization'),
(199, 'Northwestern University', 'Accounting Information and ManagementPhD'),
(200, 'Northwestern University', 'Computer Science and Learning SciencesPhD'),
(201, 'Northwestern University', 'Health Sciences Integrated ProgramPhD'),
(202, 'Northwestern University', 'Medical AnthropologyPhD/MPH'),
(203, 'Northwestern University', 'Screen CulturesPhD'),
(204, 'University of Kyoto', 'Activity Database on Education and Research'),
(205, 'University of Kyoto', '【International Graduate Programme for East Asia Sustainable Economic Development Studies 】'),
(206, 'University of Kyoto', '【Integrated Engineering Course, Human Security Engineering Field】'),
(207, 'University of Kyoto', '【International Course in Intelligence Science and Technology】'),
(208, 'University of Kyoto', '【Global Frontier in Life Science Program】'),
(209, 'University of Kyoto', '【International Project Management Course】'),
(210, 'Seoul National University', 'H: Homepage, C: Curriculum, E: English-taught Courses'),
(211, 'Seoul National University', 'Mechanical Engineering  H C E'),
(212, 'Seoul National University', 'Dept. of Electrical and Computer Engineering  H C E'),
(213, 'Seoul National University', 'Dept. of Architecture and Architectural Engineering   Architecture  H C E    Architecture Engineering  H C E'),
(214, 'Seoul National University', 'Dept. of Industrial Engineering  H C E'),
(215, 'Seoul National University', 'Dept. of Naval Architecture and Ocean Engineering  H C E'),
(216, 'Hong Kong University of Science and Technology', 'BEng in Chemical Engineering'),
(217, 'Hong Kong University of Science and Technology', 'BEng in Computer Engineering'),
(218, 'Hong Kong University of Science and Technology', 'BEng in Industrial Engineering and Engineering Management'),
(219, 'Hong Kong University of Science and Technology', 'BSc in Data Science and Technology'),
(220, 'London School of Economics and Political Science (LSE)', 'Undergraduate\n                             BA Anthropology and Law'),
(221, 'London School of Economics and Political Science (LSE)', 'Undergraduate\n                             BA History'),
(222, 'London School of Economics and Political Science (LSE)', 'Undergraduate\n                             BSc Actuarial Science'),
(223, 'London School of Economics and Political Science (LSE)', 'Undergraduate\n                             BSc Econometrics and Mathematical Economics'),
(224, 'London School of Economics and Political Science (LSE)', 'Undergraduate\n                             BSc Economic History and Geography'),
(225, 'University of Melbourne', 'Master of Engineering (Civil with Business)'),
(226, 'University of Melbourne', 'Master of Engineering (Materials)'),
(227, 'University of Melbourne', 'Master of Engineering (Software with Business)'),
(228, 'University of Melbourne', 'Master of Engineering Structures'),
(229, 'University of Melbourne', 'Master of Geoscience'),
(230, 'University of Melbourne', 'Master of Philosophy (Engineering and IT)'),
(231, 'University of Melbourne', 'Master of Science (Computer Science)'),
(232, 'KAIST - Korea Advanced Institute of Science & Technology', 'Aerospace Engineering'),
(233, 'KAIST - Korea Advanced Institute of Science & Technology', 'Chemical and Biomolecular Engineering'),
(234, 'KAIST - Korea Advanced Institute of Science & Technology', 'Industrial & System Engineering'),
(235, 'KAIST - Korea Advanced Institute of Science & Technology', 'Materials Science & Engineering'),
(236, 'KAIST - Korea Advanced Institute of Science & Technology', 'Nuclear & Quantum Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`, `remember_token`, `token`) VALUES
(9, 'masudurhimel', 'Md. Masudur Rahman', 'masudurhimel@gmail.com', NULL, '$2y$10$aXdsA4W7lSuPJZ8fS6ZlF.xxFjAmUGIazH8D46fDwpp8NVdYZCRGu', '2019-03-17 14:06:40', '2019-03-30 14:00:22', 'O7hJz0wsXXbIiC2zOVvpojg4OjKUMywZfz2wpjGtHwhpcDBcHGbyii0KgB6d', NULL),
(10, 'ridwanshourov', 'Ridwan Shourov', 'ridwanshourov@gmail.com', NULL, '$2y$10$OyoK5rUrCQVIHbwVgluJSO/Zu3MrTLJGgSa5QLCH0LV.zcPA9Ezzy', '2019-04-13 10:35:41', '2019-04-13 10:50:27', NULL, NULL),
(11, 'rizonssh', 'Rabius Sunny', 'rabuis@gmail.com', NULL, '$2y$10$1wRzV9DT.us0YLQIjoWW.O5crz54ILm6SLgF4fWQeNBB53.lIu1/m', '2019-04-13 10:37:15', '2019-04-13 10:50:21', NULL, NULL),
(12, 'toushuju', 'Taowshiqur Rahman', 'toshu@gmail.com', NULL, '$2y$10$dpGVHm7F7CyBN4y6NZwc1Oj3H4iioyV.1gFjGfIoUk5El2M4OTjIO', '2019-04-13 10:39:18', '2019-04-13 10:50:17', NULL, NULL),
(13, 'bishwabrac', 'Bishwajit Ghosh', 'bishwa@gmail.com', NULL, '$2y$10$94MgQCuVGb1o1JJ66AiajeMOu0ua7JRJYqkgQ.togmW/8/lqJmPPG', '2019-04-13 10:41:05', '2019-04-13 10:50:14', NULL, NULL),
(14, 'nabilNSU', 'Nabil Shahriar', 'nabil@gmail.com', NULL, '$2y$10$jbx8Ymids1GrwS5ixoEBvuvvww4ooYLf3bXxU4v1ePf6HbrMGuVxm', '2019-04-13 10:42:21', '2019-04-13 10:50:08', NULL, NULL),
(15, 'muniraRahman', 'Munira  Rahman', 'munira@gmail.com', NULL, '$2y$10$nuL3zYB7/obfkOTjxq0dj.Xb.qxr4PO4doUA14LXUmbQ2D5mGQ4NS', '2019-04-13 10:43:49', '2019-04-13 10:50:03', NULL, NULL),
(16, 'engrmizan', 'Mizanur Rahman', 'engrmizan@gmail.com', NULL, '$2y$10$zZ/CxlYyrKx48UhmwuwYcuygJslhYxoTx1JqGqBvgdPAdOOcHSphe', '2019-04-13 10:48:46', '2019-04-13 10:49:59', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitive_entrance_exams`
--
ALTER TABLE `competitive_entrance_exams`
  ADD KEY `competitive_entrance_exams_username_foreign` (`username`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country`);

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD KEY `FKusername` (`username`);

--
-- Indexes for table `student_acceptance`
--
ALTER TABLE `student_acceptance`
  ADD PRIMARY KEY (`acceptance_id`),
  ADD UNIQUE KEY `student_acceptance_username_unique` (`username`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `universities_name_unique` (`name`);

--
-- Indexes for table `universities_requirements`
--
ALTER TABLE `universities_requirements`
  ADD PRIMARY KEY (`uni_id`),
  ADD UNIQUE KEY `universities_requirements_university_name_unique` (`university_name`);

--
-- Indexes for table `university_programs`
--
ALTER TABLE `university_programs`
  ADD PRIMARY KEY (`uni_prog_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_acceptance`
--
ALTER TABLE `student_acceptance`
  MODIFY `acceptance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `universities_requirements`
--
ALTER TABLE `universities_requirements`
  MODIFY `uni_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university_programs`
--
ALTER TABLE `university_programs`
  MODIFY `uni_prog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `competitive_entrance_exams`
--
ALTER TABLE `competitive_entrance_exams`
  ADD CONSTRAINT `competitive_entrance_exams_username_foreign` FOREIGN KEY (`username`) REFERENCES `students` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FKusername` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
