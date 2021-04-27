<?php

//use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

//$this->params['breadcrumbs'][] = Yii::t('lang', 'Admin panel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Admin panel'), 'url' => ['/admin']];
?>

<div class="admin-default-index">
    <h1>Admin panel</h1>
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <p><button class="btn btn-success" id="btn_clear_cache">Clear Cache... AJAX...</button></p>
<?php
    $js = <<<JS
    $('#btn_clear_cache').on('click', function () {
    $.ajax({
        url: '/en/admin/default/flush',
        type: 'POST',
        //data: {test: '123'},
        success: function (res) {
            if (res == 1) {
                alert("Response - OK!!! Cache cleared...");
                console.log(res);
            } else {
                alert("Response - OK!!! Cache NOT cleared...");
                console.log(res);
            }
        },
        error: function () {
            alert('Error Cache clear!!!');
        }
    });
    });
JS;

    $this->registerJs($js);
?>
            <p><button class="btn btn-warning" id="btn_clear_assets_dir">Clear Assets Dir... AJAX...</button></p>

<?php
    $js = <<<JS
    $('#btn_clear_assets_dir').on('click', function () {
    $.ajax({
    url: '/en/admin/default/clear-assets',
    type: 'POST',
    success: function (res) {
        if (res == 1) {
            alert("Response - OK!!! Assets Dir cleared...");
            console.log(res);
        } else {
            alert("Response - OK!!! Assets Dir NOT cleared...");
            console.log(res);
        }
    },
    error: function () {
        alert('Error Assets Dir cleared!!!');
    }
    });
    });
JS;

    $this->registerJs($js);
?>

<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){
        $('#btn_pjax_time').click();
    }, 10000);
});

$('#btn_pjax_time').on('click', function () {
    $.ajax({
    url: '/en/admin/default/pjax-time',
    type: 'POST',
    success: function (res) {
        $('#server_time_pjax').text(res);
    },
    error: function () {
        alert('Error Update Server Time (Pjax)!!!');
    }
    });
    });
JS;
$this->registerJs($script);
?>
<?php Pjax::begin(['enablePushState' => false]); ?>
    <p><button class="btn btn-primary" id="btn_pjax_time">Update server time... PJAX</button></p>
    <p>Час сервера: <span id="server_time_pjax"></span></p>
<?php Pjax::end(); ?>

            <p><a href="<?= Url::to(['/admin/default/test']) ?>" class="btn btn-info" id="btn_clear_assets_dir">Debag/Tests...</a></p>
        </div>

        <div class="col-sm-9 col-md-9">

        </div>

    </div>
</div>