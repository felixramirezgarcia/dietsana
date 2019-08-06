<?php
$conexion = Conexion::Conectar();
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sentencia = $conexion->prepare("SELECT * FROM hotel");
$sentencia->execute();
$hotel = $sentencia->fetch(PDO::FETCH_ASSOC);
echo '
<div class="paneles">
  <div>
    <a href="./index.php?secc=promo" ><img class="sliderOferta imagenOferta" src="images/oferta1.jpg" alt="oferta numero 1" > </a>
    <a href="./index.php?secc=promo" ><img class="sliderOferta imagenOferta" src="images/oferta2.jpg" alt="oferta numero 2" > </a>
    <a href="./index.php?secc=promo" ><img class="sliderOferta imagenOferta" src="images/oferta3.jpg" alt="oferta numero 3" > </a>
  </div>';
  if (!isset($_GET['secc']) || $_GET['secc'] != "contacto"){

    echo '
    <div class="panel panel-info"> 
      <div class="panel-heading"> Contacto </div>
      <div class= "panel-body">
        <p><h5><strong> Direccion </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span </h5></p>';
        echo '<p>'.$hotel['direccion'].'</p>';
        echo '<p><h5><strong> Telefono </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-earphone"></span></h5></p>';
        echo '<p>'.$hotel['telefono'].'</p>';
        echo '<p><h5><strong> Email </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></h5></p><p>';
        echo '<p>'.$hotel['email'].'</p>';
        echo '</div>
    </div>';
  }
  echo '</div>';
  ?>
<script>
  var myIndex = 0;
  carousel();

  function carousel() {
      var i;
      var x = document.getElementsByClassName("sliderOferta");
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";  
      }
      myIndex++;
      if (myIndex > x.length) {myIndex = 1}    
      x[myIndex-1].style.display = "block";  
      setTimeout(carousel, 10000);
  }
</script>