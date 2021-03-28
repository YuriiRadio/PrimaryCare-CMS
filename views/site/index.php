<?php
/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->registerJsFile('@web/js/doctor.js', ['depends' => ['yii\web\YiiAsset', 'yii\bootstrap\BootstrapAsset']])
?>

<div class="row">

    <div class="col-sm-6 col-md-9">

        <div class="row">
            <div class="jumbotron">
            <h1><?= Yii::t('lang', 'Congratulations!') ?></h1>
            <p class="lead">You have successfully created your Yii-powered application.</p>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="http://via.placeholder.com/300x350" alt="...">
                    <div class="caption">
                    <!--<div class="icon doctor">&nbsp;</div>-->
                        <h3>Doctor1</h3>
                        <p>...</p>
                        <p>
                            <a href="#" data-id="1" class="btn btn-primary doctor-view" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <a href="<?= Url::to(['doctor/view', 'id' => 1]) ?>" class="btn btn-default" role="button">Відкрити</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="http://via.placeholder.com/300x350" alt="...">
                    <div class="caption">
                        <h3>Doctor2</h3>
                        <p>...</p>
                        <p>
                            <a href="#" data-id="2" class="btn btn-primary doctor-view" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <a href="<?= Url::to(['doctor/view', 'id' => 2]) ?>" class="btn btn-default" role="button">Відкрити</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="http://via.placeholder.com/300x350" alt="...">
                    <div class="caption">
                        <h3>Doctor3</h3>
                        <p>...</p>
                        <p>
                            <a href="#" data-id="3" class="btn btn-primary doctor-view" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <a href="<?= Url::to(['doctor/view', 'id' => 3]) ?>" class="btn btn-default" role="button">Відкрити</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="http://via.placeholder.com/300x350" alt="...">
                    <div class="caption">
                        <h3>Doctor4</h3>
                        <p>...</p>
                        <p>
                            <a href="#" data-id="4" class="btn btn-primary doctor-view" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <a href="<?= Url::to(['doctor/view', 'id' => 4]) ?>" class="btn btn-default" role="button">Відкрити</a>
                        </p>
                    </div>
                </div>
            </div>

        </div><!--row-->

    </div><!--col-sm-6 col-md-9-->

    <div class="col-sm-6 col-md-3">

        <div class="panel panel-default">
            <div class="panel-heading">Бокова навігаційна панель</div>
            <div class="panel-body">
                Вміст панелі
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">Бокова навігаційна панель2</div>
            <div class="panel-body">
                Вміст панелі2
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">Бокова навігаційна панель3</div>
            <div class="panel-body">
                Вміст панелі3
            </div>
        </div>

    </div><!--col-sm-6 col-md-3-->

</div><!--row-->

<?php

Modal::begin([
    'id' => 'doctor-modal',
    'header' => '<h2>Hello world</h2>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>',
    //'toggleButton' => ['label' => 'click me'],
]);

echo 'Say hello...';

Modal::end();

?>