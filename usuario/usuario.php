<div class="container">
	<div class="table-responsive" style="padding: 5%;">
	<?
	if(isset($_GET['uid'])){

		$conexion = Conexion::Conectar();
        $sentencia = $conexion->prepare("SELECT * FROM cliente WHERE id = :id");
        $sentencia->bindParam(":id", $_GET['uid']);
        $sentencia->execute();
        $user = array();
        if ($sentencia->rowCount()>0){
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
	        $arrayName = array('correo' => 'Correo', 'nombre' => 'Nombre', 'apellidos' => 'Apellidos', 'tlfn' => 'Teléfono','usuario' => 'Usuario', 'DNI' => 'DNI', 'objetivo' => 'Objetivo');
	        $array['0'] = $arrayName;
	        while ($row = $sentencia->fetch()){
	        	$arrayName = array('correo' => $row['correo'], 'nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 'tlfn' => $row['telefono'], 'usuario' => $row['usuario'], 'DNI' => $row['DNI'], 'objetivo' => $row['objetivo']);
	        	$array[$row['id']] = $arrayName;
	        }
            $user = $array;
        }
		$hayUser=false;

		//Hay usuario?
		if (count($user) > 1) {$hayUser = true;}

		//En caso de que sea ver el usuario, mostramos los datos en labels
		if (!isset($_GET['edit'])) {
			if ($hayUser) {
				$cabecera = $user['0'];
				unset($user['0']);
		?>

				<h2>Datos del usuario</h2>
				<div id="datos" class="col-sm-6">
					<label>DNI: <?php echo $user[$_GET['uid']]['DNI']; ?></label><br>
					<label>Correo electronico: <?php echo $user[$_GET['uid']]['correo']; ?></label><br>
					<label>Nombre: <?php echo $user[$_GET['uid']]['nombre']; ?></label><br>
					<label>Apellidos: <?php echo $user[$_GET['uid']]['apellidos']; ?></label><br>
					<label>Telefono: <?php echo $user[$_GET['uid']]['tlfn']; ?></label><br>
					<label>Usuario: <?php echo $user[$_GET['uid']]['usuario']; ?></label><br>
					<label>Objetivo: <?php echo $user[$_GET['uid']]['objetivo']; ?></label><br>

				<?php
					if ($_SESSION['rol'] == 'admin'){
				?>
					<a href="?secc=usuario&uid=<?php echo $_GET['uid']; ?>&edit" class="btn btn-warning">Modificar usuario</a>
					<br><br>
					<a href="?secc=nuevaDieta&DNI=<?php echo $user[$_GET['uid']]['DNI']; ?>" class="btn btn-primary">Nueva dieta</a>
					<button class="btn btn-primary" data-toggle="modal" data-target="#nuevoEstado">Nuevo estado</button><br><br>
					<a href="mailto:<?php echo $user[$_GET['uid']]['correo']; ?>" class="btn btn-default">Enviar correo</a><br><br>
				<?php } ?>
					<a href="?secc=verDietas&DNI=<?php echo $user[$_GET['uid']]['DNI']; ?>" class="btn btn-primary">Ver historial de dietas</a>
					<a href="?secc=verEstados&DNI=<?php echo $user[$_GET['uid']]['DNI']; ?>" class="btn btn-primary">Ver historial de estados</a>
				</div>
				<div id="estado" class="col-sm-6">
				<?php
					$sentencia = $conexion->prepare("SELECT * FROM estado WHERE DNI = :DNI ORDER BY idEstado DESC");
			        $sentencia->bindParam(":DNI", $user[$_GET['uid']]['DNI']);
			        $sentencia->execute();
			        $row = $sentencia->fetch();
			        $img = substr($row['estado'], 3);
			        echo '<img src="'.$img.'" alt="Imagen del estado" />';
			    ?>
				</div>
				<div id="dieta" class="col-sm-12">
					<?php
				        $sentencia = $conexion->prepare("SELECT * FROM comida WHERE IDdieta IN (SELECT IDdieta FROM dieta WHERE DNI = :DNI ORDER BY IDdieta DESC)");
				        $sentencia->bindParam(":DNI", $user[$_GET['uid']]['DNI']);
				        $sentencia->execute();
				        $alimentos = array();
				        $bebidas = array();
				        $idUltimaComida = 0;
				        if($sentencia->rowCount()>0){
				        while ($row = $sentencia->fetch()){
				        	$sent1 = $conexion->prepare("SELECT * FROM alimento WHERE IDalimento = (SELECT IDalimento FROM comida_tiene_alimento WHERE IDcomida = :IDcomida)");
				        	$sent1->bindParam(":IDcomida", $row['IDcomida']);
        					$sent1->execute();
        					$row1 = $sent1->fetch();
        					$alimentos[$row['IDcomida']] = $row1['nombre'];


				        	$sent2 = $conexion->prepare("SELECT * FROM bebida WHERE IDbebida = (SELECT IDbebida FROM comida_tiene_bebida WHERE IDcomida = :IDcomida)");
				        	$sent2->bindParam(":IDcomida", $row['IDcomida']);
        					$sent2->execute();
        					$row2 = $sent2->fetch();
        					$bebidas[$row['IDcomida']] = $row2['nombre'];
        					$idUltimaComida = $row['IDcomida'];
				        }

				        $idPrimeraComida = $idUltimaComida - 35;

					?>
					<h2> Dieta actual </h2>
			        <table class="table table-responsive">
				        <thead>
				            <th></th>
				            <th>Lunes</th>
				            <th>Martes</th>
				            <th>Miércoles</th>
				            <th>Jueves</th>
				            <th>Viernes</th>
				            <th>Sábado</th>
				            <th>Domingo</th>
				        </thead>
				        <tbody>
				            <tr>
				                <th>Desayuno</th>
				                <?php
				                    for ($i=$idPrimeraComida+1; $i < $idPrimeraComida+8; $i++) {
				                        echo '<td>
				                        <label>'.$bebidas[$i].'</label><br>';
				                        echo '<label>'.$alimentos[$i].'</label></td>';
				                        
				                    }
				                ?>
				            </tr>
				            <tr>
				                <th>Almuerzo</th>
				                <?php
				                    for ($i=$idPrimeraComida+8; $i < $idPrimeraComida+15; $i++) {
				                        echo '<td>
				                        <label>'.$bebidas[$i].'</label><br>';
				                        echo '<label>'.$alimentos[$i].'</label></td>';
				                        
				                    }
				                ?>
				            </tr>
				            <tr>
				                <th>Comida</th>
				                <?php
				                    for ($i=$idPrimeraComida+15; $i < $idPrimeraComida+22; $i++) {
				                        echo '<td>
				                        <label>'.$bebidas[$i].'</label><br>';
				                        echo '<label>'.$alimentos[$i].'</label></td>';
				                        
				                    }
				                ?>
				            </tr>
				            <tr>
				                <th>Merienda</th>
				                <?php
				                    for ($i=$idPrimeraComida+22; $i < $idPrimeraComida+29; $i++) {
				                        echo '<td>
				                        <label>'.$bebidas[$i].'</label><br>';
				                        echo '<label>'.$alimentos[$i].'</label></td>';
				                        
				                    }
				                ?>
				            </tr>
				            <tr>
				                <th>Cena</th>
				                <?php
				                    for ($i=$idPrimeraComida+29; $i <= $idPrimeraComida+35; $i++) {
				                        echo '<td>
				                        <label>'.$bebidas[$i].'</label><br>';
				                        echo '<label>'.$alimentos[$i].'</label></td>';
				                        
				                    }
				                ?>
				            </tr>
				        </tbody>
			        </table>
				</div>
				<? } ?>
		</div>
		<?php
			}else{
				//Vaya, no hay usuarios con ese ID
				echo "<h3>No hay usuario con el ID especificado</h3>";
			}

				//Edicion de usuarios
				}else if (isset($_GET['edit'])) {
					echo "<h2>Editar usuario</h2>";
?>
				<form id="edit-user" action="?secc=usuario&uid=<?php echo $_GET['uid']; ?>&s" method="POST">
					<input type="text" class="form-control" placeholder="DNI" name="DNI" value="<?php echo $user[$_GET['uid']]['DNI']; ?>" disabled></input>
					<input type="text" class="form-control" placeholder="Usuario" name="usuario" value="<?php echo $user[$_GET['uid']]['usuario']; ?>" required disabled></input>
					<input type="text" class="form-control" placeholder="correo electronico" name="correo" value="<?php echo $user[$_GET['uid']]['correo']; ?>" required></input>
					<input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $user[$_GET['uid']]['nombre']; ?>" required></input>
					<input type="text" class="form-control" placeholder="Apellidos" name="apellidos" value="<?php echo $user[$_GET['uid']]['apellidos']; ?>" required></input>
					<input type="text" class="form-control" placeholder="correo electronico" name="tlfn" value="<?php echo $user[$_GET['uid']]['tlfn']; ?>" required></input>
					<input type="text" class="form-control" placeholder="Objetivo" name="objetivo" value="<?php echo $user[$_GET['uid']]['objetivo']; ?>" required></input>
					<input type="hidden" name="id" value="<?php echo $_GET['uid']; ?>"></input>
					<br><br>
					<input type="submit" class="btn btn-info" value="Modificar datos">
				</form>

<?php
				}
				if ($_SESSION['rol'] == 'admin'){
					echo '<br><br><br><a href="?secc=admin" class="btn btn-success">Volver a listado</a><br><br>';
				}
			}
		?>
	</div>
</div>

<div id="nuevoEstado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title modal-nuevo">Nuevo estado</p>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="post" action="./includes/upload.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="estado" class="col-sm-3 control-label"> Estado:</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" id="estado" name="estado" required>
            </div>
          </div>
          <div class="form-group">
            <label for="fecha" class="col-sm-3 control-label"> Fecha:</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-8 col-sm-4">
            	<input type="hidden" name="DNI" value="<?php echo $user[$_GET['uid']]['DNI']; ?>">
            	<button type="submit" id="submit" name="submit" class="btn-lg btn-primary btn-block">Insertar estado</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>