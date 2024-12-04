<?php
require 'entities/App.class.php';
require 'Request.class.php';
require 'Router.class.php';
require 'exceptions/NotFoundException.php';

$config = require_once __DIR__ . '/../app/config.php';
App::bind('config', $config);
