<?php 
	$this->load->view('inc/cabecera');
?>

<main>
<p><?php echo $titulo; ?></p>

<p>Mira cuantos hay:</p>	
<p><?php echo $cuantos; ?></p>

<div>
<?php 
	foreach($videos as $video) { ?>

			<div> <?php  echo($video->title); ?> </div>
	<?php }

?>
</div>
	
</main>

<?php 
	$this->load->view('inc/pie.php');
?>



