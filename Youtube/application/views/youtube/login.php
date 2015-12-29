<?php 
	$this->load->view('inc/cabecera');
?>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="../css/login.css" />

<main class="container">
	<h2><?php echo $titulo; ?></h2>

	<?php echo $existeusuario; ?></br>
	
	<div class="divcamposlogin">
		<label>Email:</label>
		<input type="text" class="form-control"> </input>
		<label>Password:</label>
		<input type="pasword" class="form-control"> </input>

		<button class="btn btn-primary botonlogin">Iniciar sesión</button>
	</div>
</main>

<?php 
	$this->load->view('inc/pie.php');
?>