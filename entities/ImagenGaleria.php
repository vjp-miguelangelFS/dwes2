<?php

namespace proyecto\entities;

use proyecto\database\IEntity;

// Clase ImagenGaleria que implementa la interfaz IEntity
class ImagenGaleria implements IEntity
{
    // Constantes con las ruta de las carpeta portafolio y gallery
    const RUTA_IMAGENES_PORTAFOLIO = "images/index/portfolio/";
    const RUTA_IMAGENES_GALLERY = "images/index/gallery/";

    // Variable necesarias para la clase
    private $nombre;

    private $descripcion;

    private $numVisualizaciones;

    private $numLikes;

    private $numDownloads;

    private $id;

    private $categoria;

    /**
     * Constructor de la clase ImagenGaleria
     *
     * @param string $nombre
     * @param string $descripcion
     * @param integer $categoria
     * @param integer $numVisualizaciones
     * @param integer $numLikes
     * @param integer $numDownloads
     */
    public function __construct($nombre = '',  $descripcion = '', int $categoria = 0,  $numVisualizaciones = 0,  $numLikes = 0,  $numDownloads = 0)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->numVisualizaciones = rand(0, 12000);
        $this->numLikes = rand(0, 12000);
        $this->numDownloads = rand(0, 12000);
        $this->id = null;
        $this->categoria = $categoria;
    }

    // Getters y Setters de la clase ImagenGaleria
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function getNumVisualizaciones()
    {
        return $this->numVisualizaciones;
    }

    public function getNumLikes()
    {
        return $this->numLikes;
    }

    public function getNumDownloads()
    {
        return $this->numDownloads;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }
    public function setNumVisualizaciones($numVisualizaciones): void
    {
        $this->numVisualizaciones = $numVisualizaciones;
    }

    public function setNumLikes($numLikes): void
    {
        $this->numLikes = $numLikes;
    }

    public function setNumDownloads($numDownloads): void
    {
        $this->numDownloads = $numDownloads;
    }

    /**
     * Concatena la ruta de la carpeta portafolio con el nombre de la imagen
     *
     * @return string
     */
    public function getUrlPortafolio(): string
    {
        return self::RUTA_IMAGENES_PORTAFOLIO . $this->getNombre();
    }
    /**
     * Concatena la ruta de la carpeta gallery con el nombre de la imagen
     *
     * @return string
     */
    public function getUrlGallery(): string
    {
        return self::RUTA_IMAGENES_GALLERY . $this->getNombre();
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
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDescargas' => $this->getNumDownloads(),
            'categoria' => $this->getCategoria()
        ];
    }
}
