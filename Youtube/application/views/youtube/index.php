<?php 
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>

	<div class="videospopulares">
		<?php 
			foreach($videos as $video) { ?>

				<div class="bloquevideoinicio">
					<h5> <?php  echo($video->title); ?> </h5>
					<iframe class="videoinicio"	
									src="https://www.youtube.com/embed/<?php echo substr($video->url, 32, 30); ?>?feature=player_embedded"
									frameborder="0" allowfullscreen>
					</iframe>	
				</div>
			<?php }
		?>
	</div>

</main>

<?php 
	$this->load->view('inc/pie.php');
?>
