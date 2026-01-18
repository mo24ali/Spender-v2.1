<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($userId)
    {
        $sql = "SELECT * FROM categories WHERE user_id = ? OR user_id IS NULL ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $type, $userId)
    {
        $sql = "INSERT INTO categories (name, type, user_id) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $type, $userId]);
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM categories WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id, $userId]);
    }
}
