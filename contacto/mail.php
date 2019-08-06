<?php
	require_once "../includes/PHPMailer/PHPMailerAutoload.php";

	ob_start();
	//if (isset($_POST['email'])){

		$mail = new PHPMailer();
		$mail->isSMTP();
		//Mostramos mensajes de error
		$mail->SMTPDebug = 3;

		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host="smtp.gmail.com";
		$mail->Port=465;

		$header = "Consulta a Hotel Plaza Nueva";
		$mail->Username="usuariosucio@gmail.com";
		$mail->Password="departamento";
		$mail->SetFrom("usuariosucio@gmail.com",$header);
		$mail->AddReplyTo("usuariosucio@gmail.com",$header);
		$mail->Subject = "Resguardo de la consulta";

		$mensaje = "Estimad@ ". $_POST["nombre"]."<br>";
		$mensaje .= "Le agradecemos su consulta y pronto recibirá nuestra respuesta.<br>";
		$mensaje .= "Le dejamos una copia de su mensaje:<br><br>";
		$mensaje .= $_POST["mensaje"]."<br><br>";
		$mensaje .= "Reciba un cordial saludo.";
		$mail->msgHTML($mensaje);

		$address = $_POST['email'];
		$mail->AddAddress($address,$_POST['nombre']);

		if(!$mail->Send()) {
			echo "Error al enviar: ".$mail->ErrorInfo;
		} else {
			$mensaje = "El cliente ". $_POST["nombre"]." ".$_POST["apellidos"]." ha hecho una consulta:<br><br>";
			$mensaje .= $_POST["mensaje"]."<br><br>";
			$mensaje .= "Datos finales del cliente:<br><br>";
			$mensaje .= "Nombre y apellidos: ". $_POST["nombre"]." ".$_POST["apellidos"]."<br>";
			$mensaje .= "Email: ".$_POST["email"]."<br>";
			$mensaje .= "Telefono: ".$_POST["tlfn"];
			$mail->msgHTML($mensaje);
			$mail->AddAddress("salvadoranuar@gmail.com",$header);
			$mail->Send();
			header('Location: ../index.php?secc=contacto');
		}
	//}else{
		//header("Location: ../index.php");
	//}
	ob_end_flush();
?>