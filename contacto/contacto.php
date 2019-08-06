
<div class="col-sm-12">
<br><br>
	<div class="row">
		<div class="center-block col-sm-2">
			<div class="panel panel-info"> 
				<div class="panel-heading"> Contacto </div>
				<div class= "panel-body">
					<p><h5><strong> Direccion </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-map-marker"></span </h5></p>
					<p>Avda. Rambla de la Santa, 3</p>
					<p><h5><strong> Teléfono </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-phone-alt"></span></h5></p>
					<p>968424493</p>
					<p><h5><strong> Móvil </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-earphone"></span></h5></p>
					<p>629068086</p>
					<p><h5><strong> Email </strong><span class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></h5></p><p>
					<p>dietsana@dietsana.es</p>
				</div>
			</div>
		</div>
		<div class="center-block col-sm-10">
			<iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d197.1195065587989!2d-1.4971714886265146!3d37.76865908580395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6492e8b5aecbbb%3A0xc0a508592101be2c!2sAv.+Rambla+de+la+Santa%2C+3%2C+30850+Totana%2C+Murcia!5e0!3m2!1ses!2ses!4v1486210177446" allowfullscreen></iframe>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-offset-2 col-sm-8 col-sm-offset-2center-block">
			<h3>Formulario de contacto</h3>

			<form class="form-horizontal" role="form" method="post" action="contacto/mail.php" onsubmit="return validar()">

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
					<label for="email" class="col-sm-3 control-label"> Email: </label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@dominio.com" required>
					</div>
				</div>

				<div class="form-group">
					<label for="tlfn" class="col-sm-3 control-label">Telefono: </label>
					<div class="col-sm-9">
						<input type="tel" class="form-control" id="tlfn" name="tlfn" placeholder="Telefono" required>
					</div>
				</div>

				<div class="form-group">
					<label for="mensaje" class="col-sm-3 control-label">Mensaje:</label>
					<div class="col-sm-9">
						<textarea class="form-control" row="4" id="mensaje" name="mensaje" placeholder="Escribe aquí..."></textarea>
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
