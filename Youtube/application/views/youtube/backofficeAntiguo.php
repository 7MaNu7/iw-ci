<?php
	$this->load->view('inc/cabecera');
	$this->load->helper('url');
?>

<?php
	$this->load->helper('url');
	foreach($css_grocery_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?=base_url($file)?>" />
<?php endforeach; ?>
<?php
	foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file;?>" />
<?php endforeach; ?>

<main class="container">
	<h2><?=$titulo?></h2>
	
	<?php echo $output->output; ?>
	
</main>

<?php
	$this->load->view('inc/pie.php');
?>