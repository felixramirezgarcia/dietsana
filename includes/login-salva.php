<?
if (isset ($_POST['user']) && isset($_POST['pass'])){
	$conn = Conexion::Conectar();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sentencia = $conn->prepare("SELECT * FROM usuarios WHERE alias = :user AND password = :pass"); 
	$sentencia->bindParam(':user', $_POST['user']);
	$sentencia->bindParam(':pass', crypt($_POST['pass'],'SalvadorAnuarOlmedoMohamed'));
	$sentencia->execute();
	if ($sentencia->rowCount()==1){
		$_SESSION['usuario'] = $_POST['user'];
		$row = $sentencia->fetch();
		$_SESSION['email'] = $row['email'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['apellidos'] = $row['apellidos'];
		$_SESSION['tlfn'] = $row['telefono'];
		$_SESSION['DNI'] = $row['DNI'];
		if ($row['tipo'] == 1)
			$_SESSION['admin'] = $_POST['user'];
		header("Refresh:0");
	}

}else{
echo '
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="loginmodal-container">
			<h1>Entra en tu cuenta</h1><br>
			<form method="post">
				<input type="text" name="user" placeholder="Usuario">
				<input type="password" name="pass" placeholder="Contraseña">
				<input type="submit" name="login" class="login loginmodal-submit" value="Entrar">
			</form>

			<div class="login-help">
				<a href="index.php?secc=registrar#registro">Registrar</a> - <a href="#">¿Olvidó su contraseña?</a>
			</div>
		</div>
	</div>
</div>';
}
?>