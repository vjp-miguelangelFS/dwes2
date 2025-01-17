<?php
// Clase que controla las excepciones Querry
namespace proyecto\exceptions;

use Exception;

class QuerryException extends Exception
{
    public function __construct(string $mensaje)
    {
        // Llama al constructor de la clase padre que es Exception
        parent::__construct($mensaje);
    }
}
