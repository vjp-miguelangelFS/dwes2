<?php
    namespace proyecto\entities;

use proyecto\repository\CategoriaRepository;
use proyecto\repository\ImagenGalariaRepository;

    class PagesController{
        public function index(){
            $imageneRepository = new ImagenGalariaRepository();
            $imagenes = $imageneRepository->findAll();
            $categoriaRepository = new CategoriaRepository();
            $categoria = $categoriaRepository->findAll();

            require 'app/views/index.view.php';
        }
    }
?>