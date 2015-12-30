<?php 
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>
	
	<form method="post" accept-charset="utf-8" action="subirvideo/insertar_video" class="formulariosubirvideo"/>
	
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
		'name'        => 'url',
		'id'          => 'url',
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
	
	echo '<select name="visibility" class="form-control formsubirvideoselect">';
	foreach($videovisibilidades as $visibilidad)
		echo '<option value="' .  $visibilidad->id . '">' . $visibilidad->name . '</option>';
	echo '</select>'; echo '<br>';
	
	echo '<select name="license" class="form-control formsubirvideoselect">';
	foreach($licenses as $license)
		echo '<option value="' .  $license->id . '">' . $license->name . '</option>';
	echo '</select>'; echo '<br>';
	
	echo '<select name="category" class="form-control formsubirvideoselect">';
	foreach($categories as $category)
		echo '<option value="' .  $category->id . '">' . $category->name . '</option>';
	echo '</select>'; echo '<br>';
	
	echo '<label class="">Título:</label>';
	echo form_input($title); echo '<br>';
	echo '<label class="">URL del video:</label>';
	echo form_input($url); echo '<br>';
	echo '<label class="">Descripción del video:</label>';
	echo form_textarea($description); echo '<br>';	
	
	echo form_submit($submit);
	
	?>
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