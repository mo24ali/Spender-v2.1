<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Card extends Model
{
    protected static $table = 'cards';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM cards WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO cards (name, user_id, balance, credit_limit, expiry_date, card_number) 
                VALUES (:name, :user_id, :balance, :limit, :expiry_date, :card_number)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':user_id' => $data['user_id'],
            ':balance' => $data['balance'] ?? 0,
            ':limit' => $data['limit'] ?? 0,
            ':expiry_date' => $data['expiry_date'],
            ':card_number' => $data['card_number']
        ]);
    }

    public function updateBalance($id, $amount)
    {
        $sql = "UPDATE cards SET balance = balance + :amount WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':amount' => $amount, ':id' => $id]);
    }
}
