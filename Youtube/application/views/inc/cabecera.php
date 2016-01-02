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
						session_start();

					if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { ?>
					<a class="btn btn-youtube" href="<?=site_url('login')?>">
						<i class="glyphicon glyphicon-log-in"></i> Iniciar sesión
					</a>
					<a class="btn btn-default" href="<?=site_url('registro')?>">
						<i class="glyphicon glyphicon-pencil"></i> Registrarse
					</a>
					<?php } else { ?>
						<a class="btn btn-default" href="<?=site_url('registro')?>">
							<i class="glyphicon glyphicon-log-out"></i> Cerrar sesión
						</a>
					<?php } ?>
				</div>
			</ul>

			<!-- Menú que se abre con hamburger y Enlaces -->
			<div class="menu">
				<ul>
					<li><i class="glyphicon glyphicon-home"></i><a href="<?=site_url('inicio')?>">Página principal</a></li>
					<li><i class="glyphicon glyphicon-user"></i><a href="<?=site_url('canal/ver/' . $_SESSION['id'])?>">Mi canal</li>

					<!-- Subir video si no está logeado va a login -->
					<?php

					if (!isset($_SESSION['email']) || !isset($_SESSION['password']))
						$urlsubirvideo = site_url('login?redirect=subirvideo');
					else
						$urlsubirvideo = site_url('subirvideo');

					echo '<li><a href="'.$urlsubirvideo.'"><i class="glyphicon glyphicon-upload"></i> Subir video</a></li>';
					?>


				</ul>
			</div>
    </div>
</nav>
