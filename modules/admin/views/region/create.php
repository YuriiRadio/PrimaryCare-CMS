<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */

$this->title = Yii::t('lang', 'Create Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
