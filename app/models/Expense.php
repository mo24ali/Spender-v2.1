<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Expense extends Model
{
    protected static $table = 'expenses';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM expenses WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO expenses (title, description, user_id, amount, category_id, card_id, due_date, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'paid', NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['user_id'],
                $data['amount'],
                $data['category_id'],
                $data['card_id'],
                $data['due_date']
            ]);

            // Deduct from card if selected and status is paid (assuming immediate payment for now)
            if (!empty($data['card_id'])) {
                $sql = "UPDATE cards SET balance = balance - ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$data['amount'], $data['card_id']]);
            }

            // Log Transaction
            $sql = "INSERT INTO transactions (title, description, user_id, type, amount, transaction_date, status, category_id, card_id) 
                    VALUES (?, ?, ?, 'expense', ?, NOW(), 'completed', ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['user_id'],
                $data['amount'],
                $data['category_id'],
                $data['card_id']
            ]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
