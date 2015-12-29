<?php 
	$this->load->view('inc/cabecera');
?>

<!-- CSS -->
<link type="text/css" rel="stylesheet" href="http://localhost/IW-CI/Youtube/css/inicio.css" />

<main class="container">
<h2><?php echo $titulo; ?></h2>

<p>Mira cuantos hay:</p>	
<p><?php echo $cuantos; ?></p>

<div>
<?php 
	foreach($videos as $video) { ?>

		<div> <?php  echo($video->title); ?> </div>
	
		<?php  echo( substr($video->url,3,0) );?>
		
		<iframe width="640" height="360" 
						src="https://www.youtube.com/embed/?feature=player_embedded" 
						frameborder="0" allowfullscreen>
		</iframe>
	
	
	<?php }
?>
</div>
	
	<iframe width="640" height="360" src="https://www.youtube.com/embed/EtLjq3Ocs6w?feature=player_embedded" frameborder="0" allowfullscreen></iframe>

</main>

<?php 
	$this->load->view('inc/pie.php');
?>



