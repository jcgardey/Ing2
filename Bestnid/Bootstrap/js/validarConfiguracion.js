function validarNumeroMayorACero (idCampo, idCampoError) {
	var expRegNumero=/^\d+$/;
	if (!expRegNumero.exec(document.getElementById(idCampo).value)) {
		document.getElementById(idCampoError).innerHTML = "<p class=text-danger>Campo obligatorio, ingrese únicamente números</p>";
		document.getElementById(idCampo).focus();
		return false;
	}
	if ( (parseInt(document.getElementById(idCampo).value)) <= 0 ) {
		document.getElementById(idCampoError).innerHTML = "<p class=text-danger>Debe ingresar un número mayor que cero</p>";
		document.getElementById(idCampo).focus();
		return false;	
	}
	return true;
}

