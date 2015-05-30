function validarNombre () {
	if (!document.getElementById("inputNombre").value) {
		document.getElementById("campoNombre").innerHTML = "<p class=text-danger>El nombre es obligatorio</p>";
		document.getElementById("inputNombre").focus();
		return false;
	}
	return true;
}

function validarDescripcion () {
	if (!document.getElementById("inputDesc").value) {
		document.getElementById("campoDescripcion").innerHTML = "<p class=text-danger>La descripcion es obligatoria</p>";
		document.getElementById("inputDec").focus();
		return false;
	}
	return true;
}

function validarFecha () {
	if (!document.getElementById("datepicker").value) {
		document.getElementById("campoFecha").innerHTML = "<p class=text-danger>La fecha de cierre es obligatoria</p>";
		document.getElementById("datepicker").focus();
		return false;
	}
	return true;
}

function validarForm () {
	if (validarNombre() && validarDescripcion() && validarFecha() ) {
		document.getElementById("f_producto").submit();
	}
}

window.onload = function () {
	document.getElementById("btn_sig").onclick= validarForm;
}