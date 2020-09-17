<?php

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $sth = $this->db->prepare("SELECT userid, role, user_name, user_surname FROM user WHERE
                login = :login AND password = :password");
        $sth->execute(array(
            ':login' => $_POST['login'],
            ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));

        $data = $sth->fetch();

        $count =  $sth->rowCount();
        if ($count > 0) {
            $u_name = $data["user_name"]." ".$data["user_surname"];
            // login
            Session::init();
            Session::set('role', $data['role']);
            Session::set('loggedIn', true);
            Session::set('userid', $data['userid']);
            Session::set('username', $u_name);
            // echo Session::get('loggedIn');
            header('location: ../dashboard');
        } else {
            header('location: ../login');
        }

    }

}
