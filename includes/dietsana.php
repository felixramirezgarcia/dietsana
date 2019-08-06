<?php
	echo '
	<!-- BLOQUE "QUIENES SOMOS" -->
  <div class="container-fluid new bg-grey">
   	<div class="row">
   		<div class="col-sm-8">
	      <h2>About Company Page</h2>
	      <h4>Lorem ipsum..</h4>
	      <p>Lorem ipsum..</p>
	      <button class="btn btn-default btn-lg">Get in Touch</button>
   		</div>
   		<div class="col-sm-4">
     		<span class="glyphicon glyphicon-signal logo"></span>
   		</div>
   	</div>
  </div>

  <!-- BLOQUE SERVICIOS -->
  <div class="container-fluid text-center">
   	<h2>SERVICES</h2>
   	<h4>What we offer</h4>
   	<br>
   	
   	<!-- PRIMERA FILA CON CADA UNA DE SUS COLUMNAS, QUE SERÁN LOS LOGOS PEQUEÑOS -->
   	<div class="row slideanim">
   		<div class="col-sm-4">
     		<span class="glyphicon glyphicon-off logo-small"></span>
     		<h4>POWER</h4>
     		<p>Lorem ipsum dolor sit amet..</p>
   		</div>
   		<div class="col-sm-4">
     		<span class="glyphicon glyphicon-heart logo-small"></span>
     		<h4>LOVE</h4>
     		<p>Lorem ipsum dolor sit amet..</p>
   		</div>
   		<div class="col-sm-4">
     		<span class="glyphicon glyphicon-lock logo-small"></span>
     		<h4>JOB DONE</h4>
     		<p>Lorem ipsum dolor sit amet..</p>
   		</div>
    </div>
  	<br><br>
    
   	<!-- SEGUNDA FILA CON LOGOS PEQUEÑOS -->
   	<div class="row slideanim">
     	<div class="col-sm-4">
     		<span class="glyphicon glyphicon-leaf logo-small"></span>
     		<h4>GREEN</h4>
     		<p>Lorem ipsum dolor sit amet..</p>
    	</div>
    	<div class="col-sm-4">
     		<span class="glyphicon glyphicon-certificate logo-small"></span>
     		<h4>CERTIFIED</h4>
     		<p>Lorem ipsum dolor sit amet..</p>
     	</div>
     	<div class="col-sm-4">
     		<span class="glyphicon glyphicon-wrench logo-small"></span>
     		<h4>HARD WORK</h4>
     		<p>Lorem ipsum dolor sit amet..</p>
     	</div>
   	</div>
  </div>

  <!-- BLOQUE "CONTACT" -->
  <div id="contact" class="container-fluid bg-grey new">
    <h2 class="text-center">CONTACT</h2>
    <div class="row test">
      <div class="col-md-6 slideanim" style="padding-top: 80px">
        <div class="row">
          <div class="col-sm-6 form-group">
            <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
          </div>
        </div>
        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
        <div class="row">
          <div class="col-md-12 form-group">
            <button class="btn pull-right" type="submit">Send</button>
          </div>
        </div> 
      </div>
      <div class="col-md-6 slideanim">
        <div id="googleMap" style="height:400px;width:100%;">
        <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d197.1195065587989!2d-1.4971714886265146!3d37.76865908580395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6492e8b5aecbbb%3A0xc0a508592101be2c!2sAv.+Rambla+de+la+Santa%2C+3%2C+30850+Totana%2C+Murcia!5e0!3m2!1ses!2ses!4v1486210177446" allowfullscreen></iframe></div>

      </div>
    </div>
  </div>
</body>
</html>';
?>