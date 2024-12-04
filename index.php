<?php
    require 'core/bootstrap.php';

    $routes = require 'app/routes.php';

    $uri = trim($_SERVER['REQUEST_URI'],'/');

    require $routes[$uri];
?>