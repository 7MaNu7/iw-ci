<?php 
	$this->load->view('inc/cabecera');
?>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="../css/login.css" />

<main class="container">
	<h2><?php echo $titulo; ?></h2>
	
	<form name="formulario" action="" method="POST" class="divcamposlogin">
		<label>Email:</label>
		<input type="text" name="email" class="form-control"> </input>
		<label>Password:</label>
		<input type="password" name="password" class="form-control"> </input>
	 	<input class="btn btn-primary botonlogin" value="Iniciar sesión" type="submit" name="submit"/>
	</form>

	<div id="mensajeerror"></div>
	
	<?php 
	if(isset($_POST["submit"])){ 
		$existeusuario=false;
		$camposvacios=false;
		$response = "";
		$uemail = $_POST['email'];
		$upass = $_POST['password'];

		/* Comprobamos si el usuario existe en la BD o si los campos están en vacio */
		foreach ($usuarios as $usuario) {
			if($usuario->email==$uemail && $usuario->password==$upass)
				$existeusuario=true;
			if($uemail=="" || $upass=="")
				$camposvacios=true;
		}
		
		/* Mostramos el error específico */
		if($camposvacios==true)
			$response = "Debes completar todos los campos"; 
		else if($existeusuario==false && $camposvacios==false) 
			$response = "El usuario introducido no existe"; 
		
		if($response=="" || $response==null) {
			echo '<div class="alert alert-success errorlogin">Inicio de sesión correcto</div>';
			echo '<script>setTimeout(function(){window.location="inicio"}, 3000);</script>';
		} else {
			echo '<div class="alert alert-danger errorlogin">Error: '.$response.'</div>';		
		}
	}
	?>

</main>

<?php 
	$this->load->view('inc/pie.php');
?>