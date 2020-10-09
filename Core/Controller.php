<?php

class Controller {

    function __construct() {
      Session::init();
        $this->view = new View();
        $this->auth = new Auth();
        $this->auth->handleLogin();
        $this->view->authorized = $this->getAuthorized();
        $this->view->sayfaAdi = $this->getSayfaAdi();
    }

    public function loadModel($name, $modelPath = 'models/') {

        $path = $modelPath . $name.'_model.php';

        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }

    public function getAuthorized()
    {
      $result = null;
      if (!in_array($_SERVER['REQUEST_URI'], BYPASSLOGIN)) {
        if (isset(get_called_class()::$_roles)) {
          $result =  $this->auth->setRoles(get_called_class()::$_roles);
        } else {
          $result = $this->auth->setRoles(ROLES);
        }
      }
      return $result;
    }

    public function getSayfaAdi()
    {
      $sayfaadi = isset(get_called_class()::$_pageHeading) ? get_called_class()::$_pageHeading : "Numeko";
      $ikon = isset(get_called_class()::$_pageIcon) ? get_called_class()::$_pageIcon : 'fas fa-info-circle';

      return '<i class="text-info mr-2 nav-icon '.$ikon.'"></i> '.$sayfaadi;
    }

}
