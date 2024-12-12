<?php

use proyecto\exceptions\AppException;
use proyecto\repository\AsociadosRepository;
use proyecto\exceptions\FileException;
use proyecto\exceptions\QuerryException;

// Variables necesarios para poder añadir un asociado a la base de datos y un array de errores
$errores = [];
$descripcion = '';

try {

    $asociadoRepository = new AsociadosRepository();
} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QuerryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    $errores[] = $exception->getMessage();
} catch (Exception $exception) {
    $errores[] = $exception->getMessage();
} finally {
    // Almaceno todos los asociados de la base de datos
    $asociados = $asociadoRepository->findAll();
};

require_once __DIR__ . '/../views/asociados.view.php';
