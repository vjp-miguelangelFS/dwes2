<!-- Navigation Bar -->
<!-- Partial de nav -->
<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand page-scroll" href="#page-top">
        <span>[PHOTO]</span>
      </a>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="menu">
      <ul class="nav navbar-nav">
        <!-- Los apartado de la barra de navegación, y
          utilizan la función  esOpcionMenuActiva y esOpcionMenuActivaEnArray para remarcar la pagina en la que se encuentra el usuario con bootStrap añadiento active a la clase del li-->
        <li class="<?php if (esOpcionMenuActiva('/')) echo 'active' ?> lien"><a href="/"><i class="fa fa-home sr-icons"></i> Home</a></li>
        <li class="<?php if (esOpcionMenuActiva('/about')) echo 'active' ?> lien"><a href="about"><i class="fa fa-bookmark sr-icons"></i> About</a></li>
        <li class="<?php if (esOpcionMenuActivaEnArray('/blog', '/post')) echo 'active' ?> lien"><a href="blog"><i class="fa fa-file-text sr-icons"></i> Blog</a></li>
        <li class="<?php if (esOpcionMenuActiva('/contact')) echo 'active' ?> lien"><a href="contact"><i class="fa fa-phone-square sr-icons"></i> Contact</a></li>
        <li class="<?php if (esOpcionMenuActiva('/galeria')) echo 'active' ?> lien"><a href="galeria"><i class="fa fa-image sr-icons"></i> Galeria</a></li>
        <li class="<?php if (esOpcionMenuActiva('/asociados')) echo 'active' ?>"><a href="asociados"><i class="fa fa-hand-o-right sr-icons"></i> Asociados</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- End of Navigation Bar