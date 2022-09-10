<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesOrders */

$this->title = Yii::t('lang', 'Update Analys Order: #{name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Order') . ' #' .  $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('lang', 'Update');
?>
<div class="analyses-orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'analyses' => $analyses,
        'analyses_packages' => $analyses_packages,
    ]) ?>

</div>
