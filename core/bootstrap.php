<?php
require 'entities/App.class.php';
require 'Request.class.php';
require 'Router.class.php';
require 'exceptions/NotFoundException.php';
require 'repository/MyLog.class.php';
require 'vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);

$router = Router::load('app/routes.php');
App::bind('router', $router);

App::bind('logger',new MyLog('logs/proyecto.log'));