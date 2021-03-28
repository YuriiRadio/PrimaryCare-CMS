<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DoctorCategory */

$this->title = Yii::t('lang', 'Create Doctor Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Doctor Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
