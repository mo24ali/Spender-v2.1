<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Card extends Model
{
    protected static $table = 'cards';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM cards WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO cards (name, user_id, balance, credit_limit, expiry_date, card_number) 
                VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['user_id'],
            $data['balance'] ?? 0,
            $data['limit'] ?? 0,
            $data['expiry_date'],
            $data['card_number']
        ]);
    }

    public function updateBalance($id, $amount)
    {
        $sql = "UPDATE cards SET balance = balance + ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$amount, $id]);
    }
}
