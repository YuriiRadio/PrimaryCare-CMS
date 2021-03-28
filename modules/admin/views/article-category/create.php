<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArticleCategory */

$this->title = Yii::t('lang', 'Create Article Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Article Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'i18nMessages' => $i18nMessages,
    ]) ?>

</div>
