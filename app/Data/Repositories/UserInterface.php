


<?php

namespace App\Data\Repositories;

use App\Models\User;

interface UserInterface
{
    public function save(User $user): bool;
    public function findById(int $id): User;
    public function findByName(string $name): User;
}
