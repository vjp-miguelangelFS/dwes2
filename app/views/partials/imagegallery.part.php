<!-- Partial con la galeria de imagenes de la página web Home -->

<!-- Estilo css para dar un alto especifico a las imagenes para que tengas diferentes tamañoes entre ellas -->
<style>
    .sol {
        height: 200px;
    }

    .sol img {
        height: 100%;
        width: 100%;
    }
</style>
<?php
// Creo el código html para mostrar por pantalla la galeria de imagenes utilizando el array $arrayImagenes
// que almacena las imagenes de la base de datos en el fichero index.php
echo '<div id=' . $idCategoria . ' class="tab-pane ' . $categoriaActiva . '">';
echo '<div class="row popup-gallery">';
// Creo un div para cada una de las imagenes del array $arrayImagenes que consigo de la base de datos
foreach ($arrayImagenes as $imagen) {
    echo '<div class="col-xs-12 col-sm-6 col-md-3">
        <div class="sol">
            <img class="img-responsive" src=' . $imagen->getUrlPortafolio() . ' alt=' . $imagen->getDescripcion() . ' width="450">
            <div class="behind">
                <div class="head text-center">
                    <ul class="list-inline">
                        <li>
                            <a class="gallery" href=' . $imagen->getUrlGallery() . ' data-toggle="tooltip" data-original-title="Quick View">
                                <i class="fa fa-eye"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-original-title="Click if you like it">
                                <i class="fa fa-heart"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-original-title="Download">
                                <i class="fa fa-download"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" data-original-title="More information">
                                <i class="fa fa-info"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="row box-content">
                    <ul class="list-inline text-center">
                        <li><i class="fa fa-eye"></i>' . $imagen->getNumVisualizaciones() . '</li>
                        <li><i class="fa fa-heart"></i>' . $imagen->getNumLikes() . '</li>
                        <li><i class="fa fa-download"></i>' . $imagen->getNumDownloads() . '</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';
}
echo '</div>';
echo '</div>';

?>