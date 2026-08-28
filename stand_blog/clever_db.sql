-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 أغسطس 2026 الساعة 21:55
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clever_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `about`
--

CREATE TABLE `about` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `item1_title` varchar(255) DEFAULT NULL,
  `item1_description` text DEFAULT NULL,
  `item2_title` varchar(255) DEFAULT NULL,
  `item2_description` text DEFAULT NULL,
  `item3_title` varchar(255) DEFAULT NULL,
  `item3_description` text DEFAULT NULL,
  `item4_title` varchar(255) DEFAULT NULL,
  `item4_description` text DEFAULT NULL,
  `item5_title` varchar(255) DEFAULT NULL,
  `item5_description` text DEFAULT NULL,
  `item6_title` varchar(255) DEFAULT NULL,
  `item6_description` text DEFAULT NULL,
  `item7_title` varchar(255) DEFAULT NULL,
  `item7_description` text DEFAULT NULL,
  `item8_title` varchar(255) DEFAULT NULL,
  `item8_description` text DEFAULT NULL,
  `item9_title` varchar(255) DEFAULT NULL,
  `item9_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `about`
--

INSERT INTO `about` (`id`, `image`, `title`, `description`, `item1_title`, `item1_description`, `item2_title`, `item2_description`, `item3_title`, `item3_description`, `item4_title`, `item4_description`, `item5_title`, `item5_description`, `item6_title`, `item6_description`, `item7_title`, `item7_description`, `item8_title`, `item8_description`, `item9_title`, `item9_description`) VALUES
(1, '1787946716_صوره.jpg', 'About Clever Mind POB ICT test sara abuodeh', 'Clever Mind POB ICT is a technology company providing innovative digital and web development solutions.2004', 'Web Development', 'We develop modern and responsive websites using modern web technologies.', 'Software Development', 'We provide software development solutions according to client requirements.', 'Digital Solutions', 'We create digital solutions that help businesses improve their online presence.', 'Creative Design', 'We create modern and user-friendly designs for digital products.', 'UI/UX Design', 'We focus on creating simple and user-friendly experiences.', 'Mobile Applications', 'We provide modern solutions for mobile application development.', 'Technology Solutions', 'We use modern technologies to build reliable digital solutions.', 'Training sara', 'We provide programming and technology training.', 'Innovation', 'We continuously work on innovative ideas and modern technology solutions.');

-- --------------------------------------------------------

--
-- بنية الجدول `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `blogger_name` varchar(150) NOT NULL,
  `publish_date` date NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `blogs`
--

INSERT INTO `blogs` (`id`, `image`, `title`, `subtitle`, `blogger_name`, `publish_date`, `description`, `created_at`) VALUES
(1, 'blog-thumb-01.jpg', 'Digital Transformation', 'The Future of Digital Technology', 'Clever Mind Team', '2026-08-01', 'Digital transformation is changing the way businesses work and communicate with their customers.', '2026-08-28 18:07:31'),
(2, 'blog-thumb-02.jpg', 'Modern Web Development', 'Building Better Web Experiences', 'Clever Mind Team', '2026-08-05', 'Modern web development focuses on performance, responsive design and excellent user experience.', '2026-08-28 18:07:31'),
(3, 'blog-thumb-03.jpg', 'Technology and Innovation', 'Innovating for a Better Future', 'Clever Mind Team', '2026-08-10', 'Technology and innovation help organizations develop new solutions and improve their services.', '2026-08-28 18:07:31'),
(4, 'blog-thumb-04.jpg', 'UI and UX Design', 'Creating User-Friendly Interfaces', 'Clever Mind Team', '2026-08-15', 'Good UI and UX design creates simple, clear and enjoyable experiences for users.', '2026-08-28 18:07:31'),
(8, 'blog-thumb-05.jpg', 'sara test', 'asoooo', 'Clever Mind Team', '2026-08-08', 'wanna test', '2026-08-28 19:51:02');

-- --------------------------------------------------------

--
-- بنية الجدول `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `guest_name` varchar(150) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `guest_name`, `comment`, `created_at`) VALUES
(1, 1, 'Ahmad nanil', 'Great article. Very useful information.', '2026-08-28 18:09:01'),
(2, 1, 'Sara', 'I really enjoyed reading this post.', '2026-08-28 18:09:01'),
(3, 2, 'Omar', 'Very helpful information about web development.', '2026-08-28 18:09:01'),
(4, 3, 'Lina', 'Technology and innovation are very important topics.', '2026-08-28 18:09:01'),
(5, 4, 'Mohammad', 'The UI and UX information is very helpful.', '2026-08-28 18:09:01'),
(7, 1, 'Gaming Laptop Pro', 'ccccccccccccc', '2026-08-28 19:33:04');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_info`
--

INSERT INTO `contact_info` (`id`, `phone`, `email`, `address`) VALUES
(1, '(079) 534-734-1', 'Clevermindpob@gmail.com', 'ZINC23 Building, Amman, Jordan'),
(2, '0799229200', 'saraaboudeh08@gmail.com', '123.SO');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Test User', 'test@example.com', 'Website Inquiry', 'Hello, I would like to know more about your services.', '2026-08-28 18:10:44'),
(2, 'sara', 'saraaboudeh08@gmail.com', 'test', 'cc', '2026-08-28 19:36:54'),
(3, 'sara', 'saraaboudeh08@gmail.com', 'test', 'cc', '2026-08-28 19:40:46'),
(4, 'nabil', 'saraaboudeh2004@outlook.com', 'test dad', ',,,,,', '2026-08-28 19:54:21');

-- --------------------------------------------------------

--
-- بنية الجدول `social_links`
--

CREATE TABLE `social_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `platform` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `url`) VALUES
(1, 'Instagram.', 'https://www.instagram.com/clevermindpob/'),
(2, 'Twitter', 'https://twitter.com/search?q=cleverMindICT'),
(3, 'Facebook', 'https://www.facebook.com/ClevermindICT/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
