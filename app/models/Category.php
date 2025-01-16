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
} 