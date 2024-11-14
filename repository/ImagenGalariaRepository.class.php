<?php
require_once 'entities/QuerryBuilder.class.php';

class ImagenGaleriaRepository extends QuerryBuilder
{
    public function __construct(string $table = 'imagenes', string $classEntity = 'ImagenGaleria')
    {
        parent::__construct($table, $classEntity);
    }
}
