<?php
require 'core/bootstrap.php';

try {
    require Router::load('app/routes.php')->direct(Request::uri());
} catch (NotFoundException $exception) {
    die($exception->getMessage());
}
