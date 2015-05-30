	
function validarNombre () {
	var expRegNombre=/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
	if (!expRegNombre.exec(document.getElementById("inputNombre").value)) {
		document.getElementById("campoNombreCategoria").innerHTML = "<p class=text-danger>Solo se aceptan letras</p>";
		document.getElementById("inputNombre").focus();
		return false;
	}
	return true;
}

function validarDescripcion () {
	if (!document.getElementById("inputDescripcion").value) {
		document.getElementById("campoDescripcionCategoria").innerHTML = "<p class=text-danger>Este campo es obligatorio</p>";
		document.getElementById("inputDescripcion").focus();
		return false;	
	}
	return true;
}

function validarEdicionCategoria () {
	if (validarNombre() && validarDescripcion()) {
		document.getElementById("f_editarCategoria").submit();
	}
}
function validarInsercionCategoria () {
	if (validarNombre() && validarDescripcion()) {
		document.getElementById("f_altaCategoria").submit();
	}
}
