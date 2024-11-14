<?php
require "utils/utils.php";
require "entities/ImagenGaleria.class.php";
require "entities/partners.class.php";

require_once 'repository/ImagenGalariaRepository.class.php';
require_once 'entities/connection.class.php';


// Lo necesario para poder almacenar las imagenes del servidor en la variable $arrayImagenesRepository
$config = require_once 'app/config.php';
App::bind('config', $config);
$imagenRepositorio = new ImagenGaleriaRepository();
$arrayImagenesRepository = $imagenRepositorio->findAll();

// Con foreach añado a una array de imagenes las imagenes que tengo almacenadas en el sevidor
foreach ($arrayImagenesRepository as $imagen) {
    $arrayImagenes[] = $imagen;
}


// For para crear seis Asociados

$arrayNombreAsociados = ["Miguel Ángel Fernández", "Fernando García", "Antonio Pérez", "Ana Fernández ", "Ramon López ", "Sara Martínez"];
$num = 1;
for ($i = 0; $i < 6; $i++) {
    $arrayPartners[] = new Partners($arrayNombreAsociados[$i], "images/index/log" . $num . ".jpg", " Asociado " . ($i + 1));
    if ($num >= 3) {
        $num = 1;
    } else {
        $num++;
    }
}

require "views/index.view.php";
