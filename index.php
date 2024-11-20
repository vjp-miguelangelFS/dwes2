<?php
require_once "utils/utils.php";
require_once "entities/ImagenGaleria.class.php";
require_once "entities/Asociados.class.php";
require_once "entities/partners.class.php";

require_once 'repository/ImagenGalariaRepository.class.php';
require_once 'repository/asociadosRepository.class.php';
require_once 'entities/connection.class.php';


// Lo necesario para poder almacenar las imagenes del servidor en la variable $arrayImagenesRepository
$arrayVacioImagenes = false;
$config = require_once 'app/config.php';
App::bind('config', $config);
$imagenRepositorio = new ImagenGaleriaRepository();
$arrayImagenesRepository = $imagenRepositorio->findAll();

// Con foreach añado a una array de imagenes las imagenes que tengo almacenadas en el sevidor
if (count($arrayImagenesRepository) == 0) {
    $arrayVacioImagenes = true;
} else {
    foreach ($arrayImagenesRepository as $imagen) {
        $arrayImagenes[] = $imagen;
    }
}



// For para crear seis Asociados

// Boolean para comprobar que el arrayAsociados no este vacio para que no ocurra ningun error.
$arrayVacioAsociados = false;

$config = require_once 'app/config.php';
App::bind('config', $config);
$asociados = new AsociadosRepository();
$arrayAsociados = $asociados->findAll();
if (count($arrayAsociados) == 0) {
    $arrayVacioAsociados = true;
} else {
    foreach ($arrayAsociados as $asociado) {
        $arrayPartners[] = $asociado;;
    }
}


require "views/index.view.php";
