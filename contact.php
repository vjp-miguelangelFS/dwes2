<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $arrayErrores;
    $arrayCampos = ['First Name' => $_POST['firstName'], 'Email' => $_POST['email'], 'Subject' => $_POST['subject']];

    foreach ($arrayCampos as $key => $value) {
        if (empty($value)) {
            $arrayErrores[] = 'El campo ' . $key . ' no puede estar vacio';
        }
    }
    if (strpos($arrayCampos['Email'], '@') == false && !empty($arrayCampos['Email'])) {
        $arrayErrores[] = 'Email incorrecto';
    }
}

require "utils/utils.php";
require "views/contact.view.php";

?>