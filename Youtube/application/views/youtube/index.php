<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>

<main class="container">

	<!--<div id="alerta"></div>-->
	<!--Mensaje cierre de sesión -->
	<div id="divmensajelogin" style="width:500px; margin-left: 250px; margin-top: 15px;" class="mensajeoculto">
		<div class="alert alert-success" id="mensajelogin">Cierre de sesión correcto</div>
	</div>
	
	<h2><?=$titulo?></h2>

	<div class="videospopulares">
		<?php
			if(sizeof($videos)!=0)
			{
				foreach($videos as $video) { 
		?>
				<div class="bloquevideoinicio">
					<a href="<?=site_url('/video/watch/' . $video->id)?>">
						<h5> <?=$video->title?></h5>
					</a>
						<div class="user">By <a href="<?=site_url('canal/ver/' . $video->userid)?>"><?=$video->username?></a></div>
					<a href="<?=site_url('/video/watch/' . $video->id)?>">
						<img src="http://img.youtube.com/vi/<?php echo substr($video->url, 32, 30); ?>/0.jpg" alt="" class="videoinicio"/>
					</a>
				</div>
		<?php 
				}
			} else {
		?>
				<h4>Todavía no hay ningún video subido en la web</h4>
				<h5>¡Sé el primero en <a href="<?=site_url('/subirvideo')?>">subir un video</a>!</h5>
		<?php
			}
		?>
	</div>

    <script type="text/javascript">
    	/*var funcion = function() {
    		document.getElementById("alerta").innerHTML='<div class="alert alert-success errorlogin">Cerrado de sesión correcto</div>';
    		setTimeout(function(){window.location="logout"}, 2000);
    	}*/
			var funcion = function() {
				var mensaje = document.getElementById("mensajelogin");
				var divmensaje = document.getElementById("divmensajelogin");
				mensaje.className = "alert alert-success";
				divmensaje.className = "mensajevisible";
				setTimeout(function(){window.location="logout"}, 2000);
			}
    	document.getElementById("salir").onclick=funcion;
    </script>

</main>

<?php
	$this->load->view('inc/pie.php');
?>
