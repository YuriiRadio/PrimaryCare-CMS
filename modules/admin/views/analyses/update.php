<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesTypes */

$this->title = Yii::t('lang', 'Update Analyses Types: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('lang', 'Update');
?>
<div class="analyses-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
