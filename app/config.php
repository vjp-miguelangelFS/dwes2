<?php
// Devulve la información necesaria para conectarse a la base de datos
return [
    'database' => [
        'name' => 'proyecto',
        'username' => 'userProyecto',
        'password' => 'userProyecto',
        'connection' => 'mysql:host=dwes.local',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // encripcion utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_AUTOCOMMIT => false
        ]
    ],
    'swiftmail' => [
        "smtp_server" => "smtp.gmail.com",
        "smtp_port" => "587",
        "smtp_security" => "tls",
        "username" => "pruebamiguel174@gmail.com",
        "password" => "19102004ab",
        "email" => "pruebamiguel174@gmail.com",
        "name" => "Proyecto DWES"
    ]
];
