function validar(){
	var valor = document.getElementById("tlfn").value;
	if( !(/^\d{9}$/.test(valor)) ) {
		alert("Este telefono no es valido");
		document.getElementById("tlfn").focus();
		return false;
	}

	valor = document.getElementById("email").value;
	if( !(/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) ) {
		alert("Este email no es valido");
		document.getElementById("email").focus();

		return false;
	}
	alert("Nos pondremos en contacto con usted. Muchas gracias");
	return true;
}

function validarRegistro(){
	var valor = document.getElementById("tlfn").value;
	if( !(/^\d{9}$/.test(valor)) ) {
		alert("Este telefono no es valido");
		document.getElementById("tlfn").focus();
		return false;
	}

	valor = document.getElementById("email").value;
	if( !(/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) ) {
		alert("Este email no es valido");
		document.getElementById("email").focus();

		return false;
	}
	var pass1 = document.getElementById("pass").value;
	var pass2 = document.getElementById("rep-pass").value;
	if(pass1 != pass2){
		alert("Las contraseñas no coinciden");
		document.getElementById("rep-pass").focus();
		return false;
	}
	var dni = document.getElementById("DNI").value;
	if (!nif(dni)){
		alert("DNI Incorrecto");
		document.getElementById("DNI").focus();
		return false;
	}
	return true;
}

function nif(dni) {
  var numero
  var letr
  var letra
  var expresion_regular_dni
 
  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
 
  if(expresion_regular_dni.test (dni) == true){
     numero = dni.substr(0,dni.length-1);
     letr = dni.substr(dni.length-1,1);
     numero = numero % 23;
     letra='TRWAGMYFPDXBNJZSQVHLCKET';
     letra=letra.substring(numero,numero+1);
    if (letra!=letr.toUpperCase()) {
       return false;
     }else{
       return true;
     }
  }else{
     return false;
   }
}
var reserva = [];

function validarReserva(){
	var fentrada = document.getElementById("fentrada").value;
	var fsalida = document.getElementById("fsalida").value;
	var fechaArray1 = fentrada.split("/");
	var fechaArray2 = fsalida.split("/");
	if( (new Date(fechaArray1[2], fechaArray1[1] - 1, fechaArray1[0]).getTime() > new Date(fechaArray2[2], fechaArray2[1] - 1, fechaArray2[0]).getTime())){
		alert("Las fecha de entrada debe ser menor a la de salida");
		document.getElementById("fentrada").focus();
		return false;
	}
	$('#arr').val(JSON.stringify(reserva.sort()));
	document.getElementById("fentrada").disabled = false;
	document.getElementById("fsalida").disabled = false;
	document.getElementById("personas").disabled = false;
	return true;
}


