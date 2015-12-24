<?php 
	$this->load->view('inc/cabecera');
?>

<main>
<p><?php echo $titulo; ?></p>

<p>Mira cuantos hay:</p>	
<p><?php echo $cuantos; ?></p>

<ul>
<?php 
	foreach($personas as $persona) { ?>

			<li> <?php  echo($persona->nombre); ?> </li>
	<?php }

?>
</ul>
	
</main>

<?php 
	$this->load->view('inc/pie.php');
?>



