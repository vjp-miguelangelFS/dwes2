<?php
require 'core/bootstrap.php';

try {
    require Router::load('app/routes.php')->direct(Request::uri(), Request::method());
} catch (NotFoundException $exception) {
    die($exception->getMessage());
}
