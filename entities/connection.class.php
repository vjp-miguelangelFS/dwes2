<?php
require_once 'entities/App.class.php';
require_once 'utils/const.php';
class Connection
{
    public static function make()
    {
        try {
            $config = App::get('config')['database'];

            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $error) {
            throw new AppException(ERROR_STRINGS[ERROR_CON_BD]);
        }
        return $connection;
    }
}
