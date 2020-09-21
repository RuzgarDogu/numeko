<?php

class Expense extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/expense/js/expense.js'
        );
    }

    function index() {
        $this->view->sayfaAdi = '<i class="text-info mr-2 nav-icon fas fa-money-bill-wave"></i> Expense';
        $this->view->render('expense/index');
    }

    public function getIncome()
    {
      header('Content-Type: application/json');
      echo json_encode($this->model->getIncome());
    }

    public function getExpense()
    {
      header('Content-Type: application/json');
      echo json_encode($this->model->getExpense());
    }

    public function addExpenseIncome()
    {
      $type = $_POST['type'];
      $tarih = $_POST['tarih'];
      $seller = $_POST['seller'];
      $miktar = $_POST['miktar'];
      $this->model->addExpenseIncome($type,$tarih,$seller,$miktar);
      header('location: ../expense');
    }

    public function deleteExpense()
    {
      $id = $_POST['id'];
      echo json_encode($this->model->deleteExpense($id));
    }

}
