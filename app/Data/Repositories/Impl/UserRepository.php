<?php

namespace App\Data\Repositories\Impl;

use App\Core\Database;
use App\Data\Repositories\UserInterface;
use App\Models\User;
use PDO;

class userRepository implements UserInterface
{

    private PDO $db;


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    public function save(User $user):bool
    {
        $sql = "insert into users(firstname, lastname, email, password, age) 
                            values(?,?,?,?,?)
                 ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute(
            [
                $user->getFirstname(),
                $user->getlastname(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getAge()
            ]
        );
    }
    public function findById(int $id): User
    {
        $sql = "select * from users where id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = new User(
            $row['firstname'],
            $row['lastname'],
            $row['age'],
            $row['email']
        );
        return $user;
    }

    public function findByName(string $name):User{
        $sql = "select * from users where firstname=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = new User(
            $row['firstname'],
            $row['lastname'],
            $row['age'],
            $row['email']
        );
        return $user;
    }
}
