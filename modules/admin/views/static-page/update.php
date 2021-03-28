<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\StaticPage */

$this->title = Yii::t('lang', 'Update Static Page: {nameAttribute}', [
    'nameAttribute' => @$model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => @$model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('lang', 'Update');
?>
<div class="static-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>