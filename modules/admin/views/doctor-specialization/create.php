<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DoctorSpecialty */

$this->title = Yii::t('lang', 'Create Doctor Specialization');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Doctors specialization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-specialization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
