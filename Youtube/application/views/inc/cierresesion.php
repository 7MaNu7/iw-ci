<!--Mensaje cierre de sesión -->
<div id="divmensajelogout" style="width:500px; margin-left: 250px; margin-top: 15px;" class="mensajeoculto">
	<div class="alert alert-success" id="mensajelogout">Cierre de sesión correcto</div>
</div>

<script type="text/javascript">
	var funcion = function() {
		var mensaje = document.getElementById("mensajelogout");
		var divmensaje = document.getElementById("divmensajelogout");
		mensaje.className = "alert alert-success";
		divmensaje.className = "mensajevisible";
		setTimeout(function(){window.location="logout"}, 2000);
	}
	document.getElementById("salir").onclick=funcion;
</script>