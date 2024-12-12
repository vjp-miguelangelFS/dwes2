<?php

namespace proyecto\entities;

use proyecto\database\IEntity;

// Clase Asociados que implementa la interfaz IEntity
class Asociados implements IEntity
{
    // Constantes con las ruta de las carpeta logo
    const RUTA_LOGO = 'images/logo/';

    // Variable necesarias para la clase
    private $id;
    private $nombre;
    private $log;
    private $descripcion;

    /**
     * Constructor de la clase Asociados
     *
     * @param string $nombre
     * @param string $log
     * @param string $descripcion
     */
    public function __construct($nombre = '', $log = '', $descripcion = '')
    {
        $this->nombre = $nombre;
        $this->log = $log;
        $this->descripcion = $descripcion;
        $this->id = null;
    }
    // Getters y Setters de la clase Asociados
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getLogo()
    {
        return $this->log;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setLogo($log): void
    {
        $this->log = $log;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getRutaLogo()
    {
        return self::RUTA_LOGO . $this->getLogo();
    }

    /**
     * Función toArray convierte un Objeto en un array asociativo 
     * donde las claves corresponden a los nombres de las propiedades del objeto y los valores son los datos de esas propiedades.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'log' => $this->getLogo(),
            'descripcion' => $this->getDescripcion(),
        ];
    }
}
