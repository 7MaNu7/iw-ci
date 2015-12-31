<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>

<main class="container containerbusqueda">
	<h2><?=$titulo?></h2>

	<div class="videospopulares">
		<?php
			foreach($videos as $video) { ?>

				<div class="row bloquevideoinicio">
					<a href="<?=site_url('/video/watch/' . $video->id)?>">
						<div class="col-md-3">
							<img src="http://img.youtube.com/vi/<?php echo substr($video->url, 32, 30); ?>/0.jpg" 
								 	alt="" width="196" height="110" class="videoinicio"/>
						</div>
						<div class="col-md-6">
							<h5> <?=$video->title?></h5>
							<p> de Pepe </p>
							<p> 10897 reproducciones </p>
							<p> John Mayer's official live video for 'Free Fallin' (Live At the Nokia Theatre)'. Click to listen to John Mayer on Spotify: </p>
						</div>
					</a>
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
