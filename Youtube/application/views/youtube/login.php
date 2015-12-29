<?php 
	$this->load->view('inc/cabecera');
?>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="../css/login.css" />

<main class="container">
	<h2><?php echo $titulo; ?></h2>
		
	<?php 
	if(isset($_POST["submit"])){ 
		
    if($existeusuario==0) {
			$response[] = "El usuario no existe"; 
		}	else {
			$response[] = "El usuario existe"; 
		}
		
		echo $existeusuario;
		
		if(empty($response)){ 
			echo "Los datos son validos"; 
		}else{ 
			foreach($response as $r){ 
				echo "Errores: ".$r."<br>"; 
			} 
		} 
	}
	?>
	
	<form name="formulario" method="POST" action="" class="divcamposlogin">
		<label>Email:</label>
		<input type="text" name="email" class="form-control"> </input>
		<label>Password:</label>
		<input type="pasword" name="password" class="form-control"> </input>

	 	<input class="btn btn-primary botonlogin" value="Iniciar sesión" type="submit" name="submit"/>
	</form>

</main>

<?php 
	$this->load->view('inc/pie.php');
?>