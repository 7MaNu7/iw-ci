<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>

<main class="container containerbusqueda">
	
	<div class="numresultados"><p><?=$cuantosvideos?> resultados</p></div>

	<div class="videospopulares">
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
	
	<ul class="pagination">
		<li><a href="#">&laquo;</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">&raquo;</a></li>
	</ul>
	
</main>

<?php
	$this->load->view('inc/pie.php');
?>
