function validarCampo (expReg, idCampo, idCampoError, mensajeError) {
	if (!document.getElementById(idCampo).value) {
		document.getElementById(idCampoError).innerHTML = "<p class='text-danger'>Complete este campo</p>";
		document.getElementById(idCampo).focus();
		return false;
	}
	if (!expReg.exec(document.getElementById(idCampo).value) ) {
		document.getElementById(idCampoError).innerHTML = "<p class='text-danger'>" + mensajeError + "</p>";
		document.getElementById(idCampo).focus();
		return false;
	}
	return true;
}

function validarUsuario () {
	var expRegUsuario = /^[a-z\d_]{4,15}$/  
	if (!expRegUsuario.exec(document.getElementById("inputUsuario").value) ) {
		document.getElementById("campoUsuario").innerHTML = "<p class=text-danger>Se aceptan solo letras y numeros</p>";
		document.getElementById("inputUsuario").focus();
		return false;
	}
	return true;
}

function validarMail () {
	var expRegMail=/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	if (!document.getElementById("inputEmail").value) {
		document.getElementById("campoEmail").innerHTML = "<p class=text-danger> el campo Email es obligatorio</p>";
		document.getElementById("inputEmail").focus();
		return false;
	}
	if (!expRegMail.exec(document.getElementById("inputEmail").value) ) {
		document.getElementById("campoEmail").innerHTML = "<p class=text-danger>debe cumplir con el formato alguien@ejemplo.com</p>";
		document.getElementById("inputEmail").focus();
		return false;
	}
	return true;	
}
function validarTelefono () {
	var expRegTelefono=/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/;
	/*if (!document.getElementById("inputTelefono").value) {
		document.getElementById("campoTelefono").innerHTML = "<p class=text-danger> el campo Telefono es obligatorio</p>";
		document.getElementById("inputTelefono").focus();
		return false;
	}*/
	if (!expRegTelefono.exec(document.getElementById("inputTelefono").value) ) {
		document.getElementById("campoTelefono").innerHTML = "<p class=text-danger>No es un numero de telefono valido</p>";
		document.getElementById("inputTelefono").focus();
		return false;
	}
	return true;	
}

function validarDomicilio () {
	var expRegNumero=/^[0-9]$/;
	var expRegDepto=/^[a-zA-Z]{1}$/;
	var expRegCalle=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
	if (!expRegCalle.exec(document.getElementById("inputCalle").value) && !expRegNumero.exec(document.getElementById("inputCalle").value) ) {
		document.getElementById("campoDomicilio").innerHTML = "<p class=text-danger>Se aceptan solo letras o solo números</p>";
		document.getElementById("inputCalle").focus();
		return false;
	}
	if (!expRegNumero.exec(document.getElementById("inputNumero").value) ) {
		document.getElementById("campoDomicilio").innerHTML = "<p class=text-danger>Solo se aceptan numeros</p>";
		document.getElementById("inputNumero").focus();
		return false;
	}
	if (document.getElementById("inputPiso").value || document.getElementById("inputDepto").value) {
		if (!expRegNumero.exec(document.getElementById("inputPiso").value) ) {
			document.getElementById("campoDomicilio").innerHTML = "<p class=text-danger>Solo se aceptan numeros, es obligatorio en conjunto con Depto</p>";
			document.getElementById("inputPiso").focus();
			return false;
		}
		if (!expRegDepto.exec(document.getElementById("inputDepto").value) ) {
			document.getElementById("campoDomicilio").innerHTML = "<p class=text-danger>Solo se acepta una letra, es obligatorio en conjunto con Piso</p>";
			document.getElementById("inputDepto").focus();
			return false;
		}
	}
	return true;
}

function validarPassword () {
	var expRegPass = /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/;
	if (!expRegPass.test(document.getElementById("inputPassword").value) ) {
		document.getElementById("campoPassword").innerHTML ="<p class=text-danger>Contraseña no válida</p>";
		document.getElementById("inputPassword").focus();
		return false;
	}
	if (document.getElementById("inputRepetirPassword").value != document.getElementById("inputPassword").value ) {
		document.getElementById("campoRepetirPassword").innerHTML = "<p class=text-danger>Las contraseñas ingresadas no son iguales</p>";
		document.getElementById("inputRepetirPassword").focus();
		return false;	
	}
	return true;
}

function validarForm () {
	var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
	var expRegUsuario = /^[a-z\d_]{4,15}$/;
	var expRegMail=/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	if ( (validarCampo(expRegNombre,"inputNombres","campoNombresyApellidos","solo se aceptan letras")) 
		&& (validarCampo(expRegNombre,"inputApellidos","campoNombresyApellidos","solo se aceptan letras"))
		&& (validarCampo(expRegUsuario,"inputUsuario","campoUsuario","solo se acpetan letras y numeros"))
		&& (validarCampo(expRegMail,"inputEmail","campoEmail","debe cumplir con el formato alguien@ejemplo.com"))
		 && (validarTelefono()) && (validarDomicilio()) && (validarPassword())) {
		document.getElementById("f_registro").submit();
	}
}


window.onload = function () {
	document.getElementById("btn_registro").onclick=validarForm;
}