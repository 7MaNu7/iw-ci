<?php
	$this->load->view('inc/cabecera');
?>

	<main class="container">

	<?php

		if (session_status() == PHP_SESSION_NONE)
			session_start();
		if (!isset($_SESSION['id']) || $_SESSION["admin"]!=1) {
			echo '<script>window.location.href="' . base_url() . 'index.php' . '"</script>';
		}

	?>

		<ul class="nav nav-tabs enlacesgrocery">
			<li role="presentation">
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
			$( document ).ready(function() {
				//Según la URL se activa una pestaña u otra
				var URLactual = String(window.location);
				var id = "";
				if(URLactual.indexOf('categoria')>1)
					id = '2';
				else if(URLactual.indexOf('visibilidad')>1)
					id = '3';
				else if(URLactual.indexOf('etiquetas')>1)
					id = '4';
				else if(URLactual.indexOf('idiomas')>1)
					id = '5';
				else if(URLactual.indexOf('calidades')>1)
					id = '6';
				else
					id = '1';
				document.getElementById(id).className = "active";
				document.getElementById(id).parentNode.className = "active";
			});
		</script>

		<div class="tablasgrocery">
			<?php echo $output; ?>
		</div>

	</main>

<?php
	$this->load->view('inc/pie.php');
?>
