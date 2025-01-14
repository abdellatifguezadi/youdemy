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
    name VARCHAR(100) NOT NULL,
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
    video_url VARCHAR(255),
    document TEXT,
    photo_url VARCHAR(255),
    teacher_id INT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT check_content CHECK (
        (video_url IS NOT NULL AND document IS NULL) OR 
        (video_url IS NULL AND document IS NOT NULL)
    )
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

INSERT INTO users (name, email, password, role_id) VALUES
('Admin System', 'admin@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('John Doe', 'john.doe@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Jane Smith', 'jane.smith@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Bob Johnson', 'bob.johnson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3);

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
INSERT INTO courses (title, description, video_url, document, photo_url, teacher_id, category_id) VALUES
('Introduction à PHP', 'Apprenez les bases de PHP', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=500', 2, 1),
('JavaScript Avancé', 'Maîtrisez JavaScript', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 2, 1),
('Design UI/UX', 'Principes de design moderne', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2),
('Marketing Digital', 'Stratégies de marketing en ligne', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 3, 3);

-- Ajout de 18 nouveaux cours
INSERT INTO courses (title, description, video_url, document, photo_url, teacher_id, category_id) VALUES
-- Programmation (Category 1)
('Laravel Framework', 'Développez des applications web robustes avec Laravel', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 2, 1),
('React.js Mastery', 'Créez des interfaces modernes avec React', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=500', 3, 1),
('Python pour Data Science', 'Analyse de données avec Python', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500', 2, 1),
('Vue.js 3 Complete', 'Maîtrisez Vue.js et son écosystème', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 3, 1),
('Node.js Backend', 'Développement backend avec Node.js', '/uploads/courses/videos/nodejs.mp4', NULL, 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 2, 1),

-- Design (Category 2)
('Figma Masterclass', 'Design d\'interfaces avec Figma', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2),
('Adobe XD Pro', 'Prototypage avancé avec Adobe XD', '/uploads/courses/videos/xd.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 2, 2),
('Design System', 'Créez des systèmes de design cohérents', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2),
('Motion Design', 'Animation et motion design', '/uploads/courses/videos/motion.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 2, 2),
('UX Writing', 'L\'art d\'écrire pour les interfaces', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 3, 2),

-- Business (Category 3)
('Growth Hacking', 'Stratégies de croissance rapide', '/uploads/courses/videos/growth.mp4', NULL, 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 2, 3),
('SEO Avancé', 'Optimisation pour les moteurs de recherche', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 3, 3),
('E-commerce Strategy', 'Développez votre business en ligne', '/uploads/courses/videos/ecommerce.mp4', NULL, 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 2, 3),
('Personal Branding', 'Construisez votre marque personnelle', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=500', 3, 3),

-- Langues (Category 4)
('English for Business', 'Anglais professionnel', '/uploads/courses/videos/business-english.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 2, 4),
('Spanish Beginner', 'Espagnol pour débutants', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 3, 4),
('French Advanced', 'Français niveau avancé', '/uploads/courses/videos/french.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 2, 4),
('Japanese Culture & Language', 'Initiation au japonais', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 3, 4);

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

