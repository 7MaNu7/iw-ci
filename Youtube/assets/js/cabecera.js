/* Para mostrar menu */

$( ".cross" ).hide();
$( ".menu" ).hide();
$( ".hamburger" ).click(function() {
	$( ".menu" ).slideToggle( "fast", function() {
		$( ".cross" ).show();
	});
})

/* Para la búsqueda */

$('#botonsearch').click(function() {
	buscar();
})

$('#inputsearchcab').keypress(function(e) {
	if (e.which == 13)
		buscar();
});

/* Para que se vea seleccionado link donde se está URL */
function buscar() {
	var URLactual = String(window.location);
	var baseURL = URLactual.split('index.php')[0]+"index.php/";
	
	var buscado = $('#inputsearchcab').val();
	if(buscado!="" || buscado==undefined)
		window.location=baseURL+"busqueda?search_query="+buscado;
}

$( document ).ready(function() {
	var estaenmenu = true;
	
	//Según la URL se activa una pestaña u otra
	var URLactual = String(window.location);
	var id = "";
	if(URLactual.indexOf('login')>1)
		id = 'link-login';
	else if(URLactual.indexOf('registro')>1)
		id = 'link-registro';
	else if(URLactual.indexOf('inicio')>1)
		id = 'link-inicio';
	else if(URLactual.indexOf('subirvideo')>1)
		id = 'link-subirvideo';
	else if(URLactual.indexOf('backoffice')>1)
		id = 'link-backoffice';
	else if(URLactual.indexOf('canal')>1) {
		<?php
			if (session_status() == PHP_SESSION_NONE)
							session_start();
			if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
				if(URLactual.indexOf('canal/ver/'<?php echo isset($_SESSION['id']?>)>1))
					id = 'link-canal';
				else
					estaenmenu = false;
			} else
				estaenmenu = false;
		?>
	}
	else
		estaenmenu = false;
	
	if(estaenmenu) {
		document.getElementById(id).className = "active";//color: white;
		document.getElementById(id).parentNode.className = "active";//    background-color: #333; color: white !important;
	}
});