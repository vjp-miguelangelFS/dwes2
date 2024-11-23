<?php
// Clase que controla las excepciones File

class FileException extends Exception
{
    public function __construct(string $mensaje)
    {
        // Llama al constructor de la clase padre que es Exception
        parent::__construct($mensaje);
    }
}
