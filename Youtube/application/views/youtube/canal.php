<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
    <div class="col-md-8">
        <div class="portada">
            <div class="title"><?=$user->username?></div>
        </div>
		<?php if ($last_video) { ?>
	        <iframe src="http://www.youtube.com/embed/<?=substr($last_video->url, 32, 30);?>" class="video"></iframe>
	        <div class="description">
	            <div class="row"><a href="<?=site_url('video/watch/' . $last_video->id)?>"><h3><?=$last_video->title?></h3></a></div>
	            <div class="row video-info">
	                <div class="col-md-4">By <?=$user->username?></div>
	                <div class="col-md-4"><?=$last_video->visits?> visualizaciones</div>
	                <div class="col-md-4">Hace 4 días</div>
	                </div>
	            <div class="row video-description">
		            <?=$last_video->description?>
	            </div>
	        </div>
		<?php } else { ?>
			<div class="video"></div>
	        <div class="description">
	            <div class="row"><h3>Ups... Parece que no has subido ningún video todavía.</h3></div>
	            <div class="row video-info">
	                <div class="col-md-4"></div>
	                <div class="col-md-4"></div>
	                <div class="col-md-4"></div>
	                </div>
	            <div class="row video-description">
	            	¡Sube tu primer video <a href="<?=site_url('/subirvideo')?>">aquí</a>!
	            </div>
	        </div>
		<?php } ?>
        <div class="row space"></div>
        <section class="col-md-12">
            <div class="row">
                <div class="col-md-12">
					<ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab" href="#videos">Videos</a></li>
					    <li><a data-toggle="tab" href="#comentarios">Comentarios</a></li>
				  	</ul>
                </div>
            </div>

            <div class="tab-content margin-top">
            	<div id="videos" class="row tab-pane fade in active">
					<?php
    					if(sizeof($videos)!=0)
    					{
    						foreach ($videos as $video) {

					 ?>
            	    <div class="col-md-3 margin-bottom">
            	        <a href="<?=site_url('video/watch/' . $video->id)?>"><h5><?=$video->title?></h5>
            	        <img src="http://img.youtube.com/vi/<?=substr($video->url, 32, 30);?>/0.jpg" alt="" class="videos-image"/></a>
    	        		<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $user->id) { ?>
							<a href="<?=site_url('/video/editar/' . $video->id)?>" class="btn btn-default btn-block"><i class="glyphicon glyphicon-pencil"></i> Editar video</a>
							<button class="btn btn-danger" data-toggle="modal" data-target="#delete-modal" data-user="<?=$user->id?>" data-video="<?=$video->id?>" data-title="<?=$video->title?>"><i class="glyphicon glyphicon-trash"></i> Borra este video</button>
						<?php } ?>
            	    </div>
					<?php }
						}
						else { ?>
							<p class="mensaje-sin-videos">Aún no tienes ningún video para mostrar</p>
					<?php } ?>
            	</div>
				<div id="comentarios" class="row tab-pane fade">
					<div class="row margin-bottom">
						<!-- Mensaje error comentario -->
						<div id="error" class="col-md-12"></div>
						
						<form id="new-comment-form" method="post" accept-charset="utf-8">
							<input type="hidden" name="channel" value="<?=$user->id?>">
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
			                    <div class="col-md-2"><img src="http://lorempixel.com/100/100/people/<?=$i?>" alt="" class="image img-circle"></div>
			                    <div class="col-md-10">
			                        <div class="row">
			                            <div class="col-sm-6"><h4><?=$comentario->username?></h4></div>
			                            <div class="col-sm-6 right">
											<em class="date"><?=$comentario->date?></em>
											<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $comentario->user) { ?>
												<form id="delete-comment-form" method="post">
													<input type="hidden" name="user" value="<?=$user->id?>">
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
	            </div>
            </div>

        </section>
    </div>
    <div class="col-md-4">
       <section class="profile center">
            <img src="http://lorempixel.com/100/100" alt="" class="profile-image img-circle">
            <h4><?=$user->username?></h4>
			<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $user->id) { ?>
            <div class="btn-group">
                <a href="<?=site_url('/subirvideo')?>" class="btn btn-youtube"><i class="glyphicon glyphicon-upload"></i> Subir video</a>
            </div>
			<?php } else { ?>
				<button class="btn btn-youtube"><i class="gyphicon glyphicon-plus"></i> Suscribirse</button>
                <div class="btn btn-default">128.915 segidores</div>
			<?php } ?>
       </section>
        <section class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4>Relacionados</h4>
                    <hr>
                </div>
            </div>
			<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $user->id) { ?>
			<div class="row margin-bottom">
				<div class="col-sm-12">
					<form method="post" action="<?=site_url('canal/nuevo_relacionado')?>">
						<div class="input-group">
							<input type="text" name="newuser" placeholder="nombre del usuario" class="form-control" required>
							<input type="hidden" name="user" value="<?=$user->id?>">
							<div class="input-group-btn">
								<button class="btn btn-default">Nuevo usuario</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php }foreach ($related as $rel) { ?>
            <div class="row margin-bottom">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <img src="http://lorempixel.com/100/100" alt="" class="image img-circle">
                    </div>
                    <div class="col-sm-8 relacionados-channel">
                        <div class="row"><span class="relacionados-user"><?=$rel->username?></span></div>
                        <div class="row"><span class="relacionados-thumb">124.324 Suscriptores</span></div>
                    </div>
                </div>
            </div>
			<?php } ?>
        </section>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">¿Está seguro de borrar este video?</h4>
	  </div>
	  <div class="modal-body">
		<form id="delete-video-form" method="post" action="<?php echo base_url()?>index.php/canal/borrar_video">
			<label for=""></label>
			<input type="hidden" name="video" value="">
			<input type="hidden" name="user" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
		<button id="submit-delete" type="button" class="btn btn-danger">Borrar</button>
	  </div>
	</div>
  </div>
</div>

<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
	$('#delete-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var video = button.data('video') // Extract info from data-* attributes
	  var user = button.data('user') // Extract info from data-* attributes
	  var title = button.data('title') // Extract info from data-* attributes

	  var modal = $(this);

	  modal.find('input[name=video]').val(video);
	  modal.find('input[name=user]').val(user);
	  modal.find('label').text(title);

	  $('#submit-delete').click(function () {
	  	document.getElementById('delete-video-form').submit();
	  })
  });
	$('#new-comment-form').submit(function(event){
		event.preventDefault();
		var formData = {
			'channel'              : $('input[name=channel]').val(),
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
				url: '<?=site_url('/canal/nuevo_comentario')?>',
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
			'user'              : $('input[name=user]').val(),
			'comment'    : $('input[name=comment]').val()
		};
		console.log(formData);
		$.ajax({
			url: '<?=site_url('/canal/borrar_comentario')?>',
			type: 'POST',
			data: formData
		}).then(function () {
			location.reload();
		});
	});
</script>

<?php
	$this->load->view('inc/pie.php');
?>
