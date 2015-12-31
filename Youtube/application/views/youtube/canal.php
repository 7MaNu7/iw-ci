<?php
	$this->load->view('inc/cabecera');
?>

<main class="container">
    <div class="col-md-8">
        <div class="portada">
            <div class="title"><?=$user->username?></div>
        </div>
        <iframe src="http://www.youtube.com/embed/<?=substr($last_video->url, 32, 30);?>" class="video"></iframe>
        <div class="description">
            <div class="row"><h3><?=$last_video->title?></h3></div>
            <div class="row video-info">
                <div class="col-md-4">By <?=$user->username?></div>
                <div class="col-md-4"><?=$last_video->visits?> visualizaciones</div>
                <div class="col-md-4">Hace 4 días</div>
                </div>
            <div class="row video-description">
	            <?=$last_video->description?>
            </div>
        </div>
        <div class="row space"></div>
        <section class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4>Videos</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
				<?php foreach ($videos as $video) { ?>
                <div class="col-md-3">
                    <h5><?=$video->title?></h5>
                    <img src="http://img.youtube.com/vi/<?=substr($video->url, 32, 30);?>/0.jpg" alt="" class="videos-image"/>
                </div>
				<?php } ?>
            </div>
        </section>
    </div>
    <class class="col-md-4">
       <section class="profile center">
            <img src="http://lorempixel.com/100/100" alt="" class="imagen img-circle">
            <h4><?=$user->username?></h4>
            <div class="btn-group">
                <button class="btn btn-youtube"><i class="gyphicon glyphicon-plus"></i> Suscribirse</button>
                <div class="btn btn-default">128.915 segidores</div>
            </div>
       </section>
       <div class="row space"></div>
        <section class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4>Relacionados</h4>
                    <hr>
                </div>
            </div>
			<?php foreach ($related as $rel) { ?>
            <div class="row margin-bottom">
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <img src="http://lorempixel.com/100/100" alt="" class="relacionados-imagen img-circle">
                    </div>
                    <div class="col-sm-8 relacionados-channel">
                        <div class="row"><span class="relacionados-user"><?=$rel->username?></span></div>
                        <div class="row"><span class="relacionados-thumb">124.324 Suscriptores</span></div>
                    </div>
                </div>
            </div>
			<?php } ?>
        </section>
    </class>
</main>

<?php
	$this->load->view('inc/pie.php');
?>
