<?php



namespace App\Data\Repositories;
use App\Models\Category;


interface CategoryInterface{


public function add(Category $category);
public function save(Category $category);
public function delete(Category $category);
public function update(Category $category);

}