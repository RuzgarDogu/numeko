<?php

class Logbook_Model extends Model {

  public function __construct() {
    parent::__construct();
  }

  public function getClients()
  {
    return $this->db->select("SELECT * FROM clients");
  }

  public function addNewClient($yeni_client)
  {
    $this->db->select("INSERT INTO clients (client_name) VALUES ('{$yeni_client}')");
    return $this->db->lastInsertId();
  }

  public function getCities()
  {
    return $this->db->select("SELECT * FROM cities");
  }

  public function getTrainers()
  {
    return $this->db->select("SELECT * FROM trainers");
  }

  public function getTrainingList()
  {
    return $this->db->select("SELECT * FROM training_list");
  }

  public function getLogbook()
  {
    return $this->db->select("SELECT * FROM training_log");
  }

  public function addNewTraining($client_id,$date,$trainer1,$trainer2,$city,$training_code,$status)
  {
    $this->db->select("INSERT INTO `trainings`(`training_date`, `client_id`, `training_code`, `trainer1_id`, `trainer2_id`, `city`,`status`) VALUES ('{$date}',{$client_id},'{$training_code}',{$trainer1},{$trainer2},{$city},'{$status}')");
    return $this->db->lastInsertId();
  }

  public function editTraining($datum,$e_training_code,$e_trainer1,$e_city,$stati,$trainingid)
  {
    $this->db->select("UPDATE `trainings` SET `training_date`='{$datum}',`training_code`={$e_training_code},`trainer1_id`={$e_trainer1},`city`={$e_city},`status`='{$stati}' WHERE `id`={$trainingid}");
  }

  public function deleteFromTrainingLog($trainingid)
  {
    $this->db->select("DELETE FROM `training_log` WHERE `training_id`={$trainingid}");
  }

  public function addTrainee($trainingId,$v,$i,$cert,$zeroi)
  {
    $this->db->select("INSERT INTO `training_log`(`training_id`, `trainee_name`, `trainee_id`, `cert_no`) VALUES ({$trainingId},'{$v}',{$i},CONCAT('{$cert}',LPAD({$trainingId},3,0),'{$zeroi}'))");
    return $this->db->lastInsertId();
  }

  public function addToTrainingLog($traineeId)
  {
    $this->db->select("UPDATE `training_log` SET `qr_code`=CONCAT(MID(`cert_no`, 4, 3),LEFT(ASCII(LEFT(`trainee_name`,1)),2),RIGHT(`cert_no`,2),RIGHT(ASCII(RIGHT(`trainee_name`,1)),2)) WHERE id = {$traineeId}");
  }

  public function deleteTrainingLog($trainingid)
  {
    $this->db->select("DELETE FROM `training_log` WHERE `training_id`={$trainingid}");
  }

  public function deleteTraining($trainingid)
  {
      $this->db->select("DELETE FROM `trainings` WHERE `id`={$trainingid}");
  }

  public function getParticipants($id)
  {
    return $this->db->select("SELECT `id`, `trainee_name`, `trainee_id`, `cert_no` FROM `training_log` WHERE `training_id` = {$id}");
  }

  public function getTab1()
  {
    $data = $this->db->select("
    SELECT
    t.status,
    t.training_date,
    t.id,
    c.client_name,
    tl.training_name,
    t.training_code,
    ts.trainer_name,
    t.trainer1_id,
    cs.city,
    t.city as ctyid
    FROM trainings t
    LEFT JOIN clients c ON t.client_id = c.id
    LEFT JOIN training_list tl ON t.training_code = tl.id
    LEFT JOIN trainers ts ON t.trainer1_id = ts.id
    LEFT JOIN cities cs ON t.city = cs.id
    ORDER BY t.id DESC"
  );

  for ($i=0; $i < count($data); $i++) {
    $data[$i]['validuntil'] = date('Y-m-d', strtotime('+2 years', strtotime($data[$i]['training_date'])));
    $cnt = $this->db->select("SELECT COUNT(id) as cnt FROM training_log where training_id = {$data[$i]['id']}");
    $data[$i]['participants'] = $cnt[0]['cnt'];
  }
  return $data;
  }


  public function getTab2()
  {
    $data = $this->db->select("
    SELECT
    tlg.id as tlid,
    t.id as trid,
    tlg.trainee_name,
    tlg.trainee_id,
    tlg.cert_no,
    t.training_date,
    tl.training_name,
    c.client_name,
    trs.trainer_name
    FROM training_log tlg
    LEFT JOIN trainings t
    ON tlg.training_id = t.id
    LEFT JOIN training_list tl
    ON tl.id = t.training_code
    LEFT JOIN clients c
    ON c.id = t.client_id
    LEFT JOIN trainers trs
    ON t.trainer1_id = trs.id
    ORDER BY tlid DESC
    ");
    return $data;
  }


  public function getTab3()

  {
    $data = $this->db->select("
    SELECT
    t.training_date,
    t.id,
    -- t.trainer2_id,
    tl.training_code,
    tl.training_name,
    tl.training_duration AS duration,
    c.client_name,
    tlg.trainee_id,
    tlg.trainee_name,
    tlg.cert_no,
    ts.trainer_name,
    tss.trainer_name AS TRN2,
    cs.city
    FROM trainings t
    LEFT JOIN clients c ON t.client_id = c.id
    LEFT JOIN training_list tl ON t.training_code = tl.id
    LEFT JOIN trainers ts ON t.trainer1_id = ts.id
    LEFT JOIN trainers tss ON t.trainer2_id = tss.id
    LEFT JOIN cities cs ON t.city = cs.id
    LEFT JOIN training_log tlg ON t.id = tlg.training_id
    WHERE t.status = 3
    ");

    for ($i=0; $i < count($data); $i++) {
      $data[$i]['validuntil'] = date('Y-m-d', strtotime('+2 years', strtotime($data[$i]['training_date'])));
      // $tr2 = $this->db->select("SELECT trainer_name as tr2 FROM trainers where id = {$data[$i]['trainer2_id']}");
      // $data[$i]['trn222'] = $tr2[0]['tr2'];
    }
    return $data;
  }

}
