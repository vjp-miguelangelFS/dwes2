<?php

require_once 'utils/utils.php';
require_once 'entities/File.class.php';
require_once 'entities/Asociados.class.php';
require_once 'entities/connection.class.php';
require_once 'entities/QuerryBuilder.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'repository/asociadosRepository.class.php';

$errores = [];
$descripcion = '';
$nombre = '';
$mensaje = '';

try {
    $config = require_once 'app/config.php';

    App::bind('config', $config);

    $asociadoRepository = new AsociadosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $nombre = trim(htmlspecialchars($_POST['nombre']));

        $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        $logo = new File('imagen', $tipoAceptados);

        $logo->saveUploadFile(Asociados::RUTA_LOGO);


        $asociado = new Asociados($nombre, $logo->getFileName(), $descripcion);
        $asociadoRepository->save($asociado);
        $descripcion = '';
        $mensaje = 'Imagen guardada';
    }
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
    $asociados = $asociadoRepository->findAll();
};


require_once 'views/asociados.view.php';
