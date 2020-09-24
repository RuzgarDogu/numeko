<?php

class Overview extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->css = array(
          'public/externallibs/fullcalendar-5.3.2/lib/main.min.css',
          'node_modules/highcharts/css/highcharts.css'
        );
        $this->view->js = array(
          'public/externallibs/fullcalendar-5.3.2/lib/main.min.js',
          'node_modules/highcharts/highcharts.src.js',
          'views/overview/js/graphics.js',
          'views/overview/js/overview.js'
        );
    }

    function index() {
        $this->view->sayfaAdi = '<i class="text-info mr-2 nav-icon fas fa-chart-line"></i> Overview';
        $this->view->render('overview/index');
    }

    public function getCalendar()
    {
      $calendarData = $this->model->getCalendar();
      $arr = [];
      $i = 0;
      foreach ($calendarData as $d) {
        $arr[$i]['id'] = $d['id'];
        $arr[$i]['title'] = $d['client_name'];
        $arr[$i]['start'] = $d['training_date'];
        $arr[$i]['end'] = $d['training_date'];
        $i++;
      }
      echo json_encode($arr);
    }

    public function getEventDetails()
    {
      $id = $_POST['id'];
      header('Content-Type: application/json');
      echo json_encode($this->model->getEventDetails($id));
    }

    public function getTrainerTraineCount()
    {
      $data = $this->model->getTrainerTraineCount();
    	for ($i=0; $i < count($data); $i++) {
    		$data[$i]['y'] = (int)$data[$i]['y'];
    	}
      header('Content-Type: application/json');
      echo json_encode($data);
    }

    public function getTraineeByDate()
    {
      $data = $this->model->getTraineeByDate();
      $finaldata = [];
      for ($i=0; $i < count($data); $i++) {
        $temp = [];
        array_push($temp, $data[$i]['dt']);
        array_push($temp, (int)$data[$i]['trcnt']);
        array_push($finaldata, $temp);
      }
      header('Content-Type: application/json');
      echo json_encode($finaldata);
    }

    public function getTraineesByClients()
    {
      $data = $this->model->getTraineesByClients();
      for ($i=0; $i < count($data); $i++) {
        $data[$i]['cnt'] = (int)$data[$i]['cnt'];
      }
      header('Content-Type: application/json');
      echo json_encode($data);
    }

    public function getTraineesByTrainings()
    {
      $data = $this->model->getTraineesByTrainings();
    	for ($i=0; $i < count($data); $i++) {
    		$data[$i]['y'] = (int)$data[$i]['y'];
    	}
      header('Content-Type: application/json');
    	echo json_encode($data);
    }

}
