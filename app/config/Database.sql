
CREATE DATABASE IF NOT EXISTS youdemy;
USE youdemy;


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
    CONSTRAINT check_content CHECK (video_path IS NOT NULL OR document_path IS NOT NULL) 
);

-- Table de relation cours-tags (Many-to-Many)
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




INSERT INTO roles (name) VALUES 
('admin'),
('teacher'),
('student');


INSERT INTO users (firstname, lastname, email, password, role_id) VALUES
('Admin', 'System', 'admin@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1), -- password: 'password'
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


INSERT INTO courses (title, description, video_path, document_path, photo_url, teacher_id, category_id) VALUES
('Introduction à PHP', 'Apprenez les bases de PHP', '/courses/php-intro.mp4', '/courses/php-intro.pdf', '/images/courses/php-intro.jpg', 2, 1),
('JavaScript Avancé', 'Maîtrisez JavaScript', '/courses/js-advanced.mp4', NULL, '/images/courses/js-advanced.jpg', 2, 1),
('Design UI/UX', 'Principes de design moderne', NULL, '/courses/uiux-design.pdf', '/images/courses/uiux-design.jpg', 3, 2),
('Marketing Digital', 'Stratégies de marketing en ligne', '/courses/marketing.mp4', '/courses/digital-marketing.pdf', '/images/courses/digital-marketing.jpg', 3, 3);


INSERT INTO course_tags (course_id, tag_id) VALUES
(1, 1), 
(1, 9), 
(2, 2), 
(2, 10), 
(3, 7), 
(4, 8); 


INSERT INTO enrollments (student_id, course_id) VALUES
(4, 1),
(4, 2); 


INSERT INTO comments (content, user_id, course_id) VALUES
('Excellent cours pour débuter!', 4, 1),
('Contenu très bien structuré', 4, 2); 