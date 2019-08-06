<?php
    $conexion = Conexion::Conectar();
    if (isset($_POST['enviar'])){
        $primeraComida = $_POST['idUltimaComida'] - 34;
        $ultimaComida = $_POST['idUltimaComida'];
        $sentencia = $conexion->prepare("INSERT INTO `comida_tiene_alimento`(`IDcomida`, `IDalimento`) VALUES (:idComida,:idAlimento)");
        $sentencia2 = $conexion->prepare("INSERT INTO `comida_tiene_bebida`(`IDcomida`, `IDbebida`) VALUES (:idComida,:idBebida)");
        for ($i=$primeraComida; $i <= $ultimaComida; $i++) {
            if ($_POST['comida'.$i] != 0){
                $sentencia->bindParam(":idComida", $i);
                $sentencia->bindParam(":idAlimento", $_POST['comida'.$i]);
                $sentencia->execute();
            }

            if ($_POST['bebida'.$i] != 0){
                $sentencia2->bindParam(":idComida", $i);
                $sentencia2->bindParam(":idBebida", $_POST['bebida'.$i]);
                $sentencia2->execute();
            }
        }

        header("Location: index.php?secc=admin");

    }else{
        $sentencia = $conexion->prepare("INSERT INTO `dieta`(`fecha`, `DNI`) VALUES (:fecha, :DNI)");
        $sentencia->bindParam(":DNI", $_GET['DNI']);
        $sentencia->bindParam(":fecha", date('d/m/Y'));
        $sentencia->execute();
        $id = $conexion->lastInsertId();
        $sentencia = $conexion->prepare("INSERT INTO `comida`(`tipo`, `dia`, `IDdieta`) VALUES (:tipo,:dia,:id)");
        for ($i=1; $i < 8; $i++) {
            $tipo = 'desayuno';
            $sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':dia', $i);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            
            $tipo = 'almuerzo';
            $sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':dia', $i);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            
            $tipo = 'comida';
            $sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':dia', $i);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            
            $tipo = 'merienda';
            $sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':dia', $i);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            $tipo = 'cena';
            $sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':dia', $i);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
        }
        $idUltimaComida = $conexion->lastInsertId();
        $sentencia = $conexion->prepare("SELECT * FROM alimento ORDER BY nombre ASC");
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $alimentos = array();
        $alimentos[0] = 'Elige comida...';
        while ($row = $sentencia->fetch()){
            $alimentos[$row['IDalimento']] = $row['nombre'];
        }
        $sentencia = $conexion->prepare("SELECT * FROM bebida ORDER BY nombre ASC");
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $bebidas = array();
        $bebidas[0] = 'Elige bebida...';
        while ($row = $sentencia->fetch()){
            $bebidas[$row['IDbebida']] = $row['nombre'];
        }

?>
<div class="table-responsive" style="padding: 5%;">
    <form action="index.php?secc=nuevaDieta&DNI=<?php echo $_GET['DNI']; ?>" method="POST">
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
                    for ($i=34; $i > 27; $i--) {
                        echo '<td>
                        <select class="form-control" name="bebida'.($idUltimaComida-$i).'">';
                        foreach ($bebidas as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select>';
                        echo '
                        <select class="form-control" name="comida'.($idUltimaComida-$i).'">';
                        foreach ($alimentos as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select></td>';
                        
                    }
                ?>
            </tr>
            <tr>
                <th>Almuerzo</th>
                <?php
                    for ($i=27; $i > 20; $i--) { 
                         echo '<td>
                        <select class="form-control" name="bebida'.($idUltimaComida-$i).'">';
                        foreach ($bebidas as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select>';
                        echo '
                        <select class="form-control" name="comida'.($idUltimaComida-$i).'">';
                        foreach ($alimentos as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select></td>';
                    }
                ?>
            </tr>
            <tr>
                <th>Comida</th>
                <?php
                    for ($i=20; $i > 13; $i--) { 
                         echo '<td>
                        <select class="form-control" name="bebida'.($idUltimaComida-$i).'">';
                        foreach ($bebidas as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select>';
                        echo '
                        <select class="form-control" name="comida'.($idUltimaComida-$i).'">';
                        foreach ($alimentos as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select></td>';
                    }
                ?>
            </tr>
            <tr>
                <th>Merienda</th>
                <?php
                    for ($i=13; $i > 6; $i--) { 
                         echo '<td>
                        <select class="form-control" name="bebida'.($idUltimaComida-$i).'">';
                        foreach ($bebidas as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select>';
                        echo '
                        <select class="form-control" name="comida'.($idUltimaComida-$i).'">';
                        foreach ($alimentos as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select></td>';
                    }
                ?>
            </tr>
            <tr>
                <th>Cena</th>
                <?php
                    for ($i=6; $i >= 0; $i--) { 
                         echo '<td>
                        <select class="form-control" name="bebida'.($idUltimaComida-$i).'">';
                        foreach ($bebidas as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select>';
                        echo '
                        <select class="form-control" name="comida'.($idUltimaComida-$i).'">';
                        foreach ($alimentos as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                        echo '</select></td>';
                    }
                ?>
            </tr>
        </tbody>
        </table>
        
        <input type="submit" name="enviar" value="Insertar nueva dieta" class="btn btn-success" />
    </form>
</div>
<?php
}
?>