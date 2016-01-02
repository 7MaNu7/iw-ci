<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Archivos CSS JS -->
	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
	
	<main class="container">
	
		<ul class="nav nav-tabs enlacesgrocery">
			<li role="presentation" class="active">
				<a id="1" href='<?php echo site_url('backoffice/gestion_licencias')?>'>Licencias</a>
			</li>
			<li role="presentation">
				<a id="2" href='<?php echo site_url('backoffice/gestion_categorias')?>'>Categorias</a>
			</li>
			<li role="presentation">
				<a id="3" href='<?php echo site_url('backoffice/gestion_visibilidad')?>'>Visibilidad</a>
			</li>
			<li role="presentation">
				<a id="4" href='<?php echo site_url('backoffice/gestion_etiquetas')?>'>Etiquetas</a>
			</li>
			<li role="presentation">
				<a id="5" href='<?php echo site_url('backoffice/gestion_idiomas')?>'>Idiomas</a>
			<li role="presentation">
				<a id="6" href='<?php echo site_url('backoffice/gestion_calidades')?>'>Calidades</a>		
			</li>
		</ul>
		
		<script>
			$('.container').click(function(e){
			 var id = e.target.id;
			 console.log("mira:"+id);
				document.getElementById(id).addClass = ".active";
				document.getElementById(id).parentNode.addClass = ".active";
			});
		</script>		
		
		<div class="tablasgrocery">
			<?php echo $output; ?>
		</div>
		
	</main>

<?php
	$this->load->view('inc/pie.php');
?>