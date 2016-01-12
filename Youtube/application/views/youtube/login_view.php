<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<h2><?php echo $titulo; ?></h2>
    <div class="alert alert-danger errorlogin">
        <?php echo validation_errors(); ?>
    </div>
    <div class="divcamposlogin">
        <?php echo form_open('login/verifylogin'); ?>
            <label>Email:</label>
            <input type="text" name="email" id="email" class="form-control"> </input>
            <label>Password:</label>
            <input type="password" name="password" id="password" class="form-control"> </input>
            <input class="btn btn-primary botonlogin" value="Iniciar sesión" type="submit" name="submit"/>
        </form>
    </div>
    <div class=" divcamposlogin center">O regístrate <a href="<?=site_url('registro')?>">aquí</a></div>
    <div id="mensajeerror"></div>

</main>

<?php
    $this->load->view('inc/pie');
?>