function reservaHabitacion(id,precio,habitacion){

	var fentrada = document.getElementById("fentrada").value;
	var fsalida = document.getElementById("fsalida").value;
	var fechaArray1 = fentrada.split("/");
	var fechaArray2 = fsalida.split("/");
	if (fentrada == '' || fsalida == ''){
		alert("Ambas fechas deben estar rellenas");
		document.getElementById("fentrada").focus();
		return false;
	}

	if( (new Date(fechaArray1[2], fechaArray1[1] - 1, fechaArray1[0]).getTime() >= new Date(fechaArray2[2], fechaArray2[1] - 1, fechaArray2[0]).getTime())){
		alert("Las fecha de entrada debe ser menor a la de salida");
		document.getElementById("fentrada").focus();
		return false;
	}
	if (document.getElementById("personas").value == ""){
		alert("Ponga un numero de personas");
		document.getElementById("personas").focus();
		return false;
	}

	var fecha_entrada = new Date(fechaArray1[2], fechaArray1[1] - 1, fechaArray1[0]);
	var fecha_salida = new Date(fechaArray2[2], fechaArray2[1] - 1, fechaArray2[0]);
	var dif = fecha_salida - fecha_entrada;
 	var dias = Math.floor(dif / (1000 * 60 * 60 * 24));

 	precio = precio * dias;

	document.getElementById("fentrada").disabled = true;
	document.getElementById("fsalida").disabled = true;
	document.getElementById("personas").disabled = true;

	if(document.getElementById("divTotal") == null){
		var divTotal = document.createElement("div");
		divTotal.className = "col-sm-offset-3 col-sm-9";
		divTotal.id = "divTotal";

		var nombre = document.createElement("p");
		nombre.className = "col-sm-6";
		nombre.innerHTML = "<strong>Habitación</strong>";

		var cantidad = document.createElement("p");
		cantidad.className = "col-sm-3";
		cantidad.innerHTML = "<strong>Cantidad</strong>";

		var total = document.createElement("p");
		total.className = "col-sm-3";
		total.innerHTML = "<strong>Precio</strong>";

		var oculto = document.createElement("p");
		oculto.className = "hidden";
		oculto.id = "oculto";
		oculto.innerHTML = "0";

		var precioCompleto = document.createElement("p");
		precioCompleto.className = "hidden";
		precioCompleto.id = "precioCompleto";
		precioCompleto.innerHTML = "0";


		var precioActividad = document.createElement("p");
		precioActividad.className = "hidden";
		precioActividad.id = "precioActividad";
		precioActividad.innerHTML = "0";

		var divSubcont = document.createElement("div");
		divSubcont.className="row";
		divSubcont.appendChild(nombre);
		divSubcont.appendChild(cantidad);
		divSubcont.appendChild(total);

		divTotal.appendChild(divSubcont);
		divTotal.appendChild(oculto);
		divTotal.appendChild(precioCompleto);
		divTotal.appendChild(precioActividad);
		var divCont = document.getElementById("habs");
		divCont.appendChild(divTotal);
	}

	if (document.getElementById(habitacion) == null){
		var divTotal = document.getElementById("divTotal");

		var nombre = document.createElement("p");
		nombre.className = "col-sm-6";
		nombre.id = habitacion;
		nombre.innerHTML = habitacion;

		var cantidad = document.createElement("p");
		cantidad.innerHTML = "1";
		cantidad.id = "cantidad-"+id;
		cantidad.className = "col-sm-3 "+habitacion;

		var total = document.createElement("p");
		total.className = "col-sm-3";
		total.innerHTML = precio+"€";
		total.id = "precio-"+id;
		total.className = "col-sm-3 "+habitacion;

		var conjuntoTotal = document.getElementById("oculto").innerHTML;
		conjuntoTotal = parseInt(conjuntoTotal)+precio;
		document.getElementById("oculto").innerHTML = conjuntoTotal;

		var precioCompleto = document.getElementById("precioCompleto");
		precioCompleto.innerHTML = document.getElementById("oculto").innerHTML;

		var divSubcont = document.createElement("div");
		divSubcont.className="row";
		divSubcont.id = habitacion;
		divSubcont.appendChild(nombre);
		divSubcont.appendChild(cantidad);
		divSubcont.appendChild(total);

		divTotal.appendChild(divSubcont);
		
	}else{
		var cantidad = document.getElementById("cantidad-"+id).innerHTML;
		cantidad = parseInt(cantidad)+1;
		document.getElementById("cantidad-"+id).innerHTML = cantidad;

        document.getElementById("precio-"+id).innerHTML = (precio*cantidad)+"€";

        var conjuntoTotal = document.getElementById("oculto").innerHTML;
		conjuntoTotal = parseInt(conjuntoTotal)+precio;
		document.getElementById("oculto").innerHTML = conjuntoTotal;

		var precioCompleto = document.getElementById("precioCompleto");
		precioCompleto.innerHTML = document.getElementById("oculto").innerHTML;
	}
    
    if(document.getElementById("divConjuntoTotal") == null){
		var divConjuntoTotal = document.createElement("div");
		divConjuntoTotal.className = "col-sm-offset-3 col-sm-9";
		divConjuntoTotal.id = "divConjuntoTotal";

		var pTotal = document.createElement("p");
		pTotal.className = "col-sm-9";
		pTotal.innerHTML = "<strong>Total</strong>";
		pTotal.style = "text-align: right";

		var cantidadTotal = document.createElement("p");
		cantidadTotal.id = "pTotal";
		cantidadTotal.className = "col-sm-3";
		cantidadTotal.innerHTML = "<strong>"+document.getElementById("oculto").innerHTML+"€</strong>";

		var divSubcont = document.createElement("div");
		divSubcont.className="row";
		divSubcont.appendChild(pTotal);
		divSubcont.appendChild(cantidadTotal);

		divConjuntoTotal.appendChild(divSubcont);
		var divCont = document.getElementById("habs");
		divCont.appendChild(divConjuntoTotal);

	}else{
		document.getElementById("pTotal").innerHTML = "<strong>"+document.getElementById("oculto").innerHTML+"€</strong>";
	}
	actualizaActividad(document.getElementById("actividad").value);
	actualizaDescuento();
	reserva.push(habitacion);
}

