	<?php
		$conexion = Conexion::Conectar();

		$sentenciaza = $conexion->prepare("SELECT * FROM dieta WHERE DNI = :DNI ORDER BY IDdieta DESC");
        $sentenciaza->bindParam(":DNI", $_GET['DNI']);
        $sentenciaza->execute();
        while ($rowa = $sentenciaza->fetch()){

	        $sentencia = $conexion->prepare("SELECT * FROM comida WHERE IDdieta = :IDdieta");
	        $sentencia->bindParam(":IDdieta", $rowa['IDdieta']);
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
	<div class="dieta" style="padding: 5%;">
	<h2> <?php echo 'Dieta de la semana del '.$rowa['fecha']; ?> </h2>
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
<?php
 } 
}
?>