/* Para mostrar menu */
$( ".cross" ).hide();
$( ".menu" ).hide();
$( ".hamburger" ).click(function() {
	$( ".menu" ).slideToggle( "fast", function() {
		$( ".cross" ).show();
	});
})

function buscar() {
	var URLactual = window.location;
	var preURL = "";
	var ind = String(URLactual).indexOf("inicio");
	
	if(!(ind>-1))
		preURL = "index.php/";
	
	var buscado = $('#inputsearchcab').val();
	if(buscado!="" || buscado==undefined)
		window.location=preURL+"busqueda?search_query="+buscado;
}

/* Para la búsqueda */
$('#botonsearch').click(function() {
	buscar();
})

$('#inputsearchcab').keypress(function(e) {
	if (e.which == 13)
		buscar();
});
