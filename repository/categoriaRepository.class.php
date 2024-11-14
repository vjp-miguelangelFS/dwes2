<?php
require_once 'entities/QuerryBuilder.class.php';

class CategoriaRepository extends QuerryBuilder
{
    public function __construct(string $table = 'categorias', string $classEntity = 'Categoria')
    {
        parent::__construct($table, $classEntity);
    }
}
