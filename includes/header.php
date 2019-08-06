<?php
echo '<!DOCTYPE html>
<html lang="es">
<head>
  <title>DietSana</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/ruben.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js"></script>

  <!-- AÑADIMOS LAS FUENTES DE GOOGLE PARA USARLAS EN NUESTRO CODIGO -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">DietSana</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">';

      if (!isset($_GET['secc']))
        echo '<li class="active">';
      else
        echo '<li>';
      echo '<a href="index.php">INICIO</a></li>';

      if (isset($_GET['secc']) && $_GET['secc'] == 'quienes-somos')
        echo '<li class="active">';
      else
        echo '<li>';
      echo '<a href="index.php?secc=quienes-somos">QUIENES SOMOS</a></li>';

      if (isset($_GET['secc']) && $_GET['secc'] == 'galeria')
        echo '<li class="active">';
      else
        echo '<li>';
      echo '<a href="index.php?secc=galeria">GALERIA</a></li>';

      if (isset($_GET['secc']) && $_GET['secc'] == 'contacto')
        echo '<li class="active">';
      else
        echo '<li>';
      echo '<a href="index.php?secc=contacto">CONTACTO</a></li>';
      
      echo '</ul>
      <ul class="nav navbar-nav navbar-right">';
        
      session_start();
        
      if (!isset($_SESSION['rol']))
        echo '<li><a href="#" id="login" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> LOGIN</a></li>';
      else{
        if ($_SESSION['rol'] == 'admin'){
          if (isset($_GET['secc']) && $_GET['secc'] == 'admin')
            echo '<li class="active">';
          else
            echo '<li>';
          echo '<a href="index.php?secc=admin">ADMINISTRACIÓN</a></li>';
        }
        else
          echo '<li><a href="index.php?secc=usuario&uid='.$_SESSION['id'].'">ÁREA PERSONAL</a></li>';

        echo '<li><a href="includes/logout.php" >CERRAR SESIÓN</a></li>';
      }

      echo '</ul>
    </div>
  </div>
</nav>';
if ($_SESSION['rol'] == 'admin' && $_GET['secc'] == 'admin'){
?>
<div class="acciones col-sm-12">
  <div class="col-sm-offset-1 col-sm-3">
    <a href="?secc=registrar"><button class="nuevo">
      <span class="glyphicon glyphicon-plus logo-small"></span>
      <p>Nuevo usuario</p>
    </button></a>
  </div>
  <div class="col-sm-3">
    <button class="nuevo" data-toggle="modal" data-target="#nuevaComida">
      <span class="glyphicon glyphicon-plus logo-small"></span>
      <p>Nueva comida</p>
    </button>
  </div>
  <div class="col-sm-3">
    <button class="nuevo" data-toggle="modal" data-target="#nuevaBebida">
      <span class="glyphicon glyphicon-plus logo-small"></span>
      <p>Nueva bebida</p>
    </button>
  </div>
</div>

<!-- Modal -->
<div id="nuevaComida" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title modal-nuevo">Nueva comida</p>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="post" action="./includes/nuevaComida.php">
          <div class="form-group">
            <label for="comida" class="col-sm-3 control-label"> Comida:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="comida" name="comida" placeholder="Nombre comida" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-8 col-sm-4">
              <button type="submit" id="submit" name="submit" class="btn-lg btn-primary btn-block">Insertar comida</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="nuevaBebida" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title modal-nuevo">Nueva bebida</p>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="post" action="./includes/nuevaBebida.php">
          <div class="form-group">
            <label for="bebida" class="col-sm-3 control-label"> Bebida:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="bebida" name="bebida" placeholder="Nombre bebida" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-8 col-sm-4">
              <button type="submit" id="submit" name="submit" class="btn-lg btn-primary btn-block">Insertar bebida</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?
}
?>