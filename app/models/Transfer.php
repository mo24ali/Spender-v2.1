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
            $sql = "INSERT INTO transfers (sender_id, receiver_id, amount, date) VALUES (:sender_id, :receiver_id, :amount, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':sender_id' => $data['sender_id'],
                ':receiver_id' => $data['receiver_id'],
                ':amount' => $data['amount']
            ]);
            $transferId = $this->db->lastInsertId();

            // 2. Update Sender Balance (Assuming Cards for now, or User wallet logic)
            // If sender_id represents a Card:
            if (isset($data['sender_type']) && $data['sender_type'] == 'card') {
                $sql = "UPDATE cards SET balance = balance - :amount WHERE id = :sender_id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':amount' => $data['amount'], ':sender_id' => $data['sender_id']]);
            }

            // 3. Update Receiver Balance
            if (isset($data['receiver_type']) && $data['receiver_type'] == 'card') {
                $sql = "UPDATE cards SET balance = balance + :amount WHERE id = :receiver_id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':amount' => $data['amount'], ':receiver_id' => $data['receiver_id']]);
            }

            // 4. Log Transaction (Unified)
            $sql = "INSERT INTO transactions (title, description, user_id, type, amount, transaction_date, status, transfer_id) 
                    VALUES ('Transfer', 'Transfer between accounts', :user_id, 'transfer', :amount, NOW(), 'completed', :transfer_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'] ?? 0,
                ':amount' => $data['amount'],
                ':transfer_id' => $transferId
            ]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
