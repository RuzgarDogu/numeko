<?php

class Clientsportal_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getClientLogData($id)
    {
      return $this->db->select("
        SELECT
        t.status,
        t.training_date,
        t.id,
        c.client_name,
        tl.training_code,
        tl.training_name,
        tl.training_duration,
        ts.trainer_name,
        cs.city,
        (SELECT COUNT(*) FROM training_log WHERE training_id = t.id) as nop
        FROM trainings t
        LEFT JOIN clientuser cu ON cu.client_id = t.client_id
        LEFT JOIN clients c ON t.client_id = c.id
        LEFT JOIN training_list tl ON t.training_code = tl.id
        LEFT JOIN trainers ts ON t.trainer1_id = ts.id
        LEFT JOIN cities cs ON t.city = cs.id
        WHERE cu.user_id = {$id}
        ORDER BY t.id DESC
        ");
    }

    public function getParticipants($id)
    {
      return $this->db->select("SELECT `id`, `trainee_name`, `trainee_id`, `cert_no` FROM `training_log` WHERE `training_id` = {$id}");
    }

    public function deleteExistingTrainees($tid)
    {
      $this->db->select("DELETE FROM `training_log` WHERE `training_id` = {$tid}");
    }

    public function insertNewList($tid,$value,$i)
    {
      $this->db->select("INSERT INTO `training_log`(`training_id`, `trainee_name`, `trainee_id`) VALUES ({$tid},'{$value}',{$i})");
    }

    public function changeStatus($id)
    {
      $this->db->select("UPDATE `trainings` SET `status`= '1' WHERE `id` = {$id}");
      return "success";
    }

}
