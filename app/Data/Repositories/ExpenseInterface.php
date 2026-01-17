<?php



use App\Models\Expense;


interface ExpenseInterface{


public function add(Expense $expense);
public function save(Expense $expense);
public function delete(Expense $expense);
public function update(Expense $expense);

}