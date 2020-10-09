<?php

class Checkcert extends Controller {

  // public static $_roles = array('owner','admin','client');
  public static $_pageHeading = "Assets";
  public static $_pageIcon = "fas fa-fire-extinguisher";

    function __construct() {
        parent::__construct();
        // $this->view->css = array(
        //   'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        // );
        // $this->view->js = array(
        //   'node_modules/datatables.net/js/jquery.dataTables.min.js',
        //   'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
        //   'views/assets/js/assets.js'
        // );
    }

    // function index() {
      // $this->view->render('checkcert/index',true);
    // }

    public function cert($certno=null)
    {
      $this->view->cert = $this->model->getCert($certno);
      $this->view->render('checkcert/index',true);
    }

}
