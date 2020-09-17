<?php
class Auth
{

    public static function handleLogin()
    {

        // $logged = $_SESSION['loggedIn'];
        // echo $logged;
        if (!isset($_SESSION)) {
          @session_start();
        }

        if (!isset($_SESSION['loggedIn'])) {
          session_destroy();
          header('location: ../login');
          exit;
        }

        // if ($logged == false) {
        //     session_destroy();
        //     header('location: ../login');
        //     exit;
        // }
    }

}
