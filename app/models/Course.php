<?php
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/course/VideoCourse.php');
require_once(__DIR__ . '/course/DocumentCourse.php');
require_once 'User.php';
require_once 'Tag.php';

class Course extends Db
{
    private $table = "courses";
    private $user;
    private $tagModel;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
        $this->tagModel = new Tag();
    }

    public function createCourseObject($courseData)
    {
        if (!empty($courseData['video_url'])) {
            return new VideoCourse($courseData);
        } elseif (!empty($courseData['document'])) {
            return new DocumentCourse($courseData);
        }
        return new DocumentCourse($courseData);
    }

    public function searchCourses($keywords = '', $category = '', $tag = '', $limit = null, $offset = null)
    {
        $sql = "SELECT DISTINCT c.*, u.name, cat.name as category_name,
                (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count
                FROM {$this->table} c
                LEFT JOIN users u ON c.teacher_id = u.id
                LEFT JOIN categories cat ON c.category_id = cat.id";

       
        if (!empty($tag)) {
            $sql .= " LEFT JOIN course_tags ct ON c.id = ct.course_id";
        }
        
        $sql .= " WHERE 1=1";
        
        $params = [];
        
        if (!empty($keywords)) {
            $sql .= " AND (c.title LIKE ? OR c.description LIKE ?)";
            $params[] = "%$keywords%";
            $params[] = "%$keywords%";
        }
        
        if (!empty($category)) {
            $sql .= " AND cat.id = ?";
            $params[] = $category;
        }

        if (!empty($tag)) {
            $sql .= " AND ct.tag_id = ?";
            $params[] = $tag;
        }
        
        $sql .= " ORDER BY c.created_at DESC";

        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
            if ($offset !== null) {
                $sql .= " OFFSET " . (int)$offset;
            }
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function($course) {
            $course['tags'] = $this->tagModel->getCourseTags($course['id']);
            return $this->createCourseObject($course);
        }, $courses);
    }

    public function getTotalFilteredCourses($keywords = '', $category = '', $tag = '')
    {
        $sql = "SELECT COUNT(DISTINCT c.id) as total 
                FROM {$this->table} c
                LEFT JOIN categories cat ON c.category_id = cat.id";

        if (!empty($tag)) {
            $sql .= " LEFT JOIN course_tags ct ON c.id = ct.course_id";
        }
        
        $sql .= " WHERE 1=1";
        
        $params = [];
        
        if (!empty($keywords)) {
            $sql .= " AND (c.title LIKE ? OR c.description LIKE ?)";
            $params[] = "%$keywords%";
            $params[] = "%$keywords%";
        }
        
        if (!empty($category)) {
            $sql .= " AND cat.id = ?";
            $params[] = $category;
        }

        if (!empty($tag)) {
            $sql .= " AND ct.tag_id = ?";
            $params[] = $tag;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getCourseById($id)
    {
        $sql = "SELECT c.*, u.name, cat.name as category_name,
                (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count
                FROM {$this->table} c
                LEFT JOIN users u ON c.teacher_id = u.id
                LEFT JOIN categories cat ON c.category_id = cat.id
                WHERE c.id = ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($course) {
            $course['tags'] = $this->tagModel->getCourseTags($course['id']);
            return $this->createCourseObject($course);
        }

        return null;
    }

    public function getTotalCourses()
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getMostPopularCourse() {
        $sql = "SELECT c.*, u.name as teacher_name, COUNT(e.student_id) as student_count 
                FROM courses c 
                LEFT JOIN users u ON c.teacher_id = u.id 
                LEFT JOIN enrollments e ON c.id = e.course_id 
                GROUP BY c.id, c.title, c.photo_url, c.teacher_id, u.name 
                ORDER BY student_count DESC 
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCourse($id) {
        
            $sql = "DELETE FROM courses WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        
    }

    public function teacherCourses($teacherId) {
        $sql = "SELECT 
                    c.*,
                    u.name as teacher_name,
                    cat.name as category_name,
                    (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count
                FROM {$this->table} c
                LEFT JOIN users u ON c.teacher_id = u.id
                LEFT JOIN categories cat ON c.category_id = cat.id
                WHERE c.teacher_id = ?
                ORDER BY c.created_at DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$teacherId]);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($courses as &$course) {
            $course['tags'] = $this->tagModel->getCourseTags($course['id']);
        }

        return $courses;
    }

    public function createCourse($data) {
        try {
            $this->conn->beginTransaction();

            // Debug des données reçues
            echo "<pre>Données reçues : ";
            print_r($data);
            echo "</pre>";

            // Récupérer le nom de la catégorie
            $stmt = $this->conn->prepare("SELECT name FROM categories WHERE id = ?");
            $stmt->execute([$data['category_id']]);
            $categoryName = $stmt->fetchColumn();

            // Créer l'objet du bon type avec les données complètes
            $course = $data['type'] === 'video' 
                ? new VideoCourse([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'photo_url' => $data['photo_url'],
                    'teacher_id' => $data['teacher_id'],
                    'category_id' => $data['category_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'category_name' => $categoryName,
                    'video_url' => $data['video']
                ])
                : new DocumentCourse([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'photo_url' => $data['photo_url'],
                    'teacher_id' => $data['teacher_id'],
                    'category_id' => $data['category_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'category_name' => $categoryName,
                    'document' => $data['document']
                ]);

            // Utiliser les méthodes de l'objet pour l'insertion
            $sql = "INSERT INTO {$this->table} (title, description, photo_url, teacher_id, category_id, created_at";
            
            // Utiliser getType() pour déterminer la colonne
            if ($course->getType() === 'Cours vidéo') {
                $sql .= ", video_url";
            } else {
                $sql .= ", document";
            }
            $sql .= ") VALUES (?, ?, ?, ?, ?, NOW(), ?)";

            $params = [
                $course->getTitle(),
                $course->getDescription(),
                $course->getPhotoUrl(),
                $course->getTeacherId(),
                $course->getCategoryId(),
                $course->getContent()  // Polymorphique : retourne soit video_url soit document
            ];

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            $courseId = $this->conn->lastInsertId();

            echo "<br>Cours créé avec ID: " . $courseId;

            // Debug des tags
            echo "<pre>Tags reçus : ";
            print_r($data['tags'] ?? 'Aucun tag');
            echo "</pre>";

            // Gestion des tags
            if (isset($data['tags']) && is_array($data['tags'])) {
                echo "<br>Nombre de tags à insérer : " . count($data['tags']);
                
                $tagSql = "INSERT INTO course_tags (course_id, tag_id) VALUES (?, ?)";
                $tagStmt = $this->conn->prepare($tagSql);
                
                foreach ($data['tags'] as $tagId) {
                    try {
                        echo "<br>Insertion du tag {$tagId} pour le cours {$courseId}";
                        $tagStmt->execute([$courseId, $tagId]);
                        echo "<br>Tag {$tagId} inséré avec succès";
                    } catch (PDOException $e) {
                        echo "<br>Erreur lors de l'insertion du tag {$tagId}: " . $e->getMessage();
                        throw $e;
                    }
                }
            } else {
                echo "<br>Pas de tags valides dans les données";
            }

            $this->conn->commit();
            return $courseId;

        } catch (PDOException $e) {
            $this->conn->rollBack();
            echo "<br>Erreur PDO: " . $e->getMessage();
            throw new Exception("Database error: " . $e->getMessage());
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "<br>Erreur générale: " . $e->getMessage();
            throw new Exception("Error creating course: " . $e->getMessage());
        }
    }
} 