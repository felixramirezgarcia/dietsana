<?
	$sentencia = $conn->prepare("SELECT * FROM hotel"); 
	$sentencia->execute();
	$row = $sentencia->fetch();

	if(isset($_POST['submit'])){
		$sentencia = $conn->prepare("UPDATE hotel SET nombre=:nombre, descripcion=:descripcion, direccion=:direccion, telefono=:telefono, email=:email, CIF=:CIF");
		$sentencia->bindParam(':nombre', $_POST['nombre']);
		$sentencia->bindParam(':descripcion', $_POST['descripcion']);
		$sentencia->bindParam(':direccion', $_POST['direccion']);
		$sentencia->bindParam(':CIF', $_POST['CIF']);
		$sentencia->bindParam(':telefono', $_POST['tlfn']);
		$sentencia->bindParam(':email', $_POST['email']);
		$sentencia->execute();
		header("Location: index.php?secc=editor");
	}else{
?>

<div class="col-sm-12">
<div class="row">
	<div class="col-sm-offset-2 col-sm-8 col-sm-offset-2center-block">
		<h3>Editor del hotel</h3>

		<form class="form-horizontal" role="form" method="post">

			<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label"> Nombre:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<? echo $row['nombre']; ?>" required>
				</div>
			</div>

			<div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Descripción:</label>
				<div class="col-sm-9">
					<textarea class="form-control" row="10" id="descripcion" name="descripcion" placeholder="Escribe aquí..." ><? echo $row['descripcion']; ?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="direccion" class="col-sm-3 control-label"> Dirección:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="<? echo $row['direccion']; ?>" required>
				</div>
			</div>

			<div class="form-group">
				<label for="CIF" class="col-sm-3 control-label"> CIF:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="CIF" name="CIF" placeholder="CIF" value="<? echo $row['CIF']; ?>" required>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label"> Email: </label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@dominio.com" value="<? echo $row['email'] ?>" required>
				</div>
			</div>

			<div class="form-group">
				<label for="tlfn" class="col-sm-3 control-label">Teléfono: </label>
				<div class="col-sm-9">
					<input type="tel" class="form-control" id="tlfn" name="tlfn" placeholder="Teléfono" value="<? echo $row['telefono']; ?>" required>
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
<?
}
?>