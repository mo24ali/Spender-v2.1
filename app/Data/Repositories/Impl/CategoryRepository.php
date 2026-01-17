<?php


namespace App\Data\Repositories\Impl;

use App\Data\Repositories\CategoryInterface;
use App\Models\Category;
use App\Core\Database;
use PDO;
class CategoryRepository implements CategoryInterface
{

    private PDO $db;



    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    
    public function add(Category $category){
            $sql = "insert into categories(name,monthly_limit)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
              
        
            ]);
    }
    public function save(Category $category){

    }
    public function delete(Category $category){

    }
    public function update(Category $category){

    }
}
