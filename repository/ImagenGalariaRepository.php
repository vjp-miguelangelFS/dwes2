<?php

namespace proyecto\repository;

use proyecto\entities\ImagenGaleria;
use proyecto\entities\QuerryBuilder;

// Clase ImagenGaleriaRepository con un extends a QuerryBuilder
class ImagenGalariaRepository extends QuerryBuilder
{
    // Constructor que contiene la variabole $table con el nombre de la tabla que contiene las imagenes de la base de datos,
    // y la variable $classEntity con el nombre de la clase ImagenGaleria
    public function __construct(string $table = 'imagenes', string $classEntity = ImagenGaleria::class)
    {
        // Llama al constructor de la clase padre QuerryBuilder
        parent::__construct($table, $classEntity);
    }
}
