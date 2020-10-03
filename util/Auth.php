<?php
class Auth
{

  private $_roles = ROLES;

  public function handleAuth($r)
  {
    if (!in_array(Session::get('role'), $r)) {
      header('location: ../hata');
    }
    return $this->getMenu();
  }

  public function getMenu()
  {
    $menu = [];

    foreach (glob('controllers/*.php') as $file)
    {
      $temp = [];
        require_once $file;
        $class = basename($file, '.php');
        if (class_exists($class))
        {
          $c = ucfirst($class);

          if (isset($c::$_pageIcon)) {
            $temp['ikon'] = $c::$_pageIcon;
          }

          if (isset($c::$_pageHeading)) {
            $temp['name'] = $c::$_pageHeading;
            $temp['link'] = $class;
          }

          if (isset($c::$_roles) && in_array(Session::get('role'),$c::$_roles)) {
            array_push($menu,$temp);
          }

        }

    }
    return $menu;
  }

  public function setRoles($r)
  {
    $this->_roles = $r;
    return $this->handleAuth($r);
  }

  public static function handleLogin()
  {
    if (!isset($_SESSION['loggedIn']) && !in_array($_SERVER['REQUEST_URI'], BYPASS)) {
      header('location: ../login');
      exit;
    }
  }

}
