<?php

class Clientinfo extends Controller {

  public static $_roles = array('client');
  public static $_pageHeading = "Client Info";
  public static $_pageIcon = "fas fa-info-circle";

    function __construct() {


        parent::__construct();

        $this->render = Session::get("role") == "client" ? "clientinfo/index" : "clientsportal/clientindex";
        $this->js = Session::get("role") == "client" ? "clientinfo/js/clientinfo" : "clientsportal/js/clientindex";

        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/'.$this->js.'.js'
        );
    }

    function index() {
      $this->view->clientData = $this->getClientFullData();
      $this->view->cities = $this->model->getCities();
      $this->view->vergidaireleri = $this->getVergiDaireleri();
      $this->view->render($this->render);
    }

    public function getClientFullData()
    {
      $uid = Session::get('userid');
      $bigdata = [];
      $bigdata['userdetails'] = $this->model->getUserDetails($uid);
      $bigdata['companyinfo'] = $this->model->getCompanyInfo($bigdata['userdetails']['client_id']);
      return $bigdata;
    }

    public function getVergiDaireleri()
    {
      if (isset($_POST['vergi_plaka'])) {
        $vergi_plaka = $_POST['vergi_plaka'];
        header('Content-Type: application/json');
        echo json_encode($this->model->getVergiDaireleri($vergi_plaka));
        exit();
      } else {
        $vergi_plaka = $this->model->getVergiPlaka(Session::get('userid'));
        return $this->model->getVergiDaireleri($vergi_plaka);
        exit();
      }
    }

    public function editClient()
    {
      $client_name = $_POST['client_name'];
      $client_longname = $_POST['client_longname'];
      $city = $_POST['city'];
      $client_address = $_POST['client_address'];
      $client_phone = $_POST['client_phone'];
      $client_webpage = $_POST['client_webpage'];
      $email = $_POST['email'];
      $vergi_dairesi = $_POST['vergi_dairesi'];
      $vergi_no = $_POST['vergi_no'];
      $client_id = $_POST['client_id'];

      $this->model->updateUserEmail(Session::get('userid'),$email);
      $this->model->editClient($client_id, $client_name, $client_longname, $city, $client_address, $client_phone, $client_webpage, $vergi_dairesi, $vergi_no );
      header('location: ../clientinfo');
    }

    // public function getClientLogData()
    // {
    //   $id = $_POST['id'];
    //   $clientTrainingData = $this->model->getClientLogData($id);
    //   for ($i=0; $i < count($clientTrainingData) ; $i++) {
    //     $clientTrainingData[$i]["participants"] = $this->model->getParticipants($clientTrainingData[$i]["id"]);
    //   }
    //   header('Content-Type: application/json');
    //   echo json_encode($clientTrainingData);
    // }
    //
    // public function approveTraining()
    // {
    //   $tid = $_POST['tid'];
    //   $isimlistesi = json_decode($_POST['isimlistesi']);
    //   $verivar = $_POST['verivar'];
    //
    //   if ($verivar == 1) {
    //     $this->model->deleteExistingTrainees($tid);
    //   }
    //
    //   $i = 1;
    //   foreach ($isimlistesi as $value) {
    //     $this->model->insertNewList($tid,$value,$i);
    //     $i++;
    //   }
    //
    //   echo json_encode($this->model->changeStatus($tid));
    // }
    //
    // public function qrcode()
    // {
    //   require_once 'public/externallibs/phpqrcode/qrlib.php';
    //   QRcode::png("Some test");
    // }

}
