<?php

class Users extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/users/js/users.js'
        );
    }

    function index() {
        $this->view->sayfaAdi = "Users";
        $this->view->render('users/index');
    }

    public function getAllUsers()
    {
      $data = $this->model->getAllUsers();
      header('Content-Type: application/json');
      echo json_encode($data);
    }

}
