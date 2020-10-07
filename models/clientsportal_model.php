<?php

class Clientsportal_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getClientIdFromUserId($uid)
    {
      $result = $this->db->select("SELECT client_id FROM clientuser WHERE user_id = {$uid}");
      return $result[0]['client_id'];
    }

    public function getClientLogData($id)
    {
      // return $this->db->select("
      //   SELECT
      //   t.status,
      //   t.training_date,
      //   t.id,
      //   c.client_name,
      //   tl.training_code,
      //   tl.training_name,
      //   tl.training_duration,
      //   ts.trainer_name,
      //   cs.city,
      //   (SELECT COUNT(*) FROM training_log WHERE training_id = t.id) as nop
      //   FROM trainings t
      //   LEFT JOIN clientuser cu ON cu.client_id = t.client_id
      //   LEFT JOIN clients c ON t.client_id = c.id
      //   LEFT JOIN training_list tl ON t.training_code = tl.id
      //   LEFT JOIN trainers ts ON t.trainer1_id = ts.id
      //   LEFT JOIN cities cs ON t.city = cs.id
      //   WHERE cu.user_id = {$id}
      //   ORDER BY t.id DESC
      //   ");

      return $this->db->select("SELECT t.status, t.training_date, t.id, c.client_name, tl.training_code, tl.training_name, tl.training_duration, ts.trainer_name, cs.city, ( SELECT COUNT(*) FROM training_log WHERE training_id = t.id ) AS nop FROM trainings t LEFT JOIN clients c ON t.client_id = c.id LEFT JOIN training_list tl ON t.training_code = tl.id LEFT JOIN trainers ts ON t.trainer1_id = ts.id LEFT JOIN cities cs ON t.city = cs.id WHERE c.id = {$id} ORDER BY t.id DESC");

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

    public function getCertificate($id,$tid)
    {
      $result = $this->db->select("SELECT tl.trainee_name, tl.cert_no, tl.qr_code, t.training_date, l.training_code, l.training_name, tr1.trainer_name as trainee1, tr2.trainer_name as trainee2 FROM training_log tl LEFT JOIN trainings t ON t.id = tl.training_id LEFT JOIN training_list l ON l.id = t.training_code LEFT JOIN trainers tr1 ON t.trainer1_id = tr1.id LEFT JOIN trainers tr2 ON t.trainer2_id = tr2.id WHERE tl.id = {$id} AND tl.training_id = {$tid}");
      return $result[0];
    }

    public function getAllClients()
    {
      return $this->db->select("SELECT * FROM clients");
    }

}
