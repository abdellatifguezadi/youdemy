<?php
require_once(__DIR__ . '/../config/db.php');

class Tag extends Db
{
    private $table = "tags";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTags()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseTags($courseId)
    {
        $sql = "SELECT t.* FROM {$this->table} t
                INNER JOIN course_tags ct ON t.id = ct.tag_id
                WHERE ct.course_id = ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagsCount()
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getCoursesCountByTag($tagId)
    {
        $sql = "SELECT COUNT(DISTINCT course_id) as count 
                FROM course_tags 
                WHERE tag_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tagId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function bulkInsertTags($tagNames) {
        $selectStmt = $this->conn->prepare("SELECT id FROM {$this->table} WHERE name = ?");
        $insertStmt = $this->conn->prepare("INSERT INTO {$this->table} (name) VALUES (?)");
        
        foreach ($tagNames as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                $selectStmt->execute([$tagName]);
                $tag = $selectStmt->fetch();
                
                if (!$tag) {
                    $insertStmt->execute([$tagName]);
                }
            }
        }
        
        return true;
    }
} 