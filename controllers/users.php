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
        $this->view->clients = $this->model->getClients();
        $this->view->render('users/index');
    }

    public function getAllUsers()
    {
      $data = $this->model->getAllUsers();
      header('Content-Type: application/json');
      echo json_encode($data);
    }

    public function getCurrentUser()
    {
      $uid = Session::get("userid");
      echo intval($uid);
      // echo json_encode($cu,JSON_UNESCAPED_UNICODE);
    }

    public function addUser()
    {
      if (isset($_POST['username'])) {
        $username = $_POST['username'];
      }
      if (isset($_POST['usersurname'])) {
        $usersurname = $_POST['usersurname'];
      }
      if (isset($_POST['login'])) {
        $login = $_POST['login'];
      }
      if (isset($_POST['pwd'])) {
        $pwd = Hash::create('sha256', $_POST['pwd'], HASH_PASSWORD_KEY);
      }
      if (isset($_POST['client'])) {
        $client = $_POST['client'];
      }
      if (isset($_POST['role'])) {
        $role = $_POST['role'];
      }


      $uid = $this->model->addUser($username,$usersurname,$login,$pwd,$role);
      $this->model->addClientUser($uid,$client);
      header('location: ../users');
    }

    public function deleteUser()
    {
      $uid = $_POST['uid'];
      $this->model->deleteUser($uid);
    }

    public function editUser()
    {
      if (isset($_POST['ed-username'])) {
        $username = $_POST['ed-username'];
      }
      if (isset($_POST['ed-usersurname'])) {
        $usersurname = $_POST['ed-usersurname'];
      }
      if (isset($_POST['ed-login'])) {
        $login = $_POST['ed-login'];
      }
      if (isset($_POST['ed-pwd']) && $_POST['ed-pwd'] != "") {
        $pwd = Hash::create('sha256', $_POST['ed-pwd'], HASH_PASSWORD_KEY);
      }
      if (isset($_POST['ed-role'])) {
        $role = $_POST['ed-role'];
      }
      if (isset($_POST['inp-ed-id'])) {
        $uid = $_POST['inp-ed-id'];
      }
      $this->model->editUser($username,$usersurname,$login,$role,$uid);
      if ($pwd) {
        $this->model->changePassword($uid,$pwd);
      }
      header('location: ../users');
    }

}
