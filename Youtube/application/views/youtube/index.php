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
	
		<?php  echo($video->url); ?>	
	
		<iframe width="370" height="270" data="<?php  echo($video->url);?>" frameborder="0" allowfullscreen> 
		</iframe>
	
	<?php }
?>
</div>
	
</main>

<?php 
	$this->load->view('inc/pie.php');
?>



