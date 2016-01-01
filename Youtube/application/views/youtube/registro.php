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
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: AuronPlay'
			);
			$email = array(
				'name'        => 'email',
				'id'          => 'email',
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Ej: example@outlook.es'
			);
			$password = array(
				'name'        => 'password',
				'id'          => 'password',
				'value'       => '',
				'maxlength'   => '255',
				'class'				=> 'form-control',
				'placeholder'	=> 'Dificil de adivinar. Ej: N5eA_7n8B3i'
			);
			$submit = array(
					'name' => 'submit',
					'id' => 'submit',
					'value' => 'Crear cuenta',
					'title' => 'Crear cuenta',
					'class'	=>	'btn btn-primary'
			);

		    echo '<label class="">Nick de usuario:</label>';
		    echo form_input($userName); echo '<br>';
		    echo '<label class="">Email:</label>';
		    echo form_input($email); echo '<br>';
		    echo '<label class="">Password:</label>';
		    echo form_input($password); echo '<br>';  

	        echo form_submit($submit);

			?>

	</form>
    
</main>

<?php 
    $this->load->view('inc/pie.php');
?>
