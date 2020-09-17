<?php

class Hata extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->msg = 'public/images/404page.gif';
        $this->view->render('hata/index');
    }

}
