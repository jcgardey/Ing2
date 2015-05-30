function validarRazon () {
	if (!document.getElementById("inputRazon").value) {
		document.getElementById("campoRazon").innerHTML = "<p class=text-danger>La razon es obligatoria</p>";
		document.getElementById("inputRazon").focus();
		return false;
	}
	return true;
}

function validarMonto () {
	var expRegNumero=/^\d+$/;
	if (!expRegNumero.exec(document.getElementById("inputMonto").value)) {
		document.getElementById("campoMonto").innerHTML = "<p class=text-danger>El monto es obligatorio, ingrese únicamente números</p>";
		document.getElementById("inputMonto").focus();
		return false;
	}
	return true;
}

function validarForm () {
	if (validarRazon() && validarMonto()) {
		document.getElementById("f_oferta").submit();
	}
}

window.onload = function () {
	document.getElementById("btn_oferta").onclick= validarForm;

}