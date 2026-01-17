<?php



use App\Models\Income;


interface IncomeInterface{


public function add(Income $income);
public function save(Income $income);
public function delete(Income $income);
public function update(Income $income);

}