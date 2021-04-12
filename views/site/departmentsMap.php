<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/departments-map.js', ['depends' => ['yii\web\YiiAsset']]);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key='.Yii::$app->setting->get('GOOGLE.MAP_API').'&callback=initMap&language='.Yii::$app->language, ['depends' => ['yii\web\YiiAsset']]);

?>
<div class="site-departments">
    <h1><?= Html::encode($this->title) ?></h1>
<?php //debug($models) ?>
<?php if(!empty($models)): ?>
    <script>
        var markersData = [
<?php foreach ($models as $item): ?>
            {
                lat: <?= $item['latitude'] ?>,
                lng: <?= $item['longitude'] ?>,
                name: <?= "\"".$item['i18n']['name']."\"" ?>,
                address: <?= "\"".$item['i18n']['street'].',&nbsp;'.$item['building']."\"" ?>,
                phone: <?= "\"".$item['phone']."\"" ?>,
                department_type: <?= $item['department_type_id'] ?>
            },
<?php endforeach; ?>
        ];
    </script>
<?php endif; ?>
    <p>
        <div id="departments-map"></div>
    </p>
</div>
