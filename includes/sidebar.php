<?php
$conn = Conexion::Conectar();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sentencia = $conn->prepare("SELECT * FROM tipo_habitacion"); 
$sentencia->execute();
$sentencia->setFetchMode(PDO::FETCH_ASSOC); 

echo '
<nav class="navbar navbar-default sidebar" role="navigation">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">';
        if (isset($_GET['secc'])){
          echo '<li><a href="index.php">Hotel<span class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>';
          $secc = $_GET['secc'];
          if ($secc != 'promo'){
            echo '<li><a href="index.php?secc=promo">Promociones<span class="pull-right hidden-xs showopacity glyphicon glyphicon-piggy-bank"></span></a></li>';
          }
          if ($secc != 'actividades'){
            echo '<li ><a href="index.php?secc=actividades">Actividades<span class="pull-right hidden-xs showopacity glyphicon glyphicon-calendar"></span></a></li>';
          }
            echo '<li class="dropdown">
            <a href="index.php?secc=habitaciones" class="dropdown-toggle" data-toggle="dropdown">Habitaciones <span class="caret"></span><span class="pull-right hidden-xs showopacity glyphicon glyphicon-bed"></span></a>
            <ul class="dropdown-menu forAnimate" role="menu">';
              if (!isset($_GET['tipo'])){
                while ($row = $sentencia->fetch()){
                echo '<li><a href="index.php?secc=habitaciones&tipo='.$row['id'].'">'.$row['titulo'].'</a></li>';
                }
              }else{
                $tipo = $_GET['tipo'];
                while ($row = $sentencia->fetch()){
                if ($tipo != $row['id']){
                  echo '<li><a href="index.php?secc=habitaciones&tipo='.$row['id'].'">'.$row['titulo'].'</a></li>';
                }
                }
              }
              echo '</ul>
            </li>';
          if ($secc != 'fotos'){
            echo '<li ><a href="index.php?secc=fotos">Fotos<span class="pull-right hidden-xs showopacity glyphicon glyphicon-picture"></span></a></li>';
          }
          if ($secc != 'contacto'){
            echo '<li ><a href="index.php?secc=contacto">Contacto<span class="pull-right hidden-xs showopacity glyphicon glyphicon-phone-alt"></span></a></li>';
          }
        }else{
          echo '
          <li><a href="index.php?secc=promo">Promociones<span class="pull-right hidden-xs showopacity glyphicon glyphicon-piggy-bank"></span></a></li> 
          <li ><a href="index.php?secc=actividades">Actividades<span class="pull-right hidden-xs showopacity glyphicon glyphicon-calendar"></span></a></li>  
          <li class="dropdown">
            <a href="index.php?secc=habitaciones" class="dropdown-toggle" data-toggle="dropdown">Habitaciones <span class="caret"></span><span class="pull-right hidden-xs showopacity glyphicon glyphicon-bed"></span></a>
            <ul class="dropdown-menu forAnimate" role="menu">';
              while ($row = $sentencia->fetch()){
                echo '<li><a href="index.php?secc=habitaciones&tipo='.$row['id'].'">'.$row['titulo'].'</a></li>';
                }
      echo '</ul>
          </li>          
          <li ><a href="index.php?secc=fotos">Fotos<span class="pull-right hidden-xs showopacity glyphicon glyphicon-picture"></span></a></li>        
          <li ><a href="index.php?secc=contacto">Contacto<span class="pull-right hidden-xs showopacity glyphicon glyphicon-phone-alt"></span></a></li>';
        }
        echo'      </ul>
      </div>
    </div>
  </nav>';

  ?>