<?php
// Requires necesarios para el funcionamiento de la clase QuerryBuilder
namespace proyecto\entities;

use proyecto\exceptions\QuerryException;
use proyecto\entities\App;
use proyecto\database\IEntity;
use PDO;
use PDOException;
use Exception;
// require_once 'utils/const.php';
// require_once 'exceptions/querryException.class.php';
// require_once 'entities/App.class.php';
// require_once 'Categoria.class.php';

// Clase abstracta QuerryBuilder
abstract class QuerryBuilder
{
    // Variables necesarias para el funcionamiento de la clase
    private PDO $connection;

    private $table;

    private $classEntity;

    /**
     * Constructor de la clase QuerryBuilder
     *
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    /**
     * Retorna todas las columnas de una base de datos utilizando la sentencia MySQL SELECT * FROM "tabla"
     *
     * @return array
     */
    public function findAll(): array
    {
        $sqlStatement = "SELECT * FROM $this->table";

        $pdoStatement = $this->connection->prepare($sqlStatement);

        if ($pdoStatement->execute() === false) {
            throw new QuerryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
        }

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    /**
     * Inserta un dato a una base de datos y gestiona la transacción.
     *
     * @param IEntity $entity
     * @return void
     */
    public function save(IEntity $entity): void
    {
        try {
            // Comienza una transacción globalmente (en el método save)
            $this->connection->beginTransaction();

            // Convierte la entidad a un array de parámetros
            $parameters = $entity->toArray();

            // Prepara la sentencia SQL para insertar
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(',:', array_keys($parameters))
            );

            // Prepara y ejecuta la sentencia
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);

            // Si es una imagen, incrementa el número de imágenes en la categoría
            if ($entity instanceof ImagenGaleria) {
                $this->incrementaNumCategoria($entity->getCategoria());
            }

            // Si todo ha ido bien, realiza el commit de la transacción
            $this->connection->commit();
        } catch (PDOException $exception) {
            // Si ocurre un error, realiza el rollback
            $this->connection->rollBack();
            throw new QuerryException(ERROR_STRINGS[ERROR_INSERT_BD]);
        }
    }

    /**
     * Aumenta el número de imágenes almacenadas en una categoría.
     *
     * @param integer $categoria
     * @return void
     */
    public function incrementaNumCategoria(int $categoria)
    {
        try {
            // Realiza la operación sin abrir una nueva transacción
            $sql = "UPDATE categorias SET numImagenes = numImagenes + 1 WHERE id = :categoria";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':categoria' => $categoria]);

            // No hace falta un commit porque ya estamos dentro de una transacción activa
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
