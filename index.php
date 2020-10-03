<?php

require 'config.php';
require 'util/Auth.php';

function yoneticiClasslariYukle($class) {
    require_once(CORE . $class .".php");
}
spl_autoload_register('yoneticiClasslariYukle');

$rota = new Rota;
$rota->baslat();

// $bootstrap = new Bootstrap();

// İlave - Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

// $bootstrap->init();
