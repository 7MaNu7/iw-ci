<?php 
	$this->load->view('inc/cabecera');
?>

<main>
<p><?php echo $titulo; ?></p>

<p>Mira cuantos hay:</p>	
<p><?php echo $cuantos; ?></p>

<ul>
<?php 
	foreach($videos as $video) { ?>

			<li> <?php  echo($video->title); ?> </li>
	<?php }

?>
</ul>
	
</main>

<?php 
	$this->load->view('inc/pie.php');
?>



