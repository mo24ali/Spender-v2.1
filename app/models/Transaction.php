<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Transaction extends Model
{
    protected static $table = 'transactions';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = :user_id ORDER BY transaction_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
