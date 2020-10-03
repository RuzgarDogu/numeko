<?php

class Dashboard extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array(
          'views/dashboard/js/dashboard.js',
          'node_modules/html2canvas/dist/html2canvas.min.js',
          'public/externallibs/jspdf/jspdf.umd.min.js'
        );
    }

    function index()
    {
      $this->view->sayfaAdi = "Dashboard";
      $this->view->render('dashboard/index');
    }

    function xhrInsert()
    {
        $this->model->xhrInsert();
    }

    function xhrGetListings()
    {
        $this->model->xhrGetListings();
    }

    function xhrDeleteListing()
    {
        $this->model->xhrDeleteListing();
    }

    public function deneme()
    {
      $this->view->sonuclar = $this->model->deneme();
    }

    public function test()
    {
      $param = $_POST['param1'];
      $html = Pdfmake::generateHTML($param);
      header('Content-Type: application/json');
      echo json_encode($html);
    }



}
