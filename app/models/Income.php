<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Income extends Model
{
    protected static $table = 'incomes';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM incomes WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO incomes (title, description, user_id, amount, category_id, date, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['user_id'],
                $data['amount'],
                $data['category_id'],
                $data['date']
            ]);

            // Add to card if selected
            if (!empty($data['card_id'])) {
                $sql = "UPDATE cards SET balance = balance + ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$data['amount'], $data['card_id']]);
            }

            // Log Transaction
            $sql = "INSERT INTO transactions (title, description, user_id, type, amount, transaction_date, status, category_id, card_id) 
                    VALUES (?, ?, ?, 'income', ?, NOW(), 'completed', ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['title'],
                $data['description'],
                $data['user_id'],
                $data['amount'],
                $data['category_id'],
                $data['card_id'] ?? null
            ]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
