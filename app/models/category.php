<?php



namespace App\Models;

use App\Core\Model;


class Category extends Model
{


    private int $id;
    private string $name;
    private float $monthlyIncome;


    public function __construct(string $newName)
    {
        $this->name = $newName;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setId(int $newId)
    {
        $this->id = $newId;
    }

    public function setName(string $newName)
    {
        $this->name = $newName;
    }

  



    public function __toString(): string
    {
        return "this category is : " . $this->getName() . " with the id of " . $this->getId();
    }
}
