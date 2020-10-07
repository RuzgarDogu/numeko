<?php

class Clientsportal extends Controller {

  public static $_roles = array('owner','admin','client');
  public static $_pageHeading = "Trainings";
  public static $_pageIcon = "fas fa-people-arrows";

    function __construct() {


        parent::__construct();

        $this->render = Session::get("role") == "client" ? "index" : "clientindex";
        $this->js = Session::get("role") == "client" ? "clientsportal" : "clientindex";

        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
          'node_modules/select2/dist/css/select2.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'public/externallibs/qrcodeJS/qrcode.min.js',
          'node_modules/html2canvas/dist/html2canvas.min.js',
          'public/externallibs/jspdf/jspdf.umd.min.js',
          'node_modules/select2/dist/js/select2.min.js',
          'views/clientsportal/js/'.$this->js.'.js'
        );
    }

    function index() {
      $this->view->render('clientsportal/'.$this->render);
    }

    public function getClientLogData()
    {
      if (isset($_POST['uid'])) {
        $id = $this->model->getClientIdFromUserId($_POST['uid']);
      } else {
        $id = $_POST['id'];
      }
      $clientTrainingData = $this->model->getClientLogData($id);
      for ($i=0; $i < count($clientTrainingData) ; $i++) {
        $clientTrainingData[$i]["participants"] = $this->model->getParticipants($clientTrainingData[$i]["id"]);
      }
      header('Content-Type: application/json');
      echo json_encode($clientTrainingData);
    }

    public function approveTraining()
    {
      $tid = $_POST['tid'];
      $isimlistesi = json_decode($_POST['isimlistesi']);
      $verivar = $_POST['verivar'];

      if ($verivar == 1) {
        $this->model->deleteExistingTrainees($tid);
      }

      $i = 1;
      foreach ($isimlistesi as $value) {
        $this->model->insertNewList($tid,$value,$i);
        $i++;
      }

      echo json_encode($this->model->changeStatus($tid));
    }

    public function getCertificate()
    {
      $id = $_POST['id'];
      $tid = $_POST['tid'];
      header('Content-Type: application/json');
      echo json_encode($this->model->getCertificate($id,$tid));
    }

    public function getAllClients()
    {
      header('Content-Type: application/json');
      echo json_encode($this->model->getAllClients());
    }

}
