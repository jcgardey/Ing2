function validarForm () {
	alert("anda");
	var ok = true;
	if (!document.getElementById("inputNombres").value) {
		document.getElementById("campoNombres").innerHTML = "<p class=/"text-warning/">El campo Nombres es obligatorio</p>";
		ok= false;
	}
	if (ok) {
		document.frm-registro.submit();
	}
}


window.onload = function () {
	document.getElementById ("b_registrarse").onclick=validarForm;
}