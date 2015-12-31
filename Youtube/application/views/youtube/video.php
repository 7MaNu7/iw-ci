<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
	<section class="col-md-8">
        <div class="row">
			<iframe class="video"
							src="https://www.youtube.com/embed/<?=substr($video->url, 32, 30); ?>"
							allowfullscreen></iframe>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="row"><h2 class="video-title"><?=$video->title?></h2></div>
                    <div class="row"><em class="date">Publicado el 29/12/2015</em><span class="user"> By <a href="<?=site_url('canal/ver/' . $video->userid)?>"><?=$video->username?></a></span></div>
                </div>
                <div class="col-sm-6 right margin-top">
                    <div class="row"><?=$video->visits?> Visualizaciones</div>
                    <div class="row">
						<span style="margin:5px;color:green"><?=$video->likes?></span> <span class="glyphicon glyphicon-thumbs-up" style="color:green"></span>
						<span style="margin:5px;color:red"><?=$video->dislikes?></span> <span class="glyphicon glyphicon-thumbs-down" style="color:red"></span>
					</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?=$video->description?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h2>Comentarios</h2>
            </div>
            <hr class="divider">
			<?php foreach($comentarios as $comentario) { ?>
	            <div class="row margin-bottom">
	                <div class="col-sm-12">
	                    <div class="col-md-2"><img src="http://lorempixel.com/100/100" alt="" class="imagen img-circle"></div>
	                    <div class="col-md-10">
	                        <div class="row">
	                            <div class="col-sm-6"><h4><?=$comentario->username?></h4></div>
	                            <div class="col-sm-6 right"><em class="date"><?=$comentario->date?></em></div>
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
    </section>
	<div class="col-md-1"></div>
	<section class="col-md-3">
        <div class="row">
            <div class="col-sm-12">
                <h2>Relacionados</h2>
            </div>
            <hr class="divider">
        </div>
		<?php foreach($related as $rel) { ?>
	        <div class="row margin-bottom">
	            <div class="col-sm-12">
	                <div class="col-sm-4 video-thumb"></div>
	                <div class="col-sm-8 video-thumb-info">
	                    <div class="row"><span class="video-thumb-title"><?=$rel->title?></span></div>
	                    <div class="row"><span class="video-thumb-user"><?=$rel->user?></span></div>
	                    <div class="row"><span class="video-thumb-views"><?=$rel->visits?> Visualizaciones</span></div>
	                </div>
	            </div>
	        </div>
		<?php } ?>
    </section>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
