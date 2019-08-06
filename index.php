<?php
ob_start();
require 'conexion/conexion.php';
include 'includes/header.php';
include 'includes/login.php';
if (!(isset($_GET['secc'])) || ($_GET['secc'] != 'admin' && $_GET['secc'] != 'registrar' && $_GET['secc'] != 'usuario' && $_GET['secc'] != 'nuevaDieta' && $_GET['secc'] != 'verEstados' && $_GET['secc'] != 'verDietas'))
	include 'includes/carousel.php';
echo '<div class="container-fluid">';
echo '
<div class="row">';
	echo '<div class="col-lg-12">';
		if (!isset($_GET['secc'])){
			include 'includes/dietsana.php';
		}else{
			$secc = $_GET['secc'];
			if ($secc == 'admin' && $_SESSION['rol'] == 'admin'){
				include 'admin/admin.php';
			}else if ($secc == 'registrar' && $_SESSION['rol'] == 'admin'){
				include 'includes/registrar.php';
			}else if ($secc == 'galeria'){
				include 'galeria/fotos.php';
			}else if ($secc == 'contacto'){
				include 'contacto/contacto.php';
			}else if ($secc == 'usuario' && isset($_SESSION['rol'])){
				include 'usuario/usuario.php';
			}else if ($secc == 'verDietas' && isset($_SESSION['rol'])){
				include 'dietas/verDietas.php';
			}else if ($secc == 'verEstados' && isset($_SESSION['rol'])){
				include 'includes/historialEstados.php';
			}else if ($secc == 'nuevaDieta' && $_SESSION['rol'] == 'admin'){
				include 'dietas/creaDieta.php';
			}else{
				include 'includes/dietsana.php';
			}
		}
	//echo '</div>
	//<div class="col-lg-1">';
		//include 'includes/ofertasContacto.php';
	echo '</div>
</div>';
		include 'includes/footer.php';
ob_flush();
?>