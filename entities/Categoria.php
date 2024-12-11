<?php
// Llamo a la interfaz IEntity
namespace proyecto\entities;

use proyecto\database\IEntity;
// require_once 'database/IEntity.class.php';

// Clase Categoria que implementa la interfaz IEntity
class Categoria implements IEntity
{
    // Variable necesarias para la clase
    private $id;
    private $nombre;
    private $numImagenes;

    /**
     * Constructor de la clase Categoria
     *
     * @param string $nombre
     * @param integer $numImagenes
     */
    public function __construct(string $nombre = '', int $numImagenes = 0)
    {
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }

    // Getters y Setters de la clase Categoria
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getNumImagenes()
    {
        return $this->numImagenes;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setNumImagenes($numImagenes): void
    {
        $this->numImagenes = $numImagenes;
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
            'numImagenes' => $this->getNumImagenes()
        ];
    }
}
