<!DOCTYPE html>
<html lang="en">
<head>
	<title>Youtube</title>
	<meta charset="utf-8">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- JQUEY -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- CSS -->
	<?php
	$this->load->helper('url');
	foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?=base_url($file)?>" />
	<?php endforeach; ?>
</head>


<body>

	<nav class="navbar navbar-default">
    <div class="navbar-header">
			<!-- Icono hamburger menu -->
			<div>
				<button class="hamburger">&#9776;</button>
			</div>
			<!-- Resto barra -->
			<ul>
				<!-- Nombre web -->
				<a class="navbar-brand" href="<?=site_url('inicio')?>">
					<li class="iconocab">
					You<span style="color:red;font-weight:600">Tube</span>
					</li>
				</a>
				<!-- Search -->
				<div class="input-group searchcab">
					<input type="text"class="form-control" name="" placeholder="Buscar...">
					<span class="input-group-btn boton-input">
						<a href="#" onclick='' class="btn btn-default" role="button">
							<span class="glyphicon glyphicon-search"></span>
						</a>
					</span>
				</div>
			</ul>
			
			<!-- Menú que se abre con hamburger y Enlaces -->
			<div class="menu">
				<ul>
					<li><a href="<?=site_url('inicio')?>">Página principal</a></li>
					<li>Mi canal</li>
					
					<!-- Subir video si no está logeado va a login -->
					<?php
					if (session_status() == PHP_SESSION_NONE)
						session_start();		
	
					if (!isset($_SESSION['email']) || !isset($_SESSION['password']))
						$urlsubirvideo = site_url('login?redirect=subirvideo');
					else
						$urlsubirvideo = site_url('subirvideo');
					
					echo '<li><a href="'.$urlsubirvideo.'">Subir video</a></li>';
					?>
					
					<!-- Iniciar sesión o Cerrar sesión (elimina la sesión) -->
					<?php
					if (session_status() == PHP_SESSION_NONE)
						session_start();
					
					if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
						$urllogin = site_url('login');
						$mensajelogeologout = 'Iniciar sesión';
					}
					else {
						$urllogin = site_url('');
						$mensajelogeologout = 'Cerrar sesión';
					}					
					echo '<li><a id="loginlogout" href="'.$urllogin.'">'.$mensajelogeologout.'</a></li>';
					?>
					<script>
						/* Para eliminar la sesión */
						$("#loginlogout").click(function(){
							if(document.getElementById('loginlogout').innerHTML=="Cerrar sesión") {
								console.log("Entra2 ");
								<?php
								if (ini_get("session.use_cookies")) {
									$params = session_get_cookie_params();
									setcookie(session_name(), '', time() - 42000,
										$params["path"], $params["domain"],
										$params["secure"], $params["httponly"]
									);
								}
								session_destroy();
								?>
							}
						})
					</script>				
					
				</ul>
			</div>
    </div>
</nav>
