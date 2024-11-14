<?php
require_once "utils/utils.php";
require_once "entities/ImagenGaleria.class.php";
require_once "entities/Asociados.class.php";
require_once "entities/partners.class.php";

require_once 'repository/ImagenGalariaRepository.class.php';
require_once 'repository/asociadosRepository.class.php';
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


$config = require_once 'app/config.php';
App::bind('config', $config);
$asociados = new AsociadosRepository();
$arrayAsociados = $asociados->findAll();

foreach ($arrayAsociados as $asociado) {
    $arrayPartners[] = $asociado;;
}

require "views/index.view.php";
