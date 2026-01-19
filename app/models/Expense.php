<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Expense extends Model
{
    protected static $table = 'transactions';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = ? AND type = 'expense' ORDER BY transaction_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        try {
            $this->db->beginTransaction();

            // Deduct from carte if selected
            if (!empty($data['card_id'])) {
                $sql = "UPDATE carte SET balance = balance - ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$data['amount'], $data['card_id']]);
            }

            // Log Transaction
            $sql = "INSERT INTO transactions (title, description, user_id, type, amount, transaction_date, status, category_id, card_id) 
                    VALUES (?, ?, ?, 'expense', ?, ?, 'completed', ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['user_id'],
                $data['amount'],
                $data['due_date'] ?? date('Y-m-d'),
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
