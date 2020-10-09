<?php
class Auth
{

  private $_roles = ROLES;

  public function handleAuth($r)
  {
    if (!in_array(Session::get('role'), $r) && $this->byPassCheck()) {
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

    // echo $bypassurl;
    // die;
    $kural1 = !isset($_SESSION['loggedIn']) && !in_array($_SERVER['REQUEST_URI'], BYPASSLOGIN);
    $kural2 = self::byPassCheck();

    // die;
    // echo "kural1__".$kural1;
    // echo "<hr>";
    // echo "kural2__".$kural2;
    // echo "<hr>";
    // echo $kural1 && $kural2;
    // die;
    if ($kural1 && $kural2) {
      header('location: ../login');
      exit;
    }
  }

  public static function byPassCheck()
  {
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    $bypassurl = $url[0];
    if (!in_array($bypassurl, BYPASSCERT)) {
      return true;
    }
    return false;
  }

}
