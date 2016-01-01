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
	
		<?php
			if(isset($titulo)) {
				echo "<h1>Gestión/Back-office de Youtube</h1>";
				echo "<h4 class='backofficetexto'>Eliga la tabla que desee añadir un elemento, verlo, editarlo o eliminarlo:</h4>";
				
			?>
				<div class="enlacesgrocery1">
					<a href='<?php echo site_url('backoffice/gestion_licencias')?>'>Licencias</a><br>
					<a href='<?php echo site_url('backoffice/gestion_categorias')?>'>Categorias</a><br>
					<a href='<?php echo site_url('backoffice/gestion_visibilidad')?>'>Visibilidad</a><br>
					<a href='<?php echo site_url('backoffice/gestion_etiquetas')?>'>Etiquetas</a><br>
					<a href='<?php echo site_url('backoffice/gestion_idiomas')?>'>Idiomas</a><br>
					<a href='<?php echo site_url('backoffice/gestion_calidades')?>'>Calidades</a><br>		
				</div>
		<?php	
			}
		else {
		?>		
			<div class="enlacesgrocery2">
				<a href='<?php echo site_url('backoffice/gestion_licencias')?>'>Licencias</a>
				<a href='<?php echo site_url('backoffice/gestion_categorias')?>'>Categorias</a>
				<a href='<?php echo site_url('backoffice/gestion_visibilidad')?>'>Visibilidad</a>
				<a href='<?php echo site_url('backoffice/gestion_etiquetas')?>'>Etiquetas</a>
				<a href='<?php echo site_url('backoffice/gestion_idiomas')?>'>Idiomas</a>
				<a href='<?php echo site_url('backoffice/gestion_calidades')?>'>Calidades</a>		
			</div>
		<?php	
		}
		?>
		
		<div class="tablasgrocery">
			<?php echo $output; ?>
		</div>
		
	</main>

<?php
	$this->load->view('inc/pie.php');
?>