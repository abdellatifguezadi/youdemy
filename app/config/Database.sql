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
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
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
    student_id INT,
    course_id INT,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
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
('Bob Johnson', 'bob.johnson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3),
('Sarah Wilson', 'sarah.wilson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Michael Brown', 'michael.brown@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Emily Davis', 'emily.davis@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('David Miller', 'david.miller@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Lisa Anderson', 'lisa.anderson@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2);
-- Ajout de nouveaux étudiants


-- Ajout de nouvelles inscriptions
INSERT INTO enrollments (student_id, course_id) VALUES
(5, 1),  -- Sarah s'inscrit au cours PHP
(5, 3),  -- Sarah s'inscrit au cours Design UI/UX
(6, 2),  -- Mike s'inscrit au cours JavaScript Avancé
(6, 5),  -- Mike s'inscrit au cours Laravel Framework
(7, 10); -- Emma s'inscrit au cours Figma Masterclass

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


-- Ajout de quelques commentaires
INSERT INTO comments (content, user_id, course_id) VALUES
('Excellent cours pour débuter!', 4, 1),
('Contenu très bien structuré', 4, 2); 

-- Ajout de nouvelles inscriptions
INSERT INTO enrollments (student_id, course_id) VALUES
(4, 1),  -- Bob s'inscrit au cours PHP
(4, 2),  -- Bob s'inscrit au cours JavaScript
(4, 3),  -- Bob s'inscrit au cours Design UI/UX
(4, 5),  -- Bob s'inscrit au cours Laravel
(4, 6),  -- Bob s'inscrit au cours React.js
(4, 10), -- Bob s'inscrit au cours Figma
(4, 15); -- Bob s'inscrit au cours Growth Hacking

-- Ajout de plus d'inscriptions
INSERT INTO enrollments (student_id, course_id) VALUES
-- Bob (id: 4) s'inscrit à d'autres cours
(4, 7),  -- Python pour Data Science
(4, 8),  -- Vue.js 3 Complete
(4, 9),  -- Node.js Backend
(4, 11), -- Adobe XD Pro
(4, 12), -- Design System
(4, 13), -- Motion Design
(4, 14), -- UX Writing
(4, 16), -- SEO Avancé
(4, 17), -- E-commerce Strategy
(4, 18), -- Personal Branding
(4, 19), -- English for Business
(4, 20), -- Spanish Beginner

-- Sarah (id: 5) s'inscrit à plusieurs cours
(5, 2),  -- JavaScript Avancé
(5, 4),  -- Marketing Digital
(5, 5),  -- Laravel Framework
(5, 6),  -- React.js Mastery
(5, 7),  -- Python pour Data Science
(5, 8),  -- Vue.js 3 Complete
(5, 10), -- Figma Masterclass
(5, 15), -- Growth Hacking
(5, 19), -- English for Business
(5, 21), -- French Advanced

-- Michael (id: 6) s'inscrit à plusieurs cours
(6, 1),  -- Introduction à PHP
(6, 3),  -- Design UI/UX
(6, 4),  -- Marketing Digital
(6, 7),  -- Python pour Data Science
(6, 9),  -- Node.js Backend
(6, 10), -- Figma Masterclass
(6, 11), -- Adobe XD Pro
(6, 13), -- Motion Design
(6, 15), -- Growth Hacking
(6, 16), -- SEO Avancé

-- Emily (id: 7) s'inscrit à plusieurs cours
(7, 2),  -- JavaScript Avancé
(7, 3),  -- Design UI/UX
(7, 5),  -- Laravel Framework
(7, 6),  -- React.js Mastery
(7, 8),  -- Vue.js 3 Complete
(7, 11), -- Adobe XD Pro
(7, 12), -- Design System
(7, 14), -- UX Writing
(7, 17), -- E-commerce Strategy
(7, 20), -- Spanish Beginner

-- David (id: 8) s'inscrit à plusieurs cours
(8, 1),  -- Introduction à PHP
(8, 4),  -- Marketing Digital
(8, 7),  -- Python pour Data Science
(8, 9),  -- Node.js Backend
(8, 13), -- Motion Design
(8, 15), -- Growth Hacking
(8, 16), -- SEO Avancé
(8, 18), -- Personal Branding
(8, 19), -- English for Business
(8, 22); -- Japanese Culture & Language

-- Ajout de cours pour les autres enseignants
INSERT INTO courses (title, description, video_url, document, photo_url, teacher_id, category_id) VALUES
-- Cours de Sarah Wilson (id: 5)
('Advanced CSS Techniques', 'Maîtrisez les techniques CSS avancées', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500', 5, 1),
('TypeScript Fundamentals', 'Les bases de TypeScript', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=500', 5, 1),
('React Native Mobile', 'Développement d\'applications mobiles', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500', 5, 1),

-- Cours de Michael Brown (id: 6)
('Machine Learning Basics', 'Introduction au Machine Learning', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1527474305487-b87b222841cc?w=500', 6, 1),
('Data Visualization', 'Techniques de visualisation des données', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500', 6, 1),
('Cloud Computing AWS', 'Services Amazon Web Services', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=500', 6, 1),

-- Cours de Emily Davis (id: 7)
('Advanced Photoshop', 'Techniques avancées de Photoshop', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500', 7, 2),
('3D Modeling', 'Modélisation 3D avec Blender', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1615648178124-01f7162ceac4?w=500', 7, 2),
('Logo Design Masterclass', 'L\'art de créer des logos mémorables', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1557683311-eac922347aa1?w=500', 7, 2),

-- Cours de David Miller (id: 8)
('Digital Marketing Strategy', 'Stratégies de marketing numérique', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?w=500', 8, 3),
('Social Media Management', 'Gestion des réseaux sociaux', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1562577309-4932fdd64cd1?w=500', 8, 3),
('Content Marketing', 'Création de contenu marketing', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500', 8, 3),

-- Cours de Lisa Anderson (id: 9)
('Business English Advanced', 'Anglais des affaires niveau avancé', 'https://www.w3schools.com/html/mov_bbb.mp4', NULL, 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=500', 9, 4),
('German for Beginners', 'Allemand pour débutants', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'https://images.unsplash.com/photo-1527866959252-deab85ef7d1b?w=500', 9, 4),
('Italian Language & Culture', 'Langue et culture italiennes', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4', NULL, 'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=500', 9, 4);

-- Association des tags aux nouveaux cours
INSERT INTO course_tags (course_id, tag_id) VALUES
-- Cours de Sarah Wilson
(23, 3), (23, 4), (23, 10), -- Advanced CSS
(24, 2), (24, 9),          -- TypeScript
(25, 2), (25, 10),         -- React Native

-- Cours de Michael Brown
(26, 6), (26, 9),          -- Machine Learning
(27, 6), (27, 10),         -- Data Visualization
(28, 6), (28, 9),          -- Cloud Computing

-- Cours de Emily Davis
(29, 7), (29, 10),         -- Advanced Photoshop
(30, 7), (30, 9),          -- 3D Modeling
(31, 7), (31, 10),         -- Logo Design

-- Cours de David Miller
(32, 8), (32, 10),         -- Digital Marketing
(33, 8), (33, 9),          -- Social Media
(34, 8), (34, 10),         -- Content Marketing

-- Cours de Lisa Anderson
(35, 10), (35, 8),         -- Business English
(36, 9), (36, 8),          -- German
(37, 9), (37, 8);          -- Italian

