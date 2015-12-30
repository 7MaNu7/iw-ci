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
	<!--<link type="text/css" rel="stylesheet" href="../css/cabecera.css" />
	<link type="text/css" rel="stylesheet" href="../css/inicio.css" />
	<link type="text/css" rel="stylesheet" href="../css/video.css" />-->
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
				<a class="navbar-brand" href="<?=site_url('inicio')?>"><li class="iconocab"> You<span style="color:red;font-weight:600">Tube</span> </li></a>
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
			<!-- Menú que se abre con hamburger -->
			<div class="menu">
				<ul>
					<li><a href="<?=site_url('inicio')?>">Página principal</a></li>
					<li><a href="<?=site_url('login')?>">Iniciar sesión</a></li>
					<li>Mi canal</li>
					<li>Subir video</li>
				</ul>
			</div>
    </div>
</nav>
