<?php
// Requires necesarios para el funcionamiento de la clase QuerryBuilder
require_once 'utils/const.php';
require_once 'exceptions/querryException.class.php';
require_once 'entities/App.class.php';
require_once 'Categoria.class.php';
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
     * Retorna tadas la columnas de una base de datos utilizando la sencia MySQL SELECT * FROM "tabla"
     * y realizando una conexión con la base de datos con ayuda de la clase Connection
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
     * Inserta un dato a una base de datos utilizando la sentencia MySQL insert into tabla (campos necsarios) values (valores de los campos)' ,
     * y realiza una conexión can la base de datos utilizando la clase Connection
     *
     * @param IEntity $entity
     * @return void
     */
    public function save(IEntity $entity): void
    {
        try {
            $parameters = $entity->toArray();

            $sql = sprintf(
                'insert into %s (%s) values (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(',:', array_keys($parameters))
            );

            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);

            if ($entity instanceof ImagenGaleria) { //Si es una imagen lo que estamos insertando en la tabla incrementa el número de imágenes correspondientes en la tabla categoria
                $this->incrementaNumCategoria($entity->getCategoria());
            }
        } catch (PDOException $exception) {
            throw new QuerryException(ERROR_STRINGS[ERROR_INSERT_BD]);
        }
    }
    /**
     * Aumenta el Num de datos almacenas en una categoria utilzando la sentencia MySQL "UPDATE categorias SET numImagenes=numImagenes+1 WHERE id = $categoria",
     * y realiza una conexión con la base de datos con la clase Connection
     *
     * @param integer $categoria
     * @return void
     */
    public function incrementaNumCategoria(int $categoria)
    {
        try {
            $this->connection->beginTransaction();
            $sql = "UPDATE categorias SET numImagenes=numImagenes+1 WHERE id = $categoria";
            $this->connection->exec($sql);
            $this->connection->commit();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