function login(){
	document.getElementById("login").click();
}

function pintaHabitacion(){
	var personas = document.getElementById('personas').value;
	if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
		
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	document.getElementById("habs").innerHTML = xmlhttp.responseText;
		}
    }
    
   	xmlhttp.open("GET", "reservas/recarga_reserva.php?personas=" + personas, true);
    xmlhttp.send();
}

function pintaHabitacion(){
	var personas = document.getElementById('personas').value;
	if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
		
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	document.getElementById("habs").innerHTML = xmlhttp.responseText;
		}
    }
    
   	xmlhttp.open("GET", "reservas/recarga_reserva.php?personas=" + personas, true);
    xmlhttp.send();
}

function actualizaActividad(value){
	if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
		
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	if(document.getElementById("divActividades") == null){
		    	var divActividades = document.createElement("div");
		    	divActividades.id = "divActividades";
			}else{
				var divActividades = document.getElementById("divActividades");
			}
			divActividades.innerHTML = xmlhttp.responseText;
	    	var divTotal = document.getElementById("divTotal");
	    	divTotal.appendChild(divActividades);
	    	actualizaPrecio(value);		    
		}
    }
    
   	xmlhttp.open("GET", "reservas/actualiza_precio.php?value=" + value, true);
    xmlhttp.send();
}

function actualizaDescuento(){
	var str = document.getElementById("promo").value;
	if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
		
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	if(document.getElementById("divDescuento") == null){
		    	var divDescuento = document.createElement("div");
		    	divDescuento.id = "divDescuento";
			}else{
				var divDescuento = document.getElementById("divDescuento");
			}
			divDescuento.innerHTML = xmlhttp.responseText;
	    	var divTotal = document.getElementById("divTotal");
	    	divTotal.appendChild(divDescuento);
	    	if (xmlhttp.responseText != ''){
	    		actualizaPrecioDescuento();
	    	}else{
	    		var precio = document.getElementById("precioActividad").innerHTML;
				var habitaciones = document.getElementById("oculto").innerHTML;
				var conjuntoTotal = parseInt(habitaciones)+parseInt(precio);
				document.getElementById("pTotal").innerHTML = "<strong>"+conjuntoTotal+"€</strong>";
	    	}
		}
    }
    
   	xmlhttp.open("GET", "reservas/actualiza_precio.php?descuento=" + str, true);
    xmlhttp.send();
}

function actualizaPrecio(id){
	if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
		
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	var precio = xmlhttp.responseText;
	    	document.getElementById("precioActividad").innerHTML = precio;
			var habitaciones = document.getElementById("oculto").innerHTML;
			var conjuntoTotal = parseInt(habitaciones)+parseInt(precio);
			document.getElementById("pTotal").innerHTML = "<strong>"+conjuntoTotal+"€</strong>";
			//document.getElementById("precioCompleto").innerHTML = conjuntoTotal;
			if (document.getElementById("promo").value != ''){
				actualizaPrecioDescuento();
			}
		}
    }
    
   	xmlhttp.open("GET", "actividades/consulta_precio.php?id=" + id, true);
    xmlhttp.send();
}

function actualizaPrecioDescuento(){
	var str = document.getElementById("promo").value;
	if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
		
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    	var descuento = xmlhttp.responseText;
	    	if (descuento != '0'){
		    	var habitaciones = document.getElementById("oculto").innerHTML;
				var precioDescontado = (parseInt(habitaciones)*(parseInt(descuento)/100));
				var total = document.getElementById("precioCompleto").innerHTML;
				var precioActividad = document.getElementById("precioActividad").innerHTML;
				var conjuntoTotal = parseInt(total)-parseInt(precioDescontado)+parseInt(precioActividad);
				document.getElementById("pTotal").innerHTML = "<strong>"+conjuntoTotal+"€</strong>";
			}
		}
    }
    
   	xmlhttp.open("GET", "promociones/consulta_promo.php?codigo=" + str, true);
    xmlhttp.send();
}