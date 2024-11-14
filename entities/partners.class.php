<?php
class Partners
{
    private $nombre;
    private $logo;
    private $descripcion;

    public function __construct($nombre,  $logo,  $descripcion)
    {
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
}
