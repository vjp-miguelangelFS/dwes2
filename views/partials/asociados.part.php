<div class="last-box row">
    <div class="col-xs-12 col-sm-4 col-sm-push-4 last-block">
        <div class="partner-box text-center">
            <p>
                <i class="fa fa-map-marker fa-2x sr-icons"></i>
                <span class="text-muted">35 North Drive, Adroukpape, PY 88105, Agoe Telessou</span>
            </p>
            <h4>Our Main Partners</h4>
            <hr>
            <div class="text-muted text-left">
                <?php
                // Comprubo que arrayPartners menos o igual de tres posiciones y muestro todo su contenido,
                // en cabio si arrayPartners es mayor a 3 posiciones llamo al metodo extraerTresAsociados del fichero utils.php y mostraria 3 objetos del array
                if ($arrayVacioAsociados == true) {
                    print "<h3>No hay ningun Asociado</h3>";
                } else {
                    if (count($arrayPartners) <= 3) {
                        $arrayMostrarPartner = $arrayPartners;
                    } else {
                        if (count($arrayPartners) > 3) {
                            $arrayMostrarPartner = extraerTresAsociados($arrayPartners);
                        }
                    }
                    // print_r($arrayMostrarPartner);
                    // Muestro por pantalla los Asociados
                    foreach ($arrayMostrarPartner as $partner) {
                        print "<ul class='list-inline'>
                        <li><img src=" . $partner->getRutaLogo() . " alt='" . $partner->getDescripcion() . "' title='" . $partner->getDescripcion() . " '></li>
                        <li>" . $partner->getNombre() . "</li>
                        </ul>";
                    }
                }


                ?>
            </div>
        </div>
    </div>
</div>