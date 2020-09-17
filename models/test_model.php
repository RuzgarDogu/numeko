<?php

class Test_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function deneme()
    {
      return $this->db->select("SELECT * FROM person WHERE age>23");
    }

}
