<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Doctor */

$this->title = Yii::t('lang', 'Create Doctor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
