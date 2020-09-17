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
        $this->view->sayfaAdi = "Trainers";
        $this->view->render('trainers/index');
    }

    public function getTrainersList()
    {
      $tl = $this->model->getTrainersList();
      for ($i=0; $i < count($tl); $i++) {
        $tl[$i]["exp"] = $this->model->getTrainersExp($tl[$i]["id"]);
      }
      // $texp = $this->model->getTrainersExp();
      header('Content-Type: application/json');
      echo json_encode($tl);
    }

}
