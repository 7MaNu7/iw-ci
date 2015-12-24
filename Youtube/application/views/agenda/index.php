<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<?php
	foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
	
	
	<link type="text/css" rel="stylesheet" href="../../../assets/grocery_crud/themes/datatables/css/datatables.css" />
	</head>

<body>

	<header>
		<h1> CRUD</h1>
	</header>
	<main>
		<?php
		echo $output;
		?>
	</main>

</body>
</html>
