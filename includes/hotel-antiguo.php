<?php
	$conexion = Conexion::Conectar();
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sentencia = $conexion->prepare("SELECT descripcion FROM hotel");
	$sentencia->execute();
	$descripcion = $sentencia->fetch(PDO::FETCH_ASSOC);
	echo '<div class="panel panel-default"> 
    <div class= "panel-body">';
	echo $descripcion['descripcion'];
	echo '</div></div>';
?>