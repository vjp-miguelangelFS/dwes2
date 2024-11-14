<?php
require_once 'entities/QuerryBuilder.class.php';

class AsociadosRepository extends QuerryBuilder
{
    public function __construct(string $table = 'asociados', string $classEntity = 'Asociados')
    {
        parent::__construct($table, $classEntity);
    }
}
