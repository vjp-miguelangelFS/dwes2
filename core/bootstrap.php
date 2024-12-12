<?php

use proyecto\entities\App;
use proyecto\core\Router;
use proyecto\repository\MyLog;

require 'vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);

$router = Router::load('app/routes.php');
App::bind('router', $router);

App::bind('logger', new MyLog('logs/proyecto.log'));
