<?php

namespace App\Models;

use App\Core\Model;

class Transfer extends Model
{
    protected static $table = 'transfers';

    public function create(array $data)
    {
        try {
            $this->db->beginTransaction();

            // 1. Create Transfer Record
            $sql = "INSERT INTO transfers (sender_id, receiver_id, amount, date) VALUES (?, ?, ?, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['sender_id'],
                $data['receiver_id'],
                $data['amount']
            ]);
            $transferId = $this->db->lastInsertId();

            // 2. Update Sender Balance (Assuming Cards for now, or User wallet logic)
            // If sender_id represents a Card:
            if (isset($data['sender_type']) && $data['sender_type'] == 'card') {
                $sql = "UPDATE carte SET balance = balance - ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$data['amount'], $data['sender_id']]);
            }

            // 3. Update Receiver Balance
            if (isset($data['receiver_type']) && $data['receiver_type'] == 'card') {
                $sql = "UPDATE carte SET balance = balance + ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$data['amount'], $data['receiver_id']]);
            }

            // 4. Log Transaction (Unified)
            $sql = "INSERT INTO transactions (title, description, user_id, type, amount, transaction_date, status, transfer_id) 
                    VALUES ('Transfer', 'Transfer between accounts', ?, 'transfer', ?, NOW(), 'completed', ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $_SESSION['user_id'] ?? 0,
                $data['amount'],
                $transferId
            ]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
