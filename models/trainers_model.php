<?php

class Trainers_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTrainersList()
    {
      return $this->db->select("SELECT * from trainers");
    }

    public function getTrainersExp($id)
    {
      return $this->db->select("SELECT tl.`training_name` FROM trainer_exp te LEFT JOIN training_list tl ON te.training_id = tl.id WHERE te.trainer_id = {$id}");
    }

    // public function deneme()
    // {
    //   return $this->db->select("SELECT * FROM person WHERE age>23");
    // }

    // public function getAllUsers()
    // {
    //   return $this->db->select("SELECT userid, login, role FROM user");
    // }

}
