<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<div class="col-md-8">
        <section>
        	<iframe class="video" src="https://www.youtube.com/embed/<?=substr($video->url, 32, 30); ?>" allowfullscreen></iframe>
        	<div class="description">
	            <div class="row">
					<div class="col-sm-6">
						<h2 class="video-title"><?=$video->title?></h2>
					</div>
					<div class="col-sm-6 right margin-top">
        	            <div class="row">
							<div class="col-sm-12"><?=$video->visits?> Visualizaciones</div>
						</div>
        	            <div class="row">
							<div class="col-sm-12">
								<span style="margin:5px;color:green"><?=$video->likes?></span> <span class="glyphicon glyphicon-thumbs-up" style="color:green"></span>
								<span style="margin:5px;color:red"><?=$video->dislikes?></span> <span class="glyphicon glyphicon-thumbs-down" style="color:red"></span>
							</div>
						</div>
        	        </div>
				</div>
	            <div class="row">
					<div class="col-sm-4">
						<em class="date">Publicado el 29/12/2015</em>
					</div>
					<div class="col-sm-4">
						<span class="user"> By <a href="<?=site_url('canal/ver/' . $video->userid)?>"><?=$video->username?></a></span>
					</div>
				</div>
				<div class="row">
	        	    <div class="col-sm-12">
	        	        <?=$video->description?>
	        	    </div>
	        	</div>
				<div class="row margin-top">
					<div class="col-sm-12">
						<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $video->userid) { ?>
							<a href="<?=site_url('/video/editar/' . $video->id)?>" class="btn btn-default btn-block"><i class="glyphicon glyphicon-pencil"></i> Editar video</a>
						<?php } ?>
					</div>
				</div>
    	    </div>
        </section>
        <section>
            <div class="col-sm-12">
                <h4>Comentarios</h4>
				<hr>
            </div>
			<div class="row margin-bottom">
				<!-- Mensaje error comentario -->
				<div id="error" class="col-md-12"></div>
				
				<form id="new-comment-form" method="post" accept-charset="utf-8">
					<input type="hidden" name="video" value="<?=$video->id?>">
					<input type="hidden" name="user" value="<?php if( isset($_SESSION['id']) ){ echo $_SESSION['id']; }else {echo '0';} ?>">
					<div class="col-md-10">
						<textarea name="newcomment" rows="4" cols="40" class="form-control comment-box"></textarea>
					</div>
					<div class="col-md-2 margin-top"><button class="btn btn-primary margin-top">Enviar</button></div>
				</form>
				<hr>
			</div>
			<?php foreach($comentarios as $i => $comentario) { ?>
	            <div class="row margin-bottom">
	                <div class="col-sm-12">
	                    <div class="col-md-2"><img src="http://lorempixel.com/100/100/people/<?=$i?>" alt="" class="imagen img-circle"></div>
	                    <div class="col-md-10">
	                        <div class="row">
	                            <div class="col-sm-6"><h4><?=$comentario->username?></h4></div>
	                            <div class="col-sm-6 right">
									<em class="date"><?=$comentario->date?></em>
									<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $comentario->user) { ?>
										<form id="delete-comment-form" method="post">
											<input type="hidden" name="video" value="<?=$video->id?>">
											<input type="hidden" name="comment" value="<?=$comentario->id?>">
											<button class="btn btn-default" data-toggle="tooltip" data-title="Borrar comentario" data-placement="bottom"><i class="glyphicon glyphicon-trash"></i></button>
										</form>
									<?php } ?>
								</div>
	                        </div>
	                        <div class="row">
	                            <div class="col-sm-12">
	                                <?=$comentario->comment?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			<?php } ?>
        </section>
    </div>
	<div class="col-md-4">
        <section class="col-md-12">
			<div class="row">
        	    <div class="col-sm-12">
        	        <h4>Relacionados</h4>
					<hr>
        	    </div>
        	</div>
			<?php foreach($related as $rel) { ?>
		        <div class="row margin-bottom">
		            <div class="col-sm-12">
		                <div class="col-sm-4 video-thumb">
		                	<a href="<?=site_url('/video/watch/' . $rel->id)?>">
		                		<img src="http://img.youtube.com/vi/<?php echo substr($rel->url, 32, 30); ?>/0.jpg" alt="" class="videoinicio" style="width: 100%;"/>
		                	</a>
		                </div>
		                <div class="col-sm-8 video-thumb-info">
			                <a href="<?=site_url('/video/watch/' . $rel->id)?>">
			                    <div class="row"><span class="video-thumb-title"><?=$rel->title?></span></div>
		                    </a>
		                    <a href="<?=site_url('canal/ver/' . $rel->user)?>">
		                    	<div class="row"><span class="video-thumb-user"><?=$rel->userName?></span></div>
		                    </a>
		                    <div class="row"><span class="video-thumb-views"><?=$rel->visits?> Visualizaciones</span></div>
		                </div>
		            </div>
		        </div>
			<?php } ?>
		</section>
    </div>
</main>
<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
	$('#new-comment-form').submit(function(event){
		event.preventDefault();
		var formData = {
			'video'              : $('input[name=video]').val(),
			'user'             : $('input[name=user]').val(),
			'comment'    : $('textarea[name=newcomment]').val()
		};
		console.log(formData);
		if(formData.user == 0)
		{
			$('#error').html('<div id="divmensajecomentarioerror" style="width:600px; margin-left: 10px;" class="mensajeoculto"><div class="alert alert-danger" id="mensajecomentarioerror">Error: Debes iniciar sesión</div></div>');
			setTimeout(function(){
				var mensaje = document.getElementById("mensajecomentarioerror");
				var divmensaje = document.getElementById("divmensajecomentarioerror");
				mensaje.className = "alert alert-danger";
				divmensaje.className = "mensajevisible";
			}, 1);			
		}
		else {
			$.ajax({
				url: '<?=site_url('/video/nuevo_comentario')?>',
				type: 'POST',
				data: formData
			}).then(function () {
				location.reload();
			});
		}
	});
	$('#delete-comment-form').submit(function(event){
		event.preventDefault();
		var formData = {
			'video'              : $('input[name=video]').val(),
			'comment'    : $('input[name=comment]').val()
		};
		console.log(formData);
		$.ajax({
			url: '<?=site_url('/video/borrar_comentario')?>',
			type: 'POST',
			data: formData
		}).then(function () {
			location.reload();
		});
	});/*
	$('#delete-video-form').submit(function(event){
		event.preventDefault();
		var formData = {
			'video'              : $('input[name=video]').val()
		};
		console.log(formData);
		$.ajax({
			url: '<?=site_url('/video/borrar_video')?>',
			type: 'POST',
			data: formData
		}).then(function () {
			location.reload();
		});
	});*/
</script>

<?php
	$this->load->view('inc/pie.php');
?>
