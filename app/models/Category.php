<?php
require_once(__DIR__ . '/../config/db.php');

class Category extends Db
{
    private $table = "categories";

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesCountByCategory($categoryId)
    {
        $sql = "SELECT COUNT(*) as count FROM courses WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getCategoryDistribution() {
        $sql = "SELECT c.name, 
                COUNT(co.id) as course_count,
                ROUND(COUNT(co.id) * 100.0 / (SELECT COUNT(*) FROM courses), 1) as percentage
                FROM {$this->table} c
                LEFT JOIN courses co ON c.id = co.category_id
                GROUP BY c.id, c.name
                ORDER BY course_count DESC
                LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name , $discription) {
        $selectStmt = $this->conn->prepare("SELECT id FROM {$this->table} WHERE name = ?");
        $selectStmt->execute([$name]);

        if ($selectStmt->fetch()) {
            return false;
        }

        $insertStmt = $this->conn->prepare("INSERT INTO {$this->table} (name , description ) VALUES (?, ?)");
        return $insertStmt->execute([$name , $discription]);
    }

    public function deleteCategory($id) {
        $deleteStmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $deleteStmt->execute([$id]);
    }
    public function updateCategory($id, $name, $description) {
        $checkStmt = $this->conn->prepare("SELECT id FROM {$this->table} WHERE name = ? AND id != ?");
        $checkStmt->execute([$name, $id]);
        
        if ($checkStmt->fetch()) {
            return false; 
        }
        
        $updateStmt = $this->conn->prepare("UPDATE {$this->table} SET name = ?, description = ? WHERE id = ?");
        return $updateStmt->execute([$name, $description, $id]);
    }
} 