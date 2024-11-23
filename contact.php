<?php
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
// Require necesarios para el funcionamiento de la página
require "utils/utils.php";
require "views/contact.view.php";
