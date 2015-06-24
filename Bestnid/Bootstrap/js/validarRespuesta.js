function validarResp () {
	if (!document.getElementById("inputRespuesta").value) {
		document.getElementById("campoRespuesta").innerHTML = "<p class=text-danger>La Respuesta es obligatoria</p>";
		document.getElementById("inputRespuesta").focus();
		return false;
	}
	return true;
}



function validarForm () {
	if (validarResp()) {
		document.getElementById("f_respuesta").submit();
	}
}

window.onload = function () {
	document.getElementById("btn_respuesta").onclick= validarForm;

}