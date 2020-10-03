<?php

class Clientinfo_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserDetails($uid)
    {
      $userdata = $this->db->select("SELECT u.login, u.user_name, u.user_surname, u.user_position, u.telefon, u.email, cu.client_id FROM USER u LEFT JOIN clientuser cu ON cu.user_id = u.userid WHERE userid = {$uid}");
      return $userdata[0];
    }

    public function getCompanyInfo($cid)
    {
      $clientdata = $this->db->select("SELECT c.id, c.client_name, c.client_longname, c.client_city as client_plaka, ct.city as city, c.client_address, c.client_phone, c.client_webpage, c.vergi_dairesi, v.plaka as vergi_plaka, v.city as vergi_city, v.vergidairesi as vergidairesiismi, c.vergi_no FROM clients c LEFT JOIN vergidaireleri v ON c.vergi_dairesi = v.id LEFT JOIN cities ct ON c.client_city = ct.id WHERE c.id = {$cid}");
      return $clientdata[0];
    }

    public function getCities()
    {
      return $this->db->select("SELECT * FROM cities");
    }

    public function getVergiPlaka($uid)
    {
      $p = $this->db->select("SELECT DISTINCT(v.plaka) as plaka FROM user u LEFT JOIN clientuser cu ON u.userid = cu.user_id LEFT JOIN clients c ON c.id = cu.client_id LEFT JOIN vergidaireleri v ON c.vergi_dairesi = v.id WHERE u.userid = {$uid}");
      return $p[0]['plaka'];
    }

    public function getVergiDaireleri($plaka)
    {
      return $this->db->select("SELECT id, plaka, city, vergidairesi FROM vergidaireleri WHERE plaka = {$plaka}");
    }

    public function updateUserEmail($uid,$email)
    {
      $this->db->select("UPDATE `user` SET `email`='{$email}' WHERE `userid` = {$uid}");
    }

    public function editClient($client_id, $client_name, $client_longname, $city, $client_address, $client_phone, $client_webpage, $vergi_dairesi, $vergi_no )
    {
      $this->db->select("UPDATE `clients` SET `client_name`='{$client_name}',`client_longname`='{$client_longname}',`client_city`='{$city}',`client_address`='{$client_address}',`client_phone`='{$client_phone}',`client_webpage`='{$client_webpage}',`vergi_dairesi`={$vergi_dairesi},`vergi_no`={$vergi_no} WHERE `id`={$client_id}");
    }

    // public function getClientLogData($id)
    // {
    //   return $this->db->select("
    //     SELECT
    //     t.status,
    //     t.training_date,
    //     t.id,
    //     c.client_name,
    //     tl.training_code,
    //     tl.training_name,
    //     tl.training_duration,
    //     ts.trainer_name,
    //     cs.city,
    //     (SELECT COUNT(*) FROM training_log WHERE training_id = t.id) as nop
    //     FROM trainings t
    //     LEFT JOIN clientuser cu ON cu.client_id = t.client_id
    //     LEFT JOIN clients c ON t.client_id = c.id
    //     LEFT JOIN training_list tl ON t.training_code = tl.id
    //     LEFT JOIN trainers ts ON t.trainer1_id = ts.id
    //     LEFT JOIN cities cs ON t.city = cs.id
    //     WHERE cu.user_id = {$id}
    //     ORDER BY t.id DESC
    //     ");
    // }
    //
    // public function getParticipants($id)
    // {
    //   return $this->db->select("SELECT `id`, `trainee_name`, `trainee_id`, `cert_no` FROM `training_log` WHERE `training_id` = {$id}");
    // }
    //
    // public function deleteExistingTrainees($tid)
    // {
    //   $this->db->select("DELETE FROM `training_log` WHERE `training_id` = {$tid}");
    // }
    //
    // public function insertNewList($tid,$value,$i)
    // {
    //   $this->db->select("INSERT INTO `training_log`(`training_id`, `trainee_name`, `trainee_id`) VALUES ({$tid},'{$value}',{$i})");
    // }
    //
    // public function changeStatus($id)
    // {
    //   $this->db->select("UPDATE `trainings` SET `status`= '1' WHERE `id` = {$id}");
    //   return "success";
    // }

}
