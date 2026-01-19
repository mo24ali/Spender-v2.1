<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Transaction
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get all transactions (expenses and incomes combined if needed, or just from transactions table)
    // The schema has specific tables for expenses and incomes, and also a transactions table.
    // Based on user request, I will adhere to the "Generic" transaction model but utilizing the specific tables if required, 
    // OR just use the 'transactions' table if that's the intended unified store.
    // Looking at schema, 'transactions' table seems to be a unified one, but 'expenses' and 'incomes' distinct tables also exist.
    // Let's assume we use the 'transactions' table for the unified view as per the MVC request implying a cleaner approach.
    // However, the prompts mention "Expense/Income" so I will support methods for both specific types if they use the unified table.

    public function getAll($userId)
    {
        $sql = "SELECT t.*, c.name as category_name, cr.name as card_name 
                FROM transactions t 
                LEFT JOIN categories c ON t.category_id = c.id 
                LEFT JOIN carte cr ON t.card_id = cr.id 
                WHERE t.user_id = ? 
                ORDER BY t.transaction_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $amount, $date, $type, $userId, $categoryId = null)
    {
        $sql = "INSERT INTO transactions (title, amount, transaction_date, type, user_id, category_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        // Ensure empty categoryId is treated as null
        if (empty($categoryId))
            $categoryId = null;
        return $stmt->execute([$title, $amount, $date, $type, $userId, $categoryId]);
    }

    public function getRecent($userId, $limit = 5)
    {
        $sql = "SELECT t.*, c.name as category_name 
                FROM transactions t 
                LEFT JOIN categories c ON t.category_id = c.id 
                WHERE t.user_id = ? 
                ORDER BY t.transaction_date DESC LIMIT " . (int) $limit;


        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM transactions WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id, $userId]);
    }

    public function getById($id, $userId)
    {
        $sql = "SELECT * FROM transactions WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $amount, $date, $type, $userId, $categoryId = null)
    {
        $sql = "UPDATE transactions SET title = ?, amount = ?, transaction_date = ?, type = ?, category_id = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $amount, $date, $type, $categoryId, $id, $userId]);
    }

    public function getSummary($userId)
    {
        $sql = "SELECT type, SUM(amount) as total FROM transactions WHERE user_id = ? GROUP BY type";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Returns ['income' => 1000, 'expense' => 500]
    }
}
