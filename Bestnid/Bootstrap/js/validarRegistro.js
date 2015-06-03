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

function validarCampoObligatorio (idCampo, idCampoError) {
	if (!document.getElementById(idCampo).value) {
		document.getElementById(idCampoError).innerHTML = "<p class='text-danger'>Complete este campo</p>";
		document.getElementById(idCampo).focus();
		return false;
	}
	return true;
}

function validarDomicilio () {
	var expRegNumero=/^\d+$/;
	var expRegDepto=/^[a-zA-Z]{1}$/;
	var expRegCalle=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
	if (!expRegCalle.exec(document.getElementById("inputCalle").value) && !expRegNumero.exec(document.getElementById("inputCalle").value) ) {
		document.getElementById("campoDomicilio").innerHTML = "<p class=text-danger>Se aceptan solo letras o solo números</p>";
		document.getElementById("inputCalle").focus();
		return false;
	}
	if (!validarCampo(expRegNumero,"inputNumero","campoDomicilio","Solo se aceptan números")) {
		return false;
	}
	if (document.getElementById("inputPiso").value || document.getElementById("inputDepto").value) {
		if (!validarCampo(expRegNumero,"inputPiso","campoDomicilio","Solo se aceptan números, es obligatorio en conjunto con Depto")) {
			return false;
		}
		if (!validarCampo(expRegDepto,"inputDepto","campoDomicilio","Solo se acepta una letra, es obligatorio en conjunto con Piso")) {
			return false;
		}
	}
	return true;
}

function validarPassword () {
	var expRegPass = /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/;
	if (validarCampo(expRegPass,"inputPassword","campoPassword","Contraseña no válida")) {
		if (document.getElementById("inputRepetirPassword").value == document.getElementById("inputPassword").value ) {
			return true;	
		}
		else {
			document.getElementById("campoRepetirPassword").innerHTML = "<p class=text-danger>Las contraseñas ingresadas no son iguales</p>";
			document.getElementById("inputRepetirPassword").focus();
		}
	}
	return false;
}

function validarForm () {
	var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
	var expRegUsuario = /^[a-z\d_]{4,15}$/;
	var expRegMail=/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var expRegTelefono=/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/;
	var expRegPass = /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/;
	if ( (validarCampo(expRegNombre,"inputNombres","campoNombresyApellidos","solo se aceptan letras")) 
		&& (validarCampo(expRegNombre,"inputApellidos","campoNombresyApellidos","solo se aceptan letras"))
		&& (validarCampo(expRegUsuario,"inputUsuario","campoUsuario","solo se acpetan letras y numeros"))
		&& (validarCampo(expRegMail,"inputEmail","campoEmail","debe cumplir con el formato alguien@ejemplo.com"))
		&& (validarCampo(expRegTelefono,"inputTelefono","campoTelefono","no es un numero de telefono válido"))
		&& (validarDomicilio()) && (validarPassword()) ) {
		document.getElementById("f_registro").submit();
	}
}


window.onload = function () {
	document.getElementById("btn_registro").onclick=validarForm;
}