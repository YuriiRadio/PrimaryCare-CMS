<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\StaticPage */

$this->title = Yii::t('lang', 'Create Static Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Static Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
