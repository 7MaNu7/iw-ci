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
					<input type="text" class="form-control" id="inputsearchcab" name="" placeholder="Buscar...">
					<span class="input-group-btn boton-input">
						<a href="#" onclick='' id="botonsearch" class="btn btn-default" role="button">
							<span class="glyphicon glyphicon-search"></span>
						</a>
					</span>
				</div>

				<div class="registrarse">
					<?php
					if (session_status() == PHP_SESSION_NONE)
						session_start();

					if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { ?>
						<a class="btn btn-youtube" href="<?=site_url('login')?>">
							<i class="glyphicon glyphicon-log-in"></i><span> Iniciar sesión</span>
						</a>
						<a class="btn btn-default" href="<?=site_url('registro')?>">
							<i class="glyphicon glyphicon-pencil"></i><span> Registrarse</span>
						</a>
					<?php } else { ?>
						<a id="salir" class="btn btn-default" >
							<i class="glyphicon glyphicon-log-out"></i><span> Cerrar sesión</span>
						</a>
					<?php } ?>
				</div>
			</ul>

			<!-- Menú que se abre con hamburger y Enlaces -->
			<div class="menu">
				<ul>
					<!-- Página principal -->
					<li>
						<i class="glyphicon glyphicon-home"></i>
						<a id="link-inicio" href="<?=site_url('inicio')?>">Página principal</a>
					</li>
					<!-- Ver canal-->
					<?php
					$clasecanal = "";
					if (!isset($_SESSION['email']) || !isset($_SESSION['password']))
						$urluser = site_url('login?redirect=inicio');
					else {
						$urluser = site_url('canal/ver/' . $_SESSION['id']);
						//vemos si está viendo su canal
						if(strpos($_SERVER['REQUEST_URI'], 'canal/ver/'.$_SESSION['id']))
							 $clasecanal = "activecab";
					}
					?>
					<li class="<?=$clasecanal?>">
						<i class="glyphicon glyphicon-user"></i>
						<a class="<?=$clasecanal?>" id="link-canal" href="<?=$urluser?>">Mi canal</a>
					</li>

					<!-- Subir video si no está logeado va a login -->
					<?php
					if (!isset($_SESSION['email']) || !isset($_SESSION['password']))
						$urlsubirvideo = site_url('login?redirect=subirvideo');
					else
						$urlsubirvideo = site_url('subirvideo');
					?>
					<li>
						<i class="glyphicon glyphicon-upload"></i>
						<a id="link-subirvideo" href="<?=$urlsubirvideo?>">Subir video</a>
					</li>
					
					<!-- Ver Backoffice si es admin -->
					<?php
					if (session_status() == PHP_SESSION_NONE)
						session_start();

					if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
						if ($_SESSION['admin']==1) { ?>
							<li>
								<i class="glyphicon glyphicon-briefcase"></i>
								<a id="link-backoffice" href="<?=site_url('backoffice')?>">Back-office</a>
							</li>
					<?php 
						}
					} 
					?>
					
				</ul>
			</div>
    </div>
</nav>