<?php

class Trainers extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/trainers/js/trainers.js'
        );
    }

    function index() {
        $this->view->sayfaAdi = '<i class="text-info mr-2 nav-icon fas fa-chalkboard-teacher"></i> Trainers';
        $this->view->trainingList = $this->model->getTrainingList();
        $this->view->render('trainers/index');
    }

    public function getTrainersList()
    {
      $tl = $this->model->getTrainersList();
      for ($i=0; $i < count($tl); $i++) {
        $tl[$i]["exp"] = $this->model->getTrainersExp($tl[$i]["id"]);
      }
      header('Content-Type: application/json');
      echo json_encode($tl);
    }

    public function addTrainer()
    {
      $trainer_type = $_POST['trainer_type'];
      $trainer_name = $_POST['trainer_name'];
      $trainer_gsm = $_POST['trainer_gsm'];
      $trainer_price = $_POST['trainer_price'];
      $trexp_add = $_POST['trexp_add'];
      $lastId = $this->model->addTrainer($trainer_name,$trainer_type,$trainer_gsm,$trainer_price);
      if (isset($lastId)) {
        foreach ($trexp_add as $t) {
          $this->model->addTrainerExp($lastId,$t);
        }
      }
      header('location: ../trainers');
    }

    public function saveTrainer()
    {
    	$trainer_name_edit = $_POST['trainer_name_edit'];
      $trainer_type_edit = $_POST['trainer_type_edit'];
    	$trainer_gsm_edit = $_POST['trainer_gsm_edit'];
    	$trainer_price_edit = $_POST['trainer_price_edit'];
    	$id = $_POST['id'];
    	$trexp_edit = $_POST['trexp_edit'];
      $this->model->saveTrainer($trainer_name_edit,$trainer_type_edit,$trainer_gsm_edit,$trainer_price_edit,$id);
      $this->model->deleteTrainerExp($id);
      if (isset($trexp_edit)) {
        foreach ($trexp_edit as $t) {
          $this->model->addTrainerExp($id,$t);
        }
      }
    }

}
