<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesTypes */

$this->title = Yii::t('lang', 'Create Analyses Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
