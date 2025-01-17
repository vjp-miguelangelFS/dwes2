<?php

use proyecto\repository\AsociadosRepository;
use proyecto\entities\File;
use proyecto\entities\Asociados;
use proyecto\exceptions\FileException;
use proyecto\exceptions\QuerryException;

// Variables necesarios para poder añadir un asociado a la base de datos y un array de errores
$errores = [];
$descripcion = '';
$nombre = '';
$mensaje = '';

try {


    $asociadoRepository = new AsociadosRepository();

    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    $nombre = trim(htmlspecialchars($_POST['nombre']));

    $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

    $logo = new File('imagen', $tipoAceptados);
    $logo->saveUploadFile(Asociados::RUTA_LOGO);

    $asociado = new Asociados($nombre, $logo->getFileName(), $descripcion);
    $asociadoRepository->save($asociado);
    $descripcion = '';
    $mensaje = 'Se ha guardado un nuevo asociado: ' . $asociado->getNombre();
} catch (FileException $exception) {
    die($exception->getMessage());
} catch (QuerryException $exception) {
    die($exception->getMessage());
}
header('location: /asociados');
