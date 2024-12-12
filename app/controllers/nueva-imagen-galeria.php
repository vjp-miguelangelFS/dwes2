<?php

use proyecto\repository\ImagenGalariaRepository;
use proyecto\entities\File;
use proyecto\entities\ImagenGaleria;
use proyecto\exceptions\FileException;
use proyecto\exceptions\QuerryException;

try {
    $imagenRepository = new ImagenGalariaRepository();

    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    $categoria = trim(htmlspecialchars($_POST['categoria']));
    $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

    $imagen = new File('imagen', $tipoAceptados);

    $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
    $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTAFOLIO);

    $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion, $categoria);
    $imagenRepository->save($imagenGaleria);

    $mensaje = 'Se ha guardado una nueva imagen: ' . $imagenGaleria->getNombre();
    // App::get('logger')->log->Info($mensaje);

} catch (FileException $exception) {
    die($exception->getMessage());
} catch (QuerryException $exception) {
    die($exception->getMessage());
}
header('location: /imagenes-galeria');
