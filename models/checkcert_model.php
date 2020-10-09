<?php

class Checkcert_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCert($certno)
    {
      $result = $this->db->select("
      SELECT
          tl.trainee_name,
          tl.cert_no,
          t.training_date,
          DATE_ADD(t.training_date, INTERVAL 2 YEAR) as gecerliliktarihi,
          c.client_name,
          c.client_longname,
          tls.training_name,
          tls.training_duration,
          tr1.trainer_name,
          tr2.trainer_name,
          ct.city
      FROM
          training_log tl
      LEFT JOIN trainings t ON
      	tl.training_id = t.id
      LEFT JOIN clients c ON
      	t.client_id = c.id
      LEFT JOIN training_list tls ON
      	tls.id = t.training_code
      LEFT JOIN trainers tr1 ON
      	t.trainer1_id = tr1.id
      LEFT JOIN trainers tr2 ON
      	t.trainer1_id = tr2.id
      LEFT JOIN cities ct ON
      	ct.id = t.city
      WHERE
          tl.qr_code = {$certno}
      ");

      return $result[0];
    }

}
