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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.categories : ~6 rows (environ)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
	(1, 'Programmation', 'Cours de programmation et développement'),
	(2, 'Design', 'Cours de design graphique et UI/UX'),
	(3, 'Business', 'Cours de business et entrepreneuriat'),
	(4, 'Langues', 'Cours de langues étrangères'),
	(5, 'testing', 'test'),
	(6, 'testing2', 'test test');

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

-- Listage des données de la table youdemy.comments : ~2 rows (environ)
DELETE FROM `comments`;
INSERT INTO `comments` (`id`, `content`, `user_id`, `course_id`, `created_at`) VALUES
	(1, 'Excellent cours pour débuter!', 4, 1, '2025-01-16 19:54:28'),
	(2, 'Contenu très bien structuré', 4, 2, '2025-01-16 19:54:28');

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
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE cascade ON UPDATE CASCADE,
  CONSTRAINT `check_content` CHECK ((((`video_url` is not null) and (`document` is null)) or ((`video_url` is null) and (`document` is not null))))
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.courses : ~34 rows (environ)
DELETE FROM `courses`;
INSERT INTO `courses` (`id`, `title`, `description`, `video_url`, `document`, `photo_url`, `teacher_id`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Introduction à PHP', 'Apprenez les bases de PHP', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=500', 2, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(2, 'JavaScript Avancé', 'Maîtrisez JavaScript', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 2, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(3, 'Design UI/UX', 'Principes de design moderne', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(4, 'Marketing Digital', 'Stratégies de marketing en ligne', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 3, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(5, 'Laravel Framework', 'Développez des applications web robustes avec Laravel', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 2, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(6, 'React.js Mastery', 'Créez des interfaces modernes avec React', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=500', 3, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(7, 'Python pour Data Science', 'Analyse de données avec Python', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500', 2, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(8, 'Vue.js 3 Complete', 'Maîtrisez Vue.js et son écosystème', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 3, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(9, 'Node.js Backend', 'Développement backend avec Node.js', '/uploads/courses/videos/nodejs.mp4', NULL, 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 2, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(10, 'Figma Masterclass', 'Design d\'interfaces avec Figma', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(11, 'Adobe XD Pro', 'Prototypage avancé avec Adobe XD', '/uploads/courses/videos/xd.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 2, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(12, 'Design System', 'Créez des systèmes de design cohérents', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(13, 'Motion Design', 'Animation et motion design', '/uploads/courses/videos/motion.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 2, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(14, 'UX Writing', 'L\'art d\'écrire pour les interfaces', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(15, 'Growth Hacking', 'Stratégies de croissance rapide', '/uploads/courses/videos/growth.mp4', NULL, 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 2, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(16, 'SEO Avancé', 'Optimisation pour les moteurs de recherche', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 3, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(17, 'E-commerce Strategy', 'Développez votre business en ligne', '/uploads/courses/videos/ecommerce.mp4', NULL, 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 2, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(18, 'Personal Branding', 'Construisez votre marque personnelle', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 3, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(19, 'English for Business', 'Anglais professionnel', '/uploads/courses/videos/business-english.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 2, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(20, 'Spanish Beginner', 'Espagnol pour débutants', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 3, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(21, 'French Advanced', 'Français niveau avancé', '/uploads/courses/videos/french.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 2, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(22, 'Japanese Culture & Language', 'Initiation au japonais', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 3, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(23, 'Advanced CSS Techniques', 'Maîtrisez les techniques CSS avancées', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 5, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(24, 'TypeScript Fundamentals', 'Les bases de TypeScript', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=500', 5, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(25, 'React Native Mobile', 'Développement d\'applications mobiles', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500', 5, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(26, 'Machine Learning Basics', 'Introduction au Machine Learning', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1527474305487-b87b222841cc?w=500', 6, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(27, 'Data Visualization', 'Techniques de visualisation des données', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500', 6, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(28, 'Cloud Computing AWS', 'Services Amazon Web Services', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=500', 6, 1, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(29, 'Advanced Photoshop', 'Techniques avancées de Photoshop', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 7, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(31, 'Logo Design Masterclass', 'L\'art de créer des logos mémorables', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1557683311-eac922347aa1?w=500', 7, 2, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(32, 'Digital Marketing Strategy', 'Stratégies de marketing numérique', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 8, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(34, 'Content Marketing', 'Création de contenu marketing', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500', 8, 3, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(35, 'Business English Advanced', 'Anglais des affaires niveau avancé', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 9, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28'),
	(36, 'German for Beginners', 'Allemand pour débutants', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1527866959252-deab85ef7d1b?w=500', 9, 4, '2025-01-16 19:54:28', '2025-01-16 19:54:28');

-- Listage de la structure de table youdemy. course_tags
CREATE TABLE IF NOT EXISTS `course_tags` (
  `course_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`course_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `course_tags_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.course_tags : ~69 rows (environ)
DELETE FROM `course_tags`;
INSERT INTO `course_tags` (`course_id`, `tag_id`) VALUES
	(1, 1),
	(5, 1),
	(2, 2),
	(6, 2),
	(8, 2),
	(9, 2),
	(24, 2),
	(25, 2),
	(23, 3),
	(23, 4),
	(7, 6),
	(26, 6),
	(27, 6),
	(28, 6),
	(3, 7),
	(10, 7),
	(11, 7),
	(12, 7),
	(13, 7),
	(14, 7),
	(29, 7),
	(31, 7),
	(4, 8),
	(15, 8),
	(16, 8),
	(17, 8),
	(18, 8),
	(19, 8),
	(20, 8),
	(21, 8),
	(22, 8),
	(32, 8),
	(34, 8),
	(35, 8),
	(36, 8),
	(1, 9),
	(3, 9),
	(4, 9),
	(6, 9),
	(8, 9),
	(10, 9),
	(13, 9),
	(14, 9),
	(17, 9),
	(18, 9),
	(19, 9),
	(20, 9),
	(22, 9),
	(24, 9),
	(26, 9),
	(28, 9),
	(36, 9),
	(2, 10),
	(5, 10),
	(7, 10),
	(9, 10),
	(11, 10),
	(12, 10),
	(15, 10),
	(16, 10),
	(21, 10),
	(23, 10),
	(25, 10),
	(27, 10),
	(29, 10),
	(31, 10),
	(32, 10),
	(34, 10),
	(35, 10);

-- Listage de la structure de table youdemy. enrollments
CREATE TABLE IF NOT EXISTS `enrollments` (
  `student_id` int NOT NULL,
  `course_id` int NOT NULL,
  `enrollment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.enrollments : ~59 rows (environ)
DELETE FROM `enrollments`;
INSERT INTO `enrollments` (`student_id`, `course_id`, `enrollment_date`) VALUES
	(4, 1, '2025-01-16 19:54:28'),
	(4, 2, '2025-01-16 19:54:28'),
	(4, 3, '2025-01-16 19:54:28'),
	(4, 5, '2025-01-16 19:54:28'),
	(4, 6, '2025-01-16 19:54:28'),
	(4, 7, '2025-01-16 19:54:28'),
	(4, 8, '2025-01-16 19:54:28'),
	(4, 9, '2025-01-16 19:54:28'),
	(4, 10, '2025-01-16 19:54:28'),
	(4, 11, '2025-01-16 19:54:28'),
	(4, 12, '2025-01-16 19:54:28'),
	(4, 13, '2025-01-16 19:54:28'),
	(4, 14, '2025-01-16 19:54:28'),
	(4, 15, '2025-01-16 19:54:28'),
	(4, 16, '2025-01-16 19:54:28'),
	(4, 17, '2025-01-16 19:54:28'),
	(4, 18, '2025-01-16 19:54:28'),
	(4, 19, '2025-01-16 19:54:28'),
	(4, 20, '2025-01-16 19:54:28'),
	(5, 2, '2025-01-16 19:54:28'),
	(5, 4, '2025-01-16 19:54:28'),
	(5, 5, '2025-01-16 19:54:28'),
	(5, 6, '2025-01-16 19:54:28'),
	(5, 7, '2025-01-16 19:54:28'),
	(5, 8, '2025-01-16 19:54:28'),
	(5, 10, '2025-01-16 19:54:28'),
	(5, 15, '2025-01-16 19:54:28'),
	(5, 19, '2025-01-16 19:54:28'),
	(5, 21, '2025-01-16 19:54:28'),
	(6, 1, '2025-01-16 19:54:28'),
	(6, 3, '2025-01-16 19:54:28'),
	(6, 4, '2025-01-16 19:54:28'),
	(6, 7, '2025-01-16 19:54:28'),
	(6, 9, '2025-01-16 19:54:28'),
	(6, 10, '2025-01-16 19:54:28'),
	(6, 11, '2025-01-16 19:54:28'),
	(6, 13, '2025-01-16 19:54:28'),
	(6, 15, '2025-01-16 19:54:28'),
	(6, 16, '2025-01-16 19:54:28'),
	(7, 2, '2025-01-16 19:54:28'),
	(7, 3, '2025-01-16 19:54:28'),
	(7, 5, '2025-01-16 19:54:28'),
	(7, 6, '2025-01-16 19:54:28'),
	(7, 8, '2025-01-16 19:54:28'),
	(7, 11, '2025-01-16 19:54:28'),
	(7, 12, '2025-01-16 19:54:28'),
	(7, 14, '2025-01-16 19:54:28'),
	(7, 17, '2025-01-16 19:54:28'),
	(7, 20, '2025-01-16 19:54:28'),
	(8, 1, '2025-01-16 19:54:28'),
	(8, 4, '2025-01-16 19:54:28'),
	(8, 7, '2025-01-16 19:54:28'),
	(8, 9, '2025-01-16 19:54:28'),
	(8, 13, '2025-01-16 19:54:28'),
	(8, 15, '2025-01-16 19:54:28'),
	(8, 16, '2025-01-16 19:54:28'),
	(8, 18, '2025-01-16 19:54:28'),
	(8, 19, '2025-01-16 19:54:28'),
	(8, 22, '2025-01-16 19:54:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.tags : ~17 rows (environ)
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
	(20, 'test', '2025-01-17 09:03:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table youdemy.users : ~9 rows (environ)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `is_active`, `created_at`) VALUES
	(1, 'Admin System', 'admin@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '2025-01-16 19:54:27'),
	(2, 'John Doe', 'john.doe@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(3, 'Jane Smith', 'jane.smith@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(4, 'Bob Johnson', 'bob.johnson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 1, '2025-01-16 19:54:27'),
	(5, 'Sarah Wilson', 'sarah.wilson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(6, 'Michael Brown', 'michael.brown@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(7, 'Emily Davis', 'emily.davis@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(8, 'David Miller', 'david.miller@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27'),
	(9, 'Lisa Anderson', 'lisa.anderson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1, '2025-01-16 19:54:27');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
