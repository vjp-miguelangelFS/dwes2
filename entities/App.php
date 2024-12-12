<?php

namespace proyecto\entities;

use proyecto\exceptions\AppException;
use proyecto\entities\Connection;

class App
{

    /**
     * Array estacico $container
     * @var array
     */
    private static $container = [];

    /**
     * Se encarga de asociar una clave/key con un contenido para posteriormente llamar a la clave y te proporcioene el contenido
     *
     * @param [type] $clave
     * @param [type] $valor
     * @return void
     */
    public static function bind($clave, $valor)
    {
        self::$container[$clave] = $valor;
    }
    /**
     * Te permite acceder al contenido de la varialbe static $container
     *
     * @param string $key
     * @return void
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$container)) {
            throw new AppException(ERROR_STRINGS[ERROR_APP_CORE]);
        }
        return static::$container[$key];
    }
    /**
     * Contrala la creación de una conexión en caso de que exista devilvera una conexión, y en caso de que no exista una conexión la creara
     *
     * @return void
     */
    public static function getConnection()
    {
        if (!array_key_exists('connection', static::$container)) {
            static::$container['connection'] = Connection::make();
        }
        return static::$container['connection'];
    }
}
