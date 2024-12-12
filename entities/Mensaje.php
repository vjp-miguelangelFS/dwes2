<?php

namespace proyecto\entities;

use proyecto\database\IEntity;

class Mensaje implements IEntity
{
    private $id;
    private $nombre;
    private $apellido;
    private $asunto;
    private $email;
    private $texto;
    private $fecha;

    public function __construct($nombre = "",  $apellido = "",  $asunto = "",  $email = "",  $texto = "",  $fecha = "")
    {
        $this->id = null;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->asunto = $asunto;
        $this->email = $email;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getAsunto()
    {
        return $this->asunto;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido): void
    {
        $this->apellido = $apellido;
    }

    public function setAsunto($asunto): void
    {
        $this->asunto = $asunto;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setTexto($texto): void
    {
        $this->texto = $texto;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'apellido' => $this->getApellido(),
            'asunto' => $this->getAsunto(),
            'email' => $this->getEmail(),
            'texto' => $this->getTexto(),
            'fecha' => $this->getFecha()
        ];
    }
}
