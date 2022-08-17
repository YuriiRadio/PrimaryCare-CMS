<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesCategories */

$this->title = Yii::t('lang', 'Create Analyses Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Analyses Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analyses-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
