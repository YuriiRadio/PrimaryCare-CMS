<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesOrders */

$this->title = Yii::t('lang', 'Create Analyses Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'analyses_packages' => $analyses_packages
    ]) ?>

</div>
