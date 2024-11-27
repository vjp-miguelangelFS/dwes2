<?php
require_once 'repository/mensajeRepository.class.php';
require_once 'entities/Mensaje.class.php';
require_once 'entities/connection.class.php';
// Codigo necesario para validar la información de la pagina contact
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Array de errores en el cual se almacenaras todos los errores que ocurran
    $arrayErrores;
    // Array en el cual almaceno todos los campos para poder validarlos en un ForEach
    $arrayCampos = ['First Name' => $_POST['firstName'], 'Email' => $_POST['email'], 'Subject' => $_POST['subject']];

    // ForEach para validar que ningun campo este vacio y en caso de que lo este añadira un error al array $arrayErrores
    foreach ($arrayCampos as $key => $value) {
        if (empty($value)) {
            $arrayErrores[] = 'El campo ' . $key . ' no puede estar vacio';
        }
    }
    // Valido que el campo email no este vacio y que utilize un formato correcto
    if (strpos($arrayCampos['Email'], '@') == false && !empty($arrayCampos['Email'])) {
        $arrayErrores[] = 'Email incorrecto';
    }
}

try {
    $config = require_once 'app/config.php';

    App::bind('config', $config);
    $mensajeRepository = new MensajeRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Consigo las dotos de los POST
        $nombre = trim(htmlspecialchars($_POST['firstName']));
        $apellidos = trim(htmlspecialchars($_POST['lastName']));
        $email = trim(htmlspecialchars($_POST['email']));
        $asunto = trim(htmlspecialchars($_POST['subject']));
        $texto = trim(htmlspecialchars($_POST['message']));
        $fecha = date('Y-m-d H:i:s');

        $mensaje = new Mensaje($nombre, $apellidos, $asunto, $email, $texto, $fecha);
        $mensajeRepository->save($mensaje);
    }
} catch (Exception $error) {
    throw $error;
} finally {
}
// Require necesarios para el funcionamiento de la página
require "utils/utils.php";
require "views/contact.view.php";
