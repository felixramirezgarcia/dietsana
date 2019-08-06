<?php

echo '
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="Pagina web de SIBW">
  <meta name="author" content="Salvador Anuar Olmedo Mohamed">
  <link rel="icon" href="../../favicon.ico">

  <title>DietSana</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/carousel.css" rel="stylesheet">
  <link href="css/sidebar.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('.'<script src="jquery.min.js"><\/script>'.')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/contacto.js"></script>
    <script src="js/moment.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
</head>
<body>
  <div class="navbar-wrapper">
    <div class="container">

      <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">DietSana</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">';
            echo  '<li><a href="index.php?secc=servicios">Servicios</a></li>';
            echo  '<li><a href="index.php?secc=quienes-somos">Quienes somos</a></li>';
            echo  '<li><a href="index.php?secc=contacto">Contacto</a></li>';
            echo  '<li><a href="index.php?secc=actividades">Actividades</a></li>';
            echo  '<li><a href="index.php?secc=promo">Promociones</a></li>';
              session_start();
              if (!isset($_SESSION['usuario']))
                echo '<li><a href="#" id="login" data-toggle="modal" data-target="#login-modal">Login</a></li>';
              else{
                echo '<li><a href="index.php?secc=area-personal">Área Personal</a></li>';
                if (isset($_SESSION['admin'])){
                  echo '<li><a href="index.php?secc=editor">Administración</a></li>';
                }
                echo '<li><a href="includes/logout.php" >Cerrar sesión</a></li>';
              }

              
            echo '
            </ul>
          </div>
        </div>
      </nav>

    </div>
  </div>';
  ?>    