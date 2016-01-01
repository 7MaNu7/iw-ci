<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>

<main class="container containerbusqueda">
	
	<div class="numresultados"><p><?=$cuantosvideos?> resultados</p></div>

	<div id='content' class="videospopulares">
		<?php
			foreach($videos as $video) { ?>

				<div class="row bloquevideoinicio">
					<a href="<?=site_url('/video/watch/' . $video->id)?>">
						<div class="col-md-3">
							<img src="http://img.youtube.com/vi/<?php echo substr($video->url, 32, 30); ?>/0.jpg" 
								 	href="" alt="" width="196" height="110" class="videoinicio"/>
						</div>
					</a>
					<div class="col-md-6">
						<a href="<?=site_url('/video/watch/' . $video->id)?>">
							<h5><?=$video->title?></h5>
						</a>
						<a href="<?=site_url('canal/ver/' . $video->user)?>">
							<p>de <?=$video->userName?></p>
						</a>
						<p><?=$video->visits?> reproducciones</p>
						<?php
							//Si la descripción es larga, la acortamos + ...
							$description=$video->description;
							if(strlen($description)>$tamdescription)
								$description=substr($video->description, 0, $tamdescription).'...';
						?>
						<p><?=$description?></p>
					</div>
				</div>
			<?php }
		?>
	</div>
	
	<script src="http://c.fzilla.com/1286136086-jquery.js"></script>  
	<script src="http://c.fzilla.com/1291523190-jpaginate.js"></script>  
	<script>  
	$(document).ready(function(){  
			$("#content").jPaginate({items: 20, next: "Siguiente", previous: "Anterior", paginaton_class: "myownclass"});                  
	});  
	</script> 
	
	
	
	<!-- PROBANDO -->
	
	
</main>

<?php
	$this->load->view('inc/pie.php');
?>
