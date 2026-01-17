<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Income extends Model
{
    protected static $table = 'incomes';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM incomes WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO incomes (title, description, user_id, amount, category_id, date, created_at) 
                    VALUES (:title, :description, :user_id, :amount, :category_id, :date, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':user_id' => $data['user_id'],
                ':amount' => $data['amount'],
                ':category_id' => $data['category_id'],
                ':date' => $data['date']
            ]);

            // Add to card if selected
            if (!empty($data['card_id'])) {
                $sql = "UPDATE cards SET balance = balance + :amount WHERE id = :card_id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':amount' => $data['amount'], ':card_id' => $data['card_id']]);
            }

            // Log Transaction
            $sql = "INSERT INTO transactions (title, description, user_id, type, amount, transaction_date, status, category_id, card_id) 
                    VALUES (:title, :description, :user_id, 'income', :amount, NOW(), 'completed', :category_id, :card_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':user_id' => $data['user_id'],
                ':amount' => $data['amount'],
                ':category_id' => $data['category_id'],
                ':card_id' => $data['card_id'] ?? null
            ]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
