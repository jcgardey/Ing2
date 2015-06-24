function validarTexto () {
	if (!document.getElementById("inputTexto").value) {
		document.getElementById("campoTexto").innerHTML = "<p class=text-danger>El texto es obligatorio</p>";
		document.getElementById("inputTexto").focus();
		return false;
	}
	return true;
}



function validarForm () {
	if (validarTexto()) {
		document.getElementById("f_comentario").submit();
	}
}

window.onload = function () {
	document.getElementById("btn_comentario").onclick= validarForm;

}