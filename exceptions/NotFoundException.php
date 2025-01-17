<?php
// Clase que controla las excepciones App
namespace proyecto\exceptions;

use Exception;

class NotFoundException extends Exception
{

    public function __construct(string $mensaje)
    {
        // Llama al constructor de la clase padre que es Exception
        parent::__construct($mensaje);
    }
}
