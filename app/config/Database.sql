-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour youdemy
CREATE DATABASE IF NOT EXISTS `youdemy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `youdemy`;

-- Listage de la structure de table youdemy. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.categories : ~5 rows (environ)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
	(1, 'Programmation', 'Cours de programmation et développement'),
	(2, 'Design', 'Cours de design graphique et UI/UX'),
	(3, 'Business', 'Cours de business et entrepreneuriat'),
	(4, 'Langues', 'Cours de langues étrangères'),
	(5, 'testing', 'test');

-- Listage de la structure de table youdemy. comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.comments : ~0 rows (environ)
DELETE FROM `comments`;

-- Listage de la structure de table youdemy. courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `video_url` varchar(255) DEFAULT NULL,
  `document` text,
  `photo_url` varchar(255) DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `check_content` CHECK ((((`video_url` is not null) and (`document` is null)) or ((`video_url` is null) and (`document` is not null))))
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.courses : ~13 rows (environ)
DELETE FROM `courses`;
INSERT INTO `courses` (`id`, `title`, `description`, `video_url`, `document`, `photo_url`, `teacher_id`, `category_id`, `created_at`, `updated_at`) VALUES
	(12, 'Design System', 'Créez des systèmes de design cohérents', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(13, 'Motion Design', 'Animation et motion design', '/uploads/courses/videos/motion.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 2, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(14, 'UX Writing', 'L\'art d\'écrire pour les interfaces', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(16, 'SEO Avancé', 'Optimisation pour les moteurs de recherche', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 3, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(18, 'Personal Branding', 'Construisez votre marque personnelle', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 3, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(19, 'English for Business', 'Anglais professionnel', '/uploads/courses/videos/business-english.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 2, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(20, 'Spanish Beginner', 'Espagnol pour débutants', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 3, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(21, 'French Advanced', 'Français niveau avancé', '/uploads/courses/videos/french.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 2, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(22, 'Japanese Culture & Language', 'Initiation au japonais', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 3, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(26, 'Machine Learning Basics', 'Introduction au Machine Learning', NULL, 'https://www.fmcgastro.org/wp-content/uploads/file/pdf/43_pps.pdf', 'https://images.unsplash.com/photo-1527474305487-b87b222841cc?w=500', 6, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(58, 'busniii', 'Repudiandae praesent php', 'https://v.ftcdn.net/11/37/11/65/700_F_1137116524_kNBt8Yb53APDXKcMt5YMC8HxWLf1ZY3H_ST.mp4', NULL, 'https://img.freepik.com/free-vector/web-design-background_1300-39.jpg?t=st=1737246174~exp=1737249774~hmac=f9739aa9ebbf66f126131f807626e8343674334ac6baa52479f840f204268de0&w=740', 2, 3, '2025-01-19 00:06:39', '2025-01-19 00:43:08'),
	(59, 'Qui veniam voluptas', 'In dolore ab beatae', 'https://v.ftcdn.net/03/64/37/71/700_F_364377166_z8omZEaP0qOhyAv0AD40iAZPFvifQUvF_ST.mp4', NULL, 'https://img.freepik.com/free-vector/web-design-background_1300-39.jpg?t=st=1737246174~exp=1737249774~hmac=f9739aa9ebbf66f126131f807626e8343674334ac6baa52479f840f204268de0&w=740', 2, 3, '2025-01-19 00:35:04', '2025-01-19 19:56:09'),
	(68, 'course', 'Dolores non exercita', 'https://v.ftcdn.net/03/64/37/71/700_F_364377166_z8omZEaP0qOhyAv0AD40iAZPFvifQUvF_ST.mp4', NULL, 'https://img.freepik.com/free-vector/web-design-background_1300-39.jpg?t=st=1737246174~exp=1737249774~hmac=f9739aa9ebbf66f126131f807626e8343674334ac6baa52479f840f204268de0&w=740', 2, 1, '2025-01-20 09:18:27', '2025-01-20 09:18:27');

-- Listage de la structure de table youdemy. course_tags
CREATE TABLE IF NOT EXISTS `course_tags` (
  `course_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`course_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `course_tags_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.course_tags : ~43 rows (environ)
DELETE FROM `course_tags`;
INSERT INTO `course_tags` (`course_id`, `tag_id`) VALUES
	(59, 1),
	(68, 1),
	(59, 2),
	(68, 2),
	(68, 3),
	(58, 4),
	(26, 6),
	(59, 6),
	(12, 7),
	(13, 7),
	(14, 7),
	(58, 7),
	(16, 8),
	(18, 8),
	(19, 8),
	(20, 8),
	(21, 8),
	(22, 8),
	(59, 8),
	(13, 9),
	(14, 9),
	(18, 9),
	(19, 9),
	(20, 9),
	(22, 9),
	(26, 9),
	(68, 9),
	(12, 10),
	(16, 10),
	(21, 10),
	(59, 10),
	(68, 10),
	(58, 12),
	(59, 12),
	(68, 13),
	(59, 15),
	(68, 15),
	(59, 16),
	(68, 16),
	(68, 17),
	(68, 29),
	(68, 31),
	(68, 34);

