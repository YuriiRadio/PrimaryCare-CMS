<?php

use yii\helpers\Html;

//$this->title = $model->i18n->title;
//$this->title = $model['title'];
//$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = @$model->name;

$this->registerJsFile('@web/js/department.js', ['depends' => ['yii\web\YiiAsset']]);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key='.Yii::$app->setting->get('GOOGLE.MAP_API').'&callback=initMap&language='.Yii::$app->language, ['depends' => ['yii\web\YiiAsset']]);

?>
<div class="row">
    <div class="col-sm-5 col-md-5">
        <div id="map" data-lat="<?= $model->latitude ?>" data-lng="<?= $model->longitude ?>"></div>
    </div>
    <div class="col-sm-7 col-md-7">
        <table class="table table-hover">
            <tr>
                <td><b><?= Yii::t('lang', 'Department type') ?>:</b></td>
                <td><?= @$model->departmentType->name ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Region') ?>:</b></td>
                <td><?= @$model->region->name ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Street') ?>:</b></td>
                <td><?= @$model->street ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Building') ?>:</b></td>
                <td><?= $model->building ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Phone') ?>:</b></td>
                <td><?= $model->phone ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Email') ?>:</b></td>
                <td><?= $model->email ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Zip code') ?>:</b></td>
                <td><?= @$model->zip_code ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Body') ?>:</b></td>
                <td><?= @$model->body ?></td>
            </tr>
        </table>
    </div>
</div>

<?php if(!empty(@$model->doctors)): ?>
<hr />
<div class="row">
    <b><p><?= Yii::t('lang', 'Doctors')?>:</p></b>

    <table class="table table-hover">
        <thead>
            <th><b>#</b></th>
            <th><b><?= Yii::t('lang', 'Name') ?></b></th>
            <th><b><?= Yii::t('lang', 'Specialization') ?>:</b></th>
            <th><b><?= Yii::t('lang', 'Experience') ?>:</b></th>
        </thead>
        <?php $i = 1; foreach (@$model->doctors as $doctor): ?>
            <tr>
                <td><b><?= $i ?></b></td>
                <td><?= Html::a($doctor->name, ['doctor/view', 'id' => $doctor->id]) ?></td>
                <td><?= @$doctor->specialization->name ?></td>
                <td><?= @$doctor->experience.Yii::t('lang', 'Y.') ?></td>
            </tr>
        <?php $i++; endforeach; ?>
    </table>

</div>
<?php endif; ?>
