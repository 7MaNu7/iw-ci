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

	<style type='text/css'>
	body
	{
		font-family: Arial;
		font-size: 14px;
	}
	a {
			color: blue;
			text-decoration: none;
			font-size: 14px;
	}
	a:hover
	{
		text-decoration: underline;
	}
	</style>
	
	<main class="container">
	
		<div>
			<a href='<?php echo site_url('backoffice/gestion_licencias')?>'>Licencias</a>
			<a href='<?php echo site_url('backoffice/gestion_categorias')?>'>Categorias</a>
			<a href='<?php echo site_url('backoffice/gestion_visibilidad')?>'>Visibilidad</a>
			<a href='<?php echo site_url('backoffice/gestion_etiquetas')?>'>Etiquetas</a>
			<a href='<?php echo site_url('backoffice/gestion_idiomas')?>'>Idiomas</a>
			<a href='<?php echo site_url('backoffice/gestion_calidades')?>'>Calidades</a>		
		</div>
		
		<div style='height:20px;'></div>  
		<div>
			<?php echo $output; ?>
		</div>
		
	</main>

<?php
	$this->load->view('inc/pie.php');
?>