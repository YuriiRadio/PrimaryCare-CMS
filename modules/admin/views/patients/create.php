<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patients */

$this->title = Yii::t('lang', 'Create Patients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
