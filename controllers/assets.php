<?php

class Assets extends Controller {

  public static $_roles = array('owner','admin');
  public static $_pageHeading = "Assets";
  public static $_pageIcon = "fas fa-fire-extinguisher";

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/assets/js/assets.js'
        );
    }

    function index() {
      $this->view->assetTypes = $this->model->assetTypes();
      $this->view->render('assets/index');
    }

    public function getAssetList()
    {
      header('Content-Type: application/json');
      echo json_encode($this->model->getAssetList());
    }

    public function deleteAsset()
    {
      $id = $_POST['id'];
      $result = $this->model->deleteMaint($id);
      if ($result) {
        echo json_encode($this->model->deleteAsset($id));
      }
    }

    public function addMaintenance()
    {
      $bakimciadi = $_POST['bakimciadi'];
      $bakimtarihi = $_POST['bakimtarihi'];
      $bakimvalid = $_POST['bakimvalid'];
      $h_assetid = $_POST['h_assetid'];
      $this->model->addMaintenance($bakimciadi,$bakimtarihi,$bakimvalid,$h_assetid);
      header('location: ../assets');
    }

    public function addAsset()
    {
      if (isset($_POST['type'])) {
        $type = $_POST['type'];
      }
      $brand = $_POST['brand'];
      $model = $_POST['model'];
      $serino = $_POST['serino'];

      if (isset($_POST['yeni_type'])) {
        $yeni_type = $_POST['yeni_type'];
        $newType = $this->model->addAssetType($yeni_type);
        if ($newType) {
          $this->model->addAsset($newType,$brand,$model,$serino);
        }
      } else {
        $this->model->addAsset($type,$brand,$model,$serino);
      }
      header('location: ../assets');
    }

}
