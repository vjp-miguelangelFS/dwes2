<?php
// Llamo a la clase App y al fichero const.php que almacena los mensajes de los errores
// require_once 'entities/App.class.php';
namespace proyecto\entities;

use PDO;
use PDOException;
use proyecto\exceptions\AppException;
// require_once 'utils/const.php';

// Clase Connection
class Connection
{
    /**
     * La función make se encarga de crear y devolver una conexión con la clase PDO.
     * Tomando los parámetros de configuración de la base de datos de la clase APP
     *
     * @return void
     */
    public static function make()
    {
        try {
            $config = App::get('config')['database'];

            // Construye la cadena de conexión y la usa para establecer la conexión
            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
            // Muestra un mensaje de error en caso de que ocurra alguno
        } catch (PDOException $error) {
            throw new AppException(ERROR_STRINGS[ERROR_CON_BD]);
        }
        return $connection;
    }
}
