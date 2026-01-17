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
}
