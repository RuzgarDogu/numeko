<?php

class Users_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    // public function deneme()
    // {
    //   return $this->db->select("SELECT * FROM person WHERE age>23");
    // }

    public function getAllUsers()
    {
      return $this->db->select("SELECT u.userid, u.login, u.role, u.user_name, u.user_surname, (CASE WHEN cu.client_id IS NULL THEN 'Numeko' ELSE c.client_name END) as client FROM user u LEFT JOIN clientuser cu ON u.userid = cu.user_id LEFT JOIN clients c ON cu.client_id = c.id");
    }

    public function getClients()
    {
      return $this->db->select("SELECT * FROM clients");
    }

    public function addUser($username,$usersurname,$login,$pwd,$role)
    {
      $this->db->select("INSERT INTO `user`(`login`, `password`, `role`, `user_name`, `user_surname`) VALUES ('{$login}','{$pwd}','{$role}','{$username}','{$usersurname}')");
      return $this->db->lastInsertId();
    }

    public function addClientUser($uid,$clientid)
    {
      $this->db->select("INSERT INTO `clientuser`(`client_id`, `user_id`) VALUES ({$clientid},{$uid})");
    }

    public function deleteUser($uid)
    {
      $this->db->select("DELETE FROM `user` WHERE `userid` = {$uid}");
    }

    public function editUser($username,$usersurname,$login,$role,$uid)
    {
      $this->db->select("UPDATE `user` SET `login`='{$login}', `role`='{$role}',`user_name`='{$username}',`user_surname`='{$usersurname}' WHERE `userid`={$uid}");
    }

    public function changePassword($uid,$pwd)
    {
      $this->db->select("UPDATE `user` SET `password`='{$pwd}' WHERE `userid`={$uid}");
    }

}
