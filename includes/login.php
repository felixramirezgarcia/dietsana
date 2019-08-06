<?php
if(isset ($_POST['user']) && isset($_POST['pass'])){
  $conn = Conexion::Conectar();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sentencia = $conn->prepare("SELECT * FROM cliente WHERE usuario = :user AND contraseña = :pass"); 
  $sentencia->bindParam(':user', $_POST['user']);
  $sentencia->bindParam(':pass', crypt($_POST['pass'],'SalvadorAnuarOlmedoMohamed'));
  $sentencia->execute();

  if ($sentencia->rowCount()==1){
    $_SESSION['usuario'] = $_POST['user'];
    $row = $sentencia->fetch();
    $_SESSION['email'] = $row['correo'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['nombre'] = $row['nombre'];
    $_SESSION['apellidos'] = $row['apellidos'];
    $_SESSION['tlfn'] = $row['telefono'];
    $_SESSION['DNI'] = $row['DNI'];
    $_SESSION['rol'] = $row['rol'];
    header("Refresh:0");
  }
}
else {
  ?>
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post">
          <div class="form-group">
            <label for="user"><span class="glyphicon glyphicon-user"></span> Usuario</label>
            <input type="text" class="form-control" name="user" placeholder="Introducir usuario">
          </div>
          <div class="form-group">
            <label for="pass"><span class="glyphicon glyphicon-eye-open"></span> Contraseña</label>
            <input type="password" class="form-control" name="pass" placeholder="Introducir contraseña">
          </div>
          <div class="checkbox">
            <label><input type="checkbox" value="" checked>Recuerdame</label>
          </div>
          <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
        </form>
      </div>
    </div>
    </div>
  </div>
  <script>
  $(document).ready(function(){
      $("#myBtn").click(function(){
          $("#myModal").modal();
      });
  });
  </script>
</body>
</html>
<?
}
?>