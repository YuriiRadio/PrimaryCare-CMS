<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesPackages */

$this->title = Yii::t('lang', 'Create Analyses Packages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-packages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'analyses' => $analyses,
    ]) ?>

</div>
