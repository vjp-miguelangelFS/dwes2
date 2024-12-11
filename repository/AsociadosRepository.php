<?php
// Llamo a la clase abstracta QuerryBuilder
namespace proyecto\repository;

use proyecto\entities\Asociados;
use proyecto\entities\QuerryBuilder;
// require_once 'entities/QuerryBuilder.class.php';

// Clase AsociadosRepository con un extends a QuerryBuilder
class AsociadosRepository extends QuerryBuilder
{
    // Constructor que contiene la variabole $table con el nombre de la tabla que contiene los asociados de la base de datos,
    // y la variable $classEntity con el nombre de la clase Asociados
    public function __construct(string $table = 'asociados', string $classEntity = Asociados::class)
    {
        // Llama al constructor de la clase padre QuerryBuilder
        parent::__construct($table, $classEntity);
    }
}
