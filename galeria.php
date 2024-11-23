<?php
// Require necesario para el funcionamiento de la pagina web
require_once 'utils/utils.php';
require_once 'entities/File.class.php';
require_once 'entities/ImagenGaleria.class.php';
require_once 'entities/connection.class.php';
require_once 'entities/QuerryBuilder.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'repository/ImagenGalariaRepository.class.php';
require_once 'repository/categoriaRepository.class.php';

// Variable que se necesitan para añadir una imagen a la base de datos y errores para almacenar algun error
$errores = [];
$descripcion = '';
$mensaje = '';
try {
    // Creo la conexión con la base de datos y
    // creo los obejtos necesarios para poder conseguir las imagenes y las categorias de la bsae de datos
    $config = require_once 'app/config.php';

    App::bind('config', $config);

    $imagenRepository = new ImagenGaleriaRepository();
    $categoriaRepository = new CategoriaRepository();

    // Este if se llevara a cabo cuado quiera añadir una imagen a la base de datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Consigo las dotos de los POST
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $categoria = trim(htmlspecialchars($_POST['categoria']));

        $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        $imagen = new File('imagen', $tipoAceptados);

        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        // Si ocurre la función saveUploadFile es porque la imagen se ha subido correctamente
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTAFOLIO);

        // Guarda la imagen en la base de datos
        $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
        $imagenRepository->save($imagenGaleria);
        $descripcion = '';
        $mensaje = 'Imagen guardada';
    }
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

require 'views/galeria.view.php';
