<!--Mensaje cierre de sesión -->
<div id="divmensajelogout" 
		 style="position:fixed; text-align:center; width:400px; margin-left: 35%; margin-top: 15px; z-index:1;" class="mensajeoculto">
	<div class="alert alert-success" id="mensajelogout">Cierre de sesión correcto</div>
</div>

<script type="text/javascript">
	var funcion = function() {
		var mensaje = document.getElementById("mensajelogout");
		var divmensaje = document.getElementById("divmensajelogout");
		mensaje.className = "alert alert-success";
		divmensaje.className = "mensajevisible";
		
		//Vamos a logout para cerrar la sesión
		setTimeout(function(){
			var URLactual = String(window.location);
			var baseURL = URLactual.split('index.php')[0]+"index.php/";
			window.location=baseURL+"logout";
		}, 2000);
	}
	document.getElementById("salir").onclick=funcion;
</script>