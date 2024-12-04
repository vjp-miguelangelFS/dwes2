<?php
// Require necesarios
require_once 'utils/utils.php';
require_once 'entities/File.class.php';
require_once 'entities/Asociados.class.php';
require_once 'entities/connection.class.php';
require_once 'entities/QuerryBuilder.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'repository/asociadosRepository.class.php';

// Variables necesarios para poder añadir un asociado a la base de datos y un array de errores
$errores = [];
$descripcion = '';
$nombre = '';
$mensaje = '';

try {
    // Creo una conexión con la base de datos y crea el objeto AsociadosRepository necesario para almacenar asociados en la base de datos y 
    // para conseguir todos los asociados de la base de datos
    
    // $config = require_once 'app/config.php';

    // App::bind('config', $config);

    $asociadoRepository = new AsociadosRepository();

    // Este if se llevara a cabo en caso de que quiera almacenar un asociado a la base de datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Datos necesarios para almacenar un asociados en la base de datos
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $nombre = trim(htmlspecialchars($_POST['nombre']));

        $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        $logo = new File('imagen', $tipoAceptados);
        // Almacena el logo del asociado en la carpeta /logo
        $logo->saveUploadFile(Asociados::RUTA_LOGO);

        // Código para almacenar un asociado nuevo a la base de datos
        $asociado = new Asociados($nombre, $logo->getFileName(), $descripcion);
        $asociadoRepository->save($asociado);
        $descripcion = '';
        $mensaje = 'Imagen guardada';
    }
    // Posibles Errores
} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QuerryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
} catch (PDOException $exception) {
    $errores[] = $exception->getMessage();
} catch (Exception $exception) {
    $errores[] = $exception->getMessage();
} finally {
    // Almaceno todos los asociados de la base de datos
    $asociados = $asociadoRepository->findAll();
};

require_once __DIR__.'/../views/asociados.view.php';
