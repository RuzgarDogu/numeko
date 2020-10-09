<?php

class Singletrainer extends Controller {

  public static $_roles = array('owner','admin','client');
  public static $_pageHeading = "Trainer Page";
  public static $_pageIcon = "fas fa-user-shield";

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css'
        );
        $this->view->js = array(
          'node_modules/datatables.net/js/jquery.dataTables.min.js',
          'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
          'views/singletrainer/js/singletrainer.js'
        );
    }

    function index() {
        $this->view->render('singletrainer/index');
    }

}
