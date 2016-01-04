<?php 
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>
	
	<form method="post" accept-charset="utf-8" 
				action="<?php echo base_url()?>index.php/subirvideo/insertar_video" class="row formularioeditarvideo"/>
		<div class="col-md-6">
			<?php	
			$this->load->helper('form');
			/* Atributos del formulario */	
			$title = array(
				'name'        => 'title',
				'id'          => 'title',
				'value'       => $video->title,
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: Recopilación de vídeos graciosos'
			);
			$url = array(
				'name'        => 'url',
				'id'          => 'url',
				'value'       => $video->url,
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: https://www.youtube.com/watch?v=p87gfVHMms'
			);
			$description = array(
				'name'        => 'description',
				'id'          => 'description',
				'value'       => $video->description,
				'class'				=> 'form-control formeditarvideotextarea',
				'placeholder'	=> 'Ej: El mejor vídeo de risa que puedas ver. Muestra una serie situaciones graciosas con las que vas a disfrutar...'
			);
			$submit = array(
					'name' => 'submit',
					'id' => 'submit',
					'value' => 'Guardar cambios',
					'title' => 'Guardar cambios',
					'class'	=>	'btn btn-primary botoneditarvideo'
			);
			?>
			
			<label class=""><span class="campoobligatorio">(*) </span>Título:</label>
			<?php echo form_input($title); echo '<br>'; ?>

			<label class=""><span class="campoobligatorio">(*) </span>URL del video:</label>
			<?php echo form_input($url); echo '<br>'; ?>

			<label class="">Descripción del video:</label>
			<?php echo form_textarea($description); echo '<br>';?>
			
			<p>(*): El campo es obligatorio.</p>
			<?php echo form_submit($submit);?>
		</div>

		<div class="col-md-6">
			
			<div class="row formeditarvideodosinputs">
				<div class="col-md-6 inputpeque">
					<label class="">Visibilidad del video:</label>

					<select name="visibility" class="form-control">

					<?php
					foreach($videovisibilidades as $visibilidad)
					{
						if($visibilidad->id == $video->visibility)
						{
							echo '<option value="' .  $visibilidad->id . '" selected>' . $visibilidad->name . '</option>';
						}
						else
						{
							echo '<option value="' .  $visibilidad->id . '">' . $visibilidad->name . '</option>';
						}	
					}
					?>

					</select><br>	
				</div>
				<div class="col-md-6 inputpeque">
					<label class="">Tipo de licencia:</label>
					<select name="license" class="form-control">

					<?php
					foreach($licenses as $license)
					{
						if($license->id == $video->license)
						{
							echo '<option value="' .  $license->id . '" selected>' . $license->name . '</option>';
						}
						else
						{
							echo '<option value="' .  $license->id . '">' . $license->name . '</option>';
						}	
					}
					?>

					</select><br>
				</div>
			</div>
			
			<label class="">Categoria:</label>
			<select name="category" class="form-control formeditarvideoselect">

			<?php
				foreach($categories as $category)
				{
					if($category->id == $video->category)
					{
						echo '<option value="' .  $category->id . '" selected>' . $category->name . '</option>';
					}
					else
					{
						echo '<option value="' .  $category->id . '">' . $category->name . '</option>';
					}	
				}
			?>

			</select><br>

			<div class="row formeditarvideodosinputs">
				<div class="col-md-6 inputpeque">
					<label class="">Idiomas:</label>
					<select name="language" class="form-control">

					<?php

					foreach($languages as $language)
					{
						if($language->id == $video->language)
						{
							echo '<option value="' .  $language->id . '" selected>' . $language->name . '</option>';
						}
						else
						{
							echo '<option value="' .  $language->id . '">' . $language->name . '</option>';
						}	
					}
					?>

					</select><br>
				</div>
				<div class="col-md-6 inputpeque">
					<label class="">Calidades del video:</label>
					<select name="qualities[]" class="form-control" multiple>
			
					<?php

					$calidades = $videoqualities;

					foreach($qualities as $quality)		
					{

						$encontrado = false;
						for($i=0; $i<sizeof($calidades); $i++)
						{
							echo $calidades[$i]->id;
							if($quality->id==$calidades[$i]->id)
							{
								$encontrado = true;
							}
						}

						if($encontrado==true)
						{
							echo '<option value="' .  $quality->id . '" selected>' . $quality->name . '</option>';
						}
						else
						{
							echo '<option value="' .  $quality->id . '">' . $quality->name . '</option>';
						}
					}
					?>
					</select><br>
				</div>
			</div>

			<?php

				$cadenatags="";

				$i=0;
				foreach($videotags as $vt)
				{
					$cadenatags=$cadenatags . $vt->name;
					$i++;
					
					if($i<sizeof($videotags))
					{
						$cadenatags=$cadenatags . ', ';
					}
				}

				$etiquetas = array(
				'name'       	 	=> 'etiquetas',
				'id'          		=> 'etiquetas',
				'value'       		=>  $cadenatags,
				'class'				=> 'form-control formeditarvideotextareasmall',
				'placeholder'		=> 'Etiquetas (p. ej: Albert Einstein, gatitos, comedia)'
			);

			?>

			<label class="">Etiquetas:</label>
			<?php echo form_textarea($etiquetas); echo '<br>';?>

	</form>
	
	<div class="alert alert-danger mensajesEditarVideo" id="mensajeEditarVideo"><?php echo validation_errors();?></div>
	
	<?php 
	if(isset($_POST["submit"])){
		if (session_status() == PHP_SESSION_NONE)
			session_start();
		if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
			$response = "Debes iniciar sesión.";
			echo '<div class="alert alert-danger mensajesEditarVideo">Error: '.$response.'</div>';
		}		
	}
	?>

	<script type="text/javascript">
		//Si hay errores en el formulario, el div en rojo se mostrará
		var diverrores = document.getElementById('mensajeEditarVideo').innerHTML;
		if(diverrores=="") {
			document.getElementById('mensajeEditarVideo').style.display = "none";
		}
		//Si no hay título o URL dicho campo se pondrá en rojo
		var mensajes = document.getElementById('mensajeEditarVideo').innerHTML;
		if(mensajes.indexOf("El campo titulo") > -1)
			document.getElementById('title').style.borderColor = "rgba(255, 0, 0, 0.51)";
		if(mensajes.indexOf("El campo url") > -1)
			document.getElementById('url').style.borderColor = "rgba(255, 0, 0, 0.51)";	
	</script>

</main>

<?php 
	$this->load->view('inc/pie.php');
?>