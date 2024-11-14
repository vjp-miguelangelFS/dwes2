<?php
require_once 'utils/utils.php';
require_once 'entities/File.class.php';
require_once 'entities/ImagenGaleria.class.php';
require_once 'entities/connection.class.php';
require_once 'entities/QuerryBuilder.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'repository/ImagenGalariaRepository.class.php';
require_once 'repository/categoriaRepository.class.php';

$errores = [];
$descripcion = '';
$mensaje = '';
try {
    $config = require_once 'app/config.php';

    App::bind('config', $config);

    $imagenRepository = new ImagenGaleriaRepository();
    $categoriaRepository = new CategoriaRepository();

    // $connection = App::getConnection(); // Si funciona elimina el database en config.php y quitas los corchetes aqui

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $categoria = trim(htmlspecialchars($_POST['categoria']));

        $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        $imagen = new File('imagen', $tipoAceptados);

        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        // Si ocurre la función saveUploadFile es porque la imagen se ha subido correctamente
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTAFOLIO);

        $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
        $imagenRepository->save($imagenGaleria);
        $descripcion = '';
        $mensaje = 'Imagen guardada';
    }
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
    $imagenes = $imagenRepository->findAll();
    $categorias = $categoriaRepository->findAll();
}

require 'views/galeria.view.php';
