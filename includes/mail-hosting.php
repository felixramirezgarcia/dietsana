<?php
	if (isset($_POST['email'])){
	    //escribo un texto para el mensaje
		$mensaje = "Estimad@ ". $_POST["nombre"]."<br>";
		$mensaje .= "Le agradecemos su consulta y pronto recibirá nuestra respuesta.<br>";
		$mensaje .= "Le dejamos una copia de su mensaje:<br><br>";
		$mensaje .= $_POST["consulta"]."<br><br>";
		$mensaje .= "Reciba un cordial saludo.";

		$headers =  'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'From: Hotel Plaza Nueva <salvadoranuar@gmail.com>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	    //envío el mensaje y comprueba que se ha enviado correctamente
		if(mail($_POST['email'], "Consulta a Hotel Plaza Nueva", $mensaje, $headers)){
			$headers =  'MIME-Version: 1.0' . "\r\n"; 
			$headers .= 'From: Hotel Plaza Nueva <'.$_POST['email'].'>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$mensaje = "El cliente ". $_POST["nombre"]." ".$_POST["apellidos"]." ha hecho una consulta:<br><br>";
			$mensaje .= $_POST["consulta"]."<br><br>";
			$mensaje .= "Datos finales del cliente:<br><br>";
			$mensaje .= "Nombre y apellidos: ". $_POST["nombre"]." ".$_POST["apellidos"]."<br>";
			$mensaje .= "Email: ".$_POST["email"]."<br>";
			$mensaje .= "Telefono: ".$_POST["tlfn"];
			mail("salvadoranuar@gmail.com", "Consulta a Hotel Plaza Nueva", $mensaje, $headers);
			header("Location: ../index.php?secc=contacto");
		}else{
			echo "Error: fallo al enviar el mensaje";
		}
	}else{
		header("Location: ../index.php");
	}
?>