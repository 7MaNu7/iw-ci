<?php 
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>
	
	<form method="post" accept-charset="utf-8" action="subirvideo/insertar_video" class="row formulariosubirvideo"/>
		<div class="col-md-6">
			<?php	
			$this->load->helper('form');
			/* Atributos del formulario */	
			$title = array(
				'name'        => 'title',
				'id'          => 'title',
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: Recopilación de vídeos graciosos'
			);
			$url = array(
				'name'        => 'url',
				'id'          => 'url',
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: https://www.youtube.com/watch?v=p87gfVHMms'
			);
			$description = array(
				'name'        => 'description',
				'id'          => 'description',
				'value'       => '',
				'class'				=> 'form-control formsubirvideotextarea',
			);
			$submit = array(
					'name' => 'submit',
					'id' => 'submit',
					'value' => 'Subir video',
					'title' => 'Subir video',
					'class'	=>	'btn btn-primary'
			);
			?>
			
			<label class="">Título:</label>
			<?php echo form_input($title); echo '<br>'; ?>

			<label class="">URL del video:</label>
			<?php echo form_input($url); echo '<br>'; ?>

			<label class="">Descripción del video:</label>
			<?php echo form_textarea($description); echo '<br>';
			
			echo form_submit($submit);?>
		</div>

		<div class="col-md-6">
			
			<div class="row formsubirvideodosinputs">
				<div class="col-md-6 inputpeque">
					<label class="">Visibilidad del video:</label>
					<select name="visibility" class="form-control">
					<?php
					foreach($videovisibilidades as $visibilidad)
						echo '<option value="' .  $visibilidad->id . '">' . $visibilidad->name . '</option>';
					?>
					</select><br>	
				</div>
				<div class="col-md-6 inputpeque">
					<label class="">Tipo de licencia:</label>
					<select name="license" class="form-control">
					<?php
					foreach($licenses as $license)
						echo '<option value="' .  $license->id . '">' . $license->name . '</option>';
					?>
					</select><br>
				</div>
			</div>
			
			<label class="">Categoria:</label>
			<select name="category" class="form-control formsubirvideoselect">
			<?php
			foreach($categories as $category)
				echo '<option value="' .  $category->id . '">' . $category->name . '</option>';
			?>
			</select><br>

			<div class="row formsubirvideodosinputs">
				<div class="col-md-6 inputpeque">
					<label class="">Idiomas:</label>
					<select name="languages[]" class="form-control" multiple>
					<?php	
					foreach($languages as $language)
						echo '<option value="' .  $language->id . '">' . $language->name . '</option>';
					?>
					</select><br>
				</div>
				<div class="col-md-6 inputpeque">
					<label class="">Calidades del video:</label>
					<select name="qualities[]" class="form-control" multiple>
					<?php
					foreach($qualities as $quality)
						echo '<option value="' .  $quality->id . '">' . $quality->name . '</option>';
					?>
					</select><br>
				</div>
			</div>

			<label class="">Etiquetas:</label>
			<textarea name="etiquetas" id="etiquetas"
								placeholder="Etiquetas (p. ej: Albert Einstein, gatitos, comedia)"
								class="form-control formsubirvideotextareasmall"></textarea>
		</div>
	</form>
	
	<div class="alert alert-danger mensajesSubirVideo" id="mensajeSubirVideo"><?php echo validation_errors();?></div>
	
	<script type="text/javascript">
		var diverrores = document.getElementById('mensajeSubirVideo').innerHTML;
		if(diverrores=="") {
			document.getElementById('mensajeSubirVideo').style.display = "none";
		}
	</script>
	
</main>

<?php 
	$this->load->view('inc/pie.php');
?>