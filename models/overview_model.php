<?php

class Overview_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCalendar()
    {
      return $this->db->select("SELECT t.id, t.training_date, c.client_name FROM trainings t LEFT JOIN clients c ON t.client_id = c.id");
    }

    public function getEventDetails($id)
    {
      return $this->db->select("    SELECT
          t.status,
          t.training_date,
          t.id,
          c.client_name,
          tl.training_name,
          t.training_code,
          ts.trainer_name,
          t.trainer1_id,
          cs.city,
          t.city AS ctyid
      FROM
          trainings t
      LEFT JOIN clients c ON
          t.client_id = c.id
      LEFT JOIN training_list tl ON
          t.training_code = tl.id
      LEFT JOIN trainers ts ON
          t.trainer1_id = ts.id
      LEFT JOIN cities cs ON
          t.city = cs.id
      WHERE t.id = {$id}
      ORDER BY
          t.id
      DESC");
    }

    public function getTrainerTraineCount()
    {
      return $this->db->select("SELECT COUNT(tl.trainee_name) as y, tr.trainer_name as name FROM training_log tl LEFT JOIN trainings t ON t.id = tl.training_id LEFT JOIN trainers tr ON tr.id = t.trainer1_id GROUP BY name");
    }

    public function getTraineeByDate()
    {
      return $this->db->select("SELECT COUNT(tl.trainee_name) as trcnt, t.training_date as dt FROM training_log tl LEFT JOIN trainings t ON tl.training_id = t.id GROUP BY dt ASC");
    }

    public function getTraineesByClients()
    {
      return $this->db->select("SELECT COUNT(tl.trainee_name) as cnt, c.client_name as cn FROM training_log tl LEFT JOIN trainings t ON tl.training_id = t.id LEFT JOIN clients c ON t.client_id = c.id GROUP BY cn");
    }

    public function getTraineesByTrainings()
    {
      return $this->db->select("SELECT COUNT(tl.trainee_name) as y, tls.training_name as name FROM training_log tl LEFT JOIN trainings t ON tl.training_id = t.id LEFT JOIN training_list tls ON tls.id = t.training_code GROUP BY name ORDER BY y DESC");
    }

}
