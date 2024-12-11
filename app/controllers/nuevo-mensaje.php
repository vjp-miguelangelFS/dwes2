<?php
// require_once 'repository/mensajeRepository.class.php';
// require_once 'entities/Mensaje.class.php';
// require_once 'entities/connection.class.php';

use proyecto\repository\MensajeRepository;
use proyecto\entities\Mensaje;
use proyecto\exceptions\FileException;
use proyecto\exceptions\QuerryException;

try {

    $mensajeRepository = new MensajeRepository();

    // Consigo las dotos de los POST
    $nombre = trim(htmlspecialchars($_POST['firstName']));
    $apellidos = trim(htmlspecialchars($_POST['lastName']));
    $email = trim(htmlspecialchars($_POST['email']));
    $asunto = trim(htmlspecialchars($_POST['subject']));
    $texto = trim(htmlspecialchars($_POST['message']));
    $fecha = date('Y-m-d H:i:s');

    $mensaje = new Mensaje($nombre, $apellidos, $asunto, $email, $texto, $fecha);
    $mensajeRepository->save($mensaje);
} catch (FileException $exception) {
    die($exception->getMessage());
} catch (QuerryException $exception) {
    die($exception->getMessage());
}

header('location: /contact');
