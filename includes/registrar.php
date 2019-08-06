<?php

if (isset ($_POST['alias']) && isset($_POST['pass'])){
	$conn = Conexion::Conectar();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sentencia = $conn->prepare("SELECT * FROM cliente WHERE DNI = :DNI");
	$sentencia->bindParam(':DNI', $_POST['DNI']);
	$sentencia->execute();
	if ($sentencia->rowCount()>0){
		echo '
<div class="col-sm-12">
<div class="row">
	<div class="col-sm-offset-2 col-sm-8 col-sm-offset-2 center-block">
		<h2>Formulario de registro</h2>

		<form class="form-horizontal" role="form" method="post" onsubmit="return validarRegistro()">

			<div class="form-group">
				<label for="DNI" class="col-sm-3 control-label"> DNI:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="DNI" name="DNI" placeholder="DNI" value="'.$_POST['DNI'].'" required>
				</div>
			</div>

			<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label"> Nombre:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="'.$_POST['nombre'].'" required>
				</div>
			</div>

			<div class="form-group">
				<label for="apellidos" class="col-sm-3 control-label"> Apellidos:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="'.$_POST['apellidos'].'" required>
				</div>
			</div>

			<div class="form-group">
				<label for="alias" class="col-sm-3 control-label"> Alias:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" required>
				</div>
			</div>

			<div class="form-group">
				<label for="pass" class="col-sm-3 control-label"> Contraseña:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
				</div>
			</div>

			<div class="form-group">
				<label for="rep-pass" class="col-sm-3 control-label"> Repita contraseña:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="rep-pass" name="rep-pass" placeholder="Repita contraseña" required>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label"> Email: </label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@dominio.com" value="'.$_POST['email'].'" required>
				</div>
			</div>

			<div class="form-group">
				<label for="tlfn" class="col-sm-3 control-label">Teléfono: </label>
				<div class="col-sm-9">
					<input type="tel" class="form-control" id="tlfn" name="tlfn" placeholder="Teléfono" value="'.$_POST['tlfn'].'" required>
				</div>
			</div>

			<div class="form-group">
				<label for="objetivo" class="col-sm-3 control-label">Objetivo: </label>
				<div class="col-sm-9">
					<input type="tel" class="form-control" id="objetivo" name="objetivo" placeholder="Objetivo" value="'.$_POST['objetivo'].'" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" id="submit" name="submit" class="btn-lg btn-primary btn-block">Enviar</button>
				</div>
			</div>
		</form>
	</div>
	</div>
</div>';
		echo '<script type="text/javascript">
				alert("Ese usuario ya existe");
				document.getElementById("nombre").focus();
			</script>';
	}else{
		$sentencia = $conn->prepare("INSERT INTO cliente(DNI, nombre, apellidos, correo, usuario, contraseña, telefono, objetivo) VALUES (:DNI,:nombre,:apellidos,:email,:alias,:pass,:telefono,:objetivo)"); 
		$sentencia->bindParam(':alias', $_POST['alias']);
		$sentencia->bindParam(':pass', crypt($_POST['pass'],'SalvadorAnuarOlmedoMohamed'));
		$sentencia->bindParam(':apellidos', $_POST['apellidos']);
		$sentencia->bindParam(':nombre', $_POST['nombre']);
		$sentencia->bindParam(':email', $_POST['email']);
		$sentencia->bindParam(':DNI', $_POST['DNI']);
		$sentencia->bindParam(':telefono', $_POST['tlfn']);
		$sentencia->bindParam(':objetivo', $_POST['objetivo']);

		if ($sentencia->execute()){
			$_SESSION['usuario'] = $_POST['alias'];
			header("Location: index.php?secc=admin");
			echo '<script type="text/javascript">
					alert("Usuario registrado correctamente");
				</script>';
		}
	}

}else{
?>
<section id="registro">
<div class="col-sm-12">
<div class="row">
	<div class="col-sm-offset-2 col-sm-8 col-sm-offset-2 center-block">
		<h2>Formulario de registro</h2>

		<form class="form-horizontal" role="form" method="post" onsubmit="return validarRegistro()">

			<div class="form-group">
				<label for="DNI" class="col-sm-3 control-label"> DNI:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="DNI" name="DNI" placeholder="DNI" required>
				</div>
			</div>

			<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label"> Nombre:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
				</div>
			</div>

			<div class="form-group">
				<label for="apellidos" class="col-sm-3 control-label"> Apellidos:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
				</div>
			</div>

			<div class="form-group">
				<label for="alias" class="col-sm-3 control-label"> Usuario:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="alias" name="alias" placeholder="usuario" required>
				</div>
			</div>

			<div class="form-group">
				<label for="pass" class="col-sm-3 control-label"> Contraseña:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
				</div>
			</div>

			<div class="form-group">
				<label for="rep-pass" class="col-sm-3 control-label"> Repita contraseña:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="rep-pass" name="rep-pass" placeholder="Repita contraseña" required>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label"> Email: </label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@dominio.com" required>
				</div>
			</div>

			<div class="form-group">
				<label for="tlfn" class="col-sm-3 control-label">Teléfono: </label>
				<div class="col-sm-9">
					<input type="tel" class="form-control" id="tlfn" name="tlfn" placeholder="Teléfono" required>
				</div>
			</div>

			<div class="form-group">
				<label for="objetivo" class="col-sm-3 control-label">Objetivo: </label>
				<div class="col-sm-9">
					<input type="tel" class="form-control" id="objetivo" name="objetivo" placeholder="Objetivo" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" id="submit" name="submit" class="btn-lg btn-primary btn-block">Enviar</button>
				</div>
			</div>
		</form>
	</div>
	</div>
</div>
</section>
<?
}
?>