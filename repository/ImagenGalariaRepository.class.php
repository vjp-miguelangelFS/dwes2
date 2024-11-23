<?php
// Llamo a la clase abstracta QuerryBuilder
require_once 'entities/QuerryBuilder.class.php';
// Clase ImagenGaleriaRepository con un extends a QuerryBuilder
class ImagenGaleriaRepository extends QuerryBuilder
{
    // Constructor que contiene la variabole $table con el nombre de la tabla que contiene las imagenes de la base de datos,
    // y la variable $classEntity con el nombre de la clase ImagenGaleria
    public function __construct(string $table = 'imagenes', string $classEntity = 'ImagenGaleria')
    {
        // Llama al constructor de la clase padre QuerryBuilder
        parent::__construct($table, $classEntity);
    }
}
