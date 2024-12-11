<?php
// Require necesarios
// require_once 'utils/utils.php';
// require_once 'entities/File.class.php';
// require_once 'entities/Asociados.class.php';
// require_once 'entities/connection.class.php';
// require_once 'entities/QuerryBuilder.class.php';
// require_once 'exceptions/AppException.class.php';
// require_once 'repository/asociadosRepository.class.php';
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
