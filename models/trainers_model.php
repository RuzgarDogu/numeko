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
      return $this->db->select("SELECT tl.`training_name`, tl.`id` as trid FROM trainer_exp te LEFT JOIN training_list tl ON te.training_id = tl.id WHERE te.trainer_id = {$id}");
    }

    public function getTrainingList()
    {
      return $this->db->select("SELECT * FROM training_list");
    }

    public function addTrainer($trainer_name,$trainer_type,$trainer_gsm,$trainer_price)
    {
      $this->db->select("INSERT INTO `trainers`(`trainer_name`, `trainer_type`, `trainer_gsm`, `trainer_price`) VALUES ('{$trainer_name}','{$trainer_type}','{$trainer_gsm}','{$trainer_price}')");
      return $this->db->lastInsertId();
    }

    public function addTrainerExp($trainer_id,$training_id)
    {
      $this->db->select("INSERT INTO `trainer_exp`(`trainer_id`, `training_id`) VALUES ('{$trainer_id}', '{$training_id}')");
    }

    public function saveTrainer($trainer_name_edit,$trainer_type_edit,$trainer_gsm_edit,$trainer_price_edit,$id)
    {
      $this->db->select("UPDATE `trainers` SET `trainer_name`='{$trainer_name_edit}',`trainer_type`='{$trainer_type_edit}',`trainer_gsm`='{$trainer_gsm_edit}',`trainer_price`='{$trainer_price_edit}' WHERE `id` = {$id}");
    }

    public function deleteTrainerExp($id)
    {
      $this->db->select("DELETE FROM `trainer_exp` WHERE `trainer_id` = {$id}");
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
