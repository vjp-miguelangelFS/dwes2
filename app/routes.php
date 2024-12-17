<?php

$router->get('', 'app/controllers/index.php');
$router->get('about', 'app/controllers/about.php');
$router->get('asociados', 'app/controllers/asociados.php');
$router->get('blog', 'app/controllers/blog.php');
$router->get('contact', 'app/controllers/contact.php');
$router->get('imagenes-galeria', 'app/controllers/galeria.php');
$router->get('post', 'app/controllers/single_post.php');
$router->post('imagenes-galeria/nueva', 'app/controllers/nueva-imagen-galeria.php');
$router->post('contacto-asociados/nuevo', 'app/controllers/nuevo-asociado.php');
$router->post('mensaje/nuevo', 'app/controllers/nuevo-mensaje.php');
