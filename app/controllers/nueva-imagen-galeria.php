<?php

require_once 'utils/utils.php';
require_once 'entities/File.class.php';
require_once 'entities/ImagenGaleria.class.php';
require_once 'entities/connection.class.php';
require_once 'entities/QuerryBuilder.class.php';
require_once 'repository/ImagenGalariaRepository.class.php';
require_once 'repository/categoriaRepository.class.php';
require_once 'entities/Categoria.class.php';

$descripcion = '';

try {
    $imagenRepository = new ImagenGaleriaRepository();

    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    $categoria = trim(htmlspecialchars($_POST['categoria']));
    $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

    $imagen = new File('imagen', $tipoAceptados);

    $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
    $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTAFOLIO);

    $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
    $imagenRepository->save($imagenGaleria);
} catch (FileException $exception) {
    die($exception->getMessage());
} catch (QuerryException $exception) {
    die($exception->getMessage());
}
header('location: /imagenes-galeria');
