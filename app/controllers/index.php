<?php
// Require necesarios para el funcionamiento de la pagina

use proyecto\repository\ImagenGalariaRepository;
use proyecto\repository\AsociadosRepository;
use proyecto\entities\App;
use proyecto\repository\MyMail;

// Lo necesario para poder almacenar las imagenes del servidor en la variable $arrayImagenesRepository
try {
    $arrayVacioImagenes = false;

    $imagenRepositorio = new ImagenGalariaRepository();
} catch (Exception $error) {
    throw $error;
} finally {
    $arrayImagenesRepository = $imagenRepositorio->findAll();
}


// Con foreach añado a una array de imagenes las imagenes que tengo almacenadas en el sevidor
if (count($arrayImagenesRepository) == 0) {
    $arrayVacioImagenes = true;
} else {
    foreach ($arrayImagenesRepository as $imagen) {
        $arrayImagenes[] = $imagen;
    }
}

// Codigo para conseguir los asociados de la base de dato
try {
    $arrayVacioAsociados = false;

    $config = require_once 'app/config.php';
    App::bind('config', $config);
    $asociados = new AsociadosRepository();
} catch (Exception $error) {
    throw $error;
} finally {
    $arrayAsociados = $asociados->findAll();
}


// If para comprobar si se tiene que ordenar aleatoriamente los asociados o mostrar los tres primeros
if (count($arrayAsociados) == 0) {
    $arrayVacioAsociados = true;
} else {
    foreach ($arrayAsociados as $asociado) {
        $arrayPartners[] = $asociado;;
    }
}

$mail = new MyMail();
// $mail->__construct();
// $mail->send('Hola', 'pruebamiguel174@gmail.com', 'Proyecto DWES', 'Prueba mail proyecto');
// Llamo a index view
require __DIR__ . "/../views/index.view.php";
