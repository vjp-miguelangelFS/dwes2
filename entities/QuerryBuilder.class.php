<?php
require_once 'utils/const.php';
require_once 'exceptions/querryException.class.php';
require_once 'entities/App.class.php';
require_once 'Categoria.class.php';
abstract class QuerryBuilder
{
    /**
     * @var PDO
     */
    private $connection;

    private $table;

    private $classEntity;

    /**
     * @param PDO $connection
     */
    public function __construct(string $table, string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }
    public function findAll(): array
    {
        $sqlStatement = "SELECT * FROM $this->table";

        $pdoStatement = $this->connection->prepare($sqlStatement);

        if ($pdoStatement->execute() === false) {
            throw new QuerryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
        }

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

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

            if ($entity instanceof ImagenGaleria) { //Si es una iamgen lo que estamos insertando en la tabla incrementa el número de imágenes correspondientes en la tabla categoria
                $this->incrementaNumCategoria($entity->getCategoria());
            }
        } catch (PDOException $exception) {
            throw new QuerryException(ERROR_STRINGS[ERROR_INSERT_BD]); // Pasar el mensaje a const.php
        }
    }

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
