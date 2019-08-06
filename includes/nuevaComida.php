<?php
	require '../conexion/conexion.php';
	ob_start();
	if(!isset($_POST['name'])){
		$conn = Conexion::Conectar();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sentencia = $conn->prepare("INSERT INTO alimento (nombre) VALUES (:name)");
		$sentencia->bindParam(':name', $_POST['comida']);
		$sentencia->execute();
	}
	header("Location: ../index.php?secc=admin");
	ob_end_flush();
?>