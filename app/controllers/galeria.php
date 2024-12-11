<?php
// Require necesario para el funcionamiento de la pagina web
// require_once 'utils/utils.php';
// require_once 'entities/File.class.php';
// require_once 'entities/ImagenGaleria.class.php';
// require_once 'entities/connection.class.php';
// require_once 'entities/QuerryBuilder.class.php';
// require_once 'exceptions/AppException.class.php';
// require_once 'repository/ImagenGalariaRepository.class.php';
// require_once 'repository/categoriaRepository.class.php';
// require_once 'entities/Categoria.class.php';

use proyecto\repository\ImagenGalariaRepository;
use proyecto\repository\CategoriaRepository;
use proyecto\exceptions\FileException;
use proyecto\exceptions\QuerryException;
use proyecto\exceptions\AppException;
// Variable que se necesitan para añadir una imagen a la base de datos y errores para almacenar algun error
$errores = [];
$descripcion = '';
try {

    $imagenRepository = new ImagenGalariaRepository();
    $categoriaRepository = new CategoriaRepository();

    // Almaceno los errores en el array $errorres y en caso de que no ocurra ningun error se llevara a cabo el finally
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
    // Obtengo las imagenes y las categorias de la base de datos con la función findAll de QueryBuilder
    $imagenes = $imagenRepository->findAll();
    $categorias = $categoriaRepository->findAll();
}

require __DIR__ . '/../views/galeria.view.php';
