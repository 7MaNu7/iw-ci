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
	
	//Según la URL se activa un link u otro
	var URLactual = String(window.location);
	var id = "";
	
	if(URLactual.indexOf('index.php/inicio')>1 || URLactual.substr(URLactual.length - 9)=="index.php") {
		id = 'link-inicio';
		document.getElementById(id).className = "activecab";
		document.getElementById(id).parentNode.className = "activecab";
	} else {
		console.log("Lo quitamos")
		id = 'link-inicio';
		document.getElementById(id).removeClass = "activecab";
		document.getElementById(id).parentNode.removeClass = "activecab";
	}
	
	if(URLactual.indexOf('subirvideo')>1) {
		id = 'link-subirvideo';
		document.getElementById(id).className = "activecab";
		document.getElementById(id).parentNode.className = "activecab";
	} else {
		console.log("Lo quitamos")
		id = 'link-subirvideo';
		document.getElementById(id).removeClass = "activecab";
		document.getElementById(id).parentNode.removeClass = "activecab";
	}
	
	if(URLactual.indexOf('backoffice')>1) {
		id = 'link-backoffice';
		document.getElementById(id).className = "activecab";
		document.getElementById(id).parentNode.className = "activecab";
	} else {
		console.log("Lo quitamos")
		id = 'link-backoffice';
		document.getElementById(id).removeClass = "activecab";
		document.getElementById(id).parentNode.removeClass = "activecab";
	}
});

/*
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
	
*/