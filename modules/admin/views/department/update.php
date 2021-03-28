<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */

$this->title = Yii::t('lang', 'Update department').': '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('lang', 'Update');
?>
<div class="department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
