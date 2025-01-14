-- Suppression de la base de données si elle existe
DROP DATABASE IF EXISTS youdemy;

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS youdemy;
USE youdemy;

-- Création des tables
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    video_path VARCHAR(255),
    document_path VARCHAR(255),
    photo_url VARCHAR(255),
    teacher_id INT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT check_content CHECK (video_path IS NOT NULL OR document_path IS NOT NULL),
    price DECIMAL(10,2) DEFAULT 0.00
);

CREATE TABLE course_tags (
    course_id INT,
    tag_id INT,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    user_id INT,
    course_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Insertion des données de base
INSERT INTO roles (name) VALUES 
('admin'),
('teacher'),
('student');

INSERT INTO users (firstname, lastname, email, password, role_id) VALUES
('Admin', 'System', 'admin@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('John', 'Doe', 'john.doe@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Jane', 'Smith', 'jane.smith@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Bob', 'Johnson', 'bob.johnson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3);

INSERT INTO categories (name, description) VALUES
('Programmation', 'Cours de programmation et développement'),
('Design', 'Cours de design graphique et UI/UX'),
('Business', 'Cours de business et entrepreneuriat'),
('Langues', 'Cours de langues étrangères');

INSERT INTO tags (name) VALUES
('PHP'),
('JavaScript'),
('HTML'),
('CSS'),
('MySQL'),
('Python'),
('UI/UX'),
('Marketing'),
('Débutant'),
('Avancé');

-- Insertion des cours initiaux
INSERT INTO courses (title, description, video_path, document_path, photo_url, teacher_id, category_id, price) VALUES
('Introduction à PHP', 'Apprenez les bases de PHP', '/courses/php-intro.mp4', '/courses/php-intro.pdf', '/images/courses/php-intro.jpg', 2, 1, 0.00),
('JavaScript Avancé', 'Maîtrisez JavaScript', '/courses/js-advanced.mp4', NULL, '/images/courses/js-advanced.jpg', 2, 1, 29.99),
('Design UI/UX', 'Principes de design moderne', NULL, '/courses/uiux-design.pdf', '/images/courses/uiux-design.jpg', 3, 2, 49.99),
('Marketing Digital', 'Stratégies de marketing en ligne', '/courses/marketing.mp4', '/courses/digital-marketing.pdf', '/images/courses/digital-marketing.jpg', 3, 3, 39.99);

-- Ajout de 18 nouveaux cours
INSERT INTO courses (title, description, video_path, document_path, photo_url, teacher_id, category_id, price) VALUES
-- Programmation (Category 1)
('Laravel Framework', 'Développez des applications web robustes avec Laravel', '/courses/laravel.mp4', '/courses/laravel.pdf', '/images/courses/laravel.jpg', 2, 1, 49.99),
('React.js Mastery', 'Créez des interfaces modernes avec React', '/courses/react.mp4', '/courses/react.pdf', '/images/courses/react.jpg', 3, 1, 44.99),
('Python pour Data Science', 'Analyse de données avec Python', '/courses/python-data.mp4', '/courses/python-data.pdf', '/images/courses/python.jpg', 2, 1, 59.99),
('Vue.js 3 Complete', 'Maîtrisez Vue.js et son écosystème', '/courses/vue.mp4', '/courses/vue.pdf', '/images/courses/vue.jpg', 3, 1, 39.99),
('Node.js Backend', 'Développement backend avec Node.js', '/courses/nodejs.mp4', '/courses/nodejs.pdf', '/images/courses/nodejs.jpg', 2, 1, 54.99),

-- Design (Category 2)
('Figma Masterclass', 'Design d\'interfaces avec Figma', '/courses/figma.mp4', '/courses/figma.pdf', '/images/courses/figma.jpg', 3, 2, 49.99),
('Adobe XD Pro', 'Prototypage avancé avec Adobe XD', '/courses/xd.mp4', '/courses/xd.pdf', '/images/courses/xd.jpg', 2, 2, 44.99),
('Design System', 'Créez des systèmes de design cohérents', '/courses/design-system.mp4', '/courses/design-system.pdf', '/images/courses/design-system.jpg', 3, 2, 64.99),
('Motion Design', 'Animation et motion design', '/courses/motion.mp4', '/courses/motion.pdf', '/images/courses/motion.jpg', 2, 2, 69.99),
('UX Writing', 'L\'art d\'écrire pour les interfaces', '/courses/ux-writing.mp4', '/courses/ux-writing.pdf', '/images/courses/ux-writing.jpg', 3, 2, 39.99),

-- Business (Category 3)
('Growth Hacking', 'Stratégies de croissance rapide', '/courses/growth.mp4', '/courses/growth.pdf', '/images/courses/growth.jpg', 2, 3, 79.99),
('SEO Avancé', 'Optimisation pour les moteurs de recherche', '/courses/seo.mp4', '/courses/seo.pdf', '/images/courses/seo.jpg', 3, 3, 69.99),
('E-commerce Strategy', 'Développez votre business en ligne', '/courses/ecommerce.mp4', '/courses/ecommerce.pdf', '/images/courses/ecommerce.jpg', 2, 3, 89.99),
('Personal Branding', 'Construisez votre marque personnelle', '/courses/branding.mp4', '/courses/branding.pdf', '/images/courses/branding.jpg', 3, 3, 49.99),

-- Langues (Category 4)
('English for Business', 'Anglais professionnel', '/courses/business-english.mp4', '/courses/business-english.pdf', '/images/courses/english.jpg', 2, 4, 44.99),
('Spanish Beginner', 'Espagnol pour débutants', '/courses/spanish.mp4', '/courses/spanish.pdf', '/images/courses/spanish.jpg', 3, 4, 39.99),
('French Advanced', 'Français niveau avancé', '/courses/french.mp4', '/courses/french.pdf', '/images/courses/french.jpg', 2, 4, 49.99),
('Japanese Culture & Language', 'Initiation au japonais', '/courses/japanese.mp4', '/courses/japanese.pdf', '/images/courses/japanese.jpg', 3, 4, 54.99);

-- Association des tags aux cours
INSERT INTO course_tags (course_id, tag_id) VALUES
-- Cours initiaux
(1, 1), (1, 9),  -- PHP Intro
(2, 2), (2, 10), -- JavaScript Avancé
(3, 7), (3, 9),  -- Design UI/UX
(4, 8), (4, 9),  -- Marketing Digital

-- Nouveaux cours
(5, 1), (5, 10),  -- Laravel
(6, 2), (6, 9),   -- React
(7, 6), (7, 10),  -- Python
(8, 2), (8, 9),   -- Vue.js
(9, 2), (9, 10),  -- Node.js
(10, 7), (10, 9), -- Figma
(11, 7), (11, 10), -- Adobe XD
(12, 7), (12, 10), -- Design System
(13, 7), (13, 9), -- Motion
(14, 7), (14, 9), -- UX Writing
(15, 8), (15, 10), -- Growth
(16, 8), (16, 10), -- SEO
(17, 8), (17, 9), -- E-commerce
(18, 8), (18, 9), -- Personal Branding
(19, 9), (19, 8), -- English
(20, 9), (20, 8), -- Spanish
(21, 10), (21, 8), -- French
(22, 9), (22, 8); -- Japanese

-- Ajout de quelques inscriptions
INSERT INTO enrollments (student_id, course_id) VALUES
(4, 1), -- Bob s'inscrit au cours PHP
(4, 2); -- Bob s'inscrit au cours JavaScript

-- Ajout de quelques commentaires
INSERT INTO comments (content, user_id, course_id) VALUES
('Excellent cours pour débuter!', 4, 1),
('Contenu très bien structuré', 4, 2); 

