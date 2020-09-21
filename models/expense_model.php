<?php

class Expense_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getIncome()
    {
      return $this->db->select("SELECT * FROM expense WHERE type='income'");
    }

    public function getExpense()
    {
      return $this->db->select("SELECT * FROM expense WHERE type='expense' ORDER BY `date` DESC");
    }

    public function addExpenseIncome($type,$tarih,$seller,$miktar)
    {
      $this->db->select("INSERT INTO `expense`(`type`, `date`, `seller`, `total`) VALUES ('{$type}','{$tarih}','{$seller}','{$miktar}')");
    }

    public function deleteExpense($id)
    {
      $this->db->select("DELETE FROM `expense` WHERE `idexp` = {$id}");
      return "success";
    }

}