-- Listage de la structure de table youdemy. enrollments
CREATE TABLE IF NOT EXISTS `enrollments` (
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `status_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.enrollments : ~5 rows (environ)
DELETE FROM `enrollments`;
INSERT INTO `enrollments` (`student_id`, `course_id`, `enrollment_date`, `status`, `status_updated_at`) VALUES
	(11, 12, '2025-01-19 21:44:18', 'pending', '2025-01-19 23:22:44'),
	(11, 58, '2025-01-19 10:58:53', 'approved', '2025-01-19 21:34:30'),
	(11, 59, '2025-01-19 21:35:51', 'approved', '2025-01-20 09:18:51'),
	(14, 19, '2025-01-19 17:57:00', 'approved', '2025-01-19 21:36:40'),
	(14, 58, '2025-01-19 18:50:00', 'approved', '2025-01-19 21:59:52');

-- Listage de la structure de table youdemy. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.roles : ~3 rows (environ)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'admin'),
	(2, 'teacher'),
	(3, 'student');

-- Listage de la structure de table youdemy. tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.tags : ~24 rows (environ)
DELETE FROM `tags`;
INSERT INTO `tags` (`id`, `name`, `created_at`) VALUES
	(1, 'PHP', '2025-01-16 19:54:27'),
	(2, 'JavaScript', '2025-01-16 19:54:27'),
	(3, 'HTML', '2025-01-16 19:54:27'),
	(4, 'CSS', '2025-01-16 19:54:27'),
	(5, 'MySQL', '2025-01-16 19:54:27'),
	(6, 'Python', '2025-01-16 19:54:27'),
	(7, 'UI/UX', '2025-01-16 19:54:27'),
	(8, 'Marketing', '2025-01-16 19:54:27'),
	(9, 'Débutant', '2025-01-16 19:54:27'),
	(10, 'Avancé', '2025-01-16 19:54:27'),
	(12, 'laravel', '2025-01-17 08:37:10'),
	(13, 'tag 2', '2025-01-17 08:37:10'),
	(15, 'figma', '2025-01-17 08:37:10'),
	(16, 'java', '2025-01-17 08:41:25'),
	(17, 'tag 3', '2025-01-17 08:41:25'),
	(18, 'tag 7', '2025-01-17 08:52:33'),
	(20, 'test', '2025-01-17 09:03:14'),
	(21, 'tag 1', '2025-01-17 20:53:48'),
	(22, 'ggg', '2025-01-17 20:53:48'),
	(29, 'tatttt', '2025-01-19 17:46:56'),
	(30, 'tattt', '2025-01-19 17:46:56'),
	(31, 'toooo', '2025-01-19 17:46:56'),
	(33, 'taggg', '2025-01-19 23:24:40'),
	(34, 'yuy', '2025-01-19 23:25:46');

-- Listage de la structure de table youdemy. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.users : ~10 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `is_active`, `created_at`) VALUES
	(1, 'Admin System', 'admin@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '2025-01-16 19:54:27'),
	(2, 'John Doe', 'john.doe@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(3, 'Jane Smith', 'jane.smith@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(4, 'Bob Johnson', 'bob.johnson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 1, '2025-01-16 19:54:27'),
	(6, 'Michael Brown', 'michael.brown@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(11, 'Sonya Gallegos', 'gezix@mailinator.com', '$2y$10$gbLnZGIiJk1HQGvq7xwiH.mLrp5CiJyq7wX1aAEbhoZw0tEpfGmzC', 3, 1, '2025-01-17 21:00:47'),
	(14, 'Kylee Sears', 'mukij@mailinator.com', '$2y$10$41wtX5v8JeFNdGckAG312efFBDniJnk3w69WyB1g/wzwlGVYKNgCi', 3, 1, '2025-01-18 11:18:57'),
	(17, 'Kay Church', 'qedu@mailinator.com', '$2y$10$kV06MglR.KJEaiu.pIdBnOn7hVhngPQ3flZH/QBGH.qSHfWwzd32C', 3, 1, '2025-01-20 09:12:35'),
	(18, 'Walker Dixon', 'visybagah@mailinator.com', '$2y$10$LOK6eGZ.Ro/pTSuuOjK.VOL5fSFQzJQtTMawlOFDV.sYrnTfk.BUq', 2, 1, '2025-01-20 09:13:30'),
	(19, 'Aimee Durham', 'sopizaf@mailinator.com', '$2y$10$X9o.inef5CBbkENV1kG5CeP0geCeRlA5YQ6wIooXgMQ2jzDZuxzV6', 2, 0, '2025-01-20 09:14:01');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
