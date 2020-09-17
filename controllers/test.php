<?php

class Test extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('test/js/test.js');
    }

    function index() {
        $this->view->render('test/index');
    }

    public function deneme()
    {
      $sonuclar = $this->model->deneme();
      echo json_encode($sonuclar);
    }

}
