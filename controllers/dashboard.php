<?php

class Dashboard extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->view->js = array('dashboard/js/dashboard.js');
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

}
