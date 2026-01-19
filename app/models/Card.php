<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Card extends Model
{
    protected static $table = 'carte';

    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM carte WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $sql = "INSERT INTO carte (nom, user_id, currentsold, limite, expiredate,num) 
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

    public function getById($id)
    {
        $sql = "SELECT * FROM carte WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM carte WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function update($id, array $data)
    {
        $sql = "UPDATE carte SET name = ?, balance = ?, credit_limit = ?, expiry_date = ?, card_number = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['balance'],
            $data['limit'],
            $data['expiry_date'],
            $data['card_number'],
            $id
        ]);
    }
}
