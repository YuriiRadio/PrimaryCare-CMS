<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentType */

$this->title = Yii::t('lang', 'Create Department Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Department Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
