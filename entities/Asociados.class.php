<?php
require_once 'database/IEntity.class.php';
class Asociados implements IEntity
{
    const RUTA_LOGO = 'images/logo/';

    private $id;
    private $nombre;
    private $log;
    private $descripcion;



    public function __construct($nombre = '', $log = '', $descripcion = '')
    {
        $this->nombre = $nombre;
        $this->log = $log;
        $this->descripcion = $descripcion;
        $this->id = null;
    }

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
