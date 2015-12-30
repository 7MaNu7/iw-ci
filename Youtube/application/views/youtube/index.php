<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>

	<div class="videospopulares">
		<?php
			foreach($videos as $video) { ?>

				<div class="bloquevideoinicio">
					<a href="<? echo site_url('/video/watch/' . $video->id); ?>">
						<h5> <?=$video->title?></h5>
						<img src="http://img.youtube.com/vi/<?php echo substr($video->url, 32, 30); ?>/0.jpg" alt="" class="videoinicio"/>
					</a> 
				</div>
			<?php }
		?>
	</div>

</main>

<?php
	$this->load->view('inc/pie.php');
?>
