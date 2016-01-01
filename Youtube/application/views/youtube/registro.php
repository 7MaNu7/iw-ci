<?php 
    $this->load->view('inc/cabecera');
?>

<main class="container">
    <h2><?php echo $titulo; ?></h2>


	<form method="post" accept-charset="utf-8" 
				action="<?php echo base_url()?>index.php/registro/insertar_usuario" class="row"/>

			<?php	
			$this->load->helper('form');
			/* Atributos del formulario */	
			$userName = array(
				'name'        => 'userName',
				'id'          => 'userName',
				'value'       => (isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''),
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: AuronPlay'
			);
			$email = array(
				'name'        => 'email',
				'id'          => 'email',
				'type'		  => 'email',
				'value'       => (isset($_SESSION['email']) ? $_SESSION['email'] : ''),
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: Usu_ario.prueBa-7@gmail.com'
			);
			$password = array(
				'name'        => 'password',
				'id'          => 'password',
				'type'		  => 'password',
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Dificil de adivinar. Ej: N5eA_7n8B3i'
			);
			$repetirPassword = array(
				'name'        => 'repetirPassword',
				'id'          => 'repetirPassword',
				'type'		  => 'password',
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Introduce la misma password aqui'
			);
			$submit = array(
					'name' => 'submit',
					'id' => 'submit',
					'value' => 'Crear cuenta',
					'title' => 'Crear cuenta',
					'class'	=>	'btn btn-primary'
			);

			?>

		    <label class=""><span class="campoobligatorio">(*) </span>Nick de usuario:</label>
		    <?php echo form_input($userName); echo '<br>'; ?>
		    <label class=""><span class="campoobligatorio">(*) </span>Email:</label>
		    <?php echo form_input($email); echo '<br>'; ?>
		    <label class=""><span class="campoobligatorio">(*) </span>Password:</label>
		    <?php echo form_input($password); echo '<br>'; ?>
		    <label class=""><span class="campoobligatorio">(*) </span>Repite la password:</label>
		    <?php echo form_input($repetirPassword); echo '<br>'; ?>

		    <p>(*): El campo es obligatorio.</p>

	        <?php echo form_submit($submit); ?>



	</form>

	<?php 

		$urlredireccion='inicio';
		//Redireccionamos			
		if(isset($_SESSION["id"]))
			echo '<script>window.location="'.$urlredireccion.'"</script>'; 

	?>

	<div class="alert alert-danger mensajesSubirVideo" id="mensajeRegistro"><?php echo validation_errors();?></div>
    
</main>

<?php 
    $this->load->view('inc/pie.php');
?>


<script type="text/javascript">
	//Si hay errores en el formulario, el div en rojo se mostrará
	var diverrores = document.getElementById('mensajeRegistro').innerHTML;
	if(diverrores=="") {
		document.getElementById('mensajeRegistro').style.display = "none";
	}
	//Si no hay título o URL dicho campo se pondrá en rojo
	var mensajes = document.getElementById('mensajeRegistro').innerHTML;
	if(mensajes.indexOf("El campo email") > -1)
		document.getElementById('email').style.borderColor = "rgba(255, 0, 0, 0.51)";
	if(mensajes.indexOf("El campo userName") > -1)
		document.getElementById('userName').style.borderColor = "rgba(255, 0, 0, 0.51)";	
	if(mensajes.indexOf("El campo password") > -1)
		document.getElementById('password').style.borderColor = "rgba(255, 0, 0, 0.51)";
	if(mensajes.indexOf("El campo repetirPassword") > -1)
		document.getElementById('repetirPassword').style.borderColor = "rgba(255, 0, 0, 0.51)";
	
	if(mensajes.indexOf("El campo de repetir la password debe coincidir") > -1)
	{
		document.getElementById('password').style.borderColor = "rgba(255, 0, 0, 0.51)";
		document.getElementById('repetirPassword').style.borderColor = "rgba(255, 0, 0, 0.51)";
	}

	
</script>
