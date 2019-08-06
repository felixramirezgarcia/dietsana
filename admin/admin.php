<?
	$conexion = Conexion::Conectar();
    $sentencia = $conexion->prepare("SELECT DISTINCT * FROM cliente ORDER BY id DESC");
    $sentencia->execute();
    $array = array();

    if ($sentencia->rowCount()>0){
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $arrayName = array('correo' => 'Correo', 'nombre' => 'Nombre', 'apellidos' => 'Apellidos', 'tlfn' => 'Teléfono','usuario' => 'Usuario', 'DNI' => 'DNI', 'objetivo' => 'Objetivo');
        $array['0'] = $arrayName;
        while ($row = $sentencia->fetch()){
        	$arrayName = array('correo' => $row['correo'], 'nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 'tlfn' => $row['telefono'], 'usuario' => $row['usuario'], 'DNI' => $row['DNI'], 'objetivo' => $row['objetivo']);
        	$array[$row['id']] = $arrayName;
        }
    }
?>
<div class="listaUsuarios">
<label class="col-sm-1 col-form-label" for="usuario">Buscador: </label>
	<div class="col-sm-11">
		<input type="text"  name="usuario" id="usuario" class="form-control" onkeyup="myFunction()" placeholder="Buscar usuarios...">
	</div>
</div>
<table class="table table-hover" id="filtraTabla">
		<tr id="header">
		<?
		$cabecera = $array['0'];
        unset($array['0']);
        foreach ($cabecera as $key => $value) {
            echo '<th class="'.$key.'">'. $value .'</th>';
        }
		?>
		</tr>
<?php 
		foreach ($array as $key => $value) {
	        echo '<tr onclick="document.location = `./index.php?secc=usuario&uid='.$key.'`;" id="'.$key.'">';
	        foreach ($value as $clave => $valor) {
				echo '<td>'. $valor .'</td>';
			}
		}
?>
</table>
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("usuario");
  filter = input.value.toUpperCase();
  table = document.getElementById("filtraTabla");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {

    correo = tr[i].getElementsByTagName("td")[0];
    nombre = tr[i].getElementsByTagName("td")[1];
	apellidos = tr[i].getElementsByTagName("td")[2];
	telefono = tr[i].getElementsByTagName("td")[3];
	usuario = tr[i].getElementsByTagName("td")[3];
	dni =  tr[i].getElementsByTagName("td")[5];
	objetivo =  tr[i].getElementsByTagName("td")[6];

    if (correo || nombre || apellidos) {
      if (correo.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      	nombre.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      	apellidos.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      	telefono.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      	usuario.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      	dni.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      	objetivo.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }

  }
}
</script>
