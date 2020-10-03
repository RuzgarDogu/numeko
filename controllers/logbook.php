<?php

class Logbook extends Controller {

  public static $_roles = array('owner','admin','client');
  public static $_pageHeading = "Logbook";
  public static $_pageIcon = "fas fa-book";

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/logbook/js/logbook.js'
        );
    }

    function index() {
        $this->view->clients = $this->model->getClients();
        $this->view->trainers = $this->model->getTrainers();
        $this->view->cities = $this->model->getCities();
        $this->view->trainingList = $this->model->getTrainingList();
        $this->view->render('logbook/index');
    }

    public function addtraininglog()
    {
      if (isset($_POST['yeni_client'])) {
        $yeni_client = $_POST['yeni_client'];
        $client_id = $this->model->addNewClient($yeni_client);
      } else {
        $client_id = $_POST['clients'];
      }

      $date = $_POST['date'];
      $trainer1 = $_POST['trainer1'];
      $trainer2 = $_POST['trainer2'];
      $city = $_POST['city'];
      $training_code = $_POST['training_code'];
      $status = $_POST['tr_status'];
      $trainee_box = $_POST['trainee_box'];
      $trainees = explode("\n", $trainee_box);

      $trainingId = $this->model->addNewTraining($client_id,$date,$trainer1,$trainer2,$city,$training_code,$status);

      $i = 1;
  		$cert = "NMK";
  		foreach ($trainees as $v) {
  			$v = mb_strtoupper($v);
  			if (strlen(trim($v)) != 0) {
  				$zeroi = sprintf("%02d", $i);
          $traineeId = $this->model->addTrainee($trainingId,$v,$i,$cert,$trainingId,$zeroi);
          $this->model->addToTrainingLog($traineeId);
  				$i++;
  			}
  		}
      header('location: ../logbook');
    }

    public function editTraining()
    {
      $trainingid = $_POST['trainingid'];
    	$stati = $_POST['stati'];
    	$datum = $_POST['datum'];
    	$e_training_code = $_POST['e_training_code'];
    	$e_trainer1 = $_POST['e_trainer1'];
    	$e_city = $_POST['e_city'];
    	$e_tr_status = $_POST['e_tr_status'];
    	$e_trainee_box = $_POST['e_trainee_box'];

    	$trainees = explode("\n", $e_trainee_box);

      $this->model->editTraining($datum,$e_training_code,$e_trainer1,$e_city,$stati,$trainingid);

    	if ($e_tr_status == "0") {
        $this->model->deleteFromTrainingLog($trainingid);
    		$i = 1;
    		$cert = "NMK";

    		foreach ($trainees as $v) {
    			$v = mb_strtoupper($v);
    			if (strlen(trim($v)) != 0) {
    				$zeroi = sprintf("%02d", $i);
            $traineeId = $this->model->addTrainee($trainingid,$v,$i,$cert,$zeroi);
            $this->model->addToTrainingLog($traineeId);
    				$i++;
    			}
    		}
    	}

      header('location: ../logbook');
    }

    public function deleteTraining()
    {
      $trainingid = $_POST['trainingid'];
      $this->model->deleteTrainingLog($trainingid);
      $this->model->deleteTraining($trainingid);
    }

    public function getTab1()
    {
      $tab1Data = $this->model->getTab1();
      for ($i=0; $i < count($tab1Data); $i++) {
        $tab1Data[$i]["traineelist"] = $this->model->getParticipants($tab1Data[$i]["id"]);
      }
      header('Content-Type: application/json');
      echo json_encode($tab1Data);
    }

    public function getTab2()
    {
      header('Content-Type: application/json');
      echo json_encode($this->model->getTab2());
    }

    public function getTab3()
    {
      header('Content-Type: application/json');
      echo json_encode($this->model->getTab3());
    }

}
